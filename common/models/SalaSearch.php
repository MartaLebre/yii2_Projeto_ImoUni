<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Sala;

/**
 * SalaSearch represents the model behind the search form of `common\models\Sala`.
 */
class SalaSearch extends Sala
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_casa', 'televisao', 'sofa', 'moveis', 'mesa', 'ac'], 'integer'],
            [['aquecimento', 'foto'], 'safe'],
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
        $query = Sala::find();

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
            'televisao' => $this->televisao,
            'sofa' => $this->sofa,
            'moveis' => $this->moveis,
            'mesa' => $this->mesa,
            'ac' => $this->ac,
        ]);

        $query->andFilterWhere(['like', 'aquecimento', $this->aquecimento])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
