<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "estatistica".
 *
 * @property int $num_users
 * @property int $num_genero_mas
 * @property int $num_genero_fem
 * @property int $idade_media
 * @property int $preco_medio
 * @property int $total_anuncios
 * @property int $total_reservas
 * @property int $total_visitas
 */
class Estatistica extends \yii\db\ActiveRecord
{
    public $numMas;
    public $numFem;
    public $idadeMedia;
    public $precoMedio;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estatistica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_users', 'num_genero_mas', 'num_genero_fem', 'idade_media', 'preco_medio', 'total_anuncios', 'total_reservas', 'total_visitas'], 'required'],
            [['num_users', 'num_genero_mas', 'num_genero_fem', 'total_anuncios', 'total_reservas', 'total_visitas'], 'integer'],
            [['idade_media', 'preco_medio'], 'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'num_users' => 'Utilizadores',
            'num_genero_mas' => 'Gênero Mas',
            'num_genero_fem' => 'Gênero Fem',
            'idade_media' => 'Idade média',
            'preco_medio' => 'Preço médio',
            'anuncios_pub_mes' => 'Anúncios publicados /Mês',
            'anuncios_pub_ano' => 'Anúncios publicados /Ano',
            'reservas_mes' => 'Reservas /Mês',
            'reservas_ano' => 'Reservas /Ano',
        ];
    }
    
    public function getEstatisticas(){
        $perfies = Perfil::find()->where(['tipo' => 1])->orWhere(['tipo' => 2])->all();
        $anuncios = Anuncio::find()->all();
        $reservas = Reserva::find()->all();
        $visitas = Visita::find()->all();
        
        //UTILIZADORES
        $this->num_users = count($perfies);
        
        //GENERO
        foreach($perfies as $perfil){
            if($perfil['genero'] == 'masculino')
                $this->numMas += 1;
            else
                $this->numFem += 1;
        }
        $this->num_genero_mas = $this->numMas;
        $this->num_genero_fem = $this->numFem;
        
        //IDADE MEDIA
        foreach($perfies as $perfil)
            $this->idadeMedia += $perfil->getIdade();
        
        $this->idadeMedia /= count($perfies);
        $this->idade_media = $this->idadeMedia;
        
        //TOTAL ANUNCIOS
        $this->total_anuncios = count($anuncios);
        
        //PRECO MEDIO
        foreach($anuncios as $anuncio)
            $this->precoMedio += $anuncio['preco'];
    
        $this->precoMedio /= count($anuncios);
        $this->preco_medio = $this->precoMedio;
    
        //TOTAL RESERVAS
        $this->total_reservas = count($reservas);
        
        //TOTAL VISITAS
        $this->total_visitas = count($visitas);
        
        $this->save();
    }
}
