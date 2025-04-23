<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		$this->load->library('Alam_custom','alam_custom');
	}
	
	public function index(){
		$this->load->view('nur_adm/firstpage');
	}
}
