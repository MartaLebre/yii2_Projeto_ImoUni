<?php namespace frontend\tests\functional;
use common\fixtures\AnuncioFixture;
use common\fixtures\CasaFixture;
use common\fixtures\CozinhaFixture;
use common\fixtures\PerfilFixture;
use common\fixtures\QuartoFixture;
use common\fixtures\SalaFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class ReservaCest
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

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Nome de Utilizador', 'estudante_teste');
        $I->fillField('Password', '123456');
        $I->click('login-button');

        $I->amOnPage(\Yii::$app->homeUrl);
    }

    // tests
    public function marcarReserva(FunctionalTester $I)
    {
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

    public function marcarReservaErro(FunctionalTester $I)
    {
        $I->see('Pesquisar');
        $I->click('Pesquisar');

        $I->click('teste');
        $I->see('Características dos quartos');
        $I->see('Reservar');
        $I->click('Reservar');
        $I->see('Marcar reserva');
        $I->see('Por favor preencha os seguintes campos');
        $I->fillField('Data da entrada', '2020-02-12');
        $I->see('Marcar');
        $I->click('Marcar');
        $I->see('Reserva não efetuada, disponivel a partir de 2021-01-12.');
    }

    public function marcarReservaVazio(FunctionalTester $I)
    {
        $I->see('Pesquisar');
        $I->click('Pesquisar');

        $I->click('teste');
        $I->see('Características dos quartos');
        $I->see('Reservar');
        $I->click('Reservar');
        $I->see('Marcar reserva');
        $I->see('Por favor preencha os seguintes campos');
        $I->fillField('Data da entrada', '');
        $I->see('Marcar');
        $I->click('Marcar');
        $I->seeValidationError('Introduza a sua data de entrada.');
    }
}
