<?php namespace frontend\tests;

use Codeception\Test\Unit;
use common\models\Sala;

class SalaTest extends Unit
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
        $sala = new Sala();

        $sala->aquecimento = 'nao';
        $this->assertTrue($sala->validate(['aquecimento']));
    }

    public function testValidacaoParamentsIncorretos()
    {
        $sala = new Sala();

        $sala->aquecimento = null;
        $this->assertFalse($sala->validate(['aquecimento']));
    }

    public function testRegistoBD()
    {
        $sala = new Sala();
        $sala->aquecimento = 'nao';

        $sala->safeAttributes();
        $sala->save();

        $this->assertEquals('nao', $sala->aquecimento);


        $this->tester->seeRecord('common\models\Sala', [
            'aquecimento' => 'nao'
        ]);
    }
}