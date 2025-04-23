<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewYourHW extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}

	public function index(){
		$class_code = $this->session->userdata('class_code');
		$sec_code   = $this->session->userdata('sec_code');
		$admno      = $this->session->userdata('adm');
		
		$data['homework'] = $this->alam->selectA('e_exam_questions_hw','*,(select SubName from subjects where SubCode=e_exam_questions_hw.subject)subjnm,(select count(final_submit_status) from e_exam_answers_hw where homework_id=e_exam_questions_hw.id AND final_submit_status="1" AND admno="'.$admno.'")cnt,(select count(teacher_final_copy_correction) from e_exam_answers_hw where homework_id=e_exam_questions_hw.id AND teacher_final_copy_correction="2" AND admno="'.$admno.'")teachercpycorrectedcnt,(select count(teacher_final_copy_correction) from e_exam_answers_hw where homework_id=e_exam_questions_hw.id AND teacher_final_copy_correction="1" AND admno="'.$admno.'")teachercpyPendingcnt',"classes='$class_code' AND sec='$sec_code' order by date(created_at)");
		
		$this->Parent_templete('parents_dashboard/e_exam/homework/homework',$data);
	}
	
	public function fetchQuestions($que_id){
		$admno      = $this->session->userdata('adm');
		$data['admno'] = $admno;
		$class_code = $this->session->userdata('class_code');
		$sec_code   = $this->session->userdata('sec_code');
		
		$queData = $this->alam->selectA('e_exam_questions_hw_append','*,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subject,(select classes from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)classes,(select sec from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)sec,(select submitDate from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)submitDate',"e_exam_questions_hw_id='$que_id'");
		
		$admExistData = $this->alam->selectA('e_exam_answers_hw','count(*)cnt',"first_insert_status='1' AND homework_id='$que_id'");
		$cnt = $admExistData[0]['cnt'];
		if($cnt == 0){
			foreach($queData as $key =>$val){
				$saveFirstTime = array(
					'homework_id'   	   => $val['e_exam_questions_hw_id'],
					'que_id'   			   => $val['id'],
					'question' 			   => $val['question'],
					'subj_id'  			   => $val['subject'],
					'admno'    			   => $admno,
					'class_no' 			   => $val['classes'],
					'sec_no'               => $val['sec'],
					'target_date'          => $val['submitDate'],
					'first_insert_status ' => 1,
				);
				
				$this->alam->insert('e_exam_answers_hw',$saveFirstTime);
			}
		}
		
		$data['classWiseQuestions'] = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm,(select ans from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND admno="'.$admno.'")ans,(select img from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND admno="'.$admno.'")img,(select answered_date from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND admno="'.$admno.'")answered_date,(select remarks from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND teacher_final_copy_correction="2" AND admno="'.$admno.'")remarks,(select updated_on from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND teacher_final_copy_correction="2" AND admno="'.$admno.'")updated_on',"e_exam_questions_hw_id='$que_id'");
		//echo $this->db->last_query();die;
		
		$data['subjective'] = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm,question_type,question,que_img,que_no',"e_exam_questions_hw_id='$que_id' AND question_type = '1'");
		
		$data['objective'] = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm,question_type,question,que_img,que_no',"e_exam_questions_hw_id='$que_id' AND question_type = '2'");
		
		$this->Parent_templete('parents_dashboard/e_exam/homework/viewYourHW',$data);
	}
	
	public function fetchQuestionsById(){
		$admno       = $this->session->userdata('adm');
		$homeworkId  = $this->input->post('homeworkId');
		$que_id      = $this->input->post('que_id');
		$que_no      = $this->input->post('que_no');
		$class_code  = $this->session->userdata('class_code');
		$sec_code    = $this->session->userdata('sec_code');
		
		$classWiseQuestions = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm,(select answered_date from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND admno="'.$admno.'")answered_date,(select remarks from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND teacher_final_copy_correction="2" AND admno="'.$admno.'")remarks,(select updated_on from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND teacher_final_copy_correction="2" AND admno="'.$admno.'")updated_on',"id='$que_id'");
		
		$subjective = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm,question_type,question,que_img,que_no',"question_type = '1' AND e_exam_questions_hw_id='$homeworkId'");
		
		$objective = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm,question_type,question,que_img,que_no',"question_type = '2' AND e_exam_questions_hw_id='$homeworkId'");
		
		?>
		<div class='row'>
			<div class='col-sm-9'></div>
			<div class='col-sm-3'>
				<button class='btn btn-warning btn-xs'>Active</button>
				<button class='btn btn-success btn-xs'>Answered</button>
				<button class='btn btn-danger btn-xs'>Unanswered</button>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-1 col-md-1'></div>
			<div class='col-sm-5 col-md-5'>
				<h3>Subjective (Click on Question No. to open)</h3>
				<?php
					foreach($subjective as $key => $val){
						
						$ansData = $this->alam->selectA('e_exam_answers_hw','id,que_id',"que_id='".$val['id']."' AND admno='$admno' AND ans_status='1'");
						$que_idd = (!empty($ansData[0]['que_id']))?$ansData[0]['que_id']:0;
				
						if($que_no == $val['que_no']){
						?>
							<button class='btn btn-warning btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php	
						}elseif($que_idd == $val['id']){
						?>
							<button class='btn btn-success btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php
						}else{
						?>
							<button class='btn btn-danger btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php	
						}
						
					}
				?>
			</div>
			<div class='col-sm-5 col-md-5'>
				<h3>Objective</h3>
				<?php
					foreach($objective as $key => $val){
						$ansData = $this->alam->selectA('e_exam_answers_hw','id,que_id',"que_id='".$val['id']."' AND admno='$admno' AND ans_status='1'");
						$que_idd = (!empty($ansData[0]['que_id']))?$ansData[0]['que_id']:0;
				
						if($que_no == $val['que_no']){
						?>
							<button class='btn btn-warning btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php	
						}elseif($que_idd == $val['id']){
						?>
							<button class='btn btn-success btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php
						}else{
						?>
							<button class='btn btn-danger btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php	
						}
					}
				?>
			</div>
			<div class='col-sm-1 col-md-1'></div>
		</div><br /><br />

		<div class='row'>
			<div class='col-sm-1 col-md-1'></div>
			<div class='col-sm-10 col-md-10'>
					<?php
						foreach($classWiseQuestions as $key => $val){
							
								$ansData = $this->alam->selectA('e_exam_answers_hw','ans,id,que_id,img',"que_id='".$val['id']."' AND admno='$admno' AND ans_status='1'");
								$ans = (!empty($ansData[0]['ans']))?$ansData[0]['ans']:'';
								$img = (!empty($ansData[0]['img']))?$ansData[0]['img']:'';
							
								?>
									<span style='font-size:20px;'>Q<?php echo $val['que_no']; ?>. </span>
									<span style='font-size:18px;'><?php echo $val['question']; ?></span>
								<?php
								?>
									<br /><span style='font-size:20px;'>Ans. </span><textarea class='form-control' id='ans' rows='6' readonly><?php echo $ans; ?></textarea><br />
				
				<?php if($img != ''){ ?>
									<a href='<?php echo base_url($img); ?>' target='_blank'><img src='<?php echo base_url($img); ?>' class='img-responsive' style='width:100px; height:100px;'></a><br />
									<?php } ?>
									<?php
										if($ans != ''){
									?>
									<div class='pull-right'><i><label class='label label-success'>Answered date & Time:- <?php echo date('d-M-y h:i',strtotime($val['answered_date'])); ?></label></i></div>
									<?php } ?>
									<br /><span style='font-size:20px;'>Teacher Remarks</span><textarea class='form-control' id='ans' rows='6' readonly><?php echo $val['remarks']; ?></textarea>
									<?php
									if($val['remarks'] == ''){
									?>
									
									<?php }else{
									?>
									<div class='pull-right'><i><label class='label label-success'>Remarks date & Time:- <?php echo date('d-M-y h:i',strtotime($val['updated_on'])); ?></label></i></div>
									<?php							
									} ?>
								<?php
						}
					?>	
			</div>
			<div class='col-sm-1 col-md-1'></div>
		</div><br /><br />
		<?php
	}
	
	public function saveAnsByQues(){
		$qusId   = $this->input->post('qusId');
		$adm = $this->session->userdata('adm');
		
		$upd = array(
			'ans'           => $this->input->post('ans'),
			'answered_date' => date('Y-m-d h:i:s'),
			'ans_status'    => 1,
		);
		
		$this->alam->update('e_exam_answers_hw',$upd,"admno='$adm' AND que_id='$qusId'");
	}
	
	public function exm_status(){
		$adm_no      = $this->session->userdata('adm');
		$homework_id = $this->input->post('homework_id');
		
			$upd = array(
			 'final_submit_status' => 1,				
			 'final_submit_by_stu' => date('Y-m-d h:i:s'),				
			);
			
		$this->alam->update('e_exam_answers_hw',$upd,"admno='$adm_no' AND homework_id='$homework_id'");
	}
}