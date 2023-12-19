<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatePostMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userId; // proslijedimo u konstruktor

    /**
     * Create a new message instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function build(){
        return $this->subject('New Comment Added')->view('emails.createcommentmail');
    }
}   