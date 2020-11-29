<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sala".
 *
 * @property int $id
 * @property int|null $id_casa
 * @property int $televisao
 * @property int $sofa
 * @property int $moveis
 * @property int $mesa
 * @property string $aquecimento
 * @property int $ac
 * @property resource $foto
 *
 * @property Casa $casa
 */
class Sala extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sala';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_casa', 'televisao', 'sofa', 'moveis', 'mesa', 'ac'], 'integer'],
            [['televisao', 'sofa', 'moveis', 'mesa', 'aquecimento', 'ac', 'foto'], 'required'],
            [['aquecimento'], 'string'],
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
            'televisao' => 'Televisao',
            'sofa' => 'Sofa',
            'moveis' => 'Moveis',
            'mesa' => 'Mesa',
            'aquecimento' => 'Aquecimento',
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
