<?php
namespace Taghwo\PhoneNumber\Exception;

use Exception;

class InvalidData
{
    public static function fire($message, $code = 500)
    {
        throw new Exception($message, $code);
    }
}
