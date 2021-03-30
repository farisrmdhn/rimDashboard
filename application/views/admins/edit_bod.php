<div class="right_col" role="main">
	<div class="row">
		<div style="text-align: center;">
	      <div class="col-md-8 col-sm-12 col-xs-12">
	        <div class="x_panel">
	          <div class="x_title">
	            <h2>Edit BoD User</h2>
	            <div class="clearfix"></div>
	          </div>
	          <div class="x_content">
	            <br />
            	<form class="form-horizontal form-label-left" action="<?php echo base_url();?>admins/edit_bod/<?php echo $bod['id']; ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            	<?php echo validation_errors(); ?>


	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="text" name="name" class="form-control col-md-7 col-xs-12" value="<?php echo $bod['name']; ?>">
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="text" name="username" class="form-control col-md-7 col-xs-12" value="<?php echo $bod['username']; ?>">
	                </div>
	              </div>
	  			  <p style="color: red;">Hanya diisi jika ingin mengganti password</p>
	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="password" name="password" class="form-control col-md-7 col-xs-12" value="">
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                  <input type="password" name="password2" class="form-control col-md-7 col-xs-12" value="">
	                </div>
	              </div>
	              <div class="ln_solid"></div>
	              <div class="form-group">
	                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	                  <input type="hidden" name="key" value="1">
	                  <input type="hidden" name="id" value="<?php echo $bod['id']; ?>">
	                  <input type="hidden" name="default_username" value="<?php echo $bod['username']; ?>">
	                  <input type="hidden" name="default_password" value="<?php echo $bod['password']; ?>">
	                  <input type="submit" value="Update" class="btn btn-primary">
	                </div>
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
    </div>
</div>