<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Tasks */

$this->title = $model->summary;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $TASK_ID =  $model->task_id; ?>

<div class="tasks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-12">
             <?= Html::a('Update', ['update', 'id' => $model->task_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->task_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>

        <?php if( $isAdmin ): ?>
        <?php $reporturl = Url::to(['reports/tasklog', 'task_id' => $model->task_id, 'type' => 'html']);?>
        <a class="btn btn-info" target="_blank" href="<?= $reporturl ?>">Generate Task Log Report</a>
        <?php endif; ?>

        </div>
    </div>

     <div class="row">
        <div class="col-md-12">
             <br/>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Ticket Details</div>
            <div class="panel-body">
           
            <form class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <p class="form-control-static"><?= $model->description ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                  <p class="form-control-static"><?= $model->status->name ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Client</label>
                <div class="col-sm-10">
                  <p class="form-control-static"><?= $model->client->name ?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Task Category</label>
                <div class="col-sm-10">
                  <p class="form-control-static"><?= $model->task_category ?></p>
                </div>
              </div>

              <?php if( $isAdmin ): ?>
              <div class="form-group">
                <label class="col-sm-2 control-label">Project Value (For Admin)</label>
                <div class="col-sm-10">
                  <p class="form-control-static"><?= $model->project_value ?></p>
                </div>
              </div>
            <?php endif; ?>

            </form>
            </div>
         </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Task Info</div>
                <div class="panel-body">

                     <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Assignee</label>
                        <div class="col-sm-5">
                          <p class="form-control-static"><?= $model->assignee0->fullname ?></p>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-5 control-label">Task Owner</label>
                        <div class="col-sm-5">
                          <p class="form-control-static"><?= $model->taskOwner->fullname ?></p>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-5 control-label">Start Date</label>
                        <div class="col-sm-5">
                          <p class="form-control-static"><?= $model->start_date ?></p>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-5 control-label">Scheduled Date</label>
                        <div class="col-sm-5">
                          <p class="form-control-static"><?= $model->scheduled_date ?></p>
                        </div>
                      </div>

                     </form>

                </div>
            </div>
         </div>

     
      </div>
      
      
      <div class="row">
      <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
				<h3 class="panel-title pull-left">Attachments</h3>

				<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myUploadModal">
				  Add Attachment
				</button>
				
				<div class="clearfix"></div>
            </div>
           
			  <!-- List group -->
			  <ul class="list-group">
        
        <?php foreach( $model->tasksAttachments as $attachment ): ?>

          <li class="list-group-item">
            <a href="uploads/<?= $TASK_ID ?>/<?= $attachment->file_destination ?>.<?= $attachment->file_extension ?>"> <?= $attachment->file_destination ?>.<?= $attachment->file_extension ?> </a>
          </li>

        <?php endforeach; ?>

			  </ul>
         </div>
        </div>
        </div>
      
      
        <div class="row">
			<div class="col-md-12">
				
				
				<div class="panel panel-default">
                <div class="panel-heading">
					<h3 class="panel-title pull-left">Conversation</h3>

					<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal">
					  New Comment
					</button>
					
					<div class="clearfix"></div>
                </div>
                <div class="panel-body">
					
					
				<?php foreach( $model->comments as $comment ): ?>
				
					<div class="panel panel-default">
					  <div class="panel-body">
						<b><?php echo ( $comment->userfk->fname).' , '.( $comment->userfk->lname); ?></b>
						
						<?php
						
							$date = strtotime($comment->created_date);
							$new_date = date('Y-m-d h:i A', $date);
							

						?>
						
						<i> <?php echo ( $new_date ); ?> </i><br/><br/>
						
						<p><?php echo ( $comment->text ); ?></p>
					  </div>
					</div>

				<?php endforeach; ?>
					
				</div>
				</div>
				
				
			</div>
		</div>

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<form id="comment submit" method="POST" action="<?php echo $postcomment; ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Comment</h4>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="message-text" class="control-label">Comment</label>
            <textarea name="comment" class="form-control" id="message-text"></textarea>
            <input type="hidden" name="task_id" value="<?php echo $model->task_id; ?>" />
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myUploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Attachment</h4>
      </div>
      <div class="modal-body">
        
          <?php
          $url = Url::to(['tasks/upload', 'task_id' => $TASK_ID]);
          $homepage = file_get_contents("http://".$_SERVER['SERVER_NAME'].$url);
          echo $homepage;
          ?>
        
      </div>
    </div>
    
  </div>
</div>
