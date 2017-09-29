<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//echo '<pre>';print_r($modelAttr);echo '</pre>';
//echo '<pre>';print_r($attrs);echo '</pre>';

?>
<?php echo Yii::$app->session->getFlash('success'); ?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<h3>Свойства пользователя</h3>
<?php
    /*foreach ($attrs as $attr){
        echo $form->field($modelAttr, $attr['name'])->textInput()->label($attr['label']);
    }*/
/*foreach ($modelAttr as $index => $setting) {
    echo $form->field($setting, "[$index]name")->label($setting->label);
}*/
?>
    <div class="form-group">
        <div>
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>