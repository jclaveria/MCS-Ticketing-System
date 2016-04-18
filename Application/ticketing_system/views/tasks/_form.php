<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
use app\models\Status;
use app\models\Clients;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Ticket Details</div>
            <div class="panel-body">

                <?= $form->field($model, 'summary')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows'=>2,'cols'=>5]) ?>

                <?= $form->field( $model, 'assignee')->dropDownList(
                ArrayHelper::map( Users::find()->all(), 'user_id', 'username' ),
                [ 'prompt' => '' ]
                ) ?>

                 <?= $form->field( $model, 'task_owner')->dropDownList(
                ArrayHelper::map( Users::find()->all(), 'user_id', 'username' ),
                [ 'prompt' => '' ]
                ) ?>

                <?= $form->field($model, 'task_category')->textInput(['maxlength' => true]) ?>

                <?= $form->field( $model, 'status_id')->dropDownList(
                ArrayHelper::map( Status::find()->all(), 'status_id', 'name' ),
                [ 'prompt' => '' ]
                ) ?>

                <?= $form->field( $model, 'client_id')->dropDownList(
                ArrayHelper::map( Clients::find()->all(), 'client_id', 'name' ),
                [ 'prompt' => '' ]
                ) ?>


                 <?= $form->field($model, 'project_value')->textInput(['maxlength' => true]) ?>

            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Scheduling</div>
            <div class="panel-body">
                <?=
                    $form->field($model, 'start_date')->widget(DatePicker::classname(), [
                       'clientOptions' => [
                       'language' => 'en',
                       'class' => 'form-control'
                       ],
                       'dateFormat' => 'yyyy-MM-dd'
                    ]) ?>


                     <?=
                    $form->field($model, 'scheduled_date')->widget(DatePicker::classname(), [
                       'clientOptions' => [
                       'language' => 'en',
                       'class' => 'form-control'
                       ],
                       'dateFormat' => 'yyyy-MM-dd'
                    ]) ?>

          </br>

            <div style="display:none">
             
                <?= $form->field($model, 'created_date')->textInput() ?>

                <?= $form->field($model, 'created_by')->textInput() ?>

                <?= $form->field($model, 'updated_date')->textInput() ?>

                <?= $form->field($model, 'updated_by')->textInput() ?>
              </div>
           

            </div>
        </div>
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script type="text/javascript">
      $.datepicker.setDefaults({
          dateFormat: 'yy-mm-dd'
      });
    </script>

</div>
