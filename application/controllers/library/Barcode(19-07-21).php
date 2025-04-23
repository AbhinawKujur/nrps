<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode extends MY_controller{
	public function __construct(){
		parent:: __construct();
		$this->load->model('Pawan','pawan');
	}
	public function index(){		
		$data['subjectname']   	= $this->pawan->selectA('library_call_master','*');		
		$this->render_template('library/barcode',$data);
	}
	
	public function generate(){
		echo "<script> window.print();</script>";
		include 'barcode128.php';
		if(isset($_POST['search']))
		{
			
			$ck= $this->input->post('barcode');
			if($ck=="all"){
				
			$data['book_data']  = $this->pawan->selectA('bookmaster','*');
			}else if($ck=="subject"){
					$subj_id= $this->input->post('subj_id');
			$data['book_data']  = $this->pawan->selectA('bookmaster','BNAME,AUTHOR,PurName,B_Code,accno',"SUB_ID='$subj_id'");
			
			}else{
				$from= $this->input->post('from');
			$to= $this->input->post('to');
			
			$data['book_data']  = $this->pawan->selectA("bookmaster","*","accno BETWEEN $from AND $to");
			
			}
		
			
			
			$school_name   = $this->pawan->selectA('school_setting','*');	
		$school_name=$school_name[0]['School_Name'];
			$html1="";
			$html1 .="<table><tr>";
			$totCnt = count($data['book_data']);
			//$divby = round($totCnt/10);
			$tcon=4;
			foreach($data['book_data'] as $key => $val){
				if($key == $tcon){
					$html1 .="<tr><td></td></tr>";
					$tcon =$tcon+4;
				}
			$html1 .="<td><div class='inline' style='border: 1px solid;width:160px;height:133px;text-align: left;margin:15px'>
			".bar128(stripcslashes($val['accno']))."
			<span style='font-size: 10px;font-weight:bold;'>&nbsp;&nbsp;".$val['BNAME']." <br/>&nbsp; ".$val['AUTHOR']." </span>
			<br/>
			
		</td>";
			
			}
			
			$html1 .="</tr></table>";
		echo $html1;
		//ini_set('output_buffering', true); // no limit
	  //ini_set('output_buffering', 12288); // 12KB limit			
	//	$html = $this->output->get_output();
		// $this->load->library('pdf');
		//$this->dompdf->loadHtml($html);
		// $this->dompdf->setPaper('A4', 'landscape');
		// $this->dompdf->render();
		// $this->dompdf->set_option("isPhpEnabled", true);
		// $this->dompdf->stream("salaryslip.pdf", array("Attachment"=>0));
			
			
		}

		
	}
}