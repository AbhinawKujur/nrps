<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homework extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}

	public function index(){
		$class_code = $this->session->userdata('class_code');
		$sec_code   = $this->session->userdata('sec_code');
		$admno      = $this->session->userdata('adm');
		
		$data['homework'] = $this->alam->selectA('e_exam_questions_hw','*,(select SubName from subjects where SubCode=e_exam_questions_hw.subject)subjnm,(select count(final_submit_status) from e_exam_answers_hw where homework_id=e_exam_questions_hw.id AND final_submit_status="1" AND admno="'.$admno.'")cnt,(select count(teacher_final_copy_correction) from e_exam_answers_hw where homework_id=e_exam_questions_hw.id AND teacher_final_copy_correction="2" AND admno="'.$admno.'")teachercpycorrectedcnt,(select count(teacher_final_copy_correction) from e_exam_answers_hw where homework_id=e_exam_questions_hw.id AND teacher_final_copy_correction="1" AND admno="'.$admno.'")teachercpyPendingcnt',"classes='$class_code' AND sec='$sec_code' AND homework_display_status='1' order by date(created_at)");
		
		$this->Parent_templete('parents_dashboard/e_exam/homework/homework',$data);
	}
	
	public function fetchQuestions($que_id){
		$admno      = $this->session->userdata('adm');
		$data['admno'] = $admno;
		$class_code = $this->session->userdata('class_code');
		$sec_code   = $this->session->userdata('sec_code');
		
		$queData = $this->alam->selectA('e_exam_questions_hw_append','*,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subject,(select classes from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)classes,(select sec from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)sec,(select submitDate from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)submitDate',"e_exam_questions_hw_id='$que_id'");
		
		$admExistData = $this->alam->selectA('e_exam_answers_hw','count(*)cnt',"first_insert_status='1' AND homework_id='$que_id' AND admno='$admno'");
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
		
		$data['classWiseQuestions'] = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,que_img,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm,(select ans from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND admno="'.$admno.'")ans,(select img from e_exam_answers_hw where que_id=e_exam_questions_hw_append.id AND admno="'.$admno.'")img',"e_exam_questions_hw_id='$que_id'");
		//echo $this->db->last_query();die;
		
		$data['subjective'] = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm,question_type,question,que_img,que_no',"e_exam_questions_hw_id='$que_id' AND question_type = '1'");
		
		$data['objective'] = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm,question_type,question,que_img,que_no',"e_exam_questions_hw_id='$que_id' AND question_type = '2'");
		
		$this->Parent_templete('parents_dashboard/e_exam/homework/allQuestionByClass',$data);
	}
	
	public function fetchQuestionsById(){
		$admno       = $this->session->userdata('adm');
		$homeworkId  = $this->input->post('homeworkId');
		$que_id      = $this->input->post('que_id');
		$que_no      = $this->input->post('que_no');
		$class_code  = $this->session->userdata('class_code');
		$sec_code    = $this->session->userdata('sec_code');
		
		$classWiseQuestions = $this->alam->selectA('e_exam_questions_hw_append','id,e_exam_questions_hw_id,que_no,question,que_img,(select subject from e_exam_questions_hw where id=e_exam_questions_hw_append.e_exam_questions_hw_id)subj_id,(select SubName from subjects where SubCode=subj_id)subjnm',"id='$que_id'");
		
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
					<form id='ansSave' enctype='multipart/form-data'>
					<?php
						foreach($classWiseQuestions as $key => $val){
								$que_img = $val['que_img'];
								$ansData = $this->alam->selectA('e_exam_answers_hw','ans,id,que_id,img',"que_id='".$val['id']."' AND admno='$admno' AND ans_status='1'");
								$ans = (!empty($ansData[0]['ans']))?$ansData[0]['ans']:'';
								$img = (!empty($ansData[0]['img']))?$ansData[0]['img']:'';
							
								?>
									<span style='font-size:20px;'>Q<?php echo $val['que_no']; ?>. </span>
									<span style='font-size:18px;'><?php echo $val['question']; ?><input type='hidden' name='qusId' value='<?php echo $val['id']; ?>'></span><br />
									<?php if($que_img != ''){ ?>
									<img src='<?php echo base_url($que_img); ?>' class='img-responsive' style='width:100px; height:100px;'><br />
									<?php } ?>
								<?php
								?>
									<br /><span style='font-size:20px;'>Ans. </span><textarea class='form-control' name='ans' id='ans' rows='6'><?php echo $ans; ?></textarea><br />
									<input type='file' name='img' class='filePHOTO'><br />
									<?php if($img != ''){ ?>
									<img src='<?php echo base_url($img); ?>' class='img-responsive' style='width:100px; height:100px;'><br />
									<?php } ?>
									<center><button type='submit' class='btn btn-success' onclick="saveAns()"><i class="fa fa-circle-o-notch fa-spin" id='process' style='display:none;'></i> Save Answer</button><button class='btn btn-info pull-right' onclick="saveStatus(<?php echo $val['e_exam_questions_hw_id']; ?>)" style='background:#3c8dbc;'>SUBMIT HOMEWORK</button></center>
									<script>	
										$(".filePHOTO").change(function(){
											var file_size = $('.filePHOTO')[0].files[0].size;
											var ext = $('.filePHOTO').val().split('.').pop().toLowerCase();
												if(file_size > 1048576 || (ext != 'jpg') && (ext != 'jpeg') && (ext != 'png')){
													toastr.error('File size must be less than 1000kb and only allowed jpg,jpeg,png format');
													$(".filePHOTO").val('');
												}
											return true;
										});
										
										$("#ansSave").on("submit", function (event) {
											event.preventDefault();
											$("#btn").prop('disabled',true);
											$("#process").show();
											let ans = $("#ans").val();
											if(ans != ''){
											var formData = new FormData(this);
											$.ajax({
													url: "<?php echo base_url('parent_dashboard/e_exam/homework/Homework/saveAnsByQues'); ?>",
													type: "POST",
													data:formData,
													cache:false,
													contentType: false,
													processData: false,
													success: function(data){
														$("#btn").prop('disabled',false);
														$("#process").hide();
														$("#addQuestionForm").trigger("reset");
														location.reload();
													}
												});
												}else{
													toastr.error('Please write answer first..!!!');
													$("#btn").prop('disabled',false);
													$("#process").hide();
												}
											 });
									</script>	
								<?php
						}
					?>
					</form>	
					<b style='color:red'>Note: <br />1. Click on Question No. to give the answer and click on "Save Answer" Button. </b><br />
					<b style='color:red'>2. After completion of all the answers, click on "SUBMIT HOMEWORK" Button. </b><br/>
					<b style='color:red'>3. Once clicked on "SUBMIT HOMEWORK" Button it cannot be modified.</b><br/>
			</div>
			<div class='col-sm-1 col-md-1'></div>
		</div><br /><br />
		<?php
	}
	
	public function saveAnsByQues(){
		$qusId   = $this->input->post('qusId');
		$imgdata = $this->alam->selectA('e_exam_answers_hw','id,img,img_status,',"que_id='$qusId'");
		$img = $imgdata[0]['img'];
		$adm = $this->session->userdata('adm');
		
		if(!empty($_FILES['img']['name'])){
			$image              = $_FILES['img']['name']; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = strtotime('now'). mt_rand() .'.'.$image_ext;
			$imagepath          = "uploads/e_exam_hw/".$image_name;
			$img_satus          = 1;
				
		move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
		}else{
			$imagepath  = $img;
			$img_satus  = 0;
		}
		
		$upd = array(
			'ans'           => $this->input->post('ans'),
			'answered_date' => date('Y-m-d h:i:s'),
			'ans_status'    => 1,
			'img'           => $imagepath,
			'img_status'    => $img_satus
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