<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4>Underwriting</h4>
<div class="claims-feed">
    <div class="content">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <label>Related Project ID</label>
                <input type="text" class="form-control" name="condition" required>

            </div>
            <div class="col-md-4">
                <label>Final Status</label>
                <select class="selectpicker form-control customer-email-tab" multiple data-live-search="true" id="set_contact" name="life_assured[]" required>
                </select>
            </div>
            <div class="col-md-4">
                <label>Submitted Date</label>
                <input type="date" class="form-control" name="condition" required>
            </div>
        </div></br>
        <div class="row">
            <div class="col-md-4">
                <label>Submitted API</label>
                <input type="text" class="form-control" name="condition" required>
            </div>
            
            <div class="col-md-4">
                <label>Date Requested to Issue</label>
                <input type="date" class="form-control" name="condition" required>
            </div>
            <div class="col-md-4">
                <label>Commission Split</label>
                <select class="selectpicker form-control customer-email-tab" multiple data-live-search="true" id="set_contact" name="life_assured[]" required>
                </select>
            </div>
        </div></br>
        <div class="row">
            <div class="col-md-4">
                <label>Requested API</label>
                <input type="text" class="form-control" name="condition" required>
            </div>
            <div class="col-md-4">
                <label>Reason for Policy not issued</label>
                <select class="selectpicker form-control customer-email-tab" multiple data-live-search="true" id="set_contact" name="life_assured[]" required>
                </select>
            </div>
        </div></br>
        <div class="row">
        <div class="col-md-6">
        <button type="submit" class="btn btn-info">Save</button>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
		</div>
        </div>
    </form>    
    </div>
</div>
</div>
