<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal fade" id="customer_file_share_file_with" data-total-contacts="<?php echo count($contacts); ?>"
    tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo _l('share_file_with'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo form_hidden('file_id'); ?>
                <?php echo render_select('share_contacts_id[]',$contacts,array('id',array('firstname','lastname')),'customer_contacts',array(get_primary_contact_user_id($client->userid)),array('multiple'=>true,'data-actions-box'=>true),array(),'','',false); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="button" class="btn btn-info"
                    onclick="do_share_file_contacts();"><?php echo _l('confirm'); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<h4 class="no-mtop bold"><?php echo _l('customer_attachments'); ?>
    <br />
    <small class="text-info"><?php echo _l('customer_files_info_message'); ?></small>
</h4>
<!-- <h4>Files Archive: <a href="<?php// echo $archive_file; ?>" target="blank"><?php// echo $archive_file; ?></a> </h4>  -->
<h4>Files Archive: <a href="<?php echo $client->file_archive; ?>" target="blank"><?php echo $client->file_archive; ?></a> </h4>


<hr />
<?php if(isset($client)){ ?>

<?php echo form_open_multipart(admin_url('clients/upload_attachment/'.$client->userid),array('class'=>'dropzone','id'=>'client-attachments-upload')); ?>
<input type="file" name="file" multiple />
<?php echo form_close(); ?>

<div class="text-right mtop15">
    <button class="gpicker" data-on-pick="customerGoogleDriveSave">
        <i class="fa fa-google" aria-hidden="true"></i>
        <?php echo _l('choose_from_google_drive'); ?>
    </button>
    <div id="dropbox-chooser"></div>
</div>
<div class="attachments">
    <div class="mtop25">

        <table class="table dt-table" data-order-col="5" data-order-type="desc">
            <thead>
                <tr>
                    <th width="30%"><?php echo _l('customer_attachments_file'); ?></th>
                    <th><?php echo _l('File Type'); ?></th>

                    <!-- <th><?php echo _l('category'); ?></th> -->
                    <th><?php echo _l('compliance'); ?></th>
                    <th><?php echo _l('Description'); ?></th>
                    <th><?php echo _l('uploaded_by'); ?></th>
                    <th><?php echo _l('file_date_uploaded'); ?></th>
                    <th><?php echo _l('options'); ?></th>
                    <th><?php echo _l('customer_attachments_show_in_customers_area'); ?></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($attachments as $type => $attachment){
                        $download_indicator = 'id';
                        $key_indicator = 'rel_id';
                        $upload_path = get_upload_path_by_type($type);
                        if($type == 'invoice' || $type == 'proposal' || $type == 'estimate' || $type == 'credit_note'){
                            $url = site_url() .'download/file/sales_attachment/';
                            $download_indicator = 'attachment_key';
                        } else if($type == 'contract'){
                            $url = site_url() .'download/file/contract/';
                            $download_indicator = 'attachment_key';
                        } else if($type == 'lead'){
                            $url = site_url() .'download/file/lead_attachment/';
                        } else if($type == 'task'){
                            $url = site_url() .'download/file/taskattachment/';
                            $download_indicator = 'attachment_key';
                        } else if($type == 'ticket'){
                            $url = site_url() .'download/file/ticket/';
                            $key_indicator = 'ticketid';
                        } else if($type == 'customer'){
                            $url = site_url() .'download/file/client/';
                            $download_indicator = 'attachment_key';
                        } else if($type == 'expense'){
                            $url = site_url() .'download/file/expense/';
                            $download_indicator = 'rel_id';
                        }
                        ?>
                <?php foreach($attachment as $_att){
                ?>

                <tr id="tr_file_<?php echo $_att['id']; ?>">


                    <td>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#" type="button"  data-toggle="modal" value="<?php echo $_att['file_name']; ?>" data-target="#myModal_files<?php echo $_att['id'];?>"><?php echo $_att['filename_Notencript']; ?> </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <?php
                            //  $path = $upload_path . $_att[$key_indicator] . '/' . $_att['file_name'];
                            $is_image = false;
                            if(!isset($_att['external'])) {
                                // download URL
                                $attachment_url = $url . $_att[$download_indicator];
                                $is_image = is_image($path);
                                $img_url = site_url('download/preview_image?path='.protected_file_url_by_path($path,true).'&type='.$_att['filetype']);
                                $lightBoxUrl = site_url('download/preview_image?path='.protected_file_url_by_path($path).'&type='.$_att['filetype']);
                            } else if(isset($_att['external']) && !empty($_att['external'])){
                                if(!empty($_att['thumbnail_link']) && $_att['external'] == 'dropbox'){
                                    $is_image = true;
                                    $img_url = optimize_dropbox_thumbnail($_att['thumbnail_link']);
                                }
                                $attachment_url = $_att['external_link'];
                            }
                            if($is_image){
                                echo '<div class="preview_image">';
                            }
                        ?>
                        <a href="<?php if($is_image){ echo isset($lightBoxUrl) ? $lightBoxUrl : $img_url; } else {echo $attachment_url; } ?>"
                            <?php if($is_image){ ?> data-lightbox="customer-profile" <?php } ?>
                            class="display-block mbot5">
                            <?php if($is_image){ ?>
                            <div class="table-image">
                                <div class="text-center"><i class="fa fa-spinner fa-spin mtop30"></i></div>
                                <img src="#" class="img-table-loading" data-orig="<?php echo $img_url; ?>">
                            </div>
                            <?php } else { ?>
                            <i class="<?php echo get_mime_class($_att['filetype']); ?>"></i>
                            <?php //echo $_att['file_name']; ?>
                            <?php echo 'Download'; ?>
                            <!-- <p type="button" class="btn btn-info btn-sm" data-toggle="modal"> <?php //echo 'Download'; ?>
                            </p> -->
                            <?php } ?>
                        </a>
                        <?php if($is_image){ echo '</div>'; } ?>
                            </div>
                        </div>
                    </td>
                    <td data-order="<?php echo $_att['filetype']; ?>"><?php echo $_att['filetype']; ?></td>


                        <!-- <td >
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"  value="<?php echo $_att['category_name']; ?>" data-target="#myModal<?php echo $_att['id'];?>"><?php if(isset($_att['category_name'])){ echo $_att['category_name']; } else { echo "Choose Category"; } ?> </button>
                        </td> -->
                        <td>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"  value="<?php echo $_att['compliance_name']; ?>" data-target="#myModal_compliance<?php echo $_att['id'];?>"><?php if(isset($_att['compliance_name'])){ echo $_att['compliance_name']; } else { echo "Choose Compliance"; } ?> </button>
                        </td>

                    <td data-order="<?php echo $_att['client_file_discription']; ?>"><?php echo $_att['client_file_discription']; ?></td>

                   
                    <!-- <td><?php  //echo ($staff[0]['firstname'] .' '. $staff[0]['lastname']); ?> </td> -->
                    <td>
                        <?php if($_att['staffid'] != 0){
                            $_data = '<a href="' . admin_url('staff/profile/' . $_att['staffid']). '">' .staff_profile_image($_att['staffid'], array(
                                'staff-profile-image-small'
                            )) . '</a>';
                            $_data .= ' <a href="' . admin_url('staff/member/' . $_att['staffid'])  . '">' . get_staff_full_name($_att['staffid']) . '</a>';
                            echo $_data;
                            } else {
                            echo ' <img src="'.contact_profile_image_url($_att['contact_id'],'thumb').'" class="client-profile-image-small mrigh5">
                            <a href="'.admin_url('clients/client/'.get_user_id_by_contact_id($_att['contact_id']).'?contactid='.$_att['contact_id']).'">'.get_contact_full_name($_att['contact_id']).'</a>';
                            }
                        ?>
                    </td>
                    <td data-order="<?php echo $_att['dateadded']; ?>"><?php echo _dt($_att['dateadded']); ?></td>
                    <td>
                        <?php if(!isset($_att['external'])){ ?>
                        <!-- <button type="button" data-toggle="modal" data-file-name="<?php //echo $_att['file_name']; ?>"
                            data-filetype="<?php// echo $_att['filetype']; ?>" data-path="<?php //echo $path; ?>"
                            data-target="#send_file" class="btn btn-info btn-icon"><i
                                class="fa fa-envelope"></i></button> -->
                                <?php
                            $encpath = $upload_path . $_att[$key_indicator] . '/' . $_att['file_name'];
                            $pathh = $upload_path . $_att[$key_indicator] . '/' . $_att['filename_Notencript'];
                            if(!file_exists($decpath)){
                                copy($encpath, $pathh);
                                $pathh = $upload_path . $_att[$key_indicator] . '/' . $_att['filename_Notencript'];
                            }
                        ?>
                        <button type="button" data-toggle="modal"
                            data-file-name="<?php echo $_att['filename_Notencript']; ?>"
                            data-filetype="<?php echo $_att['filetype']; ?>" data-path="<?php echo $pathh; ?>"
                            data-target="#send_file" class="btn btn-info btn-icon"><i
                                class="fa fa-envelope"></i></button>
                        <?php } else if(isset($_att['external']) && !empty($_att['external'])) {
                                    echo '<a href="'.$_att['external_link'].'" class="btn btn-info btn-icon" target="_blank">'.($_att['external'] == 'dropbox' ? '<i class="fa fa-dropbox"></i>' : '<i class="fa fa-google"></i>').'</a>';
                                } ?>

                        <?php if(is_admin() || get_staff_user_id() == $_att['staffid']){ ?>
                        <?php if($type == 'customer'){ ?>
                        <a href="<?php echo admin_url('clients/delete_attachment/'.$_att['rel_id'].'/'.$_att['id']); ?>"
                            class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                        <?php } ?>
                        <?php } ?>
                    </td>

                    <td>
                        <div class="onoffswitch" <?php if($type != 'customer'){?> data-toggle="tooltip"
                            data-title="<?php echo _l('customer_attachments_show_notice'); ?>" <?php } ?>>
                            <input type="checkbox" <?php if($type != 'customer'){echo 'disabled';} ?>
                                id="<?php echo $_att['id']; ?>" data-id="<?php echo $_att['id']; ?>"
                                class="onoffswitch-checkbox customer_file"
                                data-switch-url="<?php echo admin_url(); ?>misc/toggle_file_visibility"
                                <?php if(isset($_att['visible_to_customer']) && $_att['visible_to_customer'] == 1){echo 'checked';} ?>>
                            <label class="onoffswitch-label" for="<?php echo $_att['id']; ?>"></label>
                        </div>
                        <?php if($type == 'customer' && $_att['visible_to_customer'] == 1){
                            $file_visibility_message = '';
                            $total_shares = total_rows(db_prefix().'shared_customer_files',array('file_id'=>$_att['id']));

                            if($total_shares == 0){
                                $file_visibility_message = _l('file_share_visibility_notice');
                            } else {
                                $share_contacts_id = get_customer_profile_file_sharing(array('file_id'=>$_att['id']));
                                if(count($share_contacts_id) == 0){
                                    $file_visibility_message = _l('file_share_visibility_notice');
                                }
                            }
                            echo '<span class="text-warning'.(empty($file_visibility_message) || total_rows(db_prefix().'contacts',array('userid'=>$client->userid)) == 0 ? ' hide': '').'">'.$file_visibility_message.'</span>';
                            if(isset($share_contacts_id) && count($share_contacts_id) > 0){
                                $names = '';
                                $contacts_selected = '';
                                foreach($share_contacts_id as $file_share){
                                    $names.= get_contact_full_name($file_share['contact_id']) .', ';
                                    $contacts_selected .= $file_share['contact_id'].',';
                                }
                                if($contacts_selected != ''){
                                    $contacts_selected = substr($contacts_selected,0,-1);
                                }
                                if($names != ''){
                                    echo '<a href="#" onclick="do_share_file_contacts(\''.$contacts_selected.'\','.$_att['id'].'); return false;"><i class="fa fa-pencil-square-o"></i></a> ' . _l('share_file_with_show',mb_substr($names, 0,-2));
                                }
                            }
                        }
                        ?>
                    </td>

                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php foreach($attachments as $type => $attachment){
    
    $download_indicator = 'id';
    $key_indicator = 'rel_id';
    $upload_path = get_upload_path_by_type($type);
    if($type == 'invoice' || $type == 'proposal' || $type == 'estimate' || $type == 'credit_note'){
        $url = site_url() .'download/file/sales_attachment/';
        $download_indicator = 'attachment_key';
    } else if($type == 'contract'){
        $url = site_url() .'download/file/contract/';
        $download_indicator = 'attachment_key';
    } else if($type == 'lead'){
        $url = site_url() .'download/file/lead_attachment/';
    } else if($type == 'task'){
        $url = site_url() .'download/file/taskattachment/';
        $download_indicator = 'attachment_key';
    } else if($type == 'ticket'){
        $url = site_url() .'download/file/ticket/';
        $key_indicator = 'ticketid';
    } else if($type == 'customer'){
        $url = site_url() .'download/file/client/';
        $download_indicator = 'attachment_key';
    } else if($type == 'expense'){
        $url = site_url() .'download/file/expense/';
        $download_indicator = 'rel_id';
    }
    ?>
<?php foreach($attachment as $_att){  ?>
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" data-toggle="modal" id="myModal_files<?php echo $_att['id']; ?>" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:white;"><?php echo $_att['filename_Notencript']; ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 border-right">
                    <!-- <div class="col-md-12"> -->
                        <?php if($_att['staffid'] != 0){
                            $_data = '<a href="' . admin_url('staff/profile/' . $_att['staffid']). '">' .staff_profile_image($_att['staffid'], array(
                                'staff-profile-image-small'
                            )) . '</a>';
                            $_data .= ' <a href="' . admin_url('staff/member/' . $_att['staffid'])  . '">' . get_staff_full_name($_att['staffid']) . '</a>';
                            echo $_data;
                            } else {
                            echo ' <img src="'.contact_profile_image_url($_att['contact_id'],'thumb').'" class="client-profile-image-small mrigh5">
                            <a href="'.admin_url('clients/client/'.get_user_id_by_contact_id($_att['contact_id']).'?contactid='.$_att['contact_id']).'">'.get_contact_full_name($_att['contact_id']).'</a>';
                            }
                        ?>
                        <br>
                        <br>
                        <label for="client_file_discription">File Name</label>
                        <input type="text" id="_file<?= $_att['id']; ?>" class="form-control" onkeyup="file_name_change(<?= $_att['id']; ?>)"; name="filename_Notencript" value="<?php echo $_att['filename_Notencript']; ?>" rows="6" cols="50" >
                        <br>
                        <label for="_file">Description</label>
                        <textarea type="text" id="client_file_discription<?= $_att['id']; ?>" onkeyup="file_name_change(<?= $_att['id']; ?>)"; name="client_file_discription" class="form-control" value="<?php echo $_att['client_file_discription']; ?>"><?php echo $_att['client_file_discription']; ?></textarea>
                 
                        <input type="hidden" id="clientId" value="<?php echo  $client->userid; ?>">
                        <!-- <img src="http://127.0.0.1/perfex_crm/download/preview_image?path=uploads/clients/121/Super_Compressor (1) (1)_thumb.png&amp;type=image/png" class="img-table-loading" data-orig="http://127.0.0.1/perfex_crm/download/preview_image?path=uploads/clients/121/Super_Compressor (1) (1)_thumb.png&amp;type=image/png"> -->
                        <br>
                        <?php
                        $path = $upload_path . $_att[$key_indicator] . '/' . $_att['file_name'];
                        $img_url = site_url('download/preview_image?path='.protected_file_url_by_path($path,true).'&type='.$_att['filetype']);
                        $lightBoxUrl = site_url('download/preview_image?path='.protected_file_url_by_path($path).'&type='.$_att['filetype']);
                        ?>
                        <!-- <div class="row">
                            <div class="col-sm-12"> -->
                            <!-- <div class=""> -->
                            <!-- style="display: block; margin-left: auto; margin-right: auto;" -->
                            <img src="<?php echo $img_url; ?>" alt="" class="img img-responsive" style="display: block; margin-left: auto; margin-right: auto;">
                            <!-- </div> -->
                        <!-- </div>
                        </div> -->
                    </div>
                    <!-- <div class="col-md-6 project_file_discusssions_area">
                        <div id="project-file-discussion" class="tc-content">
                        </div>
                   </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="myfunctionClose();" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $discussion_lang = get_project_discussions_language_array(); ?>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $_att['id']; ?>" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">CHOOSE CATEGORY</h4>
            </div>
            <div class="modal-body">
                <p>Category</p>

                <select name="category<?php echo $_att['id']; ?>" id="category<?= $_att['id'];?>" class="selectpicker"
                    data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>"
                    onchange="myFunction(<?php echo $_att['id']; ?>);">
                    <option value="">Select</option>
                    <?php foreach($category as $categories){?>
                    <option value="<?php echo $categories['id']; ?>"
                        <?php if(isset($category) && $categories['id'] == $_att['category_id']){ echo 'selected';}?>>
                        <?php echo $categories['category']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="myfunctionClose();"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal_compliance<?php echo $_att['id']; ?>" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">CHOOSE COMPLIANCE</h4>
            </div>
            <div class="modal-body">
                <p>Compliance</p>
                <select name="compliance<?= $_att['id']?>" id="compliance<?= $_att['id']?>" class="selectpicker"
                    data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>"
                    onchange="myfunctions(<?php echo $_att['id']; ?>)">
                    <option value="">Select</option>
                    <?php foreach($complience as $compliences){ ?>
                    <option value="<?php echo $compliences['id']; ?>"
                        <?php if(isset($complience) && $_att['compliance_id']==$compliences['id']){ echo 'selected'; }?>>
                        <?php echo $compliences['compliance'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="myfunctionClose();"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<?php } } ?>
<?php

$this->load->view('admin/clients/modals/send_file_modal');
} ?>

<script>
function myFunction(id) {
    // alert(id);
    var attachementId = id;
    var categoryDropdown = 'category' + attachementId;
    var category_id = document.getElementById(categoryDropdown).value;
    var actionUrl = "<?php echo site_url('admin/clients/updatecategory'); ?>"
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: {
            id: category_id,
            attachementId: attachementId,
        },
        dataType: "json",
        success: function(data) {
            console.log(data);
        }
    })
}

function myfunctions(id) {
    var attachementId = id;
    var compliancesDropdown = 'compliance' + attachementId;
    var compliance_id = document.getElementById(compliancesDropdown).value;
    var actionUrl = "<?php echo base_url('admin/clients/updateCompliance')?>"
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: {
            id: compliance_id,
            attachementId: attachementId
        },
        dataType: "json",
        success: function(data) {
            consol.log(data);
        }
    })
}

function myfunctionClose() {
    location.reload(true);
}

function view_project_file(e, t) {
$("#project_file_data").empty(),
    $("#project_file_data").load(admin_url + "projects/file/" + e + "/" + project_id,
    function(e, t, i) {
        "error" == t && alert_float("danger", i.statusText)
    })
}

function file_name_change(id){
    var rowid                   = id;
    var clientId                = $('#clientId').val();
    var filename_Notencript               = $('#_file' + rowid).val();
    var client_file_discription = $('#client_file_discription'+ rowid).val();
    var action_url1 = "<?php  echo base_url('admin/clients/update_file_data'); ?>"
    
    $.ajax({
        type: 'POST',
        url: action_url1,
        data: {
            rowid  : rowid,
            clientId  : clientId,
            client_file_discription  : client_file_discription,
            filename_Notencript : filename_Notencript,
        },
        datatype: "json",
        success: function(data){
            consol.log(data);
        }
    })
}

</script>