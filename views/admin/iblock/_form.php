<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\admin\IblockType;

/* @var $this yii\web\View */
/* @var $model app\models\admin\Iblock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iblock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'iblock_type_id')->dropDownList(IblockType::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList(array('1'=>'Да','0'=>'Нет')) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'list_page_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_page_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'section_page_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'canonical_page_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
