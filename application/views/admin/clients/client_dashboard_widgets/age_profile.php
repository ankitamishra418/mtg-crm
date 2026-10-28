<div class="panel_s">
    <div class="panel-body">
        <div class="col-md-12">
            <h4 style="font-weight: 900; text-align: center;">Age Profile</h4>
        </div><br> <br>
        <div class="row " style="margin-top:30px;">
        </div>
        <div class="table">
            <table class="table mt-5 choose_contact_table " id="choose_contact_table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Age Band</th>
                        <th scope="col" style="text-align:right;">Individuals</th>
                    </tr>
                </thead>
                <tbody>

                
                    <?php foreach($ageProfile as $ageProfiles) {  
                        $number = $ageProfiles['no_of_count'];
                        $total_number_customer += $number;
                    ?>
                    <tr>
                        <td><?php echo $ageProfiles['age_range']; ?> </td>
                        <td style="text-align:right;"><?php echo $ageProfiles['no_of_count']; ?> </td>
                    </tr>

                    <?php }  ?>
                    <tr>
                        <th scope="col">Total</th>
                        <th style="text-align:right;"><?php  echo $total_number_customer; ?></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>