<?php

namespace App\Http\Controllers;

use App\Services\ZipCodeService;
use Illuminate\Http\Request;

class ZipCodeController extends Controller
{
    private ZipCodeService $service;

    public function __construct(ZipCodeService $service)
    {
        $this->service = $service;
    }

    /**
     * Call viacep service to retrive address data.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function get(string $zipCode)
    {
        return response()->json($this->service->getAddressByZipCode($zipCode));
    }
}
