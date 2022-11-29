<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class UserAuthTest extends BaseUnitTests
{
    /**
     * Register user missing parameters throw QueryException exception.
     * 
     * @return void
     */
    public function test_register_missing_parameters_throw_exception()
    {
        $this->expectException(QueryException::class);

        $user = User::create([
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10)
        ]);

        $user->refresh();
    }
    
}
