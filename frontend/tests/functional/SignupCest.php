<?php

namespace frontend\tests\functional;

use common\models\User;
use frontend\tests\FunctionalTester;

class SignupCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    protected function formParams($primeiro_nome, $ultimo_nome, $username, $email, $password, $data_nascimento, $numero_telemovel, $genero, $tipo)
    {
        return[
            'SignupForm[primeiro_nome]' => $primeiro_nome,
            'SignupForm[ultimo_nome]' => $ultimo_nome,
            'SignupForm[username]' => $username,
            'SignupForm[email]' => $email,
            'SignupForm[password]' => $password,
            'SignupForm[data_nascimento]' => $data_nascimento,
            'SignupForm[numero_telemovel]' => $numero_telemovel,
            'SignupForm[genero]' => $genero,
            'SignupForm[tipo]' => $tipo,
        ];
    }

    public function VerificacaoVazio (FunctionalTester $I)
    {
        $I->submitForm('#signup', [
            'SignupForm[primeiro_nome]' => '',
            'SignupForm[ultimo_nome]' => '',
            'SignupForm[username]' => '',
            'SignupForm[email]' => '',
            'SignupForm[password]' => '',
            'SignupForm[data_nascimento]' => '',
            'SignupForm[numero_telemovel]' => '',
            'SignupForm[genero]' => '',
            'SignupForm[tipo]' => '',
        ]);
        $I->seeValidationError('Este campo não pode estar em branco!');
        $I->see('Este campo não pode estar em branco!', '.help-block');
        $I->see('Este campo não pode estar em branco!', '.help-block');
        $I->see('Este campo não pode estar em branco!', '.help-block');
        $I->see('Este campo não pode estar em branco!', '.help-block');
        $I->see('Este campo não pode estar em branco!', '.help-block');
        $I->see('Este campo não pode estar em branco!', '.help-block');
        $I->see('Este campo não pode estar em branco!', '.help-block');
        $I->see('Este campo não pode estar em branco!', '.help-block');
        $I->see('Este campo não pode estar em branco!', '.help-block');
    }

    public function VerificacaoEmail (FunctionalTester $I)
    {
        $I->submitForm('#signup', [
            'SignupForm[primeiroNome]' => 'aaaaa',
            'SignupForm[ultimoNome]' => 'aaaaa',
            'SignupForm[username]' => 'aaaaa123',
            'SignupForm[email]' => 'aaaaa123',
            'SignupForm[password]' => '123456',
            'SignupForm[dtaNascimento]' => '2020-11-02',
            'SignupForm[numero_telemovel]' => '922922922',
            'SignupForm[genero]' => 'Masculino',
            'SignupForm[tipo]' => 'Estudante',
        ]);
        $I->see('Primeiro Nome');
        $I->See('Email não é válido!', '.help-block');
    }

    public function VerificacaoRegistoCorreto(FunctionalTester $I)
    {
        $I->submitForm('#signup', [
            'SignupForm[primeiroNome]' => 'aaaaa',
            'SignupForm[ultimoNome]' => 'aaaaa',
            'SignupForm[username]' => 'aaaaa123',
            'SignupForm[email]' => 'aaaaa123@gmail.com',
            'SignupForm[password]' => '123456',
            'SignupForm[dtaNascimento]' => '2020-11-02',
            'SignupForm[numero_telemovel]' => '922922922',
            'SignupForm[genero]' => 'Masculino',
            'SignupForm[tipo]' => 'Estudante',
        ]);


        $I->see("ImoUni");

        $I->seeRecord(User::className(), [
            'username' => 'aaaaa123',
            'email' => 'aaaaa123@gmail.com',
        ]);

        $I->seeRecord('common\models\Perfil', [
            'primeiroNome' => 'aaaaa',
            'numero_telemovel' => '922922922',
        ]);
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
