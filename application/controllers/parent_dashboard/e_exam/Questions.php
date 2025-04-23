<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}

	public function index(){
		$class_code = $this->session->userdata('class_code');
		$classData = $this->alam->selectA('Classes','CLASS_NM',"Class_No='$class_code'");
		$data['classnm'] = $classData[0]['CLASS_NM']; 
		$sec_code   = $this->session->userdata('sec_code');
		$todayDate  = date('d-M-Y');
		$currTime   = date("g:i A");
		
		$data['class_code'] = $class_code;
		$data['sec_code']   = $sec_code;
		$data['questions'] = $this->alam->selectA('e_exam_questions','classes,sec,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,examDate,examTime,examTimeDuration',"classes='$class_code' AND sec='$sec_code' AND examDate='$todayDate' AND examTime <= '$currTime' AND exam_display_status='1' GROUP BY classes,sec,subject,examDate,examTime,subjnm,examTimeDuration");
		$this->Parent_templete('parents_dashboard/e_exam/questions',$data);
	}
	
	public function examList(){
		 $adm_no = $this->session->userdata('adm');
	     $class_code = $this->session->userdata('class_code');
	     $section = $this->session->userdata('sec_code');
		 
		 $data['e_exam_questions'] = $this->alam->selectA('e_exam_questions','classes,sec,subject,exam_display_status,(select CLASS_NM from classes where Class_No=e_exam_questions.classes)classnm, (select SECTION_NAME from sections where section_no=e_exam_questions.sec)secnm, (select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,examDate,examTime,examTimeDuration',"classes='$class_code' and sec='$section' GROUP BY classes,sec,subject,classnm,secnm,subjnm,examDate,examTime,examTimeDuration,exam_display_status order by examDate");
		 
		$this->Parent_templete('parents_dashboard/e_exam/examlist',$data);
	}
	
	public function timeRefresh(){
		$todayDate  = date('d-M-Y');
		$currTime   = date("g:i A");
		$class_code = $this->input->post('class_code');
		$sec_code   = $this->input->post('sec_code');
		
		$timeData = $this->alam->selectA('e_exam_questions','classes,sec,subject,examDate,examTime',"examDate='$todayDate' AND examTime >= '$currTime' AND exam_display_status='1' AND classes='$class_code' AND sec='$sec_code' group by classes,sec,subject,examDate,examTime");
		
		$examTime = $timeData[0]['examTime'];
		$examDate = $timeData[0]['examDate'];

		if($examTime == $currTime && $todayDate == $examDate){
			echo 1;
		}
	}
	
	public function fetchQuestions(){
		$admno = $this->session->userdata('adm');
		$stuNm = $this->alam->selectA('student','FIRST_NM',"ADM_NO='$admno'");
		$data['name'] = $stuNm[0]['FIRST_NM'];
		$data['admno'] = $admno;
		$subj_code = $this->input->post('subj_code');
		$data['subjCode'] = $subj_code;
		$class_code = $this->session->userdata('class_code');
		$sec_code   = $this->session->userdata('sec_code');
		$todayDate  = date('d-M-Y');
		$todayDatechk  = date('Y-m-d');
		$this->session->set_userdata('subj',$subj_code);
		
		$data['classWiseQuestions'] = $this->alam->selectA('e_exam_questions','id,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,question_type,question,que_img,max_marks,examTimeDuration,examDate,examTime,que_no',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_code' AND examDate='$todayDate'");
		
		$maxData = $this->alam->selectA('e_exam_questions','MAX(que_no)mxno',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_code' AND examDate='$todayDate'");
		$data['mxno'] = $maxData[0]['mxno'];
		
		$examTimeData = $this->alam->selectA('e_exam_questions','examTime',"classes='$class_code' AND sec = '$sec_code' AND examDate='$todayDate' group by examTime");
		
		$data['examTime'] = (!empty($examTimeData[0]['examTime']))?$examTimeData[0]['examTime']:'';
		
		$duration = (!empty($data['classWiseQuestions'][0]['examTimeDuration']))?$data['classWiseQuestions'][0]['examTimeDuration']:0;
		$time     = date('H:i:s',strtotime((!empty($data['classWiseQuestions'][0]['examTime']))?$data['classWiseQuestions'][0]['examTime']:0));
		$examDate = date('Y-m-d',strtotime((!empty($data['classWiseQuestions'][0]['examDate']))?$data['classWiseQuestions'][0]['examDate']:0));
		$e_date_time = $examDate." ".$time;
		
		$data['endtime']=date('M d, Y H:i:s',strtotime('+'.$duration.'minutes',strtotime($e_date_time)));
		
		
		$data['subjective'] = $this->alam->selectA('e_exam_questions','id,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,question_type,question,que_img,max_marks,examTimeDuration,examDate,examTime,que_no',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_code' AND examDate='$todayDate' AND question_type = '1'");
		
		$data['objective'] = $this->alam->selectA('e_exam_questions','id,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,question_type,question,que_img,max_marks,examTimeDuration,examDate,examTime,que_no',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_code' AND examDate='$todayDate' AND question_type = '2'");
		
		$chkansData = $this->alam->selectA('e_exam_answers','count(*)cnt',"admno='$admno' AND subj_id='$subj_code' AND date(created_at)='$todayDatechk' AND exam_attmpted_status='1'");
		
		$cnt = $chkansData[0]['cnt'];
		if($cnt > 0){
			echo "<h2 style='color:red; text-align:center'>You have already submitted your paper</h2>";
		}else{
			$this->load->view('parents_dashboard/e_exam/allQuestionByClasDate',$data);
		}
		
	}
	
	public function fetchQuestionsById(){
		$admno = $this->session->userdata('adm');
		$questionId = $this->input->post('questionId');
		$subj_code = $this->input->post('subj_id');
		$class_code = $this->session->userdata('class_code');
		$sec_code   = $this->session->userdata('sec_code');
		$todayDate  = date('d-M-Y');
		
		$savedAnsData = $this->alam->selectA('e_exam_answers','id,que_id,subj_id,admno,ans',"admno='$admno' AND que_id='$questionId' AND subj_id='$subj_code'");
		$answer = (!empty($savedAnsData[0]['ans']))?$savedAnsData[0]['ans']:'';
		
		$classWiseQuestions = $this->alam->selectA('e_exam_questions','id,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,question_type,question,que_img,max_marks,examTimeDuration,que_no',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_code' AND examDate='$todayDate'");
		
		$maxData = $this->alam->selectA('e_exam_questions','MAX(que_no)mxno',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_code' AND examDate='$todayDate'");
		$mxno = $maxData[0]['mxno'];
		
		$subjective = $this->alam->selectA('e_exam_questions','id,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,question_type,question,que_img,max_marks,examTimeDuration,examDate,examTime,que_no',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_code' AND examDate='$todayDate' AND question_type = '1'");
		
		$objective = $this->alam->selectA('e_exam_questions','id,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,question_type,question,que_img,max_marks,examTimeDuration,examDate,examTime,que_no',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_code' AND examDate='$todayDate' AND question_type = '2'");
		
		$queData = $this->alam->selectA('e_exam_questions','id,question,que_img,max_marks',"id='$questionId'");
		$id         = $queData[0]['id'];
		$question   = $queData[0]['question'];
		$que_img    = $queData[0]['que_img'];
		$max_marks  = $queData[0]['max_marks'];
		
		?>
		<div class='row'>
			<div class='col-sm-1'></div>
			<div class='col-sm-5'>
				<h3>Subjective (Click on Question No. to open)</h3>
				<?php
					foreach($subjective as $key => $val){
						$ansData = $this->alam->selectA('e_exam_answers','id,que_id',"que_id='".$val['id']."' AND admno='$admno'");
						$que_id = (!empty($ansData[0]['que_id']))?$ansData[0]['que_id']:0;
						
						if($que_id == $val['id']){
						?>
							<button class='btn btn-success btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php
						}else if($questionId == $val['id']){
						?>
							<button class='btn btn-warning btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php	
						}else{
						?>
							<button class='btn btn-danger btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php	
						}
					}
				?>
			</div>
			<div class='col-sm-5'>
				<h3>Objective</h3>
				<?php
					foreach($objective as $key => $val){
						$ansData = $this->alam->selectA('e_exam_answers','id,que_id',"que_id='".$val['id']."' AND admno='$admno'");
						$que_id = (!empty($ansData[0]['que_id']))?$ansData[0]['que_id']:0;
						if($que_id == $val['id']){
						?>
							<button class='btn btn-success btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php
						}else if($questionId == $val['id']){
						?>
							<button class='btn btn-warning btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php	
						}else{
						?>
							<button class='btn btn-danger btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
						<?php	
						}
					}
				?>
			</div>
			<div class='col-sm-1'></div>
		</div><br /><br />

		<div class='row'>
			<div class='col-sm-1'></div>
			<div class='col-sm-10'>
					<?php
						foreach($classWiseQuestions as $key => $val){
							if($questionId == $val['id']){
								?>
									<span style='font-size:20px;'>Q<?php echo $val['que_no']; ?>. </span>
									<span style='font-size:18px;'><?php echo $question; ?></span>
								<?php
								?>
									<br /><span style='font-size:20px;'>Ans. </span><textarea class='form-control' id='ans' rows='6'><?php echo $answer; ?></textarea><br />
									<center><button class='btn btn-success' onclick="saveAns(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>,<?php echo $val['que_no'] + 1; ?>,<?php echo $mxno; ?>)">Save</button><button class='btn btn-info pull-right' onclick="saveStatus('top')" style='background:#3c8dbc;'>SUBMIT PAPER</button></center>
								<?php
							}
						}
					?>
					<b style='color:red'>Note: <br />1. Click on Question No. to give the answer and click on Save Button. </b><br />
			        <b style='color:red'>2. After completion of all the answers, click on "SUBMIT PAPER" Button. </b><br />
			        <b style='color:red'>3. If Exam time is started, you can't go through other menu. </b>		
			</div>
			<div class='col-sm-1'></div>
		</div><br /><br />
		<?php
	}
	
	public function saveAnsByQues(){
		$qusId   = $this->input->post('qusId');
		$subj_id = $this->input->post('subj_id');
		$adm = $this->session->userdata('adm');
		$class_code = $this->session->userdata('class_code');
		$sec_code = $this->session->userdata('sec_code');
		$todayDate  = date('d-M-Y');
		
		$save = array(
			'que_id'   => $qusId,
			'subj_id'  => $subj_id,
			'admno'    => $adm,
			'class_no' => $class_code,
			'sec_no  ' => $sec_code,
			'ans'      => $this->input->post('ans')
		);
		
		$upd = array(
			'ans'      => $this->input->post('ans')
		);
		
		$exstData = $this->alam->selectA('e_exam_answers','count(*)cnt',"admno='$adm' AND que_id='$qusId'");
		$cnt = $exstData[0]['cnt'];
		
		if($cnt == 0){
			$this->alam->insert('e_exam_answers',$save);
		}else{
			$this->alam->update('e_exam_answers',$upd,"admno='$adm' AND que_id='$qusId'");
		}
		//save end
		// $queNoData = $this->alam->selectA('e_exam_questions','que_no',"id='$qusId' AND classes='$class_code' AND sec = '$sec_code' AND subject='$subj_id' AND examDate='$todayDate'");
		
		// $mxqueNoData = $this->alam->selectA('e_exam_questions','max(que_no)maxQue',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_id' AND examDate='$todayDate'");
		// $maxQue = $mxqueNoData[0]['maxQue'];
		// $chkQue = $queNoData[0]['que_no'] + 1;
		// if($chkQue <= $maxQue){
			// $queNo = $queNoData[0]['que_no'] + 1;
		// }
		// else{
		    // $queNo = 1;	
		// }
			
		
		// $savedAnsData = $this->alam->selectA('e_exam_answers','id,que_id,subj_id,admno,ans',"admno='$adm' AND que_id='$qusId' AND subj_id='$subj_id'");
		// $answer = (!empty($savedAnsData[0]['ans']))?$savedAnsData[0]['ans']:'';
		
		// $classWiseQuestions = $this->alam->selectA('e_exam_questions','id,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,question_type,question,que_img,max_marks,examTimeDuration,que_no',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_id' AND examDate='$todayDate'");
		
		// $maxData = $this->alam->selectA('e_exam_questions','MAX(que_no)mxno',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_id' AND examDate='$todayDate'");
		// $mxno = $maxData[0]['mxno'];
		
		// $subjective = $this->alam->selectA('e_exam_questions','id,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,question_type,question,que_img,max_marks,examTimeDuration,examDate,examTime,que_no',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_id' AND examDate='$todayDate' AND question_type = '1'");
		
		// $objective = $this->alam->selectA('e_exam_questions','id,subject,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm,question_type,question,que_img,max_marks,examTimeDuration,examDate,examTime,que_no',"classes='$class_code' AND sec = '$sec_code' AND subject='$subj_id' AND examDate='$todayDate' AND question_type = '2'");
		
		// $queData = $this->alam->selectA('e_exam_questions','id,question,que_img,max_marks,',"que_no='$queNo' AND classes='$class_code' AND sec = '$sec_code' AND subject='$subj_id' AND examDate='$todayDate'");
		// $id         = (!empty($queData[0]['id']))?$queData[0]['id']:0;
		// $question   = (!empty($queData[0]['question']))?$queData[0]['question']:0;
		// $que_img    = (!empty($queData[0]['que_img']))?$queData[0]['que_img']:0;
		// $max_marks  = (!empty($queData[0]['max_marks']))?$queData[0]['max_marks']:0;
		
		?>
		<!--<div class='row'>
			<div class='col-sm-1'></div>
			<div class='col-sm-5'>
				<h3>Subjective (Click on Question No. to open)</h3>
				<?php
					//foreach($subjective as $key => $val){
						//$ansData = $this->alam->selectA('e_exam_answers','id,que_id',"que_id='".$val['id']."' AND admno='$adm'");
						//$que_id = (!empty($ansData[0]['que_id']))?$ansData[0]['que_id']:0;
						
						//if($que_id == $val['id']){
						?>
							<button class='btn btn-success btn-sm' onclick="queClick(<?php //echo //$val['id']; ?>,<?php //echo $val['subject']; ?>)"><?php //echo "Q. ".(//$val['que_no']); ?></button>
						<?php
						//}else if($queNo == $val['que_no']){
						?>
							<button class='btn btn-warning btn-sm' onclick="queClick(<?php //echo //$val['id']; ?>,<?php //echo $val['subject']; ?>)"><?php //echo "Q. ".(//$val['que_no']); ?></button>
						<?php	
						//}else{
						?>
							<button class='btn btn-danger btn-sm' onclick="queClick(<?php //echo //$val['id']; ?>,<?php //echo $val['subject']; ?>)"><?php //echo "Q. ".(//$val['que_no']); ?></button>
						<?php	
						//}
					//}
				?>
			</div>
			<div class='col-sm-5'>
				<h3>Objective</h3>
				<?php
					//foreach($objective as $key => $val){
						//$ansData = $this->alam->selectA('e_exam_answers','id,que_id',"que_id='".$val['id']."' AND admno='$adm'");
						//$que_id = (!empty($ansData[0]['que_id']))?$ansData[0]['que_id']:0;
						
						//if($que_id == $val['id']){
						?>
							<button class='btn btn-success btn-sm' onclick="queClick(<?php //echo //$val['id']; ?>,<?php //echo $val['subject']; ?>)"><?php //echo "Q. ".(//$val['que_no']); ?></button>
						<?php
						//}else if($queNo == $val['que_no']){
						?>
							<button class='btn btn-warning btn-sm' onclick="queClick(<?php //echo //$val['id']; ?>,<?php //echo $val['subject']; ?>)"><?php //echo "Q. ".(//$val['que_no']); ?></button>
						<?php	
						//}else{
						?>
							<button class='btn btn-danger btn-sm' onclick="queClick(<?php //echo //$val['id']; ?>,<?php //echo $val['subject']; ?>)"><?php //echo "Q. ".(//$val['que_no']); ?></button>
						<?php	
						//}
					//}
				?>
			</div>
			<div class='col-sm-1'></div>
		</div><br /><br />

		<div class='row'>
			<div class='col-sm-1'></div>
			<div class='col-sm-10'>
					<?php
						//foreach($classWiseQuestions as $key => $val){
							//if($qusId == $val['id']){
								?>
									<span style='font-size:20px;'>Q<?php //echo $queNo; ?>. </span>
									<span style='font-size:18px;'><?php //echo $question; ?></span>
								<?php
								?>
									<br /><span style='font-size:20px;'>Ans. </span>
									<textarea class='form-control' id='ans' rows='6'><?php //echo $answer; ?></textarea><br />
									<center><button class='btn btn-success' onclick="saveAns(<?php //echo $id; ?>,<?php //echo $val['subject']; ?>,<?php //echo $val['que_no'] + 1; ?>,<?php //echo $mxno; ?>)">Save and Next</button></center>
									<button class='btn btn-info pull-right' onclick="saveStatus('top')">SUBMIT PAPER</button>
								<?php
							//}
						//}
					?>	
			</div>
			<div class='col-sm-1'></div>
		</div><br /><br />-->
		<?php
	}
	
	public function exm_status(){
		$adm_no   = $this->session->userdata('adm');
		$subjCode = $this->input->post('subjCode');
		$date     =  date('Y-m-d')."<br />";
		
			$upd = array(
			 'exam_attmpted_status' => 1,				
			);
			
		$this->alam->update('e_exam_answers',$upd,"admno='$adm_no' AND subj_id='$subjCode' AND date(created_at)='$date'");
	}
}