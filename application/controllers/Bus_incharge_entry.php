<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_incharge_entry extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function bus_incharge(){
		$array['data'] = $this->dbcon->select('bus_incharge_master','*');
		$this->fee_template('transport_management/incharge_master/incharge_master',$array);
	}
	public function edit_busincharge($id){
		$array['data'] = $this->dbcon->select('bus_incharge_master','*',"Incharge_Id='$id'");
		$this->fee_template('transport_management/incharge_master/edit_incharge',$array);
	}
	public function insert_data(){
		$name = strtoupper($this->input->post('incharge_name'));
		$ph_no = $this->input->post('incharge_phone');
		
		$data = $this->dbcon->max_no('bus_incharge_master','Incharge_Id');
		$max_no = $data[0]->Incharge_Id + 1;
		
		$array = array(
			'Incharge_Id' => $max_no,
			'Incharge_nm' => $name,
			'Incharge_ph_no' => $ph_no
		);
		$this->dbcon->insert('bus_incharge_master',$array);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Bus_incharge_entry/bus_incharge');
	}
	public function incharge_update(){
		$incharge_name = strtoupper($this->input->post('incharge_name'));
		$incharge_phone = $this->input->post('incharge_phone');
		$upd_id = $this->input->post('upd_id');
		
		$update_data = array(
			'Incharge_nm' => $incharge_name,
			'Incharge_ph_no' => $incharge_phone,
		);
		if($this->dbcon->update('bus_incharge_master',$update_data,"Incharge_Id='$upd_id'")){
			$this->session->set_flashdata('msg',"Successfully Updated");
			redirect('Bus_incharge_entry/bus_incharge');
		}
		else{
			$this->session->set_flashdata('msg',"Failed Updated");
			redirect('Bus_incharge_entry/bus_incharge');
		}
		
	}
	public function validate_number(){
		$number = $this->input->post('val');
		$data = $this->dbcon->select('bus_incharge_master','Incharge_ph_no',"Incharge_ph_no='$number'");
		echo count($data);
		
		
	}
	public function checkdata(){
		$number = $this->input->post('val');
		$data = $this->dbcon->select('bus_incharge_master','Incharge_ph_no',"Incharge_ph_no='$number'");
		echo count($data);
	}
}