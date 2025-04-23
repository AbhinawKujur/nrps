<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Mymodel','dbcon');
	}
	
	public function index(){
		
		$data['schoolData'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$this->checkLogin();
		$this->load->view('login/index',$data);
	}

	public function newLogin()
	{
		$data['schoolData'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$this->checkLogin();
		$this->load->view('login/new_login',$data);
	}
	
	public function loggedIn()
	{
		$username    = $this->input->post('Username');
		$pass 		 = md5($this->input->post('pass'));
		$check_data = $this->sumit->checkData('*','login_details',array('username'=>$username,'pass_word'=>$pass));
		if($check_data)
		{
			$login_details = $this->sumit->fetchSingleData('*','login_details',array('username'=>$username,'pass_word'=>$pass));
			$check_status = $this->sumit->fetchSingleData('STATUS','employee',array('EMPID'=>$login_details['user_id']));
			if($check_status['STATUS'] == 1)
			{
				$school = $this->dbcon->select('school_setting','School_Name');
				$school_name = $school[0]->School_Name;
				$this->session->set_userdata('school_name',$school_name);
				$this->session->set_userdata('userId', $username);
				$this->session->set_userdata('user_id',$login_details['user_id']);
				$this->session->set_userdata('username',$login_details['username']);
				$this->session->set_userdata('Class_tech_sts',$login_details['Class_tech_sts']);
				$this->session->set_userdata('Class_No',$login_details['Class_No']);
				$this->session->set_userdata('Section_No',$login_details['Section_No']);
				$this->session->set_userdata('emp_name',$login_details['emp_name']);
				$empimage = $this->sumit->fetchSingleData('profile_img','employee',array('EMPID'=>$login_details['user_id']));
				$login_data = array(
					'user_id'	=> $login_details['user_id'],
					'user_name'	=> $login_details['username'],
					'emp_name'	=> $login_details['emp_name'],
					'ROLE_ID'	=> $login_details['ROLE_ID'],
					'Class_tech_sts'	=> $login_details['Class_tech_sts'],
					'Class_No'	=> $login_details['Class_No'],
					'Section_No'	=> $login_details['Section_No'],
					'user_image'	=> $empimage['profile_img']
				);
				$permission_data = $this->sumit->fetchSingleData('*','permission_data',array('ROLE_ID'=>$login_details['ROLE_ID']));
				if(empty($permission_data))
				{
					$permission_data['PERMISSION_DATA'] = array('1'=>'add'); //this is demo
				}
				else
				{
					$permission_data = unserialize($permission_data['PERMISSION_DATA']);
				}
				
				$this->session->set_userdata('permission_data', $permission_data);
				$this->session->set_userdata('ROLE_ID', $login_details['ROLE_ID']);
				$this->session->set_userdata('login_details', $login_data);

				$useragentdata = array(
					'username'		=> $login_details['username'],
					'user_type'		=> 'Staff',
					'ip_address'	=>	$this->input->ip_address(),
					'user_device'	=> user_agents(),
				);
				$this->sumit->createData('userlog',$useragentdata);
				redirect('payroll/dashboard/emp_dashboard');
			}
			else
			{
				$this->session->set_flashdata('msg','Account Suspended'); //new login form
				redirect('login');
			}
		}
		else
		{
			$this->session->set_flashdata('msg','Username or password is Incorrect !'); // new login form
			redirect('login');
		}
	}


	public function logout(){
		$this->session->sess_destroy();
		redirect('login/index');
	}
	
	public function fees_dashboard(){
		$total_student = $this->dbcon->select('student','*');
		$active_student = $this->dbcon->select('student','*',"Student_Status='ACTIVE'");
		$unactive_student = $this->dbcon->select('student','*',"Student_Status='UNACTIVE'");
		$cnt = count($total_student);
		$cnt_active_student = count($active_student);
		$cnt_unactive_student = count($unactive_student);
		$student_information = array(
			'total_student' =>$cnt,
			'active_student' => $cnt_active_student,
			'unactive_student' => $cnt_unactive_student
		);
		$this->fee_template('fees_dashboard/dash',$student_information);
	}
	
	public function teacher_dashboard(){
		$this->teacher_template('teacher_dashboard/dash');
	}



	public function payroll_dashboard(){
		$this->render_template('payroll_dashboard/dash');
	}

	public function changePassword()
	{
		$response = array();
		$emp_id = $this->input->post('empid_change_pass');
		$password = $this->input->post('password');
		$conf_password = $this->input->post('conf_password');

		if($password == $conf_password)
		{
			$data = array(
				'pass_word'	=> md5($password)
			);

			$update = $this->sumit->update('login_details',$data,array('user_id'=>$emp_id));
			if($update)
			{
				$response['msg'] = 1;
			}
			else
			{
				$response['msg'] = 2;
			}
		}
		echo json_encode($response);
	}

	public function matchOldPassword()
	{
		$response = array();
		$emp_id = $this->input->post('empid_change_pass');
		$old_password = $this->input->post('old_password');
		$old_password = md5($old_password);

		$checkpassword = $this->sumit->checkData('*','login_details',array('user_id'=>$emp_id,'pass_word'=>$old_password));

		if($checkpassword == FALSE)
		{
			echo json_encode('Old password does not match');
		}
		else
		{
			echo json_encode('true');
		}
	}
}
