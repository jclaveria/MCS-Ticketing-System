<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'MCS Ticketing System';
?>
<div class="site-index">

    <div class="jumbotron">

        <p class="lead">Welcome to MCS Task Ticketing System</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['site/login']); ?>">Login to Ticketing System</a></p>

        <p><a class="btn btn-lg btn-info" href="uploads/install/ticketing.apk">Download Companion App</a></p>

        
    </div>
    
</div>
