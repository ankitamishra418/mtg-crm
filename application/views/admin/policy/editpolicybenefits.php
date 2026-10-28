<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css'); ?>">
<div id="wrapper">
  <div class="content">
    <h3>Add Benefit Fields</h3>
    <!-- <div class="row">
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
    </div> -->
    <br>
    <h3 style="display:none" id="add_benefits_lavel">Add Benefit Title</h3>
    <form method="post" action="<?php echo base_url(); ?>admin/Policy/updatePolicyBenefitsfiled" id="formid">
            <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="benefits_title" value="<?php echo $form_title; ?>"
                        style="" id="benefits_title" required>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="benefit_group" id="benefit_group" data-width="100%" style="">
                        <option value="">Nothing Selected</option>
                        <?php foreach($grouping_benefitData as $groupData){?>
                        <option value="<?php echo $groupData['id']; ?>"
                            <?php if($benefits_group == $groupData['id']) { echo "selected"; } ?>>
                            <?php echo $groupData['benefit_grouping']; } ?>
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" id="sort_order" value="<?php echo $sort_order; ?>"
                        style="" placeholder='SelectShortOrder' required name='sorted_number'>
                </div>
            </div>
            <div class="container-fluid" id="inputfield" style="border:1px solid #000;margin-top:10px;">
                <h3 id="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="margin: auto;">Text</span>
                    <span class="btn btn-primary btn-md add-text-field">Add</span>
                </h3>
                <input class="count" type="hidden" id="inputtextcount" value="<?php echo $inputtextcount; ?>"
                    name="inputtextcount">
                <?php 
                $i = 1;
                foreach($text as $textElements){
                    foreach($textElements['textLabel'] as $key => $value){  
                    ?>
                <div class="createfield">
                    <input class="form-control text-field" value="<?php echo $value; ?>" type="text"
                        name="text_<?php echo $i; ?>"
                        style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191; width:90rem; float:left;"
                        id="text_<?php echo $i ?>" required />
                    <input class="form-control sortOrder" value="<?php echo $key; ?>" type="number" name="sortOrder[]"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"
                        placeholder="Order Number" value=0>
                    <div class="btn btn-danger btn-md btn-md delete-text-field"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; float:left; margin-left:27px">
                        <i class="iconFontSize fa fa-trash-o"></i>
                    </div>
                </div>

                <?php
                    }
                    $i++;
                } 
                ?>
            </div>
            <div class="container-fluid" id="checkfield" style="border:1px solid #000;margin-top:10px;">
                <h3 id="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="margin: auto;">CheckBox</span>
                    <span class="btn btn-primary btn-md add-checkbox-field">Add</span>
                </h3>
                <input class="count" type="hidden" value="<?php echo $inputcheckcount; ?>" id="inputcheckcount"
                    name="inputcheckcount">
                <?php 
                    $i=1;
                    foreach($check as $checkElemnts){
                        foreach($checkElemnts['check'] as $key =>$value){
                        ?>
                <div class='createfield'>
                    <input class="form-control check-field" type="text" value="<?php echo $value['checkLabel']; ?>"
                        name="check_<?php echo $i; ?>"
                        style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;"
                        id="check_<?php echo $i; ?>" placeholder="Enter check box label" required />
                    <input class="form-control" type="number" value="<?php echo $key; ?>" name="sortOrder[]"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"
                        placeholder="Order Number">
                    <input class="addStyle number-of-options" placeholder="Number Of Option" type="text"
                        name="number_check_option<?php echo $i; ?>" value="<?php echo $count_check_option[$i]; ?>"
                        style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:150px;"
                        id="number_check_option<?php echo $i; ?>" required readonly />
                    <input type="button" value="add option" class="btn btn-info addoption optionbutton"
                        data-check="<?php echo $i; ?>">
                    <div class="btn btn-danger btn-md btn-md delete-check-field" id="check-delete-<?php echo $i; ?>" style="">
                        <i class="iconFontSize fa fa-trash-o"></i>
                    </div>

                    <div id="addcheckop<?php echo $i; ?>" required>
                        <?php 
                            $k=1;
                            foreach( $value['checkOp'] as $key =>$value){
                            ?>
                        <div class="createopstion" style="display: flex; align-items: center;">
                            <input class="form-control" type="text" placeholder="Enter Option Label"
                                name="checkbox<?php echo $i; ?>_op_<?php echo $k; ?>" value="<?php echo $value; ?>"
                                style="margin-top: 10px; margin-bottom: 10px; border: 1px solid #919191; width: 40rem;">
                            <span class="btn btn-danger btn-md btn-md delete-checkop-field" style="margin-left: 10px;">
                                <i class="iconFontSize fa fa-trash-o"></i>
                            </span>
                        </div>
                        <?php
                        $k++;
                        }
                        ?>
                    </div>
                </div>
                <?php 
                $i++;   
                // $z++;
                }
            }
             ?>
            </div>
            <div class="container-fluid" id="radiofield" style="border:1px solid #000;margin-top:10px;<?php  ?>">
                <h3 id="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="margin: auto;">Radio</span>
                    <span class="btn btn-primary btn-md add-radio-field">Add</span>
                </h3>
                <input class="count" type="hidden" value="<?php echo $inputradiocount; ?>" id="inputradiocount"
                    name="inputradiocount">
                <?php 
                    $i=1;
                    foreach($radio as $radioElemnts){
                        foreach($radioElemnts['radio'] as $key =>$value){
                ?>
                <div class="createfield">
                    <input class="form-control radio-field" type="text" name="radio_<?php echo $i; ?>"
                        value="<?php echo $value['radioLabel']; ?>"
                        style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;"
                        id="radio_<?php echo $i; ?>" required />
                    <input class="form-control" type="number" name="sortOrder[]" value="<?php echo $key; ?>"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"
                        placeholder="Order Number">
                    <input class="addStyle number-of-options" placeholder="Number Of Option" type="text"
                        name="number_radio_option<?php echo $i; ?>" value="<?php echo $count_radio_option[$i]; ?>"
                        style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:150px;"
                        id="number_radio_option<?php echo $i; ?>" required readonly />
                    <input type="button" value="add option" id="radioOp" class="btn btn-info addoption optionbutton"
                        data-radio="<?php echo $i; ?>"></input>
                    <div class="btn btn-danger btn-md btn-md delete-radio-field" id="radio-delete-<?php echo $i; ?>" style="">
                        <i class="iconFontSize fa fa-trash-o"></i>
                    </div>
                    <div id="addradioop<?php echo $i; ?>" required>
                        <?php
                            $k=1;
                            foreach( $value['radioOp'] as $key =>$value){
                            ?>
                        <div class="createopstion" style="display: flex; align-items: center;">
                            <input class="form-control" type="text" placeholder="Enter Option Label"
                                name="radio<?php echo $i; ?>_op_<?php echo $k; ?>" value="<?php echo $value; ?>"
                                style="margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:40rem"
                                required="">
                            <span class="btn btn-danger btn-md btn-md delete-radioop-field" style="margin-left: 10px;">
                                <i class="iconFontSize fa fa-trash-o"></i>
                            </span>
                        </div>
                        <?php
                            $k++;
                            }
                            ?>
                    </div>
                </div>
                <?php
                        $i++;
                        }
                        }
                ?>
            </div>
            <div class="container-fluid" id="dropdownfield" style="border:1px solid #000;margin-top:10px;">
                <h3 id="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="margin: auto;">Dropdown</span>
                    <span class="btn btn-primary btn-md add-dropdown-field">Add</span>
                </h3>
                <input class="count" type="hidden" value="<?php echo $inputdropdowncount; ?>" id="inputdropdowncount"
                    name="inputdropdowncount">
                <?php  
                    $i=1;
                    foreach($dropdown as $dropdownElemnts){
                        foreach($dropdownElemnts['dropdown'] as $key =>$value){
                        ?>
                <div class="createfield">
                    <input class="form-control dropdown-field" placeholder="Enter Dropdown Label" type="text"
                        name="dropdown_<?php echo $i; ?>" value="<?php echo $value['dropdownLabel'] ?>"
                        style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;"
                        id="dropdown_<?php echo $i; ?>" required="">
                    <input class="form-control" type="number" name="sortOrder[]"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"
                        placeholder="Order Number" value="<?php echo $key; ?>">
                    <input class=" addStyle no_option number-of-options" placeholder="Number Of Option" type="text"
                        name="number_option<?php echo $i; ?>" value="<?php echo $count_dropdown_option[$i]; ?>"
                        style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:150px;"
                        id="number_option<?php echo $i; ?>" required="" readonly>
                    <input type="button" value="add option" class="btn btn-info addoption optionbutton"
                        data-dropdown="<?php echo $i; ?>">
                    <div class="btn btn-danger btn-md btn-md delete-dropdown-field" id="dropdown-delete-<?php echo $i; ?>" style="">
                        <i class="iconFontSize fa fa-trash-o"></i>
                    </div>
                    <div id="adddropdownop<?php echo $i; ?>" class="options-container" required="">
                        <!-- <input type="text" name="count_option1" id="count_option1" value="<?php //echo $i; ?>"
                            required=""> -->
                        <?php
                            $k=1;
                            foreach( $value['dropdownOp'] as $key =>$value){
                            ?>
                        <div class="createopstion" style="display: flex; align-items: center;">
                            <input class="form-control" placeholder="Enter Option Label" type="text"
                                name="dropdown_<?php echo $i; ?>_op_<?php echo $k; ?>" value="<?php echo $value; ?>"
                                style="margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:40rem"
                                required="">
                            <span class="btn btn-danger btn-md btn-md delete-dropdownop-field"
                                style="margin-left: 10px;">
                                <i class="iconFontSize fa fa-trash-o"></i>
                        </div>
                        <?php 
                        $k++;
                            }
                        ?>
                    </div>
                </div>
                <?php 
                $i++;
                        }
                }
                ?>

            </div>
            <div class="container-fluid" id="multiselectfield" style="border:1px solid #000;margin-top:10px;">
                <h3 id="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="margin: auto;">Multiselect</span>
                    <span class="btn btn-primary btn-md add-multiselect-field">Add</span>
                </h3>
                <input class="count" type="hidden" value="<?php echo $inputmultiselectcount; ?>"
                    id="inputmultiselectcount" name="inputmultiselectcount">
                    <?php
                    $i=1;
                    // print_r($multiselect);
                    foreach($multiselect as $multiselectElemnts){
                        // print_r($multiselectElemnts);
                        foreach($multiselectElemnts['multiSelect'] as $key =>$value){
                        ?>
                <div class="createfield">
                    <input class="form-control multiselect-field" placeholder="Enter Multiselect Dropdown Label"
                        type="text" name="multiselect_<?php echo $i; ?>"
                        value="<?php echo $value['multiSelectLabel']; ?>"
                        style="margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;"
                        id="multiselect_<?php echo $i; ?>" required="">
                    <input class="form-control" type="number" name="sortOrder[]"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"
                        placeholder="Order Number" value="<?php echo $key; ?>">
                    <input class="addStyle no_moption number-of-options" placeholder="Number Of Option" type="text"
                        name="number_moption<?php echo $i; ?>" value="<?php echo $count_multi_option[$i]; ?>"
                        style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:150px;"
                        id="number_moption<?php echo $i; ?>" required="" readonly>
                    <input type="button" value="add option " class="btn btn-info addoption optionbutton"
                        data-multiselect="<?php echo $i; ?>">
                    <div class="btn btn-danger btn-md btn-md delete-multiselect-field" id="multiselect-delete-<?php echo $i; ?>" style="">
                        <i class="iconFontSize fa fa-trash-o"></i>
                    </div>
                    <div id="addmultiselectop<?php echo $i; ?>" required="">
                        <?php
                            $k=1;
                            foreach( $value['multiSelectOp'] as $key =>$value){
                             ?>
                        <div class="createopstion" style="display: flex; align-items: center;">
                            <input class="form-control" type="text" placeholder="Enter Option Label"
                                name="multiselect<?php echo $i; ?>_op_<?php echo $k; ?>" value="<?php echo $value; ?>"
                                style="margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:40rem"
                                required="">
                            <span class="btn btn-danger btn-md btn-md delete-multiselectop-field"
                                style="margin-left: 10px;">
                                <i class="iconFontSize fa fa-trash-o"></i>
                        </div>
                        <?php
                    $k++;
                     }
                    ?>
                    </div>
                </div>
                <?php
                $i++;
                    }
                }
                ?>
            </div>
            <div class="container-fluid" id="textarea" style="border:1px solid #000;margin-top:10px;">
                <h3 id="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="margin: auto;">TextArea</span>
                    <span class="btn btn-primary btn-md add-textarea-field">Add</span>
                </h3>
                <input class="count" type="hidden" value="<?php echo $inputtextareacount; ?>" id="inputtextareacount"
                    name="inputtextareacount">
                <?php 
                    $i =1;
                    foreach($textarea as $textareaElemnts){
                        foreach($textareaElemnts['textareaLabel'] as $key =>$value){
                        ?>
                <div class="createfield">
                    <input class="form-control textarea-field" type="text" name="textarea_<?php echo $i; ?>"
                        value="<?php echo $value; ?>"
                        style="margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;"
                        id="textarea_<?php echo $i; ?>" required="">
                    <input class="form-control" type="number" name="sortOrder[]"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"
                        placeholder="Order Number" value="<?php echo $key; ?>">
                    <div class="btn btn-danger btn-md btn-md delete-textarea-field"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; float:left; margin-left:27px">
                        <i class="iconFontSize fa fa-trash-o"></i>
                    </div>
                </div>

                <?php 
                        $i++;
                        }
                }
                        ?>
            </div>
            <div class="container-fluid" id="currency" style="border:1px solid #000;margin-top:10px;">
                <h3 id="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="margin: auto;">Currency</span>
                    <span class="btn btn-primary btn-md add-currency-field">Add</span>
                </h3>
                <input class="count" type="hidden" value="<?php echo $inputcurrencycount; ?>" id="inputcurrencycount"
                    name="inputcurrencycount">
                <?php 
                $i =1;
                foreach($currency as $currencyElemnts){
                    foreach($currencyElemnts['currencyLabel'] as $key =>$value){
                ?>
                <div class="createfield">
                    <input class="form-control currency-field" type="text" name="currencyarea_<?php echo $i; ?>"
                        value="<?php echo $value; ?>"
                        style="margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:90rem;float:left;"
                        id="currencyarea_<?php echo $i; ?>" required="">
                    <input class="form-control" type="number" name="sortOrder[]"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"
                        placeholder="Order Number" value="<?php echo $key; ?>">
                    <div class="btn btn-danger btn-md btn-md delete-currency-field"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; float:left; margin-left:27px">
                        <i class="iconFontSize fa fa-trash-o"></i>
                    </div>
                </div>
                <?php
                        $i++;
                    }
                }
                ?>
            </div>
            <div class="container-fluid" id="date" style="border:1px solid #000;margin-top:10px;">
                <h3 id="title" style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="margin: auto;">Date</span>
                    <span class="btn btn-primary btn-md add-date-field">Add</span>
                </h3>
                <input class="count" type="hidden" value="<?php echo $inputdatecount; ?>" id="inputdatecount"
                    name="inputdatecount">
                <?php 
                    $i =1;
                    foreach($date as $dateElemnts){
                        foreach($dateElemnts['dateLabel'] as $key =>$value){
                ?>
                <div class="createfield">
                    <input class="form-control date-field" type="text" name="datearea_<?php echo $i; ?>"
                        value="<?php echo $value; ?>"
                        style="margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:90rem; float:left"
                        id="datearea_<?php echo $i; ?>" required="">
                    <input class="form-control" type="number" name="sortOrder[]"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"
                        placeholder="Order Number" value="<?php echo $key; ?>">
                    <div class="btn btn-danger btn-md btn-md delete-date-field"
                        style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; float:left; margin-left:27px">
                        <i class="iconFontSize fa fa-trash-o"></i>
                    </div>
                </div>
                <?php 
                        $i++;
                        }
                    }
                ?>
              </div>
            </br>
            </br>
            <div style="text-align:center;">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                <button style="margin:auto" type="Submit" value="submit" class="btn btn-info"
                    id="submitdata">Submit</button>
            </div>
        </form>
  </div>
  <?php init_tail(); ?>
  <script>
    $(document).ready(function() {

$('.add-text-field').click(function() {
  var textCount = $('.text-field').length + 1;
  var sortOrder = $('.sortOrder').length + 1;
  var newTextField = '<div class="createfield">' +
      '<input class="form-control text-field" type="text" name="text_' + textCount + '"' +
      'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191; width:90rem; float:left;"' +
      'id="text_' + textCount + '" required />' +
      '<input class="form-control sortOrder" type="number" name="sortOrder[]"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"' +
      'placeholder="Order Number" value=0>' +
      '<div class="btn btn-danger btn-md btn-md delete-text-field"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; float:left; margin-left:27px">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '</div>';
  $('#inputfield').append(newTextField);
  updateTextFields();
});

$(document).on('click', '.delete-text-field', function() {
  $(this).closest('.createfield').remove();
  updateTextFields();
});

function updateTextFields() {
  $('.text-field').each(function(index) {
      $(this).attr('name', 'text_' + (index + 1));
      $(this).attr('id', 'text_' + (index + 1));
  });
  $('#inputtextcount').val($('.text-field').length);
}

$('.add-checkbox-field').click(function() {
  var checkCount = $('.check-field').length + 1;
  var sortOrder = $('.sortOrder').length + 1;
  var newCheckField = '<div class="createfield">' +
      '<input class="form-control check-field" type="text" name="check_' + checkCount + '"' +
      'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191; width:90rem;float:left;"' +
      'id="check_' + checkCount + '" placeholder="Enter check box label" required />' +
      '<input class="form-control sortOrder" type="number" name="sortOrder[]"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"' +
      'placeholder="Order Number" value=0>' +
      '<input class="addStyle" placeholder="Number Of Option" type="text"' +
      'name="number_check_option' + checkCount + '" value=""' +
      'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:100px;"' +
      'id="number_check_option' + checkCount + '" required readonly/>' +
      '<input type="button" value="add option" class="btn btn-info addoption optionbutton" data-check="' +
      checkCount + '">' +
      '<div class="btn btn-danger btn-md btn-md delete-check-field" id="check-delete-'+checkCount+'" style="">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '<div id="addcheckop' + checkCount + '" required>' +
      '</div>' +
      '</div>';
  $('#checkfield').append(newCheckField);
  $('#inputcheckcount').val(checkCount);
});

function updateCheckFields() {
  $('.check-field').each(function(index) {
      $(this).attr('name', 'check_' + (index + 1));
      $(this).attr('id', 'check_' + (index + 1));
  });
  $('#inputcheckcount').val($('.check-field').length);
}

$(document).on('click', '.addoption', function() {
  var checkNumber = $(this).data('check');
  var optionCount = $('#addcheckop' + checkNumber + ' .createopstion').length + 1;
  var newOptionField =
      '<div class="createopstion" style="display: flex; align-items: center;">' +
      '<input class="form-control" type="text" placeholder="Enter Option Label"' +
      'name="checkbox' + checkNumber + '_op_' + optionCount + '" value=""' +
      'style="margin-top: 10px; margin-bottom: 10px; border: 1px solid #919191; width: 40rem;">' +
      '<div class="btn btn-danger btn-md btn-md delete-checkop-field" style="margin-left: 10px;">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '</div>';
  $('#addcheckop' + checkNumber).append(newOptionField);
  $('#number_check_option' + checkNumber).val(optionCount);
});

$(document).on('click', '.delete-check-field', function() {
  var checkCount = $('.check-field').length;
  var currentId = $(this).attr('id');
  var currentCheckBoxId = currentId.split('-');
  if (checkCount == currentCheckBoxId[2]) {
      $(this).closest('.createfield').remove();
      updateCheckFields();
      updateCheckopFields();
  } else {
      alert('Please delete last checkbox first.');
  }
});

$(document).on('click', '.delete-checkop-field', function() {
  var checkNumber = $(this).closest('.createfield').find('.addoption').data('check');
  $(this).closest('.createopstion').remove();
  updateOptionFields(checkNumber);
  updatecheckOptionNames(checkNumber);
});

function updateOptionFields(checkNumber) {
  var optionCount = $('#addcheckop' + checkNumber + ' .createopstion').length;
  $('#number_check_option' + checkNumber).val(optionCount);
}

function updatecheckOptionNames(checkNumber) {
  $('#addcheckop' + checkNumber + ' .createopstion').each(function(index) {
      $(this).find('input').attr('name', 'checkbox_' + checkNumber + '_op_' + (index + 1));
  });
}

$('.add-radio-field').click(function() {
  var radioCount = $('.radio-field').length + 1;
  var sortOrder = $('.sortOrder').length + 1;
  var newRadioField = '<div class="createfield">' +
      '<input class="form-control radio-field" type="text" name="radio_' + radioCount + '"' +
      'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191; width:90rem;float:left;"' +
      'id="radio_' + radioCount + '" placeholder="Enter radio button label" required />' +
      '<input class="form-control sortOrder" type="number" name="sortOrder[]"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"' +
      'placeholder="Order Number" value=0>' +
      '<input class="addStyle" placeholder="Number Of Option" type="text"' +
      'name="number_radio_option' + radioCount + '" value=""' +
      'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:100px;"' +
      'id="number_radio_option' + radioCount + '" required readonly/>' +
      '<input type="button" value="add option" class="btn btn-info addoption optionbutton" data-radio="' +
      radioCount + '">' +
      '<div class="btn btn-danger btn-md btn-md delete-radio-field" id="radio-delete-'+radioCount+'" style="">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '<div id="addradioop' + radioCount + '" required>' +
      '</div>' +
      '</div>';
  $('#radiofield').append(newRadioField);
  $('#inputradiocount').val(radioCount);
});

function updateRadioFields() {
  $('.radio-field').each(function(index) {
      $(this).attr('name', 'radio_' + (index + 1));
      $(this).attr('id', 'radio_' + (index + 1));
  });
  $('#inputradiocount').val($('.radio-field').length);
}

$(document).on('click', '.addoption', function() {
  var radioNumber = $(this).data('radio');
  var optionCount = $('#addradioop' + radioNumber + ' .createopstion').length + 1;
  var newOptionField =
      '<div class="createopstion" style="display: flex; align-items: center;">' +
      '<input class="form-control" type="text" placeholder="Enter Option Label"' +
      'name="radio' + radioNumber + '_op_' + optionCount + '" value=""' +
      'style="margin-top: 10px; margin-bottom: 10px; border: 1px solid #919191; width: 40rem;">' +
      '<div class="btn btn-danger btn-md btn-md delete-radioop-field" style="margin-left: 10px;">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '</div>';
  $('#addradioop' + radioNumber).append(newOptionField);
  $('#number_radio_option' + radioNumber).val(optionCount);
});

$(document).on('click', '.delete-radio-field', function() {
  var radioCount = $('.radio-field').length;
  var currentId = $(this).attr('id');
  var currentradioBoxId = currentId.split('-');
  if (radioCount == currentradioBoxId[2]) {
      $(this).closest('.createfield').remove();
      updateRadioFields();
  } else {
      alert('Please delete last radio first.');
  }
});

$(document).on('click', '.delete-radioop-field', function() {
  var radioNumber = $(this).closest('.createfield').find('.addoption').data('radio');
  $(this).closest('.createopstion').remove();
  updateradioOptionFields(radioNumber);
  updateradioOptionNames(radioNumber);
});

function updateradioOptionFields(radioNumber) {
  var optionCount = $('#addradioop' + radioNumber + ' .createopstion').length;
  $('#number_radio_option' + radioNumber).val(optionCount);
}

function updateradioOptionNames(radioNumber) {
  $('#addradioop' + radioNumber + ' .createopstion').each(function(index) {
      $(this).find('input').attr('name', 'radio' + radioNumber + '_op_' + (index + 1));
  });
}


$('.add-dropdown-field').click(function() {
  var dropdownCount = $('.dropdown-field').length + 1;
  var sortOrder = $('.sortOrder').length + 1;
  var newDropdownField = '<div class="createfield">' +
      '<input class="form-control dropdown-field" type="text" name="dropdown_' +
      dropdownCount + '"' +
      'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191; width:90rem;float:left;"' +
      'id="dropdown_' + dropdownCount + '" placeholder="Enter dropdown label" required />' +
      '<input class="form-control sortOrder" type="number" name="sortOrder[]"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"' +
      'placeholder="Order Number" value=0>' +
      '<input class="addStyle" placeholder="Number Of Option" type="text"' +
      'name="number_option' + dropdownCount + '" value=""' +
      'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:100px;"' +
      'id="number_option' + dropdownCount + '" required readonly />' +
      '<input type="button" value="add option" class="btn btn-info addoption optionbutton" data-dropdown="' +
      dropdownCount + '">' +
      '<div class="btn btn-danger btn-md btn-md delete-dropdown-field" id="dropdown-delete-'+dropdownCount+'" style="">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '<div id="adddropdownop' + dropdownCount + '" required>' +
      '</div>' +
      '</div>';
  $('#dropdownfield').append(newDropdownField);
  $('#inputdropdowncount').val(dropdownCount);
});

function updateDropdownFields() {
  $('.dropdown-field').each(function(index) {
      $(this).attr('name', 'dropdown_' + (index + 1));
      $(this).attr('id', 'dropdown_' + (index + 1));
  });
  $('#inputdropdowncount').val($('.dropdown-field').length);
}

$(document).on('click', '.addoption', function() {
  var dropdownNumber = $(this).data('dropdown');
  var optionCount = $('#adddropdownop' + dropdownNumber + ' .createopstion').length + 1;
  var newOptionField =
      '<div class="createopstion" style="display: flex; align-items: center;">' +
      '<input class="form-control" type="text" placeholder="Enter Option Label"' +
      'name="dropdown_' + dropdownNumber + '_op_' + optionCount + '" value=""' +
      'style="margin-top: 10px; margin-bottom: 10px; border: 1px solid #919191; width: 40rem;">' +
      '<div class="btn btn-danger btn-md btn-md delete-dropdownop-field" style="margin-left: 10px;">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '</div>';
  $('#adddropdownop' + dropdownNumber).append(newOptionField);
  $('#number_option' + dropdownNumber).val(optionCount);
});

$(document).on('click', '.delete-dropdown-field', function() {
  var dropdownCount = $('.dropdown-field').length;
  var currentId = $(this).attr('id');
  var currentdropdownBoxId = currentId.split('-');
  if (dropdownCount == currentdropdownBoxId[2]) {
      $(this).closest('.createfield').remove();
      updateDropdownFields();
  } else {
      alert('Please delete last dropdown first.');
  }
});

$(document).on('click', '.delete-dropdownop-field', function() {
  var dropdownNumber = $(this).closest('.createfield').find('.addoption').data('dropdown');
  $(this).closest('.createopstion').remove();
  updatedropdownOptionFields(dropdownNumber);
  updatedropdownOptionNames(dropdownNumber);
});

function updatedropdownOptionFields(dropdownNumber) {
  var optionCount = $('#adddropdownop' + dropdownNumber + ' .createopstion').length;
  $('#number_option' + dropdownNumber).val(optionCount);
}

function updatedropdownOptionNames(dropdownNumber) {
  $('#adddropdownop' + dropdownNumber + ' .createopstion').each(function(index) {
      $(this).find('input').attr('name', 'dropdown_' + dropdownNumber + '_op_' + (index + 1));
  });
}

$('.add-multiselect-field').click(function() {
          var multiselectCount = $('.multiselect-field').length + 1;
          // var sortOrder = $('.sortOrder').length + 1;
          var newMultiselectField = '<div class="createfield">' +
              '<input class="form-control multiselect-field" type="text" name="multiselect_' +
              multiselectCount + '"' +
              'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191; width:90rem;float:left;"' +
              'id="multiselect_' + multiselectCount +
              '" placeholder="Enter multiselect label" required />' +
              '<input class="form-control sortOrder" type="number" name="sortOrder[]"' +
              'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"' +
              'placeholder="Order Number" value=0>' +
              '<input class="addStyle" placeholder="Number Of Option" type="text"' +
              'name="number_moption' + multiselectCount + '" value=""' +
              'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191;width:150px;"' +
              'id="number_moption' + multiselectCount + '" required readonly/>' +
              '<input type="button" value="add option" class="btn btn-info addoption optionbutton" data-multiselect="' +
              multiselectCount + '">' +
              '<div class="btn btn-danger btn-md btn-md delete-multiselect-field" id="multiselect-delete-'+multiselectCount+'" style="">' +
              '<i class="iconFontSize fa fa-trash-o"></i>' +
              '</div>' +
              '<div id="addmultiselectop' + multiselectCount + '" required>' +
              '</div>' +
              '</div>';
          $('#multiselectfield').append(newMultiselectField);
          $('#inputmultiselectcount').val(multiselectCount);
          multiselectCount++;
      });
      function updateMultiselectFields() {
          $('.multiselect-field').each(function(index) {
              $(this).attr('name', 'multiselect_' + (index + 1));
              $(this).attr('id', 'multiselect_' + (index + 1));
          });
          $('#inputmultiselectcount').val($('.multiselect-field').length);
      }
      $(document).on('click', '.addoption', function() {
          var multiselectNumber = $(this).data('multiselect');
          var optionCount = $('#addmultiselectop' + multiselectNumber + ' .createopstion').length + 1;
          var newOptionField =
              '<div class="createopstion" style="display: flex; align-items: center;">' +
              '<input class="form-control" type="text" placeholder="Enter Option Label"' +
              'name="multiselect' + multiselectNumber + '_op_' + optionCount + '" value=""' +
              'style="margin-top: 10px; margin-bottom: 10px; border: 1px solid #919191; width: 40rem;">' +
              '<div class="btn btn-danger btn-md btn-md delete-multiselectop-field" style="margin-left: 10px;">' +
              '<i class="iconFontSize fa fa-trash-o"></i>' +
              '</div>' +
              '</div>';
          $('#addmultiselectop' + multiselectNumber).append(newOptionField);
          $('#number_moption' + multiselectNumber).val(optionCount);
      });
      $(document).on('click', '.delete-multiselect-field', function() {
            var multiselectCount = $('.multiselect-field').length;
            var currentId = $(this).attr('id');
            var currentmultiselectBoxId = currentId.split('-');
            if (multiselectCount == currentmultiselectBoxId[2]) {
                $(this).closest('.createfield').remove();
                updateMultiselectFields();
            } else {
                alert('Please delete last multiselect first.');
            }
        });
      $(document).on('click', '.delete-multiselectop-field', function() {
          var multiselectNumber = $(this).closest('.createfield').find('.addoption').data(
              'multiselect');
          $(this).closest('.createopstion').remove();
          updatemultiselectOptionFields(multiselectNumber);
          updatemultiselectOptionNames(multiselectNumber);
      });
      function updatemultiselectOptionFields(multiselectNumber) {
          var optionCount = $('#addmultiselectop' + multiselectNumber + ' .createopstion').length;
          $('#number_moption' + multiselectNumber).val(optionCount);
      }
      function updatemultiselectOptionNames(multiselectNumber) {
          $('#addmultiselectop' + multiselectNumber + ' .createopstion').each(function(index) {
              $(this).find('input').attr('name', 'multiselect' + multiselectNumber + '_op_' + (index +
                  1));
          });
      }

$('.add-textarea-field').click(function() {
  var textareaCount = $('.textarea-field').length + 1;
  var sortOrder = $('.sortOrder').length + 1;
  var newTextareaField = '<div class="createfield">' +
      '<input class="form-control textarea-field" name="textarea_' + textareaCount + '"' +
      'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191; width:90rem; float:left;"' +
      'id="textarea_' + textareaCount + '" required >' +
      '<input class="form-control sortOrder" type="number" name="sortOrder[]"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"' +
      'placeholder="Order Number" value=0>' +
      '<div class="btn btn-danger btn-md btn-md delete-textarea-field"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; float:left; margin-left:27px">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '</div>';
  $('#textarea').append(newTextareaField);
  $('#inputtextareacount').val(textareaCount); // Set textarea count
  updateTextareaFields();
});

$(document).on('click', '.delete-textarea-field', function() {
  var textareaCount = $('#inputtextareacount').val();
  $(this).closest('.createfield').remove();
  $('#inputtextareacount').val(textareaCount - 1); // Update textarea count
  updateTextareaFields();
});

function updateTextareaFields() {
  $('.textarea-field').each(function(index) {
      $(this).attr('name', 'textarea_' + (index + 1));
      $(this).attr('id', 'textarea_' + (index + 1));
  });
  $('#inputtextareacount').val($('.textarea-field').length);
}

$('.add-currency-field').click(function() {
  var currencyCount = $('.currency-field').length + 1;
  var sortOrder = $('.sortOrder').length + 1;
  var newCurrencyField = '<div class="createfield">' +
      '<input class="form-control currency-field" type="text" name="currencyarea_' +
      currencyCount + '"' +
      'style="margin-top: 10px; margin-bottom: 10px;border:1px solid #919191; width:90rem; float:left;"' +
      'id="currencyarea_' + currencyCount + '" required />' +
      '<input class="form-control sortOrder" type="number" name="sortOrder[]"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"' +
      'placeholder="Order Number" value=0>' +
      '<div class="btn btn-danger btn-md btn-md delete-currency-field"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; float:left; margin-left:27px">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '</div>';
  $('#currency').append(newCurrencyField);
  $('#inputcurrencycount').attr('value', currencyCount);
  updateCurrencyFields();
});

$(document).on('click', '.delete-currency-field', function() {
  var currencyCount = $('#inputcurrencycount').val();
  $(this).closest('.createfield').remove();
  $('#inputcurrencycount').attr('value', currencyCount - 1);
  updateCurrencyFields();
});

function updateCurrencyFields() {
  $('.currency-field').each(function(index) {
      $(this).attr('name', 'currencyarea_' + (index + 1));
      $(this).attr('id', 'currencyarea_' + (index + 1));
  });
  $('#inputcurrencycount').val($('.currency-field').length);
}
$('.add-date-field').click(function() {
  var dateCount = $('.date-field').length + 1;
  var sortOrder = $('.sortOrder').length + 1;
  var newDateField = '<div class="createfield">' +
      '<input class="form-control date-field" type="text" name="datearea_' + dateCount + '"' +
      'style="margin-top: 10px;margin-bottom: 10px;border:1px solid #919191;width:90rem; float:left"' +
      'id="datearea_' + dateCount + '" required />' +
      '<input class="form-control" type="number" name="sortOrder[]"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; width:7%; float:left; margin-left:27px"' +
      'placeholder="Order Number" value="0">' +
      '<div class="btn btn-danger btn-md btn-md delete-date-field"' +
      'style="margin-top: 10px; margin-bottom: 10px; border:1px solid #919191; float:left; margin-left:27px">' +
      '<i class="iconFontSize fa fa-trash-o"></i>' +
      '</div>' +
      '</div>';
  $('#date').append(newDateField);
  $('#inputdatecount').val(dateCount); // Set date count
  updateDateFields();
});

$(document).on('click', '.delete-date-field', function() {
  var dateCount = $('#inputdatecount').val();
  $(this).closest('.createfield').remove();
  $('#inputdatecount').val(dateCount - 1); // Update date count
  updateDateFields();
});

function updateDateFields() {
  $('.date-field').each(function(index) {
      $(this).attr('name', 'datearea_' + (index + 1));
      $(this).attr('id', 'datearea_' + (index + 1));
  });
  $('#inputdatecount').val($('.date-field').length);
}


});
  </script>
    </body>
</html >