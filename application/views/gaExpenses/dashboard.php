<div class="right_col" role="main">
	<!-- title & selector -->
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<h3>General & Administration Expense Monitoring</h3>
			<p><span id="titleMonth"></span> - <span id="titleYear"></span></p>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="x_content">
				<div class="col-md-6 col-xs-6">
					<select id="monthSelector" class="form-control ">
					</select>
				</div>
				<div class="col-md-6 col-xs-6">
					<select id="yearSelector" class="form-control">
						<?php for($i = 0; $i < sizeof($years)-1; $i++):?>
							<option value="<?php echo $years[$i]['year']?>"><?php echo $years[$i]['year']?></option>
						<?php endfor;?>
						<option id="yearNow" value="<?php echo $years[sizeof($years)-1]['year']?>" selected><?php echo $years[sizeof($years)-1]['year']?></option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<!-- left -->
	<div class="col-md-4 col-xs-12">
		<div class="row">
			<p>* in mio</p>
			<div class="row">
				<div class="x_panel tile">
					<div class="col-md-8 col-xs-8">
						<h4>G & A Actual : </h4>
					</div>
					<div class="col-md-4 col-xs-4">
						<h3 id="ga_actual_amount">12345678</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="x_panel tile">
					<div class="col-md-8 col-xs-8">
						<h4>G & A Allowable : </h4>
					</div>
					<div class="col-md-4 col-xs-4">
						<h3 id="ga_allowable_amount">12345678</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="x_panel tile">
					<div class="col-md-8 col-xs-8">
						<h4>G & A Over / Under Run : </h4>
					</div>
					<div class="col-md-4 col-xs-4">
						<h3 id="ga_ouRun_amount" style="color: darkred;">12345678</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="x_panel tile ">
				<div class="x_title">
					<h4>Note:</h4>
				</div>
				<div class="x_content">
					<ul>
						<li>Amount G&A Actual and Allowable is amount in YTD</li>
						<li>G&A over/under run <br> = G&A Actual - G&A Allowable</li>
						<li>G&A Over/under run (%)<br> = 1 + {G&A over/under run} / {G&A Allowable}</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- right -->
	<div class="col-md-8 col-xs-12">
		<div class="col-md-12 col-xs-12">
			<div class="x_panel tile">
				<div class="x_content">
					<div id="echart_gauge_ga_expense_monitoring" style="height: 300px;"></div>
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
			if($(window).width()<=768){
				$('#echart_gauge_ga_expense_monitoring').css('height', '375px');
			}
			ga_expense_monitoring_show_gauge();
			ga_expense_monitoring_show_amounts();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			update_month();
			if($(window).width()<=768){
				$('#echart_gauge_ga_expense_monitoring').css('height', '375px');
			}
			
			ga_expense_monitoring_show_gauge();
			ga_expense_monitoring_show_amounts();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);
			if($(window).width()<=768){
				$('#echart_gauge_ga_expense_monitoring').css('height', '375px');
			}

			ga_expense_monitoring_show_gauge();
			ga_expense_monitoring_show_amounts();
		})

		// Ajax Function
		function ga_expense_monitoring_show_gauge(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>gaExpenses/ga_expense_monitoring_show_gauge/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(gauge_data){
					update_ga_expense_monitoring_gauge(gauge_data);
				}
			});
		}

		function ga_expense_monitoring_show_amounts(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>gaExpenses/ga_expense_monitoring_show_amounts/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(amounts){
					$('#ga_actual_amount').html(amounts[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
					$('#ga_allowable_amount').html(amounts[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
					$('#ga_ouRun_amount').html(amounts[2].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
				}
			});
		}

		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>gaExpenses/get_month/'+ year,
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

		function update_ga_expense_monitoring_gauge(gauge_data){
			var echartGauge_ga_expense_monitoring = echarts.init(document.getElementById('echart_gauge_ga_expense_monitoring'));
			//GA Expense Gauge Option
			if($(window).width()<=768){
				echartGauge_ga_expense_monitoring.setOption({
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
					  center: ['50%', '45%'],
					  startAngle: 270,
					  endAngle: -40,
					  min: 50,
					  max: 300,
					  precision: 0,
					  splitNumber: 25,
					  axisLine: {
						show: true,
						lineStyle: {
						  color: [
							[0.1, 'green'],
							[0.2, 'orange'],
							[1, '#961c0f']
						  ],
						  width: 15
						}
					  },
					  axisTick: {
						show: true,
						splitNumber: 10,
						length: 6.5,
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
							case '50':
							  return '50 %';
							case '70':
							  return '70 %';
							case '90':
							  return '90 %';
							case '110':
							  return '110 %';
							case '130':
							  return '130 %';
							case '150':
							  return '150 %';
							case '170':
							  return '170 %';
							case '190':
							  return '190 %';
							case '210':
							  return '210';
							case '230':
							  return '230 %';
							case '250':
							  return '250 %';
							case '270':
							  return '270 %';
							case '290':
							  return '290 %';
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
						  color: 'black',
						  width: 1,
						  type: 'solid'
						}
					  },
					  pointer: {
						length: '80%',
						width: 3,
						color: 'auto'
					  },
					  title: {
						show: true,
						offsetCenter: [-100, -140],
						textStyle: {
						  color: '#333',
						  fontSize: 20
						}
					  },
					  detail: {
						show: true,
						backgroundColor: 'rgba(0,0,0,0)',
						borderWidth: 0,
						borderColor: '#ccc',
						width: 100,
						height: 40,
						offsetCenter: [0, 160],
						formatter: '{value}%',
						textStyle: {
						  color: 'auto',
						  fontSize: 30,
						}
					  },
					  data: [{
						value: gauge_data,
						name: 'G&A Expense'
					  }]
					}]
				});
			}else{
				echartGauge_ga_expense_monitoring.setOption({
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
					  center: ['50%', '55%'],
					  startAngle: 270,
					  endAngle: -40,
					  min: 50,
					  max: 300,
					  precision: 0,
					  splitNumber: 25,
					  axisLine: {
						show: true,
						lineStyle: {
						  color: [
							[0.1, 'green'],
							[0.2, 'orange'],
							[1, '#961c0f']
						  ],
						  width: 15
						}
					  },
					  axisTick: {
						show: true,
						splitNumber: 10,
						length: 6.5,
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
							case '50':
							  return '50 %';
							case '70':
							  return '70 %';
							case '90':
							  return '90 %';
							case '110':
							  return '110 %';
							case '130':
							  return '130 %';
							case '150':
							  return '150 %';
							case '170':
							  return '170 %';
							case '190':
							  return '190 %';
							case '210':
							  return '210';
							case '230':
							  return '230 %';
							case '250':
							  return '250 %';
							case '270':
							  return '270 %';
							case '290':
							  return '290 %';
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
						  color: 'black',
						  width: 1,
						  type: 'solid'
						}
					  },
					  pointer: {
						length: '80%',
						width: 3,
						color: 'auto'
					  },
					  title: {
						show: true,
						offsetCenter: [200, -40],
						textStyle: {
						  color: '#333',
						  fontSize: 20
						}
					  },
					  detail: {
						show: true,
						backgroundColor: 'rgba(0,0,0,0)',
						borderWidth: 0,
						borderColor: '#ccc',
						width: 100,
						height: 40,
						offsetCenter: [200, 0],
						formatter: '{value}%',
						textStyle: {
						  color: 'auto',
						  fontSize: 30,
						}
					  },
					  data: [{
						value: gauge_data,
						name: 'G&A Expense'
					  }]
					}]
				});
			}
		}
	</script>
</body></html>