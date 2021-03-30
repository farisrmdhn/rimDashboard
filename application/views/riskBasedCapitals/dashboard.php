<div class="right_col" role="main">
	<!-- title & selector -->
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<h3>RBC Monitoring</h3>
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
		<div class="col-md-3 col-xs-12">
			<div class="row">
				<div class="x_panel tile">
					<div class="x_content">
						<h4>Regulation : <span id="regulation"></span></h4>
						<small>New Regulation since Aug '17</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="x_panel tile">
					<div class="x_title">
						<h4>RBC</h4>
					</div>
					<div class="x_content">
						<div class="row">
							<div class="col-md-8 col-xs-8">
								<button id="rbcm_btn_1" class="btn col-md-12 col-xs-12">RBC Conventional</button>
							</div>
							<div class="col-md-4 col-xs-4">
								<h4 id="rbcm_1" style="text-align: center;">730.05%</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 col-xs-8">
								<button id="rbcm_btn_2" class="btn col-md-12 col-xs-12">RBC Sharia Tabarru</button>
							</div>
							<div class="col-md-4 col-xs-4">
								<h4 id="rbcm_2" style="text-align: center;">730.05%</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 col-xs-8">
								<button id="rbcm_btn_3" class="btn col-md-12 col-xs-12">RBC Sharia SHF</button>
							</div>
							<div class="col-md-4 col-xs-4">
								<h4 id="rbcm_3" style="text-align: center;">730.05%</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="x_panel tile">
					<div class="x_content">
						<label>
							Component RBC
						</label>
						<select id="componentSelector" class="form-control">\
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9 col-xs-12">
			<div class="x_panel tile">
				<div class="x_title">
					<h4><span id="chartRbc" style="color: #333;"></span> - <span id="chartComponent" style="color: #333;"></span></h4>
				</div>
				<div class="x_content">
					<p id="barChart_rbc_keterangan"></p>
					<canvas id="mybarChart_rbc" height="120"></canvas>
					<div id="barChart_legend">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12" id="rbc_note">
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
<script src="<?php echo base_url(); ?>vendors/Chart.js/dist/Chart.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo base_url(); ?>build/js/custom.min.js"></script>
<!-- gauge.js -->
<script src="<?php echo base_url(); ?>vendors/gauge.js/dist/gauge.min.js"></script>


<!-- AJAX Script -->
<script type="text/javascript">
	var month;
	var year = $('#yearSelector').val();
	var rbc = 1;
	var component = '.RBC';
	var regulation = 'new';
	
	$(document).ready(function(){
		update_month();
		$('#titleYear').html(year);

		rbc_monitoring_show_regulation();
		rbc_monitoring_show_score();
		$('#rbcm_btn_1').addClass('btn-primary');
		rbc_monitoring_show_selector();
		rbc_monitoring_show_chart();
		rbc_monitoring_show_note();
	})

	$('#yearSelector').on('change', function(){
		year = this.value;
		$('#titleYear').html(year);
		update_month();

		rbc_monitoring_show_regulation();
		rbc_monitoring_show_score();
		rbc_monitoring_show_selector();
		rbc_monitoring_show_note();
		rbc_monitoring_show_chart();
	})

	$('#monthSelector').on('change', function(){
		month = this.value;
		$('#titleMonth').html(month);
		
		rbc_monitoring_show_regulation();
		rbc_monitoring_show_score();
		rbc_monitoring_show_selector();
		rbc_monitoring_show_note();
		rbc_monitoring_show_chart();
	})

	$('#componentSelector').on('change', function(){
		component = this.value;
		rbc_monitoring_show_chart();
		// var component_id = '#'+this.value;
		// $(component_id).
	})

	$('#rbcm_btn_1').on('click', function(){
		rbc = 1;

		$('#rbcm_btn_2').removeClass('btn-primary');
		$('#rbcm_btn_3').removeClass('btn-primary');

		$('#rbcm_btn_1').addClass('btn-primary');
		rbc_monitoring_show_selector();
		rbc_monitoring_show_chart();
	})

	$('#rbcm_btn_2').on('click', function(){
		rbc = 2;

		$('#rbcm_btn_1').removeClass('btn-primary');
		$('#rbcm_btn_3').removeClass('btn-primary');


		$('#rbcm_btn_2').addClass('btn-primary');
		rbc_monitoring_show_selector();
		rbc_monitoring_show_chart();
	})

	$('#rbcm_btn_3').on('click', function(){
		rbc = 3;

		$('#rbcm_btn_2').removeClass('btn-primary');
		$('#rbcm_btn_1').removeClass('btn-primary');


		$('#rbcm_btn_3').addClass('btn-primary');
		rbc_monitoring_show_selector();
		rbc_monitoring_show_chart();
	})

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

	function rbc_monitoring_show_score(){
		$.ajax({
			type: 'ajax',
			url: '<?php echo base_url(); ?>riskBasedCapitals/rbc_monitoring_show_score/'+ month +'/'+ year +'/'+ regulation,
			async: true,
			dataType: 'json',
			success: function(rbc_score){
				update_rbc_monitoring_score(rbc_score);
			}
		});
	}

	function rbc_monitoring_show_selector(){
		$.ajax({
			type: 'ajax',
			url: '<?php echo base_url(); ?>riskBasedCapitals/rbc_monitoring_show_selector/'+ rbc +'/'+ month +'/'+ year,
			async: true,
			dataType: 'json',
			success: function(selector_data){
				update_rbc_monitoring_selector(selector_data);
			}
		});
	}

	function rbc_monitoring_show_chart(){
		$.ajax({
			type: 'ajax',
			url: '<?php echo base_url(); ?>riskBasedCapitals/rbc_monitoring_show_chart/'+ rbc +'/'+ year +'/'+ regulation +'/'+ component,
			async: true,
			dataType: 'json',
			success: function(chart_data){
				update_rbc_monitoring_chart(chart_data);
			}
		});
	}

	function rbc_monitoring_show_note(){
		$.ajax({
			type: 'ajax',
			url: '<?php echo base_url(); ?>riskBasedCapitals/rbc_monitoring_show_note/'+ month +'/'+ year,
			async: true,
			dataType: 'json',
			success: function(note){
				$('#rbc_note').html(note['note']);
			}
		});
	}

	//RBC Monitoring - start
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
	function rbc_monitoring_show_regulation(){
		if(year == 2016){
			regulation = 'old';
			$('#regulation').html('Old Regulation');
			$('#rbcm_btn_3').hide();
			$('#rbcm_3').hide();
		}else if (year == 2017) {
			if((month == 'Jan') || (month == 'Feb') || (month == 'Mar') || (month == 'Apr') || (month == 'May') || (month == 'Jun') || (month == 'Jul')){
				regulation = 'old';
				$('#regulation').html('Old Regulation');
				$('#rbcm_btn_3').hide();
				$('#rbcm_3').hide();
			}else{
				regulation = 'new';
				$('#regulation').html('New Regulation');
				$('#rbcm_btn_3').show();
				$('#rbcm_3').show();
			}
		}else {
			regulation = 'new';
			$('#regulation').html('New Regulation');
			$('#rbcm_btn_3').show();
			$('#rbcm_3').show();
		}
	}

	function update_rbc_monitoring_score(rbc_score){
		if(regulation == 'new'){
			$('#rbcm_3').html(rbc_score[2] + '%');
		}
		$('#rbcm_1').html(rbc_score[0] + '%');
		$('#rbcm_2').html(rbc_score[1] + '%');
	}

	function update_rbc_monitoring_selector(selector_data){
		var html = '';
		for(var i = 0; i < selector_data.length; i++){
			var  str = selector_data[i];
			var str_value = str.replace(/\s+/g, '-');
			if(str_value == component){
				html += '<option value="'+ str_value +'" selected>'+ selector_data[i] +'</option>';
			}else{
				html += '<option value="'+ str_value +'">'+ selector_data[i] +'</option>';
			}
		}
		$('#componentSelector').html(html);
	}

	function update_rbc_monitoring_chart(chart_data){
		var namaRbc = ['RBC Conventional', 'RBC Sharia Tabarru', 'RBC Sharia SHF'];
		$('#chartRbc').html(namaRbc[rbc-1]);
		$('#chartComponent').html(component.replace('-', ' '));
		var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		if(year == 2017 && regulation == 'old'){
			months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
		}
		if(year == 2017 && regulation == 'new'){
			months = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		}
		var datasets = [];
		if(component == '.RBC'){
			var score = [];
			for(var i = 0; i < chart_data.length; i++){
				score.push(chart_data[i]);
			}
			datasets =	[{
							label: 'RBC',
							backgroundColor: "#26B99A",
							data: score
						}];
			var html = '<div class="col-md-2"><i class="fa fa-square" style="color : #26B99A"></i> RBC</div>'
			$('#barChart_legend').html(html);
		}

		if(component == '1.-Solvability'){
			var score = [];
			var score2 = [];
			for(var i = 0; i < months.length; i++){
				score.push(chart_data[months[i]][0]);
				score2.push(chart_data[months[i]][1]);
			}
			datasets =	[
							{
								label: 'Assets',
								backgroundColor: "#26B99A",
								data: score
							},
							{
								label: 'Liabilities',
								backgroundColor: "orange",
								data: score2
							}
						];

			var html = '<div class="col-md-2"><i class="fa fa-square" style="color : #26B99A"></i> Assets</div>' +
						'<div class="col-md-2"><i class="fa fa-square" style="color : orange"></i> Liabilities</div>';
			$('#barChart_legend').html(html);
		}

		if(component == '1a.-Admitted-Asset'){
			if(regulation == 'old'){
				var score = [];
				var score2 = [];
				for(var i = 0; i < months.length; i++){
					score.push(chart_data[months[i]][0]);
					score2.push(chart_data[months[i]][1]);
				}
				datasets =	[
								{
									label: 'Investment',
									backgroundColor: "#26B99A",
									data: score
								},
								{
									label: 'Non Investment',
									backgroundColor: "orange",
									data: score2
								}
							];

				var html = '<div class="col-md-2"><i class="fa fa-square" style="color : #26B99A"></i> Investment</div>' +
							'<div class="col-md-2"><i class="fa fa-square" style="color : orange"></i> Non Investment</div>';
				$('#barChart_legend').html(html);
			}
			if(regulation == 'new'){
				if(rbc == 1){
					var score = [];
					var score2 = [];
					for(var i = 0; i < months.length; i++){
						score.push(chart_data[months[i]][0]);
						score2.push(chart_data[months[i]][1]);
					}
					datasets =	[
									{
										label: 'Traditional',
										backgroundColor: "#26B99A",
										data: score
									},
									{
										label: 'PAYDI',
										backgroundColor: "orange",
										data: score2
									}
								];

					var html = '<div class="col-md-2"><i class="fa fa-square" style="color : #26B99A"></i> Traditional</div>' +
								'<div class="col-md-2"><i class="fa fa-square" style="color : orange"></i> PAYDI</div>';
					$('#barChart_legend').html(html);
				}
				if(rbc == 2 || rbc == 3){
					var score = [];
					for(var i = 0; i < months.length; i++){
						score.push(chart_data[months[i]][0]);
					}
					datasets =	[
									{
										label: 'Admitted Assets',
										backgroundColor: "#26B99A",
										data: score
									}
								];

					var html = '<div class="col-md-2"><i class="fa fa-square" style="color : #26B99A"></i>Admitted Assets</div>';
					$('#barChart_legend').html(html);
				}
			}
		}

		if(component == '1b.-Liabilities'){
			if(regulation == 'old'){
				var score = [];
				var score2 = [];
				var score3 = [];

				for(var i = 0; i < months.length; i++){
					score.push(chart_data[months[i]][0]);
					score2.push(chart_data[months[i]][1]);
					score3.push(chart_data[months[i]][2]);
				}
				if(rbc == 1){
					datasets =	[
									{
										label: 'Estimated Claim Liabilities',
										backgroundColor: "#26B99A",
										data: score
									},
									{
										label: 'Future Policy Benefits',
										backgroundColor: "orange",
										data: score2
									},
									{
										label: 'Unearned Premium',
										backgroundColor: "green",
										data: score3
									}
								];

					var html = '<div class="col-md-4"><i class="fa fa-square" style="color : #26B99A"></i> Estimated Claim Liabilities</div>' +
								'<div class="col-md-4"><i class="fa fa-square" style="color : orange"></i> Future Policy Benefits</div>' +
								'<div class="col-md-4"><i class="fa fa-square" style="color : green"></i> Unearned Premium</div>';
					$('#barChart_legend').html(html);
				}
				if(rbc ==2){
					datasets =	[
									{
										label: 'Claim Reserves',
										backgroundColor: "#26B99A",
										data: score
									},
									{
										label: 'Contribution Reserves',
										backgroundColor: "orange",
										data: score2
									},
									{
										label: 'Unrealized Contribution',
										backgroundColor: "green",
										data: score3
									}
								];

					var html = '<div class="col-md-4"><i class="fa fa-square" style="color : #26B99A"></i> Claim Reserves</div>' +
								'<div class="col-md-4"><i class="fa fa-square" style="color : orange"></i> Contribution Reserves Benefits</div>' +
								'<div class="col-md-4"><i class="fa fa-square" style="color : green"></i> Unrealized Contribution</div>';
					$('#barChart_legend').html(html);
				}
			}
			if(regulation == 'new'){
				if(rbc == 1){
					var score = [];
					var score2 = [];
					for(var i = 0; i < months.length; i++){
						score.push(chart_data[months[i]][0]);
						score2.push(chart_data[months[i]][1]);
					}
					datasets =	[
									{
										label: 'Traditional',
										backgroundColor: "#26B99A",
										data: score
									},
									{
										label: 'PAYDI',
										backgroundColor: "orange",
										data: score2
									}
								];

					var html = '<div class="col-md-4"><i class="fa fa-square" style="color : #26B99A"></i> Traditional</div>' +
								'<div class="col-md-4"><i class="fa fa-square" style="color : orange"></i> PAYDI</div>';
					$('#barChart_legend').html(html);
				}
				if(rbc == 2 || rbc == 3){
					var score = [];
					for(var i = 0; i < months.length; i++){
						score.push(chart_data[months[i]][0]);
					}
					datasets =	[
									{
										label: 'Liabilities',
										backgroundColor: "#26B99A",
										data: score
									}
								];

					var html = '<div class="col-md-4"><i class="fa fa-square" style="color : #26B99A"></i>Liabilities</div>';
					$('#barChart_legend').html(html);
				}
			}
		}

		if(component == '2.-MMBR'){
			if(regulation == 'old'){
				if(rbc == 1){
					var score = [];
					var score2 = [];
					var score3 = [];
					var score4 = [];
					var score5 = [];
					var score6 = [];
					var score7 = [];
					var score8 = [];

					for(var i = 0; i < months.length; i++){
						score.push(chart_data[months[i]][0]);
						score2.push(chart_data[months[i]][1]);
						score3.push(chart_data[months[i]][2]);
						score4.push(chart_data[months[i]][3]);
						score5.push(chart_data[months[i]][4]);
						score6.push(chart_data[months[i]][5]);
						score7.push(chart_data[months[i]][6]);
						score8.push(chart_data[months[i]][7]);
					}
					datasets =	[
									{
										label: 'Schedule A',
										backgroundColor: "#26B99A",
										data: score
									},
									{
										label: 'Schedule B',
										backgroundColor: "orange",
										data: score2
									},
									{
										label: 'Schedule C',
										backgroundColor: "green",
										data: score3
									},
									{
										label: 'Schedule D',
										backgroundColor: "yellow",
										data: score4
									},
									{
										label: 'Schedule E',
										backgroundColor: "red",
										data: score5
									},
									{
										label: 'Schedule F',
										backgroundColor: "blue",
										data: score6
									},
									{
										label: 'Schedule G',
										backgroundColor: "lightgreen",
										data: score7
									},
									{
										label: 'Schedule H',
										backgroundColor: "grey",
										data: score8
									}
								];

					var html = '<div class="col-md-2"><i class="fa fa-square" style="color : #26B99A"></i> Schedule A</div>' +
								'<div class="col-md-2"><i class="fa fa-square" style="color : orange"></i> Schedule B</div>' +
								'<div class="col-md-2"><i class="fa fa-square" style="color : green"></i> Schedule C</div>'+
								'<div class="col-md-2"><i class="fa fa-square" style="color : yellow"></i> Schedule D</div>' +
								'<div class="col-md-2"><i class="fa fa-square" style="color : red"></i> Schedule E</div>'+
								'<div class="col-md-2"><i class="fa fa-square" style="color : blue"></i> Schedule F</div>'+
								'<div class="col-md-2"><i class="fa fa-square" style="color : lightgreen"></i> Schedule G</div>' +
								'<div class="col-md-2"><i class="fa fa-square" style="color : grey"></i> Schedule H</div>'
								;
					$('#barChart_legend').html(html);
				}
				if(rbc ==2){
					var score = [];
					var score2 = [];
					var score3 = [];
					var score4 = [];
					var score5 = [];
					var score6 = [];

					for(var i = 0; i < months.length; i++){
						score.push(chart_data[months[i]][0]);
						score2.push(chart_data[months[i]][1]);
						score3.push(chart_data[months[i]][2]);
						score4.push(chart_data[months[i]][3]);
						score5.push(chart_data[months[i]][4]);
						score6.push(chart_data[months[i]][5]);
					}
					datasets =	[
									{
										label: 'Schedule A',
										backgroundColor: "#26B99A",
										data: score
									},
									{
										label: 'Schedule B',
										backgroundColor: "orange",
										data: score2
									},
									{
										label: 'Schedule C',
										backgroundColor: "green",
										data: score3
									},
									{
										label: 'Schedule D',
										backgroundColor: "yellow",
										data: score4
									},
									{
										label: 'Schedule E',
										backgroundColor: "red",
										data: score5
									},
									{
										label: 'Schedule F',
										backgroundColor: "blue",
										data: score6
									}
								];

					var html = '<div class="col-md-2"><i class="fa fa-square" style="color : #26B99A"></i> Schedule A</div>' +
								'<div class="col-md-2"><i class="fa fa-square" style="color : orange"></i> Schedule B</div>' +
								'<div class="col-md-2"><i class="fa fa-square" style="color : green"></i> Schedule C</div>'+
								'<div class="col-md-2"><i class="fa fa-square" style="color : yellow"></i> Schedule D</div>' +
								'<div class="col-md-2"><i class="fa fa-square" style="color : red"></i> Schedule E</div>' +
								'<div class="col-md-2"><i class="fa fa-square" style="color : blue"></i> Schedule F</div>'
								;									;
					$('#barChart_legend').html(html);
				}
			}
			if(regulation == 'new'){
				var score = [];
				var score2 = [];
				var score3 = [];
				var score4 = [];
				var score5 = [];
				for(var i = 0; i < months.length; i++){
					score.push(chart_data[months[i]][0]);
					score2.push(chart_data[months[i]][1]);
					score3.push(chart_data[months[i]][2]);
					score4.push(chart_data[months[i]][3]);
					score5.push(chart_data[months[i]][4]);
				}
				datasets =	[
								{
									label: 'Credit Risk',
									backgroundColor: "#26B99A",
									data: score
								},
								{
									label: 'Liquidity Risk',
									backgroundColor: "orange",
									data: score2
								},
								{
									label: 'Market Risk',
									backgroundColor: "green",
									data: score3
								},
								{
									label: 'Insurance Risk',
									backgroundColor: "yellow",
									data: score4
								},
								{
									label: 'Operational Risk',
									backgroundColor: "red",
									data: score5
								}
							];

				var html = '<div class="col-md-2"><i class="fa fa-square" style="color : #26B99A"></i> Credit Risk</div>' +
							'<div class="col-md-2"><i class="fa fa-square" style="color : orange"></i> Liquidity Risk</div>' +
							'<div class="col-md-2"><i class="fa fa-square" style="color : green"></i> Market Risk</div>'+
							'<div class="col-md-2"><i class="fa fa-square" style="color : yellow"></i> Insurance Risk</div>' +
							'<div class="col-md-3"><i class="fa fa-square" style="color : red"></i> Operational Risk</div>';
				$('#barChart_legend').html(html);
			}
		}

		if(component == '2a.-Credit-Risk'){
			var score = [];
			var score2 = [];
			var score3 = [];
			for(var i = 0; i < months.length; i++){
				score.push(chart_data[months[i]][0]);
				score2.push(chart_data[months[i]][1]);
				score3.push(chart_data[months[i]][2]);
			}
			datasets =	[
							{
								label: 'Asset Investment Default Risk',
								backgroundColor: "#26B99A",
								data: score
							},
							{
								label: 'Asset Non Investment Default Risk',
								backgroundColor: "orange",
								data: score2
							},
							{
								label: 'Reinsurance Risk',
								backgroundColor: "green",
								data: score3
							}
						];

			var html = '<div class="col-md-4"><i class="fa fa-square" style="color : #26B99A"></i> Asset Investment Default Risk</div>' +
						'<div class="col-md-4"><i class="fa fa-square" style="color : orange"></i> Asset Non Investment Default Risk</div>' +
						'<div class="col-md-4"><i class="fa fa-square" style="color : green"></i> Reinsurance Risk</div>'
						;
			$('#barChart_legend').html(html);
		}

		if(component == '2b.-Liquidity-Risk'){
			if(rbc == 1){
				var score = [];
				var score2 = [];
				for(var i = 0; i < months.length; i++){
					score.push(chart_data[months[i]][0]);
					score2.push(chart_data[months[i]][1]);
				}
				datasets =	[
								{
									label: 'Asset Liability Mismatch Risk',
									backgroundColor: "#26B99A",
									data: score
								},
								{
									label: 'Premium Reserve PAYDI',
									backgroundColor: "orange",
									data: score2
								}
							];

				var html = '<div class="col-md-4"><i class="fa fa-square" style="color : #26B99A"></i> Asset Liability Mismatch Risk</div>' +
							'<div class="col-md-3"><i class="fa fa-square" style="color : orange"></i> Premium Reserve PAYDI</div>'
							;
				$('#barChart_legend').html(html);
			}

			if((rbc == 2) || (rbc == 3)	){
				var score = [];
				for(var i = 0; i < months.length; i++){
					score.push(chart_data[months[i]][0]);
				}
				datasets =	[
								{
									label: 'Asset Liability Mismatch Risk',
									backgroundColor: "#26B99A",
									data: score
								}
							];

				var html = '<div class="col-md-6"><i class="fa fa-square" style="color : #26B99A"></i> Asset Liability Mismatch Risk</div>'
							;
				$('#barChart_legend').html(html);
			}

		}

		if(component == '2c.-Market-Risk'){
			var score = [];
			var score2 = [];
			var score3 = [];
			for(var i = 0; i < months.length; i++){
				score.push(chart_data[months[i]][0]);
				score2.push(chart_data[months[i]][1]);
				score3.push(chart_data[months[i]][2]);
			}
			datasets =	[
							{
								label: 'Asset Default Risk',
								backgroundColor: "#26B99A",
								data: score
							},
							{
								label: 'Currency Mismatch Risk',
								backgroundColor: "orange",
								data: score2
							},
							{
								label: 'Interest Rate Changes',
								backgroundColor: "green",
								data: score3
							}
						];

			var html = '<div class="col-md-4"><i class="fa fa-square" style="color : #26B99A"></i> Asset Default Risk</div>' +
						'<div class="col-md-4"><i class="fa fa-square" style="color : orange"></i> Currency Mismatch Risk</div>' +
						'<div class="col-md-4"><i class="fa fa-square" style="color : green"></i> Interest Rate Changes</div>'
						;
			$('#barChart_legend').html(html);
		}

		if(component == '2d.-Insurance-Risk'){
			var score = [];
			var score2 = [];
			var score3 = [];
			var score4 = [];
			for(var i = 0; i < months.length; i++){
				score.push(chart_data[months[i]][0]);
				score2.push(chart_data[months[i]][1]);
				score3.push(chart_data[months[i]][2]);
				score4.push(chart_data[months[i]][4]);
			}
			datasets =	[
							{
								label: 'Premium Reserve',
								backgroundColor: "#26B99A",
								data: score
							},
							{
								label: 'Unearned Premium Reserve',
								backgroundColor: "orange",
								data: score2
							},
							{
								label: 'Claim Reserve',
								backgroundColor: "green",
								data: score3
							},
							{
								label: 'Catastrophic Reserve',
								backgroundColor: "yellow",
								data: score4
							}
						];

			var html = '<div class="col-md-3"><i class="fa fa-square" style="color : #26B99A"></i> Premium Reserve</div>' +
						'<div class="col-md-3"><i class="fa fa-square" style="color : orange"></i> Unearned Premium Reserve</div>' +
						'<div class="col-md-3"><i class="fa fa-square" style="color : green"></i> Claim Reserve</div>'+
						'<div class="col-md-3"><i class="fa fa-square" style="color : yellow"></i> Catastrophic Reserve</div>'
						;
			$('#barChart_legend').html(html);
		}

		if(component == '2e.-Operational-Risk'){
			if(rbc == 1){
				var score = [];
				var score2 = [];
				for(var i = 0; i < months.length; i++){
					score.push(chart_data[months[i]][0]);
					score2.push(chart_data[months[i]][1]);
				}
				datasets =	[
								{
									label: 'Operational Risk',
									backgroundColor: "#26B99A",
									data: score
								},
								{
									label: 'Operational Risk PAYDI',
									backgroundColor: "orange",
									data: score2
								}
							];

				var html = '<div class="col-md-4"><i class="fa fa-square" style="color : #26B99A"></i> Operational Risk</div>' +
							'<div class="col-md-4"><i class="fa fa-square" style="color : orange"></i> Operational Risk PAYDI</div>'
							;
				$('#barChart_legend').html(html);
			}

			if(rbc == 2 || rbc == 3){
				var score = [];
				for(var i = 0; i < months.length; i++){
					score.push(chart_data[months[i]][0]);
				}
				datasets =	[
								{
									label: 'Operational Risk',
									backgroundColor: "#26B99A",
									data: score
								}
							];

				var html = '<div class="col-md-3"><i class="fa fa-square" style="color : #26B99A"></i> Operational Risk</div>'
							;
				$('#barChart_legend').html(html);
			}

		}

		var ctx = document.getElementById("mybarChart_rbc");
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
							}
						}]
					}
				}
			}
		);
	}
</script>
</body></html>
