<style>
    .onoffswitch-checkbox:checked + .red_btn{
  background-color: red !important;
  border-color: red !important;
}
.onoffswitch-checkbox:checked+.onoffswitch-label .red_btn, .onoffswitch-checkbox:checked+.onoffswitch-label.red_btn:before {
  border-color: red !important;
}
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
            <?php if(isset($consent_purposes)) { ?>
            <div class="row mbot15">
              <div class="col-md-3 contacts-filter-column">
               <div class="select-placeholder">
                <select name="custom_view" title="<?php echo _l('gdpr_consent'); ?>" id="custom_view" class="selectpicker" data-width="100%">
                  <option value=""></option>
                  <?php foreach($consent_purposes as $purpose) { ?>
                  <option value="consent_<?php echo $purpose['id']; ?>">
                    <?php echo $purpose['name']; ?>
                  </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        <?php } ?>
        <div class="clearfix"></div>

        <!--import button-->
        <div class="inline-block new-contact-wrapper" data-title="<?php echo _l('customer_contact_person_only_one_allowed'); ?>"<?php if($disable_new_contacts){ ?> data-toggle="tooltip"<?php } ?>>
          <?php if(is_admin()){  ?> <a href="<?php echo base_url(); ?>admin/clients/import_view<?php //echo $client->userid; ?>" class="btn btn-info new-contact mbot25<?php if($disable_new_contacts){echo ' disabled';} ?>"><?php echo _l('Import Individuals'); ?></a>
          <?php } ?> 
        </div>
        <!-- end import button -->


          
        <div class="row inline-block "style="margin-bottom: -35px;">
          <div class="row" style="margin-bottom: -35px; margin-left: 220px;">
            <form method="post" action="<?php echo base_url();?>admin/Clients/all_contacts" class="filterform">
              <!-- for first name and last name -->

              <div class="col-md-6">
                <select class=" selectpicker form-control form-control-lg" title="First Name" data-live-search="true" id="firstnameindividual" name="firstnameindividual">
                  <option value="" selected>First Name</option>
                  <?php foreach($firstname as $firstdata)
                  {?>
                    <option value="<?php echo $firstdata;?>"
                      <?php if($firstdata == $this->session->userdata('firstNameIndividual'))
                      {
                        ?>
                        selected
                        <?php
                      }?>>
                      <?php echo $firstdata;?>
                    </option>
                    <?php
                  } ?>
                </select>
              </div>

              
              <div class="col-md-6">
                <select class="selectpicker form-control form-control-lg" title="Last Name" data-live-search="true" id="lastnameindividual" name="lastnameindividual">
                  <option value="" selected>Last Name</option>
                  <?php foreach($lastname as $lastData)
                  {?>
                    <option value="<?php echo $lastData;?>"
                    <?php if($lastData == $this->session->userdata('lastNameIndividual'))
                    {?>
                      selected
                      <?php
                    }?>>
                    <?php echo $lastData;?>
                    </option>
                    <?php
                  }?>
                </select>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"value="<?php echo $this->security->get_csrf_hash();?>">
                <button type="submit" class="btn btn-primary" style="left: 200px;top:-34px;">Search</button>
              </div>
              
            </form>
            <!-- end -->
          </div>
        </div>
          


        <?php if(is_admin()){  ?><a class="btn btn-info" style="float: right;" href=<?php echo base_url('admin/clients/InActivityLog'); ?>>Export Individuals log</a></br><br>
        <?php } ?> 
        <?php
        $table_data = array(_l('client_firstname'),_l('client_lastname'));
        if(is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1')
        {
          array_push($table_data, array(
          'name'=>_l('gdpr_consent') .' ('._l('gdpr_short').')',
          'th_attrs'=>array('id'=>'th-consent', 'class'=>'not-export')
        ));
       }
       $table_data = array_merge($table_data, array(
        _l('email_receiver'),
        _l('date_birth'),
        _l('age'),
        _l('client_email'),
        _l('clients_list_company'),
         _l('Adviser'),
        //  _l('Age'),
        _l('client_phonenumber'),
        // _l('Occupation Class'),
        _l('location'),
        // _l('contact_position'),
        // _l('clients_list_last_login'),
        _l('contact_active'),
        _l('Vulnerable'),
        _l('Deceased')
      ));
       $custom_fields = get_custom_fields('contacts',array('show_on_table'=>1));
       foreach($custom_fields as $field){
        array_push($table_data,$field['name']);
      }
      render_datatable($table_data,'all-contacts');
      ?>
    </div>
  </div>
</div>
</div>
</div>
</div>
<?php init_tail(); ?>
<?php $this->load->view('admin/clients/client_js'); ?>
<div id="contact_data"></div>
<div id="consent_data"></div>
<script>
 $(function(){
  var optionsHeading = [];
  var allContactsServerParams = {
   "custom_view": "[name='custom_view']",
 }
 <?php if(is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1'){ ?>
  optionsHeading.push($('#th-consent').index());
  <?php } ?>
  _table_api = initDataTable('.table-all-contacts', window.location.href, optionsHeading, optionsHeading, allContactsServerParams, [0,'asc']);
  if(_table_api) {
   <?php if(is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1'){ ?>
    _table_api.on('draw', function () {
      var tableData = $('.table-all-contacts').find('tbody tr');
      $.each(tableData, function() {
        $(this).find('td:eq(2)').addClass('bg-light-gray');
      });
    });
    $('select[name="custom_view"]').on('change', function(){
      _table_api.ajax.reload()
      .columns.adjust()
      .responsive.recalc();
    });
    <?php } ?>
  }
});
function status_individual(id) {
    var actionURL = "<?php echo base_url('admin/Clients/email_reciever')?>";
    var status = id;
    var deceasedcheckBox = document.getElementById("e_" + status);
    var statuscheckBox = document.getElementById("c_" + status);
    var checkBox = document.getElementById("c_" + status);
    var email_checkBox = document.getElementById("P_" + status);
    var email_checkBoxId = email_checkBox.id;
    if (deceasedcheckBox.checked == false && statuscheckBox.checked == true) {
        var email_checkVal = 1;
        document.getElementById(email_checkBoxId).checked = true;
        document.getElementById(email_checkBoxId).onchange = function() {
            myPrimaryContact(status, 'status');
        }
    } else if (deceasedcheckBox.checked == true && statuscheckBox.checked == true) {
        var email_checkVal = 0;
        document.getElementById(email_checkBoxId).checked = false;
        document.getElementById(email_checkBoxId).onchange = function() {
            this.checked = false;
        }
    } else if (deceasedcheckBox.checked == false && statuscheckBox.checked == false) {
        var email_checkVal = 0;
        document.getElementById(email_checkBoxId).checked = false;
        document.getElementById(email_checkBoxId).onchange = function() {
            this.checked = false;
        }
    } else {
        var email_checkVal = 0;
        document.getElementById(email_checkBoxId).checked = false;
        document.getElementById(email_checkBoxId).onchange = function() {
            this.checked = false;
        }
    }
    $.ajax({
        type: 'POST',
        url: actionURL,
        data: {
            email_checkVal: email_checkVal,
            id: status
        },
        datatype: "json",
        success: function(data) {
            console.log(data);
        }
    });
}
function myDeceasedfunctions(id) {
    var actionURL = "<?php echo base_url('admin/Clients/DeceasedContact')?>";
    var deceased = id;
    var deceasedcheckBox = document.getElementById("e_" + deceased);
    var statusCheckBox = document.getElementById("c_" + deceased);
    var email_checkBox = document.getElementById("P_" + deceased);
    var email_checkBoxId = document.getElementById("P_" + deceased).id;
    if (deceasedcheckBox.checked == true && statusCheckBox.checked == false) {
        var deceased_checkVal = 1;
        var email_checkVal = 0;
        document.getElementById(email_checkBoxId).checked = false;
        document.getElementById(email_checkBoxId).onchange = function() {
            this.checked = false;
        }
    } else if (deceasedcheckBox.checked == true && statusCheckBox.checked == true) {
        var deceased_checkVal = 1;
        var email_checkVal = 0;
        document.getElementById(email_checkBoxId).checked = false;
        document.getElementById(email_checkBoxId).onchange = function() {
            this.checked = false;
        }
    } else if (deceasedcheckBox.checked == false && statusCheckBox.checked == false) {
        var deceased_checkVal = 0;
        var email_checkVal = 0;
        document.getElementById(email_checkBoxId).checked = false;
        document.getElementById(email_checkBoxId).onchange = function() {
            this.checked = false;
        }
    } else {
        var deceased_checkVal = 0;
        var email_checkVal = 1;
        document.getElementById(email_checkBoxId).checked = true;
        document.getElementById(email_checkBoxId).onchange = function() {
            myPrimaryContact(deceased, 'deceased');
        };
    }
    $.ajax({
        type: 'POST',
        url: actionURL,
        data: {
            deceased_checkVal: deceased_checkVal,
            email_checkVal: email_checkVal,
            deceased: deceased
        },
        datatype: "json",
        success: function(data) {
            console.log(data);
        }
    });
}
function myPrimaryContact(id, where) {
    var actionURL = "<?php echo base_url('admin/Clients/primaryContact')?>"
    var individeal = id;
    var checkBox = document.getElementById("P_" + individeal);
    var checkBoxId = document.getElementById("P_" + individeal).id;
    var deceasedCheckBox = document.getElementById("e_" + individeal);
    var statusCheckBox = document.getElementById("c_" + individeal);
    if (where == "deceased") {
        console.log(where);
        if (deceasedCheckBox.checked == true && statusCheckBox.checked == false) {
            var deceased_checkVal = 1;
            var email_checkVal = 0;
            document.getElementById(checkBoxId).checked = false;
            document.getElementById(checkBoxId).onchange = function() {
                this.checked = false;
            }
        } else if (deceasedCheckBox.checked == true && statusCheckBox.checked == true) {
            var deceased_checkVal = 1;
            var email_checkVal = 0;
            document.getElementById(checkBoxId).checked = false;
            document.getElementById(checkBoxId).onchange = function() {
                this.checked = false;
            }
        } else if (deceasedCheckBox.checked == false && statusCheckBox.checked == false) {
            var deceased_checkVal = 0;
            var email_checkVal = 0;
            document.getElementById(checkBoxId).checked = false;
            document.getElementById(checkBoxId).onchange = function() {
                this.checked = false;
            }
        } else {
            if (checkBox.checked == true) {
                var primary_checkVal = 1;
            } else {
                var primary_checkVal = 0;
            }
        }
        $.ajax({
            type: 'POST',
            url: actionURL,
            data: {
                primary_checkVal: primary_checkVal,
                individeal: individeal
            },
            datatype: "json",
            success: function(data) {
                console.log(data);
            }
        })
    } else if (where == "status") {
        console.log(where);
        if (deceasedCheckBox.checked == true && statusCheckBox.checked == false) {
            var deceased_checkVal = 1;
            var email_checkVal = 0;
            document.getElementById(checkBoxId).checked = false;
            document.getElementById(checkBoxId).onchange = function() {
                this.checked = false;
            }
        } else if (deceasedCheckBox.checked == true && statusCheckBox.checked == true) {
            var deceased_checkVal = 1;
            var email_checkVal = 0;
            document.getElementById(checkBoxId).checked = false;
            document.getElementById(email_checkBoxId).onchange = function() {
                this.checked = false;
            }
        } else if (deceasedCheckBox.checked == false && statusCheckBox.checked == false) {
            var deceased_checkVal = 0;
            var email_checkVal = 0;
            document.getElementById(checkBoxId).checked = false;
            document.getElementById(checkBoxId).onchange = function() {
                this.checked = false;
            }
        } else {
            if (checkBox.checked == true) {
                var primary_checkVal = 1;
            } else {
                var primary_checkVal = 0;
            }
        }
        $.ajax({
            type: 'POST',
            url: actionURL,
            data: {
                primary_checkVal: primary_checkVal,
                individeal: individeal
            },
            datatype: "json",
            success: function(data) {
                console.log(data);
            }
        })
    } else {
        console.log(where);
        if (deceasedCheckBox.checked == true && statusCheckBox.checked == false) {
            var deceased_checkVal = 1;
            var email_checkVal = 0;
            document.getElementById(checkBoxId).checked = false;
            document.getElementById(checkBoxId).onchange = function() {
                this.checked = false;
            }
        } else if (deceasedCheckBox.checked == true && statusCheckBox.checked == true) {
            var deceased_checkVal = 1;
            var email_checkVal = 0;
            document.getElementById(checkBoxId).checked = false;
            document.getElementById(checkBoxId).onchange = function() {
                this.checked = false;
            }
        } else if (deceasedCheckBox.checked == false && statusCheckBox.checked == false) {
            var deceased_checkVal = 0;
            var email_checkVal = 0;
            document.getElementById(checkBoxId).checked = false;
            document.getElementById(checkBoxId).onchange = function() {
                this.checked = false;
            }
        } else {
            if (checkBox.checked == true) {
                var primary_checkVal = 1;
            } else {
                var primary_checkVal = 0;
            }
        }
        $.ajax({
            type: 'POST',
            url: actionURL,
            data: {
                primary_checkVal: primary_checkVal,
                individeal: individeal
            },
            datatype: "json",
            success: function(data) {
                console.log(data);
            }
        })
    }
}
// function myDeceasedfunctions(id) {
//     var actionURL = "<?php echo base_url('admin/Clients/DeceasedContact')?>";
//     var deceased = id;
//     var checkBox = document.getElementById("e_" + deceased);
//     var email_checkBox = document.getElementById("P_" + deceased);
//     var email_checkBoxId = document.getElementById("P_" + deceased).id;
//     if (checkBox.checked == true) {
//         var deceased_checkVal = 1;
//         var email_checkVal = 0;
//         document.getElementById(email_checkBoxId).checked = false;
//         document.getElementById(email_checkBoxId).onchange = function() {
//             this.checked = false;
//         }
//     } else {
//         var deceased_checkVal = 0;
//         var email_checkVal = 1;
//         document.getElementById(email_checkBoxId).checked = true;
//         document.getElementById(email_checkBoxId).onchange = function() {
//             myPrimaryContact(deceased);
//         };
//     }
//     $.ajax({
//         type: 'POST',
//         url: actionURL,
//         data: {
//             deceased_checkVal: deceased_checkVal,
//             email_checkVal: email_checkVal,
//             deceased: deceased
//         },
//         datatype: "json",
//         success: function(data) {
//             console.log(data);
//         }
//     });
// }
// function myPrimaryContact(id) {
//     var actionURL = "<?php echo base_url('admin/Clients/primaryContact')?>"
//     var individeal = id;
//     var checkBox = document.getElementById("P_" + individeal);
//     var checkBoxId = document.getElementById("P_" + individeal).id;
//     var deceasedCheckBox = document.getElementById("e_" + individeal);
//     // alert(deceasedCheckBox);
//     if (deceasedCheckBox.checked == true) {
//         document.getElementById(checkBoxId).checked = false;
//         document.getElementById(checkBoxId).onchange = function() {
//             this.checked = false;
//         }
//     } else {
//         if (checkBox.checked == true) {
//             var primary_checkVal = 1;
//         } else {
//             var primary_checkVal = 0;
//         }
//     }
//     $.ajax({
//         type: 'POST',
//         url: actionURL,
//         data: {
//             primary_checkVal: primary_checkVal,
//             individeal: individeal
//         },
//         datatype: "json",
//         success: function(data) {
//             console.log(data);
//         }
//     })
// }

// function myPrimaryContact(id) {

// var actionURL = "<?php// echo base_url('admin/Clients/primaryContact')?>"
// var individeal = id;
// var checkBox = document.getElementById("P_" + individeal);
// // alert(individeal);
// if (checkBox.checked == true) {
//    var primary_checkVal = 1;
// } else {
//    var primary_checkVal = 0;
// }
// $.ajax({
//    type: 'POST',
//    url: actionURL,
//    data: {
//       primary_checkVal: primary_checkVal,
//       individeal: individeal
//    },
//    datatype: "json",
//    success: function(data) {
//       console.log(data);
//    }
// })
// }

function myClientfunctions(id) {
   var actionURL = "<?php echo base_url('admin/Clients/vulnerableCheckData_tbl')?>"
   var individeal_id = id;
   var checkBox = document.getElementById("d_" + individeal_id);
 
   if (checkBox.checked == true) {
      var vulnerable_checkValue = 1;
   } else {
      var vulnerable_checkValue = 0;
   }
   $.ajax({
      type: 'POST',
      url: actionURL,
      data: {
         vulnerable_checkValue: vulnerable_checkValue,
         individeal_id: individeal_id,
        
      },
      datatype: "json",
      success: function(data) {
         console.log(data);
      }
   })
}
</script>
<script>
$(document).ready(function() {
  var table = $('.table-responsive .table .has-row-options').DataTable();
  $(".dataTables_filter input").on('keyup change', function() {
    var searchDate = $(this).val();
    var splitSearchDate = searchDate.split('-');
    if (splitSearchDate.length == 3 && splitSearchDate[2].length == 4 && splitSearchDate[1].length == 2 && splitSearchDate[0].length == 2) {
      $(this).val(splitSearchDate[2]+'-'+splitSearchDate[1]+'-'+splitSearchDate[0]);
    }
  });
});
</script>
</body>
</html>
