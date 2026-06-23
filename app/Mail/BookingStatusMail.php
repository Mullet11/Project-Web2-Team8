<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $statusType;

    /**
     * Create a new message instance.
     */
    public function __construct($reservation, $statusType)
    {
        $this->reservation = $reservation;
        $this->statusType = $statusType; // 'menunggu', 'disetujui', 'ditolak'
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subjectText = 'Status Booking Ruangan: ' . ucfirst($this->statusType);
        if ($this->statusType === 'menunggu') {
            $subjectText = 'Pengajuan Booking Berhasil Diterima';
        }

        return new Envelope(
            subject: $subjectText,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_status',
            with: [
                'reservation' => $this->reservation,
                'statusType' => $this->statusType,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
