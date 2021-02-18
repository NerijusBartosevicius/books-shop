<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Mail\User\BookReported;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Mail;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with(['bookReviews'])->ByRole()->latest()->paginate();
        return view('user.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        return view('user.books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request)
    {
        $data = $request->validated();
        $data['cover'] = $request->hasFile('cover') ? $this->uploadCover($request->file('cover')) : null;
        $book = auth()->user()->books()->create($data);
        $book->genres()->sync($request->genres);

        foreach ($request->authors as $author) {
            if (!is_null($author)) {
                $authors = Author::updateOrCreate(['name' => $author]);
                $book->authors()->attach($authors->id);
            }
        }

        return redirect()->route('user.books.index')->with('success', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $reviews = $book->bookReviews()->simplePaginate(10);
        return view('user.books.show', compact('book', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $this->authorize('update', $book);
        $genres = Genre::all();
        return view('user.books.edit', compact('book', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, $id)
    {
        $book = Book::find($id);
        $this->authorize('update', $book);
        $data = $request->validated();
        if ($request->has('remove_cover') && $request->has('remove_cover') == 1 && !$request->hasFile('cover')) {
            $this->removeCoverFromStorage($book->cover);
            $data['cover'] = null;
        } elseif ($request->hasFile('cover')) {
            $this->removeCoverFromStorage($book->cover);
            $data['cover'] = $request->hasFile('cover') ? $this->uploadCover($request->file('cover')) : null;
        }

        $book->update($data);
        $book->genres()->sync($request->genres);

        $book->authors()->detach();
        foreach ($request->authors as $author) {
            if (!is_null($author)) {
                $authors = Author::updateOrCreate(['name' => $author]);
                $book->authors()->attach($authors->id);
            }
        }

        return redirect()->route('user.books.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $this->authorize('delete', $book);
        $this->removeCoverFromStorage($book->cover);
        $book->delete();

        return redirect()->route('user.books.index')->with('success', 'Successfully deleted the book!');
    }

    private function uploadCover($cover)
    {
        $coverName = auth()->user()->id . '_' . time() . '.' . $cover->getClientOriginalExtension();
        $destinationPath = public_path('images/books') . '/' . $coverName;
        $resize_image = Image::make($cover->getRealPath());
        $resize_image->resize(
            400,
            700
        )->save($destinationPath);

        return $coverName;
    }

    private function removeCoverFromStorage($coverName)
    {
        $destinationPath = public_path('images/books') . '/' . $coverName;
        if (file_exists($destinationPath) && !is_null($coverName)) {
            unlink($destinationPath);
        }
    }

    public function myBooks()
    {
        $books = auth()->user()->books()->paginate(25);
        return view('user.books.index', compact('books'));
    }

    public function reportBook($id)
    {
        $book = Book::find($id);
        $adminUsers = User::where('is_admin', 1)->pluck('email')->toArray();
        if (count($adminUsers) > 0) {
            Mail::to($adminUsers)
                ->send(new BookReported($book));
            return redirect()->back()->with('success', 'Successfully reported the book!');
        } else {
            return redirect()->back()->with('error', 'Error try again later!');
        }
    }

}
