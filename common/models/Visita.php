<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "visita".
 *
 * @property int $id
 * @property int|null $id_estudante
 * @property int|null $id_anuncio
 * @property string $hora_visita
 * @property string $data_visita
 *
 * @property Perfil $estudante
 * @property Anuncio $anuncio
 */
class Visita extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visita';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['data_visita', 'safe'],
            ['data_visita', 'required', 'message' => 'Introduza a sua data da visita.'],
            ['data_visita', 'date', 'format' => 'Y-M-d', 'message' => 'Formato de data inválida.'],
            
            ['hora_visita', 'safe'],
            ['hora_visita', 'required', 'message' => 'Introduza a sua hora da visita.'],
            ['hora_visita', 'time', 'format' => 'HH:mm', 'message' => 'Formato de hora inválida.'],
            
            [['id_estudante'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_estudante' => 'id_user']],
            [['id_anuncio'], 'exist', 'skipOnError' => true, 'targetClass' => Anuncio::className(), 'targetAttribute' => ['id_anuncio' => 'id']],
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
            'hora_visita' => 'Hora da visita',
            'data_visita' => 'Data da visita',
        ];
    }
    
    /**
     * Cria uma visita
     * @param User $id_user para qual a reserva irá ser associado
     * @param Anuncio $id_anuncio para qual reserva irá ser associado
     * @return bool se for criado com sucesso
     */
    public function addVisita($id_user, $id_anuncio){
        if (!$this->validate()) {
            return null;
        }
        
        $visita = new Visita();
    
        $visita->id_estudante = $id_user;
        $visita->id_anuncio = $id_anuncio;
        $visita->hora_visita = $this->hora_visita;
        $visita->data_visita = $this->data_visita;
        $visita->save();
        
        return true;
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
     * Gets query for [[Anuncio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncio()
    {
        return $this->hasOne(Anuncio::className(), ['id' => 'id_anuncio']);
    }
}
