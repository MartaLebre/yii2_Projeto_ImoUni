<?php
namespace backend\tests\acceptance;


use common\fixtures\PerfilFixture;
use backend\tests\AcceptanceTester;
use common\fixtures\UserFixture;

use yii\helpers\Url;

class MainCest
{
    protected $formSignupId = '#form-signup';

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
            ]
        ];
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function  checkLogin(AcceptanceTester $I){
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->submitForm('#login-form', $this->formParams('admin', 'admin123'));
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
        $I->see('Estatísticas');
    }

}
