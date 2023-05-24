<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        $checkout= count((array) session('cart'))==0 ? false:true;

        if (Auth::guard('client')->check()) {
            $intent = Auth::guard('client')->user()->createSetupIntent()->client_secret;
            return view('products.cart', compact('intent','checkout'));
        } else {
            $intent = null;
            return view('products.cart', compact('intent','checkout'));
        } 
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

    public function purchase(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
    
        foreach ($cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }

        $user = Auth::guard('client')->user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($total * 100, $paymentMethod, [
                'metadata' => [
                    'cart' => json_encode($cart),
                    'client_id' => $user->id,
                ],
            ]);        
            session()->forget('cart');
        } catch (\Exception $exception) {
            return back()->with('error', "there is an error! please try again");
        }
        
        return back()->with('success', 'Thank you for your order! the order has been successfully placed');
    }

    public function removeProduct(int $productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        return redirect()->back();
    }
}
