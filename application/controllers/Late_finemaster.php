<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Late_finemaster extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function late_fine(){
		$data['late_fine'] = $this->dbcon->select('latefine_master','*');
		$this->fee_template('fees_master/late_finemaster',$data);
	}
	public function update_latefine($id){
		$data['late_fine'] = $this->dbcon->select('latefine_master','*',"ID='$id'");
		$data['month'] = $this->dbcon->select('month_master','*');
		$this->fee_template('fees_master/update_finemaster',$data);
	}
	public function update_save(){
		$id = $this->input->post('id');
		$data = array(
			'month_applied' => $this->input->post('month'),
			'date_applied' => $this->input->post('days'),
			'late_amount' => $this->input->post('amount'),
			'collection_mode' => $this->input->post('moc'),
			'status' => $this->input->post('status')
		);
		if($this->dbcon->update('latefine_master',$data,"ID='$id'")){
			$this->session->set_flashdata('msg',"Successfully Updated");
			redirect('Late_finemaster/late_fine');
		}
		else{
			$this->session->set_flashdata('msg',"Failed Updated");
			redirect('Late_finemaster/late_fine');
		}
	}
}