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
            [['id', 'id_casa', 'lava_loica', 'maquina_roupa', 'maquina_loica', 'tostadeira', 'torradeira', 'mircro_ondas', 'frigorifico', 'arca', 'fogao', 'forno'], 'required'],
            [['id', 'id_casa', 'lava_loica', 'maquina_roupa', 'maquina_loica', 'tostadeira', 'torradeira', 'mircro_ondas', 'arca', 'forno'], 'integer'],
            [['frigorifico', 'fogao'], 'string'],
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
            'lava_loica' => 'Lava-loica',
            'maquina_roupa' => 'Maquina roupa',
            'maquina_loica' => 'Maquina loica',
            'tostadeira' => 'Tostadeira',
            'torradeira' => 'Torradeira',
            'mircro_ondas' => 'Mircro-ondas',
            'frigorifico' => 'Frigorifico',
            'arca' => 'Arca',
            'fogao' => 'Fogão',
            'forno' => 'Forno',
            'foto' => 'Foto',
        ];
    }
    
    /**
     * Cria uma cozinha
     * @param Casa $id_user para qual utilizador irá ser associado
     * @return bool se for criado com sucesso
     */
    public function addCozinha($id_propriedade, $imgUploaded){
        if (!$this->validate()) {
            return null;
        }
        
        $cozinha = new Cozinha();
    
        $cozinha->id_casa = $id_propriedade;
        $cozinha->lava_loica = $this->lava_loica;
        $cozinha->maquina_roupa = $this->maquina_roupa;
        $cozinha->maquina_loica = $this->maquina_loica;
        $cozinha->tostadeira = $this->tostadeira;
        $cozinha->torradeira = $this->torradeira;
        $cozinha->mircro_ondas = $this->mircro_ondas;
        $cozinha->frigorifico = $this->frigorifico;
        $cozinha->arca = $this->arca;
        $cozinha->fogao = $this->fogao;
        $cozinha->forno = $this->forno;
        $cozinha->foto = $imgUploaded;
        $cozinha->save();
        
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
