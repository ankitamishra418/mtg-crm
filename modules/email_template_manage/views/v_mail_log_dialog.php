
<div class="modal-header">

    <button type="button" class="close"  onclick="$('#email_template_manage_mail_modal').modal('hide'); return false;" ><span aria-hidden="true">&times;</span></button>

   <h4 class="modal-title">

        <span class="edit-title"><?php echo _l('email_template_manage_email_log_detail')?></span>

        <button type="button" class="btn btn-primary email_template_model_log_detail"
            style="float: right;margin-right: 50px;" onclick="printEmailLog()"><span>Print</span></button>

    </h4>

</div>

<div class="modal-body email_template_model_log_detail">

    <div class="row" id="emailLog" >

        <?php if ($all_list){ ?>

            <div class="col-md-6" >
                <label for=""><b><?php echo _l("email_template_manage_log_table_head_from")?></b></label>
                <p><?php echo $data->company_name;?></p>
            </div>

            <div class="col-md-6" >
                <label for=""><b><?php echo _l("email_template_manage_log_table_head_email")?></b></label>
                <p id="sendtomail"><?php echo $data->company_email;?></p>
            </div>


        <?php } ?>

        <div class="col-md-6" id="sendstatus" >
            <label for=""><b><?php echo _l("email_template_manage_log_table_head_status")?></b></label>
            <p><?php echo $data->status;?></p>
        </div>

        <div class="col-md-6" id="senddate" >
            <label for=""><b><?php echo _l("email_template_manage_log_table_head_date")?></b></label>
            <p><?php echo _d($data->date);?></p>
        </div>

        <?php if (!empty($data->company_cc)){ ?>
            <div class="col-md-12" >
                <label for=""><?php echo _l("email_template_manage_cc")?></label>
                <p><?php echo $data->company_cc;?></p>
            </div>
        <?php } ?>

        <div class="col-md-6" id="subject" >
            <label for=""><?php echo _l("email_template_manage_log_table_head_subject")?></label>
            <p><?php echo $data->mail_subject;?></p>
        </div>

        <div class="col-md-6" id="opendate" >
            <label for=""><?php echo _l("email_template_manage_date_opened")?></label>
            <p><?php echo _d($data->date_opened);?></p>
        </div>

        <div class="col-md-12" >
            <label for=""><?php echo _l("email_template_manage_log_table_head_content")?></label>
            <p><iframe id="emailLogIframe" style="width: 100%; min-height:400px " src="<?php echo admin_url('email_template_manage/mail_log_detail_frame/'.$data->id)?>" frameborder="0"></iframe></p>
        </div>


        <?php if (!empty($data->error_message)){ ?>
            <div class="col-md-12" >
                <label for=""><?php echo _l("email_template_manage_log_error_message")?></label>
                <p><?php echo $data->error_message;?></p>
            </div>
        <?php } ?>

        <div class="clearfix"></div>

    </div>

</div>

<div class="modal-footer">

    <button  class="btn btn-default" type="button" onclick="$('#email_template_manage_mail_modal').modal('hide'); return false;" ><?php echo _l('close'); ?></button>

</div>

<style>

    .email_template_model_log_detail label{
        font-size: 18px;
        font-weight: bold;
    }

    .email_template_model_log_detail .col-md-6{
        min-height: 75px;
    }

    .email_template_model_log_detail .col-md-12{
        min-height: 75px;
    }

</style>
<script>
function printEmailLog() {
    var sendToMial = $('#sendtomail').html();
    var sendStatus = $('#sendstatus').html();
    var sendDate = $('#senddate').html();
    var subject = $('#subject').html();
    var openDate = $('#opendate').html();
    var iframeContent = $('#emailLogIframe').contents().find('body').html();
    var printContents = '<div>' + iframeContent + '</div>';
    var printWindow = window.open('', '_blank', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Send to : ' + sendToMial + '</title>');
    printWindow.document.write(
        '<style>body { padding-top: 100px; } .right-align { float: right; text-align: right; }</style>'
    );
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContents);
    printWindow.document.write('<div class="right-align">');
    printWindow.document.write(sendDate);
    printWindow.document.write('</div>');
    printWindow.document.write(sendStatus);
    printWindow.document.write('<div class="right-align">');
    printWindow.document.write(openDate);
    printWindow.document.write('</div>');
    printWindow.document.write(subject);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.onload = function() {
        printWindow.print();
        printWindow.close();
    };
}
</script>
