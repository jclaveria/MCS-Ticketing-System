<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'username',
            'password',
            'user_type',
            'fname',
            // 'lname',
            // 'mname',
            // 'birthdate',
            // 'position_id',
            // 'created_by',
            // 'created_date',
            // 'updated_by',
            // 'updated_date',
            // 'disabled',
            // 'authKey',
            // 'accessToken',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
