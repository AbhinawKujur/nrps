<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alam extends CI_model{

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
	
	public function del($table,$where){
		$this->db->where($where);
		$this->db->delete($table);
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
	
	public function countBook($subject_id){
		$query = $this->db->query("SELECT library_call_master.id as bookId,count(library_call_master.id)subjCnt,call_no FROM `library_call_master` join bookmaster on library_call_master.id=bookmaster.SUB_ID WHERE library_call_master.id='$subject_id' ");
		return $query->result_array();
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

	public function update($table,$data,$where=''){
		$this->db->where($where);
		$this->db->update($table,$data);
		return true;
	}
	
	public function del_grd_tbl($class,$sec,$trm){
		$this->db->query("delete from co_scholastic_grade where Class='$class' AND Sec='$sec' AND Term='$trm'");
		$this->db->query("delete from discipline_grades where Class='$class' AND Sec='$sec' AND Term='$trm'");
		return true;
	}
	
     public function co_scholastic_grade_data($classs,$sec,$trm){
        $query = $this->db->query("SELECT  DISTINCT(stu.ADM_NO),stu.FIRST_NM,stu.ROLL_NO,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO and SkillCode = 1 and Term = $trm)skill1,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO and SkillCode = 2 and Term = $trm)skill2,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO and SkillCode = 3 and Term = $trm)skill3,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO and SkillCode = 5 and Term = $trm)skill5,(select Grade from discipline_grades where Adm_no=stu.ADM_NO and  isnull(SkillCode) and Term = 2)skill4 from `student` as stu where stu.student_status='ACTIVE' and stu.CLASS='$classs' AND stu.SEC='$sec' order by stu.ROLL_NO");
		return $query->result();
	}
	
	public function discipline_grade($classs,$sec,$trm){
        $query = $this->db->query("SELECT  DISTINCT(stu.ADM_NO),stu.FIRST_NM,stu.ROLL_NO,(select Grade from discipline_grades where Adm_no=stu.ADM_NO and Term = $trm and SkillCode IS NULL)skill1 from `student` as stu where stu.student_status='ACTIVE' and stu.CLASS='$classs' AND stu.SEC='$sec' order by stu.ROLL_NO");
		return $query->result();
	}
	
	public function discipline_grade_skill_wise($classs,$sec,$trm){
        $query = $this->db->query("SELECT  DISTINCT(stu.ADM_NO),stu.FIRST_NM,stu.ROLL_NO,(select Grade from discipline_grades where Adm_no=stu.ADM_NO and SkillCode = 1 and Term = $trm)skill1,(select Grade from discipline_grades where Adm_no=stu.ADM_NO and SkillCode = 2 and Term = $trm)skill2,(select Grade from discipline_grades where Adm_no=stu.ADM_NO and SkillCode = 3 and Term = $trm)skill3,(select Grade from discipline_grades where Adm_no=stu.ADM_NO and SkillCode = 4 and Term = $trm)skill4 from `student` as stu where stu.student_status='ACTIVE' and stu.CLASS='$classs' AND stu.SEC='$sec' order by stu.ROLL_NO");
		return $query->result();
	}
	
	public function remarks_data($classs,$sec,$trm){
		$query = $this->db->query("SELECT  DISTINCT(stu.ADM_NO),stu.FIRST_NM,stu.ROLL_NO,(select REMARKS from remarks where Adm_no=stu.ADM_NO and TERM = 'TERM-$trm')remarks from `student` as stu where stu.student_status='ACTIVE' and stu.CLASS='$classs' AND stu.SEC='$sec' order by stu.ROLL_NO");
		return $query->result();
	}
	
	public function report_card_student_detail_backup2809($trm,$classs,$sec){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.t1_report_card_status,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,stu.WORK_DAYS,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND Term = '$trm')skill_1,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND Term = '$trm')skill_2,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND Term = '$trm')skill_3,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Term = '$trm')dis_grd,(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-$trm')rmks from student as stu where stu.CLASS = '$classs' AND stu.SEC = '$sec' AND Student_Status = 'ACTIVE' order by stu.ROLL_NO");
		return $query->result();
	}
	
	public function report_card_student_detail($trm, $classs, $sec)
	{
		$query = $this->db->query("SELECT stu.ADM_NO,stu.t1_report_card_status,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,stu.WORK_DAYS,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND Term = '$trm' AND class='$classs' AND Sec='$sec')skill_1,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND Term = '$trm' AND class='$classs' AND Sec='$sec')skill_2,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND Term = '$trm' AND class='$classs' AND Sec='$sec')skill_3,
		(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Term = '$trm' AND class='$classs' AND Sec='$sec')dis_grd,
		(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-$trm')rmks from student as stu where stu.CLASS = '$classs' AND stu.SEC = '$sec' AND Student_Status = 'ACTIVE' order by stu.ROLL_NO");
		return $query->result();
	}
	
	public function report_card_student_detail_junior($trm,$classs,$sec){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.t1_report_card_status,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,stu.WORK_DAYS from student as stu where stu.CLASS = '$classs' AND stu.SEC = '$sec' AND Student_Status = 'ACTIVE' order by stu.ROLL_NO");
		return $query->result();
	}
	
	public function annual_report_card_student_detail1($classs,$sec){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND Term = '1')t1_skill_1,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND Term = '1')t1_skill_2,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND Term = '1')t1_skill_3,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Term = '1')t1_dis_grd,(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-1')t1_rmks,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND Term = '2')t2_skill_1,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND Term = '2')t2_skill_2,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND Term = '2')t2_skill_3,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Term = '2')t2_dis_grd,(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-2')t2_rmks from student as stu where stu.CLASS = '$classs' AND stu.SEC = '$sec' AND Student_Status = 'ACTIVE' order by stu.ROLL_NO");
		return $query->result();
	}
	
	public function annual_report_card_student_detail2($classs,$sec,$adm_no){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,stu.WORK_DAYS,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND Term = '1')t1_skill_1,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND Term = '1')t1_skill_2,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND Term = '1')t1_skill_3,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Term = '1')t1_dis_grd,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode = '1' AND Term = '1')t1_dis_skill_1_grd,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode = '2' AND Term = '1')t1_dis_skill_2_grd,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode = '3' AND Term = '1')t1_dis_skill_3_grd,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode = '4' AND Term = '1')t1_dis_skill_4_grd,(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-1')t1_rmks,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND Term = '2')t2_skill_1,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND Term = '2')t2_skill_2,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND Term = '2')t2_skill_3,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Term = '2')t2_dis_grd,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode ='1' AND Term = '2')t2_dis_skill_1_grd,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode ='2' AND Term = '2')t2_dis_skill_2_grd,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode ='3' AND Term = '2')t2_dis_skill_3_grd,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode ='4' AND Term = '2')t2_dis_skill_4_grd,(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-2')t2_rmks from student as stu where stu.CLASS = '$classs' AND stu.SEC = '$sec' AND Student_Status = 'ACTIVE' AND stu.adm_no = '$adm_no' order by stu.ROLL_NO");
		return $query->result();
	}

public function studentDetailsByAdmissionNo_Batch($adm_no_array, $trm, $class, $section)
	{
		//$start = microtime(true);
		$adm_no_list = "'" . implode("','", $adm_no_array) . "'";
	
		if($trm == 1){
			$trm_nm = 'TERM-1';
		}else{
			$trm_nm = 'TERM-2';
		}

		// Pre-calculate attendance in a temp table
		$this->db->query("
        CREATE TEMPORARY TABLE IF NOT EXISTS temp_attendance AS
        SELECT admno, COUNT(DISTINCT att_date) AS t2_present_days
        FROM stu_attendance_entry
        WHERE admno IN ($adm_no_list)
        AND class_code = '$class'
        AND att_status IN ('P', 'HD')
        AND att_date > '2024-03-31'
        AND att_date <= '2025-03-06'
        GROUP BY admno
    ");

		// Main query with remarks table added
		$query = $this->db->query("
        SELECT 
            stu.ADM_NO, stu.CLASS,
            cls.GRADE_ONLY_SUB AS grade_only_sub,
            stu.SEC, stu.DISP_CLASS, stu.DISP_SEC, stu.ROLL_NO, stu.FIRST_NM, stu.MIDDLE_NM, 
            stu.TITLE_NM, stu.FATHER_NM, stu.MOTHER_NM, stu.BIRTH_DT, stu.MAY_ATT,stu.student_image,
            csg1.Grade AS skill_1,
            csg2.Grade AS skill_2,
            csg3.Grade AS skill_3,
            csg5.Grade AS skill_5,
            dg.Grade AS dis_grd,
            ta.t2_present_days,
            rm.remarks AS rmks
        FROM student AS stu
        LEFT JOIN classes AS cls ON cls.Class_No = stu.CLASS
        LEFT JOIN co_scholastic_grade AS csg1 ON csg1.Adm_no = stu.ADM_NO AND csg1.SkillCode = '1' AND csg1.Term = '$trm'
        LEFT JOIN co_scholastic_grade AS csg2 ON csg2.Adm_no = stu.ADM_NO AND csg2.SkillCode = '2' AND csg2.Term = '$trm'
        LEFT JOIN co_scholastic_grade AS csg3 ON csg3.Adm_no = stu.ADM_NO AND csg3.SkillCode = '3' AND csg3.Term = '$trm'
        LEFT JOIN co_scholastic_grade AS csg5 ON csg5.Adm_no = stu.ADM_NO AND csg5.SkillCode = '5' AND csg5.Term = '$trm'
        LEFT JOIN discipline_grades AS dg ON dg.Adm_no = stu.ADM_NO AND dg.SkillCode IS NULL AND dg.Term = '$trm'
        LEFT JOIN temp_attendance AS ta ON ta.admno = stu.ADM_NO
        LEFT JOIN remarks AS rm ON rm.ADM_NO = stu.ADM_NO AND rm.TERM = '$trm_nm'
        WHERE stu.ADM_NO IN ($adm_no_list)
        ORDER BY stu.ROLL_NO
    ");
	// echo $this->db->last_query();die;
		$result = $query->result_array();

		// Drop temp table
	

		$time = microtime(true) - $start;
		//echo "Student Fetch Time: $time seconds<br>";
		return $result;
	}
	public function studentDetailsByAdmissionNo($adm_no,$trm){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.CLASS,stu.student_image,(SELECT GRADE_ONLY_SUB FROM classes WHERE Class_No=stu.CLASS)grade_only_sub,stu.SEC,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,stu.WORK_DAYS,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND Term = '$trm' AND class=stu.CLASS)skill_1,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND Term = '$trm' AND class=stu.CLASS)skill_2,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND Term = '$trm' AND class=stu.CLASS)skill_3,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='5' AND Term = '$trm' AND class=stu.CLASS)skill_5,
		(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Term = '$trm' AND class=stu.CLASS)dis_grd,
		(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='1' AND Term='1')diskill_1,
		(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='2' AND Term='1')diskill_2,
		(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='3' AND Term='1')diskill_3,
		(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='4' AND Term='1')diskill_4,
		
		(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-$trm')rmks from student as stu where ADM_NO = '$adm_no' order by stu.ROLL_NO");
		return $query->row_array();
	}
	
	public function studentDetailsByAdmissionNo_new25($adm_no,$trm,$date,$class){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.CLASS,stu.student_image,(SELECT GRADE_ONLY_SUB FROM classes WHERE Class_No=stu.CLASS)grade_only_sub,stu.SEC,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,stu.WORK_DAYS,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND Term = '$trm')skill_1,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND Term = '$trm')skill_2,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND Term = '$trm')skill_3,(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='5' AND Term = '$trm')skill_5,(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Term = '$trm')dis_grd,(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='1' AND Term='1')diskill_1,(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='2' AND Term='1')diskill_2,(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='3' AND Term='1')diskill_3,(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='4' AND Term='1')diskill_4,
		(select count(DISTINCT att_date)present_days from stu_attendance_entry where admno=stu.ADM_NO AND class_code='$class' AND att_status in('P','HD') and att_date>= '2024-04-01' and att_date<= '$date' )t2_present_days,
		(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-$trm')rmks from student as stu where ADM_NO = '$adm_no' order by stu.ROLL_NO");
		return $query->row_array();
	}
	
		public function studentDetailsByAdmissionNo_New_9($adm_no,$trm,$class,$section){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.CLASS,(SELECT GRADE_ONLY_SUB FROM classes WHERE Class_No=stu.CLASS)grade_only_sub,stu.SEC,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,stu.WORK_DAYS,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND Term = '$trm')skill_1,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND Term = '$trm')skill_2,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND Term = '$trm')skill_3,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='5' AND Term = '$trm')skill_5,
		(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Term = '$trm')dis_grd,
		(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='1' AND Term='1')diskill_1,
		(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='2' AND Term='1')diskill_2,
		(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='3' AND Term='1')diskill_3,
		(SELECT Grade FROM discipline_grades WHERE Adm_No=stu.ADM_NO AND SkillCode='4' AND Term='1')diskill_4,
		(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-$trm')rmks,(select count(DISTINCT att_date)present_days from stu_attendance_entry where admno=stu.ADM_NO AND class_code='$class' AND att_status in('P','HD') and att_date>'2023-03-31' and att_date<='2024-03-04' )t2_present_days,(select count(DISTINCT att_date)WORK_days from stu_attendance_entry where admno=stu.ADM_NO AND class_code='$class' )t2_working_days from student as stu where ADM_NO = '$adm_no' order by stu.ROLL_NO");
		return $query->row_array();
	}
	
	
	public function studentDetailsByAdmissionNo_New($adm_no,$trm,$class,$section,$date){
		if($trm == 1){
			$trm_nm = 'TERM-1';
		}else{
			$trm_nm = 'TERM-2';
		}
		$query = $this->db->query("SELECT stu.ADM_NO,stu.CLASS,stu.student_image,
		(SELECT GRADE_ONLY_SUB FROM classes WHERE Class_No=stu.CLASS)grade_only_sub,stu.SEC,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,stu.MAY_ATT,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='1' AND class='$class' AND Term = '$trm')skill_1,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='2' AND class='$class' AND Term = '$trm')skill_2,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='3' AND class='$class' AND Term = '$trm')skill_3,
		(select Grade from co_scholastic_grade where Adm_no=stu.ADM_NO AND SkillCode='5' AND class='$class' AND Term = '$trm')skill_5,
		(select Grade from discipline_grades where Adm_no=stu.ADM_NO AND SkillCode is null AND Class='$class' AND Term = '$trm')dis_grd,
		(SELECT REMARKS FROM `remarks` where term = '$trm_nm' and adm_no = '$adm_no')rmks,
		(select count(DISTINCT att_date)present_days from stu_attendance_entry where admno=stu.ADM_NO AND class_code='$class' AND att_status in('P','HD') and att_date>'2024-03-31' and att_date<='$date' )t2_present_days
		 from student as stu where ADM_NO = '$adm_no' order by stu.ROLL_NO");
		return $query->row_array();
	}
	
	public function studentClassByAdmissionNo($adm_no){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.CLASS from student as stu where ADM_NO = '$adm_no' order by stu.ROLL_NO");
		return $query->row_array();
	}
	
	
	public function studentDetailsByAdmissionNo_junior_09($adm_no,$trm,$class,$section){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.CLASS,stu.SEC,stu.DISP_CLASS,stu.DISP_SEC,stu.WORK_DAYS,stu.ROLL_NO,concat_ws(' ',stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM) STU_NAME,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,stu.WORK_DAYS,(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-$trm')rmks,(select count(DISTINCT att_date)present_days from stu_attendance_entry where admno=stu.ADM_NO AND class_code='$class' AND att_status in('P','HD') and att_date>= '2023-04-03' and att_date<= '2024-03-04' )t2_present_days,(select count(DISTINCT att_date)WORK_days from stu_attendance_entry where  class_code='$class'  and sec_code = '$section' and att_date>= '2023-04-03' and att_date<= '2024-03-04')t2_working_days from student as stu where ADM_NO = '$adm_no' order by stu.ROLL_NO");
		return $query->row_array();
	}

	public function studentDetailsByAdmissionNo_junior($adm_no,$trm,$class,$section){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.CLASS,stu.SEC,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,concat_ws(' ',stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM) STU_NAME,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,
		(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-$trm')rmks,
		(select count(DISTINCT att_date)present_days from stu_attendance_entry where admno=stu.ADM_NO AND class_code='$class' AND att_status in('P','HD') and att_date>= '2024-04-01' and att_date<= '2024-09-24' )t2_present_days
	 from student as stu where ADM_NO = '$adm_no' order by stu.ROLL_NO");
		return $query->row_array();
	}
	public function studentDetailsByAdmissionNo_junior_new($adm_no,$trm,$class,$section,$date){
		$query = $this->db->query("SELECT stu.ADM_NO,stu.CLASS,stu.SEC,stu.DISP_CLASS,stu.student_image,stu.DISP_SEC,stu.ROLL_NO,concat_ws(' ',stu.FIRST_NM,stu.MIDDLE_NM,stu.TITLE_NM) STU_NAME,stu.FATHER_NM,stu.MOTHER_NM,stu.BIRTH_DT,
		(select REMARKS from remarks where Adm_no=stu.ADM_NO AND Term = 'TERM-$trm')rmks,
		(select count(DISTINCT att_date)present_days from stu_attendance_entry where admno=stu.ADM_NO AND att_status in('P','HD') and att_date>= '2024-04-01' and att_date<= '$date' )t2_present_days
	 from student as stu where ADM_NO = '$adm_no' order by stu.ROLL_NO");
		return $query->row_array();
	}
	public function getClassWiseSubject($term, $class, $section)
	{
		$query = $this->db->query("SELECT DISTINCT subject_code,subj_nm,opt_code,sorting_no,applicable_exam,Class_Name_Hindu_arabic,ifnull((SELECT ExamMode FROM classes WHERE Class_No=cswsa.Class_No),1)exam_mode,ifnull((SELECT PT_TYPE FROM classes WHERE Class_No=cswsa.Class_No),1)pt_type FROM `class_section_wise_subject_allocation` cswsa WHERE Class_No='$class' and section_no = '$section' AND applicable_exam=1 ORDER BY cswsa.sorting_no asc");
		return $query->result_array();
	}
	public function getClassWiseSubject_junior($class,$section)
	{
		$query = $this->db->query("SELECT class_no,section_no,subject_code,subj_nm,opt_code,sorting_no,applicable_exam FROM `class_section_wise_subject_allocation` where Class_No=$class and section_no=$section order by sorting_no;");
		return $query->result_array();
	}
	
	
	public function leave_approved(){
		$query = $this->db->query("SELECT ela.ID,ela.EMPLOYEE_ID,ela.REASON_DETAILS,ela.UPDATE_LOCK,(SELECT WING_MASTER_ID FROM employee where EMPID=ela.EMPLOYEE_ID)wing_id,(select concat(IFNULL(EMP_FNAME,''),' ',IFNULL(EMP_MNAME,''), ' ',IFNULL(EMP_LNAME,'')) FROM employee where EMPID=ela.EMPLOYEE_ID)empnm,(SELECT DESIG FROM employee where EMPID=ela.EMPLOYEE_ID)desig,(SELECT DESIG FROM desig where Sno=(SELECT DESIG FROM employee where EMPID=ela.EMPLOYEE_ID))designm,ela.APPLY_DATE,ela.LEAVE_TYPE,ela.DATE_FROM,ela.DATE_TO,ela.AGAINST_DATE_FROM,ela.AGAINST_DATE_TO,ela.TOTAL_DAYS,ela.REASON,ela.ADMIN_ID,(SELECT ROLE_ID FROM employee where EMPID=ela.ADMIN_ID)roleid,(SELECT NAME FROM role_master WHERE ID=(SELECT ROLE_ID FROM employee where EMPID=ela.ADMIN_ID))rolenm,ela.REMARKS FROM `emp_leave_attendance` as ela where ela.STATUS='1'");
		return $query->result();
	}
	
	public function leave_disapproved(){
		$query = $this->db->query("SELECT ela.ID,ela.EMPLOYEE_ID,ela.REASON_DETAILS,(SELECT WING_MASTER_ID FROM employee where EMPID=ela.EMPLOYEE_ID)wing_id,(select concat(IFNULL(EMP_FNAME,''),' ',IFNULL(EMP_MNAME,''), ' ',IFNULL(EMP_LNAME,'')) FROM employee where EMPID=ela.EMPLOYEE_ID)empnm,(SELECT DESIG FROM employee where EMPID=ela.EMPLOYEE_ID)desig,(SELECT DESIG FROM desig where Sno=(SELECT DESIG FROM employee where EMPID=ela.EMPLOYEE_ID))designm,ela.APPLY_DATE,ela.LEAVE_TYPE,ela.DATE_FROM,ela.DATE_TO,ela.AGAINST_DATE_FROM,ela.AGAINST_DATE_TO,ela.TOTAL_DAYS,ela.REASON,ela.ADMIN_ID,(SELECT ROLE_ID FROM employee where EMPID=ela.ADMIN_ID)roleid,(SELECT NAME FROM role_master WHERE ID=(SELECT ROLE_ID FROM employee where EMPID=ela.ADMIN_ID))rolenm,ela.REMARKS FROM `emp_leave_attendance` as ela where ela.STATUS='2'");
		return $query->result();
	}

	public function getMarksWithMaxMarks($examcode,$exammode,$class,$subject_code,$term,$adm_no)
	{
		$query = $this->db->query("SELECT M1,M2,M3,(SELECT MaxMarks FROM maxmarks WHERE ExamCode='$examcode' AND ExamMode='$exammode' AND ClassCode='$class' AND teacher_code='$subject_code' AND Term='$term')max_marks,(SELECT wetage1 FROM exammaster WHERE ExamCode='$examcode')wetage1,(SELECT wetage2 FROM exammaster WHERE ExamCode='$examcode')wetage2,((M3/M1)*(SELECT wetage1 FROM exammaster WHERE ExamCode='$examcode'))wetage_obt_cbse,((M3/M1)*(SELECT wetage2 FROM exammaster WHERE ExamCode='$examcode'))wetage_obt_cmc  FROM `marks` WHERE admno='$adm_no' AND ExamC = '$examcode' AND SCode='$subject_code' AND Term='$term'");
		return $query->row_array();
	}
	
	public function topper_list(){
		$query = $this->db->query("select *,(select CLASS_NM from classes where Class_No=temp_report_card.classes)classes,(select SECTION_NAME from sections where section_no=temp_report_card.sec)sec from  temp_report_card order by tot_wet_mrk DESC");
		return $query->result_array();
	}
	
	public function countSubj($subject_id){
		$query = $this->db->query("SELECT count(SubCode)subjCnt,SubSName FROM `subjects` join bookmaster on subjects.SubCode=bookmaster.SUB_ID WHERE subjects.SubCode='$subject_id'");
		return $query->result_array();
	}
	
	public function orderByDesc(){
		$query = $this->db->query("select * from  notice order by id DESC");
		return $query->result_array();
	}
	
	public function orderByDescc(){
		$query = $this->db->query("select * from  homework order by id DESC");
		return $query->result_array();
	}
	
	public function getclass(){
		$query = $this->db->query("SELECT DISTINCT(Class_No),(SELECT CLASS_NM FROM classes WHERE Class_No=class_section_wise_subject_allocation.Class_No)classnm FROM `class_section_wise_subject_allocation` order BY Class_No");
		return $query->result_array();
	}
	
	public function myMsgReply($stu_id){
		$query = $this->db->query("SELECT cm.sender_id,(SELECT FIRST_NM FROM student WHERE adm_no=cm.sender_id)firstnm,cm.sms_text,(SELECT sms_text FROM chat_msg WHERE reply_sms_chat_id=cm.id)reply_sms_text,cm.sender_date,(SELECT sender_date FROM chat_msg WHERE reply_sms_chat_id=cm.id)Rsender_date,(SELECT sender_id FROM chat_msg WHERE reply_sms_chat_id=cm.id)Rsender_id,(select EMP_FNAME from employee where EMPID=Rsender_id)empnm FROM `chat_msg` as cm WHERE sender_id = '$stu_id' AND sender_user = 'P' AND (SELECT sms_text FROM chat_msg WHERE reply_sms_chat_id=cm.id) is not null order by id desc");
		return $query->result_array();
	}
	
	public function dailyReport($date){
		$query = $this->db->query("SELECT DISTINCT CLASS,DISP_CLASS,SEC,DISP_SEC,(SELECT COUNT(*) FROM student WHERE CLASS=s.CLASS AND SEC=s.SEC)total_student,(SELECT COUNT(*) FROM stu_attendance_entry_periodwise WHERE att_status='A' AND class_code=s.CLASS AND sec_code=s.SEC AND period=1 AND date(att_date)='$date')total_absent,(SELECT COUNT(*) FROM stu_attendance_entry_periodwise WHERE att_status='P' AND class_code=s.CLASS AND sec_code=s.SEC AND period=1 AND date(att_date)='$date')total_present FROM student s ORDER BY CLASS,SEC");
		return $query->result_array();
	}
	
	public function reportCardPrepTofive($Class_No,$sec,$val,$subject_code){
		if($subject_code != 37){
			$query = $this->db->query("select id,skill_name,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=1 AND term='1')exmcode1_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=2 AND term='1')exmcode2_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=3 AND term='1')exmcode3_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=4 AND term='1')exmcode4_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=1 AND term='2')exmcode1_m2_t2,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=2 AND term='2')exmcode2_m2_t2,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=3 AND term='2')exmcode3_m2_t2,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=5 AND term='2')exmcode5_m2_t2 from subject_skill_master as ssm where subject_code='$subject_code' AND class_code='$Class_No'");
		}else{
			$query = $this->db->query("select id,skill_name,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$val' AND subject='$subject_code' AND class_code='$Class_No' AND sec_code='$sec' AND term='1' AND subj_skill_id=subject_skill_master.id)grdT1,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$val' AND subject='$subject_code' AND class_code='$Class_No' AND sec_code='$sec' AND term='2' AND subj_skill_id=subject_skill_master.id)grdT2 from subject_skill_master where subject_code='$subject_code' AND class_code='$Class_No'");
		}
		return $query->result_array();
	}
	
	public function internalCbseExcelReport($admno,$class,$sec,$subject){
		$query = $this->db->query("SELECT mrks.admno,mrks.Classes,mrks.Sec,mrks.ExamC as examCode1,mrks.M1 as examcode1mxmrks,mrks.M2 as examcode1mrks,(SELECT ExamC FROM marks WHERE ExamC='4' AND Term='Term-1' AND Classes='$class' AND Sec='$sec' AND admno='$admno' AND SCode='$subject')examcode4,(SELECT M1 FROM marks WHERE ExamC='4' AND Term='Term-1' AND Classes='$class' AND Sec='$sec' AND admno='$admno' AND SCode='$subject')examcode4mxmrks,(SELECT M2 FROM marks WHERE ExamC='4' AND Term='Term-1' AND Classes='$class' AND Sec='$sec' AND admno='$admno' AND SCode='$subject')examcode4mrks,(SELECT ExamC FROM marks WHERE ExamC='1' AND Term='Term-2' AND Classes='$class' AND Sec='$sec' AND admno='$admno' AND SCode='$subject')t2examcode1,(SELECT M1 FROM marks WHERE ExamC='1' AND Term='Term-2' AND Classes='$class' AND Sec='$sec' AND admno='$admno' AND SCode='$subject')t2examcode1mxmrks,(SELECT M2 FROM marks WHERE ExamC='1' AND Term='Term-2' AND Classes='$class' AND Sec='$sec' AND admno='$admno' AND SCode='$subject')t2examcode1mrks,(SELECT M2 FROM marks WHERE ExamC='2' AND Term='Term-2' AND Classes='$class' AND Sec='$sec' AND admno='$admno' AND SCode='$subject')t2notebokmrks,(SELECT M2 FROM marks WHERE ExamC='3' AND Term='Term-2' AND Classes='$class' AND Sec='$sec' AND admno='$admno' AND SCode='$subject')t2semrks FROM `marks` as mrks WHERE Classes='$class' AND Sec='$sec' AND admno='$admno' AND ExamC='1' AND SCode='$subject' AND Term='TERM-1'");
		return $query->result_array();
	}
	
	public function reportCardPrepTofiveGrade($Class_No,$sec,$val,$subject_code){
		$query = $this->db->query("select id,skill_name,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$val' AND subject='$subject_code' AND class_code='$Class_No' AND sec_code='$sec' AND term='1' AND subj_skill_id=subject_skill_master.id)grdT1,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$val' AND subject='$subject_code' AND class_code='$Class_No' AND sec_code='$sec' AND term='2' AND subj_skill_id=subject_skill_master.id)grdT2 from subject_skill_master where subject_code='$subject_code' AND class_code='$Class_No'");
		return $query->result_array();
	}
	
	public function reportCardOneToTwo($Class_No,$sec,$val,$subject_code){
		$query = $this->db->query("select id,skill_name,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=1 AND term='1')exmcode1_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=2 AND term='1')exmcode2_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=3 AND term='1')exmcode3_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=4 AND term='1')exmcode4_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=1 AND term='2')exmcode1_m2_t2,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=2 AND term='2')exmcode2_m2_t2,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=3 AND term='2')exmcode3_m2_t2,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=5 AND term='2')exmcode5_m2_t2 from subject_skill_master as ssm where subject_code='$subject_code' AND class_code='$Class_No'");
		return $query->result_array();
	}
	
	public function reportCardOneToTwoGrade($Class_No,$sec,$val,$subject_code){
		$query = $this->db->query("select id,skill_name,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$val' AND subject='$subject_code' AND class_code='$Class_No' AND sec_code='$sec' AND term='1' AND subj_skill_id=subject_skill_master.id)grdT1,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$val' AND subject='$subject_code' AND class_code='$Class_No' AND sec_code='$sec' AND term='2' AND subj_skill_id=subject_skill_master.id)grdT2 from subject_skill_master where subject_code='$subject_code' AND class_code='$Class_No'");
		return $query->result_array();
	}
	
	public function reportCardThreeToFive($Class_No,$sec,$val,$subject_code){
		$query = $this->db->query("select id,skill_name,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=1 AND term='1')exmcode1_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=2 AND term='1')exmcode2_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=3 AND term='1')exmcode3_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=4 AND term='1')exmcode4_m2_t1,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=1 AND term='2')exmcode1_m2_t2,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=2 AND term='2')exmcode2_m2_t2,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=3 AND term='2')exmcode3_m2_t2,(SELECT m2 FROM marks_all WHERE subject_skill=ssm.id AND class_code=ssm.class_code AND sec_code='$sec' AND subject=ssm.subject_code AND admno='$val' AND examcode=5 AND term='2')exmcode5_m2_t2 from subject_skill_master as ssm where subject_code='$subject_code' AND class_code='$Class_No'");
		return $query->result_array();
	}
	
	public function reportCardThreeToFiveGrade($Class_No,$sec,$val,$subject_code){
		$query = $this->db->query("select id,skill_name,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$val' AND subject='$subject_code' AND class_code='$Class_No' AND sec_code='$sec' AND term='1' AND subj_skill_id=subject_skill_master.id)grdT1,(SELECT grade FROM co_scholastic_grade_all WHERE admno='$val' AND subject='$subject_code' AND class_code='$Class_No' AND sec_code='$sec' AND term='2' AND subj_skill_id=subject_skill_master.id)grdT2 from subject_skill_master where subject_code='$subject_code' AND class_code='$Class_No'");
		return $query->result_array();
	}
	
	public function co_scholastic_grade_report(){
		$query = $this->db->query("SELECT Class_No,(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm,section_no,(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm FROM `class_section_wise_subject_allocation` WHERE `Class_No` IN (8,9,10,11,12) GROUP BY Class_No,section_no");
		return $query->result_array();
	}
	
	public function promotedStuSave($class_id){
		$query = $this->db->query("insert into promoted_stu select admno,first_nm,class_id,sec_id,percent,rank from topper_rank where class_id='$class_id' and admno not in (select admno from promoted_stu where class_id='$class_id')");
		return $query->result_array();
	}
	public function get_data_from_daycoll()
	{
		$sql = "SELECT a.ADM_NO,a.RECT_NO,a.PERIOD FROM daycoll a
		WHERE a.PERIOD NOT LIKE '%MIS%' AND a.PERIOD !='CANCELLED' AND a.PERIOD NOT LIKE '%PRE%' AND a.PERIOD NOT LIKE '%FOR%'  AND a.PERIOD NOT LIKE '%FEE%' AND a.PERIOD NOT LIKE '%CHG%' AND a.PERIOD NOT LIKE '%ADV%' AND a.PERIOD NOT LIKE '%NOT%' AND a.PERIOD NOT LIKE '%OLD%' AND a.PERIOD NOT LIKE '%EXAM%' AND a.PERIOD NOT LIKE '%OF%' AND a.PERIOD NOT LIKE '%TDS%' AND a.PERIOD NOT LIKE '%RENT%' AND a.PERIOD NOT LIKE '%EPF%' AND a.PERIOD NOT LIKE '%TC%' AND a.ADM_NO!=''AND a.PERIOD NOT LIKE '%ADM%' AND a.PERIOD NOT LIKE '%SHIRT%' AND a.PERIOD NOT LIKE '%BOOK%' AND a.PERIOD NOT LIKE '%PURCHASE%'  AND a.PERIOD NOT LIKE '%UPS%' AND a.PERIOD NOT LIKE '%DONAT%'  AND a.PERIOD NOT LIKE '%VOLLEY%'  AND a.PERIOD NOT LIKE '%RETURN%' AND a.PERIOD NOT LIKE '%DIESEL%' AND a.PERIOD NOT LIKE '%BILL%' AND a.PERIOD NOT LIKE '%SCH%'  AND a.PERIOD NOT LIKE '%BUS%' AND a.PERIOD NOT LIKE '%TOUR%' AND a.PERIOD NOT LIKE '%YOGA%' AND a.PERIOD NOT LIKE '%PALLAVI%' AND a.PERIOD NOT LIKE '%BAL%' AND a.PERIOD NOT LIKE '%EXHI%' AND a.PERIOD NOT LIKE '%CAMP%'
		ORDER BY  a.ADM_NO;";
		$query = $this->db->query($sql);
		return $query->result();

	}
	public function update_student_table($tmp,$rec,$adm_no)
	{
		
		$sql = "UPDATE student SET $tmp='$rec' WHERE adm_no='$adm_no'";
        $query = $this->db->query($sql);
        
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

	}
}