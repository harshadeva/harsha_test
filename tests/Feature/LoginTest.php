<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LoginTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        User::factory(1)->create();
        $user = User::latest()->first();
        $response = $this->postJson(route('login'), [
            'email' => $user['email'],
            'password' => '12345678'
        ]);

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has('token')
                    ->etc()
            );
    }
}
