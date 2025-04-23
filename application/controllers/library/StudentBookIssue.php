
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentBookIssue extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');
		$this->load->model('Alam','alam');
	}
	
	public function index(){	
		$data['StudentAdmno']   = $this->pawan->selectA('student','STUDENTID,ADM_NO,FIRST_NM,LETTERNO,DISP_CLASS,DISP_SEC',"Student_Status='ACTIVE' order by ADM_NO ASC");
		$data['BookDetail']   	= $this->pawan->selectA('bookmaster','*');	
        $this->render_template('library/student_book_issue',$data);		
	}
	public function IsuueBook(){
		$data['StudentAdmno']   = $this->pawan->selectA('student','STUDENTID,ADM_NO,FIRST_NM',"Student_Status='ACTIVE' order by ADM_NO ASC");
		$data['BookDetail']   	= $this->pawan->selectA('bookmaster','*');		
		$this->render_template('library/student_book_issue',$data);
	}
	
	public function issuebook(){
		$admission_no 	= $this->input->post('admission_no');
		$first_nmA 		= $this->pawan->selectA('student','FIRST_NM',"ADM_NO='$admission_no'");
		$stu_class	 	= $this->input->post('stu_class');		
		$issue_dt	 	= date('Y-m-d',strtotime($this->input->post('issue_dt')));
		$due_date	 	= date('Y-m-d',strtotime($this->input->post('due_date')));				
		$B_Code			= $this->input->post('B_Code');
		$book_detail	= $this->pawan->selectA('bookmaster','*',"B_Code='$B_Code'");
		$sub_id			= $book_detail[0]['SUB_ID'];
		$PUBLISHER		= $book_detail[0]['PUBLISHER'];
		$book_name		= $book_detail[0]['BNAME'];
		$author_name	= $book_detail[0]['AUTHOR'];
		$studnet_id = $this->input->post('student_id');
		
		
		//print_r($sub_id);die;
		$savedata=array(
			
		     
			'Admno'        	=> $admission_no,
			'SubId'        	=> $sub_id,
			'Issued'       	=> '1',
			'BookID'		=> $B_Code,
			'class'       	=> $stu_class,
			'IDate'         => $issue_dt,			
			'BName'			=> $book_name,
			'author'		=> $author_name,			
			'publisher'		=> $PUBLISHER,			
			'Due_date' 		=> $due_date,
			'rect_no'		=> ''
		);		
		$ins		=$this->pawan->insert('books_applied',$savedata);
		
			$upddat	=array(
			'FLAG'	=> '1',
		);
		$upd=$this->pawan->update('bookmaster',$upddat,"B_code='$B_Code'");
	}
		
		public function issuebook_adv(){
			
		$adv_id = $this->input->post('adv_id');		
			
		
		$book_detail = $this->pawan->selectA('books_applied_adv','*',"id='$adv_id'");
		
	 	$admission_no 	= $book_detail[0]['Admno'];		
	 	$accno 	= $book_detail[0]['BookID'];		
		$stu_class	 	= $book_detail[0]['class'];			
		$B_Code			= $book_detail[0]['BookID'];
		$book_detail_status	= $this->pawan->selectA('bookmaster','FLAG',"B_Code='$B_Code'");
		$issue_dt		= $book_detail[0]['BookingDate'];
		$due_date		= $book_detail[0]['Due_date'];
		$sub_id			= $book_detail[0]['SubId'];
		$PUBLISHER		= $book_detail[0]['publisher'];
		$book_name		= $book_detail[0]['BName'];
		$author_name	= $book_detail[0]['author'];
		
		$book_detail_status=$book_detail_status[0]['FLAG'];
		if($book_detail_status == 0){
			
			$savedata=array(
			'Admno'        	=> $admission_no,
			'SubId'        	=> $sub_id,
			'Issued'       	=> '1',
			'BookID'		=> $B_Code,
			'class'       	=> $stu_class,
			'IDate'         => $issue_dt,			
			'BName'			=> $book_name,
			'author'		=> $author_name,			
			'publisher'		=> $PUBLISHER,			
			'Due_date' 		=> $due_date,			
		);		
		$ins=$this->pawan->insert('books_applied',$savedata);
		
			$upddat	=array(
			'FLAG'	=> '1',
		);
				$upddat_adv	=array(
			'Issued'	=> '1',
		);
		$upd=$this->pawan->update('bookmaster',$upddat,"B_code='$B_Code'"); 
		$upd=$this->pawan->update('books_applied_adv',$upddat_adv,"id='$adv_id'"); 
		echo 1;
	}else{
		echo 0;
	}
	}
//****************Student Details***********************	
	
	public function student_details(){
		$studnet_id = $this->input->post('student_id');
		$advbook 	= $this->pawan->selectA('books_applied_adv','*',"Admno='$studnet_id' AND Issued='0'");	
		$stuData 	= $this->pawan->isuue_detail($studnet_id);
		$fine_data 	= $this->pawan->selectA('fine','*');		
		$c=0;
		if(sizeof($stuData)!=0){
		$ret = '';		
		$ret .="<table class='table' style='font-size: 12px;' class='example'><thead><tr><th style='background:#337ab7; color:#fff !important;border:1px solid;'></th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Book Name</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Acc.No</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Issued Date</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Due Date</th></tr></thead><tbody>";
		 foreach($stuData as $key => $val){
		$ret .="<tr><td style='border:1px solid #dddddd;'>".++$c."</td><td style='border:1px solid #dddddd;'>".$val['BName']."</td><td style='border:1px solid #dddddd;'>".$val['accno']."</td><td style='border:1px solid #dddddd;'>".date('d-M-y',strtotime($val['IDate']))."</td><td style='border:1px solid #dddddd;'>".date('d-M-y',strtotime($val['Due_date']))."</td></tr><tbody>";
		}
		$ret .= '</table>';
		$cont=$c;
		}else
		{
			$ret="<div style='text-align: center;margin-top: 50px;'>No Book Issued</div>";
			$cont=$c;
		}
		$adv = '';
		if(sizeof($advbook)!=0){
					
			$adv .="<table class='table' style='font-size: 12px;' class='example'><thead><tr><td colspan='4' align='center'>Advaced Booking List</td></tr><tr><th style='background:#337ab7; color:#fff !important;border:1px solid;'></th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Book Name</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Acc.No</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Apply Date</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Booking Date</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'> Operation</th></tr></thead><tbody>";
			 foreach($advbook as $key => $val){
			$adv .="<tr><td style='border:1px solid #dddddd;'>".++$c."</td><td style='border:1px solid #dddddd;'>".$val['BName']."</td><td style='border:1px solid #dddddd;'>".$val['BookID']."</td><td style='border:1px solid #dddddd;'>".$val['IDate']."</td><td style='border:1px solid #dddddd;'>".$val['BookingDate']."</td><td style='border:1px solid #dddddd;'> <button type='button' onclick='isuuebook_adv(".$val['id'].")' class='btn btn-success btn-xs'>Issue</button></td></tr><tbody>";
			}
			$adv .= '</table>';
		}
		$StuDatas   = $this->pawan->student_data($studnet_id);
		$adm_nooo	=$studnet_id;
		$first_name = $StuDatas[0]['FIRST_NM'];
		$mid_name 	= $StuDatas[0]['MIDDLE_NM'];
		$stuClass   = $StuDatas[0]['DISP_CLASS'];
		$stusec     = $StuDatas[0]['DISP_SEC'];
		$sturoll    = $StuDatas[0]['ROLL_NO'];
		$maxbooks   = $fine_data[0]['maxbooks'];
		$full_name  = $first_name .' '. $mid_name;
		
		$array = array($ret,$adm_nooo,$full_name,$stuClass,$stusec,$sturoll,$cont,$maxbooks,$adv);	
		echo json_encode($array);
	}

//*****************Book Details***********************	
	public function bookDetails(){
		$acce_no 	= $this->input->post('acce_no');
		
		$StuData    = $this->pawan->book_data($acce_no);
		
		$numrow		= $this->pawan->numrows('bookmaster','*',"accno='$acce_no'");
		$book_name  = $StuData[0]['BNAME'];
		$author_name= $StuData[0]['AUTHOR'];
		$publisnm	= $StuData[0]['PUBLISHER'];
		$edition    = $StuData[0]['EDITION'];
		$racname    = $StuData[0]['racname'];
		$Rackno	    = $StuData[0]['Rackno'];
		$subname    = $StuData[0]['subject_name'];
		$book_no    = $StuData[0]['book_no'];
		$B_Code    	= $StuData[0]['B_Code'];
		$ID_NO    	= $StuData[0]['ID_NO'];
		//$remain 	= $this->pawan->selectA('books_applied','count(id) as isu_no',"BName='$book_name' and Issued='1'");
		$remain 	= $this->pawan->selectA('books_applied', 'count(id) as isu_no', "BookID='$acce_no' and Issued='1'");
		$isu_no		=$remain[0]['isu_no'];
		$nbook 		= $this->pawan->selectA('bookmaster','count(id) as nbook',"ID_NO='$ID_NO'");
		$totbok		=$nbook[0]['nbook'];
		$isuid 		= $this->pawan->selectA('bookmaster','count(id) as isu_no',"B_Code='$B_Code' and FLAG='1'");
		$bokissu	=$isuid[0]['isu_no'];
		$multi 		= $this->pawan->selectA('bookmaster','*',"accno='$acce_no' and FLAG='0'");
	    $rbooklist 	= $this->pawan->selectA('bookmaster','*',"ID_NO='$ID_NO' AND book_status !='L' AND book_status !='D' AND book_status !='W'");		
	
		$t=0;				
		$res = '';		
		$res .="<table class='table'style='font-size: 12px;cursor:pointer' id='example'><thead><tr><th style='background:#337ab7;width: 38px; color:#fff !important;border:1px solid;'></th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Book Name</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Acc.No</th></tr></thead><tbody>";
	
		foreach($rbooklist as $key => $val){
			$cc=$val['accno'];
			$fnc="onclick='acce_no($cc)'";
			if($val['FLAG']=='' || $val['FLAG']==0 || $val['FLAG']==null){
					$clr="";
					$vl="<strong>In Stock</strong>";
				}else{
					$clr="background-color:#ff9999;opacity:0.6";
					$vl="<strong>Out of Stock</strong>";
				}
			if($acce_no ==$val['accno']){
				if($val['FLAG']=='' || $val['FLAG']==0 || $val['FLAG']==null){
					$clr="background-color:#95eacd";
					$vl="<strong>Selected</strong>";
				}else{
							$clr="background-color:#ff9999;opacity:0.6";
							$vl="<strong>Out of Stock</strong>";
				}
			}
			
		$res .="<tr style='$clr' $fnc><td style='border:1px solid #dddddd;'>".++$t."</td><td style='border:1px solid #dddddd;'>".$val['BNAME']."<span style='float:right'>$vl</span></td><td style='border:1px solid #dddddd;width: 74px;'>".$val['accno']."</td></tr><tbody>";
		}
		$res .= '</table>';
		$rest = '';
		
		if($numrow>1){
			if(!empty($multi)){			
				$rest .="<table class='table' id='example1'><thead><tr><th style='background:#337ab7; color:#fff !important;border:1px solid;'></th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Book Name</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Acc No</th></tr></thead>";
				foreach($multi as $key => $val){
				$rest .="<tr><td style='border:1px solid #dddddd;'><button type='button' class='btn btn-success btn-xs' onclick='isue_ref(".'"'.$val['B_Code'].'"'.")'>Issue</button></td><td style='border:1px solid #dddddd;'>".$val['BNAME']."</td><input type='hidden' name='bcode' id='bcode' value='".$val['B_Code']."'><td style='border:1px solid #dddddd;'>".$val['accno']."</td></tr><tbody>";
				}
				$rest .= '</table>';
			}else{
				$rest="<div style='text-align:center;margin-top: 50px; color:red'>No Book Available</div>";
			}			
		}
		
		$array = array($book_name,$author_name,$publisnm,$edition,$racname,$Rackno,$subname,$book_no,$isu_no,$totbok,$bokissu,$res,$B_Code,$numrow,$rest);		
		echo json_encode($array);
	}

//***************Remaining Book List*******************	
	public function remainingbook(){
		$rbooklist 	= $this->pawan->selectA('bookmaster','*',"BNAME='$book_name' and FLAG='0'");		
		$t=0;				
		$res = '';		
		$res .="<table class='table'style='font-size: 12px;' id='example'><thead><tr><th style='background:#337ab7;width: 38px; color:#fff !important;border:1px solid;'></th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Book Name</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Acc.No</th></tr></thead><tbody>";
		foreach($rbooklist as $key => $val){
		$res .="<tr><td style='border:1px solid #dddddd;'>".++$t."</td><td style='border:1px solid #dddddd;'>".$val['BNAME']."</td><td style='border:1px solid #dddddd;width: 74px;'>".$val['accno']."</td></tr><tbody>";
		}
		$res .= '</table>';
		$rest = '';
	}

	
	public function get_dates(){
		$fine 			= $this->pawan->selectA('fine','*');		
		$getdat 		= $this->input->post('dateval');
		
		$finday  		= $fine[0]['FineDays'];
		$due_dat		= date('d-M-Y', strtotime($getdat. ' + '. --$finday .'Days'));
		$holyd 			= $this->pawan->selectA('holiday_master','library_holiday_date','');
		$daterang		=$this->custom_lib->getDatesFromRange($getdat,$due_dat);
		
		$start 			= new DateTime($getdat);
		$end 			= new DateTime($due_dat);
		$days 			= $start->diff($end, true)->days;
		$sundays 		= intval($days / 7) + ($start->format('N') + $days % 7 >= 7);
		$finday1		=$sundays+$finday; 
		$due_dat2		= date('d-M-Y', strtotime($getdat. ' + '. $finday1 .'Days'));

		$start1 		= new DateTime($getdat);
		$end1 			= new DateTime($due_dat2);
		$days1 			= $start1->diff($end1, true)->days;
		$sundays1 		= intval($days1 / 7) + ($start1->format('N') + $days1 % 7 >= 7);
		$finday2		=$sundays1+$finday;
		$due_dat3		= date('d-M-Y', strtotime($getdat. ' + '. $finday2 .'Days')); 
		
		$array 			= array($due_dat3,$finday);		
		echo json_encode($array);
		
	}
	
	public function chkHoliday(){
		$issue_dt = date('Y-m-d', strtotime($this->input->post('issue_dt'))); 
		$due_date = date('Y-m-d', strtotime($this->input->post('due_date')));
		
		$this->pawan->selectA('holiday_master','*',"");
	}
}