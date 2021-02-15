<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookReviewStoreRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookReview;
use Illuminate\Http\Request;

class BookReviewController extends Controller
{
    public function store(BookReviewStoreRequest $request)
    {
        auth()->user()->bookReviews()->create($request->validated());

        return redirect()->back()->with('success', 'Successfully created the review!');
    }
}
