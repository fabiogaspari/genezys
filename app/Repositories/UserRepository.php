<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class UserRepository
{
    /**
     * Return all users from the database.
     */
    public function list()
    {
        $users = User::with('adresses')->paginate(10);
        
        return $users;
    }
}
