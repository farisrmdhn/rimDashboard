<div class="right_col" role="main">
	<!-- title & selector -->
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<h3>Leading Risk Indicator</h3>
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
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="x_panel tile">
					<div id="lri_uw_gauge" style="height: 175px;">
					</div>
					<button id="lri_btn_1" class="btn col-md-12 col-xs-12 btn-primary">Underwriting Ratio</button>
				</div>
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="x_panel tile">
					<div id="lri_rbc_conventional_gauge" style="height: 175px;">
					</div>
					<button id="lri_btn_2" class="btn col-md-12 col-xs-12">RBC Conventional</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="x_panel tile">
					<div id="lri_rbc_sharia_gauge" style="height: 175px;">
					</div>
					<button id="lri_btn_3" class="btn col-md-12 col-xs-12">RBC Sharia</button>
				</div>
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="x_panel tile">
					<div id="lri_bond_a_gauge" style="height: 175px;">
					</div>
					<button id="lri_btn_4" class="btn col-md-12 col-xs-12">Proportion of Bond A Rating</button>
				</div>
			</div>
		</div>
	</div>
	<!-- right -->
	<div class="col-md-6 col-xs-12">
		<div class="x_panel tile">
			<div class="x_title">
				<h4 id="lri_chart_title">Underwriting Ratio</h4>
			</div>
			<div class="x_content">
				<div>
					<canvas id="lri_chart" height="250"></canvas>
					<div id="lri_chart_legend">
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
		var lri = 1;

		//Init page
		$(document).ready(function(){
			update_month();
			$('#titleYear').html(year);

			lri_show_gauges();
			lri_show_chart();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			update_month();

			lri_show_gauges();
			lri_show_chart();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);
			lri_show_gauges();
			lri_show_chart();
		})

		//lri buttons
		$('#lri_btn_1').on('click', function(){
			lri = 1;

			$('#lri_btn_2').removeClass('btn-primary');
			$('#lri_btn_3').removeClass('btn-primary');
			$('#lri_btn_4').removeClass('btn-primary');


			$('#lri_btn_1').addClass('btn-primary');
			$('#lri_chart_title').html('Underwriting Ratio');
			lri_show_chart();
		})

		$('#lri_btn_2').on('click', function(){
			lri = 2;

			$('#lri_btn_1').removeClass('btn-primary');
			$('#lri_btn_3').removeClass('btn-primary');
			$('#lri_btn_4').removeClass('btn-primary');


			$('#lri_btn_2').addClass('btn-primary');
			$('#lri_chart_title').html('RBC Conventional');
			lri_show_chart();
		})

		$('#lri_btn_3').on('click', function(){
			lri = 3;

			$('#lri_btn_2').removeClass('btn-primary');
			$('#lri_btn_1').removeClass('btn-primary');
			$('#lri_btn_4').removeClass('btn-primary');


			$('#lri_btn_3').addClass('btn-primary');
			$('#lri_chart_title').html('RBC Sharia');
			lri_show_chart();
		})

		$('#lri_btn_4').on('click', function(){
			lri = 4;

			$('#lri_btn_2').removeClass('btn-primary');
			$('#lri_btn_3').removeClass('btn-primary');
			$('#lri_btn_1').removeClass('btn-primary');


			$('#lri_btn_4').addClass('btn-primary');
			lri_show_chart();
			$('#lri_chart_title').html('Proportion Of Bond A Rating');
		})

		// Ajax Function
		function lri_show_gauges(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>leadingRiskIndicators/lri_show_gauges/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(gauge_data){
					update_lri_gauges(gauge_data);
				}
			});
		}

		function lri_show_chart(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>leadingRiskIndicators/lri_show_chart/'+ lri +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(chart_data){
					update_lri_chart(chart_data);
				}
			});
		}

		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>leadingRiskIndicators/get_month/'+ year,
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

		function update_lri_gauges(gauge_data){

			var echartGauge_lri_uw = echarts.init(document.getElementById('lri_uw_gauge'));
			var echartGauge_lri_rbc_conventional = echarts.init(document.getElementById('lri_rbc_conventional_gauge'));
			var echartGauge_lri_rbc_sharia = echarts.init(document.getElementById('lri_rbc_sharia_gauge'));
			var echartGauge_lri_bond_a = echarts.init(document.getElementById('lri_bond_a_gauge'));

			echartGauge_lri_uw.setOption({
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
				  startAngle: 200,
				  endAngle: -20,
				  min: 0,
				  max: 100,
				  precision: 0,
				  splitNumber: 20,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.05, '#961c0f'],
						[0.1, 'orange'],
						[1 , 'green']
					  ],
					  width: 15
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 1,
					length: 8,
					lineStyle: {
					  color: '#333',
					  width: 2,
					  type: 'solid'
					}
				  },
				  axisLabel: {
					show: true,
					formatter: function(v) {
					  switch (v + '') {
						case '5':
						  return '5 %';
						case '10':
						  return '10 %';
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
					show: false,
					length: 15,
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
					offsetCenter: ['0%', 20],
					formatter: '{value}%',
					textStyle: {
					  color: 'auto',
					  fontSize: 20
					}
				  },
				  data: [{
					value: gauge_data[0],
					name: 'UW Ratio'
				  }]
				}]
			});

			echartGauge_lri_rbc_conventional.setOption({
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
				  startAngle: 200,
				  endAngle: -20,
				  min: 0,
				  max: 2000,
				  precision: 0,
				  splitNumber: 20,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.2, '#961c0f'],
						[0.2375, 'orange'],
						[1 , 'green']
					  ],
					  width: 15
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 1,
					length: 8,
					lineStyle: {
					  color: '#333',
					  width: 2,
					  type: 'solid'
					}
				  },
				  axisLabel: {
					show: true,
					formatter: function(v) {
					  switch (v + '') {
						case '400':
						  return '400 %';
						case '500':
						  return '475% %';
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
					show: false,
					length: 15,
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
					offsetCenter: ['0%', 20],
					formatter: '{value}%',
					textStyle: {
					  color: 'auto',
					  fontSize: 20
					}
				  },
				  data: [{
					value: gauge_data[1],
					name: 'RBC'
				  }]
				}]
			});

			echartGauge_lri_rbc_sharia.setOption({
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
				  startAngle: 200,
				  endAngle: -20,
				  min: 0,
				  max: 300,
				  precision: 0,
				  splitNumber: 15,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.333, '#961c0f'],
						[0.4, 'orange'],
						[1 , 'green']
					  ],
					  width:15
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 1,
					length: 8,
					lineStyle: {
					  color: '#333',
					  width: 2,
					  type: 'solid'
					}
				  },
				  axisLabel: {
					show: true,
					formatter: function(v) {
					  switch (v + '') {
						case '120':
						  return '120 %';
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
					show: false,
					length: 15,
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
					offsetCenter: ['0%', 20],
					formatter: '{value}%',
					textStyle: {
					  color: 'auto',
					  fontSize: 20
					}
				  },
				  data: [{
					value: gauge_data[2],
					name: 'RBC Sharia'
				  }]
				}]
			});

			echartGauge_lri_bond_a.setOption({
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
				  startAngle: 200,
				  endAngle: -20,
				  min: 0,
				  max: 100,
				  precision: 0,
				  splitNumber: 20,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.25, 'green'],
						[0.3, 'orange'],
						[1, '#961c0f']
					  ],
					  width: 15
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 1,
					length: 8,
					lineStyle: {
					  color: '#333',
					  width: 2,
					  type: 'solid'
					}
				  },
				  axisLabel: {
					show: true,
					formatter: function(v) {
					  switch (v + '') {
						case '25':
						  return '25 %';
						case '30':
						  return '30 %';
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
					show: false,
					length: 15,
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
					  fontSize: 8
					}
				  },
				  detail: {
					show: true,
					backgroundColor: 'rgba(0,0,0,0)',
					borderWidth: 0,
					borderColor: '#ccc',
					width: 100,
					height: 40,
					offsetCenter: ['0%', 20],
					formatter: '{value}%',
					textStyle: {
					  color: 'auto',
					  fontSize: 20
					}
				  },
				  data: [{
					value: gauge_data[3],
					name: 'Bond A'
				  }]
				}]
			});

		}

		function update_lri_chart(chart_data){
			var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			var score = [];
			var label;
			if(lri == 1){
				label = 'UW Ratio';
			}else if (lri == 2) {
				label = 'RBC Conventional';
			}else if (lri == 2) {
				label = 'RBC Sharia';
			}else{
				label = 'Bond A'
			}
			for(var i = 0; i < months.length; i++){
				score.push(chart_data[i]);
			}
			datasets =	[
							{
								label: label,
								backgroundColor: "#26B99A",
								data: score
							}
						];

			var html = '<div class="col-md-12"><i class="fa fa-square" style="color : #26B99A"></i> '+ label +'</div>';
			$('#lri_chart_legend').html(html);

			var ctx = document.getElementById("lri_chart");
			if(window.bar != undefined)
				window.bar.destroy();

			window.bar = new Chart(
				ctx, {
					type: 'bar',
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
						,
						animation: {
							duration: 500,
							easing: "easeOutQuart",
							onComplete: function () {
								var ctx = this.chart.ctx;
								ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
								ctx.textAlign = 'center';
								ctx.textBaseline = 'bottom';

								this.data.datasets.forEach(function (dataset) {
									for (var i = 0; i < dataset.data.length; i++) {
										var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
											scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
										ctx.fillStyle = '#333';
										var y_pos = model.y-5;
										var x_pos = model.x;
										ctx.fillText(dataset.data[i], x_pos, y_pos);
									}
								});
							}
						}
					}
				}
			);
		}

	</script>
</body>
</html>