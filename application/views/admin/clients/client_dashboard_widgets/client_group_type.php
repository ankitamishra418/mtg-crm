<div class="panel_s">
    <div class="panel-body">
        <div class="col-md-12">
            <h4 style="font-weight: 900; text-align: center;">Client Group Type</h4>
        </div><br> <br>
        <div class="row " style="margin-top:30px;"></div>
        <div class="table">
            <table class="table mt-5 choose_contact_table " id="choose_contact_table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col" style="text-align:right;">Client Groups</th>
                        <th scope="col" style="text-align:right;">API</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($client_group_type as $row){ 

                        $total_client_count = $row['count'];
                        $apibeing_lapsed = $row['total_primium_added'];
                        $dollerData      = mb_substr(trim($apibeing_lapsed), 0, 1);
                        if($dollerData == '$'){
                            $numericdata      = substr(trim($apibeing_lapsed),1);
                            $sum_numeric_data = trim(str_replace(",", "", $numericdata));
                            $lapsed_api_total += $sum_numeric_data;
                        }
                        $lapsed_Api_total = '$'.number_format($lapsed_api_total ,2).'';

                        $cc += $total_client_count;
                    ?>
                    <tr>
                        <td><?php echo $row['client_type']?></td>
                        <td style="text-align:right;"><?php echo $row['count']  ?></td>
                        <td style="text-align:right;"><?php echo $row['total_primium_added']  ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th scope="col">Total</th>
                        <th style="text-align:right;"><?php  echo $cc; ?></th>
                        <th style="text-align:right;"><?php  echo $lapsed_Api_total; ?></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
