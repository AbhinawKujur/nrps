<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_trip_master extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$data['bus_trip'] = $this->dbcon->select('bus_trip_master','*');
		$this->fee_template('transport_management/bus_trip/bus_details',$data);
	}
	public function checkdata(){
		$val = strtoupper($this->input->post('val'));
		$dta = $this->dbcon->select('bus_trip_master','Trip_Nm',"Trip_Nm='$val'");
		echo count($dta);
	}
	public function edit_trip($id){
		$data['bus_master'] = $this->dbcon->select('bus_trip_master','*',"Trip_ID='$id'");
		// echo "<pre>";
		// print_r($data);
		// exit;
		$this->fee_template('transport_management/bus_trip/bus_edit',$data);
	}
	public function trip_update(){
		$tn = strtoupper($this->input->post('tn'));
		$id = $this->input->post('id');
		$array = array(
			'Trip_Nm' => $tn
		);
		$this->dbcon->update('bus_trip_master',$array,"Trip_ID='$id'");
		$this->session->set_flashdata('msg',"Successfully Updated");
		redirect('Bus_trip_master/index');
	}
	public function add_trip(){
		$this->fee_template('transport_management/bus_trip/add_trip');
	}
	public function checktrip(){
		$val = strtoupper($this->input->post('val'));
		$dta = $this->dbcon->select('bus_trip_master','Trip_Nm',"Trip_Nm='$val'");
		echo count($dta);
	}
	public function save_trip(){
		$data = $this->dbcon->max_no('bus_trip_master','Trip_ID');
		$max_no = $data[0]->Trip_ID + 1;
		
		$data = array(
		 'Trip_ID' => $max_no,
		 'Trip_Nm' => strtoupper($this->input->post('trip_name'))
		);

		$this->dbcon->insert('bus_trip_master',$data);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Bus_trip_master/index');
	}
}