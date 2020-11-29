<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "horario".
 *
 * @property int $id
 * @property int|null $id_perfil
 * @property string $hora_comeco
 * @property string $hora_fim
 * @property string $dia_semana
 *
 * @property Perfil $perfil
 */
class Horario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'horario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_perfil'], 'integer'],
            [['hora_comeco', 'hora_fim', 'dia_semana'], 'required'],
            [['hora_comeco', 'hora_fim'], 'safe'],
            [['dia_semana'], 'string'],
            [['id_perfil'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_perfil' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_perfil' => 'Id Perfil',
            'hora_comeco' => 'Hora Comeco',
            'hora_fim' => 'Hora Fim',
            'dia_semana' => 'Dia Semana',
        ];
    }

    /**
     * Gets query for [[Perfil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfil()
    {
        return $this->hasOne(Perfil::className(), ['id_user' => 'id_perfil']);
    }
}
