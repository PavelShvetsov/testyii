<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attribute_validate".
 *
 * @property integer $id
 * @property integer $attr_id
 * @property string $type
 * @property string $required
 *
 * @property UserAttributes $attr
 */
class AttributeValidate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_validate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attr_id'], 'required'],
            [['attr_id'], 'integer'],
            [['type', 'required'], 'string'],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAttributes::className(), 'targetAttribute' => ['attr_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attr_id' => 'Attr ID',
            'type' => 'Type',
            'required' => 'Required',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(UserAttributes::className(), ['id' => 'attr_id']);
    }

    public function getValid()
    {
        return $this->hasOne(Validate::className(), ['id' => 'valid_id']);
    }
}