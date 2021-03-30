<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Entri Data - Risk Control Plan</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>rcpStatus/add" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<?php echo validation_errors(); ?>
							<div class="form-group">
								<span class="section">Pilih periode untuk di entri</span>
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
								<div class="col-md-4">
									<label>Risk Category</label>
									<input type="text" class="form-control" value="Board Management Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Governance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Strategy Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Operational Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Assets& Liabilities Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Risk of Financial Support (Capital Funding)" readonly>
									<br />
									<input type="text" class="form-control" value="Integrated Risk Management" readonly>
								</div>
								<div class="col-md-2">
									<label>Done</label>
									<input type="text" class="form-control" name="done[0]">
									<br />
									<input type="text" class="form-control" name="done[1]">
									<br />
									<input type="text" class="form-control" name="done[2]">
									<br />
									<input type="text" class="form-control" name="done[3]">
									<br />
									<input type="text" class="form-control" name="done[4]">
									<br />
									<input type="text" class="form-control" name="done[5]">
									<br />
									<input type="text" class="form-control" name="done[6]">
									<br />
									<input type="text" class="form-control" name="done[7]">
								</div>
								<div class="col-md-2">
									<label>In Progress</label>
									<input type="text" class="form-control" name="in_progress[0]">
									<br />
									<input type="text" class="form-control" name="in_progress[1]">
									<br />
									<input type="text" class="form-control" name="in_progress[2]">
									<br />
									<input type="text" class="form-control" name="in_progress[3]">
									<br />
									<input type="text" class="form-control" name="in_progress[4]">
									<br />
									<input type="text" class="form-control" name="in_progress[5]">
									<br />
									<input type="text" class="form-control" name="in_progress[6]">
									<br />
									<input type="text" class="form-control" name="in_progress[7]">
								</div>
								<div class="col-md-2">
									<label>Not Yet Started</label>
									<input type="text" class="form-control" name="not_yet_started[0]">
									<br />
									<input type="text" class="form-control" name="not_yet_started[1]">
									<br />
									<input type="text" class="form-control" name="not_yet_started[2]">
									<br />
									<input type="text" class="form-control" name="not_yet_started[3]">
									<br />
									<input type="text" class="form-control" name="not_yet_started[4]">
									<br />
									<input type="text" class="form-control" name="not_yet_started[5]">
									<br />
									<input type="text" class="form-control" name="not_yet_started[6]">
									<br />
									<input type="text" class="form-control" name="not_yet_started[7]">
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
