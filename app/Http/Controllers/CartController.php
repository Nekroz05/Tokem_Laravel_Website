<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    //
    public function store($id){

        $history = History::findOrFail($id);
        $cart = Cart::create([
            'history_id' => $history->id,
        ]);
        $cart->history()->associate($history);

        $cart->save();
        return $cart;
    }

    public function delete($id){

        $cart = Cart::findOrFail($id);

        $history = $cart->history()->$id;

        $cart->delete();
        $history->delete();

        return redirect()->back()->withSuccess(["Cart has been deleted"]);
    }

    public function read(){

        $hist = History::where('paid','=',0)->where('user_id','=',Auth::user()->id)->first();
        $cart = $hist->cart;
        $products = $cart->products;
        $details = ProductDetail::all();

        return view('Member.cart',compact('products','details','hist'));
    }

    function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    public function checkOutPage(){

        $permitted = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $hist = History::where('paid','=',0)->where('user_id','=',Auth::user()->id)->first();

        $cart = $hist->cart;
        // dd($cart->first()->products->first()->product_detail_id);
        $products = $cart->products;
        // dd($products);
        // $details = ProductDetail::where('id','=',$products->product_detail_id);
        // dd($details);
        $details = ProductDetail::all();



        return view('Member.checkout',compact('products','details','hist'), ["dummy"=> $this->generate_string($permitted, 6)]);
    }



    // public function checkOut($id){

    //     $cart = Cart::findOrFail($id);

    //     $products = $cart->first()->products->first();

    //     $details = ProductDetail::where('id','=',$products->product_detail_id);

    //     return view('Member.checkout',compact('details'))->with(['product'=>$products]);
    // }

}
