<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    //
    public function store(Request $req)
    {

        $req->validate([
            'category' => ['required', 'alpha', 'unique:App\Models\category'],
        ]);

        $category = Category::create([
            'category' => $req['category'],
        ]);

        $category->save();

        return redirect()->back()->withSuccess(["Category added!"]);
    }

    public function edit(Request $req, $id)
    {

        $req->validate([
            'category' => ['required', 'alpha', 'unique:App\Models\ProductDetail,category'],
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'category' => $req['category'],
        ]);

        return redirect()->back()->withSuccess(["Category updated!"]);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->back()->withSuccess(["Category deleted!"]);
    }

    public function show()
    {
        return view('Admin.add_category', ['categories' => category::all()]);
    }
}
