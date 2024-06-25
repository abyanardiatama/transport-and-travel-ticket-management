<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LengkapiSuratTiketDinas extends Mailable
{
    use Queueable, SerializesModels;
    public $suratPermintaanTiketDinas;
    /**
     * Create a new message instance.
     */
    public function __construct($suratPermintaanTiketDinas)
    {
        $this->suratPermintaanTiketDinas = $suratPermintaanTiketDinas;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Surat Pengurusan Tiket Perjalanan Dinas perlu dilengkapi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'dashboard.emails.lengkapi-surat-tiket-dinas',
            view: 'dashboard.emails.lengkapi-surat-tiket-dinas',
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
