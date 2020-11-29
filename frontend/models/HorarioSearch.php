<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Horario;

/**
 * HorarioSearch represents the model behind the search form of `common\models\Horario`.
 */
class HorarioSearch extends Horario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_perfil'], 'integer'],
            [['hora_comeco', 'hora_fim', 'dia_semana'], 'safe'],
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
        $query = Horario::find();

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
            'id_perfil' => $this->id_perfil,
            'hora_comeco' => $this->hora_comeco,
            'hora_fim' => $this->hora_fim,
        ]);

        $query->andFilterWhere(['like', 'dia_semana', $this->dia_semana]);

        return $dataProvider;
    }
}
