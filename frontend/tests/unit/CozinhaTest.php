<?php namespace frontend\tests;

use common\models\Cozinha;

class CozinhaTest extends \Codeception\Test\Unit
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
    public static function addCozinha()
    {
        $cozinha = new Cozinha();
        $cozinha->id = '40';
        //$cozinha->id_casa = '30';
        $cozinha->lava_loica = '1';
        $cozinha->maquina_roupa = '0';
        $cozinha->maquina_loica = '0';
        $cozinha->tostadeira = '1';
        $cozinha->torradeira = '1';
        $cozinha->micro_ondas = '0';
        $cozinha->frigorifico = 'sem congelador';
        $cozinha->arca = '0';
        $cozinha->fogao = 'gas';
        $cozinha->forno = '1';

        return $cozinha;
    }

    public function testCamposCozinha(){
        $cozinha = $this->addCozinha();
        $this->assertTrue($cozinha->validate());
    }

    public function testAddCozinha(){
        $cozinha = $this->addCozinha();
        $this->assertTrue($cozinha->save());
        $this->tester->seeRecord(Cozinha::class, ['id' => '40']);
    }

    public function testAddErroCozinha(){

        $cozinha = new Cozinha();
        $cozinha->id = '';
        //$cozinha->id_casa = 'ola';
        $cozinha->lava_loica = '';
        $cozinha->maquina_roupa = '';
        $cozinha->maquina_loica = '';
        $cozinha->tostadeira = '';
        $cozinha->torradeira = '';
        $cozinha->micro_ondas = '';
        $cozinha->frigorifico = '';
        $cozinha->arca = '';
        $cozinha->fogao = '';
        $cozinha->forno = '';

        $this->assertFalse($cozinha->save());

        $this->tester->dontSeeRecord(Cozinha::class, ['id' => '']);
    }

    public function testDeleteCozinha(){
        $cozinha = $this->addCozinha();
        $cozinha->save();
        $this->tester->seeRecord(Cozinha::class, ['id' => '40']);
        $cozinha->delete();
        $this->tester->dontSeeRecord(Cozinha::class, ['id' => '40']);
    }

    public function testEditCozinha()
    {
        $cozinha = new Cozinha();
        $cozinha->save();
        $cozinha->id = '40';
        //$cozinha->id_casa = '30';
        $cozinha->lava_loica = '0';
        $cozinha->maquina_roupa ='1';
        $cozinha->maquina_loica = '1';
        $cozinha->tostadeira = '0';
        $cozinha->torradeira = '0';
        $cozinha->micro_ondas = '1';
        $cozinha->frigorifico = 'com congelador';
        $cozinha->arca = '0';
        $cozinha->fogao = 'eletrico';
        $cozinha->forno = '0';
        $cozinha->save();
        $this->tester->seeRecord(Cozinha::class, ['id' => '40', 'lava_loica' => '0',
            'maquina_roupa' => '1',
            'maquina_loica' => '1', 'tostadeira' => '0',
            'torradeira' => '0','mircro_ondas' => '1',
            'frigorifico' => 'com congelador','arca' => '0',
            'fogao' => 'eletrico','forno' => '0']);
    }
}