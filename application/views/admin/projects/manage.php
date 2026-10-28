<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
            <div class="panel_s">
              <div class="panel-body">
              <div class="_buttons">
              <?php if(has_permission('projects','','create')){ ?>
                <!-- <a href="<?php echo admin_url('projects/project'); ?>" class="btn btn-info pull-left display-block mright5">
                  <?php echo _l('new_project'); ?>
                </a> -->
                <button onclick="document.getElementById('custom-modal').style.display='block'" class="btn btn-info pull-left display-block mright5">New Activity</button>
              <?php } ?>
              <div id="custom-modal" class="w3-modal w3-animate-opacity modal fade in">
                <div class="w3-modal-content w3-animate-top w3-card-4 radius">
                  <header class="modal-header"> 
                    <span onclick="document.getElementById('custom-modal').style.display='none'" 
                    class="w3-button w3-large w3-display-topright timesX">&times;</span>
                    <h4 class="modal-title">Choose Activity Template</h4>
                  </header>
                  <div class="modal-body">
                   <div class="row">
                      <div class="col-md-12">
                        <!-- <label  for="cars">Choose a Project:</label> -->
                        <select class="selectpicker form-control" name="project" id="select-project">
                        <option value="">Choose Activity Template</option>
                          <?php foreach($projecttemplates as $projecttemplate){ ?>
                          <option value="<?php echo $projecttemplate['template_id']; ?>"><?php echo $projecttemplate['template_name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      
                    <div class="col-md-12" >
                    <button id="copy-select-project" onclick="" data-name="" class="btn btn-info display-block waves-effect waves-effect waves-light waves-ripple copyProject proceed">Proceed</button>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <a href="<?php echo admin_url('projects/gantt'); ?>" data-toggle="tooltip" title="<?php echo _l('project_gant'); ?>" class="btn btn-default"><i class="fa fa-align-left" aria-hidden="true"></i></a>
              <div class="btn-group pull-right mleft4 btn-with-tooltip-group _filter_data" data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-filter" aria-hidden="true"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right width300">
                  <li>
                    <a href="#" data-cview="all" onclick="dt_custom_view('','.table-projects',''); return false;">
                      <?php echo _l('expenses_list_all'); ?>
                    </a>
                  </li>
                  <?php
                  // Only show this filter if user has permission for projects view otherwise wont need this becuase by default this filter will be applied
                  if(has_permission('projects','','view')){ ?>
                  <li>
                    <a href="#" data-cview="my_projects" onclick="dt_custom_view('my_projects','.table-projects','my_projects'); return false;">
                      <?php echo _l('home_my_projects'); ?>
                    </a>
                  </li>
                  <?php } ?>
                  <li class="divider"></li>
                  <?php foreach($statuses as $status){ ?>
                    <li class="<?php if($status['filter_default'] == true && !$this->input->get('status') || $this->input->get('status') == $status['id']){echo 'active';} ?>">
                      <a href="#" data-cview="<?php echo 'project_status_'.$status['id']; ?>" onclick="dt_custom_view('project_status_<?php echo $status['id']; ?>','.table-projects','project_status_<?php echo $status['id']; ?>'); return false;">
                        <?php echo $status['name']; ?>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="clearfix"></div>
                <hr class="hr-panel-heading" />
              </div>
               <div class="row mbot15">
                <div class="col-md-12">
                  <h4 class="no-margin"><?php echo _l('projects_summary'); ?></h4>
                  <?php
                  $_where = '';
                  if(!has_permission('projects','','view')){
                    $_where = 'id IN (SELECT project_id FROM '.db_prefix().'project_members WHERE staff_id='.get_staff_user_id().')';
                  }
                  ?>
                </div>
                <div class="_filters _hidden_inputs">
                  <?php
                  echo form_hidden('my_projects');
                  foreach($statuses as $status){
                   $value = $status['id'];
                     if($status['filter_default'] == false && !$this->input->get('status')){
                        $value = '';
                     } else if($this->input->get('status')) {
                        $value = ($this->input->get('status') == $status['id'] ? $status['id'] : "");
                     }
                     echo form_hidden('project_status_'.$status['id'],$value);
                    ?>
                   <div class="col-md-2 col-xs-6 border-right">
                    <?php $where = ($_where == '' ? '' : $_where.' AND ').'status = '.$status['id']; ?>
                    <a href="#" onclick="dt_custom_view('project_status_<?php echo $status['id']; ?>','.table-projects','project_status_<?php echo $status['id']; ?>',true); return false;">
                     <h3 class="bold"><?php echo total_rows(db_prefix().'projects',$where); ?></h3>
                     <span style="color:<?php echo $status['color']; ?>" project-status-<?php echo $status['id']; ?>">
                     <?php echo $status['name']; ?>
                     </span>
                   </a>
                 </div>
                 <?php } ?>
               </div>
             </div>
             <div class="clearfix"></div>
              <hr class="hr-panel-heading" />
             <?php echo form_hidden('custom_view'); ?>
             <?php $this->load->view('admin/projects/table_html'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('admin/projects/copy_settings'); ?>
<?php init_tail(); ?>
<script>
$(function(){
     var ProjectsServerParams = {};

     $.each($('._hidden_inputs._filters input'),function(){
         ProjectsServerParams[$(this).attr('name')] = '[name="'+$(this).attr('name')+'"]';
     });

     initDataTable('.table-projects', admin_url+'projects/table', undefined, undefined, ProjectsServerParams, <?php echo hooks()->apply_filters('projects_table_default_order', json_encode(array(5,'asc'))); ?>);

     init_ajax_search('customer', '#clientid_copy_project.ajax-search');
});
$('#select-project').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var HtmlSelected = $(this).find('option:selected').text();
    $("#copy-select-project").attr("onclick","copy_project("+valueSelected+", this);return false;");
    $("#copy-select-project").attr("data-name",HtmlSelected);
});
</script>
</body>
</html>
