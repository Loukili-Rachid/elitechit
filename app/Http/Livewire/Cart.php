<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $cart;
    public $cart_counter;
    public $total;

    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->cart_counter= count((array) session('cart'));
    }

    public function incrementQuantity($productId)
    {
        $this->cart[$productId]['quantity']++;
        session()->put('cart', $this->cart);
    }

    public function removeProduct($productId)
    {
        unset($this->cart[$productId]);
        session()->put('cart', $this->cart);
    }

    public function decrementQuantity($productId)
    {
        if ($this->cart[$productId]['quantity'] > 1) {
            $this->cart[$productId]['quantity']--;
            session()->put('cart', $this->cart);
        }
    }
    private function calculateTotal()
    {
        $this->cart = session()->get('cart', []);
        $total = 0;
    
        foreach ($this->cart as $item) {
            $total += $item['quantity'] * $item['price'];
        }
    
        return $total;
    }
    private function calculateItems()
    {
        $cart_counter= count((array) session('cart'));
    
        return $cart_counter;
    }
    
    public function render()
    {
        $this->total = $this->calculateTotal();
        $this->cart_counter = $this->calculateItems();

        return view('livewire.cart', [
            'total' => $this->total,
            'cart_counter' => $this->cart_counter,
        ]);
        
    }
}
