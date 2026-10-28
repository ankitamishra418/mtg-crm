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
                $sortorder = $data['fieldSortOrder'];
                $JsonEncode = json_encode($sortorder);

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
                    
                    // for ($i = 0; $i < $currencyareacount; $i++) {
                    //     $currencyarealabel = $data['currencyarealabel'][$i];
                      
                    ?>
                        <!-- <div class="col-md-6 addMarginTop">
                            <label><?php //echo $currencyarealabel ?></label>
                        
                            <input class='form-control' type='text' step='any' id='text_"+i+"'
                                name="<?// echo $currencyarealabel?>"
                                value="<?php// echo $benefit['policy_benefits'][0][str_replace(" ","_","$currencyarealabel")]?>"
                                onkeypress="clsAlphaNoOnly(event)" onpaste="return false" required /> 
                        </div>-->
                        <?php //}

                        for ($i = 0; $i < $currencyareacount; $i++) {
                            $currencyarealabel = $data['currencyarealabel'][$i];
                            $username = $benefit['policy_benefits'][0][str_replace(" ","_","$currencyarealabel")];
                            $dollerData = mb_substr($username, 0, 1); ?>
                            <div class="col-md-6 addMarginTop">
                            <label><?php echo $currencyarealabel ?></label>
                            <input class='form-control' type='text' step='any' id='text_<?php echo $i; ?>'
                                name="<?php echo $currencyarealabel?>"
                                value="<?php if($dollerData == '$'){ echo ($username); } 
                                else{ echo '$' . ($username); } ?>"
                                onkeyup='clsAlphaNoOnly(<?php echo $i; ?>)' onpaste="return false" required />

                                <!-- value="<?php //if($dollerData == '$'){ echo ($benefit['policy_benefits'][0][str_replace(" ","_","$currencyarealabel")]); } 
                               // else{ echo '$' . ($benefit['policy_benefits'][0][str_replace(" ","_","$currencyarealabel")]); } ?>"
                                onkeypress="clsAlphaNoOnly(event)" onpaste="return false" required /> -->
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
                <input type="hidden" name ="sortednumber" value ='<?php echo $JsonEncode?>'>
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
<script>
// function clsAlphaNoOnly (e) {  // Accept only alpha numerics, no special characters
//   var regex = new RegExp("^[0-9+. ]+$");
//   var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//   if (regex.test(str)) {
//       return true;
//   }
//   e.preventDefault();
//   return false;
// }


function clsAlphaNoOnly (t) {
  $('#text_'+ t).on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() {
      formatCurrency($(this), "blur");
    }
  });
  };
  function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  }
  function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") { return; }
    var original_len = input_val.length;
    var caret_pos    = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
      var decimal_pos = input_val.indexOf(".");
      var left_side   = input_val.substring(0, decimal_pos);
      var right_side  = input_val.substring(decimal_pos);
      left_side       = formatNumber(left_side);
      right_side      = formatNumber(right_side);
      if (blur === "blur") {
          right_side += "00";
      }
      right_side  = right_side.substring(0, 2);
      input_val   = "$" + left_side + "." + right_side;
    } else {
      input_val = formatNumber(input_val);
      input_val = "$" + input_val;
      if (blur === "blur") {
          input_val += ".00";
      }
    }
    input.val(input_val);
    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}
</script>
</html>
