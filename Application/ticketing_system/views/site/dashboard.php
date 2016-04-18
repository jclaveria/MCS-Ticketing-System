<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Homepage';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode('Welcome '.$fullName) ?></h1>
	
	<div class="row">
	
	  <section class="col-md-8">
	  
		 <div class="panel-group">
		  <div class="panel panel-primary">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse1">Tickets Currently Assigned to You</a>
			  </h4>
			</div>
			<div id="collapse1" class="panel">
			  <div class="panel-body">
				
				<table class="table">
		        <thead>
		          <tr>
		            <th>#</th>
		            <th>Summary</th>
		            <th>Status</th>
		            <th>Deadline</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<?php foreach ($tasksOfUser as $task) { ?>
						
						<tr>
			            <th scope="row">
			            	<?= Html::a($task->task_id, ['tasks/view', 'id' => $task->task_id]) ?>
			            </th>
			            <td>
			            	<?= Html::a($task->summary, ['tasks/view', 'id' => $task->task_id]) ?>
			            </td>
			            <td><?= $task->status->name ?></td>
			            <td><?= $task->scheduled_date ?></td>
			          </tr>

					<?php } ?>
		        	
		        </tbody>
		      </table>
			  
			  
			  </div>
			</div>
		  </div>
		</div>
	  
	  </section>
	  
	  
	  <!-- Sidebar -->
	  <section class="col-md-4">
		
		<div class="panel list-group">
			
			
		 <a href="#" class="list-group-item" 
		    data-toggle="collapse" data-target="#tix" 
		    data-parent="#menu">Ticket Functions<span class="glyphicon glyphicon-flash pull-right"></span>
		 </a>
		 <div id="tix" class="sublinks">
		  <a class="list-group-item small" href="<?= Url::to(['tasks/index']); ?>"><span class="glyphicon glyphicon-chevron-right"></span> Search for a Task</a>
		 </div>
		 
		</div>
		
	  </section>
	
	</div>
</div>
