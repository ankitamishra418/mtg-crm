<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<?php init_head();?>
<div id="wrapper">
   <div class="content">
        <div class="panel_s">
			<div class="panel-body">
            <form method="post" action="<?php echo base_url(); ?>admin/policy/updatesavepolicydetails/<?php echo $benefit['id']?>">
                <div class="row addMarginTop">
                <?php  
                $textcount = $data['textcount'];
                $checkcount = $data['checkcount'];
                $radiocount = $data['radiocount'];
                $dropdowncount = $data['dropdowncount'];
                $multiselectcount = $data['multiselectcount'];
                $textareacount = $data['textareacount'];
                $currencyareacount = $data['currencyareacount'];
                $dateareacount = $data['dateareacount'];
                for ($i = 0; $i < $textcount; $i++) {
                $textlabel = $data['textlabel'][$i]; ?>
                    <div class="col-md-6 addMarginTop">
                        <label><?php echo $textlabel ?></label>
                        <input class='form-control' type ='text'  id='text_"+i+"' name="<?php echo $textlabel?>" value="<?php echo $benefit['policy_benefits'][0][str_replace(" ","_","$textlabel")]?>" required/>
                    </div>
                <?php } ?>
                <div class="col-md-12 addMarginTop">
                <?php
                for ($i = 0; $i < $checkcount; $i++) {
                $checklabel = $data['checklabel'][$i];
                ?>
                <div class="col-md-2">
                    <label><?php echo $checklabel ?></label>
                </div>
                <div class="row addMarginTop">
                    <?php  $total_option =$data['count_check_option'][$i];
                        for ($y = 0; $y< $total_option; $y++){
                        ?>
                        <div class="col-md-2">
                            <input class='' type ='checkbox'  id='check_"+i+"' name="<?php echo $checklabel?>[]" <?php if(in_array($data['checkboxoption'][$i][$y],$benefit['policy_benefits'][0][str_replace(" ","_","$checklabel")])){echo "checked";}?> value="<?php echo $data['checkboxoption'][$i][$y]?>"/>
                            <label><?php echo $data['checkboxoption'][$i][$y]?></label>
                        </div>
                        <?php }?>
                </div>
                <?php } ?>
                </div>
                <div class="col-md-12 addMarginTop">
                <?php
                for ($i = 0; $i < $radiocount; $i++) {
                $radiolabel = $data['radiolabel'][$i];
                ?>
                    <div class="col-md-2">
                            <label><?php echo $radiolabel?></label>
                    </div>
                <div class="row addMarginTop">
                        <?php  $total_option =$data['count_radio_option'][$i];
                        for ($y = 0; $y< $total_option; $y++){
                        ?>
                        <div class="col-md-2">
                            <input class='' type ='radio'  id='radio_"+i+"' name="<?php echo $radiolabel?>" <?php if($data['redio_option'][$i][$y]==$benefit['policy_benefits'][0][str_replace(" ","_","$radiolabel")]){echo "checked";}?> value="<?php echo $data['redio_option'][$i][$y]?>" required/>
                            <label><?php echo $data['redio_option'][$i][$y]?></label>
                        </div>
                        <?php }?>
                        </div>
                <?php }?>
                </div>
                <?php
                for ($i = 0; $i < $dropdowncount; $i++) {
                $droplabel = $data['droplabel'][$i];
                ?>
                    <div class="col-md-6 addMarginTop">
                        <label><?php echo $droplabel ?></label>
                        <select class='selectpicker form-control' data-live-search='true' id='box_"+i+"' name="<?php echo $droplabel?>"required>
                            <option value="<?php echo $benefit['policy_benefits'][0][str_replace(" ","_","$droplabel")]?>" selected><?php echo $benefit['policy_benefits'][0][str_replace(" ","_","$droplabel")]?></option>
                            <?php $total_option =$data['count_dropdown_option'][$i];
                            for ($y = 0; $y < $total_option; $y++){ ?>
                                <option value="<?php echo $data['option'][$i][$y]?>"><?php echo $data['option'][$i][$y] ?></option>
                            <?php }?>
                        </select>
                    </div>
                <?php }
                for ($i = 0; $i < $multiselectcount; $i++) {
                $multiselectlabel = $data['multiselectlabel'][$i];
                ?>
                    <div class="col-md-6 addMarginTop">
                        <label><?php echo $multiselectlabel ?></label>
                        <select class='selectpicker  form-control' multiple data-live-search='true' name="<?php echo $multiselectlabel?>[]"required>
                            <?php $total_option =$data['count_multi_option'][$i];
                            for ($y = 0; $y < $total_option; $y++){ ?>
                                <option value="<?php echo $data['multioption'][$i][$y]?>" <?php if(in_array($data['multioption'][$i][$y],$benefit['policy_benefits'][0][str_replace(" ","_","$multiselectlabel")])){?>selected <?php } ?>><?php echo $data['multioption'][$i][$y] ?></option>
                           <?php }?>
                        </select>
                    </div>
                <?php } 
                for ($i = 0; $i < $textareacount; $i++) {
                $textarealabel = $data['textarealabel'][$i];
                ?>
                    <div class="col-md-6 addMarginTop">
                        <label><?php echo $textarealabel ?></label>
                        <textarea class='form-control' rows='3'  name="<?php echo $textarealabel ?>" value="<?php echo $benefit['policy_benefits'][0][str_replace(" ","_","$textarealabel")]?>" required><?php echo $benefit['policy_benefits'][0][str_replace(" ","_","$textarealabel")]?></textarea>
                    </div>
                    <?php } 
                    
                    for ($i = 0; $i < $currencyareacount; $i++) {
                        $currencyarealabel = $data['currencyarealabel'][$i];
                      
                    ?>
                        <div class="col-md-6 addMarginTop">
                            <label><?php echo $currencyarealabel ?></label>

                            <input class='form-control' type='number' step='any' id='text_"+i+"'
                                name="<?php echo $currencyarealabel?>"
                                value="<?php echo $benefit['policy_benefits'][0][str_replace(" ","_","$currencyarealabel")]?>"
                                required />
                        </div>
                        <?php }

                     for ($i = 0; $i < $dateareacount; $i++) {
                        $datearealabel = $data['datearealabel'][$i]; 
                    ?>
                        <div class="col-md-6 addMarginTop">
                            <label><?php echo $datearealabel ?></label>

                            <input class='form-control' type='date' id='text_"+i+"' name="<?php echo $datearealabel?>"
                                value="<?php echo $benefit['policy_benefits'][0][str_replace(" ","_","$datearealabel")]?>"
                                required />
                        </div>
                        <?php }
                            ?>
                
                </div>
                <div class="row addMarginTop">
                <div class="col-md-6">
                            <input type="hidden" name="policy_id" value="<?php echo $benefit['policy_id']?>">
							<button type="submit" class="btn btn-info">Update</button>
							<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
				</div>
                </div>
            </form>
            </div>
        </div>
	</div>
</div>
<?php init_tail(); ?>
</body>
</html>
