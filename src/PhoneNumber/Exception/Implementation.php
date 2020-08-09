<?php
namespace Taghwo\PhoneNumber\Exception;

use Exception;

class Implementation
{
    public static function fire($message, $code = '')
    {
        throw new Exception($message, $code);
    }
}
