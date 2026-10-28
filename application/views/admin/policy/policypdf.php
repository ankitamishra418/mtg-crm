<!DOCTYPE html>
<html>
  <head>
    <title>Policy Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    .center {
      margin-left: 0px;
      width: 100%;
    }

    .margin{
      /* margin-top:20rem; */
      page-break-after:always;
    }




    .logo-image {
      width: 18%;
      height: 14%;
      overflow: hidden;
      margin-top: -6px;
    }

    .address {
      font-size: 12px;
      line-height: 0.1;
      font-family: Arial, Helvetica, sans-serif;
      color: #6c757d;
    }

    footer {
      position: fixed;
      bottom: -50px;
      left: 0px;
      right: 0px;
      height: 50px;
      font-size: 12px !important;
    }
    </style>
  </head>
  <body>
    <div>
      <?php
      // $path = '/var/www/html/httpdocs/assets/images/Logo_RGB.jpg';
      // $type = pathinfo($path, PATHINFO_EXTENSION);
      // $data = file_get_contents($path);
      // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      ?>
      <!-- <img class="logo-image" src="<?php //echo $base64 ?>" > -->

      <!-- <img class="logo-image" src="<?php //  echo base_url('assets/images/Logo_RGB.jpg') ?>" alt="">

      </br></br>
      <p class="address">phone: +64 09 630 5884</p>
      <p class="address">email: info@mauricetrapp.com</p>
      <p class="address">claims support: claims@mauricetrapp.com</p>
    </div> -->

    <div style="width: 100%; display: table;">
      <div style="display: table-cell; text-align: right;  ">

          <img style="height:100px; width: 198px;" class="logo-image" src="<?php echo base_url('assets/images/Logo_RGB.jpg') ?>" alt="">
          </br></br>
          <p class="address">phone: +64 09 630 5884</p>
          <p class="address">email: info@mauricetrapp.com</p>
          <p class="address">claims support: claims@mauricetrapp.com</p>
      </div>
    </div>



    <br>
    <h3>Policy Detail</h3><br>
    <table class='center'>
      <tr>
        <th>Client Group</th>
        <td>&nbsp; &nbsp;</td>
        <td><?php echo $data[0]['customer'];?></td>
        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        <th>Provider</th>
        <td>&nbsp; &nbsp;</td>
        <td><?php echo $data[0]['provider'];?></td>
      </tr></br>
      <tr>
        <th>Policy Number</th>
        <td>&nbsp; &nbsp; &nbsp; &nbsp;</td>
        <td><?php echo $data[0]['policy_number'];?></td>
        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        <th>Policy Start Date</th>
        <td>&nbsp; &nbsp;</td>
        <td><?php echo $data[0]['start_date'];?></td>
      </tr></br>
      <tr>
        <th>Policy Status</th>
        <td>&nbsp; &nbsp;</td>
        <td><?php echo $data[0]['policy_status'];?></td>
        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        <th>Cover Type</th>
        <td>&nbsp; &nbsp; &nbsp;</td>
        <td><?php echo $data[0]['cover_type'];?></td>
      </tr></br>
      <tr>
        <th>Life Assured</th>
        <td>&nbsp; &nbsp;</td>
        <td><?php echo $data[0]['life_assured'];?></td>
        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        <th>Policy Owner</th>
        <td>&nbsp; &nbsp; &nbsp; &nbsp;</td>
        <td><?php echo $data[0]['policy_owner'];?></td>
      </tr></br>
      <tr>
        <th>Premium Amount</th>
        <td>&nbsp; &nbsp;</td>
        <td><?php echo $data[0]['total_frequency_premium'] ?></td>
        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        <th>Policy Fee</th>
        <td>&nbsp; &nbsp; &nbsp;</td>
        <td><?php echo $data[0]['policy_fee'];?></td>
      </tr></br>
      <tr>
        <th>Premium Frequency</th>
        <td>&nbsp; &nbsp;</td>
        <td><?php echo $data[0]['premium_frequency'];?></td>
        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        <th>Annual Premium</th>
        <td>&nbsp; &nbsp; &nbsp;</td>
          <td><?php echo $data[0]['total_premium'];?></td>
      </tr></br>
      <tr>
        <th>Scheme</th>
        <td>&nbsp; &nbsp;</td>
        <td><?php echo $data[0]['key_contact']; ?></td>
        <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        <th>Tag</th>
        <td>&nbsp; &nbsp; &nbsp;</td>
        <td><?php echo $data[0]['tagg'] ?></td>
      </tr><br>
    </table>
      <br><br><br>
      <hr class="margin">
     
      <h3>Benefits</h3><br>
    <table class="center">
    <?php
    for ($i=0; $i<count($benefits); $i++){ 
      $keys = array_keys($benefits[$i]['policy_benefits'][0]);
      $arraySize = count($benefits[$i]['policy_benefits'][0]);
      $j=0;
      if($benefits[$i]['contact_id']){ ?>

        <?php if(isset($benefits[$i]['updated_at'])){ ?>
        <div style="font-size: 12px !important;">Updated At: <?php if($benefits[$i]['updated_at']==00-00-0000 && $benefits[$i]['updated_at']==Null){ echo '-'; } else { echo $startdate = date("d-m-Y", strtotime($benefits[$i]['updated_at'])); } ?></div>
        <?php  } ?>
        <tr style="background-color:#566de2; color:white;">
          <th><?php echo $benefits[$i]['contact_id'];?></th>
          <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
          <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
          <th><?php echo $benefits[$i]['title'];?></th>
          
        </tr><?php 
      }
      for($j=0; $j < $arraySize; $j++) { ?>
        <tr>
          <th><?php  echo str_replace("_"," ","$keys[$j]")?></th>
          <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
          <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
          <?php if(is_array($benefits[$i]['policy_benefits'][0][$keys[$j]])){ ?>
          <td><?php echo implode(",",$benefits[$i]['policy_benefits'][0][$keys[$j]]);?></td>
          <?php 
          } else { ?>
          <td>
            <?php 
            $dataRowValue = $benefits[$i]['policy_benefits'][0][$keys[$j]];
            $dollerData = mb_substr($dataRowValue, 0, 1);
            $date = $dataRowValue;
            if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
              $timestamp = strtotime($dataRowValue);
              echo date("d/m/Y", $timestamp);
            }
            elseif($dollerData == '$' || is_numeric($dataRowValue)){
              if($dollerData == '$'){
                // $str = substr($dataRowValue, 1);
                // if(is_numeric($str)){
                //   //echo '$'. number_format($str);
                //   echo '$'.number_format(($str) ,2).''; 
                // }
                echo $dataRowValue;
              }
              else{
                if(is_numeric($dataRowValue)){
                  //echo '$'. number_format($dataRowValue);
                  echo '$'.number_format(($dataRowValue) ,2).''; 
                }
              }
            }
            else{
              echo $dataRowValue;
            }
            ?>
          </td>
          <?php 
          } ?>
        </tr>
        <?php 
      } 
      ?></br>
      <hr style="width:300% !important">
      <?php  
    } ?>
    </table>
    <footer>
      <p><?php echo (strtoupper($companyPolicies[0]['policy']['customer'])) . '- ' . 'Schedule of Insurances' . ' -' .  ($currentDate) ;  ?></p>
    </footer>
  </body>
</html>