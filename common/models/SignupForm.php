<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    
    //perfil
    public $tipo;
    public $data_nascimento;
    public $numero_telemovel;
    public $primeiro_nome;
    public $ultimo_nome;
    public $genero;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message' => 'Introduza um nome de utilizador.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nome de utilizador já está registado.'],
            ['username', 'string',
                'min' => 2, 'max' => 255,
                'tooShort' => 'O nome de utilizador tem que ter no mínimo 2 digitos.',
                'tooLong' => 'O nome de utilizador não pode exceder os 255 digitos.'],
            
            ['email', 'required', 'message' => 'Introduza um e-mail.'],
            ['email', 'email', 'message' => 'Introduza um e-mail válido.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este e-mail já está registado.'],
            ['email', 'string',
                'max' => 255,
                'tooLong' => 'O email não pode exceder os 255 digitos.'],
            
            ['tipo', 'required', 'message' => 'Escolha uma opção.'],
    
            ['data_nascimento', 'safe'],
            ['data_nascimento', 'required', 'message' => 'Introduza a sua data de nascimento.'],
            ['data_nascimento', 'date', 'format' => 'Y-M-d', 'message' => 'Formato de data inválida.'],
            
            ['password', 'required', 'message' => 'Introduza uma password.'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'A password tem que ter no mínimo 6 digitos.'],
            
            ['numero_telemovel', 'integer', 'message' => 'Número de telemovel incorreto.'],
            ['numero_telemovel', 'required', 'message' => 'Introduza um número de telemovel.'],
            ['numero_telemovel', 'unique', 'targetClass' => '\common\models\Perfil', 'message' => 'Este número de telemovel já está registado.'],
            [
                'numero_telemovel', 'string', 'min' => 9, 'max' => 9,
                'tooShort' => 'O número de telemovel tem que ter 9 dígitos.',
                'tooLong' => 'O número de telemovel tem que ter 9 dígitos.'
            ],
            
            ['primeiro_nome', 'required', 'message' => 'Introduza um nome.'],
            [
                'primeiro_nome', 'string', 'min' => 2, 'max' => 50,
                'tooShort' => 'O nome tem que ter no mínimo 2 digitos.',
                'tooLong' => 'O nome não pode exceder os 50 digitos.'
            ],
            
            ['ultimo_nome', 'required', 'message' => 'Introduza um apelido.'],
            [
                'ultimo_nome', 'string', 'min' => 2, 'max' => 50,
                'tooShort' => 'O apelido tem que ter no mínimo 2 digitos.',
                'tooLong' => 'O apelido não pode exceder os 50 digitos.'
            ],
            
            ['genero', 'required', 'message' => 'Indique o seu genero.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup(){
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->save();
    
        //perfil
        $perfil = new Perfil();
        $perfil->id_user = $user->id;
        $perfil->tipo = $this->tipo;
        $perfil->data_nascimento = $this->data_nascimento;
        $perfil->numero_telemovel = $this->numero_telemovel;
        $perfil->primeiro_nome = $this->primeiro_nome;
        $perfil->ultimo_nome = $this->ultimo_nome;
        $perfil->genero = $this->genero;
        $perfil->save();
        
        /*
        $auth = Yii::$app->authManager;
        if($perfil->tipo == 2){
            $authorRole = $auth->getRole('senhorio');
            $auth->assign($authorRole, $user->getId());
        }
        */
        
        return true;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    /*
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
    */
}
