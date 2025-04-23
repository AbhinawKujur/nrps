<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_master_add extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function bus_details(){
		$data['bus_master'] = $this->dbcon->select('busnomaster','*');
		$this->fee_template('transport_management/bus_details/bus_details',$data);
	}
	public function add_bus(){
		$this->fee_template('transport_management/bus_details/bus_add');
	}
	public function save_busdetails(){
		$User_Id = $this->session->userdata('user_id');
		$data = $this->dbcon->max_no('busnomaster','BusCode');
		$max_no = $data[0]->BusCode + 1;
		$array = array(
			'BusCode' => $max_no,
			'BusNo' => strtoupper($this->input->post('vn')),
			'seats' => $this->input->post('seats'),
			'regn_no' => $this->input->post('Regn'),
			'chasis_no' => $this->input->post('Chasis'),
			'engine_no' => $this->input->post('engineno'),
			'tax_paid_date' => $this->input->post('tpd'),
			'tax_expiry_date' => $this->input->post('tped'),
			'fitness_date' => $this->input->post('fd'),
			'fitness_renewal_date' => $this->input->post('frd'),
			'gprs_installed' => $this->input->post('gid'),
			'pollution_date' => $this->input->post('pcd'),
			'pollution_expiry_date' => $this->input->post('pced'),
			'insuance_comp_name' => strtoupper($this->input->post('noic')),
			'insuance_comp_address' => strtoupper($this->input->post('ica')),
			'insurance_policy_no' => $this->input->post('ipn'),
			'insurance_amt' => $this->input->post('ia'),
			'insurance_renewal_date' => $this->input->post('ird'),
			'insurance_expiry_date' => $this->input->post('ied'),
			'bus_no' => $this->input->post('bn'),
			'cctv' => $this->input->post('cctv')
		);
		$pollution = array(
			'BusCode' => $max_no,
			'renwal_date' => $this->input->post('pcd'),
			'exp_date' => $this->input->post('pced'),
			'insurance_type' => 1,
			'created_by' => $User_Id,
			'created_date' => date('Y-m-d')
		);
		$insurance = array(
			'BusCode' => $max_no,
			'renwal_date' => $this->input->post('ird'),
			'exp_date' => $this->input->post('ied'),
			'insurance_type' => 2,
			'created_by' => $User_Id,
			'created_date' => date('Y-m-d')
		);
		$fitness = array(
			'BusCode' => $max_no,
			'renwal_date' => $this->input->post('fd'),
			'exp_date' => $this->input->post('frd'),
			'insurance_type' => 3,
			'created_by' => $User_Id,
			'created_date' => date('Y-m-d')
		);
		$taxpaid = array(
			'BusCode' => $max_no,
			'renwal_date' => $this->input->post('tpd'),
			'exp_date' => $this->input->post('tped'),
			'insurance_type' => 4,
			'created_by' => $User_Id,
			'created_date' => date('Y-m-d')
		);
		// echo "<pre>";
		// print_r($pollution);
		// print_r($insurance);
		// print_r($fitness);
		// print_r($taxpaid);
		// exit;
		$this->dbcon->insert('busnomaster',$array);
		$this->dbcon->insert('transport_renwal_history',$pollution);
		$this->dbcon->insert('transport_renwal_history',$insurance);
		$this->dbcon->insert('transport_renwal_history',$fitness);
		$this->dbcon->insert('transport_renwal_history',$taxpaid);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Bus_master_add/bus_details');
	}
	public function checkbuno(){
		$data = $this->input->post('val');
		$find_data = $this->dbcon->select('busnomaster','bus_no',"bus_no='$data'");
		$cnt = count($find_data);
		echo $cnt;
	}
	public function edit_bus($id){
		$data['bus_master'] = $this->dbcon->select('busnomaster','*',"BusCode='$id'");
		$this->fee_template('transport_management/bus_details/bus_edit',$data);
	}
	public function edit_save(){
		$User_Id = $this->session->userdata('user_id');
		$id = $this->input->post('id');
		$array = array(
			'BusNo' => strtoupper($this->input->post('vn')),
			'seats' => $this->input->post('seats'),
			'regn_no' => $this->input->post('Regn'),
			'chasis_no' => $this->input->post('Chasis'),
			'engine_no' => $this->input->post('engineno'),
			'tax_paid_date' => $this->input->post('tpd'),
			'tax_expiry_date' => $this->input->post('tped'),
			'fitness_date' => $this->input->post('fd'),
			'fitness_renewal_date' => $this->input->post('frd'),
			'gprs_installed' => $this->input->post('gid'),
			'pollution_date' => $this->input->post('pcd'),
			'pollution_expiry_date' => $this->input->post('pced'),
			'insuance_comp_name' => strtoupper($this->input->post('noic')),
			'insuance_comp_address' => strtoupper($this->input->post('ica')),
			'insurance_policy_no' => $this->input->post('ipn'),
			'insurance_amt' => $this->input->post('ia'),
			'insurance_renewal_date' => $this->input->post('ird'),
			'insurance_expiry_date' => $this->input->post('ied'),
			'bus_no' => $this->input->post('bn'),
			'cctv' => $this->input->post('cctv'),
		);
		$pollution = array(
			'BusCode' => $id,
			'renwal_date' => $this->input->post('pcd'),
			'exp_date' => $this->input->post('pced'),
			'insurance_type' => 1,
			'created_by' => $User_Id,
			'created_date' => date('Y-m-d')
		);
		$insurance = array(
			'BusCode' => $id,
			'renwal_date' => $this->input->post('ird'),
			'exp_date' => $this->input->post('ied'),
			'insurance_type' => 2,
			'created_by' => $User_Id,
			'created_date' => date('Y-m-d')
		);
		$fitness = array(
			'BusCode' => $id,
			'renwal_date' => $this->input->post('fd'),
			'exp_date' => $this->input->post('frd'),
			'insurance_type' => 3,
			'created_by' => $User_Id,
			'created_date' => date('Y-m-d')
		);
		$taxpaid = array(
			'BusCode' => $id,
			'renwal_date' => $this->input->post('tpd'),
			'exp_date' => $this->input->post('tped'),
			'insurance_type' => 4,
			'created_by' => $User_Id,
			'created_date' => date('Y-m-d')
		);
		// echo "<pre>";
		// print_r($pollution);
		// print_r($insurance);
		// print_r($fitness);
		// print_r($taxpaid);
		// exit;
		$this->dbcon->insert('busnomaster',$array);
		$this->dbcon->insert('transport_renwal_history',$pollution);
		$this->dbcon->insert('transport_renwal_history',$insurance);
		$this->dbcon->insert('transport_renwal_history',$fitness);
		$this->dbcon->insert('transport_renwal_history',$taxpaid);
		$this->dbcon->update('busnomaster',$array,"BusCode='$id'");
		$this->session->set_flashdata('msg',"Successfully Updated");
		redirect('Bus_master_add/bus_details');
	}
	public function view_bus($id){
		$data['bus_master'] = $this->dbcon->select('busnomaster','*',"BusCode='$id'");
		$this->fee_template('transport_management/bus_details/bus_view',$data);
	}
	public function checkbusno(){
		$data = $this->input->post('val');
		$val = $this->dbcon->select('busnomaster','BusNo',"BusNo='$data'");
		echo count($val);
	}
}