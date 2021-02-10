<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mensagem;

/**
 * MensagemSearch represents the model behind the search form of `common\models\Mensagem`.
 */
class MensagemSearch extends Mensagem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_remetente', 'id_destinatario', 'vista'], 'integer'],
            [['categoria', 'mensagem', 'data_envio'], 'safe'],
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
        $query = Mensagem::find();

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
            'id_remetente' => $this->id_remetente,
            'id_destinatario' => $this->id_destinatario,
            'vista' => $this->vista,
            'data_envio' => $this->data_envio,
        ]);

        $query->andFilterWhere(['like', 'categoria', $this->categoria])
            ->andFilterWhere(['like', 'mensagem', $this->mensagem]);

        return $dataProvider;
    }
}
