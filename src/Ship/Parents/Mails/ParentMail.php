<?php

namespace AdminKit\Core\Ship\Parents\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

abstract class ParentMail extends Mailable
{
    use Queueable, SerializesModels;
}
