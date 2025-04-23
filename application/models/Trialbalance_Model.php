<?php

class Trialbalance_Model extends CI_Model
{
	public function getTrialBalanceReport($account_type,$date_from,$date_to,$sg)
	{
		$query = $this->db->query("SELECT *,(SELECT CCode FROM mledger WHERE AcNo=tc.CCode)ledger_head,(SELECT OBal FROM mledger WHERE AcNo=tc.CCode)opening_bal,(SELECT DC FROM mledger WHERE AcNo=tc.CCode)opening_bal_dc FROM tcash tc WHERE date(TDate) >= '$date_from' AND date(TDate) <= '$date_to' AND AcT='$account_type' AND SG='$sg' ORDER BY CCode");
		return $query->result_array();
	}

	public function getTrialBalanceReportDistinct($account_type,$date_from,$date_to,$sg)
	{
		$query = $this->db->query("SELECT DISTINCT(CCode),(SELECT CCode FROM mledger WHERE AcNo=tc.CCode)ledger_head FROM tcash tc WHERE date(TDate) >= '$date_from' AND date(TDate) <= '$date_to' AND AcT='$account_type' AND SG='$sg' ORDER BY CCode");
		return $query->result_array();
	}
	
	public function getSchoolGroupByTcash($account_type,$date_from,$date_to)
	{
		$query = $this->db->query("SELECT SG,TDate,AcT,(SELECT CAT_ABBR FROM accscg WHERE cat_code=tc.SG)school_group FROM tcash tc GROUP BY SG HAVING date(TDate) >= '$date_from' AND date(TDate) <= '$date_to' AND AcT='$account_type'");
		return $query->result_array();
	}
}