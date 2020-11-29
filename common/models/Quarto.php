<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quarto".
 *
 * @property int $id
 * @property int|null $id_casa
 * @property int $disponibilidade
 * @property string $tamanho
 * @property string $tipo_cama
 * @property int $varanda
 * @property int $secretaria
 * @property int $armario
 * @property int $ac
 * @property resource $foto
 *
 * @property Casa $casa
 */
class Quarto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quarto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_casa', 'disponibilidade', 'varanda', 'secretaria', 'armario', 'ac'], 'integer'],
            [['disponibilidade', 'tamanho', 'tipo_cama', 'varanda', 'secretaria', 'armario', 'ac', 'foto'], 'required'],
            [['tamanho', 'tipo_cama'], 'string'],
            [['foto'], 'string', 'max' => 1024],
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
            'id_casa' => 'Id Casa',
            'disponibilidade' => 'Disponibilidade',
            'tamanho' => 'Tamanho',
            'tipo_cama' => 'Tipo Cama',
            'varanda' => 'Varanda',
            'secretaria' => 'Secretaria',
            'armario' => 'Armario',
            'ac' => 'Ac',
            'foto' => 'Foto',
        ];
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
}
