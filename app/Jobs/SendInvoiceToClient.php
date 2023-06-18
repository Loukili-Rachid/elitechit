<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class SendInvoiceToClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $client;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client,$data)
    {
        $this->client=$client;
        $this->data=$data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client=$this->client;
        $data=$this->data;
        $pdf = Pdf::loadView('receipts.pdf', compact('data'));
        $attachment = $pdf->output();

        try {
            Mail::send('email.emailSendInvoice', ['name' => $client->last_name,'total' => $data["total"],'paymentDate'=>$data["invoiceDate"]], function ($message) use ($client,$attachment) {
                $message->from('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->sender('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->to($client->email);
                $message->replyTo('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->subject('Order Payment Confirmation');
                $message->priority(1);
                $message->attachData($attachment, 'Receipt.pdf', ['mime' => 'application/pdf']);
            });
        } catch (\Swift_TransportException $e) {
            if ($e->getMessage()) {
                return back()->with('error', 'Something went wrong. Please try again later.');
            }
        }
    }
}
