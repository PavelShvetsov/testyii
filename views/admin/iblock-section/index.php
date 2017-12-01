<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \app\models\admin\Iblock;
use \app\models\admin\IblockSection;

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
            [
                'attribute' => 'iblock_id',
                'filter' => Iblock::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'iblock.name',
            ],
            'code',
            'name',
            [
                'attribute' => 'active',
                'filter' => array('1'=>'Да','0'=>'Нет'),
                'value' => 'active',
            ],
            [
                'attribute' => 'iblock_section_id',
                'filter' => IblockSection::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'parent.name',
            ],
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
