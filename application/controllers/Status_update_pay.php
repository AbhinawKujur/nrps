<?php

/*
* @param1 : Plain String
* @param2 : Working key provided by CCAvenue
* @return : Decrypted String
*/
function encrypt($plainText,$key)
{
	$key = hextobin(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
	$encryptedText = bin2hex($openMode);
	return $encryptedText;
}

/*
* @param1 : Encrypted String
* @param2 : Working key provided by CCAvenue
* @return : Plain String
*/
function decrypt($encryptedText,$key)
{
	$key = hextobin(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$encryptedText = hextobin($encryptedText);
	$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
	return $decryptedText;
}

function hextobin($hexString) 
 { 
	$length = strlen($hexString); 
	$binString="";   
	$count=0; 
	while($count<$length) 
	{       
	    $subString =substr($hexString,$count,2);           
	    $packedString = pack("H*",$subString); 
	    if ($count==0)
	    {
			$binString=$packedString;
	    } 
	    
	    else 
	    {
			$binString.=$packedString;
	    } 
	    
	    $count+=2; 
	} 
        return $binString; 
  } 
?>
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_update_pay extends MY_Controller{
	public function __construct(){     
		parent:: __construct();
	    $this->load->model('Farheen','farheen');
	    $this->load->model('Alam','alam');
		$this->load->model('Mymodel','dbcon');
		error_reporting(0);
	}
	
	public function apitest(){

error_reporting(0);
$working_key = '7F0876900816421A9BAC221F7FACE121'; //Shared by CCAVENUES
$access_code = 'AVBI92HE42CJ30IBJC';
$merchant_json_data =
 array(
   'order_no' => '1630671671268',// 1621856896272  this order id is not working ofter successfull transaction
  'merchant_id' => '260186',
);


$merchant_data = json_encode($merchant_json_data);
$encrypted_data = encrypt($merchant_data, $working_key);

$final_data ='enc_request='.$encrypted_data.'&access_code='.$access_code.'&command=orderStatusTracker&request_type=JSON&response_type=JSON';
?>

<form action='https://logintest.ccavenue.com/apis/servlet/DoWebTrans' method='post'>

<input type='text' value="<?php echo $encrypted_data;?>" name='enc_request'>
<input type='text' value="<?php echo $access_code;?>" name='access_code'>
<input type='text' value="orderStatusTracker" name='command'>
<input type='text' value="JSON" name='request_type'>
<input type='text' value="JSON" name='response_type'>
<input type='text' value="version" name='1.2'>
<input type='submit' value="submit">
</form>
<?php
	}

public function fetch_status($orderid){


$working_key = '7F0876900816421A9BAC221F7FACE121'; //Shared by CCAVENUES
$access_code = 'AVBI92HE42CJ30IBJC';
$merchant_json_data =
    array(
   'order_no' => $orderid,
   'merchant_id' => '260186',
);

$merchant_data = json_encode($merchant_json_data);
$encrypted_data = encrypt($merchant_data, $working_key);
$final_data ='enc_request='.$encrypted_data.'&access_code='.$access_code.'&command=orderStatusTracker&request_type=JSON&response_type=JSON';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.ccavenue.com/apis/servlet/DoWebTrans");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER,'Content-Type: application/json') ;
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
// Get server response ...
$result = curl_exec($ch);
curl_close($ch);
$status = '';
$information = explode('&', $result);

$dataSize = sizeof($information);
for ($i = 0; $i < $dataSize; $i++) {
    $info_value = explode('=', $information[$i]);
    if ($info_value[0] == 'enc_response') {
	$status = decrypt(trim($info_value[1]), $working_key);
}
}

 $obj = json_decode($status);

	$data['reference_no']=$obj->Order_Status_Result->reference_no;
	$data['order_bank_ref_no']=$obj->Order_Status_Result->order_bank_ref_no;
	$data['order_card_name']=$obj->Order_Status_Result->order_card_name;
	$data['order_status']=$obj->Order_Status_Result->order_status;
	$data['order_amt']=$obj->Order_Status_Result->order_amt;
	$data['order_bill_name']=$obj->Order_Status_Result->order_bill_name;
	$data['order_no']=$obj->Order_Status_Result->order_no;
return $data;

}

	public function update_payment()
	{
		//$id = generate_session['id'];
		//$alltran = $this->alam->select('online_transaction',"order_id,User_id","order_status 'Success'");
		$query="SELECT order_id,User_id FROM `online_transaction` where order_status !='Success' || order_status is null order by id desc";
		$alltran=$this->db->query($query)->result_array();

foreach($alltran as $key){
$status=$this->fetch_status($key->order_id);
	//echo "<pre>";
	//print_r($status);
		
if($status['order_status'] =='Shipped'){
	    $User_id=$key->User_id;
		$order_id=$key->order_id;
		$tracking_id=$status['reference_no'];
		$bank_ref_no=$status['order_bank_ref_no'];
		$order_status='Success';
		$failure_message="status_api_update";
		$payment_mode="online";
		$card_name=$status['order_card_name'];
		$status_message=$status['order_status'];
		$amount=$status['order_amt'];
		$online_trans = $this->db->query("select * from online_transaction where order_id='$order_id'")->result();
		$admm = $online_trans[0]->ADM_NO;
        $stuu_name = $online_trans[0]->STU_NAME; 		
        $on_orderid = $online_trans[0]->order_id;
		$on_amt = $online_trans[0]->pay_amount;
		$on_period = $online_trans[0]->PERIOD;
		$upt_data = array(
			
			'tracking_id' => $tracking_id,
			'bank_ref_no' => $bank_ref_no,
			'order_status' => $order_status,
			'failure_msg' => $failure_msg,
			'pay_mode' => $payment_mode,
			'card_name' => $card_name,
			//'status_code' => $status_code,
			'status_msg' => $status_msg,
			'rcv_amt' => $amount,
			'payment_status' =>  'response_rcpt'
		);

		$admm = $online_trans[0]->ADM_NO;
        $stuu_name = $online_trans[0]->STU_NAME; 		
        $on_orderid = $online_trans[0]->order_id;
		$on_amt = $online_trans[0]->pay_amount;
		$on_period = $online_trans[0]->PERIOD;
		
		$str_arr = explode ("-", $on_period);
		$trans_month = implode("",$str_arr);
		
		$stuu_dett = $this->db->query("select C_MOBILE from student where ADM_NO='$admm'")->result();
		$mobile = $stuu_dett[0]->C_MOBILE;
		
		//$order_id = $this->session->userdata('tid');
		//$track_id =  $this->session->userdata('track_id');
	
		
		$recpt_val = $this->db->query("select max(RECT_NO) as rec_no from daycoll where Mid(RECT_NO,1,2)='ON'")->result();
		$rcpt_cnt =  count($recpt_val);
		if($rcpt_cnt == 0)
		{
		    $rcpt = 'ON00000';
		}
		else{
		     $rcpt = $recpt_val[0]->rec_no;
         }
		
		$data = explode('ON',$rcpt);
        @$number = $data[1];
		$number++;
        $rcpt_dig = str_pad($number, 5, "0", STR_PAD_LEFT);
		$rcpt_no = 'ON'.$rcpt_dig;
		
		$this->session->set_userdata('sessionRecepitData',$rcpt_no);
		$ses = $this->session->userdata('sessionRecepitData');
		
		$upt_data = array(
			
			'tracking_id' => $tracking_id,
			'bank_ref_no' => $bank_ref_no,
			'order_status' => $order_status,
			'failure_msg' => $failure_msg,
			'pay_mode' => $payment_mode,
			'card_name' => $card_name,
			//'status_code' => $status_code,
			'status_msg' => $status_msg,
			'rcv_amt' => $amount,
			'payment_status' =>  'response_rcpt'
		);
		
		$this->dbcon->update('online_transaction',$upt_data,"order_id='$order_id'");
		//$rec_no = $online_trans[0]->RECT_NO;
		$pre_fee = $this->db->query("select * from previous_year_feegeneration where ADM_NO='$admm'")->result();
		$pre_due = count($pre_fee);
		$today_date = date('Y-m-d H:i:s');
		if(($on_orderid == $order_id) AND ($on_amt == $amount)  AND ($order_status == 'Success') AND ($billing_name == $trans_month))
		{   
	        if($pre_due > 0)
			{
			 $dycl_chk = $this->db->query("select * from daycoll where CHQ_NO='$order_id'")->result();
			 $dychk_cnt = count($dycl_chk);
			 if($dychk_cnt == 0)
		     {	
			$month = $online_trans[0]->PERIOD;
		    $mon = explode("-",$month);
			$mn_cnt = count($mon);
			
			foreach($mon as $key => $val){
			  if($val == 'JUN'){
				  $val = 'JUNE';
				}
			  if($val == 'JUL'){
				  $val = 'JULY';
				}
		
		      $dayycol = $this->db->query("select * from daycoll where RECT_NO='$ses'")->result();
				$dy_cnt = count($dayycol);
				if($dy_cnt == 0)
				{
					$daycall = array(
			'RECT_NO'  => $ses,
			'RECT_DATE' => $online_trans[0]->trans_date,
			'STU_NAME' => $online_trans[0]->STU_NAME,
			'STUDENTID' => $online_trans[0]->STUDENTID,
			'ADM_NO' => $online_trans[0]->ADM_NO,
			'CLASS' => $online_trans[0]->CLASS,
			'SEC' => $online_trans[0]->SEC,
			'ROLL_NO' => $online_trans[0]->ROLL_NO,
			'PERIOD' => 'PRE'.$online_trans[0]->PERIOD,
			'TOTAL' => $online_trans[0]->TOTAL,
			'fee1' => '0',
			'fee2' => '0',
			'fee3' => '0',
			'fee4' =>'0',
			'fee5' => '0',
			'fee6' => '0',
			'fee7' => '0',
			'fee8' => '0',
			'fee9' => '0',
			'fee10' =>'0',
			'fee11' => $online_trans[0]->TOTAL,
			'fee12' =>'0',
			'fee13' => '0',
			'fee14' => '0',
			'fee15' => '0',
			'fee16' => '0',
			'fee17' => '0',
			'fee18' => '0',
			'fee19' => '0',
			'fee20' => '0',
			'fee21' => '0',
			'fee22' => '0',
			'fee23' => '0',
			'fee24' => '0',
			'fee25' => '0',
			 $val.'_FEE' => $ses,
            'Collection_Mode' => 3,
			'Payment_Mode' => 'ONLINE',
			'Bank_Name' => 'CC Avenue',
            'User_Id'         => $User_Id,
             'CHQ_NO' => $order_id,
             'Narr' => 'N/A',
             'TAmt' => 0,
             'Fee_Book_No' => 0,
			);
					
		      $this->dbcon->insert('daycoll',$daycall);
				}
				else{
			 $upd_dyy = array(
				$val.'_FEE' => $ses,
			);
				
			$this->dbcon->update('daycoll',$upd_dyy,"RECT_NO='$ses'");
				}
			$precol = $this->db->query("select * from previous_year_collection where RECT_NO='$ses'")->result();
				$pre_cnt = count($precol);
				if($pre_cnt == 0)
				{
			$pree_yr = array(
			'RECT_NO'  => $ses,
			'RECT_DATE' => $online_trans[0]->trans_date,
			'STU_NAME' => $online_trans[0]->STU_NAME,
			'STUDENTID' => $online_trans[0]->STUDENTID,
			'ADM_NO' => $online_trans[0]->ADM_NO,
			'CLASS' => $online_trans[0]->CLASS,
			'SEC' => $online_trans[0]->SEC,
			'ROLL_NO' => $online_trans[0]->ROLL_NO,
			'PERIOD' => 'PRE'.$online_trans[0]->PERIOD,
			'TOTAL' => $online_trans[0]->TOTAL,
			'fee1' => $online_trans[0]->Fee1,
			'fee2' => $online_trans[0]->Fee2,
			'fee3' => $online_trans[0]->Fee3,
			'fee4' => $online_trans[0]->Fee4,
			'fee5' => $online_trans[0]->Fee5,
			'fee6' => $online_trans[0]->Fee6,
			'fee7' => $online_trans[0]->Fee7,
			'fee8' => $online_trans[0]->Fee8,
			'fee9' => $online_trans[0]->Fee9,
			'fee10' => $online_trans[0]->Fee10,
			'fee11' => $online_trans[0]->Fee11,
			'fee12' => $online_trans[0]->Fee12,
			'fee13' => $online_trans[0]->Fee13,
			'fee14' => $online_trans[0]->Fee14,
			'fee15' => $online_trans[0]->Fee15,
			'fee16' => $online_trans[0]->Fee16,
			'fee17' => $online_trans[0]->Fee17,
			'fee18' => $online_trans[0]->Fee18,
			'fee19' => $online_trans[0]->Fee19,
			'fee20' => $online_trans[0]->Fee20,
			'fee21' => $online_trans[0]->Fee21,
			'fee22' => $online_trans[0]->Fee22,
			'fee23' => $online_trans[0]->Fee23,
			'fee24' => $online_trans[0]->Fee24,
			'fee25' => $online_trans[0]->Fee25,
			 $val.'_FEE' => $ses,
            'Collection_Mode' => 3,
			'Payment_Mode' => 'ONLINE',
			'Bank_Name' => 'CC Avenue',
            'User_Id'         => $User_Id,
             'CHQ_NO' => $order_id,
             'Narr' => 'N/A',
             'TAmt' => 0,
             'Fee_Book_No' => 0,
			);
		  $this->dbcon->insert('previous_year_collection',$pree_yr);
				}
				else{
			 $upd_pre = array(
				$val.'_FEE' => $ses,
				);
			$this->dbcon->update('previous_year_collection',$upd_pre,"RECT_NO='$ses'");
				}
			$online_trans = array(
				'Pay_Date' => $today_date,
				'RECT_DATE'  => $today_date,
				'RECT_NO'  => $ses,
				$val.'_FEE' => $ses,
				
			);
				
			$this->dbcon->update('online_transaction',$online_trans,"order_id='$order_id'");
				$upd_stu = array(
				$val.'_FEE' => $ses,
				);
			}
			
			for($i=0;$i<$mn_cnt;$i++){
					$this->dbcon->del_pre_fee_generation($mon[$i],$admm);
				}
				
				//$message = "Dear Parents,\r\nYou have paid the fees for the month of 'PRE'.$on_period , amount $on_amt for $stuu_name .\r\n ACHARYAKULAM";
				//$this->sms_lib->sendSMS($mobile,$message);
				}
		   else
		   {
			   	echo "<h2 style='text-align:center;color:red;'>Thank you for making a payment !!!!!</h2>";
    			die();
		   }
			}
			else
			{
			$dycl_chk = $this->db->query("select * from daycoll where CHQ_NO='$order_id'")->result();
			 $dychk_cnt = count($dycl_chk);
			 if($dychk_cnt == 0)
			{	
			$month = $online_trans[0]->PERIOD;
		    $mon = explode("-",$month);
			foreach($mon as $key => $val){
			  if($val == 'JUN'){
				  $val = 'JUNE';
				}
			  if($val == 'JUL'){
				  $val = 'JULY';
				}
		
		   $daycall = array(
			'RECT_NO'  => $ses,
			'RECT_DATE' => $online_trans[0]->trans_date,
			'STU_NAME' => $online_trans[0]->STU_NAME,
			'STUDENTID' => $online_trans[0]->STUDENTID,
			'ADM_NO' => $online_trans[0]->ADM_NO,
			'CLASS' => $online_trans[0]->CLASS,
			'SEC' => $online_trans[0]->SEC,
			'ROLL_NO' => $online_trans[0]->ROLL_NO,
			'PERIOD' => $online_trans[0]->PERIOD,
			'TOTAL' => $online_trans[0]->TOTAL,
			'fee1' => $online_trans[0]->Fee1,
			'fee2' => $online_trans[0]->Fee2,
			'fee3' => $online_trans[0]->Fee3,
			'fee4' => $online_trans[0]->Fee4,
			'fee5' => $online_trans[0]->Fee5,
			'fee6' => $online_trans[0]->Fee6,
			'fee7' => $online_trans[0]->Fee7,
			'fee8' => $online_trans[0]->Fee8,
			'fee9' => $online_trans[0]->Fee9,
			'fee10' => $online_trans[0]->Fee10,
			'fee11' => $online_trans[0]->Fee11,
			'fee12' => $online_trans[0]->Fee12,
			'fee13' => $online_trans[0]->Fee13,
			'fee14' => $online_trans[0]->Fee14,
			'fee15' => $online_trans[0]->Fee15,
			'fee16' => $online_trans[0]->Fee16,
			'fee17' => $online_trans[0]->Fee17,
			'fee18' => $online_trans[0]->Fee18,
			'fee19' => $online_trans[0]->Fee19,
			'fee20' => $online_trans[0]->Fee20,
			'fee21' => $online_trans[0]->Fee21,
			'fee22' => $online_trans[0]->Fee22,
			'fee23' => $online_trans[0]->Fee23,
			'fee24' => $online_trans[0]->Fee24,
			'fee25' => $online_trans[0]->Fee25,
			 $val.'_FEE' => $ses,
            'Collection_Mode' => 3,
			'Payment_Mode' => 'ONLINE',
			'Bank_Name' => 'CC Avenue',
            'User_Id'         => $User_Id,
             'CHQ_NO' => $order_id,
             'Narr' => 'N/A',
             'TAmt' => 0,
             'Fee_Book_No' => 0,
			);
			
		  $dayycol = $this->db->query("select * from daycoll where RECT_NO='$ses'")->result();
				$dy_cnt = count($dayycol);
				if($dy_cnt == 0)
				{
		  $this->dbcon->insert('daycoll',$daycall);
				}
				else{
			 $upd_dyy = array(
				
				$val.'_FEE' => $ses,
				
			);
				
			$this->dbcon->update('daycoll',$upd_dyy,"RECT_NO='$ses'");
				}
			$online_trans = array(
				'Pay_Date' => $today_date,
				'RECT_DATE'  => $today_date,
				'RECT_NO'  => $ses,
				$val.'_FEE' => $ses,
				
			);
				
			$this->dbcon->update('online_transaction',$online_trans,"order_id='$order_id'");
				
				$upd_stu = array(
				
				$val.'_FEE' => $ses,
				
			);
				
		$this->dbcon->update('student',$upd_stu,"ADM_NO='$admm'");
				
			}
		//	$message = "Dear Parents,\r\nYou have paid the fees for the month of $on_period , amount $on_amt for $stuu_name .\r\n ACHARYAKULAM";
			//$this->sms_lib->sendSMS($mobile,$message);
			}
           else{
			   
			   echo "<h2 style='text-align:center;color:red;'>Thank you for making a payment !!!!!</h2>";
    
			   die();
		   }		
			}
				
			}
		else{
		
				$uptt_data = array(
			
			'tracking_id' => $tracking_id,
			'bank_ref_no' => $bank_ref_no,
			'order_status' => $order_status,
			'failure_msg' => $failure_msg,
			'pay_mode' => 'ONLINE',
			'card_name' => $card_name,
			'status_code' => $auth_code,
			'status_msg' => $status_msg,
			//'rcv_amt' => $amount,
			'payment_status' =>  'response_rcpt',
		     //'RECT_DATE'  => $today_date,
		     //'RECT_NO'  => $rcpt_no,
		);
		
			$this->dbcon->update('online_transaction',$uptt_data,"order_id='$order_id'");
		}
		   
		
	}
}
			
	}
	
}