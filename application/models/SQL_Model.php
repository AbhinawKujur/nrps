<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SQL_Model extends CI_model{

	public function __construct()
	{
		parent::__construct();
	}

	function sqlServerData()
	{
		$otherdb = $this->load->database('otherdb', TRUE);
	 	$query = $otherdb->select('*')
	 					->where('PROCESS','N')
	 					->get('STARDC_RAWDATA');
	  	return $query->result_array();
	}

	public function update($tablename,$data,$where)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$query = $otherdb->update($tablename,$data,$where);
		return $this->db->affected_rows();
		// return $query;
	}
  }