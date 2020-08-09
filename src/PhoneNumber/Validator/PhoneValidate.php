<?php

declare(strict_types=1);

namespace Taghwo\PhoneNumber\Validator;

use Taghwo\PhoneNumber\Exception\Implementation as ImplementationException;
use Taghwo\PhoneNumber\Exception\InvalidData as InvalidDataException;
use Taghwo\PhoneNumber\Validator\Factory;

class PhoneValidate extends Factory
{
    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var bool
     */
    private $isIntPrefix = false;

    /**
    * @var array
    */
    private $splitPhoneNumberInThreeArr = [];

    /**
    * @var array
    */
    private $splitPhoneNumberInOneArr = [];
            

    /**
     * @param string $phoneNumber
     */
    public function __construct(String $phoneNumber = null)
    {
        $this->cleanPhoneNumber((String)$phoneNumber);
    }

    /**
     * Validates Nigerian phone Number
     * @return Object
     */
    public function validatePhoneNumber()
    {
        if (strlen($this->phoneNumber) >= MIN_NUMBER && strlen($this->phoneNumber) <= MAX_NUMBER) {
            return $this;
        }
        InvalidDataException::fire(
            INVALID_PHONE_NUMBER_MSG,
            422
        );
    }
    
    /**
     * Fetch prefix for phone number
     * @return $string
     * @param $string $phoneNumber
     */
    public function getPrefix($phoneNumber = null):String
    {
        $this->splitPhoneNumberInThreeArr = is_null($phoneNumber) ?
                            $this->splitPhoneNumber($this->phoneNumber, 3) :
                            $this->splitPhoneNumber($phoneNumber, 3);

        if (in_array($this->splitPhoneNumberInThreeArr[0], $this->intPrefix)) {
            $this->isIntPrefix = true;

            return $this->splitPhoneNumberInThreeArr[0];
        } elseif (in_array($this->splitPhoneNumberInThreeArr[0], $this->localPrefix)) {
            $this->isIntPrefix = false;
            return $this->splitPhoneNumberInThreeArr[0];
        } else {
            InvalidDataException::fire(
                INVALID_PREFIX_MSG,
                400
            );
        }
    }

    private function splitPhoneNumber($phoneNumber, $depth = 1)
    {
        return str_split($phoneNumber, $depth);
    }

    public function formatToIntPhoneNumber($newPhoneNumber = null)
    {
        if (!is_null($newPhoneNumber)) {
            $this->cleanPhoneNumber($newPhoneNumber, 'formatToIntPhoneNumber');
        }
            
        $this->getPrefix();

        if (!$this->isIntPrefix) {
            $this->splitPhoneNumberInOneArr = $this->splitPhoneNumber($this->phoneNumber);
           
            array_shift($this->splitPhoneNumberInOneArr);
    
            array_unshift($this->splitPhoneNumberInOneArr, INT_PREFIX);

            $this->phoneNumber = implode($this->splitPhoneNumberInOneArr);

            return implode($this->splitPhoneNumberInOneArr);
        }

        return $this->phoneNumber;
    }


    /**
     * remove unwanted parts from phone number
     * @return object
     */
    private function cleanPhoneNumber($phoneNumber, $method = '')
    {
        if (empty($phoneNumber)) {
            ImplementationException::fire(
                IMPLEMENTATION_EXCEPTION_MSG .$this->extraMessageForException($method),
                500
            );
        }

        $cleanPhoneNumber =  trim(str_replace(['+','-','%','&','$','=',',',';','_','/','*','#','\\'], '', $phoneNumber));

        $this->phoneNumber = $cleanPhoneNumber;

        $this->validatePhoneNumber();

        return $this;
    }

    private function extraMessageForException($methodName)
    {
        return !empty($method)? "or pass a phone number as the argument to the {$methodName} method":'';
    }

    public function getCleanNumber()
    {
        return $this->phoneNumber;
    }

    public function getAllPhoneNumberPrefix():string
    {
        return json_encode(array_merge($this->intPrefix, $this->localPrefix));
    }
}
