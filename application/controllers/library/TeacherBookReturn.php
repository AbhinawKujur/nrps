<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherBookReturn extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');
	}
	
	public function index(){		
		$data['BookDetail']   	= $this->pawan->selectA('bookmaster','*');
		$data['issuedbok'] 		= $this->pawan->selectA('books_applied1','*,(select EMP_FNAME from employee where EMPID=books_applied1.E_ID)stu_nm',"Issued='1'");		
        $this->render_template('library/teacher_book_return',$data);		
	}
	public function Return_book(){		
		$data['BookDetail']   	= $this->pawan->selectA('bookmaster','*');		
		$this->render_template('library/teacher_book_return',$data);		
	}
	
	
//*****************Book Details***********************	
	public function bookDetails(){
		$bcode 		= $this->input->post('acce_no');
		$emp_deta   = $this->pawan->tech_return_detail($bcode);
		$EMPID		= (!empty($emp_deta[0]['EMPID']))?$emp_deta[0]['EMPID']:'';
		$FIRST_NM	= (!empty($emp_deta[0]['EMP_FNAME']))?$emp_deta[0]['EMP_FNAME']:'';
		$MIDDLE_NM	= (!empty($emp_deta[0]['EMP_MNAME']))?$emp_deta[0]['EMP_MNAME']:'';
		$EMP_LNAME	= (!empty($emp_deta[0]['EMP_LNAME']))?$emp_deta[0]['EMP_LNAME']:'';
		$FATHER_NM	= (!empty($emp_deta[0]['FATHERS_NAME']))?$emp_deta[0]['FATHERS_NAME']:'';	
		$BName	    = (!empty($emp_deta[0]['BName']))?$emp_deta[0]['BName']:'';
		$Due_date   = (!empty($emp_deta[0]['Due_date']))?$emp_deta[0]['Due_date']:'';		
		$BookID    	= (!empty($emp_deta[0]['BookID']))?$emp_deta[0]['BookID']:'';
		$appli_id   = (!empty($emp_deta[0]['id']))?$emp_deta[0]['id']:'';	
		$AppDate   	= (!empty($emp_deta[0]['AppDate']))?$emp_deta[0]['AppDate']:'';			
		$stuname	= $FIRST_NM.' '.$MIDDLE_NM.' '.$EMP_LNAME;	
		$date1		=date_create($Due_date);
		$date2		=date_create(date('d-M-Y'));
		$difdate	=0;
		if($date1<$date2){
		$diff		=date_diff($date1,$date2);
		$difdate	= $diff->format("%a");
		}
		$fine    	= $this->pawan->selectA('fine','*');
		$fineamt	=$fine[0]['TAmount']*$difdate;
		
		/*if($stu_image==""){*/
			$imgs		=base_url('assets/libraryimg/img.jpg');
		/*}else{
			$imgs		=base_url($stu_image);
		}*/
		
		$div="";
		$div .="<div class='form-group' >
					<label style='font-size:10px;'>&nbsp;&nbsp;&nbsp;Employee Details With Photo</label>
				</div>
				<div class='col-sm-3' style='text-align:center'>
				  <div class='form-group'>
					<img src='".$imgs."' style='height: 120px;width:115px;border:1px solid'>
				  </div>
				</div>
				<div class='col-sm-9'>
					<div class='row'>
						<div class='col-sm-4' >
							<div class='form-group' style='font-size: 12px;font-weight: bold;'>
							Employee ID.
							</div>
						</div>
						<div class='col-sm-5'>
						  <div class='form-group' style='font-size: 12px;'>
							".$EMPID."
						  </div>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-4'>
							<div class='form-group' style='font-size: 12px;font-weight: bold;'>
							Employee Name
							</div>
						</div>
						<div class='col-sm-8'>
							<div class='form-group' style='font-size: 12px;'>
							".$stuname."
							</div>
						</div>
					</div>				 
				  <div class='row'>
					  <div class='col-sm-4'>
						  <div class='form-group' style='font-size: 12px;font-weight: bold;'>
							Book Issued
						  </div>
					  </div>
					  <div class='col-sm-8'>
						 <div class='form-group' style='font-size: 12px;'>
							".$BName."
						 </div>
					  </div>
				  </div>
				</div>";
		//print_r($div);die;
		
		$Emp_data   = $this->pawan->selectA('employee','*,(select DESIG from desig where Sno=employee.DESIG)DESIG_NAME',"EMPID='$EMPID'");
		$array = array($stuname,$Emp_data[0]['DESIG_NAME'],$BName,$Due_date,$BookID,$difdate,$fineamt,$EMPID,$appli_id,$div,$AppDate);	
		echo json_encode($array); 
	}
//*****************Book Reissued***********************	
	public function bookreisu(){
		
		$ids 			= 	$this->input->post('ids');
		$fine 			= 	$this->pawan->selectA('fine','*');		
		$getdat 		= 	date('Y-m-d',strtotime($this->input->post('duedate')));
		$appdat			=	$this->pawan->selectA('books_applied1','*',"id='$ids'");
		$countno		= 	$this->pawan->numrows('books_applied1','*',"AppNo!=''");
		$appcoun		=	$countno+1;
		//$seque			=	$this->custom_lib->getsequence($appcoun);
		$appno 			=	'E-'.$appcoun.rand(10,100);			

		$finday  		= 	$fine[0]['FineDays'];
		$appdatval		=	$appdat[0]['AppDate'];
		$E_ID			=	$appdat[0]['E_ID'];
		$sub_id			=	$appdat[0]['SubId'];
		$isu_date		=	$appdat[0]['IDate'];
		$Due_date		=	$appdat[0]['Due_date'];
		$book_id		=	$appdat[0]['BookID'];
		$book_name		=	$appdat[0]['BName'];
		$author			=	$appdat[0]['author'];
		$publish		=	$appdat[0]['publisher'];
		
		
		$due_dat		= 	date('d-M-Y', strtotime($getdat. ' + '. --$finday .'Days'));
		//$holyd 			= 	$this->pawan->selectA('holiday_master','library_holiday_date','');
		$daterang		=	$this->custom_lib->getDatesFromRange($getdat,$due_dat);
		
		$start 			= 	new DateTime($getdat);
		$end 			= 	new DateTime($due_dat);
		$days 			= 	$start->diff($end, true)->days;
		$sundays 		= 	intval($days / 7) + ($start->format('N') + $days % 7 >= 7);
		$finday1		=	$sundays+$finday; 
		$due_dat2		= 	date('d-M-Y', strtotime($getdat. ' + '. $finday1 .'Days'));

		$start1 		= 	new DateTime($getdat);
		$end1 			= 	new DateTime($due_dat2);
		$days1 			= 	$start1->diff($end1, true)->days;
		$sundays1 		= 	intval($days1 / 7) + ($start1->format('N') + $days1 % 7 >= 7);
		$finday2		=	$sundays1+$finday;
		$due_dat3		= 	date('Y-m-d', strtotime($getdat. ' + '. $finday2 .'Days'));
		$appdatval1		= 	$appdatval+1;

				$date1=date_create("$Due_date");
        $date1= date_format($date1,"d-M-Y");
		$date2		=date('d-M-Y');
	
		$diff = strtotime($date2) - strtotime($date1); 
       
		$dateDiff = abs(round($diff / 86400));
		
		
		if($fine[0]['FineDays'] < $dateDiff){
			$dateDiff=  $dateDiff - $fine[0]['FineDays'];
		}else{
			$dateDiff=0;
		}
		
		$fineamt	=$fine[0]['Amount']*$dateDiff;

		$upd_reisu		=	array(		
		'AppNo'			=>	$appno,				
		'Issued'		=>  '0',
		'RDate'			=>	$getdat,		
		'return'		=>	'1',
		'Fine'			=>	$fineamt
		);			
		$reisu_insrt 	= array(
			'E_ID' 		=> $E_ID,
			'SubId' 	=> $sub_id,
			'AppDate'	=>	$appdatval1,
			'Issued' 	=> '1',
			'IDate'		=> $getdat,
			'BookID' 	=> $book_id,
			'BName' 	=> $book_name,
			'author' 	=> $author,
			'publisher'	=> $publish,
			'Due_date'	=> $due_dat3,
			
		 );
		 
		$upd=$this->pawan->update('books_applied1',$upd_reisu,"id='$ids'");
		$insrt=$this->pawan->insert('books_applied1',$reisu_insrt);
		 	
	}
	
//*****************Book Return***********************
public function print_receipt_teacher($emp,$accno_no,$applied_id){		
	$accno_no=str_replace("-","/",$accno_no);
		$data['Applied_data']  = $this->pawan->selectA('books_applied1','*',"id='$applied_id'");		
		$data['BookDetail']  = $this->pawan->selectA('bookmaster','*',"B_Code='$accno_no'");		
		$data['StuDetail']  = $this->pawan->selectA('employee','*,(select DESIG from desig where Sno=employee.DESIG)DESIG_NAME',"EMPID='$emp'");		
		$data['school']  = $this->pawan->selectA('school_setting','*');	
	
		$this->load->view('library/print_receipt_teacher',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("student_proflile.pdf", array("Attachment"=>0));		
	}

	public function bookreturn(){
		
		$ids 			= 	$this->input->post('ids');
		$bcode 			= 	$this->input->post('accno');
		$countno		= 	$this->pawan->numrows('books_applied1','*',"AppNo!=''");		
		$getdat 		= 	date('Y-m-d',strtotime($this->input->post('duedate')));
		$rdate 			= 	date('Y-m-d',strtotime($this->input->post('rdate')));
		$fineamt		= 	$this->input->post('fineamt');
		$appcoun		=	$countno+1;
		$appdat 		=	'E-'.$seque.rand(10,100);		
		$update			=	array(
		'AppNo'			=>	$appdat,		
		'Issued'		=>  '0',
		'RDate'			=>	$rdate,
		'Fine'			=>	$fineamt,
		'return'		=>	'1',		
		);
		$upd=$this->pawan->update('books_applied1',$update,"id='$ids'");
		$upd_b_mas		=	array(
			'FLAG'		=>	'0',
		);
		$upd_b			=	$this->pawan->update('bookmaster',$upd_b_mas,"B_Code='$bcode'");

	}	 
}