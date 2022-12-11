<?php

namespace App\Services\ZipCode;

use App\Services\ZipCode\Factory\ChooseZipCodeFactory;

class ZipCodeService
{
    /**
     * Call viacep service to retrive data about address.
     *
     * @param string $zipCode
     * @return string
     */
    public function getAddressByZipCode(string $zipCode): array
    {
        //here we can get data from others fonts, like databases (ex.:redis)
        $zipCodeMethod = config('app.zipcode_method');
        $choice = ChooseZipCodeFactory::choose($zipCodeMethod);

        $clazz = (new $choice());

        $response = $clazz->call($zipCode);

        $data = [
            'mainInfo' => $response,
            'zipCode' => $zipCode
        ];

        $treatedResponse = $clazz->treat($data);

        return $treatedResponse;
    }
}
