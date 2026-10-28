<style>
.onoffswitch-checkbox:checked+.red_btn {
    background-color: red !important;
    border-color: red !important;
}

.onoffswitch-checkbox:checked+.onoffswitch-label .red_btn,
.onoffswitch-checkbox:checked+.onoffswitch-label.red_btn:before {
    border-color: red !important;
}
.d-none {
    display:none;
}
</style>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<!-- Modal Contact -->
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" id="centerMpdel">
        <div class="modal-content" id="contentmodal">
            <?php echo form_open(admin_url('clients/form_contact/'. $customer_id . ($contactid ? '/'.$contactid : '')),array('id'=>'contact-form','autocomplete'=>'off')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                        <div class="row">
                    <div class="col-md-4">
                        <h3 class="modal-title text_color" id="myModalLabel">
                            <?php //echo $title; ?> <span> Add New Individual
                            </span><br />
                            <span id="userId" class="d-none"><?php echo  $customer_id ?> </span>
                            <h5 class="text_color" id=""><?php echo get_company_name($customer_id,true); ?></h5>
                        </h3>
                    </div>
                    <div class="col-md-4 text_color">
                        <div class="row mtop45">
                            <div class="col-md-6 mtop30"><span>Contact Key</span></div>
                            <div class="col-md-6 mtop30">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="contact_key" id="contact_key" data-perm-id="3"
                                        class="onoffswitch-checkbox"
                                        <?php if(isset($contact) && $contact->contact_key == '1'){echo 'checked';} ?>
                                        value="<?php echo(isset($contact) ? $contact->contact_key : ''); ?>">
                                    <label class="onoffswitch-label" for="contact_key"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mtop25 text_color">
                        <div class="row">
                            <div class="col-md-6"><span>Business</span></div>
                            <div class="col-md-6">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="business" id="business" data-perm-id="3"
                                        class="onoffswitch-checkbox"
                                        <?php if(isset($contact) && $contact->business == '1'){echo 'checked';} ?>
                                        value="<?php echo(isset($contact) ? $contact->business : ''); ?>">
                                    <label class="onoffswitch-label" for="business"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><span>Dependents</span></div>
                            <div class="col-md-6">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="dependent" id="dependent" data-perm-id="3"
                                        class="onoffswitch-checkbox"
                                        <?php if(isset($contact) && $contact->dependent == '1'){echo 'checked';} ?>
                                        value="<?php echo(isset($contact) ? $contact->dependent : ''); ?>">
                                    <label class="onoffswitch-label" for="dependent"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><span>Deceased</span></div>
                            <div class="col-md-6">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="deceased" id="deceased" data-perm-id="3"
                                        class="onoffswitch-checkbox"
                                        <?php if(isset($contact) && $contact->deceased == '1'){echo 'checked';} ?>
                                        value="<?php echo(isset($contact) ? $contact->deceased : ''); ?>">
                                    <label class="onoffswitch-label red_btn" for="deceased"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span style="margin-left: 272px;" id="msg"></span>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <?php //if(isset($contact)){ ?>
                        <img src="<?php //echo contact_profile_image_url($contact->id,'thumb'); ?>" id="contact-img"
                            class="client-profile-image-thumb">
                            <?php //if(!empty($contact->profile_image)){ ?>
                        <a href="#" onclick="delete_contact_profile_image(<?php //echo $contact->id; ?>); return false;"
                            class="text-danger pull-right" id="contact-remove-img"><i class="fa fa-remove"></i></a>
                        <?php //} ?>
                        <hr />
                        <?php //} ?>
                        <div id="contact-profile-image"
                            class="form-group<?php //if(isset($contact) && !empty($contact->profile_image)){echo ' hide';} ?>">
                            <label for="profile_image"
                                class="profile-image"><?php //echo _l('client_profile_image'); ?></label>
                            <input type="file" name="profile_image" class="form-control" id="profile_image">
                        </div>
                        <?php //if(isset($contact)){ ?>
                        <div class="alert alert-warning hide" role="alert" id="contact_proposal_warning">
                            <?php //echo _l('proposal_warning_email_change',array(_l('contact_lowercase'),_l('contact_lowercase'),_l('contact_lowercase'))); ?>
                            <hr />
                            <a href="#" id="contact_update_proposals_emails" data-original-email=""
                                onclick="update_all_proposal_emails_linked_to_contact(<?php //echo $contact->id; ?>); return false;"><?php //echo _l('update_proposal_email_yes'); ?></a>
                            <br />
                            <a href="#"
                                onclick="close_modal_manually('#contact'); return false;"><?php //echo _l('update_proposal_email_no'); ?></a>
                        </div>
                        <?php //} ?> -->
                        <!-- // For email exist check -->
                        <?php echo form_hidden('contactid',$contactid); ?>
                        <?php $value=( isset($contact) ? $contact->firstname : ''); ?>
                        <?php echo render_input( 'firstname', 'client_firstname',$value); ?>
                        <span id="msg"></span>
 
                    </div>
                    <div class="col-md-6">
                        <?php $value=( isset($contact) ? $contact->lastname : ''); ?>
                        <?php echo render_input( 'lastname', 'client_lastname',$value); ?>
                        <span id="msg_lastname"></span>
                        <!-- <input type="hidden" id="age" name="age"
                            value="<?php //if(isset($contact)){ echo $contact->age;}; ?>"> -->
                    </div>
                </div>
                <?php// echo date("Y-m-d"); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php $value=( isset($contact) ? $contact->preferredname : ''); ?>
                        <?php echo render_input( 'preferredname', 'Preferred Name',$value); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group contact-gender-option">
                            <?php //$value = (isset($contact) ? _d($contact->dob) : _d(date('Y-m-d'))) ?>
                            <?php //echo render_date_input('dob','date_birth',$value); ?>

                            <!-- <span class="text-danger">*</span><label

                             for="gender"><?php echo _l('Date Of Birth'); ?></label>

                            <input id="dob" name="dob" class="form-control" type="date"

                            value="<?php if(isset($contact)){ echo ($contact->dob); }?>"
                            minn="1900-01-01" max="<?php echo date("Y-m-d"); ?>" required/>

                            <span id="alertDate"></span> -->
                            
                            <span class="text-danger">*</span><label
                                for="gender"><?php echo _l('Date Of Birth'); ?></label>
                            <input id="dob" class="form-control" name="dob" type="date" minn="1900-01-01" maxx="<?php echo date("Y-m-d"); ?>" value="<?php if(isset($contact)){ echo ($contact->dob); }?>" required/>
                            <!-- <span id="msg_dob"></span> -->
                            <span id="alertDate"></span> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group contact-gender-option">
                            <span class="text-danger">*</span><label
                                for="gender"><?php echo _l('document_gender'); ?></label>
                            <select class="selectpicker"
                                data-none-selected-text="<?php echo _l('system_default_string'); ?>" data-width="100%"
                                name="gender" id="gender" required>
                                <option value=""
                                    <?php if(isset($contact) && empty($contact->gender)){echo 'selected';} ?>></option>
                                <option value="1"
                                    <?php if(isset($contact) && $contact->gender == '1'){echo 'selected';} ?>>Male
                                </option>
                                <option value="2"
                                    <?php if(isset($contact) && $contact->gender == '2'){echo 'selected';} ?>>Female
                                </option>
                                <option value="3"
                                    <?php if(isset($contact) && $contact->gender == '3'){echo 'selected';} ?>>Other
                                </option>
                                <option value="4"
                                    <?php if(isset($contact) && $contact->gender == '4'){echo 'selected';} ?>>Unknown
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" id="occupationField">
                        <!-- <div class="form-group contact-gender-option">
                            <span class="text-danger">*</span><label
                                for="client_type"><?php //echo _l('document_client_type'); ?></label>
                            <select class="selectpicker"
                                data-none-selected-text="<?php //echo _l('system_default_string'); ?>" data-width="100%"
                                name="client_type" id="client_type" required>
                                <option value=""
                                    <?php //if(isset($contact) && empty($contact->client_type)){echo 'selected';} ?>>
                                </option>
                                <option value="1"
                                    <?php //if(isset($contact) && $contact->client_type == '1'){echo 'selected';} ?>>
                                    Business</option>

                                <option value="2"
                                    <?php //if(isset($contact) && $contact->client_type == '2'){echo 'selected';} ?>>
                                    Personal</option>
                            </select>
                        </div> -->
                
                        <?php $value=( isset($contact) ? $contact->custom_occupation : ''); ?>
                        <?php echo render_input( 'custom_occupation', 'Occupation',$value); ?>

                    </div>

                    <div class="col-md-6"  id="occupationClass">
                    <div class="form-group contact-gender-option">
                            <label for="occupation"><?php //echo _l('document_client_type'); ?>Occupation Class</label>
                            <select class="selectpicker"
                                data-none-selected-text="<?php echo _l('system_default_string'); ?>" data-width="100%"
                                name="occupation" id="occupation" required>
                                <option value="" id="select">select
                                </option>
                                <?php foreach($data as $occupation){
                                 ?>
                                <option value="<?php echo $occupation['id'] .','. $occupation['occupation']; ?>"
                                    <?php if(isset($contact) && $contact->occupation == $occupation['id']){ echo 'selected';} ?>>
                                    <?php echo $occupation['occupation']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mtop10 border-right">
                            <span><?php //echo _l('contract'); ?>Email Receiver</span>
                        </div>
                        <div class="col-md-6 mtop10">
                            <div class="onoffswitch">
                                <input type="checkbox" id="contract_emails" data-perm-id="3"
                                    class="onoffswitch-checkbox "
                                    <?php if(isset($contact) && $contact->contract_emails == '1'){echo 'checked';} ?>
                                    value="<?php echo  $contact->contract_emails ?>" name="contract_emails">
                                <label class="onoffswitch-label" for="contract_emails" id="label_email"></label>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group contact-gender-option">
                            <label for="smoker"><?php //echo _l('document_client_type'); ?>Smoker</label>
                            <select class="selectpicker"
                                data-none-selected-text="<?php echo _l('system_default_string'); ?>" data-width="100%"
                                name="smoker" id="smoker" required>
                                <option value="">select</option>
                                <?php foreach($smokerdata as $smoker){
                                 ?>
                                <option value="<?php echo $smoker['id']; ?>"
                                    <?php if(isset($contact) && $contact->smoker == $smoker['id']){ echo 'selected';} ?>>
                                    <?php echo $smoker['smoker']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <!-- <div class="col-md-6">
                                <label for="vulnerable_client"><?php //echo _l('Primary Contact'); ?></label>
                            </div>
                            <div class="col-md-6">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="is_primary" id="contact_primary"
                                        class="onoffswitch-checkbox"
                                        <?php //if((!isset($contact) && total_rows(db_prefix().'contacts',array('is_primary'=>1,'userid'=>$customer_id)) == 0) || (isset($contact) && $contact->is_primary == 1)){echo 'checked';}; ?>
                                        <?php// if((isset($contact) && total_rows(db_prefix().'contacts',array('is_primary'=>1,'userid'=>$customer_id)) == 1 && $contact->is_primary == 1)){echo '';} ?>>
                                    <label class="onoffswitch-label " for="contact_primary"></label>
                                    </label>
                                </div>
                            </div> -->
                        
                        </div>
                       
                    </div>
                    <div class="col-md-6">
                       
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group contact-gender-option">
                                    <?php $value = (isset($contact) ? $contact->additional_note : ''); ?>
                                    <?php echo render_textarea('additional_note','contact_additional_note',$value); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label
                                            for="vulnerable_client"><?php echo _l('Vulnerable'); ?></label>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="onoffswitch">
                                            <input type="checkbox" id="checkBox_vulnerable" name="" value=""
                                                onclick="openVulnerableNote()" class="onoffswitch-checkbox"
                                                <?php  if(isset($contact) && $contact->checkBox_vulnerable == 1) { echo 'checked' ; $style = "display:block";} elseif($contact->checkBox_vulnerable == 0){ $style = "display:none";} ?>>
                                            <label class="onoffswitch-label red_btn" for="checkBox_vulnerable"></label>
                                        </div>

                                        <input type="hidden" id="checkvalue" name="checkBox_vulnerable"
                                            value="<?php if(isset($contact) && $contact->checkBox_vulnerable == 1){ echo 1 ;} ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php $vuldata = unserialize($contact->vulnerable_client);?>
                                        <div class="form-group contact-gender-option vulnerableClient"
                                            style='<?= $style ?>'>
                                            <!-- <span class="req text-danger">*</span>--> <label
                                                for="vulnerable_client"><?php echo _l('vulnerable_drivers'); ?></label>
                                            <select class="selectpicker"
                                                data-none-selected-text="<?php echo _l('system_default_string'); ?>"
                                                data-width="100%" name="vulnerable_client[]" id="vulnerable_client"
                                                multiple data-live-search="true">
                                                <option value="">select </option>
                                                <?php foreach($vulnerableClient as $vulnerableClients){ ?> <option
                                                    value="<?php echo $vulnerableClients['id'];  ?>"
                                                    <?php if(isset($contact) && in_array($vulnerableClients['id'] , $vuldata)) { echo 'selected'; } ?>>
                                                    <?php echo $vulnerableClients['vulnerabledrivers']; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group contact-gender-option">
                                            <div style='<?= $style ?>' class="vulnerableClient">
                                                <lable>Vulnerable Note</lable></br>
                                                <textarea type="textarea" id="vulnerable_note" rows="4" cols="50"
                                                    name="vulnerable_note" class="form-control "
                                                    value=""><?php if(isset($contact)){ echo $contact->vulnerable_note; } ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <hr class="hr">
               <div id="contact_details">
                <div class="row">
                    <div class="col-md-12">
                        <p style="font-size:13.5px;  font-weight: bold;"><?php echo _l('Contact Details'); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php $value=( isset($contact) ? $contact->email : ''); ?>
                        <?php echo render_input( 'email', 'client_email',$value, 'email'); ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                                // if(!isset($contact)) {
                                //     $value = $calling_code ?: '';
                                // } else {
                                //     $value = empty($contact->phonenumber) ? $calling_code : $contact->phonenumber;
                                // }
                            ?>
                        <?php //echo render_input( 'phonenumber', 'client_phonenumber',$value,'text',array('autocomplete'=>'off')); ?>
                        <label for="client"><?php echo _l('client_phonenumber'); ?></label>
                        <input class="form-control" type="text" id="phonenumber" name="phonenumber" onkeypress='clsAlphaNoOnly(event)' onpaste='return false' value="<?php if(isset($contact)){ echo $contact->phonenumber; } ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                                // if(!isset($contact)) {
                                //     $value = $calling_code ?: '';
                                // } else {
                                //     $value = empty($contact->homephone) ? $calling_code : $contact->homephone;
                                // }
                            ?>
                        <?php //echo render_input( 'homephone', 'client_homephone',$value,'text',array('autocomplete'=>'off')); ?>

                        <label for="client"><?php echo _l('Home Phone'); ?></label>
                        <input class="form-control" type="text" id="homephone" name="homephone" onkeypress='clsAlphaNoOnly(event)' onpaste='return false' value="<?php if(isset($contact)){ echo $contact->homephone; } ?>">
                    
                    </div>
                    <div class="col-md-6">
                        <?php $value=( isset($contact) ? $contact->title : ''); ?>
                        <?php echo render_input( 'title', 'contact_position',$value); ?>

                    </div>
                </div>
                                </div>
                <hr class="hr">

                <div id="address_details">

                <div class="row">
                    <div class="col-md-6">
                        <p style="font-size:13.5px;  font-weight: bold;"><?php echo _l('Address Details'); ?></p>
                    </div>
                    <div class="col-md-3">
                        <div class="onoffswitch">
                            <input type="checkbox" id="checkBox" onclick="autoFilAddress()" class="onoffswitch-checkbox"
                                <?php if(!empty($contact)) { echo 'checked';} ?>>
                            <label class="onoffswitch-label" for="checkBox"></label>
                        </div>

                        <input type="hidden" id="test" value="<?php echo($contact->id); ?>">
                    </div>
                    <div class="col-md-3">
                            <label for="contactKeyAddress">Copy Key Contact Address</label>
                            <input type="checkbox" id="contactKeyAddress" name="contactkey_address"
                                    <?php if(isset($contact) && $contact->contactkey_address == '1'){echo 'checked';} ?>>
                        </div>
                </div>

                <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="search_address">Search Address</label>
            <input type="text"
                   id="search_address"
                   name="search_address"
                   class="form-control"
                   placeholder="Search Address">
        </div>
    </div>
</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group contact-gender-option">
                            <?php $value = (isset($contact) ? $contact->residential_address : ''); ?>
                            <?php echo render_input('residential_address','document_residential',$value); ?>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php $value=( isset($contact) ? $contact->residential_state : ''); ?>
                                    <?php echo render_input( 'residential_state', 'Suburb',$value); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php $value=( isset($contact) ? $contact->residential_city : ''); ?>
                                    <?php echo render_input( 'residential_city', 'city_name',$value); ?>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option" id="pAddressLine1">
                                    <?php $value=( isset($contact) ? $contact->residential_zipcode : ''); ?>
                                    <?php echo render_input( 'residential_zipcode', 'Post Code',$value); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- <div class="form-group contact-gender-option">
                                    <?php //$countries = get_all_countries(); ?>
                                    <?php //$selected = (isset($contact) ? $contact->residential_country : ''); ?>
                                    <?php //echo render_select('residential_country',$countries,array('country_id',array('short_name'),'iso2'),'billing_country',$selected); ?>
                                </div> -->
                                    <div class="form-group contact-gender-option">
                                <?php $countries= get_all_countries();
                                        $customer_default_country = get_option('customer_default_country');
                                        $selected =( isset($contact) ? $contact->residential_country : $customer_default_country);
                                        echo render_select( 'residential_country',$countries,array( 'country_id',array( 'short_name')), 'clients_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex')));
                                    ?>
                                     </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group contact-gender-option">
                            <?php $value = (isset($contact) ? $contact->postal_address : ''); ?>
                            <?php echo render_input('postal_address','document_postal',$value); ?>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php $id='ParFirstAddr'; $value=( isset($contact) ? $contact->postal_state : ''); ?>
                                    <?php echo render_input( 'postal_state', 'Suburb',$value); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php $value=( isset($contact) ? $contact->postal_city : ''); ?>
                                    <?php echo render_input( 'postal_city', 'city_name',$value); ?>
                                </div>
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group contact-gender-option">
                                    <?php $value=( isset($contact) ? $contact->postal_zipcode : ''); ?>
                                    <?php echo render_input( 'postal_zipcode', 'Post Code',$value); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- <div class="form-group contact-gender-option"> -->
                                    <?php //$countries = get_all_countries(); ?>
                                    <?php //$selected = (isset($contact) ? $contact->postal_country : ''); ?>
                                    <?php //echo render_select('postal_country',$countries,array('country_id',array('short_name'),'iso2'),'billing_country',$selected); ?>
                                <!-- </div> -->
                                <div class="form-group contact-gender-option">
                                <?php $countries= get_all_countries();
                                        $customer_default_country = get_option('customer_default_country');
                                        $selected =( isset($contact) ? $contact->postal_country : $customer_default_country);
                                        echo render_select( 'postal_country',$countries,array( 'country_id',array( 'short_name')), 'clients_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex')));
                                    ?>
                                     </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <hr> -->
                <div class="row">
                </div>
                <div class="col-md-6">
                        <!-- <p class="bold">
                            <?php echo _l('email_notifications'); ?><?php if(is_sms_trigger_active()){echo '/SMS';} ?>
                        </p> -->
                        <div id="contact_email_notifications">
                            <!-- <div class="col-md-6 row">
                                <div class="row">
                                    <div class="col-md-6 mtop10 border-right">
                                        <span><?php echo _l('invoice'); ?></span>
                                    </div>
                                    <div class="col-md-6 mtop10">
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="invoice_emails" data-perm-id="1"
                                                class="onoffswitch-checkbox"
                                                <?php if(isset($contact) && $contact->invoice_emails == '1'){echo 'checked';} ?>
                                                value="invoice_emails" name="invoice_emails">
                                            <label class="onoffswitch-label" for="invoice_emails"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <div class="row">
                                    <div class="col-md-6 mtop10 border-right">
                                        <span><?php echo _l('estimate'); ?></span>
                                    </div>
                                    <div class="col-md-6 mtop10">
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="estimate_emails" data-perm-id="2"
                                                class="onoffswitch-checkbox"
                                                <?php if(isset($contact) && $contact->estimate_emails == '1'){echo 'checked';} ?>
                                                value="estimate_emails" name="estimate_emails">
                                            <label class="onoffswitch-label" for="estimate_emails"></label>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6 row">
                                <div class="row">
                                    <div class="col-md-6 mtop10 border-right">
                                        <span><?php echo _l('credit_note'); ?></span>
                                    </div>
                                    <div class="col-md-6 mtop10">
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="credit_note_emails" data-perm-id="1"
                                                class="onoffswitch-checkbox"
                                                <?php if(isset($contact) && $contact->credit_note_emails == '1'){echo 'checked';} ?>
                                                value="credit_note_emails" name="credit_note_emails">
                                            <label class="onoffswitch-label" for="credit_note_emails"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <div class="row">
                                    <div class="col-md-6 mtop10 border-right">
                                        <span><?php echo _l('project'); ?></span>
                                    </div>
                                    <div class="col-md-6 mtop10">
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="project_emails" data-perm-id="6"
                                                class="onoffswitch-checkbox"
                                                <?php if(isset($contact) && $contact->project_emails == '1'){echo 'checked';} ?>
                                                value="project_emails" name="project_emails">
                                            <label class="onoffswitch-label" for="project_emails"></label>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6 row"> -->
                                <!-- <div class="row">
                                    <div class="col-md-6 mtop10 border-right">
                                        <span><?php echo _l('tickets'); ?></span>
                                    </div>
                                    <div class="col-md-6 mtop10">
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="ticket_emails" data-perm-id="5"
                                                class="onoffswitch-checkbox"
                                                <?php if(isset($contact) && $contact->ticket_emails == '1'){echo 'checked';} ?>
                                                value="ticket_emails" name="ticket_emails">
                                            <label class="onoffswitch-label" for="ticket_emails"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mtop10 border-right">
                                        <span><i class="fa fa-question-circle" data-toggle="tooltip"
                                                data-title="<?php echo _l('only_project_tasks'); ?>"></i>
                                            <?php echo _l('task'); ?></span>
                                    </div>
                                    <div class="col-md-6 mtop10">
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="task_emails" data-perm-id="6"
                                                class="onoffswitch-checkbox"
                                                <?php if(isset($contact) && $contact->task_emails == '1'){echo 'checked';} ?>
                                                value="task_emails" name="task_emails">
                                            <label class="onoffswitch-label" for="task_emails"></label>
                                        </div>
                                    </div>
                                </div> -->
                            <!-- </div> -->
                            <!-- <div class="col-md-6 row">
                                <div class="row" >
                                    <div class="col-md-6 mtop10 border-right">
                                        <span><?php //echo _l('contract'); ?>Review Email</span>
                                    </div>
                                    <div class="col-md-6 mtop10" >
                                        <div class="onoffswitch">
                                            <input type="checkbox" id="contract_emails" data-perm-id="3"
                                                class="onoffswitch-checkbox " 
                                                <?php //if(isset($contact) && $contact->contract_emails == '1'){echo 'checked';} ?>
                                                checked value="contract_emails" name="contract_emails"  >
                                            <label class="onoffswitch-label" for="contract_emails"></label>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <!-- <div class="checkbox checkbox-primary">
                            <input type="checkbox" name="is_primary" id="contact_primary"
                                <?php //if((!isset($contact) && total_rows(db_prefix().'contacts',array('is_primary'=>1,'userid'=>$customer_id)) == 0) || (isset($contact) && $contact->is_primary == 1)){echo 'checked';}; ?>
                                <?php //if((isset($contact) && total_rows(db_prefix().'contacts',array('is_primary'=>1,'userid'=>$customer_id)) == 1 && $contact->is_primary == 1)){echo '';} ?>>
                            <label for="contact_primary">
                                <?php //echo _l( 'contact_primary'); ?>
                            </label>
                        </div> -->
                        <?php if(!isset($contact) && is_email_template_active('new-client-created')){ ?>
                        <div class="checkbox checkbox-primary" style="display:none;">
                            <input type="checkbox" name="donotsendwelcomeemail" id="donotsendwelcomeemail">
                            <label for="donotsendwelcomeemail">
                                <?php echo _l( 'client_do_not_send_welcome_email'); ?>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-6"> -->
                <!-- <div class="form-group contact-direction-option">
                            <label for="direction"><?php //echo _l('document_direction'); ?></label>
                            <select class="selectpicker" data-none-selected-text="<?php //echo _l('system_default_string'); ?>" data-width="100%" name="direction" id="direction">
                                <option value="" <?php //if(isset($contact) && empty($contact->direction)){echo 'selected';} ?>></option>
                                <option value="ltr" <?php //if(isset($contact) && $contact->direction == 'ltr'){echo 'selected';} ?>>LTR</option>
                                <option value="rtl" <?php //if(isset($contact) && $contact->direction == 'rtl'){echo 'selected';} ?>>RTL</option>
                            </select>
                            </div> -->
                <?php //$rel_id=( isset($contact) ? $contact->id : false); ?>
                <?php //echo render_custom_fields( 'contacts',$rel_id); ?>
                <!-- fake fields are a workaround for chrome autofill getting the wrong fields -->
                <!-- <input type="text" class="fake-autofill-field" name="fakeusernameremembered" value=''
                            tabindex="-1" />
                        <input type="password" class="fake-autofill-field" name="fakepasswordremembered" value=''
                            tabindex="-1" />
                        <div class="client_password_set_wrapper">
                            <label for="password" class="control-label">
                                <?php //echo _l( 'client_password'); ?>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control password" name="password"
                                    autocomplete="false">
                                <span class="input-group-addon">
                                    <a href="#password" class="show_password"
                                        onclick="showPassword('password'); return false;"><i class="fa fa-eye"></i></a>
                                </span>
                                <span class="input-group-addon">
                                    <a href="#" class="generate_password"
                                        onclick="generatePassword(this);return false;"><i class="fa fa-refresh"></i></a>
                                </span>
                            </div>
                            <?php //if(isset($contact)){ ?>
                            <p class="text-muted">
                                <?php //echo _l( 'client_password_change_populate_note'); ?>
                            </p>
                            <?php //if($contact->last_password_change != NULL){
                                //echo _l( 'client_password_last_changed');
                               //echo '<span class="text-has-action" data-toggle="tooltip" data-title="'._dt($contact->last_password_change).'"> ' . time_ago($contact->last_password_change) . '</span>';
                                  //  }
                               // } ?>
                        </div>
                        <hr /> -->
                <!-- Send SET password email -->
                <?php //if(is_email_template_active('contact-set-password')){ ?>
                <!-- <div class="checkbox checkbox-primary">
                            <input type="checkbox" name="send_set_password_email" id="send_set_password_email">
                            <label for="send_set_password_email">
                                <?php //echo _l( 'client_send_set_password_email'); ?>
                            </label>
                        </div>
                        <?php //} ?> -->
                <!-- <hr /> -->
                <!-- <p class="bold"><?php //echo _l('customer_permissions'); ?></p> -->
                <!-- <p class="text-danger"><?php //echo _l('contact_permissions_info'); ?></p> -->
                <?php
                            // $default_contact_permissions = array();
                            // if(!isset($contact)){
                            //     $default_contact_permissions = @unserialize(get_option('default_contact_permissions'));
                            // }
                            ?>
                <?php //foreach($customer_permissions as $permission){ ?>

                <!-- <div class="col-md-6 row">
                            <div class="row">
                                <div class="col-md-6 mtop10 border-right">
                                    <span><?php //echo $permission['name']; ?></span>
                                </div>
                                <div class="col-md-6 mtop10"> -->
                <!-- <div class="onoffswitch">
                                <input type="checkbox" id="<?php //echo $permission['id']; ?>" class="onoffswitch-checkbox s" <?php //if(isset($contact) && has_contact_permission($permission['short_name'],$contact->id) || is_array($default_contact_permissions) && in_array($permission['id'],$default_contact_permissions)){echo 'checked';} ?> value="<?php //echo $permission['id']; ?>" 
                                name="permissions[]" >
                                <label class="onoffswitch-label" for="<?php //echo $permission['id']; ?>"></label>
                            </div> -->
                <!-- for set default unchecked -->
                <!-- <div class="onoffswitch">
                                <input type="checkbox" id="<?php //echo $permission['id']; ?>" class="onoffswitch-checkbox s" <?php //if(isset($contact) && has_contact_permission($permission['short_name'],$contact->id)){echo 'checked';} ?> value="<?php //echo $permission['id']; ?>" 
                                name="permissions[]" >
                                <label class="onoffswitch-label" for="<?php //echo $permission['id']; ?>"></label>
                            </div> -->
                <!-- </div>
                            </div>
                        </div> -->

                <!-- <div class="clearfix"></div>
                        <?php //} ?>
                        <hr /> -->

                <!-- </div>
                </div> -->
            </div>

            <?php hooks()->do_action('after_contact_modal_content_loaded'); ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info" data-loading-text="<?php echo _l('wait_text'); ?>"
                    autocomplete="off" data-form="#contact-form"><?php echo _l('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>
</div>
<!-- <?php// if(!isset($contact)){ ?>
    <script>
        $(function(){
            // Guess auto email notifications based on the default contact permissios
            var permInputs = $('input[name="permissions[]"]');
            $.each(permInputs,function(i,input){
                input = $(input);
                if(input.prop('checked') === true){
                    $('#contact_email_notifications [data-perm-id="'+input.val()+'"]').prop('checked',true);
                }
            });
        });
    </script>
<?php// } ?> -->
<?php if(!isset($contact)){ ?>
<script>
$(function() {
    // Guess auto email notifications based on the default contact permissios
    var permInputs = $('input[name="permissions[]"]');
    $.each(permInputs, function(i, input) {
        input = $(input);
        if (input.prop('checked') === false) {
            $('#contact_email_notifications [data-perm-id="' + input.val() + '"]').prop('checked',
                false);
        }
    });
});
</script>
<?php } ?>
<script>
// function dependentElements() {
//     if ($('#dependent').is(':checked')) {
//         $('#dependent').val("1");
//         $('#occupationField').addClass('d-none');
//         $('#occupationClass').addClass('d-none');
//         $('#contact_details').addClass('d-none');
//         $('#address_details').addClass('d-none');
//         $('.hr').addClass('d-none');
//         $('#contract_emails').prop('checked', false);
//         $('#label_email').attr('for', '');
//     } else {
//         $('#dependent').val("0");
//         $('#occupationField').removeClass('d-none');
//         $('#occupationClass').removeClass('d-none');
//         $('#contact_details').removeClass('d-none');
//         $('#address_details').removeClass('d-none');
//         $('.hr').removeClass('d-none');
//         if ($('#deceased').is(':checked')) {
//             $('#contract_emails').prop('checked', false);
//             $('#label_email').attr('for', '');
//             $('#deceased').val("1");
//         } else if (!$('#dependent').is(':checked')) {
//             $('#deceased').val("0");
//             $('#contract_emails').prop('checked', true);
//             $('#label_email').attr('for', 'contract_emails');
//         }
//     }
// }
// function deceasedElements() {
//     if ($('#deceased').is(':checked')) {
//         $('#deceased').val("1");
//         $('#contract_emails').prop('checked', false);
//         $('#label_email').attr('for', '');
//     } else if (!$('#dependent').is(':checked')) {
//         $('#deceased').val("0");
//         $('#contract_emails').prop('checked', true);
//         $('#label_email').attr('for', 'contract_emails');
//     } else {
//         $('#deceased').val("0");
//     }
// }
// function contactKey() {
//     if ($('#contact_key').is(':checked')) {
//         $('#contact_key').val('1');
//     } else {
//         $('#contact_key').val('0');
//     }
// };

function contactKey() {
    var userId = $('#userId').html();
    var val = $('#contact_key').val();
    $.ajax({
        url: "<?php echo admin_url('Clients/checkKeyContact'); ?>",
        type: "POST",
        data: {
            userid: userId
        },
        success: function(response) {
            if (response == 1) {
                if (val == 1) {
                    if ($('#contact_key').is(':checked')) {
                        $('#contact_key').val('1');
                    } else {
                        $('#contact_key').val('0');
                    }
                } else {
                    if ($('#contact_key').is(':checked')) {
                        $('#contact_key').attr('disabled', false);
                        $('#contact_key').val('1');
                    } else {
                        $('#contact_key').attr('disabled', true);
                        $('#contact_key').val('0');
                    }
                }
            } else if (response > 1) {
                console.log("val > 1");
                if ($('#contact_key').is(':checked')) {
                    $('#contact_key').attr('disabled', false);
                    $('#contact_key').val('1');
                } else {
                    $('#contact_key').attr('disabled', true);
                    $('#contact_key').val('0');
                }
            } else {
                if ($('#contact_key').is(':checked')) {
                    $('#contact_key').val('1');
                } else {
                    $('#contact_key').val('0');
                }
            }
        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
};

function toggleContractEmails() {
    var contractEmail = $('#contract_emails').val();
    if ($('#deceased').is(':checked')) {
        $('#contract_emails').prop('checked', false);
        $('#label_email').attr('for', '');
    } else if (!$('#business').is(':checked') && !$('#dependent').is(':checked')) {
        if (contractEmail == 1) {
            $('#contract_emails').prop('checked', true);
            $('#label_email').attr('for', 'contract_emails');
        } else {
            $('#contract_emails').prop('checked', false);
            $('#label_email').attr('for', 'contract_emails');
        }
    } else {
        $('#contract_emails').prop('checked', false);
        $('#label_email').attr('for', '');
    }
}
function businessElements() {
    if ($('#business').is(':checked')) {
        $('#business').val("1");
        $('#occupationField').addClass('d-none');
        $('#occupationClass').addClass('d-none');
        $('#contact_details').addClass('d-none');
        $('#address_details').addClass('d-none');
        $('.hr').addClass('d-none');
    } else {
        $('#business').val("0");
        if (!$('#business').is(':checked') && !$('#dependent').is(':checked')) {
            $('#occupationField').removeClass('d-none');
            $('#occupationClass').removeClass('d-none');
            $('#contact_details').removeClass('d-none');
            $('#address_details').removeClass('d-none');
            $('.hr').removeClass('d-none');
        }
    }
    toggleContractEmails();
}
function dependentElements() {
    if ($('#dependent').is(':checked')) {
        $('#dependent').val("1");
        $('#occupationField').addClass('d-none');
        $('#occupationClass').addClass('d-none');
        $('#contact_details').addClass('d-none');
        $('#address_details').addClass('d-none');
        $('.hr').addClass('d-none');
    } else {
        $('#dependent').val("0");
        if (!$('#business').is(':checked') && !$('#dependent').is(':checked')) {
            $('#occupationField').removeClass('d-none');
            $('#occupationClass').removeClass('d-none');
            $('#contact_details').removeClass('d-none');
            $('#address_details').removeClass('d-none');
            $('.hr').removeClass('d-none');
        }
    }
    toggleContractEmails();
}
function deceasedElements() {
    if ($('#deceased').is(':checked')) {
        $('#deceased').val("1");
        $('#contract_emails').prop('checked', false);
        $('#label_email').attr('for', '');
    } else {
        $('#deceased').val("0");
        toggleContractEmails();
    }
}
$(document).ready(function() {
    contactKey();
    dependentElements();
    deceasedElements();
    businessElements();

    $('#contact_key').click(function() {
        contactKey();
    });
    $('#business').on('click', function() {
        businessElements();
    });
    $('#dependent').on('click', function() {
        dependentElements();
    });
    $('#deceased').on('click', function() {
        deceasedElements();
    });



    $("#checkBox").click(function() {
        let postal_address = $('#postal_address').val();
        if (postal_address != '') {
            $(".has-error").removeClass("has-error");
            $("#postal_country-error").css("display", "none");
            $("#postal_address-error").css("display", "none");
            $("#postal_city-error").css("display", "none");
            $("#postal_state-error").css("display", "none");
            $("#postal_zipcode-error").css("display", "none");
        }
    });

    // Contact key Address start
    var residential_address = $('#residential_address').val();
    var residential_state = $('#residential_state').val();
    var residential_city = $('#residential_city').val();
    var residential_zipcode = $('#residential_zipcode').val();
    var residential_country = $('#residential_country').val();
    var postal_address = $('#postal_address').val();
    var postal_state = $('#postal_state').val();
    var postal_city = $('#postal_city').val();
    var postal_zipcode = $('#postal_zipcode').val();
    var postal_country = $('#postal_country').val();
    $('#contactKeyAddress').click(function() {
        var userId = $('#userId').html();
        $.ajax({
            url: "<?php echo admin_url('Clients/KeyContactAddress'); ?>",
            type: "POST",
            datatype: 'json',
            data: {
                userid: userId
            },
            success: function(response) {
                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }
                if ($('#contactKeyAddress').is(':checked')) {
                    $('#contactKeyAddress').val('1');
                    $('#residential_address').val(response[0].residential_address);
                    $('#residential_state').val(response[0].residential_state);
                    $('#residential_city').val(response[0].residential_city);
                    $('#residential_zipcode').val(response[0].residential_zipcode);
                    $('#residential_country').val(response[0].residential_country).change();
                    $('#postal_address').val(response[0].postal_address);
                    $('#postal_state').val(response[0].postal_state);
                    $('#postal_city').val(response[0].postal_city);
                    $('#postal_zipcode').val(response[0].postal_zipcode);
                    $('#postal_country').val(response[0].postal_country).change();
                    $('.selectpicker').selectpicker('refresh');
                } else {
                    $('#contactKeyAddress').val('0');
                    $('#residential_address').val(residential_address);
                    $('#residential_state').val(residential_state);
                    $('#residential_city').val(residential_city);
                    $('#residential_zipcode').val(residential_zipcode);
                    $('#residential_country').val(residential_country).change();
                    $('#postal_address').val(postal_address);
                    $('#postal_state').val(postal_state);
                    $('#postal_city').val(postal_city);
                    $('#postal_zipcode').val(postal_zipcode);
                    $('#postal_country').val(postal_country).change();
                    $('.selectpicker').selectpicker('refresh');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    });

});


// $("#dob").change(function() {
//     // alert('ldkfjg');
//     var dob = $(this).val();
//     dobb = new Date(dob);
//     var today = new Date();
//     var age = Math.floor((today - dobb) / (365.25 * 24 * 60 * 60 * 1000));
//     $("#age").val(age);
// })


// $("#dob").click(function() {
// var dob = $(this).val();
// alert("dob");
//    var birthdate = new Date(dob);
//     var today = new Date();
//            // var birthdate = new Date($(this).val());
           
//             var age = today.getFullYear() - birthdate.getFullYear();
//             //Adjust age if the current month is before the birth month
//             var birthMonth = birthdate.getMonth();
//             var currentMonth = today.getMonth();
//             if (currentMonth < birthMonth || (currentMonth === birthMonth && today.getDate() < birthdate.getDate())) {
//                 age--;
//             }
//             // alert(age);
//             $('#age').val(age);
//         });
    

function openVulnerableNote() {
    // if ($('#checkBox_vulnerable').is(":checked"))
    //     $(".vulnerableClient").show();
    // else
    //     $(".vulnerableClient").hide();

    var checkBox = document.getElementById("checkBox_vulnerable");

    if (checkBox.checked == true) {
        $(".vulnerableClient").show();
        var vulnerable_checkValue = 1;
        //  alert(vulnerable_checkValue);
        document.getElementById("checkvalue").value = vulnerable_checkValue;
    } else {
        $(".vulnerableClient").hide();
        var vulnerable_checkValue = 0;
        // alert(vulnerable_checkValue);
        document.getElementById("checkvalue").value = vulnerable_checkValue;

    }
}
</script>

<script>
function clsAlphaNoOnly (e) {  // Accept only alpha numerics, no special characters 
  var regex = new RegExp("^[0-9 ]+$");
  var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
  if (regex.test(str)) {
      return true;
  }
  e.preventDefault();
  return false;
}



// $("#firstname").keyup(function() {
//     var firstname = $(this).val();
//     var actionurl = "<?php echo base_url('admin/clients/firstNameExists')?>"
//     $.ajax({
//         type: "post",
//         url: actionurl,
//         datatype: "application/json",
//         data: {
//             firstname: firstname,
//         },
//         success: function(response) {
//             if (response == 0) {
//                 $('#msg').html('');
//             } else {
//                 $('#msg').html('<span style="color:red;">First Name Is Already Exists</span>');
//                 $("#firstname").val('');
//             }
//         }
//     });
// });

// $("#lastname").keyup(function() {
//     var lastname = $(this).val();
//     var actionurl = "<?php echo base_url('admin/clients/lastnameExists')?>"
//     $.ajax({
//         type: "post",
//         url: actionurl,
//         datatype: "application/json",
//         data: {
//             lastname: lastname,
//         },
//         success: function(response) {
//             if (response == 0) {
//                 $('#msg_lastname').html('');
//             } else {
//                 $('#msg_lastname').html('<span style="color:red;">Last Name Is Already Exists</span>');
//                 $("#lastname").val('');
//             }
//         }
//     });
// });

// $("#dob").keyup(function() {
//     var dob = $(this).val();
//     var actionurl = "<?php echo base_url('admin/clients/dobExists')?>"
//     $.ajax({
//         type: "post",
//         url: actionurl,
//         datatype: "application/json",
//         data: {
//             dob: dob,
//         },
//         success: function(response) {
//             if (response == 0) {
//                 $('#msg_dob').html('');
//             } else {
//                 $('#msg_dob').html('<span style="color:red;">Date of birth Is Already Exists</span>');
//             }
//         }
//     });
// });

$("#dob,#firstname,#lastname").blur(function() {
    var firstname   = $('#firstname').val();
    var lastname    = $('#lastname').val();
    var dob         = $("#dob").val();
    var actionurl   = "<?php echo base_url('admin/clients/firstNameExists')?>"
    $.ajax({
        type: "post",
        url: actionurl,
        datatype: "application/json",
        data: {
            firstname: firstname,
            lastname: lastname,
            dob: dob,
        },
        success: function(response) {
            if (response == 0) {
                $('#msg').html('');
            } else {
                $('#msg').html('<span class="alert alert-danger">Individual may already exist in the system</span>');
                // alert("Individual may already exist in the system")
                // $("#firstname").val('');
                // $("#lastname").val('');
                // $("#dob").val('');
            }
        }
    });
});


var input = document.getElementById('dob');
input.addEventListener('blur', function(e) {
    var el          = e.target;
    var selected    = new Date(e.target.value).getTime();
    var minVal      = el.hasAttribute('minn') ? el.getAttribute('minn'): '0000-00-00';
    var maxVal      = el.hasAttribute('maxx') ? el.getAttribute('maxx'): '0000-00-00';
    var min         = new Date(minVal).getTime();
    var max         = new Date(maxVal).getTime();
    var isValid     = selected >= min && selected <= max;
    var today       = new Date();
    var dd          = String(today.getDate()).padStart(2, '0');
    var mm          = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy        = today.getFullYear();
    todaya          = mm + '/' + dd + '/' + yyyy;
    if(!isValid){
        $('#alertDate').html('<span style="color:red;">Please enter a value less than or equal to '+ todaya);
        // $("#firstname").val('');
    }
    else{
        $('#alertDate').html('');
    }
});

</script>
