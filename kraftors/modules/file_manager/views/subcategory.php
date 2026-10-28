<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">

			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<div role="tabpanel" class="tab-pane" id="job_position_tab">
							<div class="_buttons">
								<?php if(is_admin() || has_permission('staffmanage_job_position','','create')) { ?>
									<a href="#" onclick="new_file_cate(); return false;" class="btn btn-info pull-left ">
										<?php echo _l('Add Subcategory'); ?>
									</a>
								<?php } ?>
						</div>
						<div class="clearfix"></div>
						<br>
						<div class="modal bulk_actions" id="table_contract_bulk_actions" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title"><?php echo _l('hr_bulk_actions'); ?></h4>
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
							_l('Name'),
                            _l('category_name'),
							_l('description'),
							_l('Date'),
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

        <div class="modal fade" id="new_file_category" tabindex="-1" role="dialog">
			<div class="modal-dialog new_job_positions_dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">
							<span class="edit-title"><?php echo _l('Edit Subcategory'); ?></span>
							<span class="add-title"><?php echo _l('Add New Subcategory'); ?></span>
						</h4>
					</div>
					<?php echo form_open_multipart(admin_url('file_manager/add_edit_file_subcategory'),array('id'=>'job_position','autocomplete'=>'off')); ?>           
					<div class="modal-body">
						<div id="additional_proposal"></div>
						<!-- general_info start -->
						<div role="tabpanel" class="tab-pane active" id="general_infor">
							<div class="row">
								<div class="col-md-6">
									<div id="additional"></div>   
								</div>
								<div class="col-md-12">
									<?php 
									echo render_input('name','Subcategory Name'); ?>
								</div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="category_id" class="control-label get_id_row" value ="0" ><?php echo _l('category'); ?></label>
                                        <select name="category_id" class="selectpicker" id="category_id" data-width="100%" data-live-search="true"  data-actions-box="true" data-none-selected-text="<?php echo _l('Select Category'); ?>"> 
                                            <?php foreach($category as $c){ ?> 
                                                <option value="<?php echo html_entity_decode($c['id']); ?>"><?php echo html_entity_decode($c['name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="bold"><?php echo _l('Subcategory Description'); ?></p>
									<?php $contents = ''; if(isset($project)){$contents = $project->description;} ?>
									<?php echo render_textarea('description','',$contents,array(),array(),'','tinymce'); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
						<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
					</div>
					<?php echo form_close(); ?>                 
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- New position group -->
		
	</div>
</div>
</div>

<?php init_tail(); ?>

</body>
</html>

<script>
			
			var jobPositionServerParams = {
				//"department_id": "[name='department_id[]']",
				//"job_p_id": "[name='job_p_id[]']"
			};
			
			var table_job_position = $('.table-table_job_position');
			
			
			initDataTable(table_job_position, admin_url + 'file_manager/table_subcategory', [0], [0], jobPositionServerParams, [0, 'desc']);
			
			//hide first column
			var hidden_columns = [1];
			//$('.table-table_job_position').DataTable().columns(hidden_columns).visible(false, false);

			// $('#department_id').on('change', function() {
			// 	table_job_position.DataTable().ajax.reload().columns.adjust().responsive.recalc();
			// });
			// $('#job_p_id').on('change', function() {
			// 	table_job_position.DataTable().ajax.reload().columns.adjust().responsive.recalc();
			// });

			appValidateForm($("body").find('.job_p'), {
				'name': 'required'
			});

		</script>
		
