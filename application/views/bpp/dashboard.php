<div class="right_col" role="main">
	<!-- title & selector -->
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<h3>Buku Pedoman Perusahaan</h3>
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
						<?php for($i = 0; $i < sizeof($years) - 1; $i++):?>
							<option value="<?php echo $years[$i]['year']?>"><?php echo $years[$i]['year']?></option>
						<?php endfor;?>
						<option id="yearNow" value="<?php echo $years[sizeof($years)-1]['year']?>" selected><?php echo $years[sizeof($years)-1]['year']?></option>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="x_panel tile">
				<div class="x_content">
					<p>Already Certified : <span id="alreadyCertified"></span></p>
					<canvas id="mybarChart_bpp" height="275" style="border-top: 1px solid #ccc; padding-top: 10px;"></canvas>
					<div id="errMsg" style="font-weight: bold; font-size: 15pt; color: red;"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="x_panel tile">
				<div class="x_title">
					<h4 class="col-md-2">Unit : </h4>
					<div class="col-md-10">
						<select class="form-control" id="unitSelector">
						</select>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<table class="table">
						<tr>
							<td>BPP</td>
							<td>No Sertifikat</td>
						</tr>
						<tbody id="bpp_table">

						</tbody>
					</table>
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
		var unit = 'BANCASSURANCE';
		//Init page
		$(document).ready(function(){
			update_month();
			$('#titleYear').html(year);

			bpp_show_chart();
			bpp_show_selector();
			bpp_show_sum();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			update_month();
			$('#titleYear').html(year);

			bpp_show_chart();
			bpp_show_selector();
			bpp_show_sum();
		})

		//On Month Change
		$('#monthSelector').on('change', function(){
			month = this.value;
			$('#titleMonth').html(month);

			bpp_show_chart();
			bpp_show_selector();
			bpp_show_sum();
		})

		//On Unit Change - BPP
		$('#unitSelector').on('change', function(){
			unit = this.value;
			bpp_show_table();
		})

		//AJAX
		function bpp_show_chart(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bpp/bpp_show_chart/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(chart_data){
					update_bpp_chart(chart_data);
				}
			});
		}

		function bpp_show_table(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bpp/bpp_show_table/'+ unit +'/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(table_data){
					update_bpp_table(table_data);
				}
			});
		}

		function bpp_show_selector(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bpp/bpp_show_selector/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(selector_data){
					update_bpp_selector(selector_data);
				}
			});
		}


		function bpp_show_sum(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bpp/bpp_show_sum/'+ month +'/'+ year,
				async: true,
				dataType: 'json',
				success: function(sum_data){
					update_bpp_sum(sum_data);
				}
			});
		}

		function update_month(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>bpp/get_month/'+ year,
				async: false,
				dataType: 'json',
				success: function(months){
					set_months(months);

				}
			});
		}
		// End - Ajax Function


		//BPP -start
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
		function update_bpp_chart(chart_data){
			if(chart_data.length > 1){
				var unit = [];
				var sum = [];
				for(var i = 0; i < chart_data.length; i++){
					unit.push(chart_data[i]['unit']);
					sum.push(chart_data[i]['sum'])
				}
				var ctx = document.getElementById("mybarChart_bpp");
				if(window.bar != undefined)
					window.bar.destroy();

				window.bar = new Chart(
					ctx, {
						type: 'horizontalBar',
						data: {
							labels: unit,
							datasets: [{
							label: 'Jumlah : ',
							backgroundColor: "#26B99A",
							data: sum
						}]
						},
						options: {
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
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
					                        var y_pos = model.y+5;
					                        var x_pos = model.x+5;
					                        ctx.fillText(dataset.data[i], x_pos, y_pos);
					                    }
					                });
					            }
					        }
						}
					}
				);
				$('#errMsg').html('');
			}else {
				$('#errMsg').html('Data Tidak Tersedia');
			}
		}

		function update_bpp_selector(selector_data){
			var html = '<option>SELECT UNIT<option>';
			for(var i = 0; i < selector_data.length; i++){
				//Valuenya dirubah, yg spasi jadi dash, yg & jadi dan biar bisa dibaca CI
				var str = selector_data[i]['unit'];
				html += '<option value="'+ str.replace(',', 'koma').replace('&', 'dan').replace(/\s+/g, '-').toLowerCase() +'">'+ selector_data[i]['unit'] +'</option>';
			}
			$('#unitSelector').html(html);
		}

		function update_bpp_table(table_data){
			var html = '';
			for(var i = 0; i < table_data.length; i++){
				html += '<tr><td>'+ table_data[i]['bpp'] +'</td><td>'+ table_data[i]['no_sertifikasi'] +'</td></tr>'
			}
			$('#bpp_table').html(html);
		}

		function update_bpp_sum(sum_data){
			$('#alreadyCertified').html(sum_data)
		}
		//BPP - end

	</script>
	</body>
</html>

