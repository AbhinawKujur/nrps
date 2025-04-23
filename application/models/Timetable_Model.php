<?php

class Timetable_Model extends CI_model{

	public function getFloorList($where = 1)
	{
		$query = $this->db->query("SELECT f.Floor_ID,f.Floor_Name,w.NAME as Wing_Name,c.Campus_Name FROM `floor_master` f INNER JOIN wing_master w ON w.ID=f.Building_ID INNER JOIN campus_master c ON c.Campus_ID=f.Campus_ID WHERE $where ORDER BY w.ID");
		return $query->result_array();
	}

	public function getRoomList($where = 1)
	{
		$query = $this->db->query("SELECT r.Room_ID,r.Room_Name,r.Alloted_Class,r.Floor_ID,r.Building_ID,r.Campus_ID,f.Floor_Name,w.NAME as Wing_Name,c.Campus_Name FROM `room_master` r INNER JOIN floor_master f ON f.Floor_ID=r.Floor_ID INNER JOIN wing_master w ON w.ID=r.Building_ID INNER JOIN campus_master c ON w.CAMPUS_MASTER_ID=c.Campus_ID WHERE $where ORDER BY w.ID");
		return $query->result_array();
	}

	public function getTotalBundleAndPeriodTeacherWise($empid)
	{
		$query = $this->db->query("SELECT cs.subject_code,cs.Teacher_Merge_Class_Details,IFNULL(s.Bundle_Count,0)Bundle_Count,IFNULL(cs.Total_Period_inWeek,0)Total_Period_inWeek FROM class_section_wise_subject_allocation cs INNER JOIN subjects s ON cs.subject_code=s.SubCode WHERE cs.Main_Teacher_Code = '$empid' OR cs.Support_Teacher_Code = '$empid' GROUP BY cs.subject_code,cs.Teacher_Merge_Class_Details,s.Bundle_Count,cs.Total_Period_inWeek");
		return $query->result_array();
	}

	public function getClassSectionSubjectWiseTeacher($where,$class_no,$section_no,$subject_code)
	{
		$query = $this->db->query("SELECT Class_No,section_no,Main_Teacher_Code,Support_Teacher_Code,IFNULL((SELECT EMP_FNAME FROM employee WHERE EMPID=c.Main_Teacher_Code),' ')EMP_FNAME,IFNULL((SELECT EMP_MNAME FROM employee WHERE EMPID=c.Main_Teacher_Code),' ')EMP_MNAME,IFNULL((SELECT EMP_LNAME FROM employee WHERE EMPID=c.Main_Teacher_Code),' ')EMP_LNAME,IFNULL((SELECT EMP_FNAME FROM employee WHERE EMPID=c.Support_Teacher_Code),' ')EMP_FNAME_SUPPORT,IFNULL((SELECT EMP_MNAME FROM employee WHERE EMPID=c.Support_Teacher_Code),' ')EMP_MNAME_SUPPORT,IFNULL((SELECT EMP_LNAME FROM employee WHERE EMPID=c.Support_Teacher_Code),' ')EMP_LNAME_SUPPORT FROM class_section_wise_subject_allocation c WHERE $where");
		return $query->row_array();
	}

	public function getClassListBySubjectModel($where)
	{
		$query = $this->db->query("SELECT DISTINCT `cs`.`Class_No`, `c`.`CLASS_NM` FROM `class_section_wise_subject_allocation` `cs` JOIN `classes` `c` ON `cs`.`Class_No`=`c`.`Class_No` WHERE $where");
		return $query->result_array();
	}

	public function getTeacherDetailsByClassSectionSubject($class_id,$section_no,$subject_code)
	{
		$query = $this->db->query("SELECT cs.ID,cs.Main_Teacher_Code,cs.Support_Teacher_Code,c.CLASS_NM,s.SECTION_NAME,cs.subj_nm,(SELECT concat(IFNULL(EMP_FNAME,''),' ',IFNULL(EMP_MNAME,''),' ',IFNULL(EMP_LNAME,'')) FROM employee WHERE EMPID=cs.Main_Teacher_Code)EMP_NAME,(SELECT concat(IFNULL(EMP_FNAME,''),' ',IFNULL(EMP_MNAME,''),' ',IFNULL(EMP_LNAME,'')) FROM employee WHERE EMPID=cs.Support_Teacher_Code)EMP_NAME_SUPPORT FROM ((`class_section_wise_subject_allocation` cs INNER JOIN classes c ON c.Class_No=cs.Class_No) INNER JOIN sections s ON s.section_no=cs.section_no) WHERE cs.Class_No='$class_id' AND cs.section_no='$section_no' AND cs.subject_code='$subject_code'");
		return $query->row_array();
	}

	public function getTeacherDetailswithAllotedPeriod($where)
	{
		$query = $this->db->query("SELECT e.EMPID,e.EMP_FNAME,e.EMP_MNAME,e.EMP_LNAME,IFNULL((SELECT CLASS_NM FROM classes WHERE Class_No=L.Class_No),'')class_name,IFNULL((SELECT SECTION_NAME FROM sections WHERE section_no=L.Section_No),'')section_name FROM `employee` e INNER JOIN login_details l ON e.EMPID=l.user_id WHERE $where");
		return $query->result_array();
	}

	public function getSubjectList()
	{
		$query = $this->db->query("SELECT subject_code,subj_nm FROM `class_section_wise_subject_allocation` GROUP BY subject_code,subj_nm ORDER BY subj_nm");
		return $query->result_array();
	}
  }