<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Entri Data - Risk Control Plan Detail</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>rcpStatus/add_detail" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<?php echo validation_errors(); ?>
							<div class="form-group">
								<span class="section">Pilih tahun untuk di entri</span>
								<div class="row">
									<div class="col-md-3 col-xs-6">
										<input type="text" class="form-control" name="year" placeholder="year (ex. 2019)">
									</div>
								</div>
								<div class="row">
									<hr />
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Risk</label>
									<select name="risk" class="form-control">
										<option value="">-- Select Risk --</option>
										<option value="Assets & Liabilities Risk">Assets & Liabilities Risk</option>
										<option value="Board Management Risk">Board Management Risk</option>
										<option value="Governance Risk">Governance Risk</option>
										<option value="Insurance Risk">Insurance Risk</option>
										<option value="Integrated Risk Management">Integrated Risk Management</option>
										<option value="Operational Risk">Operational Risk</option>
										<option value="Risk of Financial Support (Capital Funding)">Risk of Financial Support (Capital Funding)</option>
										<option value="Strategy Risk">Strategy Risk</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Project Task</label>
									<textarea class="form-control" name="project_task"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Task Owner</label>
									<input type="text" class="form-control" name="task_owner" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Est. Complete Date</label>
									<input type="text" class="form-control" name="est_complete_date" placeholder="dd-MMM-yy (ex. 01-Jan-19)">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label>Actual Complete Date</label>
									<input type="text" class="form-control" name="actual_complete_date" placeholder="dd-MMM-yy (ex. 01-Jan-19)">
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
									<textarea class="form-control" name="comment"></textarea>
								</div>
							</div>
							<input type="submit" class="btn btn-primary col-md-2" value="Upload" style="float: right;">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
