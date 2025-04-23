<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookissue extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		$this->load->model('Mymodel','dbcon');
			$this->load->model('Pawan','pawan');
			$this->load->model('Gautam','gautam');
	}
	public function index(){
		
		$adm_no = $this->session->userdata('adm');
		$book_issue= $this->pawan->selectA('books_applied','*',"Admno='$adm_no' AND Issued='1'");	
		$advbook= $this->pawan->selectA('books_applied_adv','*',"Admno='$adm_no' AND Issued='0'");	
		$bbdata= $this->pawan->selectA('BookMaster','*,(select book_name from library_call_master where id=BookMaster.SUB_ID)subject,(select CLASS_NM from classes where class_no=BookMaster.CLASS)class');	
		$stuData= $this->gautam->student_data_stu($adm_no);
		$data=array('issued'=>$book_issue,'adv_issue'=>$advbook,'StuDatas'=>$stuData,'BookDetail'=>$bbdata);
	$this->Parent_templete('parents_dashboard/library/bookissue',$data);
		
	}
		public function bookDetails(){
		$feild 	= $this->input->post('feild');
		$value 	= $this->input->post('value');
		$adm 	= $this->input->post('adm');
		$StuData    = $this->pawan->book_data($value,$feild);
		
		$numrow		= $this->pawan->numrows('bookmaster','*',"$feild='$value'");
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
		$acce_no    = $StuData[0]['accno'];
		$remain 	= $this->pawan->selectA('books_applied','count(id) as isu_no',"BName='$book_name' and Issued='1'");
		$isu_no		=$remain[0]['isu_no'];
		$nbook 		= $this->pawan->selectA('bookmaster','count(id) as nbook',"BNAME='$book_name'");
		$totbok		=$nbook[0]['nbook'];
		$isuid 		= $this->pawan->selectA('books_applied_adv','count(id) as isu_no',"BookID='$B_Code' && Admno='$adm' && Issued='0'");
		$bokissu	=$isuid[0]['isu_no'];
		$multi 		= $this->pawan->selectA('bookmaster','*',"accno='$acce_no' and FLAG='0'");
	    $rbooklist 	= $this->pawan->selectA('BookMaster',"*,(select Issued from books_applied_adv where BookID=BookMaster.B_Code AND Admno='$adm' AND Issued='0' )Issued","ID_NO='$ID_NO' AND book_status !='L' AND book_status !='D' AND book_status !='W'");
    	  
	
		$t=0;				
		$res = '';		
		$res .="<table class='table'style='font-size: 12px;cursor:pointer' id='example'><thead><tr><th style='background:#337ab7;width: 38px; color:#fff !important;border:1px solid;'></th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Book Name</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Acc.No</th></tr></thead><tbody>";
	//print_r($rbooklist);
	//die();
		foreach($rbooklist as $key => $val){
			$cc=$val['accno'];
			
			
			$fnc="onclick='searchh($cc)'";
			
			if($val['Issued']==""){
					$clr="";
					$vl="";
				}else{
					$clr="background-color:#ffd9b3;opacity:0.4";
					$vl="<strong>Allready you Aplied</strong>";
				}
			if($acce_no ==$val['accno']){
				if($val['Issued']==""){
					$clr="background-color:#85e0c9";
					$vl="<strong>Selected</strong>";
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
		$ret .="<tr><td style='border:1px solid #dddddd;'>".++$c."</td><td style='border:1px solid #dddddd;'>".$val['BName']."</td><td style='border:1px solid #dddddd;'>".$val['accno']."</td><td style='border:1px solid #dddddd;'>".date('d-M-y',strtotime($val['IDate']))."</td><td style='border:1px solid #dddddd;'>".$val['Due_date']."</td></tr><tbody>";
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
					
			$adv .="<table class='table' style='font-size: 12px;' class='example'><thead><tr><th style='background:#337ab7; color:#fff !important;border:1px solid;'></th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Book Name</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Acc.No</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Appl. Date</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Booking Date</th></tr></thead><tbody>";
			 foreach($advbook as $key => $val){
			$adv .="<tr><td style='border:1px solid #dddddd;'>".++$c."</td><td style='border:1px solid #dddddd;'>".$val['BName']."</td><td style='border:1px solid #dddddd;'>".$val['BookID']."</td><td style='border:1px solid #dddddd;'>".$val['IDate']."</td><td style='border:1px solid #dddddd;'>".$val['BookingDate']."</td></tr><tbody>";
			}
			$adv .= '</table>';
		}
		$StuDatas   = $this->pawan->student_data($studnet_id);		
		$first_name = $StuDatas[0]['FIRST_NM'];
		$mid_name 	= $StuDatas[0]['MIDDLE_NM'];
		$stuClass   = $StuDatas[0]['CLASS_NM'];
		$stusec     = $StuDatas[0]['SECTION_NAME'];
		$sturoll    = $StuDatas[0]['ROLL_NO'];
		$maxbooks   = $fine_data[0]['maxbooks'];
		$full_name  = $first_name .' '. $mid_name;
		
		$array = array($ret,$full_name,$stuClass,$stusec,$sturoll,$cont,$maxbooks,$adv);	
		echo json_encode($array);
	}
	
	
		public function issuebook(){
			
		$admission_no 	= $this->input->post('admission_no');		
		$stu_class	 	= $this->input->post('stu_class');		
		$issue_dt	 	= date('Y-m-d',strtotime($this->input->post('issue_dt')));
		$due_date	 	= date('Y-m-d',strtotime($this->input->post('due_date')));				
		$B_Code			= $this->input->post('B_Code');
		$book_detail	= $this->pawan->selectA('bookmaster','*',"B_Code='$B_Code'");
		$sub_id			= $book_detail[0]['SUB_ID'];
		$PUBLISHER		= $book_detail[0]['PUBLISHER'];
		$book_name		= $book_detail[0]['BNAME'];
		$author_name	= $book_detail[0]['AUTHOR'];
		$bdate	= $book_detail[0]['bdate'];
		
		
		
		//print_r($sub_id);die;
		$savedata=array(
			'Admno'        	=> $admission_no,
			'SubId'        	=> $sub_id,
			'Issued'       	=> '0',
			'BookID'		=> $B_Code,
			'BookingDate'		=> $bdate,
			'class'       	=> $stu_class,
			'IDate'         => $issue_dt,			
			'BName'			=> $book_name,
			'author'		=> $author_name,			
			'publisher'		=> $PUBLISHER,			
			'Due_date' 		=> $due_date,			
		);		
		$ins		=$this->pawan->insert('books_applied_adv',$savedata);
		
			$upddat	=array(
			'FLAG'	=> '1',
		);
		//$upd=$this->pawan->update('bookmaster',$upddat,"B_code='$B_Code'");
	}

}
 
