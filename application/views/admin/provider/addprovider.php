
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
 	<div class="content">
		<div class="panel_s">
			<div class="panel-body">
				<h3>Add Provider</h3>
				</br>
				<form method="post" action="<?php echo base_url(); ?>admin/Provider/saveprovider">
					<div class="row">
						<div class="col-md-6">
							<label>Provider Name</label>
							<input type="text" class="form-control" name="providername">
						</div>
						<div class="col-md-6">
							<label>Provider Email</label>
							<input type="text" class="form-control" name="email">
						</div>
					</div>
					</br>
					<div class="row">
						<div class="col-md-6">
							<label>BDM Name</label>
							<input type="text" class="form-control" name="bdm_name">
						</div>
					    <div class="col-md-6">
							<label>BDM Mobile Number</label>
							<input type="text" class="form-control" name="mobilenumber">
						</div>
                    </div>
					<br>
					<div class="row">
						<div class="col-md-6">
							<label>BDM Email</label>
							<input type="text" class="form-control" name="bdm_email">
						</div>
						<div class="col-md-6">
							<label>Accounts Name</label>
							<input type="text" class="form-control" name="accounts_name">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
							<label>Accounts Email</label>
							<input type="text" class="form-control" name="accounts_email">
						</div>
						<div class="col-md-6">
							<label>Accounts Phone</label>
							<input type="text" class="form-control" name="accounts_phone">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
							<button type="submit" class="btn btn-info">Add</button>
						</div>
					</div>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
				</form>
			</div>
	    </div>
	</div>
</div>
<?php init_tail(); ?>
</body>
</html>