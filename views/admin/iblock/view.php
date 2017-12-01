<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\admin\Iblock */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Iblocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="iblock-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'iblock_type_id',
            'code',
            'name',
            'active',
            'sort',
            'list_page_url:url',
            'detail_page_url:url',
            'section_page_url:url',
            'canonical_page_url:url',
        ],
    ]) ?>

</div>
