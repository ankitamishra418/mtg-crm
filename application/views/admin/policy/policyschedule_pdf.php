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
    width: 350px;
}

.fourth {
    width: 5px;
}

.Loadings {
    width: 50px;
}

.Assured {
    width: 60px;
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
.formatted-btn {
    background: #01728E;
    padding: 10px;
    text-decoration: none;
    font-family: Arial, Helvetica, sans-serif !important;
    color: #ffff;
    font-weight: 400;
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
                    $path = '/var/www/html/httpdocs/assets/images/Logo_RGB.jpg';
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <img class="logo-image" src="<?php echo $base64 ?>" >
                <!-- <img class="logo-image" src="<?php // echo base_url('assets/images/Logo_RGB.jpg') ?>" alt=""> -->
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
                <th class="first" style="font-size:14px; font-weight:none!important;" ;>Policy # Company</th>
                <th class="first" style="font-size:14px; font-weight:none!important;" ;>Start Date</th>
                <th class="Owner" style="font-size:14px; font-weight:none!important;" ;>Owner</th>
                <table class="table1" style="font-size:14px; font-weight:none!important;" ;>
                    <tr>
                        <th class="Assured" style="font-size:14px; font-weight:none!important;" ;>Assured</th>
                        <th class="Benefit" style="font-size:14px; font-weight:none!important;" ;>Benefit</th>
                        <th class="Loadings" style="font-size:14px; font-weight:none!important;" ;>Loadings / Exclusions
                        </th>
                        <th class="Premium" style="font-size:14px; font-weight:none!important;" ;>Premium</th>
                    </tr>
                </table>
            </tr>
        </thead>
        <?php 
        
            foreach($companyPolicies as $company) 
            { 
                $assuredArray = [];
                $occurrenceCount = [];
                foreach($company['benefits'] as $benefitDetails) 
                {
                    $assuredArray[] = $benefitDetails['contact_id'];
                    $occurrenceCount = array_count_values($assuredArray);
                }    
        ?>
        <tbody>
            <tr>
                <td class="">
                    <div class="policyNumber"> <?php echo $company['policy']['policy_number']; ?> </div>
                    <div> <?php echo $company['policy']['provider']; ?></div>
                </td>

                <td> <?php echo date("d/m/Y", strtotime($company['policy']['start_date'])) ?> </td>
                <td>
                    <?php   $str = $company['policy']['policy_owner']; 
                        $data = (explode(",",$str)); 
                    ?>
                    <?php   foreach($data as $ownerdata){ ?>
                    <div><?php echo $ownerdata ?> </div>
                    <?php } ?>
                </td>
                <td style="">
                    <table class="table1" style="border:none!important;">
                        <?php
                    $lifeAssured = explode(',', $company['policy']['life_assured']);
                    $assuredCount = count($lifeAssured);
                    
                    foreach ($lifeAssured as $lifeAss) 
                    {  ?>
                        <tr>
                            <td class="tdAssured"
                                style="width:85px; border-left:none!important; border-top:none!important;">
                                <?php 
                            ?>
                                <div> <?php echo $lifeAss ?> </div>
                            </td>
                            <td style="border:none!important;">
                                <table class="table1" style=" border:none!important;">
                                    <?php
                                $lifeAssur = $lifeAss;
                                $benefitCount = count($company['benefits']);
                                
                                foreach($company['benefits'] as $benefitDetails) {

                                $lifeAssur = $lifeAss;
                                if (in_array($lifeAssur , $benefitDetails)) 
                                {
                                    ?>
                                    <tr>
                                        <td style="width:350px;">
                                            <?php
                                            $sortBenefit = [];
                                            foreach ($benefitDetails['policy_benefits'][0] as $key => $value) {
                                                $sortBenefit[] = $value;
                                            }
                                            ?>

                                            <!-- <div style="margin: 5px; "> -->
                                                <div style="font-weight:bold;">
                                                <?php
                                               
                                                $value = $sortBenefit[0];
                                                // print_r($value);
                                                $dollerData = mb_substr($sortBenefit[0], 0, 1);

                                                if($dollerData == '$')
                                                {
                                                    $value = $sortBenefit[0];
                                                    $pattern = '/^\$?\d{1,3}(,\d{3})*(\.\d{2})?$/';
                                                    // Check if the value matches the pattern
                                                    if (preg_match($pattern, $value)) 
                                                    {
                                                        // echo "$value is in currency format.";
                                                        echo $sortBenefit[0].' '.$benefitDetails['title'];
                                                    }
                                                    else 
                                                    {
                                                        // echo "$value is not in currency format.";
                                                        echo ''.number_format($value ,2).''.' '.$benefitDetails['title'];//added march 28
                                                    }
                                                }
                                                else 
                                                {
                                                    
                                                    // print_r($sortBenefit[0]);
                                                    // echo $value;
                                                    // $str = substr($sortBenefit[0], 1);
                                                    // echo"hiii";
                                                    
                                                    if(is_numeric($value))
                                                    {
                                                        echo ''. number_format($value ,2).'' .' '.$benefitDetails['title'];
                                                    }
                                                    else
                                                    {
                                                        echo ''. number_format($value ,2).'' .' '.$benefitDetails['title'];
                                                    }
                                                    
                                                }
                                                // exit;
                                                // $dollerData = mb_substr($sortBenefit[0], 0, 1);
                                               
                                                // if($dollerData == '$'){
                                                //     $str = substr($sortBenefit[0], 1);
    
                                                //     if(is_numeric($str)){
                                                //         echo '$'. number_format($str) .' '.$benefitDetails['title'];
                                                       
                                                //     }
                                                //     // echo number_format($sortBenefit[0]).' '.$benefitDetails['title']; 
                                                // }
                                                // elseif(is_numeric($dollerData)){
                                                //     echo '$'. number_format($sortBenefit[0]).' '.$benefitDetails['title'];
                                                //     echo $sortBenefit[0];
                                                // }
                                                // else{
                                                //     if(is_array($sortBenefit[0])){

                                                //         foreach ($sortBenefit[0] as $rowData) {
                                                //             if (strtolower($rowData) != 'no') {
                                                //                 echo $rowData.', ';
                                                //             }
                                                //         }
                                                //         echo ' '.$benefitDetails['title'];
                                                //     }
                                                //     else{
                                                //         echo ($sortBenefit[0]).' '.$benefitDetails['title']; 
                                                //     }
                                                // }
                                                ?>
                                                </div>
                                                <!-- <div> -->
                                                    <?php
                                                    // if (is_array($sortBenefit[4] == 1) && (!is_array($sortBenefit[4]))) {
                                                        
                                                    //     foreach ($sortBenefit[4] as $rowData) {
                                                    //         if (strtolower($rowData) != 'no') {
                                                    //             // if($rowData)
                                                    //             echo $rowData.', ';
                                                                
                                                    //         }
                                                    //     } 
                                                    // } else {
                                                    //     if (strtolower($sortBenefit[4]) != 'no' && !is_array($sortBenefit[4]) && $sortBenefit[4]!='' && $sortBenefit[4] != 'Select' ) {
                                                    //         echo $sortBenefit[4].', ';
                                                        
                                                    //     }
                                                    // }
                                            //  added today
                                           
                                            $output = ' (';

                                            // if (is_array($sortBenefit[5] == 1) && (!is_array($sortBenefit[5]))) {
                                            //     foreach ($sortBenefit[5] as $rowData) {
                                            //         if (strtolower($rowData) != 'no' && $rowData != 'Select') {
                                            //             $output .= $rowData . ', ';
                                            //         }
                                            //     }
                                            // } else {
                                            //     if (strtolower($sortBenefit[5]) != 'no' && !is_array($sortBenefit[5]) && $sortBenefit[5]!='' && $sortBenefit[5] != 'Select') {
                                            //         $output .= $sortBenefit[5] . ', ';
                                            //     }
                                            // }

                                            // start from 6 sort;
                                            for($i=4; $i <= 30; $i++){
                                                $na_variations = ['no','n/a', 'na', 'n a', 'not applicable', 'not-applicable'];
                                                if (is_array($sortBenefit[$i] == 1 && (!is_array($sortBenefit[$i])))) {
                                                    foreach ($sortBenefit[$i] as $rowData) {
                                                        // if (strtolower($rowData) != 'no' && $rowData != 'Select') {
                                                        if (!in_array(strtolower($rowData), $na_variations) && $rowData != 'Select') {
                                                            $output .= $rowData . ', ';
                                                        }
                                                    }
                                                // } elseif (strtolower($sortBenefit[$i]) != 'no' && !is_array($sortBenefit[$i]) && $sortBenefit[$i]!='' && $sortBenefit[$i] != 'Select') {
                                                } elseif (!in_array(strtolower($sortBenefit[$i]),$na_variations) && !is_array($sortBenefit[$i]) && $sortBenefit[$i]!='' && $sortBenefit[$i] != 'Select') {
                                                    $data = $sortBenefit[$i];
                                                    $dollerData = mb_substr($data, 0, 1);

                                                    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data)) {
                                                        $timestamp = strtotime($sortBenefit[$i]);
                                                        $output .= date("d/m/Y", $timestamp) . ', ';
                                                    } 
                                                    elseif($dollerData == '$' || is_numeric($data )) {
                                                        if($dollerData == '$') {
                                                            // $str = substr($data, 1);
                                                            // //  var_dump($str);
                                                            // if(is_numeric($numericValue)){
                                                            //     $output .= '$' . number_format($numericValue) . ', ';
                                                            // }

                                                            $values = explode('$', $data); 
                                                            foreach ($values as $value) {

                                                                if (trim($value) === '') {
                                                                    continue;
                                                                }
                                                                $str = str_replace(',', '', trim($value));
                                                                if (is_numeric($str)) {
                                                                    $formattedStr = '$' . number_format($str, 2);
                                                                    $output .= $formattedStr . ', ';
                                                                }
                                                            }

                                                        } else {
                                                            // today added
                                                             if(is_numeric($data) && $data != 0){ // Add the condition here
                                                                $output .= '$' . number_format($data) . ', ';
                                                            }
                                                              // today added
                                                            // if(is_numeric($data)  ){
                                                         
                                                            //     $output .= '$' . number_format($data) . ', ';
                                                           
                                                            // }
                                                        }
                                                    } else {
                                                        $output .= $sortBenefit[$i] . ', ';
                                                    }
                                                    
                                                } else {
                                                    foreach ($sortBenefit[$i] as $rowData) {
                                                        // if (strtolower($rowData) != 'no') {
                                                        if (!in_array(strtolower($rowData),$na_variations)) {
                                                            $output .= $rowData . ', ';
                                                        }
                                                    }
                                                }
                                            }

                                            $output = rtrim($output, ', ');

                                            $output .= ')';

                                            echo $output;
                                              // today added
                                            ?>
                                                    <!-- <1?php //echo ' (';
                                                    $finalString = '';

                                                    // if (is_array($sortBenefit[5] == 1) && (!is_array($sortBenefit[5]))) {
                                                    //     foreach ($sortBenefit[5] as $rowData) {
                                                    //         if (strtolower($rowData) != 'no' && $rowData != 'Select') {
                                                    //             //echo $rowData.', ';
                                                    //             $finalString.= $rowData.', ';
                                                    //         }
                                                    //     }
                                                    // } else {
                                                    //     if (strtolower($sortBenefit[5]) != 'no' && !is_array($sortBenefit[5]) && $sortBenefit[5]!='' && $sortBenefit[5] != 'Select') {
                                                    //         //echo $sortBenefit[5].', ';
                                                    //         $finalString.= $sortBenefit[5].', ';
                                                    //     }
                                                    // }

                                                    // start from 6 sort;
                                            
                                                for($i=4; $i <= 30; $i++)
                                                {
                                                
                                                if (is_array($sortBenefit[$i] == 1 && (!is_array($sortBenefit[$i])))) 
                                                {
                                                    foreach ($sortBenefit[$i] as $rowData) 
                                                    {
                                                        if (strtolower($rowData) != 'no' && $rowData != 'Select') 
                                                        {
                                                            //echo $rowData.', ';
                                                            $finalString.= $rowData.', ';
                                                        }
                                                    }
                                                } 
                                                elseif (strtolower($sortBenefit[$i]) != 'no' && !is_array($sortBenefit[$i]) && $sortBenefit[$i]!='' && $sortBenefit[$i] != 'Select' ) {
                                                    $data = $sortBenefit[$i];
                                                    $dollerData = mb_substr($data, 0, 1);

                                                    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data)) 
                                                    {
                                                        $timestamp = strtotime($sortBenefit[$i]);
                                                        //echo date("d/m/Y", $timestamp).', ';
                                                        $finalString.= date("d/m/Y", $timestamp).', ';
                                                    }

                                                    elseif($dollerData == '$' || is_numeric($data))
                                                    {
                                                        if($dollerData == '$')
                                                        {
                                                            $str = substr($data, 1);

                                                            if(is_numeric($str))
                                                            {
                                                                //echo '$'. number_format($str).', ';
                                                                $finalString.= '$'. number_format($str).', ';
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if(is_numeric($data))
                                                            {
                                                                //echo '$'. number_format($data).', ';
                                                                $finalString.= '$'. number_format($data).', ';
                                                            }
                                                        }
                                                    }
                                                    else
                                                    {
                                                        //echo $sortBenefit[$i] .', ';
                                                        $finalString.= $sortBenefit[$i] .', ';
                                                    }
                                                }
                                                else
                                                {
                                                    foreach ($sortBenefit[$i] as $rowData) 
                                                    {
                                                        if (strtolower($rowData) != 'no') 
                                                        {
                                                            //echo $rowData;
                                                            $finalString.= $rowData.',';
                                                        }
                                                    }
                                                }
                                            }
                                            // $explodedFinalString = explode(',', $finalString);
                                            // $countString = count($explodedFinalString);
                                            // $cs = 0;
                                            // echo '(';
                                            // foreach ($explodedFinalString as $explodedFinalStr) {
                                            //     $cs++;
                                            //     if ($cs < $countString && $explodedFinalStr != '') {
                                            //         echo $explodedFinalStr.', ';
                                            //     }
                                            //     if ($cs == $countString && $explodedFinalStr != '') {
                                            //         echo $explodedFinalStr;
                                            //     }
                                            // }
                                            // echo ')';
                                            $lastq = '('.$finalString.')'; 
                                            $lastsent = str_replace(", )", ")",$lastq);
                                            echo $lastsent;

                                            ?> -->

                                            <!-- </div> -->
                                            <?php 


                                            // if (is_array($sortBenefit[14] == 1) && (!is_array($sortBenefit[14]))) {
                                            //     foreach ($sortBenefit[14] as $rowData) {
                                            //         if (strtolower($rowData) != 'no') {
                                            //             echo $rowData;
                                            //         }
                                            //     }
                                            // } else {
                                            //     if (strtolower($sortBenefit[14]) != 'no' && !is_array($sortBenefit[14]) && $sortBenefit[14]!='') {
                                            //         echo $sortBenefit[14];
                                            //          $date = date_create($sortBenefit[14]);
                                            //         echo date_format($date,"d/m/Y");
                                            //     }
                                                ?>
                                            <!-- </div> -->
                                            <!-- </div> -->
                                            <?php //} ?>
                                        </td>
                                        <td style="width:70px;">
                                            <?php 
            
                                            $sortBenefit = [];
                                            foreach ($benefitDetails['policy_benefits'][0] as $key => $value) 
                                            {
                                                $sortBenefit[] = $value;
                                            } ?>

                                            <!-- <div style="margin:5px">
                                                <div> -->

                                                    <?php  
                                                    $doller_data = mb_substr($sortBenefit[2], 0, 1);

                                                if (is_array($sortBenefit[2] == 1)) 
                                                {
                                                    foreach ($sortBenefit[2] as $rowData) 
                                                    {
                                                        if (strtolower($rowData) != 'no') 
                                                        { ?>
                                                            <div><?php echo $rowData.' / '; ?></div>
                                                    <?php }
                                                    }
                                                } 
                                                else 
                                                {
                                                    if (strtolower($sortBenefit[2]) != 'no') 
                                                    {
                                                        ?>
                                                    <div><?php
                                                    // if($doller_data == '$'){
                                                    //     echo $sortBenefit[2].' / ';
                                                    // }
                                                    // if(is_numeric($doller_data)){
                                                    //     echo '$'. $sortBenefit[2].' / ';
                                                    // }
                                                    // else{
                                                        echo $sortBenefit[2].' / ';
                                                        // } ?></div>
                                                    <?php 
                                                    }
                                                } ?>
                                                <!-- </div>
                                                <div> -->
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
                                                    <div><?php  echo  $sortBenefit[3]; ?></div>
                                                    <?php 
                                                    }
                                                }
                                                ?>
                                                <!-- </div>
                                            </div> -->
                                        </td>
                                        <td style="width:75px;">
                                            <?php
                                            $sortBenefit = [];
                                            foreach ($benefitDetails['policy_benefits'][0] as $key => $value) {
                                                $sortBenefit[] = $value;
                                            }
                                            ?>
                                            <?php

                                            $rowDoller = $sortBenefit[1];
                                            $dollerData = mb_substr($rowDoller, 0, 1);
                                            // echo $dollerData;
                                            // exit;
                                            if (is_array($sortBenefit[1] == 1)) 
                                            {
                                                foreach ($sortBenefit[1] as $rowData)
                                                {
                                                    if (strtolower($rowData) != 'no')
                                                    { 
                                                        if ($amountCount != $cycleA)
                                                        {    
                                                            ?>
                                                            <div class=""> <?php echo '$'. number_format($rowData); ?></div>
                                                        <?php   
                                                        }
                                                    } 
                                                    else 
                                                    { ?>
                                                        <div> <?php echo '$'. number_format($rowData); ?></div>
                                                        <?php    
                                                    }
                                                }
                                            }
                                            else 
                                            {
                                                if (strtolower($sortBenefit[1]) != 'no' && !is_array($sortBenefit[1]) && $sortBenefit[1]!='') 
                                                { 
                                                    if ($amountCount != $cycleA) 
                                                    { ?>
                                                        <!-- <div class="" style="margin:15px"> -->
                                                            <?php 
                                                            if($dollerData == '$')
                                                            {
                                                                echo number_format($rowDoller, 2).''; 
                                                            }
                                                            elseif(is_numeric($dollerData))
                                                            {
                                                                echo '$'. number_format($rowDoller, 2).'';
                                                            } 
                                                            else
                                                            {
                                                                echo $rowDoller;
                                                            }

                                                            // $pattern = '/^\$?\d{1,3}(,\d{3})*(\.\d{2})?$/';
                                                            // // Check if the value matches the pattern
                                                            // if (preg_match($pattern, $rowDoller)) {
                                                            //     echo "$rowDoller is in currency format.";
                                                            // } else {
                                                            //     echo "$rowDoller is not in currency format.";
                                                            // }

                                                            ?>
                                                        <!-- </div> -->
                                                        <?php   
                                                    } 
                                                    else 
                                                    { ?>
                                                        <!-- <div> -->
                                                            <?php if($dollerData == '$')
                                                            {
                                                                echo ($rowDoller); 
                                                            }
                                                            elseif(is_numeric($dollerData))
                                                            {
                                                                echo '$'. number_format($rowDoller, 2).'';
                                                            } 
                                                            else
                                                            {
                                                               echo $rowDoller;
                                                            }
                                                            ?>
                                                        <!-- </div> -->
                                                        <?php 
                                                    }
                                                    ?>
                                                    <?php 
                                                }
                                            } 
                                            ?>
                                        </td>
                                    </tr>
                                    <?php 
                                } } 
                                ?>
                                </table>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
            <tr style="border:none!important;">
                <td colspan="3" class="total" style=" height:25px; border:none!important;">
                </td>
                <td>
                <table style="width:100%; border:none!important;">
                    <tr style="border:none!important;">
                        <td class="total" style="width:650px; height:25px;    border:none!important; ">
                            <?php echo 'Total ' . ucfirst($company['policy']['premium_frequency']) . ' Premium (including '.($company['policy']['policy_fee']).' policy fee)' ?>
                        </td>
                        <td style="width:115px;  border:none!important;" class="total">
                            <?php //echo '$'.number_format(($company['policy']['premium_amount']) + ($company['policy']['policy_fee']) ,2).''; ?>
                            <?php
                            $remove_doller_premium_amount       = substr(($company['policy']['premium_amount']), 1);
                            $remove_doller_policy_fee           = substr(($company['policy']['policy_fee']), 1);
                            $pattern                            = "/[,\s]/";
                            $remover_component_premium_amount   = preg_split($pattern, $remove_doller_premium_amount);
                            $array_to_string_primium            = implode(" ",$remover_component_premium_amount);
                            $remove_white_space_premium_amount  = str_replace(' ', '', $array_to_string_primium);
                            $remover_component_policy_fee       = preg_split($pattern, $remove_doller_policy_fee);
                            $array_to_string_policy_fee         = implode(" ",$remover_component_policy_fee);
                            $remove_white_space_policy_fee      = str_replace(' ', '', $array_to_string_policy_fee);
                            $total_primium_SUM_policyFee        = ($remove_white_space_premium_amount + $remove_white_space_policy_fee);
                            echo '$'.number_format($total_primium_SUM_policyFee ,2).'';
                            ?>
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
                        <th  class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important; ">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Date of Birth</td>
                        <td style="text-align: left !important; padding-left: 10px;">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px;" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker please confirm the date you stopped smoking <br>
                    _______________
                </p>
            </div>
            <?php  }  ?>
            <?php   if($i == 1){  ?>
            <div style="width: 485px; margin-left:55px;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Date of Birth</td>
                        <td style="text-align: left !important; padding-left: 10px;">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px;" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker please confirm the date you stopped smoking <br>
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

                <table class="table2" >
                    <tr>
                        <th class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Date of Birth</td>
                        <td style="text-align: left !important; padding-left: 10px;">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px;" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker please confirm the date you stopped smoking <br>
                    _______________
                </p>
            </div>
            <?php  }  ?>
            <?php   if($i == 3){  ?>
            <div style="width: 485px; margin-left:55px;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Date of Birth</td>
                        <td style="text-align: left !important; padding-left: 10px;">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px;" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px;"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker please confirm the date you stopped smoking <br>
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
                        <th class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Date of Birth</td>
                        <td style="text-align: left !important; padding-left: 10px;">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important  padding-left: 10px"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important;  padding-left: 10px"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker please confirm the date you stopped smoking <br>
                    _______________
                </p>
            </div>
            <?php  }  ?>
            <?php   if($i == 5){  ?>
            <div style="width: 485px; margin-left:55px;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Date of Birth</td>
                        <td style="text-align: left !important; padding-left: 10px">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker please confirm the date you stopped smoking <br>
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
                        <th class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Date of Birth</td>
                        <td style="text-align: left !important; padding-left: 10px">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker please confirm the date you stopped smoking <br>
                    _______________
                </p>
            </div>
            <?php  }  ?>
            <?php   if($i == 7){  ?>
            <div style="width: 485px; margin-left:55px;">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Date of Birth</td>
                        <td style="text-align: left !important; padding-left: 10px">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker please confirm the date you stopped smoking <br>
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
                        <th class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td  style="text-align: left !important;">Date of Birth</td>
                        <td  style="text-align: left !important; padding-left: 10px">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker please confirm the date you stopped smoking <br>
                    _______________
                </p>
            </div>
            <?php  }  ?>
            <?php   if($i == 9){  ?>
            <div style="width: 485px; margin-left:55px; ">
                <table class="table2">
                    <tr>
                        <th class="table2-padding" colspan="2"
                            style="text-left; font-size:14px; font-weight:none!important; text-align: left !important;">
                            <?php echo strtoupper($lifeAsuredMember['firstname']) .' '. strtoupper($lifeAsuredMember['lastname']);?>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Date of Birth</td>
                        <td style="text-align: left !important; padding-left: 10px">
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
                    <?php if(!$lifeAsuredMember['dependent'] == 1){ ?>
                    <tr>
                        <td style="text-align: left !important;">Phone</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['phonenumber'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Email</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo $lifeAsuredMember['email'];?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Smoker Status *</td>
                        <td style="text-align: left !important; padding-left: 10px" value="">
                            <?php if($lifeAsuredMember['smoker']==1){ echo "Yes";} else { echo "No";}?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left !important;">Address</td>
                        <td style="text-align: left !important; padding-left: 10px"><?php echo ($lifeAsuredMember['residential_address'] .', '. $lifeAsuredMember['residential_state'] .', '. $lifeAsuredMember['residential_city'] .', '. $lifeAsuredMember['residential_zipcode'] .', '. $lifeAsuredMember['residential_country'][0]['short_name']);?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <p>*If previously a smoker - please confirm the date you stopped smoking <br>
                    _______________
                </p>
            </div>
            <?php  } $i++; } ?>
        </div>
    </div>
    <footer>
        <p>
            <?php
        echo (strtoupper($companyPolicies[0]['policy']['customer'])) . ' - ' . 'Schedule of Insurances' . ' - ' .  (str_replace(' ','', $currentDate)) ;  ?>
        </p>
    </footer>
</body>

</html>