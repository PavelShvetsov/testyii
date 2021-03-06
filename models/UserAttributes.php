<?php

namespace app\models;

use Yii;
use yii\base\DynamicModel;

/**
 * This is the model class for table "user_attributes".
 *
 * @property integer $id
 * @property string $name
 *
 * @property UserAttributeValues[] $userAttributeValues
 */
class UserAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'label'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['label'], 'string', 'max' => 255],
            [['type'], 'safe'],
            //[['required'], 'safe'],
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
            'type' => 'Тип поля',
            //'required' => 'Обязательное',
        ];
    }

    private $_type;

    public function getType()
    {
        if ($this->_type === null) {
            $this->_type = ['срока','число'];
        }
        return $this->_type;
    }

    public function setType($value)
    {
        $this->_type = (array)$value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAttributeValues()
    {
        return $this->hasMany(UserAttributeValues::className(), ['attr_id' => 'id']);
    }

    public function getAttributeValidate()
    {
        return $this->hasMany(AttributeValidate::className(), ['attr_id' => 'id']);
    }

    public function getAttributeValidate2(){
        return $this->hasMany(Validate::className(), ['id' => 'valid_id'])
            ->viaTable('attribute_validate',['attr_id' => 'id']);
    }
    /**
     * @return int
     */

}
