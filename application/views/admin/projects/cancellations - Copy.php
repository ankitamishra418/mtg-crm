<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4>Policy Cancellation</h4>
<div class="claims-feed">
    <div class="content">
        <form method="post" action="<?php echo base_url('admin/projects/policyCancellation');?>">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Source</label>
                            <select class="selectpicker form-control" multiple data-live-search="true" id="source" name="source" required>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>API Being Cancelled</label>
                            <input type="text" class="form-control" name="api_being _cancelled" required>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Date Received</label>
                            <input type="date" class="form-control" name="date_received" required>
                        </div>
                        <div class="col-md-4">
                            <label>Clawback period</label>
                            <input type="date" class="form-control" name="clawback_period" required>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Reason for Cancellation</label>
                            <select class="selectpicker form-control" data-live-search="true" id="reason_for_cancellation" name="reason_for_cancellation" required>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Clawback amount</label>
                            <select class="selectpicker form-control"  data-live-search="true" id="set_contact" name="clawback_amount" required>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                            <div class="col-md-4">
                            <label>Claim Identified</label>
                            </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="radio"  name="claim_Identified"  value ='0' required>
                            <label>Yes</label>
                            <input type="radio"  name="claim_Identified" value ='1' required>
                            <label>NO</label>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Outcome of Cancellation</label>
                            <select class="selectpicker form-control"  data-live-search="true" id="outcome_cancellation" name="outcome_cancellation" required>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info">Save</button>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Replacement Business</label>
                            <select class="selectpicker form-control"  data-live-search="true" id="replacement_business" name="replacement_business" required>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Replacement Reason</label>
                            <select class="selectpicker form-control"  data-live-search="true" id="replacement_reason" name="replacement_reason" required>
                            </select>
                        </div>
                    </div></br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>New Policy Commission</label>
                            <select class="selectpicker form-control"  data-live-search="true" id="outcome_cancellation" name="policy_commission" required>
                            </select>
                        </div>
                    </div></br>
                </div>
            </div>
        </form>
    </div>
</div>
