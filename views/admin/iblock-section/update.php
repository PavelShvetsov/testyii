<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\admin\IblockSection */

$this->title = 'Update Iblock Section: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Iblock Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="iblock-section-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
