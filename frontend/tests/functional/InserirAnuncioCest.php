<?php

namespace frontend\tests\functional;

use common\fixtures\HorarioFixture;
use common\fixtures\PerfilFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;


class InserirAnuncioCest
{


    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
            'perfil' => [
                'class' => PerfilFixture::className(),
                'dataFile' => codecept_data_dir() . 'perfil_data.php'
            ],
            'horario' => [
                'class' => HorarioFixture::className(),
                'dataFile' => codecept_data_dir() . 'horario_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Nome de Utilizador', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('login-button');

        $I->amOnPage(\Yii::$app->homeUrl);
    }

    public function InserirAnuncio(FunctionalTester $I)
    {
        $I->see('Meus anúncios');
        $I->click('Meus anúncios');
        $I->see('Adicionar anúncio');
        $I->click('Adicionar anúncio');
        $I->see('Adicionar propriedade', 'h1');
        $I->see('Por favor preencha os seguintes campos');
        $I->see('Caracteristicas da propriedade');
        $I->fillField('Nome da rua', 'teste');
        $I->selectOption('Casa[tipo_alojamento]', 'Moradia');
        $I->selectOption('Casa[limpeza]', 'Mensal');
        $I->fillField('Quartos', '1');
        $I->fillField('Casas de banho', '1');
        $I->selectOption('Casa[aquecimento_agua]', 'Esquentador');
        $I->selectOption('Casa[wifi]', 'Sim');
        $I->selectOption('Casa[area_exterior]', 'Sim');

        $I->see('Regras');
        $I->selectOption('Casa[animais]', 'Não');
        $I->selectOption('Casa[fumar]', 'Não');
        $I->selectOption('Casa[visitantes_pernoitar]', 'Não');

        $I->see('Adicionar propriedade');
        $I->click('Adicionar propriedade');
    }


}