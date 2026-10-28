<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<?php init_head();?>
<div id="wrapper">
  <div class="content">
    <div class="panel_s">
      <div class="panel-body">
        <?php //echo "<pre>"; print_r($selectedbenefits); exit; ?>
        <div class="container-fluid">
          <!-- <span class="addfontSize">Contacts</span> -->
            <h3>Benefits</h3>
          <?php if(isset($client_id)){ ?>
            <button type="button" class="btn btn-danger" style='float:right;'><a href="<?php echo admin_url('clients/client/' . $client_id . '?group=policies');?>" style="color:#fff;">Close</a></button>
           <?php } 
          else if(isset($benifitsID))
          {?>
              <button type="button" class="btn btn-danger" style='float:right;'><a href="<?php 
              echo admin_url('clients/client/' . $benifitsID . '?group=policies');
              //echo base_url('admin/policy/showPolicyData')?>" style="color:#fff;">Close</a></button>
              <?php 
          } else 
          {?>
            <button type="button" class="btn btn-danger" style='float:right;'><a href="<?php 
            echo base_url('admin/policy/showPolicyData')?>" style="color:#fff;">Close</a></button>
            <?php
          }
          ?>  
          </div>
      <hr/>
    <div class="container-fluid">
      <div class="tab">
        <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
          <?php $i=1; foreach($data[0]['life_assured'] as $val)   {  ?>
            <li  class="idget tablinks<?php if($i == 1){ ?> active<?php } ?>" onclick="selectedTab(<?php echo $i ?>)" id='tablinks_<?php echo $i?>' value=<?php echo $data[0]['contact_id'][$i-1]?>>
            <a><?php echo $val ?></a>
            </li>
          <?php $i++; } ?>
        <ul>
      </div>
      <?php $i=1; foreach($data[0]['life_assured'] as $val)   { ?>
        <div class="tab_fields <?php if($i == 1){?>custom-display <?php } else { ?> custom-hide <?php } ?>" id="tablinks_fields_<?php echo $i?>">
          <div class="button-group coldf" id="btn-benefit_<?php echo $i ?>">
            <button type="button" class="btn btn-info" id="add-benefit_<?php echo $i ?>" onclick="addbenefit(<?php echo $i ?>)">Add Benefit</button>
          </div>
            <div class="benefit-title-con custom-hide" id="benefit-title-con_<?php echo $i?>">
              <select class="selectpicker form-control form-control-lg" data-live-search="true"  name="benefit-title" onchange="selectbenefit(<?php echo $i ?>)" id="benefit-title_<?php echo $i?>">
                <option value="" selected disabled>Select Benefit Title</option>
                  <?php $j=1; foreach ($benefits['data'] as $val) {?>
                    <option value="<?php echo $val['form_title']?>" id="option_<?php echo $i?>_<?php echo $j?>" data-element-id="<?php echo $val['id'] ?>">
                    <?php echo $val['form_title']?>
                    </option>
                  <?php $j++;}?>
              </select>
            </div>
            <form method="post" action="<?php echo base_url(); ?>admin/policy/savepolicydetails" id="form_<?php echo $i ?>">
              <input type="hidden" name="contact_id" id="contact_<?php echo $i?>">
              <input type="hidden" name="policy_id" id="policy_id" value=<?php echo $this->uri->segment(4);?>>
              <div id="feild_<?php echo $i ?>"></div>
              <input type="hidden" name="benefit_id" id="benefits_field">
              <button type="submit" class="btn btn-info addMarginTop" id="save_<?php echo $i?>" style="display:none">ADD</button>
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            </form>
            <?php if($i == 1){?>
              <input type="hidden" name="active_hidden_<?php echo $i?>" id="active_hidden_<?php echo $i?>" value="1"> 
              <?php } else { ?> 
                <input type="hidden" name="active_hidden_<?php echo $i?>" id="active_hidden_<?php echo $i?>" value="0">
            <?php } ?>
        </div>
      <?php $i++; } ?>
           <input type="hidden" name="count_hidden" id="count_hidden" value="<?php echo $i - 1 ?>">
    </div>
       <!-- <input type="hidden" id='deletedtitle' value=''></input> -->
    </div>
    </div>
  </div>
  <div class="content">
  <?php //echo "<pre>"; print_r($benefits);
            for ($i=0; $i<count($selectedbenefits); $i++){ 
              $keys = array_keys($selectedbenefits[$i]['policy_benefits'][0]);
              $arraySize = count($selectedbenefits[$i]['policy_benefits'][0]);
              $j=0;
              if($selectedbenefits[$i]['contact_id']){
                if($i==0){ ?>
                 <h4>All Benefit Details</h4></br>
                <?php } ?>
    <div class="panel_s">
          <div class="panel-body addPageColor">      
            <div class="row addRowMarginleft">
              <div class="col-md-4">
                 <div class="row">
                    <div class="col-md-12">
                    <label class="addColor"><?php echo $selectedbenefits[$i]['contact_id'];?></label>
                    </div>
                 </div>
              </div>
              <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-12">
                    <label class="addColor"><?php echo $selectedbenefits[$i]['title'];?></label>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>    
            <div class="row addRowMarginleft"> 
             <?php }
            for($j=0; $j < $arraySize; $j++) { ?>
              <div class="col-md-4">
                <div class="col-md-6">
                  <strong class="setMargin setFontSize"><?php  echo str_replace("_"," ","$keys[$j]")?></strong>
                </div>
                <div class="col-md-6">
                <?php
                if(is_array($selectedbenefits[$i]['policy_benefits'][0][$keys[$j]])){ ?>
                  <label ><?php echo implode(",",$selectedbenefits[$i]['policy_benefits'][0][$keys[$j]]);?></label>
                <?php } else { ?>
                <!-- <label><?php //echo $selectedbenefits[$i]['policy_benefits'][0][$keys[$j]];?></label> -->
                <label><?php $dataRowValue = $selectedbenefits[$i]['policy_benefits'][0][$keys[$j]];
                  $dollerData = mb_substr($dataRowValue, 0, 1);
                  $date = $dataRowValue;
                  if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
                    $timestamp = strtotime($dataRowValue);
                    echo date("d/m/Y", $timestamp);
                  }
                  elseif($dollerData == '$' || is_numeric($dataRowValue)){
                    if($dollerData == '$'){
                      // $str = substr($dataRowValue, 1);
    
                      // if(is_numeric($str)){
                      //   // echo '$'. number_format($str);
                      //   echo '$'.number_format(($str) ,2).''; 
                      // }
                      echo $dataRowValue;
                    }
                    else{
                      if(is_numeric($dataRowValue)){
                        // echo '$'. number_format($dataRowValue);
                        echo '$'.number_format(($dataRowValue) ,2).''; 
                      }
                    }
                  }
                  else{
                    echo $dataRowValue;
                  }
                  ?>
                </label>
                <?php }?>
                </div>
            </div>
           <?php } ?> </div><hr> <?php }  //echo count($benefits); exit;?>
        </div>
    </div> 
  </div>
</div>
<input type="hidden" id="url"  value="<?php echo admin_url('Policy/fetchBenefitfield')?>">
<?php init_tail(); ?>
</body>
<script>
  var titlearray =[];
  function selectedTab(id) {
    var count = $("#count_hidden").val();
    if ($('#tablinks_'+id).hasClass('active') == false) {
      $('#tablinks_'+id).addClass('active');
      $('#tablinks_fields_'+id).addClass('custom-display');
      $('#tablinks_fields_'+id).removeClass('custom-hide');
      for (var i = 1; i <= count; i++) {
          if (i != id) {
            $('#tablinks_fields_'+i).addClass('custom-hide');
            $('#tablinks_fields_'+i).removeClass('custom-display');
            $('#tablinks_'+i).removeClass('active');
          }
      }
    }
  }
  function addbenefit(id) {
    var contact_id = $('#tablinks_'+id).val();
    var sid = $('#contact_'+id).val(contact_id);
    $('#benefit-title-con_'+id).removeClass('custom-hide');
    $('#benefit-title-con_'+id).addClass('custom-display');
  }

  function selectbenefit(id) {
    $("#save_"+id).css('display','block');
    $('#add-benefit_'+id).prop( "disabled", true );
    var selectedOption = $('#benefit-title-con_' + id + ' option:selected');
    var benefitId = selectedOption.data("element-id");
    $("#benefits_field").val(benefitId);

    var title = $("#benefit-title_"+id).val();
     $("#deletedtitle").val(title);
     titlearray.push(title);
    $("#selctectedtitle" ).val(titlearray);
    var url = $("#url").val();
    $('#benefit-title-con_'+id).removeClass('custom-display');
    $('#benefit-title-con_'+id).addClass('custom-hide');
    var rem = title.replace(/\s+/g, "");
    var uniqcontantid = $("#benefit-title_"+id).children(":selected").attr("id");
    var contanthtml = "<div style='margin-top:10px; border:1px solid black; padding:21px' id ='contant_"+uniqcontantid+"'><label style='font-size: 24px;' id='"+title+"_"+id+"'>"+title+"</label><input type='hidden' name='title' value='"+title+"'><button id='dlfeild_"+uniqcontantid+"' value='"+title+"' type='button'  onclick='deletebenefit("+uniqcontantid+","+id+")' class='btn btn-danger' style='float:right; margin-right:9px;'>Delete</button></div>";
    $("#feild_"+id).append(contanthtml);
    $("#benefit-title_"+id).selectpicker('refresh');
    $.ajax({
                    url: url,
                    type: "POST",
					          datatype : "application/json",
                    data: {
                        'title': title,
                    },
                    success: function (datas) {
                    var data = JSON.parse(datas);
                    var sortedFieldKeys = [];
                    var sortedFieldValues = [];
                    var sortTotal = 0;
                    $.each(data, function( index, value ) {
                      if (index == 'fieldSortOrder') {
                        $.each(value, function( key, val ) {
                          sortedFieldKeys.push(key);
                          sortedFieldValues.push(val);
                          sortTotal++;
                        });
                      }
                    });
                    var sortedLabels = [];
                    for (var c = 0; c <= sortTotal; c++) {
                      $.each(sortedFieldValues, function( key, val ) {
                          if (val == c) {
                            sortedLabels.push(sortedFieldKeys[key]);
                          }
                      });
                    }
                    var textcount = data.textcount;
                    var checkcount = data.checkcount;
                    var radiocount = data.radiocount;
                    var dropdowncount = data.dropdowncount;
                    var multiselectcount = data.multiselectcount;
                    var textareacount = data.textareacount;
                    var currencyareacount = data.currencyareacount;
                    var dateareacount = data.dateareacount;
                    var j=0; // use for get field  SortOrder
                    var jsonarray = Object.values(data.fieldSortOrder); // get fieldSortOrder values in array 
                    var arrayToShow = [];
                    var appendsortednumber = "<input type='hidden' name='sortednumber' value="+data.sortnumber+">";
                    $("#feild_"+id).append(appendsortednumber);
                    for (let i = 0; i < textcount; i++) {
                      var textlabel = data.textlabel[i];
                      var html='';
                      var htmll = "<div><label class='text-center' style='margin:10px; font-size:16px;'>"+textlabel+"</label><input class='form-control' type ='text' name='"+textlabel+"' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191' id='text_"+i+"' required/><input type='hidden' name='sort-"+textlabel+"' value="+jsonarray[j]+"></div>";
                      var htmlnew = htmll+html;
                      var pos = $.inArray(textlabel, sortedLabels);
                      arrayToShow[pos + 1] = htmlnew;
                      j++;
                    }
                    for (let i = 0; i < checkcount; i++) {
                      var checklabel = data.checklabel[i];
                      var html='';
                      var htmll = "<div><label class='text-center' style='margin:10px; font-size:16px;'>"+checklabel+"</label><input type='hidden' name='sort-"+checklabel+"' value="+jsonarray[j]+"><div id='Cbox_"+i+"'></div></div>";
                      var htmlnew = htmll+html;
                      var pos = $.inArray(checklabel, sortedLabels);
                      arrayToShow[pos + 1] = htmlnew;
                      j++;
                    }
                    for (let i = 0; i < radiocount; i++) {
                      var radiolabel = data.radiolabel[i];
                      var html='';
                      var htmll = "<div><label class='text-center'; style='margin:10px; font-size:16px;'>"+radiolabel+"</label><input type='hidden' name='sort-"+radiolabel+"' value="+jsonarray[j]+"><div id='Rbox_"+i+"'></div></div>";
                      var htmlnew = htmll+html;
                      var pos = $.inArray(radiolabel, sortedLabels);
                      arrayToShow[pos + 1] = htmlnew;
                      j++;
                    }
                    for (var i = 0; i < dropdowncount; i++) {
                      var droplabel = data.droplabel[i];
                      var html='';
                      var htmll = "<div><label style='margin:10px; font-size:16px;'>"+droplabel+"</label><input type='hidden' name='sort-"+droplabel+"' value="+jsonarray[j]+"><select class='selectpicker form-control' data-live-search='true' id='box_"+i+"' name='"+droplabel+"' required><option>Select</option></select></div>"; 
                      var htmlnew = htmll+html;
                      var total_option =data.count_dropdown_option[i];
                      for (var y = 0; y < total_option; y++){
                        var op = '<option>'+data.option[i][y]+'</option>';
                        $("#box_"+i).append(op);
                      }
                      var pos = $.inArray(droplabel, sortedLabels);
                      arrayToShow[pos + 1] = htmlnew;
                      j++;
                      $('.selectpicker').selectpicker('render');
                    }
                    for (let i = 0; i < multiselectcount; i++) {
                      var multiselectlabel = data.multiselectlabel[i];
                      var html='';
                      var htmll = "<div><label style='margin:10px; font-size:16px;'>"+multiselectlabel+"</label><input type='hidden' name='sort-"+multiselectlabel+"' value="+jsonarray[j]+"><select class='selectpicker  form-control' multiple data-live-search='true' name='"+multiselectlabel+"[]' id='mbox_"+i+"' required><option >Select</option></select></div>";
                      var htmlnew = htmll+html;
                      var total_option =data.count_multi_option[i];
                      for (var y = 0; y < total_option; y++){
                        var op = '<option>'+data.multioption[i][y]+'</option>';
                        $("#mbox_"+i).append(op);
                      }
                      var pos = $.inArray(multiselectlabel, sortedLabels);
                      arrayToShow[pos + 1] = htmlnew;
                      j++;
                      $('.selectpicker').selectpicker('render');
                    }
                    for (let i = 0; i < textareacount; i++) {
                      var textarealabel = data.textarealabel[i];
                      var html='';
                      var htmll = "<div><label style='margin:10px; font-size:16px;'>"+textarealabel+"</label><input type='hidden' name='sort-"+textarealabel+"' value="+jsonarray[j]+"><textarea class='form-control' rows='3' style='border:1px solid #919191; margin-bottom:10px;' name='"+textarealabel+"' required></textarea></div>";
                      var htmlnew = htmll+html;
                      var pos = $.inArray(textarealabel, sortedLabels);
                      arrayToShow[pos + 1] = htmlnew;
                      j++;
                    }
                    for (let i = 0; i < currencyareacount; i++) {
                      var currencyarealabel = data.currencyarealabel[i];
                      var html='';
                      var htmll = "<div><label class='text-center' style='margin:10px; font-size:16px;'>"+currencyarealabel+"</label><input type='hidden' name='sort-"+currencyarealabel+"' value="+jsonarray[j]+"><input class='form-control' type ='' step='any' name='"+currencyarealabel+"' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191' id='currency_"+i+"'  onkeypress='clsAlphaNoOnly("+i+")' onpaste='return false' required> </div>";
                      //var htmll = "<div><label class='text-center' style='margin:10px; font-size:16px;'>"+currencyarealabel+"</label><input type='hidden' name='sort-"+currencyarealabel+"' value="+jsonarray[j]+"><input class='form-control' type ='number' step='any' name='"+currencyarealabel+"' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191' id='currency_"+i+"' required> </div>";
                      var htmlnew = htmll+html;
                      var pos = $.inArray(currencyarealabel, sortedLabels);
                      arrayToShow[pos + 1] = htmlnew;
                      j++;
                    }
                    for (let i = 0; i < dateareacount; i++) {
                      var datearealabel = data.datearealabel[i];
                      var html='';
                      
                      var htmll = "<div><label class='text-center' style='margin:10px; font-size:16px;'>"+datearealabel+"</label><input type='hidden' name='sort-"+datearealabel+"' value="+jsonarray[j]+"><input  type ='date' class='form-control' name='"+datearealabel+"' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191' id='date_"+i+"' required/></div>";
                      var htmlnew = htmll+html;
                      var pos = $.inArray(datearealabel, sortedLabels);
                      arrayToShow[pos + 1] = htmlnew;
                      j++;
                    }
                    // console.log(arrayToShow);
                    $.each(arrayToShow, function( key, val ) {
                          if (val != '') {
                            $("#contant_"+uniqcontantid).append(val);
                          }
                    });
                    // console.log(arrayToShow);
                    for (let i = 0; i < checkcount; i++) {
                      var checklabel = data.checklabel[i];
                      var  total_option =data.count_check_option[i];
                      for (var y = 0; y < total_option; y++) { 
                        console.log(data.checkboxoption[i][y]);
                        var op ="<input type ='checkbox' name='"+checklabel+"[]' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;margin-left:10px;' id='check_"+i+"' value='"+data.checkboxoption[i][y]+"'><label class='text-center' style='margin:10px; font-size:16px;'>"+data.checkboxoption[i][y]+"</label>";
                        $("#Cbox_"+i).append(op);
                      }
                      j++;
                    }
                    for (let i = 0; i < radiocount; i++) {
                      var radiolabel = data.radiolabel[i];
                      var  total_option =data.count_radio_option[i];
                      for (var y = 0; y < total_option; y++){
                        var op ="<input type ='radio' name='"+radiolabel+"' style='margin-top:10px; margin-bottom: 10px;border:1px solid #919191;margin-left:10px;' id='check_"+i+"' value="+data.redio_option[i][y]+" required><label class='text-center' style='margin:10px; font-size:16px;'>"+data.redio_option[i][y]+"</label>";
                        $("#Rbox_"+i).append(op);
                      }
                      j++;
                    }
                    for (var i = 0; i < dropdowncount; i++) {
                      var droplabel = data.droplabel[i];
                      var total_option =data.count_dropdown_option[i];
                      for (var y = 0; y < total_option; y++){
                        var op = '<option>'+data.option[i][y]+'</option>';
                        $("#box_"+i).append(op);
                      }
                      $('.selectpicker').selectpicker('render');
                    }
                    for (let i = 0; i < multiselectcount; i++) {
                      var multiselectlabel = data.multiselectlabel[i];
                      var total_option =data.count_multi_option[i];
                      for (var y = 0; y < total_option; y++){
                        var op = '<option>'+data.multioption[i][y]+'</option>';
                        $("#mbox_"+i).append(op);
                      }
                      $('.selectpicker').selectpicker('render');
                    }
                  }
				});
  }
  function deletebenefit(id,i) {
      var deletedvalue = $("#dlfeild_"+id.id).val();
      var s = titlearray.lastIndexOf(deletedvalue);
       console.log(s);
      titlearray.splice(s);
      console.log(titlearray);
      $("#benefit-title_"+i).val('');
      var div_count = $("#feild_"+i).children('div').size();
      if( div_count ==1){
        $("#save_"+i).css('display','none');
      }
      $("#contant_"+id.id).remove();
      $('#add-benefit_'+i).removeAttr("disabled");
  }
</script>
<!-- Sort Order JS -->
<script>
function orderSorted(x) { 
  var result = confirm("ARE YOY SURE TO CHANGE SORT ORDER");
   if(result == true){
    var sortorderNumber = $('#sortorder_'+x).val();
    var benefitid =  $('#benefitid_'+x).val();
    var actionurl = "<?php echo base_url('admin/policy/sortedOrderbytitle')?>"
          $.ajax({
              type: 'POST',
              url: actionurl,
              data: {
                  id: benefitid,
                  sortorderNumber: sortorderNumber
              },
              dataType: "json",
              success: function(data) {
              }
          }); 
   }
   $(window).off('beforeunload');
   window.location.reload();
}
</script>

<script>
// function clsAlphaNoOnly (e) {  // Accept only alpha numerics, no special characters
//   var regex = new RegExp("^[0-9 ]+$");
//   var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//   if (regex.test(str)) {
//       return true;
//   }
//   e.preventDefault();
//   return false;
// }


function clsAlphaNoOnly (t) {
  $('#currency_'+ t).on({
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
</html> 