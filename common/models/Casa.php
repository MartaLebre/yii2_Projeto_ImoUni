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
 * @property int $num_quartos
 * @property int $num_wcs
 * @property string $aquecimento_agua
 * @property int $area_exterior
 * @property int $animais
 * @property int $fumar
 * @property int $visitantes_pernoitar
 * @property string $foto
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
            [['tipo_alojamento', 'wifi', 'limpeza', 'aquecimento_agua', 'area_exterior', 'animais', 'fumar', 'visitantes_pernoitar'], 'required', 'message' => 'Escolha uma das opções.'],
            
            [['num_quartos', 'num_wcs'], 'integer', 'message' => 'Valor introduzido é inválido.'],
            [['num_quartos', 'num_wcs'], 'required', 'message' => 'Introduza um valor.'],
            
            [['nome_rua'], 'string'],
            [['nome_rua'], 'required', 'message' => 'Introduza um endereço.'],
            
            [['foto'], 'file', 'extensions' => ['png', 'jpg', 'jpeg'], 'wrongExtension' => 'Apenas ficheiros com estas extenções são permitidos: png, jpg, jpeg. '],
            [['foto'], 'file', 'maxSize' => (1024 * 1024)/2, 'tooBig' => 'O ficheiro tem ser menor que 525KB.'],
            [['foto'], 'file', 'skipOnEmpty' => false ,'uploadRequired' => 'Faça upload de uma fotografia.'],
            
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
            'nome_rua' => 'Nome da rua',
            'localizacao' => 'Localização',
            'tipo_alojamento' => 'Tipo do imóvel',
            'wifi' => 'Wi-Fi',
            'limpeza' => 'Limpeza',
            'num_quartos' => 'Quartos',
            'num_wcs' => 'Casas de banho',
            'aquecimento_agua' => 'Aquecimento da água',
            'area_exterior' => 'Área exterior',
            'animais' => 'Permitido animais',
            'fumar' => 'Permitido fumar',
            'visitantes_pernoitar' => 'Visitantes podem pernoitar',
            'foto' => 'Foto',
        ];
    }
    
    /**
     * Cria uma casa
     * @param Casa $id_user para qual utilizador irá ser associado
     * @return bool se for criado com sucesso
     */
    public function addCasa($id_user, $imgUploaded){
        if (!$this->validate()){
            return null;
        }
        
        $casa = new Casa();
        
        $casa->id_proprietario = $id_user;
        $casa->nome_rua = $this->nome_rua;
        $casa->tipo_alojamento = $this->tipo_alojamento;
        $casa->wifi = $this->wifi;
        $casa->limpeza = $this->limpeza;
        $casa->num_quartos = $this->num_quartos;
        $casa->num_wcs = $this->num_wcs;
        $casa->aquecimento_agua = $this->aquecimento_agua;
        $casa->area_exterior = $this->area_exterior;
        $casa->animais = $this->animais;
        $casa->fumar = $this->fumar;
        $casa->visitantes_pernoitar = $this->visitantes_pernoitar;
        $casa->foto = $imgUploaded;
        $casa->save();
    
        $session = Yii::$app->session;
        if($session->has('id_casa'))
            $session->remove('id_casa');
    
        $session->set('id_casa', $casa->id);
        
        return true;
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
