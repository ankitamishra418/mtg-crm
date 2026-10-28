<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper">

  <div class="content">

    <div class="row">

      <div class="col-md-<?php if(!isset($automationRule)){echo '8 col-md-offset-2';} else {echo '6';} ?>">

        <div class="panel_s">

          <div class="panel-body">

            <h4 class="no-margin"><?php echo $title; ?></h4>

            <hr class="hr-panel-heading" />

            <?php echo form_open($this->uri->uri_string()); ?>

            <?php $attrs = (isset($automationRule) ? array() : array('autofocus'=>true)); ?>

            <?php $value = (isset($automationRule) ? $automationRule->name : ''); ?>

            <?php echo render_input('name','name',$value,'text',$attrs); ?>
            <div class="form-group select-placeholder"> 
              <label for="module_type" class="control-label"><?php echo _l('Module'); ?></label> 
              <select name="module_name" id="module_type" class="selectpicker" data-width="100%" data-none-selected-text="select"> 
                <option value=""></option> 
                <option value="support" data-subtext="support" <?php if(isset($automationRule) && $automationRule->module_name == 'support'){echo 'selected';} ?>>Support</option> 
                <option value="lead" data-subtext="lead" <?php if(isset($automationRule) && $automationRule->module_name == 'lead'){echo 'selected';} ?>>Lead</option>  
              </select> 
            </div> 
            <div id="lead__section" style="display: none;"> 
              <?php   
                $selected = (isset($automationRule) ? $automationRule->from_lead_status_id : ''); 
                echo render_select('from_lead_status_id',$leadstatuses,array('id','name'),'from_status', $selected);
                $selected = (isset($automationRule) ? $automationRule->to_lead_status_id : '');  
                echo render_select('to_lead_status_id',$leadstatuses,array('id','name'),'to_status', $selected); 
             
                 $selected = (isset($automationRule) ? $automationRule->from_lead_source_id : get_option('leads_default_source')); 
                 echo render_select('from_lead_source_id',$sources,array('id','name'), 'from_source',$selected);  

                 $selected = (isset($automationRule) ? $automationRule->to_lead_source_id : get_option('leads_default_source')); 
                 echo render_select('to_lead_source_id',$sources,array('id','name'), 'to_source',$selected);  
                  $selected = (isset($automationRule) ? $automationRule->from_role_id : ''); 
                  echo render_select('from_role_id',$roles,array('roleid','name'),'from_role',$selected);
                  $selected = (isset($automationRule) ? $automationRule->to_role_id : ''); 
                  echo render_select('to_role_id',$roles,array('roleid','name'),'to_role',$selected);
              ?>  
            </div>
            <div id="support__section" style="display: none;"> 
              <?php  
              $selectedDepartment = (isset($automationRule) ? $automationRule->from_department_id : ''); 

              echo '<div class="'.($this->input->get('department_id') ? 'hide' : '').'">';
              echo render_select('from_department_id',$departments,array('departmentid','name'),'from_department',$selectedDepartment,array()); 
              echo '</div>'; 
              ?> 
              <?php

              $selectedDepartment = (isset($automationRule) ? $automationRule->to_department_id : '');

              echo '<div class="'.($this->input->get('department_id') ? 'hide' : '').'">';

              echo render_select('to_department_id',$departments,array('departmentid','name'),'to_department',$selectedDepartment,array());

              echo '</div>';

              ?> 

              <?php 
             // $selected = (isset($automationRule) ? $automationRule->staff_id : '');

             // echo render_select('staff_id',$members,array('staffid',array('firstname','lastname')),'staff_member',$selected,array('data-none-selected-text'=>_l('all_staff_members'))); 

              ?> 
              <?php echo render_select('status_id',$statuses,array('ticketstatusid','name'),'from_status',$automationRule->status_id,array(),array(),'no-mbot','',false); 
               $selected = (isset($automationRule) ? $automationRule->to_status_id : '');
               echo render_select('to_status_id',$statuses,array('ticketstatusid','name'),'to_status',$selected,array(),array(),'no-mbot','',false);  


              $priorities['callback_translate'] = 'ticket_priority_translate';
              $selected = (isset($automationRule) ? $automationRule->priority_id : '');
              echo render_select('priority_id',$priorities,array('priorityid','name'),'from_priority',$selected); 
              $selected = (isset($automationRule) ? $automationRule->to_priority_id : '');
              echo render_select('to_priority_id',$priorities,array('priorityid','name'),'to_priority',$selected); 

              ?>

              <?php if(get_option('services') == 1){  
                $selectedS = (isset($automationRule) ? $automationRule->service_id : ''); 
                echo render_select('service_id',$services,array('service_id','name'),'ticket_settings_service',$selectedS);  
                } ?>
            </div>
           

          <?php $value = (isset($automationRule) ? _d($automationRule->start_date) : _d(date('Y-m-d'))); ?>

          <?php //echo render_date_input('start_date','goal_start_date',$value); ?>

          <?php $value = (isset($automationRule) ? _d($automationRule->end_date) : ''); ?>

          <?php //echo render_date_input('end_date','goal_end_date',$value); ?> 

          <?php $value = (isset($automationRule) ? $automationRule->description : ''); ?>

          <?php echo render_textarea('description','goal_description',$value); ?>

          <div class="form-group select-placeholder">

          <label for="goal_type" class="control-label"><?php echo _l('When [Run script]'); ?></label>

          <select name="duration_type" id="duration_type" class="selectpicker" data-width="100%" data-none-selected-text="select">

            <option value=""></option> 

            <option value="1" data-subtext="For within 1 days" <?php if(isset($automationRule) && $automationRule->duration_type == '1'){echo 'selected';} ?>>Hourly</option> 

            <option value="2" data-subtext="For more than one days" <?php if(isset($automationRule) && $automationRule->duration_type == '2'){echo 'selected';} ?>>Days</option>

          </select>

        </div> 

        <?php $value = (isset($automationRule) ? $automationRule->duration : ''); ?>

        <?php echo render_input('duration','duration',$value,'number'); ?> 
        <!-- <div class="checkbox checkbox-primary"> 
            <input type="checkbox" name="notify_when_achieve" id="notify_when_achieve" <?php if(isset($automationRule)){if($automationRule->notify_when_achieve == 1){echo 'checked';} } else {echo 'checked';} ?>> 
            <label for="notify_when_achieve"><?php echo _l('goal_notify_when_achieve'); ?></label> 
        </div>

        <div class="checkbox checkbox-primary"> 
            <input type="checkbox" name="notify_when_fail" id="notify_when_fail" <?php if(isset($automationRule)){if($automationRule->notify_when_fail == 1){echo 'checked';} } else {echo 'checked';} ?>> 
            <label for="notify_when_fail"><?php echo _l('goal_notify_when_fail'); ?></label> 
          </div> --> 
          <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button> 
          <?php echo form_close(); ?> 
        </div> 
      </div> 
    </div> 
  </div> 
</div> 
</div> 
<?php init_tail(); ?> 
  <script> 
    $(function(){ 
     appValidateForm($('form'), { 
      name: 'required', 
      duration_type: 'required', 
      duration: 'required', 
      module_name: 'required', 
      // to_department_id: 'required', 
      // from_department_id: 'required', 
      // status_id: 'required', 
      // priority_id: 'required', 
    // end_date: 'required', 
    // start_date: 'required', 
    }); 

    $('#module_type').on('change',function(){
      var moduleNm= $(this).val();
      if (moduleNm=='lead') {
        $('#lead__section').css('display','block');
        $('#support__section').css('display','none');
      }else if(moduleNm=='support'){
        $('#lead__section').css('display','none');
        $('#support__section').css('display','block');
      }else{
        $('#lead__section').css('display','none');
        $('#support__section').css('display','none');
      }
    }); 
      var moduleNm= $('#module_type').val();
      if (moduleNm=='lead') {
        $('#lead__section').css('display','block');
        $('#support__section').css('display','none');
      }else if(moduleNm=='support'){
        $('#lead__section').css('display','none');
        $('#support__section').css('display','block');
      }else{
        $('#lead__section').css('display','none');
        $('#support__section').css('display','none');
      }
   
  }); 
  </script> 
</body> 
</html>

