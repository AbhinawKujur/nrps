<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marksentry_preptofive extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$report_card_permission = $this->alam->selectA('report_card_permission','*');
		$t1 = $report_card_permission[0]['term1'];
		$t2 = $report_card_permission[0]['term2'];
		
		$array = array('t1'=>$t1,'t2'=>$t2);
		$this->render_template('marks_entry/marks_entry_preptofive_term',$array);
	}
	
	public function first_term($trm){
		$user_id = login_details['user_id'];
		
		$class_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Class_No in (2,3,4,5,6,7)");
		if($trm == 1){
			$examData = $this->alam->selectA('exammasterprep','*',"examcode <> 5");	
		}else{
			$examData = $this->alam->selectA('exammasterprep','*',"examcode <> 4");
		}
		
		$array = array('class_data'=>$class_data,'examData'=>$examData,'trm'=>$trm);
		
		$this->render_template('marks_entry/first_year_perptofive',$array);
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
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data['section_no'] .">" . $data['secnm'] ."</option>";
			}
		}
		
		$array = array($ret,$Class_No,$ExamMode);
		echo json_encode($array);
	}
	
	public function getSubject(){
		$user_id = login_details['user_id'];
		$classs = $this->input->post('classs');
		$sec    = $this->input->post('sec');
		$subData = $this->alam->selectA('class_section_wise_subject_allocation','Class_No,section_no,subject_code,(SELECT SubName FROM subjects WHERE SubCode=class_section_wise_subject_allocation.subject_code)subjnm,Main_Teacher_Code',"Class_No = '$classs' AND section_no='$sec' AND subject_code NOT IN(16,36,37)");
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
		
		$data['skillData'] = $this->alam->selectA('subject_skill_master',"id,IFNULL((SELECT maxmarks FROM maxmarks_all WHERE subj_skill_mstr_id=subject_skill_master.id AND term='$trm' AND examcode='$exm_code'),0)maxmarks,skill_name","class_code='$Class_No' AND subject_code='$sub' order by sorting_no");
		
		$this->load->view('marks_entry/load_marksEntry_preptofive',$data);
	}
	
	function save_upd_validate(){
		$adm_no  = $this->input->post('admno');
		$exm_typ = $this->input->post('exm_typ');
		$sub     = $this->input->post('sub');
		$subskill_id     = $this->input->post('subskill_id');
		$trm     = $this->input->post('trm');
		
		$exsitData = $this->alam->selectA('marks_all','count(*)cnt',"admno='$adm_no' AND examcode='$exm_typ' AND subject='$sub' AND subject_skill='$subskill_id' AND term = '$trm'");
		
		$cnt = $exsitData[0]['cnt'];
		if($cnt == 0){
			$saveData = array(
				'admno'         => $adm_no,
				'examcode'      => $exm_typ,
				'subject'       => $sub,
				'subject_skill' => $subskill_id,
				'm1'            => $this->input->post('max_marks'),
				'm2'            => strtoupper($this->input->post('marks')),
				'm3'            => strtoupper($this->input->post('marks')),
				'class_code'    => $this->input->post('classs'),
				'sec_code'      => $this->input->post('sec'),
				'term'          => $trm,
				'teacher_code'  => login_details['user_id']
		    );
			$this->alam->insert('marks_all',$saveData);
		}else{
			$updData = array(
				'm2'            => strtoupper($this->input->post('marks')),
				'm3'            => strtoupper($this->input->post('marks'))
		    );
			$this->alam->update('marks_all',$updData,"admno='$adm_no' AND examcode='$exm_typ' AND subject='$sub' AND subject_skill='$subskill_id' AND term = '$trm'");
		}
	}
	
	function confirm(){
		$classs  = $this->input->post('classs');
		$sec     = $this->input->post('sec');
		$exm_typ = $this->input->post('exm_typ');
		$sub     = $this->input->post('sub');
		$trm     = $this->input->post('trm');
		$admno   = $this->input->post('admno[]');
		foreach($admno as $key => $val){
			$updData = array(
				'status' => 1
			);
			
			$this->alam->update('marks_all',$updData,"admno='$val' AND examcode='$exm_typ' AND subject='$sub' AND class_code='$classs' AND sec_code='$sec' AND term='$trm'");
		}
	}
}