<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuratPermintaanTiketDinasCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $validatedData;
    /**
     * Create a new message instance.
     */
    public function __construct($validatedData)
    {
        $this->validatedData = $validatedData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Surat Permintaan Pengurusan Tiket untuk Perjalanan Dinas Baru',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'dashboard.emails.surat-permintaan-tiket-dinas-created',
            view: 'dashboard.emails.surat-permintaan-tiket-dinas-created',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
