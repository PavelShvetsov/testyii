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

        $atr = AttributeProperties::find()->select(['id','label'])->where(['valid_id' => $index])->indexBy('id')->all();

        //echo '<pre>';print_r($atr);echo '</pre>';

        $ar = [];
        foreach ($atr as $item){
            $ar[$item['id']]=$item['label'];
        }

        echo $form->field($value, '[' . $index . ']value')->dropDownList($ar)->label($value->valid->label);
    }

    /*foreach ($values as $index => $value){
        echo $form->field($value, '[' . $index . ']value')->label($value->valid->label);
    }*/
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
