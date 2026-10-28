<div class="modal modalallcallconfirm" tabindex="-1" role="dialog" id="buyconfirm">
  <div class="modal-dialog" role="document">
  	<form action="<?= admin_url('twilio/twilio_menu/saveConfiguration') ?>" method="post">
  		<input type="hidden" name="phone_number_id" id="phone_number_id" value="">
      <input type="hidden" name="phone__number" id="phone__number" value="">
  		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
     <div class="modal-content">
       <div class="modal-header bg-modaltitle">
         <h6 class="modal-title">Your selected phone number: <span id="confirm__number">123</span></h6>
       </div>
       <div class="modal-body"> 
        <div class="form-group">
          <label><?= _l('staff'); ?></label>
          <select name="staff" class="selectpicker" id="staff" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">  
           <option value=""></option>        
           <?php foreach($staff as $s){ ?> 
            <option value="<?php echo htmlspecialchars($s['staffid']); ?>"  <?php if(isset($contracts) && $contracts[0]['staff'] == $s['staffid'] ){echo 'selected';} ?>> <?php echo htmlspecialchars($s['firstname']).' '.htmlspecialchars($s['lastname']); ?></option>                   

          <?php }?>

        </select>
      </div>

      <div class="form-group"> 
       <input type="checkbox" name="recording" id="check-recording">
       <label for="check-recording" style="font-size: 16px;"><?= _l('Recording'); ?></label>
     </div>
     <div class="form-group"> 
       <input type="checkbox" name="set_default" id="set_default">
       <label for="set_default" style="font-size: 16px;"><?= _l('Set Default'); ?></label>
     </div>
   </div>

   <div class="modal-footer">

     <div class="modal-btnconfirm">
      <button type="submit" class="btn btn-primary">Confirm</button>
      <button type="button" class="btn btn-cancel-modal" data-dismiss="modal">Cancel</button>
    </div> 
  </div>
</form>
</div>
</div>