<?php use yii\helpers\Url; ?>

<html>
<head>
<style>
table, p{ font-size:12px; }
</style>
</head>

<body>

<center>
<h1>Individual Task Report</h1>

<p>
    Individual reporting of users' task done from <?= $_GET["startdate"] ?> to <?= $_GET["enddate"] ?>
</p>
</center>
<br/><br/>

<?php foreach($usertasks as $usertask): ?>

<h4><?= $usertask->fullname ?></h4>

    <table border=1 width=800px>
        <colgroup>
            <col style="width:10%">
            <col style="width:45%">
            <col style="width:15%">
            <col style="width:15%">
            <col style="width:15%">
        </colgroup>
          
        <thead>
            <th>Task ID</th>
            <th>Title</th>
            <th>Status</th>
            <th>Scheduled Date</th>
            <th>Value</th>
        </thead>
        <tbody>
    
    <?php foreach($usertask->tasks as $task): ?>
        
        <?php if(strtotime( $task->scheduled_date ) >=  strtotime(  $_GET["startdate"] ) && strtotime( $task->scheduled_date ) <=  strtotime(  $_GET["enddate"] ) ){ ?>

        <tr>
            <td><?= $task->task_id ?></td>
            <td><?= $task->summary ?></td>
            <td><?= $task->status->name ?></td>
            <td><?= $task->scheduled_date ?></td>
            <td><?= $task->project_value ?></td>
        </tr>

        <?php } ?>

    <?php endforeach; ?>
    
    </tbody>
    </table>


<?php endforeach; ?>
<br><br><br>
<p style="font-size:0.8em">This is a generated report from Microfix Ticketing System. Any alteration made to this report without prior approval to management is punishable by law. If you are not authorized please remove this report immediately on your computer</p>
<br/>
<p style="font-size:0.8em">Microfix 2015. All Rights Reserved</p>
<br>

<div style="font-size:0.8em;<?php if($_GET['type']=='export'){ echo 'display:none'; } ?>">

<b>Print Options</b><br>
<?php $url = Url::to(['reports/index', 'startdate' => $_GET["startdate"], 'enddate' => $_GET["enddate"], 'type' => 'export']);?>
<a href="<?= $url ?>">Export to Word</a>

<a href="javascript:window.print();">Print Page</a>
</div>

</body>
</html>