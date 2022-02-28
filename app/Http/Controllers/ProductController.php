<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $products;

    public function index()
    {
        return view('product.add');
    }
    public function create(Request $request)
    {
        Product::newProduct($request);

//        return redirect()->back()->with('message', 'Product info save successfully');
        return redirect('/add-product')->with('message', 'Product info save successfully');
    }

    public function manage()
    {
        $this->products = Product::orderby('id', 'desc')->get();
        return view('product.manage-product', ['products' => $this->products]);
    }
    public function edit($id)
    {
        $this->product = Product::find($id);
//        return $this->student;

        return view('product.edit-product',['product' => $this->product]);
    }

    public function update(Request $request, $id)
    {
        Product::updateProduct($request, $id);
        return redirect('/manage-product')->with('message', 'Product info update successfully');
    }

    public function delete($id)
    {
        $this->product = Product::find($id);
        $this->product->delete();
        return redirect('/manage-product')->with('message', 'Product info deleted successfully');
    }
}
