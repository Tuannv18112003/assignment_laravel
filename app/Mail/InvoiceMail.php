<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $list_details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($list_details)
    {
        $this->list_details = $list_details;
        // dd($list_details);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('nguyenvantuan18112003dt@gmail.com'),
            subject: 'Hóa đơn thanh toán',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'backend.bills.invoice',
            with: [
                $this->list_details
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
