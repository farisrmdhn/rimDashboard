<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<h3>Risk Control Plan Status</h3>
			<p><span id="titleYear"></span></p>
		</div>
	</div>

	<!-- top tiles -->
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="row">
				<div class="x_panel">
					<select id="yearSelector" class="form-control">
						<?php for($i = 0; $i < sizeof($years)-1; $i++):?>
							<option value="<?php echo $years[$i]['tahun']?>"><?php echo $years[$i]['tahun']?></option>
						<?php endfor;?>
						<option id="yearNow" value="<?php echo $years[sizeof($years)-1]['tahun']?>" selected><?php echo $years[sizeof($years)-1]['tahun']?></option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="x_panel">
					<table class="col-md-12 col-xs-12 table" style="text-align: center;";>
						<tr>
							<td>No</td>
							<td>Risk Category </td>
							<td colspan="2">Status</td>
						</tr>
						<tbody id="data_table">

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4>Risk Control Plan Status on <span id="titleStatusYear"></span></h4>
				</div>
				<div class="x_content" >
					<table width="100%" style="text-align: center;">
						<tr>
							<td>
								<canvas class="canvasDoughnut_status" height="200" width="200"></canvas>
							</td>
						</tr>
						<tr>
							<td height="50"></td>
						</tr>
						<tr>
							<td>
								<table  width="100%" class="table">
									<tr>
										<td>
										  <p><i class="fa fa-square" style="color: green;"></i></p>
										</td>
										<td>
										  <p>Done</p>
										</td>
										<td><span id="rcp_chart_done"></span> %</td>
									</tr>
									<tr>
										<td>
										  <p><i class="fa fa-square" style="color: orange;"></i></p>
										</td>
										<td>
										  <p>In Progress </p>
										</td>
										<td><span id="rcp_chart_in_progress"></span>%</td>
									</tr>
									<tr>
										<td>
										  <p><i class="fa fa-square" style="color: red;"></i></p>
										</td>
										<td>
										  <p>Not yet started </p>
										</td>
										<td><span id="rcp_chart_not_yet_started"></span>%</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		</div>
	</div>
	<!-- /top tiles -->

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
		var year = $('#yearSelector').val();

		//Init page
		$(document).ready(function(){
			$('#titleYear').html(year);
			$('#titleStatusYear').html(year);
			rcp_status_show_chart();
			rcp_status_show_table();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			$('#titleStatusYear').html(year);
			rcp_status_show_table();
			rcp_status_show_chart();
		})

		// Ajax Function
		function rcp_status_show_chart(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>pages/dashboard_show_chart/'+ year,
				async: true,
				dataType: 'json',
				success: function(data_chart){
					update_rcp_status_chart(data_chart[0], data_chart[1], data_chart[2]);
					init_chart_doughnut_status(data_chart[0], data_chart[1], data_chart[2]);
				}
			});
		}

		function rcp_status_show_table(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>rcpStatus/rcp_status_show_table/'+ year,
				async: true,
				dataType: 'json',
				success: function(data_table){
					update_rcp_status_table(data_table);
				}
			});
		}

		//Main Dashboard- RCP Chart
		//sepertinya bisa diastukan sama rcpStatus/Status
		function update_rcp_status_chart(done, in_progress, not_yet_started){
			$('#rcp_chart_done').html(done);
			$('#rcp_chart_in_progress').html(in_progress);
			$('#rcp_chart_not_yet_started').html(not_yet_started);
		}

		//rcpStatus Doughnut Chart Style
		function init_chart_doughnut_status(done, in_progress, not_yet_started){

			if( typeof (Chart) === 'undefined'){ return; }

			console.log('init_chart_doughnut');

			if ($('.canvasDoughnut_status').length){

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
						legend: true,
						responsive: false
					}
				}

				$('.canvasDoughnut_status').each(function(){

					var chart_element = $(this);
					if(window.bar != undefined)
						window.bar.destroy();

					window.bar = new Chart( chart_element, chart_doughnut_settings);

				});

			}
		}

			function update_rcp_status_table(data_table){
			var html = "<tr>"+
						"<td>1</td>"+
						"<td style='text-align : left;' ><p>"+data_table[0]['risk_category']+"</p></td>"+
						"<td><p>"+data_table[0]['status_precentage']+" %</p></td>"+
						"<td><p>"+data_table[0]['status_string']+"</p></td>"+
						"</tr>" +
						"<tr>"+
						"<td>2</td>"+
						"<td style='text-align : left;' ><p>"+data_table[1]['risk_category']+"</p></td>"+
						"<td><p>"+data_table[1]['status_precentage']+" %</p></td>"+
						"<td><p>"+data_table[1]['status_string']+"</p></td>"+
						"</tr>" +
						"<tr>"+
						"<td>3</td>"+
						"<td style='text-align : left;' ><p>"+data_table[2]['risk_category']+"</p></td>"+
						"<td><p>"+data_table[2]['status_precentage']+" %</p></td>"+
						"<td><p>"+data_table[2]['status_string']+"</p></td>"+
						"</tr>" +
						"<tr>"+
						"<td>4</td>"+
						"<td style='text-align : left;' ><p>"+data_table[3]['risk_category']+"</p></td>"+
						"<td><p>"+data_table[3]['status_precentage']+" %</p></td>"+
						"<td><p>"+data_table[3]['status_string']+"</p></td>"+
						"</tr>" +
						"<tr>"+
						"<td>5</td>"+
						"<td style='text-align : left;' ><p>"+data_table[4]['risk_category']+"</p></td>"+
						"<td><p>"+data_table[4]['status_precentage']+" %</p></td>"+
						"<td><p>"+data_table[4]['status_string']+"</p></td>"+
						"</tr>" +
						"<tr>"+
						"<td>6</td>"+
						"<td style='text-align : left;' ><p>"+data_table[5]['risk_category']+"</p></td>"+
						"<td><p>"+data_table[5]['status_precentage']+" %</p></td>"+
						"<td><p>"+data_table[5]['status_string']+"</p></td>"+
						"</tr>" +
						"<tr>"+
						"<td>7</td>"+
						"<td style='text-align : left;' ><p>"+data_table[6]['risk_category']+"</p></td>"+
						"<td><p>"+data_table[6]['status_precentage']+" %</p></td>"+
						"<td><p>"+data_table[6]['status_string']+"</p></td>"+
						"</tr>" +
						"<tr>"+
						"<td>8</td>"+
						"<td style='text-align : left;' ><p>"+data_table[7]['risk_category']+"</p></td>"+
						"<td><p>"+data_table[7]['status_precentage']+" %</p></td>"+
						"<td><p>"+data_table[7]['status_string']+"</p></td>"+
						"</tr>"
						;
			$('#data_table').html(html);
		}
		</script></body></html>