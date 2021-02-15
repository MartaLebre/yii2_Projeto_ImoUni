<?php

namespace frontend\tests\functional;

use common\fixtures\PerfilFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;
use yii\helpers\Url;


class AnuncioProprietarioCest
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

        //Adicionar Propriedade
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

        //Adicionar Cozinha
        $I->see('Adicionar cozinha', 'h1');
        $I->see('Por favor preencha os seguintes campos');
        $I->see('Caracteristicas da cozinha');
        $I->selectOption('Cozinha[lava_loica]', 'Não');
        $I->selectOption('Cozinha[maquina_roupa]', 'Não');
        $I->selectOption('Cozinha[maquina_loica]', 'Sim');
        $I->selectOption('Cozinha[tostadeira]', 'Sim');
        $I->selectOption('Cozinha[torradeira]', 'Não');
        $I->selectOption('Cozinha[mircro_ondas]', 'Sim');
        $I->selectOption('Cozinha[frigorifico]', 'Sem congelador');
        $I->selectOption('Cozinha[arca]', 'Não');
        $I->selectOption('Cozinha[fogao]', 'Gás');
        $I->selectOption('Cozinha[forno]', 'Sim');

        $I->see('Adicionar cozinha');
        $I->click('Adicionar cozinha');

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

        //Adicionar quarto
        $I->see('Adicionar quarto (1/1)', 'h1');
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

        //Adicionar anúncio
        $I->see('Adicionar anúncio', 'h1');
        $I->see('Por favor preencha os seguintes campos');
        $I->fillField('Título', 'teste anúncio');
        $I->fillField('Preço', 170);
        $I->selectOption('Anuncio[despesas_inc]', 'Não');
        $I->fillField('Data de disponibilidade', '2021-03-12');
        $I->fillField('Descrição', 'teste descrição');
        $I->fillField('Número de telemóvel', '233455677');

        $I->see('Adicionar anúncio');
        $I->click('Adicionar anúncio');

        $I->see('Anúncio registado com sucesso.');
    }

    /*public function deleteAnuncio(FunctionalTester $I){
        $I->see('Meus anúncios');
        $I->click('Meus anúncios');

        $I->see('Apagar anúncio');
        $I->click('Apagar anúncio');
        $I->click('OK');
    }*/


    public function PropriedadeVazio(FunctionalTester $I){
        $I->see('Meus anúncios');
        $I->click('Meus anúncios');
        $I->see('Adicionar anúncio');
        $I->click('Adicionar anúncio');

        //Adicionar Propriedade
        $I->see('Adicionar propriedade');
        $I->see('Por favor preencha os seguintes campos');
        $I->see('Caracteristicas da propriedade');
        $I->fillField('Nome da rua', '');
        $I->selectOption('Casa[tipo_alojamento]', '');
        $I->selectOption('Casa[limpeza]', '');
        $I->fillField('Quartos', '');
        $I->fillField('Casas de banho', '');
        $I->selectOption('Casa[aquecimento_agua]', '');
        $I->selectOption('Casa[wifi]', '');
        $I->selectOption('Casa[area_exterior]', '');

        //$I->see('Adicionar propriedade');
        $I->click('Adicionar propriedade');

        $I->seeValidationError('Introduza um endereço.');
        $I->seeValidationError('Escolha uma das opções.');
        $I->seeValidationError('Escolha uma das opções.');
        $I->seeValidationError('Introduza um valor.');
        $I->seeValidationError('Introduza um valor.');
        $I->seeValidationError('Escolha uma das opções.');
        $I->seeValidationError('Escolha uma das opções.');
        $I->seeValidationError('Escolha uma das opções.');
        $I->seeValidationError('Escolha uma das opções.');
        $I->seeValidationError('Escolha uma das opções.');
        $I->seeValidationError('Escolha uma das opções.');
    }
}