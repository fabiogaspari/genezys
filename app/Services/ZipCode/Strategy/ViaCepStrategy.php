<?php

namespace App\Services\ZipCode\Strategy;

use App\Services\ZipCode\Contract\ZipCodeInterface;
use App\Util\StateUtil;
use App\Util\StrUtil;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ViaCepStrategy implements ZipCodeInterface
{
    const URL_ZIPCODE_BASE_SEARCH = 'viacep.com.br/ws/';
    const ZIPCODE_FORMAT = '/json/';

    /**
     * Call viacep strategy url.
     *
     * @param string $zipCode
     * @return Response
     */
    public function call(string $zipCode): Response
    {
        $response = Http::get(
            self::URL_ZIPCODE_BASE_SEARCH
            .$zipCode
            .self::ZIPCODE_FORMAT
        );

        return $response;
    }

    /**
     * Treat viacep strategy return.
     *
     * @param array $data
     * @return mixed
     */
    public function treat(array $data): mixed
    {
        $mainInfo = $data['mainInfo'];

        return $mainInfo->json();
    }

}
