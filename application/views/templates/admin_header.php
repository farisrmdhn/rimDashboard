<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/ico" />

		<title>ADMIN AREA</title>

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
							<a style="display: inline;" href="<?php echo base_url(); ?>admins/index" class="site_title"><span style="color: #73879c;">Admin Area</span></a>

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

										<a href="<?php echo base_url()?>admins/index"><i class="fa fa-home"></i>Home</a>

									</li>

									<p style="color: black;margin-left: 5px;"><strong>User Control</strong></p>

									<li>

										<a><i class="fa fa-user"></i>Board of Director</a>

										<ul class="nav child_menu">

											<li><a href="<?php echo base_url();?>admins/create_bod">Create</a></li>
											<li><a href="<?php echo base_url();?>admins/manage_bod">Manage</a></li>

										</ul>

									</li>

									<li>

										<a><i class="fa fa-user"></i>RIM Staff</a>

										<ul class="nav child_menu">

											<li><a href="<?php echo base_url();?>admins/create_rim">Create</a></li>
											<li><a href="<?php echo base_url();?>admins/manage_rim">Manage</a></li>

										</ul>

									</li>

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
								<a id="menu_toggle"><i class="fa fa-bars" style="color: #0d7492"></i></a>

							</div>
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<?php echo $this->session->userdata['username']?>
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<li><a href="<?php echo base_url();?>"><i class="fa fa-desktop pull-right"></i>User Area</a></li>
										<li><a href="<?php echo base_url();?>admins/change_password"><i class="fa fa-key pull-right"></i> Change Password</a></li>
										<li><a href="<?php echo base_url();?>admins/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- /top navigation -->
