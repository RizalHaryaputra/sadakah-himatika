<?php

namespace App\Mail;

use App\Models\PenukaranPoin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PenukaranDiambilMail extends Mailable
{
    use Queueable, SerializesModels;

    public $penukaran;

    public function __construct(PenukaranPoin $penukaran)
    {
        $this->penukaran = $penukaran;
    }

    public function build()
    {
        return $this->subject('Penukaran Poin Diambil')
            ->markdown('emails.penukaran-diambil');
    }
}
