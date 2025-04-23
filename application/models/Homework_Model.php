<?php

class Homework_Model extends CI_model{

	public function getHomeworkReport($where,$role_id){
		if($role_id != 4){
			$query = $this->db->query("SELECT *,(SELECT CLASS_NM FROM classes WHERE Class_No=h.class)class_name,(SELECT SECTION_NAME FROM sections WHERE section_no=h.sec)section_name,(SELECT SubName FROM subjects WHERE SubCode=h.subject)subject_name,(SELECT category FROM homework_cat_master WHERE id=h.homework_category)category,(SELECT EMP_FNAME FROM employee WHERE EMPID=h.emp_id)EMP_FNAME,(SELECT EMP_MNAME FROM employee WHERE EMPID=h.emp_id)EMP_MNAME,(SELECT EMP_LNAME FROM employee WHERE EMPID=h.emp_id)EMP_LNAME FROM `homework` h WHERE $where");
		return $query->result_array();
		}else{
			$query = $this->db->query("SELECT *,(SELECT CLASS_NM FROM classes WHERE Class_No=h.class)class_name,(SELECT SECTION_NAME FROM sections WHERE section_no=h.sec)section_name,(SELECT SubName FROM subjects WHERE SubCode=h.subject)subject_name,(SELECT category FROM homework_cat_master WHERE id=h.homework_category)category,(SELECT EMP_FNAME FROM employee WHERE EMPID=h.emp_id)EMP_FNAME,(SELECT EMP_MNAME FROM employee WHERE EMPID=h.emp_id)EMP_MNAME,(SELECT EMP_LNAME FROM employee WHERE EMPID=h.emp_id)EMP_LNAME FROM `homework` h");
			return $query->result_array();
		}
	}
  }