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

	<div id="ia_bra">
		<div class="row">
			<div class="col-md-8 col-xs-12">
				<h3>Bond Rating A</h3>
			</div>
			<div class="col-md-4 col-xs-12">
				<div class="row">
					<div class="col-md-6">
						<div class="col-md-6">
							<label>Group by</label>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<button id="ia_bra_btn_1" class="btn col-md-12 btn-primary">Accounting Method</button>
				</div>
				<div class="col-md-6 col-xs-12">
					<button id="ia_bra_btn_2" class="btn col-md-12">Portofolio</button>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 20px;">
			<div class="col-md-4 col-xs-12">
				<div class="x_panel tile">
					<div class="x_title">
						<h4>Proportion of Bond A *</h4>
					</div>
					<div class="x_content">
						<div class="row">
							<div id="ia_bra_gauge" style="height: 240px;"></div>
						</div>
						<div class="row">
							<table class="col-md-12 table">
								<tr>
									<td>Bond A</td>
									<td>:</td>
									<td id="ia_bra_gauge_bond_a">12345 Bio</td>
								</tr>
								<tr>
									<td>Total Bond</td>
									<td>:</td>
									<td id="ia_bra_gauge_total_bond">12345 Bio</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-5 col-xs-12">
				<div class="row">
					<div class="x_panel tile">
						<div class="x_title">
							<h4>Unrealized Gain/Loss Bond Rating A **</h4>
						</div>
						<div class="x_content">
							<canvas id="ia_bra_chart" height="150"></canvas>
							<div id="ia_bra_chart_legend"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<p>* Bond Rating A monitoring starts on March 2017 according to BPP Strategy Investment 2017</p>
					<p>** Unrealized Gain/Loss Bond Rating A is difference between Purchase Value with Book Value on closing date selected month</p>
				</div>
			</div>
			<div class="col-md-3 col-xs-12">
				<div class="col-md-12 col-xs-6">
					<div class="x_panel tile">
						<div class="x_title">
							<h5>Actual Book Value</h5>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table class="col-md-12 col-xs-12 table">
								<tr>
									<td class="ia_bra_score_1_title">Direct Bond</td>
									<td>:</td>
									<td id="ia_bra_score_1">12345 Bio</td>
								</tr>
								<tr>
									<td class="ia_bra_score_2_title">Mutual Fund</td>
									<td>:</td>
									<td id="ia_bra_score_2">12345 Bio</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-xs-6">
					<div class="x_panel tile">
						<div class="x_title">
							<h5>Unrealized Gain/Loss</h5>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<table class="col-md-12 col-xs-12 table">
								<tr>
									<td class="ia_bra_score_1_title">Direct Bond</td>
									<td>:</td>
									<td id="ia_bra_score_3">12345 Bio</td>
								</tr>
								<tr>
									<td class="ia_bra_score_2_title">Mutual Fund</td>
									<td>:</td>
									<td id="ia_bra_score_4">12345 Bio</td>
								</tr>
							</table>
						</div>
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
		var bond_a = 1;

		//Init page
		$(document).ready(function(){
			update_month();
			$('#titleYear').html(year);

			ia_bra_show_gauge();
			ia_bra_show_chart();
			ia_bra_show_score();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			update_month();

			ia_bra_show_gauge();
			ia_bra_show_chart();
			ia_bra_show_score();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);

			ia_bra_show_gauge();
			ia_bra_show_chart();
			ia_bra_show_score();
		})

		$('#ia_bra_btn_1').on('click', function(){
			bond_a = 1;

			$('#ia_bra_btn_2').removeClass('btn-primary');
			$('#ia_bra_btn_1').addClass('btn-primary');

			ia_bra_show_chart();
			ia_bra_show_score();
		})

		$('#ia_bra_btn_2').on('click', function(){
			bond_a = 2;

			$('#ia_bra_btn_1').removeClass('btn-primary');
			$('#ia_bra_btn_2').addClass('btn-primary');

			ia_bra_show_chart();
			ia_bra_show_score();
		})

		//AJAX - Start
		function ia_bra_show_gauge(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bondARatings/ia_bra_show_gauge/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(gauge_data){
					update_ia_bra_gauge(gauge_data);
				}
			});
		}

		function ia_bra_show_chart(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bondARatings/ia_bra_show_chart/'+ bond_a +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(chart_data){
					update_ia_bra_chart(chart_data);
				}
			});
		}

		function ia_bra_show_score(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bondARatings/ia_bra_show_score/'+ bond_a +'/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(scores){
					update_ia_bra_score(scores);
				}
			});
		}

		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bondARatings/get_month/'+ year,
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

		function update_ia_bra_gauge(gauge_data){
			$('#ia_bra_gauge_bond_a').html(gauge_data[0] + ' Bio');
			$('#ia_bra_gauge_total_bond').html(gauge_data[1] + ' Bio');
			var echartGauge_ia_bra = echarts.init(document.getElementById('ia_bra_gauge'));

			echartGauge_ia_bra.setOption({
				tooltip: {
				  formatter: "{b} <br/>{a} : {c}%"
				},
				toolbox: {
				  show: true,
				  feature: {
					saveAsImage: {
					  show: true,
					  title: "Save Image"
					}
				  }
				},
				series: [{
				  name: 'Score',
				  type: 'gauge',
				  center: ['50%', '60%'],
				  startAngle: 180,
				  endAngle: 0,
				  min: 0,
				  max: 100,
				  precision: 0,
				  splitNumber: 10,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.24, 'green'],
						[0.34, 'orange'],
						[1 , 'red']
					  ],
					  width: 15
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 10	,
					length: 5,
					lineStyle: {
					  color: '#333',
					  width: 1,
					  type: 'solid'
					}
				  },
				  axisLabel: {
					show: true,
					formatter: function(v) {
					  switch (v + '') {
						case '0':
						  return '0 %';
						case '10':
						  return '10 %';
						case '20':
						  return '20 %';
						case '30':
						  return '30 %';
						case '40':
						  return '40 %';
						case '50':
						  return '50 %';
						case '60':
						  return '60 %';
						case '70':
						  return '70 %';
						case '80':
						  return '80 %';
						case '90':
						  return '90 %';
						case '100':
						  return '100 %';
						default:
						  return '';
					  }
					},
					textStyle: {
					  color: '#333',
					  fontSize: 8
					}
				  },
				  splitLine: {
					show: true,
					length: 15,
					lineStyle: {
					  color: '#333',
					  width: 1,
					  type: 'solid'
					}
				  },
				  pointer: {
					length: '100%',
					width: 3,
					color: 'auto'
				  },
				  title: {
					show: false,
					offsetCenter: ['-70%', -90],
					textStyle: {
					  color: '#333',
					  fontSize: 15
					}
				  },
				  detail: {
					show: true,
					backgroundColor: 'rgba(0,0,0,0)',
					borderWidth: 0,
					borderColor: '#ccc',
					width: 100,
					height: 40,
					offsetCenter: ['0%', 40],
					formatter: '{value}%',
					textStyle: {
					  color: 'auto',
					  fontSize: 30
					}
				  },
				  data: [{
					value: gauge_data[2],
					name: 'Bond A'
				  }]
				}]
			});
		}

		function update_ia_bra_chart(chart_data){
			var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			if(year == 2017){
				months = ['Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			}
			if(bond_a == 1){
				var score = [];
				var score2 = [];
				var score3 = [];
				for(var i = 0;i < months.length;i++){
					score.push(chart_data['AFS'][months[i]]);
					score2.push(chart_data['TRD'][months[i]]);
					score3.push(chart_data['HTM'][months[i]]);
				}
				datasets =	[
								{
									label: 'AFS',
									fill: false,
									borderColor: '#26B99A',
									data: score
								},
								{
									label: 'TRD',
									fill: false,
									borderColor: "orange",
									data: score2
								},
								{
									label: 'HTM',
									fill: false,
									borderColor: "green",
									data: score3
								}
							];

				var html = '<div class="col-md-3"><i class="fa fa-square" style="color : #26B99A"></i> AFS</div>' +
							'<div class="col-md-3"><i class="fa fa-square" style="color : orange"></i> TRD</div>' +
							'<div class="col-md-3"><i class="fa fa-square" style="color : green"></i> HTM</div>';
				$('#ia_bra_chart_legend').html(html);
			}
			if(bond_a == 2){
				var score = [];
				var score2 = [];
				for(var i = 0;i < months.length;i++){
					score.push(chart_data['Direct Bond'][months[i]]);
					score2.push(chart_data['Mutual Fund'][months[i]]);
				}
				datasets =	[
								{
									label: 'Direct Bond',
									fill: false,
									borderColor: '#26B99A',
									data: score
								},
								{
									label: 'Mutual Fund',
									fill: false,
									borderColor: "orange",
									data: score2
								}
							];

				var html = '<div class="col-md-5"><i class="fa fa-square" style="color : #26B99A"></i> Direct Bond</div>' +
							'<div class="col-md-5"><i class="fa fa-square" style="color : orange"></i> Mutual Fund</div>';
				$('#ia_bra_chart_legend').html(html);
			}


			var ctx = document.getElementById("ia_bra_chart");
					if(window.bar != undefined)
						window.bar.destroy();

					window.bar = new Chart(
						ctx, {
							type: 'line',
							data: {
								labels: months,
								datasets: datasets
							},
							options: {
								scales: {
									yAxes: [{
										ticks: {
											beginAtZero: true
											,
											callback: function(value, index, values) {
												return value + ' %';
											}
								  		}
									}]
								}
							}
						}
					);
		}

		function update_ia_bra_score(scores){
			var score_array = [];
			if(bond_a == 1){
				$('.ia_bra_score_1_title').html('AFS');
				$('.ia_bra_score_2_title').html('TRD');
			}
			if(bond_a == 2){
				$('.ia_bra_score_1_title').html('Direct Bond');
				$('.ia_bra_score_2_title').html('Mutual fund');
			}

			$('#ia_bra_score_1').html(scores['actual'][0] + ' Bio');
			$('#ia_bra_score_2').html(scores['actual'][1] + ' Bio');
			$('#ia_bra_score_3').html(scores['unrealized'][0] + ' Bio');
			$('#ia_bra_score_4').html(scores['unrealized'][1] + ' Bio');
		}
	</script>
</body>
</html>
