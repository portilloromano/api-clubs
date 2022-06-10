<?php

namespace Api\Emails\ClubsAdmin\Presentation;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailAssociateClubController extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this
            ->from('contracting@clubsadmin.com')
            ->subject('Contratación con el Club: ' . $this->data['club']['name'])
            ->view('emails.associate_club');
    }

}
