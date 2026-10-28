<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4 class="customer-profile-group-heading"><?php echo _l('projects'); ?></h4>
<?php if(isset($client)){ ?>
<?php if(has_permission('projects','','create')){ ?>
<!-- <a href="<?php /* echo admin_url('projects/project?customer_id='.$client->userid); ?>" class="btn btn-info mbot25<?php if($client->active == 0){echo ' disabled';} ?>"><?php echo _l('new_project'); */?></a> -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal"
    data-target="#myModal"><?php echo _l('new_project');?></button>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Choose Project Template</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <label  for="cars">Choose a Project:</label> -->
                        <select class="selectpicker form-control" name="project" id="select-project"
                            onchange="myFunction()">
                            <option value="">Choose Project Template</option>
                           <?php print_r($projecttemplates); ?>
                            <?php foreach($projecttemplates as $projecttemplate){ ?>
                            <option value="<?php echo $projecttemplate['template_id']; ?>">
                                <?php echo $projecttemplate['template_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="copy-select-project" onclick="" data-name="" type="button"
                    class="btn btn-info">Proceed</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<div class="row">
    <?php
      $_where = '';
      if(!has_permission('projects','','view')){
        $_where = 'id IN (SELECT project_id FROM '.db_prefix().'project_members WHERE staff_id='.get_staff_user_id().')';
      }
      ?>
    <?php foreach($project_statuses as $status){ ?>
    <div class="col-md-5ths total-column">
        <div class="panel_s">
            <div class="panel-body">
                <h3 class="text-muted _total">
                    <?php $where = ($_where == '' ? '' : $_where.' AND ').'status = '.$status['id']. ' AND clientid='.$client->userid; ?>
                    <?php echo total_rows(db_prefix().'projects',$where); ?>
                </h3>
                <span style="color:<?php echo $status['color']; ?>"><?php echo $status['name']; ?></span>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php $this->load->view('admin/projects/copy_settings'); ?>
<?php
   $this->load->view('admin/projects/table_html', array('class'=>'projects-single-client'));
}
?>
<script>
function myFunction(e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = document.getElementById("select-project").value;
    var text = $("#select-project").find('option:selected').text();
    let HtmlSelected = text.trim();
    // alert((HtmlSelected));
    $("#copy-select-project").attr("onclick", "copy_project(" + valueSelected + ", this);return false;");
    $("#copy-select-project").attr("data-name", HtmlSelected);
    init_ajax_search('customer', '#clientid_copy_project.ajax-search');
}
</script>