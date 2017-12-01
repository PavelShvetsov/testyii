<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\admin\Iblock;
use \app\models\admin\IblockSection;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\admin\IblockSection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iblock-section-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'iblock_id')->dropDownList(Iblock::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList(array('1'=>'Да','0'=>'Нет')) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'iblock_section_id')->dropDownList(IblockSection::find()->select(['name', 'id'])->indexBy('id')->column(),[
        'prompt' => 'Выбор раздела',
    ]) ?>

    <?php /* $form->field($model, 'parent')->dropDownList(ArrayHelper::map(IblockSection::find()->all(), 'id', 'name'))*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
