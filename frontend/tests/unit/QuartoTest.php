<?php namespace frontend\tests;

use Codeception\Test\Unit;
use common\models\Quarto;

class QuartoTest extends Unit
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
        $quarto = new Quarto();

        $quarto->tamanho = 'grande';
        $this->assertTrue($quarto->validate(['tamanho']));
    }

    public function testValidacaoParamentsIncorretos()
    {
        $quarto = new Quarto();

        $quarto->tamanho = null;
        $this->assertFalse($quarto->validate(['tamanho']));
    }

    public function testRegistoBD()
    {
        $quarto = new Quarto();
        $quarto->tamanho = 'grande';

        $quarto->safeAttributes();
        $quarto->save();

        $this->assertEquals('grande', $quarto->tamanho);


        $this->tester->seeRecord('common\models\Quarto', [
            'tamanho' => 'grande'
        ]);
    }
}