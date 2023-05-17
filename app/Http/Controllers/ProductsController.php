<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {  
        $products = Product::whereHas('status', function ($query) {
            $query->where('name', 'active');
        })->paginate(10);
        
        return view('products.index', compact('products'));
    }
 
    public function cart()
    {
        return view('products.cart');
    }
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
 
        $cart = session()->get('cart', []);
 
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                'product_id' => $product->id,
                "title" => $product->title,
                "price" => $product->price,
                "cost" => $product->cost,
                "quantity" => 1
            ];
        }
 
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }
}
