<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_nur extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		$this->load->library('Alam_custom','alam_custom');
	}
	
	public function index(){
		die;
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
		$this->load->view('nur_adm/admForm',$data);
	}
	
	function Getsec(){
		$classes = $this->input->post('classes');
		$secData = $this->alam->selectA("student","SEC,DISP_SEC","CLASS='$classes' GROUP BY SEC,DISP_SEC");
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['SEC']; ?>'><?php echo $val['DISP_SEC']; ?></option>
			<?php
		}
		
	}
	
	public function checkData(){
		$stu_nm = trim(strtoupper($this->input->post('stu_nm')));
		$dob    = date('Y-m-d',strtotime($this->input->post('dob')));
		$mobile = $this->input->post('mobile');
		$stuDatacnt = $this->alam->selectA('nursery_adm_data','count(*)cnt',"stu_nm='$stu_nm' AND dob='$dob' AND mobile='$mobile'");
		
		$stuData = $this->alam->selectA('nursery_adm_data','id,mobile',"stu_nm='$stu_nm' AND dob='$dob' AND mobile='$mobile'");
		
		$cnt = $stuDatacnt[0]['cnt'];
		$un  = $stuData[0]['id'];
		$pwd = $stuData[0]['mobile'];
		$array = array($cnt,$un,$pwd);
		echo json_encode($array);
	}
	
	function saveNurAdmRecord(){
		
		if(!empty($_FILES['img']['name'])){
		$image              = $_FILES['img']['name']; 
		$expimage           = explode('.',$image);
		$count              = count($expimage);
		$image_ext          = $expimage[$count-1];
		$image_name         = strtotime('now'). mt_rand() .'.'.$image_ext;
		$imagepath          = "assets/nur_adm_img/".$image_name;
		
		move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
		}else{
			$imagepath  = '';
		}
		
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
			'img'                => $imagepath,
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
			'grand_parent'       => strtoupper($this->input->post('grand_parent')),
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
			'mobile'             => $this->input->post('mobile'),
			'email'              => $this->input->post('email'),
			'p_residentail_add'  => strtoupper($this->input->post('p_residentail_add')),
			'p_pin_code'         => $this->input->post('p_pin_code'),
			'p_phone_residence'  => $this->input->post('p_phone_residence'),
			'p_mobile'           => $this->input->post('p_mobile'),
			'set_amt'            => '1500.00'
		);
		
		$this->alam->insert('nursery_adm_data',$saveData);
		$last_id = $this->db->insert_id();
		$last_reg_id = sprintf("%04d", $last_id);
		
		$regData = $this->alam->selectA('nursery_adm_data','id,dob,stu_nm,mobile,img,set_amt,verified_status,f_code',"id='$last_reg_id'");
		
		$session = array(
			'id'              => $regData[0]['id'],
			'name'            => $regData[0]['stu_nm'],
			'img'             => $regData[0]['img'],
			'set_amt'         => $regData[0]['set_amt'],
			'verified_status' => $regData[0]['verified_status'],
			'mobile'          => $regData[0]['mobile'],
			'f_code'          => $regData[0]['f_code'],
			'role'            => 'APPLICANT'
		);
		
		$this->session->set_userdata('generate_session',$session);
	}
	
	public function payNow(){
		$data['school_setting'] = $this->alam->select('school_setting','*');
		$data['school_photo'] = $this->alam->select('school_photo','*');
		
		$message = "Dear Parent, Your application is successfully submitted Your username is ".generate_session['id']."/2020 & password is ".generate_session['mobile'];
		$this->sms_lib->sendSms(generate_session['mobile'],$message);
		
		$data['allData'] = $this->alam->selectA('nursery_adm_data','*',"id='".generate_session['id']."'");
		$this->load->view('nur_adm/payNow',$data);
	}
}
