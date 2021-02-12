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
            [['tamanho', 'tipo_cama', 'varanda', 'secretaria', 'armario', 'ac'], 'required', 'message' => 'Escolha uma das opções.'],
    
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
            'disponibilidade' => 'Disponibilidade',
            'tamanho' => 'Tamanho da cama',
            'tipo_cama' => 'Tipo da cama',
            'varanda' => 'Varanda',
            'secretaria' => 'Secretária',
            'armario' => 'Armário',
            'ac' => 'AC',
            'foto' => 'Foto',
        ];
    }
    
    /**
     * Cria uma casa
     * @param Quarto $id_casa para qual utilizador irá ser associado
     * @return bool se for criado com sucesso
     */
    public function addQuarto($id_casa, $imgUploaded){
        if (!$this->validate()) {
            return null;
        }
        
        $quarto = new Quarto();
    
        $quarto->id_casa = $id_casa;
        $quarto->tamanho = $this->tamanho;
        $quarto->tipo_cama = $this->tipo_cama;
        $quarto->varanda = $this->varanda;
        $quarto->secretaria = $this->secretaria;
        $quarto->armario = $this->armario;
        $quarto->ac = $this->ac;
        $quarto->foto = $imgUploaded;
        $quarto->save();
        
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
