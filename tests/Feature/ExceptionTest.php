<?php

namespace Taghwo\PhoneNumber;

use PHPUnit\Framework\TestCase;
use Taghwo\PhoneNumber\Exception\Implementation;
use Taghwo\PhoneNumber\Exception\InvalidData;

class ExceptionTest extends TestCase
{

     /**
     * @test
     *
     ***/
    public function assert_implementation_exception_fires()
    {
        $this->expectExceptionCode(500);
        $this->expectException(Implementation::fire(IMPLEMENTATION_EXCEPTION_MSG, 500));
        $this->expectExceptionMessage(IMPLEMENTATION_EXCEPTION_MSG);
    }

    /**
     * @test
     *
     ***/
    public function assert_invalid_data_exception_fires()
    {
        $this->expectExceptionCode(422);
        $this->expectException(InvalidData::fire(INVALID_PHONE_NUMBER_MSG, 422));
        $this->expectExceptionMessage(INVALID_PHONE_NUMBER_MSG);
    }
}
