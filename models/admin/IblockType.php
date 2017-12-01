<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model class for table "by_iblock_type".
 *
 * @property string $id
 * @property integer $sort
 * @property string $name
 *
 * @property Iblock[] $iblocks
 */
class IblockType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'by_iblock_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'name'], 'required'],
            [['sort'], 'integer'],
            [['id', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sort' => 'Сортировка',
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIblocks()
    {
        return $this->hasMany(Iblock::className(), ['iblock_type_id' => 'id']);
    }
}
