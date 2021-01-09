<?php namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\models\LoginForm;
use common\models\User;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function FazerLogin(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'antonio_augusto',
            'LoginForm[password]' => '123456',
        ], 'login-button');

        $I->dontSee('Login');
        $I->see('Logout');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
