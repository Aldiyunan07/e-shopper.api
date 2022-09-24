<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        $product = Product::all();
        return view('product/index',compact('product'));
    }

    public function create(){
        $type = Type::get();
        $brand = Brand::get();
        $product = new Product;
        return view('product/create',compact('product','brand','type'));
    }

    public function store(Request $request)
    { 
        $request->validate([
            'name' => 'required',
            'price' => 'required|min:1|integer',
            'quantity' => 'required|min:1|integer',
            'description' => 'required',
            'condition' => 'required|in:new,second',
            'brand_id' => 'required',
            'type_id' => 'required'
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name) . Str::random(4);
        auth()->user()->product()->create($data);
        return redirect('/product');
    }

    public function show($id){
        
        $product = Product::findOrFail($id);
        $gallery = Gallery::where('product_id', $product->id)->get();
        return view('product/show', compact('product','gallery'));
    }

    public function tambah($id)
    {
        $product = Product::where('slug',$id)->first();
        return view('product/tambah', compact('product'));
    }

    public function insert($slug, Request $request)
    {
        $request->validate([
            'gambar' => 'required|file|mimes:png,jpg,jpeg',
            'description' => 'required'
        ]);
        $data['isDefault'] = $request->isDefault == 1 ? 'true' : 'false';
        $data['photo'] = $request->file('gambar')->store(
            'assets/product' , 'public'
            ) ;
        $product = Product::where('slug', $slug)->first();
        Gallery::create([
            'product_id' => $product->id,
            'description' => $request->description,
            'isDefault' => $request->isDefault == null ? '0' : '1',
            'photo' => $data['photo']
        ]);
        return Redirect('product/' . $product->id);
    }

    public function delete($product, $gambar)
    {
        $gambar = Gallery::findOrFail($gambar)->first();
        $gambar->delete();
        return redirect('product/' . $product);
    }

    public function edit($id)
    {
        $type = Type::get();
        $brand = Brand::get();
        $product = Product::findOrFail($id);
        return view('product/edit',compact('product','brand','type'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|min:1|integer',
            'quantity' => 'required|min:1|integer',
            'description' => 'required',
            'condition' => 'required|in:new,second',
            'brand_id' => 'required',
            'type_id' => 'required'
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name) . Str::random(4);
        $product = Product::findOrFail($id);
        $product->update($data);
        return redirect('/product');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        foreach (Gallery::where('product_id', $id)->get() as  $value) {
            Storage::delete($value->photo);
        }
        $product->delete();
        return redirect('/product');
    }
}
