<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Address extends Model
{

    protected $table = 'adresses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'street',
        'cep',
        'neighborhood',
        'city',
        'state',
        'number',
        'user_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
