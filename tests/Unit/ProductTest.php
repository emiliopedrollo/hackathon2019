<?php

namespace Tests\Unit;

use App\Note;
use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @test
     */
    public function a_note_can_belong_to_a_user()
    {
        $note = factory(Note::class)->create();

        $product = factory(Product::class)->create([
            'note_id' => $note->id
        ]);

        $this->assertEquals($note->products()->first()->id, $product->id);

        $this->assertEquals($product->note->id, $note->id);
    }

    /** @test */
    public function a_product_price_is_stored_as_int() {
        $product = factory(Product::class)->create([
            'price' => 10.45
        ]);

        self::assertEquals(10.45, $product->price);

        self::assertEquals(1045, $product->getAttributes()['price']);
    }
}
