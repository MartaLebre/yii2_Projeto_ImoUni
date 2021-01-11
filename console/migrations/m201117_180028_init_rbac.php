<?php

use yii\db\Migration;

/**
 * Class m201117_180028_init_rbac
 */
class m201117_180028_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
    
        //admin permissoes
        $blockUser = $auth->createPermission('blockUser');
        $blockUser->description = 'Bloquear um utilizador';
        $auth->add($blockUser);
    
        $unblockUser = $auth->createPermission('unblockUser');
        $unblockUser->description = 'Desbloquear um utilizador';
        $auth->add($unblockUser);
    
        $blockAnuncio = $auth->createPermission('blockAnuncio');
        $blockAnuncio->description = 'Bloquear um anuncio';
        $auth->add($blockAnuncio);
    
        $unblockAnuncio = $auth->createPermission('unblockAnuncio');
        $unblockAnuncio->description = 'Desbloquear um anuncio';
        $auth->add($unblockAnuncio);
    
        //role admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $blockUser);
        $auth->addChild($admin, $unblockUser);
        $auth->addChild($admin, $blockAnuncio);
        $auth->addChild($admin, $unblockAnuncio);
    
    
        //senhorio permissoes
        $addAnuncio = $auth->createPermission('addAnuncio');
        $addAnuncio->description = 'Publicar Anuncio';
        $auth->add($addAnuncio);
    
        $editAnuncio = $auth->createPermission('editAnuncio');
        $editAnuncio->description = 'Editar Anuncio';
        $auth->add($editAnuncio);
    
        $delAnuncio = $auth->createPermission('delAnuncio');
        $delAnuncio->description = 'Eliminar anuncio';
        $auth->add($delAnuncio);
    
        //role senhorio
        $senhorio = $auth->createRole('senhorio');
        $auth->add($senhorio);
        $auth->addChild($senhorio, $addAnuncio);
        $auth->addChild($senhorio, $editAnuncio);
        $auth->addChild($senhorio, $delAnuncio);
    }

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
    
        $auth->removeAll();
        /*
        echo "m201117_180028_init_rbac cannot be reverted.\n";

        return false;*/
    }
    


    /*
    public function up()
    {
        $auth = Yii::$app->authManager;

        //admin permissoes
        $blockUser = $auth->createPermission('blockUser');
        $blockUser->description = 'Bloquear um utilizador';
        $auth->add($blockUser);

        $unblockUser = $auth->createPermission('unblockUser');
        $unblockUser->description = 'Desbloquear um utilizador';
        $auth->add($unblockUser);

        $blockAnuncio = $auth->createPermission('blockAnuncio');
        $blockAnuncio->description = 'Bloquear um anuncio';
        $auth->add($blockAnuncio);

        $unblockAnuncio = $auth->createPermission('unblockAnuncio');
        $unblockAnuncio->description = 'Desbloquear um anuncio';
        $auth->add($unblockAnuncio);

        //role admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $blockUser);
        $auth->addChild($admin, $unblockUser);
        $auth->addChild($admin, $blockAnuncio);
        $auth->addChild($admin, $unblockAnuncio);


        //senhorio permissoes
        $addAnuncio = $auth->createPermission('addAnuncio');
        $addAnuncio->description = 'Publicar Anuncio';
        $auth->add($addAnuncio);

        $editAnuncio = $auth->createPermission('editAnuncio');
        $editAnuncio->description = 'Editar Anuncio';
        $auth->add($editAnuncio);

        $delAnuncio = $auth->createPermission('delAnuncio');
        $delAnuncio->description = 'Eliminar anuncio';
        $auth->add($delAnuncio);

        //role senhorio
        $senhorio = $auth->createRole('senhorio');
        $auth->add($senhorio);
        $auth->addChild($senhorio, $addAnuncio);
        $auth->addChild($senhorio, $editAnuncio);
        $auth->addChild($senhorio, $delAnuncio);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
    */
}
