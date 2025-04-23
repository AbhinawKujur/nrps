<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_pay extends MY_Controller{
	public function __construct(){
		parent:: __construct();
	    $this->load->model('Mymodel','dbcon');
	}

	function onlinePayment()
	{
		$total_amount = $this->input->post('total_amount');
		$fee1 = $this->input->post('fee[1]');
		$fee2 = $this->input->post('fee[2]');
		$fee3 = $this->input->post('fee[3]');
		$fee4 = $this->input->post('fee[4]');
		$fee5 = $this->input->post('fee[5]');
		$fee6 = $this->input->post('fee[6]');
		$fee7 = $this->input->post('fee[7]');
		$fee8 = $this->input->post('fee[8]');
		$fee9 = $this->input->post('fee[9]');
		$fee10 = $this->input->post('fee[10]');
		$fee11 = $this->input->post('fee[11]');
		$fee12 = $this->input->post('fee[12]');
		$fee13 = $this->input->post('fee[13]');
		$fee14 = $this->input->post('fee[14]');
		$fee15 = $this->input->post('fee[15]');
		$fee16 = $this->input->post('fee[16]');
		$fee17 = $this->input->post('fee[17]');
		$fee18 = $this->input->post('fee[18]');
		$fee19 = $this->input->post('fee[19]');
		$fee20 = $this->input->post('fee[20]');
		$fee21 = $this->input->post('fee[21]');
		$fee22 = $this->input->post('fee[22]');
		$fee23 = $this->input->post('fee[23]');
		$fee24 = $this->input->post('fee[24]');
		$fee25 = $this->input->post('fee[25]');
		$adm_no = $this->input->post('adm_no');
		$rcpt_no = $this->input->post('rcpt_no');
		$payment_month = $this->input->post('ffm');
		$sessiondata = $this->input->post('sessiondata');
		# Create a "unique" order id.
		$order_id = rand();
		$this->session->set_userdata('unique_idgenereted',$order_id);
		$this->session->set_userdata('sessiondata',$sessiondata);
		$f_name = $this->session->userdata('father_name');
		$stu_details = $this->dbcon->select('student','FIRST_NM,DISP_CLASS,DISP_SEC',"ADM_NO='$adm_no'");
		$on_trans_history = array
		(
			'u_id' => $order_id,
			'request_date' => date('Y-m-d'),
			'request_time' => date('h:i:s'),
			'request_ampm' => date("a"),
			'response_order_id' => 'N/A',
			'response_status' => 'N/A',
			'response_status_id' => 'N/A',
			'adm_no' => $adm_no,
			'parent_name' => $f_name,
			'student_name' => $stu_details[0]->FIRST_NM,
			'class' => $stu_details[0]->DISP_CLASS,
			'sec' => $stu_details[0]->DISP_SEC,
			'period' => $payment_month,
			'total' => $total_amount,
			'fee1' => $fee1,
			'fee2' => $fee2,
			'fee3' => $fee3,
			'fee4' => $fee4,
			'fee5' => $fee5,
			'fee6' => $fee6,
			'fee7' => $fee7,
			'fee8' => $fee8,
			'fee9' => $fee9,
			'fee10' => $fee10,
			'fee11' => $fee11,
			'fee12' => $fee12,
			'fee13' => $fee13,
			'fee14' => $fee14,
			'fee15' => $fee15,
			'fee16' => $fee16,
			'fee17' => $fee17,
			'fee18' => $fee18,
			'fee19' => $fee19,
			'fee20' => $fee20,
			'fee21' => $fee21,
			'fee22' => $fee22,
			'fee23' => $fee23,
			'fee24' => $fee24,
			'fee25' => $fee25
			
		);
		if($this->dbcon->insert('onlinepaymentrequest_status',$on_trans_history)){
			# Create the order with /order/create API call
			$ch = curl_init('https://api.juspay.in/order/create');

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    

			# You should use your API key here.               
			curl_setopt($ch, CURLOPT_USERPWD, 'D15F44B15124D48BA6BE6037CC82D8:');
			curl_setopt($ch, CURLOPT_POST, 1); 

			# Set the customer_id, customer_email , amount and order_id as per details.
			# NOTE: The amount and order_id are the fields associated with the "current" order.
			$customer_id = $adm_no;
			$customer_email = 'student@gmail.com';
			$amount = $total_amount;
			
			$sendingData = array(
				'customer_id' => $customer_id,
				'customer_email' => $customer_email,
				'amount' => $amount,
				'order_id' => $order_id 
			);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $sendingData);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);                    
			curl_setopt($ch,CURLOPT_TIMEOUT, 15); 
			$response = curl_exec($ch);
			$response = json_decode($response);
			$action = $response->payment_links->web;
			header("Location:".$action);
		}
		else{
			
		}
		
	}


	public function responseByjuspay()
	{
		$order_id = $_GET['order_id'];
		$status = $_GET['status'];
		$status_id = $_GET['status_id'];
		$sessiondata = $this->session->userdata('sessiondata');
		echo "<pre>";
		print_r($sessiondata);
		exit;
		if($status == "CHARGED" && $status_id=21){
			echo "success";
			//print_r("<pre>");
			//print_r($sessiondata);
			//print_r($order_id);
			//echo "<br>";print_r($status);
			//echo "<br>";print_r($status_id);
		}else{
			echo "no id";
		}
		
	}

	public function pay_details(){
		$mon[0] 	   		= $this->input->post('apr');
		$mon[1]      	    = $this->input->post('may');
		$mon[2]       		= $this->input->post('jun');
		$mon[3]       		= $this->input->post('jul');
		$mon[4]      		= $this->input->post('aug');
		$mon[5]       		= $this->input->post('sep');
		$mon[6]       		= $this->input->post('oct');
		$mon[7]      	    = $this->input->post('nov');
		$mon[8]       		= $this->input->post('dec');
		$mon[9]       		= $this->input->post('jan');
		$mon[10]       		= $this->input->post('feb');
		$mon[11]       		= $this->input->post('mar');
		$ffm       			= $this->input->post('ffm');
		$rcpt_no   		= $this->input->post('rcpt_no');
		
		$rect_no = array();
		$cnt_mon = count($mon);
		
		for($i=0; $i<$cnt_mon;$i++){
		  if($mon[$i] == null){
			  $rect_no[] = 'N/A';
			}
		  else{
			 $rect_no[] =  $rcpt_no;
			}
		}
		if($mon[0]=='APR')
		{
			if($mon[0]=='APR')
			{
				$apr_recpt = $rcpt_no;
			}
			else
			{
				$apr_recpt = 'N/A';
			}
			if($mon[1]=='MAY')
			{
				$may_recpt = $rcpt_no;
			}
			else
			{
				$may_recpt = 'N/A';
			}
			if($mon[2]=='JUN')
			{
				$jun_recpt = $rcpt_no;
			}
			else
			{
				$jun_recpt = 'N/A';
			}
			if($mon[3]=='JUL')
			{
				$jul_recpt = $rcpt_no;
			}
			else
			{
				$jul_recpt = 'N/A';
			}
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			
			$data = array(
				'APR_FEE' => $apr_recpt,
				'MAY_FEE' => $may_recpt,
				'JUNE_FEE' => $jun_recpt,
				'JULY_FEE' => $jul_recpt,
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		else if($mon[1]=='MAY')
		{
			if($mon[1]=='MAY')
			{
				$may_recpt = $rcpt_no;
			}
			else
			{
				$may_recpt = 'N/A';
			}
			if($mon[2]=='JUN')
			{
				$jun_recpt = $rcpt_no;
			}
			else
			{
				$jun_recpt = 'N/A';
			}
			if($mon[3]=='JUL')
			{
				$jul_recpt = $rcpt_no;
			}
			else
			{
				$jul_recpt = 'N/A';
			}
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'MAY_FEE' => $may_recpt,
				'JUNE_FEE' => $jun_recpt,
				'JULY_FEE' => $jul_recpt,
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[2]=='JUN')
		{
			if($mon[2]=='JUN')
			{
				$jun_recpt = $rcpt_no;
			}
			else
			{
				$jun_recpt = 'N/A';
			}
			if($mon[3]=='JUL')
			{
				$jul_recpt = $rcpt_no;
			}
			else
			{
				$jul_recpt = 'N/A';
			}
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'JUNE_FEE' => $jun_recpt,
				'JULY_FEE' => $jul_recpt,
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[3]=='JUL')
		{
			if($mon[3]=='JUL')
			{
				$jul_recpt = $rcpt_no;
			}
			else
			{
				$jul_recpt = 'N/A';
			}
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'JULY_FEE' => $jul_recpt,
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[4]=='AUG')
		{
			if($mon[4]=='AUG')
			{
				$aug_recpt = $rcpt_no;
			}
			else
			{
				$aug_recpt = 'N/A';
			}
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'AUG_FEE' => $aug_recpt,
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[5]=='SEP')
		{
			if($mon[5]=='SEP')
			{
				$sep_recpt = $rcpt_no;
			}
			else
			{
				$sep_recpt = 'N/A';
			}
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'SEP_FEE' => $sep_recpt,
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[6]=='OCT')
		{
			if($mon[6]=='OCT')
			{
				$oct_recpt = $rcpt_no;
			}
			else
			{
				$oct_recpt = 'N/A';
			}
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'OCT_FEE' => $oct_recpt,
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[7]=='NOV')
		{
			if($mon[7]=='NOV')
			{
				$nov_recpt = $rcpt_no;
			}
			else
			{
				$nov_recpt = 'N/A';
			}
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'NOV_FEE' => $nov_recpt,
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[8]=='DEC')
		{
			if($mon[8]=='DEC')
			{
				$dec_recpt = $rcpt_no;
			}
			else
			{
				$dec_recpt = 'N/A';
			}
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'DEC_FEE' => $dec_recpt,
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
				);
		}
		ELSE IF($mon[9]=='JAN')
		{
			if($mon[9]=='JAN')
			{
				$jan_recpt = $rcpt_no;
			}
			else
			{
				$jan_recpt = 'N/A';
			}
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'JAN_FEE' => $jan_recpt,
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[10]=='FEB')
		{
			if($mon[10]=='FEB')
			{
				$feb_recpt = $rcpt_no;
			}
			else
			{
				$feb_recpt = 'N/A';
			}
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'FEB_FEE' => $feb_recpt,
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE IF($mon[11]=='MAR')
		{
			if($mon[11]=='MAR')
			{
				$mar_recpt = $rcpt_no;
			}
			else
			{
				$mar_recpt = 'N/A';
			}
			$data = array(
				'MAR_FEE' => $mar_recpt
			);
		}
		ELSE
		{
			
		}
		echo "<pre>";
		print_r($rect_no);
		print_r($data);
		echo $ffm;
		echo "<br>";
		echo "<a href=".base_url('Parent_details/pay_details').">BACK</a>";
		exit;
	}
}