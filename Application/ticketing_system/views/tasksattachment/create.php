<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tasksattachment */

$this->title = 'Create Tasksattachment';
$this->params['breadcrumbs'][] = ['label' => 'Tasksattachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasksattachment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
