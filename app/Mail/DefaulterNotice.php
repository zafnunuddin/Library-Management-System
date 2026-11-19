<?php

namespace App\Mail;

use App\Models\BookIssue;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DefaulterNotice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The overdue book issue this notice is about.
     */
    public BookIssue $issue;

    /**
     * How many days overdue the book currently is.
     */
    public int $overdueDays;

    /**
     * The fine amount currently owed for this overdue issue.
     */
    public float $fineAmount;

    /**
     * Create a new message instance.
     */
    public function __construct(BookIssue $issue, int $overdueDays, float $fineAmount)
    {
        $this->issue = $issue;
        $this->overdueDays = $overdueDays;
        $this->fineAmount = $fineAmount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Overdue Book Reminder - ' . ($this->issue->book->title ?? 'Library Book'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.defaulter_notice',
            with: [
                'issue' => $this->issue,
                'overdueDays' => $this->overdueDays,
                'fineAmount' => $this->fineAmount,
            ],
        );
    }
}
