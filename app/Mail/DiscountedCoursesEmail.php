<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DiscountedCoursesEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $discountedCourses;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($discountedCourses)
    {
        $this->discountedCourses = $discountedCourses;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Discounted Courses',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.discounted-courses',
        );
    }

    public function attachments(): array
    {
        return [];
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->view('emails.discounted-courses')
            ->with('discountedCourses', $this->discountedCourses);
    }
}
