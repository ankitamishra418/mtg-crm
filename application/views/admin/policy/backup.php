<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<?php init_head();?>
<div id="wrapper">
  <div class="content">
    <div class="panel_s">
      <div class="panel-body">
      <h3>Contacts</h3>
      <hr/>
    <div class="container-fluid">
      <div class="tab" >
     <?php  // echo "<pre>";print_r($data[0]['contact_id']); exit; ?>
     <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
        <?php $i=1; foreach($data[0]['life_assured'] as $val)   {  ?>
          <li  class="tablinks<?php if($i == 1){ ?> active<?php } ?>" onclick="selectedTab(<?php echo $i ?>)" id='tablinks_<?php echo $i?>' value=<?php echo $data[0]['contact_id'][$i-1]?>>
          <a><?php echo $val ?></a>
          </li>
        <?php $i++; } ?>
      <ul>
      </div>
      <?php $i=1; foreach($data[0]['life_assured'] as $val)   {  ?>
        <div class="tab_fields <?php if($i == 1){?>custom-display <?php } else { ?> custom-hide <?php } ?>" id="tablinks_fields_<?php echo $i?>">
          <div class="button-group coldf" id="btn-benefit_<?php echo $i ?>">
            <button type="button" class="btn btn-info" id="add-benefit_<?php echo $i ?>" onclick="addbenefit(<?php echo $i ?>)">Add Benefit</button>
          </div>
            <div class="benefit-title-con custom-hide" id="benefit-title-con_<?php echo $i?>">
              <select class="selectpicker form-control form-control-lg" data-live-search="true"  name="benefit-title" onchange="selectbenefit(<?php echo $i ?>)" id="benefit-title_<?php echo $i?>">
                <option value >Select Beneifit Title</option>
                  <?php $j=1; foreach ($benefits['data'] as $val) {?>
                    <option value="<?php echo $val['form_title']?>" id="option_<?php echo $i?>_<?php echo $j?>">
                    <?php echo $val['form_title']?>
                    </option>
                  <?php $j++;}?>
              </select>
            </div>
            <form method="post" action="<?php echo base_url(); ?>admin/policy/savepolicydetails" id="form_<?php echo $i ?>">
              <input type="hidden" name="contact_id" id="contact_id">
              <!-- <input type="hidden" id='selctectedtitle' name ="selctectedtitle" value=''></input> -->
              <div id="feild_<?php echo $i ?>"></div>
              <button type="submit" class="btn btn-info addMarginTop" id="save_<?php echo $i?>" style="display:none">Save</button>
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
</div>
<input type="hidden" id="url"  value="<?php echo admin_url('Policy/featchBenefitfield')?>">
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
    $('#contact_id').val(contact_id);
    $('#benefit-title-con_'+id).removeClass('custom-hide');
    $('#benefit-title-con_'+id).addClass('custom-display');
  }
   
  function selectbenefit(id) {
    $("#save_"+id).css('display','block');
    $('#add-benefit_'+id).prop( "disabled", true );
    var title = $("#benefit-title_"+id).val();
     $("#deletedtitle").val(title);
    titlearray.push(title);
    $("#selctectedtitle" ).val(titlearray);
    for (var option of document.getElementById("benefit-title_"+id).options) {
      if(title == option.value){
        $("#"+option.id).attr( "disabled", "disabled");
      }
  }
    var url = $("#url").val();
    $('#benefit-title-con_'+id).removeClass('custom-display');
    $('#benefit-title-con_'+id).addClass('custom-hide');
    var rem = title.replace(/\s+/g, "");
    var uniqcontantid = $("#benefit-title_"+id).children(":selected").attr("id");
    var contanthtml = "<div style='margin-top:10px; border:2px solid black; padding:22px' id ='contant_"+uniqcontantid+"'><label style='font-size: 24px;' id='"+title+"_"+id+"'>"+title+"</label><input type='hidden' name='title[]' value='"+rem+"'><button id='dlfeild_"+uniqcontantid+"' value='"+title+"' type='button'  onclick='deletebenefit("+uniqcontantid+","+id+")' class='btn btn-danger' style='float:right; margin-right:9px;'>Delete</button></div>";
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
                      console.log(datas);
                    var data = JSON.parse(datas);
                    var textcount = data.textcount;
                    var checkcount = data.checkcount;
                    var radiocount = data.radiocount;
                    var dropdowncount = data.dropdowncount;
                    var multiselectcount = data.multiselectcount;
                    var textareacount = data.textareacount;
                    for (let i = 0; i < textcount; i++) {
                      var textlabel = data.textlabel[i];
                      var html='';
                      var htmll = "<div><label class='text-center' style='margin:10px; font-size:16px;'>"+textlabel+"</label><input class='form-control col-md-6' type ='text' name= '"+rem+"_text_"+i+"' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191' id='text_"+i+"'/></div>";
                      var htmlnew = htmll+html;
                      $("#contant_"+uniqcontantid).append(htmlnew);
                    }
                    for (let i = 0; i < checkcount; i++) {
                      var checklabel = data.checklabel[i];
                      var html='';
                      var htmll = "<div><input class='' type ='checkbox' name= '"+rem+"_checkbox_"+i+"' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191;margin-left:10px;' id='check_"+i+"'/><label class='text-center' style='margin:10px; font-size:16px;'>"+checklabel+"</label></div>";
                      var htmlnew = htmll+html;
                      $("#contant_"+uniqcontantid).append(htmlnew);
                    }
                    for (let i = 0; i < radiocount; i++) {
                      var radiolabel = data.radiolabel[i];
                      var html='';
                      var htmll = "<div><input class='' type ='radio' name= '"+rem+"_radio' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191; margin-left:10px;' id='radio_"+i+"'/><label class='text-center'; style='margin:10px; font-size:16px;'>"+radiolabel+"</label></div>";
                      var htmlnew = htmll+html;
                      $("#contant_"+uniqcontantid).append(htmlnew);
                    }
                    for (let i = 0; i < dropdowncount; i++) {
                      //var count_dropdown_option+id = data.count_dropdown_option1;
                      var droplabel = data.droplabel[i];
                      var html='';
                      var htmll = "<div ><label style='margin:10px; font-size:16px;'>"+droplabel+"</label><select class='selectpicker form-control' data-live-search='true' id='box_"+i+"' name='"+rem+"_dropdown_"+i+"'><option>a<option></select></div>";
                      var la =data.count_dropdown_option1;
                      for (let i = 0; i < la; i++){
                        var op = '<option>a</option>';
                        $("#box_"+1).append(op);
                      }
                      var htmlnew = htmll+html;
                      $("#contant_"+uniqcontantid).append(htmlnew);
                      $('.selectpicker').selectpicker('render');
                    }

                    for (let i = 0; i < multiselectcount; i++) {
                      var multiselectlabel = data.multiselectlabel[i];
                      var html='';
                      var htmll = "<div ><label style='margin:10px; font-size:16px;'>"+multiselectlabel+"</label><select class='selectpicker  form-control' multiple data-live-search='true' name='"+rem+"_multiselect_"+i+"'><option >Select</option><option>A</option><option>B</option></select></div>";
                      var htmlnew = htmll+html;
                      $("#contant_"+uniqcontantid).append(htmlnew);
                      $('.selectpicker').selectpicker('render');
                    }
                    for (let i = 0; i < textareacount; i++) {
                      var textarealabel = data.textarealabel[i];
                      var html='';
                      var htmll = "<div ><label style='margin:10px; font-size:16px;'>"+textarealabel+"</label><textarea class='form-control' rows='3' style='border:2px solid #919191; margin-bottom:10px;' name='"+rem+"_textarea_"+i+"'></textarea></div>";
                      var htmlnew = htmll+html;
                      $("#contant_"+uniqcontantid).append(htmlnew);
                    }
                    }
				});
  }
  function deletebenefit(id,i) {
      var deletedvalue = $("#dlfeild_"+id.id).val();
      //alert(deletedvalue);
       //console.log(deletedvalue);
      var s = titlearray.lastIndexOf(deletedvalue);
       console.log(s);
       //alert(s);
      titlearray.splice(s);
      console.log(titlearray);
      $("#selctectedtitle" ).val(titlearray);
      var div_count = $("#feild_"+i).children('div').size();
      if( div_count ==1){
        $("#save_"+i).css('display','none');
      }
      $("#contant_"+id.id).remove();
  }
 $(document).ready(function(){
/*$("#benefit-title").change(function(){
     var title = $("#benefit-title").val();
     console.log(title);
     var url = $("#url").val();
     $('#field').find('input').remove();
     $('#field').find('select').remove();
     $('#field').find('label').remove();
     $.ajax({
                    url: url,
                    type: "POST",
					          datatype : "application/json",
                    data: {
                        'title': title,
                    },
                    success: function (datas) {
                      console.log(datas);
                    var data = JSON.parse(datas);
                    var textcount = data.textcount;
                    var checkcount = data.checkcount;
                    var radiocount = data.radiocount;
                    var radiocount = data.radiocount;
                    var dropdowncount = data.dropdowncount;
                      //console.log(data.dropdowncount);

                      //console.log(dropdowncount);
                    for (let i = 0; i < textcount; i++) {
                      var textlabel = data.textlabel[i];
                      var html='';
                      var htmll = "<div><strong><label class='text-center' style=margin-top:10px;>"+textlabel+"</label></strong><input class='form-control col-md-6' type ='text' name= 'text_"+i+"' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191' id='text_"+i+"'/></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }
                    for (let i = 0; i < checkcount; i++) {
                      var checklabel = data.checklabel[i];
                      var html='';
                      var htmll = "<div><strong><label class='text-center' style=margin-top:10px;margin-left:10px;>"+checklabel+"</label></strong><input class='' type ='checkbox' name= 'checkbox_"+i+"' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191;margin-left:10px;' id='text_"+i+"'/></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }
                    for (let i = 0; i < radiocount; i++) {
                      var radiolabel = data.radiolabel[i];
                      var html='';
                      var htmll = "<strong><label class='text-center' style='margin-left:10px;'>"+radiolabel+"</label></strong><input class='' type ='radio' name= 'radio' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191; margin-left:10px;' id='radio_"+i+"'/></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }
                    
                    for (let i = 0; i < radiocount; i++) {
                      var radiolabel = data.radiolabel[i];
                      var html='';
                      var htmll = "<strong><label class='text-center' style='margin-left:10px;'>"+radiolabel+"</label></strong><input class='' type ='radio' name= 'radio' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191; margin-left:10px;' id='radio_"+i+"'/></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }

                    for (let i = 0; i < dropdowncount; i++) {
                      var droplabel = data.droplabel[i];
                      console.log(droplabel);
                      var html='';
                      var htmll = "<div class=''><label>Provider</label><select class=' form-control' data-live-search='true'><option value ='' >Select</option></select></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }
                    }
				});
});*/
});
</script>
</html>