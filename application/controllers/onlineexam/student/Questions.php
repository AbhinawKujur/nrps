<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}
	public function index(){
		$this->parentLoggedOut();
		$duration         = $this->session->userdata('duration');
		$end_time         = $this->session->userdata('end_time');
		$subject_id       = $this->session->userdata('subject_id');
		$data['subjnm']   = $this->session->userdata('subjnm');
		$data['examnm']   = $this->session->userdata('examnm');
		$data['exam_pattern'] = $this->session->userdata('exam_pattern');
		$exam_schedule_id = $this->session->userdata('exam_schedule_id');
		$login_status     = $this->session->userdata('login_status');
		$exam_date        = date('Y-m-d',strtotime($this->session->userdata('exam_date')));
		$data['timer']    = date('Y-m-d H:i:s',strtotime($exam_date.' '.$end_time));
		
		$adm              = $this->session->userdata('adm');
		$class_code       = $this->session->userdata('class_code');
		$sec_code         = $this->session->userdata('sec_code');
		
        $getQue = $this->alam->selectA('online_exam_question','*',"schedule_id='$exam_schedule_id'");
		
		$getAnsData = $this->alam->selectA('online_exam_answers','count(*)cnt',"exam_schedule_id='$exam_schedule_id' AND admno='$adm'");
		$cnt = $getAnsData[0]['cnt'];
		
		if($cnt == 0){
			foreach($getQue as $key => $val){
				$saveFirstTime = array(
					'exam_schedule_id'    => $exam_schedule_id,
					'exam_pattern'        => $val['exam_ptern_id'],
					'que_id'              => $val['id'],
					'subj_id'             => $subject_id,
					'admno'               => $adm,
					'class_no'            => $class_code,
					'sec_no'              => $sec_code, 
					'first_insert_status' => 1
				);
				$this->alam->insert('online_exam_answers',$saveFirstTime);
			}	
		}
		
		$data['getQueAndAns'] = $this->db->query("SELECT que_tbl.*,ans_tbl.id as ans_id,ans_tbl.ans,ans_tbl.ans_status,ans_tbl.img,ans_tbl.img_status FROM `online_exam_answers` as ans_tbl JOIN online_exam_question as que_tbl ON ans_tbl.que_id=que_tbl.id WHERE ans_tbl.exam_schedule_id='$exam_schedule_id' AND ans_tbl.admno='$adm'")->result_array();
		
		$chkLoginFinalSubmit = $this->alam->selectA('online_exam_answers','count(DISTINCT(admno))cnt',"exam_schedule_id='$exam_schedule_id' AND admno='$adm' AND final_submit_status='1' AND date(final_submit_by_stu)='$exam_date'");
		$login_cnt = $chkLoginFinalSubmit[0]['cnt'];
		
		if($login_cnt == 0){ // check login to after exam
			$this->session->unset_userdata('msg');
			$this->load->view('onlineexam/student/questions',$data);	
		}else{
			$this->session->unset_userdata('msg');
			$this->session->set_userdata('msg',"You have already submitted your paper...!");
			redirect('onlineexam/student/OnlineExamStu');
		}
		
		
	}
	
	/*public function getOnlyStartTime(){
		// $getData          = $this->db->query("SELECT CURRENT_TIMESTAMP as currentDatetime")->result_array();
		// $currentDatetime  = $getData[0]['currentDatetime'];
		echo $start_time       = date('M d, Y H:i:s');
	}*/
	
	public function finalSave(){
		$this->session->unset_userdata('msg');
		$adm = $this->session->userdata('adm');
		$exam_schedule_id = $this->session->userdata('exam_schedule_id');
		
		$upd = array(
			'final_submit_status' => 1,
			'final_submit_by_stu' => date('Y-m-d H:i:s')
		);
		
		$updStuTbl = array(
			'RemID' => 0
		); // for login status(RemID) from student tbl (0=login,1=you have no permission)
		
		$this->alam->update('student',$updStuTbl,"ADM_NO='$adm'");
				
		$this->alam->update('online_exam_answers',$upd,"exam_schedule_id='$exam_schedule_id' AND admno='$adm'");
		redirect('onlineexam/student/OnlineExamStu');
	}
	
	public function saveAns(){
		$ans_id           = $this->input->post('ans_id');
		$exam_schedule_id = $this->session->userdata('exam_schedule_id');
		$adm              = $this->session->userdata('adm');
		$exam_pattern     = $this->input->post('exam_pattern');
		$que_max_marks    = $this->input->post('que_max_marks');
		$ans_key          = $this->input->post('ans_key');
		$opt_radio        = $this->input->post('opt_radio');
		$subjectiveAns    = $this->input->post('subjectiveAns');
		$ans_status       = $this->input->post('ans_status');
		
		
		$maxQueNo = $this->alam->selectA('online_exam_question','MAX(qus_no)max',"schedule_id='$exam_schedule_id'");
		$qus_no1=$this->input->post('qus_no') + 1;
		$max = $maxQueNo[0]['max'];
		if($max < $qus_no1){
			$qus_no  = 1;
		}else{
			$qus_no   = $this->input->post('qus_no') + 1;
		}
		
		$subjnm   = $this->session->userdata('subjnm');
		$examnm   = $this->session->userdata('examnm');
		$data['exam_pattern'] = $this->session->userdata('exam_pattern');
		$sheduler_exam_pattern = $data['exam_pattern'];

		if($exam_pattern == 2){ // MCQ
			$corctmarks=0;
			if($opt_radio != ''){
				if($ans_key == $opt_radio){
					$corctmarks = $que_max_marks;
				}else{
					$corctmarks = 0;
				}
				
				$updData = array(
					'ans'           => $opt_radio,
					'ans_status'    => 1,
					'stu_marks'     => 	$corctmarks,
					'answered_date' => date('Y-m-d H:i:s')
				);
				
				$this->alam->update('online_exam_answers',$updData,"id='$ans_id' AND exam_schedule_id='$exam_schedule_id' AND admno='$adm'");
			}
			
		}else{ // for subjective;
			if($subjectiveAns != ''){
				
				$updData = array(
					'ans'           => $subjectiveAns,
					'ans_status'    => 1,
					'answered_date' => date('Y-m-d H:i:s')
				);
				
				$this->alam->update('online_exam_answers',$updData,"id='$ans_id' AND exam_schedule_id='$exam_schedule_id' AND admno='$adm'");
				
				if(!empty($_FILES['subjectiveImg']['name'])){
					$filepth1='online_exam/'.$exam_schedule_id;
					   if(!is_dir($filepth1)){
						 mkdir($filepth1, 0755);
					   }
					
					$filepath2='online_exam/'.$exam_schedule_id.'/answer';
					if(!is_dir($filepath2)){
					 mkdir($filepath2, 0755);
					}
						$image              = $_FILES['subjectiveImg']['name']; 
						//$expimage           = explode('.',$image);				
						//$image_ext          = $expimage[1];
					    $image_ext          =substr(strrchr($image,'.'),1);
						$image_name         =  'A'.$ans_id.'.'.$image_ext;
						$imagepath          = $filepath2.'/'.$image_name;
							
					move_uploaded_file($_FILES["subjectiveImg"]["tmp_name"],$imagepath);
					
					$qusimg	=	array(
						'img'	=> $imagepath,
						'img_status' => 1
					);
					
					$this->alam->update('online_exam_answers',$qusimg,"id='$ans_id' AND exam_schedule_id='$exam_schedule_id' AND admno='$adm'");
				}
			}
		}
		
		$getQueAndAns1 = $this->db->query("SELECT que_tbl.*,ans_tbl.id as ans_id,ans_tbl.ans,ans_tbl.ans_status,ans_tbl.img,ans_tbl.img_status FROM `online_exam_answers` as ans_tbl JOIN online_exam_question as que_tbl ON ans_tbl.que_id=que_tbl.id WHERE ans_tbl.exam_schedule_id='$exam_schedule_id' AND ans_tbl.admno='$adm'")->result_array();
		
		$getQueAndAns = $this->db->query("SELECT que_tbl.*,ans_tbl.id as ans_id,ans_tbl.ans,ans_tbl.ans_status,ans_tbl.img,ans_tbl.img_status FROM `online_exam_answers` as ans_tbl JOIN online_exam_question as que_tbl ON ans_tbl.que_id=que_tbl.id WHERE ans_tbl.exam_schedule_id='$exam_schedule_id' AND ans_tbl.admno='$adm' AND que_tbl.qus_no='$qus_no'")->result_array();
		
		?>

<div class='row'>
  <div class='col-sm-3' style='border-right:1px solid #000;'>
    <label><u>Subject : <?php echo $subjnm; ?></u></label>
    <br />
    <!--<button class='btn btn-warning btn-xs'>Active</button>-->
    <button class='btn btn-success btn-xs'>Answered</button>
    <button class='btn btn-danger btn-xs'>Unanswered</button>
    <br />
    <br />
    <?php
			if($sheduler_exam_pattern == 2){ //MCQ
				echo "<label><u>MCQ</u></label><br />";
				foreach($getQueAndAns1 as $key => $val){
					if($val['exam_ptern_id'] == 2){
						if($val['ans_status'] != 1){
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}else{
							?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}
					}
				}
			}else if($sheduler_exam_pattern == 1){ //subjective
				echo "<label><u>SUBJECTIVE</u></label><br />";
				foreach($getQueAndAns1 as $key => $val){
					if($val['exam_ptern_id'] == 1){
						if($val['ans_status'] != 1){
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}else{
							?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}
					}
				}
			}else if($sheduler_exam_pattern == 3){ //both
				echo "<label><u>MCQ</u></label><br />";
				foreach($getQueAndAns1 as $key => $val){
					if($val['exam_ptern_id'] == 2){
						if($val['ans_status'] != 1){
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}else{
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}
					}
				}
				echo "<br /><br /><label><u>SUBJECTIVE</u></label><br />";
				foreach($getQueAndAns1 as $key => $val){
					if($val['exam_ptern_id'] == 1){
						if($val['ans_status'] != 1){
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}else{
							?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}
					}
				}
			}
		?>
  </div>
  <form id='ansSave' method='post' enctype='multipart/form-data'>
    <div class='col-sm-9'>
    <!--- view questions -->
    <?php
					foreach($getQueAndAns as $key => $val){
						//if($val['qus_no'] == 1){
							?>
    <div class='row'>
      <div class='col-sm-10'>
        <table>
          <tr>
            <td valign="top"><h3><?php echo "Q. ".$val['qus_no']; ?>&nbsp;&nbsp;</h3></td>
            <td valign="top"><h3><?php echo $val['question']; ?></h3>
			   &nbsp;&nbsp;<span style="float:right;" class='label label-danger'><?php echo "Max Marks:".$val['marks']; ?></span>
			  </td>
          </tr>
        </table>
      </div>
      <!-- for question -->
      <div id="mdb-lightbox-ui"></div>
      <?php
								if(!empty($val['qus_img'])){
									?>
      <a href="<?php echo base_url($val['qus_img']); ?>" data-size="1600x1067">
      <div class='col-sm-2 mdb-lightbox no-margin'> <img src="<?php echo base_url($val['qus_img']); ?>" class='img-responsive' style='width:100px; height:100px;'> </div>
      <!-- for image -->
      </a>
      <?php } ?>
    </div>
    <input type='hidden' value='<?php echo $val['ans_id']; ?>' name='ans_id'>
    <input type='hidden' value='<?php echo $val['exam_ptern_id']; ?>' name='exam_pattern'>
    <input type='hidden' value='<?php echo $val['marks']; ?>' name='que_max_marks'>
    <input type='hidden' value='<?php echo $val['ans_key']; ?>' name='ans_key'>
    <input type='hidden' value='<?php echo $val['ans_status']; ?>' name='ans_status'>
    <input type='hidden' value='<?php echo $val['qus_no']; ?>' name='qus_no'>
    <?php
								if($val['exam_ptern_id'] == 2){ //MQC
									$opt_val = '';
									for($i=1; $i<=$val['obj_no_option']; $i++){
										if($i == 1){
											$opt_val = 'A';
										}else if($i == 2){
											$opt_val = 'B';
										}else if($i == 3){
											$opt_val = 'C';
										}else if($i == 4){
											$opt_val = 'D';
										}else if($i == 5){
											$opt_val = 'E';
										}
							?>
    <div class='row'>
      <div class='col-sm-6'>
        <table>
          <tr>
            <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type='radio' name='opt_radio' value='<?php echo $opt_val; ?>' <?php if($opt_val == $val['ans']){echo "checked";} ?> required>
              &nbsp;&nbsp;</td>
            <td valign="top"><?php echo $val['option_'.$i]; ?></td>
          </tr>
        </table>
      </div>
      <!-- for question -->
      <?php
									if(!empty($val['option_img_'.$i])){
									?>
      <a href="<?php echo base_url($val['option_img_'.$i]); ?>" data-size="1600x1067">
      <div class='col-sm-6 mdb-lightbox no-margin'> <img src='<?php echo base_url($val['option_img_'.$i]); ?>' style='width:100px; height:100px;'></div>
      <!-- for image -->
      </a>
      <?php } ?>
    </div>
    <?php } ?>
    <?php 
							}else{ //subjective
								?>
    <div class='row'>
      <div class='col-sm-10'>
        <textarea rows='7' required name='subjectiveAns' class='form-control'><?php echo $val['ans']; ?></textarea>
        <br />
        <input type='file' name='subjectiveImg' onchange='validateImage4()' id='img4'>
        <label id='imgq4' style='color:red; font-size:10px;'>* Only JPEG,JPG,PNG,BMP Image and file size 5 MB.</label>
      </div>
      <!-- for question -->
      <?php
											if(!empty($val['img'])){
										?>
      <a href="<?php echo base_url($val['img']); ?>" data-size="1600x1067">
      <div class='col-sm-2 mdb-lightbox no-margin'> <img src='<?php echo base_url($val['img']); ?>' style='width:100px; height:100px;'> </div>
      <!-- for image -->
      </a>
      <?php } ?>
    </div>
    <?php
							} 
							?>
    <?php
						//}
					}
				?>
    <br />
    <div class='row'>
      <div class='col-sm-12'>
        <center>
          <button id='btn' class='btn btn-success'><i class="fa fa-circle-o-notch fa-spin" id='process' style='display:none'></i> SAVE & NEXT <i class="fa fa-angle-double-right"></i> </button>
        </center>
      </div>
    </div>
    <br />
    <br />
  </form>
  <script>
					$("#ansSave").on("submit", function (event) {
					event.preventDefault();
					$("#btn").prop('disabled',true);
					$("#process").show();
					let ans = $("#ans").val();
					var formData = new FormData(this);
					$.ajax({
							url: "<?php echo base_url('onlineexam/student/Questions/saveAns'); ?>",
							type: "POST",
							data:formData,
							cache:false,
							contentType: false,
							processData: false,
							success: function(data){
								$("#btn").prop('disabled',false);
								$("#process").hide();
								$("#addQuestionForm").trigger("reset");
								$("#loadQue").html(data);
							}
						});
					 });
				</script>
  <!--- view questions -->
</div>
</div>
<?php
 	}
	
	public function showQueAns(){
		$que_id = $this->input->post('que_id');
		$que_no = $this->input->post('que_no');
		$subjnm   = $this->session->userdata('subjnm');
		$examnm   = $this->session->userdata('examnm');
		$data['exam_pattern'] = $this->session->userdata('exam_pattern');
		$exam_pattern = $data['exam_pattern'];
		$exam_schedule_id = $this->session->userdata('exam_schedule_id');
		$adm              = $this->session->userdata('adm');
		
		$getQueAndAns1 = $this->db->query("SELECT que_tbl.*,ans_tbl.id as ans_id,ans_tbl.ans,ans_tbl.ans_status,ans_tbl.img,ans_tbl.img_status FROM `online_exam_answers` as ans_tbl JOIN online_exam_question as que_tbl ON ans_tbl.que_id=que_tbl.id WHERE ans_tbl.exam_schedule_id='$exam_schedule_id' AND ans_tbl.admno='$adm'")->result_array();

		$getQueAndAns = $this->db->query("SELECT que_tbl.*,ans_tbl.id as ans_id,ans_tbl.ans,ans_tbl.ans_status,ans_tbl.img,ans_tbl.img_status FROM `online_exam_answers` as ans_tbl JOIN online_exam_question as que_tbl ON ans_tbl.que_id=que_tbl.id WHERE ans_tbl.exam_schedule_id='$exam_schedule_id' AND ans_tbl.admno='$adm' AND que_tbl.qus_no='$que_no'")->result_array();
		?>
<div class='row'>
  <div class='col-sm-3' style='border-right:1px solid #000;'>
    <label><u>Subject : <?php echo $subjnm; ?></u></label>
    <br />
    <!--<button class='btn btn-warning btn-xs'>Active</button>-->
    <button class='btn btn-success btn-xs'>Answered</button>
    <button class='btn btn-danger btn-xs'>Unanswered</button>
    <br />
    <br />
    <?php
			if($exam_pattern == 2){ //MCQ
				echo "<label><u>MCQ</u></label><br />";
				foreach($getQueAndAns1 as $key => $val){
					if($val['exam_ptern_id'] == 2){
						if($val['ans_status'] != 1){
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}else{
							?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}
					}
				}
			}else if($exam_pattern == 1){ //subjective
				echo "<label><u>SUBJECTIVE</u></label><br />";
				foreach($getQueAndAns1 as $key => $val){
					if($val['exam_ptern_id'] == 1){
						if($val['ans_status'] != 1){
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}else{
							?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}
					}
				}
			}else if($exam_pattern == 3){ //both
				echo "<label><u>MCQ</u></label><br />";
				foreach($getQueAndAns1 as $key => $val){
					if($val['exam_ptern_id'] == 2){
						if($val['ans_status'] != 1){
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}else{
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}
					}
				}
				echo "<br /><br /><label><u>SUBJECTIVE</u></label><br />";
				foreach($getQueAndAns1 as $key => $val){
					if($val['exam_ptern_id'] == 1){
						if($val['ans_status'] != 1){
						?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}else{
							?>
    <button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
    <?php
						}
					}
				}
			}
		?>
  </div>
  <form id='ansSave' method='post' enctype='multipart/form-data'>
    <div class='col-sm-9'>
    <!--- view questions -->
    <?php
					foreach($getQueAndAns as $key => $val){
						//if($val['qus_no'] == 1){
							?>
    <div class='row'>
      <div class='col-sm-10'>
        <table>
          <tr>
            <td valign="top"><h3><?php echo "Q. ".$val['qus_no']; ?>&nbsp;&nbsp;</h3></td>
            <td valign="top"><h3><?php echo $val['question']; ?></h3>
			 &nbsp;&nbsp;<span style="float:right;" class='label label-danger'><?php echo "Max Marks:".$val['marks'];?></span>
			  </td>
          </tr>
        </table>
      </div>
      <!-- for question -->
      <div id="mdb-lightbox-ui"></div>
      <?php
										if(!empty($val['qus_img'])){
									?>
      <a href="<?php echo base_url($val['qus_img']); ?>" data-size="1600x1067">
      <div class='col-sm-2 mdb-lightbox no-margin'> <img src="<?php echo base_url($val['qus_img']); ?>" class='img-responsive' style='width:100px; height:100px;'> </div>
      <!-- for image -->
      </a>
      <?php } ?>
    </div>
    <input type='hidden' value='<?php echo $val['ans_id']; ?>' name='ans_id'>
    <input type='hidden' value='<?php echo $val['exam_ptern_id']; ?>' name='exam_pattern'>
    <input type='hidden' value='<?php echo $val['marks']; ?>' name='que_max_marks'>
    <input type='hidden' value='<?php echo $val['ans_key']; ?>' name='ans_key'>
    <input type='hidden' value='<?php echo $val['ans_status']; ?>' name='ans_status'>
    <input type='hidden' value='<?php echo $val['qus_no']; ?>' name='qus_no'>
    <?php
								if($val['exam_ptern_id'] == 2){ //MQC
									$opt_val = '';
									for($i=1; $i<=$val['obj_no_option']; $i++){
										if($i == 1){
											$opt_val = 'A';
										}else if($i == 2){
											$opt_val = 'B';
										}else if($i == 3){
											$opt_val = 'C';
										}else if($i == 4){
											$opt_val = 'D';
										}else if($i == 5){
											$opt_val = 'E';
										}
							?>
    <div class='row'>
      <div class='col-sm-6'>
        <table>
          <tr>
            <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type='radio' name='opt_radio' value='<?php echo $opt_val; ?>' <?php if($opt_val == $val['ans']){echo "checked";} ?> required>
              &nbsp;&nbsp;</td>
            <td valign="top"><?php echo $val['option_'.$i]; ?></td>
          </tr>
        </table>
      </div>
      <!-- for question -->
      <?php
										if(!empty($val['option_img_'.$i])){
									?>
      <a href="<?php echo base_url($val['option_img_'.$i]); ?>" data-size="1600x1067">
      <div class='col-sm-6 mdb-lightbox no-margin'> <img src='<?php echo base_url($val['option_img_'.$i]); ?>' style='width:100px; height:100px;'> </div>
      <!-- for image -->
      </a>
      <?php } ?>
    </div>
    <?php } ?>
    <?php 
							}else{ //subjective
								?>
    <div class='row'>
      <div class='col-sm-10'>
        <textarea rows='7' required name='subjectiveAns' class='form-control'><?php echo $val['ans']; ?></textarea>
        <br />
        <input type='file' name='subjectiveImg' onchange='validateImage4()' id='img4'>
        <label id='imgq4' style='color:red; font-size:10px;'>* Only JPEG,JPG,PNG,BMP Image and file size 5 MB.</label>
      </div>
      <!-- for question -->
     
        <?php
											if(!empty($val['img'])){
										?>
		 <a href="<?php echo base_url($val['img']); ?>" data-size="1600x1067">
      <div class='col-sm-2 mdb-lightbox no-margin'>
        <img src='<?php echo base_url($val['img']); ?>' style='width:100px; height:100px;'>
		</div>
      <!-- for image -->
      </a>
        <?php } ?>
       </div>
    <?php
							} 
							?>
    <?php
						//}
					}
				?>
    <br />
    <div class='row'>
      <div class='col-sm-12'>
        <center>
          <button id='btn' class='btn btn-success'><i class="fa fa-circle-o-notch fa-spin" id='process' style='display:none'></i> SAVE & NEXT <i class="fa fa-angle-double-right"></i> </button>
        </center>
      </div>
    </div>
    <br />
    <br />
  </form>
  <script>
					$("#ansSave").on("submit", function (event) {
					event.preventDefault();
					$("#btn").prop('disabled',true);
					$("#process").show();
					let ans = $("#ans").val();
					var formData = new FormData(this);
					$.ajax({
							url: "<?php echo base_url('onlineexam/student/Questions/saveAns'); ?>",
							type: "POST",
							data:formData,
							cache:false,
							contentType: false,
							processData: false,
							success: function(data){
								$("#btn").prop('disabled',false);
								$("#process").hide();
								$("#addQuestionForm").trigger("reset");
								$("#loadQue").html(data);
							}
						});
					 });
				</script>
  <!--- view questions -->
</div>
</div>
<?php
	}
}