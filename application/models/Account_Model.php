<?php

class Account_Model extends CI_model{

	public function getLedgerList()
	{
		$query = $this->db->query("SELECT *,(SELECT CAT_ABBR FROM accscg WHERE cat_code=ml.SG)school_group,(SELECT AcName FROM acgroup WHERE GName=ml.CBO)account_group FROM `mledger` ml");
		return $query->result_array();
	}

	public function getTemporarryVoucher($login_id)
	{
		$query = $this->db->query("SELECT *,(SELECT CAT_ABBR FROM accg WHERE CAT_CODE=tvd.ac_type)ac_type_abbr,(SELECT CCode FROM mledger WHERE AcNo=tvd.ac_head)ledger_name,(SELECT CBO FROM mledger WHERE AcNo=tvd.ac_head)ag_code,(SELECT AcName FROM acgroup WHERE GName=ag_code)ag,(SELECT SG FROM mledger WHERE AcNo=tvd.ac_head)SG FROM `temp_voucher_db` tvd WHERE login_id='$login_id'");
		return $query->result_array();
	}

	public function getTcashdataByVno($Vno)
	{
		$query = $this->db->query("SELECT *,(SELECT CCode FROM mledger WHERE AcNo=tc.CCode)ledger_head FROM `tcash` tc WHERE VNo='$Vno' ORDER BY PR DESC");
		return $query->result_array();
	}

	public function getTotalLedgerPassed()
	{
		$query = $this->db->query("SELECT *,(SELECT COUNT(CCode) FROM tcash WHERE CCode=ml.AcNo)total_entry FROM `mledger` ml");
		return $query->result_array();
	}
  }