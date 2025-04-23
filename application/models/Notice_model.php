<?php

class Notice_Model extends CI_model{

	public function getNoticeDetails($where)
	{
		$query = $this->db->query("SELECT *,(SELECT date FROM notice WHERE id=naw.notice_tbl_id)notice_date,(SELECT notice_category FROM notice WHERE id=naw.notice_tbl_id)notice_category,(SELECT notice FROM notice WHERE id=naw.notice_tbl_id)notice_details,(SELECT img FROM notice WHERE id=naw.notice_tbl_id)notice_img FROM `notice_adm_wise` naw WHERE $where");
		return $query->result_array();
	}
	
	public function gethomeworkDetails($where)
	{
		$query = $this->db->query("SELECT *,(SELECT date FROM homework WHERE id=naw.homework_tbl_id)homework_date,(SELECT homework_category FROM homework WHERE id=naw.homework_tbl_id)homework_category,(select category from homework_cat_master where id=(SELECT homework_category FROM homework WHERE id=naw.homework_tbl_id))catnm,(SELECT remarks FROM homework WHERE id=naw.homework_tbl_id)remarks,(SELECT img FROM homework WHERE id=naw.homework_tbl_id)img,(SELECT subject FROM homework WHERE id=naw.homework_tbl_id)subjectCode,(select SubName from subjects where SubCode=subjectCode)subjnm,(SELECT submission_date FROM homework WHERE id=naw.homework_tbl_id)subdate,(SELECT homework_date FROM homework WHERE id=naw.homework_tbl_id)hwDate FROM `homework_adm_wise` naw WHERE $where");
		return $query->result_array();
	}
	
	public function getHomeworkData($submission_dt,$category,$class,$section,$subject,$hw_status,$user_id){
		$query = $this->db->query("SELECT haw.stuUploadedimg,haw.stuByRemarks,haw.stu_status,haw.id,haw.homework_tbl_id,haw.admno,(select FIRST_NM from student where ADM_NO=haw.admno)firstnm,(select ROLL_NO from student where ADM_NO=haw.admno)roll,haw.homework_status,hw.subject,(SELECT SubName FROM subjects WHERE SubCode=hw.subject)subjnm,hw.homework_date,hw.class,(SELECT CLASS_NM FROM classes WHERE Class_No=hw.class)classnm,hw.sec,(SELECT SECTION_NAME FROM sections WHERE section_no=hw.sec)secnm,hw.homework_category,hw.remarks,hw.img FROM `homework_adm_wise` as haw join homework as hw on haw.homework_tbl_id=hw.id where hw.homework_category='$category' AND hw.subject='$subject' AND hw.submission_date='$submission_dt' AND haw.homework_status='$hw_status' AND class='$class' AND sec='$section' AND emp_id='$user_id' order by roll");
		return $query->result_array();
	}


	public function getHomeworkSubjectinParent($admno)
	{
		$query = $this->db->query("SELECT DISTINCT(subject)subject_id,(SELECT SubName FROM subjects WHERE SubCode=subject_id)subject_name FROM homework INNER JOIN homework_adm_wise ON homework.id=homework_adm_wise.homework_tbl_id WHERE homework_adm_wise.admno='$admno'");
		return $query->result_array();
	}

	public function getHomeworkList($where)
	{
		$query = $this->db->query("SELECT *,(SELECT category FROM homework_cat_master WHERE id=h.homework_category)homework_category_name,(SELECT SubName FROM subjects WHERE SubCode=h.subject)subject_name FROM `homework` h INNER JOIN homework_adm_wise haw ON h.id=haw.homework_tbl_id WHERE $where");
		return $query->result_array();
	}
	
	public function noticeReport($empid){
		$query = $this->db->query("SELECT naw.id,naw.notice_tbl_id,naw.admno,(select FIRST_NM from student where ADM_NO=naw.admno)firstnm,ntc.* FROM `notice_adm_wise` as naw JOIN notice as ntc on naw.notice_tbl_id=ntc.id and ntc.emp_id='$empid' order by ntc.id desc");
		return $query->result_array();
	}
	
	public function noticeReportBySearch($date,$cat,$empid){
		$query = $this->db->query("SELECT naw.id,naw.notice_tbl_id,naw.admno,(select FIRST_NM from student where ADM_NO=naw.admno)firstnm,ntc.* FROM `notice_adm_wise` as naw JOIN notice as ntc on naw.notice_tbl_id=ntc.id where ntc.date='$date' AND notice_category='$cat' AND ntc.emp_id='$empid'");
		return $query->result_array();
	}

  }