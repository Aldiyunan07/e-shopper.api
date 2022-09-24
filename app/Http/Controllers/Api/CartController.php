<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function index(){
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'cart' => CartResource::collection($cart)
        ]);
    }

    public function store($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $cartslug = Cart::where('product_id', $product->id)->where('user_id',auth()->user()->id)->first();
        if($cartslug->count() == 0){            
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }else{
            $cartslug->update([
                'quantity' => $cartslug->quantity + 1
            ]);
        }
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'message' => 'Berhasil di tambahkan ke Cart',
            'cart' => CartResource::collection($cart)
        ]);
    }

    public function destroy($id)
    {
        $cart = Cart::where('product_id', $id)->first();
        $cart->delete();
        return response()->json([
            'message' => 'Berhasil di hapus dari Cart'
        ]);
    }

    public function action(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|min:1'
        ]);
        $cart = Cart::where('product_id', $id)->first();
        $cart->update([
            'quantity' => $request->input('quantity')
        ]);
        return response()->json([
            'message' => 'Berhasil Menambah jumlah product ke cart'
        ]);
    }

}
