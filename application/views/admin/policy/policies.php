<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<?php init_head();?>
<div id="wrapper">
    <div class="content">
        <h3> Policy</h3>
        <div>
            <?php if(isset($client_id)){ ?>
            <a href="<?php echo admin_url('clients/client/' . $client_id . '?group=policies');?>" class="btn btn-info"
                style="float:right;">Back</a>
            <?php } else{?>
            <a href="<?php echo admin_url('Policy/showPolicyData'); ?>" class="btn btn-info"
                style="float:right;">Back</a>
            <?php }?>
            <!-- <a href="<?php //echo admin_url('Policy/showPolicyData'); ?>" class="btn btn-info" style="float:right;">Back</a> -->
            <a class="addColor addMarginRight btn btn-info"
                href="<?php echo base_url('admin/policy/downloadpolicy/').$data[0]['id']; ?>" style="float:right;"
                target="_blank">Download</a>
        </div></br>
    </div>
    <div class="container-fluid">
        <div class="panel_s">
            <div class="panel-body">
                <form method="#">
                    <div class="row addRowMarginleft">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class="setMargin setFontSize">Client</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['customer'];?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class=" setMargin setFontSize">Provider</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['provider'];?></label>
                                </div>


                                <div class="col-md-4">
                                    <?php if(has_permission('policy','','edit')){ ?>
                                    <?php if(isset($client_id)){ ?>
                                    <a class="btn btn-info btn-md"
                                        href="<?php echo base_url('admin/policy/editpolicy/'.$data[0]['id'].'/'.$client_id) ?>"
                                        style="float:right;"><i class=" iconFontSize fa fa-edit"></i></a>
                                    <?php } else { ?>
                                    <a class="btn btn-info btn-md"
                                        href="<?php echo base_url('admin/policy/editpolicy/'.$data[0]['id']) ?>"
                                        style="float:right;"><i class=" iconFontSize fa fa-edit"></i></a>
                                    <?php } }?>
                                    <!-- <a class="btn btn-info btn-md" href="<?php //echo base_url('admin/policy/editpolicy/'.$data[0]['id']) ?>" style="float:right;"><i class=" iconFontSize fa fa-edit"></i></a> -->
                                </div>
                            </div>
                        </div>

                    </div>
                    </br>
                    <div class="row addRowMarginleft">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class="setMargin setFontSize">Policy Number</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['policy_number'];?></label>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class="setMargin setFontSize">Policy Start Date</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo date("d-m-Y", strtotime($data[0]['start_date']));?></label>
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
                                    <label><?php echo $data[0]['policy_status'];?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class=" setMargin setFontSize">Cover Type</strong>
                                </div>
                                <div class="col-md-4 setFontSize">
                                    <label><?php echo $data[0]['cover_type'];?></label>
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
                                    <label><?php echo $data[0]['life_assured'];?></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class=" setMargin setFontSize">Policy Owner</strong>
                                </div>
                                <div class="col-md-8">
                                    <label><?php echo $data[0]['policy_owner'];?></label>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class="setMargin setFontSize">Policy Review Date</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php//echo date("d-m-Y", strtotime($data[0]['renewal_date']));?></label>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    </br>
                    <div class="row addRowMarginleft">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class=" setMargin setFontSize">Premium Amount</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['total_frequency_premium'];?></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class="setMargin setFontSize">Policy Fee</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['policy_fee'];?></label>
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
                                    <label><?php echo $data[0]['premium_frequency'];?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class=" setMargin setFontSize">Annual Premium</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['total_premium'];?></label>
                                </div>
                            </div>
                        </div>
                    </div></br>
                    <div class="row addRowMarginleft">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class=" setMargin setFontSize">Scheme</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['key_contact'];?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class=" setMargin setFontSize">Tag</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['tagg'];?></label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class=" setMargin setFontSize">Key Contact Email</strong>
                                </div>
                                <div class="col-md-4 setFontSize">
                                    <label><?php echo $data[0]['contact_email'];?></label>
                                </div>
                            </div>
                        </div> -->
                    </div><br>
                    <div class="row addRowMarginleft">
                        <!-- <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class=" setMargin setFontSize">Key Contact Phone</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['contact_phone'];?></label>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="row">
                                <?php if(isset($data[0]['lastpolicy_update'])){ ?>
                                <div class="col-md-4">
                                    <strong class="setMargin setFontSize">Policy Last Updated</strong>
                                </div>
                                <div class="col-md-4">
                                    <label><?php echo $data[0]['lastpolicy_update'];?></label>
                                </div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div></br>
                    <div class="row addRowMarginleft">

                    </div></br>
                    <hr>
                </form>
                <div class="row">
                    <div class="col-md-6">
                        <?php if(has_permission('policy','','create')){ ?>
                        <?php if(isset($client_id)){ ?>
                        <button class="btn btn-info btn-sm addMarginleft"><a class="addColor"
                                href="<?php echo base_url('admin/policy/showmulticontact/'.$data[0]['id'].'/'.$client_id) ?>">Add
                                Benefit</a></button>

                        <?php } else{ ?>
                        <button class="btn btn-info btn-sm addMarginleft"><a class="addColor"
                                href="<?php echo base_url('admin/policy/showmulticontact/'.$data[0]['id']) ?>">Add
                                Benefit</a></button>
                        <?php }?>
                        <?php }?>
                    </div>
                </div>
                <?php //echo '<pre>'; print_r($benefits); exit; ?>
                <h3>Benefits</h3></br>
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
                                
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <?php if(isset($benefits[$i]['updated_at'])) { ?>  
                                            <label class="addColor">Updated At: <?php echo date("d-m-Y", strtotime($benefits[$i]['updated_at'])); ?></label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-2">
                                    <?php if(isset($client_id)){?>
                                    <?php if(has_permission('policy','','delete')){ ?>
                                    <a onclick="return mConfirm();"
                                        href="<?php echo base_url('admin/Policy/deleteSelectedBenefit/'.$benefits[$i]['id'].'/'.$benefits[$i]['policy_id'].'/'.$client_id) ?>"
                                        class="addColor" style="float:right;"><i
                                            class=" setMargin iconFontSize fa fa-trash-o"></i></a>
                                    <?php }?>
                                    <?php if(has_permission('policy','','edit')){ ?>
                                    <a href="<?php echo base_url('admin/Policy/editSelectedBenefit/'.$benefits[$i]['id'].'/'.$client_id) ?>"
                                        class="addColor" style="float:right;"><i
                                            class="setMargin iconFontSize fa fa-edit"></i></a>
                                    <?php }?>
                                    <?php } else { ?>
                                    <?php if(has_permission('policy','','delete')){ ?>
                                    <a onclick="return mConfirm();"
                                        href="<?php echo base_url('admin/Policy/deleteSelectedBenefit/'.$benefits[$i]['id'].'/'.$benefits[$i]['policy_id']) ?>"
                                        class="addColor" style="float:right;"><i
                                            class=" setMargin iconFontSize fa fa-trash-o"></i></a>
                                    <?php }?>
                                    <?php if(has_permission('policy','','edit')) {?>
                                    <a href="<?php echo base_url('admin/Policy/editSelectedBenefit/'.$benefits[$i]['id']) ?>"
                                        class="addColor" style="float:right;"><i
                                            class="setMargin iconFontSize fa fa-edit"></i></a>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row addRowMarginleft">
                        <?php }
                        for($j=0; $j < $arraySize; $j++) { ?>
                        <div class="col-md-4">
                            <div class="col-md-6">
                                <strong
                                    class="setMargin setFontSize"><?php  echo str_replace("_"," ","$keys[$j]")?></strong>
                            </div>
                            <div class="col-md-6">
                                <?php
                                if(is_array($benefits[$i]['policy_benefits'][0][$keys[$j]])){ ?>
                                <label><?php echo implode(",",$benefits[$i]['policy_benefits'][0][$keys[$j]]);?></label>
                                <?php } else { ?>
                                <label><?php //echo $benefits[$i]['policy_benefits'][0][$keys[$j]];?></label>

                                <label><?php $dataRowValue = $benefits[$i]['policy_benefits'][0][$keys[$j]];
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
                                            // // echo '$'. number_format($str);
                                            //     echo '$'.number_format(($str) ,2).''; 
                                            // }
                                            echo $dataRowValue;
                                        }
                                        else{
                                            if(is_numeric($dataRowValue)){
                                            // echo '$'. number_format($dataRowValue);
                                            echo '$'.number_format(($dataRowValue) ,2).''; 
                                            }
                                        }
                                    }
                                    else{
                                        echo $dataRowValue;
                                    }
                                    ?></label>
                                <?php }?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <hr> <?php } //echo count($benefits); exit;?>
                </div>
            </div>
        </div>
    </div>
    <?php init_tail(); ?>
    </body>
    <script>
    function mConfirm() {
        var mesg = confirm("Want to delete?");
        if (mesg == true) {
            return true;
        } else {
            return false;
        }
    }
    </script>

    </html>