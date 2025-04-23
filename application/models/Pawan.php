<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pawan extends CI_model{
	
	public function select($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function delete($tablename)
	{
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
	
	
	
//	public function updateANk($table,$data,$where='')
	//{
	
		//$this->db->update($table,$data);
//	$this->db->update('update books_applied inner join student on books_applied.admno=student.adm_no set //books_applied.rect_no=student.first_nm');
//	}
	
	public function selectA($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function numrows($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function student_data_18_05_2023($student_id){
		$query = $this->db->query("select FIRST_NM,MIDDLE_NM,DISP_CLASS,ROLL_NO,DISP_SEC from student a left join sections b on a.ADM_SEC=b.section_no left join classes c on a.ADM_CLASS=c.Class_No
		where LETTERNO='$student_id'");
		return $query->result_array();
	}
	
	public function student_data($student_id){
		$query = $this->db->query("select FIRST_NM,MIDDLE_NM,DISP_CLASS,ROLL_NO,DISP_SEC from student a left join sections b on a.ADM_SEC=b.section_no left join classes c on a.ADM_CLASS=c.Class_No
		where adm_no='$student_id'");
		return $query->result_array();
	}
	
	public function isuue_detail($adm_no){
		$query = $this->db->query("select a.BName,b.accno,a.IDate,a.Due_date from books_applied a left join bookmaster b  on a.BookID=b.B_Code  where ADMNO='$adm_no' and Issued=1");
		return $query->result_array();
	}
	
	public function book_data($acce_no){
		$query = $this->db->query("SELECT a.id as bookid,accno,ID_NO,`BNAME`,`AUTHOR`,`PUBLISHER`,`EDITION`,B_Code,`racname`,`Rackno`,book_name as subject_name,book_no FROM `bookmaster` a left join library_call_master b on a.`SUB_ID`=b.id where `accno`='$acce_no'");
		return $query->result_array();
	}
	
	public function return_detail_old18_05_2023($acce_no){
		$query = $this->db->query("SELECT a.id,a.BookID,a.Admno,b.FIRST_NM,b.MIDDLE_NM,b.FATHER_NM,a.class,a.BName,a.Due_date,c.SECTION_NAME as ADM_SEC,a.`AppDate`,b.student_image FROM `books_applied` a left JOIN student b on a.Admno=b.letterno left join sections c on b.ADM_SEC=c.section_no where a.Issued='1' and `BookID`='$acce_no'");
		return $query->result_array();
	}
	
	
	public function return_detail($acce_no)
	{
		$query = $this->db->query("SELECT books_applied.id, books_applied.BookID, books_applied.Admno, student.FIRST_NM, student.MIDDLE_NM, student.FATHER_NM, books_applied.class, books_applied.BName, books_applied.Due_date,  books_applied.AppDate, student.student_image , student.DISP_SEC
		FROM books_applied
		LEFT JOIN student ON student.ADM_NO=books_applied.Admno
		WHERE books_applied.Issued='1' AND books_applied.BookID='$acce_no'");
		return $query->result_array();
	}


	public function return_details1718($acce_no)
	{
		$query = $this->db->query("SELECT books_applied.id, books_applied.BookID, books_applied.Admno, student.FIRST_NM, student.MIDDLE_NM, student.FATHER_NM, books_applied.class, books_applied.BName, books_applied.Due_date,  books_applied.AppDate,  student.DISP_SEC
		FROM books_applied
		LEFT JOIN student_1718 as student ON student.STUDENTID=books_applied.Admno
		WHERE books_applied.Issued='1' AND books_applied.BookID='$acce_no'");
		return $query->result_array();
	}

	public function return_details1819($acce_no)
	{
		$query = $this->db->query("SELECT books_applied.id, books_applied.BookID, books_applied.Admno, student.FIRST_NM, student.MIDDLE_NM, student.FATHER_NM, books_applied.class, books_applied.BName, books_applied.Due_date,  books_applied.AppDate,  student.DISP_SEC
		FROM books_applied
		LEFT JOIN student_1819 as student ON student.STUDENTID=books_applied.Admno
		WHERE books_applied.Issued='1' AND books_applied.BookID='$acce_no'");
		return $query->result_array();
	}

	public function return_details1920($acce_no)
	{
		$query = $this->db->query("SELECT books_applied.id, books_applied.BookID, books_applied.Admno, student.FIRST_NM, student.MIDDLE_NM, student.FATHER_NM, books_applied.class, books_applied.BName, books_applied.Due_date,  books_applied.AppDate,  student.DISP_SEC
		FROM books_applied
		LEFT JOIN student_1920 as student ON student.STUDENTID=books_applied.Admno
		WHERE books_applied.Issued='1' AND books_applied.BookID='$acce_no'");
		return $query->result_array();
	}
	
	
	public function stock_reg(){
		$query = $this->db->query("SELECT a.SUB_ID,count(a.SUB_ID) as instok,(Select book_name from library_call_master where id=a.SUB_ID)as book_name,(Select count(id) from bookmaster where accno=a.accno and flag=1) as totissued,(Select count(id) from bookmaster where SUB_ID=a.SUB_ID and book_status='L') as totlost,(Select count(id) from bookmaster where SUB_ID=a.SUB_ID and book_status='D') as totdmage ,(Select count(id) from bookmaster where SUB_ID=a.SUB_ID and book_status='W') as totwritten from bookmaster a GROUP by a.SUB_ID,book_name,totissued,totlost,totdmage order by book_name desc");
		return $query->result_array();
	}
	
	public function teach_isuue_detail($em_id){
		$query = $this->db->query("select a.BName,b.accno,a.IDate,a.Due_date from books_applied1 a left join bookmaster b on a.BookID=b.B_Code where E_ID='$em_id' and Issued=1");
		return $query->result_array();
	}
	public function tech_return_detail($acce_no){
		$query = $this->db->query("SELECT a.id,b.EMPID,a.`BookID`,b.EMP_FNAME,b.EMP_MNAME,b.EMP_LNAME,b.`FATHERS_NAME`,a.BName,a.Due_date FROM `books_applied1` a left JOIN employee b on a.`E_ID`=b.EMPID where a.Issued='1' and `BookID`='$acce_no'");
		return $query->result_array();
	}
	
	public function section_name_cwisw($class_no){
		$query	=	$this->db->query("SELECT a.section_no,(SELECT SECTION_NAME from sections WHERE section_no=a.section_no) secnm FROM `class_section_wise_subject_allocation` a where Class_No='$class_no' GROUP by section_no");
		return $query->result();
	}
	
	public function subject_name_cwisw($class_no){
		$query	=	$this->db->query("SELECT subject,(SELECT SubName from subjects WHERE SubCode=subject)as sub_name FROM `e_exam_questions` WHERE classes='$class_no' GROUP by subject");
		return $query->result();
	}
	
	/*public function question_det($class_no,$sec_no,$subject){		
		$query	=	$this->db->query("SELECT e_exam_answers.id as qid, admno,subj_id,(SELECT question FROM `e_exam_questions` WHERE e_exam_questions.id=que_id)question, (SELECT max_marks FROM `e_exam_questions` WHERE e_exam_questions.id=e_exam_answers.que_id)maxmarks,ans, (SELECT SubName from subjects WHERE SubCode=subj_id)subname,ob_marks,remarks,
		(SELECT student.FIRST_NM FROM `student` WHERE student.ADM_NO=e_exam_answers.admno)stuname FROM `e_exam_answers` WHERE subj_id='$subject' and class_no='$class_no' AND sec_no='$sec_no'");
		return $query->result();
	}*/
	public function question_det($class_no,$sec_no,$subject,$adm_id,$date){		
		$query	=	$this->db->query("SELECT e_exam_answers.id as qid, admno,subj_id,(SELECT question FROM `e_exam_questions` WHERE e_exam_questions.id=que_id)question, (SELECT max_marks FROM `e_exam_questions` WHERE e_exam_questions.id=e_exam_answers.que_id)maxmarks,ans, (SELECT SubName from subjects WHERE SubCode=subj_id)subname,ob_marks,remarks,
		(SELECT student.FIRST_NM FROM `student` WHERE student.ADM_NO=e_exam_answers.admno)stuname FROM `e_exam_answers` WHERE subj_id='$subject' and class_no='$class_no' AND sec_no='$sec_no' and admno='$adm_id' and date(created_at)='$date'");
		return $query->result();
	}
	
	public function student_List($class_no,$sec_no,$subject,$exam_d){		
		$query	=	$this->db->query("SELECT ADM_NO,FIRST_NM,ROLL_NO,TITLE_NM,MIDDLE_NM,c.status FROM `student` a RIGHT join e_exam_answers b on a.ADM_NO=b.admno  LEFT JOIN tbl_corrected_report c on a.ADM_NO=c.admno WHERE b.subj_id='$subject' AND b.class_no='$class_no' and b.sec_no='$sec_no' and date(b.created_at)='$exam_d' GROUP by ADM_NO,FIRST_NM,ROLL_NO,TITLE_NM,MIDDLE_NM,c.status");
		return $query->result();
	}	
	
	public function subject_name_cwisw_hw($class_no){
		$query	=	$this->db->query("SELECT subject,(SELECT SubName from subjects WHERE SubCode=subject)as sub_name FROM `e_exam_questions_hw` WHERE classes='$class_no' GROUP by subject");
		return $query->result();
	}
	
	public function section_name_cwisw_hw($class_no,$sec){
		$query	=	$this->db->query("SELECT a.section_no,(SELECT SECTION_NAME from sections WHERE section_no=a.section_no) section_nm FROM `class_section_wise_subject_allocation` a where Class_No='$class_no' and section_no='$sec' GROUP by section_no");
		return $query->result();
	}
	public function ans_key($que_id,$class_no,$sec,$adm_no,$subj_id){
		$query	=	$this->db->query("SELECT ans FROM e_exam_answers WHERE que_id='$que_id' and admno='$adm_no' and class_no='$class_no' and sec_no='$sec' and subj_id='$subj_id'");
		return $query->result();
	}
}