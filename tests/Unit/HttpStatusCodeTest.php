<?php

namespace Tests\Unit;

use App\Facades\HttpStatusCode;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HttpStatusCodeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @test
     */
    public function it_returns_the_expected_message()
    {
        $this->assertEquals('ok', HttpStatusCode::getMessageCode(200));
    }

    /** @test */
    public function it_will_return_unknown_error_when_asking_for_code_not_covered() {
        $this->assertEquals("unknown_error", HttpStatusCode::getMessageCode(102));
    }

    /** @test */
    public function it_can_return_a_translation() {
        $this->assertEquals(__('messages.errors.not_acceptable'), HttpStatusCode::getText(406));
    }
}
