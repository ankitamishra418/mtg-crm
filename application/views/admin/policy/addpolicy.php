<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<div id="wrapper">
    <div class="content">
        <div class="panel_s">
            <div class="panel-body">
            <div class="row">
                    <div class="col-md-6">
                    <h3>Add Policy</h3>
                    </div>
                    <div class="col-md-6">
                        <?php if(isset($client_id)){ ?>
                        <button type="button" class="btn btn-danger" style='float:right;'><a href="<?php echo admin_url('clients/client/' . $client_id . '?group=policies');?>">Close</a></button>
                        <?php } ?>
                    </div>
                </div></br>
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
                        <?php sort($providers); ?>
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
                    </div></br>
                    <div class="row">
                        
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Policy Number</label>
                            <input type="text" class="form-control" id='policy_number' name="policy_number" required>
                            <span id="msg"></span>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Policy Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
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
                            onkeypress="clsAlphaNoOnly(event)" onpaste="return false"  data-type="currency" value="" required>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Policy Fee</label>
                            <input type="text" class="form-control" id="policy_fee" name="policy_fee" data-type="currency" onkeypress="clsAlphaNoOnly(event)" onpaste="return false" required>
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
                            <input type="text" class="form-control" name="total_premium" id="total_premium" onkeypress="clsAlphaNoOnly(event)" onpaste="return false" required>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label><small class="req text-danger"></small>Kiwisaver IRD Number</label>
                            <input type="number" class="form-control" name="ird_number" id="ird_number">
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger"></small>Kiwisaver PIR</label>
                            <input type="text" class="form-control" name="pir" id="pir">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- <label><small class="req text-danger">* </small>Key Contact</label> -->
                            <label>Scheme</label>                                
                            <select class="selectpicker form-control form-control-lg" name="key_contact" id="key_contact" >
                                <option value="">Select</option>
                                <?php foreach($customer_groups as $customer_groups){   ?>
                                <option value="<?php echo $customer_groups['name'];  ?>"><?php echo $customer_groups['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Tag</label>
                            <input type="text" class="form-control" name="tagg" id="tagg" >
                        </div>
                    </div></br>
                    <!-- <div class="row">
                         <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Key Contact Email</label>
                            <input type="email" class="form-control" name="contact_email" required>
                        </div>
                        <div class="col-md-6">
                            <label><small class="req text-danger">* </small>Key Contact Phone</label>
                            <input type="text" class="form-control" name="contact_phone" required>
                        </div>
                    </div></br> -->
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


$('#policy_fee').keyup(function() {
var text            = $('#premium_amount').val();
let result          = text.replace(',','');
let resultt         = result.replace(',','');
let resulttt        = resultt.replace(',','');
let resultttt       = resulttt.replace(',','');
let premium_amount  = resultttt.replace('$','');
var text1           = $('#policy_fee').val();
let result1         = text1.replace(',','');
let resultt1        = result1.replace(',','');
let resulttt1       = resultt1.replace(',','');
let resultttt1      = resulttt1.replace(',','');
let policy_fee      = resultttt1.replace('$','');
var premium_frequency       = $('#premium_frequency').val();
var premium_frequencylower  = premium_frequency.toLowerCase();
if (premium_frequencylower == 'monthly') {
    frequency           = 12;
    let fineltotal      = (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     = (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'weekly') {
    frequency           = 52;
    let fineltotal      = (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     = (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'quarterly') {
    frequency           = 4;
    let fineltotal      = (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     = (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'fortnightly') {
    frequency           = 26;
    let fineltotal      = (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     = (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'bi-annual') {
    frequency           = 2;
    let fineltotal      = (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     = (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'annual') {
    frequency           = 1;
    let fineltotal      = (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     = (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
})
$('#premium_amount').keyup(function() {
var text             =   $('#premium_amount').val();
let result           =   text.replace(',','');
let resultt          =   result.replace(',','');
let resulttt         =   resultt.replace(',','');
let resultttt        =   resulttt.replace(',','');
let premium_amount   =   resultttt.replace('$','');
var text1            =   $('#policy_fee').val();
let result1          =   text1.replace(',','');
let resultt1         =   result1.replace(',','');
let resulttt1        =   resultt1.replace(',','');
let resultttt1       =   resulttt1.replace(',','');
let policy_fee       =   resultttt1.replace('$','');
var premium_frequency       = $('#premium_frequency').val();
var premium_frequencylower  = premium_frequency.toLowerCase();
if (premium_frequencylower == 'monthly') {
    frequency           =   12;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
   let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'weekly') {
    frequency           =   52;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'quarterly') {
    frequency           =   4;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
   let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'fortnightly') {
    frequency           = 26;
    let fineltotal      = (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     = (fineltotal * frequency);
     let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'bi-annual') {
    frequency = 2;
    let fineltotal      = (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     = (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'annual') {
    frequency           =   1;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
})
$('#premium_frequency').change(function() {
var text             =   $('#premium_amount').val();
let result           =   text.replace(',','');
let resultt          =   result.replace(',','');
let resulttt         =   resultt.replace(',','');
let resultttt        =   resulttt.replace(',','');
let premium_amount   =   resultttt.replace('$','');
var text1            =   $('#policy_fee').val();
let result1          =   text1.replace(',','');
let resultt1         =   result1.replace(',','');
let resulttt1        =   resultt1.replace(',','');
let resultttt1       =   resulttt1.replace(',','');
let policy_fee       =   resultttt1.replace('$','');
var premium_frequency = $('#premium_frequency').val();
var premium_frequencylower = premium_frequency.toLowerCase();
if (premium_frequencylower == 'monthly') {
    frequency           =   12;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'weekly') {
    frequency           =   52;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
     let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'quarterly') {
    frequency           =   4;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'fortnightly') {
    frequency           =   26;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
     let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'bi-annual') {
    frequency           =   2;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
    let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
if (premium_frequencylower == 'annual') {
    frequency           =   1;
    let fineltotal      =   (parseFloat(policy_fee) + parseFloat(premium_amount));
    var fineltotall     =   (fineltotal * frequency);
     let formatting_options = {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
    }
    let numberWithDollar = fineltotall.toLocaleString("en-US", formatting_options);
    $("#total_premium").val(numberWithDollar);
}
});

$("input[data-type='currency']").on({
    keypress: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) {
    var input_val = input.val();

    if (input_val === "") { return; }

    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");

    if (input_val.indexOf(".") >= 0) {
    var decimal_pos = input_val.indexOf(".");
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    left_side = formatNumber(left_side);
    right_side = formatNumber(right_side);

    if (blur === "blur") {
        right_side += "00";
    }

    right_side = right_side.substring(0, 2);
    input_val = "$" + left_side + "." + right_side;

    } else {

    input_val = formatNumber(input_val);
    input_val = "$" + input_val;
    if (blur === "blur") {
        input_val += ".00";
    }
    }

    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function clsAlphaNoOnly (e) { 
  var regex = new RegExp("^[0-9+. ]+$");
  var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
  if (regex.test(str)) {
      return true;
  }
  
  e.preventDefault();
  return false;
}
</script>
</body>

</html>