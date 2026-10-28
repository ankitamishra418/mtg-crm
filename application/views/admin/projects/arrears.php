<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4>Arrears</h4>

<div class="claims-feed">
    <div class="content">
        <form method="post" action="<?php echo base_url('admin/projects/saveArrears');?>">

            <div class="row">
                <div class="col-md-6">
                    <label>Date Received</label>
                    <!-- <input type="date" class="form-control" name="recieve_date"
                        value="<?php // echo $save_Arrears[0]['recieve_date']; ?>" > -->
                        <input type="date" class="form-control" name="recieve_date"
                             onchange="myFunction()" id="recieve_date"
                            value="<?php echo $save_Arrears[0]['recieve_date']; ?>">
                             <h4 type="text" id="contactshow" ></h4>
                            <input type="hidden" id="contactsave" name="clawback" value="clawback">
                </div>
            </div><br>

            <div class="row">
                <div class="col-md-6">
                    <label>Reason For Arrears</label>
                    <select class="selectpicker form-control customer-email-tab" data-live-search="true"
                        id="reason_arrears" name="reason_arrears" >
                        <option value="">Select</option>
                        <?php foreach ($reasonForArreas as $vall){?>
                             
                        <option value="<?php echo $vall['id']?>"
                            <?php if ($vall['id'] == $save_Arrears[0]['reason_arrears']) { echo 'selected'; } ?>>
                            <?php echo $vall['reason_arrears']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <label>API</label>
                    <input type="text" class="form-control" name="apibeinglapsed" id="myinput" data-type="currency" <?php $username = $save_Arrears[0]['apibeinglapsed']; ?> value='<?php echo $username ?>' >
                </div>
            </div><br>
            <!-- <div class="row">
                <div class="col-md-6">
                    <label>Advisor Contacted?</label>
                    <select class="selectpicker form-control " data-live-search="true" id="advisercontacted"
                        name="advisercontacted" >
                        <option value="">Select</option>
                       <option value="1">Yes</option>
                       <option value="0">No</option>
                    </select>
                </div>
            </div><br> -->
            <div class="row">
                <div class="col-md-6">
                    <label>Arrears Status</label>
                    <select class="selectpicker form-control customer-email-tab"  data-live-search="true"
                        id="arrears_status" name="arrears_status" >
                        <option value="">Select</option>
                        <?php foreach ($arreasStatus as $val){ ?>
                        <option value="<?php echo $val['id']?>"
                            <?php if ($val['id'] == $save_Arrears[0]['arrears_status']) { echo 'selected'; } ?>>
                            <?php echo $val['arrears_status']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div><br>
            <div class="row">
            <div class="col-md-6"></div>
                <div class="col-md-6">
                <input type="hidden" value="<?php echo($policydata['start_date']);?>" id="policy_start_date">
                    <?php //if(is_admin()){ ?>
                    <button type="submit" class="btn btn-info">Save</button>
                    <?php //} ?>
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
    function myFunction() {
    let recieve_date = document.getElementById("recieve_date").value;
    var policy_start_date = document.getElementById("policy_start_date").value;
    var action = "<?php echo base_url('admin/projects/getdateCalculate')?>";
    // alert(policy_start_date);
    $.ajax({
        type: 'POST',
        url: action,
        data: {
            recieve_date: recieve_date,
            policy_start_date: policy_start_date,
        },
        success: function(data) {
            console.log(data);
            // Formatting the number of days with two decimal places
            var NumberDays = parseFloat(data).toFixed(2);
             $('#contactshow').html('');
            if (data < 731) {
                // $('#contactshow').html(NumberDays);
                $('#contactshow').html("Clawback");
                $('#contactsave').val(NumberDays);
                document.getElementById("contactshow").style.color = "red";
            } else {
                //  $('#contactshow').html(NumberDays);
                $('#contactsave').val(NumberDays);
                // document.getElementById("contactshow").style.color = "green";
            }
        }
    });
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
</script>
