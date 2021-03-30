<!-- page content -->
<div class="right_col" role="main">
	<!-- title & selector -->
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<h3>Risk Management Monitoring</h3>
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
	<!-- /title & selector -->
	<!-- content -->
	<div class="row">
		<!-- lefttiles -->
		<div class="col-md-6 col-xs-12">
		    <div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="col-md-7 col-xs-12">
						<a href="<?php echo base_url();?>riskBasedCapitals">
							<div class="x_panel tile" style="height:320px;">
								<div class="x_title">
									<h4>RBC</h4>
								</div>
								<div class="x_content">
									<div id="echart_gauge_rbc" style="height:320px;" ></div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-5 col-xs-12">
						<div class="row">
							<a href="<?php echo base_url();?>leadingRiskIndicators">
								<div class="x_panel" style="height: 150px">
									<div class="x_content">
										<div id="echart_gauge_uw_ratio" style="height:150px;"></div>
									</div>
								</div>
							</a>
						</div>
						<div class="row">
							<a href="<?php echo base_url();?>gaExpenses">
								<div class="x_panel" style="height: 150px; margin: 5px auto 0 auto;">
									<div class="x_content">
										<div id="echart_gauge_ga_expense" style="height:150px;"></div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-md-12 col-xs-12">
					<a href="<?php echo base_url();?>investmentAssets">
						<div class="x_panel tile" >
							<div class="x_title">
								<h4 class="col-md-9 col-xs-12">Non-Link Assets Monitoring (Unrealized Gain/Loss)</h4>
					</a>
								<div class="col-md-3 col-xs-12">
									<select class="form-control" id="weekSelector">
										<option value="W-1">Week 1</option>
										<option value="W-2">Week 2</option>
										<option value="W-3">Week 3</option>
										<option value="W-4">Week 4</option>
									</select>
					<a href="<?php echo base_url();?>investmentAssets">
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="x_content">
								<div class="row">
									<div class="col-md-4 col-xs-12">
										<div class="gain_loss_prec">
											<h1><span id="bonds_prec"></span><small>% </small></h1>
											<div class="gain_loss_name"><p>Bonds</p></div>
										</div>
									</div>
									<div class="col-md-4 col-xs-12">
										<div class="gain_loss_prec">
											<h1><span id="equities_prec"></span><small>% </small></h1>
											<div class="gain_loss_name"><p>Equities</p></div>
										</div>
									</div>
									<div class="col-md-4 col-xs-12">
										<div class="gain_loss_prec">
											<h1><span id="mutual_funds_prec"></span><small>% </small></h1>
											<div class="gain_loss_name"><p>Mutual Funds</p></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<!-- /top tiles -->
		<!-- right tiles -->
		<div class="col-md-6 col-xs-12">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<a href="<?php echo base_url();?>investmentAssets">
						<div class="x_panel tile" style="height: 280px;">
							<div class="x_title">
								<h4 id="bulb_header">Non-Link Investment Allocation Limit</h4>
							</div>
							<div class="">
								<table>
									<tr>
										<td class="col-md-1"></td>
										<td class="col-md-2">
											<div class="bulb_title">
												<p id="compo1">Stock</p>
											</div>
										</td>
										<td class="col-md-1"></td>
										<td class="col-md-2">
											<div class="bulb_title">
												<p id="compo2">IDR Fixed</p>
											</div>
										</td>
										<td class="col-md-1"></td>
										<td class="col-md-2">
											<div class="bulb_title">
												<p id ="compo3">USD Exposure</p>
											</div>
										</td>
										<td class="col-md-1"></td>
										<td class="col-md-2">
											<div class="bulb_title">
												<p id="compo4">Corporate Bond</p>
											</div>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<div class = "bulb">
												<div class="bulb_light" id="stock_color"></div>
												<p class="bulb_score" id="stock_score"></p>
											</div>
										</td>
										<td></td>
										<td>
											<div class = "bulb">
												<div class="bulb_light" id="idr_color"></div>
												<p class="bulb_score" id="idr_score"></p>
											</div>
										</td>
										<td></td>
										<td>
											<div class = "bulb">
												<div class="bulb_light" id="usd_color"></div>
												<p class="bulb_score" id="usd_score"></p>
											</div>
										</td>
										<td></td>
										<td>
											<div class = "bulb">
												<div class="bulb_light" id="corporate_bond_color"></div>
												<p class="bulb_score" id="corporate_bond_score"></p>
											</div>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<div class="bulb_content">
												<p><div id="stock_prec"></div></p>
											</div>
										</td>
										<td></td>
										<td>
											<div class="bulb_content">
												<p><div id="idr_prec"></div></p>
											</div>
										</td>
										<td></td>
										<td>
											<div class="bulb_content">
												<p><div id="usd_prec"></div></p>
											</div>
										</td>
										<td></td>
										<td>
											<div class="bulb_content">
												<p><div id="corporate_bond_prec"></div></p>
											</div>
										</td>
										<td></td>
									</tr>
									<tr>
										<td class="bulb_content">Reg :</td>
										<td>
											<div class="bulb_content">
												<p>20 %</p>
											</div>
										</td>
										<td></td>
										<td>
											<div class="bulb_content">
												<p>20 %</p>
											</div>
										</td>
										<td></td>
										<td>
											<div class="bulb_content">
												<p>55 %</p>
											</div>
										</td>
										<td></td>
										<td>
											<div class="bulb_content">
												<p>50 %</p>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<a href="<?php echo base_url();?>rcpStatus">
			        	<div class="x_panel tile"  style="height: 220px;">
			                <div class="x_title">
			                  <h4>Risk Control Plan</h4>
			                  <div class="clearfix"></div>
			                </div>
			                <div class="x_content">
			                	<table class="col-md-12 col-xs-12">
				                	<tr>
				                		<th style="width:37%;">
				                			<p>Chart</p>
				                		</th>
				                		<th>
				                        	<div class="col-lg-7 col-md-5 col-sm-7 col-xs-5">
				                        		<p class="">Status</p>
				                        	</div>
				                        	<div class="col-lg-5 col-md-7 col-sm-5 col-xs-7">
				                        		<p class="">Precentage</p>
				                        	</div>
				                    	</th>
				                    </tr>
				                    <tr>
				                    	<td>
				                    		<canvas class="canvasDoughnut" height="100" width="100" style="margin: 0px auto 20px auto"></canvas>
				                    	</td>
				                    	<td>
				                    		<table class="tile_info">
				                        		<tr>
				                        			<td>
														<p><i class="fa fa-square" style="color: green;"></i>Done </p>
				                            		</td>
				                            		<td><span id="rcp_chart_done"></span> %</td>
				                          		</tr>
				                          		<tr>
				                            		<td>
				                              			<p><i class="fa fa-square" style="color: orange;"></i>In Progress </p>
				                            		</td>
				                            		<td><span id="rcp_chart_in_progress"></span>%</td>
				                          		</tr>
				                          		<tr>
				                            		<td>
				                              			<p><i class="fa fa-square red"></i>Not yet started </p>
				                            		</td>
				                            		<td><span id="rcp_chart_not_yet_started"></span>%</td>
				                          		</tr>
				                        	</table>
				                    	</td>
				                    </tr>
			                	</table>
			                </div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<!-- /right tiles -->
	</div>
	<!-- /content -->
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
			update_month();
			dashboard_show_gauge();
			dashboard_show_chart();
			dashboard_show_bulb();
			dashboard_show_prec();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			update_month();

			dashboard_show_chart();
			dashboard_show_gauge();
			dashboard_show_bulb();
			dashboard_show_prec();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);
			dashboard_show_chart();
			dashboard_show_gauge();
			dashboard_show_bulb();
			dashboard_show_prec();
		})

		//On Week Change - RCP Status
		$('#weekSelector').on('change', function(){
			week = this.value;
			dashboard_show_prec();
		})

		// Ajax Function
		function dashboard_show_gauge(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>pages/dashboard_show_gauge/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(data_gauge){
					update_dashboard_gauge(data_gauge[0], data_gauge[1], data_gauge[2]);
				}
			});
		}

		function dashboard_show_chart(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>pages/dashboard_show_chart/'+ year,
				async: true,
				dataType: 'json',
				success: function(data_chart){
					update_dashboard_chart(data_chart[0], data_chart[1], data_chart[2]);
					init_chart_doughnut(data_chart[0], data_chart[1], data_chart[2]);
				}
			});
		}

		function dashboard_show_bulb(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>pages/dashboard_show_bulb/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(bulb_data){
					update_dashboard_bulb(bulb_data);
				}
			})
		}

		function dashboard_show_prec(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>pages/dashboard_show_prec/'+ week +'/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(prec_data){
					//Bonds->prec_data[1] Equities->prec_data[2]
					update_dashboard_prec(prec_data[1], prec_data[0], prec_data[2], prec_data[3], prec_data[4], prec_data[5]);
				}
			})
		}

		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>riskBasedCapitals/get_month/'+ year,
				async: false,
				dataType: 'json',
				success: function(months){
					set_months(months);

				}
			});
		}
		// End - Ajax Function

		//Main Dashboard - Assets Monitoring Panel
		function update_dashboard_prec(equities, bonds, mutual_funds, equities_color, bonds_color, mutual_funds_color){
			$('#equities_prec').html(equities);
			$('#bonds_prec').html(bonds);
			$('#mutual_funds_prec').html(mutual_funds);
			$('#equities_prec').css('color', bonds_color);
			$('#bonds_prec').css('color', equities_color);
			$('#mutual_funds_prec').css('color', mutual_funds_color);
		}

		//Main Dashbaord - Investment Risk Limit Panel
		function update_dashboard_bulb(bulb_data){
			if(year > 2017){
				$('#bulb_header').html('Non-Link Investment Allocation Limit');
				$('#compo1').html('Equity');
				$('#compo2').html('Time Deposit');
				$('#compo3').html('Bonds');
				$('#compo4').html('Mutual Fund');
			}else{
				$('#bulb_header').html('Investment Risk Limit');
				$('#compo1').html('Stock');
				$('#compo2').html('IDR Fixed');
				$('#compo3').html('USD Exposure');
				$('#compo4').html('Corporate Bond');
			}
			$('#stock_score').html(bulb_data[0][0]);
			$('#idr_score').html(bulb_data[1][0]);
			$('#usd_score').html(bulb_data[2][0]);
			$('#corporate_bond_score').html(bulb_data[3][0]);
			$('#stock_prec').html(bulb_data[0][1] + " %");
			$('#idr_prec').html(bulb_data[1][1] + " %");
			$('#usd_prec').html(bulb_data[2][1] + " %");
			$('#corporate_bond_prec').html(bulb_data[3][1] + " %");
			$('#stock_color').css('background-color', bulb_data[0][2]);
			$('#idr_color').css('background-color', bulb_data[1][2]);
			$('#usd_color').css('background-color', bulb_data[2][2]);
			$('#corporate_bond_color').css('background-color', bulb_data[3][2]);
		}

		function update_dashboard_chart(done, in_progress, not_yet_started){
			$('#rcp_chart_done').html(done);
			$('#rcp_chart_in_progress').html(in_progress);
			$('#rcp_chart_not_yet_started').html(not_yet_started);
		}

		//Main Dashboard - Doughnut Chart Style
		function init_chart_doughnut(done, in_progress, not_yet_started){

			if( typeof (Chart) === 'undefined'){ return; }

			console.log('init_chart_doughnut');

			if ($('.canvasDoughnut').length){

			var chart_doughnut_settings = {
					type: 'doughnut',
					tooltipFillColor: "rgba(51, 51, 51, 0.55)",
					data: {
						labels: [
							"Done",
							"In progress",
							"Not yet started"
						],
						datasets: [{
							data: [done, in_progress, not_yet_started],
							backgroundColor: [
								"green",
								"orange",
								"red"
							],
							hoverBackgroundColor: [
								"lightgreen",
								"yellow",
								"pink"
							]
						}]
					},
					options: {
						legend: false,
						responsive: false
					}
				}

				$('.canvasDoughnut').each(function(){

					var chart_element = $(this);
					if(window.bar != undefined)
						window.bar.destroy();

					window.bar = new Chart( chart_element, chart_doughnut_settings);

				});

			}

		}

		//Main Dashboard - Gauges
		function update_dashboard_gauge(rbc_score, uw_ratio_score, ga_expense_score){

			//Init Gauge
			var echartGauge_rbc = echarts.init(document.getElementById('echart_gauge_rbc'));
			var echartGauge_uw_ratio = echarts.init(document.getElementById('echart_gauge_uw_ratio'));
			var echartGauge_ga_expense = echarts.init(document.getElementById('echart_gauge_ga_expense'));

			//RBC Gauge Options
			echartGauge_rbc.setOption({
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
					center: ['50%', '38%'],
					startAngle: 140,
					endAngle: -140,
					min: 0,
					max: 2000,
					precision: 0,
					splitNumber: 20,
					axisLine: {
						show: true,
						lineStyle: {
						color: [
							[0.2, '#ff4500'],
							[0.2375, 'orange'],
							[0.5, '#43af24'],
							[1, 'green']
						],
						width: 10
						}
					},
					axisTick: {
						show: true,
						splitNumber: 5,
						length: 4,
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
									return '0';
								case '500':
									return '500 %';
								case '1000':
									return '1000 %';
								case '1500':
									return '1500 %';
								case '2000':
									return '2000 %';
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
						length: 12,
						lineStyle: {
							color: '#333',
							width: 2,
							type: 'solid'
						}
					},
					pointer: {
						length: '90%',
						width: 6,
						color: 'auto'
					},
					title: {
						show: true,
						offsetCenter: ['-100%', -170],
						textStyle: {
							color: '#333',
							fontSize: 30
						}
					},
					detail: {
						show: true,
						backgroundColor: 'rgba(0,0,0,0)',
						borderWidth: 0,
						borderColor: '#ccc',
						width: 100,
						height: 40,
						offsetCenter: ['-70%', 0],
						formatter: '{value}%',
						textStyle: {
							color: 'auto',
							fontSize: 25
						}
					},
					data: [{
						value: rbc_score,
						name: 'RBC'
					}]
				}]
			});

			//UW Ratio Gauge Options
			echartGauge_uw_ratio.setOption({
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
				  center: ['50%', '65%'],
				  startAngle: 180,
				  endAngle: 0,
				  min: 0,
				  max: 50,
				  precision: 0,
				  splitNumber: 5,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.1, '#ff4500'],
						[0.2, 'orange'],
						[1, 'green']
					  ],
					  width: 8
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 9,
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
						  return '0';
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
					length: 9,
					lineStyle: {
					  color: '#333',
					  width: 1.5,
					  type: 'solid'
					}
				  },
				  pointer: {
					length: '100%',
					width: 3,
					color: 'auto'
				  },
				  title: {
					show: true,
					offsetCenter: ['-25%', -90],
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
					offsetCenter: ['10%', 20],
					formatter: '{value}%',
					textStyle: {
					  color: 'auto',
					  fontSize: 20
					}
				  },
				  data: [{
					value: uw_ratio_score,
					name: 'Underwriting Ratio'
				  }]
				}]
			});

			//GA Expense Gauge Option
			echartGauge_ga_expense.setOption({
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
				  center: ['50%', '65%'],
				  startAngle: 180,
				  endAngle: 0,
				  min: 40,
				  max: 220,
				  precision: 0,
				  splitNumber: 18,
				  axisLine: {
					show: true,
					lineStyle: {
					  color: [
						[0.195, 'green'],
						[0.334, 'orange'],
						[0.6 , 'red'],
						[1, '#961c0f']
					  ],
					  width: 8
					}
				  },
				  axisTick: {
					show: true,
					splitNumber: 2,
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
						case '40':
						  return '40 %';
						case '100':
						  return '100 %';
						case '150':
						  return '150 %';
						case '220':
						  return '220 %';
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
					length: 8,
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
					show: true,
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
					value: ga_expense_score,
					name: 'G&A Expense'
				  }]
				}]
				});


		}
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

</script>
</body></html>
