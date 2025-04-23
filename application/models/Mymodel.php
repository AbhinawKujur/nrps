<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_model{

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
	
	
	public function del($table,$where=''){
		$this->db->where($where);
		$this->db->delete($table);
		$query = $this->db->get();
		return true;
	}
	public function empty_table($table){
		$this->db->empty_table($table);
		return true;
	}
	
	public function Previous_year_duesmonth($adm){
		$query = $this->db->query("SELECT month_master.id,previous_year_feegeneration.Month_NM,previous_year_feegeneration.STU_NAME,previous_year_feegeneration.STUDENTID,previous_year_feegeneration.ADM_NO,previous_year_feegeneration.CLASS,previous_year_feegeneration.SEC,previous_year_feegeneration.ROLL_NO,previous_year_feegeneration.TOTAL,previous_year_feegeneration.Fee1,previous_year_feegeneration.Fee2,previous_year_feegeneration.Fee3,previous_year_feegeneration.Fee4,previous_year_feegeneration.Fee5,previous_year_feegeneration.Fee6,previous_year_feegeneration.Fee7,previous_year_feegeneration.Fee8,previous_year_feegeneration.Fee9,previous_year_feegeneration.Fee10,previous_year_feegeneration.Fee11,previous_year_feegeneration.Fee12,previous_year_feegeneration.Fee13,previous_year_feegeneration.Fee14,previous_year_feegeneration.Fee15,previous_year_feegeneration.Fee16,previous_year_feegeneration.Fee17,previous_year_feegeneration.Fee18,previous_year_feegeneration.Fee19,previous_year_feegeneration.Fee20,previous_year_feegeneration.Fee21,previous_year_feegeneration.Fee22,previous_year_feegeneration.Fee23,previous_year_feegeneration.Fee24,previous_year_feegeneration.Fee25 FROM previous_year_feegeneration LEFT JOIN month_master ON previous_year_feegeneration.Month_NM=month_master.month_name WHERE previous_year_feegeneration.ADM_NO='$adm' ORDER BY month_master.id");
		return $query->result();
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
	public function createMultiple($tablename,$data)
	{
		$query = $this->db->insert_batch($tablename, $data);
		return true;
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
	public function selectmultiDataArray($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result_array();
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

	public function update($table,$data,$where=''){
		$this->db->where($where);
		$this->db->update($table,$data);
		return true;
	}
	public function icard($adm_no){
		$query = $this->db->query("SELECT ADM_NO,BIRTH_DT,FIRST_NM,FATHER_NM,MOTHER_NM,(SELECT STOPPAGE FROM stoppage WHERE stoppage.STOPNO=st.STOPNO)STOPPAGE_AMT,student_image,DISP_CLASS,DISP_SEC,ROLL_NO,C_MOBILE,CORR_ADD FROM `student` st WHERE ADM_NO='$adm_no'");
		return $query->row();
	}
	public function class_wise_ledger($class,$sec,$order){
		//$query = $this->db->query("SELECT ADM_NO,FIRST_NM,ROLL_NO,EMP_WARD, (select HOUSENAME from eward where HOUSENO=student.EMP_WARD)housenm,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.APR_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.APR_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.APR_FEE,2)))) APR_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.APR_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.APR_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.APR_FEE,2)))) APR_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.APR_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.APR_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.APR_FEE,2)))) APR_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAY_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAY_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.MAY_FEE,2)))) MAY_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAY_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.MAY_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.MAY_FEE,2)))) MAY_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAY_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.MAY_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.MAY_FEE,2)))) MAY_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JUNE_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JUNE_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.JUNE_FEE,2)))) JUNE_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JUNE_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JUNE_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.JUNE_FEE,2)))) JUNE_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JUNE_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.JUNE_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.JUNE_FEE,2)))) JUNE_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JULY_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JULY_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.JULY_FEE,2)))) JULY_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JULY_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JULY_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.JULY_FEE,2)))) JULY_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JULY_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.JULY_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.JULY_FEE,2)))) JULY_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.AUG_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.AUG_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.AUG_FEE,2)))) AUG_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.AUG_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.AUG_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.AUG_FEE,2)))) AUG_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.AUG_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.AUG_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.AUG_FEE,2)))) AUG_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.SEP_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.SEP_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.SEP_FEE,2)))) SEP_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.SEP_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.SEP_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.SEP_FEE,2)))) SEP_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.SEP_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.SEP_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.SEP_FEE,2)))) SEP_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.OCT_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.OCT_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.OCT_FEE,2)))) OCT_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.OCT_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.OCT_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.OCT_FEE,2)))) OCT_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.OCT_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.OCT_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.OCT_FEE,2)))) OCT_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.NOV_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.NOV_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.NOV_FEE,2)))) NOV_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.NOV_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.NOV_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.NOV_FEE,2)))) NOV_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.NOV_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.NOV_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.NOV_FEE,2)))) NOV_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.DEC_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.DEC_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.DEC_FEE,2)))) DEC_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.DEC_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.DEC_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.DEC_FEE,2)))) DEC_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.DEC_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.DEC_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.DEC_FEE,2)))) DEC_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JAN_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JAN_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.JAN_FEE,2)))) JAN_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JAN_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JAN_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.JAN_FEE,2)))) JAN_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JAN_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.JAN_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.JAN_FEE,2)))) JAN_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.FEB_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.FEB_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.FEB_FEE,2)))) FEB_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.FEB_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.FEB_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.FEB_FEE,2)))) FEB_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.FEB_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.FEB_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.FEB_FEE,2)))) FEB_FEE_AMT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAR_FEE) <> '', (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAR_FEE),(SELECT RECT_NO FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.MAR_FEE,2)))) MAR_FEE_RECPT,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAR_FEE) <> '', (SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.MAR_FEE),(SELECT RECT_DATE FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.MAR_FEE,2)))) MAR_FEE_DATE,

//IF ((SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAR_FEE) <> '', (SELECT TOTAL FROM daycoll WHERE RECT_NO=student.MAR_FEE),(SELECT TOTAL FROM temp_daycoll WHERE RECT_NO=(SUBSTRING(student.MAR_FEE,2)))) MAR_FEE_AMT

//FROM `student` WHERE `CLASS` = '$class' AND `SEC` = '$sec' AND Student_Status='ACTIVE' ORDER BY $order;");
		$query = $this->db->query("SELECT 
    s.ADM_NO,
    s.FIRST_NM,
    s.ROLL_NO,
    s.EMP_WARD,
    e.HOUSENAME AS housenm,

    -- April Fee Details
    COALESCE(d_apr.RECT_NO, t_apr.RECT_NO) AS APR_FEE_RECPT,
    COALESCE(d_apr.RECT_DATE, t_apr.RECT_DATE) AS APR_FEE_DATE,
    COALESCE(d_apr.TOTAL, t_apr.TOTAL) AS APR_FEE_AMT,

    -- May Fee Details
    COALESCE(d_may.RECT_NO, t_may.RECT_NO) AS MAY_FEE_RECPT,
    COALESCE(d_may.RECT_DATE, t_may.RECT_DATE) AS MAY_FEE_DATE,
    COALESCE(d_may.TOTAL, t_may.TOTAL) AS MAY_FEE_AMT,

    -- June Fee Details
    COALESCE(d_jun.RECT_NO, t_jun.RECT_NO) AS JUNE_FEE_RECPT,
    COALESCE(d_jun.RECT_DATE, t_jun.RECT_DATE) AS JUNE_FEE_DATE,
    COALESCE(d_jun.TOTAL, t_jun.TOTAL) AS JUNE_FEE_AMT,
    
    -- July Fee Details
    COALESCE(d_jul.RECT_NO, t_jul.RECT_NO) AS JULY_FEE_RECPT,
    COALESCE(d_jul.RECT_DATE, t_jul.RECT_DATE) AS JULY_FEE_DATE,
    COALESCE(d_jul.TOTAL, t_jul.TOTAL) AS JULY_FEE_AMT,
    
    -- Aug Fee Details
    COALESCE(d_aug.RECT_NO, t_aug.RECT_NO) AS AUG_FEE_RECPT,
    COALESCE(d_aug.RECT_DATE, t_aug.RECT_DATE) AS AUG_FEE_DATE,
    COALESCE(d_aug.TOTAL, t_aug.TOTAL) AS AUG_FEE_AMT,
    
    -- Sep Fee Details
    COALESCE(d_sep.RECT_NO, t_sep.RECT_NO) AS SEP_FEE_RECPT,
    COALESCE(d_sep.RECT_DATE, t_sep.RECT_DATE) AS SEP_FEE_DATE,
    COALESCE(d_sep.TOTAL, t_sep.TOTAL) AS SEP_FEE_AMT,
    
    -- Oct Fee Details
    COALESCE(d_oct.RECT_NO, t_oct.RECT_NO) AS OCT_FEE_RECPT,
    COALESCE(d_oct.RECT_DATE, t_oct.RECT_DATE) AS OCT_FEE_DATE,
    COALESCE(d_oct.TOTAL, t_oct.TOTAL) AS OCT_FEE_AMT,
    
    -- Nov Fee Details
    COALESCE(d_nov.RECT_NO, t_nov.RECT_NO) AS NOV_FEE_RECPT,
    COALESCE(d_nov.RECT_DATE, t_nov.RECT_DATE) AS NOV_FEE_DATE,
    COALESCE(d_nov.TOTAL, t_nov.TOTAL) AS NOV_FEE_AMT,
    
    
    -- Dec Fee Details
    COALESCE(d_dec.RECT_NO, t_dec.RECT_NO) AS DEC_FEE_RECPT,
    COALESCE(d_dec.RECT_DATE, t_dec.RECT_DATE) AS DEC_FEE_DATE,
    COALESCE(d_dec.TOTAL, t_dec.TOTAL) AS DEC_FEE_AMT,
    
    
    -- Jan Fee Details
    COALESCE(d_jan.RECT_NO, t_jan.RECT_NO) AS JAN_FEE_RECPT,
    COALESCE(d_jan.RECT_DATE, t_jan.RECT_DATE) AS JAN_FEE_DATE,
    COALESCE(d_jan.TOTAL, t_jan.TOTAL) AS JAN_FEE_AMT,
    
     -- Feb Fee Details
    COALESCE(d_feb.RECT_NO, t_feb.RECT_NO) AS FEB_FEE_RECPT,
    COALESCE(d_feb.RECT_DATE, t_feb.RECT_DATE) AS FEB_FEE_DATE,
    COALESCE(d_feb.TOTAL, t_feb.TOTAL) AS FEB_FEE_AMT,
    
     -- Mar Fee Details
    COALESCE(d_mar.RECT_NO, t_mar.RECT_NO) AS MAR_FEE_RECPT,
    COALESCE(d_mar.RECT_DATE, t_mar.RECT_DATE) AS MAR_FEE_DATE,
    COALESCE(d_mar.TOTAL, t_mar.TOTAL) AS MAR_FEE_AMT

FROM student s
LEFT JOIN eward e ON e.HOUSENO = s.EMP_WARD

-- April Fee Join
LEFT JOIN daycoll d_apr ON d_apr.RECT_NO = s.APR_FEE
LEFT JOIN temp_daycoll t_apr ON t_apr.RECT_NO = SUBSTRING(s.APR_FEE, 2)

-- May Fee Join
LEFT JOIN daycoll d_may ON d_may.RECT_NO = s.MAY_FEE
LEFT JOIN temp_daycoll t_may ON t_may.RECT_NO = SUBSTRING(s.MAY_FEE, 2)

-- June Fee Join
LEFT JOIN daycoll d_jun ON d_jun.RECT_NO = s.JUNE_FEE
LEFT JOIN temp_daycoll t_jun ON t_jun.RECT_NO = SUBSTRING(s.JUNE_FEE, 2)

-- July Fee Join
LEFT JOIN daycoll d_jul ON d_jul.RECT_NO = s.JULY_FEE
LEFT JOIN temp_daycoll t_jul ON t_jul.RECT_NO = SUBSTRING(s.JULY_FEE, 2)

-- Aug Fee Join
LEFT JOIN daycoll d_aug ON d_aug.RECT_NO = s.AUG_FEE
LEFT JOIN temp_daycoll t_aug ON t_aug.RECT_NO = SUBSTRING(s.AUG_FEE, 2)

-- Sep Fee Join
LEFT JOIN daycoll d_sep ON d_sep.RECT_NO = s.SEP_FEE
LEFT JOIN temp_daycoll t_sep ON t_sep.RECT_NO = SUBSTRING(s.SEP_FEE, 2)

-- Oct Fee Join
LEFT JOIN daycoll d_oct ON d_oct.RECT_NO = s.OCT_FEE
LEFT JOIN temp_daycoll t_oct ON t_oct.RECT_NO = SUBSTRING(s.OCT_FEE, 2)

-- Nov Fee Join
LEFT JOIN daycoll d_nov ON d_nov.RECT_NO = s.NOV_FEE
LEFT JOIN temp_daycoll t_nov ON t_nov.RECT_NO = SUBSTRING(s.NOV_FEE, 2)

-- Dec Fee Join
LEFT JOIN daycoll d_dec ON d_dec.RECT_NO = s.DEC_FEE
LEFT JOIN temp_daycoll t_dec ON t_dec.RECT_NO = SUBSTRING(s.DEC_FEE, 2)

-- Jan Fee Join
LEFT JOIN daycoll d_jan ON d_jan.RECT_NO = s.JAN_FEE
LEFT JOIN temp_daycoll t_jan ON t_jan.RECT_NO = SUBSTRING(s.JAN_FEE, 2)

-- Feb Fee Join
LEFT JOIN daycoll d_feb ON d_feb.RECT_NO = s.FEB_FEE
LEFT JOIN temp_daycoll t_feb ON t_feb.RECT_NO = SUBSTRING(s.FEB_FEE, 2)

-- Mar Fee Join
LEFT JOIN daycoll d_mar ON d_mar.RECT_NO = s.MAR_FEE
LEFT JOIN temp_daycoll t_mar ON t_mar.RECT_NO = SUBSTRING(s.MAR_FEE, 2)


WHERE s.CLASS = '$class' 
AND s.SEC = '$sec' 
AND s.Student_Status = 'ACTIVE' 
ORDER BY s.$order;");
		return $query->result();
	}
	public function bus_wise_ledger($class,$sec,$order,$fee){
		$query = $this->db->query("SELECT ADM_NO,FIRST_NM,ROLL_NO,EMP_WARD, (select HOUSENAME from eward where HOUSENO=student.EMP_WARD)housenm,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.APR_FEE)APR_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.APR_FEE)APR_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.APR_FEE)APR_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAY_FEE)MAY_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.MAY_FEE)MAY_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.MAY_FEE)MAY_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JUNE_FEE)JUNE_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JUNE_FEE)JUNE_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.JUNE_FEE)JUNE_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JULY_FEE)JULY_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JULY_FEE)JULY_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.JULY_FEE)JULY_FEE_AMT, (SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.AUG_FEE)AUG_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.AUG_FEE)AUG_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.AUG_FEE)AUG_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.SEP_FEE)SEP_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.SEP_FEE)SEP_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.SEP_FEE)SEP_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.OCT_FEE)OCT_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.OCT_FEE)OCT_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.OCT_FEE)OCT_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.NOV_FEE)NOV_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.NOV_FEE)NOV_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.NOV_FEE)NOV_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.DEC_FEE)DEC_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.DEC_FEE)DEC_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.DEC_FEE)DEC_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.JAN_FEE)JAN_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.JAN_FEE)JAN_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.JAN_FEE)JAN_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.FEB_FEE)FEB_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.FEB_FEE)FEB_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.FEB_FEE)FEB_FEE_AMT,(SELECT RECT_NO FROM daycoll WHERE RECT_NO=student.MAR_FEE)MAR_FEE_RECPT,(SELECT RECT_DATE FROM daycoll WHERE RECT_NO=student.MAR_FEE)MAR_FEE_DATE,(SELECT $fee FROM daycoll WHERE RECT_NO=student.MAR_FEE)MAR_FEE_AMT FROM `student` WHERE `CLASS` = '$class' AND `SEC` = '$sec' AND Student_Status='ACTIVE' ORDER BY $order");
		return $query->result();
	}
	public function category_data($class,$sec){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,DISP_SEC,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY = 1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')CAT1,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')CAT2,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=3 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')CAT3,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=4 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')CAT4,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=1 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')BOY_CAT1,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=1 AND student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')GIRL_CAT1,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=2 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')BOY_CAT2,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=2 AND student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')GIRL_CAT2,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=3 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')BOY_CAT3,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=3 AND student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')GIRLS_CAT3,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=4 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')BOY_CAT4,(SELECT COUNT(CATEGORY) FROM student WHERE student.CATEGORY=4 AND student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')GIRL_CAT4,(SELECT COUNT(CATEGORY) FROM student WHERE student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_BOYS,(SELECT COUNT(CATEGORY) FROM student WHERE student.SEX=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_GIRLS,(SELECT COUNT(CATEGORY) FROM student WHERE student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL FROM `student` st WHERE DISP_CLASS='$class' AND DISP_SEC='$sec' AND Student_Status='ACTIVE'");
		return $query->result();
	}
	public function category_data_all(){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,DISP_SEC,(SELECT COUNT(*) FROM student WHERE student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.SEX='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.SEX=2 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')FEMALE,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT1,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT2,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT3,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT4,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')CAT5 FROM `student` st WHERE Student_Status='ACTIVE' ORDER by CLASS");
		return $query->row();
	}
	public function religion_data($class,$sec){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,DISP_SEC,(SELECT COUNT(religion) FROM student WHERE student.religion=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_HINDU,(SELECT COUNT(religion) FROM student WHERE student.religion=1 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_HINDI,(SELECT COUNT(religion) FROM student WHERE student.religion=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MUSLIM,(SELECT COUNT(religion) FROM student WHERE student.religion=2 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_MUSLIM,(SELECT COUNT(religion) FROM student WHERE student.religion=3 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_CHRISTIAN,(SELECT COUNT(religion) FROM student WHERE student.religion=3 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_CHRISTIAN,(SELECT COUNT(religion) FROM student WHERE student.religion=4 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_SIKH,(SELECT COUNT(religion) FROM student WHERE student.religion=4 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_SIKH,(SELECT COUNT(religion) FROM student WHERE student.religion=5 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_BUDDHIST,(SELECT COUNT(religion) FROM student WHERE student.religion=5 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_BUDDHIST,(SELECT COUNT(religion) FROM student WHERE student.religion=6 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_JAIN,(SELECT COUNT(religion) FROM student WHERE student.religion=6 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_JAIN,(SELECT COUNT(religion) FROM student WHERE student.religion=7 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_OTHER,(SELECT COUNT(religion) FROM student WHERE student.religion=7 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_OTHER,(SELECT COUNT(religion) FROM student WHERE student.religion=8 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_OTHER2,(SELECT COUNT(religion) FROM student WHERE student.religion=8 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_OTHER2 FROM `student` st WHERE DISP_CLASS='$class' AND DISP_SEC='$sec' AND Student_Status='ACTIVE'");
		return $query->result();
	}
	public function religion_data_all($class){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,(SELECT COUNT(religion) FROM student WHERE student.religion=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_HINDU,(SELECT COUNT(religion) FROM student WHERE student.religion=1 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_HINDI,(SELECT COUNT(religion) FROM student WHERE student.religion=2 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MUSLIM,(SELECT COUNT(religion) FROM student WHERE student.religion=2 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_MUSLIM,(SELECT COUNT(religion) FROM student WHERE student.religion=3 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_CHRISTIAN,(SELECT COUNT(religion) FROM student WHERE student.religion=3 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_CHRISTIAN,(SELECT COUNT(religion) FROM student WHERE student.religion=4 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_SIKH,(SELECT COUNT(religion) FROM student WHERE student.religion=4 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_SIKH,(SELECT COUNT(religion) FROM student WHERE student.religion=5 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_BUDDHIST,(SELECT COUNT(religion) FROM student WHERE student.religion=5 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_BUDDHIST,(SELECT COUNT(religion) FROM student WHERE student.religion=6 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_JAIN,(SELECT COUNT(religion) FROM student WHERE student.religion=6 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_JAIN,(SELECT COUNT(religion) FROM student WHERE student.religion=7 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_OTHER,(SELECT COUNT(religion) FROM student WHERE student.religion=7 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_OTHER,(SELECT COUNT(religion) FROM student WHERE student.religion=8 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_OTHER2,(SELECT COUNT(religion) FROM student WHERE student.religion=8 AND student.SEX=1 AND student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTAL_MALE_OTHER2 FROM `student` st WHERE CLASS='$class' AND Student_Status='ACTIVE' ORDER by CLASS");
		return $query->row();
	}
	public function ward_data($class,$sec){
		$query = $this->db->query("SELECT DISTINCT DISP_CLASS,DISP_SEC,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=1 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=2 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD2,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=2 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD2,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=3 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD3,(SELECT COUNT(religion) FROM student WHERE student.EMP_WARD=3 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD3,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=4 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD4,(SELECT COUNT(religion) FROM student WHERE student.EMP_WARD=4 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD4,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=5 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD5,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=5 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD5,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=6 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_WARD6,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD=6 AND student.SEX=1 AND student.DISP_CLASS=st.DISP_CLASS AND student.DISP_SEC=st.DISP_SEC AND Student_Status='ACTIVE')TOTAL_MALE_WARD6 FROM student st WHERE DISP_CLASS='$class' AND DISP_SEC='$sec' AND Student_Status='ACTIVE'");
		return $query->result();
	}
	public function all_strength()
	{
		$query = $this->db->query("SELECT class,sec, DISP_CLASS,DISP_SEC,(SELECT COUNT(*) FROM student WHERE student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.SEX='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)MALE,(SELECT COUNT(*) FROM student WHERE student.SEX='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)FEMALE,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD2,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD3,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD4,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD5,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='6' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)WARD6,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT1,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT2,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT3,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT4,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT5,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='6' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND student.SEC=st.SEC)CAT6 FROM student st WHERE Student_Status='ACTIVE' and Sec NOT IN (21,22,23,24) group by  class,sec, DISP_CLASS,DISP_SEC");
		return $query->result();
	}
	public function classwise_strength_all()
	{
		$query = $this->db->query("SELECT class, DISP_CLASS,
(SELECT COUNT(*) FROM student WHERE student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))TOTALSTUDENT,
(SELECT COUNT(*) FROM student WHERE student.SEX='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))MALE,(SELECT COUNT(*) FROM student WHERE student.SEX='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))FEMALE,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))WARD2,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))WARD3,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))WARD4,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))WARD5,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='6' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))WARD6,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='1' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))CAT1,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='2' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))CAT2,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='3' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))CAT3,(SELECT COUNT(*)
 FROM student WHERE student.CATEGORY='4' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))CAT4,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='5' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))CAT5,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='6' AND student.CLASS=st.CLASS AND Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24))CAT6 FROM student st WHERE Student_Status='ACTIVE' AND SEC NOT IN (17,21,22,23,24) group by  class, DISP_CLASS;");
		return $query->result();
	}

	public function classwise_strength($class_code, $sec_code)
	{
		$query = $this->db->query("SELECT CLASS,DISP_CLASS,(SELECT COUNT(*) FROM student WHERE student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.SEX='1' AND student.CLASS=st.CLASS and student.SEC in($sec_code) AND student.Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.SEX='2' AND student.CLASS=st.CLASS and student.SEC in($sec_code) AND student.Student_Status='ACTIVE')FEMALE,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='1' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD='2' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE')WARD2,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='3' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD3,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='4' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD4,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='5' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD5,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='6' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD6,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='1' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT1,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='2' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT2,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='3' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT3,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='4' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT4,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='5' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT5,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='6' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT6 FROM student st WHERE st.Student_Status='ACTIVE' and st.CLASS in($class_code) and st.SEC in($sec_code) GROUP BY CLASS,DISP_CLASS");
		return $query->result();
	}
	
	public function classwise_strength_new($class_code,$sec_code){
		
		if($sec_code=='')
		{
			$sec_code='1,2,3,4,5,6';
			
		}
		else
		{
			
		}
		$query = $this->db->query("SELECT CLASS,DISP_CLASS,(SELECT COUNT(*) FROM student WHERE student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.SEX='1' AND student.CLASS=st.CLASS and student.SEC in($sec_code) AND student.Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.SEX='2' AND student.CLASS=st.CLASS and student.SEC in($sec_code) AND student.Student_Status='ACTIVE')FEMALE,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='1' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD1,(SELECT COUNT(EMP_WARD) FROM student WHERE student.EMP_WARD='2' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE')WARD2,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='3' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD3,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='4' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD4,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='5' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD5,(SELECT COUNT(*) FROM student WHERE student.EMP_WARD='6' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))WARD6,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='1' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT1,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='2' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT2,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='3' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT3,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='4' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT4,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='5' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT5,(SELECT COUNT(*) FROM student WHERE student.CATEGORY='6' AND student.CLASS=st.CLASS AND student.Student_Status='ACTIVE' and student.SEC in($sec_code))CAT6 FROM student st WHERE st.Student_Status='ACTIVE' and st.CLASS in($class_code) and st.SEC in($sec_code) GROUP BY CLASS,DISP_CLASS");
		//echo '<pre>'; print_r($data); echo '</pre>';die;
		//$str=$this->db->last_query();
		//echo $str;
		//die;
		return $query->result();
	}
	public function bus($id){
		$query = $this->db->query("select distinct bmstr.BusNo from STOPPAGE as stpg join busnomaster as bmstr on stpg.BUS_NO=bmstr.BusCode where stpg.BUS_NO='$id'");
		return $query->result();

	}
	public function period_wise_data($adm_no,$start_date,$end_date){
		$query = $this->db->query("SELECT DISTINCT att_date,admno,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=1 AND att_date=adf.att_date)P1,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=2 AND att_date=adf.att_date)P2,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=3 AND att_date=adf.att_date)P3,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=4 AND att_date=adf.att_date)P4,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=5 AND att_date=adf.att_date)P5,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=6 AND att_date=adf.att_date)P6,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=6 AND att_date=adf.att_date)P6,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=7 AND att_date=adf.att_date)P7,(SELECT att_status FROM stu_attendance_entry_periodwise WHERE admno=adf.admno AND period=8 AND att_date=adf.att_date)P8 FROM `stu_attendance_entry_periodwise` adf WHERE admno='$adm_no' AND att_date BETWEEN '$start_date' AND '$end_date' ORDER by att_date desc");
		return $query->result();
	}
	public function show_student($id){
		$query = $this->db->query("SELECT student.student_transport_facility_id,student.route_id,student.ADM_CLASS AS ADM_CLASS,student.STUDENTID AS ID,student.HOSTEL AS HOSTEL_STATUS,student.COMPUTER AS COUMPUTER_STATUS,student.MUSIC AS MUSIC_STATUS,student.FREESHIP AS FREESHIP_STATUS,student.LETTERNO AS FREESHIP_MONTH,student.math_lab AS HANDICAP,student.ADM_NO AS ADMISSION_NO,student.ADM_DATE AS ADMISSION_DATE,student.FIRST_NM AS STUDENT_NAME,classes.CLASS_NM AS CLASS_NAME,sections.SECTION_NAME AS SECTION_NAME,student.ADM_SEC AS ADM_SEC,student.DISP_CLASS AS CURRENT_CLASS,student.DISP_SEC AS CURRENT_SECTION,student.ROLL_NO AS ROLL_NO,student.SEX AS GENDER,student.BIRTH_DT AS DATE_OF_BIRTH,category.CAT_ABBR CATEGORY,house.HOUSENAME AS HOUSE_NAME,eward.HOUSENAME AS EMPLOYEE_WARD,stoppage.STOPPAGE AS BUSSTOPAGE,student.BLOOD_GRP AS BLOOD_GROUP,student.Fee_Book_No AS ACCOUNT_NUMBER,student.Bus_Book_No AS AADHAR_NUMBER,student.student_image AS STUDENT_IMAGE,religion.Rname AS RELIGION,student.BUS_NO AS SCIENCE_FEE,student.FATHER_NM AS FATHERNAME,student.MOTHER_NM AS MOTHERNAME,student.PERM_ADD AS PERADD,student.P_CITY AS PERCITY,student.P_STATE AS PERSTATE,student.p_NATION AS PERNATION,student.P_PIN AS PERPIN,student.P_PHONE1 AS PERPHONE1,student.P_PHONE2 AS PERPHONE2,student.P_FAXNO AS PERFAX,student.P_MOBILE AS PERMOBILE,student.p_EMAIL AS PEREMAIL,student.CORR_ADD AS CROSSADD,student.C_CITY AS CROSSCITY,student.C_STATE AS CROSSSTATE,student.C_NATION AS CROSSNATION,student.C_PIN AS CROSSPIN,student.LAST_SCH AS LAST_SCHOOL,student.LSCH_ADD AS LSCH_ADD,student.C_MOBILE AS CROSSMOBILE,student.C_PHONE1 AS CROSSPHONE1,student.C_PHONE2 AS CROSSPHONE2,student.C_FAXNO AS CROSSFAX,student.C_EMAIL AS CROSSEMAIL,student.SUBJECT1 AS SUBJECT1,student.SUBJECT2 AS SUBJECT2,student.SUBJECT3 AS SUBJECT3,student.SUBJECT4 AS SUBJECT4,student.SUBJECT5 AS SUBJECT5,student.SUBJECT6 AS SUBJECT6,student.CBSE_REG AS CBSEREGISTRATION,student.CBSE_ROLL AS CBSEROLL,student.APR_FEE AS APRILFEE,student.MAY_FEE AS MAYFEE,student.JUNE_FEE AS JUNEFEE,student.JULY_FEE AS JULYFEE,student.AUG_FEE AS AUGUSTFEE,student.SEP_FEE AS SEPTEMBERFEE,student.OCT_FEE AS OCTOBERFEE,student.NOV_FEE AS NOVEMBERFEE,student.DEC_FEE AS DECEMBERFEE,student.JAN_FEE AS JANUARYFEE,student.FEB_FEE AS FEBRUARYFEE,student.MAR_FEE AS MARCHFEE,student.oldadmno AS HANDICAP_NATURE,student.CLASS AS CURRENT_CLASS_CODE,student.SEC AS CURRENT_SEC_CODE,student.CATEGORY AS CATEGORY_CODE,student.HOUSE_CODE AS HOUSE_CODE,student.EMP_WARD AS EMP_CODE,student.STOPNO AS STOPPAGE_CODE,student.religion AS RELIGION_CODE FROM (((((((student LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No)LEFT JOIN sections ON student.ADM_SEC=sections.section_no)LEFT JOIN category ON student.CATEGORY=category.CAT_CODE)LEFT JOIN house ON student.HOUSE_CODE=house.HOUSENO)LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO)LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN religion ON student.religion=religion.RNo) WHERE student.adm_No='$id'");
		return $query->result();

	}
	
	
	public function show_student_new($id){
		$query = $this->db->query("SELECT student.student_transport_facility_id,(SELECT BUSNO FROM `busnomaster` WHERE BusCode = (SELECT BUSCODE FROM `bus_route_master` WHERE STOPNO = student.STOPNO )) AS BUSNO,student.route_id,student.ADM_CLASS AS ADM_CLASS,student.STUDENTID AS ID,student.HOSTEL AS HOSTEL_STATUS,student.COMPUTER AS COUMPUTER_STATUS,student.MUSIC AS MUSIC_STATUS, student.FREESHIP AS FREESHIP_STATUS,student.LETTERNO AS FREESHIP_MONTH,student.math_lab AS HANDICAP,student.ADM_NO AS ADMISSION_NO,student.ADM_DATE AS ADMISSION_DATE,student.FIRST_NM AS STUDENT_NAME,classes.CLASS_NM AS CLASS_NAME,sections.SECTION_NAME AS SECTION_NAME,student.ADM_SEC AS ADM_SEC,student.DISP_CLASS AS CURRENT_CLASS,student.DISP_SEC AS CURRENT_SECTION,student.ROLL_NO AS ROLL_NO,student.SEX AS GENDER,student.BIRTH_DT AS DATE_OF_BIRTH,category.CAT_ABBR CATEGORY,house.HOUSENAME AS HOUSE_NAME,eward.HOUSENAME AS EMPLOYEE_WARD,stoppage.STOPPAGE AS BUSSTOPAGE,student.BLOOD_GRP AS BLOOD_GROUP,student.Fee_Book_No AS ACCOUNT_NUMBER,student.Bus_Book_No AS AADHAR_NUMBER,student.student_image AS STUDENT_IMAGE,religion.Rname AS RELIGION,student.BUS_NO AS SCIENCE_FEE,student.FATHER_NM AS FATHERNAME,student.MOTHER_NM AS MOTHERNAME,student.PERM_ADD AS PERADD,student.P_CITY AS PERCITY,student.P_STATE AS PERSTATE,student.p_NATION AS PERNATION,student.P_PIN AS PERPIN,student.P_PHONE1 AS PERPHONE1,student.P_PHONE2 AS PERPHONE2,student.P_FAXNO AS PERFAX,student.P_MOBILE AS PERMOBILE,student.p_EMAIL AS PEREMAIL,student.CORR_ADD AS CROSSADD,student.C_CITY AS CROSSCITY,student.C_STATE AS CROSSSTATE,student.C_NATION AS CROSSNATION,student.C_PIN AS CROSSPIN,student.LAST_SCH AS LAST_SCHOOL,student.LSCH_ADD AS LSCH_ADD,student.C_MOBILE AS CROSSMOBILE,student.C_PHONE1 AS CROSSPHONE1,student.C_PHONE2 AS CROSSPHONE2,student.C_FAXNO AS CROSSFAX,student.C_EMAIL AS CROSSEMAIL,student.SUBJECT1 AS SUBJECT1,student.SUBJECT2 AS SUBJECT2,student.SUBJECT3 AS SUBJECT3,student.SUBJECT4 AS SUBJECT4,student.SUBJECT5 AS SUBJECT5,student.SUBJECT6 AS SUBJECT6,student.CBSE_REG AS CBSEREGISTRATION,student.CBSE_ROLL AS CBSEROLL,student.APR_FEE AS APRILFEE,student.MAY_FEE AS MAYFEE,student.JUNE_FEE AS JUNEFEE,student.JULY_FEE AS JULYFEE,student.AUG_FEE AS AUGUSTFEE,student.SEP_FEE AS SEPTEMBERFEE,student.OCT_FEE AS OCTOBERFEE,student.NOV_FEE AS NOVEMBERFEE,student.DEC_FEE AS DECEMBERFEE,student.JAN_FEE AS JANUARYFEE,student.FEB_FEE AS FEBRUARYFEE,student.MAR_FEE AS MARCHFEE,student.oldadmno AS HANDICAP_NATURE,student.CLASS AS CURRENT_CLASS_CODE,student.SEC AS CURRENT_SEC_CODE,student.CATEGORY AS CATEGORY_CODE,student.HOUSE_CODE AS HOUSE_CODE,student.EMP_WARD AS EMP_CODE,student.STOPNO AS STOPPAGE_CODE,student.religion AS RELIGION_CODE,student.PEN AS PEN, APAR_ID AS APAR_ID FROM (((((((student LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No)LEFT JOIN sections ON student.ADM_SEC=sections.section_no)LEFT JOIN category ON student.CATEGORY=category.CAT_CODE)LEFT JOIN house ON student.HOUSE_CODE=house.HOUSENO)LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO)LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN religion ON student.religion=religion.RNo) WHERE student.studentid='$id'");
		return $query->result();

	}
	public function student_information($class,$sec,$short_by){
			if($sec !=0){
		$cnd="AND student.SEC='$sec'";
		}else{
		$cnd="";
		}
		$query = $this->db->query("SELECT
		(select sum(fee1) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee1,
		(select sum(fee2) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee2,
		(select sum(fee3) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee3,
		(select sum(fee4) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee4,
		(select sum(fee5) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee5,
		(select sum(fee6) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee6,
		(select sum(fee7) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee7,
		(select sum(fee8) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee8,
		(select sum(fee9) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee9,
		(select sum(fee10) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee10,
		(select sum(fee11) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee11,
		(select sum(fee12) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee12,
		(select sum(fee13) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee13,
		(select sum(fee14) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee14,
		(select sum(fee15) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee15,
		(select sum(fee16) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee16,
		(select sum(fee17) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee17,
		(select sum(fee18) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee18,
		(select sum(fee19) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee19,
		(select sum(fee20) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee20,
		student.ADM_CLASS AS ADM_CLASS,student.STUDENTID AS ID,student.HOSTEL AS HOSTEL_STATUS,student.COMPUTER AS COUMPUTER_STATUS,student.FREESHIP AS FREESHIP_STATUS,student.LETTERNO AS FREESHIP_MONTH,student.math_lab AS HANDICAP,student.ADM_NO AS ADMISSION_NO,student.ADM_DATE AS ADMISSION_DATE,student.FIRST_NM AS STUDENT_NAME,classes.CLASS_NM AS CLASS_NAME,sections.SECTION_NAME AS SECTION_NAME,student.ADM_SEC AS ADM_SEC,student.DISP_CLASS AS CURRENT_CLASS,student.DISP_SEC AS CURRENT_SECTION,student.ROLL_NO AS ROLL_NO,student.SEX AS GENDER,student.BIRTH_DT AS DATE_OF_BIRTH,category.CAT_ABBR CATEGORY,house.HOUSENAME AS HOUSE_NAME,eward.HOUSENAME AS EMPLOYEE_WARD,stoppage.STOPPAGE AS BUSSTOPAGE,student.BLOOD_GRP AS BLOOD_GROUP,student.Fee_Book_No AS ACCOUNT_NUMBER,student.Bus_Book_No AS AADHAR_NUMBER,student.student_image AS STUDENT_IMAGE,religion.Rname AS RELIGION,student.BUS_NO AS SCIENCE_FEE,student.FATHER_NM AS FATHERNAME,student.MOTHER_NM AS MOTHERNAME,student.PERM_ADD AS PERADD,student.P_CITY AS PERCITY,student.P_STATE AS PERSTATE,student.p_NATION AS PERNATION,student.P_PIN AS PERPIN,student.P_PHONE1 AS PERPHONE1,student.P_PHONE2 AS PERPHONE2,student.P_FAXNO AS PERFAX,student.P_MOBILE AS PERMOBILE,student.p_EMAIL AS PEREMAIL,student.CORR_ADD AS CROSSADD,student.C_CITY AS CROSSCITY,student.C_STATE AS CROSSSTATE,student.C_NATION AS CROSSNATION,student.C_PIN AS CROSSPIN,student.LAST_SCH AS LAST_SCHOOL,student.LSCH_ADD AS LSCH_ADD,student.C_MOBILE AS CROSSMOBILE,student.C_PHONE1 AS CROSSPHONE1,student.C_PHONE2 AS CROSSPHONE2,student.C_FAXNO AS CROSSFAX,student.C_EMAIL AS CROSSEMAIL,student.SUBJECT1 AS SUBJECT1,student.SUBJECT2 AS SUBJECT2,student.SUBJECT3 AS SUBJECT3,student.SUBJECT4 AS SUBJECT4,student.SUBJECT5 AS SUBJECT5,student.SUBJECT6 AS SUBJECT6,student.CBSE_REG AS CBSEREGISTRATION,student.CBSE_ROLL AS CBSEROLL,student.APR_FEE AS APRILFEE,student.MAY_FEE AS MAYFEE,student.JUNE_FEE AS JUNEFEE,student.JULY_FEE AS JULYFEE,student.AUG_FEE AS AUGUSTFEE,student.SEP_FEE AS SEPTEMBERFEE,student.OCT_FEE AS OCTOBERFEE,student.NOV_FEE AS NOVEMBERFEE,student.DEC_FEE AS DECEMBERFEE,student.JAN_FEE AS JANUARYFEE,student.FEB_FEE AS FEBRUARYFEE,student.MAR_FEE AS MARCHFEE,student.oldadmno AS HANDICAP_NATURE,student.CLASS AS CURRENT_CLASS_CODE,student.SEC AS CURRENT_SEC_CODE,student.CATEGORY AS CATEGORY_CODE,student.HOUSE_CODE AS HOUSE_CODE,student.EMP_WARD AS EMP_CODE,student.STOPNO AS STOPPAGE_CODE,student.religion AS RELIGION_CODE FROM (((((((student LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No)LEFT JOIN sections ON student.ADM_SEC=sections.section_no)LEFT JOIN category ON student.CATEGORY=category.CAT_CODE)LEFT JOIN house ON student.HOUSE_CODE=house.HOUSENO)LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO)LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN religion ON student.religion=religion.RNo)
WHERE student.class='$class' $cnd AND Student_Status='ACTIVE' ORDER BY $short_by");
		
		return $query->result();
		
	

	}
	
	public function student_information_all($short_by){
		$query = $this->db->query("SELECT 
		(select sum(fee1) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee1,
		(select sum(fee2) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee2,
		(select sum(fee3) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee3,
		(select sum(fee4) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee4,
		(select sum(fee5) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee5,
		(select sum(fee6) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee6,
		(select sum(fee7) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee7,
		(select sum(fee8) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee8,
		(select sum(fee9) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee9,
		(select sum(fee10) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee10,
		(select sum(fee11) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee11,
		(select sum(fee12) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee12,
		(select sum(fee13) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee13,
		(select sum(fee14) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee14,
		(select sum(fee15) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee15,
		(select sum(fee16) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee16,
		(select sum(fee17) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee17,
		(select sum(fee18) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee18,
		(select sum(fee19) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee19,
		(select sum(fee20) from daycoll where adm_no=student.ADM_NO and period not like 'PRE%')fee20,
		student.ADM_CLASS AS ADM_CLASS,student.STUDENTID AS ID,student.HOSTEL AS HOSTEL_STATUS,student.COMPUTER AS COUMPUTER_STATUS,student.FREESHIP AS FREESHIP_STATUS,student.LETTERNO AS FREESHIP_MONTH,student.math_lab AS HANDICAP,student.ADM_NO AS ADMISSION_NO,student.ADM_DATE AS ADMISSION_DATE,student.FIRST_NM AS STUDENT_NAME,classes.CLASS_NM AS CLASS_NAME,sections.SECTION_NAME AS SECTION_NAME,student.ADM_SEC AS ADM_SEC,student.DISP_CLASS AS CURRENT_CLASS,student.DISP_SEC AS CURRENT_SECTION,student.ROLL_NO AS ROLL_NO,student.SEX AS GENDER,student.BIRTH_DT AS DATE_OF_BIRTH,category.CAT_ABBR CATEGORY,house.HOUSENAME AS HOUSE_NAME,eward.HOUSENAME AS EMPLOYEE_WARD,stoppage.STOPPAGE AS BUSSTOPAGE,student.BLOOD_GRP AS BLOOD_GROUP,student.Fee_Book_No AS ACCOUNT_NUMBER,student.Bus_Book_No AS AADHAR_NUMBER,student.student_image AS STUDENT_IMAGE,religion.Rname AS RELIGION,student.BUS_NO AS SCIENCE_FEE,student.FATHER_NM AS FATHERNAME,student.MOTHER_NM AS MOTHERNAME,student.PERM_ADD AS PERADD,student.P_CITY AS PERCITY,student.P_STATE AS PERSTATE,student.p_NATION AS PERNATION,student.P_PIN AS PERPIN,student.P_PHONE1 AS PERPHONE1,student.P_PHONE2 AS PERPHONE2,student.P_FAXNO AS PERFAX,student.P_MOBILE AS PERMOBILE,student.p_EMAIL AS PEREMAIL,student.CORR_ADD AS CROSSADD,student.C_CITY AS CROSSCITY,student.C_STATE AS CROSSSTATE,student.C_NATION AS CROSSNATION,student.C_PIN AS CROSSPIN,student.LAST_SCH AS LAST_SCHOOL,student.LSCH_ADD AS LSCH_ADD,student.C_MOBILE AS CROSSMOBILE,student.C_PHONE1 AS CROSSPHONE1,student.C_PHONE2 AS CROSSPHONE2,student.C_FAXNO AS CROSSFAX,student.C_EMAIL AS CROSSEMAIL,student.SUBJECT1 AS SUBJECT1,student.SUBJECT2 AS SUBJECT2,student.SUBJECT3 AS SUBJECT3,student.SUBJECT4 AS SUBJECT4,student.SUBJECT5 AS SUBJECT5,student.SUBJECT6 AS SUBJECT6,student.CBSE_REG AS CBSEREGISTRATION,student.CBSE_ROLL AS CBSEROLL,student.APR_FEE AS APRILFEE,student.MAY_FEE AS MAYFEE,student.JUNE_FEE AS JUNEFEE,student.JULY_FEE AS JULYFEE,student.AUG_FEE AS AUGUSTFEE,student.SEP_FEE AS SEPTEMBERFEE,student.OCT_FEE AS OCTOBERFEE,student.NOV_FEE AS NOVEMBERFEE,student.DEC_FEE AS DECEMBERFEE,student.JAN_FEE AS JANUARYFEE,student.FEB_FEE AS FEBRUARYFEE,student.MAR_FEE AS MARCHFEE,student.oldadmno AS HANDICAP_NATURE,student.CLASS AS CURRENT_CLASS_CODE,student.SEC AS CURRENT_SEC_CODE,student.CATEGORY AS CATEGORY_CODE,student.HOUSE_CODE AS HOUSE_CODE,student.EMP_WARD AS EMP_CODE,student.STOPNO AS STOPPAGE_CODE,student.religion AS RELIGION_CODE FROM (((((((student LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No)LEFT JOIN sections ON student.ADM_SEC=sections.section_no)LEFT JOIN category ON student.CATEGORY=category.CAT_CODE)LEFT JOIN house ON student.HOUSE_CODE=house.HOUSENO)LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO)LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN religion ON student.religion=religion.RNo) WHERE  Student_Status='ACTIVE' ORDER BY $short_by");
		return $query->result();

	}
	
	
	
	
	public function tc_issue($id){
		$query = $this->db->query("SELECT student.ADM_DATE,student.SUBJECT1,student.SUBJECT2,student.SUBJECT3,student.SUBJECT4,student.SUBJECT5,student.SUBJECT6,student.FIRST_NM,student.MOTHER_NM,student.FATHER_NM,student.FIRST_NM,student.DISP_CLASS,student.NATION,student.BIRTH_DT,classes.CLASS_NM AS ADM_CLASSS,student.CBSE_REG,student.CBSE_ROLL,student.ADM_NO,category.CAT_ABBR,student.PEN, student.APAR_ID FROM ((student LEFT JOIN category ON category.CAT_CODE=student.CATEGORY) LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No) WHERE student.ADM_NO='$id'");
		return $query->row();
	}
	
	public function tc_issue_back($id,$back_database){
		$query = $this->db->query("SELECT student.FIRST_NM,student.MOTHER_NM,student.FATHER_NM,student.DISP_CLASS,student.SUBJECT1,student.SUBJECT2,student.SUBJECT3,student.SUBJECT4,student.SUBJECT5,student.SUBJECT6,student.ADM_DATE,student.FIRST_NM,student.NATION,student.BIRTH_DT,classes.CLASS_NM AS ADM_CLASSS,student.CBSE_REG,student.CBSE_ROLL,student.ADM_NO,category.CAT_ABBR,student.PEN FROM (($back_database.student LEFT JOIN $back_database.category ON category.CAT_CODE=student.CATEGORY) LEFT JOIN $back_database.classes ON student.ADM_CLASS=classes.Class_No) WHERE student.ADM_NO='$id'");
		return $query->row();
	}
	
	function get_student($tbl, $adm_no)
	{

		$sql = "SELECT student.ADM_DATE,student.SUBJECT1,student.SUBJECT2,student.SUBJECT3,student.SUBJECT4,student.SUBJECT5,student.SUBJECT6,student.FIRST_NM,student.MOTHER_NM,student.FATHER_NM,student.FIRST_NM,student.DISP_CLASS,student.NATION,student.BIRTH_DT,classes.CLASS_NM AS ADM_CLASSS,student.CBSE_REG,student.CBSE_ROLL,student.ADM_NO,category.CAT_ABBR,student.PEN, student.APAR_ID FROM (($tbl student
			LEFT JOIN category ON category.CAT_CODE=student.CATEGORY) 
		    LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No) 
		
		 WHERE student.ADM_NO=?";

				$query = $this->db->query($sql, array($adm_no));
		if ($query->num_rows() == 0)	return FALSE;
		return $query->row();
	}
	
	public function subjwiseallco($class){
		$query = $this->db->query("SELECT cswsa.subj_nm,cswsa.opt_code,cswsa.Class_No,cswsa.subject_code,cswsa.sorting_no FROM `class_section_wise_subject_allocation` as cswsa left join marks on Class_No=marks.Classes AND cswsa.subject_code=marks.SCode where cswsa.Class_No = '$class' AND cswsa.applicable_exam = '1' group by cswsa.subj_nm,cswsa.opt_code,cswsa.Class_No,cswsa.subject_code,cswsa.sorting_no order by cswsa.sorting_no");
		return $query->result();
	}

	public function subjcnt($subjname,$classs){
		$query = $this->db->query("SELECT DISTINCT subj_nm,opt_code FROM `class_section_wise_subject_allocation` where Class_No = '$classs' AND subj_nm = '$subjname' AND applicable_exam = '1'");
		return $query->result();
	}
	
	public function stu_list_subj_allocation300924($classs,$sec){
		$query = $this->db->query("SELECT stu.ADM_no,stu.FIRST_NM,stu.ROLL_NO,(select SUBCODE from studentsubject where Adm_no=stu.adm_no)subcodee,(SELECT SubName FROM subjects WHERE SubCode = (select SUBCODE from studentsubject where Adm_no=stu.adm_no))subnm FROM `student` as stu  WHERE stu.`CLASS` = '$classs' AND stu.`SEC` = '$sec' AND stu.`Student_Status` = 'ACTIVE' ORDER by ROLL_NO");
		return $query->result();
	}
	
	public function stu_list_subj_allocation($classs,$sec){
		$query = $this->db->query("SELECT stu.ADM_no,stu.FIRST_NM,stu.ROLL_NO, (select SUBCODE from studentsubject where Adm_no=stu.adm_no and optcode =5 )subcodee5, (SELECT SubName FROM subjects WHERE SubCode = (select SUBCODE from studentsubject where Adm_no=stu.adm_no and optcode =5 ))subnm5, (select SUBCODE from studentsubject where Adm_no=stu.adm_no and optcode =6 )subcodee6, (SELECT SubName FROM subjects WHERE SubCode = (select SUBCODE from studentsubject where Adm_no=stu.adm_no and optcode =6 ))subnm6 FROM `student` as stu WHERE stu.`CLASS` = '$classs' AND stu.`SEC` = '$sec' AND stu.`Student_Status` = 'ACTIVE' ORDER by ROLL_NO;");
		return $query->result();
	}

	public function feeclw($id)
	{
		$query = $this->db->query("SELECT fee_clw.FH,fee_clw.CL,classes.CLASS_NM,fee_clw.AMOUNT,fee_clw.EMP,fee_clw.CCL,fee_clw.SPL,fee_clw.EXT,fee_clw.INTERNAL FROM ( fee_clw LEFT JOIN classes ON fee_clw.CL=classes.Class_No )WHERE fee_clw.FH='$id' ORDER BY fee_clw.CL");
		return $query->result();
	}
	
	public function max_mrks_allco_trem($classes,$trm,$board){
		$query = $this->db->query("SELECT ExamCode,(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)exmnm,(select SubName from subjects where SubCode=maxmarks.teacher_code)subnm,teacher_code,MaxMarks FROM `maxmarks` where ClassCode = '$classes' AND ExamCode = '$board' ORDER BY ExamCode");
		return $query->result();
	}
	
	// public function max_mrks_allco_exam($classcode,$term,$exammode,$examcode){
	// 	$query = $this->db->query("SELECT ExamCode,(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)exmnm,(select SubName from subjects where SubCode=maxmarks.teacher_code)subnm,teacher_code,MaxMarks FROM `maxmarks` where ClassCode = '$classcode' AND ExamCode = '$examcode' ORDER BY teacher_code");
	// 	return $query->result();
	// }
	public function max_mrks_allco_exam($classcode,$term,$exammode,$examcode){
		$query = $this->db->query("SELECT ExamCode,(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)exmnm,(select SubName from subjects where SubCode=maxmarks.teacher_code)subnm,teacher_code,MaxMarks FROM `maxmarks` where ClassCode = '$classcode' AND ExamCode = '$examcode' ORDER BY teacher_code");
		return $query->result();
	}
	
	
	public function max_mrks_allco_exam_prep($classcode,$term,$examcode){
		$query = $this->db->query("SELECT examcode,(select examname from exammasterprep where examcode=maxmarks_all.examcode)exmnm,subject,(select SubName from subjects where SubCode=maxmarks_all.subject)subnm,subject,subj_skill_mstr_id,(select skill_name from subject_skill_master where id=maxmarks_all.subj_skill_mstr_id)skillnm,maxmarks FROM `maxmarks_all` where class_code = '$classcode' AND term = '$term' AND examcode = '$examcode' ORDER BY subject");
		return $query->result();
	}
	
	public function half_year_subject($ExamCode,$Class_No,$ExamMode){
		$query = $this->db->query("Select distinct(subj_nm),opt_code,subject_code from class_section_wise_subject_allocation where `class_no`='$Class_No' AND `Subject_Code` in(Select teacher_code FROM `maxmarks` WHERE ClassCode = '$Class_No' AND ExamMode = '$ExamMode' AND term = 'TERM-1' AND ExamCode = '$ExamCode')");
		return $query->result();
	}
	
	public function half_year_subject2($ExamCode,$Class_No,$ExamMode){
		$query = $this->db->query("Select distinct(subj_nm),opt_code,subject_code from class_section_wise_subject_allocation where `class_no`='$Class_No' AND `Subject_Code` in(Select teacher_code FROM `maxmarks` WHERE ClassCode = '$Class_No' AND ExamMode = '$ExamMode' AND term = 'TERM-2' AND ExamCode = '$ExamCode')");
		return $query->result();
	}
	
	public function half_year_stu_tbl_list($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.`ADM_NO`,st.`FIRST_NM`,st.`ROLL_NO`,
		(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-1')mrks2 FROM `student` as st where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stu_tbl_list_new($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("select t1.*,t2.m2 from 
		(SELECT student.ADM_NO,student.CLASS,student.SEC,student.ROLL_NO,student.FIRST_NM FROM `student` where student.CLASS='$Class_No' AND student.SEC='$sec' AND student.Student_Status = 'ACTIVE' order by student.$sortval) as t1
		LEFT JOIN 
		(select marks.M2,marks.admno from marks where marks.examc='$exm_code' and marks.SCode='$subcode')as t2
		on t1.ADM_NO=t2.admno order by t1.$sortval;");
		return $query->result();
	}
	
	public function half_year_stu_tbl_list2($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.`ADM_NO`,st.`FIRST_NM`,st.`ROLL_NO`,(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-2')mrks2 FROM `student` as st where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stu_tbl_list2t1($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.`ADM_NO`,st.`FIRST_NM`,st.`ROLL_NO`,(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-1')mrks2 FROM `student` as st where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stusub_tbl_list($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.ADM_NO,st.FIRST_NM,st.ROLL_NO,
		(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-1')mrks2 FROM `student` as st join studentsubject as ss on st.ADM_NO=ss.Adm_no where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND ss.SUBCODE = '$subcode' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stusub_tbl_list_xii($Class_No,$sec,$sortval,$exm_code,$subcode){
		//$Class_No=$Class_No+1;
		$query = $this->db->query("SELECT st.ADM_NO,st.FIRST_NM,st.ROLL_NO,
		(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-2')mrks2 FROM `student` as st join studentsubject_xii as ss on st.ADM_NO=ss.Adm_no where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND ss.SUBCODE = '$subcode' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stusub_tbl_listt1($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.ADM_NO,st.FIRST_NM,st.ROLL_NO,(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-1')mrks2 FROM `student` as st join studentsubject as ss on st.ADM_NO=ss.Adm_no where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND ss.SUBCODE = '$subcode' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stusub_tbl_list2t1($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.ADM_NO,st.FIRST_NM,st.ROLL_NO,(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-1')mrks2 FROM `student` as st join studentsubject as ss on st.ADM_NO=ss.Adm_no where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND ss.SUBCODE = '$subcode' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	public function half_year_stusub_tbl_list2($Class_No,$sec,$sortval,$exm_code,$subcode){
		$query = $this->db->query("SELECT st.ADM_NO,st.FIRST_NM,st.ROLL_NO,(SELECT M2 from marks where admno=st.ADM_NO AND Classes=st.CLASS and Sec=st.SEC and ExamC='$exm_code' and SCode='$subcode' and term='TERM-2')mrks2 FROM `student` as st join studentsubject as ss on st.ADM_NO=ss.Adm_no where st.`CLASS`='$Class_No' AND st.`SEC`='$sec' AND ss.SUBCODE = '$subcode' AND st.`Student_Status`='ACTIVE' order by st.$sortval");
		return $query->result();
	}
	
	
	public function misc_collection($admno)
	{
		$query = $this->db->query("SELECT student.ADM_DATE,student.ROLL_NO,student.DISP_CLASS,student.DISP_SEC,stoppage.STOPPAGE,stop_amt.AMT,student.FIRST_NM,student.FATHER_NM,student.STUDENTID,eward.HOUSENAME FROM(((student LEFT JOIN eward on student.EMP_WARD=eward.HOUSENO) LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN stop_amt ON student.STOPNO=stop_amt.STOP_NO)WHERE student.ADM_NO='$admno'");
		return $query->result();
	}

	public function monthly_collection($admno)
	{
		$query = $this->db->query("SELECT student.ADM_DATE,student.ADM_NO,student.FIRST_NM,student.STUDENTID,student.FATHER_NM,student.MOTHER_NM,student.DISP_CLASS,(select distinct(CLASS) from previous_year_feegeneration where ADM_NO='$admno')cls,student.DISP_SEC,student.ROLL_NO,eward.HOUSENAME,stoppage.STOPPAGE,stop_amt.AMT,student.APR_FEE,student.MAY_FEE,student.JUNE_FEE,student.JULY_FEE,student.AUG_FEE,student.SEP_FEE,student.OCT_FEE,student.NOV_FEE,student.DEC_FEE,student.JAN_FEE,student.FEB_FEE,student.MAR_FEE FROM(((student LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO) LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN stop_amt ON student.STOPNO=stop_amt.STOP_NO) WHERE student.ADM_NO='$admno'");
		return $query->result();
	}
	public function bus_master_show(){
		$query = $this->db->query("SELECT stoppage.STOPNO,stoppage.STOPPAGE,stop_amt.AMT,stop_amt.APR_FEE,stop_amt.MAY_FEE,stop_amt.JUN_FEE,stop_amt.JUL_FEE,stop_amt.AUG_FEE,stop_amt.SEP_FEE,stop_amt.OCT_FEE,stop_amt.NOV_FEE,stop_amt.DEC_FEE,stop_amt.JAN_FEE,stop_amt.FEB_FEE,stop_amt.MAR_FEE FROM (stoppage LEFT JOIN stop_amt ON stoppage.STOPNO=stop_amt.STOP_NO) ORDER BY stoppage.STOPNO");
		return $query->result();
	}
	public function edit_busmaster($id){
		$query = $this->db->query("SELECT stoppage.STOPNO,stoppage.STOPPAGE,stop_amt.AMT,stop_amt.APR_FEE,stop_amt.MAY_FEE,stop_amt.JUN_FEE,stop_amt.JUL_FEE,stop_amt.AUG_FEE,stop_amt.SEP_FEE,stop_amt.OCT_FEE,stop_amt.NOV_FEE,stop_amt.DEC_FEE,stop_amt.JAN_FEE,stop_amt.FEB_FEE,stop_amt.MAR_FEE FROM (stoppage LEFT JOIN stop_amt ON stoppage.STOPNO=stop_amt.STOP_NO) WHERE stoppage.STOPNO='$id'");
		return $query->result();
	}
	public function del_pre_fee_generation($mon,$adm){
		$query = $this->db->query("DELETE FROM previous_year_feegeneration WHERE Month_NM='$mon' AND ADM_NO='$adm'");
		return true;
	}
	public function dist_data($table,$column){
		$query = $this->db->query("SELECT DISTINCT($column) FROM `$table` ORDER BY $column");
		return $query->result();
	}
	public function data_orderby($table, $orderby){
		$query = $this->db->query("SELECT * FROM `$table` ORDER BY $orderby");
		return $query->result();
	}
	public function driver_master_details(){
		$query = $this->db->query("SELECT driver_master.Driver_ID,driver_master.BusCode,busnomaster.BusNo,driver_master.driver_name,driver_master.driver_address,driver_master.driver_dob,driver_master.driver_ph_no,driver_master.driver_license_no,driver_master.trip_id,bus_trip_master.Trip_Nm,driver_master.khallasi_nm,driver_master.khallasi_ph_no,bus_incharge_master.Incharge_nm,bus_incharge_master.Incharge_ph_no,driver_master.incharge_id FROM(((driver_master LEFT JOIN busnomaster ON driver_master.BusCode=busnomaster.BusCode) LEFT JOIN bus_incharge_master ON bus_incharge_master.Incharge_Id=driver_master.incharge_id) LEFT JOIN bus_trip_master ON bus_trip_master.Trip_ID=driver_master.trip_id)");
		return $query->result();
	}
	public function edit_driver($id)
	{
		$query = $this->db->query("SELECT driver_master.Driver_ID,driver_master.driver_empid,driver_master.khallasi_empid,driver_master.BusCode,busnomaster.BusNo,driver_master.driver_name,driver_master.driver_address,driver_master.driver_dob,driver_master.driver_ph_no,driver_master.driver_license_no,driver_master.trip_id,bus_trip_master.Trip_Nm,driver_master.khallasi_nm,driver_master.khallasi_ph_no,bus_incharge_master.Incharge_nm,bus_incharge_master.Incharge_ph_no,driver_master.incharge_id FROM(((driver_master LEFT JOIN busnomaster ON driver_master.BusCode=busnomaster.BusCode) LEFT JOIN bus_incharge_master ON bus_incharge_master.Incharge_Id=driver_master.incharge_id) LEFT JOIN bus_trip_master ON bus_trip_master.Trip_ID=driver_master.trip_id) WHERE driver_master.Driver_ID='$id'");
		return $query->row();
	}
public function senior_rectno(){
		$query = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(RECT_NO),3) AS UNSIGNED)+1) MAX_NUMBER FROM daycoll WHERE RECT_NO LIKE '%ST%'");
		return $query->result();
	}
	public function junior_rectno(){
		$query = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(RECT_NO),3) AS UNSIGNED)+1) MAX_NUMBER FROM daycoll WHERE RECT_NO LIKE '%JTE'");
		return $query->result();
	}
	public function recpt_numeric_Details($counter){
		$query = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(RECT_NO),2) AS UNSIGNED)+1) MAX_NUMBER FROM daycoll WHERE RECT_NO LIKE '%$counter%'");
		return $query->result();
	}
	public function getbusstoppagedetails($buscode,$tripid,$preferid){
		$query = $this->db->query("SELECT bus_route_master.Route_Id,stoppage.STOPPAGE,bus_trip_master.Trip_Nm,bus_route_master.Prefer_ID FROM ((bus_route_master LEFT JOIN stoppage ON bus_route_master.STOPNO=stoppage.STOPNO) LEFT JOIN bus_trip_master ON bus_route_master.Trip_ID=bus_trip_master.Trip_ID) WHERE bus_route_master.BusCode LIKE '$buscode' AND bus_route_master.Trip_ID LIKE '$tripid' AND bus_route_master.Prefer_ID LIKE '$preferid'");
		return $query->result();
	}
	public function getbusmasterdetails($id){
		$query = $this->db->query("SELECT bus_route_master.Route_Id,bus_route_master.BusCode,bus_route_master.Trip_ID,bus_route_master.Prefer_ID,bus_route_master.STOPNO,busnomaster.BusNo FROM bus_route_master LEFT JOIN busnomaster ON busnomaster.BusCode=bus_route_master.BusCode WHERE bus_route_master.Route_Id='$id'");
		return $query->result();
	}
	public function gettripdetails($id){
		$query = $this->db->query("SELECT bus_trip_master.Trip_ID,bus_trip_master.Trip_Nm FROM bus_route_master LEFT JOIN bus_trip_master ON bus_route_master.Trip_ID=bus_trip_master.Trip_ID WHERE STOPNO='$id'");
		return $query->result();
	}
	public function getvehicle($trip,$stopno){
		$query = $this->db->query("SELECT busnomaster.BusCode,busnomaster.BusNo FROM bus_route_master LEFT JOIN busnomaster ON bus_route_master.BusCode=busnomaster.BusCode WHERE bus_route_master.STOPNO='$stopno' AND bus_route_master.Trip_ID='$trip'");
		return $query->result();
	}
	public function getbusamountmonthwise($month,$adm,$monthno){
		$query = $this->db->query("SELECT (SELECT $month FROM stop_amt WHERE STOP_NO=sbd.NEW_STOPNO) AS BUSAMOUNT FROM student_transport_facility AS sbd WHERE sbd.ADM_NO='$adm' AND sbd.FROM_APPLICABLE_MONTH_CODE<='$monthno' AND sbd.TO_APPLICABLE_MONTH_CODE>='$monthno' ORDER BY sbd.ID");
		return $query->result();
	}
	public function GetTrip($id){
		$query = $this->db->query("SELECT bus_trip_master.Trip_ID,bus_trip_master.Trip_Nm FROM bus_route_master LEFT JOIN bus_trip_master ON bus_route_master.Trip_ID=bus_trip_master.Trip_ID WHERE bus_route_master.BusCode='$id' GROUP BY bus_trip_master.Trip_ID,bus_trip_master.Trip_Nm");
		return $query->result();
	}
	public function GetStoppage($buscode,$trip,$preferid){
		$query = $this->db->query("SELECT stoppage.STOPPAGE,stoppage.STOPNO FROM `bus_route_master` LEFT JOIN stoppage ON bus_route_master.STOPNO=stoppage.STOPNO WHERE bus_route_master.BusCode='$buscode' AND bus_route_master.Trip_ID='$trip' AND bus_route_master.Prefer_ID='$preferid'");
		return $query->result();
	}
	public function update_merge_data($data){
		$query = $this->db->query("UPDATE excel_data inner join daycoll on excel_data.ADM_NO=daycoll.ADM_NO set excel_data.narr='1' where excel_data.period LIKE '%$data%' AND DAYCOLL.PERIOD LIKE '%$data%' AND MID(DAYCOLL.PERIOD,1,3)<>'PRE' AND MID(DAYCOLL.PERIOD,1,4)<>'MISL'");
		return true;
	}
	public function CopyData(){
		$query = $this->db->query("INSERT INTO daycoll SELECT * FROM excel_data WHERE Narr='N/A'");
		return true;
	}
	public function Driver_data_trip_wise($id,$code){
		$query = $this->db->query("SELECT driver_master.driver_name,driver_master.driver_address,busnomaster.BusNo,bus_trip_master.Trip_Nm,driver_master.driver_dob,driver_master.driver_ph_no,driver_master.driver_license_no,driver_master.khallasi_nm,driver_master.khallasi_ph_no FROM ((`driver_master` LEFT JOIN bus_trip_master ON driver_master.trip_id=bus_trip_master.Trip_ID) LEFT JOIN busnomaster ON driver_master.BusCode=busnomaster.BusCode) WHERE driver_master.trip_id LIKE '$id' AND driver_master.BusCode LIKE '$code'");
		return $query->result();
	}
	public function Driver_data_busnowise_wise($id){
		$query = $this->db->query("SELECT driver_master.driver_name,driver_master.driver_address,busnomaster.BusNo,bus_trip_master.Trip_Nm,driver_master.driver_dob,driver_master.driver_ph_no,driver_master.driver_license_no,driver_master.khallasi_nm,driver_master.khallasi_ph_no FROM ((`driver_master` LEFT JOIN bus_trip_master ON driver_master.trip_id=bus_trip_master.Trip_ID) LEFT JOIN busnomaster ON driver_master.BusCode=busnomaster.BusCode) WHERE driver_master.BusCode LIKE '$id'");
		return $query->result();
	}
	public function GetBusMaster(){
		$query = $this->db->query("SELECT busnomaster.BusCode,busnomaster.BusNo FROM bus_route_master LEFT JOIN busnomaster ON busnomaster.BusCode=bus_route_master.BusCode GROUP BY busnomaster.BusCode");
		return $query->result();
	}
	public function GetStoppageMaster(){
		$query = $this->db->query("SELECT busnomaster.BusCode,busnomaster.BusNo FROM bus_route_master INNER JOIN busnomaster ON bus_route_master.BusCode=busnomaster.BusCode GROUP BY busnomaster.BusCode");
		return $query->result();
	}
	public function GetTrip_BusRouteReport($id){
		$query = $this->db->query("SELECT bus_trip_master.Trip_ID,bus_trip_master.Trip_Nm FROM bus_route_master LEFT JOIN bus_trip_master ON bus_trip_master.Trip_ID=bus_route_master.Trip_ID WHERE bus_route_master.BusCode='$id' GROUP BY bus_route_master.Trip_ID");
		return $query->result();
	}
	public function StoppageRouteMaster($buscode,$trip,$prefrence){
		$query = $this->db->query("SELECT stoppage.STOPPAGE,busnomaster.BusNo,bus_trip_master.Trip_Nm,bus_route_master.Prefer_ID FROM (((bus_route_master LEFT JOIN stoppage ON bus_route_master.STOPNO=stoppage.STOPNO) LEFT JOIN busnomaster ON bus_route_master.BusCode=busnomaster.BusCode) LEFT JOIN bus_trip_master ON bus_trip_master.Trip_ID=bus_route_master.Trip_ID) WHERE bus_route_master.BusCode LIKE '$buscode' AND bus_route_master.Trip_ID LIKE '$trip' AND bus_route_master.Prefer_ID LIKE '$prefrence'  ORDER BY bus_route_master.STOPNO");
		return $query->result();
	}
	public function GetStoppagedata($buscode,$trip,$prefrence){
		$query = $this->db->query("SELECT stoppage.STOPPAGE,stoppage.STOPNO FROM stoppage LEFT JOIN bus_route_master ON bus_route_master.STOPNO=stoppage.STOPNO WHERE bus_route_master.BusCode='$buscode' AND bus_route_master.Trip_ID='$trip' AND bus_route_master.Prefer_ID='$prefrence'");
		return $query->result();
	}
	public function Getstudentdetails($stoppage){
		$query = $this->db->query("SELECT student.ADM_NO,student.FIRST_NM,student.DISP_CLASS,student.DISP_SEC,stoppage.STOPPAGE FROM ((student LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO)LEFT JOIN bus_route_master ON student.STOPNO=bus_route_master.STOPNO) WHERE student.Student_Status='ACTIVE' AND bus_route_master.STOPNO LIKE '$stoppage'");
		return $query->result();
	}
	
	public function subjwiseallco_senior($class,$sec){
		$query = $this->db->query("SELECT cswsa.subj_nm,cswsa.opt_code,cswsa.Class_No,cswsa.subject_code,cswsa.sorting_no FROM `class_section_wise_subject_allocation` as cswsa left join marks on Class_No=marks.Classes AND cswsa.subject_code=marks.SCode where cswsa.Class_No = '$class' AND section_no='$sec' AND cswsa.applicable_exam = '1' group by cswsa.subj_nm,cswsa.opt_code,cswsa.Class_No,cswsa.subject_code,cswsa.sorting_no order by cswsa.sorting_no");
		return $query->result();
	}
	
	function get_list_admn_no($admno){
		$sql="SELECT a.ADM_NO,a.order_id,a.tracking_id,a.payment_mode,
a.bank_ref_no,a.order_status,a.pay_amount,a.trans_date,
b.FIRST_NM,b.DISP_CLASS,b.DISP_SEC,a.payment_status
 FROM online_transaction a 
 INNER JOIN student b ON b.ADM_NO=a.ADM_NO
 WHERE 
DATE( a.trans_date)>='2022-04-01' AND  a.ADM_NO='".$admno."'
 ORDER BY a.trans_date desc";

	 $query = $this->db->query($sql);
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;

	}
	function get_list_orderid($orderid){
		$sql="SELECT a.ADM_NO,a.order_id,a.tracking_id,a.payment_mode,
a.bank_ref_no,a.order_status,a.pay_amount,a.trans_date,
b.FIRST_NM,b.DISP_CLASS,b.DISP_SEC,a.payment_status 
 FROM online_transaction a
  INNER JOIN student b ON b.ADM_NO=a.ADM_NO
  WHERE 
 DATE( a.trans_date)>='2022-04-01' AND  a.order_id='".$orderid."'
 ORDER BY a.trans_date desc";

	 $query = $this->db->query($sql);
        return $query->result();

	}
	function get_list_daterange($dt1,$dt2){
		$sql=" SELECT a.ADM_NO,a.order_id,a.tracking_id,a.payment_mode,a.bank_ref_no,a.order_status,a.pay_amount,a.trans_date,b.FIRST_NM,b.DISP_CLASS,b.DISP_SEC,a.payment_status,a.status_code  FROM online_transaction a  INNER JOIN student b ON b.ADM_NO=a.ADM_NO   WHERE  DATE( a.trans_date)>='".$dt1."' AND DATE( a.trans_date)<='".$dt2."'  ORDER BY a.trans_date desc";

	 $query = $this->db->query($sql);
       return $query->result();

	}
	
	
		public function student_information_new($class,$sec,$short_by){
		if($sec !=0){
		$cnd="AND student.SEC='$sec'";
		}else{
		$cnd="";
		}
		$query = $this->db->query("SELECT
		student.ADM_CLASS AS ADM_CLASS,student.STUDENTID AS ID,student.HOSTEL AS HOSTEL_STATUS,student.COMPUTER AS COUMPUTER_STATUS,student.FREESHIP AS FREESHIP_STATUS,student.LETTERNO AS FREESHIP_MONTH,student.math_lab AS HANDICAP,student.ADM_NO AS ADMISSION_NO,student.ADM_DATE AS ADMISSION_DATE,student.FIRST_NM AS STUDENT_NAME,classes.CLASS_NM AS CLASS_NAME,sections.SECTION_NAME AS SECTION_NAME,student.ADM_SEC AS ADM_SEC,student.DISP_CLASS AS CURRENT_CLASS,student.DISP_SEC AS CURRENT_SECTION,student.ROLL_NO AS ROLL_NO,student.SEX AS GENDER,student.BIRTH_DT AS DATE_OF_BIRTH,category.CAT_ABBR CATEGORY,house.HOUSENAME AS HOUSE_NAME,eward.HOUSENAME AS EMPLOYEE_WARD,stoppage.STOPPAGE AS BUSSTOPAGE,student.BLOOD_GRP AS BLOOD_GROUP,student.Fee_Book_No AS ACCOUNT_NUMBER,student.Bus_Book_No AS AADHAR_NUMBER,student.student_image AS STUDENT_IMAGE,religion.Rname AS RELIGION,student.BUS_NO AS SCIENCE_FEE,student.FATHER_NM AS FATHERNAME,student.MOTHER_NM AS MOTHERNAME,student.PERM_ADD AS PERADD,student.P_CITY AS PERCITY,student.P_STATE AS PERSTATE,student.p_NATION AS PERNATION,student.P_PIN AS PERPIN,student.P_PHONE1 AS PERPHONE1,student.P_PHONE2 AS PERPHONE2,student.P_FAXNO AS PERFAX,student.P_MOBILE AS PERMOBILE,student.p_EMAIL AS PEREMAIL,student.CORR_ADD AS CROSSADD,student.C_CITY AS CROSSCITY,student.C_STATE AS CROSSSTATE,student.C_NATION AS CROSSNATION,student.C_PIN AS CROSSPIN,student.LAST_SCH AS LAST_SCHOOL,student.LSCH_ADD AS LSCH_ADD,student.C_MOBILE AS CROSSMOBILE,student.C_PHONE1 AS CROSSPHONE1,student.C_PHONE2 AS CROSSPHONE2,student.C_FAXNO AS CROSSFAX,student.C_EMAIL AS CROSSEMAIL,student.SUBJECT1 AS SUBJECT1,student.SUBJECT2 AS SUBJECT2,student.SUBJECT3 AS SUBJECT3,student.SUBJECT4 AS SUBJECT4,student.SUBJECT5 AS SUBJECT5,student.SUBJECT6 AS SUBJECT6,student.CBSE_REG AS CBSEREGISTRATION,student.CBSE_ROLL AS CBSEROLL,student.APR_FEE AS APRILFEE,student.MAY_FEE AS MAYFEE,student.JUNE_FEE AS JUNEFEE,student.JULY_FEE AS JULYFEE,student.AUG_FEE AS AUGUSTFEE,student.SEP_FEE AS SEPTEMBERFEE,student.OCT_FEE AS OCTOBERFEE,student.NOV_FEE AS NOVEMBERFEE,student.DEC_FEE AS DECEMBERFEE,student.JAN_FEE AS JANUARYFEE,student.FEB_FEE AS FEBRUARYFEE,student.MAR_FEE AS MARCHFEE,student.oldadmno AS HANDICAP_NATURE,student.CLASS AS CURRENT_CLASS_CODE,student.SEC AS CURRENT_SEC_CODE,student.CATEGORY AS CATEGORY_CODE,student.HOUSE_CODE AS HOUSE_CODE,student.EMP_WARD AS EMP_CODE,student.STOPNO AS STOPPAGE_CODE,student.religion AS RELIGION_CODE FROM (((((((student LEFT JOIN classes ON student.ADM_CLASS=classes.Class_No)LEFT JOIN sections ON student.ADM_SEC=sections.section_no)LEFT JOIN category ON student.CATEGORY=category.CAT_CODE)LEFT JOIN house ON student.HOUSE_CODE=house.HOUSENO)LEFT JOIN eward ON student.EMP_WARD=eward.HOUSENO)LEFT JOIN stoppage ON student.STOPNO=stoppage.STOPNO) LEFT JOIN religion ON student.religion=religion.RNo)
		WHERE student.class='$class' $cnd AND Student_Status='ACTIVE' ORDER BY student.class,student.sec, student.roll_no");
	
		return $query->result();

}
	
	
		public function student_list($class, $sec)
	{
		if ($sec != 0) {
			$cnd = "AND student.SEC='$sec'";
		} else {
			$cnd = "";
		}
		$query = $this->db->query("SELECT ADM_NO ,ROLL_NO, FIRST_NM , SUBJECT1, SUBJECT2 ,SUBJECT3 , SUBJECT4, SUBJECT5 , SUBJECT6 FROM student WHERE CLASS='$class' $cnd AND SEC='$sec' AND Student_Status='ACTIVE' order by ROLL_NO ");

		return $query->result();
	}
	
	function get_online_data($dt)
	{
		//$query = $this->db->query("SELECT b.ADM_NO, c.FIRST_NM,c.DISP_CLASS,c.DISP_SEC, c.CLASS,c.SEC,b.RECT_NO,b.RECT_DATE,b.CHQ_NO,b.TOTAL,b.order_id,b.payment_status,b.pay_amount,b.order_status FROM  online_transaction b ON b.ADM_NO=a.ADM_NO INNER JOIN student  c ON c.ADM_NO=a.ADM_NO WHERE b.trans_date='".$dt."'");

		$query = $this->db->query("SELECT ADM_NO, STU_NAME,CLASS,SEC,RECT_NO,RECT_DATE,CHQ_NO,TOTAL,
		order_id,payment_status,pay_amount,order_status FROM  online_transaction WHERE trans_date like '%$dt%'");


		return $query->result();
	}

	function select_and_insert($rcpt_no)
	{
		$sql = "INSERT INTO daycoll
		SELECT  RECT_NO , RECT_DATE,STU_NAME, STUDENTID, ADM_NO, CLASS, SEC, ROLL_NO, PERIOD, TOTAL, FEE1, FEE2,FEE3,FEE4,FEE5,FEE6,FEE7,FEE8,FEE9,FEE10, FEE11, FEE12,FEE13,FEE14,FEE15,FEE16,FEE17,FEE18,FEE19,FEE20, FEE21, FEE22,FEE23,FEE24,FEE25, APR_FEE, MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,CHQ_NO, NARR, TAMT, FEE_BOOK_NO, COLLECTION_MODE, USER_ID, PAYMENT_MODE, BANK_NAME, PAY_DATE, SESSION_YEAR, FORM_NO, VOUCHER_CREATED , TOTAL , TOTAL ,0,0
		FROM ONLINE_TRANSACTION
		WHERE order_id='" . $rcpt_no . "'";

		$query = $this->db->query($sql);
		return true;
	}
	
}