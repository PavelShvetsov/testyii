<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attribute_properties".
 *
 * @property integer $id
 * @property string $code
 * @property string $label
 *
 * @property AttributeValidate[] $attributeValidates
 */
class AttributeProperties extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'label'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'label' => 'Label',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValidates()
    {
        return $this->hasMany(AttributeValidate::className(), ['attr_prop_id' => 'id']);
    }
}
