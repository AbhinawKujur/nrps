<?php 

class Dashboard extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		redirect('payroll/dashboard/emp_dashboard');
		// $this->load->view('payroll_dashboard/dash');
	}

	public function profile()
	{		
		$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		$data['login_data'] = $login_data;
		$this->render_template('payroll_dashboard/profileDetails',$data);
	}
	public function updateImage()
	{
		$user_id = $this->session->userdata('user_id');

		 if (!file_exists('uploads/emp_profile')) {
		   mkdir('uploads/emp_profile', 0777, true);
		 }

		$image=$_FILES['profile_img']['name']; 
		$expimage=explode('.',$image);
		$count = count($expimage);
		$image_ext=$expimage[$count-1];
		$image_name=$user_id.'.'.$image_ext;
		$imagepath="uploads/emp_profile/".$image_name;

		move_uploaded_file($_FILES["profile_img"]["tmp_name"],$imagepath);

		$data = array(
			'profile_img'	=> $imagepath
		);
		$update = $this->sumit->update('employee',$data,array('EMPID'=>$user_id));
		if($update)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('payroll/dashboard/dashboard/profile');
	}

	public function changeUserName()
	{
		$user_id = $this->session->userdata('user_id');
		$username = $this->input->post('username');
		$data =array(
			'username'	=> $username
		);
		$this->form_validation->set_rules('username','Username','trim|required|xss_clean|is_unique[login_details.username]');

	    if($this->form_validation->run() == true)
	    {
			$update = $this->sumit->update('login_details',$data,array('user_id'=>$user_id));
			if($update)
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
			}
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Username Must Be Unique!</div>');
		}
		redirect('payroll/dashboard/dashboard/profile');
	}
}