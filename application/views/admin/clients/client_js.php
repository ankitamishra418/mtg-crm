<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
/**
 * Included in application/views/admin/clients/client.php
 */
?>
<script>
Dropzone.options.clientAttachmentsUpload = false;
var customer_id = $('input[name="userid"]').val();
var choose = $('input[name="choose"]').val();
$(function() {

    if ($('#client-attachments-upload').length > 0) {
        new Dropzone('#client-attachments-upload', appCreateDropzoneOptions({
            paramName: "file",
            accept: function(file, done) {
                done();
            },
            success: function(file, response) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                    window.location.reload();
                }
            }
        }));
    }

    // Save button not hidden if passed from url ?tab= we need to re-click again
    if (tab_active) {
        $('body').find('.nav-tabs [href="#' + tab_active + '"]').click();
    }

    $('a[href="#customer_admins"]').on('click', function() {
        $('.btn-bottom-toolbar').addClass('hide');
    });

    $('.profile-tabs a').not('a[href="#customer_admins"]').on('click', function() {
        $('.btn-bottom-toolbar').removeClass('hide');
    });

    $("input[name='tasks_related_to[]']").on('change', function() {
        var tasks_related_values = []
        $('#tasks_related_filter :checkbox:checked').each(function(i) {
            tasks_related_values[i] = $(this).val();
        });
        $('input[name="tasks_related_to"]').val(tasks_related_values.join());
        $('.table-rel-tasks').DataTable().ajax.reload();
    });

    var contact_id = get_url_param('contactid');
    if (contact_id) {
        contact(customer_id, contact_id);
    }

    // consents=CONTACT_ID
    var consents = get_url_param('consents');
    if(consents){
        view_contact_consent(consents);
    }

    // If user clicked save and add new contact
    if (get_url_param('new_contact')) {
        contact(customer_id);
    }

    $('body').on('change', '.onoffswitch input.customer_file', function(event, state) {
        var invoker = $(this);
        var checked_visibility = invoker.prop('checked');
        var share_file_modal = $('#customer_file_share_file_with');
        setTimeout(function() {
            $('input[name="file_id"]').val(invoker.attr('data-id'));
            if (checked_visibility && share_file_modal.attr('data-total-contacts') > 1) {
                share_file_modal.modal('show');
            } else {
                do_share_file_contacts();
            }
        }, 200);
    });

    $('.customer-form-submiter').on('click', function() {
        var form = $('.client-form');
        if (form.valid()) {
            if ($(this).hasClass('save-and-add-contact')) {
                form.find('.additional').html(hidden_input('save_and_add_contact', 'true'));
            } else {
                form.find('.additional').html('');
            }
            form.submit();
        }
    });

    if (typeof(Dropbox) != 'undefined' && $('#dropbox-chooser').length > 0) {
        document.getElementById("dropbox-chooser").appendChild(Dropbox.createChooseButton({
            success: function(files) {
                saveCustomerProfileExternalFile(files, 'dropbox');
            },
            linkType: "preview",
            extensions: app.options.allowed_files.split(','),
        }));
    }

    /* Customer profile tickets table */
    $('.table-tickets-single').find('#th-submitter').removeClass('toggleable');

    initDataTable('.table-tickets-single', admin_url + 'tickets/index/false/' + customer_id, undefined, undefined, 'undefined', [$('table thead .ticket_created_column').index(), 'desc']);

    /* Customer profile contracts table */
    initDataTable('.table-contracts-single-client', admin_url + 'contracts/table/' + customer_id, undefined,undefined, 'undefined', [6, 'desc']);

    /* Custome profile contacts table */
    var contactsNotSortable = [];
    <?php if(is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1'){ ?>
        contactsNotSortable.push($('#th-consent').index());
    <?php } ?>
    if (!choose) {
        _table_api = initDataTable('.table-contacts', admin_url + 'clients/contacts/' + customer_id, 
        //contactsNotSortable, 
        //contactsNotSortable
        undefined,
        undefined,
        'undefined', [3, 'desc']
        );
    }
    // if (choose) {
    //     _table_api = initDataTable('.table-contacts', admin_url + 'clients/choose_contacts/' + customer_id, contactsNotSortable, contactsNotSortable);
    // }
    if(_table_api) {
          <?php if(is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1'){ ?>
        _table_api.on('draw', function () {
            var tableData = $('.table-contacts').find('tbody tr');
            $.each(tableData, function() {
                $(this).find('td:eq(1)').addClass('bg-light-gray');
            });
        });
        <?php } ?>
    }
    /* Customer profile invoices table */
    initDataTable('.table-invoices-single-client',
        admin_url + 'invoices/table/' + customer_id,
        'undefined',
        'undefined',
        'undefined', [
            [3, 'desc'],
            [0, 'desc']
        ]);

   initDataTable('.table-credit-notes', admin_url+'credit_notes/table/'+customer_id, ['undefined'], ['undefined'], undefined, [0, 'desc']);

    /* Customer profile Estimates table */
    initDataTable('.table-estimates-single-client',
        admin_url + 'estimates/table/' + customer_id,
        'undefined',
        'undefined',
        'undefined', [
            [3, 'desc'],
            [0, 'desc']
        ]);

    /* Customer profile payments table */
    initDataTable('.table-payments-single-client',
        admin_url + 'payments/table/' + customer_id, undefined, undefined,
        'undefined', [0, 'desc']);

    /* Customer profile reminders table */
    initDataTable('.table-reminders', admin_url + 'misc/get_reminders/' + customer_id + '/' + 'customer', undefined, undefined, undefined, [1, 'asc']);

    /* Customer profile expenses table */
    initDataTable('.table-expenses-single-client',
        admin_url + 'expenses/table/' + customer_id,
        'undefined',
        'undefined',
        'undefined', [6, 'desc']);

    /* Customer profile proposals table */
    initDataTable('.table-proposals-client-profile',
        admin_url + 'proposals/proposal_relations/' + customer_id + '/customer',
        'undefined',
        'undefined',
        'undefined', [6, 'desc']);

    /* Custome profile projects table */
    initDataTable('.table-projects-single-client', admin_url + 'projects/table/' + customer_id, undefined, undefined, 'undefined', <?php echo hooks()->apply_filters('projects_table_default_order', json_encode(array(5,'asc'))); ?>);

    var vRules = {};
    if (app.options.company_is_required == 1) {
        vRules = {
            company: 'required',
            phonenumber : 'required',
            key_contact_name : 'required',
            key_contact_email : 'required',
            client_review_date : 'required',
            customer_advisor:'required',
            client_type_id:'required',
        }
    }

    appValidateForm($('.client-form'), vRules);

    if(typeof(customer_id) == 'undefined'){
        $('#company').on('blur', function() {
            var company = $(this).val();
            var $companyExistsDiv = $('#company_exists_info');

            if(company == '') {
                $companyExistsDiv.addClass('hide');
                return;
            }

            $.post(admin_url+'clients/check_duplicate_customer_name', {company:company})
            .done(function(response) {
                if(response) {
                    response = JSON.parse(response);
                    if(response.exists == true) {
                        $companyExistsDiv.removeClass('hide');
                        $companyExistsDiv.html('<div class="info-block mbot15">'+response.message+'</div>');
                    } else {
                        $companyExistsDiv.addClass('hide');
                    }
                }
            });
        });
    }

    $('.billing-same-as-customer').on('click', function(e) {
        e.preventDefault();
        $('textarea[name="billing_street"]').val($('textarea[name="address"]').val());
        $('input[name="billing_city"]').val($('input[name="city"]').val());
        $('input[name="billing_state"]').val($('input[name="state"]').val());
        $('input[name="billing_zip"]').val($('input[name="zip"]').val());
        $('select[name="billing_country"]').selectpicker('val', $('select[name="country"]').selectpicker('val'));
    });

    $('.customer-copy-billing-address').on('click', function(e) {
        e.preventDefault();
        $('textarea[name="shipping_street"]').val($('textarea[name="billing_street"]').val());
        $('input[name="shipping_city"]').val($('input[name="billing_city"]').val());
        $('input[name="shipping_state"]').val($('input[name="billing_state"]').val());
        $('input[name="shipping_zip"]').val($('input[name="billing_zip"]').val());
        $('select[name="shipping_country"]').selectpicker('val', $('select[name="billing_country"]').selectpicker('val'));
    });

    $('body').on('hidden.bs.modal', '#contact', function() {
        $('#contact_data').empty();
    });

    $('.client-form').on('submit', function() {
        $('select[name="default_currency"]').prop('disabled', false);
    });

});

function delete_contact_profile_image(contact_id) {
    requestGet('clients/delete_contact_profile_image/'+contact_id).done(function(){
        $('body').find('#contact-profile-image').removeClass('hide');
        $('body').find('#contact-remove-img').addClass('hide');
        $('body').find('#contact-img').attr('src', '<?php echo base_url('assets/images/user-placeholder.jpg'); ?>');
    });
}

function customerGoogleDriveSave(pickData) {
    saveCustomerProfileExternalFile(pickData, 'gdrive');
}

function saveCustomerProfileExternalFile(files, externalType) {
    $.post(admin_url + 'clients/add_external_attachment', {
        files: files,
        clientid: customer_id,
        external: externalType
    }).done(function() {
        window.location.reload();
    });
}

function validate_contact_form() {
    appValidateForm('#contact-form', {
        firstname: 'required',
        lastname: 'required',
        //title:'required',
        phonenumber: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        //homephone:'required',
        Password: 'required',
        custom_occupation: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        occupation: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        residential_address: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        residential_city: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        residential_state: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        residential_zipcode: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        postal_address: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        postal_city: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        postal_state: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        postal_zipcode: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        //additional_note:'required',
        postal_country: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        residential_country: {
            required: {
                depends: function(element) {
                    if ($('#contact input[name="business"]').val() == false) {
                        if ($('#contact input[name="dependent"]').val() == false) {
                            return true;
                        }
                    }
                }
            }
        },
        password: {
            required: {
                depends: function(element) {

                    var $sentSetPassword = $('input[name="send_set_password_email"]');

                    if ($('#contact input[name="contactid"]').val() == '' && $sentSetPassword.prop('checked') == false) {
                        return true;
                    }
                }
            }
        },
        email: {
            <?php if(hooks()->apply_filters('contact_email_required', "true") === "true"){ ?>
            // required: true, -> for validate the email
            required: false,
            <?php } ?>
            email: true,
            // Use this hook only if the contacts are not logging into the customers area and you are not using support tickets piping.
            <?php if(hooks()->apply_filters('contact_email_unique', "true") === "true"){ ?>
            remote: {
                url: admin_url + "misc/contact_email_exists",
                type: 'post',
                data: {
                    email: function() {
                        return $('#contact input[name="email"]').val();
                    },
                    userid: function() {
                        return $('body').find('input[name="contactid"]').val();
                    }
                }
            }
            <?php } ?>
        }
    }, contactFormHandler);
}

function contactFormHandler(form) {
    $('#contact input[name="is_primary"]').prop('disabled', false);

    $("#contact input[type=file]").each(function() {
        if($(this).val() === "") {
            $(this).prop('disabled', true);
        }
    });

    var formURL = $(form).attr("action");
    var formData = new FormData($(form)[0]);

    $.ajax({
        type: 'POST',
        data: formData,
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        url: formURL
    }).done(function(response){
           response = JSON.parse(response);
           console.log('chooooosse=>'+response);
            if (response.success) {
                alert_float('success', response.message);
                if(typeof(response.is_individual) != 'undefined' && response.is_individual) {
                    $('.new-contact').addClass('disabled');
                    if(!$('.new-contact-wrapper')[0].hasAttribute('data-toggle')) {
                        $('.new-contact-wrapper').attr('data-toggle','tooltip');
                    }
                }
            }

            if ($.fn.DataTable.isDataTable('.table-contacts')) {
                $('.table-contacts').DataTable().ajax.reload(null,false);
            } else if ($.fn.DataTable.isDataTable('.table-all-contacts')) {
                $('.table-all-contacts').DataTable().ajax.reload(null,false);
            }
            if ($.fn.DataTable.isDataTable('.table-choose-contacts')) {
                $('.table-choose-contacts').DataTable().ajax.reload(null,false);
            } else if ($.fn.DataTable.isDataTable('.table-all-choose-contacts')) {
                $('.table-all-choose-contacts').DataTable().ajax.reload(null,false);
            }

            if (response.proposal_warning && response.proposal_warning != false) {
                $('body').find('#contact_proposal_warning').removeClass('hide');
                $('body').find('#contact_update_proposals_emails').attr('data-original-email', response.original_email);
                $('#contact').animate({
                    scrollTop: 0
                }, 800);
            } else {
                $('#contact').modal('hide');
            }
    }).fail(function(error){
        alert_float('danger', JSON.parse(error.responseText));
    });
    return false;
}

function contact(client_id, contact_id) {
    if (typeof(contact_id) == 'undefined') {
        contact_id = '';
    }
    requestGet('clients/form_contact/' + client_id + '/' + contact_id).done(function(response) {
        $('#contact_data').html(response);
        $('#contact').modal({
            show: true,
            backdrop: 'static'
        });
        $('body').off('shown.bs.modal','#contact');
        $('body').on('shown.bs.modal', '#contact', function() {
            if (contact_id == '') {
                $('#contact').find('input[name="firstname"]').focus();
            }
        });
        init_selectpicker();
        init_datepicker();
        custom_fields_hyperlink();
        validate_contact_form();
    }).fail(function(error) {
        var response = JSON.parse(error.responseText);
        alert_float('danger', response.message);
    });
}


function update_all_proposal_emails_linked_to_contact(contact_id) {
    var data = {};
    data.update = true;
    data.original_email = $('body').find('#contact_update_proposals_emails').data('original-email');
    $.post(admin_url + 'clients/update_all_proposal_emails_linked_to_customer/' + contact_id, data).done(function(response) {
        response = JSON.parse(response);
        if (response.success) {
            alert_float('success', response.message);
        }
        $('#contact').modal('hide');
    });
}

function do_share_file_contacts(edit_contacts, file_id) {
    var contacts_shared_ids = $('select[name="share_contacts_id[]"]');
    if (typeof(edit_contacts) == 'undefined' && typeof(file_id) == 'undefined') {
        var contacts_shared_ids_selected = $('select[name="share_contacts_id[]"]').val();
    } else {
        var _temp = edit_contacts.toString().split(',');
        for (var cshare_id in _temp) {
            contacts_shared_ids.find('option[value="' + _temp[cshare_id] + '"]').attr('selected', true);
        }
        contacts_shared_ids.selectpicker('refresh');
        $('input[name="file_id"]').val(file_id);
        $('#customer_file_share_file_with').modal('show');
        return;
    }
    var file_id = $('input[name="file_id"]').val();
    $.post(admin_url + 'clients/update_file_share_visibility', {
        file_id: file_id,
        share_contacts_id: contacts_shared_ids_selected,
        customer_id: $('input[name="userid"]').val()
    }).done(function() {
        window.location.reload();
    });
}

function save_longitude_and_latitude(clientid) {
    var data = {};
    data.latitude = $('#latitude').val();
    data.longitude = $('#longitude').val();
    $.post(admin_url + 'clients/save_longitude_and_latitude/'+clientid, data).done(function(response) {
       if(response == 'success') {
            alert_float('success', "<?php echo _l('updated_successfully', _l('client')); ?>");
       }
        setTimeout(function(){
            window.location.reload();
        },1200);
    }).fail(function(error) {
        alert_float('danger', error.responseText);
    });
}

function fetch_lat_long_from_google_cprofile() {
    var data = {};
    data.address = $('#long_lat_wrapper').data('address');
    data.city = $('#long_lat_wrapper').data('city');
    data.country = $('#long_lat_wrapper').data('country');
    $('#gmaps-search-icon').removeClass('fa-google').addClass('fa-spinner fa-spin');
    $.post(admin_url + 'misc/fetch_address_info_gmaps', data).done(function(data) {
        data = JSON.parse(data);
        $('#gmaps-search-icon').removeClass('fa-spinner fa-spin').addClass('fa-google');
        if (data.response.status == 'OK') {
            $('input[name="latitude"]').val(data.lat);
            $('input[name="longitude"]').val(data.lng);
        } else {
            if (data.response.status == 'ZERO_RESULTS') {
                alert_float('warning', "<?php echo _l('g_search_address_not_found'); ?>");
            } else {
                alert_float('danger', data.response.status + ' - ' + data.response.error_message);
            }
        }
    });
}
$(document).ready(function () {
    $('#choose_contact_table').DataTable();
});

function autoFilAddress() {
    
    let checkbox = document.getElementById('checkBox');
    let residential_address = document.getElementById('residential_address');
    let residential_city = document.getElementById('residential_city');
    let residential_state = document.getElementById('residential_state');
    let residential_zipcode = document.getElementById('residential_zipcode');
    let residential_country = document.getElementById('residential_country');
    let postal_address = document.getElementById('postal_address');
    let postal_city = document.getElementById('postal_city');
    let postal_state = document.getElementById('postal_state');
    let postal_zipcode = document.getElementById('postal_zipcode');
    let postal_country = document.getElementById('postal_country');
    if (checkbox.checked == true) {

        let residential_address_Value = residential_address.value;
        let residential_city_Value = residential_city.value;
        let residential_state_Value = residential_state.value;
        let residential_zipcode_Value = residential_zipcode.value;
        let residential_country_Value = residential_country.value;
        postal_address.value = residential_address_Value;
        postal_city.value = residential_city_Value;
        postal_state.value = residential_state_Value;
        postal_zipcode.value = residential_zipcode_Value;
        postal_country.value = residential_country_Value;
        $("#postal_country").selectpicker("refresh");

    } else {
        postal_address.value = "";
        postal_city.value = "";
        postal_state.value = "";
        postal_zipcode.value = "";
        postal_country.value = "";
        $("#postal_country").selectpicker("refresh");
    }
}

function autoFillAddress() {
       
       let checkbox = document.getElementById('checkBox');
       let residential_address = document.getElementById('address');
       let residential_city = document.getElementById('city');
       let residential_state = document.getElementById('state');
       let residential_zipcode = document.getElementById('zip');
       let residential_country = document.getElementById('country');
   
       let postal_address = document.getElementById('client_postal_address');
       let postal_city = document.getElementById('client_postal_city');
       let postal_state = document.getElementById('client_postal_state');
       let postal_zipcode = document.getElementById('client_postal_zip_code');
       let postal_country = document.getElementById('client_postal_country');
   
       if (checkbox.checked == true) {
           let residential_address_Value = residential_address.value;
           let residential_city_Value = residential_city.value;
           let residential_state_Value = residential_state.value;
           let residential_zipcode_Value = residential_zipcode.value;
           let residential_country_Value = residential_country.value;
           postal_address.value = residential_address_Value;
           postal_city.value = residential_city_Value;
           postal_state.value = residential_state_Value;
           postal_zipcode.value = residential_zipcode_Value;
           postal_country.value = residential_country_Value;
           $("#client_postal_country").selectpicker("refresh");
       } else {
           postal_address.value = "";
           postal_city.value = "";
           postal_state.value = "";
           postal_zipcode.value = "";
           postal_country.value = "";
           
           $("#client_postal_country").selectpicker("refresh");
       }
   }

   var csrfName    = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash        = '<?php echo $this->security->get_csrf_hash(); ?>';

$('#contact_name').change(function(){

    var contact_id  = $(this).val();
    var userid      = $('#userid').val();
    var action      = "<?php echo base_url('admin/clients/get_contact_details'); ?>"

    $.ajax({
        type : 'POST',
        url : action,
        data : {
            contact_id : contact_id,
            userid :userid,
        },
        datatype : "json",
        success: function(datas){
            var data = JSON.parse(datas);
            console.log(data);
            // to show the value in input field
            document.getElementById("individual_firstname").value              = data.firstname + " " + data.lastname;
            document.getElementById("individual_email").value                  = data.email;
            document.getElementById("individual_phonenumber").value            = data.phonenumber;
            document.getElementById("individual_residential_address").value    = data.residential_address + ' ,' + data.residential_state + ' ,' + data.residential_city + ' ,' + data.residential_zipcode + ' ,' + data.residential_country;
            document.getElementById("individual_postal_address").value         = data.postal_address + ' ,' + data.postal_state + ' ,' + data.postal_city + ' ,' + data.postal_zipcode + ' ,' + data.postal_country;
            // to show the value in html tag (h,p,span etc)
            document.getElementById("firstname").innerHTML                     = data.firstname + " " + data.lastname;
            document.getElementById("email").innerHTML                         = data.email;
            document.getElementById("phonenumber").innerHTML                   = data.phonenumber;
            document.getElementById("residential_address").innerHTML           = data.residential_address + ' ,' + data.residential_state + ' ,' + data.residential_city + ' ,' + data.residential_zipcode + ' ,' + data.residential_country;
            document.getElementById("postal_address").innerHTML                = data.postal_address + ' ,' + data.postal_state + ' ,' + data.postal_city + ' ,' + data.postal_zipcode + ' ,' + data.postal_country;
        }
    })
})   
</script>
