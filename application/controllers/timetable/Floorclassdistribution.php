<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Floorclassdistribution extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		
		$data['wingList'] =$this->sumit->fetchAllData('*','wing_master',array());
		$data['roomList'] = $this->timetable_model->getRoomList();
		$data['classSecList'] = $this->sumit->fetchDataGroupByWhereOrderBy('Class_Sec_SubCode,Class_name_Roman','class_section_wise_subject_allocation',"Class_name_Roman NOT IN (SELECT Alloted_Class FROM room_master)","Class_Sec_SubCode,Class_name_Roman","Class_name_Roman");
		$this->render_template('timetable/floorClassDistribution',$data);
	}

	public function create()
	{
		$this->form_validation->set_rules('wing_name','Wing Name','trim|required');
		$this->form_validation->set_rules('floor_name','Floor Name','trim|required');
		$this->form_validation->set_rules('class_name_Roman','Class Name','trim|required');
		$this->form_validation->set_rules('room_no','Room No','trim|required');
		if($this->form_validation->run()==TRUE)
		{
			$wing = $this->input->post('wing_name');
			$floor = $this->input->post('floor_name');
			$class_name_Roman = $this->input->post('class_name_Roman');
			$room_no = $this->input->post('room_no');

			$wingDetails = $this->sumit->fetchSingleData('*','wing_master',"ID='$wing'");
			$data = array(
				'Room_Name'	=> strtoupper($room_no),
				'Alloted_Class'		=> $class_name_Roman,
				'Floor_ID'	=> $floor,
				'Building_ID'	=> $wing,
				'Campus_ID'	=> $wingDetails['CAMPUS_MASTER_ID'],
			);

			$insert = $this->sumit->createData('room_master',$data);
			if($insert)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Added Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Creation Failed!</div>');
			}
		}
		redirect('timetable/floorclassdistribution');
	}

	public function checkRoomNo()
	{
		$wing = $this->input->post('wing_name');
		$floor = $this->input->post('floor_name');
		$room_no = $this->input->post('room_no');
		$check = $this->sumit->checkData('*','room_master',array('Room_Name'=>$room_no,'Floor_ID'=>$floor,'Building_ID'=>$wing));
		if($check)
		{
			echo json_encode('Room no already exist in this floor');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function checkRoomNoAtEdit()
	{
		$id = $this->input->post('id');
		$wing = $this->input->post('wing_name');
		$floor = $this->input->post('floor_name');
		$room_no = $this->input->post('room_no');
		$check = $this->sumit->checkData('*','room_master',array('Room_Name'=>$room_no,'Floor_ID'=>$floor,'Building_ID'=>$wing,'Room_ID !='=>$id));
		if($check)
		{
			echo json_encode('Room no already assigned to another class section');
		}
		else
		{
			echo json_encode('true');
		}
	}

	public function deleteRecord()
	{
		$id = $this->input->post('id');
		$delete = $this->sumit->delete('room_master',array('Room_ID'=>$id));
		if($delete==true)
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
	}

	public function getFloor()
	{
		$wing_id = $this->input->post('wing_id');
		$floorDetails = $this->sumit->fetchAllData('*','floor_master',"Building_ID='$wing_id'");
		echo json_encode($floorDetails);
	}
}
