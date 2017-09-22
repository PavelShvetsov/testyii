<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserAttributesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Attributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-attributes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Attributes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'label',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
