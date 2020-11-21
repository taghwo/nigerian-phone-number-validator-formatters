<?php

const INVALID_PHONE_NUMBER_MSG = "The phone number supplied is invalid. Must be between 11 and 14 characters";

const INVALID_PREFIX_MSG = "The phone number prefix is invalid";

const IMPLEMENTATION_EXCEPTION_MSG = "To validate/format a phone number you must pass the number as an argument when initializing the class constructor";

const MIN_NUMBER = 11;

const MAX_NUMBER = 14;

const INT_PREFIX = 234;

const DIRTY_STRINGS = ['+','-','%','&','$','=',',',';','_','/','*','#','\\'];

if (!function_exists('invaliderrormsg')) {
    function invalidphonenumbererrormsg($message)
    {
        return $message;
    }
}
