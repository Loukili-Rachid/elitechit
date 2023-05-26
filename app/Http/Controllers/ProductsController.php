<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class ProductsController extends Controller
{
    public function index()
    {  
        // Meta tags Generator
        SEOMeta::setTitle(setting('site.title'));
        SEOMeta::setDescription(setting('site.description'));
        SEOMeta::addKeyword(['Computer Repair Services', 'elitch', 'Mobile','Laptop']);
        // Opengraph tags Generator
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::setDescription(setting('site.description'));
        OpenGraph::setTitle(setting('site.title'));
        OpenGraph::addProperty('type', 'section');
        // Twitter for Twitter Cards tags Generator
        TwitterCard::setTitle(setting('site.title'));
        TwitterCard::setSite('@elitch');
        // json-Ld tags Generator
        JsonLd::setTitle(setting('site.title'));
        JsonLd::setDescription(setting('site.description'));

        $products = Product::whereHas('status', function ($query) {
            $query->where('name', 'active');
        })->paginate(10);
        
        return view('products.index', compact('products'));
    }
    
    public function show($id){
        $products = Product::whereHas('status', function ($query) {
            $query->where('name', 'active');
        })->get();
        $product = $products->where('id', $id)->firstOrFail();

        // Meta tags Generator
        SEOMeta::setTitle($product->meta_title ?? '');
        SEOMeta::setDescription($product->meta_description ?? '');
        SEOMeta::addKeyword(['Computer Repair Services', 'elitch', 'Mobile','Laptop']);
        // Opengraph tags Generator
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::setDescription($product->meta_description ?? '');
        OpenGraph::setTitle($product->meta_title ?? '');
        OpenGraph::addProperty('type', 'section');
        // Twitter for Twitter Cards tags Generator
        TwitterCard::setTitle($product->meta_title ?? '');
        TwitterCard::setSite('@elitch');
        // json-Ld tags Generator
        JsonLd::setTitle($product->meta_title ?? '');
        JsonLd::setDescription($product->meta_description ?? '');

        return view('products.show', compact('product'));
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
        $discount = !empty($product->discount) ? $product->discount : 0 ;
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                'product_id' => $product->id,
                "title" => $product->title,
                "price" => $product->price,
                "cost" => $product->cost,
                "discount" => $discount ,
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
            $itemTotal = $item['quantity'] * $item['price'];
            $discountAmount = ($itemTotal * $item['discount']) / 100;
            $itemTotal -= $discountAmount;
            $total += $itemTotal;
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
