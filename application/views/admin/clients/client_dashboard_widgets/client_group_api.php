<div class="panel_s">
    <div class="panel-body" id="panel">
        <div class="col-md-12">
            <h4 style="font-weight: 900; text-align: center;">Client Group API</h4>
        </div><br> <br>

        
        <div class="row " style="margin-top:30px;">
        </div>
        <div class="table">
            <table class="table mt-5 choose_contact_table " id="choose_contact_table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Client Group</th>
                        <th scope="col" style="text-align:right;">Individuals</th>

                        <th scope="col" style="text-align:right;">Policies</th>

                        <th scope="col" style="text-align:right;">API</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($client_group_api as $row)
                    { 
                       
                    $individual      = $row['individual_name'];
                    $apibeing_lapsed = $row['api'];
                    $count_policy = $row['count_policy'];

                    $dollerData      = mb_substr(trim($apibeing_lapsed), 0, 1);
                    if($dollerData == '$'){
                        $numericdata      = substr(trim($apibeing_lapsed),1);
                        $sum_numeric_data = trim(str_replace(",", "", $numericdata));
                        $lapsed_api_total += $sum_numeric_data;
                    }
                    $lapsed_Api_total = '$'.number_format($lapsed_api_total ,2).'';

                    if($individual)
                    {
                        $individual_total = $individual_total + $individual;
                    }

                    if($count_policy)
                    {
                        $count_policy_total = $count_policy_total + $count_policy;
                    }
                    ?>
                    <tr>
                        <td><?php echo $row['customer_name']  ?></td>
                        <td style="text-align:right;"><?php echo $row['individual_name']  ?></td>

                        <td style="text-align:right;"><?php echo $row['count_policy']  ?></td>
                        <td style="text-align:right;"><?php echo $row['api']  ?></td>

                    </tr>
                    <?php } ?>
                    <tr>
                        <th scope="col">Total</th>
                        <th style="text-align:right;"><?php echo $individual_total; ?></th>
                        <th style="text-align:right;"><?php  echo $count_policy_total; ?></th>
                        <th style="text-align:right;"><?php  echo $lapsed_Api_total; ?></th>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

    // $(document).ready(function() {
    // $('#choose_contact_table').DataTable({
    //     // alert('ekhfjdf');
    //     "order": [],
    // });
    // });
</script>

