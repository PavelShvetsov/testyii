<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model class for table "by_iblock_section".
 *
 * @property integer $id
 * @property integer $iblock_id
 * @property string $code
 * @property string $name
 * @property integer $active
 * @property integer $sort
 * @property string $picture
 * @property string $detail_picture
 * @property string $description
 * @property integer $left_margin
 * @property integer $right_margin
 * @property integer $depth_level
 *
 * @property Iblock $iblock
 */
class IblockSection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'by_iblock_section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iblock_id', 'name'], 'required'],
            [['iblock_id', 'iblock_section_id', 'active', 'sort', 'left_margin', 'right_margin', 'depth_level'], 'integer'],
            [['description'], 'string'],
            [['code', 'name', 'picture', 'detail_picture'], 'string', 'max' => 255],
            [['iblock_id', 'left_margin', 'right_margin'], 'unique', 'targetAttribute' => ['iblock_id', 'left_margin', 'right_margin'], 'message' => 'The combination of Iblock ID, Left Margin and Right Margin has already been taken.'],
            [['iblock_id', 'code'], 'unique', 'targetAttribute' => ['iblock_id', 'code'], 'message' => 'The combination of Iblock ID and Code has already been taken.'],
            [['iblock_section_id'], 'exist', 'skipOnError' => true, 'targetClass' => IblockSection::className(), 'targetAttribute' => ['iblock_section_id' => 'id']],
            [['iblock_id'], 'exist', 'skipOnError' => true, 'targetClass' => Iblock::className(), 'targetAttribute' => ['iblock_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iblock_id' => 'Инфоблок',
            'code' => 'Символьный код',
            'iblock_section_id' => 'Родительский раздел',
            'name' => 'Название',
            'active' => 'Активность',
            'sort' => 'Сортировка',
            'picture' => 'Изображение',
            'detail_picture' => 'Детальная картинка',
            'description' => 'Описание',
            //'left_margin' => 'Left Margin',
            //'right_margin' => 'Right Margin',
            //'depth_level' => 'Depth Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getParent()
    {
        return $this->hasOne(IblockSection::className(), ['id' => 'iblock_section_id']);
    }

    public function getIblockSections()
    {
        return $this->hasMany(IblockSection::className(), ['iblock_section_id' => 'id']);
    }

    public function getIblock()
    {
        return $this->hasOne(Iblock::className(), ['id' => 'iblock_id']);
    }

}
