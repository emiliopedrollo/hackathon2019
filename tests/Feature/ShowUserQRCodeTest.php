<?php

namespace Tests\Feature;

use App\Note;
use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowUserQRCodeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function a_note_can_be_visualized()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'identification_token' => 'TOKEN_DE_IDENTIFICACAO',
        ]);

        $response = $this->get('/api/whoami?user_id=' . $user->identification_token);

        $response->assertStatus(200);
    }
}
