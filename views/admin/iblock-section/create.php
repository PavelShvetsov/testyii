<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\IblockSection */

$this->title = 'Create Iblock Section';
$this->params['breadcrumbs'][] = ['label' => 'Iblock Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iblock-section-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
