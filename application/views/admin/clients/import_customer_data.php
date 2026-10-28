<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<?php $clientId = $this->uri->segment(4);  ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4>IMPORT INDIVIDUAL</h4>
                        <?php 
                        // Message
                        if(isset($response)){
                        echo $response;
                        }
                        ?>
                        <form method='post' id="individual_import_form"
                            action='<?php echo base_url('admin/clients/importExcel');?><?php //echo $clientId;?>'
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo render_input('file','choose_csv_file','','file'); ?>
                                </div>
                            </div>
                            <input type='submit' value='Upload' name='upload' class="btn btn-info">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                                value="<?php echo $this->security->get_csrf_hash();?>">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //$this->load->view('admin/clients/client_group'); ?>
<?php init_tail(); ?>
<script src="<?php //echo base_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script>
<script>
$(function() {
    appValidateForm($('#individual_import_form'), {
        file: {
            required: true,
            extension: "csv"
        },
        source: 'required',
        status: 'required'
    });
});
</script>
</body>

</html>