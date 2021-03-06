<?php

namespace frontend\tests\functional;

use common\fixtures\PerfilFixture;
use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
            'perfil' => [
                'class' => PerfilFixture::className(),
                'dataFile' => codecept_data_dir() . 'perfil_data.php'
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkLoginVazio(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Introduza um nome de utilizador.');
        $I->seeValidationError('Introduza uma password.');
    }

    public function checkLoginPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
        $I->seeValidationError('Username ou password incorretos.');
    }


    public function checkLoginValido(FunctionalTester $I)
    {
        //$I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        //$I->see('Logout (erau)', 'form button[type=submit]');
        $I->fillField('Nome de Utilizador', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('login-button');
        $I->see('Meus anúncios');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
