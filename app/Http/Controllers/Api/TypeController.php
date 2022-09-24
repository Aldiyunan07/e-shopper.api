<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(){
        $type = Type::where('isOn', 1)->orderBy('name', 'asc')->get();
        return response()->json([
            'type' => $type
        ]);
    }

}
