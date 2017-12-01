<?php

namespace app\models\admin\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\admin\Iblock;

/**
 * IblockSearch represents the model behind the search form about `app\models\admin\Iblock`.
 */
class IblockSearch extends Iblock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active', 'sort'], 'integer'],
            [['iblock_type_id', 'code', 'name', 'list_page_url', 'detail_page_url', 'section_page_url', 'canonical_page_url'], 'safe'],
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
        $query = Iblock::find();

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
            'active' => $this->active,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'iblock_type_id', $this->iblock_type_id])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'list_page_url', $this->list_page_url])
            ->andFilterWhere(['like', 'detail_page_url', $this->detail_page_url])
            ->andFilterWhere(['like', 'section_page_url', $this->section_page_url])
            ->andFilterWhere(['like', 'canonical_page_url', $this->canonical_page_url]);

        return $dataProvider;
    }
}
