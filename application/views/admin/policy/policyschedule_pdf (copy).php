<!DOCTYPE html>
<html>
    <head>
        <title>
        <?php echo strtoupper($companyPolicies[0]['policy']['customer']) . '- Schedule'; ?>
        </title>
    </head>
<style>
.heading {
    font-family: Arial, Helvetica, sans-serif;
    color: #084c64;
    font-size: 24px;
    font-weight: bold;
}

.heading2 {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;
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
}

td {
    font-family: Arial, sans-serif;
    font-size: 14px;
}

.first {
    width: 50px;
}

.Benefit {
    width: 290px;
}

.fourth {
    width: 5px;
}

.Loadings {
    width: 84px;
}

.Assured {
    width: 62px;
}

.Owner {
    width: 100px;
}

.Premium {
    width: 76px;
}

.table2-padding {
    background-color: #084c64;
    color: white;
    font-family: Arial, sans-serif;
    padding: 5px;
}

.adviser {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
    font-weight: bold;
}

.adviserHeading {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
}

.total {
    background-color: #01728E;
    color: white;
}

.policyNumber {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 15px;
    font-weight: bold;
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

.break_page {
    page-break-after: always;
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
                <p class="adviser"><?php echo str_replace(' ','', $currentDate); ?></p>
                <p class="adviserHeading">Adviser: <span class="adviser"><?php echo ucwords($adviserData); ?> </span>
                </p>
            </div>
            <div style="display: table-cell; text-align: right; ">
                <?php
                    $path = '/var/www/mtgonline.app/httpdocs/assets/images/Logo_RGB.jpg';
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <img class="logo-image" src="<?php echo $base64 ?>" >
                </br></br>
                <p class="address">phone: +64 09 630 5884</p>
                <p class="address">email: info@mauricetrapp.com</p>
                <p class="address">claims support: claims@mauricetrapp.com</p>
            </div>
        </div>
    </div>
    <table class="table1 break_page">
    <thead style="display: table-header-group;">
        <tr>
            <th class="first" style="font-size:14px; font-weight:none!important;";>Policy # Company</th>
            <th class="first" style="font-size:14px; font-weight:none!important;";>Start Date</th>
            <th class="Owner" style="font-size:14px; font-weight:none!important;";>Owner</th>
            <table class="table1" style="font-size:14px; font-weight:none!important;";>
                <tr>
                    <th class="Assured" style="font-size:14px; font-weight:none!important;";>Assured</th>
                    <th class="Benefit" style="font-size:14px; font-weight:none!important;";>Benefit</th>
                    <th class="Loadings" style="font-size:14px; font-weight:none!important;";>Loadings / Exclusions</th>
                    <th class="Premium" style="font-size:14px; font-weight:none!important;";>Monthly Premium</th>
                </tr>
            </table>
        </tr>
        </thead>
        <?php 
            foreach($companyPolicies as $company) { 
                $assuredArray = [];
                $occurrenceCount = [];
                foreach($company['benefits'] as $benefitDetails) {
                $assuredArray[] = $benefitDetails['contact_id'];
                $occurrenceCount = array_count_values($assuredArray);
            }    
        ?>
        <tbody>
        <tr>
            <td class=""><div class="policyNumber"> <?php echo $company['policy']['policy_number']; ?> </div><div> <?php echo $company['policy']['provider']; ?></div> </td>
            
            <td> <?php echo date("d/m/Y", strtotime($company['policy']['start_date'])) ?> </td>
            <td >
            <?php  $str = $company['policy']['policy_owner']; 
                        $data = (explode(",",$str)); 
                        //print_r($data); ?>
                        <?php   foreach($data as $ownerdata){ ?>
                        <div><?php echo $ownerdata ?> </div>      
                        <?php } ?>
            </td>
            <td style="">
                <table class="table1" style="border:none!important;">
                    <?php
                    $lifeAssured = explode(',', $company['policy']['life_assured']);
                    $assuredCount = count($lifeAssured);
                    // $cycleA = 0;
                    foreach ($lifeAssured as $lifeAss) { ?>
                    <tr >
                        <td class="tdAssured" style="width:93px; border-left:none!important; border-top:none!important;">
                            <?php 
                            // $cycleA++;
                            // if ($assuredCount != $cycleA) { 
                            ?>
                            <!-- <div style="border-bottom: 1px solid black;"> <?php //echo $lifeAss ?> </div> -->
                            <?php  // } else { ?>
                            <div> <?php echo $lifeAss ?> </div>
                            <?php //echo $Assured; ?>
                        </td>
                        <td style=" border:none!important;" >
                            <table class="table1" style=" border:none!important;">
                                <?php
                                $lifeAssur = $lifeAss;
                                $benefitCount = count($company['benefits']);
                                foreach($company['benefits'] as $benefitDetails) {
                                $lifeAssur = $lifeAss;
                                if (in_array($lifeAssur , $benefitDetails)) {
                                ?>
                                <tr >
                                    <td class="" style=" width: 425px; border-left:none!important; border-top:none!important;">
                                        <?php
               
                                        // if(in_array())
                                        // $lastBenefit++;
                                        // $line++;
                                        $sortBenefit = [];
                                        foreach ($benefitDetails['policy_benefits'][0] as $key => $value) {
                                            $sortBenefit[] = $value;
                                        }
                                        ?>
                                        <?php 
                                        //f ($line == $occurrenceCount[$benefitDetails['contact_id']] && $benefitCount != $lastBenefit) { ?>
                                        <!-- //     <div class="bottomBorder"> -->
                                        <?php  
                                        //     $line = 0;
                                        // } 
                                        // else { ?>
                                        <div style="margin: 5px; ">
                                            <!-- <?php //} ?>  -->
                                            <div>
                                                <?php echo '$'.number_format($sortBenefit[0]).' '.$benefitDetails['title']; ?>
                                            </div>
                                            <div >
                                                <?php //number_format($num, 2);
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
                                                   // echo $sortBenefit[8].', ';
                                                    $date = date_create($sortBenefit[8].', ');
                                                    echo date_format($date,"d/m/Y");
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
                                                    //echo $sortBenefit[9].', ';
                                                    $date = date_create($sortBenefit[9].', ');
                                                    echo date_format($date,"d/m/Y");
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
                                                   // echo $sortBenefit[10].', ';
                                                    $date = date_create($sortBenefit[10].', ');
                                                    echo date_format($date,"d/m/Y");
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
                                                    //echo $sortBenefit[11].', ';
                                                    $date = date_create($sortBenefit[11].', ');
                                                    echo date_format($date,"d/m/Y");
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
                                                    // echo $sortBenefit[12].', ';
                                                    $date = date_create($sortBenefit[12].', ');
                                                    echo date_format($date,"d/m/Y");
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
                                                    //  echo $sortBenefit[13];
                                                    $date = date_create($sortBenefit[13].', ');
                                                    echo date_format($date,"d/m/Y");
                                                    // echo date("d/m/Y" , $sortBenefit[13]);
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
                                                    // echo $sortBenefit[14];
                                                     $date = date_create($sortBenefit[14]);
                                                    echo date_format($date,"d/m/Y");
                                                    
                                                    // echo date("d/m/Y" , $sortBenefit[14]);
                                                
                                            }
                                            echo ')'; 
                                            ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </td>
                                    <td style=" width: 124px; border-top:none!important;">
                                        <?php 
                
                                        $sortBenefit = [];
                                        foreach ($benefitDetails['policy_benefits'][0] as $key => $value) {
                                            $sortBenefit[] = $value;
                                        } ?>
                                        <?php 
                                        // if ($line == $occurrenceCount[$benefitDetails['contact_id']] && $benefitCount != $lastBenefit) {     
                                        ?>
                                        <!-- <div class="bottomBorder"> -->
                                        <?php
                                        //  $line = 0;
                                        // } else { ?>
                                        <div style="margin:5px">
                                            <?php  //  } ?>
                                            <div>
                                                <?php  
                                                if (is_array($sortBenefit[2] == 1)) {
                                                    foreach ($sortBenefit[2] as $rowData) {
                                                        if (strtolower($rowData) != 'no') { ?>
                                                        <div><?php echo $rowData.' / '; ?></div>
                                                        <?php    }
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
                                            <td style=" width: 113px; border-top:none!important; border-right:none!important; ">
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
                                                        <div class=""> <?php echo '$'. number_format($rowData); ?></div>
                                                        <?php    }
                                                        } else { ?>
                                                        <div> <?php echo '$'. number_format($rowData); ?></div>
                                                        <?php    }
                                                    }
                                                } else {
                                                    if (strtolower($sortBenefit[1]) != 'no' && !is_array($sortBenefit[1]) && $sortBenefit[1]!='') { 
                                                        if ($amountCount != $cycleA) { ?>
                                                        <div class="" style="margin:15px"><?php echo '$'. $sortBenefit[1]; ?></div>
                                                        <?php    } else { ?>
                                                        <div><?php echo '$'. number_format($sortBenefit[1],2).''; ?></div>
                                                        <?php }
                                                        ?>
                                                        <?php }
                                                } ?>
                                                    <?php  ?>
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
                <tr style="border:none!important;">
                    <td colspan="3" class="total"
                        style=" height:25px; border:none!important;" >
                    </td>
                    <td >
                        <table style="width:100%; border:none!important;">
                            <tr style="border:none!important;">
                                <td class="total" style="width:650px; height:25px;    border:none!important; ">
                                    <?php echo 'Total Monthly Premium (including $'.number_format($company['policy']['policy_fee']).' policy fee)' ?>
                                </td>
                                <td style="width:115px;  border:none!important;" class="total">
                                    <?php echo '$'.number_format($company['policy']['total_premium'] / 12,2).''; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
        <?php  } ?>
    </table>
    </div>
    <br><br>
    <?php
    $assData = count($lifeAsuredMembers); 
    ?>
    <div style="width: 100%; display: table;">
        <?php   ?>
        <div style="display: table-row">
            <?php $i=0; foreach($lifeAsuredMembers as $lifeAsuredMember){  
           ?>
            <?php if($i==0) { ?>
            <div style="width: 485px; display: table-cell;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
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
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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
            <?php  }  ?>
            <?php   if($i == 1){  ?>
            <div style="width: 485px; margin-left:55px;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
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
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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
            <?php  } $i++; } ?>
        </div>
    </div>
    <div style="width: 100%; display: table;">
        <?php   ?>
        <div style="display: table-row">
            <?php $i=0; foreach($lifeAsuredMembers as $lifeAsuredMember){  
           ?>
            <?php if($i==2) { ?>
            <div style="width: 485px; display: table-cell;">

                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td >Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td >Phone</td>
                        <td><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td>Smoker Status *</td>
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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
            <?php  }  ?>
            <?php   if($i == 3){  ?>
            <div style="width: 485px; margin-left:55px;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
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
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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

            <?php  } $i++; } ?>
        </div>
    </div>
    <div style="width: 100%; display: table;">
        <?php   ?>
        <div style="display: table-row">
            <?php $i=0; foreach($lifeAsuredMembers as $lifeAsuredMember){  
           ?>
            <?php if($i==4) { ?>
            <div style="width: 485px; display: table-cell;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td >Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td >Phone</td>
                        <td><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td>Smoker Status *</td>
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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
            <?php  }  ?>
            <?php   if($i == 5){  ?>
            <div style="width: 485px; margin-left:55px;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
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
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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
            <?php  } $i++; } ?>
        </div>
    </div>
    <div style="width: 100%; display: table;">
        <?php   ?>
        <div style="display: table-row">
            <?php $i=0; foreach($lifeAsuredMembers as $lifeAsuredMember){  
           ?>
            <?php if($i==6) { ?>
            <div style="width: 485px; display: table-cell;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td >Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td >Phone</td>
                        <td><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td>Smoker Status *</td>
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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
            <?php  }  ?>
            <?php   if($i == 7){  ?>
            <div style="width: 485px; margin-left:55px;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
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
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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
            <?php  } $i++; } ?>
        </div>
    </div>
    <div style="width: 100%; display: table;">
        <?php   ?>
        <div style="display: table-row">
            <?php $i=0; foreach($lifeAsuredMembers as $lifeAsuredMember){  
           ?>
            <?php if($i==8) { ?>
            <div style="width: 485px; display: table-cell;">

                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td >Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td >Phone</td>
                        <td><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td>Smoker Status *</td>
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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
            <?php  }  ?>
            <?php   if($i == 9){  ?>
            <div style="width: 485px; margin-left:55px;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2" style="text-left; font-size:14px; font-weight:none!important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>
                            <?php
                                $original_date = $lifeAsuredMember['dob'];
                                if($original_date == 0000-00-00 || $original_date == NULL){
                                echo NULL;
                                }
                                else {
                                    $timestamp = strtotime($original_date);
                                echo date("d/m/Y", $timestamp);
                                }
                            ?>
                        </td>
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
                        <td value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
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
            <?php  } $i++; } ?>
        </div>
    </div>
    <footer>
        <p>
            <?php
        echo (strtoupper($companyPolicies[0]['policy']['customer'])) . '- ' . 'Schedule of Insurances' . ' -' .  ($currentDate) ;  ?>
        </p>
    </footer>
</body>

</html>
