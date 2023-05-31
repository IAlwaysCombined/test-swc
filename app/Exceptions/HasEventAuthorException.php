<?php

namespace App\Exceptions;

use Exception;

class HasEventAuthorException extends Exception
{
    protected $message = 'You are the author of the event';
}
