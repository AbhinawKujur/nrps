<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		if(!in_array('viewSchoolSetting', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['singleData'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$data['session'] = $this->sumit->fetchAllData('*','session_master',array());
		$data['singleSession'] = $this->sumit->fetchSingleData('*','session_master',array('Active_Status'=>1));
		$this->render_template('school_master/setting',$data);
	}

	public function update()
	{
		if(!in_array('editSchoolSetting', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$session = $this->input->post('session');
		$data = array(
				'School_Name'			=> strtoupper($this->input->post('name')),
				'short_nm'				=> strtoupper($this->input->post('short_name')),
				'School_Address'		=> $this->input->post('address'),
				'School_PhoneNo'		=> $this->input->post('phone'),
				'School_MobileNo'		=> $this->input->post('mobile'),
				'School_Code'			=> $this->input->post('sch_code'),
				'School_AfftNo'			=> $this->input->post('sch_afft_no'),
				'School_Email'			=> $this->input->post('email'),
				'School_Webaddress'		=> $this->input->post('website'),
				'School_Session'		=> $session,
				'auth_key'				=> $this->input->post('auth_key'),
				'sender_id'				=> strtoupper($this->input->post('sender_id')),
				'board'				 => strtoupper($this->input->post('board')),
			);
			// echo "<pre>";
			// print_r($data);
			// exit;
			$update = $this->sumit->update('school_setting',$data,array('S_No'=>1));
			if(isset($_FILES['logo']['name']) && !empty($_FILES['logo']['name']))
			{
				$image_name=$_FILES['logo']['name'];
				$temp = explode(".", $image_name);
				$newfilename = round(microtime(true)) . '.' . end($temp);
				$imagepath="assets/school_logo/".$newfilename;
				move_uploaded_file($_FILES["logo"]["tmp_name"],$imagepath);
				$data = array(
					'SCHOOL_LOGO'	=> $imagepath
				);
				$this->sumit->update('school_setting',$data,array('S_No'=>1));
			}
			if($update)
			{
				$this->sumit->update('session_master',array('Active_Status'=>0),array());
				$this->sumit->update('session_master',array('Active_Status'=>1),array('Session_Nm'=>$session));
				$this->session->set_flashdata('msg','<div class="alert alert-success">Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-danger">Failed !</div>');
			}
		redirect('school_master/setting');
	}

	public function sessionView()
	{
		if(!in_array('viewSession', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$data['sessionData'] = $this->sumit->fetchAllDataWithOrder('*','session_master',array(),'Session_ID','DESC');
		$this->render_template('school_master/session',$data);
	}

	public function createSession()
	{
		if(!in_array('addSession', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$response = array();
		$name = $this->input->post('name');
		$session_year = explode('-', $name);
		$data = array(
			'Session_Nm'	=> $name,
			'Session_Year'	=> $session_year[0],
			'Active_Status'	=> 0
		);
		$create = $this->sumit->createData('session_master',$data);
		if($create)
		{
			$response['msg'] = 1;
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}
	public function checkSession()
	{
		$msg = '';
		$name = $this->input->post('name');
		$check = $this->sumit->checkData('*','session_master',array('Session_Nm'=>$name));
		if($check == true)
		{
			$msg = false;
		}
		else
		{
			$msg = true;
		}
		echo json_encode($msg);
	}

	public function getSingleSession()
	{
		$id = $this->input->post('id');
		$data = $this->sumit->fetchSingleData('*','session_master',array('Session_ID'=>$id));
		echo json_encode($data);
	}

	public function updateSession()
	{
		if(!in_array('editSession', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$id = $this->input->post('id');
		$response = array();
		$name = $this->input->post('name');
		$session_year = explode('-', $name);
		$data = array(
			'Session_Nm'	=> $name,
			'Session_Year'	=> $session_year[0]
		);
		$udpate = $this->sumit->update('session_master',$data,array('Session_ID'=>$id));
		if($udpate)
		{
			$response['msg'] = 1;
		}
		else
		{
			$udpate['msg'] = 2;
		}
		echo json_encode($response);
	}

	public function currentMonth()
	{
		$data['monthList'] = $this->sumit->fetchAllData('*','month_master',array());
		$this->render_template('school_master/current_month',$data);
	}

	public function activeCurrentMonth()
	{
		if(!in_array('editActiveMonth', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$month = $this->input->post('month');
		$update = $this->sumit->update('month_master',array('active_month'=>0),array());
		if($update)
		{
			$this->sumit->update('month_master',array('active_month'=>1),array('month_code'=>$month));
			$this->session->set_flashdata('msg','<div class="alert alert-success">Saved Successfully.</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-dangerr">Failed !</div>');
		}
		redirect('school_master/setting/currentMonth');
	}
}
