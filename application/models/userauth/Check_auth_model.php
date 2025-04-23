<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Check_auth_model extends CI_model
{

	function check_authentication($user, $pass, $status)
	{
		$sql = "SELECT * FROM check_auth  WHERE auth_level_id='" . $user . "' AND auth_level_pass='" . $pass . "' AND `status`='$status'";
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)	return FALSE;
		return $query->result();
	}

	public function insert($data, $table)
	{
		$this->db->insert($data, $table);
		return $this->db->insert_id();
	}

	public function check_bank($usr, $pass)
	{
		$sql = "SELECT * from misc_password WHERE username='" . $usr . "' AND password='" . $pass . "'";
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)	return FALSE;
		return $query->result();
	}
}
