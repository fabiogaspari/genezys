<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    /**
     * Call viacep service to retrive address data.
     *
     * @return 
     */
    public function list()
    {
        return $this->service->list();
    }
}
