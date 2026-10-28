<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4>IMPORT POLICY</h4>
                        <?php 
                        if(isset($response)){
                        echo $response;
                        }
                        ?>
                        <form method='post' id="policy_import_form" action='<?php echo base_url('admin/policy/importPolicyExcel');?>'
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo render_input('policy_file','choose_csv_file','','file'); ?>
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
<?php init_tail(); ?>
<script>
$(function() {
    appValidateForm($('#policy_import_form'), {
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