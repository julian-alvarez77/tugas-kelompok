<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\User;

class BooksController extends Controller
{

		public function __construct()
		{
				$this->middleware('auth');
		}

    public function index()
    {
			/*
			$user_id = Auth::user()->id;
      $books = Book::where('user_id', $user_id);
			*/
			$books = Book::get();
      $booksUnvailableCount = Book::where('is_borrowed', true)->count();
      $booksAvailableCount = Book::where('is_borrowed', false)->count();

      foreach ($books as $book) {
          $book->image = str_replace('public/', 'storage/', $book->image);
      }

      return view('index',[
          "books" => $books,
          "booksUnvailableCount" => $booksUnvailableCount,
          "booksAvailableCount" => $booksAvailableCount,
      ]);
    }

    public function create(Request $request)
    {
        $book = new Book();
				$book->user_id = Auth::user()->id;
        $book->name = $request->book_title;
        $book->author = $request->book_author;
        $book->year = $request->book_tahun;
        $book->image = $request->book_image->store('public/post_images');
        $book->save();
        return redirect('/');
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if ($request->unread) {
          $book->status = "unread";
        }elseif ($request->reading) {
          $book->status = "reading";
        }elseif ($request->finished){
          $book->status = "finished";
        }

        if ($request->borrow) {
          $book->is_borrowed = true;
        }

        $book->save();
        return redirect('/');
    }

    public function destroy(Request $request)
    {
        Book::find($request->id)->delete();
        return redirect('/');
    }
}
