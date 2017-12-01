<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\search\IblockSectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Iblock Sections';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iblock-section-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Iblock Section', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'iblock_id',
            'code',
            'name',
            'active',
            // 'sort',
            // 'picture',
            // 'detail_picture',
            // 'description:ntext',
            // 'left_margin',
            // 'right_margin',
            // 'depth_level',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
