<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_transport_model extends CI_model{

	public function stu_last_bus_stoppage($adm_no)
	{
	
	$query = $this->db->query("SELECT * FROM student_transport_facility WHERE adm_no='".$adm_no."' ORDER BY id DESC LIMIT 1 ");
		return $query->result();

	}

	public function get_stoppage_name($sno){

		$query = $this->db->query("SELECT * FROM stoppage WHERE stopno='".$sno."'");
		return $query->result(); 

	}

	public function stu_first_bus_stoppage_row($adm_no)
	{ 
	 
	$query = $this->db->query("SELECT * FROM student_transport_facility WHERE adm_no='".$adm_no."' ORDER BY id ASC LIMIT 1 ");
		return $query->result();

	}
	public function update_transport_table($mon,$mon_code_new,$adm_no,$rowID){
		
		$myquery = "update student_transport_facility SET TO_APPLICABLE_MONTH='".$mon."', TO_APPLICABLE_MONTH_CODE=".$mon_code_new." where adm_no='".$adm_no."' AND ID='".$rowID."'";
        $query = $this->db->query($myquery);
  
  

	}
	public function get_month_calender($mon){
		$query = $this->db->query("SELECT * from month_master WHERE month_code=".$mon);
		return $query->result();
	}

	public function verify_user($usr,$pass)
	{
		$sql="SELECT * from misc_password WHERE username='".$usr."' AND password='".$pass."'";
		$query = $this->db->query($sql);
		if($query->num_rows() == 0)	return FALSE; 
			return $query->result();  

	}
	public function del_from_bus_transport($id){
		$query = $this->db->query("DELETE FROM student_transport_facility WHERE ID='".$id."'");
		return true;
	}
	
	public function select_and_insert($id){
		$sql="INSERT INTO student_transport_facility_log
SELECT a.* FROM student_transport_facility a WHERE a.ID='$id';";
		$query = $this->db->query($sql);
		return ($this->db->affected_rows()!= 1) ? false : true;
	}
	
}