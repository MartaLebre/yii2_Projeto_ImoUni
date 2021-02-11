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
        $cozinha->id_casa = '30';
        $cozinha->lava_loica = '1';
        $cozinha->maquina_roupa = '0';
        $cozinha->maquina_loica = '0';
        $cozinha->tostadeira = '1';
        $cozinha->torradeira = '1';
        $cozinha->mircro_ondas = '0';
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
        $cozinha->id = 'ola';
        $cozinha->id_casa = 'ola';
        $cozinha->lava_loica = '2';
        $cozinha->maquina_roupa = '3';
        $cozinha->maquina_loica = '2';
        $cozinha->tostadeira = '3';
        $cozinha->torradeira = '3';
        $cozinha->mircro_ondas = '3';
        $cozinha->frigorifico = 'sem congelador';
        $cozinha->arca = '2';
        $cozinha->fogao = 'gas';
        $cozinha->forno = '8';

        $this->assertFalse($cozinha->save());

        $this->tester->dontSeeRecord(Cozinha::class, ['id' => 'ola']);
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
        $cozinha->id_casa = '30';
        $cozinha->lava_loica = '0';
        $cozinha->maquina_roupa ='1';
        $cozinha->maquina_loica = '1';
        $cozinha->tostadeira = '0';
        $cozinha->torradeira = '0';
        $cozinha->mircro_ondas = '1';
        $cozinha->frigorifico = 'com congelador';
        $cozinha->arca = '0';
        $cozinha->fogao = 'eletrico';
        $cozinha->forno = '0';
        $cozinha->save();
        $this->tester->seeRecord(Cozinha::class, ['id' => '40', 'id_casa' => '30','lava_loica' => '0',
            'maquina_roupa' => '1',
            'maquina_loica' => '1', 'tostadeira' => '0',
            'torradeira' => '0','mircro_ondas' => '1',
            'frigorifico' => 'com congelador','arca' => '0',
            'fogao' => 'eletrico','forno' => '0']);
    }
}