<?php
use yii\widgets\ActiveForm;
?>

<div id="upload-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>
    
    <?= $form->field($model, 'task_id')->hiddenInput(['value' => $task_id])->label(false) ?>
    
    <button>Submit</button>

<?php ActiveForm::end() ?>

</div>
