<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/ico" />

		<title>RIM Dashboard | BNI Life</title>

	<!-- Bootstrap -->
	    <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	    <!-- Font Awesome -->
	    <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	    <!-- NProgress -->
	    <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">

	    <!-- Custom Theme Style -->
	    <link href="<?php echo base_url(); ?>build/css/custom.css" rel="stylesheet">

	</head>



	<body class="nav-md">

		<div class="container body">

			<div class="main_container">

				<div class="col-md-3 left_col">

					<div class="left_col scroll-view" >

						<div class="navbar nav_title" style="border: 0;">

							<img src="<?php echo base_url(); ?>assets/images/favicon.ico" style="max-height: 50px;display: inline;">
							<a style="display: inline;" href="<?php echo base_url(); ?>pages/index" class="site_title"><span style="color: #73879c;">RIM Dashboard</span></a>

						</div>

						<div class="clearfix"></div>

						<!-- menu profile quick info -->

						<!-- /menu profile quick info -->
						<br />
						<!-- sidebar menu -->

						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

							<div class="menu_section">

								<ul class="nav side-menu">

									<li>

										<a href="<?php echo base_url(); ?>pages/index"><i class="fa fa-desktop"></i> Main Dashboard</a>

									</li>

									<li>

										<a><i class="fa fa-tasks"></i> Risk Control Plan Status</a>

										<ul class="nav child_menu">

											<li><a href="<?php echo base_url(); ?>rcpStatus/index">Status</a></li>
											<li><a href="<?php echo base_url(); ?>rcpStatus/detail">Detail</a></li>
											<li><a href="<?php echo base_url(); ?>bpp">Buku Pedoman Perusahaan</a></li>

										</ul>

									</li>

									<li>

										<a><i class="fa fa-signal"></i> Risk Control Plan Report</a>

										<ul class="nav child_menu">

											<li><a href="<?php echo base_url(); ?>riskBasedCapitals">RBC Monitoring</a></li>
											<li><a href="<?php echo base_url(); ?>leadingRiskIndicators">Leading Risk Indicator</a></li>
											<li><a href="<?php echo base_url(); ?>unrealizedGainLosses">Investment Assets</a></li>
											<li><a href="<?php echo base_url(); ?>kpmmRatios">KPMM Integrated Ratio</a></li>
											<li><a href="<?php echo base_url();?>gaExpenses">General & Admin Expense</a></li>

										</ul>

									</li>
									<?php if($this->session->userdata['rim'] == true):?>
										<li>
											<a><i class="fa fa-book"></i>Update Data</a>
											<ul class="nav child_menu">
												<li><a href="<?php echo base_url();?>uploads/app_upload">via App</a></li>
												<li><a href="<?php echo base_url();?>uploads/bulk_upload">via Excel (Bulk)</a></li>
											</ul>
										</li>
									<?php endif;?>

								</ul>

							</div>

						</div>

						<!-- /sidebar menu -->

					</div>

				</div>
				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<nav>
							<div class="nav toggle">
								<a id="menu_toggle"><i class="fa fa-bars" style="color: black"></i></a>

							</div>
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<?php echo $this->session->userdata['name']?>
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li>
											<?php if($this->session->userdata['admin'] == true):?>
												<li><a href="<?php echo base_url();?>admins/index"><i class="fa fa-user pull-right"></i> Admin Area</a></li>
												<li><a href="<?php echo base_url();?>admins/change_password"><i class="fa fa-key pull-right"></i> Change Password</a></li>
												<li><a href="<?php echo base_url();?>admins/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
											<?php else:?>
												<li><a href="<?php echo base_url();?>users/change_password"><i class="fa fa-key pull-right"></i> Change Password</a></li>
												<li><a href="<?php echo base_url();?>users/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
											<?php endif; ?>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				
				
				<!-- /top navigation -->
