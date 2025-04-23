<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentBookReturn extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');
	}
	
	public function index(){		
		$data['BookDetail']   	= $this->pawan->selectA('bookmaster','*');
		//$data['issuedbok'] 		= $this->pawan->selectA('books_applied',"*,(select FIRST_NM from student where etterno=books_applied.Admno)stu_nm","Issued='1'");	18/05/2023
		
		$data['issuedbok'] 		= $this->pawan->selectA('books_applied', "*,
			(select concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)as stu_name1 from student where studentid=books_applied.Admno OR 						adm_no=books_applied.Admno LIMIT 1)stu_nm1,
			(select concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)as stu_name2 from student_1718 where studentid=books_applied.Admno OR 				adm_no=books_applied.Admno LIMIT 1)stu_nm2,
			(select concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)as stu_name3 from student_1819 where studentid=books_applied.Admno OR 				adm_no=books_applied.Admno LIMIT 1)stu_nm3,
			(select concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)as stu_name5 from student2324 where studentid=books_applied.Admno OR 				adm_no=books_applied.Admno LIMIT 1)stu_nm5,
			(select concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)as stu_name4 from student_1920 where studentid=books_applied.Admno OR 				adm_no=books_applied.Admno LIMIT 1)stu_nm4", "Issued='1'");

				//$data['rect_no'] 		= $this->pawan->selectA('student','first_nm',"adm_No='$adm'");
		//$upd=$this->pawan->updateank("adm_No='$adm'");
		
        $this->render_template('library/student_book_return',$data);		
	}

	public function Return_book(){		
		$data['BookDetail']   	= $this->pawan->selectA('bookmaster','*');		
		$this->render_template('library/student_book_return',$data);		
	}
	
	public function print_receipt($adm,$acce_no,$applied_id){	
		
		$adm = str_replace("-", "/", "$adm");
		$acce_no = str_replace('-', '/', $acce_no);
		$data['Applied_data']  = $this->pawan->selectA('books_applied','*',"id='$applied_id'");		
		$data['BookDetail']  = $this->pawan->selectA('bookmaster','*',"B_Code='$acce_no'");		
		//$data['StuDetail']  = $this->pawan->selectA('student','*',"ADM_NO='$adm'");
		$issue_dt = $this->pawan->selectA('books_applied', 'IDate', "BookID='$acce_no'");
		$isue_date = $issue_dt[0]['IDate'];
		// echo $isue_date;die;

		if ($isue_date >= '2017-04-01' && $isue_date <= '2018-03-31') {
			$data['StuDetail']  = $this->pawan->selectA('student_1718', '*', "ADM_NO='$adm' OR STUDENTID='$adm'");
		} elseif ($isue_date >= '2018-04-01' && $isue_date <= '2019-03-31') {
			$data['StuDetail']  = $this->pawan->selectA('student_1819', '*', "ADM_NO='$adm' OR STUDENTID='$adm'");
		} elseif ($isue_date >= '2019-04-01' && $isue_date <= '2020-03-31') {
			$data['StuDetail']  = $this->pawan->selectA('student_1920', '*', "ADM_NO='$adm' OR STUDENTID='$adm'");
			// echo $this->db->last_query();die;
			// echo $this->db->last_query();die;
		} elseif ($isue_date >= '2020-04-01' && $isue_date <= '2021-03-31') {
			$data['StuDetail']  = $this->pawan->selectA('student_1920', '*', "ADM_NO='$adm' OR STUDENTID='$adm'");
			// echo $this->db->last_query();die;
		} elseif ($isue_date >= '2021-04-01' && $isue_date <= '2022-03-31') {
			$data['StuDetail']  = $this->pawan->selectA('student_1920', '*', "ADM_NO='$adm' OR STUDENTID='$adm'");
		} elseif ($isue_date >= '2023-04-01' && $isue_date <= '2024-03-31') {
			$data['StuDetail']  = $this->pawan->selectA('student2324', '*', "ADM_NO='$adm' OR STUDENTID='$adm'");
		}else {
			$data['StuDetail']  = $this->pawan->selectA('student', '*', "ADM_NO='$adm'");;
			// echo $this->db->last_query();die;

		}
		// ******************
		
		$data['school']  = $this->pawan->selectA('school_setting','*');		
		$this->load->view('library/print_receipt',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("student_proflile.pdf", array("Attachment"=>0));		
	}

//*****************Book Details***********************	
	public function bookDetails_old(){
		
		$bcode 		= $this->input->post('acce_no');
		$issue_dt = $this->pawan->selectA('books_applied','IDate',"BookID='$bcode'");	
		$isue_date=$issue_dt[0]['IDate']; 
	
		if($isue_date >= '2017-04-01' && $isue_date <= '2018-03-31')
		{
			$StuData    = $this->pawan->return_details1718($bcode);
		}
		elseif($isue_date >= '2018-04-01' && $isue_date <= '2019-03-31')
		{
			$StuData    = $this->pawan->return_details1819($bcode);
		}
		elseif($isue_date >= '2019-04-01' && $isue_date <= '2020-03-31')
		{
			$StuData    = $this->pawan->return_details1920($bcode);
		}
		elseif($isue_date >= '2020-04-01' && $isue_date <= '2021-03-31')
		{
			$StuData    = $this->pawan->return_details1920($bcode);
		}
		elseif($isue_date >= '2021-04-01' && $isue_date <= '2022-03-31')
		{
			$StuData    = $this->pawan->return_details1920($bcode);
		}
		else
		{
			$StuData    = $this->pawan->return_detail($bcode);
		
		}
		
		$admno		= (!empty($StuData[0]['Admno']))?$StuData[0]['Admno']:'';
		$FIRST_NM	= (!empty($StuData[0]['FIRST_NM']))?$StuData[0]['FIRST_NM']:'';
		$MIDDLE_NM	= (!empty($StuData[0]['MIDDLE_NM']))?$StuData[0]['MIDDLE_NM']:'';
		$FATHER_NM	= (!empty($StuData[0]['FATHER_NM']))?$StuData[0]['FATHER_NM']:'';
		$CLASS	    = (!empty($StuData[0]['class']))?$StuData[0]['class']:0;
		$section    = (!empty($StuData[0]['DISP_SEC']))?$StuData[0]['DISP_SEC']:'';
		$BName	    = (!empty($StuData[0]['BName']))?$StuData[0]['BName']:'';
		$Due_date   = (!empty($StuData[0]['Due_date']))?$StuData[0]['Due_date']:'';		
		$BookID    	= (!empty($StuData[0]['BookID']))?$StuData[0]['BookID']:'';
		$appli_id   = (!empty($StuData[0]['id']))?$StuData[0]['id']:'';	
		$AppDate   	= (!empty($StuData[0]['AppDate']))?$StuData[0]['AppDate']:'';
		$stu_image 	= (!empty($StuData[0]['student_image']))?$StuData[0]['student_image']:'';	
		$stuname	= $FIRST_NM.' '.$MIDDLE_NM;
		$classec	= $CLASS.'/'.$section;
		$date1=date_create("$Due_date");
        $date1= date_format($date1,"d-M-Y");
		$date2		=date('d-M-Y');
	
		$diff = strtotime($date2) - strtotime($date1); 
       
		$dateDiff = abs(round($diff / 86400));
		
		$fine    	= $this->pawan->selectA('fine','*');
		if($fine[0]['FineDays'] < $dateDiff){
			$dateDiff=  $dateDiff - $fine[0]['FineDays'];
		}else{
			$dateDiff=0;
		}
		
		
		$fineamt	=$fine[0]['Amount']*$dateDiff;
	
		
		if($stu_image==""){
			$imgs		=base_url('assets/libraryimg/img.jpg');
		}else{
			$imgs		=base_url($stu_image);
		}
		
		$div="";
		$div .="<div class='form-group' >
					<label style='font-size:10px;'>&nbsp;&nbsp;&nbsp;Student Details With Photo</label>
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
							Admission No.
							</div>
						</div>
						<div class='col-sm-5'>
						  <div class='form-group' style='font-size: 12px;'>
							".$admno."
						  </div>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-4'>
							<div class='form-group' style='font-size: 12px;font-weight: bold;'>
							Student Name
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
							Class/Sec
						  </div>
					  </div>
					  <div class='col-sm-8'>
						  <div class='form-group' style='font-size: 12px;'>
							".$classec."
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
		$array = array($stuname,$FATHER_NM,$CLASS,$BName,$date1,$BookID,$dateDiff,$fineamt,$admno,$appli_id,$div,$AppDate);	
		echo json_encode($array);
	}

	public function bookDetails(){
		
		$bcode 		= $this->input->post('acce_no');
		$issue_dt = $this->pawan->selectA('books_applied','IDate',"BookID='$bcode'");	
		//echo $this->db->last_query();die;
		$isue_date=$issue_dt[0]['IDate']; 
	
		if($isue_date >= '2017-04-01' && $isue_date <= '2018-03-31')
		{
			$StuData    = $this->pawan->return_details1718($bcode);
		}
		elseif($isue_date >= '2018-04-01' && $isue_date <= '2019-03-31')
		{
			$StuData    = $this->pawan->return_details1819($bcode);
		}
		elseif($isue_date >= '2019-04-01' && $isue_date <= '2020-03-31')
		{
			$StuData    = $this->pawan->return_details1920($bcode);
		}
		elseif($isue_date >= '2020-04-01' && $isue_date <= '2021-03-31')
		{
			$StuData    = $this->pawan->return_details1920($bcode);
		}
		elseif($isue_date >= '2021-04-01' && $isue_date <= '2022-03-31')
		{
			$StuData    = $this->pawan->return_details1920($bcode);
		}
		else
		{
			$StuData    = $this->pawan->return_detail($bcode);
			// echo $this->db->last_query();die;
		
		}

		$admno		= (!empty($StuData[0]['Admno']))?$StuData[0]['Admno']:'';
		$FIRST_NM	= (!empty($StuData[0]['FIRST_NM']))?$StuData[0]['FIRST_NM']:'';
		$MIDDLE_NM	= (!empty($StuData[0]['MIDDLE_NM']))?$StuData[0]['MIDDLE_NM']:'';
		$FATHER_NM	= (!empty($StuData[0]['FATHER_NM']))?$StuData[0]['FATHER_NM']:'';
		$CLASS	    = (!empty($StuData[0]['class']))?$StuData[0]['class']:0;
		$section    = (!empty($StuData[0]['DISP_SEC']))?$StuData[0]['DISP_SEC']:'';
		$BName	    = (!empty($StuData[0]['BName']))?$StuData[0]['BName']:'';
		$Due_date   = (!empty($StuData[0]['Due_date']))?$StuData[0]['Due_date']:'';		
		$BookID    	= (!empty($StuData[0]['BookID']))?$StuData[0]['BookID']:'';
		$appli_id   = (!empty($StuData[0]['id']))?$StuData[0]['id']:'';	
		$AppDate   	= (!empty($StuData[0]['AppDate']))?$StuData[0]['AppDate']:'';
		$stu_image 	= (!empty($StuData[0]['student_image']))?$StuData[0]['student_image']:'';	
		$stuname	= $FIRST_NM.' '.$MIDDLE_NM;
		$classec	= $CLASS.'/'.$section;
		$date1=date_create("$Due_date");
        $date1= date_format($date1,"d-M-Y");
		$date2		=date('d-M-Y');
	
		$diff = strtotime($date2) - strtotime($date1); 
       
		$dateDiff = abs(round($diff / 86400));
		
		$fine    	= $this->pawan->selectA('fine','*');
		if($fine[0]['FineDays'] < $dateDiff){
			$dateDiff=  $dateDiff - $fine[0]['FineDays'];
		}else{
			$dateDiff=0;
		}
		
		
		$fineamt	=$fine[0]['Amount']*$dateDiff;
	
		
		if($stu_image==""){
			$imgs		=base_url('assets/libraryimg/img.jpg');
		}else{
			$imgs		=base_url($stu_image);
		}
		
		$div="";

		$div .="<div class='form-group' >
					<label style='font-size:10px;'>&nbsp;&nbsp;&nbsp;Student Details With Photo</label>
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
							Admission No.
							</div>
						</div>
						<div class='col-sm-5'>
						  <div class='form-group' style='font-size: 12px;'>
							".$admno."
						  </div>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-4'>
							<div class='form-group' style='font-size: 12px;font-weight: bold;'>
							Student Name
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
							Class/Sec
						  </div>
					  </div>
					  <div class='col-sm-8'>
						  <div class='form-group' style='font-size: 12px;'>
							".$classec."
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
		$array = array($stuname,$FATHER_NM,$CLASS,$BName,$date1,$BookID,$dateDiff,$fineamt,$admno,$appli_id,$div,$AppDate);	
		echo json_encode($array);
	}
	
//*****************Book Reissued***********************	
	public function bookreisu(){
		
		$ids 			= 	$this->input->post('ids');
		$fine 			= 	$this->pawan->selectA('fine','*');		
		$getdat 		= 	date('Y-m-d',strtotime($this->input->post('duedate')));
		$appdat			=	$this->pawan->selectA('books_applied','*',"id='$ids'");
		$countno		= 	$this->pawan->numrows('books_applied','*',"AppNo!=''");
		$appcoun		=	$countno+1;
		//$seque			=	$this->custom_lib->getsequence($appcoun);
		$appno 			=	'L'.$appcoun.rand(10,100);			
		$finday  		= 	$fine[0]['FineDays'];
		$appdatval		=	$appdat[0]['AppDate'];
		$adm_no			=	$appdat[0]['Admno'];
		$sub_id			=	$appdat[0]['SubId'];
		$isu_date		=	$appdat[0]['IDate'];
		$Due_date		=	$appdat[0]['Due_date'];
		$book_id		=	$appdat[0]['BookID'];
		$book_name		=	$appdat[0]['BName'];
		$author			=	$appdat[0]['author'];
		$publish		=	$appdat[0]['publisher'];
		$clas 			=	$appdat[0]['class'];
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
			'Admno' 	=> $adm_no,
			'SubId' 	=> $sub_id,
			'AppDate'	=>	$appdatval1,
			'Issued' 	=> '1',
			'IDate'		=> $getdat,
			'BookID' 	=> $book_id,
			'BName' 	=> $book_name,
			'author' 	=> $author,
			'publisher'	=> $publish,
			'Due_date'	=> $due_dat3,
			'class'		=> $clas,
		 );
		$upd=$this->pawan->update('books_applied',$upd_reisu,"id='$ids'");
		$insrt=$this->pawan->insert('books_applied',$reisu_insrt);
		 	
	}
	
//*****************Book Return***********************
	public function bookreturn(){
		
		$ids 			= 	$this->input->post('ids');
		$bcode 			= 	$this->input->post('accno');
		$countno		= 	$this->pawan->numrows('books_applied','*',"AppNo!=''");	
		
		$getdat 		= 	date('Y-m-d',strtotime($this->input->post('duedate')));
		$rdate 			= 	date('Y-m-d',strtotime($this->input->post('rdate')));
		$fineamt		= 	$this->input->post('fineamt');
		$appcoun		=	$countno+1;
		//$seque			=	$this->custom_lib->getsequence($appcoun);
		$appdat 		=	'L-'.$appcoun.rand(10,100);		
		$update			=	array(
		'AppNo'			=>	$appdat,		
		'Issued'		=>  '0',
		'RDate'			=>	$rdate,
		'Fine'			=>	$fineamt,
		'return'		=>	'1',		
		);
		
		$upd=$this->pawan->update('books_applied',$update,"id='$ids'");
		$upd_b_mas		=	array(
			'FLAG'		=>	'0'
		);
		$upd_b			=	$this->pawan->update('BookMaster',$upd_b_mas,"B_Code='$bcode'");

	}	 
}