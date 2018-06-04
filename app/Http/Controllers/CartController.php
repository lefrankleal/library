<?php

namespace App\Http\Controllers;

use App\Book;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::leftJoin('users', 'carts.user_id', '=', 'users.id')
            ->leftJoin('books', 'carts.book_id', '=', 'books.id')
            ->where('user_id', '=', Auth::user()->id)
            ->select(
                'carts.id as id',
                'carts.quant as inCart',
                'users.id as userId',
                'users.name as userName',
                'books.id as bookId',
                'books.name as bookName',
                'books.image as bookImage',
                'books.price as bookPrice',
                'books.stock as bookStock'
            )
            ->get();
        return view('cart', compact('carts'));
    }

    public function add(Request $request, Book $book)
    {
        $user_id = Auth::user()->id;
        $cart = new Cart();
        $cart->user_id = $user_id;
        $cart->book_id = $book->id;
        $cart->quant = $request->quant;
        $cart->save();
        return redirect('home');
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->quant = $request->quant + $cart->quant;
        $cart->save();
        return redirect('cart');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect('cart');
    }

    public function confirm()
    {
        $carts = Cart::where('user_id', '=', Auth::user()->id)->get();
        foreach ($carts as $cart => $k) {
            $book = Book::where('id', $k->book_id)->first();
            if ((int) $book->stock >= (int) $k->quant) {
                $book->stock = $book->stock - $k->quant;
                $book->save();
                DB::table('carts')->where('id', '=', $k->id)->delete();
            }
        }
        return redirect('home');
    }

    public function cancel()
    {
        DB::table('carts')->where('user_id', '=', Auth::user()->id)->delete();
        return redirect('home');
    }
}
