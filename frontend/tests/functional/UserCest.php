<?php

namespace frontend\tests\functional;

use common\fixtures\PerfilFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;


class UserCest
{


    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
            'profile' => [
                'class' => PerfilFixture::className(),
                'dataFile' => codecept_data_dir() . 'perfil_data.php'
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

    public function atualizarDadosUser(FunctionalTester $I)
    {
        $I->see('erau');
        $I->click('erau');
        $I->see('Informações da Conta');
        $I->click('Alterar dados');
        $I->see('Atualizar dados da conta');
        $I->fillField('Password', 'password_0');
        $I->fillField('Número de telemovel', '123456789');
        $I->click('Guardar');
        $I->see('Update efetuado com sucesso');

    }
}