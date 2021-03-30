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

	<div id="ia_uga">
		<div class="row">
			<div class="col-md-9">
				<h3>Unrealized Gain / Loss Assets</h3>
			</div>
			<div class="col-md-3 col-xs-12">
				<select class="form-control" id="weekSelector">
					<option value="W-1">Week 1</option>
					<option value="W-2">Week 2</option>
					<option value="W-3">Week 3</option>
					<option value="W-4">Week 4</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-xs-12">
				<div class="x_panel tile">
					<div class="x_title">
						<h4>Bonds</h4>
					</div>
					<div class="x_content">
						<div class="row">
							<div id="ia_uga_gauge_bonds" style="height: 300px;"></div>
						</div>
						<div class="row">
							<table class="col-md-12 col-xs-12 table">
								<tr>
									<td>Actual Book Value</td>
									<td>:</td>
									<td id="ia_uga_bonds_1">12345 Bio</td>
								</tr>
								<tr>
									<td>Unrealized Gain/Loss</td>
									<td>:</td>
									<td id="ia_uga_bonds_2">12345 Bio</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-xs-12">
				<div class="x_panel tile">
					<div class="x_title">
						<h4>Equities</h4>
					</div>
					<div class="x_content">
						<div class="row">
							<div id="ia_uga_gauge_equities" style="height: 300px;"></div>
						</div>
						<div class="row">
							<table class="col-md-12 col-xs-12 table">
								<tr>
									<td>Actual Book Value</td>
									<td>:</td>
									<td id="ia_uga_equities_1">12345 Bio</td>
								</tr>
								<tr>
									<td>Unrealized Gain/Loss</td>
									<td>:</td>
									<td id="ia_uga_equities_2">12345 Bio</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-xs-12">
				<div class="x_panel tile">
					<div class="x_title">
						<h4>Mutual Funds</h4>
					</div>
					<div class="x_content">
						<div class="row">
							<div id="ia_uga_gauge_mutual_funds" style="height: 300px;"></div>
						</div>
						<div class="row">
							<table class="col-md-12 col-xs-12 table">
								<tr>
									<td>Actual Book Value</td>
									<td>:</td>
									<td id="ia_uga_mutual_funds_1">12345 Bio</td>
								</tr>
								<tr>
									<td>Unrealized Gain/Loss</td>
									<td>:</td>
									<td id="ia_uga_mutual_funds_2">12345 Bio</td>
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
		var week = 'W-1';

		//Init page
		$(document).ready(function(){
			update_month();
			$('#titleYear').html(year);

			ia_uga_show_gauge();
			ia_uga_show_bio();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			update_month();;

			ia_uga_show_gauge();
			ia_uga_show_bio();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);

			ia_uga_show_gauge();
			ia_uga_show_bio();
		})

		//On Week Change - RCP Status
		$('#weekSelector').on('change', function(){
			week = this.value;

			ia_uga_show_bio();
			ia_uga_show_gauge();
		})

		// Ajax Function
		function ia_uga_show_gauge(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>unrealizedGainLosses/ia_uga_show_gauge/'+ week +'/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(gauge_data){
					update_ia_uga_gauge(gauge_data);
				}
			});
		}

		function ia_uga_show_bio(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>unrealizedGainLosses/ia_uga_show_bio/'+ week +'/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(amounts){
					update_ia_uga_bio(amounts);
				}
			});
		}

		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>unrealizedGainLosses/get_month/'+ year,
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

		function update_ia_uga_gauge(gauge_data){
			var echartGauge_ia_uga_bonds = echarts.init(document.getElementById('ia_uga_gauge_bonds'));
			var echartGauge_ia_uga_equities = echarts.init(document.getElementById('ia_uga_gauge_equities'));
			var echartGauge_ia_uga_mutual_funds = echarts.init(document.getElementById('ia_uga_gauge_mutual_funds'));

			echartGauge_ia_uga_bonds.setOption({
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
				  min: -20,
				  max: 10,
				  precision: 0,
				  splitNumber: 6,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.5, 'red'],
						[0.667, 'orange'],
						[1 , 'green']
					  ],
					  width: 10
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 5,
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
						case '-20':
						  return '-20 %';
						case '-10':
						  return '-10 %';
						case '-15':
						  return '-15%';
						case '-5':
						  return '-5 %';
						case '0':
						  return '0';
						case '5':
						  return '5 %';
						case '10':
						  return '10 %';
						case '20':
						  return '20 %';
						default:
						  return '';
					  }
					},
					textStyle: {
					  color: '#333',
					  fontSize: 10
					}
				  },
				  splitLine: {
					show: true,
					length: 10,
					lineStyle: {
					  color: '#333',
					  width: 2,
					  type: 'solid'
					}
				  },
				  pointer: {
					length: '80%',
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
					value: gauge_data[1],
					name: 'Bonds'
				  }]
				}]
			});

			echartGauge_ia_uga_equities.setOption({
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
				  min: -20,
				  max: 10,
				  precision: 0,
				  splitNumber: 6,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.5, 'red'],
						[0.667, 'orange'],
						[1 , 'green']
					  ],
					  width: 10
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 5,
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
						case '-20':
						  return '-20 %';
						case '-10':
						  return '-10 %';
						case '-15':
						  return '-15%';
						case '-5':
						  return '-5 %';
						case '0':
						  return '0';
						case '5':
						  return '5 %';
						case '10':
						  return '10 %';
						case '20':
						  return '20 %';
						default:
						  return '';
					  }
					},
					textStyle: {
					  color: '#333',
					  fontSize: 10
					}
				  },
				  splitLine: {
					show: true,
					length: 10,
					lineStyle: {
					  color: '#333',
					  width: 2,
					  type: 'solid'
					}
				  },
				  pointer: {
					length: '80%',
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
					value: gauge_data[0],
					name: 'Equities'
				  }]
				}]
			});

			echartGauge_ia_uga_mutual_funds.setOption({
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
				  min: -20,
				  max: 10,
				  precision: 0,
				  splitNumber: 6,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.5, 'red'],
						[0.667, 'orange'],
						[1 , 'green']
					  ],
					  width: 10
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 5,
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
						case '-20':
						  return '-20 %';
						case '-10':
						  return '-10 %';
						case '-15':
						  return '-15%';
						case '-5':
						  return '-5 %';
						case '0':
						  return '0';
						case '5':
						  return '5 %';
						case '10':
						  return '10 %';
						case '20':
						  return '20 %';
						default:
						  return '';
					  }
					},
					textStyle: {
					  color: '#333',
					  fontSize: 10
					}
				  },
				  splitLine: {
					show: true,
					length: 10,
					lineStyle: {
					  color: '#333',
					  width: 2,
					  type: 'solid'
					}
				  },
				  pointer: {
					length: '80%',
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
					name: 'Mutual Fund'
				  }]
				}]
			});
		}

		function update_ia_uga_bio(amounts){
			$('#ia_uga_bonds_1').html(amounts['Bonds'][0] + ' Bio');
			$('#ia_uga_bonds_2').html(amounts['Bonds'][1] + ' Bio');
			$('#ia_uga_equities_1').html(amounts['Equities'][0] + ' Bio');
			$('#ia_uga_equities_2').html(amounts['Equities'][1] + ' Bio');
			$('#ia_uga_mutual_funds_1').html(amounts['Mutual Funds'][0] + ' Bio');
			$('#ia_uga_mutual_funds_2').html(amounts['Mutual Funds'][1] + ' Bio');
		}
	</script>
	</body>
</html>

