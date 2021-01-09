<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage('yii2_Projeto_ImoUni/frontend/web/');
        $I->wait(3);



        $I->seeLink('Signup');
        $I->click('Signup');
        $I->wait(2); // wait for page to be opened

        $I->see('Registar nova conta');
    }
}
