<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function store(Request $req, $id){

        $details = ProductDetail::findOrFail($id);

        $hist = History::where('user_id','=',Auth::user()->id)->where('paid','=',0)->first();
        $cart = $hist->cart;
        // dd($cart->products->where('product_detail_id', '=', $id)->first());
        if($cart->products->where('product_detail_id', '=', $id)->isEmpty()){
            $header = new Product();
            $header->product_detail_id = $details->id;
            $header->cart_id = $cart->id;
            $header->quantity = $req['quantity'];
        }
        else{
            $header = $cart->products->where('product_detail_id', '=', $id)->first();
            $header->quantity = $header->quantity + $req["quantity"];
        }


        $header->save();

        // $details->stock = $details->stock - $req['quantity'];
        // $details->save();

        return redirect()->back()->withSuccess(["Items are added"]);
    }

    public function remove($id){

        $header = Product::findOrFail($id);
        $header->delete();

        return redirect()->back()->withSucess(["Items are deleted from your cart"]);
    }

    public function edit(Request $req, $id){
        // dd($req->all());
        $header = Product::findOrFail($id);
        // dd($header);
        $details = ProductDetail::findOrFail($header->product_detail_id);
        // dd($details);
        if($req['quantity'] == 0){
            return $this->remove($header->id);
        }

        $req->validate([
            'quantity' => ['required', 'max:'.strval($details->stock), 'min:0'],
        ]);

        $header->update([
            'quantity' => $req['quantity'],
        ]);

        return redirect()->back()->withSuccess(["Updated Succesfully"]);

    }

}
