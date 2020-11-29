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
 * @property int $anuncios_pub_mes
 * @property int $anuncios_pub_ano
 * @property int $reservas_mes
 * @property int $reservas_ano
 */
class Estatistica extends \yii\db\ActiveRecord
{
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
            [['num_users', 'num_genero_mas', 'num_genero_fem', 'idade_media', 'preco_medio', 'anuncios_pub_mes', 'anuncios_pub_ano', 'reservas_mes', 'reservas_ano'], 'required'],
            [['num_users', 'num_genero_mas', 'num_genero_fem', 'idade_media', 'preco_medio', 'anuncios_pub_mes', 'anuncios_pub_ano', 'reservas_mes', 'reservas_ano'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'num_users' => 'Num Users',
            'num_genero_mas' => 'Num Genero Mas',
            'num_genero_fem' => 'Num Genero Fem',
            'idade_media' => 'Idade Media',
            'preco_medio' => 'Preco Medio',
            'anuncios_pub_mes' => 'Anuncios Pub Mes',
            'anuncios_pub_ano' => 'Anuncios Pub Ano',
            'reservas_mes' => 'Reservas Mes',
            'reservas_ano' => 'Reservas Ano',
        ];
    }
}
