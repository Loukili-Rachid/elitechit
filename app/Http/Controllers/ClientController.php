<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function showOrder()
    {
        $client = Auth::guard('client')->user();

        $authenticatedClientWithOrders = Client::with('orders')->find($client->id);

        $orders = $authenticatedClientWithOrders->orders()->paginate(10);
        
        return view('client.orders',compact('orders'));

    }

    public function orderUpdate(Order $order)
    {
        try {
            $client = Auth::guard('client')->user();
            $order = Order::where('client_id', $client->id)
            ->findOrFail($order->id);

        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Order not found.');
        }
        // Check if the current status is not already "received"
        if ($order->status->name !== 'received') {
            // Update the status to "received"
            $order->status()->associate(
                Status::where('model', class_basename(Order::class))
                    ->where('name', 'received')->first()
            );
            $order->save();

            // Perform any additional actions or redirects as needed

            return redirect()->back()->with('success', 'Order marked as received.');
        }

        return redirect()->back()->with('error', 'Order is already marked as received.');
    }

    public function orderDetails(Order $order)
    {
        $client = Auth::guard('client')->user();
        $order = Order::where('client_id', $client->id)
        ->findOrFail($order->id);
        return view('client.order-details', compact('order'));

    }
}
