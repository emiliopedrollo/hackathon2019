<?php


namespace Tests\Unit;


use Tests\TestCase;

class HelperTest extends TestCase
{

    public function testItCanCalculateCPFValidatorDigit() {
        $this->assertEquals('36269162009',cpf('362691620'));
        $this->assertEquals('472.352.473-80',cpf('472352473',true));
    }

    public function testItCanGenerateRandomCPF() {
        $cpf = cpf();
        $this->assertEquals($cpf,cpf(substr($cpf,0,9)));
    }

}