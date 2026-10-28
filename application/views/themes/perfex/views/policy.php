<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<div class="panel_s section-heading section-proposals">
  <div class="panel-body">
    <h4 class="no-margin section-text">Policy </h4>
    <a href="<?php echo site_url().'clients/policies'?>" class="btn btn-info"
              style="float:right;">Back</a>
  </div>
</div>
<div class="panel_s">
  <div class="panel-body">
  <form method="#">
              <div class="row addRowMarginleft">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-4">
                    <strong class="setMargin setFontSize">Customer</strong>
                    </div>
                    <div class="col-md-4">
                    <label ><?php echo $policydata[0]['customer'];?></label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-4">
                    <strong class="setMargin setFontSize">Policy Number</strong>
                    </div>
                    <div class="col-md-4">
                    <label><?php echo $policydata[0]['policy_number'];?></label>
                    </div>
                  </div>
                </div>
              </div>
              </br>
              <div class="row addRowMarginleft">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-4">
                    <strong class=" setMargin setFontSize">Life Assured</strong>
                    </div>
                    <div class="col-md-6">
                    <label><?php echo $policydata[0]['life_assured'];?></label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-4">
                    <strong class=" setMargin setFontSize">Policy Owner</strong>
                    </div>
                    <div class="col-md-8">
                    <label><?php echo $policydata[0]['policy_owner'];?></label>
                    </div>
                  </div>
                </div>
              </div>
              </br>
              <div class="row addRowMarginleft">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-4">
                      <strong class=" setMargin setFontSize">Provider</strong>
                      </div>
                      <div class="col-md-4">
                      <label ><?php echo $policydata[0]['provider'];?></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-4">
                      <strong class="setMargin setFontSize">Policy Fee</strong>
                      </div>
                      <div class="col-md-4">
                      <label><?php echo $policydata[0]['policy_fee'];?></label>
                      </div>
                    </div>
                  </div>
              </div>
              </br>
              <div class="row addRowMarginleft">
                <div class="col-md-6">
                  <div class="row">
                      <div class="col-md-4">
                      <strong class="setMargin setFontSize">Policy Start Date</strong>
                      </div>
                      <div class="col-md-4">
                      <label><?php echo $policydata[0]['start_date'];?></label>
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                      <div class="col-md-4">
                        <strong class="setMargin setFontSize">Policy Review Date</strong>
                      </div>
                      <div class="col-md-4">
                        <label><?php echo $policydata[0]['renewal_date'];?></label>
                      </div>
                  </div>
                </div>
              </div>
              </br>
              <div class="row addRowMarginleft">
                  <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                          <strong class="setMargin setFontSize">Policy Status</strong>
                        </div>
                        <div class="col-md-4">
                         <label><?php echo $policydata[0]['policy_status'];?></label>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                          <div class="col-md-4">
                            <strong class=" setMargin setFontSize">Total Premium</strong>
                          </div>
                          <div class="col-md-4">
                            <label><?php echo $policydata[0]['total_premium'];?></label>
                          </div>
                    </div>
                  </div>
              </div></br>
              <div class="row addRowMarginleft">
                  <div class="col-md-6">
                    <div class="row">
                          <div class="col-md-4">
                            <strong class=" setMargin setFontSize">Premium Frequency</strong>
                          </div>
                          <div class="col-md-4">
                            <label><?php echo $policydata[0]['premium_frequency'];?></label>
                          </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                          <div class="col-md-4">
                            <strong class=" setMargin setFontSize">Cover Type</strong>
                          </div>
                          <div class="col-md-4 setFontSize">
                            <label><?php echo $policydata[0]['cover_type'];?></label>
                          </div>
                    </div>
                  </div>
              </div></br>
               <hr>
          </form>
</div>
<div class="panel_s section-heading section-proposals">
  <div class="panel-body">
    <h4 class="no-margin section-text">Benefits</h4>
  </div>
</div>
<?php if(!empty($benefits)) { ?>
        <div class="container-fluid">
          <?php //echo "<pre>"; print_r($benefits);
            for ($i=0; $i<count($benefits); $i++){ 
              $keys = array_keys($benefits[$i]['policy_benefits'][0]);
              $arraySize = count($benefits[$i]['policy_benefits'][0]);
              $j=0;
              if($benefits[$i]['contact_id']){
              ?>
        <div class="panel_s">
          <div class="panel-body addPageColor">      
            <div class="row addRowMarginleft">
              <div class="col-md-4">
                 <div class="row">
                    <div class="col-md-12">
                    <label class="addColor"><?php echo $benefits[$i]['contact_id'];?></label>
                    </div>
                 </div>
              </div>
              <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-12">
                    <label class="addColor"><?php echo $benefits[$i]['title'];?></label>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
            <div class="row addRowMarginleft"> 
             <?php }
            for($j=0; $j < $arraySize; $j++) { ?>
              <div class="col-md-4">
                <div class="col-md-6">
                  <strong class="setMargin setFontSize"><?php  echo str_replace("_"," ","$keys[$j]")?></strong>
                </div>
                <div class="col-md-6">
                <?php
                if(is_array($benefits[$i]['policy_benefits'][0][$keys[$j]])){ ?>
                  <label ><?php echo implode(",",$benefits[$i]['policy_benefits'][0][$keys[$j]]);?></label>
                <?php } else { ?>
                <label><?php echo $benefits[$i]['policy_benefits'][0][$keys[$j]];?></label>
                <?php }?>
                </div>
              </div>
           <?php } ?> </div><hr> <?php } //echo count($benefits); exit;?>
        </div>
     </div>
    </div>
</div>
<?php } ?>
   
