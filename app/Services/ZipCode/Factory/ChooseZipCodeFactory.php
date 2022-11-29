<?php

namespace App\Services\ZipCode\Factory;

use App\Services\ZipCode\Strategy\ViaCepStrategy;
use App\Services\ZipCode\Strategy\ZipCodeStrategy;

class ChooseZipCodeFactory
{

    /**
     * Choose the zipcode class.
     *
     * @param string $zipCode
     * @return string
     */
    public static function choose(string $type): string
    {
        switch( $type ) {
            case 'viacep':
                return ViaCepStrategy::class;
            case 'zipcode':
                return ZipCodeStrategy::class;
            default: 
                return ViaCepStrategy::class;
        }
    }
}
