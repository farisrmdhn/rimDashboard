<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Entri Data - Bond Allocation</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>bondAllocations/add" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<?php echo validation_errors(); ?>
							<div class="form-group">
								<span class="section">Pilih periode untuk di entri</span>
								<div class="row">
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
								<h4>Direct Bond</h4>
								<div class="col-md-4">
									<label>Bond</label>
									<input type="text" class="form-control" value="Corporate non SOE" readonly>
									<br />
									<input type="text" class="form-control" value="Government IDR" readonly>
									<br />
									<input type="text" class="form-control" value="Government USD" readonly>
									<br />
									<input type="text" class="form-control" value="SOE IDR" readonly>
									<br />
									<input type="text" class="form-control" value="SOE IDR - Infrastructure" readonly>
									<br />
									<input type="text" class="form-control" value="SOE USD" readonly>
									<br />
									<input type="text" class="form-control" value="SOE USD - Infrastructure" readonly>
									<br />
									<input type="text" class="form-control" value="Total Bond" readonly>
									<br />
									<input type="text" class="form-control" value="Total Investment Portfolio Traditional & SHF" readonly>
								</div>
								<div class="col-md-4">
									<label>Amount</label>
									<input type="text" class="form-control" name="db_1" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="db_2" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="db_3" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="db_4" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="db_5" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="db_6" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="db_7" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="db_8" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="db_9" placeholder="amount (ex. 123.45)">
								</div>
							</div>
							<div class="form-group">
								<h4>Direct Bond + MF</h4>
								<div class="col-md-4">
									<label>Bond</label>
									<input type="text" class="form-control" value="Corporate non SOE" readonly>
									<br />
									<input type="text" class="form-control" value="Government IDR" readonly>
									<br />
									<input type="text" class="form-control" value="Government USD" readonly>
									<br />
									<input type="text" class="form-control" value="SOE IDR" readonly>
									<br />
									<input type="text" class="form-control" value="SOE IDR - Infrastructure" readonly>
									<br />
									<input type="text" class="form-control" value="SOE USD" readonly>
									<br />
									<input type="text" class="form-control" value="SOE USD - Infrastructure" readonly>
									<br />
									<input type="text" class="form-control" value="Total Bond" readonly>
									<br />
									<input type="text" class="form-control" value="Total Investment Portfolio Traditional & SHF" readonly>
								</div>
								<div class="col-md-4">
									<label>Amount</label>
									<input type="text" class="form-control" name="dbmf_1" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="dbmf_2" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="dbmf_3" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="dbmf_4" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="dbmf_5" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="dbmf_6" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="dbmf_7" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="dbmf_8" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="dbmf_9" placeholder="amount (ex. 123.45)">
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
