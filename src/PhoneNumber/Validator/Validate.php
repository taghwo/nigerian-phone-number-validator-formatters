<?php

declare(strict_types=1);

namespace Taghwo\PhoneNumber\Validator;

use Error;
use Exception;
use InvalidArgumentException;
use Taghwo\PhoneNumber\BluePrint;

class Validate extends BluePrint
{
    /**
    * @return integer
    */
    public $digits;
    
    public function __construct($phoneNumber = '', $digits = null)
    {
        if (!empty($phoneNumber)) {
            parent::__construct($phoneNumber, $digits);
        }
    }
    
    /**
     * Validates with a range of number
     * @return object|Error
     */
    public function validatePhoneNumber()
    {
        if (sizeof($this->getDigits())  === 2) {
            $this->validateStrictPhoneNumber();
        }

        if (strlen($this->phoneNumber) >= $this->getDigits()[0] && strlen($this->phoneNumber) <= $this->getDigits()[1]) {
            return $this;
        }
        return [
            'status' => false,
            'Message' => invalidphonenumbererrormsg('Validation failed,phone number must be between '.$this->getDigits()[0] - $this->getDigits()[0].' characters'),
            'code' => 422
        ];
    }

    /**
    * Validates with strict digit number
    * @return object|Error
    */
    public function validateStrictPhoneNumber()
    {
        if (strlen($this->phoneNumber) === $this->getDigits()[0]) {
            return $this;
        }

        return [
            'status' => false,
            'Message' => invalidphonenumbererrormsg('Validation failed,phone number must be between '.$this->digits[0] .' to '. $this->digits[1].' characters'),
            'code' => 422
        ];
    }


    public function validateStrictPhoneNumberWithException()
    {
        if (strlen($this->phoneNumber) === $this->digits[0]) {
            return $this;
        }
        throw new Exception(
            invalidphonenumbererrormsg('Validation failed,phone number must be '.$this->digits[0]. ' characters'),
            422
        );
    }

    public function validatePhoneNumberWithException()
    {
        if (sizeof($this->digits)  === 1) {
            $this->validateStrictPhoneNumberWithException();
        }

        if (strlen($this->phoneNumber) >= $this->digits[0] && strlen($this->phoneNumber) <= $this->digits[1]) {
            return $this;
        }
        throw new Exception(
            invalidphonenumbererrormsg('Validation failed,phone number must be between '.$this->digits[0] .' to '. $this->digits[1].' characters'),
            422
        );
    }

    /**
     * returns user defined range of digits or set range
     * @return array
     */
    public function getDigits($digits = null)
    {
        if (!is_null($digits)) {
            return $this->cleanDigits($digits);
        } else {
            $this->digits = $this->standardPhoneNumberDigits;
            return $this;
        }
    }

    /**
     * clean user entered digits and explodes string to array
     * @param string $difgits
     */
    public function cleanDigits($digits)
    {
        $trimmeddigits = trim(str_replace(' ', '', (string)$digits));
                
        if (strlen($trimmeddigits) > 6) {
            throw new InvalidArgumentException('You can only pass a range of two digits, like 11,14 or a single digit like 14', 400);
        }

        $this->digits = explode(',', $trimmeddigits);

        return $this;
    }
}
