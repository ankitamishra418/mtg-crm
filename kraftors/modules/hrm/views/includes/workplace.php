<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div>
<div class="_buttons">
    <a href="#" onclick="new_workplace(); return false;" class="btn btn-info pull-left display-block">
        <?php echo _l('new_workplace'); ?>
    </a>
</div>
<div class="clearfix"></div>
<hr class="hr-panel-heading" />
<div class="clearfix"></div>
<table class="table dt-table">
 <thead>
    <th><?php echo _l('id'); ?></th>
    <th><?php echo _l('workplace'); ?></th>
    <th><?php echo _l('options'); ?></th>
 </thead>
 <tbody>
    <?php foreach($workplace as $w){ ?>
    <tr>
       <td><?php echo htmlspecialchars($w['id']); ?></td>
       <td><?php echo htmlspecialchars($w['name']); ?></td>
       <td>
         <a href="#" onclick="edit_workplace(this,<?php echo htmlspecialchars($w['id']); ?>); return false" data-name="<?php echo htmlspecialchars($w['name']); ?>"  data-email="<?php echo $w['workplace_email']; ?>" data-phone="<?php echo $w['workplace_phone']; ?>" data-address="<?php echo $w['workplace_address']; ?>" data-description="<?php echo $w['workplace_description']; ?>"  data-logo="<?php echo $w['workplace_logo']; ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil-square-o"></i></a>
          <a href="<?php echo admin_url('hrm/delete_workplace/'.$w['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
       </td>
    </tr>
    <?php } ?>
 </tbody>
</table>       
<div class="modal fade" id="workplace" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <?php echo form_open_multipart(admin_url('hrm/workplace')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <span class="edit-title"><?php echo _l('edit_workplace'); ?></span>
                    <span class="add-title"><?php echo _l('new_workplace'); ?></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                     <div id="additional_workplace"></div>   
                     <div class="form">     
                        <?php echo render_input('name','Workplace name'); ?>
                        <?php echo render_input('workplace_email','Email'); ?>
                        <?php echo render_input('workplace_phone','Phone'); ?>
                        <?php echo render_input('workplace_address','Address'); ?>
                        <?php echo render_input('workplace_description','description'); ?>
                        <input type="file" name="workplace_logo" value="" />
                    </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                    <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                </div>
            </div><!-- /.modal-content -->
            <?php echo form_close(); ?>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
</body>
</html>
