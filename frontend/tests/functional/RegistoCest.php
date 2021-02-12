<?php

namespace frontend\tests\functional;

use common\models\User;
use frontend\tests\FunctionalTester;

class RegistoCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function registoVazio(FunctionalTester $I)
    {
        $I->see('Registar nova conta', 'h1');
        $I->see('Por favor preencha os seguintes campos');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Introduza um nome.');
        $I->seeValidationError('Introduza um apelido.');
        $I->seeValidationError('Introduza um nome de utilizador.');
        $I->seeValidationError('Introduza um e-mail.');
        $I->seeValidationError('Introduza uma password.');
        $I->seeValidationError('Introduza um número de telemovel.');
        $I->seeValidationError('Indique o seu genero.');
        $I->seeValidationError('Introduza a sua data de nascimento');
        $I->seeValidationError('Escolha uma opção.');
    }

    public function registoEmailIncorreto(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'SignupForm[primeiro_nome]' => 'aaaaa',
                'SignupForm[ultimo_nome]' => 'aaaaa',
                'SignupForm[username]' => 'aaaaa123',
                'SignupForm[email]' => 'aaaaa123',
                'SignupForm[password]' => '123456',
                'SignupForm[numero_telemovel]' => '922922922',
                'SignupForm[genero]' => 'Masculino',
                'SignupForm[data_nascimento]' => '2020-11-02',
                'SignupForm[tipo]' => 'Estudante'
            ]
        );
        $I->dontSee('Introduza um nome.');
        $I->dontSee('Introduza um apelido.');
        $I->dontSee('Introduza um nome de utilizador.');
        $I->dontSee('Introduza uma password.');
        $I->dontSee('Introduza um número de telemovel.');
        $I->dontSee('Indique o seu genero.');
        $I->dontSee('Introduza a sua data de nascimento');
        $I->dontSee('Escolha uma opção.');
        $I->see('Introduza um e-mail válido.', '.help-block');
    }

    public function registoCorreto(FunctionalTester $I)
    {
        $I->see('Registar nova conta', 'h1');
        $I->see('Por favor preencha os seguintes campos');
        $I->submitForm($this->formId, [
            'SignupForm[primeiro_nome]' => 'aaaaa',
            'SignupForm[ultimo_nome]' => 'apelido',
            'SignupForm[username]' => 'aaaaa123',
            'SignupForm[email]' => 'aaaaa123@mail.com',
            'SignupForm[password]' => '123456',
            'SignupForm[numero_telemovel]' => '922922922',
            'SignupForm[genero]' => 'Masculino',
            'SignupForm[data_nascimento]' => '2020-11-02',
            'SignupForm[tipo]' => 'Proprietario'
        ]);

        $I->seeRecord(User::className(), [
            'username' => 'aaaaa',
            'email' => 'aaaaa123@mail.com',
            'status' => \common\models\User::STATUS_ACTIVE
        ]);

        $I->see('Registo efetuado com sucesso.');

    }
}
