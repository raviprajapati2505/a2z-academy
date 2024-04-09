<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
class BookController extends Controller
{
    public function book_store()
    {
        $books = Book::all();
        return view('frontend.book.book_store', compact('books'));
    }
}
