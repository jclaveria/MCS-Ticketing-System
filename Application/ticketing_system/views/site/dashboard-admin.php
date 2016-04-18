<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
	
	<div class="row">
	
	  <section class="col-md-10">
	  
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
		            <th>Assignee</th>
		            <th>Task Owner</th>
		            <th>Task Start Date</th>
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
			            <td><?= $task->assignee0->username ?></td>
			            <td><?= $task->taskOwner->username ?></td>
			            <td><?= $task->start_date ?></td>
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
	  <section class="col-md-2">
		
		<div class="panel list-group">

		<a href="#" class="list-group-item" 
		    data-toggle="collapse" data-target="#tix" 
		    data-parent="#menu">Ticket Functions<span class="glyphicon glyphicon-flash pull-right"></span>
		 </a>
		 <div id="tix" class="sublinks">
		  <a class="list-group-item small" href="<?= Url::to(['tasks/create']); ?>"><span class="glyphicon glyphicon-chevron-right"></span> Create a Task</a>
		  <a class="list-group-item small" href="<?= Url::to(['tasks/index']); ?>"><span class="glyphicon glyphicon-chevron-right"></span> Search for a Task</a>
		 </div>
			
		 <a href="#" class="list-group-item" 
		    data-toggle="collapse" data-target="#admins" 
		    data-parent="#menu">Admin Features<span class="glyphicon glyphicon-cog pull-right"></span></a>
		 <div id="admins" class="sublinks collapse">
		  <a class="list-group-item small" href="<?= Url::to(['clients/index']); ?>" ><span class="glyphicon glyphicon-chevron-right"></span> Manage Clients</a>
		  <a class="list-group-item small" href="<?= Url::to(['positions/index']); ?>" ><span class="glyphicon glyphicon-chevron-right"></span> Manage Positions</a>
		  <a class="list-group-item small" href="<?= Url::to(['status/index']); ?>" ><span class="glyphicon glyphicon-chevron-right"></span> Manage Status</a>
		  <a class="list-group-item small" href="<?= Url::to(['users/index']); ?>"><span class="glyphicon glyphicon-chevron-right"></span> Manage Users</a>
		 </div>
		 
		 <a href="#" class="list-group-item" 
		    data-toggle="collapse" data-target="#reps" 
		    data-parent="#menu">Reports<span class="glyphicon glyphicon-signal pull-right"></span></a>
		 <div id="reps" class="sublinks collapse">
		  <a style="cursor:pointer" class="list-group-item small" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-chevron-right"></span> Create Task Report</a>
		 </div>
		 
		</div>
		
	  </section>
	
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Task Report</h4>
      </div>
      <div class="modal-body">
        
        <form class="form-horizontal">
		  <div class="form-group">
		    <label for="startdate" class="col-sm-2 control-label">Start Date</label>
		    <div class="col-sm-10">
		      <input type="date" format="yyyy-mm-dd" class="form-control" id="startdate" placeholder="Start Date">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="enddate" class="col-sm-2 control-label">End Date</label>
		    <div class="col-sm-10">
		      <input type="date" format="yyyy-mm-dd" class="form-control" id="enddate" placeholder="End Date">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="rep_type" class="col-sm-2 control-label">Type</label>
		    <div class="col-sm-10">
		      <select class="form-control" id="rep_type">
				    <option value="html">HTML Only</option>
				    <option value="export">Export to Word File</option>
				</select>
		    </div>
		  </div>
		</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="generateTaskReport">Save changes</button>
      </div>
    </div>
  </div>
</div>