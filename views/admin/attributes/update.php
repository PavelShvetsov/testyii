<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserAttributes */

$this->title = 'Update User Attributes: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'User Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-attributes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
