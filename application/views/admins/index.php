<div class="right_col" role="main">
	<div class="col-md-6">
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
						</tr>
					</thead>
					<tbody>
						<?php foreach($bod_array as $bod):?>
							<tr>
								<td><?php echo $bod['id']?></td>
								<td><?php echo $bod['username']?></td>
								<td><?php echo $bod['name']?></td>
								<td><?php echo $bod['last_login']?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="x_panel tile">
			<div class="x_title">
				<h4>RIM Staff</h4>
			</div>
			<div class="x_content">
				<table class="table">
					<thead>
						<tr>
							<td><strong>id</strong></td>
							<td><strong>username</strong></td>
							<td><strong>name</strong></td>
							<td><strong>last login</strong></td>
						</tr>
					</thead>
					<tbody>
						<?php foreach($rim_array as $rim):?>
							<tr>
								<td><?php echo $rim['id']?></td>
								<td><?php echo $rim['username']?></td>
								<td><?php echo $rim['name']?></td>
								<td><?php echo $rim['last_login']?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>