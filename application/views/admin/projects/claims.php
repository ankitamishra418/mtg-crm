<?php 
defined('BASEPATH') or exit('No direct script access allowed');
?>
<h4>New Claim</h4>
<?php $individual = unserialize($claimDetails[0]['contact']); ?>
<div class="claims-feed">
    <div class="content">
        <form method="post" action="<?php echo base_url('admin/projects/saveCalim');?>">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Individual</label>
                            <select class=" selectpicker form-control form-control-lg" multiple data-live-search="true"
                                id="contact" name="contact[]" >
                                <option value="">Select</option>
                                <?php 
                                foreach ($contacts as $val){ 
                                        ?>
                                <option value="<?php echo $val['id']?>" <?php if (in_array($val['id'], $individual)) { echo 'selected'; } ?>>

                                    <?php echo $val['firstname'].' '.$val['lastname']?>
                                </option>
                                <?php   }?>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Benefit</label>
                            <select class="selectpicker form-control" data-live-search="true" id="benefit"
                                name="benefit" >
                                <option value="">Select</option>
                                <?php foreach ($benefits as $val){ ?>
                                <option value="<?php echo $val['id']?>" <?php if ($val['id'] == $claimDetails[0]['benefit']) { echo 'selected'; } ?>>
                                    <?php echo $val['form_title']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Condition Groups</label>
                            <select class="selectpicker form-control customer-email-tab" data-live-search="true"
                                id="conditiongroup" name="conditiongroup" >
                                <option value="">Select</option>
                                <?php foreach ($conditionalgroup as $val){ ?>
                                <option value="<?php echo $val['id']?>" <?php if($val['id'] == $claimDetails[0]['condition_groups']){ echo 'selected'; } ?>>
                                    <?php echo $val['condition_qroups']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Condition</label>
                            <input type="text" class="form-control" name="condition" value="<?php echo($claimDetails[0]['condition']); ?>" >
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Outcome</label>
                            <select class="selectpicker form-control" data-live-search="true" id="outcome"
                                name="outcome" >
                                <option value="">Select</option>
                                <?php foreach ($outcome as $val){ ?>
                                <option value="<?php echo $val['id']?>" <?php if($val['id'] == $claimDetails[0]['outcome']){ echo 'selected'; } ?> >
                                    <?php echo $val['outcome']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Reason for no Claim</label>
                            <select class="selectpicker form-control" data-live-search="true" id="reason_noclaim"
                                name="reason_noclaim" >
                                <option value="">Select</option>
                                <?php foreach ($reasonNoclaim as $val){ ?>
                                <option value="<?php echo $val['id']?>" <?php if($val['id'] == $claimDetails[0]['reason_noclaim']){ echo 'selected'; } ?>>
                                    <?php echo $val['reason_noclaim']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Specialist</label>
                            <input type="text" class="form-control" name="specialist" value="<?php echo($claimDetails[0]['specialist']); ?>" >
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Additional Info</label>
                            <textarea class="form-control" rows="6" cols="40" placeholder="Leave a comment here"
                                id="additional_info" name="additional_info" value="<?php echo($claimDetails[0]['additional_Info']); ?>"><?php echo($claimDetails[0]['additional_Info']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <hr><br>
            <div class="row">
                <div class="col-md-6">
                    <h4><i class="fa fa-plus-circle" onclick="add_row();"></i>Add New Claim Payment</h4>
                </div>
                <div class="col-md-2" style='margin-left: 36rem;'>
                    <label>Total Amount</label>
                    <?php if (count($claimPaymentDetails) > 0) {  ?>
                        <input type="text" class="form-control" Id='totalAmount' name="total_amount" value="<?php echo $claimPaymentDetails[0]['total_amount'] ?>" readonly>
                    <?php } else { ?>
                        <input type="text" class="form-control" Id='totalAmount' name="total_amount" value="" readonly>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <table id="employee_table">
                        <tr>
                            <th>Invoice / Description</th>
                            <th>Payment Date</th>
                            <th>Amount</th>
                        </tr>
                        <?php if (count($claimPaymentDetails) > 0) {
                            $rowCount = 1;
                                foreach ($claimPaymentDetails as $claimPaymentDetail) {  
                        ?>
                            <tr id="row<?php echo $rowCount ?>">
                                <td><input type="text" name="invoice[]" Class="form-control" placeholder="invoice" value="<?php echo $claimPaymentDetail['Invoice'] ?>"></td>
                                <td><input type="date" name="payment_date[]" Class="form-control" placeholder="Payment Date" value="<?php echo $claimPaymentDetail['payment_date'] ?>"></td>
                                <td><input type="text" name="amount[]" Class="form-control tamount" placeholder="Amount" value="<?php echo $claimPaymentDetail['amount'] ?>" id='amount<?php echo $rowCount ?>' ></td>
                                <td><input type='button' value='DELETE' onclick="delete_row(<?php echo $rowCount ?>)"></td>
                            </tr>
                        <?php
                            $rowCount++;
                                }
                            } else { ?>
                            <tr id="row1">
                                <td><input type="text" name="invoice[]" Class="form-control" placeholder="invoice" value=""></td>
                                <td><input type="date" name="payment_date[]" Class="form-control" placeholder="Payment Date" value=""></td>
                                <td><input type="text" name="amount[]" Class="form-control tamount" placeholder="Amount" value="" id='amount' ></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div></br>
            <div class="row">
                <div class="col-md-6">
                <?php //if(is_admin()){ ?>
                    <button type="submit" class="btn btn-info">Save</button>
                    <?php // } ?>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                        value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="hidden" name="projectid" value="<?php echo $projectid ?>">
                </div>
            </div>

        </form>
    </div>
</div>
<script>
function add_row() {
    $rowno = $("#employee_table tr").length;
    $rowno = $rowno + 1;
    $("#employee_table tr:last").after("</br><tr id='row" + $rowno +
        "'><td><input type='text' name='invoice[]' class='form-control' placeholder='Invoice'></td><td><input type='date' name='payment_date[]' class='form-control' placeholder=''></td><td><input type='text' class='form-control tamount' name='amount[]' placeholder='Enter Amount'   id='amount" +
        $rowno+"'></td><td><input type='button' value='DELETE' onclick=delete_row(" + $rowno + ")></td></tr>");
}

function delete_row(rowno) {
    
    let amount = $("#amount" + rowno).val();

    let result          = amount.replace(',','');
    let result_1        = result.replace(',','');
    let result_2        = result_1.replace(',','');
    let result_3        = result_2.replace(',','');
    let amount_1        = result_3.replace('$','');

    console.log(amount_1);
    if (amount_1 != '') {

        let totalAmount = $("#totalAmount").val();

        let result          = totalAmount.replace(',','');
        let result_1        = result.replace(',','');
        let result_2        = result_1.replace(',','');
        let result_3        = result_2.replace(',','');
        let totalAmount_1   = result_3.replace('$','');

        let addAmount = parseFloat(totalAmount_1) - parseFloat(amount_1);
        
        let formatting_options = {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2,
        }
        let numberWithDollar_1 = addAmount.toLocaleString("en-US", formatting_options);
        console.log(numberWithDollar_1);

        $("#totalAmount").val(numberWithDollar_1);
    }
    $('#row' + rowno).remove();
}

// function Currency_format(rowno) {
//     let amount = $("#amount" + rowno ).val();
//     let val = amount;
//     val = val.replace(/[^0-9\.]/g,'');
//     if(val != "") {
//         valArr = val.split('.');
//         valArr[0] = (parseFloat(valArr[0],10)).toLocaleString();
//         sendvalue = valArr.join('.');
//         // sent = "$" + sendvalue;
//     }
//     $("#amount" + rowno ).val(sendvalue);
// };

</script>