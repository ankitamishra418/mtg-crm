<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
    .mydata {
    background-color: #fbfdff;
    border: 1px dashed #c0ccda;
    border-radius: 6px;
    min-height:150px;
}
input.form-control.dropzone {
    opacity: 0;
    position: absolute;
    top: 0;
    height: 100%;
}
</style>
<div id="wrapper">
	<div class="content">
		<div class="row">

			<?php if($this->session->flashdata('debug')){ ?>
				<div class="col-lg-12">
					<div class="alert alert-warning">
						<?php echo html_entity_decode($this->session->flashdata('debug')); ?>
					</div>
				</div>
			<?php } ?>

			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<div role="tabpanel" class="tab-pane" id="job_position_tab">
							<div class="_buttons">
								<?php if(is_admin() || has_permission('file_manager','','create')) { ?>
									<a href="#" onclick="new_job_pstns(); return false;" class="btn btn-info pull-left ">
										<?php echo _l('Add new File'); ?>
									</a>
								<?php } ?>
						</div>
						<div class="clearfix"></div>
						<br>

						<!-- <div class="row">

                        <br>
							<div class="col-md-3 pull-right">
								<div class="form-group ">
									<select name="cat" class="selectpicker" id="cat_id" data-width="100%" data-live-search="true" multiple="true" data-actions-box="true" data-none-selected-text="<?php echo _l('SubCategory'); ?>"> 
                                        <option value="1">Sub Category1</option>
                                        <option value="2">Sub Category2</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 pull-right">
								<div class="form-group">
									<select name="department_id[]" class="selectpicker" id="department_id" data-width="100%" data-live-search="true" multiple="true" data-actions-box="true"  data-none-selected-text="<?php echo _l('Category') ?>">

									<option value="1">Category1</option>
                                        <option value="2">Category2</option>

									</select>
								</div>
							</div>
						</div> -->
						<?php if(!is_admin()){ ?>
						<div class="col-md-3 pull-right">
								<div class="form-group">
									<select name="category" class="selectpicker" id="category_id" data-width="100%" data-live-search="true"  data-actions-box="true"  data-none-selected-text="<?php echo _l('Category') ?>">
									<option>Select category</option>
									<?php foreach($category as $c){ ?>
										<option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
									<?php } ?>
									</select>
								</div>
						</div>
						<div class="col-md-3 pull-right">
								<div class="form-group">
									<select name="subcategory" class="selectpicker" id="subcategory_id" data-width="100%" data-live-search="true"  data-actions-box="true"  data-none-selected-text="<?php echo _l('Category') ?>">
										<option>Select subcategory</option>
									<?php foreach($subcategory as $sc){ ?>
										<option value="<?= $sc['id'] ?>"><?= $sc['name'] ?></option>
									<?php } ?>
									</select>
								</div>
						</div>
						<?php } ?>

						<div class="modal bulk_actions" id="table_contract_bulk_actions1" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title"><?php echo _l('hr_bulk_actgroions'); ?></h4>
									</div>
									<div class="modal-body">
										<?php if(has_permission('staffmanage_job_position','','delete') || is_admin()){ ?>
											<div class="checkbox checkbox-danger">
												<input type="checkbox" name="mass_delete" id="mass_delete">
												<label for="mass_delete"><?php echo _l('hr_mass_delete'); ?></label>
											</div>
										<?php } ?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('hr_close'); ?></button>

										<?php if(has_permission('staffmanage_job_position','','delete') || is_admin()){ ?>
											<a href="#" class="btn btn-info" onclick="staff_delete_bulk_action(this); return false;"><?php echo _l('hr_confirm'); ?></a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>

						<?php if (has_permission('staffmanage_job_position','','delete')) { ?>
							<a href="#"  onclick="staff_bulk_actions(); return false;" data-toggle="modal" data-table=".table-table_job_position" data-target="#leads_bulk_actions" class=" hide bulk-actions-btn table-btn"><?php echo _l('hr_bulk_actions'); ?></a>
						<?php } ?>

						<?php render_datatable(array(
							'<span class="hide"> - </span><div class="checkbox mass_select_all_wrap"><input type="checkbox" id="mass_select_all" data-to-table="table_job_position"><label></label></div>',
							_l('File Name'),
							_l('File Category'),
							_l('File Subcategory'),
							_l('File Description'),
							_l('Review date'),
						),'table_job_position',
						array('customizable-table'),
						array(
							'id'=>'table-table_job_position',
							 'data-last-order-identifier'=>'table_job_position',
							 'data-default-order'=>get_table_last_order('table_job_position'),
						)); ?>

					</div>


					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		
		

		<div class="btn-bottom-pusher"></div>
		<div id="contract_file_data"></div>
		<div id="new_version"></div>

        <div class="modal fade" id="new_job_positions" tabindex="-1" role="dialog">
			<div class="modal-dialog new_job_positions_dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">
							<span class="edit-title"><?php echo _l('Edit File'); ?></span>
							<span class="add-title"><?php echo _l('New File'); ?></span>
						</h4>
					</div>
					<?php echo form_open_multipart(admin_url('file_manager/add_edit_file'),array('id'=>'job_position','autocomplete'=>'off')); ?>           
					<div class="modal-body">
						<div id="additional_proposal"></div>

						<!-- general_info start -->
						<div role="tabpanel" class="tab-pane active" id="general_infor">
							<div class="row">
								<div class="col-md-6">
									<div id="additional"></div> 
									<div id="showstaff" style="display:none;"> 
									<?php
									
									$st = $this->db->get('tblstaff')->result_array($data);
									?>
									    <select class="selectpicker" >
									        <?php foreach($st as $staff){ ?>
									        <option value="<?php echo $staff['staffid']  ?>"><?php echo $staff['firstname'].' '.$staff['lastname'] ?></option>
									        <?php } ?>
									    </select>
									</div>

								</div>
								<div class="col-md-12">
								<div id="reviewDate"></div>  

									<?php 
									echo render_input('file_name','File name'); ?>
								</div>
                                
                                <div class="col-md-12">
                                  
								<div class="form-group">
							  
										<?php echo render_select('groupid[]',$job_p_id,array('job_id','job_name'),'Job Group','',array('multiple'=>true),array(),'','',false); ?>
									   
									</div>
								</div>
								
								<div class="col-md-6">
								<div class="form-group">
										<label for="category_id" class="control-label get_id_row" value ="0" ><?php echo _l('Category'); ?></label>

										<select name="category_id" class="selectpicker" id="category_id" data-width="100%" data-live-search="true"  data-action-box="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
											<option></option>
											<?php foreach($category as $c) { ?>	
												<option value="<?php echo html_entity_decode($c['id']); ?>"><?php echo html_entity_decode($c['name']); ?></option>
											<?php } ?>
										</select>
									</div>
									<?php // echo render_select('job_p_id',$job_p_id,array('job_id','job_name'),'Category'); ?>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="subcategory_id" class="control-label get_id_row" value ="0" ><?php echo _l('Sub Category'); ?></label>

										<select name="subcategory_id" class="selectpicker" id="subcategory_id" data-width="100%" data-live-search="true" data-action-box="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
										    <option></option>
										    <?php foreach($subcategory as $sc) { ?>	
											<option value="<?php echo html_entity_decode($sc['id']); ?>"><?php echo html_entity_decode($sc['name']); ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<p class="bold"><?php echo _l('File Description'); ?></p>
									<?php $contents = ''; if(isset($project)){$contents = $project->description;} ?>
									<?php echo render_textarea('file_description','',$contents,array(),array(),'','tinymce'); ?>
								</div>
							</div>

							<!-- view attachment file -->
							<div class="row">
								<div id="position_attachments" class="mtop30 col-md-12 "></div>
							</div>
							<!-- file attachment -->
							<div class="row">
								<div class="col-md-12">
									<div class=" attachments">
										<div class="attachment">
											<div class="col-md-12 pl-0">
												<div class="form-group">
													<label for="attachment" class="control-label"><?php echo _l('add_task_attachments'); ?></label>
													<div class="mydata">
													    <!--<p>Upload Document</p>-->
													    <div id="file-upload-filename" ></div>
														<img class="project-file-image" id="blah" src="#" width="100%" />
														<input id="file-upload" type="file" extension="<?php echo str_replace('.','',get_option('allowed_files')); ?>" filesize="<?php echo file_upload_max_size(); ?>" class="form-control dropzone" name="file" style="width: 551px;height: 200px;" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('hr_close'); ?></button>
						<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
					</div>
					<?php echo form_close(); ?>                 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- New position group -->
		<div class="modal fade" id="job_p" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">
							<span class="edit-title"><?php echo _l('hr_edit_job_p'); ?></span>
							<span class="add-title"><?php echo _l('hr_new_job_p'); ?></span>
						</h4>
					</div>
					<?php echo form_open_multipart(admin_url('hr_profile/job_p'),array('class'=>'job_p','autocomplete'=>'off')); ?>
					<div class="modal-body">
						<div id="additional_job"></div>
						<div role="tabpanel" class="tab-pane active" id="general_infor">
							<div class="row">
								<div class="col-md-12">
									<div id="additional"></div>   
									<div class="form">     
										<?php 
										echo render_input('job_name','hr_job_p'); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">

									<p class="bold"><?php echo _l('hr_hr_description'); ?></p>
									<?php $contents = ''; if(isset($project)){$contents = $project->description;} ?>
									<?php echo render_textarea('description','',$contents,array(),array(),'','tinymce'); ?>
								</div>
							</div>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('hr_close'); ?></button>
						<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
					</div>
					<?php echo form_close(); ?>                 
				</div>
			</div>
		</div>


	</div>
</div>
</div>

<?php init_tail(); ?>

</body>
</html>

<script>
			
			var jobPositionServerParams = {
				"department_id": "[name='department_id[]']",
				"job_p_id": "[name='job_p_id[]']"
			};
			
			var table_job_position = $('.table-table_job_position');
			
			
			initDataTable(table_job_position, admin_url + 'file_manager/table_file', [0], [0], jobPositionServerParams, [0, 'desc']);
			
			//hide first column
			var hidden_columns = [1];
			//$('.table-table_job_position').DataTable().columns(hidden_columns).visible(false, false);

			$('#department_id').on('change', function() {
				table_job_position.DataTable().ajax.reload().columns.adjust().responsive.recalc();
			});
			$('#job_p_id').on('change', function() {
				table_job_position.DataTable().ajax.reload().columns.adjust().responsive.recalc();
			});

			appValidateForm($("body").find('.job_p'), {
				'job_name': 'required'
			});

		</script>
		
		<!--<script>-->
  <!--  		$(document).ready(function() {-->
  <!--              var readURL = function(input) {-->
  <!--                  if (input.files && input.files[0]) {-->
  <!--                      var reader = new FileReader();-->
  <!--                      var infoArea = document.getElementById( 'file-upload-filename' );-->
  <!--                      reader.onload = function (e) {-->
  <!--                          $('.profile-pic').attr('src', e.target.result);-->
  <!--                      }-->
  <!--                      reader.readAsDataURL(input.files[0]);-->
  <!--                  }-->
  <!--              }-->
  <!--              $(".file-upload").on('change', function(){-->
  <!--                  readURL(this);-->
  <!--              });-->
  <!--              $(".upload-button").on('click', function() {-->
  <!--                 $(".file-upload").click();-->
  <!--              });-->
  <!--          });-->
  <!--  	</script>-->
    	
    	
    	<script>
    	    var input = document.getElementById( 'file-upload' );
            var infoArea = document.getElementById( 'file-upload-filename' );
            
            input.addEventListener( 'change', showFileName );
            
            function showFileName( event ) {
              
              // the change event gives us the input it occurred in 
              var input = event.srcElement;
              
              // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
              var fileName = input.files[0].name;
              
              var ext = fileName.split('.').pop();
              
              if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'jfif'){
                  $('.project-file-image').show();
              }else{
                  $('.project-file-image').hide();
                  $('#file-upload-filename').show();
              }
              
              // use fileName however fits your app best, i.e. add it into a div
              infoArea.textContent = 'File name: ' + fileName;
            }
    	</script>