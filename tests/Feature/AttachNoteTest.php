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
        /** @var User $user */
        $user = factory(User::class)->create([
            'identification_token' => 'TOKEN_DE_IDENTIFICACAO',
        ]);

        $note = factory(Note::class)->create([
            'note_identifier' => 838383477,
            'total_value' => 10,
            'discount_value' => 5,
        ]);

        $response = $this->post('/api/note', [
            'user_id' => $user->identification_token,
            'data' => [
                'note_identifier' => $note->note_identifier,
            ],
        ]);

        $response->assertStatus(200);

        $note->refresh();

        $this->assertEquals($user->id, $note->user_id);

        $user->refresh();

        $this->assertEquals($note->discount_value, $user->cashback_available);
    }

    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function a_user_cant_attach_a_note_that_is_already_attached()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'identification_token' => 'TOKEN_DE_IDENTIFICACAO',
        ]);

        $note = factory(Note::class)->create([
            'user_id' => factory(User::class)->create()->id,
            'note_identifier' => 838383477,
            'total_value' => 10,
            'discount_value' => 5,
        ]);

        $response = $this->post('/api/note', [
            'user_id' => $user->identification_token,
            'data' => [
                'note_identifier' => $note->note_identifier,
            ],
        ]);

        $response->assertStatus(500);

        $note->refresh();

        $this->assertNotEquals($user->id, $note->user_id);

        $user->refresh();

        $this->assertNotEquals($note->discount_value, $user->cashback_available);
    }

    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function a_non_user_cannot_do_stuff()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'identification_token' => 'TOKEN_DE_IDENTIFICACAO',
        ]);

        $note = factory(Note::class)->create([
            'user_id' => factory(User::class)->create()->id,
            'note_identifier' => 838383477,
            'total_value' => 10,
            'discount_value' => 5,
        ]);

        $response = $this->post('/api/note', [
            'user_id' => 'NOT A TOKEN',
            'data' => [
                'note_identifier' => $note->note_identifier,
            ],
        ]);

        // user not found
        $response->assertStatus(404);
    }
}
