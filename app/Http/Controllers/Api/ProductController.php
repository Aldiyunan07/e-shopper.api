<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product = Product::get();
        $tipe = Type::get();
        return response()->json([
            'product' => ProductResource::collection($product),
            'type' => $tipe
        ]);
    }
}
