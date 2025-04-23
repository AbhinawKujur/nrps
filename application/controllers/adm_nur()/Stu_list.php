<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stu_list extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		$this->load->library('Alam_custom','alam_custom');
		$this->loggedOutNurAdmForm();
	}
	
	public function index(){
		$user_session_id = generate_session['id'];
		$data['stuData'] = $this->alam->selectA('nursery_adm_data','*',"f_code='Ok'");
		$data['nur_reg_user'] = $this->alam->selectA('nur_reg_user','*',"id='$user_session_id'");
		$this->nurseryAdmissionAdminTemplate('adm_three/admin/stu_list',$data);
	}
	
	public function transFailed(){
		$user_session_id = generate_session['id'];
		$data['stuData'] = $this->alam->selectA('nursery_adm_data','*',"f_code='f'");
		$data['nur_reg_user'] = $this->alam->selectA('nur_reg_user','*',"id='$user_session_id'");
		$this->nurseryAdmissionAdminTemplate('adm_three/admin/failed_stu_list',$data);
	}
	
	public function edit($id=null){
		$session_id = generate_session['id'];
		$nur_reg_user = $this->alam->selectA('nur_reg_user','updpermission_status',"id='$session_id'");
		
		$permissionData = $nur_reg_user[0]['updpermission_status'];
		if($permissionData == 0){
			redirect('adm_three/Admin/dashboard');
		}
		
		$data['stu_classes'] = $this->alam->selectA('student','CLASS,DISP_CLASS',"Student_Status = 'ACTIVE' GROUP BY CLASS,DISP_CLASS");
		$data['religion'] = $this->alam->selectA('religion','*',"status='Y' order by sorting_no");
		$data['category'] = $this->alam->selectA('category','*');
		$data['stuData'] = $this->alam->selectA('nursery_adm_data','*,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_0)secc_0,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_1)secc_1',"id='$id'");
		
		$data['motherTounge'] = $this->alam_custom->motherTounge();
		$data['bloodGroup'] = $this->alam_custom->bloodGroup();
		$data['parent_qualification'] = $this->alam_custom->parent_qualification();
		$data['parent_accupation'] = $this->alam_custom->parent_accupation();
		$data['grand_parent'] = $this->alam_custom->grand_parent();
		
		$this->nurseryAdmissionAdminTemplate('adm_three/admin/editForm',$data);
	}
	
	public function updForm(){
		$upd_id = $this->input->post('upd_id');
		
		$saveData = array(
			'stu_nm'             => strtoupper($this->input->post('stu_nm')),
			'dob'                => date('Y-m-d',strtotime($this->input->post('dob'))),
			'gender'             => $this->input->post('gender'),
			'phy_challenged'     => $this->input->post('phy_challenged'),
			'category'           => $this->input->post('category'),
			'aadhaar_no'         => $this->input->post('aadhaar_no'),
			'mother_tounge'      => strtoupper($this->input->post('mother_tounge')),
			'religion'           => strtoupper($this->input->post('religion')),
			'blood_group'        => $this->input->post('blood_group'),
			'f_name'             => strtoupper($this->input->post('f_name')),
			'f_qualification'    => strtoupper($this->input->post('f_qualification')),
			'f_accupation'       => strtoupper($this->input->post('f_accupation')),
			'f_gov_job'          => strtoupper($this->input->post('f_gov_job')),
			'f_jbo_transferable' => strtoupper($this->input->post('f_jbo_transferable')),
			'f_alumini'          => strtoupper($this->input->post('f_alumini')),
			'f_year_leaving'     => $this->input->post('f_year_leaving'),
			'f_reg_no'           => $this->input->post('f_reg_no'),
			'm_name'             => strtoupper($this->input->post('m_name')),
			'm_qualification'    => strtoupper($this->input->post('m_qualification')),
			'm_accupation'       => strtoupper($this->input->post('m_accupation')),
			'm_gov_job'          => strtoupper($this->input->post('m_gov_job')),
			'm_jbo_transferable' => $this->input->post('m_jbo_transferable'),
			'm_alumini'          => $this->input->post('m_alumini'),
			'm_year_leaving'     => $this->input->post('m_year_leaving'),
			'm_reg_no'           => $this->input->post('m_reg_no'),
			'no_of_son'          => $this->input->post('no_of_son'),
			'no_of_daughters'    => $this->input->post('no_of_daughters'),
			'single_parent'      => $this->input->post('single_parent'),
			'father_or_mother'   => strtoupper($this->input->post('father_or_mother')),
			'grand_parent'       => $this->input->post('grand_parent'),
			'stuofjvm_0'         => $this->input->post('stuofjvm_0'),
			'class_0'            => $this->input->post('class_0'),
			'sec_0'              => $this->input->post('sec_0'),
			'registration_0'     => $this->input->post('registration_0'),
			'stuofjvm_1'         => $this->input->post('stuofjvm_1'),
			'class_1'            => $this->input->post('class_1'),
			'sec_1'              => $this->input->post('sec_1'),
			'registration_1'     => $this->input->post('registration_1'),
			'residentail_add'    => strtoupper($this->input->post('residentail_add')),
			'pin_code'           => $this->input->post('pin_code'),
			'distance'           => $this->input->post('distance'),
			'phone_residence'    => $this->input->post('phone_residence'),
			'phone_ofc'          => $this->input->post('phone_ofc'),
			'mobile'             => $this->input->post('mobile'),
			'email'              => $this->input->post('email'),
			'p_residentail_add'  => strtoupper($this->input->post('p_residentail_add')),
			'p_pin_code'         => $this->input->post('p_pin_code'),
			'p_phone_residence'  => $this->input->post('p_phone_residence'),
			'p_phone_ofc'        => $this->input->post('p_phone_ofc'),
			'p_mobile'           => $this->input->post('p_mobile'),
			'verified_status'    => $this->input->post('r1'),
			'verified_by'        => generate_session['id'],
			'verified_date_time' => date("Y-m-d H:i:s")
		);
		
		if(!empty($_FILES['img']['name'])){
		$image              = $_FILES['img']['name']; 
		$expimage           = explode('.',$image);
		$count              = count($expimage);
		$image_ext          = $expimage[$count-1];
		$image_name         = strtotime('now'). mt_rand() .'.'.$image_ext;
		$imagepath          = "assets/nur_adm_img/".$image_name;
		
		move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
		$saveData['img'] = $imagepath;
		
		}
		
		$this->alam->update('nursery_adm_data',$saveData,"id='$upd_id'");
		
		// log
		$logData = array(
			'verified_status' => $this->input->post('r1'),
			'verified_by'     => generate_session['id'],
			'reject_reason'   => ($this->input->post('r1') != 1)?$this->input->post('reject_reason'):'',
			'reg_no'          => $upd_id.'/2020'
		);
		$this->alam->insert('verified_reject_log',$logData);
	}
	
	public function downloadPDF($id){
		$data['stu_classes'] = $this->alam->selectA('student','CLASS,DISP_CLASS',"Student_Status = 'ACTIVE' GROUP BY CLASS,DISP_CLASS");
		$data['school_setting'] = $this->alam->select('school_setting','*');
		$data['school_photo'] = $this->alam->select('school_photo','*');
		$data['religion'] = $this->alam->selectA('religion','*',"status='Y' order by sorting_no");
		$data['category'] = $this->alam->selectA('category','*');
		
		$data['motherTounge'] = $this->alam_custom->motherTounge();
		$data['bloodGroup'] = $this->alam_custom->bloodGroup();
		$data['parent_qualification'] = $this->alam_custom->parent_qualification();
		$data['parent_accupation'] = $this->alam_custom->parent_accupation();
		$data['grand_parent'] = $this->alam_custom->grand_parent();
		
		$data['allData'] = $this->alam->selectA('nursery_adm_data','*,(select CAT_DESC from category where CAT_CODE=nursery_adm_data.category)category,(select Rname from religion where RNo=nursery_adm_data.religion)religion,(select CLASS_NM from classes where Class_No=nursery_adm_data.class_0)class_0,(select CLASS_NM from classes where Class_No=nursery_adm_data.class_1)class_1,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_0)sec_0,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_1)sec_1',"id='$id'");
		
		$this->load->view('adm_three/generate_reg_pdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream($id.".pdf", array("Attachment"=>1));
	}
	
	public function viewOwnData(){
		$stu_id = generate_session['id'];
		
		$data['stuData'] = $this->alam->selectA('nursery_adm_data','*,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_0)sec_0,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_1)sec_1',"id='$stu_id'");
		$data['stu_classes'] = $this->alam->selectA('student','CLASS,DISP_CLASS',"Student_Status = 'ACTIVE' GROUP BY CLASS,DISP_CLASS");
		$data['religion'] = $this->alam->selectA('religion','*',"status='Y' order by sorting_no");
		$data['category'] = $this->alam->selectA('category','*');
		$data['motherTounge'] = $this->alam_custom->motherTounge();
		$data['bloodGroup'] = $this->alam_custom->bloodGroup();
		$data['parent_qualification'] = $this->alam_custom->parent_qualification();
		$data['parent_accupation'] = $this->alam_custom->parent_accupation();
		$data['grand_parent'] = $this->alam_custom->grand_parent();
		$this->nurseryAdmissionAdminTemplate('adm_three/admin/viewOwnData',$data);	
	}
	
	public function updByUser(){
		$stu_id = generate_session['id'];
		
		$data['stuData'] = $this->alam->selectA('nursery_adm_data','*,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_0)secc_0,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_1)secc_1',"id='$stu_id'");
		$data['stu_classes'] = $this->alam->selectA('student','CLASS,DISP_CLASS',"Student_Status = 'ACTIVE' GROUP BY CLASS,DISP_CLASS");
		$data['religion'] = $this->alam->selectA('religion','*',"status='Y' order by sorting_no");
		$data['category'] = $this->alam->selectA('category','*');
		$data['motherTounge'] = $this->alam_custom->motherTounge();
		$data['bloodGroup'] = $this->alam_custom->bloodGroup();
		$data['parent_qualification'] = $this->alam_custom->parent_qualification();
		$data['parent_accupation'] = $this->alam_custom->parent_accupation();
		$data['grand_parent'] = $this->alam_custom->grand_parent();
		$this->nurseryAdmissionAdminTemplate('adm_three/admin/updByUser',$data);
	}
	
	public function rejectReasonSave(){
		$upd_id = $this->input->post('upd_id');
		$updaData = array(
			'reject_reason' => $this->input->post('reject_reason') 
		);
		$this->alam->update('nursery_adm_data',$updaData,"id='$upd_id'");
	}
}
