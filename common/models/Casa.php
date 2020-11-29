<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "casa".
 *
 * @property int $id
 * @property int|null $id_proprietario
 * @property string $nome_rua
 * @property string $localizacao
 * @property string $tipo_alojamento
 * @property int $wifi
 * @property string $limpeza
 * @property int $capacidade
 * @property int $num_quartos
 * @property int $num_wcs
 * @property string $aquecimento_agua
 * @property int $area_exterior
 * @property int $animais
 * @property int $fumar
 * @property int $visitantes_pernoitar
 * @property resource $foto
 *
 * @property Anuncio[] $anuncios
 * @property Perfil $proprietario
 * @property Cozinha[] $cozinhas
 * @property Quarto[] $quartos
 * @property Sala[] $salas
 */
class Casa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'casa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proprietario', 'wifi', 'capacidade', 'num_quartos', 'num_wcs', 'area_exterior', 'animais', 'fumar', 'visitantes_pernoitar'], 'integer'],
            [['nome_rua', 'localizacao', 'tipo_alojamento', 'wifi', 'limpeza', 'capacidade', 'num_quartos', 'num_wcs', 'aquecimento_agua', 'area_exterior', 'animais', 'fumar', 'visitantes_pernoitar', 'foto'], 'required'],
            [['localizacao', 'tipo_alojamento', 'limpeza', 'aquecimento_agua'], 'string'],
            [['nome_rua'], 'string', 'max' => 45],
            [['foto'], 'string', 'max' => 1024],
            [['id_proprietario'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::className(), 'targetAttribute' => ['id_proprietario' => 'id_user']],
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
            'nome_rua' => 'Nome Rua',
            'localizacao' => 'Localizacao',
            'tipo_alojamento' => 'Tipo Alojamento',
            'wifi' => 'Wifi',
            'limpeza' => 'Limpeza',
            'capacidade' => 'Capacidade',
            'num_quartos' => 'Num Quartos',
            'num_wcs' => 'Num Wcs',
            'aquecimento_agua' => 'Aquecimento Agua',
            'area_exterior' => 'Area Exterior',
            'animais' => 'Animais',
            'fumar' => 'Fumar',
            'visitantes_pernoitar' => 'Visitantes Pernoitar',
            'foto' => 'Foto',
        ];
    }

    /**
     * Gets query for [[Anuncios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnuncios()
    {
        return $this->hasMany(Anuncio::className(), ['id_casa' => 'id']);
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
     * Gets query for [[Cozinhas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCozinhas()
    {
        return $this->hasMany(Cozinha::className(), ['id_casa' => 'id']);
    }

    /**
     * Gets query for [[Quartos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuartos()
    {
        return $this->hasMany(Quarto::className(), ['id_casa' => 'id']);
    }

    /**
     * Gets query for [[Salas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalas()
    {
        return $this->hasMany(Sala::className(), ['id_casa' => 'id']);
    }
}
