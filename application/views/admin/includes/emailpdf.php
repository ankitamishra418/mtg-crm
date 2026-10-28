<html>
<div class="panel_s">
    <div class="panel-body">
        <?php foreach($emailpdfData as $emailpdfDatas){ ?>
        <h4>Subject : <?php echo $emailpdfDatas['subject']; ?></h4>
        <h4>Sent from : crm@mtgonline.app </h4>
        <h4>Sent to : <?php echo $emailpdfDatas['email']; ?></h4>
        <h4>CC : <?php echo $emailpdfDatas['cc']; ?></h4>
        <?php echo $emailpdfDatas['message']; ?>
        <?php } ?>
        <h4>Signature : <?php echo $fetchSign[0]['email_signature']; ?></h4>
        <?php foreach($emailpdfData as $emailpdfDatas){ ?>
        <p style="font-size: 13px;">Email Sent Date & Time : <?php echo $emailpdfDatas['date']; ?> <br>
        
        <?php if($emailpdfDatas['opened'] == 1 ) {?> Email Opened Date & Time : <?php echo $emailpdfDatas['date_opened']; ?>

             <?php } else{ ?> <p style="color:red"> <i class="fa fa-clock-o"> Status: Not Opened </i></p><?php } ?></p>
        <?php } ?>
    </div>
</div>
</html>
