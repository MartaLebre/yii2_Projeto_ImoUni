<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reserva;

/**
 * ReservaSearch represents the model behind the search form of `common\models\Reserva`.
 */
class ReservaSearch extends Reserva
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_estudante', 'id_anuncio'], 'integer'],
            [['data_reserva', 'data_entrada'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Reserva::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_estudante' => $this->id_estudante,
            'id_anuncio' => $this->id_anuncio,
            'data_reserva' => $this->data_reserva,
            'data_entrada' => $this->data_entrada,
        ]);

        return $dataProvider;
    }
}
