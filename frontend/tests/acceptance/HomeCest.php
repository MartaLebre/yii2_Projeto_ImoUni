<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use common\fixtures\UserFixture;
use yii\helpers\Url;

class MainCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
        ];
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('ImoUni');
        $I->see('Encontre a sua propriedade hoje!');
    }


    public function  checkLogin(AcceptanceTester $I){
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->see('Logout');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
