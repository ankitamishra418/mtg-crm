<style>
    .d-none{
        display:none;
    }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4>Underwriting</h4>
<div class="claims-feed">
    <div class="content">
        <form method="post" action="<?php echo base_url('admin/projects/saveUnderwriting');?>">
            <div class="row">
                <div class="col-md-6">

                <div class="row">
                        <div class="col-md-12">
                          
                            <label>Advice Activity</label>                                    
                            <select class="selectpicker form-control customer-email-tab" data-live-search="true" id="unerwriting" name="related_project_id">
                                <option value="">Select</option>
                                <?php foreach ($client_resp_project as $vall)
                                { ?>
                                <option value="<?php echo $vall['id']?>" <?php if ($vall['id'] == $underwritingDetails[0]['related_project_id']) { echo 'selected'; } ?>>
                                    <?php 
                                    echo $vall['id']; echo" - ";
                                    echo $vall['name']; ?> 
                                </option>
                                <?php 
                                } ?>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Submitted API </label>
                            <input type="text" class="form-control" name="submitted_api" data-type='currency' id="myinput" 
                            <?php   $username = $underwritingDetails[0]['submitted_api'];?>
                            value="<?php echo $username ?>">
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Submitted Date</label>
                            <input type="date" class="form-control" name="submitted_date" value="<?php echo $underwritingDetails[0]['submitted_date']; ?>" >
                        </div>
                    </div></br>
                    
                <!--</br>
                    <div class="row ">
                        <div class="col-md-12">
                            <label>Referrer</label>
                            <select class="selectpicker form-control customer-email-tab"
                                data-live-search="true" id="set_contact" name="commission_split" >
                                <option value="">Select</option>
                                <?php //foreach ($commisionsplit as $val){ ?>
                                <option value="<?php// echo $val['id']?>" <?php if ($val['id'] == $underwritingDetails[0]['commission_split']) { echo 'selected'; } ?>>
                                    <?php// echo $val['commission_split']; ?>
                                </option>
                                <?php //} ?>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Final Status</label>
                            <select class="selectpicker form-control customer-email-tab" data-live-search="true"
                                id="set_contact" name="final_status" >
                                <option value="">Select</option>
                                <?php /*foreach ($finalstatus as $vall){ ?>
                                <option value="<?php echo $vall['id']?>" <?php if ($vall['id'] == $underwritingDetails[0]['final_status']) { echo 'selected'; } ?>>
                                    <?php echo $vall['final_status']; ?> 
                                </option>
                                <?php }*/ ?>
                            </select>
                        </div>
                    </div-->
                    <div class="row">
                        <div class="col-md-12">
                            <label>Underwriting Status</label>
                            <select class="selectpicker form-control customer-email-tab" data-live-search="true"
                                id="set_contact" name="under_status" >
                                <option value="">Select</option>
                                <?php foreach ($fetchUnderwrittingStatus as $vall){ ?>
                                <option value="<?php echo $vall['id']?>" <?php if ($vall['id'] == $underwritingDetails[0]['under_status']) { echo 'selected'; } ?>>
                                    <?php echo $vall['under_status']; ?> 
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div></br>
                </div>
                <div class="col-md-6">

                <div class="row">
                        <div class="col-md-12">
                            <label>Requested To Issue API</label>
                            <input type="text" class="form-control" name="requested_api" data-type='currency' id="myinput1"  
                            <?php   $username = $underwritingDetails[0]['requested_api'];?>
                            value="<?php echo $username ?>" >
                        </div>
                    </div></br>
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label>Date Requested to Issue</label>
                            <input type="date" class="form-control" name="issue_date" value="<?php echo $underwritingDetails[0]['issue_date']; ?>" >
                        </div>
                    </div></br>
                   
                    
                    <div class="row">
                        <div class="col-md-12">
                            <label>Reason for Policy not issued</label>
                            <select class="selectpicker form-control " data-live-search="true" id="set_contact"
                                name="reason_policy_notissued" >
                                <option value="">Select</option>
                                <?php foreach ($Notissuepolicy as $val){ ?>
                                <option value="<?php echo $val['id']?>" <?php if ($val['id'] == $underwritingDetails[0]['reason_policynotissued']) { echo 'selected'; } ?>>
                                    <?php echo $val['issue_policy']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div></br>

                    <div class="row">
                        <div class="col-md-12">
                            <label>Are benefits being cancelled as a result of issuing this policy?</label>
                            &nbsp;&nbsp;
                            <input type="radio" class="form-check-input" onchange="benefitCancelled(this)" value="yes"
                                name="benefit_cancelled"
                                <?php if($underwritingDetails[0]['benefit_cancelled'] == 'yes') { echo "checked"; } ?>
                                required id="yes">
                            Yes
                            &nbsp;&nbsp;
                            <input type="radio" class="form-check-input" onchange="benefitCancelled(this)" value="no"
                                name="benefit_cancelled"
                                <?php if($underwritingDetails[0]['benefit_cancelled'] == 'no') { echo "checked"; } ?>
                                required id="no">
                            No
                        </div>
                    </div></br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="row d-none" id="replacement_type">
                        <div class="col-md-12">
                            <label>Is this a full or partial replacement?</label>
                            &nbsp;&nbsp;
                            <input type="radio" class="form-check-input" name="replacement_type" required value="full"
                                <?php if($benefitBeingReplace['replacement_type'] == 'full') { echo "checked"; } ?>
                                id="full">
                            Full
                            &nbsp;&nbsp;
                            <input type="radio" class="form-check-input" name="replacement_type" required
                                value="partial"
                                <?php if($benefitBeingReplace['replacement_type'] == 'partial') { echo "checked"; } ?>
                                id="partial">
                            Partial
                        </div>
                    </div></br>
                    <div class="row d-none" id="replacement">
                        <div class="col-md-12">
                            <label>Is this an internal or external replacement?</label>
                            &nbsp;&nbsp;
                            <input type="radio" class="form-check-input" name="type" required value="internal"
                                <?php if($benefitBeingReplace
                                ['type'] == 'internal') { echo "checked"; } ?> id="internal">
                            Internal
                            &nbsp;&nbsp;
                            <input type="radio" class="form-check-input" name="type" required value="external"
                                <?php if($benefitBeingReplace['type'] == 'external') { echo "checked"; } ?> id="external">
                            External
                        </div>
                    </div></br>
                    <div class="row d-none" id="replaced">
                        <div class="col-md-12">
                            <h4><i class="fa fa-plus-circle" onclick="add_row();"></i>Add
                                benefits being
                                replaced.</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-none" id="addbenefits">
            <div class="col-md-6">
                    <table id="benefits_table" class="table">
                        <tr>
                            <th>Provider</th>
                            <th>Policy Number</th>
                            <th>Benefit</th>
                            <!-- <th>Category</th> -->
                        </tr>
                        <?php
                            for($i=0;$i < $benefitBeingReplace['count'] ;$i++  ) {
                            ?>
                        <tr>
                            <td>
                                <input type="hidden" name="provider_name[]" id="provider_name"
                                    value="<?php echo $benefitBeingReplace['provider_name'][$i]; ?>">
                                <select class="selectpicker  customer-email-tab" data-live-search="true"
                                    onchange="providerName(this)" id="provider_id" name="provider_id[]">
                                    <option value="">Select</option>
                                    <?php foreach ($advisers as $val)
                                { echo "<pre>"; print_r($val); ?>
                                    <option value="<?php echo $val['id']?>"
                                        <?php if ($val['id'] == $benefitBeingReplace['provider_id'][$i]) { echo 'selected'; } ?>>
                                        <?php echo $val['providername']; ?>
                                    </option>
                                    <?php
                                } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="" name="policy_number[]"
                                    value="<?php echo $benefitBeingReplace['policy_number'][$i]; ?>">
                            </td>
                            <td>
                                <input type="hidden" name="benefit_name" id="benefit_name" class="d-none"
                                    value="<?php echo $benefitBeingReplace['benefit_name'][$i]; ?>">
                                <select class="selectpicker customer-email-tab" data-live-search="true"
                                    onchange="benefitName(this)" id="benefit_id" name="benefit_id[]">
                                    <option value="">Select</option>
                                    <?php foreach ($benefits as $val)
                                { ?>
                                    <option value="<?php echo $val['id']?>"
                                        <?php if ($val['id'] == $benefitBeingReplace['benefit_id'][$i]) { echo 'selected'; } ?>>
                                        <?php echo $val['form_title']; ?>
                                    </option>
                                    <?php
                                } ?>
                                </select>
                            </td>
                            <!-- <td>
                                <select class="selectpicker form-control customer-email-tab" data-live-search="true"
                                    id="category" name="category[]">
                                    <option value="">Select</option>
                                    <?php foreach ($category as $val)
                                { echo "<pre>"; print_r($val); ?>
                                    <option value="<?php echo $val['id']?>"
                                        <?php if ($val['id'] == $benefitBeingReplace['category'][$i]) { echo 'selected'; } ?>>
                                        <?php echo $val['category']; ?>
                                    </option>
                                    <?php
                                } ?>
                                </select>
                            </td> -->
                            <td> <button class="btn btn-danger" onclick="delete_row(this)">Delete</button></td>
                        </tr>
                        <?php } ?>
                    </table>
                    </br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-info">Save</button>
                    <input type="hidden" name="projectid" value="<?php echo $projectid ?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                        value="<?php echo $this->security->get_csrf_hash();?>">
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var element = document.querySelector('input[name="benefit_cancelled"]:checked');
    benefitCancelled(element);
});
function benefitCancelled(element) {
    var value = element.id === "yes" ? "Yes" : "No";
    var partial = document.getElementById('partial').checked;
    if (value === 'Yes') {
        document.getElementById('replacement').classList.remove('d-none');
        document.getElementById('replaced').classList.remove('d-none');
        document.getElementById('addbenefits').classList.remove('d-none');
        document.getElementById('internal').setAttribute('required', true);
        document.getElementById('external').setAttribute('required', true);
        document.getElementById('replacement_type').classList.remove('d-none');
        document.getElementById('full').setAttribute('required', true);
        document.getElementById('partial').setAttribute('required', true);
        if (partial == true) {
            document.getElementById('full').removeAttribute('checked');
        } else {
            document.getElementById('full').setAttribute('checked', true);
        }
    } else if (value === 'No') {
        document.getElementById('replacement').classList.add('d-none');
        document.getElementById('replaced').classList.add('d-none');
        document.getElementById('addbenefits').classList.add('d-none');
        document.getElementById('internal').removeAttribute('required');
        document.getElementById('external').removeAttribute('required');
        document.getElementById('replacement_type').classList.add('d-none');
        document.getElementById('full').removeAttribute('required');
        document.getElementById('partial').removeAttribute('required');
    } else {
        // console.log('not checked any options yes or no');
    }
}
function add_row() {
    var table = document.getElementById("benefits_table"); // Assume your table has this ID
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    // var cell5 = row.insertCell(4);
    cell1.innerHTML = `
        <input type="hidden" name="provider_name[]" id="provider_name_${table.rows.length}" value="">
        <select class="selectpicker form-control customer-email-tab" data-live-search="true"
            onchange="providerName(this)" id="provider_id_${table.rows.length}" name="provider_id[]">
            <option value="">Select</option>
            <?php foreach ($advisers as $val) { ?>
                <option value="<?php echo $val['id']?>"><?php echo $val['providername']; ?></option>
            <?php } ?>
        </select>
    `;
    cell2.innerHTML = `<input type="text" class="form-control" name="policy_number[]">`;
    cell3.innerHTML = `
        <input type="hidden" name="benefit_name[]" id="benefit_name_${table.rows.length}" class="d-none" value="">
        <select class="selectpicker form-control customer-email-tab" data-live-search="true"
            onchange="benefitName(this)" id="benefit_id_${table.rows.length}" name="benefit_id[]">
            <option value="">Select</option>
            <?php foreach ($benefits as $val) { ?>
                <option value="<?php echo $val['id']?>"><?php echo $val['form_title']; ?></option>
            <?php } ?>
        </select>
    `;
    // cell4.innerHTML = `<select class="selectpicker form-control customer-email-tab" data-live-search="true"
    //          id="category_${table.rows.length}" name="category[]">
    //         <option value="">Select</option>
    //         <?php foreach ($category as $val) { ?>
    //             <option value="<?php echo $val['id']?>"><?php echo $val['category']; ?></option>
    //         <?php } ?>
    //     </select>
    // `;
    cell4.innerHTML = `<button class="btn btn-danger" onclick="delete_row(this)">Delete</button>`;
    $('.selectpicker').selectpicker('refresh');
}
function delete_row(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
function providerName(selectElement) {
    var row = selectElement.closest('tr');
    var providerNameInput = row.querySelector('input[name="provider_name[]"]');
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    providerNameInput.value = selectedOption.text;
}
function benefitName(selectElement) {
    var row = selectElement.closest('tr');
    var benefitNameInput = row.querySelector('input[name="benefit_name[]"]');
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    benefitNameInput.value = selectedOption.text;
}
// var myinput = document.getElementById('myinput');

// myinput.addEventListener('keyup', function() {
//     var val = this.value;
//     val = val.replace(/[^0-9\.]/g,'');
//     console.log('test3');
//     console.log(val);
//     if(val != "") {
//         valArr = val.split('.');
//         valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
//         val = valArr.join('.');
//     }
//     this.value = val;
// });

// var myinput = document.getElementById('myinput1');

// myinput.addEventListener('keyup', function() {
//     var val = this.value;
//     val = val.replace(/[^0-9\.]/g,'');
//     console.log('test3');
//     console.log(val);
//     if(val != "") {
//         valArr = val.split('.');
//         valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
//         val = valArr.join('.');
//     }
//     this.value = val;
// });

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
