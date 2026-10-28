<!DOCTYPE html>
<html>
<style>
.heading {
    font-family: Arial, Helvetica, sans-serif;
    color: #084c64;
    font-size: 20px;
    font-weight: bold;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.heading2 {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.table1 {
    width: 100%;
}

.table2 {
    width: 100%;
}

table,
th,
td {
    border: solid 0.1px black;
    border-collapse: collapse;
    text-align: center;
}

th {
    background-color: #084c64;
    color: white;
    font-family: Arial, sans-serif;
    padding: 2px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

td {
    font-family: Arial, sans-serif;
    font-size: 14px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.first {
    width: 50px;
}

.Benefit {
    width: 300px;
}

.fourth {
    width: 5px;
}

.Loadings {
    width: 80px;
}

.Assured {
    width: 50px;
}

.Owner {
    width: 100px;
}

.Premium {
    width: 80px;
}

.table2-padding {
    background-color: #084c64;
    color: white;
    font-family: Arial, sans-serif;
    padding: 5px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.adviser {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
    font-weight: bold;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.adviserHeading {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.total {
    background-color: #01728E;
    color: white;
}

.policyNumber {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
    font-weight: bold;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.bottomBorder {
    border-bottom: 1px solid black;
}

ul li {
    font-size: 14px;
    line-height: 1;
}

footer {
    position: fixed;
    bottom: -50px;
    left: 0px;
    right: 0px;
    height: 50px;
    font-size: 12px !important;
}

.logo-image {
    width: 45%;
    height: 14%;
    overflow: hidden;
    margin-top: -6px;
}

.address {
    font-size: 13px;
    line-height: 0.1;
    font-family: Arial, Helvetica, sans-serif;
    color: #6c757d;
}
</style>

<body>
    <div style="width: 100%; display: table;">
        <div style="display: table-row">
            <div style="width: 600px; display: table-cell;">
                <h2 class="heading">
                    <?php echo strtoupper($companyPolicies[0]['policy']['customer']); ?>
                </h2>
                <p class="heading2">Schedule of Insurances</p>
                <p class="adviser"><?php echo $currentDate; ?></p>
                <p class="adviserHeading">Adviser: <span class="adviser"><?php echo ucwords($adviserData); ?> </span>
                </p>
            </div>
            <div style="display: table-cell; text-align: right; ">
                <img class="logo-image" src="<?php echo base_url('assets/images/Logo_RGB.jpg') ?>" alt="">
                </br></br>
                <p class="address">phone: +64 09 630 5884</p>
                <p class="address">email: info@mauricetrapp.com</p>
                <p class="address">claims support: claims@mauricetrapp.com</p>
            </div>
        </div>
    </div>
    <table class="table1">
        <tr>
            <th class="first">Policy # Company</th>
            <th class="first">Start Date</th>
            <th class="Owner">Owner</th>
            <table class="table1">
                <tr>
                    <th class="Assured">Assured</th>
                    <th class="Benefit">Benefit</th>
                    <th class="Loadings">Loadings / Exclusions</th>
                    <th class="Premium">Monthly Premium</th>
                </tr>
            </table>
        </tr>
        <?php 
            foreach($companyPolicies as $company) { 
                $assuredArray = [];
                $occurrenceCount = [];
                foreach($company['benefits'] as $benefitDetails) {
                $assuredArray[] = $benefitDetails['contact_id'];
                $occurrenceCount = array_count_values($assuredArray);
            }  
        ?>
        <tr>
            <td class="policyNumber">
                <?php echo $company['policy']['policy_number'].' '.$company['policy']['provider']; ?> </td>
            <td> <?php echo date("d/m/Y", strtotime($company['policy']['start_date'])) ?> </td>
            <td><?php echo $company['policy']['policy_owner'] ?></td>
            <td>
                <table class="table1">
                    <?php
                    $lifeAssured = explode(',', $company['policy']['life_assured']);
                    $assuredCount = count($lifeAssured);
                    foreach ($lifeAssured as $lifeAss) { ?>
                    <tr>
                        <td class="tdAssured" style=" width: 93px;">
                            <div> <?php echo $lifeAss ?> </div>
                        </td>
                        <td>
                            <table class="table1">
                                <?php
                                $lifeAssur = $lifeAss;
                                $benefitCount = count($company['benefits']);
                                foreach($company['benefits'] as $benefitDetails) {
                                $lifeAssur = $lifeAss;
                                if (in_array($lifeAssur , $benefitDetails)) {
                                ?>

                                <tr>
                                    <td class="" style=" width: 425px;">
                                        <?php
                                        $sortBenefit = [];
                                        foreach ($benefitDetails['policy_benefits'][0] as $key => $value) {
                                            $sortBenefit[] = $value;
                                        }
                                        ?>
                                        <div style="margin:10px;">
                                            <div>
                                                <?php echo '$'.number_format($sortBenefit[0]).' '.$benefitDetails['title']; ?>
                                            </div>
                                            <div>
                                                <?php 
                                            if (is_array($sortBenefit[4] == 1) && (!is_array($sortBenefit[4]))) {
                                                foreach ($sortBenefit[4] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                } 
                                            } else {
                                                if (strtolower($sortBenefit[4]) != 'no' && !is_array($sortBenefit[4]) && $sortBenefit[4]!='') {
                                                    echo $sortBenefit[4].', ';
                                                }
                                            }
                                            ?>
                                                <?php echo ' (';

                                            if (is_array($sortBenefit[5] == 1) && (!is_array($sortBenefit[5]))) {
                                                foreach ($sortBenefit[5] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[5]) != 'no' && !is_array($sortBenefit[5]) && $sortBenefit[5]!='') {
                                                    echo $sortBenefit[5].', ';
                                                }
                                            }

                                            if (is_array($sortBenefit[6] == 1 && (!is_array($sortBenefit[6])))) {
                                                foreach ($sortBenefit[6] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[6]) != 'no' && !is_array($sortBenefit[6]) && $sortBenefit[6]!='') {
                                                    echo $sortBenefit[6].', ';
                                                }
                                            }

                                            if (is_array($sortBenefit[7] == 1 && (!is_array($sortBenefit[7])))) {
                                                foreach ($sortBenefit[7] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[7]) != 'no' && !is_array($sortBenefit[7]) && $sortBenefit[7]!='') {
                                                    echo $sortBenefit[7].', ';
                                                }
                                            }
                                        
                                            if (is_array($sortBenefit[8] == 1 && (!is_array($sortBenefit[8])))) {
                                                foreach ($sortBenefit[8] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[8]) != 'no' && !is_array($sortBenefit[8]) && $sortBenefit[8]!='') {
                                                    echo $sortBenefit[8].', ';
                                                }
                                            }

                                            if (is_array($sortBenefit[9] == 1 && (!is_array($sortBenefit[9])))) {
                                                foreach ($sortBenefit[9] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[9]) != 'no' && !is_array($sortBenefit[9]) && $sortBenefit[9]!='') {
                                                    echo $sortBenefit[9].', ';
                                                }
                                            }

                                            if (is_array($sortBenefit[10] == 1) && (!is_array($sortBenefit[10]))) {
                                                foreach ($sortBenefit[10] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[10]) != 'no' && !is_array($sortBenefit[10]) && $sortBenefit[10]!='') {
                                                    echo $sortBenefit[10].', ';
                                                }
                                            }

                                            if (is_array($sortBenefit[11] == 1) && (!is_array($sortBenefit[11]))) {
                                                foreach ($sortBenefit[11] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[11]) != 'no' && !is_array($sortBenefit[11]) && $sortBenefit[11]!='') {
                                                    echo $sortBenefit[11].', ';
                                                }
                                            }

                                            if (is_array($sortBenefit[12] == 1) && (!is_array($sortBenefit[12]))) {
                                                foreach ($sortBenefit[12] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[12]) != 'no' && !is_array($sortBenefit[12]) && $sortBenefit[12]!='') {
                                                    echo $sortBenefit[12].', ';
                                                }
                                            }

                                            if (is_array($sortBenefit[13] == 1) && (!is_array($sortBenefit[13]))) {
                                                foreach ($sortBenefit[13] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData.', ';
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[13]) != 'no' && !is_array($sortBenefit[13]) && $sortBenefit[13]!='') {
                                                    echo $sortBenefit[13].', ';
                                                }
                                            }

                                            if (is_array($sortBenefit[14] == 1) && (!is_array($sortBenefit[14]))) {
                                                foreach ($sortBenefit[14] as $rowData) {
                                                    if (strtolower($rowData) != 'no') {
                                                        echo $rowData;
                                                    }
                                                }
                                            } else {
                                                if (strtolower($sortBenefit[14]) != 'no' && !is_array($sortBenefit[14]) && $sortBenefit[14]!='') {
                                                    echo $sortBenefit[14];    
                                            }
                                            echo ')'; 
                                            ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <td style=" width: 124px;">
                                        <?php 
                                        $sortBenefit = [];
                                        foreach ($benefitDetails['policy_benefits'][0] as $key => $value) {
                                            $sortBenefit[] = $value;
                                        } ?>
                                        <div style="margin:10px;">
                                            <div>
                                                <?php  
                                                if (is_array($sortBenefit[2] == 1)) {
                                                    foreach ($sortBenefit[2] as $rowData) {
                                                        if (strtolower($rowData) != 'no') { ?>
                                                        <div><?php echo $rowData.' / '; ?></div>
                                                        <?php  
                                                        }
                                                    }
                                                } else {
                                                    if (strtolower($sortBenefit[2]) != 'no') {
                                                        ?>
                                                        <div><?php  echo $sortBenefit[2].' / '; ?></div>
                                                        <?php 
                                                    }
                                                } ?>
                                            </div>
                                            <div>
                                                <?php if (is_array($sortBenefit[3] == 1)) {
                                                    foreach ($sortBenefit[3] as $rowData) {
                                                        if (strtolower($rowData) != 'no') {
                                                            ?>
                                                            <div><?php  echo $rowData; ?></div>
                                                            <?php 
                                                        }
                                                    }
                                                } else {
                                                    if (strtolower($sortBenefit[3]) != 'no') {
                                                        ?>
                                                        <div><?php  echo $sortBenefit[3]; ?></div>
                                                        <?php 
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td style=" width: 113px;">
                                        <?php
                                        $sortBenefit = [];
                                        foreach ($benefitDetails['policy_benefits'][0] as $key => $value) {
                                            $sortBenefit[] = $value;
                                        }
                                        ?>
                                        <?php
                                        if (is_array($sortBenefit[1] == 1)) {
                                            foreach ($sortBenefit[1] as $rowData) {
                                                if (strtolower($rowData) != 'no') { 
                                                if ($amountCount != $cycleA) {    
                                                ?>
                                        <div class=""> <?php echo '$'. $rowData; ?></div>
                                        <?php    }
                                            } else { ?>
                                        <div> <?php echo '$'. $rowData; ?></div>
                                        <?php    }
                                            }
                                        } else {
                                            if (strtolower($sortBenefit[1]) != 'no' && !is_array($sortBenefit[1]) && $sortBenefit[1]!='') { 
                                                if ($amountCount != $cycleA) { ?>
                                        <div class="" style="margin:15px"><?php echo '$'. $sortBenefit[1]; ?></div>
                                        <?php    } else { ?>
                                        <div><?php echo '$'. $sortBenefit[1]; ?></div>
                                        <?php } ?>
                                        <?php }  } ?>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </table>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="total"
                style=" height:25px; border-left:none!important; border-right:none!important; border-top:none!important;">
            </td>
            <td>
                <table style="width:100%;">
                    <tr>
                        <td class="total" style="width:650px; height:25px;  border-top:none!important; ">
                            <?php echo 'Total Monthly Premium (including $'.$company['policy']['policy_fee'].' policy fee)' ?>
                        </td>
                        <td style="width:115px;  border-top:none!important;" class="total">
                            <?php echo '$'.number_format((float)$company['policy']['total_premium'] / 12, 2, '.', ''); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php  } ?>
    </table>
    </div>
    <br><br>
    <?php foreach($lifeAsuredMembers as $lifeAsuredMember){  ?>
    <div style="width: 100%; display: table;">
        <div style="display: table-row">
            <div style="width: 500px; display: table-cell;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td><?php
                        $original_date = $lifeAsuredMember['dob'];
                        if($original_date == 0000-00-00 || $original_date == NULL){
                        echo NULL;
                        }
                        else {
                            $timestamp = strtotime($original_date);
                        echo date("d/m/Y", $timestamp);
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td>Smoker Status *</td>
                        <td value=""> <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                </table>
                <p>*If previously a smoker – please confirm the date you stop smoking <br>
                    _______________
                </p>
            </div>
            <p style="display:none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

            <!-- <div style="display: table-cell; width: 450px; border: 1px solid #01728E; padding: 5px 8px 5px 8px;"> -->
            <!-- <div class="card" style=" border: 1px solid #808080;">
                    <div class="container">
                        <h6><b><?php //echo ($lifeAsuredMember[0]['firstname']) .' '. ($lifeAsuredMember[0]['lastname']); ?></b>
                        </h6>
                        <ul>
                            <li>Life (Pays on death or terminal illness)</li>
                            <li> Trauma (Pays upon diagnosis of a critical illness)</li>
                            <li>Total and permanent disablement</li>
                            <li>Income Protection (pays while unable to work <br> due to illness or injury)</li>
                            <li>Mortgage Protection</li>
                            <li>Medical (pays private medical costs)</li>
                        </ul>
                        <h6><b>Other Services</b></h6>
                        <ul>
                            <li>Fire and General</li>
                            <li>Accounting</li>
                            <li>Kiwisaver and investments</li>
                        </ul>
                    </div>
                </div> -->
            <!-- </div> -->
        </div>
    </div>
    <br>
    <?php } ?>
    <br><br><br>
    <!-- <div style=" border: 2px solid #084c64; width:100%; padding: 5px 8px 5px 8px;">
        <div style=" border: 1px solid #808080;">
            <h6 style="font-weight: bold;">Declaration</h6>
            <p style="line-height: 1; font-size:15px;"> The above covers and our personal details have discussed and are
                understood by me/us AND They are suitable
                to our requirements at the present time but will be reviewed again in 12 months <br><br>
                Should my/our circumstances change prior to the next review, we will contact Maurice Trapp Group Ltd
                with
                details of our new situation OR
                They are no longer suitable and require revision
                Signed & Dated:
                __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __
            </p>
        </div>
    </div> -->
    <footer>
        <p>
            <?php
        echo (strtoupper($companyPolicies[0]['policy']['customer'])) . '- ' . 'Schedule of Insurances' . ' -' .  ($currentDate) ;  ?>
        </p>
    </footer>
</body>

</html>