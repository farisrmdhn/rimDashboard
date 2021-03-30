<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Entri Data - Buku Pedoman Perusahaan</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>bpp/add" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
								<div class="col-md-4">
									<label>Unit</label>
									<select name="unit" class="form-control">
										<option value="">-- Select Unit --</option>
										<option value="AGENCY">AGENCY</option>
										<option value="BANCASSURANCE">BANCASSURANCE</option>
										<option value="BUSINESS DEVELOPMENT">BUSINESS DEVELOPMENT</option>
										<option value="CCHU">CCHU</option>
										<option value="CLAIM & PROVIDER">CLAIM & PROVIDER</option>
										<option value="COMPLIANCE">COMPLIANCE</option>
										<option value="CORPORATE COMMUNICATION">CORPORATE COMMUNICATION</option>
										<option value="CORPORATE PLANNING">CORPORATE PLANNING</option>
										<option value="CORPORATE SECRETARY">CORPORATE SECRETARY</option>
										<option value="EB BUSINESS BANKING">EB BUSINESS BANKING</option>
										<option value="EB OPEN MARKET">EB OPEN MARKET</option>
										<option value="FINANCIAL CONTROLLER">FINANCIAL CONTROLLER</option>
										<option value="GA & PROCUREMENT">GA & PROCUREMENT</option>
										<option value="HUMAN CAPITAL & ET">HUMAN CAPITAL & ET</option>
										<option value="INFORMATION TECHNOLOGY">INFORMATION TECHNOLOGY</option>
										<option value="INTERNAL AUDIT">INTERNAL AUDIT</option>
										<option value="LEGAL & INVESTIGATION">LEGAL & INVESTIGATION</option>
										<option value="PCBC">PCBC</option>
										<option value="PRICING & PRODEV">PRICING & PRODEV</option>
										<option value="RISK MANAGEMENT">RISK MANAGEMENT</option>
										<option value="SYARIAH">SYARIAH</option>
										<option value="TREASURY & INV">TREASURY & INV</option>
										<option value="UNDERWRITING & CS">UNDERWRITING & CS</option>
										<option value="VALUATION, TECH.REPORT & REINS">VALUATION, TECH.REPORT & REINS</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
									<label>BPP</label>
									<input type="text" class="form-control" name="bpp" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
									<label>Date</label>
									<input type="text" class="form-control" name="date" placeholder="dd-MMM-yy (ex. 01-Jan-19)">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4">
									<label>No. Sertifikasi</label>
									<input type="text" class="form-control" name="no_sertifikasi" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-1">
									<label>Cek</label>
									<input type="text" class="form-control" name="cek" value="1">
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
