<?php namespace frontend\tests;

use common\models\Casa;

class CasasTest extends \Codeception\Test\Unit
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
    public static function addCasa()
    {
        $casa = new Casa();
        $casa->id = 40;
        $casa->nome_rua = "test";
        $casa->tipo_alojamento = "Apartamento";
        $casa->wifi = 0;
        $casa->limpeza = "Quinzenal";
        $casa->num_quartos = 3;
        $casa->num_wcs = 2;
        $casa->aquecimento_agua = "Esquentador";
        $casa->area_exterior = 0;
        $casa->animais = 0;
        $casa->fumar = 1;
        $casa->visitantes_pernoitar = 1;

        return $casa;
    }

    public function testCamposCasa(){
        $casa = $this->addCasa();
        $this->assertTrue($casa->validate());
    }

    public function testAddCasa(){
        $casa = $this->addCasa();
        $this->assertTrue($casa->save());
        $this->tester->seeRecord(Casa::class, ['id' => 40]);
    }

    public function testAddErroCasa(){
        $casa = new Casa();
        $casa->id = "ola";
        $casa->nome_rua = 1;
        $casa->tipo_alojamento = "Apartamento";
        $casa->wifi = 0;
        $casa->limpeza= "Quinzenal";
        $casa->num_quartos = 3;
        $casa->num_wcs = 2;
        $casa->aquecimento_agua = "Esquentador";
        $casa->area_exterior = 0;
        $casa->animais = 0;
        $casa->fumar = 1;
        $casa->visitantes_pernoitar = 1;

        $this->assertFalse($casa->save());

        $this->tester->dontSeeRecord(Casa::class, ['id' => 'ola']);
    }

    public function testDeletecasa(){
        $casa = $this->addCasa();
        $casa->save();
        $this->tester->seeRecord(Casa::class, ['id' => 40]);
        $casa->delete();
        $this->tester->dontSeeRecord(Casa::class, ['id' => 40]);
    }

    public function testEditCasa()
    {
        $casa = $this->addCasa();
        $casa->save();
        $casa->nome_rua = "benfica";
        $casa->tipo_alojamento = "Apartamento";
        $casa->wifi = 0;
        $casa->limpeza= "Quinzenal";
        $casa->num_quartos = 3;
        $casa->num_wcs = 2;
        $casa->aquecimento_agua = "Esquentador";
        $casa->area_exterior = 0;
        $casa->animais = 0;
        $casa->fumar = 1;
        $casa->visitantes_pernoitar = 1;
        $casa->save();
        $this->tester->seeRecord(Casa::class, ['id' => 40, 'nome_rua' => 'benfica',
            'tipo_alojamento' => 'Apartamento',
            'wifi' => 0, 'limpeza' => 'Quinzenal',
            'num_quartos' => 3,'num_wcs' => 2,
            'aquecimento_agua' => 'Esquentador','area_exterior' => 0,
            'animais' => 0,'fumar' => 1,'visitantes_pernoitar' => 1]);
    }

}