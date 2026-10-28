<div class="panel_s">
    <div class="panel-body">
        <div class="col-md-12">
            <h4 style="font-weight: 900; text-align: center;">Provider API</h4>
        </div><br> <br>
        <div class="row " style="margin-top:30px;">
        </div>
        <div class="table">
            <table class="table mt-5 choose_contact_table " id="choose_contact_table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Provider</th>
                        <th scope="col" style="text-align:right;">Client Groups</th>
                        <th scope="col" style="text-align:right;">Individuals</th>
                        <th scope="col" style="text-align:right;">Policies</th>
                        <th scope="col" style="text-align:right;">API</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($provider_summary as $row)
                    { 
                        
                        $apibeing_lapsed = $row['api'];
                        $total_client_data = $row['client_data'];
                        $total_life_assured = $row['life_assured'];
                        $total_policies = $row['policies'];

                        $dollerData      = mb_substr(trim($apibeing_lapsed), 0, 1);
                        if($dollerData == '$')
                        {
                            $numericdata      = substr(trim($apibeing_lapsed),1);
                            $sum_numeric_data = trim(str_replace(",", "", $numericdata));
                            $lapsed_api_total += $sum_numeric_data;
                        }
                        $lapsed_Api_total = '$'.number_format($lapsed_api_total ,2).'';

                        $tc += $total_client_data;
                        $tl += $total_life_assured;
                        $tp += $total_policies;
                    ?>
                    <tr>
                        <td><?php echo $row['provider']?></td>
                        <td style="text-align:right;"><?php echo $row['client_data']  ?></td>
                        <td style="text-align:right;"><?php echo $row['life_assured']  ?></td>
                        <td style="text-align:right;"><?php echo $row['policies']?></td>
                        <td style="text-align:right;"><?php echo $row['api']?></td>
                    </tr>
                    <?php
                        }?>
                    <tr>
                        <th scope="col">Total</th>
                        <th style="text-align:right;"><?php echo $tc; ?></th>
                        <th style="text-align:right;"><?php echo $tl; ?></th>
                        <th style="text-align:right;"><?php echo $tp; ?></th>
                        <th style="text-align:right;"><?php echo $lapsed_Api_total; ?></th>
                    </tr>
                    </tbody>
            </table>
        </div>
    </div>
</div>


<?php //$this->load->view('admin/clients/modals/client_review_report_js'); ?>