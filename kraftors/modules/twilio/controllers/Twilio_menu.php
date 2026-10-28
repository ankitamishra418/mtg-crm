<?php  
defined('BASEPATH') or exit('No direct script access allowed'); 
class Twilio_menu extends AdminController 
{
    private $sid    = TWILIO_SID;
    private $token  = TWILIO_AUTH_TOKEN;
    private $userID;
    public function __construct()  { 
        parent::__construct(); 
        $this->load->model('dashboard_model');
        $this->load->helper('common_helper');
        $this->load->helper('twilio_helper');
        $this->userID=$this->session->userdata('staff_user_id'); 
    }  

    public function index()  {  
       echo "string"; 
    } 
    
    public function purchase_number($value=''){
        $data['title']      ='Dashboard | Purchase Number';
        $data['userData']   = getRecord('tblstaff',array('staffid'=>$this->userID));  
        $this->load->view('purchase_number',$data);
    } 
    public function calling_credit($value=''){
        // $qry =  "SELECT * FROM tbl_wallet_log WHERE ref_user_id=$this->userID ORDER BY id DESC" ;
        // $data['listRecord'] = createConnection('',[],$qry);  
        $data['title']      = 'Dashboard | Buy Credit';
        $data['userData']   = getRecord('tblstaff',array('staffid'=>$this->userID)); 
        $this->load->view('buy_credit',$data);
    } 
    
    public function call_forword(){
        $data['title'] ='Dashboard | Call Forwording';
        $this->load->view('incomingCallforwarding',$data);
    }

    public function table()
    {
        if (!has_permission('twilio', '', 'view')) {
            ajax_access_denied();
        }

        $this->app->get_table_data(module_views_path('twilio', 'table_callhistory'));
    }

    public function dialer($value='')
    {            
        $data['title']       ='Dashboard | Twilio Dialer'; 
        $this->load->model('staff_model');
         $data['staff'] = $this->staff_model->get(); 
        $data['callHistory'] =$this->db->get('tbltwilio_call_log')->result();
        $this->load->view('dialler',$data);
    }


    public function incommingCallForwording($value='')
    {            
        $success_flag = false;
        $phone_number_array = "";
        $phone_number_array = json_decode($_POST['phone_number_array'], true);
        $phone_number_array=array_map('trim',$phone_number_array);

        $forward_number_array = "";
        $forward_number_array = json_decode($_POST['forward_number_array'], true);
        $forward_number_array=array_map('trim',$forward_number_array);  
        $arrResponse = $forward_number_array;

        try {
        for ($counter=0; $counter < count($phone_number_array); $counter++) { 

            foreach ($client->account->incoming_phone_numbers->getIterator(0, 50, array(
                    "PhoneNumber" => $phone_number_array[$counter]
                )) as $number
            ) {
                $voice_url = "https://api.twilio.com/2010-04-01/forward?PhoneNumber=" . $forward_number_array[$counter];
                    $number->update(array(
                    "VoiceUrl" => $voice_url,
                ));
                $success_flag = true;

            }
        }       
        } catch (Exception $e) {
        $success_flag = false;
        $error = "\n\nError in forward numbers : " . $e;
        file_put_contents("debug_file.txt", print_r($error, true), FILE_APPEND);

        }

        if($success_flag==false){
        $response = "no records found";
        echo $response;
        }else{
        $response = "Changes saved successfully";
        echo $response;
        }   
    }

    public function getTwilioLog($From=''){
        $curencySymbol='$';  
        $TWILIO_CALL_COST  = TWILIO_CALL_COST; 
        if (isIndian() && isIndian()=='IN') { 
          $curencySymbol='Rs.';//'रु';   
          $TWILIO_CALL_COST  = TWILIO_CALL_COST_INR;
        }
        $dataNum = $this->db->where('assign_user_id',$this->userID)->get('tbltwilio_number')->row();
        if (empty($dataNum)) {
            set_alert('warning', _l('No number found', _l('Call')));
            redirect($_SERVER['HTTP_REFERER']); 
        }
        $output ='';
        $dataSet = $finalArr = [];  
        try {  
            $x = 1;
            $dataVal = true;
            $url = 'https://api.twilio.com/2010-04-01/Accounts/AC08aa55c8388025012e24ab6daa80c46d/Calls.json?PageSize=20&From='.$dataNum->phone_number;
            $baseURL="https://api.twilio.com";
            do {
                $finalArr = [];  
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, TWILIO_SID.":".TWILIO_AUTH_TOKEN);
                $result = curl_exec($ch);
                $calls = json_decode($result);   
                // echo "<pre>";
                // echo count($calls);
                // print_r($calls);die;
                if (!empty(count($calls->calls))) {  
                    foreach ($calls->calls as $record) {   
                        // echo "<pre>";
                        // echo  $record->sid; 
                        // echo date('Y-m-d',strtotime($record->date_created));die;
                        if (!isNumRows('tbltwilio_call_log',array('sid'=>$record->sid))) {  
                            $dataSet['sid']                 = $record->sid;
                            $dataSet['account_sid']         = $record->account_sid;
                            $dataSet['answered_by']         = $record->answered_by;
                            $dataSet['api_version']         = $record->api_version;
                            $dataSet['caller_name']         = $record->caller_name; 
                            $dataSet['date_created']        = $record->date_created;
                            $dataSet['date_updated']        = $record->date_updated; 
                            $dataSet['duration']            = $record->duration;
                            $dataSet['end_date_time']       = $record->end_time; 
                            $dataSet['forwarded_from']      = $record->forwarded_from;
                            $dataSet['call_from']           = $record->from;
                            $dataSet['from_formatted']      = $record->from_formatted;
                            $dataSet['group_sid']           = $record->group_sid;
                            $dataSet['parent_call_sid']     = $record->parentCallSid;
                            $dataSet['phone_number_sid']    = $record->phoneNumberSid;
                            $dataSet['price']               = $record->price;
                            $dataSet['price_unit']          = $record->price_unit;
                            $dataSet['call_start_date_time']= $record->start_time;
                            $dataSet['status']              = $record->status;
                            $dataSet['call_to']             = $record->to;
                            $dataSet['to_formatted']        = $record->toFormatted; 
                            $dataSet['call_date']           = date('Y-m-d',strtotime($record->date_created)); 
                            $finalArr[]=$dataSet;
                            // $userDetails =$this->db->where('staffid',$this->userID)->get('tblstaff')->row(); 
                            $userDetails =$this->db->where(['admin'=>'1','subdomain_name !='=>''])->get('tblstaff')->row(); 
                            $des= 'Calling with '.$record->to;
                            $transactionID= rand();
                            $payment_status= 'success';
                            $name= $record->to;
                            $email= $record->to;
                            $paidAmount = $TWILIO_CALL_COST * get_calling_cost($record->duration);
                            $walletQuery = "INSERT INTO tbl_wallet_log (user_id,ref_user_id,payment_type,payment_by,total_amount,price_unit,payment_title,payment_description,tx_id,payment_status,name,email) VALUES('".$userDetails->ref_user_id."','".$this->userID."','debited','wallet','".$paidAmount."','".$curencySymbol."','Calling ','".$des."','".$transactionID."','".$payment_status."','".$name."','".$email."')";

                            $orderID = saveDetail('','',$walletQuery);
                            $updateData = array(
                                'wallet_total' => ($userDetails->wallet_total - $paidAmount)
                            );
                            $this->staffWalletUpdate($this->userID,$updateData);
                        } 
                    }
                if (!empty($finalArr)) {
                    $this->db->insert_batch('tbltwilio_call_log', $finalArr);
                }
                    $url = $baseURL.$calls->next_page_uri ;
                }else{  
                    curl_close($ch);    
                    $dataVal = false; 
                }
              $x++;
            } while ($dataVal);    
        } catch (Exception $e) {
            print_r($e);die;
        } 
        log_activity('Call history Sync Successfully [StaffID: ' . $this->userID . ']');  
        $this->get_call_recording();
    }

    public function getTwilioAvailabeNumber($country='',$type='')
    {
        $curencySymbol='$'; 
        $TWILIO_PRICE  = TWILIO_COST; 
        $TWILIO_CALL_COST  = TWILIO_CALL_COST; 
        if (isIndian() && isIndian()=='IN') { 
          $curencySymbol='रु';  
          $TWILIO_PRICE  = TWILIO_COST_INR;
          $TWILIO_CALL_COST  = TWILIO_CALL_COST_INR;
        }
        $output     = '';
        if (empty($type)) {
            $typeFor    = $type = 'tollFree';
        }
        $countryFor = $country ?? isIndian(); 
        try {  
            $twilio   = $this->twilioClient(); 
            $tollFree = $twilio->availablePhoneNumbers($countryFor)
                                ->$type 
                                ->read([], 20); 
        } catch (Exception $e) {
            // echo "<h5 style='color:red;text-align:center;'>OPPS! There was an error!</h5><br>";
            // echo "<h6 style='color:red'>".$e->getMessage()."</h6>";die();
            $tollFree = $twilio->availablePhoneNumbers("US")
                                ->tollFree 
                                ->read([], 50);
        }
        if (!empty($tollFree)) { 
            foreach ($tollFree as $record) {  
                $location = $record->region ?? $record->locality;
            $output .='<tr>
                <td>
                    <span class="tablecoltitle">'.$record->phoneNumber.'</span>
                    <br>
                    <span>'.$location.'  '.$record->isoCountry.'</span>
                </td>
                <td class="paddingtop20">'.$type.'</td>
                <td class="paddingtop20"> 
                    <ul class="listing-icon">
                        <li>
                            <img src="'.base_url('pricing/call1.png') .'" data-toggle="tooltip" data-title="VOICE '.( $record->capabilities['voice'] == '1' ? 'Yes' : 'No').'">
                        </li>

                        <li>
                            <img src="'.base_url('pricing/call2.png').'" data-toggle="tooltip" data-title="SMS '. ($record->capabilities['SMS']=='1' ? "Yes":"No" ).'">
                        </li>

                        <li>
                            <img src="'.base_url('pricing/call3.png').'" data-toggle="tooltip" data-title="MMS '. ($record->capabilities['MMS']=='1' ? "Yes":"No" ).'">
                        </li>

                        <li>
                            <img src="'.base_url('pricing/call4.png').'" data-toggle="tooltip" data-title="FAX '. ($record->capabilities['fax']=='1' ? "Yes":"No" ).'">
                        </li>
                    </ul>
                    </td>
                    <td class="paddingtop20">'.$curencySymbol.$TWILIO_PRICE.'</td>
                    <td class="paddingtop20">'.$curencySymbol.$TWILIO_CALL_COST.'/min</td>
                    <td class="paddingtop12">
                        <button class="btn btn-primary" onclick="confirmNumber('.$record->phoneNumber.')">Buy</button>
                    </td>
                </tr>'; 
            }
        }else{
            $output .="<h5 style='color:red;text-align:center;'>OPPS! Number not available!</h5><br>";
        }
        echo $output;
        
    }

    public function purchaseNumber($value='')
    {    
        $curencySymbol='$'; 
        $TWILIO_PRICE  = TWILIO_COST; 
        if (isIndian() && isIndian()=='IN') { 
          $curencySymbol='रु';  
          $TWILIO_PRICE  = TWILIO_COST_INR;
        } 
        $dataSet =[];
        try {
            $twilio   = $this->twilioClient(); 
            $twilioNm = $this->input->post('phoneNumber');
            
            $record = $twilio->incomingPhoneNumbers
                             ->create(["phoneNumber" => "+".$twilioNm]); 
            $dataSet['user_id']       = $this->userID;
            $dataSet['origin']        = $record->origin ?? 'demo'; 
            $dataSet['sid']           = $record->sid ?? 'demo';
            $dataSet['account_sid']   = $record->accountSid ?? 'demo';
            $dataSet['friendly_name'] = $record->friendlyName ?? $twilioNm; 
            $dataSet['phone_number']  = $record->phoneNumber ?? $twilioNm; 
            $dataSet['total_cost']    = $TWILIO_PRICE; 
            $dataSet['curr_symbol']   = $curencySymbol; 
            $dataSet['date_created']  = json_encode($record->dateCreated) ?? 'demo';
            $dataSet['date_updated']  = json_encode($record->dateUpdated) ?? 'demo';  
            $dataSet['capabilities']  = json_encode($record->capabilities) ?? 'demo';  
            if (!empty($dataSet)) {
                $this->db->insert('tbltwilio_number', $dataSet);
            }  
            // $refUser =$this->db->where('staffid',$this->userID)->get('tblstaff')->row(); 
            $refUser =$this->db->where(['admin'=>'1','subdomain_name !='=>''])->get('tblstaff')->row(); 
            $des= 'Buy number '.$record->phoneNumber;
            $transactionID= rand();
            $payment_status= 'success';
            $name= $refUser->firstname;
            $email= $refUser->email;
            $paidAmount = $TWILIO_PRICE;
            $walletQuery = "INSERT INTO tbl_wallet_log (user_id,ref_user_id,payment_type,payment_by,total_amount,price_unit,payment_title,payment_description,tx_id,payment_status,name,email) VALUES('".$refUser->ref_user_id."','".$this->userID."','debited','wallet','".$paidAmount."','".$curencySymbol."','buy number ','".$des."','".$transactionID."','".$payment_status."','".$name."','".$email."')";

            $orderID = saveDetail('','',$walletQuery); 
            $updateData = array(
                'wallet_total' => ($refUser->wallet_total - $TWILIO_PRICE)
            );
            $this->staffWalletUpdate($this->userID,$updateData);
            set_alert('success', _l('Successfully buy', _l('Call')));
            redirect(admin_url('twilio/twilio_menu/calling_numbers')); 
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    private function staffWalletUpdate($userID='',$dataSet=array())
    { 
      // $this->db->where('staffid',$userID)->update('tblstaff',$dataSet); 
      $this->db->where(['admin'=>'1','subdomain_name !='=>''])->update('tblstaff',$dataSet); 
      return $userID;
    }

    public function calling_numbers($value='')
    {
        $this->load->model('staff_model');
        $data['title'] ='Dashboard | Calling Number';
        $data['staffNum'] = $this->db->where(['user_id'=>$this->userID])->get('tbltwilio_number')->result();
        
        $data['staff'] = $this->staff_model->get();
        $this->load->view('calling_numbers',$data);
    } 

    public function getToken($value='')
    {
        try{ 
           require_once(APPPATH . 'vendor/autoload.php');  

            // Required for all Twilio access tokens
            $twilioAccountSid = TWILIO_SID;
            $twilioApiKey     = 'SK089365aaacb5755edf4d59a1905bd654';
            $twilioApiSecret  = 'yNtSEKzywMPOowFnPLO0sEz2ISjliNGz';

            // Required for Voice grant
            $outgoingApplicationSid = 'APc803270d8966df2643889ffde8f747be';
            // An identifier for your app - can be anything you'd like
            $identity = "Gaurav Khurana";

            // Create access token, which we will serialize and send to the client
            $token = new Twilio\Jwt\AccessToken(
                $twilioAccountSid,
                $twilioApiKey,
                $twilioApiSecret,
                3600,
                $identity
            );

            // Create Voice grant
            $voiceGrant = new Twilio\Jwt\Grants\VoiceGrant();
            $voiceGrant->setOutgoingApplicationSid($outgoingApplicationSid);

            // Optional: add to allow incoming calls
            $voiceGrant->setIncomingAllow(true);

            // Add grant to token
            $token->addGrant($voiceGrant);

            // render token to string
            echo json_encode(['token'=>$token->toJWT()]);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    } 

    public function availableCountry()
    {
        $twilio   = $this->twilioClient(); 
        $availablePhoneNumbers = $twilio->availablePhoneNumbers
                                ->read(100);
        // echo count($availablePhoneNumbers);
        $output =''; 
        foreach ($availablePhoneNumbers as $record) {
            $selectedId='';
            if ($record->countryCode=='US') {
                $selectedId='selected';
            }
            $output .="<option value='".$record->countryCode."' ".$selectedId.">".$record->country."</option>";  
        }
        echo $output;
    }

    private function twilioClient($value='')
    {
        try { 
            require_once(APPPATH . 'vendor/autoload.php');
            return new Twilio\Rest\Client($this->sid, $this->token);   
        } catch (Exception $e) {
            print_r($e->getMessage());die();   
        }
        
    }

    public function help_section($value='')
    {
        $data['title']='Call Manger | Help';
        $this->load->view('help_section',$data);
    }

    public function change_recording($id='', $status='')
    {  
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'twilio_number', [
            'is_recording' => $status,
        ]);

        log_activity('Call recording status changed [ID: ' . $id . ' - Status(Active/Inactive): ' . $status . ']');
    }
    public function saveConfiguration()
    { 
        $dataSet['is_default_number']=$dataSet['is_recording']=0;
        if (empty($this->input->post('staff'))) {
            set_alert('danger', _l('Please select staff !', _l('Call')));
            redirect(base_url('twilio/twilio_menu/calling_numbers'));  
        }
        
        if (!empty($this->input->post('set_default'))) {
            $this->db->where('is_default_number', 1);
            $this->db->update(db_prefix() . 'twilio_number', array('is_default_number'=>0));  
            $dataSet['is_default_number']=1;
        }if (!empty($this->input->post('recording'))) {
            $dataSet['is_recording']=1;
        }if (!empty($this->input->post('staff'))) {
            $dataSet['assign_user_id']=$this->input->post('staff');
        }
        $this->db->where('id', $this->input->post('phone_number_id'));
        $this->db->update(db_prefix() . 'twilio_number', $dataSet); 
        $this->db->where('staffid', $this->input->post('staff'));
        $this->db->update(db_prefix() . 'staff',array('assign_number'=>$this->input->post('phone__number'))); 
        log_activity('Calling number configuration changed [ID: ' . $id . ' - Status(Active/Inactive): ' . $status . ']'); 
        set_alert('success', _l('Save Successfully !', _l('Call')));
        redirect(base_url('twilio/twilio_menu/calling_numbers'));  
     
    }

    public function getCheckbox($id='',$coulmn='')
    {
        $data = $this->db->where('id',$id)->get('tbltwilio_number')->row();
        echo json_encode($data);
    }

    public function get_call_recording()
    {
        $tbl ='tbltwilio_call_log';
        $dataSet = $finalArr = [];  
        try {  
            $x = 1;
            $dataVal = true; 
            $baseURL="https://api.twilio.com";
            $url = $baseURL.'/2010-04-01/Accounts/AC08aa55c8388025012e24ab6daa80c46d/Recordings.json?PageSize=20';
            do {
                $finalArr = [];  
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, TWILIO_SID.":".TWILIO_AUTH_TOKEN);
                $result = curl_exec($ch);
                $recordingArr = json_decode($result);   
                if (!empty(count($recordingArr->recordings))) {  
                    // print_r($recordingArr->recordings);die;
                    foreach ($recordingArr->recordings as $record) {   
                        if (isNumRows($tbl,array('sid'=>$record->call_sid))) {  
                            $dataSet['recording'] = 1; 
                            $dataSet['recording_sid'] = $record->sid; 
                            $this->db->where('sid',$record->call_sid)->update($tbl,$dataSet);
                        } 
                    }   
                }else{  
                    curl_close($ch);    
                    $dataVal = false; 
                }
                if (!empty($recordingArr->next_page_uri) || $recordingArr->next_page_uri != null) {
                        $url = $baseURL.$recordingArr->next_page_uri ;
                }else{ 
                    curl_close($ch); 
                    $dataVal = false;   
                }
              $x++;
            } while ($dataVal);    
        } catch (Exception $e) {
            print_r($e);die;
        } 
        log_activity('Recoding Sync add_note [StaffID: ' . $this->userID . ']'); 
        set_alert('success', _l('Call history successfully sync', _l('Call')));
        if (!$this->input->is_ajax_request()) {
           redirect($_SERVER['HTTP_REFERER']);
        }
        
    }


    public function get_client_by_number($value='')
    { 
        $data['call_to'] = '';
        $dataRow = $this->db->where('phonenumber','+'.$value)->get('tblclients')->row(); 
        if (!empty($dataRow)) {
            $data['call_to'] = $dataRow->company;
            echo json_encode($data) ;die();
        } 
        $lead =$this->db->where('phonenumber','+'.$value)->get('tblleads')->row();
        if (!empty($lead)) { 
            $data['call_to'] = $lead->name;
            echo json_encode($data) ;die();
        }
        $cont =$this->db->where('phonenumber','+'.$value)->get('tblcontacts')->row();
        if (!empty($cont)) { 
            $data['call_to'] = $cont->firstname.' '.$cont->lastname;
            echo json_encode($data) ;die();
        }
        $staff =$this->db->where('phonenumber','+'.$value)->get('tblstaff')->row();
        if (!empty($staff)) { 
            $data['call_to'] = $staff->firstname.' '.$staff->lastname;
            echo json_encode($data) ;die();
        }
        $data['call_to'] = 'Unknown';
        echo json_encode($data) ;die(); 
    }

    public function save_call_notes()
    { 
        $dataSet = $this->input->post();
    
        $setData['description']   = $dataSet['msg'];
        $value = $dataSet['call_to']; 
        $dataRow = $this->db->where('phonenumber',$value)->get('tblclients')->row(); 
        if (!empty($dataRow)) {
            $setData['rel_type'] = 'client';
            $setData['rel_id']   = $dataRow->id;
        } 
        $lead =$this->db->where('phonenumber',$value)->get('tblleads')->row();
        if (!empty($lead)) { 
            $setData['rel_type'] = 'lead';
            $setData['rel_id']   = $lead->id;
        }
        $cont =$this->db->where('phonenumber',$value)->get('tblcontacts')->row();
        if (!empty($cont)) { 
            $setData['rel_type'] = 'contact';
            $setData['rel_id']   = $cont->id;
        }
        $staff =$this->db->where('phonenumber',$value)->get('tblstaff')->row();
        if (!empty($staff)) { 
            $setData['rel_type'] = 'staff';
            $setData['rel_id']   = $staff->staffid; 
        }
        if (!empty($setData['rel_type']) && !empty($setData['rel_id'])) {
            $note_id = $this->misc_model->add_note($setData, $setData['rel_type'], $setData['rel_id']); 
        }
        if ($note_id) { 
            $res['msg']='Notes added successfully!' ;
        }else{
            $res['msg']='OPPS! There was an error!' ;
        }
        echo json_encode($res);
    }

    public function get_wallet_log_data($value='')
    {  
        $staff = $this->db->where(['admin'=>'1','subdomain_name !='=>''])->get('tblstaff')->row();
           
        $conn = new mysqli($servername, ADMIN_DATABASE_USER, ADMIN_DATABASE_PASSWORD, ADMIN_DATABASE_NAME);
        // $query = "SELECT * FROM tbl_wallet_log WHERE ref_user_id=$this->userID ORDER BY id DESC";
        $query = "SELECT * FROM tbl_wallet_log WHERE user_id = $staff->ref_user_id ORDER BY id DESC"; 
        $result = $conn->query($query); 
        // echo $this->db->last_query();die;
        $data=array();
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
          $data[] = $row;
        }

        $results = ["sEcho" => 1,
                  "iTotalRecords" => count($data),
                  "iTotalDisplayRecords" => count($data),
                  "aaData" => $data ];

        echo json_encode($results);
     
    }
    public function get_client_default_number($value='')
    {
        if (is_admin()) {
           $data = $this->db->where(['is_default_number'=>1,'user_id'=>$this->userID])->get('tbltwilio_number')->row();
        }else{
            $data = $this->db->where(['assign_user_id'=>$this->userID])->get('tbltwilio_number')->row();
        }
        
        if (!empty($data)) {
            echo json_encode($data);
        }else{
            $dataset['error']='error';
            echo json_encode($dataset);
        }
    }
}



