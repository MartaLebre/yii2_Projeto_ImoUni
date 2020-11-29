<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Casa;

/**
 * CasaSearch represents the model behind the search form of `common\models\Casa`.
 */
class CasaSearch extends Casa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_proprietario', 'wifi', 'capacidade', 'num_quartos', 'num_wcs', 'area_exterior', 'animais', 'fumar', 'visitantes_pernoitar'], 'integer'],
            [['nome_rua', 'localizacao', 'tipo_alojamento', 'limpeza', 'aquecimento_agua', 'foto'], 'safe'],
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
        $query = Casa::find();

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
            'id_proprietario' => $this->id_proprietario,
            'wifi' => $this->wifi,
            'capacidade' => $this->capacidade,
            'num_quartos' => $this->num_quartos,
            'num_wcs' => $this->num_wcs,
            'area_exterior' => $this->area_exterior,
            'animais' => $this->animais,
            'fumar' => $this->fumar,
            'visitantes_pernoitar' => $this->visitantes_pernoitar,
        ]);

        $query->andFilterWhere(['like', 'nome_rua', $this->nome_rua])
            ->andFilterWhere(['like', 'localizacao', $this->localizacao])
            ->andFilterWhere(['like', 'tipo_alojamento', $this->tipo_alojamento])
            ->andFilterWhere(['like', 'limpeza', $this->limpeza])
            ->andFilterWhere(['like', 'aquecimento_agua', $this->aquecimento_agua])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
