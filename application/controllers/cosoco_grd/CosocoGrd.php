<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CosocoGrd extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		$this->load->model('Mymodel','dbcon');
	}
	
	public function index(){
		$report_card_permission = $this->alam->selectA('report_card_permission','*');
		$t1 = $report_card_permission[0]['term1'];
		$t2 = $report_card_permission[0]['term2'];
		
		$array = array('t1'=>$t1,'t2'=>$t2);
		$this->teacher_template('grade_entry/grade_entry_term',$array);
	}
	
	public function cosoc($trm){
		$user_id    = login_details['user_id'];
		$Class_No   = login_details['Class_No'];
		
		$class_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Class_No IN (1,2,3,4,5,6,7)");
		if($trm == 1){
			$examData = $this->alam->selectA('exammasterprep','*',"examcode = 4");	
		}else{
			$examData = $this->alam->selectA('exammasterprep','*',"examcode = 5");
		}
		
		$array = array('class_data'=>$class_data,'examData'=>$examData,'trm'=>$trm,'Class_No'=>$Class_No);
		
		$this->render_template('grade_entry/co_scholastic_grade',$array);
	}
	
	public function classess(){
		$user_id  = login_details['user_id'];
		$ret = '';
		$Class_No = '';
		$ExamMode = '';
		$class = $this->input->post('val');
		
		$class_data = $this->dbcon->select('classes','Class_No,ExamMode',"Class_No='$class'");
		
		$Class_No = $class_data[0]->Class_No;
		$ExamMode = $class_data[0]->ExamMode;
		
		$sec_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Class_No = '$class'");
		
		$Section_No = login_details['Section_No'];
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				if($Section_No == $data['section_no']){
				 $ret .="<option value=". $data['section_no'] .">" . $data['secnm'] ."</option>";
				}
			}
		}
		
		$array = array($ret,$Class_No,$ExamMode);
		echo json_encode($array);
	}
	
	public function getSubject(){
		$user_id = login_details['user_id'];
		$classs = $this->input->post('classs');
		$sec    = $this->input->post('sec');
		$subData = $this->alam->selectA('class_section_wise_subject_allocation','Class_No,section_no,subject_code,(SELECT SubName FROM subjects WHERE SubCode=class_section_wise_subject_allocation.subject_code)subjnm,Main_Teacher_Code',"Class_No = '$classs' AND section_no='$sec' AND subject_code IN (16,36,37)");
		
		?>
			<option value=''>Select</option>
		<?php
		foreach($subData as $key => $val){
			?>	
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
			<?php
		}
	}
	
	public function stu_list(){
		$sortval  = $this->input->post('sortval');
		if($sortval == 'adm_no'){
			$data['sorting'] = 'ADM_NO';
			$sorting = 'ADM_NO';
		}else if($sortval == 'stu_name'){
			$data['sorting'] = 'FIRST_NM';
			$sorting = 'FIRST_NM';
		}else{
			$data['sorting'] = 'ROLL_NO';
			$sorting = 'ROLL_NO';
		}
		$sub  = $this->input->post('sub');
		$data['sub']  = $this->input->post('sub');
		$trm  = $this->input->post('trm');
		$data['trm']  = $this->input->post('trm');
		$data['Class_No'] = $this->input->post('Class_No');
		$Class_No = $this->input->post('Class_No');
		$data['sec']      = $this->input->post('sec');
		$sec     = $this->input->post('sec');
		$exm_code = $this->input->post('exm_code');
		$data['exm_code'] = $this->input->post('exm_code');
		$data['modal'] = $this->input->post('modal');
		
		$data['skillData'] = $this->alam->selectA('subject_skill_master',"id,IFNULL((SELECT maxmarks FROM maxmarks_all WHERE subj_skill_mstr_id=subject_skill_master.id AND examcode='$exm_code'),0)maxmarks,skill_name","class_code='$Class_No' AND subject_code='$sub' order by sorting_no");
		
		$this->load->view('grade_entry/load_marksEntry_nurtofive',$data);
	}
	
	function save_upd_validate(){
		$adm_no      = $this->input->post('admno[]');
		$classs      = $this->input->post('classs');
		$sec         = $this->input->post('sec');
		$exm_typ     = $this->input->post('exm_typ');
		$sub         = $this->input->post('sub');
		$trm         = $this->input->post('trm');
		$user_id     = login_details['user_id'];
		
		$subSkillData = $this->alam->selectA('subject_skill_master','id,skill_name',"class_code='$classs' AND subject_code = '$sub'");
		
		foreach($adm_no as $key => $val){
			
			foreach($subSkillData as $key1 => $val1){
				$subj_skill_id = $val1['id'];
				$exsitData = $this->alam->selectA('co_scholastic_grade_all','count(*)cnt',"admno='$val' AND subject='$sub' AND term = '$trm' AND subj_skill_id = '$subj_skill_id'");
			    $cnt = $exsitData[0]['cnt'];
				if($cnt == 0){
					$saveData = array(
						'admno' => $val,
						'class_code' => $classs,
						'sec_code' => $sec,
						'term' => $trm,
						'subject' => $sub,
						'subj_skill_id' => $subj_skill_id,
						'grade' => $this->input->post('subskill_'.$key)[$key1],
						'user_id' => $user_id
					);
					$this->alam->insert('co_scholastic_grade_all',$saveData);
				}else{
					$updData = array(
						'grade' => $this->input->post('subskill_'.$key)[$key1],
					);
					$this->alam->update('co_scholastic_grade_all',$updData,"admno='$val' AND class_code='$classs' AND sec_code='$sec' AND subj_skill_id = '$subj_skill_id' AND term='$trm' AND subject='$sub'");
				}
			}
		}
			
	}
}