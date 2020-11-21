<?php

namespace Taghwo\PhoneNumber;

class Factory
{
    /**
     * @return array
     */
    protected $intPrefix = ['234'];

    /**
     * @return array
     */
    protected $standardPhoneNumberDigits = [MIN_NUMBER,MAX_NUMBER];
    
    /**
     * @return array
     */
    protected $localPrefix = ['070','080','090','081','091','071'];
}
