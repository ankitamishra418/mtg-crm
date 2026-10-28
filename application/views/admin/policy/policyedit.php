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
        <form method="post"
            action="<?php echo base_url(); ?>admin/policy/updatepolicy/<?php echo $data['id'].'/'.$client_id?>?>">
            <div class="row">
                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Client</label>
                    <select class=" selectpicker form-control form-control-lg" data-live-search="true" id="customer"
                        name="customer" required>
                        <option value="<?php echo $data['customerid']?>" selected><?php echo $data['customer']?>
                        </option>
                        <?php foreach ($companey as $val) {?>
                        <option value="<?php echo $val['userid']?>">
                            <?php echo $val['company']?>
                        </option>
                        <?php } ?>
                    </select>
                    <!-- <input type="hidden" class="form-control" value="<?php //echo $data['customer']?>" readonly> -->
                </div>
                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Provider</label>
                    <select class="form-control form-control-lg" name="provider" required>
                        <option value="<?php echo $data['provider'] ?>" selected><?php echo $data['provider'] ?>
                        </option>
                        <?php foreach ($providers as $val) {?>
                        <option value="<?php echo $val['providername']?>">
                            <?php echo $val['providername']?>
                        </option>
                        <?php }?>
                    </select>
                </div>


            </div>
            </br>
            <div class="row">

                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Policy Number</label>
                    <input type="text" class="form-control" name="policy_number"
                        value="<?php echo $data['policy_number'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Policy Start Date</label>
                    <input type="date" class="form-control" name="start_date" value="<?php echo $data['start_date'] ?>"
                        required>
                </div>

                <!-- <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Policy Owner</label>
                    <select class="selectpicker form-control customer-email-tab_owner" multiple data-live-search="true"
                        name="policy_owner[]" required>

                    </select>
                    <input type="hidden" class="form-control" value="<?php echo $data['policyownerid']?>"
                        id="policyOwnerId">
                </div> -->
            </div>
            </br>
            <div class="row">
                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Policy Status</label>
                    <select class="selectpicker form-control" data-live-search="true" id="" name="policy_status"
                        required>
                        <option value="">Select</option>
                                <option value="<?php echo $data['policy_status'] ?>" selected><?php echo $data['policy_status'] ?>
                            </option>
                        <?php foreach ($policystatus as $val){?>
                        <option value="<?php echo $val['status_type'] ?>">
                            <?php echo $val['status_type'] ?>
                            <?php } ?>
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Cover Type</label>
                    <select class="selectpicker form-control form-control-lg" data-live-search="true" name="cover_type"
                        required>
                        <option value="<?php echo $data['cover_type'] ?>" selected><?php echo $data['cover_type'] ?>
                        </option>
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
                    <label><small class="req text-danger">* </small>Life Assured</label>
                    <select class="selectpicker form-control customer-email-tab" multiple data-live-search="true"
                        id="set_contact" name="life_assured[]" required>
                    </select>
                    <input type="hidden" class="form-control" value="<?php echo $data['lifeassuredid']?>"
                        id="lifeAssured">

                </div>

                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Policy Owner</label>
                    <select class="selectpicker form-control customer-email-tab_owner" multiple data-live-search="true"
                        name="policy_owner[]" required>

                    </select>
                    <input type="hidden" class="form-control" value="<?php echo $data['policyownerid']?>"
                        id="policyOwnerId">
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Premium Amount</label>
                    <input type="text" class="form-control" name="total_frequency_premium" id="premium_amount"
                    data-type="currency"  value="<?php echo $data['total_frequency_premium'];?>" required>
                </div>

                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Policy Fee</label>
                    <input type="text" class="form-control" name="policy_fee" id="policy_fee"
                    data-type="currency" value="<?php echo $data['policy_fee'] ?>" required>
                </div>

                <!-- <div class="col-md-6">
                    <label>Key Contact Phone</label>
                    <input type="text" class="form-control" name="contact_phone"
                        value="<?php echo $data['contact_phone'] ?>" required>
                </div> -->
            </div>
            </br>
            <!-- <div class="row">
                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Policy Review Date</label>
                    <input type="date" class="form-control" name="renewal_date"
                        value="<?php echo $data['renewal_date'] ?>" required>
                </div>
            </div>
            <br> -->
            <div class="row">
                <!-- <div class="col-md-6">
                <?php //echo $data['lastpolicy_update']; exit;?>
                    <label><small class="req text-danger">* </small>Policy Last Updated</label>
                    <input type="date" class="form-control" name="lastpolicy_update"
                        value="<?php //echo $data['lastpolicy_update'] ?>">
                </div> -->
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Premium Frequency</label>
                    <select class="selectpicker form-control form-control-lg" data-live-search="true"
                        name="premium_frequency" id="premium_frequency" required>
                        <option value="<?php echo $data['premium_frequency'] ?>" selected>
                            <?php echo $data['premium_frequency'] ?></option>
                        <?php foreach ($premiumfrequency as $val) {?>
                        <option value="<?php echo $val['premium_frequency']?>">
                            <?php echo $val['premium_frequency']?>
                        </option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label><small class="req text-danger">* </small>Annual Premium</label>
                    <input type="text" class="form-control" name="total_premium"
                        value="<?php echo $data['total_premium'] ?>" id="total_premium" required readonly>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <label><small class="req text-danger"></small>Kiwisaver IRD Number</label>
                    <input type="number" class="form-control" name="ird_number"
                        value="<?php echo $data['ird_number'] ?>" id="irdb_number">
                </div>
                <div class="col-md-6">
                    <label><small class="req text-danger"></small>Kiwisaver PIR</label>
                    <input type="text" class="form-control" name="pir" value="<?php echo $data['pir'] ?>"
                        id="pir">
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <label>Scheme</label>
                    <select class="selectpicker form-control form-control-lg" data-live-search="true" name="key_contact"
                        >

                        <option value="<?php echo $data['key_contact'] ?>" selected><?php echo $data['key_contact'] ?>
                        </option>
                       
                        <?php foreach($customer_groups as $customer_groups){   ?>
                        <option value="<?php echo $customer_groups['name']; ?>">
                            <?php echo $customer_groups['name']; ?>
                        </option>
                        <?php }?>
                    </select>

                </div>
                <div class="col-md-6">
                    <label>Tag</label>

                    <input type="text" class="form-control" name="tagg"
                        value="<?php echo $data['tagg'] ?>" id="tagg" >
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-info">Update</button>
                    <input type="hidden" id="url" value="<?php echo admin_url('Policy/fetchcustomerContact')?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                        value="<?php echo $this->security->get_csrf_hash();?>">
                </div>
            </div>
        </form>
    </div>
</div>
<?php init_tail(); ?>
</body>
<script>
$(document).ready(function() {
    var lifeAssured = $("#lifeAssured").val();
    var policyOwnerId = $("#policyOwnerId").val();
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
        datatype: "application/json",
        data: {
            'customer': customer,
        },
        success: function(data) {
            console.log(data);
            var obj = JSON.parse(data);
            obj.forEach(function(details, index) {
                if (lifeAssured.includes(details.id) == true) {
                    $('.customer-email-tab').append('<option value="' + details.id +
                        '" selected>' + details.firstname + ' ' + details.lastname +
                        '</option>');
                } else {
                    $('.customer-email-tab').append('<option value="' + details.id + '">' +
                        details.firstname + ' ' + details.lastname + '</option>');
                }
                if (policyOwnerId.includes(details.id) == true) {
                    $('.customer-email-tab_owner').append('<option value="' + details.id +
                        '" selected>' + details.firstname + ' ' + details.lastname +
                        '</option>');
                } else {
                    $('.customer-email-tab_owner').append('<option value="' + details.id +
                        '">' + details.firstname + ' ' + details.lastname + '</option>');
                }
                $('.customer-email-tab').selectpicker("refresh");
                $('.customer-email-tab_owner').selectpicker("refresh");
            });
        }
    });
});
</script>
<script>
$(document).ready(function() {
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
var regex = new RegExp("^[0-9+.]+$");
var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
if (regex.test(str)) {
  return true;
}

e.preventDefault();
return false;
}
</script>

</html>