<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Quarto;

/**
 * QuartoSearch represents the model behind the search form of `common\models\Quarto`.
 */
class QuartoSearch extends Quarto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_casa', 'disponibilidade', 'varanda', 'secretaria', 'armario', 'ac'], 'integer'],
            [['tamanho', 'tipo_cama', 'foto'], 'safe'],
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
        $query = Quarto::find();

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
            'id_casa' => $this->id_casa,
            'disponibilidade' => $this->disponibilidade,
            'varanda' => $this->varanda,
            'secretaria' => $this->secretaria,
            'armario' => $this->armario,
            'ac' => $this->ac,
        ]);

        $query->andFilterWhere(['like', 'tamanho', $this->tamanho])
            ->andFilterWhere(['like', 'tipo_cama', $this->tipo_cama])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
