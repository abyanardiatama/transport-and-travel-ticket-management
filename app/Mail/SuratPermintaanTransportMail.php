<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SuratPermintaanTransportMail extends Mailable
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
    public function envelope() : Envelope
    {
        return new Envelope(
            from: new Address('systemsimtpdsucofindo@gmail.com', 'Sistem Manajemen Transport dan Pengurusan Tiket Perjalanan Dinas'),
            subject: 'New Surat Permintaan Transport',
        );
        // return $this->subject('Surat Permintaan Transportasi Approval Needed')
        //             ->view('dashboard.emails.surat_permintaan_transport_created');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'dashboard.emails.surat_permintaan_transport_created',
            view: 'dashboard.emails.surat_permintaan_transport_created',
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
