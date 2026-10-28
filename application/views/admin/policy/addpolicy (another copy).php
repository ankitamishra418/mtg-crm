<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<div id="wrapper">
    <div class="content">
        <div class="panel_s">
            <div class="panel-body">
                <h3>New Policy</h3></br>
                <form method="post" action="<?php echo base_url('admin/policy/savepolicy/'.$client_id); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Client</label>
                            <?php if(isset($client_id)) {?>
                            <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                id="customer" name="customer" required>
                                <?php foreach ($companey as $val) { if($val['userid']==$client_id){?>
                                <option value="<?php echo $val['userid']?>" selected>
                                    <?php echo $val['company']?>
                                </option>
                                <?php }}?>
                            </select>
                            <?php } else { ?>
                            <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                id="customer" name="customer" required>
                                <option value>Select</option>
                                <?php foreach ($companey as $val) {?>
                                <option value="<?php echo $val['userid']?>">
                                    <?php echo $val['company']?>
                                </option>
                                <?php }?>
                            </select>
                            <?php }?>
                        </div>
                        <!-- <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Policy Last Updated</label>
                            <input type="date" class="selectpicker form-control form-control-lg"
                                name="lastpolicy_update" value="<?php echo $data['lastpolicy_update'] ?>">
                        </div> -->
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Policy Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Provider</label>
                            <select class="selectpicker form-control " name="provider" required>
                                <option value="">Select</option>
                                <?php foreach ($providers as $val) {?>
                                <option value="<?php echo $val['providername']?>">
                                    <?php echo $val['providername']?>
                                </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Policy Number</label>
                            <input type="text" class="form-control" id='policy_number' name="policy_number" required>
                            <span id="msg"></span>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Policy Status</label>
                            <select class="selectpicker form-control" data-live-search="true" id="" name="policy_status"
                                required>
                                <option value="">Select</option>
                                <?php foreach ($policystatus as $val){?>
                                <option value="<?php echo $val['status_type'] ?>">
                                    <?php echo $val['status_type'] ?>
                                    <?php } ?>
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Cover Type</label>
                            <select class="selectpicker form-control form-control-lg" data-live-search="true"
                                name="cover_type" required>
                                <option value="">Select</option>
                                <?php foreach ($covertype as $val) {?>
                                <option value="<?php echo $val['cover_type']?>">
                                    <?php echo $val['cover_type']?>
                                </option>
                                <?php }?>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Life Assured</label>
                            <select class="selectpicker form-control customer-email-tab" multiple
                                data-live-search="true" id="set_contact" name="life_assured[]" required>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Policy Owner</label>
                            <select class="selectpicker form-control customer-email-tab_owner" multiple
                                data-live-search="true" name="policy_owner[]" required>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                      
                        <!-- <div class="col-md-6"> -->
                            <!-- <label><small class="req text-danger">* </small>Policy Review Date</label> -->
                            <!-- <label><small class="req text-danger">* </small>Policy Anniversary Date</label>
                            <input type="date" class="form-control" name="renewal_date" required>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Premium Amount</label>
                            <input type="text" class="form-control" name="total_frequency_premium" id="premium_amount"
                                value="" required>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Policy Fee</label>
                            <input type="text" class="form-control" id="policy_fee" name="policy_fee" required>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Premium Frequency</label>
                            <select class="selectpicker form-control form-control-lg" data-live-search="true"
                                name="premium_frequency" id="premium_frequency" required>
                                <option value="">Select</option>
                                <?php foreach ($premiumfrequency as $val) {?>
                                <option value="<?php echo $val['premium_frequency']?>">
                                    <?php echo $val['premium_frequency']?>
                                </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Annual Premium</label>
                            <input type="text" class="form-control" name="total_premium" id="total_premium" required>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <label>Reminder Date</label> -->
                            <label><small class="req text-danger">* </small>Key Contact Email</label>
                            <input type="email" class="form-control" name="contact_email" required>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Key Contact</label>
                            <input type="text" class="form-control" name="key_contact" required>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Key Contact Phone</label>
                            <input type="text" class="form-control" name="contact_phone" required>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Tag</label>
                            <input type="text" class="form-control" name="tagg" id="tagg" required>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info">Save</button>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                                value="<?php echo $this->security->get_csrf_hash();?>">
                            <input type="hidden" id="url" value="<?php echo admin_url('Policy/fetchcustomerContact')?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$(document).ready(function() {
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
        datatype: "application/json",
        data: {
            'customer': customer,
        },
        success: function(data) {
            console.log(data);
            var obj = JSON.parse(data);
            obj.forEach(function(details, index) {
                $('.customer-email-tab_owner').append('<option value="' + details.id +
                    '">' + details.firstname + ' ' + details.lastname + '</option>');
                $('.customer-email-tab').append('<option value="' + details.id + '">' +
                    details.firstname + ' ' + details.lastname + '</option>');
                $('.customer-email-tab').selectpicker("refresh");
                $('.customer-email-tab_owner').selectpicker("refresh");
            });
        }
    });
    $("#customer").change(function() {
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
            datatype: "application/json",
            data: {
                'customer': customer,
            },
            success: function(data) {
                console.log(data);
                var obj = JSON.parse(data);
                obj.forEach(function(details, index) {
                    $('.customer-email-tab_owner').append('<option value="' +
                        details.id + '">' + details.firstname + ' ' + details
                        .lastname + '</option>');
                    $('.customer-email-tab').append('<option value="' + details.id +
                        '">' + details.firstname + ' ' + details.lastname +
                        '</option>');
                    $('.customer-email-tab').selectpicker("refresh");
                    $('.customer-email-tab_owner').selectpicker("refresh");
                });
            }
        });
    });
});

// check policy Number is allready exists
$("#policy_number").blur(function() {
    var policyNumber = $(this).val();
    var actionurl = "<?php echo base_url('admin/policy/policyNumber_exists')?>"
    $.ajax({
        type: "post",
        url: actionurl,
        datatype: "application/json",
        data: {
            policyNumber: policyNumber
        },
        success: function(response) {
            if (response == 0) {
                $('#msg').html('');
            } else {
                $('#msg').html('<span style="color:red;">Policy Number Is Already Exists</span>');
                $("#policy_number").val('');
            }
        }
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
</body>

</html>
