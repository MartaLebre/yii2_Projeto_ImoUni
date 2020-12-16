<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Perfil;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
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
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Introduza um nome de utilizador.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nome de utilizador já está registado.'],
            [
                'username', 'string', 'min' => 2, 'max' => 255,
                'tooShort' => 'O nome de utilizador tem que ter no mínimo 2 digitos.',
                'tooLong' => 'O nome de utilizador não pode exceder os 255 digitos.'
            ],
    
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Introduza um e-mail.'],
            ['email', 'email', 'message' => 'Introduza um e-mail válido.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este e-mail já está registado.'],
            ['email', 'string', 'max' => 255, 'tooLong' => 'O email não pode exceder os 255 digitos.'],
    
            ['tipo', 'trim'],
            ['tipo', 'required', 'message' => 'Escolha uma opção.'],
    
            ['data_nascimento', 'trim'],
            ['data_nascimento', 'required', 'message' => 'Introduza a sua data de nascimento.'],
            ['data_nascimento', 'date', 'message' => 'Data de nascimento incorreta.'],
            ['data_nascimento', 'date', 'format' => 'd-M-yyyy',
                                        'message' => 'Formato de data inválida.'],
            
            ['password', 'required', 'message' => 'Introduza uma password.'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'A password tem que ter no mínimo 6 digitos.'],
    
            ['numero_telemovel', 'trim'],
            ['numero_telemovel', 'integer', 'message' => 'Número de telemovel incorreto.'],
            ['numero_telemovel', 'required', 'message' => 'Introduza um número de telemovel.'],
            [
                'numero_telemovel', 'string', 'min' => 9, 'max' => 9,
                'tooShort' => 'O número de telemovel tem que ter 9 dígitos.',
                'tooLong' => 'O número de telemovel tem que ter 9 dígitos.'
            ],
    
            ['primeiro_nome', 'trim'],
            ['primeiro_nome', 'required', 'message' => 'Introduza um nome.'],
            [
                'primeiro_nome', 'string', 'min' => 2, 'max' => 50,
                'tooShort' => 'O nome tem que ter no mínimo 2 digitos.',
                'tooLong' => 'O nome não pode exceder os 50 digitos.'
            ],
    
            ['ultimo_nome', 'trim'],
            ['ultimo_nome', 'required', 'message' => 'Introduza um apelido.'],
            [
                'ultimo_nome', 'string', 'min' => 2, 'max' => 50,
                'tooShort' => 'O apelido tem que ter no mínimo 2 digitos.',
                'tooLong' => 'O apelido não pode exceder os 50 digitos.'
            ],
    
            ['ultimo_nome', 'trim'],
            ['genero', 'required', 'message' => 'Indique os seu genero.'],
        
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        
        // DADOS PERFIL
        
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
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
}
