<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tasksattachment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasksattachment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file_destination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_extension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tasks_id')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'users_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
