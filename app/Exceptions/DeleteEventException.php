<?php

namespace App\Exceptions;

use Exception;

class DeleteEventException extends Exception
{
    protected $message = 'You are not the author of the event';
}
