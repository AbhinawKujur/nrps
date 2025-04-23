<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_master extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$data['driver_master'] = $this->dbcon->driver_master_details();
		// echo "<pre>";
		// print_r($data);
		// exit;
		$this->fee_template('transport_management/driver_master/index',$data);
	}
	public function edit_details($id){
		$details['details'] = $this->dbcon->edit_driver($id);
		$details['incharge'] = $this->dbcon->select('bus_incharge_master','*');
		$details['bus_trip_master'] = $this->dbcon->select('bus_trip_master','*');
		$details['bus_master'] = $this->dbcon->select('busnomaster','BusNo,BusCode');
		// echo "<pre>";
		// print_r($details);
		// exit;
		$this->fee_template('transport_management/driver_master/edit_master',$details);
	}
	
	public function changeinchargephone(){
		$id = $this->input->post('val');
		$ph = $this->dbcon->select('bus_incharge_master','*',"Incharge_Id='$id'");
		$phno = $ph[0]->Incharge_ph_no;
		$id = $ph[0]->Incharge_Id;
		$array = array($phno,$id);
		echo json_encode($array);
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
	
	public function update_save(){
		$id = $this->input->post('id_name');
		$array = array(
			'BusCode' => $this->input->post('vn'),
			'driver_name' => $this->input->post('dn'),
			'driver_address' => $this->input->post('da'),
			'driver_dob' => $this->input->post('ddb'),
			'driver_ph_no' => $this->input->post('dpn'),
			'driver_license_no' => $this->input->post('dln'),
			'trip_id' => $this->input->post('tm'),
			'khallasi_nm' => $this->input->post('kn'),
			'khallasi_ph_no' => $this->input->post('kph'),
			'incharge_id' => $this->input->post('incharge_id'),
		);
		$this->dbcon->update('driver_master',$array,"Driver_ID='$id'");
		$this->session->set_flashdata('msg','Successfully Updated');
		redirect('Driver_master/index');
	}
}