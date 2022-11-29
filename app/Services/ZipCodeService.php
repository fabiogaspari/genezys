<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ZipCodeService
{
    const URL_ZIPCODE_BASE_SEARCH = 'viacep.com.br/ws/';
    const ZIPCODE_FORMAT = '/json/';

    /**
     * Call viacep service to retrive data about address.
     *
     * @param string $zipCode
     * @return string
     */
    public function getAddressByZipCode(string $zipCode): object|null
    {
        $response = Http::get(
            self::URL_ZIPCODE_BASE_SEARCH
            .$zipCode
            .self::ZIPCODE_FORMAT
        );

        if ( !$response->object() ) {
            return null;
        }
        return $response->object();
    }
}
