<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_card extends MY_controller {
	public function __construct(){
		parent:: __construct();
	}

	public function index()
	{	
		$this->Parent_templete('parents_dashboard/report_card');
	}
}