<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<h3>Risk Control Plan Details</h3>
			<p><span id="titleYear"></span></p>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="x_content">
				<div class="col-md-12 col-xs-12">
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

	<!-- top tiles -->
	<div class="row">
		<div class="col-md-12">
			
			<div class="row">
				<div class="x_panel">
					<div class="x_content">
						<table class="col-md-12 table" style="text-align: center; font-size: 9pt;" border="1">
							<tr>
								<td>Risk</td>
								<td>Project Task</td>
								<td>Task Owner</td>
								<td>Est. Complete Date</td>
								<td>Actual Complete Date</td>
								<td>Status</td>
								<td>Remarks</td>
								<?php if($this->session->userdata['logged_in'] == true && $this->session->userdata['rim'] == true):?>
									<td></td>
								<?php endif;?>
							</tr>
							<tbody id="data_table">
							</tbody>
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
			rcp_detail_show_table();
		})

		//On Year Change
		$('#yearSelector').on('change', function(){
			year = this.value;
			$('#titleYear').html(year);
			$('#titleStatusYear').html(year);
			rcp_detail_show_table();
		})

		// Ajax Function
		function rcp_detail_show_table(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url(); ?>rcpStatus/rcp_detail_show_table/'+ year,
				async: true,
				dataType: 'json',
				success: function(data_table){
					update_rcp_detail_table(data_table);
				}
			});
		}

		//Main Dashboard- RCP Chart

			function update_rcp_detail_table(data_table){
			var html = '';

			for(var i=0; i < data_table.length; i++)
			html +=	"<tr style='text-align : left;' >"+
					"<td><p>"+data_table[i]['risk']+"</p></td>"+
					"<td><p>"+data_table[i]['project_task']+"</p></td>"+
					"<td><p>"+data_table[i]['task_owner']+"</p></td>"+
					"<td><p>"+data_table[i]['est_complete_date']+"</p></td>"+
					"<td><p>"+data_table[i]['actual_complete_date']+"</p></td>"+
					"<td><p>"+data_table[i]['status']+"</p></td>"+
					"<td><p>"+data_table[i]['comment']+"</p></td>"+
					"<?php if($this->session->userdata['logged_in'] == true && $this->session->userdata['rim'] == true):?>"+
					"<td><a class='btn btn-success' href='<?php echo base_url();?>rcpStatus/edit_detail/"+data_table[i]['id']+"'>Edit</a></td>"+
					"<?php endif;?>"+
					"</tr>";
			$('#data_table').html(html);
		}
		</script></body></html>