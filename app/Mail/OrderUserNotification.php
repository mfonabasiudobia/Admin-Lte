<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use App\Repositories\TransactionRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $trx;

    public function __construct($trx)
    {
        $this->trx = $trx;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), gs()->business_name),
            subject: "eConnect Card Purchased!",
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
            view: 'emails.order-user-notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        $cardType =  $this->trx->query2['card_type'] ?? null;

        $expiryDate = $cardType == 'business' ? \Carbon\Carbon::parse($this->trx->query2['expires_at'])->setTimezone($this->trx->timezone ?? 'America/New_York')->format('d M, Y h:i A') : null;

        $date = $this->trx->created_at->setTimezone($this->trx->timezone ?? 'America/New_York')->format("d M, Y h:i A");


        $data = [
            'trx' => $this->trx->trx,
            'logo' => gs()->logo,
            'date' => $date,
            'expiryDate' =>  $expiryDate,
            'cardType' => $cardType,
            'status' => $this->trx->status,
            'quantity' => $this->trx->quantity,
            'last4' => $this->trx->query2['last4'] ?? null,
            'price' => number_format($this->trx->price, 2),
            'amount' => number_format($this->trx->amount, 2),
        ];

        $pdf = Pdf::loadView('emails.invoice-pdf', $data)->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true, 'enable_remote' => true]);

        return [
            Attachment::fromData(fn() => $pdf->output(), 'TransactionReceipt.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
