<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_attribute_values".
 *
 * @property integer $id
 * @property integer $attr_id
 * @property integer $user_id
 *
 * @property UserAttributes $attr
 * @property User $user
 */
class UserAttributeValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_attribute_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attr_id', 'user_id'], 'required'],
            [['attr_id', 'user_id'], 'integer'],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAttributes::className(), 'targetAttribute' => ['attr_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
        ];
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
