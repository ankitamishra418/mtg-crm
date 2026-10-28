<?php 
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
   .filterContaniner{
    display: flex;
    flex-direction: column;
    align-content: center;
    text-align: center;
    align-items: center;
   }
   .textLavele{
    width:81%;
    font-weight: bold;
   }
</style>
<h4>Compliance</h4>
<div class="filterContaniner">
    
    <form  action="<?php echo base_url('admin/projects/filetr/');?>" id="myForm" method="post">
    <input  type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                                value="<?php echo $this->security->get_csrf_hash();?>">
    <input type="hidden" name="project_id" value="<?php echo $projectid ?>" id="project_id">
    <input type="hidden" name="url_redirect"  id="url_redirect" value="<?php if(isset($filter)){?>1<?php }?>">
        <div class="row">
          <div class="col-sm-6 textLavele">Categories Without Files</div>
          <div class="col-sm-2">
            <input type="checkbox"  name ="categories_without_files" id ="categories_without_files" class="" <?php if(isset($filter)){echo 'checked';}?>>
          </div>
        </div>
    </form>
</div>
<table class="table dt-table">
    <thead class="thead-dark">
        <tr  class="">
            <th scope="col" >Sr.n</th>
            <th scope="col">Workfelow</th>
            <th scope="col">Adviser</th>
            <!-- <th scope="col">%Complete</th> -->
            <th scope="col">Stage</th>
            <th scope="col">Compliance Category</th>
            <th scope="col">File Description</th>
            <th scope="col">Upload Date</th>
            <th scope="col">Link to file</th>
            <th scope="col">Uploaded By</th>
            <!-- <th scope="col">Workflow Status</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
         $i = 1; 
         foreach($combinedArray as $combinedData){ 
        ?>
        <tr class="">
        <td scope="row" ><?php echo $i; ?></td>
        <td><?php echo $combinedData['workfelow_name']?></td>
        <td><?php echo $combinedData['adviser']?></td>
        <!-- <td><?php //echo $combinedData['progress']?></td> -->
        <td><?php echo $combinedData['stage']?></td>
        <td><?php echo $combinedData['category']?></td>
        
        <td><?php echo $combinedData['file_description']?></td>
        <td><?php echo $combinedData['updated_date']?></td>
        <td><?php echo $combinedData['file_link']?></td>
        <td><?php echo $combinedData['uploaded_by']?></td>
        <!-- <td><?php //echo $combinedData['workflow_status']?></td> -->
        </tr>
        <?php $i++;} ?>
    </tbody>
</table>




