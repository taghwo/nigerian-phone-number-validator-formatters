<?php

namespace Taghwo\PhoneNumber\Rule;

use Taghwo\PhoneNumber\Validator\Validate;

class Check
{
    public static function __callStatic($method, $arguments)
    {
        return  PhoneNumberRule::new(...$arguments)->{$method}(...$arguments);
    }
}

class PhoneNumberRule extends Validate
{
    use HttpClient;

    public function __construct($phoneNumber = '')
    {
        parent::__construct($phoneNumber);
    }

    public static function new(...$args)
    {
        return new self(...$args);
    }

    public function verifyPhoneNumber()
    {
        $response = $this->validatePhoneNumber();

        if (is_array($response) && isset($response['status']) && $response['status'] === false) {
            return 'false';
        }
        return 'true';
    }

    public function verifyPhoneNumberIsIntFormat()
    {
        $this->validator->getPrefix();

        return $this->isIntPrefix? 'true':'false';
    }

    public function verifyPhoneNumberIsClean()
    {
        if (str_replace(DIRTY_STRINGS, '', $this->dirtyPhoneNumber) !== false) {
            return false;
        }
        return true;
    }

    /**
     * Initialize spam verification
     */
    public function verifySpamStatus()
    {
        return $this->runSpamChecker($this->intFormatPhoneNumber());
    }
}
