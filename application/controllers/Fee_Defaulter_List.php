<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fee_Defaulter_List extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
}