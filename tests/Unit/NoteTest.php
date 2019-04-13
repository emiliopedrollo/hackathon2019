<?php

namespace Tests\Unit;

use App\Note;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function a_note_can_belong_to_a_user()
    {
        $user = factory(User::class)->create();

        $note = factory(Note::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals($note->user->id, $user->id);

        $this->assertEquals($user->notes()->first()->id, $note->id);
    }
}
