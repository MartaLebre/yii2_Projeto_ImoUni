<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property int $id_user
 * @property string $email
 * @property string $password
 * @property int $tipo
 * @property string $data_nascimento
 * @property string $data_criacao
 * @property int $numero_telemovel
 * @property string $primeiro_nome
 * @property string $ultimo_nome
 * @property string $genero
 *
 * @property Anuncio[] $anuncios
 * @property Casa[] $casas
 * @property Horario[] $horarios
 * @property User $user
 * @property Reserva[] $reservas
 * @property Visita[] $visitas
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'email', 'password', 'tipo', 'data_nascimento', 'data_criacao', 'numero_telemovel', 'primeiro_nome', 'ultimo_nome', 'genero'], 'required'],
            [['id_user', 'tipo', 'numero_telemovel'], 'integer'],
            [['data_nascimento', 'data_criacao'], 'safe'],
            [['genero'], 'string'],
            [['email', 'password', 'primeiro_nome', 'ultimo_nome'], 'string', 'max' => 45],
            [['numero_telemovel'], 'unique'],
            [['id_user'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'email' => 'Email',
            'password' => 'Password',
            'tipo' => 'Tipo',
            'data_nascimento' => 'Data Nascimento',
            'data_criacao' => 'Data Criacao',
            'numero_telemovel' => 'Numero Telemovel',
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Ultimo Nome',
            'genero' => 'Genero',
        ];
    }

    /**
     * Gets query for [[Anuncios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncios()
    {
        return $this->hasMany(Anuncio::className(), ['id_proprietario' => 'id_user']);
    }

    /**
     * Gets query for [[Casas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCasas()
    {
        return $this->hasMany(Casa::className(), ['id_proprietario' => 'id_user']);
    }

    /**
     * Gets query for [[Horarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHorarios()
    {
        return $this->hasMany(Horario::className(), ['id_perfil' => 'id_user']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['id_estudante' => 'id_user']);
    }

    /**
     * Gets query for [[Visitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVisitas()
    {
        return $this->hasMany(Visita::className(), ['id_estudante' => 'id_user']);
    }
}
