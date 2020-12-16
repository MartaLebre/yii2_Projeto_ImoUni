<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Perfil;

/**
 * PerfilSearch represents the model behind the search form of `common\models\Perfil`.
 */
class PerfilSearch extends Perfil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'tipo', 'numero_telemovel'], 'integer'],
            [['data_nascimento', 'primeiro_nome', 'ultimo_nome', 'genero'], 'safe'],
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
        $query = Perfil::find();

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
            'id_user' => $this->id_user,
            'tipo' => $this->tipo,
            'data_nascimento' => $this->data_nascimento,
            'numero_telemovel' => $this->numero_telemovel,
        ]);

        $query->andFilterWhere(['like', 'primeiro_nome', $this->primeiro_nome])
            ->andFilterWhere(['like', 'ultimo_nome', $this->ultimo_nome])
            ->andFilterWhere(['like', 'genero', $this->genero]);

        return $dataProvider;
    }
}
