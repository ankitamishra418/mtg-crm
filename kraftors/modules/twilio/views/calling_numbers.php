<?php defined('BASEPATH') or exit('No direct script access allowed'); ?> 
<?php init_head(); 
$curencySymbol='$'; 
$TWILIO_PRICE  = TWILIO_COST; 
if (isIndian() && isIndian()=='IN') { 
  $curencySymbol='रु';  
  $TWILIO_PRICE  = TWILIO_COST_INR;
}
?>
<div id="wrapper"> 
   <div class="content">
      <div class="row">
         <div class="col-lg-12">
            <div class="panel_s mtop30">
               <div class="panel-body announcement mbot15 tc-content">
               	<p class="maintitlehead">Phone number for your current project or sub-account.</p>
                	<!-- <a class="btn btn-success" id="buy__number" href="javascript:void(0);">Buy a Number</a> -->
                	<div class="num-table-sel">
		         		<div class="table-responsive">
		         			<table class="table table-bordered" id="result__number__content">
		         				<thead>
		         					<tr>
		         						<th class="table-numselecthead">Number</th>
		         						<th class="table-numselecthead">Default</th>
		         						<th class="table-numselecthead">Type</th>
		         						<th class="table-numselecthead">Capabilities</th>
		         						<th class="table-numselecthead">Monthly fee</th>
		         						<th class="table-numselecthead">Recording</th>
		         						<th class="table-numselecthead">Date</th>
		         						<th class="table-numselecthead">Action</th>
		         					</tr>
		         				</thead>
		         				<tbody>
		         					<?php if (!empty($staffNum)) {
		         						foreach ($staffNum as $key => $item) { 
		         						$checked = $defaultSet =''; 
							            if ($item->is_recording == 1) {
							                $checked = 'checked';
							            }if ($item->is_default_number == 1) {
							                $defaultSet = '<i class="fa fa-check-circle-o fa-2x" style="color:green"></i>';
							            }
		         						$cap =  json_decode($item->capabilities); 
		         						$_data = '<div class="onoffswitch">
						                <input type="checkbox" data-switch-url="' . admin_url() . 'twilio/twilio_menu/change_recording" name="onoffswitch" class="onoffswitch-checkbox" id="c_' . $item->id . '" data-id="' . $item->id . '" ' . $checked . '>
						                <label class="onoffswitch-label" for="c_' . $item->id . '"></label>
						            </div>';

						            // For exporting
						            $_data .= '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';
		         					?>
		         					<tr>
		         						<td>
		         							<span class="tablecoltitle"><?= $item->phone_number?></span>
		         							<br>
		         							<span><?= isIndian() ?></span>
		         						</td>
		         						<td class="paddingtop20"><?= $defaultSet ?></td>
		         						<td class="paddingtop20">Toll Free</td>
		         						<td class="paddingtop20">

		         							<ul class="listing-icon">
		         								<li>
		         									<img src="<?= base_url('pricing/') ?>call1.png" data-toggle="tooltip" data-title="VOICE <?= ( $record->capabilities['voice'] == '1' ? 'Yes' : 'No') ?>">
		         								</li>

		         								<li>
		         									<img src="<?= base_url('pricing/') ?>call2.png" data-toggle="tooltip" data-title="SMS <?= ($record->capabilities['SMS']=='1' ? "Yes":"No" ) ?>">
		         								</li>

		         								<li>
		         									<img src="<?= base_url('pricing/') ?>call3.png" data-toggle="tooltip" data-title="MMS <?= ($record->capabilities['MMS']=='1' ? "Yes":"No" ) ?>">
		         								</li>

		         								<li>
		         									<img src="<?= base_url('pricing/') ?>call4.png" data-toggle="tooltip" data-title="FAX <?= ($record->capabilities['fax']=='1' ? "Yes":"No" ) ?>">
		         								</li>
		         							</ul>
		         							
		         						</td>
		         						<td class="paddingtop20"><?= $curencySymbol.$TWILIO_PRICE ?></td>
		         						<td class="paddingtop20"><?= $_data ?></td>
		         						<td class="paddingtop20"><?= _d($item->created_at) ?></td>
		         						<td class="paddingtop12">
		         							<button class="btn btn-info" onclick="buyconfirm('<?= $item->phone_number?>','<?= $item->id ?>')" >Configure</button>
		         						</td>
		         					</tr> 
		         				<?php } } ?>
		         				</tbody>
		         			</table>
		         		</div>
		         	</div>
               </div>
            </div>
         </div>
        
      </div>
   </div>
</div> 
<?php $this->load->view('partials/number_config_pop'); ?>
<?php init_tail(); ?>  
<script type="text/javascript">
	function buyconfirm(number, id) {
		$('#confirm__number').html(number);
		$('#phone__number').val(number);
		var url = "<?= base_url('twilio/twilio_menu/getCheckbox') ?>/"+id;
		getCheckbox(url);
		$('#buyconfirm').modal('show');
	}

	function getCheckbox(url) {
		$('#check-recording, #set_default').prop('checked',false);
		$.get(url,function(data){
			data = JSON.parse(data);
			if (data.is_recording=='1') {
				$('#check-recording').prop('checked',true);
			}if (data.is_default_number=='1') {
				$('#set_default').prop('checked',true);
			}
			$('#phone_number_id').val(data.id);
			$('#staff').val(data.assign_user_id);
			$('.selectpicker').selectpicker('refresh');
		})
	}
</script>
</body>
</html>