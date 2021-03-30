<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Entri Data - Unrealized Gain Loss</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>unrealizedGainLosses/add" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<?php echo validation_errors(); ?>
							<div class="form-group">
								<span class="section">Pilih periode untuk di entri</span>
								<div class="row">
									<div class="col-md-3 col-xs-6">
										<select name="week" class="form-control">
											<option value="">-- Select Week --</option>
											<option value="W-1">Week 1</option>
											<option value="W-2">Week 2</option>
											<option value="W-3">Week 3</option>
											<option value="W-4">Week 4</option>
										</select>
									</div>
									<div class="col-md-3 col-xs-6">
										<select name="month" class="form-control">
											<option value="">-- Select Month --</option>
											<option value="Jan">January</option>
											<option value="Feb">February</option>
											<option value="Mar">March</option>
											<option value="Apr">April</option>
											<option value="May">May</option>
											<option value="Jun">June</option>
											<option value="Jul">July</option>
											<option value="Aug">August</option>
											<option value="Sep">September</option>
											<option value="Oct">October</option>
											<option value="Nov">November</option>
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
								<div class="col-md-3">
									<label>Dashboard</label>
									<input type="text" class="form-control" value="Equities" readonly>
									<br />
									<input type="text" class="form-control" value="Bonds" readonly>
									<br />
									<input type="text" class="form-control" value="Mutual Funds" readonly>
								</div>
								<div class="col-md-3">
									<label>Closing</label>
									<input type="text" class="form-control" name="equities_closing" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="bonds_closing" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="mf_closing" placeholder="amount (ex. 123.45)">
								</div>
								<div class="col-md-3">
									<label>Actual</label>
									<input type="text" class="form-control" name="equities_actual" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="bonds_actual" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="mf_actual" placeholder="amount (ex. 123.45)">
								</div>
								<div class="col-md-3">
									<label>Unrealized</label>
									<input type="text" class="form-control" name="equities_unrealized" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="bonds_unrealized" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="mf_unrealized" placeholder="amount (ex. 123.45)">
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
