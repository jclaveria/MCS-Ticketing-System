<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AuditLogs */

$this->title = 'Create Audit Logs';
$this->params['breadcrumbs'][] = ['label' => 'Audit Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audit-logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
