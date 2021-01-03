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
            [['hora_comeco', 'hora_fim'], 'safe'],
            [['hora_comeco', 'hora_fim'], 'datetime', 'format' => 'H:mm', 'message' => 'Formato da hora inválido.'],
            [['dia_semana'], 'string'],
            [['hora_comeco', 'hora_fim'], 'required', 'message' => 'Introduza a hora.'],
            [['dia_semana'], 'required', 'message' => 'Introduza o dia da semana.'],
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
            'hora_comeco' => 'Hora de começo',
            'hora_fim' => 'Hora de fim',
            'dia_semana' => 'Dia da semana',
        ];
    }
    
    /**
     * Cria um horario
     * @param Horario $id_perfil para qual utilizador irá ser associado
     * @return bool se for criado com sucesso
     */
    public function addHorario($id_perfil)
    {
        if (!$this->validate()) {
            return null;
        }
        
        $horario = new Horario();
        $horario->id_perfil = $id_perfil;
        $horario->hora_comeco = $this->hora_comeco;
        $horario->hora_fim = $this->hora_fim;
        $horario->dia_semana = $this->dia_semana;
        $horario->save();
        
        return true;
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
