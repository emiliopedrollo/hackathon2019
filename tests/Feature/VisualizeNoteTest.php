<?php

namespace Tests\Feature;

use App\Note;
use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisualizeNoteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function a_note_can_be_visualized()
    {
        $note = factory(Note::class)->create([
            'note_identifier' => 838383477,
            'total_value' => 10,
            'discount_value' => 5,
        ]);

        $response = $this->get('/nota/');

        $response->assertStatus(200);
    }
}
