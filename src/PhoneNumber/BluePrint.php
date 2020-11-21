<?php

declare(strict_types=1);

namespace Taghwo\PhoneNumber;

use InvalidArgumentException;
use Taghwo\PhoneNumber\Exception\Implementation as ImplementationException;
use Taghwo\PhoneNumber\Factory;

class BluePrint extends Factory
{
    /**
     * @return string
     */
    public $dirtyPhoneNumber;

    /**
     * @return string
     */
    public $phoneNumber;

    /**
     * @return integer
     */
    public $digits;

    /**
     * @return bool
     */
    protected $isIntPrefix = false;

    /**
    * @return array
    */
    private $splitPhoneNumberInThreeArr = [];

    /**
    * @return array
    */
    private $splitPhoneNumberInOneArr = [];
            

    /**
     * @param string $phoneNumber
     */
    public function __construct(String $phoneNumber = '1')
    {
        $this->dirtyPhoneNumber = $phoneNumber;
        $this->cleanPhoneNumber((string)$phoneNumber);
    }
    
    /**
     * Fetch prefix for phone number
     * @return $string
     * @param string $newPhoneNumber optional
     */
    protected function formatPrefix($newPhoneNumber = null):string
    {
        if (!is_null($newPhoneNumber)) {
            $this->dirtyPhoneNumber = $newPhoneNumber;
            $this->cleanPhoneNumber($newPhoneNumber, 'getPrefix');
        }

        $this->splitPhoneNumberInThreeArr = $this->chunkPhoneNumber($this->phoneNumber, 3);
                         

        if (in_array($this->splitPhoneNumberInThreeArr[0], $this->intPrefix)) {
            $this->isIntPrefix = true;

            return $this->splitPhoneNumberInThreeArr[0];
        } elseif (in_array($this->splitPhoneNumberInThreeArr[0], $this->localPrefix)) {
            $this->isIntPrefix = false;
            return $this->splitPhoneNumberInThreeArr[0];
        } else {
            $this->isIntPrefix = false;
            return ['status' => false,'Message' => INVALID_PREFIX_MSG,'code' => 400];
        }
    }

    /**
     * Splits phone number into chunks
     * @param string $phoneNumber
     * @param mixed $depth
     * @return array
     */
    protected function chunkPhoneNumber($phoneNumber, $depth = 1):array
    {
        $this->cleanPhoneNumber($phoneNumber);

        return str_split($this->phoneNumber, $depth);
    }

    /**
     * format phone number to int format
     * @param string $newPhoneNumber optional is passed it will replace $this->phoneNumber
     * @return string
     */
    protected function intFormatPhoneNumber($newPhoneNumber = null):string
    {
        if (!is_null($newPhoneNumber)) {
            $this->dirtyPhoneNumber = $newPhoneNumber;
            $this->phoneNumber = (string)$newPhoneNumber;
            $this->cleanPhoneNumber($newPhoneNumber, 'formatToIntPhoneNumber');
        }

        $this->formatPrefix();

        if (!$this->isIntPrefix) {
            $this->splitPhoneNumberInOneArr = $this->chunkPhoneNumber($this->phoneNumber);
           
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
    protected function cleanPhoneNumber($phoneNumber, $method = '')
    {
        if (empty($this->phoneNumber) && empty($phoneNumber)) {
            throw new ImplementationException(IMPLEMENTATION_EXCEPTION_MSG .$this->extraMessageForException($method), 500);
        }
        $this->phoneNumber =  $this->filterNumber($phoneNumber);

        return $this;
    }

    /**
     * This filter dirty phone number
     */
    protected function filterNumber($number)
    {
        return trim(preg_replace('/[^0-9\.]/i', '', $number));
    }

    private function extraMessageForException($methodName)
    {
        return !empty($method)? "or pass a phone number as the argument to the {$methodName} method":'';
    }
}
