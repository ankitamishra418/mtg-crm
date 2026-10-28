<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css')?>">

<h4 class="customer-profile-group-heading"><?php echo _l('client_add_edit_profile'); ?></h4>
<div class="row">
    <?php echo form_open($this->uri->uri_string(),array('class'=>'client-form','autocomplete'=>'off')); ?>
    <div class="additional"></div>
    <div class="col-md-12">
        <div class="horizontal-scrollable-tabs">
            <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
            <div class="horizontal-tabs">
                <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
                    <li role="presentation" class="<?php if(!$this->input->get('tab')){echo 'active';}; ?>">
                        <a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab" class="show">
                            <?php //echo _l( 'customer_profile_details'); ?>Client Group Details
                        </a>
                    </li>
                    <!-- <li role="presentation">
                        <a href="#A" aria-controls="client_type" role="tab" data-toggle="tab" class="client_type">
                            <?php //echo _l( 'Client Type'); ?>
                        </a>
                    </li> -->

                    <li role="presentation">
                        <a href="#B" aria-controls="group" role="tab" data-toggle="tab" class="client_type">
                            <?php echo _l( 'Groups'); ?>
                        </a>
                    </li>

                    <?php
                  $customer_custom_fields = false;
                  if(total_rows(db_prefix().'customfields',array('fieldto'=>'customers','active'=>1)) > 0 ){
                       $customer_custom_fields = true;
                   ?>
                    <li role="presentation"
                        class="<?php if($this->input->get('tab') == 'custom_fields'){echo 'active';}; ?>">
                        <a href="#" aria-controls="custom_fields" role="tab" data-toggle="tab">
                            <?php echo hooks()->apply_filters('customer_profile_tab_custom_fields_text', _l( 'custom_fields')); ?>
                        </a>
                    </li>
                    <?php } ?>

                    <!-- <li role="presentation">
                        <a href="#billing_and_shipping" aria-controls="billing_and_shipping" role="tab" data-toggle="tab">
                        <?php //echo _l( 'billing_shipping'); ?>
                        </a>
                    </li>  -->

                    <?php hooks()->do_action('after_customer_billing_and_shipping_tab', isset($client) ? $client : false); ?>
                    <?php if(isset($client)){ ?>
                    <li role="presentation">
                        <a href="#customer_admins" aria-controls="customer_admins" role="tab" data-toggle="tab">
                            <?php echo _l( 'customer_admins' ); ?>
                            <?php if(count($customer_admins) > 0 ) { ?>
                            <span class="badge bg-default"><?php echo count($customer_admins) ?></span>
                            <?php } ?>
                        </a>
                    </li>
                    <?php hooks()->do_action('after_customer_admins_tab',$client); ?>
                    <?php } ?>

                    <!-- internal_profile tab start -->
                        <?php
                        // if(is_admin()) :
                         //if(is_admin() || has_permission('staff', '', 'view')) : 
                         ?>
                    <!-- <li role="presentation">
                        <a href="#internal_profile" aria-controls="internal_profile" role="tab" data-toggle="tab"
                            class="client_type">
                            <?php// echo _l( 'Internal Profile'); ?>
                        </a>
                    </li> -->
                    <?php //endif; ?>


                    <?php
if (is_admin() || has_permission('internal_profiles', '', 'view')) :
?>
    <li role="presentation">
        <a href="#internal_profile"
           aria-controls="internal_profile"
           role="tab"
           data-toggle="tab"
           class="client_type">
            <?php echo _l('Internal Profile'); ?>
        </a>
    </li>
<?php endif; ?>
                    <!-- internal_profile tab end -->

                </ul>
            </div>
        </div>
        <div class="tab-content mtop15">
            <?php hooks()->do_action('after_custom_profile_tab_content',isset($client) ? $client : false); ?>
            <?php if($customer_custom_fields) { ?>
            <div role="tabpanel"
                class="tab-pane <?php if($this->input->get('tab') == 'custom_fields'){echo ' active';}; ?>"
                id="custom_fields">
                <?php $rel_id=( isset($client) ? $client->userid : false); ?>
                <?php echo render_custom_fields( 'customers',$rel_id); ?>
            </div>
            <?php } ?>
            <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab')){echo ' active';}; ?>"
                id="contact_info">

                <div class="row">
                    <div class="col-md-6">
                        <?php $value=( isset($client) ? $client->company : ''); ?>
                        <?php $attrs = (isset($client) ? array() : array('autofocus'=>true)); ?>
                        <?php //echo render_input( 'company', 'client_company',$value,'text',$attrs); ?>
                        <?php echo render_input( 'company', 'Client Group',$value,'text',$attrs); ?>

                        <div id="company_exists_info" class="hide"></div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group contact-gender-option">
                            <label for="client_type"><?php //echo _l('document_client_type'); ?>Type</label>
                            
                            <select class="selectpicker"
    data-none-selected-text="<?php echo _l('system_default_string'); ?>"
    data-width="100%"
    name="client_type"
    id="client_type_id"
    >

    <?php foreach ($clientTypedata as $clientTypedatas) { ?>

        <option value="<?php echo $clientTypedatas['id']; ?>"
            <?php
            if (isset($client) && $client->client_type == $clientTypedatas['id']) {
                echo 'selected';
            }
            ?>>
            <?php echo $clientTypedatas['client_type']; ?>
        </option>

    <?php } ?>

</select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    
                    <div class="col-md-12 mtop15 <?php if(isset($client) && (!is_empty_customer_company($client->userid) && total_rows(db_prefix().'contacts',array('userid'=>$client->userid,'is_primary'=>1)) > 0)) { echo ''; } else {echo ' hide';} ?>"
                        id="client-show-primary-contact-wrapper">
                        <!-- <div class="checkbox checkbox-info mbot20 no-mtop">
                            <input type="checkbox" name="show_primary_contact"
                                <?php //if(isset($client) && $client->show_primary_contact == 1){echo ' checked';}?>
                                value="1" id="show_primary_contact">
                            <label for="show_primary_contact"><?php //echo _l('show_primary_contact',_l('invoices').', '._l('estimates').', '._l('payments').', '._l('credit_notes')); ?></label>
                        </div> -->
                    </div>

                    <div class="col-md-6">
                        <?php
                        $selected = array();
                        foreach($customer_advisor as $ab){
                            array_push($selected,$ab['staff_id']);
                        }
                        echo render_select('customer_advisor[]',$staff,array('staffid',array('firstname','lastname')),'Adviser',$selected,array(),'','',false); ?>

                        <!-- <div class="form-group contact-gender-option">
                            <label for="client_type"><?php echo _l('document_client_type'); ?></label>
                            <select class="selectpicker"
                                data-none-selected-text="<?php echo _l('system_default_string'); ?>" data-width="100%"
                                name="client_type" id="client_type">
                                <option value=""
                                    <?php if(isset($client) && empty($client->client_type)){echo 'selected';} ?>>
                                </option>
                                <option value="1"
                                    <?php if(isset($client) && $client->client_type == '1'){echo 'selected';} ?>>
                                    Business</option>

                                <option value="2"
                                    <?php if(isset($client) && $client->client_type == '2'){echo 'selected';} ?>>
                                    Personal</option>
                            </select>
                        </div> -->



                        <?php //if(get_option('company_requires_vat_number_field') == 1){
                    // $value=( isset($client) ? $client->vat : '');
                   //  echo render_input( 'vat', 'client_vat_number',$value);
                   //  } ?>
                        <?php //if(!isset($client)){ ?>
                        <!-- <i class="fa fa-question-circle pull-left" data-toggle="tooltip" -->
                        <!-- data-title="<?php //echo _l('customer_currency_change_notice'); ?>"></i> -->
                        <?php //}
                    // $s_attrs = array('data-none-selected-text'=>_l('system_default_string'));
                     //$selected = '';
                     //if(isset($client) && client_have_transactions($client->userid)){
                     //    $s_attrs['disabled'] = true;
                     // }
                     // foreach($currencies as $currency){
                     //    if(isset($client)){
                     //      if($currency['id'] == $client->default_currency){
                     //        $selected = $currency['id'];
                     //     }
                     //  }
                     // }
                     // Do not remove the currency field from the customer profile!

                    // echo render_select('default_currency',$currencies,array('id','name','symbol'),'invoice_add_edit_currency',$selected,$s_attrs); ?>
                        <!-- <?php //if(!is_language_disabled()){ ?>
                        <div class="form-group select-placeholder">
                            <label for="default_language"
                                class="control-label"><?php //echo _l('localization_default_language'); ?>
                            </label>
                            <select name="default_language" id="default_language" class="form-control selectpicker"
                                data-none-selected-text="<?php //echo _l('dropdown_non_selected_tex'); ?>">
                                <option value=""><?php //echo _l('system_default_string'); ?></option>
                                <?php //foreach($this->app->get_available_languages() as $availableLanguage){
                           // $selected = '';
                           // if(isset($client)){
                           //    if($client->default_language == $availableLanguage){
                           //       $selected = 'selected';
                           //    }
                           // }
                           ?>
                                <option value="<?php //echo $availableLanguage; ?>" <?php //echo $selected; ?>>
                                    <?php //echo ucfirst($availableLanguage); ?></option>
                                <?php //} ?>
                            </select>
                        </div>
                        <?php //} ?> -->
                    </div>

                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <?php //$value = (isset($client) ? _d($client->client_review_date) : _d(date('Y-m-d'))) ?>
                        <?php //echo render_date_input('client_review_date','client_review_date',$value);?>
                        <?php //echo render_date_input('client_review_date','Review Date',$value);?>

                        <div class="form-group contact-gender-option">
                            <label for="client_type"><?php //echo _l('document_client_type'); ?>Review Month</label>
                            <select class="selectpicker"
                                data-none-selected-text="<?php echo _l('system_default_string'); ?>" data-width="100%"
                                name="client_review_month" id="client_review_month">
                                <option value="">select </option>

                                <?php  foreach($review_month as $review_months){ ?>
                                <option value="<?php echo $review_months['id']; ?>"
                                    <?php if(isset($client) && $client->client_review_month == $review_months['id']) { echo 'selected'; } ?>>

                                    <?php  echo $review_months['month_name'];  ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <!-- <div class="col-md-6">
                        <div class="form-group contact-gender-option">
                            <label for="client_type"><?php //echo _l('document_client_type'); ?>Key Contact</label>
                            <select class="selectpicker"
                                data-none-selected-text="<?php echo _l('system_default_string'); ?>" data-width="100%"
                                name="contact_name" id="contact_name">
                                <option value="">select </option>

                                <?php  foreach($contacts as $contact){ ?>
                                <option value="<?php echo $contact['id']; ?>"
                                    <?php if(isset($client) && $client->contact_name == $contact['id']) { echo 'selected'; } ?>>

                                    <?php  echo $contact['firstname'] .' '. $contact['lastname'];  ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" value="<?php echo $client->userid; ?>" id="userid">
                    </div> -->   
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Key Contact Details</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <lable class="control-label">Name:</lable>
                                <span id="individual_name"><strong><?php echo $client->keycontact['firstname']." ".$client->keycontact['lastname'];
                                    if(!$client->keycontact['preferredname'] == ''){
                                        echo  " (".$client->keycontact['preferredname'].")";
                                    }
                                    ?></strong></span>
                                <input type="hidden" class="form-control" name="individual_name" id="individual_name"
                                    value="<?php if(isset($client)){ echo $client->keycontact['firstname']." ".$client->keycontact['lastname']; } ?>">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <lable class="control-label">Phone:</lable>
                                <span
                                    id="individual_phonenumber"><strong><?php echo $client->keycontact['phonenumber']; ?></strong></span>
                            </div>
                            <input type="hidden" class="form-control" name="individual_phonenumber"
                                id="individual_phonenumber"
                                value="<?php if(isset($client)){ echo $client->keycontact['phonenumber']; } ?>">
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <lable class="control-label">Email:</lable>
                                <span
                                    id="individual_email"><strong><?php echo $client->keycontact['email']; ?></strong></span>
                            </div>
                            <input type="hidden" class="form-control" name="individual_email" id="individual_email"
                                value="<?php if(isset($client)){ echo $client->keycontact['email']; } ?>">
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <lable class="control-label">Residential Address:</lable>
                                <span id="residential_address"><strong>
                                        <?php
                                if(!$client->keycontact['residential_address'] == '') {
                                echo "<br>".$client->keycontact['residential_address'].",<br>".
                                $client->keycontact['residential_state'].",<br>".
                                $client->keycontact['residential_city'].", ".
                                $client->keycontact['residential_zipcode'].",<br>".
                                $client->keycontact['residential_country'];
                                }
                                ?></strong></span>
                                <input type="hidden" class="form-control" name="individual_residential_address"
                                    id="individual_residential_address"
                                    value="<?php if(isset($client)){ echo $client->keycontact['residential_address'].",".$client->keycontact['residential_state'].",".$client->keycontact['residential_city'].",".$client->keycontact['residential_zipcode'].",".$client->keycontact['residential_country']; } ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <p><label class="control-label" for="addNote">Additional Notes</label></p>
                                <textarea class="form-control" id="addNote" name="addNote" rows="4"
                                    cols="50"><?php if(isset($client)){ echo $client->addNote; }; ?></textarea>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Internal Profile</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <lable class="control-label">Business:</lable>
                                <span id="residential_address"><?php echo $client->business;?></span>
                                <input type="hidden" class="form-control" name="business" id="business"
                                    value="<?php if(isset($client)){ echo $client->business; } ?>">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <lable class="control-label">Client Ownership:</lable>
                                <span id="postal_address"><?php echo $client->mtg_owned;?></span>
                                <input type="hidden" class="form-control" name="mtg_owned" id="MTG_owned"
                                    value="<?php if(isset($client)){ echo $client->mtg_owned; } ?>">
                            </div>
                        </div>
                    </div>
                </div>
                   

                <!-- <hr><br> -->
                <!-- <div class="row">
                    <div class="col-md-6">
                        <p style="font-size:13.5px;  font-weight: bold;">Key Contact Details</p>
                    </div>
                    <div class="col-md-6">
                        <p style="font-size:13.5px;  font-weight: bold;">Internal Profile</p>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-6">
                    <div class="row">
                    <div class="col-md-6">
                        <!-- <lable class="control-label lable_name_bold " style="font-weight: bold;">Name:</lable>
                        <span id="firstname"><?php if(isset($client)){ echo $client->individual_name; } ?></span>
                        <input type="hidden" class="form-control" name="individual_name" id="individual_firstname"
                        value="<?php if(isset($client)){ echo $client->individual_name; } ?> "> -->
                    </div>
                </div><br>
                <!-- <div class="row">
                    <div class="col-md-6">
                        <lable class="control-label" style="font-weight: bold;">Phone:</lable>
                        <span id="phonenumber"><?php echo $client->individual_phonenumber;?></span>
                        <input type="hidden" class="form-control" name="individual_phonenumber"
                        id="individual_phonenumber" value=" <?php if(isset($client)){ echo $client->individual_phonenumber; } ?> ">
                    </div>
                </div><br> -->
                <!-- <div class="row">
                    <div class="col-md-6">
                        <lable class="control-label" style="font-weight: bold;">Email:</lable>
                        <span id="email"><?php echo $client->individual_email;?></span>
                        <input type="hidden" class="form-control" name="individual_email" id="individual_email"
                        value="<?php if(isset($client)){ echo $client->individual_email; } ?>">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <lable class="control-label" style="font-weight: bold;">Residential Address:</lable>
                        <span id="residential_address"><?php echo $client->individual_residential_address;?></span>
                        <input type="hidden" class="form-control" name="individual_residential_address"
                        id="individual_residential_address" value="<?php if(isset($client)){ echo $client->individual_residential_address; } ?>">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <lable class="control-label" style="font-weight: bold;">Postal Address:</lable>
                        <span id="postal_address"><?php echo $client->individual_postal_address;?></span>
                        <input type="hidden" class="form-control" name="individual_postal_address"
                        id="individual_postal_address" value="<?php if(isset($client)){ echo $client->individual_postal_address; } ?>">
                    </div>
                </div> -->
                    </div>
                    <!-- business  mtg_owned -->

                <!-- <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <lable class="control-label" style="font-weight: bold;">Business:</lable>
                            <span id="residential_address"><?php echo $client->business;?></span>
                            <input type="hidden" class="form-control" name="business"
                            id="business" value="<?php if(isset($client)){ echo $client->business; } ?>">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <lable class="control-label" style="font-weight: bold;">Client Ownership:</lable>
                            <span id="postal_address"><?php echo $client->mtg_owned;?></span>
                            <input type="hidden" class="form-control" name="mtg_owned"
                            id="MTG_owned" value="<?php if(isset($client)){ echo $client->mtg_owned; } ?>">
                        </div>
                    </div>
                   
                </div> -->
            </div>
                



                <!-- ----------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- onkeypress='clsAlphaNoOnly(event)' onpaste='return false' -->

            <!-- <div class="row">
                <div class="col-md-6">
                    <?php //$value=( isset($client) ? $client->key_contact_name : ''); ?>
                    <?php //echo render_input( 'key_contact_name', 'key_contact_name',$value); ?>


                </div>

                <div class="col-md-6">
                    <?php //$value=( isset($client) ? $client->phonenumber : ''); ?>
                    <?php //echo render_input( 'phonenumber', 'client_phonenumber',$value); ?>
                    <label for="client"><?php //echo _l('client_phonenumber'); ?></label>
                    <input class="form-control" type="text" id="phonenumber" name="phonenumber"
                        onkeypress='clsAlphaNoOnly(event)' onpaste='return false'
                        value="<?php //if(isset($client)){ echo $client->phonenumber; } ?>">
                </div>
            </div>

                <div class="row">
                    <div class="col-md-6">
                        <?php //$value=( isset($client) ? $client->key_contact_email : ''); ?>
                        <?php //echo render_input( 'key_contact_email', 'key_contact_email',$value,); ?>
                    </div>
                    <div class="col-md-6">
                        <?php //$value=( isset($client) ? $client->key_contact_phone : ''); ?>
                        <?php //echo render_input( 'key_contact_phone', 'Alternative Contact Details  ',$value); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?php //if((isset($client) && empty($client->website)) || !isset($client)){
                           //$value=( isset($client) ? $client->website : '');
                            //echo render_input( 'website', 'client_website',$value);
                           // } else { ?>
                        <div class="form-group">
                            <label for="website"><?php //echo _l('client_website'); ?></label>
                            <div class="input-group">
                                <input type="text" name="website" id="website" value="<?php //echo $client->website; ?>"
                                    class="form-control">
                                <div class="input-group-addon">
                                    <span><a href="<?php //echo maybe_add_http($client->website); ?>" target="_blank"
                                            tabindex="-1"><i class="fa fa-globe"></i></a></span>
                                </div>
                            </div>
                        </div>
                        <?php //} ?>
                    </div>
                </div>


                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p style="font-size:13.5px;  font-weight: bold;">Address Details</p>
                    </div>
                    <div class="col-md-6">
                        <div class="onoffswitch">
                            <input type="checkbox" id="checkBox" onclick="autoFillAddress()"
                                class="onoffswitch-checkbox" <?php// if(!empty($client)) { echo 'checked';} ?>>
                            <label class="onoffswitch-label" for="checkBox"></label>
                        </div>

                        <input type="hidden" id="test" value="<?php //echo($client->id); ?>">
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group contact-gender-option">
                                    <?php //$value = (isset($client) ? $client->address : ''); ?>
                                    <?php// echo render_input('address','client_address',$value); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php// $value=( isset($client) ? $client->state : ''); ?>
                                    <?php //echo render_input( 'state', 'Suburb',$value); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php //$value=( isset($client) ? $client->city : ''); ?>
                                    <?php //echo render_input( 'city', 'client_city',$value); ?>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php// $value=( isset($client) ? $client->zip : ''); ?>
                                    <?php //echo render_input( 'zip', 'Post Code',$value); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php //$countries= get_all_countries();
                                        //$customer_default_country = get_option('customer_default_country');
                                        //$selected =( isset($client) ? $client->country : $customer_default_country);
                                        //echo render_select( 'country',$countries,array( 'country_id',array( 'short_name')), 'clients_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex')));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group contact-gender-option">
                                    <?php //$value = (isset($client) ? $client->client_postal_address : ''); ?>
                                    <?php //echo render_input('client_postal_address','document_postal',$value); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php //$id='ParFirstAddr'; $value=( isset($client) ? $client->client_postal_state : ''); ?>
                                    <?php //echo render_input( 'client_postal_state', 'Suburb',$value); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php //$value=( isset($client) ? $client->client_postal_city : ''); ?>
                                    <?php //echo render_input( 'client_postal_city', 'city_name',$value); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php //$value=( isset($client) ? $client->client_postal_zip_code : ''); ?>
                                    <?php //echo render_input( 'client_postal_zip_code', 'Post Code',$value); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php //$countries= get_all_countries();
                                        //$customer_default_country = get_option('customer_default_country');
                                        //$selected =( isset($client) ? $client->country : $customer_default_country);
                                        //echo render_select( 'client_postal_country',$countries,array( 'country_id',array( 'short_name')), 'clients_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex')));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- ----------------------------------------------------------------------------------------------------------------------------------- -->


            </div>


            <?php if(isset($client)){ ?>
            <div role="tabpanel" class="tab-pane" id="customer_admins">
                <?php if (has_permission('customers', '', 'create') || has_permission('customers', '', 'edit')) { ?>
                <a href="#" data-toggle="modal" data-target="#customer_admins_assign"
                    class="btn btn-info mbot30"><?php echo _l('assign_admin'); ?></a>
                <?php } ?>
                <table class="table dt-table">
                    <thead>
                        <tr>
                            <th><?php echo _l('staff_member'); ?></th>
                            <th><?php echo _l('customer_admin_date_assigned'); ?></th>
                            <?php if(has_permission('customers','','create') || has_permission('customers','','edit')){ ?>
                            <th><?php echo _l('options'); ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($customer_admins as $c_admin){ ?>
                        <tr>
                            <td><a href="<?php echo admin_url('profile/'.$c_admin['staff_id']); ?>">
                                    <?php echo staff_profile_image($c_admin['staff_id'], array(
                           'staff-profile-image-small',
                           'mright5'
                           ));
                           echo get_staff_full_name($c_admin['staff_id']); ?></a>
                            </td>
                            <td data-order="<?php echo $c_admin['date_assigned']; ?>">
                                <?php echo _dt($c_admin['date_assigned']); ?></td>
                            <?php if(has_permission('customers','','create') || has_permission('customers','','edit')){ ?>
                            <td>
                                <a href="<?php echo admin_url('clients/delete_customer_admin/'.$client->userid.'/'.$c_admin['staff_id']); ?>"
                                    class="btn btn-danger _delete btn-icon"><i class="fa fa-remove"></i></a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>

            <div role="tabpanel" class="tab-pane client_type" id="A">
                <?php //echo form_open(admin_url('clients/clientt')); ?>
                <div class="row">
                    <!-- <div class="col-md-6">
                        <div class="form-group contact-gender-option">
                            <label for="client_type"><?php echo _l('document_client_type'); ?></label>
                            <select class="selectpicker"
                                data-none-selected-text="<?php echo _l('system_default_string'); ?>" data-width="100%"
                                name="client_type" >
                                <option value=""
                                    <?php if(isset($client) && empty($client->client_type)){echo 'selected';} ?>>
                                </option>
                                <option value="1"
                                    <?php if(isset($client) && $client->client_type == '1'){echo 'selected';} ?>>
                                    Business</option>

                                <option value="2"
                                    <?php if(isset($client) && $client->client_type == '2'){echo 'selected';} ?>>
                                    Personal</option>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>


            <div role="tabpanel" class="tab-pane" id="B">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                     $selected = array();
                     if(isset($customer_groups)){
                       foreach($customer_groups as $group){
                          array_push($selected,$group['groupid']);
                       }
                     }
                     if(is_admin() || get_option('staff_members_create_inline_customer_groups') == '1'){
                      echo render_select_with_input_group('groups_in[]',$groups,array('id','name'),'customer_groups',$selected,'<a href="#" data-toggle="modal" data-target="#customer_group_modal"><i class="fa fa-plus"></i></a>',array('multiple'=>true,'data-actions-box'=>true),array(),'','',false);
                      } else {
                        echo render_select('groups_in[]',$groups,array('id','name'),'customer_groups',$selected,array('multiple'=>true,'data-actions-box'=>true),array(),'','',false);
                      }
                     ?>
                    </div>
                </div>
                <!-- <a href="#" data-toggle="modal" data-target="#group"
                    class="btn btn-info mbot30"><?php //echo _l('assign_admin'); ?>Group</a> -->
            </div>
            <!-- sp internal profile start -->
            <div role="tabpanel" class="tab-pane" id="internal_profile">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group contact-gender-option">
                            <label for="business">Business</label>
                            <input type="text" name="business" id="business_id" class="form-control" value="<?php if(isset($client)){ echo $client->business; } ?>">
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="form-group contact-gender-option">
                            <label for="MTG_owned">Client Ownership</label>
                            <input type="text" name="mtg_owned" id="MTG_owned" class="form-control" value="<?php if(isset($client)){ echo $client->mtg_owned; } ?>">
                        </div>
                    </div>

                </div>
                <?php $id = get_staff_user_id();
                if (is_admin() || $id == '1' || $id == '13' || $id == '23' || $id == '26' || $id == '32' || $id == '39' || $id == '76' || $id == '98'){
                ?>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group contact-gender-option">
                            <label for="file_archive">File Archive</label>
                            <input type="text" name="file_archive" id="file_archive" class="form-control"
                                value="<?php if(isset($client)){ echo $client->file_archive; } ?>">
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- sp internal profile end -->

            <!-- <div role="tabpanel" class="tab-pane" id="billing_and_shipping">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="no-mtop"><?php //echo _l('billing_address'); ?> <a href="#"
                                        class="pull-right billing-same-as-customer"><small
                                            class="font-medium-xs"><?php //echo _l('customer_billing_same_as_profile'); ?></small></a>
                                </h4>
                                <hr />
                                <?php $value=( isset($client) ? $client->billing_street : ''); ?>
                                <?php echo render_textarea( 'billing_street', 'billing_street',$value); ?>
                                <?php $value=( isset($client) ? $client->billing_city : ''); ?>
                                <?php echo render_input( 'billing_city', 'billing_city',$value); ?>
                                <?php $value=( isset($client) ? $client->billing_state : ''); ?>
                                <?php echo render_input( 'billing_state', 'billing_state',$value); ?>
                                <?php $value=( isset($client) ? $client->billing_zip : ''); ?>
                                <?php echo render_input( 'billing_zip', 'billing_zip',$value); ?>
                                <?php $selected=( isset($client) ? $client->billing_country : '' ); ?>
                                <?php echo render_select( 'billing_country',$countries,array( 'country_id',array( 'short_name')), 'billing_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                            </div>
                            <div class="col-md-6">
                                <h4 class="no-mtop">
                                    <i class="fa fa-question-circle" data-toggle="tooltip"
                                        data-title="<?php //echo _l('customer_shipping_address_notice'); ?>"></i>
                                    <?php //echo _l('shipping_address'); ?> <a href="#"
                                        class="pull-right customer-copy-billing-address"><small
                                            class="font-medium-xs"><?php //echo _l('customer_billing_copy'); ?></small></a>
                                </h4>
                                <hr />
                                <?php $value=( isset($client) ? $client->shipping_street : ''); ?>
                                <?php echo render_textarea( 'shipping_street', 'shipping_street',$value); ?>
                                <?php $value=( isset($client) ? $client->shipping_city : ''); ?>
                                <?php echo render_input( 'shipping_city', 'shipping_city',$value); ?>
                                <?php $value=( isset($client) ? $client->shipping_state : ''); ?>
                                <?php echo render_input( 'shipping_state', 'shipping_state',$value); ?>
                                <?php $value=( isset($client) ? $client->shipping_zip : ''); ?>
                                <?php echo render_input( 'shipping_zip', 'shipping_zip',$value); ?>
                                <?php $selected=( isset($client) ? $client->shipping_country : '' ); ?>
                                <?php echo render_select( 'shipping_country',$countries,array( 'country_id',array( 'short_name')), 'shipping_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                            </div>
                            <?php //if(isset($client) &&
                        //(total_rows(db_prefix().'invoices',array('clientid'=>$client->userid)) > 0 || total_rows(db_prefix().'estimates',array('clientid'=>$client->userid)) > 0 || total_rows(db_prefix().'creditnotes',array('clientid'=>$client->userid)) > 0)){ ?>
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <div class="checkbox checkbox-default">
                                        <input type="checkbox" name="update_all_other_transactions"
                                            id="update_all_other_transactions">
                                        <label for="update_all_other_transactions">
                                            <?php //echo _l('customer_update_address_info_on_invoices'); ?><br />
                                        </label>
                                    </div>
                                    <b><?php //echo _l('customer_update_address_info_on_invoices_help'); ?></b>
                                    <div class="checkbox checkbox-default">
                                        <input type="checkbox" name="update_credit_notes" id="update_credit_notes">
                                        <label for="update_credit_notes">
                                            <?php //echo _l('customer_profile_update_credit_notes'); ?><br />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php //} ?>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<?php if(isset($client)){ ?>
<?php if (has_permission('customers', '', 'create') || has_permission('customers', '', 'edit')) { ?>
<div class="modal fade" id="customer_admins_assign" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open(admin_url('clients/assign_admins/'.$client->userid)); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo _l('assign_admin'); ?></h4>
            </div>

            <div class="modal-body">
                <?php
               $selected = array();
               foreach($customer_admins as $c_admin){
                  array_push($selected,$c_admin['staff_id']);
               }
               //put this in below line foe multiselect adviser [,array('multiple'=>true)]
               echo render_select('customer_admins[]',$staff,array('staffid',array('firstname','lastname')),'',$selected,array('multiple'=>true),array(),'','',false); ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
        </div>
        <!-- /.modal-content -->
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>
<?php } ?>
<?php $this->load->view('admin/clients/client_group'); ?>




<!-- <div class="modal fade" id="group" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <?php //echo form_open(admin_url('clients/assign_admins/'.$client->userid)); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php //echo _l('Add Group'); ?></h4>
            </div>
            <div class="modal-body">
                <?php
                    // $selected = array();
                    // if(isset($customer_groups)){
                    // foreach($customer_groups as $group){
                    //     array_push($selected,$group['groupid']);
                    // }
                    // }
                    // if(is_admin() || get_option('staff_members_create_inline_customer_groups') == '1'){
                    // echo render_select_with_input_group('groups_in[]',$groups,array('id','name'),'customer_groups',$selected,'<a href="#" data-toggle="modal" data-target="#customer_group_modal"><i class="fa fa-plus"></i></a>',array('multiple'=>true,'data-actions-box'=>true),array(),'','',false);
                    // } else {
                    // echo render_select('groups_in[]',$groups,array('id','name'),'customer_groups',$selected,array('multiple'=>true,'data-actions-box'=>true),array(),'','',false);
                    // }
                ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php //echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php //echo _l('submit'); ?></button>
            </div>
        </div>
         /.modal-content -->
<?php //echo form_close(); ?>
<!-- </div> -->
<!-- /.modal-dialog -->
<!-- </div>  -->

<script>
function clsAlphaNoOnly(e) { // Accept only alpha numerics, no special characters 
    var regex = new RegExp("^[0-9 ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
}
// function clsAlphaNoOnly2 () {  // Accept only alpha numerics, no special characters 
//     return clsAlphaNoOnly (this.event); // window.event
// }
</script>
