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
            [['televisao', 'sofa', 'moveis', 'mesa', 'aquecimento', 'ac'], 'required', 'message' => 'Escolha uma das opções.'],
    
            [['foto'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'], 'wrongExtension' => 'Apenas ficheiros com estas extenções são permitidos: png, jpg, jpeg. '],
            [['foto'], 'file', 'maxSize' => (1024 * 1024)/2, 'tooBig' => 'O ficheiro tem ser menor que 525KB.'],
            //[['foto'], 'file', 'skipOnEmpty' => false ,'uploadRequired' => 'Faça upload de uma fotografia.'],
    
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
            'televisao' => 'Televisão',
            'sofa' => 'Sofa',
            'moveis' => 'Móveis',
            'mesa' => 'Mesa',
            'aquecimento' => 'Aquecimento',
            'ac' => 'AC',
            'foto' => 'Foto',
        ];
    }
    
    /**
     * Cria uma sala
     * @param Sala $id_casa para qual utilizador irá ser associado
     * @return bool se for criado com sucesso
     */
    public function addSala($id_casa, $imgUploaded){
        if (!$this->validate()){
            return null;
        }
        
        $sala = new Sala();
    
        $sala->id_casa = $id_casa;
        $sala->televisao = $this->televisao;
        $sala->sofa = $this->sofa;
        $sala->moveis = $this->moveis;
        $sala->mesa = $this->mesa;
        $sala->aquecimento = $this->aquecimento;
        $sala->ac = $this->ac;
        $sala->foto = $imgUploaded;
        $sala->save();
        
        return true;
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
