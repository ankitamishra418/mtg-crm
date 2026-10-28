<style>
.loader-container {
    position: absolute !important;
    width: 100%;
    top: 350px;
}
.loader-container .loader-text {
    position: relative !important;
    color: #5D78FF;
    text-align: center;
}
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-12">
                        <h4 style="font-weight: 900; text-align: center;">Underwriting by Adviser Report</h4>
                     </div><br> <br>
                        <div class="row " style="margin-top:30px;">
                            <form method="post" action="<?php echo base_url(); ?>admin/projects/report_underwriting_by_adviser" class="filterform">
                           <?php $data_adviser = ($this->session->userdata('adviser')); ?>
                                <div class="col-md-2">
                                <lable style="font-weight: 900;">Provider</lable>
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="provider" name="provider">
                                        <!-- <option value="">Select All</option> -->
                                        <?php /* foreach($provider as $row){ ?>
                                        <option value="<?php echo $row['id']?>"
                                            <?php if($row['id'] == $this->session->userdata('provider')){?> selected <?php }?>> <?php echo $row['providername']?>
                                        </option>
                                        <?php  } */ ?>
                                    </select>
                                </div>
                                <br>
                                <div class="col-md-2" style=" text-align: right;">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <button type="submit" class="btn btn-primary">Apply</button>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12" style=" margin-top:30px; text-align: center;">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="processing-loader" class="loader-container">
                            <div class="spinner-border text-primary loading" role="status">
                                <h3 class="loader-text">Loading...</h3><br><br><br>
                                <div class="visually-hidden dt-loader" style="left: 49%;"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table mt-5 choose_contact_table " id="choose_contact_table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Number</th>
                                    <th scope="col">Adviser</th>
                                    <th scope="col" style="text-align:right;">In Progress</th>
                                    <th scope="col" style="text-align:right;">Offer Of Terms</th>
                                    <th scope="col" style="text-align:right;">Requested To Issue</th>
                                    <th scope="col" style="text-align:right;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalOfTotal = $inprogressRow =  $outOfTermRow =  $requestedToIssueRow = 0;
                                //  echo "<pre>";
                                //  print_r($amountPerAdviser);
                                //  exit;
                                ?>
                                <?php //foreach ($amountPerAdviser as $index => $userData) : ?>
                                    <?php  $i = 1;?>
                                    <?php foreach ($amountPerAdviser as $user => $columns) : ?>
                                        <!-- <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $user; ?></td> -->
                                            <?php
                                            $total = 0;
                                            $k = 0;
                                            foreach ($columns as $value) {
                                                $amount = floatval(str_replace('$', '', $value));
                                                $total += $amount;
                                                $totalOfTotal += $amount;
                                                    if ($k == 0) {
                                                        $inprogressRow += $amount;
                                                    } elseif ($k == 1) {
                                                        $outOfTermRow += $amount;
                                                    } elseif ($k == 2) {
                                                        $requestedToIssueRow += $amount;
                                                    }
                                                $k++;
                                               // echo '<td style="text-align:right;">$' . number_format($amount, 2) . '</td>';
                                            }
                                            ?>
                                            <!-- <td style="text-align:right;"><?php echo '$' . number_format($total, 2); ?></td> -->
                                        </tr>
                                    <?php $i++; endforeach; ?>
                                <?php //endforeach; ?>
                                <!-- <tr>
                                    <td><?php echo $i; ?></th>
                                    <th>Grand Total</th>
                                    <th style="text-align:right;"><?php echo '$' . number_format($inprogressRow, 2); ?></th>
                                    <th style="text-align:right;"><?php echo '$' . number_format($outOfTermRow, 2); ?></th>
                                    <th style="text-align:right;"><?php echo '$' . number_format($requestedToIssueRow, 2); ?></th>
                                    <th style="text-align:right;"><?php echo '$' . number_format($totalOfTotal, 2) ?></th>
                                </tr> -->
                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail();?>
<?php $this->load->view('admin/projects/workflow_report/report_underwriting_by_adviser_js'); ?>
<script>
function myConfirm() {
    var result = confirm("Want to delete?");
    if (result == true) {
        return true;
    } else {
        return false;
    }
}
</script>
</body>
</html>