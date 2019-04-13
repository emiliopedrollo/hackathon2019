<?php


namespace Tests\Unit;


use Tests\TestCase;

class HelperTest extends TestCase
{

    public function testCpf() {
        $this->assertEquals('36269161894',cpf('362691618'));
        $this->assertEquals('472.352.473-80',cpf('472352473',true));
    }

}