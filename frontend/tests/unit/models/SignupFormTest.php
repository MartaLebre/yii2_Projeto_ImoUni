<?php
namespace frontend\tests\unit\models;


use common\models\Casa;

class SignupFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testValidacaoCasa()
    {
        $casa = new Casa();

        //Despoletar todas as regras de validação

        //descrição
        $casa ->nome_rua = null;
        $this->assertFalse($casa->validate(['nome_rua']));

        $casa ->nome_rua= 'Rua das Flores';
        $this->assertTrue($casa->validate('nome_rua'));

    }
    public function testCriarCasa(){
        $casa = new Casa();

        $casa-> nome_rua = 'Rua das Flores';

        $casa->save();

        $this->tester->seeInDatabase('casa',['nome_rua'=>'Rua das Flores']);

    }
}
