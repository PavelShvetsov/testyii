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
            'label' => 'Label'
        ];
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
    /**
     * @return int
     */

    public static function getModelFormAttributes($attributes){

        $attrModel=[];

        //echo '<pre>';print_r($attributes);echo '</pre>';

        foreach ($attributes as $attribute) {
            $attrModel[]=$attribute['name'];
        }

        $modelAttr = new DynamicModel($attrModel);

        //Валидация полей
        foreach($attributes as $attr) {
            $modelAttr->addRule([$attr['name']], $attr['validate']['type'], ['min' => 3]);
            if($attr['validate']['required']){
                $modelAttr->addRule([$attr['name']], 'required');
            }
        }
        //echo '<pre>';print_r($modelAttr);echo '</pre>';
        return $modelAttr;
    }

    public static function getAttrs(){
        $userAttr = self::find()->with('attributeValidate')->all();
        $attributes=[];
        foreach ($userAttr as $val){
            $attributes[$val->id]['name']=$val->name;
            $attributes[$val->id]['label']=$val->label;
            $attributes[$val->id]['validate']['required']=$val->attributeValidate[0]->required;
            $attributes[$val->id]['validate']['type']=$val->attributeValidate[0]->type;
        }
        return $attributes;
    }

}
