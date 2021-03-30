<div class="right_col" role="main">
	<div class="row">
		<div style="text-align: center;">
	      <div class="col-md-8 col-sm-12 col-xs-12">
	        <div class="x_panel">
	          <div class="x_title">
	            <h2>Create BoD User</h2>
	            <div class="clearfix"></div>
	          </div>
	          <div class="x_content">
	            <br />
            	<form class="form-horizontal form-label-left" action="<?php echo base_url();?>admins/create_bod" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            	<?php echo validation_errors(); ?>


	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="text" name="name" class="form-control col-md-7 col-xs-12" placeholder="Name">
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="text" name="username" class="form-control col-md-7 col-xs-12" placeholder="Username">
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="password" name="password" class="form-control col-md-7 col-xs-12" placeholder="Password" minlength="6">
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="password" name="password2" class="form-control col-md-7 col-xs-12" placeholder="Confirm Password">
	                </div>
	              </div>
	              <div class="ln_solid"></div>
	              <div class="form-group">
	                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	                  <input type="submit" value="Register" class="btn btn-primary">
	                </div>
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
    </div>
</div>