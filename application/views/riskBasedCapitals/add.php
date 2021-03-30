<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Entri Data - Risk Based Capitals</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>riskBasedCapitals/add" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<?php echo validation_errors(); ?>
							<div class="form-group">
								<span class="section">Pilih periode untuk di entri</span>
								<div class="row">
									<p>* Wajib Diisi</p>
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
									<p>* Hanya isi yang ingin ditambah / di replace</p>
								</div>
							</div>
							<div class="form-group">
								<h4>RBC Conventional</h4>
								<div class="col-md-4">
									<label>Component</label>
									<input type="text" class="form-control" value=".RBC" readonly>
									<br />
									<input type="text" class="form-control" value="1. Solvability" readonly>
									<br />
									<input type="text" class="form-control" value="1. Solvability" readonly>
									<br />
									<input type="text" class="form-control" value="1a. Admitted Asset" readonly>
									<br />
									<input type="text" class="form-control" value="1a. Admitted Asset" readonly>
									<br />
									<input type="text" class="form-control" value="1b. Liabilities" readonly>
									<br />
									<input type="text" class="form-control" value="1b. Liabilities" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2a. Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2a. Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2a. Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2b. Liquidity Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2b. Liquidity Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2c. Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2c. Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2c. Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2d. Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2d. Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2d. Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2d. Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2e. Operational Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2e. Operational Risk" readonly>
								</div>


								<div class="col-md-4">
									<label>Detail</label>
									<input type="text" class="form-control" value="RBC" readonly>
									<br />
									<input type="text" class="form-control" value="Admittted Asset" readonly>
									<br />
									<input type="text" class="form-control" value="Liabilities" readonly>
									<br />
									<input type="text" class="form-control" value="traditional" readonly>
									<br />
									<input type="text" class="form-control" value="PAYDI" readonly>
									<br />
									<input type="text" class="form-control" value="traditional" readonly>
									<br />
									<input type="text" class="form-control" value="PAYDI" readonly>
									<br />
									<input type="text" class="form-control" value="Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Liquidity Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Operational Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Investment Default Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Non Investment Default Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Reinsurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Liability Mismatch Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Premium Reserve PAYDI" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Default Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Currency Mismatch Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Interest Rate Changes" readonly>
									<br />
									<input type="text" class="form-control" value="Premium Reserve" readonly>
									<br />
									<input type="text" class="form-control" value="Unearned Premium Reserve " readonly>
									<br />
									<input type="text" class="form-control" value="Claim Reserve" readonly>
									<br />
									<input type="text" class="form-control" value="Catastrophic Reserve" readonly>
									<br />
									<input type="text" class="form-control" value="Operational Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Operational Risk PAYDI" readonly>
								</div>


								<div class="col-md-4">
									<label>Score</label>
									<input type="text" class="form-control" name="score_array[0]" placeholder="precentage ( tanpa presentase, ex. 7.89, 1 = 100 %)">
									<br />
									<input type="text" class="form-control" name="score_array[1]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[2]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[3]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[4]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[5]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[6]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[7]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[8]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[9]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[10]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[11]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[12]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[13]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[14]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[15]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[16]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[17]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[18]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[19]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[20]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[21]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[22]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[23]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[24]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[25]" placeholder="score (ex. 123.45)">
								</div>
							</div>
							<hr />
							<div class="form-group">
								<h4>RBC Sharia Tabarru</h4>
								<div class="col-md-4">
									<label>Component</label>
									<input type="text" class="form-control" value=".RBC" readonly>
									<br />
									<input type="text" class="form-control" value="1. Solvability" readonly>
									<br />
									<input type="text" class="form-control" value="1. Solvability" readonly>
									<br />
									<input type="text" class="form-control" value="1a. Admitted Asset" readonly>
									<br />
									<input type="text" class="form-control" value="1b. Liabilities" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2a. Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2a. Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2a. Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2b. Liquidity Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2c. Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2c. Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2c. Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2d. Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2d. Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2d. Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2d. Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2e. Operational Risk" readonly>
								</div>


								<div class="col-md-4">
									<label>Detail</label>
									<input type="text" class="form-control" value="RBC Tabarru" readonly>
									<br />
									<input type="text" class="form-control" value="Admittted Asset" readonly>
									<br />
									<input type="text" class="form-control" value="Liabilities" readonly>
									<br />
									<input type="text" class="form-control" value="Admittted Asset" readonly>
									<br />
									<input type="text" class="form-control" value="Liabilities" readonly>
									<br />
									<input type="text" class="form-control" value="Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Liquidity Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Operational Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Investment Default Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Non Investment Default Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Reinsurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Liability Mismatch Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Default Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Currency Mismatch Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Interest Rate Changes" readonly>
									<br />
									<input type="text" class="form-control" value="Premium Reserve" readonly>
									<br />
									<input type="text" class="form-control" value="Unearned Premium Reserve " readonly>
									<br />
									<input type="text" class="form-control" value="Claim Reserve" readonly>
									<br />
									<input type="text" class="form-control" value="Catastrophic Reserve" readonly>
									<br />
									<input type="text" class="form-control" value="Operational Risk Tabarru" readonly>
								</div>


								<div class="col-md-4">
									<label>Score</label>
									<input type="text" class="form-control" name="score_array[26]" placeholder="precentage ( tanpa presentase, ex. 7.89)">
									<br />
									<input type="text" class="form-control" name="score_array[27]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[28]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[29]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[30]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[31]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[32]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[33]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[34]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[35]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[36]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[37]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[38]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[39]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[40]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[41]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[42]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[43]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[44]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[45]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[46]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[47]" placeholder="score (ex. 123.45)">
								</div>
							</div>
							<hr />
							<div class="form-group">
								<h4>RBC Sharia SHF</h4>
								<div class="col-md-4">
									<label>Component</label>
									<input type="text" class="form-control" value=".RBC" readonly>
									<br />
									<input type="text" class="form-control" value="1. Solvability" readonly>
									<br />
									<input type="text" class="form-control" value="1. Solvability" readonly>
									<br />
									<input type="text" class="form-control" value="1a. Admitted Asset" readonly>
									<br />
									<input type="text" class="form-control" value="1b. Liabilities" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2. MMBR" readonly>
									<br />
									<input type="text" class="form-control" value="2a. Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2a. Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2a. Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2b. Liquidity Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2c. Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2c. Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2c. Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="2e. Operational Risk" readonly>
								</div>


								<div class="col-md-4">
									<label>Detail</label>
									<input type="text" class="form-control" value="RBC SHF" readonly>
									<br />
									<input type="text" class="form-control" value="Admittted Asset" readonly>
									<br />
									<input type="text" class="form-control" value="Liabilities" readonly>
									<br />
									<input type="text" class="form-control" value="Admittted Asset" readonly>
									<br />
									<input type="text" class="form-control" value="Liabilities" readonly>
									<br />
									<input type="text" class="form-control" value="Credit Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Liquidity Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Market Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Insurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Operational Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Investment Default Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Non Investment Default Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Reinsurance Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Liability Mismatch Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Asset Default Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Currency Mismatch Risk" readonly>
									<br />
									<input type="text" class="form-control" value="Interest Rate Changes" readonly>
									<br />
									<input type="text" class="form-control" value="Operational Risk" readonly>
								</div>


								<div class="col-md-4">
									<label>Score</label>
									<input type="text" class="form-control" name="score_array[48]" placeholder="precentage ( tanpa presentase, ex. 7.89)">
									<br />
									<input type="text" class="form-control" name="score_array[49]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[50]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[51]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[52]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[53]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[54]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[55]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[56]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[57]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[58]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[59]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[60]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[61]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[62]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[63]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[64]" placeholder="score (ex. 123.45)">
									<br />
									<input type="text" class="form-control" name="score_array[65]" placeholder="score (ex. 123.45)">
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
