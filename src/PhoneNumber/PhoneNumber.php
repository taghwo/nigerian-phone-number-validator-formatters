<?php
namespace Taghwo\PhoneNumber;

use Taghwo\PhoneNumber\Validator\Validate;

class PhoneNumber
{
    public static function __callStatic($method, $arguments)
    {
        return PhoneNumberRequest::new(...$arguments)->{$method}(...$arguments);
    }
}
class PhoneNumberRequest extends BluePrint
{
    public function __construct($phoneNumber = '')
    {
        if (!empty($phoneNumber)) {
            parent::__construct($phoneNumber);
        }
    }

    public static function new(...$args)
    {
        return new self(...$args);
    }

    /**
     * Set phonenumber as you wish, this will override $this->phoneNumber in parent class
     * @param string $phoneNumber
     * @return object
     */
    public function setPhoneNumber(string $newPhoneNumber = ''):object
    {
        if (!empty($newPhoneNumber)) {
            $this->dirtyPhoneNumber = $newPhoneNumber;
            $this->cleanPhoneNumber((string)$newPhoneNumber);
        }
        
        return $this;
    }
    
     
    /**
     * Set digits to validate with
     * @param string $digits standard 11,14
     * @return object
     */
    public function setDigits(string $digits)
    {
        $this->digits = $digits;

        return $this;
    }

    /**
     * Fetch prefix for phone number
     * @return $string
     * @param string $newPhoneNumber optional
     */
    public function getPrefix(string $newPhoneNumber = ''):string
    {
        return $this->formatPrefix($newPhoneNumber);
    }

    /**
     * Splits phone number into chunks
     * @param string $newPhoneNumber
     * @param int $depth
     * @return array
     */
    public function splitPhoneNumber(string $newPhoneNumber = null, $depth = 1):array
    {
        !empty($newPhoneNumber)?
         $this->cleanPhoneNumber((string)$newPhoneNumber) : $this->phoneNumber;
         
        return $this->chunkPhoneNumber($this->phoneNumber, $depth);
    }

    /**
    * returns a clean phone number
    * @return string
    */
    public function getCleanNumber(string $newPhoneNumber = ''):string
    {
        !empty($newPhoneNumber)?
         $this->cleanPhoneNumber((string)$newPhoneNumber) : $this->phoneNumber;

        return $this->phoneNumber;
    }

    /**
     * format phone number to int format
     * @param string $newPhoneNumber optional is passed it will replace $this->phoneNumber
     * @return string
     */
    public function formatToIntPhoneNumber($newPhoneNumber = null):string
    {
        return $this->intFormatPhoneNumber($newPhoneNumber);
    }

    
    /**
     * validate strict with a single digit
     * note if you add a range of digits it will use the first
     * @return object|Error
     */
    public function validateStrict(string $newPhoneNumber = '')
    {
        !empty($newPhoneNumber)?
        $this->cleanPhoneNumber((string)$newPhoneNumber) : $this->phoneNumber;

        $validator = new Validate($this->phoneNumber);

        $validator->validatePhoneNumberWithException();

        return $this;
    }

    /**
    * validate with a range with a range digits
    * note if you set digits to a single digit, strict validate methos will be used
    * @return object|Error
    */
    public function validateWithRange(string $newPhoneNumber = '')
    {
        !empty($newPhoneNumber)?
        $this->cleanPhoneNumber((string)$newPhoneNumber) : $this->phoneNumber;

        $validator = new Validate($this->phoneNumber);

        $validator->getDigits($this->digits);

        $validator->validatePhoneNumberWithException();

        return $this;
    }

    public function getAllPhoneNumberPrefix():string
    {
        return json_encode(array_merge($this->intPrefix, $this->localPrefix));
    }
}
