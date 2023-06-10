<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderDetails extends Component
{
    public $order_id ;
    public $order;
    public $product_id;
    public $display=false;
    public $rating;
    public $product;
    public $comment;
    public function mount()
    {
        $this->order = Order::findOrFail($this->order_id);
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function setProductId($product_id)
    {
        $this->product_id = (int)$product_id;
        $this->display= true;
        $this->rating = $this->getRatingFromDatabase();
        $this->product = Product::findOrFail($this->product_id);
    }

    public function getRatingFromDatabase()
    {
        $product = Product::findOrFail($this->product_id);
        $client_id = Auth::guard('client')->id(); 

        $rate = $product->rates()->where('client_id', $client_id)->first();

        return $rate ? $rate->rating : 0; 
    }

    public function storeRating($rating)
    {
       
        $client_id = Auth::guard('client')->id(); 
    
        // Save the rating and comment to the database
        Rate::updateOrCreate([
            'client_id' => $client_id,
            'product_id' => $this->product_id,
        ], [
            'rating' => $rating,
            'comment' => $this->comment,
        ]);
    
        // Reset the form fields
        $this->comment = null;



        $this->rating = $rating; 
        $this->closeModel();
    }
    
    public function closeModel()
    {
        $this->display= false;
    }

    public function render()
    {
        $this->order = Order::findOrFail($this->order_id);
        return view('livewire.order-details', [
            'order' => $this->order,
            'product_id' => $this->product_id,
        ]);
    }
}
