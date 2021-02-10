<?php

namespace common\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "mensagem".
 *
 * @property int $id
 * @property int $id_remetente
 * @property int $id_destinatario
 * @property string $categoria
 * @property string $mensagem
 * @property int $vista
 * @property string $data_envio
 *
 * @property User $remetente
 * @property User $destinatario
 */
class Mensagem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mensagem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mensagem'], 'required', 'message' => 'Introduza uma mensagem.'],
            [['vista'], 'integer'],
            [['categoria', 'mensagem'], 'string'],
            [['data_envio'], 'safe'],
            [['id_remetente'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_remetente' => 'id']],
            [['id_destinatario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_destinatario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_remetente' => 'Id Remetente',
            'id_destinatario' => 'Id Destinatario',
            'categoria' => 'Categoria',
            'mensagem' => 'Mensagem',
            'vista' => 'Vista',
            'data_envio' => 'Data Envio',
        ];
    }
    
    public function createMsg(Anuncio $modelAnuncio){
        if (!$this->validate()){
            return null;
        }
    
        $data_envio = new DateTime();
        $mensagem = new Mensagem();
        
        $mensagem->id_remetente = Yii::$app->user->getId();
        $mensagem->id_destinatario = $modelAnuncio->getAttribute('id_proprietario');
        $mensagem->categoria = $modelAnuncio->getAttribute('titulo');
        $mensagem->mensagem = $this->mensagem;
        $mensagem->vista = 0;
        $mensagem->data_envio = $data_envio->format('Y-m-d H:i:s');
        $mensagem->save();
    
        return true;
    }
    
    public function sendMsg($id_destinatario, $categoria){
        if (!$this->validate()) {
            return null;
        }
        
        $data_envio = new DateTime();
        $mensagem = new Mensagem();
        
        $mensagem->id_remetente = Yii::$app->user->getId();
        $mensagem->id_destinatario = $id_destinatario;
        $mensagem->categoria = $categoria;
        $mensagem->mensagem = $this->mensagem;
        $mensagem->vista = 0;
        $mensagem->data_envio = $data_envio->format('Y-m-d H:i:s');
        $mensagem->save();
        
        return true;
    }

    /**
     * Gets query for [[Remetente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRemetente()
    {
        return $this->hasOne(User::className(), ['id' => 'id_remetente']);
    }

    /**
     * Gets query for [[Destinatario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestinatario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_destinatario']);
    }
}
