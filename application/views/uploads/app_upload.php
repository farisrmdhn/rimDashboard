<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
	  		<div class="title_left">
		  		<h3>Entri Data</h3>
		  		<p>Entri Data via App.</p>
	  		</div>
		</div>
		<div class="clearfix"></div>
		<p><?php echo $error?></p>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="<?php echo base_url();?>uploads/redirect_upload" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							<div class="form-group col-md-12">
								<span class="section">Pilih tabel yang akan di entri</span>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select class="form-control" name="table_selection">
										<option value="" selected>-- Pilih Tabel --</option>
										<option value="asset_allocation">Asset Allocation</option>
										<option value="bond_a_rating">Bond A Rating</option>
										<option value="bond_allocation">Bond Allocation</option>
										<option value="bpp">Buku Pedoman Perusahaan</option>
										<option value="ga_expense">G&A Expense</option>
										<!-- <option value="irl">Investment Risk Limit</option> -->
										<option value="kpmm_ratio">KPMM Ratio</option>
										<option value="lri">Leading Risk Indicator</option>
										<option value="rbc">Risk Based Capital</option>
										<option value="rbc_note">Risk Based Capital Notes</option>
										<option value="rcp">Risk Control Plan</option>
										<option value="rcp_detail">Risk Control Plan Detail</option>
										<option value="unrealized_gain_loss">Unrealized Gain Loss</option>
									</select>
								</div>
								<br />
								<br />
							</div>
							<input type="submit" class="btn btn-primary col-md-2" value="Go" style="float: right;">
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
