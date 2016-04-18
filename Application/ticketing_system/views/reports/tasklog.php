<?php use yii\helpers\Url; ?>

<html>
<head>
<style>
table, p{ font-size:12px; }
</style>
</head>

<body>

<center>
<h1>Task Log Report</h1>

<p>
    Task log for Task #<?= $_GET["task_id"] ?>
</p>

</center>
<br/><br/>


    <table border=1 width=800px>
        <colgroup>
            <col style="width:60%">
            <col style="width:20%">
            <col style="width:20%">
        </colgroup>
          
        <thead>
            <th>Action</th>
            <th>User</th>
            <th>Date of log</th>
        </thead>
        <tbody>
    
    <?php foreach($task->auditLogs as $log): ?>
        
        <tr>
            <td><?= $log->audit_action ?></td>
            <td><?= $log->auditUser->fullName ?></td>
            <td><?= $log->created_date ?></td>
        </tr>

    <?php endforeach; ?>
    
    </tbody>
    </table>

<br><br><br>
<p style="font-size:0.8em">This is a generated report from Microfix Ticketing System. Any alteration made to this report without prior approval to management is punishable by law. If you are not authorized please remove this report immediately on your computer</p>
<br/>
<p style="font-size:0.8em">Microfix 2015. All Rights Reserved</p>
<br>

<div style="font-size:0.8em;<?php if($_GET['type']=='export'){ echo 'display:none'; } ?>">

<b>Print Options</b><br>
<?php $url = Url::to(['reports/tasklog', 'task_id' => $_GET["task_id"], 'type' => 'export']);?>
<a href="<?= $url ?>">Export to Word</a>

<a href="javascript:window.print();">Print Page</a>
</div>

</body>
</html>