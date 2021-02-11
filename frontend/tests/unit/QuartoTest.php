<?php namespace frontend\tests;

use common\models\Quarto;

class QuartoTest extends \Codeception\Test\Unit
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
    public static function addQuarto()
    {
        $quarto = new Quarto();
        $quarto->id = 30;
        $quarto->disponibilidade = 1;
        $quarto->tamanho = 'grande';
        $quarto->tipo_cama = 'solteiro';
        $quarto->varanda = 0;
        $quarto->secretaria = 1;
        $quarto->armario = 1;
        $quarto->ac = 0;


        return $quarto;
    }

    public function testCamposQuarto(){
        $quarto = $this->addQuarto();
        $this->assertTrue($quarto->validate());
    }

    public function testAddQuarto(){
        $quarto = $this->addQuarto();
        $this->assertTrue($quarto->save());
        $this->tester->seeRecord(Quarto::class, ['id' => 30]);
    }

    public function testAddErroQuarto(){
        $quarto = new Quarto();
        $quarto->id = '';
        $quarto->disponibilidade = '';
        $quarto->tamanho = '';
        $quarto->tipo_cama = '';
        $quarto->varanda = '';
        $quarto->secretaria = '';
        $quarto->armario = '';
        $quarto->ac = '';

        $this->assertFalse($quarto->save());

        $this->tester->dontSeeRecord(Quarto::class, ['id' => '']);
    }

    public function testDeleteQuarto(){
        $quarto = $this->addQuarto();
        $quarto->save();
        $this->tester->seeRecord(Quarto::class, ['id' => 30]);
        $quarto->delete();
        $this->tester->dontSeeRecord(Quarto::class, ['id' => 30]);
    }

    public function testEditCasa()
    {
        $quarto = $this->addQuarto();
        $quarto->save();
        $quarto->disponibilidade = 0;
        $quarto->tamanho = 'medio';
        $quarto->tipo_cama = 'solteiro';
        $quarto->varanda = 1;
        $quarto->secretaria = 1;
        $quarto->armario = 1;
        $quarto->ac = 1;
        $quarto->save();
        $this->tester->seeRecord(Quarto::class, ['id' => 30, 'disponibilidade' => 0,
            'tamanho' => 'medio',
            'tipo_cama' => 'solteiro', 'varanda' => 1,
            'secretaria' => 1,'armario' => 1,
            'ac' => 1]);
    }

}