<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Farheen extends CI_model{

	public function select($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	public function selectA($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function delete($tablename){
		$query = $this->db->empty_table($tablename);
			return $query;
	}

	public function insert($data,$table){
		$this->db->insert($data,$table);
		return true;
	}

	public function update($table,$data,$where=''){
		$this->db->where($where);
		$this->db->update($table,$data);
		return true;
	}
	public function monthly_collection($admno)
	{
		$query = $this->db->query("SELECT student.ADM_DATE,student.ADM_NO,student.FIRST_NM,student.STUDENTID,student.FATHER_NM,student.MOTHER_NM,student.DISP_CLASS,student.DISP_SEC,student.ROLL_NO,eward.HOUSENAME,stoppage.STOPPAGE,stop_amt.AMT,student.APR_FEE,student.MAY_FEE,student.JUNE_FEE,student.JULY_FEE,student.AUG_FEE,student.SEP_FEE,student.OCT_FEE,student.NOV_FEE,student.DEC_FEE,student.JAN_FEE,student.FEB_FEE,student.MAR_FEE FROM(((student LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO) LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN stop_amt ON student.STOPNO=stop_amt.STOP_NO) WHERE student.ADM_NO='$admno'");
		return $query->result();
	}
	
	public function selectSingleData($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->row();
	}
	
	public function scholar_data($month,$adm_no,$Apply_From_ID)
	{
		$t = 's'.$month;
		$query = $this->db->query("select $t as schl from scholarship where $t>0 and AWARDED<=$Apply_From_ID and ADM_NO='$adm_no'");
		
		$result = $query->result();
		return $result;
	}
	
	public function feehead_mnth($month,$i)
	{
		if($month == 1)
		{
			$mn = "APR";
		}
		elseif($month == 2)
		{
			$mn = "MAY";
		}
		elseif($month == 3)
		{
			$mn = "JUN";
		}
		elseif($month == 4)
		{
			$mn = "JUL";
		}
		elseif($month == 5)
		{
			$mn = "AUG";
		}
		elseif($month == 6)
		{
			$mn = "SEP";
		}
		elseif($month == 7)
		{
			$mn = "OCT";
		}
		elseif($month == 8)
		{
			$mn = "NOV";
		}
		elseif($month == 9)
		{
			$mn = "DECM";
		}
		elseif($month == 10)
		{
			$mn = "JAN";
		}
		elseif($month == 11)
		{
			$mn = "FEB";
		}
		elseif($month == 12)
		{
			$mn = "MAR";
		}
		
		$query = $this->db->query("select $mn as mnth from feehead where ACT_CODE=$i");
		$result = $query->result();
		return $result;
	}
	
	public function getbusamountmonthwise($adm,$monthno){
		$month='';
		if ($monthno==1){
			$month='APR_FEE';
		}
		elseif($monthno == 2)
		{
			$month='MAY_FEE';
		}
		elseif($monthno == 3)
		{
			$month = "JUN_FEE";
		}
		elseif($monthno == 4)
		{
			$month = "JUL_FEE";
		}
		elseif($monthno == 5)
		{
			$month = "AUG_FEE";
		}
		elseif($monthno == 6)
		{
			$month = "SEP_FEE";
		}
		elseif($monthno == 7)
		{
			$month = "OCT_FEE";
		}
		elseif($monthno == 8)
		{
			$month = "NOV_FEE";
		}
		elseif($monthno == 9)
		{
			$month = "DEC_FEE";
		}
		elseif($monthno == 10)
		{
			$month = "JAN_FEE";
		}
		elseif($monthno == 11)
		{
			$month = "FEB_FEE";
		}
		elseif($monthno == 12)
		{
			$month = "MAR_FEE";
		}
		
		$query = $this->db->query("SELECT (SELECT $month FROM stop_amt WHERE STOP_NO=sbd.NEW_STOPNO) AS BUSAMOUNT FROM student_transport_facility AS sbd WHERE sbd.ADM_NO='$adm' AND sbd.FROM_APPLICABLE_MONTH_CODE<='$monthno' AND sbd.TO_APPLICABLE_MONTH_CODE>='$monthno' ORDER BY sbd.ID desc");
		return $query->result();
	}
}