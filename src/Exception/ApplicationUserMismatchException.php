<?php

namespace App\Exception;

use Exception;

/**
 * Class ApplicationUserMismatchException
 * @package App\Exception
 */
class ApplicationUserMismatchException extends Exception
{
    public $message = 'User does not match requested application';
}