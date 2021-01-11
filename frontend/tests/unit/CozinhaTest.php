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

        $cozinha->fogao = 'eletrico';
        $this->assertTrue($cozinha->validate(['fogao']));
    }

    public function testValidacaoParamentsIncorretos()
    {
        $cozinha = new Cozinha();

        $cozinha->fogao = null;
        $this->assertFalse($cozinha->validate(['fogao']));
    }

    public function testRegistoBD()
    {
        $cozinha = new Cozinha();
        $cozinha->fogao = 'eletrico';

        $cozinha->safeAttributes();
        $cozinha->save();

        $this->assertEquals('eletrico', $cozinha->fogao);


        $this->tester->seeRecord('common\models\Cozinha', [
            'fogao' => 'eletrico'
        ]);
    }
}