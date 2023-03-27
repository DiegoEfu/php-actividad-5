<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class ClaveMail extends Mailable
{
    use Queueable, SerializesModels;
    public $demo;
    public $clave;
    public function __construct($demo, $clave)
    {
        $this->clave = $clave;
        $this->demo = $demo;
    }

    public function build()
    {
        return $this->from('no.reply.arcadestation@gmail.com')
                    ->view('mails.clave')
                    ->with(
                      [
                            'contrasena' => $this->clave,
                      ]);
    }
}
