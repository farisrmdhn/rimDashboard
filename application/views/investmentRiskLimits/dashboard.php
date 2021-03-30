<div class="right_col" role="main">
	<!-- title & selector -->
	<div class="row">
		<div class="col-md-3 col-xs-12">
			<h3>Investment Assets</h3>
			<p><span id="titleMonth"></span> - <span id="titleYear"></span></p>
		</div>
		<div class="col-md-9 col-xs-12">
			<div class="x_content">
				<div class="col-md-4 col-xs-6">
					<select id="monthSelector" class="form-control ">
					</select>
				</div>
				<div class="col-md-4 col-xs-6">
					<select id="yearSelector" class="form-control">
						<?php for($i = 0; $i < sizeof($years)-1; $i++):?>
							<option value="<?php echo $years[$i]['year']?>"><?php echo $years[$i]['year']?></option>
						<?php endfor;?>
						<option id="yearNow" value="<?php echo $years[sizeof($years)-1]['year']?>" selected><?php echo $years[sizeof($years)-1]['year']?></option>
					</select>
				</div>
				<div class="col-md-4 col-xs-12">
					<!-- investment assets dashboard selector-->
					<select class="form-control" onchange="location = this.value">
						<option selected>-- Select Dashboard --</option>
						<option value="<?php echo base_url();?>unrealizedGainLosses/dashboard">Unrealized Gain/Loss</option>
						<option value="<?php echo base_url();?>assetAllocations/dashboard">Assets Allocation</option>
						<option value="<?php echo base_url();?>bondAllocations/dashboard">Bond Allocation</option>
						<option value="<?php echo base_url();?>bondARatings/dashboard">Bond Rating A</option>
						<option value="<?php echo base_url();?>investmentRiskLimits/dashboard">Investment Risk Limit</option>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div id="ia_irl">
		<!-- left -->
		<div class="col-md-3 col-xs-12">
			<div class="row">
				<div class="row">
					<div class="x_title">
						<h4 style="text-align: center;">Investment Risk Limit</h4>
					</div>
				</div>
				<div class="row">
					<div class="x_panel tile">
						<div class="col-md-7 col-xs-7">
							<button id="ia_irl_stock_btn" class="btn col-md-12 col-xs-12">Stock</button>
						</div>
						<div class="col-md-5 col-xs-5">
							<h3 id="ia_irl_stock" style="text-align: center;">12345678</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="x_panel tile">
						<div class="col-md-7 col-xs-7">
							<button id="ia_irl_idr_btn" class="btn col-md-12 col-xs-12">IDR Fixed Income</button>
						</div>
						<div class="col-md-5 col-xs-5">
							<h3 id="ia_irl_idr" style="text-align: center;">12345678</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="x_panel tile">
						<div class="col-md-7 col-xs-7">
							<button id="ia_irl_usd_btn" class="btn col-md-12 col-xs-12">USD Exposure</button>
						</div>
						<div class="col-md-5 col-xs-5">
							<h3 id="ia_irl_usd" style="text-align: center;">12345678</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="x_panel tile">
						<div class="col-md-7 col-xs-7">
							<button id="ia_irl_bond_btn" class="btn col-md-12 col-xs-12">Corporate Bond</button>
						</div>
						<div class="col-md-5 col-xs-5">
							<h3 id="ia_irl_bond" style="text-align: center;">12345678</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- right -->
		<div class="col-md-9 col-xs-12">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel tile">
					<div class="x_title">
						<h4 id="ia_irl_chart_title"></h4>
					</div>
					<div class="x_content">
						<canvas id="ia_irl_chart" height="160"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

					<!-- footer content -->
					<footer>
						<div class="pull-right">
							BNI-Life | RIM Dashboard v 1.0
						</div>
						<div class="clearfix"></div>
					</footer>
					<!-- /footer content -->
				</div>
			</div>

	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
    <!-- ECharts -->
    <script src="<?php echo base_url(); ?>vendors/echarts/dist/echarts.js"></script>
	<!-- Chart.js -->
    <script src="<?php echo base_url(); ?>vendors/Chart.js/dist/Chart.js"></script>
	<!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>build/js/custom.min.js"></script>
	<!-- gauge.js -->
	<script src="<?php echo base_url(); ?>vendors/gauge.js/dist/gauge.min.js"></script>


	<!-- AJAX Script -->
	<script type="text/javascript">
		var month;
		var year = $('#yearSelector').val();
		var component_ia_irl = 1;

		//Init page
		$(document).ready(function(){
			update_month();
			$('#titleYear').html(year);
			
			ia_irl_show_score();
			ia_irl_show_chart();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			update_month();


			ia_irl_show_score();
			ia_irl_show_chart();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);

			ia_irl_show_score();
			ia_irl_show_chart();
		})

		$('#ia_irl_stock_btn').on('click', function(){
			component_ia_irl = 1;

			$('#ia_irl_idr_btn').removeClass('btn-primary');
			$('#ia_irl_usd_btn').removeClass('btn-primary');
			$('#ia_irl_bond_btn').removeClass('btn-primary');


			$('#ia_irl_stock_btn').addClass('btn-primary');
			ia_irl_show_chart();
		})

		$('#ia_irl_idr_btn').on('click', function(){
			component_ia_irl = 2;

			$('#ia_irl_stock_btn').removeClass('btn-primary');
			$('#ia_irl_usd_btn').removeClass('btn-primary');
			$('#ia_irl_bond_btn').removeClass('btn-primary');


			$('#ia_irl_idr_btn').addClass('btn-primary');
			ia_irl_show_chart();
		})

		$('#ia_irl_usd_btn').on('click', function(){
			component_ia_irl = 3;

			$('#ia_irl_idr_btn').removeClass('btn-primary');
			$('#ia_irl_stock_btn').removeClass('btn-primary');
			$('#ia_irl_bond_btn').removeClass('btn-primary');


			$('#ia_irl_usd_btn').addClass('btn-primary');
			ia_irl_show_chart();
		})

		$('#ia_irl_bond_btn').on('click', function(){
			component_ia_irl = 4;

			$('#ia_irl_idr_btn').removeClass('btn-primary');
			$('#ia_irl_usd_btn').removeClass('btn-primary');
			$('#ia_irl_stock_btn').removeClass('btn-primary');


			$('#ia_irl_bond_btn').addClass('btn-primary');
			ia_irl_show_chart();
		})

		// Ajax Function
		function ia_irl_show_score(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>investmentRiskLimits/ia_irl_show_score/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(scores){
					update_ia_irl_score(scores);
				}
			});
		}

		function ia_irl_show_chart(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>investmentRiskLimits/ia_irl_show_chart/'+ component_ia_irl +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(chart_data){
					update_ia_irl_chart(chart_data);
				}
			});
		}

		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>investmentRiskLimits/get_month/'+ year,
				async: false,
				dataType: 'json',
				success: function(months){
					set_months(months);

				}
			});
		}
			
		// End - Ajax Function
		function set_months(months){
			var html = '';
			length = months[1];
			months = months[0];
			for(var i = 0; i< length -1; i++){
				html += '<option value ="'+months[i]+'">'+months[i]+'</option>';
			}
			html += '<option value ="'+months[length-1]+'" selected>'+months[length-1]+'</option>';
			$('#monthSelector').html(html);
			$('#titleMonth').html(months[length-1]);
			month = months[length-1];
		}
		function update_ia_irl_score(scores){
			$('#ia_irl_stock').html(scores[0][0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
			$('#ia_irl_idr').html(scores[1][0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
			$('#ia_irl_usd').html(scores[2][0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
			$('#ia_irl_bond').html(scores[3][0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

			$('#ia_irl_stock').css('color', scores[0][2]);
			$('#ia_irl_idr').css('color', scores[1][2]);
			$('#ia_irl_usd').css('color', scores[2][2]);
			$('#ia_irl_bond').css('color', scores[3][2]);
		}

		function update_ia_irl_chart(chart_data){
			var chart_limit = [];
			if(year == 2016){
				if(component_ia_irl == 1){
					$('#ia_irl_chart_title').html('Stock');
					chart_limit = [195,195,195,195,195,195,195,195,195,195,195,195]
				}
				if(component_ia_irl == 2){
					$('#ia_irl_chart_title').html('IDR Fixed Income');
					chart_limit = [3100,3100,3100,3100,3100,3100,3100,3100,3100,3100,3100,3100]
				}
				if(component_ia_irl == 3){
					$('#ia_irl_chart_title').html('USD Exposure');
					chart_limit = [110,110,110,110,110,110,110,110,110,110,110,110]
				}
				if(component_ia_irl == 4){
					$('#ia_irl_chart_title').html('Corporate Bond');
					chart_limit = [1400,1400,1400,1400,1400,1400,1400,1400,1400,1400,1400,1400]
				}
			}else{
				if(component_ia_irl == 1){
					$('#ia_irl_chart_title').html('Stock');
					chart_limit = [775,775,775,775,775,775,775,775,775,775,775,775]
				}
				if(component_ia_irl == 2){
					$('#ia_irl_chart_title').html('IDR Fixed Income');
					chart_limit = [4890,4890,4890,4890,4890,4890,4890,4890,4890,4890,4890,4890]
				}
				if(component_ia_irl == 3){
					$('#ia_irl_chart_title').html('USD Exposure');
					chart_limit = [133,133,133,133,133,133,133,133,133,133,133,133]
				}
				if(component_ia_irl == 4){
					$('#ia_irl_chart_title').html('Corporate Bond');
					chart_limit = [4310,4310,4310,4310,4310,4310,4310,4310,4310,4310,4310,4310]
				}
			}
			datasets =	[
							{
								label: 'Score',
								backgroundColor: '#26B99A',
								fill: true,
								borderColor: 'orange',
								data: chart_data
							},
							{
								label: 'Limit',
								backgroundColor: '#26B99A',
								fill: false,
								borderColor: 'orange',
								data: chart_limit,
								type: 'line'
							}
						];

			var ctx = document.getElementById("ia_irl_chart");
			if(window.bar != undefined)
				window.bar.destroy();

			window.bar = new Chart(
				ctx, {
					type: 'bar',
					data: {
						labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
						datasets: datasets
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
						  		}
							}]
						}
					}
				}
			);
		}
	</script>
</body>
</html>