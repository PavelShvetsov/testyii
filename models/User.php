<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $auth_key
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group'], 'integer'],
            [['email', 'password', 'auth_key'], 'string', 'max' => 255],
            [['auth_key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'group' => 'Group'
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);
        if ($this->isNewRecord) {
            $this->auth_key = Yii::$app->security->generateRandomString($length = 255);
        }
        if ($this->isAttributeChanged('password')) {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
            //$this->password=md5($this->password);
        }
        return $return;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Yii::$app->session->setFlash('success', 'Новый пользователь зарегистрирован!');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAttributeValues()
    {
        return $this->hasMany(UserAttributeValues::className(), ['user_id' => 'id']);
    }
    public function getUserAttributes()
    {
        return $this->hasMany(UserAttributes::className(), ['id' => 'attr_id'])
            ->viaTable('user_attribute_values',['user_id' => 'id']);
    }
}
