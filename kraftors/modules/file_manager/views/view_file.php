<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
    span.txtSpan {
    font-size: 18px;
    margin-bottom: 6px;
    display: block;
}
span.txtSpan span{font-weight:600;}
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
            <?php $file = $file[0]; ?>
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
						<div role="tabpanel" class="tab-pane" id="job_position_tab">
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <?php
                                $ext = pathinfo($file['file'], PATHINFO_EXTENSION);
                                if ($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') { ?>
                                    <img class="fileImags" src="https://crm.visibidemo.app/modules/file_manager\uploads\files/<?= $file['file'] ?>" alt="<?= $file['filename']  ?>">
								    <a class="downloadIcon" href="https://crm.visibidemo.app/modules/file_manager\uploads\files/<?= $file['file'] ?>" download title='full view'><i class="fa fa-download"></i></a>
                                <?php }else{ ?>
                                    <p>File name : <?= $file['file'] ?></p>
								    <a class="downloadIcon" href="https://crm.visibidemo.app/modules/file_manager\uploads\files/<?= $file['file'] ?>" download title='full view'><i class="fa fa-download"></i></a>
                               <?php }
                                
                                ?>
                               
						    </div>
                            <div class="col-md-8 col-xs-12">
                                <h3><?php echo $file['filename']?></h3>
                                <span class="txtSpan"> <span>Category :</span> <?php echo  $this->file_model->get_categoryname_by_id($file['category_id']); ?></span>
                                <span class="txtSpan"> <span>Sub Category :</span> <?php echo  $this->file_model->get_subcategoryname_by_id($file['subcategory_id']); ?></span>
                                <?php $staffname = $this->db->select('firstname,lastname')->where('staffid',$file['addfrom'])->get('tblstaff')->result_array(); 
                                foreach($staffname as $staffkey=>$staffvalue){
                         		        $staff_nmae = $staffvalue['firstname'].' '.$staffvalue['lastname'];
                         		    }
                                ?>
                                <span class="txtSpan"> <span>Uploaded by :</span> <?php echo $staff_nmae?></span>
                                <span class="txtSpan"> <span>Description :</span> <?php echo $file['file_description']?></span>
                               <?php
                            //   echo '<pre>';
                            //     $groupId = $file['groupid'];
                                
                            //         $where_in_GroupId = explode(',',$groupId);
                                    
                                   
                            //         $jobPositions = $this->db->where_in('job_p_id',$where_in_GroupId)->get('tblhr_job_position')->result_array();
                                   
                                   
                                    
                            //         $jobPositionId = [];
                            //         foreach($jobPositions as $key => $value){
                            //           $jobPositionId[] = $value['position_id'];
                            //         }
                                  
                                    
                            //          $where_in_jobPositionId = $jobPositionId;
                                     
                            //          $totalStaffToDisplay = $this->db->where_in('job_position',$where_in_jobPositionId)->get('tblstaff')->result_array();
                                    
                            //         $sId = [];
                            //         foreach($totalStaffToDisplay as $staffId){
                            //             $sId[] = $staffId['staffid'];
                            //         }
                            //         $staffarray = array_unique($sId);
                            //     print_r($staffarray);exit;
                               ?>
                                <div class="clearfix"></div>
        						<br>
                            </div>
                        </div>
						
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="btn-bottom-pusher"></div>
		<div id="contract_file_data"></div>
		<div id="new_version"></div>
	</div>
  </div>
</div>

<?php init_tail(); ?>

</body>
</html>