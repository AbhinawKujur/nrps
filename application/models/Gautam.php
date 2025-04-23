<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gautam extends CI_model{

	
	public function fetchtempdata(){
		$query = $this->db->query("SELECT (SELECT count(*) from temp_cbse_reg where class='IX')total, count(*)pendingcnt,(SELECT count(*) from temp_cbse_reg WHERE verify='1' && class='IX')verifycnt FROM `temp_cbse_reg` WHERE verify='0' && class='IX'");
		return $query->result_array();
	}
public function fetchtempdata_xi(){
		$query = $this->db->query("SELECT (SELECT count(*) from temp_cbse_reg where class='XI')total, count(*)pendingcnt,(SELECT count(*) from temp_cbse_reg WHERE verify='1' && class='XI')verifycnt FROM `temp_cbse_reg` WHERE verify='0' && class='XI'");
		return $query->result_array();
	}
	public function student_data_stu($adm_no){
		
		$query = $this->db->query("select FIRST_NM,MIDDLE_NM,CLASS_NM,ROLL_NO,SECTION_NAME,ADM_NO from student a left join sections b on a.ADM_SEC=b.section_no left join classes c on a.ADM_CLASS=c.Class_No
		where ADM_NO='$adm_no'");
		
		return $query->result_array();
	}
	
	public function Journal_Entry_data(){
				$day= date("D");
				//$day= 'Wed';
				if($day =="Mon"){
					$d_pay= 'Price_mon';
									
									}else if($day =="Tue"){
										$d_pay= 'Price_tue';
									}
									else if($day =="Wed"){
										$d_pay= 'Price_wed';
									}
									else if($day =="Thu"){
										$d_pay='Price_thu';
									}else if($day =="Fri"){
										$d_pay='Price_fri';
									}
									else if($day =="Sat"){
										$d_pay= 'Price_sat';
									}else{
										$d_pay= 'Price_sun';
									}
		 $date= date("Y-m-d");
		//$date= "2020-09-10";
		
		$query =$this->db->query("SELECT nm.ItemID,nm.ItemName,nm.ItemType, nm.$d_pay as d_pay,nm.amount,(select qnt from `newspaper_journal_entry` where ItemID=nm.itemid  and daydate='$date') as qty,(select total from `newspaper_journal_entry` where ItemID=nm.itemid  and daydate='$date') as total_pay,(select id from `newspaper_journal_entry` where ItemID=nm.itemid and day='$day' and daydate='$date') as update_id FROM `newspaper_master` as nm ");
		
		return $query->result_array();
	}
	
		public function Journal_Entry_data_change($date){
			
				$date=date_create("$date");
$day = date_format($date,"D");
$date = date_format($date,"Y-m-d");
				//$day= 'Wed';
				if($day =="Mon"){
					$d_pay= 'Price_mon';
									
									}else if($day =="Tue"){
										$d_pay= 'Price_tue';
									}
									else if($day =="Wed"){
										$d_pay= 'Price_wed';
									}
									else if($day =="Thu"){
										$d_pay='Price_thu';
									}else if($day =="Fri"){
										$d_pay='Price_fri';
									}
									else if($day =="Sat"){
										$d_pay= 'Price_sat';
									}else{
										$d_pay= 'Price_sun';
									}
		
		//$date= "2020-09-10";
		
		$query =$this->db->query("SELECT nm.ItemID,nm.ItemName,nm.ItemType, nm.$d_pay as d_pay,(select qnt from `newspaper_journal_entry` where ItemID=nm.itemid and  daydate='$date') as qty,(select total from `newspaper_journal_entry` where ItemID=nm.itemid  and daydate='$date') as total_pay,(select id from `newspaper_journal_entry` where ItemID=nm.itemid and day='$day' and daydate='$date') as update_id FROM `newspaper_master` as nm  where nm.$d_pay>0");
		return $query->result_array();
	}
	
	
	public function book_data($value,$feild){
		$query = $this->db->query("SELECT a.id as bookid,`BNAME`,`ID_NO`,`AUTHOR`,`PUBLISHER`,`EDITION`,B_Code,`racname`,`Rackno`,book_name as subject_name,book_no FROM `bookmaster` a left join library_call_master b on a.`SUB_ID`=b.id where `$feild`='$value'");
		return $query->result_array();
	}
	
}