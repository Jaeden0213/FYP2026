<?php

namespace App\Mail;

use App\Models\Redemption;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VoucherMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Redemption $redemption)
    {
    }

    public function build()
    {
        return $this->subject('Your Voucher QR Code')
            ->view('emails.voucher')
            ->with([
                'redemption' => $this->redemption,
                'user' => $this->redemption->user,
                'qrPath' => public_path('images/qr.jpeg'),
            ])
            ->attach(public_path('images/qr.jpeg'), [
                'as' => 'voucher-qr.jpeg',
                'mime' => 'image/jpeg',
            ]);
    }
}