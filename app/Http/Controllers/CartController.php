<?php

namespace App\Http\Controllers;

use App\Book;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::with('user', 'book')
            ->get();
        return view('cart', compact('carts'));
    }

    public function add(Request $request, Book $book)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'quant' => 'required|numeric|min:1|max:' . $book->stock,
            ]
        );
        if ($validator->fails()) {
            return redirect('home')
                ->withErrors(
                    [
                        'quant' => [
                            'required' => 'La cantidad es requerida',
                            'between ' => ' La cantidad debe estar entre 1 y ' . $book->stock . '.',
                        ],
                    ]
                )
                ->withInput();
        }

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
        $book = Book::find($cart->book->id);
        $validator = Validator::make(
            $request->all(),
            [
                'quant' => 'required|numeric|min:1|max:' . $book->stock,
            ]
        );
        if ($validator->fails()) {
            return redirect('cart')
                ->withErrors(
                    [
                        'quant' => [
                            'required' => 'La cantidad es requerida',
                            'between ' => ' La cantidad debe estar entre 1 y ' . $book->stock . '.',
                        ],
                    ]
                )
                ->withInput();
        }

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
