<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LibraryReport extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');
		$this->load->model('Alam','alam');
	}
	
	public function index(){		
		$data['title']	='';
		if(isset($_POST['search']))
		{		
			$rpttyp				=$this->input->post('rpttyp');
			$fromdt				=date('Y-m-d',strtotime($this->input->post('fromdt')));
			$to_dt				=date('Y-m-d',strtotime($this->input->post('to_dt')));
			// echo $rpttyp." ". $fromdt." ".$to_dt;die();
			$data['reportType']= $rpttyp;
			if($rpttyp==0){
				$data['title']	=' Issued Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied','*,(SELECT FIRST_NM FROM Student WHERE books_applied.admno=student.LETTERNO) AS snm,(SELECT disp_class FROM Student WHERE books_applied.admno=student.LETTERNO) AS cls,(SELECT disp_sec FROM Student WHERE books_applied.admno=student.LETTERNO) AS sec'," Issued='1' and IDate BETWEEN '$fromdt' AND '$to_dt'");
				// echo "<pre>";
				// print_r($data);die();

			}elseif($rpttyp==1){
				$data['title']	='All Issued Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied','*,(SELECT FIRST_NM FROM Student WHERE books_applied.admno=student.LETTERNO) AS snm,(SELECT disp_class FROM Student WHERE books_applied.admno=student.LETTERNO) AS cls,(SELECT disp_sec FROM Student WHERE books_applied.admno=student.LETTERNO) AS sec'," IDate BETWEEN '$fromdt' AND '$to_dt'");
			}else{
				$data['title']	='Defaulter Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied','*,(SELECT FIRST_NM FROM Student WHERE books_applied.admno=student.LETTERNO) AS snm,(SELECT disp_class FROM Student WHERE books_applied.admno=student.LETTERNO) AS cls,(SELECT disp_sec FROM Student WHERE books_applied.admno=student.LETTERNO) AS sec',"RDate>Due_date AND IDate BETWEEN '$fromdt' AND '$to_dt'");
			}
		} 		
			// echo "<pre>";
			// 	print_r($data);
			// 	echo "<pre>";
		$this->render_template('library/book_issue_rpt',$data);		
	}
	public function book_report_emp(){		
		$data['title']	='';
		if(isset($_POST['search']))
		{		
			$rpttyp				=$this->input->post('rpttyp');
			$fromdt				=date('Y-m-d',strtotime($this->input->post('fromdt')));
			$to_dt				=date('Y-m-d',strtotime($this->input->post('to_dt')));
			if($rpttyp==0){
				$data['title']	=' Issued Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied1','*,(SELECT EMP_FNAME FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMP,(SELECT EMPID FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMPID'," Issued='1' and IDate BETWEEN '$fromdt' AND '$to_dt'");
			}elseif($rpttyp==1){
				$data['title']	='All Issued Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied1','*,(SELECT EMP_FNAME FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMP,(SELECT EMPID FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMPID'," IDate BETWEEN '$fromdt' AND '$to_dt'");
			}else{
				$data['title']	='Defaulter Report From '.$fromdt.' To '.$to_dt;
				$data['isuu_rpt']   = $this->pawan->selectA('books_applied1','*,(SELECT EMP_FNAME FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMP,(SELECT EMPID FROM EMPLOYEE WHERE books_applied1.E_ID=EMPLOYEE.EMPID) AS EMPID',"RDate>Due_date AND IDate BETWEEN '$fromdt' AND '$to_dt'");
			}
		} 		
		$this->render_template('library/book_issue_rpt_emp',$data);		
	}

	
	
	public function BookReturnRpt(){
		$data['title']='Book Return Report';
		if(isset($_POST['search']))
		{
			$fromdt				=date('Y-m-d',strtotime($this->input->post('fromdt')));
			$to_dt				=date('Y-m-d',strtotime($this->input->post('to_dt')));
			$data['return_rpt']   	= $this->pawan->selectA('books_applied','*'," return=1 and RDate BETWEEN '$fromdt' AND '$to_dt'");				
		}	
        $this->render_template('library/book_return_rpt',$data);		
	}
	public function BookReturnRpt_emp(){
		$data['title']='Book Return Report';
		if(isset($_POST['search']))
		{
			$fromdt				=date('Y-m-d',strtotime($this->input->post('fromdt')));
			$to_dt				=date('Y-m-d',strtotime($this->input->post('to_dt')));
			$data['return_rpt']   	= $this->pawan->selectA('books_applied1','*'," return=1 and RDate BETWEEN '$fromdt' AND '$to_dt'");				
		}	
        $this->render_template('library/book_return_rpt_emp',$data);		
	}

	public function BookStockReg(){			
		$data['tockreg']   = $this->pawan->stock_reg();			
        $this->render_template('library/book_stock_rpt',$data);		
	}
		public function BookStockReg_bw(){			
		$data['tockreg']   = $this->pawan->stock_reg();	
	$data['tockreg']   = $this->pawan->selectA('bookmaster','*');
	$this->render_template('library/book_stock_rpt_bw',$data);		
	}
	public function BookStockReg_bw_lost(){			
		$data['tockreg']   = $this->pawan->stock_reg();	
	$data['tockreg']   = $this->pawan->selectA('bookmaster','*',"1='1' AND book_status !='--Sel'");
	$this->render_template('library/book_stock_rpt_bw_lost',$data);		
	}
	public function BookStockReg_sort(){
		$srt=$this->input->post('sort_by');
		//$data['tockreg']   = $this->pawan->stock_reg();	
		if($srt =="accno"){
			$srt="";
		}else{
			$srt="ORDER BY $srt ASC";
		}
	$data['tockreg']   = $this->alam->selectA("bookmaster","*","1='1' $srt");
	$this->load->view('library/book_stock_sort_view',$data);		
	}
	
	
	public function barcode(){			
		$data['tockreg']   = 'Barcode Print';
		$data['subjectname']   	= $this->pawan->selectA('library_call_master','*');
		if(isset($_POST['search']))
		{
			$subj_id			=$this->input->post('subj_id');
			$data['book_data']  = $this->pawan->selectA('bookmaster','BNAME,PurName,B_Code,accno',"SUB_ID='$subj_id'");
		}
		
			$filepath ="";
			$text = "123456";
			$size = "40";
			$orientation ="horizontal";
			$code_type = "code128";
			$print = true;
			$sizefactor ="1";
			
			for($i=1;$i<=100;$i++){
				
			$data['barcoder2']=$this->test->barcode( $filepath, $i, $size, $orientation, $code_type, $print, $sizefactor );
			
			
			//print_r($data['barcoder2']);
			}die;
        $this->render_template('library/barcode',$data);		
	}
 
}