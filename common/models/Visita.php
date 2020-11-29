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
            [['id_estudante', 'id_anuncio'], 'integer'],
            [['hora_visita', 'data_visita'], 'required'],
            [['hora_visita', 'data_visita'], 'safe'],
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
            'hora_visita' => 'Hora Visita',
            'data_visita' => 'Data Visita',
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
     * Gets query for [[Anuncio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncio()
    {
        return $this->hasOne(Anuncio::className(), ['id' => 'id_anuncio']);
    }
}
