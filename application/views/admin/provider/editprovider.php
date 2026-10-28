<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
   <div class="content">
	    <h3> Edit Section</h3><br>
		<form method="post" action="<?php echo base_url(); ?>admin/Provider/updateprovider/<?php echo $data[0]['id']?>">
			<div class="row">
				<div class="col-md-6">
					<label>Provider Name</label>
					<input type="text" class="form-control" name="providername" value="<?php echo $data[0]['providername']?>">
				</div>
				<div class="col-md-6">
					<label>Provider Email</label>
					<input type="text" class="form-control" name="email" value="<?php echo $data[0]['email']?>">
				</div>
			</div>
			</br>
			<div class="row">
				<div class="col-md-6">
					<label>BDM Number</label>
					<input type="text" class="form-control" name="mobilenumber" value="<?php echo $data[0]['mobilenumber']?>">
				</div>
				<div class="col-md-6">
					<label>BDM Name</label>
					<input type="text" class="form-control" name="bdm_name" value="<?php echo $data[0]['bdm_name']?>">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-6">
					<label>BDM Email</label>
					<input type="text" class="form-control" name="bdm_email" value="<?php echo $data[0]['bdm_email']?>">
				</div>
				<div class="col-md-6">
					<label>Accounts Name</label>
					<input type="text" class="form-control" name="accounts_name" value="<?php echo $data[0]['accounts_name']?>">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-6">
					<label>Accounts Email</label>
					<input type="text" class="form-control" name="accounts_email" value="<?php echo $data[0]['accounts_email']?>">
				</div>
				<div class="col-md-6">
					<label>Accounts Phone</label>
					<input type="text" class="form-control" name="accounts_phone" value="<?php echo $data[0]['accounts_phone']?>">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-6">
					<button type="submit" class="btn btn-info">Update</button>
				</div>
			</div>
		  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
		</form>
	</div>
</div>
<?php init_tail(); ?>
</body>
</html>