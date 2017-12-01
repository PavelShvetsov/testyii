<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\admin\search\IblockSectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iblock-section-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'iblock_id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'picture') ?>

    <?php // echo $form->field($model, 'detail_picture') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'left_margin') ?>

    <?php // echo $form->field($model, 'right_margin') ?>

    <?php // echo $form->field($model, 'depth_level') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
