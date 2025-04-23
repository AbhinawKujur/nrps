<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermissionMaxMarks extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$report_card_permission = $this->alam->selectA('report_card_permission','*');
		$data['t1'] = $report_card_permission[0]['term1'];
		$data['t2'] = $report_card_permission[0]['term2'];
		$this->render_template('permission/permission_maxMarks',$data);
	}
	
	public function save(){
		$saveData = array(
			'term1' => $this->input->post('t1'),
			'term2' => $this->input->post('t2')
		);
		
		$this->alam->update('report_card_permission',$saveData,"id='1'");
		$this->session->set_userdata('msg',"Update Successfully");
		redirect('permission/PermissionMaxMarks');
	}
}