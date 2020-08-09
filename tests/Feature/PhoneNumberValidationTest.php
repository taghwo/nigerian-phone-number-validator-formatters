<?php

namespace Taghwo\PhoneNumber;

use PHPUnit\Framework\TestCase;
use Taghwo\PhoneNumber\Validator\PhoneValidate;

class PhoneNumberValidationTest extends TestCase
{
    protected $validator;

    public function setUp():void
    {
        parent::setUp();

        $this->validator = new PhoneValidate('0____7=0/6-0*49\916/049');
    }

    /**
    * @test
    * **/
    public function can_fetch_all_prefix()
    {
        $prefix = $this->validator->getAllPhoneNumberPrefix();

        $this->assertTrue(sizeOf(json_decode($prefix)) > 0);
    }

    /**
    * @test
    * **/
    public function can_fetch_a_prefix()
    {
        $prefix = $this->validator->getPrefix();

        $this->assertTrue(strlen($prefix) == 3);
    }

    /**
    * @test
    * **/
    public function can_fetch_clean_number()
    {
        $cleanNumber = $this->validator->getCleanNumber();

        $this->assertFalse(str_replace(['+','-','%','&','$','=',',',';','_','/','*','#','\\'], '', $cleanNumber) != $cleanNumber);
    }

    /**
    * @test
    **/
    public function can_format_to_Int_number()
    {
        $intFormattedNumber = $this->validator->formatToIntPhoneNumber();

        if (strrpos($intFormattedNumber, (string)INT_PREFIX) !== false) {
            $status =  true;
        } else {
            $status = false;
        }

        $this->assertTrue($status);
    }
}
