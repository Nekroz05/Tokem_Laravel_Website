<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CartController;

class HistoryController extends Controller
{

    public function store($id){
        $history = History::create([
            'user_id' => $id,
            'paid' => 0,
        ]);
        // $history->user()->associate($user);
        $history->save();
        return $history;
    }

    public function paid(Request $req,$id){
        // dd($req->all());
        // dd(Auth::user()->password);
        // dd(strcmp(Auth::user()->password, Hash::make($req['password'])) !== 0);
        if(strcmp($req['confirm'], $req["password"]) != 0){
            return redirect()->back()->withErrors(['Passwords are not matching']);
        }

        $history = History::where('user_id','=',Auth::user()->id)->where('id','=',$id)->first();
        // dd($history->cart->products);
        $products = $history->cart->products;
        // dd($products);
        // dd(ProductDetail::where('id', '=', $products[0]->product_detail_id)->first());
        foreach($products as $product){
            $detail = ProductDetail::where("id", '=', $product->product_detail_id)->first();
            // dd($detail);
            $detail->stock = $detail->stock - $product->quantity;
            $detail->save();
        }

        $history->update([
            'paid' => 1,
        ]);



        $newHistory = $this->store(Auth::user()->id);
        (new CartController)->store($newHistory->id);

        return redirect()->route('home')->withSuccess(["Payment successfull!"]);
    }

    public function new_user($id){
        $history = $this->store($id);
        (new CartController)->store($history->id);
    }

    public function index(){
        $histories = History::all()->where('user_id','=',Auth::user()->id)->where('paid','>',0);
        $details = ProductDetail::all();
        // DD($histories);
        return view('Member.transaction')->with(compact('histories','details'));
    }
}
