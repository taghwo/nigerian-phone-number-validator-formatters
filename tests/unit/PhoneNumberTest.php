<?php

namespace Taghwo\PhoneNumber;

use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    /**
     * @test
     */
    public function min_number()
    {
        $number = 11;
        $this->assertEquals(MIN_NUMBER, $number);
    }

    /**
    * @test
    */
    public function max_number()
    {
        $number = 14;
        $this->assertEquals(MAX_NUMBER, $number);
    }


    /**
    * @test
    */
    public function int_number()
    {
        $number = 234;
        $this->assertEquals(INT_PREFIX, $number);
    }
}
