<?php

namespace frontend\tests\functional;

use common\fixtures\HorarioFixture;
use common\fixtures\PerfilFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;


class HorarioProprietarioCest
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
            'horario' => [
                'class' => HorarioFixture::className(),
                'dataFile' => codecept_data_dir() . 'horario_data.php'
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

    public function InserirHorario(FunctionalTester $I)
    {
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

    public function InserirHorarioVazio(FunctionalTester $I)
    {
        $I->see('erau');
        $I->click('erau');
        $I->see('Detalhes da Conta');
        $I->click('Horários');
        $I->see('Horários');
        $I->click('Adicionar horário');
        $I->see('Adicionar horário');
        $I->fillField('Hora de começo', '');
        $I->fillField('Hora de fim', '');
        $I->selectOption('Horario[dia_semana]', '');
        $I->click('Adicionar');
        $I->seeValidationError('Introduza a hora.');
        $I->seeValidationError('Introduza a hora.');
        $I->seeValidationError('Introduza o dia da semana.');
    }

    public function InserirHorarioErro(FunctionalTester $I)
    {
        $I->see('erau');
        $I->click('erau');
        $I->see('Detalhes da Conta');
        $I->click('Horários');
        $I->see('Horários');
        $I->click('Adicionar horário');
        $I->see('Adicionar horário');
        $I->fillField('Hora de começo', '25:90');
        $I->fillField('Hora de fim', '45:70');
        $I->selectOption('Horario[dia_semana]', 'Segunda');
        $I->click('Adicionar');
        $I->seeValidationError('Formato da hora inválido.');
        $I->seeValidationError('Formato da hora inválido.');
    }
}