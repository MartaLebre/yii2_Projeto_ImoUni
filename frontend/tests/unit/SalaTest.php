<?php namespace frontend\tests;

use common\models\Sala;

class SalaTest extends \Codeception\Test\Unit
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
    public static function addSala()
    {
        $sala = new Sala();
        $sala->id = 30;
        $sala->televisao = 1;
        $sala->sofa = 1;
        $sala->moveis = 1;
        $sala->mesa = 0;
        $sala->aquecimento = 'lareira';
        $sala->ac = 0;

        return $sala;
    }

    public function testCamposSala(){
        $quarto = $this->addSala();
        $this->assertTrue($quarto->validate());
    }

    public function testAddSala(){
        $quarto = $this->addSala();
        $this->assertTrue($quarto->save());
        $this->tester->seeRecord(Sala::class, ['id' => 30]);
    }

    public function testAddErroSala(){
        $sala = new Sala();
        $sala->id = '';
        $sala->televisao = '';
        $sala->sofa = '';
        $sala->moveis = '';
        $sala->mesa = '';
        $sala->aquecimento = '';
        $sala->ac = '';

        $this->assertFalse($sala->save());

        $this->tester->dontSeeRecord(Sala::class, ['id' => '']);
    }

    public function testDeleteSala(){
        $quarto = $this->addSala();
        $quarto->save();
        $this->tester->seeRecord(Sala::class, ['id' => 30]);
        $quarto->delete();
        $this->tester->dontSeeRecord(Sala::class, ['id' => 30]);
    }

    public function testEditSala()
    {
        $sala = $this->addSala();
        $sala->save();
        $sala->televisao = 0;
        $sala->sofa = 0;
        $sala->moveis = 0;
        $sala->mesa = 1;
        $sala->aquecimento = 'nao';
        $sala->ac = 1;
        $sala->save();
        $this->tester->seeRecord(Sala::class, ['id' => 30, 'televisao' => 0,
            'sofa' => 0,
            'moveis' => 0, 'mesa' => 1,
            'aquecimento' => 'nao','ac' => 1]);
    }

}