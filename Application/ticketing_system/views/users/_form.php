<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use app\models\Positions;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_type')->dropDownList([ 'user' => 'User', 'admin' => 'Admin', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mname')->textInput(['maxlength' => true]) ?>

    <?= 
        $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
                       'clientOptions' => [
                       'language' => 'en',
                       'class' => 'form-control'
                       ],
                       'dateFormat' => 'yyyy-MM-dd'
                    ])
    ?>



     <?= $form->field( $model, 'position_id')->dropDownList(
        ArrayHelper::map( Positions::find()->all(), 'position_id', 'name' ),
        [ 'prompt' => '' ]
        ) ?>

    <?= Html::activeHiddenInput($model, 'created_by') ?>

    <?= Html::activeHiddenInput($model, 'created_date') ?>

    <?= Html::activeHiddenInput($model, 'updated_by') ?>

    <?= Html::activeHiddenInput($model, 'updated_date')?>

    <?= Html::activeHiddenInput($model, 'disabled') ?>

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
