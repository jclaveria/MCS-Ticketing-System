<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tasksattachment */

$this->title = 'Update Tasksattachment: ' . ' ' . $model->attachment_id;
$this->params['breadcrumbs'][] = ['label' => 'Tasksattachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->attachment_id, 'url' => ['view', 'id' => $model->attachment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tasksattachment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
