<?php

class Student_Model extends CI_Model
{
	public function getPeriodWiseSingleDate($att_date,$class_id,$section_id)
	{
		$query = $this->db->query("SELECT saep.admno,st.FIRST_NM,st.DISP_CLASS,st.DISP_SEC,st.ROLL_NO,st.C_MOBILE,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '1' AND date(att_date) ='$att_date' and class_code='$class_id' AND sec_code='$section_id')P1,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '2' AND date(att_date) ='$att_date' and class_code='$class_id' AND sec_code='$section_id')P2,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '3' AND date(att_date) ='$att_date' and class_code='$class_id' AND sec_code='$section_id')P3,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '4' AND date(att_date) ='$att_date' and class_code='$class_id' AND sec_code='$section_id')P4,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '5' AND date(att_date) ='$att_date' and class_code='$class_id' AND sec_code='$section_id')P5,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '5' AND date(att_date) ='$att_date' and class_code='$class_id' AND sec_code='$section_id')P5,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '6' AND date(att_date) ='$att_date' and class_code='$class_id' AND sec_code='$section_id')P6,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '7' AND date(att_date) ='$att_date' and class_code='$class_id' AND sec_code='$section_id')P7,(SELECT att_status FROM stu_attendance_entry_periodwise where admno=saep.admno AND period = '8' AND date(att_date) ='$att_date' and class_code='$class_id' AND sec_code='$section_id')P8 from stu_attendance_entry_periodwise as saep inner join student as st on st.ADM_NO=saep.admno where date(saep.att_date)='$att_date' AND saep.class_code='$class_id' AND saep.sec_code='$section_id' group by saep.admno,st.FIRST_NM,st.DISP_CLASS,st.DISP_SEC,st.ROLL_NO,st.C_MOBILE order by st.ROLL_NO asc");
		return $query->result_array();
	}

	public function getDayWiseSingleDate($where)
	{
		$query = $this->db->query("SELECT sae.admno,sae.att_status,st.FIRST_NM,st.DISP_CLASS,st.DISP_SEC,st.ROLL_NO,st.C_MOBILE from stu_attendance_entry as sae inner join student as st on st.ADM_NO=sae.admno where $where order by st.ROLL_NO asc");
		return $query->result_array();
	}

}