<?php

namespace app\models\admin\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\admin\IblockSection;

/**
 * IblockSectionSearch represents the model behind the search form about `app\models\admin\IblockSection`.
 */
class IblockSectionSearch extends IblockSection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'iblock_id', 'iblock_section_id', 'active', 'sort', 'left_margin', 'right_margin', 'depth_level'], 'integer'],
            [['code', 'name', 'picture', 'detail_picture', 'description'], 'safe'],
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
        $query = IblockSection::find();

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
            'iblock_id' => $this->iblock_id,
            'iblock_section_id' => $this->iblock_section_id,
            'active' => $this->active,
            'sort' => $this->sort,
            'left_margin' => $this->left_margin,
            'right_margin' => $this->right_margin,
            'depth_level' => $this->depth_level,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'detail_picture', $this->detail_picture])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}