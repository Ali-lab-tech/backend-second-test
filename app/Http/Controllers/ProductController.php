<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('feedBacks.user')->get();
        return response()->json(['products' => $products], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
        ]);
        return response()->json(['products' => $product], Response::HTTP_CREATED);
    }
}
