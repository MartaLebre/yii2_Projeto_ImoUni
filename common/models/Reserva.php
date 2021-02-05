<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reserva".
 *
 * @property int $id
 * @property int|null $id_estudante
 * @property int $id_quarto
 * @property string $data_reserva
 * @property string $data_entrada
 *
 * @property Perfil $estudante
 * @property Anuncio $anuncio
 */
class Reserva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['data_entrada', 'safe'],
            ['data_entrada', 'required', 'message' => 'Introduza a sua data de entrada.'],
            ['data_entrada', 'date', 'format' => 'Y-M-d', 'message' => 'Formato de data inválida.'],
            
            [['id_estudante'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_estudante' => 'id_user']],
            [['id_quarto'], 'exist', 'skipOnError' => true, 'targetClass' => Quarto::className(), 'targetAttribute' => ['id_quarto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_estudante' => 'Id Estudante',
            'id_anuncio' => 'Id Anuncio',
            'data_reserva' => 'Data da reserva',
            'data_entrada' => 'Data da entrada',
        ];
    }

    /**
     * Gets query for [[Estudante]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudante()
    {
        return $this->hasOne(Perfil::className(), ['id_user' => 'id_estudante']);
    }
    
    /**
     * Cria uma reserva
     * @param User $id_user para qual a reserva irá ser associado
     * @param Anuncio $id_anuncio para qual reserva irá ser associado
     * @return bool se for criado com sucesso
     */
    public function addReserva($id_user, $id_quarto){
        if (!$this->validate()) {
            return null;
        }
    
        $reserva = new Reserva();
        
        $reserva->id_estudante = $id_user;
        $reserva->id_quarto = $id_quarto;
        $reserva->data_reserva = date('Y-m-d');
        $reserva->data_entrada = $this->data_entrada;
        $reserva->save();
        
        return true;
    }

    /**
     * Gets query for [[Anuncio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncio()
    {
        return $this->hasOne(Anuncio::className(), ['id' => 'id_anuncio']);
    }
}
