<?php

namespace Tests\Feature;

use App\Note;
use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function discount_can_be_redeemed()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'identification_token' => 'TOKEN_DE_IDENTIFICACAO',
            'cashback_available' => 50,
        ]);

        $response = $this->post('/api/discount',[
            'user_id' => 'TOKEN_DE_IDENTIFICACAO',
            'data' => [
                'discount_value' => 30,
            ]
        ]);

        $response->assertStatus(200);

        $user->refresh();

        self::assertEquals(20, $user->cashback_available);

        self::assertCount(1, $user->discounts()->get());

        self::assertEquals(30, $user->discounts()->first()->value);
    }

    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function discount_cant_be_redeem_if_over_user_limit()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'identification_token' => 'TOKEN_DE_IDENTIFICACAO',
            'cashback_available' => 20,
        ]);

        $response = $this->post('/api/discount',[
            'user_id' => 'TOKEN_DE_IDENTIFICACAO',
            'data' => [
                'discount_value' => 30,
            ]
        ]);

        $response->assertStatus(500);

        $user->refresh();

        self::assertEquals(20, $user->cashback_available);

        self::assertCount(0, $user->discounts()->get());
    }
}
