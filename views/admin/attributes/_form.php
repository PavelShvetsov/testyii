<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Validate;
use app\models\AttributeProperties;

/* @var $this yii\web\View */
/* @var $model app\models\UserAttributes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-attributes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>


    <?php
    //echo '<pre>';print_r($values);echo '</pre>';
    ?>
    <?php
    foreach ($values as $index => $value){
        //$value->getAttrProp()->select(['code', 'label']);
        //echo $form->field($value, '[' . $index . ']value')->label($value->valid->label);
        $atr = AttributeProperties::find()->select(['id','label'])->where(['valid_id' => $index])->indexBy('id')->all();
        $ar = [];
        foreach ($atr as $item){
            $ar[$item['id']]=$item['label'];
        }

        //echo '<pre>';print_r($a);echo '</pre>';
        echo $form->field($value, '[' . $index . ']valid_id')->dropDownList($ar)->label($value->valid->label);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
