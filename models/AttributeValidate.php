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
    const SCENARIO_TABULAR = 'tabular';
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
            [['value'], 'required', 'on' => self::SCENARIO_TABULAR],
            [['attr_id'], 'integer'],
            [['type', 'required'], 'string'],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAttributes::className(), 'targetAttribute' => ['attr_id' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_TABULAR] = ['value'];
        return $scenarios;
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
    public function getAttrProp()
    {
        return $this->hasOne(AttributeProperties::className(), ['id' => 'attr_prop_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(UserAttributes::className(), ['id' => 'attr_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValid()
    {
        return $this->hasOne(Validate::className(), ['id' => 'valid_id']);
    }
}
