<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
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

        return redirect()->route('book.index')->with('success', 'Book created successfully');
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


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
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
        //
    }
}
