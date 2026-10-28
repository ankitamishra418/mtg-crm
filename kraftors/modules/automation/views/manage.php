<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>



<?php init_head(); ?> 

<div id="wrapper"> 

    <div class="content"> 

        <div class="row"> 

            <div class="col-md-12"> 

                <div class="panel_s">  

                    <div class="panel-body"> 

                        <?php if(has_permission('automation','','create')){ ?> 

                            <div class="_buttons">  

                                <a href="<?php echo admin_url('automation/rule/add'); ?>" class="btn btn-info mright5 pull-left display-block"><?php echo _l('add_new'); ?></a>  

                            </div> 

                            <div class="clearfix"></div> 

                            <br> 

                        <?php } ?> 

                        <br> 

                        <div class="row"> 

                         <div class="col-md-12" id="small-table"> 

                          <div class="panel_s"> 

                           <div class="panel-body"> 

                            <div class="clearfix"></div> 

                            <!-- if hrmcontract id found in url --> 

                            <div class="tab-content"> 

                               <!-- start --> 

                               <div role="tabpanel" class="tab-pane active" id="tab_list_insurance"> 

                                <?php 

                                $table_data = array( 

                                    _l('id'), 

                                    _l('name'), 

                                    _l('description'),                              

                                    _l('module_name'),                              

                                    _l('duration_type'),                              
                                    _l('duration'),                              

                                    _l('status'),                              

                                    _l('created'),                              



                                ); 

                                render_datatable($table_data,'table_insurance'); 

                                ?> 

                            </div> 

                            <div role="tabpanel" class="tab-pane" id="tab_statistic"> </div> 

                        </div> 

                    </div> 

                </div>  

            </div> 

        </div> 

    </div> 

</div> 

</div> 

</div> 

</div> 

<?php init_tail(); ?> 

<script> 

    $(function(){  

        table_insurance = $('table.table-table_insurance');

        initDataTable(table_insurance,admin_url + 'automation/rule', undefined, undefined, ''); 

    }); 

</script> 

</body> 

</html>



