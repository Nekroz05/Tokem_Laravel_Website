<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductDetailController extends Controller
{
    public function index(){
        // DD();
        return view('General.product_page',['products'=>ProductDetail::paginate(12)]);
    }

    public function add_page(){
        return view('Admin.add_product', ['categories' => Category::all()]);
    }

    public function edit_page($id){
        return view('Admin.edit_product', ['product' => ProductDetail::findOrFail($id)]);
    }

    public function validating(Array $request){
        return Validator::make($request, [
            'name' => ['required','string', 'min:5'],
            'description' => ['required', 'string', 'min:15', 'max:500'],
            'price' => ['required', 'integer', 'between:1000,10000000'],
            'stock' => ['required', 'integer', 'between:1,10000'],
            'image' => ['required', 'mimes:jpg,jpeg,png'],
        ], $messages = [
            'image.required' => 'You must upload an image',
            'image.mimes' => 'image must be a jpg/jpeg/png file',
        ]);
    }

    public function store(Request $req){
        $id = $req["category"];
        $category = Category::findOrFail($id);

        $validator = $this->validating($req->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $path = $req->file('image')->store('images');

        $detail = ProductDetail::create([
            'category_id' => $category->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'image_path' => $path,

        ]);

        $detail->category()->associate($category);
        $detail->save();

        return redirect()->route('products')->withSuccess(["Product has been added!"]);
    }

    public function update(Request $req, $id){

        $detail = ProductDetail::findOrFail($id);

        $validator = Validator::make($req->all(), [
            'description' => ['required', 'string', 'min:15', 'max:500'],
            'price' => ['required', 'integer', 'between:1000,10000000'],
            'stock' => ['required', 'integer', 'between:1,10000'],
            'image' => ['required', 'mimes:jpg,jpeg,png'],
        ],
        [
            'image.required' => 'You must upload an image',
            'image.mimes' => 'image must be a jpg/jpeg/png file',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $oldPath = $detail->image_path;
        Storage::delete($oldPath);

        $path = $req->file('image')->store('images');

        $detail->update([
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'image_path' => $path,
        ]);

        return redirect()->route('products')->withSuccess(["Product ".$detail->name." has been updated!"]);

    }

    public function delete($id){
        $detail = ProductDetail::findOrFail($id);

        $oldPath = $detail->image_path;
        Storage::delete($oldPath);

        $detail->delete();

        return redirect()->back()->with('removeProduct',"Successfully Removed The Product");

    }

    public function search(Request $request){

        // DD($request->search);

        $products = ProductDetail::where('name','LIKE',"%{$request->search}%")->orWhere('description','LIKE',"%{$request->search}%")->paginate(12);

        return view('General.product_page',compact('products'));
    }

    public function detail($id){

        $product = ProductDetail::findOrFail($id);
        return view('General.product_detail')->with(compact('product'));

    }

}
