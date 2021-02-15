<?php
namespace frontend\tests\acceptance;

use common\fixtures\AnuncioFixture;
use common\fixtures\CasaFixture;
use common\fixtures\CozinhaFixture;
use common\fixtures\PerfilFixture;
use common\fixtures\QuartoFixture;
use common\fixtures\SalaFixture;
use frontend\tests\AcceptanceTester;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;
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
            ],
            'anuncio' => [
                'class' => AnuncioFixture::className(),
                'dataFile' => codecept_data_dir() . 'anuncio_data.php'
            ],
            'casa' => [
                'class' => CasaFixture::className(),
                'dataFile' => codecept_data_dir() . 'casa_data.php'
            ],
            'cozinha' => [
                'class' => CozinhaFixture::className(),
                'dataFile' => codecept_data_dir() . 'cozinha_data.php'
            ],
            'quarto' => [
                'class' => QuartoFixture::className(),
                'dataFile' => codecept_data_dir() . 'quarto_data.php'
            ],
            'sala' => [
                'class' => SalaFixture::className(),
                'dataFile' => codecept_data_dir() . 'sala_data.php'
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
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
        $I->see('LOGOUT');
    }

    public function checkReserva(AcceptanceTester $I){
        $I->amOnPage('/site/login');
        $I->fillField('Nome de Utilizador', 'teste_estudante');
        $I->fillField('Password', 'Test1234');
        $I->click('login-button');

        $I->see('Pesquisar');
        $I->click('Pesquisar');

        $I->click('teste');
        $I->see('Características dos quartos');
        $I->see('Reservar');
        $I->click('Reservar');
        $I->see('Marcar reserva');
        $I->see('Por favor preencha os seguintes campos');
        $I->fillField('Data da entrada', '2021-02-12');
        $I->see('Marcar');
        $I->click('Marcar');
        $I->see('Reserva marcada com sucesso.');
    }

    public function checkHorario(AcceptanceTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Nome de Utilizador', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('login-button');

        $I->see('erau');
        $I->click('erau');
        $I->see('Detalhes da Conta');
        $I->click('Horários');
        $I->see('Horários');
        $I->click('Adicionar horário');
        $I->see('Adicionar horário');
        $I->fillField('Hora de começo', '18:05');
        $I->fillField('Hora de fim', '21:05');
        $I->selectOption('Horario[dia_semana]', 'Quarta');
        $I->click('Adicionar');
        $I->see('Horário registado com sucesso');
    }

}
