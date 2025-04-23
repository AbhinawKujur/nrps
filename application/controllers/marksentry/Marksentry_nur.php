<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marksentry_nur extends MY_controller{
	
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
		$this->render_template('marks_entry/marks_entry_nur',$array);
	}
	
	public function first_term($trm){
		$user_id = login_details['user_id'];
		
		$class_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Class_No = '1'");
		if($trm == 1){
			$examData = $this->alam->selectA('exammasterprep','*',"examcode=4");	
		}else{
			$examData = $this->alam->selectA('exammasterprep','*',"examcode=5");
		}
		
		$array = array('class_data'=>$class_data,'examData'=>$examData,'trm'=>$trm);
		
		$this->render_template('marks_entry/first_year_nur',$array);
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
		$subData = $this->alam->selectA('class_section_wise_subject_allocation','Class_No,section_no,subject_code,(SELECT SubName FROM subjects WHERE SubCode=class_section_wise_subject_allocation.subject_code)subjnm,Main_Teacher_Code',"Class_No = '$classs'AND section_no='$sec' AND subject_code NOT IN(16,36,37)");
		
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
		$trm  = $this->input->post('trm');
		$data['trm']  = $this->input->post('trm');
		$data['Class_No'] = $this->input->post('Class_No');
		$Class_No = $this->input->post('Class_No');
		$data['sec']      = $this->input->post('sec');
		$sec     = $this->input->post('sec');
		$exm_code = $this->input->post('exm_code');
		
		$data['skillData'] = $this->alam->selectA('subject_skill_master','skill_name',"class_code='$Class_No' AND subject_code='$sub' order by sorting_no");
		//check exists or not//
		$marksAllData = $this->alam->selectA('marks_all','count(*)cnt',"examcode='$exm_code' AND subject='$sub' AND class_code='$Class_No' AND sec_code='$sec' AND term='$trm'");
		$data['cnt'] = $marksAllData[0]['cnt'];
		$cnt = $marksAllData[0]['cnt'];
		if($cnt != 0){
			$data['stuData'] = $this->alam->selectA('student','ADM_NO,CLASS,SEC,ROLL_NO,FIRST_NM',"CLASS='$Class_No' AND SEC='$sec' AND Student_Status = 'ACTIVE' order by $sorting");
			
			$data['subSkillData'] = $this->alam->selectA('subject_skill_master','id,skill_name',"class_code='$Class_No' AND subject_code = '$sub'");
			
			$data['exm_typ'] = $this->input->post('exm_code');
			$data['classs']  = $this->input->post('Class_No');
			$data['sub']     = $this->input->post('sub');
		}
		$this->load->view('marks_entry/load_marksEntry_nur',$data);
	}
	
	public function save_nd_upd_prep(){
		$classs  = $this->input->post('classs');
		$sec     = $this->input->post('sec');
		$exm_typ = $this->input->post('exm_typ');
		$sub     = $this->input->post('sub');
		$sortby  = $this->input->post('sortby');
		$trm     = $this->input->post('trm');
		
		if($sortby == 'adm_no'){
			$sorting = 'ADM_NO';
		}else if($sortby == 'stu_name'){
			$sorting = 'FIRST_NM';
		}else{
			$sorting = 'ROLL_NO';
		}
		
		$subSkillData = $this->alam->selectA('subject_skill_master','id,skill_name',"class_code='$classs' AND subject_code = '$sub'");

		$admno = $this->input->post('admno[]');
		
		foreach($admno as $key => $val){
			foreach($subSkillData as $key1 => $val1){
				$save_data = array(
					'admno'         => $val,
					'examcode'      => $exm_typ,
					'subject'       => $sub,
					'subject_skill' => $val1['id'],
					'm2'            => $this->input->post('subskill_'.$key)[$key1],
					'm3'            => $this->input->post('subskill_'.$key)[$key1],
					'class_code'    => $classs,
					'sec_code'      => $sec,
					'term'          => $trm,
					'teacher_code'  => login_details['user_id'],
					'status'        => 1
				);
				$this->alam->insert('marks_all',$save_data);
			}
		}
		
		$stuData = $this->alam->selectA('student','ADM_NO,CLASS,SEC,ROLL_NO,FIRST_NM',"CLASS='$classs' AND SEC='$sec' AND Student_Status = 'ACTIVE' order by $sorting");
		
		?>
		<div class='tbl-responsive'>
		<input type='hidden' id='class_code' value='<?php echo $classs; ?>'>
		<input type='hidden' id='sec_code' value='<?php echo $sec; ?>'>
		<input type='hidden' id='exam_code' value='<?php echo $exm_typ; ?>'>
		<input type='hidden' id='sub' value='<?php echo $sub; ?>'>
		<input type='hidden' id='trm' value='<?php echo $trm; ?>'>
		<input type='hidden' id='sortby' value='<?php echo $sortby; ?>'>
			<table class='table' border='1'>
				<tr>
					<th>Adm No.</th>
					<th>Name</th>
					<th>Roll No</th>
					<?php
						foreach($subSkillData as $key => $val){
							?>
								<th><?php echo $val['skill_name']; ?></th>
							<?php
						}
					?>
				</tr>
				<?php
					foreach($stuData as $key => $val){
						$admno = $val['ADM_NO'];
						?>
						<tr>
							<td><?php echo $val['ADM_NO']; ?></td>
							<td><?php echo $val['FIRST_NM']; ?></td>
							<td><?php echo $val['ROLL_NO']; ?></td>
							<?php
								foreach($subSkillData as $key1 => $val1){
									$subskilId = $val1['id'];
									$subSill = $this->alam->selectA('marks_all','m2',"term='$trm' AND examcode='$exm_typ' AND class_code = '$classs' AND admno = '$admno' AND subject_skill = '$subskilId' AND subject = '$sub'");

									foreach($subSill as $key2 => $val2){
										if($val2['m2'] == 'AB'){	
								    ?>
										<td style='background:#efcece;'><?php echo $val2['m2']; ?></td>
								    <?php
										}else{
										?>
										<td><?php echo $val2['m2']; ?></td>
										<?php										
										}
									}
							    }
							?>
						</tr>	
						<?php
					}
				?>
				
			</table>
		</div>	
		<?php
	}
	
	function skill_upd(){
		$skill = $this->input->post('skill');
	    $id    = $this->input->post('id');
		
		$updData = array(
			'm2' => $skill,
			'm3' => $skill,
		);
		
		$this->alam->update('marks_all',$updData,"id='$id'");
	}
	
	function confirm(){
		$class_code = $this->input->post('class_code');
		$sec_code   = $this->input->post('sec_code');
		$exam_code  = $this->input->post('exam_code');
		$sub        = $this->input->post('sub');
		$trm        = $this->input->post('trm');
		
		$updData = array(
			'status' => 1
		);
		
		$this->alam->update('marks_all',$updData,"examcode='$exam_code' AND subject ='$sub' AND class_code='$class_code' AND sec_code='$sec_code' AND term = '$trm'");
	}
}