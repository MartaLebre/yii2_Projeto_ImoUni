<?php namespace frontend\tests;

use common\models\Casa;
use Codeception\Test\Unit;

class CasaTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;


    protected function _before()
    {
    }

    protected function _after()
    {
    }


    // tests
    public function testValidacaoParamentsCorretos()
    {
        $casa = new Casa();
        $casa->nome_rua = 'Rua das Flores';
        $this->assertTrue($casa->validate(['nome_rua']));
    }
    public function testValidacaoParamentsIncorretos()
    {
        $casa = new Casa();
        $casa->nome_rua = null;
        $this->assertFalse($casa->validate(['nome_rua']));
    }

    public function testRegistoBD()
    {
        $casa = new Casa();
        $casa->nome_rua = 'Rua das Flores';

        $casa->safeAttributes();
        $casa->save();

        $this->assertEquals('Rua das Flores', $casa->nome_rua);


        $this->tester->seeRecord('common\models\Casa', [
            'nome_rua' => 'Rua das Flores'
        ]);

    }
}