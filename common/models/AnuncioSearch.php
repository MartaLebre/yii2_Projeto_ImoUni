<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Anuncio;

/**
 * AnuncioSearch represents the model behind the search form of `common\models\Anuncio`.
 */
class AnuncioSearch extends Anuncio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_proprietario', 'id_casa', 'preco', 'despesas_inc'], 'integer'],
            [['titulo', 'data_criacao', 'data_disponibilidade', 'descricao'], 'safe'],
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
        $query = Anuncio::find();

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
            'id_casa' => $this->id_casa,
            'preco' => $this->preco,
            'data_criacao' => $this->data_criacao,
            'data_disponibilidade' => $this->data_disponibilidade,
            'despesas_inc' => $this->despesas_inc,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}
