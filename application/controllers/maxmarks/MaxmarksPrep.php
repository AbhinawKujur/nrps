<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MaxmarksPrep extends MY_Controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
	}
	
	public function index($class_grp){
		// $class_grp 1 = prep, $class_grp 2 = I - II, $class_grp 3 = III-V 
		$classes = $this->alam->select('classes','*');
		$report_card_permission = $this->alam->selectA('report_card_permission','*');
		$t1 = $report_card_permission[0]['term1'];
		$t2 = $report_card_permission[0]['term2'];
		$array = array('classes'=>$classes,'t1'=>$t1,'t2'=>$t2,'class_grp'=>$class_grp);
		$this->teacher_template('maxmarks/max_marks_allco_prep',$array);
	}
	
	public function chk_classes_exam_mode(){
		$classes  = $this->input->post('classes');
		$cls      = $this->dbcon->select('classes','ExamMode',"Class_No='$classes'");
		echo $ExamMode = $cls[0]->ExamMode;
	}
	
	public function term(){
		$ret  = '';
		$rett = '';
		$classes = $this->input->post('classes');
		$board   = $this->input->post('board');
		$term    = $this->input->post('term');
		if($term == 'T1'){
			$trm = 'TERM-1';
		}else{
			$trm = 'TERM-2';
		}
		$sqldata = $this->dbcon->select('exammasterprep','*');
		$ret .= "<option value=''>Select</option>";
		
		if($term == 'T1'){
		  foreach($sqldata as $key => $data){
			if($data->examcode != 5){
			  $ret .= "<option value=".$data->examcode .">".$data->examname ."</option>";
			}
		  }	
		}else{
			foreach($sqldata as $key => $data){
			if($data->examcode != 4){
			  $ret .= "<option value=".$data->examcode .">".$data->examname ."</option>";
			}
		  }	
		}
		
		$max_mrks_allco_trem = $this->dbcon->max_mrks_allco_trem($classes,$trm,$board);
		
		$rett .="
		  <table class='table' style='border:1px solid #5785c3'>
		    <tr style='background:#5785c3;'>
			  <th style='color:#fff!important;'>Sl No.</th>
			  <th style='color:#fff!important;'>Exam Name</th>
			  <th style='color:#fff!important;'>Subject Name</th>
			  <th style='color:#fff!important;'>Max Marks</th>
		    </tr>";
			$i=1;
			foreach($max_mrks_allco_trem as $max_data){
				$rett .="
				<tr>
				  <td>". $i ."</td>
				  <td>". $max_data->exmnm ."</td>
				  <td>". $max_data->subnm ."</td>
				  <td>". $max_data->MaxMarks ."</td>
				</tr>
				";
				$i++;
			}
		$rett .= "</table>";
		
		
		$array = array($ret,$rett);
		echo json_encode($array);
	}
	
	public function examination(){
		$ret  = '';
		$rett = '';
		
	    $exammode  = $this->input->post('exammode');
		$classcode = $this->input->post('classcode');
		$term      = $this->input->post('term');
		
		if($term == 'T1'){
			$term = '1';
		}else{
			$term = '2';
		}

		$examcode  = $this->input->post('examcode');
		
		$sqldata = $this->alam->select('subject_skill_master','subject_code,(SELECT SubName FROM subjects WHERE SubCode=subject_skill_master.subject_code)subjnm',"class_code = '$classcode' GROUP BY subject_code,subjnm");
		
		$ret .= "<option value=''>Select</option>";
		foreach($sqldata as $data){
			if($data->subject_code != 16 && $data->subject_code != 36 && $data->subject_code != 37){
			  $ret .= "<option value=" .$data->subject_code .">" .$data->subjnm ."</option>";
			}
		}
		
		$max_mrks_allco_exam = $this->dbcon->max_mrks_allco_exam_prep($classcode,$term,$examcode);
		
		$rett .="
		  <table class='table' style='border:1px solid #5785c3'>
		    <tr style='background:#5785c3;'>
			  <th style='color:#fff!important;'>Sl No.</th>
			  <th style='color:#fff!important;'>Exam Name</th>
			  <th style='color:#fff!important;'>Subject</th>
			  <th style='color:#fff!important;'>Skill Name</th>
			  <th style='color:#fff!important;'>Max Marks</th>
		    </tr>";
			$i=1;
			foreach($max_mrks_allco_exam as $max_data){
				$rett .="
				<tr>
				  <td>". $i ."</td>
				  <td>". $max_data->exmnm ."</td>
				  <td>". $max_data->subnm ."</td>
				  <td>". $max_data->skillnm ."</td>
				  <td>". $max_data->maxmarks ."</td>
				</tr>
				";
				$i++;
			}
		$rett .= "</table>";
		
		$array = array($ret,$rett);
		echo json_encode($array);
	}
	
	
	function fetchskill(){
		$subj_nm = $this->input->post('subj_nm');
		$subject = $this->input->post('subject');
		$class_code = $this->input->post('class_code');
		$term = $this->input->post('term');
		if($term == 'T1'){
			$trm = '1';
		}else{
			$trm = '2';
		}
		$skillData = $this->alam->selectA('subject_skill_master','*',"subject_code='$subject' AND opt_code='0' AND class_code = '$class_code'");
		?>
			<option>Select</option>
		<?php
		foreach($skillData as $key => $val){
			if($val['skill_name'] == 'N/A'){
				$skill = $subj_nm;
			}else{
				$skill = $val['skill_name'];
			}
			?>
				<option value='<?php echo $val['id']; ?>'><?php echo $skill; ?></option>
			<?php	
		}
	}
	
	public function save_upd_max_marks(){
		$classcode = $this->input->post('classcode');
		$classnm   = $this->input->post('classnm');
		$term      = $this->input->post('term');
		if($term == 'T1'){
			$termm  = '1';
		}else{
			$termm  = '2';
		}
		$examcode  = $this->input->post('examcode');
		$subcode  = $this->input->post('subcode');
		$max_marks = $this->input->post('max_marks');
		$skill     = $this->input->post('skill');
		
		$sqldata   = $this->dbcon->select('maxmarks_all','*',"examcode = '$examcode' AND class_code = '$classcode' AND term = '$termm' AND subject = '$subcode' AND subj_skill_mstr_id = '$skill'");
		$cnt = count($sqldata);
		if($cnt == 0){
			
			$ins_data = array(
			'examcode'           => $examcode,
			'maxmarks'           => $max_marks,
			'class_code'         => $classcode,
			'term'               => $termm,
			'subject'            => $subcode,
			'subj_skill_mstr_id' => $skill
			);
			
			$this->dbcon->insert('maxmarks_all',$ins_data);
			echo "Data Insert Successfully";
			
		}else{
			$sqldt = $this->dbcon->select('marks_all','*',"examcode = '$examcode' AND subject = '$subcode' AND class_code = '$classcode' AND term = '$termm'");
			$cntt = count($sqldt);
			if($cntt == 0){
				
				$upd_data = array(
				'maxmarks'     => $max_marks
				);
				$this->dbcon->update('maxmarks_all',$upd_data,"examcode='$examcode' AND subject='$subcode' AND class_code='$classcode' AND Term = '$termm' AND subj_skill_mstr_id='$skill'");
				echo "Data Update Successfully";
				
			}else{
				echo "Marks already inserted";
			}
		}
	}
}