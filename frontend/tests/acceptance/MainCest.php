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

    public function checkLogin(AcceptanceTester $I){
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
        $I->see('LOGOUT');
    }

    public function checkAnuncio(AcceptanceTester $I){
        $I->amOnPage(Url::toRoute('/site/login'));
        $I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->wait(2);
        //$I->click('login-button');

        $I->see('Meus anúncios');
        $I->click('Meus anúncios');
        $I->see('Adicionar anúncio');
        $I->click('Adicionar anúncio');

        $I->amOnPage(Url::toRoute('/casa/create'));

        //Adicionar Propriedade
        $I->see('Adicionar propriedade');
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

        $I->amOnPage(Url::toRoute('/cozinha/create'));

        //Adicionar Cozinha
        $I->see('Adicionar cozinha');
        $I->see('Por favor preencha os seguintes campos');
        $I->see('Caracteristicas da cozinha');
        $I->selectOption('Cozinha[lava_loica]', 'Não');
        $I->selectOption('Cozinha[maquina_roupa]', 'Não');
        $I->selectOption('Cozinha[maquina_loica]', 'Sim');
        $I->selectOption('Cozinha[tostadeira]', 'Sim');
        $I->selectOption('Cozinha[torradeira]', 'Não');
        $I->selectOption('Cozinha[micro_ondas]', 'Sim');
        $I->selectOption('Cozinha[frigorifico]', 'Sem congelador');
        $I->selectOption('Cozinha[arca]', 'Não');
        $I->selectOption('Cozinha[fogao]', 'Gás');
        $I->selectOption('Cozinha[forno]', 'Sim');

        $I->see('Adicionar cozinha');
        $I->click('Adicionar cozinha');

        $I->amOnPage(Url::toRoute('/sala/create'));

        //Adicionar Sala
        $I->see('Adicionar sala');
        $I->see('Por favor preencha os seguintes campos');
        $I->see('Caracteristicas da sala');
        $I->selectOption('Sala[televisao]', 'Sim');
        $I->selectOption('Sala[sofa]', 'Sim');
        $I->selectOption('Sala[moveis]', 'Não');
        $I->selectOption('Sala[aquecimento]', 'Lareira');
        $I->selectOption('Sala[mesa]', 'Não');
        $I->selectOption('Sala[ac]', 'Não');

        $I->see('Adicionar sala');
        $I->click('Adicionar sala');

        $I->amOnPage(Url::toRoute('/quarto/create'));
        //Adicionar quarto
        $I->see('Adicionar quarto (1/1)');
        $I->see('Por favor preencha os seguintes campos');
        $I->see('Caracteristicas do quarto');
        $I->selectOption('Quarto[tamanho]', 'Pequeno');
        $I->selectOption('Quarto[tipo_cama]', 'Casal');
        $I->selectOption('Quarto[varanda]', 'Não');
        $I->selectOption('Quarto[secretaria]', 'Sim');
        $I->selectOption('Quarto[armario]', 'Não');
        $I->selectOption('Quarto[ac]', 'Não');

        $I->see('Adicionar quarto');
        $I->click('Adicionar quarto');

        $I->amOnPage(Url::toRoute('/anuncio/create'));
        //Adicionar anúncio
        $I->see('Adicionar anúncio');
        $I->see('Por favor preencha os seguintes campos');
        $I->fillField('Título', 'teste anúncio');
        $I->fillField('Preço', 170);
        $I->selectOption('Anuncio[despesas_inc]', 'Não');
        $I->fillField('Data de disponibilidade', '2021-03-12');
        $I->fillField('Descrição', 'teste descrição');
        $I->fillField('Número de telemóvel', '233455677');

        $I->see('Adicionar anúncio');
        $I->click('Adicionar anúncio');

        $I->amOnPage(Url::toRoute('/anuncio/index'));

        $I->see('Anúncio registado com sucesso.');


    }

    /*public function checkReserva(AcceptanceTester $I){
        $I->amOnPage('/site/login');
        $I->fillField('Nome de Utilizador', 'teste_estudante');
        $I->fillField('Password', 'Test1234');
        $I->click('login-button');

        $I->amOnPage(\Yii::$app->homeUrl);

        $I->see('Pesquisar');
        $I->click('Pesquisar');

        $I->click('Moradia em Leiria');
        $I->see('Características dos quartos');
        $I->see('Reservar');
        $I->click('Reservar');
        $I->see('Marcar reserva');
        $I->see('Por favor preencha os seguintes campos');
        $I->fillField('Data da entrada', '2021-02-12');
        $I->see('Marcar');
        $I->click('Marcar');
       // $I->see('Reserva marcada com sucesso.');
    }*/

    /*public function checkHorario(AcceptanceTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Nome de Utilizador', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('login-button');

        $I->see('Logout');
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
    }*/

}
