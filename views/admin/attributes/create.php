<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\UserAttributes */

$this->title = 'Create User Attributes';
$this->params['breadcrumbs'][] = ['label' => 'User Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-attributes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'values' => $values,
    ]) ?>

    <?php
    //echo '<pre>';print_r($attrs);echo '</pre>';
    //echo '<pre>';print_r($values);echo '</pre>';
    ?>



</div>
