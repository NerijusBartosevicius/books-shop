<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->middleware('isAdmin')->only('delete','confirmBook');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->paginate(25);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        return view('books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:100',
                'description' => 'required',
                'is_confirm' => 'boolean',
                'price' => 'required|numeric|max:99999',
                'discount' => 'numeric|max:100',
                'genre' => 'required',
                'cover' => 'mimes:jpeg,jpg,png,gif|nullable|max:10000'
            ]
        );

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['cover'] = $request->hasFile('cover') ? $this->uploadCover($request->file('cover')) : null;
        $book = Book::create($data);
        $book->genres()->sync($request->genre);


        foreach ($request->author as $author) {
            if (!is_null($author)) {
                $authors = Author::where('name', 'like', '%' . $author . '%')->first();
                if (!$authors) {
                    $authors = Author::create(['name' => $author]);
                }
                $book->authors()->attach($authors->id);
            }
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully');
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
        return view('books.view', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect('books')->with('success', 'Successfully deleted the book!');
    }

    private function uploadCover($cover)
    {
        $coverName = auth()->user()->id . '_' . time() . '.' . $cover->getClientOriginalExtension();
        $destinationPath = public_path('images/books');
        $realCoverName = $destinationPath . '/' . $coverName;
        $resize_image = Image::make($cover->getRealPath());
        $resize_image->resize(
            400,
            700
        )->save($realCoverName);

        return $coverName;
    }

    public function confirmBook($id)
    {
        //dd($id);
        $book = Book::find($id);
        $book->is_confirmed = !$book->is_confirmed;
        $book->save();

        return redirect()->back()->with('success', 'Successfully changed status the book!');
    }


}
