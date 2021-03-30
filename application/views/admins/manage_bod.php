<div class="right_col" role="main">
	<div class="col-md-10">
		<div class="x_panel tile">
			<div class="x_title">
				<h4>Board of directors</h4>
			</div>
			<div class="x_content">
				<table class="table">
					<thead>
						<tr>
							<td><strong>id</strong></td>
							<td><strong>username</strong></td>
							<td><strong>name</strong></td>
							<td><strong>last login</strong></td>
							<td class="col-md-1"><strong>Action</strong></td>
							<td class="col-md-1"></td>
						</tr>
					</thead>
					<tbody>
						<?php foreach($bod_array as $bod):?>
							<tr>
								<td><?php echo $bod['id']?></td>
								<td><?php echo $bod['username']?></td>
								<td><?php echo $bod['name']?></td>
								<td><?php echo $bod['last_login']?></td>
								<td>
									<a class="btn btn-success" href="<?php echo base_url();?>admins/edit_bod/<?php echo $bod['id']?>">Edit</a>
								</td>
								<td>
									<form method="post" action="<?php echo base_url();?>admins/delete" id="form">
										<input type="hidden" name="id" value="<?php echo $bod['id']?>">
										<input type="hidden" name="key" value="1">
										<button id="btn" class="btn btn-danger" onclick="test()">Delete</button>
									</form>
									<script type="text/javascript">
										function test(){
											var r = confirm('Are you sure?');
											if(r == true){
												$('#form').submit();
											}else{
												return false;
											}
										}
									</script>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>