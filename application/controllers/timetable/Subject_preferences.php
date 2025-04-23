<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_preferences extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');
	}
	public function index()
	{
		$data['teacher_data'] 	=$this->pawan->selectA('employee','*',"STAFF_TYPE='1'");		
		$this->render_template('timetable/subject_preferences',$data);
	}
	/******************Insert Data subject_preferences Table*******************/
	public function save_preference(){
		$emp_id		=$this->input->post('tech_name');
		$delete		=$this->pawan->del_sub_preferences($emp_id);		
		$sub_pref	=$this->input->post('sub_pref');
		$arrcon		=count($sub_pref);
			for($i=0;$i<$arrcon;$i++){
				$sub_id	=$sub_pref[$i];
				$array=array(
				'teacher_id'	=>$emp_id,
				'subject_code'	=>$sub_id,
			);
			$this->pawan->insert('subject_preferences',$array);
		}
		
		$this->session->set_flashdata('success',"Data Updated Successfully");
		redirect('timetable/subject_preferences');
	}
	
	/*************************Subject Details************************/	
	public function teacher_details(){
		$empid		=$this->input->post('empid');		
		$subje_det	=$this->pawan->selectA('subjects','*');		
		?>
		<label>Subject List</label><br><br>
		<?php
		foreach($subje_det as $key =>$val){
			$SubCode = $val['SubCode'];
			$subje_assin=$this->pawan->selectA('subject_preferences','*',"teacher_id='$empid' AND Subject_code='$SubCode'");
			$subjCode = '';
			if(!empty($subje_assin)){
				$subjCode = $subje_assin[0]['subject_code'];
			}
			?>
				<div class='col-md-6'>
					<input type='checkbox' value="<?=$val['SubCode']?>"<?php if($subjCode==$val['SubCode']){ echo 'checked';} ?> name="sub_pref[]">  <?=$val['SubName']?>
				</div>
			<?php
		}
	
	}
}
