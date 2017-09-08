<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "validate".
 *
 * @property integer $id
 * @property string $name
 * @property string $label
 *
 * @property AttributeValidate[] $attributeValidates
 */
class Validate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'validate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'label'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'label' => 'Label',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValidates()
    {
        return $this->hasMany(AttributeValidate::className(), ['valid_id' => 'id']);
    }
}
