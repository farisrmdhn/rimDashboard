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
<div class="right_col" role="main">
	<!-- top navigation -->
	<div class="top_nav">

		<div class="nav_menu">

			<nav>
				<img src="<?php echo base_url(); ?>assets/images/favicon.ico" style="max-height: 50px;display: inline;">
				<a style="display: inline;" href="<?php echo base_url(); ?>pages/index" class="site_title"><span style="color: #73879c;">RIM Dashboard</span></a>
			</nav>

		</div>

	</div>
	<?php if($this->session->flashdata('login_failed')): ?>
		<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>';?>
	<?php endif;?>
	<div class="row">
		<div style="text-align: center;">
	      <div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-4">
	        <div class="x_panel">
	          <div class="x_title">
	            <h2><?= $title?></h2>
	            <div class="clearfix"></div>
	          </div>
	          <div class="x_content">
	            <br />
            	<form class="form-horizontal form-label-left" action="<?php echo base_url();?>users/login" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            		<?php echo validation_errors(); ?>

	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="text" name="username" class="form-control col-md-7 col-xs-12">
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="password" name="password" class="form-control col-md-7 col-xs-12">
	                </div>
	              </div>
	              <div class="ln_solid"></div>
	              <div class="form-group">
	                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	                  <input type="submit" value="Sign in" class="btn btn-primary">
	                </div>
	              </div>
	            </form>
	            <div style="text-align: right;">
	    			<a href="<?php echo base_url();?>admins/login">Admin</a>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
    </div>
</div>