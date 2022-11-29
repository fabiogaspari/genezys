<?php

namespace App\Services\ZipCode\Contract;

use Illuminate\Http\Client\Response;

interface ZipCodeInterface
{

    /**
     * Generic call method to zipcode strategies.
     *
     * @param string $zipCode
     */
    public function call(string $zipCode): Response;

    /**
     * Generic treat method to zipcode strategies.
     *
     * @param array $data
     * @return mixed
     */
    public function treat(array $data): mixed;
}
