<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reserva".
 *
 * @property int $id
 * @property int|null $id_estudante
 * @property int|null $id_anuncio
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
            [['id_estudante', 'id_anuncio'], 'integer'],
            [['data_reserva', 'data_entrada'], 'required'],
            [['data_reserva', 'data_entrada'], 'safe'],
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
            'data_reserva' => 'Data Reserva',
            'data_entrada' => 'Data Entrada',
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
