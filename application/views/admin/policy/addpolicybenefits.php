<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css'); ?>">
<div id="wrapper">
  <div class="content">
    <h3>Add Benefit Fields</h3>
    <div class="row">
      <div class="col-md-6 addMargin">
        <div class="col-md-1">
          <input class="form-check-input addMarginTop" type="checkbox" id="input" value="1">
        </div>
        <div class="col-md-3">
          <label class="addPaddingTop">Text</label>
        </div>
        <div class="col-md-2">
          <input class="count addStyle" type="text" id="inputtext">
        </div>
      </div>
      <div class="col-md-6 addMargin">
        <div class="col-md-1">
          <input class="form-check-input addMarginTop" type="checkbox" id="input" value="2">
        </div>
        <div class="col-md-3">
          <label class="addPaddingTop">Check box</label>
        </div>
        <div class="col-md-2">
          <input class="count addStyle" type="text" id="inputcheck">
        </div>
      </div>
      <div class="col-md-6 addMargin">
        <div class="col-md-1">
          <input class="form-check-input addMarginTop" type="checkbox" id="input" value="3">
        </div>
        <div class="col-md-3">
          <label class="addPaddingTop">Radio Button</label>
        </div>
        <div class="col-md-2">
          <input class="count addStyle" type="text" id="inputradio">
        </div>
      </div>
      <div class="col-md-6 addMargin">
        <div class="col-md-1">
          <input class="form-check-input addMarginTop" type="checkbox" id="input" value="4">
        </div>
        <div class="col-md-3">
          <label class="addPaddingTop">Dropdown</label>
        </div>
        <div class="col-md-2">
          <input class="count addStyle" type="text" id="inputdropdown">
        </div>
      </div>
      <div class="col-md-6 addMargin">
        <div class="col-md-1">
          <input class="form-check-input addMarginTop" type="checkbox" id="input" value="5">
        </div>
        <div class="col-md-3">
          <label class="addPaddingTop">Multiselect</label>
        </div>
        <div class="col-md-2">
          <input class="count addStyle" type="text" id="inputmultiselect">
        </div>
      </div>
      <div class="col-md-6 addMargin">
        <div class="col-md-1">
          <input class="form-check-input addMarginTop" type="checkbox" id="input" value="6">
        </div>
        <div class="col-md-3">
          <label class="addPaddingTop">TextArea</label>
        </div>
        <div class="col-md-2">
          <input class="count addStyle" type="text" id="inputtextarea">
        </div>
      </div>
      <div class="col-md-6 addMargin">
        <div class="col-md-1">
          <input class="form-check-input addMarginTop" type="checkbox" id="input" value="7">
        </div>
        <div class="col-md-3">
          <label class="addPaddingTop">Currency</label>
        </div>
        <div class="col-md-2">
          <input class="count addStyle" type="text" id="inputcurrencyarea">
        </div>
      </div> 

      <div class="col-md-6 addMargin">
        <div class="col-md-1">
          <input class="form-check-input addMarginTop" type="checkbox" id="input" value="8">
        </div>
        <div class="col-md-3">  
          <label class="addPaddingTop">Date</label>
        </div>
        <div class="col-md-2">
          <input class="count addStyle" type="text" id="inputdatearea">
        </div>
      </div> 
    </div>
    <br>
    <div class="row">
      <div class="col-md-6">
        <button type="button" value="submit" class="btn btn-info" id="submit">ADD</button>
      </div>
    </div>
    <br>
    <h3 style="display:none" id="add_benefits_lavel">Add Benefit Title</h3>
    <form method="post" action="<?php echo base_url(); ?>admin/Policy/addPolicyBenefitsfield" id="formid">
      <div class="row">
        <div class="col-md-6">
          <input type="text" class="form-control" name="benefits_title" style="display:none" id="benefits_title" required>
        </div>
        <div class="col-md-3" >
            <select class="form-control" name="benefit_group" id="benefit_group"  data-width="100%" style="display:none">
              <option value="">Nothing Selected</option>
              <?php foreach($grouping_benefitData as $groupData){?>
              <option value="<?php echo $groupData['id']; ?>"><?php echo $groupData['benefit_grouping']; } ?></option>
            </select>
        </div>
        <div class="col-md-2">
          <input type="number" class="form-control" id="sort_order"  style="display:none" placeholder='SelectShortOrder' required name='sorted_number'>
        </div>
      </div>
      <div class="container-fluid" id="inputfield">
        <h3 id="title" style="text-align:center">Text<h3>
            <input class="count" type="hidden" id="inputtextcount" name="inputtextcount">
      </div>
      <div class="container-fluid" id="checkfield">
        <h3 id="title2" style="text-align:center">CheckBox<h3>
            <input class="count" type="hidden" id="inputcheckcount" name="inputcheckcount">
      </div>
      <div class="container-fluid" id="rediofield">
        <h3 id="title3" style="text-align:center">Radio Button<h3>
            <input class="count" type="hidden" id="inputradiocount" name="inputradiocount">
      </div>
      <div class="container-fluid" id="dropdown">
        <h3 id="title4" style="text-align:center">Dropdown<h3>
            <input class="count" type="hidden" id="inputdropdowncount" name="inputdropdowncount">
      </div>
      <div class="container-fluid" id="multiselect">
        <h3 id="title5" style="text-align:center">Multiselect<h3>
            <input class="count" type="hidden" id="inputmultiselectcount" name="inputmultiselectcount">
      </div>
      <div class="container-fluid" id="textarea">
        <h3 id="title6" style="text-align:center">TextArea<h3>
            <input class="count" type="hidden" id="inputtextareacount" name="inputtextareacount">
      </div>
      <div class="container-fluid" id="currency">
        <h3 id="title7" style="text-align:center">Currency<h3>
            <input class="count" type="hidden" id="inputcurrencycount" name="inputcurrencycount">
      </div>

      <div class="container-fluid" id="date">
        <h3 id="title8" style="text-align:center">Date<h3>
            <input class="count" type="hidden" id="inputdatecount" name="inputdatecount">
      </div>
    </br>
      <div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
          value="<?php echo $this->security->get_csrf_hash(); ?>">
        <button style="display:none;margin:auto" type="Submit" value="submit" class="btn btn-info"
          id="submitdata">Submit</button>
      </div>
    </form>
  </div>
  <?php init_tail(); ?>
  <script>
    $(document).ready(function () {
      $("#title").hide();
      $("#title2").hide();
      $("#title3").hide();
      $("#title4").hide();
      $("#title5").hide();
      $("#title6").hide();
      $("#title7").hide();
      $("#title8").hide();
      $("#submit").click(function () {
        $(".createfield").remove();
        $("#title").hide();
        $("#title2").hide();
        $("#title3").hide();
        $("#title4").hide();
        $("#title5").hide();
        $("#title6").hide();
        $("#title7").hide();
        $("#title8").hide();
        $('#submitdata').css('display', 'none');
        $('#add_benefits_lavel').css('display', 'none');
        $('#benefits_title').css('display', 'none');
        $('#sort_order').css('display', 'none');
        $('#benefit_group').css('display', 'none');
        $("#inputfield").removeAttr('style');
        $("#checkfield").removeAttr('style');
        $("#rediofield").removeAttr('style');
        $("#dropdown").removeAttr('style');
        $("#multiselect").removeAttr('style');
        $("#textarea").removeAttr('style');
        $("#currency").removeAttr('style');
        $("#date").removeAttr('style');

        var inputtext = $("#inputtext").val();
        $("#inputtextcount").val(inputtext);
        var inputdropdown = $("#inputdropdown").val();
        $("#inputdropdowncount").val(inputdropdown);
        var inputcheck = $("#inputcheck").val();
        $("#inputcheckcount").val(inputcheck);
        var inputradio = $("#inputradio").val();
        $("#inputradiocount").val(inputradio);
        var inputmultiselect = $("#inputmultiselect").val();
        $("#inputmultiselectcount").val(inputmultiselect);
        var inputtextarea = $("#inputtextarea").val();
        $("#inputtextareacount").val(inputtextarea);
        var inputcurrencyarea = $("#inputcurrencyarea").val();
        $("#inputcurrencycount").val(inputcurrencyarea);
        var inputdatearea = $("#inputdatearea").val();
        $("#inputdatecount").val(inputdatearea);
        let z = 1;
        for (let i = 1; i <= inputtext; i++) {
          //console.log('hello'+i);
          //var html='';
          var htmll = "<div class='createfield'><input class='form-control' type ='text' name='text_" + i + "' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191; width:90rem; float:left;' id='text_" + i + "' required/> <input class='form-control' type='number' name='sortOrder_"+z+"' style ='margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px' placeholder ='Order Number' value=0></div>";
          var htmlnew = htmll + html;
          var textdata = 'text_' + i;
          $("#inputfield").css('border', '1px solid black');
          $("#title").show();
          $('#inputfield').css('margin-top', 20);
          $("#inputfield").append(htmll);
          $("#inputtext").val('');
          $('#submitdata').css('display', 'block');
          $('#benefits_title').css('display', 'block');
          $('#add_benefits_lavel').css('display', 'block');
          $("#benefits_title").css('border', '1px solid #919191');
          $('#sort_order').css('display', 'block');
          $("#sort_order").css('border', '1px solid #919191');
          $('#benefit_group').css('display', 'block');
          $("#benefit_group").css('border', '1px solid #919191');
          z++;
          //console.log(textdata);
        }
        for (let i = 1; i <= inputcheck; i++) {
          var html = '';
          //var htmll = "<div class ='col-md-3'><input type ='checkbox' name ='' value ='' style='margin-top: 10px;border:1px solid #919191'/><input type ='text' name ='' value ='' style='margin-top: 10px;border:1px solid #919191' id='inputtext'/><div>";
          var htmll = "<div class='createfield'><input class='form-control' type ='text' name ='check_" + i + "'  style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;' id='check_" + i + "'  placeholder='Enter check box label' required/><input class='form-control' type='number' name='sortOrder_"+z+"' style ='margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px' placeholder ='Order Number' value=0><input class='addStyle' placeholder ='Number Of Option' type ='text' name ='number_check_option" + i + "' value ='' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191' id='number_check_option" + i + "'required/><input type='button'  value ='add option' class='btn btn-info addoption optionbutton' onClick='checkbox(" + i + ")'></input><div id='addcheckop" + i + "' required ></div></div>";
          var htmlnew = htmll + html;
          $("#title2").show();
          $("#checkfield").css('border', '1px solid black');
          $('#checkfield').css('margin-top', 20);
          $("#checkfield").append(htmlnew);
          $("#inputcheck").val('');
          $('#submitdata').css('display', 'block');
          $('#benefits_title').css('display', 'block');
          $('#add_benefits_lavel').css('display', 'block');
          $("#benefits_title").css('border', '1px solid #919191');
          $('#sort_order').css('display', 'block');
          $("#sort_order").css('border', '1px solid #919191');
          $('#benefit_group').css('display', 'block');
          $("#benefit_group").css('border', '1px solid #919191');
          z++;
        }
        for (let i = 1; i <= inputradio; i++) {
          var html = '';
          //var htmll = "<div class ='col-md-3'><input type ='radio' name ='' value ='' style='margin-top: 10px'/><div>";
          var htmll = "<div class='createfield'><input class='form-control' type ='text' name= 'radio_" + i + "' value ='' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;' id='radio_" + i + "' required/><input class='form-control' type='number' name='sortOrder_"+z+"' style ='margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px' placeholder ='Order Number' value=0><input class='addStyle' placeholder ='Number Of Option' type ='text' name ='number_radio_option" + i + "' value ='' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191' id='number_radio_option" + i + "'required/><input type='button'  value ='add option' class='btn btn-info addoption optionbutton' onClick='radio(" + i + ")'></input><div id='addradio_op" + i + "' required ></div></div>";
          var htmlnew = htmll + html;
          $("#title3").show();
          $("#rediofield").css('border', '1px solid black');
          $('#rediofield').css('margin-top', 20);
          $("#rediofield").append(htmlnew);
          $("#inputradio").val('');
          $('#submitdata').css('display', 'block');
          $('#benefits_title').css('display', 'block');
          $('#add_benefits_lavel').css('display', 'block');
          $("#benefits_title").css('border', '1px solid #919191');
          $('#sort_order').css('display', 'block');
          $("#sort_order").css('border', '1px solid #919191');
          $('#benefit_group').css('display', 'block');
          $("#benefit_group").css('border', '1px solid #919191');
          z++;
        }

        for (let i = 1; i <= inputdropdown; i++) {
          var html = '';
          //var htmll = "<div class ='col-md-3'><input type ='radio' name ='' value ='' style='margin-top: 10px'/><div>";
          var htmll = "<div class='createfield'><input class='form-control' placeholder='Enter Dropdown Label' type ='text' name ='dropdown_" + i + "' value ='' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;' id='dropdown_" + i + "'required/> <input class='form-control' type='number' name='sortOrder_"+z+"' style ='margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px' placeholder ='Order Number' value=0><input class=' addStyle no_option' placeholder ='Number Of Option' type ='text' name ='number_option" + i + "' value ='' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191' id='number_option" + i + "'required/><input type='button'  value ='add option' class='btn btn-info addoption optionbutton' onClick='myFun(" + i + ")'></input><div id='addop" + i + "' required></div></div>";
          var htmlnew = htmll + html;
          $("#title4").show();
          $("#dropdown").css('border', '1px solid black');
          $('#dropdown').css('margin-top', 20);
          $("#dropdown").append(htmlnew);
          $("#inputdropdown").val('');
          $('#submitdata').css('display', 'block');
          $('#benefits_title').css('display', 'block');
          $('#add_benefits_lavel').css('display', 'block');
          $("#benefits_title").css('border', '1px solid #919191');
          $('#sort_order').css('display', 'block');
          $("#sort_order").css('border', '1px solid #919191');
          $('#benefit_group').css('display', 'block');
          $("#benefit_group").css('border', '1px solid #919191');
          z++;
        }
        for (let i = 1; i <= inputmultiselect; i++) {
          var html = '';
          //var htmll = "<div class ='col-md-3'><input type ='radio' name ='' value ='' style='margin-top: 10px'/><div>";
          var htmll = "<div class='createfield'><input  class='form-control' placeholder='Enter Multiselect Dropdown Label' type ='text' name ='multiselect_" + i + "' value ='' style='margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;' id='multiselect_" + i + "' required/><input class='form-control' type='number' name='sortOrder_"+z+"' style ='margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px' placeholder ='Order Number' value=0><input class='addStyle no_moption' placeholder ='Number Of Option' type ='text' name ='number_moption" + i + "' value ='' style='margin-top: 10px; margin-bottom: 10px;border:1px solid #919191' id='number_moption" + i + "' required/><input type='button'  value ='add option ' class='btn btn-info addmuloption optionbutton' onClick='addmuloption(" + i + ")'></input><div id='addmop" + i + "' required></div></div>";
          var htmlnew = htmll + html;
          $("#title5").show();
          $("#multiselect").css('border', '1px solid black');
          $('#multiselect').css('margin-top', 20);
          $("#multiselect").append(htmlnew);
          $("#inputmultiselect").val('');
          $('#submitdata').css('display', 'block');
          $('#benefits_title').css('display', 'block');
          $('#add_benefits_lavel').css('display', 'block');
          $("#benefits_title").css('border', '1px solid #919191');
          $('#sort_order').css('display', 'block');
          $("#sort_order").css('border', '1px solid #919191');
          $('#benefit_group').css('display', 'block');
          $("#benefit_group").css('border', '1px solid #919191');
          z++;
        }
        for (let i = 1; i <= inputtextarea; i++) {
          var html = '';
          //var htmll = "<div class ='col-md-3'><input type ='radio' name ='' value ='' style='margin-top: 10px'/><div>";
          var htmll = "<div class='createfield'><input  class='form-control' type ='text' name ='textarea_" + i + "' value ='' style='margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;' id='textarea_" + i + "' required/><input class='form-control' type='number' name='sortOrder_"+z+"' style ='margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px' placeholder ='Order Number' value=0></div>";
          var htmlnew = htmll + html;
          $("#title6").show();
          $("#textarea").css('border', '1px solid black');
          $('#textarea').css('margin-top', 20);
          $("#textarea").append(htmlnew);
          $("#inputtextarea").val('');
          $('#submitdata').css('display', 'block');
          $('#benefits_title').css('display', 'block');
          $('#add_benefits_lavel').css('display', 'block');
          $("#benefits_title").css('border', '1px solid #919191');
          $('#sort_order').css('display', 'block');
          $("#sort_order").css('border', '1px solid #919191');
          $('#benefit_group').css('display', 'block');
          $("#benefit_group").css('border', '1px solid #919191');
          z++;
        }
        for (let i = 1; i <= inputcurrencyarea; i++) {
          var html = '';
          //var htmll = "<div class ='col-md-3'><input type ='radio' name ='' value ='' style='margin-top: 10px'/><div>";
          var htmll = "<div class='createfield'><input  class='form-control' type ='text' name ='currencyarea_" + i + "' value ='' style='margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;' id='datearea_" + i + "' required/><input class='form-control' type='number' name='sortOrder_"+z+"' style ='margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px' placeholder ='Order Number' value=0></div>";
          var htmlnew = htmll + html;
          $("#title7").show();
          $("#currency").css('border', '1px solid black');
          $('#currency').css('margin-top', 20);
          $("#currency").append(htmlnew);
          $("#inputcurrencyarea").val('');
          $('#submitdata').css('display', 'block');
          $('#benefits_title').css('display', 'block');
          $('#add_benefits_lavel').css('display', 'block');
          $("#benefits_title").css('border', '1px solid #919191');
          $('#sort_order').css('display', 'block');
          $("#sort_order").css('border', '1px solid #919191');
          $('#benefit_group').css('display', 'block');
          $("#benefit_group").css('border', '1px solid #919191');
          z++;
        }
        for (let i = 1; i <= inputdatearea; i++) {
          var html = '';
          //var htmll = "<div class ='col-md-3'><input type ='radio' name ='' value ='' style='margin-top: 10px'/><div>";
          var htmll = "<div class='createfield'><input  class='form-control' type ='text' name ='datearea_" + i + "' value ='' style='margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:90rem; float:left' id='textarea_" + i + "' required/><input class='form-control' type='number' name='sortOrder_"+z+"' style ='margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px' placeholder ='Order Number' value=0></div>";
          var htmlnew = htmll + html;
          $("#title8").show();
          $("#date").css('border', '1px solid black');
          $('#date').css('margin-top', 20);
          $("#date").append(htmlnew);
          $("#inputdatearea").val('');
          $('#submitdata').css('display', 'block');
          $('#benefits_title').css('display', 'block');
          $('#add_benefits_lavel').css('display', 'block');
          $("#benefits_title").css('border', '1px solid #919191');
          $('#sort_order').css('display', 'block');
          $("#sort_order").css('border', '1px solid #919191');
          $('#benefit_group').css('display', 'block');
          $("#benefit_group").css('border', '1px solid #919191');
          z++;
        }
      });
    });
  </script>
  <script>
    function myFun(id) {
      var htmlst = "<input type='hidden' name ='count_option" + id + "' id='count_option" + id + "' value ='' required>";
      $("#addop" + id).empty();
      var inputdropdown = $("#inputdropdown").val();
      var value = $("#number_option" + id).val();
      //alert(value);
      //$("#number_option"+id).val('');
      for (let j = 1; j <= value; j++) {
        var html = '';
        var htmll = "<div class='createopstion'><input  class='form-control' placeholder='Enter Option Label' type ='text' name ='dropdown_" + id + "_op_" + j + "' value ='' style='margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:40rem' required/></div>";
        var htmlnew = htmll + html;
        if (j == 1) {
          $("#addop" + id).append(htmlnew);
          $("#addop" + id).html(htmlst);
          $("#count_option" + id).val(value);
          //$("#count_option"+id).val();
        }
        $("#addop" + id).append(htmlnew);
      }
    }


    function addmuloption(id) {
      var htmlst = "<input type='hidden' name ='multicount_option" + id + "' id='multicount_option" + id + "' value ='' required>";
      $("#addmop" + id).empty();
      var inputmultiselect = $("#inputmultiselect").val();
      var value = $("#number_moption" +id).val();
        for (let j = 1; j <= value; j++) {
          var html = '';
          var htmll = "<div><input  class='form-control' type ='text' placeholder='Enter Option Label' name ='dropdown_mop_" + id + "_op_" + j + "' value ='' style='margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:40rem' required/></div>";
          var htmlnew = htmll + html;
          if(j==1){
            $("#addmop" + id).append(htmlnew);
            $("#addmop" + id).html(htmlst);
            $("#multicount_option" + id).val(value);
          }
          $("#addmop" + id).append(htmlnew);
        }
      }

      function checkbox(id) {
      var htmlst = "<input type='hidden' name ='checkboxcount_option" + id + "' id='checkboxcount_option" + id + "' value ='' required>";
      $("#addcheckop" + id).empty();
      var value = $("#number_check_option" +id).val();
        for (let j = 1; j <= value; j++) {
          var html = '';
          var htmll = "<div><input  class='form-control' type ='text' placeholder='Enter Option Label' name ='checkbox" + id + "_op_" + j + "' value ='' style='margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:40rem' required/></div>";
          var htmlnew = htmll + html;
          if(j==1){
            $("#addcheckop" + id).append(htmlnew);
            $("#addcheckop" + id).html(htmlst);
            $("#checkboxcount_option" + id).val(value);
          }
          $("#addcheckop" + id).append(htmlnew);
        }
      }

      function radio(id) {
          var htmlst = "<div><input type='hidden' name ='radio_count_option" + id + "' id='radio_count_option" + id + "' value ='' required> </div>";
          $("#addradio_op" + id).empty();
          var value = $("#number_radio_option" +id).val();
          for (let j = 1; j <= value; j++) {
            var html = '';
            var htmll = "<div><input  class='form-control' type ='text' placeholder='Enter Option Label' name ='radio" + id + "_op_" + j + "' value ='' style='margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:40rem' required/></div>";
            var htmlnew = htmll + html;
            if(j==1){
              $("#addradio_op" + id).append(htmlnew);
              $("#addradio_op" + id).html(htmlst);
              $("#radio_count_option" + id).val(value);
            }
            $("#addradio_op" + id).append(htmlnew);
          }
    }
  </script>
    </body>
</html >