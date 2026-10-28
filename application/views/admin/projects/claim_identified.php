
<?php defined('BASEPATH') or exit('No direct script access allowed'); 

init_head();
?>

<div id="wrapper">
    <div class="content">
        <div class="row">

            <div class="col-md-12">

                <!-- Add Claim Identified -->
                <div class="panel_s">
                    <div class="panel-body">

                        <h3>Add Claim Identified</h3>

                        <form method="post"
                              action="<?php echo base_url(); ?>admin/projects/saveClaimIdentified">

                            <div class="row">

                                <div class="col-md-4">

                                    <input type="text"
                                           class="form-control"
                                           placeholder="Enter Input"
                                           name="claim_identified"
                                           required>

                                </div>

                                <div class="col-md-2">

                                    <input type="hidden"
                                           name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                           value="<?php echo $this->security->get_csrf_hash(); ?>">

                                    <button type="submit"
                                            class="btn btn-info">
                                        Add
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>
                </div>


                <!-- Claim Identified List -->
                <div class="panel_s">
                    <div class="panel-body">

                        <table class="table mt-5">

                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Sr.No</th>
                                    <th scope="col">Claim Identified</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $i = 1;

                                foreach ($data as $val) {
                                ?>

                                <tr>

                                    <td>
                                        <?php echo $i; ?>
                                    </td>

                                    <td>
                                        <?php echo $val['claim_identified']; ?>
                                    </td>

                                    <td>

                                        <!-- Edit -->
                                        <a href="javascript:void(0);"
                                           class="btn btn-info btn-sm"
                                           onclick="editClaimIdentified(
                                               '<?php echo $val['id']; ?>',
                                               '<?php echo htmlspecialchars($val['claim_identified'], ENT_QUOTES); ?>'
                                           );">

                                            <i class="fa fa-pencil"></i>

                                        </a>

                                        <!-- Delete -->
                                        <a class="btn btn-danger btn-sm"
                                           onclick="return(myConfirm())"
                                           href="<?php echo base_url('admin/projects/deleteClaimIdentified/' . $val['id']); ?>">

                                            <i class="iconFontSize fa fa-trash-o"></i>

                                        </a>

                                    </td>

                                </tr>

                                <?php
                                    $i++;
                                }
                                ?>

                            </tbody>

                        </table>

                    </div>
                </div>


                <!-- Edit Claim Identified -->
                <div class="panel_s" id="editClaimIdentifiedPanel" style="display:none;">

                    <div class="panel-body">

                        <h3>Edit Claim Identified</h3>

                        <form method="post"
                              action="<?php echo base_url(); ?>admin/projects/updateClaimIdentified">

                            <input type="hidden"
                                   name="id"
                                   id="edit_claim_identified_id">

                            <div class="row">

                                <div class="col-md-4">

                                    <input type="text"
                                           class="form-control"
                                           name="claim_identified"
                                           id="edit_claim_identified"
                                           required>

                                </div>

                                <div class="col-md-4">

                                    <input type="hidden"
                                           name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                           value="<?php echo $this->security->get_csrf_hash(); ?>">

                                    <button type="submit"
                                            class="btn btn-info">
                                        Update
                                    </button>

                                    <button type="button"
                                            class="btn btn-default"
                                            onclick="cancelEditClaimIdentified();">
                                        Cancel
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

<?php 
init_tail();

$this->load->view('admin/clients/choose_contacts_list_js');

?>


<script>

function editClaimIdentified(id, value)
{
    $('#edit_claim_identified_id').val(id);
    $('#edit_claim_identified').val(value);

    $('#editClaimIdentifiedPanel').slideDown();

    $('html, body').animate({
        scrollTop: $('#editClaimIdentifiedPanel').offset().top - 100
    }, 500);
}

function cancelEditClaimIdentified()
{
    $('#editClaimIdentifiedPanel').slideUp();

    $('#edit_claim_identified_id').val('');
    $('#edit_claim_identified').val('');
}

function myConfirm()
{
    var result = confirm("Want to delete?");

    if (result == true) {
        return true;
    } else {
        return false;
    }
}

</script>

</html>
