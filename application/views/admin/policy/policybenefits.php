
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head();?>
<div id="wrapper">
	<div class="content">
		<h3>Policy</h3>
</br>
<div class="container">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Contact1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Contact2</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Contact3</a>
  </li>
</ul>
</div>
<form>
	<div class="row">
		<div class="col-md-6">
		<label>Customer</label>
        <input type="text" class="form-control">
		</div>
	</div>
    </br>
	<div class="row">
		<div class="col-md-6">
		<label>Policy Number</label>
        <input type="number" class="form-control">
	 </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label>Provider</label>
        <select class="form-control form-control-lg">
		<option>Select</option>
		<option>A</option>
	    <option>B</option>
       </select>
	   </div>
	</div>
   </br>
	<div class="row">
		<div class="col-md-6">
		<label>Primary Contact</label>
        <select class="form-control form-control-lg">
		<option value ="" selected>Select</option>
		<?php foreach ( $primarycontact as $val) {?>
                        <option value="<?php echo $val['email']?>">
						<?php echo $val['email']?>
                        </option>
		<?php }?>
       </select>
	   </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label>Secondary Contacts</label>
        <select class="selectpicker form-control" multiple data-live-search="true">
		<option value ="" selected>Select</option>
		<?php foreach ($companey as $val) {?>
                        <option value="<?php echo $val['email']?>">
						<?php echo $val['email']?>
                        </option>
	   <?php }?>
       </select>
	   </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label>Start Date</label>
		<input type="date" class="form-control">
	   </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label>Policy Fee</label>
		<input type="number" class="form-control">
	   </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label>Total Premium</label>
		<input type="number" class="form-control">
	   </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label>Premium Frequency</label>
        <select class="form-control form-control-lg">
		<option>Select</option>
		<option>A</option>
	    <option>B</option>
       </select>
	   </div>
	</div>
	</br>
	<div class="row">
		<div class="col-md-6">
		<label>Cover Type</label>
        <select class="form-control form-control-lg">
		<option>Select</option>
		<option>A</option>
	    <option>B</option>
       </select>
	   </div>
	</div>
	</br>
	<div class="row">
	<div class="col-md-6">
	<label>Life Assured</label>
	<select class="selectpicker form-control" multiple data-live-search="true">
		<option>A</option>
		<option>B</option>
		<option>C</option>
	</select>
	</div>
	</div>
	</br>
	<div class="row">
	<div class="col-md-6">
	<label>Policy Owner</label>
	<select class="selectpicker form-control" multiple data-live-search="true">
		<option>A</option>
		<option>B</option>
		<option>C</option>
	</select>
	</div>
	</div>
	</br>
	</br>
	<div class="row">
	<div class="col-md-6">
	<button type="submit" class="btn btn-info">Save</button>
	</div>
	</div>
</form>
	</div>
</div>
<?php init_tail(); ?>
</body>
</html>