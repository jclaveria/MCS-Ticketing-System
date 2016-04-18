<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TasksattachmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasksattachment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'attachment_id') ?>

    <?= $form->field($model, 'file_destination') ?>

    <?= $form->field($model, 'file_extension') ?>

    <?= $form->field($model, 'tasks_id') ?>

    <?= $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'users_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
