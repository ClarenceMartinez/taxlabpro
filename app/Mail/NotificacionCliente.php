<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionCliente extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $nameUser;
    public $msg;

    public function __construct($name, $nameUser, $msg)
    {
        $this->name     = $name;
        $this->msg      = $msg;
        $this->nameUser = $nameUser;
    }

    public function build()
    {
        return $this->subject('Notifications| TaxLabPro')
                    ->view('emails.notificacion');
    }
}
