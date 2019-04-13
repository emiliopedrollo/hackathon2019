<?php

namespace Tests\Feature;

use App\Discount;
use App\Note;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function a_user_can_be_created()
    {
        $response = $this->post('/api/user', [
            'data' => [
                'identification_token' => 'TOKEN_DO_USUARIO'
            ],
        ]);

        $response->assertStatus(201);

        $this->assertEquals('TOKEN_DO_USUARIO', $user = User::first()->identification_token);
    }
}
