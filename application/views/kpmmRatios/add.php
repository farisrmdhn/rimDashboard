<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Entri Data - KPMM Ratio</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>kpmmRatios/add" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<?php echo validation_errors(); ?>
							<div class="form-group">
								<span class="section">Pilih periode untuk di entri</span>
								<div class="row">
									<div class="col-md-3 col-xs-6">
										<select name="month" class="form-control">
											<option value="">-- Select Month --</option>
											<option value="Mar">March</option>
											<option value="Jun">June</option>
											<option value="Sep">September</option>
											<option value="Dec">December</option>
										</select>
									</div>
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
									<label>Component</label>
									<input type="text" class="form-control" value="Actual Capital" readonly>
									<br />
									<input type="text" class="form-control" value="Minimum Capital" readonly>
									<br />
									<input type="text" class="form-control" value="KPMM Integrated Ratio" readonly>
								</div>
								<div class="col-md-4">
									<label>Score</label>
									<input type="text" class="form-control" name="actual_capital" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="min_capital" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="kpmm" placeholder="precentage (ex 0.6, 1 = 100%)">
									<br />
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
