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

	<div id="ia_ba">
		<div class="row">
			<div class="col-md-9 col-xs-12">
				<h3>Bond Allocation</h3>
			</div>
		</div>
		<!-- left -->
		<div class="col-md-6 col-xs-12">
			<div class="x_panel tile">
				<div class="x_title">
					<h4>Internal Regulator</h4>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-12" style="text-align: center;">
						<p><i class="fa fa-circle" style="color : blue"></i> Corporate Bond (<strong id="ia_ba_internal_corp_prec"></strong> %)</p>
						<p id="ia_ba_internal_corp_note">abcdefghijklmnopqrstuvwxyz</p>
					</div>
					<div class="col-md-6 col-xs-12" style="text-align: center;">
						<p><i class="fa fa-circle" style="color : orange"></i> Goverment Bond (+SOE) (<strong id="ia_ba_internal_gov_prec"></strong> %)</p>
						<p id="ia_ba_internal_gov_note">abcdefghijklmnopqrstuvwxyz</p>
					</div>
				</div>
				<div class="row" style="margin-top: 20px;">
					<div class="col-md-12 col-xs-12">
						<canvas id="ia_ba_chart" height="150"></canvas>
					</div>
				</div>
			</div>
		</div>
		<!-- right -->
		<div class="col-md-6 col-xs-12">
			<div class="x_panel tile">
				<div class="x_title">
					<h4>External Regulator</h4>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-12" style="text-align: center;">
						<p><strong>Corporate Bond</strong></p>
						<p id="ia_ba_regulator_corp_note">abcdefghijklmnopqrstuvwxyz</p>
					</div>
					<div class="col-md-6 col-xs-12" style="text-align: center;">
							<p><strong>Goverment Bond</strong></p>
							<p>POJK no 01 & 36 : Allocation Gov Direct & MF Bonds min.30% and max 50% of total Portofolio</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-12" style="text-align: center;">
						<div id="ia_ba_gauge_corp" style="height: 240px"></div>
					</div>
					<div class="col-md-6 col-xs-12" style="text-align: center;">
						<div id="ia_ba_gauge_gov" style="height: 240px"></div>
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

		//Init page
		$(document).ready(function(){
			update_month();
			$('#titleYear').html(year);

			ia_ba_show_chart();
			ia_ba_show_gauge();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			update_month();

			ia_ba_show_chart();
			ia_ba_show_gauge();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);

			ia_ba_show_chart();
			ia_ba_show_gauge();
		})

		// Ajax Function
		function ia_ba_show_chart(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bondAllocations/ia_ba_show_chart/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(chart_data){
					update_ia_ba_chart(chart_data);
				}
			});
		}

		function ia_ba_show_gauge(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bondAllocations/ia_ba_show_gauge/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(gauge_data){
					update_ia_ba_gauge(gauge_data);
				}
			});
		}

		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bondAllocations/get_month/'+ year,
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

		function update_ia_ba_chart(chart_data){
			if((month == 'Jan' || month == 'Feb' || month == 'Mar') && year == '2017'){
				$('#ia_ba_internal_corp_note').html('20% &plusmn; 20% of Total Obligasi');
				$('#ia_ba_internal_gov_note').html('80% &plusmn; 20% of Total Obligasi');
			}else{
				$('#ia_ba_internal_corp_note').html('40% &plusmn; 20% of Total Obligasi');
				$('#ia_ba_internal_gov_note').html('60% &plusmn; 20% of Total Obligasi');
			}
			$('#ia_ba_internal_corp_prec').html(chart_data[0]);
			$('#ia_ba_internal_gov_prec').html(chart_data[1]);

			if( typeof (Chart) === 'undefined'){ return; }

			console.log('init_chart_doughnut_ia_ba');

			if ($('#ia_ba_chart').length){
			var chart_doughnut_settings = {
					type: 'doughnut',
					tooltipFillColor: "rgba(51, 51, 51, 0.55)",
					data: {
						labels: [
							"Goverment Bond",
							"Corporate Bond"
						],
						datasets: [{
							data: [chart_data[1], chart_data[0]],
							backgroundColor: [
								"orange",
								"blue"
							],
							hoverBackgroundColor: [
								"yellow",
								"green"
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
						      ctx.font = "15px Arial";
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

				$('#ia_ba_chart').each(function(){

					var chart_element = $(this);
					if(window.bar != undefined)
						window.bar.destroy();

					window.bar = new Chart( chart_element, chart_doughnut_settings);

				});
			}
		}

		function update_ia_ba_gauge(gauge_data){
			if(month == ('Jan' || 'Feb' || 'Mar' || 'Apr' || 'May' || 'Jun')){
				$('#ia_ba_regulator_corp_note').html('PMK 53: Allocation Corp direct bonds max.50% of total Portofolio');
			}else{
				$('#ia_ba_regulator_corp_note').html('PJOK 71: Allocation Corp direct bonds max.50% of total Portofolio');
			}
			var echartGauge_ia_ba_corp = echarts.init(document.getElementById('ia_ba_gauge_corp'));
			var echartGauge_ia_ba_gov = echarts.init(document.getElementById('ia_ba_gauge_gov'));

			echartGauge_ia_ba_corp.setOption({
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
						[0.4, 'green'],
						[0.499, 'orange'],
						[1 , 'red']
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
						case '40':
						  return '40 %';
						case '50':
						  return '50 %';
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
					value: gauge_data[0],
					name: 'Corporation Bond'
				  }]
				}]
			});

			echartGauge_ia_ba_gov.setOption({
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
						[0.25, 'red'],
						[0.3, 'orange'],
						[0.5 , 'green'],
						[0.55, 'orange'],
						[1, 'red']
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
						case '30':
						  return '30 %';
						case '50':
						  return '50 %';
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
					name: 'Government Bond'
				  }]
				}]
			});
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

		
	</script>
	</body>
</html>
