<?php

namespace App\Services\ZipCode\Strategy;

use App\Services\ZipCode\Contract\ZipCodeInterface;
use App\Util\StateUtil;
use App\Util\StrUtil;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ZipCodeStrategy implements ZipCodeInterface
{
    const URL_ZIPCODE_BASE_SEARCH = 'https://app.zipcodebase.com/api/v1/search?';
    const CONTENT_TYPE = 'application/json';
    const API_KEY = '799fcb40-6f54-11ed-a1a9-71b04d9cc629';
    
    /**
     * Call zipcode strategy url.
     *
     * @param string $zipCode
     * @return Response
     */
    public function call(string $zipCode): Response
    {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "apikey" => "799fcb40-6f54-11ed-a1a9-71b04d9cc629", 
        ])->get(self::URL_ZIPCODE_BASE_SEARCH, [
            'codes' => $zipCode
        ]);
        
        return $response;
    }

    /**
     * Treat zipcode strategy return.
     *
     * @param array $data
     * @return mixed
     */
    public function treat(array $data): mixed
    {
        $mainInfo = $data['mainInfo'];
        $zipCode = $data['zipCode'];
        $result = $mainInfo->json();

        $treatData = data_get($result, 'results.'.$zipCode.'.0');

        $state = data_get($treatData, 'state_en');
        $stateWithoutAccents = StrUtil::replaceAccents($state);
        
        $stateAcronym = StateUtil::stateBRAcronym($stateWithoutAccents);

        $data = [
            'logradouro' => data_get($treatData, ''),
            'bairro' => data_get($treatData, 'city'),
            'uf' => $stateAcronym,
            'localidade' => data_get($treatData, 'city_en'),
        ];

        return $data;
    }
}
