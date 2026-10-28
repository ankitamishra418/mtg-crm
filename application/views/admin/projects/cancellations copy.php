<style>
.margin {
    margin-top: 16px;
}
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4>Policy Cancellation</h4>
<div class="claims-feed">
    <div class="content">
        <form method="post" action="<?php echo base_url('admin/projects/saveCancellations/');?>">
            <div class="row">
                <div class="col-md-7">
                    <div class="row" style="border-right:2px solid LightGray;">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 style="font-weight: bold;">Cancellation</h4>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>Source</label>
                                    <select class="selectpicker form-control" multiple data-live-search="true"
                                        id="source" name="source" >
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
                                    <label>Outcome of Cancellation</label>
                                    <select class="selectpicker form-control" data-live-search="true"
                                        id="outcome_cancellation" name="outcome_cancellation" >
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
                                    <label>Date Received</label>
                                    <input type="date" class="form-control" name="date_received"
                                        value="<?php echo $cancellationDetails[0]['date_received']; ?>" >
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>API Being Cancelled</label>
                                    <input type="text" class="form-control" name="api_being_cancelled"
                                        value="<?php echo $cancellationDetails[0]['api_being_cancelled']; ?>" >
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>Reason for Cancellation</label>
                                    <select class="selectpicker form-control" data-live-search="true"
                                        id="reason_for_cancellation" name="reason_for_cancellation" >
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Clawback period</label>
                                            <input type="date" class="form-control" name="clawback_period"
                                                value="<?php echo $cancellationDetails[0]['clawback_period']; ?>"
                                                >
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Claim Identified</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="radio" name="claim_Identified" value='0'
                                                <?php if(($cancellationDetails[0]['claim_identified']) == 0){ echo 'checked'; }?>
                                                >
                                            <label>Yes</label>
                                            <input type="radio" name="claim_Identified" value='1'
                                                <?php if(($cancellationDetails[0]['claim_identified']) == 1){ echo 'checked'; }?>
                                                >
                                            <label>No</label>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Clawback amount</label>
                                            <input type="text" class="form-control" name="clawback_amount"
                                                id="clawback_amount"
                                                value="<?php echo $cancellationDetails[0]['clawback_amount']; ?>"
                                                >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="col-md-12">
                                    <label>Cancellation Status</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="cancel_status"
                                        name="cancel_status" >
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
                            </div></br>
                        </div>
                        <div class="col-md-5" style="border-left:2px solid LightGray;">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 style="font-weight: bold;">Benefits Being Change</h4>
                                </div>
                            </div></br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Life Cover</label>
                                    <select class="selectpicker form-control" data-live-search="true" id="life_cover"
                                        name="life_cover" >
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
                                        name="truma_cover" >
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
                                        id="total_and_permanent_disablement_cover"
                                        name="total_and_permanent_disablement_cover" >
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
                                        id="monthly_disability_cover" name="monthly_disability_cover" >
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
                                        name="medical_cover" >
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
                                        id="whole_life_endowment_cover" name="whole_life_endowment_cover" >
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
                                        id="accidental_death_cover" name="accidental_death_cover" >
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
                                        name="funeral_cover" >
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
                                    <select class="selectpicker form-control" data-live-search="true" id="other"
                                        name="other" >
                                        <option value="">Select</option>
                                        <?php foreach ($benefitChange as $val) { ?>
                                        <option value="<?php echo $val['id']?>"
                                            <?php if ($val['id'] == $cancellationDetails[0]['other']) { echo 'selected'; } ?>>
                                            <?php echo $val['benefit_being_change']?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin">
                        <div class="col-md-6">
                            <?php if(is_admin()){ ?>
                            <button type="submit" class="btn btn-info">Save</button>
                            <?php } ?>
                            <input type="hidden" name="projectid" value="<?php echo $projectid ?>">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                                value="<?php echo $this->security->get_csrf_hash();?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="font-weight: bold;">Cancellation - Replacement Business</h4>
                        </div>
                    </div>
                    <div class="row border-red margin">
                        <div class="col-md-12">
                            <label>Replacement Business</label>
                            <select class="selectpicker form-control" data-live-search="true" id="replacement_business"
                                name="replacement_business" >
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
                            <select class="selectpicker form-control" data-live-search="true" id="replacement_reason"
                                name="replacement_reason" >
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
                            <select class="selectpicker form-control" data-live-search="true" id="outcome_cancellation"
                                name="policy_commission" >
                                <option value="">Select</option>
                                <?php foreach ($PolicyCommission as $val){ ?>
                                <option value="<?php echo $val['id']?>"
                                    <?php if ($val['id'] == $cancellationDetails[0]['policy_commission']) { echo 'selected'; } ?>>
                                    <?php echo $val['new_policy_commission']?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div></br>
                </div>
            </div>
        </form>
    </div>
</div>
