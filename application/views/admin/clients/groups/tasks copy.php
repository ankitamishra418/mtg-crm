<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h4 class="customer-profile-group-heading"><?php echo _l('tasks'); ?></h4>
<?php if(isset($client)){
    init_relation_tasks_table(array( 'data-new-rel-id'=>$client->userid,'data-new-rel-type'=>'customer'));
} ?>

<script>
    window.onload = (event) => {
        //alert("hello");
        document.getElementById("ts_rel_to_project").value ='project';
        var link = document.getElementById("ts_rel_to_project");
        link.click();
        link.click();
        document.getElementById("ts_rel_to_project").checked = true;
    };
</script>