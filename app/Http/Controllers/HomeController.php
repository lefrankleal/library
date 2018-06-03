<?php

namespace App\Http\Controllers;

use App\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id', 'DESC')
            ->orderBy('name', 'DESC')
            ->paginate(10);
        return view('home', compact('books'));
    }
}
