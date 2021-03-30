<div class="right_col" role="main">
	<!-- title & selector -->
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<h3>KPMM Integrated Ratio</h3>
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

	<div class="row">
		<div class="col-md-3 col-xs-6">
			<div class="x_panel tile">
				<div class="x_content">
					<h3 id="actual_capital_score" style="text-align: center">12345678</h3>
					<button id="kpmm_btn_1" class="btn col-md-12 col-xs-12">Actual Capital</button>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="x_panel tile">
				<div class="x_content">
					<h3 id="minimum_capital_score" style="text-align: center">12345678</h3>
					<button id="kpmm_btn_2" class="btn col-md-12 col-xs-12">Minimum Capital</button>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="x_panel tile">
				<div class="x_content">
					<h3 id="kpmm_ir_score" style="text-align: center">12345678</h3>
					<button id="kpmm_btn_3" class="btn col-md-12 col-xs-12">KPMM Integrated Ratio</button>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<h6>Note:</h6>
			<p>KPMM Integrated Ratio = Actual Capital / Minimum Capital</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4 id="kpmm_chart_title">Judul Chart</h4>
				</div>
				<div class="x_content">
					<p id="kpmm_chart_keterangan">*in mio</p>
					<canvas id="kpmm_chart" height="80"></canvas>
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
		var component_kpmm = 1;

		//Init page
		$(document).ready(function(){
			update_month();
			$('#titleYear').html(year);

			$('#kpmm_btn_1').addClass('btn-primary');
			kpmm_ratio_show_score();
			if($(window).width()<=768){
				document.getElementById('kpmm_chart').height = 150;
			}
			kpmm_ratio_show_chart();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			update_month();

			kpmm_ratio_show_score();
			kpmm_ratio_show_chart();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);

			kpmm_ratio_show_score();
			kpmm_ratio_show_chart();
		})

		$('#kpmm_btn_1').on('click', function(){
			component_kpmm = 1;

			$('#kpmm_btn_2').removeClass('btn-primary');
			$('#kpmm_btn_3').removeClass('btn-primary');


			$('#kpmm_btn_1').addClass('btn-primary');
			kpmm_ratio_show_chart();
		})

		$('#kpmm_btn_2').on('click', function(){
			component_kpmm = 2;

			$('#kpmm_btn_1').removeClass('btn-primary');
			$('#kpmm_btn_3').removeClass('btn-primary');


			$('#kpmm_btn_2').addClass('btn-primary');
			kpmm_ratio_show_chart();
		})

		$('#kpmm_btn_3').on('click', function(){
			component_kpmm = 3;

			$('#kpmm_btn_2').removeClass('btn-primary');
			$('#kpmm_btn_1').removeClass('btn-primary');


			$('#kpmm_btn_3').addClass('btn-primary');
			kpmm_ratio_show_chart();
		})

		// Ajax Function
		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>kpmmRatios/get_month/'+ year,
				async: false,
				dataType: 'json',
				success: function(months){
					set_months(months);

				}
			});
		}

		function kpmm_ratio_show_score(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>kpmmRatios/kpmm_ratio_show_score/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(scores){
					update_kpmm_ratio_score(scores);
				}
			});
		}

		function kpmm_ratio_show_chart(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>kpmmRatios/kpmm_ratio_show_chart/'+ component_kpmm,
				async: true,
				dataType: 'json',
				success: function(chart_data){
					update_kpmm_ratio_chart_title();
					update_kpmm_ratio_chart(chart_data[0], chart_data[1]);
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

		function update_kpmm_ratio_score(scores){
			$('#actual_capital_score').html(scores[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
			$('#minimum_capital_score').html(scores[1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
			$('#kpmm_ir_score').html(scores[2] + ' %');
		}

		function update_kpmm_ratio_chart(score, months){
			if($(window).width()<=768){
				var months2 = []; 
				var i = 0;
				var periode = month+'-'+ year.toString().slice(2,4);
				while(months[i] != periode){
					months2.push(months[i]);
					i++;
				}
				monthsEnd = months2.length + 1;
				monthsStart = monthsEnd - 6;
				if(months2.length < 6){
					monthsEnd = 6;
					monthsStart = 0;
				}
				months2 = [];
				for(i = monthsStart; i < monthsEnd; i++){
					months2.push(months[i]);
				}
				months = months2;
			}

			if($(window).width()<=768){
				document.getElementById('kpmm_chart').height = 150;
			}
			datasets =	[
							{
								label: 'Score',
								backgroundColor: '#26B99A',
								fill: false,
								borderColor: 'orange',
								data: score
							}
						];

			var ctx = document.getElementById("kpmm_chart");
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
						              if(component_kpmm != 3	){
						                return value.toString().slice(0, -3);
						              } else {
						                return value + ' %';
						              }
						            }
						  		}
							}]
						}
					}
				}
			);
		}

		function update_kpmm_ratio_chart_title(){
			var component_array = ['Actual Capital', 'Minimum Capital', 'KPMM Integrated Ratio'];
			var kpmm_chart_title = component_array[component_kpmm - 1];
			$('#kpmm_chart_title').html(kpmm_chart_title);
		}
	</script></body></html>
