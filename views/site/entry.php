<?php
Use yii\helpers\Html;
Use yii\widgets\ActiveForm;
?>
<?php $form = ACtiveForm::begin(); ?>

    <?= $form->field($model, 'name')?>

    <?= $form->field($model, 'email')?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class'=> 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end();?>

