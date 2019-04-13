<?php

namespace Tests\Feature;

use App\Note;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttachNoteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function a_user_can_attach_a_note_to_itself()
    {
        $user = factory(User::class)->create([
            'identification_token' => 'TOKEN_DE_IDENTIFICACAO',
        ]);

        $note = factory(Note::class)->create([
            'total_value' => 10,
            'discount_value' => 1,
        ]);

        $response = $this->post('/note/attach', [
            'user_id' => $user->identification_token,
            'data' => [
                'note_identifier' => $note->note_identifier,
            ],
        ]);

        $response->assertStatus(201);
    }
}
