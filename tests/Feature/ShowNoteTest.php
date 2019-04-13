<?php

namespace Tests\Feature;

use App\Note;
use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowNoteTest extends TestCase
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

        $products = factory(Product::class, 3)->create([
            'note_id' => $note->id,
        ]);

        $response = $this->get('/api/note/' . $note->id);

        $response->assertStatus(200);
    }
}
