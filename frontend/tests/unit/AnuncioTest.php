<?php namespace frontend\tests;

use common\models\Anuncio;

class AnuncioTest extends \Codeception\Test\Unit
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
    public static function addAnuncio()
    {
        $anuncio = new Anuncio();
        $anuncio->id = "30";
        $anuncio->titulo = "test";
        $anuncio->preco = "200";
        $anuncio->data_criacao = "2020-01-03";
        $anuncio->data_disponibilidade = "2021-03-02";
        $anuncio->despesas_inc = "0";
        $anuncio->descricao = "teste";
        $anuncio->numero_telemovel = "953214678";

        return $anuncio;
    }

    public function testCamposAnuncio(){
        $anuncio = $this->addAnuncio();
        $this->assertTrue($anuncio->validate());
    }

    public function testAddAnuncio(){
        $anuncio = $this->addAnuncio();
        $this->assertTrue($anuncio->save());
        $this->tester->seeRecord(Anuncio::class, ['id' => '30']);
    }

    public function testAddErroAnuncio(){
        $anuncio = new Anuncio();
        $anuncio->id = 'id';
        $anuncio->titulo = "test";
        $anuncio->preco = 'aaaaaaaaaaaa';
        $anuncio->data_criacao = "2020-01-03";
        $anuncio->data_disponibilidade = "2021-03-02";
        $anuncio->despesas_inc = "0";
        $anuncio->descricao = "teste";
        $anuncio->numero_telemovel = "ola";

        $this->assertFalse($anuncio->save());
        $this->tester->dontSeeRecord(Anuncio::class, ['id' => 'id']);
    }

    public function testDeleteAnuncio(){
        $anuncio = $this->addAnuncio();
        $anuncio->save();
        $this->tester->seeRecord(Anuncio::class, ['id' => '30']);
        $anuncio->delete();
        $this->tester->dontSeeRecord(Anuncio::class, ['id' => '30']);
    }

    public function testEditAnuncio()
    {
        $anuncio = $this->addAnuncio();
        $anuncio->save();
        $anuncio->titulo = "teste";
        $anuncio->preco = "300";
        $anuncio->data_criacao = "2021-01-03";
        $anuncio->data_disponibilidade = "2022-03-02";
        $anuncio->despesas_inc = "1";
        $anuncio->descricao = "testeeeeee";
        $anuncio->numero_telemovel = "953214672";
        $anuncio->save();
        $this->tester->seeRecord(Anuncio::class, ['id' => '30', 'titulo' => 'teste', 'preco' => '300', 'data_criacao' => '2021-01-03', 'data_disponibilidade' => '2022-03-02', 'despesas_inc' => '1', 'descricao' => 'testeeeeee', 'numero_telemovel'=> '953214672']);
    }
}