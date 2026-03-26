<?php

namespace App\Mail;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewQuestionReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Question $question) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova poruka od: ' . $this->question->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-question',
        );
    }
}
