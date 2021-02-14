<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cozinha;

/**
 * CozinhaSearch represents the model behind the search form of `common\models\Cozinha`.
 */
class CozinhaSearch extends Cozinha
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_casa', 'lava_loica', 'maquina_roupa', 'maquina_loica', 'tostadeira', 'torradeira', 'micro_ondas', 'arca', 'forno'], 'integer'],
            [['frigorifico', 'fogao', 'foto'], 'safe'],
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
        $query = Cozinha::find();

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
            'lava_loica' => $this->lava_loica,
            'maquina_roupa' => $this->maquina_roupa,
            'maquina_loica' => $this->maquina_loica,
            'tostadeira' => $this->tostadeira,
            'torradeira' => $this->torradeira,
            'micro_ondas' => $this->micro_ondas,
            'arca' => $this->arca,
            'forno' => $this->forno,
        ]);

        $query->andFilterWhere(['like', 'frigorifico', $this->frigorifico])
            ->andFilterWhere(['like', 'fogao', $this->fogao])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
