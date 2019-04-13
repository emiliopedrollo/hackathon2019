<?php

namespace Tests\Feature;

use App\Discount;
use App\Note;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function a_user_can_get_his_freaking_info_yay()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'identification_token' => 'TOKEN_DE_IDENTIFICACAO',
            'cashback_available' => 58.32
        ]);

        $notes = factory(Note::class, 3)->create([
            'user_id' => $user->id,
        ]);

        $discounts = factory(Discount::class)->create([
            'user_id' => $user->id,
            'value' => $notes->sum('discount_value') / 3,
        ]);

        $response = $this->get('/api/home?user_id=TOKEN_DE_IDENTIFICACAO');

        $response->assertStatus(200);
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
