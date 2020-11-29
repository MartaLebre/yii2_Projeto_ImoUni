<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "anuncio".
 *
 * @property int $id
 * @property int|null $id_proprietario
 * @property int|null $id_casa
 * @property string $titulo
 * @property int $preco
 * @property string $data_criacao
 * @property string $data_disponibilidade
 * @property int $despesas_inc
 * @property string $descricao
 *
 * @property Perfil $proprietario
 * @property Casa $casa
 * @property Reserva[] $reservas
 * @property Visita[] $visitas
 */
class Anuncio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anuncio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proprietario', 'id_casa', 'preco', 'despesas_inc'], 'integer'],
            [['titulo', 'preco', 'data_criacao', 'data_disponibilidade', 'despesas_inc', 'descricao'], 'required'],
            [['data_criacao', 'data_disponibilidade'], 'safe'],
            [['descricao'], 'string'],
            [['titulo'], 'string', 'max' => 45],
            [['id_proprietario'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_proprietario' => 'id_user']],
            [['id_casa'], 'exist', 'skipOnError' => true, 'targetClass' => Casa::className(), 'targetAttribute' => ['id_casa' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proprietario' => 'Id Proprietario',
            'id_casa' => 'Id Casa',
            'titulo' => 'Titulo',
            'preco' => 'Preco',
            'data_criacao' => 'Data Criacao',
            'data_disponibilidade' => 'Data Disponibilidade',
            'despesas_inc' => 'Despesas Inc',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * Gets query for [[Proprietario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProprietario()
    {
        return $this->hasOne(Perfil::className(), ['id_user' => 'id_proprietario']);
    }

    /**
     * Gets query for [[Casa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCasa()
    {
        return $this->hasOne(Casa::className(), ['id' => 'id_casa']);
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['id_anuncio' => 'id']);
    }

    /**
     * Gets query for [[Visitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVisitas()
    {
        return $this->hasMany(Visita::className(), ['id_anuncio' => 'id']);
    }
}
