<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Newrubrica;
use common\models\User;

/**
 * NewrubricaSearch represents the model behind the search form about `\common\models\Newrubrica`.
 */
class NewrubricaSearch extends Newrubrica
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_categoria'], 'integer'],
            [['cognome', 'nome', 'mobile', 'email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = User::readFilter(Newrubrica::find()->joinWith('gruppis'));
                                    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'id_categoria', $this->id_categoria]);

        return $dataProvider;
    }
}
