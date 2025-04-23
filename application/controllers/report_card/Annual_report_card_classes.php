<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annual_report_card_classes extends MY_Controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$this->render_template('report_card/annula_report_card_junior_classes');
	}
}