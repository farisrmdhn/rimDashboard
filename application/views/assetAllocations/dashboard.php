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

	<div id="ia_aa">
		<div class="col-md-6 col-xs-12">
			<div class="x_panel tile">
				<div class="x_title">
					<h4>Asset Allocation</h4>
				</div>
				<div class="x_content">
					<p>* in bio</p>
					<table class="table col-md-12 col-xs-12" style="font-size: 17px;">
						<tr>
							<td>Assets</td>
							<td>Actual Book Value</td>
							<td>Compliance in Inv.Limit</td>
						</tr>
						<tr>
							<td>Time Deposit</td>
							<td><span id="ia_aa_time_deposit_value"></span> (<span class="ia_aa_time_deposit_prec"></span> %)</td>
							<td id="ia_aa_time_deposit_limit">20%</td>
						</tr>
						<tr>
							<td>Bonds</td>
							<td><span id="ia_aa_bonds_value"></span> (<span class="ia_aa_bonds_prec"></span> %)</td>
							<td id="ia_aa_bonds_limit">20%</td>
						</tr>
						<tr>
							<td>Mutual Fund</td>
							<td><span id="ia_aa_mutual_fund_value"></span> (<span class="ia_aa_mutual_fund_prec"></span> %)</td>
							<td id="ia_aa_mutual_fund_limit">20%</td>
						</tr>
						<tr>
							<td>Equity</td>
							<td><span id="ia_aa_equity_value"></span> (<span class="ia_aa_equity_prec"></span> %)</td>
							<td id="ia_aa_equity_limit">20%</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-xs-12">
			<div class="x_panel">
				<canvas id="ia_aa_chart" height="200"></canvas>
				<div style="margin-top: 20px; text-align: center;">
					<div class="col-md-3 col-xs-6"><i class="fa fa-circle" style="color : red;"></i> Mutual Fund <br>(<span class="ia_aa_mutual_fund_prec"></span> %)</div>
					<div class="col-md-3 col-xs-6"><i class="fa fa-circle" style="color : orange"></i> Bonds <br>(<span class="ia_aa_bonds_prec"></span> %)</div>
					<div class="col-md-3 col-xs-6"><i class="fa fa-circle" style="color : green"></i> Time Deposit <br>(<span class="ia_aa_time_deposit_prec"></span> %)</div>
					<div class="col-md-3 col-xs-6"><i class="fa fa-circle" style="color : yellow"></i> Equity <br>(<span class="ia_aa_equity_prec"></span> %)</div>
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

		//Init page
		$(document).ready(function(){
			update_month();
			$('#titleYear').html(year);

			ia_aa_show_content();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			update_month();

			ia_aa_show_content();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);

			ia_aa_show_content();
		})

		// Ajax Function
		function ia_aa_show_content(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>assetAllocations/ia_aa_show_table/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(table_data){
					update_ia_aa_table(table_data);
					update_ia_aa_chart(table_data);
				}
			});
		}

		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>assetAllocations/get_month/'+ year,
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
		

		function update_ia_aa_table(table_data){
			if(year == 2017){
				$('#ia_aa_time_deposit_limit').html('20 %');
				$('#ia_aa_bonds_limit').html('55 %');
				$('#ia_aa_mutual_fund_limit').html('55 %');
				$('#ia_aa_equity_limit').html('10 %');
			}else if (year == 2018) {
				$('#ia_aa_time_deposit_limit').html('20 %');
				$('#ia_aa_bonds_limit').html('55 %');
				$('#ia_aa_mutual_fund_limit').html('50 %');
				$('#ia_aa_equity_limit').html('20 %');
			}
			$('#ia_aa_time_deposit_value').html(table_data['Time Deposit'][0]);
			$('.ia_aa_time_deposit_prec').html(table_data['Time Deposit'][1]);
			$('#ia_aa_bonds_value').html(table_data['Bonds'][0]);
			$('.ia_aa_bonds_prec').html(table_data['Bonds'][1]);
			$('#ia_aa_mutual_fund_value').html(table_data['Mutual Fund'][0]);
			$('.ia_aa_mutual_fund_prec').html(table_data['Mutual Fund'][1]);
			$('#ia_aa_equity_value').html(table_data['Equity'][0]);
			$('.ia_aa_equity_prec').html(table_data['Equity'][1]);
		}

		function update_ia_aa_chart(table_data){
			if( typeof (Chart) === 'undefined'){ return; }

			console.log('init_chart_doughnut_ia_aa');

			if ($('#ia_aa_chart').length){

			var chart_doughnut_settings = {
					type: 'pie',
					tooltipFillColor: "rgba(51, 51, 51, 0.55)",
					data: {
						labels: [
							"Time Deposit",
							"Bonds",
							"Mutual Fund",
							"Equity"
						],
						datasets: [{
							data: [table_data['Time Deposit'][1], table_data['Bonds'][1], table_data['Mutual Fund'][1], table_data['Equity'][1]],
							backgroundColor: [
								"green",
								"orange",
								"red",
								"yellow"
							],
							hoverBackgroundColor: [
								"lightgreen",
								"yellow",
								"pink",
								"orange"
							]
						}]
					},
					options: {
						responsive: true
						,
						events: false,
						animation: {
						    duration: 500,
						    easing: "easeOutQuart",
						    onComplete: function () {
						      var ctx = this.chart.ctx;
						      ctx.font = "15px sans-serif";
						      if($(window).width()<=768){
						     	 ctx.font = "10px sans-serif";
							  }
						      ctx.textAlign = 'center';
						      ctx.textBaseline = 'bottom';

						      this.data.datasets.forEach(function (dataset) {

						        for (var i = 0; i < dataset.data.length; i++) {
						          var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
						              total = dataset._meta[Object.keys(dataset._meta)[0]].total,
						              mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
						              start_angle = model.startAngle,
						              end_angle = model.endAngle,
						              mid_angle = start_angle + (end_angle - start_angle)/2;

						          var x = mid_radius * Math.cos(mid_angle);
						          var y = mid_radius * Math.sin(mid_angle);

						          ctx.fillStyle = '#fff';
						          if (i == 3){ // Darker text color for lighter background
						            ctx.fillStyle = '#444';
						          }

						          var val = dataset.data[i];
						          var percent = String(Math.round(val/total*100)) + "%";

						          if(val != 0) {
						            ctx.fillText(dataset.data[i] + ' %', model.x + x, model.y + y);
						          }
						        }
						      });
						    }
						}
					}
				}

				$('#ia_aa_chart').each(function(){

					var chart_element = $(this);
					if(window.bar != undefined)
						window.bar.destroy();

					window.bar = new Chart( chart_element, chart_doughnut_settings);

				});

			}
		}
	</script>
</body>
</html>