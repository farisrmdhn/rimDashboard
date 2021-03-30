<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Edit Data - Risk Control Plan Detail</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>rcpStatus/edit_detail/<?php echo $detail['id']?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<?php echo validation_errors(); ?>
							<div class="form-group">
								<div class="col-md-6">
									<label>Risk</label>
									<input type="text" class="form-control" value="<?php echo $detail['risk']?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Project Task</label>
									<textarea class="form-control" readonly><?php echo $detail['project_task']?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Task Owner</label>
									<input type="text" class="form-control" value="<?php echo $detail['task_owner']?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Est. Complete Date</label>
									<input type="text" class="form-control" value="<?php echo $detail['est_complete_date']?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Actual Complete Date</label>
									<input type="text" class="form-control" name="actual_complete_date" value="<?php echo $detail['actual_complete_date']?>">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Status</label>
									<select name="status" class="form-control">
										<option value="">--Select Status--</option>
										<option value="Done">Done</option>
										<option value="In Progress">In Progress</option>
										<option value="Not Yet Started">Not Yet Started</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Comment</label>
									<textarea class="form-control" name="comment"><?php echo $detail['comment']?></textarea>
								</div>
							</div>
							<input type="hidden" name="id" value="<?php echo $detail['id']?>">
							<input type="submit" class="btn btn-primary col-md-2" value="Edit" style="float: right;">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
