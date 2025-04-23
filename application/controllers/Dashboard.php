<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Mymodel','dbcon');
	}
	
	public function index(){
		$this->fee_template('report_card/report_card');
	}
}
