<?php
namespace frontend\tests\acceptance;

use common\models\User;
use frontend\tests\AcceptanceTester;
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

    public function checkSignUp(AcceptanceTester $I){
        $I->amOnPage(Url::toRoute('/site/signup'));
        $I->submitForm($this->formSignupId, [
            'SignupForm[primeiro_nome]' => 'teste',
            'SignupForm[ultimo_nome]' => 'testee',
            'SignupForm[username]' => 'teste123',
            'SignupForm[email]' => 'teste123@mail.com',
            'SignupForm[password]' => '123456',
            'SignupForm[numero_telemovel]' => '900988977',
            'SignupForm[genero]' => 'Masculino',
            'SignupForm[data_nascimento]' => '2020-11-02',
            'SignupForm[tipo]' => 'Proprietario'
        ]);

        $I->see('Registo efetuado com sucesso.');
    }

    public function  checkLogin(AcceptanceTester $I){
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->see('Logout');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }


}
