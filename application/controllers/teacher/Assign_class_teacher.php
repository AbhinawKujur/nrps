<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_class_teacher extends My_controller {
	public function __construct(){
		parent :: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data['class_data']   = $this->alam->select('classes','*');
		$data['teacher_data'] = $this->alam->select('employee','EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,STAFF_TYPE',"STAFF_TYPE='1'");
		$data['subjectList'] = $this->sumit->fetchAllData('*','subjects',array());
		$this->render_template('teacher/assign_class_teacher',$data);
	}
	
	public function section(){
		$classs   = $this->input->post('classs');
		$sec_data = $this->alam->select('student','distinct(DISP_SEC),SEC',"CLASS='$classs' AND Student_Status='ACTIVE' order by DISP_SEC");
		?>
		  <option value=''>Select</option>
		<?php
		foreach($sec_data as $data){
			?>
			  <option value='<?php echo $data->SEC; ?>'><?php echo $data->DISP_SEC; ?></option>
			<?php
		}
	}
	
	public function save_assign_class_teacher(){
		$emp_id     = $this->input->post('emp_id');
		$class_teac = $this->input->post('class_teac');
		$class_id   = $this->input->post('class_id');
		$sec_id     = $this->input->post('sec_id');

		if($class_teac == 'Y'){
			$data  = array(
			'Class_tech_sts' => 1,
			'Class_No' => $class_id,
            'Section_No' => $sec_id			
			);
			$this->alam->update('login_details',$data,"user_id='$emp_id'");
			echo "Saved Successfully";
		}
		elseif($class_teac == 'N')
		{
			$subjects     = $this->input->post('subjects[]');
			$insertData = array();
			foreach ($subjects as $key => $value) {

				$checkAlready = $this->sumit->checkData('*','subject_preferences',"teacher_id='$emp_id' AND subject_code='$value'");
				if($checkAlready==false)
				{
					$insertData[] = array(
						'teacher_id'	=> $emp_id,
						'subject_code'	=> $value
					);
				}
			}
			if(!empty($insertData))
			{
				$this->sumit->createMultiple('subject_preferences',$insertData);
			}
			echo "Saved Successfully";
		}
	}

	function getSubjectPreferencesData()
	{
		$teacher_id = $this->input->post('teacher_id');
		$data['subjectList'] = $this->sumit->fetchAllData('*,(SELECT SubName FROM subjects WHERE SubCode=s.subject_code)subject_name','subject_preferences s',"teacher_id='$teacher_id'");
		$this->load->view('teacher/subjectPreferencesTable',$data);
	}
}
  
