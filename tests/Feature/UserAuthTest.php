<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAuthTest extends BaseFeatureTests
{
    /**
     * User authenticated return success to access the 
     * home page.
     *
     * @return void
     */
    public function test_user_authenticated_return_success()
    {
        $user = User::factory()->create();
 
        $this->actingAs($user);
        
        $response = $this->get('/home');

        $response->assertStatus(200);
    }

    /**
     * User unauthenticated return error to access the 
     * home page.
     * 
     * @return void
     */
    public function test_access_unauthenticated_return_http_302()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }

}
