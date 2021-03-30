<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Entri Data - Asset Allocation(Limit)</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>investmentAssets/add_asset_allocation_limit" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<?php echo validation_errors(); ?>
							<div class="form-group">
								<span class="section">Pilih tahun untuk di entri</span>
								<div class="row">
									<div class="col-md-3 col-xs-12">
										<input type="text" class="form-control" name="year" placeholder="year (ex. 2019)">
									</div>
								</div>
								<div class="row">
									<hr />
								</div>
							</div>
							<div class="form-group">
								<h4>Value</h4>
								<div class="col-md-4">
									<label>Aset</label>
									<input type="text" class="form-control" value="Equity" readonly>
									<br />
									<input type="text" class="form-control" value="Time Deposit" readonly>
									<br />
									<input type="text" class="form-control" value="Bonds" readonly>
									<br />
									<input type="text" class="form-control" value="Mutual Fund" readonly>
									<br />
									<input type="text" class="form-control" value="Direct Investment" readonly>
								</div>
								<div class="col-md-4">
									<label>Amount</label>
									<input type="text" class="form-control" name="equity" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="time_deposit" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="bonds" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="mutual_fund" placeholder="amount (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="direct_investment" placeholder="amount (ex. 123.45)">
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
