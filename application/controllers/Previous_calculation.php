<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Previous_calculation extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function get_pay_details()
	{
		$adm_no  	= $this->input->post('adm_no');
		$rcpt_no 	= $this->input->post('rcpt_no');
		$ward_type  = $this->input->post('ward_type');
		$bsn		= $this->input->post('bsn');
		$bsa		= $this->input->post('bsa');
		$ffm		= $this->input->post('ffm');
		$month = $this->input->post('month[]');
		//fetching data from the data base//
		$student_data = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$session 	  = $this->dbcon->select('session_master','*',"Active_Status='1'");
		$payment_mode = $this->dbcon->select('payment_mode','*');
		$bank		  = $this->dbcon->select('bank_master','*');
		//end of fetching of data/
		$amt_feehead1 = 0;
		$amt_feehead2 = 0;
		$amt_feehead3 = 0;
		$amt_feehead4 = 0;
		$amt_feehead5 = 0;
		$amt_feehead6 = 0;
		$amt_feehead7 = 0;
		$amt_feehead8 = 0;
		$amt_feehead9 = 0;
		$amt_feehead10 = 0;
		$amt_feehead11 = 0;
		$amt_feehead12 = 0;
		$amt_feehead13 = 0;
		$amt_feehead14 = 0;
		$amt_feehead15 = 0;
		$amt_feehead16 = 0;
		$amt_feehead17 = 0;
		$amt_feehead18 = 0;
		$amt_feehead19 = 0;
		$amt_feehead20 = 0;
		$amt_feehead21 = 0;
		$amt_feehead22 = 0;
		$amt_feehead23 = 0;
		$amt_feehead24 = 0;
		$amt_feehead25 = 0;
		$total_amount = 0;
		foreach($month as $key => $month_key){
			$data = $this->dbcon->select('previous_year_feegeneration','Fee1,Fee2,Fee3,Fee4,Fee5,Fee6,Fee7,Fee8,Fee9,Fee10,Fee11,Fee12,Fee13,Fee14,Fee15,Fee16,Fee17,Fee18,Fee19,Fee20,Fee21,Fee22,Fee23,Fee24,Fee25,TOTAL',"ADM_NO='$adm_no' AND Month_NM='$month_key'");
			$amt_feehead1 += $data[0]->Fee1;
			$amt_feehead2 += $data[0]->Fee2;
			$amt_feehead3 += $data[0]->Fee3;
			$amt_feehead4 += $data[0]->Fee4;
			$amt_feehead5 += $data[0]->Fee5;
			$amt_feehead6 += $data[0]->Fee6;
			$amt_feehead7 += $data[0]->Fee7;
			$amt_feehead8 += $data[0]->Fee8;
			$amt_feehead9 += $data[0]->Fee9;
			$amt_feehead10 += $data[0]->Fee10;
			$amt_feehead11 += $data[0]->Fee11;
			$amt_feehead12 += $data[0]->Fee12;
			$amt_feehead13 += $data[0]->Fee13;
			$amt_feehead14 += $data[0]->Fee14;
			$amt_feehead15 += $data[0]->Fee15;
			$amt_feehead16 += $data[0]->Fee16;
			$amt_feehead17 += $data[0]->Fee17;
			$amt_feehead18 += $data[0]->Fee18;
			$amt_feehead19 += $data[0]->Fee19;
			$amt_feehead20 += $data[0]->Fee20;
			$amt_feehead21 += $data[0]->Fee21;
			$amt_feehead22 += $data[0]->Fee22;
			$amt_feehead23 += $data[0]->Fee23;
			$amt_feehead24 += $data[0]->Fee24;
			$amt_feehead25 += $data[0]->Fee25;
			$total_amount += $data[0]->TOTAL;
		}
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] 	= $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
			$AccG[$i]		= $feehead[$i][0]->AccG;
			$fee_head[$i] 	= $feehead[$i][0]->FEE_HEAD;
		}
		$array = array(
				'adm_no' 	=> $adm_no,
				'feehead1'  => $fee_head[1],
				'feehead2'  => $fee_head[2],
				'feehead3'  => $fee_head[3],
				'feehead4'  => $fee_head[4],
				'feehead5'  => $fee_head[5],
				'feehead6'  => $fee_head[6],
				'feehead7'  => $fee_head[7],
				'feehead8'  => $fee_head[8],
				'feehead9'  => $fee_head[9],
				'feehead10' => $fee_head[10],
				'feehead11' => $fee_head[11],
				'feehead12' => $fee_head[12],
				'feehead13' => $fee_head[13],
				'feehead14' => $fee_head[14],
				'feehead15' => $fee_head[15],
				'feehead16' => $fee_head[16],
				'feehead17' => $fee_head[17],
				'feehead18' => $fee_head[18],
				'feehead19' => $fee_head[19],
				'feehead20' => $fee_head[20],
				'feehead21' => $fee_head[21],
				'feehead22' => $fee_head[22],
				'feehead23' => $fee_head[23],
				'feehead24' => $fee_head[24],
				'feehead25' => $fee_head[25],
				'AccG1'   => $AccG[1],
				'AccG2'   => $AccG[2],
				'AccG3'   => $AccG[3],
				'AccG4'   => $AccG[4],
				'AccG5'   => $AccG[5],
				'AccG6'   => $AccG[6],
				'AccG7'   => $AccG[7],
				'AccG8'   => $AccG[8],
				'AccG9'   => $AccG[9],
				'AccG10'   => $AccG[10],
				'AccG11'   => $AccG[11],
				'AccG12'   => $AccG[12],
				'AccG13'   => $AccG[13],
				'AccG14'   => $AccG[14],
				'AccG15'   => $AccG[15],
				'AccG16'   => $AccG[16],
				'AccG17'   => $AccG[17],
				'AccG18'   => $AccG[18],
				'AccG19'   => $AccG[19],
				'AccG20'   => $AccG[20],
				'AccG21'   => $AccG[21],
				'AccG22'   => $AccG[22],
				'AccG23'   => $AccG[23],
				'AccG24'   => $AccG[24],
				'AccG25'   => $AccG[25],
				'amt_feehead1' => $amt_feehead1,
				'amt_feehead2' => $amt_feehead2,
				'amt_feehead3' => $amt_feehead3,
				'amt_feehead4' => $amt_feehead4,
				'amt_feehead5' => $amt_feehead5,
				'amt_feehead6' => $amt_feehead6,
				'amt_feehead7' => $amt_feehead7,
				'amt_feehead8' => $amt_feehead8,
				'amt_feehead9' => $amt_feehead9,
				'amt_feehead10' => $amt_feehead10,
				'amt_feehead11' => $amt_feehead11,
				'amt_feehead12' => $amt_feehead12,
				'amt_feehead13' => $amt_feehead13,
				'amt_feehead14' => $amt_feehead14,
				'amt_feehead15' => $amt_feehead15,
				'amt_feehead16' => $amt_feehead16,
				'amt_feehead17' => $amt_feehead17,
				'amt_feehead18' => $amt_feehead18,
				'amt_feehead19' => $amt_feehead19,
				'amt_feehead20' => $amt_feehead20,
				'amt_feehead21' => $amt_feehead21,
				'amt_feehead22' => $amt_feehead22,
				'amt_feehead23' => $amt_feehead23,
				'amt_feehead24' => $amt_feehead24,
				'amt_feehead25' => $amt_feehead25,
				'total_amount'  => $total_amount,
				'payment_mode'  => $payment_mode,
				'bank'			=> $bank,
				'rcpt_no'		=> $rcpt_no,
				'student_data'	=> $student_data,
				'ward_type'     => $ward_type,
				'bsn'           => $bsn,
				'bsa'			=> $bsa,
				'ffm'			=> $ffm,
				'month'         => $month
			);
			$this->load->view('previous_collection/feehaead_calculation_monthwise',$array);
	}
}