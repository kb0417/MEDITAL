<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Analyse;

class AnalyseDisponibleMail extends Mailable
{
    use Queueable, SerializesModels;
    public Analyse $analyse;

    /**
     * Create a new message instance.
     */
    public function __construct(Analyse $analyse)
    {
        $this->analyse = $analyse;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Analyse Disponible Mail',
    //     );
    // }
    public function build()
    {
        return $this
            ->subject('Votre résultat d’analyse est disponible')
            ->view('emails.analyse_disponible')
            ->with([
                'analyse' => $this->analyse
            ]);
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

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
