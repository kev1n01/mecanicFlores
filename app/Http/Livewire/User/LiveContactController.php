<?php

namespace App\Http\Livewire\User;

use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class LiveContactController extends Component
{
    public $email = '';
    public $name = '';
    public $subject = '';
    public $mensaje = "";
    public function render()
    {
        return view('livewire.user.live-contact-controller')
            ->extends('layouts.user.app')->section('content');
    }

    public function sendEmail(){
        $email = new ContactMailable($this->subject,$this->name,$this->email,$this->mensaje);
        Mail::to($this->email)->send($email);
        $this->emit('successful_alert', 'Mensaje enviado!');

    }
}
