<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\admin\search\IblockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iblock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'iblock_type_id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'list_page_url') ?>

    <?php // echo $form->field($model, 'detail_page_url') ?>

    <?php // echo $form->field($model, 'section_page_url') ?>

    <?php // echo $form->field($model, 'canonical_page_url') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
