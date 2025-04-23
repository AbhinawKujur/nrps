<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_bus_route extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$data['busnomaster'] =$this->dbcon->select('busnomaster','*');
		$this->render_template('transport_management/bus_route_master/bus_route_master',$data);
	}
	public function gettripid()
	{
		$vehicleno = $this->input->post('vehicleno');
		$tripmaster = $this->dbcon->select("bus_trip_master",'*');
		echo json_encode($tripmaster);
	}
	public function getbusstoppage()
	{
		$preference = $this->input->post('preference');
		$stoppage = $this->dbcon->select("stoppage",'*');
		echo json_encode($stoppage);
		
	}
	public function getallbusdetails(){
		$preference = $this->input->post('preference');
		$vehicleno = $this->input->post('vehicleno');
		$trip_id = $this->input->post('trip_id');
		if(!empty($vehicleno)){
			$vehicleno = $vehicleno;
		}else{
			$vehicleno = "%";
		}
		if(!empty($preference)){
			$preference = $preference;
		}else{
			$preference = "%";
		}
		if(!empty($trip_id)){
			$trip_id = $trip_id;
		}else{
			$trip_id = "%";
		}
		$busstoppagedetails['busstoppagedetails'] = $this->dbcon->getbusstoppagedetails($vehicleno,$trip_id,$preference);
		$this->load->view('transport_management/bus_route_master/getdetails_routemaster',$busstoppagedetails);
	}
	public function savedata(){
		$vehicleno = $this->input->post('vehicleno');
		$trip_id = $this->input->post('trip_id');
		$preference = $this->input->post('preference');
		$stoppage = $this->input->post('stoppage');
		$data = $this->dbcon->max_no('bus_route_master','Route_Id');
		$max_no = $data[0]->Route_Id + 1;
		$data = $this->dbcon->select('bus_route_master','*',"BusCode='$vehicleno' AND Trip_ID='$trip_id' AND Prefer_ID='$preference' AND STOPNO='$stoppage'");
		$cnt = count($data);
		$array = array(
			'Route_Id' => $max_no,
			'BusCode' => $vehicleno,
			'Trip_ID' => $trip_id,
			'Prefer_ID' => $preference,
			'STOPNO' => $stoppage,
		);
		// echo "<pre>";
		// print_r($array);
		// exit;
		if($cnt > 0){
			$this->session->set_flashdata('msg',"This Details Already Exist");
			redirect('Add_bus_route/index');
		}else{
			$this->dbcon->insert('bus_route_master',$array);
			$this->session->set_flashdata('msg',"Successfully Added");
			redirect('Add_bus_route/index');
		}
		
	}
	
	public function edit_detailsold($id){
		$data['bus_route_details'] = $this->dbcon->getbusmasterdetails($id);
		$data['stoppage'] = $this->dbcon->select('stoppage','*');
		$data['trip_master'] = $this->dbcon->select('bus_trip_master','*');
		// echo "<pre>";
		// print_r($data);
		// exit;
		$this->render_template('transport_management/bus_route_master/edit_details',$data);
		
	}
	
	public function edit_details($id)
	{
		$data['bus_route_details'] = $this->dbcon->getbusmasterdetails($id);
		$stopno = $data['bus_route_details'][0]->STOPNO;
		// print_r($stopno);die;
		$data['stoppage'] = $this->dbcon->select('stoppage', '*');
		$data['trip_master'] = $this->dbcon->select('bus_trip_master', '*');

		$data['student'] = $this->db->query("select s.STUDENTID,s.ADM_NO,s.FIRST_NM,s.DISP_CLASS,s.DISP_SEC,(bus_route_master.BusCode-1) as BUS_NO,bus_route_master.STOPNO ,stoppage.STOPPAGE as stopnm from student s left join bus_route_master on bus_route_master.stopno=s.stopno LEFT JOIN stoppage ON stoppage.STOPNO = s.stopno where bus_route_master.stopno='" . $stopno . "' and student_status='active' order by s.class,s.sec,s.FIRST_NM;")->result();
		
		// echo  $this->db->last_query();die;
		$this->render_template('transport_management\bus_route_master\edit_details', $data);
	}
	
	
	public function saveupdate(){
		$id = $this->input->post('id');
		$array = array(
			'Trip_ID' => $this->input->post('trip'),
			'Prefer_ID' => $this->input->post('preference'),
			'STOPNO' => $this->input->post('stoppage')
		);
		// echo "<pre>";
		// print_r($array);
		// exit;
		$this->dbcon->update('bus_route_master',$array,"Route_Id='$id'");
		$this->session->set_flashdata('msg',"Successfully Updated");
		redirect('Add_bus_route/index');
	}
	public function getdetailsmatch(){
		$BusCode 	= $this->input->post('BusCode');
		$Trip_ID 	= $this->input->post('Trip_ID');
		$Prefer_ID  = $this->input->post('Prefer_ID');
		$val 		= $this->input->post('val');
		$data = $this->dbcon->select('bus_route_master','*',"BusCode='$BusCode' AND Trip_ID='$Trip_ID' AND Prefer_ID='$Prefer_ID' AND STOPNO='$val'");
		echo count($data);
	}
}