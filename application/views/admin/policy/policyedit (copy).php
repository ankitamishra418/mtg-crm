<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<div id="wrapper">
	<div class="content">
		<h3>Update Policy</h3>
		<!-- <div>
		<a href="<?php //echo admin_url('Policy/policyBenefits'); ?>" class="btn btn-info">
		Next
        </a>
		</div> -->
</br>
<form method="post" action="<?php echo base_url(); ?>admin/policy/updatepolicy/<?php echo $data['id'].'/'.$client_id?>?>">
	<div class="row">
		<div class="col-md-6">
		 	<label><small class="req text-danger">* </small>Customer</label>
			 <select class=" selectpicker form-control form-control-lg" data-live-search="true" id="customer" name="customer" required>
				<option value="<?php echo $data['customerid']?>" selected><?php echo $data['customer']?></option>
				<?php foreach ($companey as $val) {?>
				<option value="<?php echo $val['userid']?>">
				<?php echo $val['company']?>
				</option>
				<?php } ?>
			</select>
            <!-- <input type="hidden" class="form-control" value="<?php //echo $data['customer']?>" readonly> -->
		</div>
		<div class="col-md-6">
			<label><small class="req text-danger">* </small>Life Assured</label>
			<select class="selectpicker form-control customer-email-tab" multiple data-live-search="true" id="set_contact" name="life_assured[]" required>
			</select>
            <input type="hidden" class="form-control" value="<?php echo $data['lifeassuredid']?>"  id="lifeAssured" >
		</div>
	</div>
    </br>
	<div class="row">
		<div class="col-md-6">
			<label><small class="req text-danger">* </small>Policy Number</label>
			<input type="text" class="form-control" name="policy_number"  value ="<?php echo $data['policy_number'] ?>" required>
	    </div>

		<div class="col-md-6">
			<label><small class="req text-danger">* </small>Policy Owner</label>
			<select class="selectpicker form-control customer-email-tab_owner" multiple data-live-search="true"name="policy_owner[]" required>

			</select>
            <input type="hidden" class="form-control" value="<?php echo $data['policyownerid']?>" id="policyOwnerId">
        </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label><small class="req text-danger">* </small>Provider</label>
        <select class="form-control form-control-lg" name="provider" required>
		<option value ="<?php echo $data['provider'] ?>" selected><?php echo $data['provider'] ?></option>
        <?php foreach ($providers as $val) {?>
                        <option value="<?php echo $val['providername']?>">
                        <?php echo $val['providername']?>
                        </option>
        <?php }?>
       </select>
	   </div>
	   <div class="col-md-6">
		<label><small class="req text-danger">* </small>Key Contact</label>
		<input type="text" class="form-control" name="key_contact" value ="<?php echo $data['key_contact'] ?>" required>
	   </div>
	</div>
   </br>
	<div class="row">
		<div class="col-md-6">
		<label><small class="req text-danger">* </small>Policy Start Date</label>
		<input type="date" class="form-control" name="start_date" value ="<?php echo $data['start_date'] ?>" required>
	   </div>
	   <div class="col-md-6">
		<label><small class="req text-danger">* </small>Key Contact Email</label>
		<input type="text" class="form-control" name="contact_email" value ="<?php echo $data['contact_email'] ?>" required>
	   </div>
	</div>
	</br>
	<div class="row">
	<div class="col-md-6">
		<label><small class="req text-danger">* </small>Policy Status</label>
		<select class="selectpicker form-control"  data-live-search="true" id="" name="policy_status" required>
		<option value ="<?php echo $data['policy_status'] ?>"selected><?php echo $data['policy_status'] ?></option>
		<option value ='In-force'>In-force</option>
	    <option value ='Out-of-force'>Out-of-force</option>
		</select>
	   </div>
	   <div class="col-md-6">
		<label>Key Contact Phone</label>
		<input type="text" class="form-control" name="contact_phone" value ="<?php echo $data['contact_phone'] ?>" required>
	   </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label><small class="req text-danger">* </small>Policy Review Date</label>
		<input type="date" class="form-control" name="renewal_date"  value ="<?php echo $data['renewal_date'] ?>"required>
	   </div>
	   <div class="col-md-6">
	   <?php //echo $data['lastpolicy_update']; exit;?>
		<label><small class="req text-danger">* </small>Policy Last Updated</label>
		<input type="date" class="form-control" name="lastpolicy_update"  value ="<?php echo $data['lastpolicy_update'] ?>">
	   </div>
	</div>
	<br>
	<div class="row">
	   <div class="col-md-6">
		<label><small class="req text-danger">* </small>Policy Fee</label>
		<input type="text" class="form-control" id="policy_fee" name="policy_fee"  value ="<?php echo $data['policy_fee'] ?>" required>
	   </div>
	   <div class="col-md-6">
		<label><small class="req text-danger">* </small>Cover Type</label>
		<select class="selectpicker form-control form-control-lg" data-live-search="true" name="cover_type" required >
		<option value="<?php echo $data['cover_type'] ?>"selected><?php echo $data['cover_type'] ?></option>
		<?php foreach ($covertype as $val) {?>
                        <option value="<?php echo $val['cover_type']?>">
                        <?php echo $val['cover_type']?>
                        </option>
        <?php }?>
       </select>
	   </div>
	</div>
	<br>
	<div class="row">
	   <div class="col-md-6">
	   <label><small class="req text-danger">* </small>Premium Amount</label>
		<input type="text" class="form-control" name="total_frequency_premium" id="premium_amount"
			value="<?php echo $data['total_frequency_premium'];?>" required>
	   </div>
	</div>
	</br>
	<div class="row">
	<div class="col-md-6">
		<label><small class="req text-danger">* </small>Premium Frequency</label>
        <select class="selectpicker form-control form-control-lg" data-live-search="true" name="premium_frequency" id="premium_frequency" required>
		<option value="<?php echo $data['premium_frequency'] ?>" selected><?php echo $data['premium_frequency'] ?></option>
		<?php foreach ($premiumfrequency as $val) {?>
				<option value="<?php echo $val['premium_frequency']?>">
				<?php echo $val['premium_frequency']?>
				</option>
        <?php }?>
       </select>
	   </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label><small class="req text-danger">* </small>Total Premium</label>
		<input type="text" class="form-control" name="total_premium"  value="<?php echo $data['total_premium'] ?>" id="total_premium" required>
	   </div>
	</div>
	</br>
	</br>
	<div class="row">
		<div class="col-md-6">
			<button type="submit" class="btn btn-info">Update</button>
			<input type="hidden" id="url"  value="<?php echo admin_url('Policy/fetchcustomerContact')?>">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
		</div>
    </div>
</form>
	</div>
</div>
<?php init_tail(); ?>
</body>
<script>
$(document).ready(function(){
	var lifeAssured = $("#lifeAssured").val();
	var policyOwnerId =$("#policyOwnerId").val();
	console.log(lifeAssured);
	console.log(lifeAssured.includes(21));
	var customer = $("#customer").val();
	var url = $("#url").val();
	// $('.customer-email-tab').find('option').remove();
	// $('.customer-email-tab_owner').find('option').remove();
	console.log(url);
		$.ajax({
					url: url,
					type: "POST",
					datatype : "application/json",
					data: {
						'customer': customer,
					},
					success: function (data) {
					console.log(data);
						var obj = JSON.parse(data);
						obj.forEach(function(details, index) {
							if(lifeAssured.includes(details.id)==true){
								$('.customer-email-tab').append('<option value="'+details.id +'" selected>'+details.firstname +' '+ details.lastname+'</option>');
							}else{
								$('.customer-email-tab').append('<option value="'+details.id +'">'+details.firstname +' '+ details.lastname+'</option>');
							}
							if(policyOwnerId.includes(details.id)==true){
								$('.customer-email-tab_owner').append('<option value="'+details.id +'" selected>'+details.firstname +' '+ details.lastname+'</option>');
							}else{
								$('.customer-email-tab_owner').append('<option value="'+details.id +'">'+details.firstname +' '+ details.lastname+'</option>');
							}
							$('.customer-email-tab').selectpicker("refresh");
							$('.customer-email-tab_owner').selectpicker("refresh");
						});
					}
	});
});
</script>
<script>
$(document).ready(function(){
$("#customer").change(function(){
	var customer = $("#customer").val();
	var url = $("#url").val();
	$('.customer-email-tab').find('option').remove();
	$('.customer-email-tab_owner').find('option').remove();
	$('.customer-email-tab_owner').selectpicker("refresh");
	$('.customer-email-tab').selectpicker("refresh");
	console.log(url);
		$.ajax({
					url: url,
					type: "POST",
					datatype : "application/json",
					data: {
						'customer': customer,
					},
					success: function (data) {
					console.log(data);
						var obj = JSON.parse(data);
						obj.forEach(function(details, index) {
							$('.customer-email-tab_owner').append('<option value="'+details.id +'">'+details.firstname +' '+ details.lastname+'</option>');
							$('.customer-email-tab').append('<option value="'+details.id +'">'+details.firstname +' '+ details.lastname+'</option>');
							$('.customer-email-tab').selectpicker("refresh");
							$('.customer-email-tab_owner').selectpicker("refresh");
						});
						}
	});
});
});

// primium frequency calcullation 
$('#policy_fee').keyup(function() {
    var premium_amount = $('#premium_amount').val();
    var policy_fee = $('#policy_fee').val();
    var premium_frequency = $('#premium_frequency').val();
  
    if (premium_frequency == 'monthly') {
        frequency = 12;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
    if (premium_frequency == 'weekly') {
        frequency = 52;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
    if (premium_frequency == 'half yearly') {
        frequency = 2;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
    if (premium_frequency == 'quarterly') {
        frequency = 3;

        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
})

$('#premium_amount').keyup(function() {
    var premium_amount = $('#premium_amount').val();
    var policy_fee = $('#policy_fee').val();
    var premium_frequency = $('#premium_frequency').val();
  
    if (premium_frequency == 'monthly') {
        frequency = 12;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
    if (premium_frequency == 'weekly') {
        frequency = 52;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
    if (premium_frequency == 'half yearly') {
        frequency = 2;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
    if (premium_frequency == 'quarterly') {
        frequency = 3;

        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
})

$('#premium_frequency').change(function() {

    var premium_amount = $('#premium_amount').val();
    var policy_fee = $('#policy_fee').val();
    var premium_frequency = $('#premium_frequency').val();

    if (premium_frequency == 'monthly') {
        frequency = 12;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
    if (premium_frequency == 'weekly') {
        frequency = 52;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
    if (premium_frequency == 'half yearly') {
        frequency = 2;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
    if (premium_frequency == 'quarterly') {
        frequency = 3;
        let fineltotal = (parseInt(policy_fee) + parseInt(premium_amount));
        var fineltotall = (fineltotal * frequency);
        $("#total_premium").val(fineltotall);
    }
})
</script>
</html>