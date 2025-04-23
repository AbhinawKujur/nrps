<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sumit extends CI_model{

	public function select($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	public function select_order_by($table,$data,$column,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		$this->db->order_by($column, "asc");
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function select_distinct($table,$data,$where=''){
		$this->db->distinct();
		$this->db->select($data);
		$this->db->from($table);
		$this->db->order_by($data, "asc");
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function max_no($table,$field){
		$this->db->select_max($field);
		$this->db->from($table);
		$query = $this->db->get();
		return $query->result();
	}

	public function insert($data,$table){
		$this->db->insert($data,$table);
		return true;
	}

	public function fetchAllData($data,$tablename,$where)
	{
		$query = $this->db->select($data)
						->where($where)
						-> get($tablename);
							
			return $query->result_array();
	}

	public function fetchAllDataWithOrder($data,$tablename,$where,$orderby,$order)
	{
		$query = $this->db->select($data)
						->where($where)
						->order_by($orderby, $order)
						->get($tablename);
							
			return $query->result_array();
	}

	public function fetchSingleData($data,$tablename,$where)
	{
		$query = $this->db->select($data)
						->where($where)
						-> get($tablename);
							
			return $query->row_array();
	}

	public function totalRecord($data,$tablename,$where)
	{
		$query = $this->db->select($data)
						->where($where)
						-> get($tablename);
							
			return $query->num_rows();
	}

	public function createData($tablename,$data)
	{
		$query = $this->db->insert($tablename,$data);
			return $query;
	}

	public function createDataReturnID($tablename,$data){
		$this->db->insert($tablename,$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function createMultiple($tablename,$data)
	{
		$query = $this->db->insert_batch($tablename, $data);
		return $query;
	}

	public function update($tablename,$data,$where)
	{
		$query = $this->db->update($tablename,$data,$where);
		// return $this->db->affected_rows();
		return $query;
	}

	public function delete($tablename,$where)
	{
		$query = $this->db->delete($tablename,$where);
			return $query;
	}

	public function checkData($data,$tablename,$where)
	{
		$query = $this->db->select($data)
						->where($where)
						-> get($tablename);
			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
	}


	public function fetchDataGroupBy($data,$groupby,$having,$tablename)
	{
		 $this->db->select($data);
		 $this->db->group_by($groupby); 
		 $this->db->having($having);
		 $query = $this->db->get($tablename);
		return $query->result_array();
	}

	public function fetchDataGroupByWhere($data,$tablename,$where,$groupby)
	{
		 $this->db->select($data);
		 $this->db->where($where);
		 $this->db->group_by($groupby); 
		 $query = $this->db->get($tablename);
		return $query->result_array();
	}

	public function fetchDataGroupByWhereOrderBy($data,$tablename,$where,$groupby,$orderby)
	{
		 $this->db->select($data);
		 $this->db->where($where);
		 $this->db->group_by($groupby); 
		 $this->db->order_by($orderby);
		 $query = $this->db->get($tablename);
		return $query->result_array();
	}

	public function fetchDataGroupByWithOrder($data,$groupby,$having,$tablename,$order_by)
	{
		 $this->db->select($data);
		 $this->db->group_by($groupby); 
		 $this->db->having($having);
		 $this->db->order_by($order_by);
		 $query = $this->db->get($tablename);
		return $query->result_array();
	}

	public function fetchSingleDataGroupBy($data,$tablename,$where,$groupby)
	{
		$this->db->select($data);
		 $this->db->where($where);
		 $this->db->group_by($groupby); 
		 $query = $this->db->get($tablename);
		return $query->row_array();
	}

	public function fetchTwoJoin($data,$tablename,$jointable,$oncondition,$where='')
	{
		$this->db->select($data);
         $this->db->from($tablename);
         $this->db->join($jointable, $oncondition);
         if($where != '')
         {
         	$this->db->where($where);
         }
		$result = $this->db->get();
		return $result->result_array();
	}

	public function fetchThreeJoin($data,$tablename,$jointable1,$jointable2,$oncondition1,$oncondition2,$where)
	{
		$this->db->select($data)
         		->from($tablename)
         		->join($jointable1, $oncondition1)
         		->join($jointable2, $oncondition2)
         		->where($where);
		$result = $this->db->get();
		return $result->result_array();
	}

	

	public function fetchLastData($data,$tablename,$where,$orderby)
	{
		$this->db->select($data);
		$this->db->from($tablename);
		$this->db->order_by($orderby,'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
							
		return $query->row_array();
	}

	public function getSingleEmployee($id)
	{
		$query = $this->db->query("SELECT *,IFNULL(EMP_FNAME,'')EMP_FNAMES,IFNULL(EMP_MNAME,'')EMP_MNAMES,IFNULL(EMP_LNAME,'')EMP_LNAMES,(SELECT qul.qualification from qualification as qul where qul.Sno=employee.QUAL) as qualification_name,(SELECT quall.qualification from qualification as quall WHERE quall.Sno=employee.MASTERQUAL) as masterqual_name, (SELECT qualll.qualification from qualification as qualll WHERE qualll.Sno=employee.PROFQUAL) as profqual_name, (SELECT des.DESIG from desig as des WHERE des.Sno=employee.DESIG) as designation_name,(SELECT role.NAME from role_master as role WHERE role.ID=employee.ROLE_ID) as role_name,(SELECT wing.NAME from wing_master as wing WHERE wing.ID=employee.WING_MASTER_ID) as wing_name FROM `employee` WHERE id='$id'");
		return $query->row_array();
	}

	public function getTimeDiff($punch_time, $shift_time)
	{
		$query = $this->db->query("SELECT TIMEDIFF('$punch_time', '$shift_time') as time_diff");
		return $query->row_array();
	}

	public function getOutTimeDiff($punch_time, $shift_time)
	{
		$query = $this->db->query("SELECT TIMEDIFF('$shift_time', '$punch_time') as time_diff");
		return $query->row_array();
	}

	public function getDateTimeDiff($in_time, $out_time)
	{
		$query = $this->db->query("SELECT TIMESTAMPDIFF(second,'$in_time','$out_time') as time_diff");
		return $query->row_array();
	}

	public function getEmpDAta($time_from,$time_to)
	{
		$query = $this->db->query("SELECT EMP.id,EMP.SHIFT as shift FROM employee as EMP WHERE id in (select distinct(EMPLOYEE_ID) FROM emp_attendance WHERE date(IN_TIME) >= '$time_from' and date(IN_TIME) <= '$time_to')");
		return $query->result_array();
	}
	public function getEmpAttendanceData($shift,$empid,$time_from,$time_to)
	{
		$query = $this->db->query("SELECT emp_atten.*,EMP.EMPID,EMP.EMP_FNAME,EMP.EMP_MNAME,EMP.EMP_LNAME,(select min(start_time) from shift_master where id in($shift)) AS SHIFTINTME,(select max(stop_time) from shift_master where id in($shift)) AS SHIFTOUTTME FROM emp_attendance as emp_atten INNER JOIN employee AS EMP ON emp_atten.EMPLOYEE_ID=EMP.ID WHERE EMP.ID=$empid AND  date(IN_TIME) >= '$time_from' and date(IN_TIME) <= '$time_to' ORDER BY emp_atten.IN_TIME");
		return $query->result_array();

	}

	public function getShiftDuration($shift)
	{
		$query = $this->db->query("SELECT SHIFT_DURATION FROM shift_master WHERE ID in ($shift)");
		return $query->result_array();
	}

	public function checkHoliday($date)
	{
		$date = date_create($date);
		$date = date_format($date,"Y-m-d");
		$query = $this->db->query("SELECT *
									FROM holiday_master
									WHERE
 									date(FROM_DATE) <= '$date' and date(TO_DATE) >= '$date' and (APPLIED_FOR = 0 OR APPLIED_FOR = 1);");
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return false;
		}
	}

	public function getEmployeeData()
	{
		$query = $this->db->query("SELECT *,(SELECT DESIG FROM desig WHERE Sno=emp.DESIG)designation,(SELECT print_position FROM desig WHERE Sno=emp.DESIG)print_position,(SELECT qualification from qualification where Sno=emp.QUAL) as qualification_name,(SELECT qualification from qualification WHERE Sno=emp.MASTERQUAL) as masterqual_name, (SELECT qualification from qualification WHERE Sno=emp.PROFQUAL) as profqual_name, (SELECT role.NAME from role_master as role WHERE role.ID=emp.ROLE_ID) as role_name,(SELECT wing.NAME from wing_master as wing WHERE wing.ID=emp.WING_MASTER_ID) as wing_name,ifnull((SELECT sum(TOTAL_DAYS) FROM emp_leave_attendance WHERE EMPLOYEE_ID=emp.EMPID AND LEAVE_TYPE=1 AND STATUS IN(0,1)),0)total_cl_leave_app,ifnull((SELECT sum(TOTAL_DAYS) FROM emp_leave_attendance WHERE EMPLOYEE_ID=emp.EMPID AND LEAVE_TYPE=2 AND STATUS IN(0,1)),0)total_ml_leave_app,ifnull((SELECT sum(TOTAL_DAYS) FROM emp_leave_attendance WHERE EMPLOYEE_ID=emp.EMPID AND LEAVE_TYPE=3 AND STATUS IN(0,1)),0)total_el_leave FROM `employee` emp WHERE STATUS = 1 ORDER BY emp.EMPID");
		return $query->result_array();
	}
	

	public function getEmployeeList($where)
	{
		$query = $this->db->query("SELECT employee.*,desig.DESIG,wing_master.NAME as wing_master_name,role_master.NAME as Role_name FROM `employee` INNER JOIN desig ON desig.Sno=employee.DESIG INNER JOIN wing_master ON employee.WING_MASTER_ID=wing_master.ID INNER JOIN role_master ON role_master.ID=employee.ROLE_ID WHERE $where");
		return $query->result_array();
	}
	public function absentEmployeeList($date)
	{
		$query = $this->db->query("SELECT id,EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,D_O_J,D_O_B,STAFF_TYPE,(SELECT DESIG FROM desig WHERE Sno=emp.DESIG)DESIGNATION,(SELECT NAME FROM wing_master WHERE ID=emp.WING_MASTER_ID)wing,(SELECT MIN(START_TIME) FROM shift_master WHERE id IN (SHIFT))IN_TIME,(SELECT MAX(STOP_TIME) FROM shift_master WHERE id IN (SHIFT))OUT_TIME FROM `employee` emp where id NOT IN (select distinct(EMPLOYEE_ID) from  emp_attendance WHERE date(ATTEN_DATE)='$date') AND STATUS=1");
		return $query->result_array();
	}

	public function myAttendance()
	{
		$query = $this->db->query("SELECT id,EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,D_O_J,D_O_B,STAFF_TYPE,(SELECT DESIG FROM desig WHERE Sno=emp.DESIG)DESIGNATION,(SELECT NAME FROM wing_master WHERE ID=emp.WING_MASTER_ID)wing,(SELECT MIN(START_TIME) FROM shift_master WHERE id IN (SHIFT))IN_TIME,(SELECT MAX(STOP_TIME) FROM shift_master WHERE id IN (SHIFT))OUT_TIME FROM `employee` emp where id NOT IN (select distinct(EMPLOYEE_ID) from  emp_attendance WHERE date(ATTEN_DATE)='$date') AND STATUS=1");
		return $query->result_array();
	}
  }