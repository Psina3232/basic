<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Status;

/** @var yii\web\View $this */
/** @var app\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php
    
    $status = Status::find()
        ->where(['id' => [2,3]])
        ->select(['name'])
        ->indexBy('id')
        ->column();

    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_status')->dropdownList($status, ['id' => 'status']) ?>

   

    <div class="form-group">
        <?= Html::submitButton('Обновить статус', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
