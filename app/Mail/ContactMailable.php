<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "";
    public $name = "";
    public $mensaje = "";
    public $email = "";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $subject, string $name, string $email,string $mensaje)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
        $this->mensaje = $mensaje;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('livewire.user.emails.contact')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'mensaje' => $this->mensaje,

            ]);
    }
}
