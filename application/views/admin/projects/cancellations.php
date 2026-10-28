<style>
.margin {
    margin-top: 25px;
}
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4>Policy Cancellation</h4>
<div class="claims-feed">
    <div class="content">
        <form method="post" action="<?php echo base_url('admin/projects/saveCancellations/');?>">
            <div class="row">
                <div class="col-md-7">
                    <div class="row" style="border-right:2px solid LightGray;">
                        <div class="col-md-6" style="border-right:2px solid LightGray;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 style="font-weight: bold;">Cancellation</h4>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>Source</label>
                                    <select class="selectpicker form-control" multiple data-live-search="true"
                                        id="source" name="source">
                                        <option value="">Select</option>
                                        <?php foreach ($source as $val){ ?>
                                        <option value="<?php echo $val['id'] ?>"
                                            <?php if ($val['id'] == $cancellationDetails[0]['source']) { echo 'selected'; } ?>>
                                            <?php echo $val['source']?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>API Being Cancelled</label>
                                    <input type="text" class="form-control" name="api_being_cancelled" data-type='currency'
                                        id="API Being Cancelled"
                                        value="<?php echo $cancellationDetails[0]['api_being_cancelled']; ?>">
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><strong>Claim Identified</strong></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-md-6">
                                            <input type="radio" name="" value='0'
                                                <?php //if(($cancellationDetails[0]['claim_identified']) == 0){ echo 'checked'; }?>>
                                            <label>Yes</label>
                                            <input type="radio" name="" value='1'
                                                <?php// if(($cancellationDetails[0]['claim_identified']) == 1){ echo 'checked'; }?>>
                                            <label>No</label>
                                        </div> -->

                                            <div class="col-md-12">
                                                <!-- <select class="selectpicker form-control"
                                                        data-live-search="true"
                                                        >

                                                    <option value="">Select</option>

                                                    <option value="0"
                                                        <?php
                                                        //if ($cancellationDetails[0]['claim_identified'] == 0) {
                                                        //    echo 'selected';
                                                        //}
                                                        ?>>
                                                        Yes
                                                    </option>

                                                    <option value="1"
                                                        <?php
                                                        //if ($cancellationDetails[0]['claim_identified'] == 1) {
                                                            //echo 'selected';
                                                        //}
                                                        ?>>
                                                        No
                                                    </option>

                                                </select> -->

                                                <select class="selectpicker form-control"
                                                        data-live-search="true"
                                                        name="claim_Identified">

                                                    <option value="">Select</option>

                                                    <?php foreach ($claimIdentified as $claim) { ?>

                                                        <option value="<?php echo $claim['id']; ?>"
                                                            <?php
                                                            if (
                                                                isset($cancellationDetails[0]['claim_identified']) &&
                                                                $cancellationDetails[0]['claim_identified'] == $claim['id']
                                                            ) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                            <?php echo htmlspecialchars($claim['claim_identified']); ?>
                                                        </option>

                                                    <?php } ?>

                                                </select>
                                            </div>
                                    </div><br>
                                    
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <label>Clawback amount</label>
                                            <input type="text" class="form-control" name="clawback_amount" data-type='currency'
                                                id="clawback_amount"
                                                value="<?php echo $cancellationDetails[0]['clawback_amount']; ?>">
                                        </div>
                                    </div> -->
                                </div>
                            </div></br>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <h4 style="font-weight: bold;">Replacement Business</h4> -->
                                </div>
                            </div><br><br>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>Outcome of Cancellation</label>
                                    <select class="selectpicker form-control" data-live-search="true"
                                        id="outcome_cancellation" name="outcome_cancellation">
                                        <option value="">Select</option>
                                        <?php foreach ($cancellationOutcome as $val){ ?>
                                        <option value="<?php echo $val['id']?>"
                                            <?php if ($val['id'] == $cancellationDetails[0]['outcome_of_cancellation']) { echo 'selected'; } ?>>
                                            <?php echo $val['outcome_cancellation']?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>Reason for Cancellation</label>
                                    <select class="selectpicker form-control" data-live-search="true"
                                        id="reason_for_cancellation" name="reason_for_cancellation">
                                        <option value="">Select</option>
                                        <?php foreach ($ReasonforCancellation as $val) { ?>
                                        <option value="<?php echo $val['id']?>"
                                            <?php if ($val['id'] == $cancellationDetails[0]['reason_for_cancellation']) { echo 'selected'; } ?>>
                                            <?php echo $val['reason_for_cancelletion']?>
                                        </option>
                                        <div class="row">
                                            <div class="col-md-12"></div>
                                        </div>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>Cancellation Status</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="cancel_status"
                                        name="cancel_status">
                                        <option value="">Select</option>
                                        <?php foreach ($fetchCancellationStatus as $val) { ?>
                                        <option value="<?php echo $val['id']?>"
                                            <?php if ($val['id'] == $cancellationDetails[0]['cancel_status']) { echo 'selected'; } ?>>
                                            <?php echo $val['cancel_status']?>
                                        </option>
                                        <div class="row">
                                            <div class="col-md-12"></div>
                                        </div>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div><br>
                            <!-- <div class="row border-red margin">
                                <div class="col-md-12">
                                    <label>Replacement Business</label>
                                    <select class="selectpicker form-control" data-live-search="true"
                                        id="replacement_business" name="replacement_business">
                                        <option value="">Select</option>
                                        <?php foreach ($replacebusiness as $val) { ?>
                                        <option value="<?php echo $val['id']?>"
                                            <?php if ($val['id'] == $cancellationDetails[0]['replacement_business']) { echo 'selected'; } ?>>
                                            <?php echo $val['replacement_business']?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>Replacement Reason</label>
                                    <select class="selectpicker form-control" data-live-search="true"
                                        id="replacement_reason" name="replacement_reason">
                                        <option value="">Select</option>
                                        <?php foreach ($replaceReason as $val){ ?>
                                        <option value="<?php echo $val['id']?>"
                                            <?php if ($val['id'] == $cancellationDetails[0]['replacement_reason']) { echo 'selected'; } ?>>
                                            <?php echo $val['replacement_reason']?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>New Policy Commission</label>
                                    <select class="selectpicker form-control" data-live-search="true"
                                        id="outcome_cancellation" name="policy_commission">
                                        <option value="">Select</option>
                                        <?php foreach ($PolicyCommission as $val){ ?>
                                        <option value="<?php echo $val['id']?>"
                                            <?php if ($val['id'] == $cancellationDetails[0]['policy_commission']) { echo 'selected'; } ?>>
                                            <?php echo $val['new_policy_commission']?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div></br> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <h4 style="font-weight: bold;">Alterations</h4> -->
                        </div>
                    </div></br><br>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label>Date Received</label>
                            <input type="date" class="form-control" name="date_received"
                                value="<?php echo $cancellationDetails[0]['date_received']; ?>">
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label>Cancellation Date</label>
                            <input type="date" class="form-control" name="clawback_period"
                                id="cancellation_date" onchange="myFunction()"
                                value="<?php echo $cancellationDetails[0]['clawback_period']; ?>">
                                <?php $clr_NoOfDays = $cancellationDetails[0]['number_of_days_calculation_c_p']; ?> 
                                <h4 type="text" id="contactshow" style="text-align: right;" value="<?php //echo $cancellationDetails[0]['number_of_days_calculation_c_p']; ?>"><?php if($clr_NoOfDays > 720){ ?> <span style="color:green;"><?php echo $clr_NoOfDays . ' Days' ?></span> <?php } else{ ?> <span style="color:red;"><?php echo $clr_NoOfDays . ' Days' ?></span> <?php } ?></h4>
                                <input type="hidden" id="contactsave" name="number_of_days_calculation_c_p" value="<?php echo $cancellationDetails[0]['number_of_days_calculation_c_p']; ?>">
                        </div>
                    </div><br>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <label for="">Life Cover</label>
                            <select class="selectpicker form-control" data-live-search="true" id="life_cover"
                                name="life_cover">
                                <option value="">Select</option>
                                <?php foreach ($benefitChange as $val) { ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['life_cover']) { echo 'selected'; } ?>>
                                    <?php echo $val['benefit_being_change']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label for="">Truma Cover</label>
                            <select class="selectpicker form-control" data-live-search="true" id="truma_cover"
                                name="truma_cover">
                                <option value="">Select</option>
                                <?php foreach ($benefitChange as $val) { ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['truma_cover']) { echo 'selected'; } ?>>
                                    <?php echo $val['benefit_being_change']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label for="">Total And Permanent Disablement Cover</label>
                            <select class="selectpicker form-control" data-live-search="true"
                                id="total_and_permanent_disablement_cover" name="total_and_permanent_disablement_cover">
                                <option value="">Select</option>
                                <?php foreach ($benefitChange as $val) { ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['total_and_permanent_disablement_cover']) { echo 'selected'; } ?>>
                                    <?php echo $val['benefit_being_change']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label for="">Monthly Disability Cover</label>
                            <select class="selectpicker form-control" data-live-search="true"
                                id="monthly_disability_cover" name="monthly_disability_cover">
                                <option value="">Select</option>
                                <?php foreach ($benefitChange as $val) { ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['monthly_disability_cover']) { echo 'selected'; } ?>>
                                    <?php echo $val['benefit_being_change']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label for="">Medical Cover</label>
                            <select class="selectpicker form-control" data-live-search="true" id="medical_cover"
                                name="medical_cover">
                                <option value="">Select</option>
                                <?php foreach ($benefitChange as $val) { ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['medical_cover']) { echo 'selected'; } ?>>
                                    <?php echo $val['benefit_being_change']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label for="">Whole Of Life/Endowment Cover</label>
                            <select class="selectpicker form-control" data-live-search="true"
                                id="whole_life_endowment_cover" name="whole_life_endowment_cover">
                                <option value="">Select</option>
                                <?php foreach ($benefitChange as $val) { ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['whole_life_endowment_cover']) { echo 'selected'; } ?>>
                                    <?php echo $val['benefit_being_change']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label for="">Accidental Death Cover</label>
                            <select class="selectpicker form-control" data-live-search="true"
                                id="accidental_death_cover" name="accidental_death_cover">
                                <option value="">Select</option>
                                <?php foreach ($benefitChange as $val) { ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['accidental_death_cover']) { echo 'selected'; } ?>>
                                    <?php echo $val['benefit_being_change']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label for="">Funeral Cover</label>
                            <select class="selectpicker form-control" data-live-search="true" id="funeral_cover"
                                name="funeral_cover">
                                <option value="">Select</option>
                                <?php foreach ($benefitChange as $val) { ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['funeral_cover']) { echo 'selected'; } ?>>
                                    <?php echo $val['benefit_being_change']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-12">
                            <label for="">Other</label>
                            <select class="selectpicker form-control" data-live-search="true" id="other" name="other">
                                <option value="">Select</option>
                                <?php foreach ($benefitChange as $val) { ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['other']) { echo 'selected'; } ?>>
                                    <?php echo $val['benefit_being_change']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->
                    <br>
                    <div class="row margin" style="float:right">
                        <div class="col-md-6">
                            <?php //if(is_admin()){ ?>
                            <button type="submit" class="btn btn-info">Save</button>
                            <?php //} ?>
                            <input type="hidden" name="projectid" value="<?php echo $projectid ?>">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                                value="<?php echo $this->security->get_csrf_hash();?>">
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo($policydata['start_date']);?>" id="policy_start_date">
            </div>
        </form>
    </div>
</div>

<script>
var myinput = document.getElementById('clawback_amount');
myinput.addEventListener('change', function() {
    var val = this.value;
    val = val.replace(/[^0-9\.]/g, '');
    console.log('test3');
    console.log(val);
    if (val != "") {
        valArr = val.split('.');
        valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
        val = valArr.join('.');
        amount_value = '$' + val;
    }
    this.value = amount_value;
});


var myinput = document.getElementById('API Being Cancelled');
myinput.addEventListener('change', function() {
    var val = this.value;
    val = val.replace(/[^0-9\.]/g, '');
    console.log('test3');
    console.log(val);
    if (val != "") {
        valArr = val.split('.');
        valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
        val = valArr.join('.');
        amount_value = '$' + val;
    }
    this.value = amount_value;
});


var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

function myFunction() {
    let cancellation_date = document.getElementById("cancellation_date").value;
    var policy_start_date = document.getElementById("policy_start_date").value;
    var action = "<?php echo base_url('admin/projects/getCalculate')?>"
    $.ajax({
        type: 'POST',
        url: action,
        data: {
            cancellation_date: cancellation_date,
            policy_start_date: policy_start_date,
        },
        success: function(data) {
            console.log(data);

            NumberDays = data + ' Days';

            if (data > 720) {
                $('#contactshow').html(NumberDays);
                $('#contactsave').val(NumberDays);
                document.getElementById("contactshow").style.color = "green";
            } else {
                $('#contactshow').html(NumberDays);
                $('#contactsave').val(NumberDays);
                document.getElementById("contactshow").style.color = "red";
            }
        }
    })
}
</script>