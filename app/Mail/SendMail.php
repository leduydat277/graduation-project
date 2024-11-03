<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $view;
    public $data_view;

    /**
     * Create a new message instance.
     */
    public function __construct($data = [])
    {
        $this->subject = $data['subject'];
        $this->view = $data['view'];
        $this->data_view = $data['data_view'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject, // Sử dụng subject từ constructor
            from: new Address(
                config('mail.from.address'),  // Lấy địa chỉ từ .env
                config('mail.from.name')       // Lấy tên từ .env
            ),
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view($this->view, $this->data_view) // Sử dụng trực tiếp thuộc tính
            ->subject($this->subject);
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [
            // new Attachment(
            //     path: '/path/to/file.pdf',
            //     name: 'File.pdf',
            // ),
        ];
    }
}