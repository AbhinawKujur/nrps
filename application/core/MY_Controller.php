<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$permission_data = $this->session->userdata('permission_data');
		define("permission_data", $permission_data);
		$login_details = $this->session->userdata('login_details');
		define("login_details", $login_details);
		$generate_session = $this->session->userdata('generate_session');
		define('generate_session',$generate_session);
		$role_details = $this->sumit->fetchSingleData('*','role_master',array('ID'=>$login_details['ROLE_ID']));
		define("role_details", $role_details);
		$schoolData = $this->sumit->fetchSingleData('','school_setting',array('S_No'=>1));
		define("schoolData", $schoolData);
		date_default_timezone_set('Asia/Kolkata');

		ignore_user_abort(1);
		set_time_limit(300);
	}

	public function loggedOut()
	{
		$login_details = $this->session->userdata('login_details');
		if(empty($login_details))
		{
			redirect('login');
		}
	}
	
	public function loggedOutNurAdmForm()
	{
		$login_details = $this->session->userdata('generate_session');
		if(empty($login_details)){
			redirect('adm_nur/Admin');
		}
	}
	
	public function loggedOutThreeAdmForm()
	{
		$login_details = $this->session->userdata('generate_session');
		if(empty($login_details)){
			redirect('adm_three/Admin');
		}
	}
	
	public function render_template($page=null, $data=null)
	{
		$data['login_details'] = $this->session->userdata('login_details');
		$this->load->view('payroll_main/header',$data);
		$this->load->view('payroll_main/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('payroll_main/footer',$data);
	}


	public function teacher_template($page=null, $data=null)
	{
		$data['login_details'] = $this->session->userdata('login_details');
		$this->load->view('teacher_main/header',$data);
		$this->load->view('payroll_main/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('payroll_main/footer',$data);
	}
	
	public function nurseryAdmissionAdminTemplate($page=null, $data=null){
		$this->load->view('nur_adm/include/header',$data);
		$this->load->view('nur_adm/include/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('nur_adm/include/footer',$data);
	}
	
	public function threeAdmissionAdminTemplate($page=null, $data=null){
		$this->load->view('adm_three/include/header',$data);
		$this->load->view('adm_three/include/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('adm_three/include/footer',$data);
	}

	public function fee_template($page=null, $data=null)
	{
		$data['login_details'] = $this->session->userdata('login_details');
		$this->load->view('fees_main/header',$data);
		$this->load->view('payroll_main/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('payroll_main/footer',$data);
	}
	
	public function Parent_templete($page=null, $data=null){
		/* $data['login_details'] = $this->session->userdata('login_details'); */
		$this->parentLoggedOut();
		$this->load->view('parent_mains/header',$data);
		$this->load->view('parent_mains/sidebar',$data);
		$this->load->view($page,$data);
		$this->load->view('parent_mains/footer',$data);
	}

	public function parentLoggedOut()
	{
		$adm = $this->session->userdata('adm');
		if($adm == '')
		{
			redirect('Parentlogin/index');
		}
	}

	public function checkLogin()
	{
		$login_details = $this->session->userdata('login_details');
		if(!empty($login_details))
		{
				redirect('payroll/dashboard/emp_dashboard');
		}
	}

}