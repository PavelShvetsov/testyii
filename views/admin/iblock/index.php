<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \app\models\admin\IblockType;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\search\IblockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Iblocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iblock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Iblock', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'iblock_type_id',
            'id',
            [
                'attribute' => 'iblock_type_id',
                'filter' => IblockType::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'iblockType.name',
            ],
            'code',
            'name',
            [
                'attribute' => 'active',
                'filter' => array('1'=>'Да','0'=>'Нет'),
                'value' => 'active',
            ],
            'sort',
            // 'list_page_url:url',
            // 'detail_page_url:url',
            // 'section_page_url:url',
            // 'canonical_page_url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
