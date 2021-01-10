<?php namespace frontend\tests;

use common\models\Cozinha;
use Codeception\Test\Unit;

class CozinhaTest extends Unit
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
        $cozinha = new Cozinha();

        $cozinha->id_casa = '7';
        $this->assertTrue($cozinha->validate(['id_casa']));
    }

    public function testValidacaoParamentsIncorretos()
    {
        $cozinha = new Cozinha();

        $cozinha->id_casa = null;
        $this->assertFalse($cozinha->validate(['id_casa']));
    }

    public function testRegistoBD()
    {
        $cozinha = new Cozinha();
        $cozinha->id_casa = '7';

        $cozinha->safeAttributes();
        $cozinha->save();

        $this->assertEquals('7', $cozinha->id_casa);


        $this->tester->seeRecord('common\models\Cozinha', [
            'id_casa' => '7'
        ]);
    }
}