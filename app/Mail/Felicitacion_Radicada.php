<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Felicitacion_Radicada extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id_felicitacion;
    public function __construct($id_felicitacion)
    {
        $this->id_felicitacion = $id_felicitacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('contacto@quiku.com')->view('intranet.emails.felicitacion_mail')->with(['id_felicitacion' => $this->id_felicitacion,]);
    }
}
