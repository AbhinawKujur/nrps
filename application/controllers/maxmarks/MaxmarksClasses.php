<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaxmarksClasses extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$this->render_template('maxmarks/maxmarksClasses');
	}
}