<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model class for table "by_iblock".
 *
 * @property integer $id
 * @property string $iblock_type_id
 * @property string $code
 * @property string $name
 * @property integer $active
 * @property integer $sort
 * @property string $list_page_url
 * @property string $detail_page_url
 * @property string $section_page_url
 * @property string $canonical_page_url
 *
 * @property IblockType $iblockType
 */
class Iblock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'by_iblock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'sort'], 'required'],
            [['active', 'sort'], 'integer'],
            [['iblock_type_id', 'code', 'name', 'list_page_url', 'detail_page_url', 'section_page_url', 'canonical_page_url'], 'string', 'max' => 255],
            [['iblock_type_id', 'active'], 'unique', 'targetAttribute' => ['iblock_type_id', 'active'], 'message' => 'The combination of Iblock Type ID and Active has already been taken.'],
            [['iblock_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => IblockType::className(), 'targetAttribute' => ['iblock_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iblock_type_id' => 'Тип инфоблока',
            'code' => 'Символьный код',
            'name' => 'Название',
            'active' => 'Активность',
            'sort' => 'Сортировка',
            'list_page_url' => 'URL страницы информационного блока',
            'detail_page_url' => 'URL страницы детального просмотра',
            'section_page_url' => 'URL страницы раздела',
            'canonical_page_url' => 'Канонический URL элемента',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIblockType()
    {
        return $this->hasOne(IblockType::className(), ['id' => 'iblock_type_id']);
    }
}
