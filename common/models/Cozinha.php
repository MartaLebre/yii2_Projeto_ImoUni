<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cozinha".
 *
 * @property int $id
 * @property int $id_casa
 * @property int $lava_loica
 * @property int $maquina_roupa
 * @property int $maquina_loica
 * @property int $tostadeira
 * @property int $torradeira
 * @property int $mircro_ondas
 * @property string $frigorifico
 * @property int $arca
 * @property string $fogao
 * @property int $forno
 * @property resource $foto
 *
 * @property Casa $casa
 */
class Cozinha extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cozinha';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_casa', 'lava_loica', 'maquina_roupa', 'maquina_loica', 'tostadeira', 'torradeira', 'mircro_ondas', 'frigorifico', 'arca', 'fogao', 'forno', 'foto'], 'required'],
            [['id', 'id_casa', 'lava_loica', 'maquina_roupa', 'maquina_loica', 'tostadeira', 'torradeira', 'mircro_ondas', 'arca', 'forno'], 'integer'],
            [['frigorifico', 'fogao'], 'string'],
            [['foto'], 'string', 'max' => 1024],
            [['id'], 'unique'],
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
            'lava_loica' => 'Lava Loica',
            'maquina_roupa' => 'Maquina Roupa',
            'maquina_loica' => 'Maquina Loica',
            'tostadeira' => 'Tostadeira',
            'torradeira' => 'Torradeira',
            'mircro_ondas' => 'Mircro Ondas',
            'frigorifico' => 'Frigorifico',
            'arca' => 'Arca',
            'fogao' => 'Fogao',
            'forno' => 'Forno',
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
