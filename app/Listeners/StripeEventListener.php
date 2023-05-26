<?php

namespace App\Listeners;

use App\Models\Client;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class StripeEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle received Stripe webhooks.
     *
     * @param  \Laravel\Cashier\Events\WebhookReceived  $event
     * @return void
     */
    public function handle(WebhookReceived $event)
    {
        if ($event->payload['type'] === 'payment_intent.succeeded') {
            // Storage::disk('public')->put("testOne.txt", "hy :".json_encode($event->payload['data']['object']['metadata']));

            $cart = json_decode($event->payload['data']['object']['metadata']['cart'], true);
            $total = 0;
            $cost = 0;

            foreach ($cart as $item) {
                $itemTotal = $item['quantity'] * $item['price'];
                $discountAmount = ($itemTotal * $item['discount']) / 100;
                $itemTotal -= $discountAmount;
                $total += $itemTotal;
                $cost += $item['quantity'] * $item['cost'];
            }
            
            $order = new Order();
            $order->total = $total;
            $order->profit = $total-$cost;
            $order->client_id = (int)$event->payload['data']['object']['metadata']['client_id'];
            $order->status_id = Status::where('model', class_basename(Order::class))
            ->where('name', 'active')
            ->first()->id ;
            
            $order->save();

            foreach ($cart as $product) {
                $data=[
                    "quantity" => $product['quantity'],
                ];
                $order->products()->attach($product['product_id'], $data);
            }

            $client = Client::find($order->client_id); 

            // Create a new payment
            $payment = new Payment();
            $payment->paid_amount = $total; 
            
            $payment->order()->associate($order);
            $payment->client()->associate($client);

            $payment->save();


            $data=[
                "invoiceDate"=> Carbon::now()->format('Y-m-d H:i:s'),
                "total"=> $total,
                "cart"=>$cart
            ];
        
            $pdf = Pdf::loadView('receipts.pdf', compact('data'));
            $attachment = $pdf->output();
        
            $mailData = [
                'attachment' => $attachment,
            ];
        
            try {
                Mail::send('email.emailSendInvoice', ['name' => $client->last_name], function ($message) use ($client,$mailData) {
                    $message->from($client->email, $client->last_name);
                    $message->sender('contact@elitechit.com', env('MAIL_FROM_NAME'));
                    $message->to($client->email);
                    $message->replyTo('contact@elitechit.com', env('MAIL_FROM_NAME'));
                    $message->subject('Order Payment Confirmation');
                    $message->priority(1);
                    $message->attachData($mailData['attachment'], 'Receipt.pdf', ['mime' => 'application/pdf']);
                });
            } catch (\Swift_TransportException $e) {
                if ($e->getMessage()) {
                    return back()->with('error', 'Something went wrong. Please try again later.');
                }
            }
         
        }
    }
}
