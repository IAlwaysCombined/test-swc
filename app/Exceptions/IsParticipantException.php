<?php

namespace App\Exceptions;

use Exception;

class IsParticipantException extends Exception
{
    protected $message = 'You are already participating';
}
