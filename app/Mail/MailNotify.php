<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    // public function build() {
    //     return $this->from('nguyenthanhphat.dev@gmail.com', 'LogdragonShop')
    //     ->subject($this->data['subject'])
    //     ->view("emails.index")->with("data", $this->data);
    // }

    public function build() {
        return $this->from('nguyenthanhphat.dev@gmail.com', 'LogdragonShop')
        ->subject($this->data['subject'])
        ->view("emails.order-notification");
    }
}
