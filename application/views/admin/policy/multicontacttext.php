
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<?php init_head();?>
<div id="wrapper">
  <div class="content">
      <h3>Contacts</h3>
          </br>
    <div class="container-fluid">
      <div class="tab">
          <?php $i=1; foreach($data[0]['life_assured'] as $val)   {  ?>
              <button class="tablinks" onclick="openCity(event, '<?php echo $val?>')" id='tablinks_<?php echo $i?>'><?php echo $val ?></button>
          <?php $i++; } ?>
      </div>
          <div id="<?php echo $val?>" class="tabcontent">
                <p><?php echo $val ?></p>
          </div>
        <div class="benefit-title-con">
        <select class=" selectpicker form-control form-control-lg " data-live-search="true"  name="benefit-title" id="benefit-title">
              <option value >Select Beneifit Title</option>
              <?php foreach ($benefits['data'] as $val) {?>
                              <option value="<?php echo $val['form_title']?>">
                              <?php echo $val['form_title']?>
                              </option>
            <?php }?>
            </select>
        </div>
    </div>
    <div id="field"></div>
    </div>
  </div>
</div>
<input type="hidden" id="url"  value="<?php echo admin_url('Policy/featchBenefitfield')?>">
<?php init_tail(); ?>
<script>
function openCity(evt, cityName) {
  $(".benefit-title-con").css("display", "block");
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace("active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<script>
  $(document).ready(function () {
    $('#tablinks_1').addClass('active').siblings().removeClass('active');
    $("#benefit-title").change(function(){
     var title = $("#benefit-title").val();
     var url = $("#url").val();
     $('#field').find('input').remove();
     $('#field').find('label').remove();
     $.ajax({
                    url: url,
                    type: "POST",
					          datatype : "application/json",
                    data: {
                        'title': title,
                    },
                    success: function (datas) {
                      console.log(datas);
                    var data = JSON.parse(datas);
                    var textcount = data.textcount;
                    var checkcount = data.checkcount;
                    var radiocount = data.radiocount;
                    var radiocount = data.radiocount;
                    var dropdowncount = data.dropdowncount; 
                      //console.log(data.dropdowncount);
                      //console.log(dropdowncount);s
                    for (let i = 0; i < textcount; i++) {
                      var textlabel = data.textlabel[i];
                      var html='';
                      var htmll = "<div><strong><label class='text-center' style=margin-top:10px;>"+textlabel+"</label></strong><input class='form-control col-md-6' type ='text' name= 'text_"+i+"' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191' id='text_"+i+"'/></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }
                    for (let i = 0; i < checkcount; i++) {
                      var checklabel = data.checklabel[i];
                      var html='';
                      var htmll = "<div><strong><label class='text-center' style=margin-top:10px;margin-left:10px;>"+checklabel+"</label></strong><input class='' type ='checkbox' name= 'checkbox_"+i+"' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191;margin-left:10px;' id='text_"+i+"'/></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }
                    for (let i = 0; i < radiocount; i++) {
                      var radiolabel = data.radiolabel[i];
                      var html='';
                      var htmll = "<strong><label class='text-center' style='margin-left:10px;'>"+radiolabel+"</label></strong><input class='' type ='radio' name= 'radio' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191; margin-left:10px;' id='radio_"+i+"'/></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }
                    for (let i = 0; i < radiocount; i++) {
                      var radiolabel = data.radiolabel[i];
                      var html='';
                      var htmll = "<strong><label class='text-center' style='margin-left:10px;'>"+radiolabel+"</label></strong><input class='' type ='radio' name= 'radio' style='margin-top: 10px; margin-bottom: 10px;border:2px solid #919191; margin-left:10px;' id='radio_"+i+"'/></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }
                    for (let i = 0; i < dropdowncount; i++) {
                      var droplabel = data.droplabel[i];
                      console.log(droplabel);
                      var html='';
                      var htmll = "<div class=''><label>Provider</label><select class=' form-control' data-live-search='true'><option value ='' >Select</option></select></div>";
                      var htmlnew = htmll+html;
                      $("#field").append(htmlnew);
                    }
                  }
					
				});
});
  });
</script>

</body>
</html>