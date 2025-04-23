<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_auth extends MY_controller{ 
	 
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	  error_reporting(0); 
		$this->load->model('userauth/Check_auth_model','auth');
		$this->load->model('Common_fun','comm');
		$this->load->library('form_validation');
	}
	
	public function index(){ 
		$data['module_name']='fee_head_master';
		$data['receiptNo']="N/A";
		$this->fee_template('userauth/check_auth_view',$data); 
	}

	function authorize_user(){

		// echo"<pre>";print_r($_POST);die;
		$admin = md5($this->input->post('adminpass'));
		$principal = md5($this->input->post('prinpass'));
		$user = md5($this->input->post('userpass'));

		$admin_id=$this->auth->check_authentication('admin',$admin,2 );
		$prin_id=$this->auth->check_authentication('principal',$principal,2 );
		$user_id=$this->auth->check_authentication('user',$user,1);

		if(!empty($admin_id) && !empty($prin_id) && !empty($user_id)){

			$module_accessed=$this->input->post('module_name');
			$receiptNo=$this->input->post('receiptNo');
			$canreason=$this->input->post('canreason');

			$data['admin_empid']=$admin_id[0]->auth_level_empid;
			$data['principal_empid']=$prin_id[0]->auth_level_empid;
			$data['user_empid']=$user_id[0]->auth_level_empid;
			$data['loggedin_on']=date('Y-m-d H:i:s');
			$data['module_accessed']=$module_accessed;
			$data['loggedin_user']=$this->session->userdata('user_id');
			if(!empty($canreason)){
				$data['reason']=$canreason;
			}else{
				$data['reason']="N/A";
			}

			if($module_accessed=="modify_student")
			{
				$adm=$this->comm->admn_no_by_StudentID($receiptNo);
				$data['receiptNo']=$adm[0]->ADM_NO;
			}else{
				$data['receiptNo']=$receiptNo;
			}



			$p=$this->auth->insert('check_auth_login_details',$data);
			
			if($p){
				if($module_accessed=="rect_cancel"){
			redirect('Cancel_reprint/canelled/'.$receiptNo,'refresh');
				}
				if($module_accessed=="fee_head_master"){
					redirect('Fees_master/fees_head','refresh');
				}
				if($module_accessed=="delete_student"){
					redirect('userauth/Check_auth/show_reason/'.$receiptNo,'refresh');
				}
				if($module_accessed=="modify_student"){
					redirect('Student_details/update_student_details/'.$receiptNo,'refresh');
				}
				if($module_accessed=="scholarship"){
					//redirect('Student_details/Scholarship1','refresh');
					redirect('userauth/check_auth/scholarship/'.$p,'refresh');	
				}
				
			}

		}else{
			$this->session->set_flashdata('error', 'Autorization Failed! Please enter password carefully....');
        		redirect('userauth/check_auth','refresh');

			
		} 
	} 

	function cancel_receipt(){
		$receiptNo=$this->input->post('rect_no');
		$module_name=$this->input->post('modulename');
		$reason=$this->input->post('creason');
		$data['receiptNo']=$receiptNo;
		$data['module_name']=$module_name; 
		$data['reason']=$reason;
		$this->fee_template('userauth/check_auth_view',$data); 
	}

	function delete_student($adm_no){ 
		
		$data['module_name']='delete_student';
		$data['receiptNo']=$adm_no;
		$this->fee_template('userauth/check_auth_view',$data);

	}

	function show_reason($receiptNo){
		$data['adm_no']=$receiptNo;
		$this->fee_template('userauth/show_reason_view',$data);
	}

	function modify_student($adm_no)
	{
		
		$data['module_name']='modify_student';
		$data['receiptNo']=$adm_no;
		
		$this->fee_template('userauth/check_auth_view',$data);

	}
	function cancelrecipet()
	{
		$data['module_name']='modify_student';
		$data['receiptNo']=$adm_no;
		$this->fee_template('userauth/check_auth_view',$data);

	}

	function scholarship($last_id){

		$data['last_id']=$last_id;
		$this->fee_template('userauth/scholarship_upload',$data);
	}

	function scholarship_document()
	{
		$refno=$this->input->post('refno');
		$scholarship=$this->input->post('scholarship_dd');
		$last_id=$this->input->post('last_id');
		if($scholarship=="none"){
			$this->session->set_flashdata('error',"Please select Yes or No For,Do you have document to upload");
			redirect('Student_details/Scholarship');
		}

		if($scholarship=="yes")
		{
			$this->form_validation->set_rules('myFile', 'myFile', 'callback_handle_upload');
			if ($this->form_validation->run() == true) 
			{
            	$data['adm_no']='na';
            	$data['ref_no']=$this->input->post('refno');
	            	if($scholarship=="yes")
		            {
		            	$data['uploaded_path']="assets/upload/scholarship/".$this->img_name1;
		        	}
		        	else{
		        		$data['uploaded_path']='na';
		        	}
            	$data['check_auth_login_id']=$last_id;
            	$this->db->trans_start();
            	$p=$this->auth->insert('scholarship_reference',$data);
				$this->db->trans_complete();
				if($this->db->trans_status() === FALSE)
				{
		   			$this->db->trans_rollback();
		   			$this->session->set_flashdata('error', 'File Not Saved Successfully');
		        	 redirect('Student_details/Scholarship');
				}else
				{
		   			$this->db->trans_commit();
		   			 $this->session->set_flashdata('success', 'Sucessfully Saved');
		        	 redirect('Student_details/Scholarship1');
				}

	        }
	        else 
	        {
	        		$this->session->set_flashdata('error',"Please try again, check file size, must be less than 200KB");
	        }
		}
		else
		{
			$data['adm_no']='na';
            $data['ref_no']=$this->input->post('refno');
	        $data['uploaded_path']='na';
		    $data['check_auth_login_id']=$last_id;
		    
		    $this->db->trans_start();
            	$p=$this->auth->insert('scholarship_reference',$data);
				$this->db->trans_complete();
				if($this->db->trans_status() === FALSE)
				{
		   			$this->db->trans_rollback();
		   			$this->session->set_flashdata('error', 'File Not Saved Successfully');
		        	 redirect('Student_details/Scholarship');
				}else
				{
		   			$this->db->trans_commit();
		   			 $this->session->set_flashdata('success', 'Sucessfully Saved');
		        	 redirect('Student_details/Scholarship1');
				}

		}
		

		
	}

	 function handle_upload() {
        $config['upload_path'] = './assets/upload/scholarship/';
        $config['max_size'] = '200';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg';
     $config['file_name'] = $this->input->post('refno').'_'.date('YmdHis');
		if(!is_dir($config['upload_path']))	
	    {
			mkdir($config['upload_path'],0777,TRUE);
    	}

        $this->load->library('upload', $config);

        if (isset($_FILES['myFile']) && !empty($_FILES['myFile']['name'])) {

            if ($this->upload->do_upload('myFile')) {
                // set a $_POST value for 'image' that we can use later
                $upload_data = $this->upload->data();
                $this->img_name1 = $upload_data['file_name'];
                $_POST['myFile'] = $upload_data['file_name'];
                return true;
            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        } else {
            // throw an error because nothing was uploaded
            $this->form_validation->set_message('handle_upload', "You must upload document!");
            return false;
        } 
    }

    function show_scholarship_success(){

    	$data['status']='scholarship';
		$this->fee_template('userauth/status',$data);

    	}

    	function verify_pwd(){

    		$user=$this->input->post('auth_level_id');
    		$pwd = md5($this->input->post('auth_level_pass'));
    		$admin_id=$this->auth->check_authentication($user,$pwd);
    		if(!empty($admin_id)){
    			$data['msg']='1';
    			$data['userid']=$admin_id[0]->auth_level_id;
    			$data['empno']=$admin_id[0]->auth_level_empid;
    			

    		}else{
    			$data['msg']='0';
    		}
    		echo json_encode($data);
    	}
 
    	function verify_bank_password(){

    		$pwd=$this->input->post('user_pwd');
    		$status1=$this->auth->check_bank('onlinepayment',$pwd);
    		
    		if(!empty($status1)){
		       redirect('Fees_collection/online_payment_verification');
    		}else{

    		$this->session->set_flashdata('error', 'Verification Failed');
		        	 redirect('Fees_collection/school_collection');

    		}

    	}
}
?>