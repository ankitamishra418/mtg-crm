<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4>New Claim</h4>
<div class="claims-feed">
    <div class="content">
        <form  method="post" action="<?php echo base_url('admin/projects/saveCalim');?>">
            <div class="row">
                <div class="col-md-4">
                    <label>Contact</label>
                    <select class=" selectpicker form-control form-control-lg"  multiple data-live-search="true" id="contact" name="contact[]" required>
                    <option value="">Select</option>
                        <?php foreach ($contacts as $val) { ?>
                            <option value="<?php echo $val['id']?>">
                            <?php echo $val['firstname'].' '.$val['lastname']?>
                            </option>
					    <?php }?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Benefit</label>
                    <select class="selectpicker form-control"  data-live-search="true" id="benefit" name="benefit" required>
                        <option value="">Select</option>
                        <?php foreach ($benefits as $val) { ?>
                            <option value="<?php echo $val['id']?>">
                                <?php echo $val['form_title']?>
                            </option>
					    <?php }?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>OutCome</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" id="outcome" name="outcome" required>
                    <option value="1">Select</option>
                    </select>
                </div>
            </div></br>
            <div class="row">
                <div class="col-md-4">
                    <label>Condition</label>
                    <input type="text" class="form-control" name="condition" required>
                </div>
                <div class="col-md-4">
                    <label>Reason for no Claim</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" id="reason_noclaim" name="reason_noclaim" required>
                    <option value="1">Select</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Condition Groups</label>
                    <select class="selectpicker form-control customer-email-tab" multiple data-live-search="true" id="conditiongroup" name="conditiongroup" required>
                    <option value="1">Select</option>
                    </select>
                </div>
            </div></br>
            <div class="row">
                <div class="col-md-4">
                    <label>Specialist</label>
                    <input type="text" class="form-control" name="specialist" required>
                </div>
                <div class="col-md-4">
                    <label>Additional Info</label>
                    <textarea class="form-control" rows="6" cols="40" placeholder="Leave a comment here" id="additional_info" name="additional_info"></textarea>            
                </div>
            </div></br><hr>
            <div class="row">
                <div class="col-md-6">
                    <h4><i class="fa fa-plus-circle" onclick="add_row();"></i>Add New Claim Payment</h4>
                </div>
                <div class="col-md-2" style='margin-left: 36rem;'>
                    <label>Total Amount</label>
                     <input type="text" class="form-control"  Id='totalAmount'  name="total_amount" required>
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
                        <tr id="row1">
                            <td><input type="text" name="invoice[]" Class="form-control" placeholder="invoice"></td>
                            <td><input type="date" name="payment_date[]" Class="form-control" placeholder="Payment Date"></td>
                            <td><input type="text" name="amount[]"  Class="form-control tamount" placeholder="Amount" id='amount' onkeyup="getTotalValue()"></td>
                        </tr>
                    </table>
                </div>   
            </div></br>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-info">Save</button>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type ="hidden"  name="projectid"  value="<?php echo $projectid ?>">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function add_row(){
    let totalAmount = $("#totalAmount").val();
    $rowno = $("#employee_table tr").length;
    if($rowno !=2){
        let amount = $("#amount"+$rowno).val();
        console.log(typeof amount);
        let addAmount = parseFloat(amount)+parseFloat(totalAmount);
        $("#totalAmount").val(addAmount);
    }
    $rowno=$rowno+1;
    $("#employee_table tr:last").after("</br><tr id='row"+$rowno+"'><td><input type='text' name='invoice[]' class='form-control' placeholder='Invoice'></td><td><input type='date' name='payment_date[]' class='form-control' placeholder=''></td><td><input type='text' class='form-control' name='amount[]' placeholder='Enter Amount' id='amount"+$rowno+"'></td><td><input type='button' value='DELETE' onclick=delete_row("+$rowno+")></td></tr>");
}
function delete_row(rowno){
    let amount = $("#amount"+rowno).val();    
    if(amount != ''){
    let totalAmount = $("#totalAmount").val();
    // console.log('totalAmount');
    // console.log(totalAmount);
    // console.log("#amount"+rowno);
    // console.log('amount');
    // console.log(amount);
    let addAmount = parseFloat(totalAmount) - parseFloat(amount);
    // console.log('addAmount');
    // console.log(addAmount);
    $("#totalAmount").val(addAmount);
    }
    $('#row'+rowno).remove();
}
function getTotalValue() {
    var amount = $("#amount").val();
    $("#totalAmount").val(amount);
}
</script>
