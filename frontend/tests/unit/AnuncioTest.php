<?php namespace frontend\tests;

use common\models\Anuncio;
use Codeception\Test\Unit;

class AnuncioTest extends Unit
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
        $anuncio = new Anuncio();

        $anuncio->titulo = 'Moradia em Leiria';
        $this->assertTrue($anuncio->validate(['titulo']));
    }

    public function testValidacaoParamentsIncorretos()
    {
        $anuncio = new Anuncio();

        $anuncio->titulo = null;
        $this->assertFalse($anuncio->validate(['titulo']));
    }

    public function testRegistoBD()
    {
        $anuncio = new Anuncio();
        $anuncio->titulo = 'Moradia em Leiria';

        //$anuncio->safeAttributes();
        $anuncio->save();

        $this->assertEquals('Moradia em Leiria', $anuncio->titulo);


        $this->tester->seeRecord('common\models\Anuncio', [
            'titulo' => 'Moradia em Leiria'
        ]);
    }
}