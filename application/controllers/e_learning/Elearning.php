<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elearning extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewHomework', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
        
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		$data['clasa_no']   = login_details['Class_No'];
		$data['sec_no']     = login_details['Section_No'];
		$data['login_id']   = login_details['user_id'];
		$data['date']       = date('Y-m-d');
		$data['stuData']    = $this->alam->selectA('student','STUDENTID,ADM_NO,FIRST_NM',"CLASS='$class' AND SEC='$sec'");
		
		$data['subjData']    = $this->alam->selectA('class_section_wise_subject_allocation','Class_No,section_no,subject_code,(SELECT SubName FROM subjects WHERE SubCode=class_section_wise_subject_allocation.subject_code)subject',"Class_No='$class' AND section_no='$sec' and applicable_exam = '1' AND Main_Teacher_Code = '$user_id' order by sorting_no");
		
		$data['eLearningData'] = $this->alam->selectA('e_learning','*,(select CLASS_NM from classes where Class_No=e_learning.class)disp_class,(select distinct(DISP_SEC) from student where SEC=e_learning.sec)disp_sec,(SELECT SubName FROM subjects WHERE SubCode=e_learning.subject)subjectnm,(SELECT chapter FROM chaptertopicmaster WHERE id=e_learning.chapter)chapternm',"emp_id = '$user_id' order by id desc");
		
		$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id'");
		
		$data['homeworkCatMaster'] = $this->alam->selectA('homework_cat_master','*');
		
		$this->render_template('e_learning/add_topic',$data);
	}
	
	public function loadSec(){
		$user_id  = login_details['user_id'];
		$class_id = $this->input->post('class_id');
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_id'");
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['section_no']; ?>'><?php echo $val['secnm']; ?></option>
			<?php
		}
	}
	
	public function loadSubj(){
		$user_id  = login_details['user_id'];
		$cls      = $this->input->post('cls');
		$sec_id   = $this->input->post('sec_id');
		
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Main_Teacher_Code='$user_id' AND Class_No = '$cls' AND section_no = '$sec_id'");
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
			<?php
		}
	}
	
	public function getChapterTopic(){
		$cls = $this->input->post('cls');
		$sec = $this->input->post('sec');
		$sub = $this->input->post('val');
		$chapterData = $this->alam->selectA('chaptertopicmaster','id,chapter',"classes='$cls' AND sec='$sec' AND subject='$sub'");
		$ret = '';
		$ret .="<option value=''>Select</option>";
		foreach($chapterData as $key => $val){
			$ret .="<option value='".$val['id']."'>".$val['chapter']."</option>";
		}
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function getTopicData(){
		$chapterId = $this->input->post('chapterId');
		$topicData = $this->alam->selectA('chaptertopicmaster','id,topic',"id='$chapterId'");
		$topic = unserialize($topicData[0]['topic']);
		?>
			<option value=''>Select</option>
		<?php
		foreach($topic as $key => $val){
			?>
				<option value='<?php echo $val; ?>'><?php echo $val; ?></option>
			<?php
		}
	}
	
	public function saveHomework(){
		$lastData           = $this->alam->orderByDescc();
		$last_id            = isset($lastData[0]['id']) ? $lastData[0]['id'] : 0;
		
		
		$class              = $this->input->post('class');
		$sec                = $this->input->post('sec');
		$chapter            = $this->input->post('chapter');
		$topic              = $this->input->post('topic');
		$date               = $this->input->post('date');
		$category           = $this->input->post('category');
		$notice             = $this->input->post('notice');
		$link               = $this->input->post('link');
		$selectAll          = $this->input->post('selectAll');
		$selectParticultStu = $this->input->post('selectParticultStu[]');
		$submission_date    = date('Y-m-d',strtotime($this->input->post('submission_date')));
		$new_link = explode('/',$link);
		$you_tube = $new_link[3];
		
		if($selectAll == 1){
				$stuData  = $this->alam->selectA('student','STUDENTID,ADM_NO,FIRST_NM',"CLASS='$class' AND SEC='$sec'");
		}else{
				$selectParticultStu = implode("','",$selectParticultStu);
			    $stuData  = $this->alam->selectA('student','STUDENTID,ADM_NO,FIRST_NM',"STUDENTID in ('$selectParticultStu')");	
		}
		$imgList = array();
		for($i=0; $i<count($_FILES['img']['name']); $i++){
			if(!empty($_FILES['img']['name'][$i])){
			$image              = $_FILES['img']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = strtotime('now'). rand() .'.'.$image_ext;
			$imagepath          = "uploads/e_learning_files/".$image_name;
			
			move_uploaded_file($_FILES["img"]["tmp_name"][$i],$imagepath);
			$imgList[] = $imagepath;
			}else{
				$imagepath  = '';
			}
		}
		$saveDataNotice = array(
			'emp_id'		  => login_details['user_id'],
			'date'            => $date,
			'homework_date'   => date('Y-m-d'),
			'subject'         => $this->input->post('subject'),
			'class'           => $class,
			'sec'             => $sec,
			'chapter'         => $chapter,
			'topic'           => $topic,
			'remarks'         => $notice,
			'link'            => $you_tube,
			'img'             => serialize($imgList),
			'is_allstu'       => $selectAll
		);
		
		$this->alam->insert('e_learning',$saveDataNotice);
		$insertLastId = $this->db->insert_id();
		
		
		foreach($stuData as $key => $val){
				$saveAllStu = array(
					'elearning_tbl_id' => $insertLastId,
					'admno' => $val['ADM_NO']
				);
				$this->alam->insert('e_learning_adm_wise',$saveAllStu);
		}
			
		$user_id = login_details['user_id'];
		$data['login_id']   = login_details['user_id'];
		
		$data['eLearningData'] = $this->alam->selectA('e_learning','*,(select distinct(DISP_CLASS) from student where CLASS=e_learning.class)disp_class,(select distinct(DISP_SEC) from student where SEC=e_learning.sec)disp_sec,(SELECT SubName FROM subjects WHERE SubCode=e_learning.subject)subjectnm,(SELECT chapter FROM chaptertopicmaster WHERE id=e_learning.chapter)chapternm',"emp_id = '$user_id' order by id desc");
		$this->load->view('e_learning/addedLoadChapterData',$data);		
	}
	
	public function statusSave()
	{
		$elearning_tbl_id = $this->input->post('elearning_tbl_id');
		$admno            = $this->input->post('admno');
		$save = array(
			'downloadStatus' => 1
		);

		$this->alam->update('e_learning_adm_wise', $save, "elearning_tbl_id='$elearning_tbl_id' AND admno='$admno'");
	}
	
	public function noticeEdit(){
		$user_id = login_details['user_id'];
		$id = $this->input->post('id');
		$noticeData = $this->alam->selectA('homework','homework_category,remarks,img,is_allstu,class,sec,subject,submission_date',"id='$id'");
		
		$notice_category = $noticeData[0]['homework_category'];
		$notice          = $noticeData[0]['remarks'];
		$img             = $noticeData[0]['img'];
		$is_allstu       = $noticeData[0]['is_allstu'];
		$class           = $noticeData[0]['class'];
		$sec             = $noticeData[0]['sec'];
		$subject         = $noticeData[0]['subject'];
		$submission_date = $noticeData[0]['submission_date'];
		
		$subjData    = $this->alam->selectA('class_section_wise_subject_allocation','Class_No,section_no,subject_code,(SELECT SubName FROM subjects WHERE SubCode=class_section_wise_subject_allocation.subject_code)subject',"Class_No='$class' AND section_no='$sec' and applicable_exam = '1' AND Main_Teacher_Code = '$user_id' order by sorting_no");
		
		$homeworkCatMaster = $this->alam->selectA('homework_cat_master','*');
		
		?>
		
		<form method='post' action='<?php echo base_url('homework/Homework/updateNotice'); ?>' enctype='multipart/form-data' id='myform'>
		<table class='table'>
		<input type='hidden' name='id' value='<?php echo $id; ?>'>
		<input type='hidden' name='imgg' value='<?php echo $img; ?>'>
			<tr>
				<th>Category</th>
				<td>
					<select class='form-control' name='category' required>
						<option value=''>Select</option>
						<?php
							if(!empty($homeworkCatMaster)){
								foreach($homeworkCatMaster as $key => $val){
									?>
										<option value='<?php echo $val['id']; ?>' <?php if($val['id'] == $notice_category){ echo 'selected'; }
										?>><?php echo $val['category']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Subject</th>
				<td>
					<select class='form-control' name='subject' required>
						<option value=''>Select</option>
						<?php
							foreach($subjData as $key => $val){
								?>
									<option <?php if($subject == $val['subject_code']){ echo 'selected'; } ?> value='<?php echo $val['subject_code']; ?>'>
									<?php echo $val['subject']; ?>
									</option>
								<?php
							}
						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Remarks</th>
				<td>
					<textarea class='form-control' name='notice' required rows='5'><?php echo $notice; ?></textarea>
				</td>
			</tr>
			<tr>
				<th>Attachment</th>
				<td>
				  <input type='file' name='img' class='form-control'>
				</td>
			</tr>
			
			<tr>
				<th>Submission Date</th>
				<td><input type='text' value='<?php echo $submission_date; ?>' name='submission_date' class='form-control dt'autocomplete='off'></td>
			</tr>
			
			<tr>
				<td colspan='2'><center><button class='btn btn-warning btn-sm'>Update <i class="fa fa-paper-plane" style='color:#fff'></i></button></center></td>
			</tr>
		</table>
		</form>
		<script>
		$('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true });
		$(document).ready(function () {
			$('#myform').validate({ // initialize the plugin
			rules: {
				img: {
				  required: false,
				  extension: "jpeg|pdf|jpg",
				}
			  },
				submitHandler: function (form) { // for demo 
					 if ($(form).valid()) 
						 form.submit(); 
					 return false; // prevent normal form posting
				}
			});
		   });
		</script>
		<?php
	}
	
	public function updateNotice(){
		
		$category           = $this->input->post('category');
		$notice             = $this->input->post('notice');
		$imgg               = $this->input->post('imgg');
		$submission_date    = $this->input->post('submission_date');
		$id                 = $this->input->post('id');
		
		
		if(!empty($_FILES['img']['name'])){
		$image              = $_FILES['img']['name']; 
		$expimage           = explode('.',$image);
		$count              = count($expimage);
		$image_ext          = $expimage[$count-1];
		$image_name         = $id .'.'.$image_ext;
		$imagepath          = "uploads/homework_img/".$image_name;
		
		move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
		}else{
			$imagepath  = $imgg;
		}
		
		$updateDataNotice = array(
			'homework_category' => $category,
			'remarks'           => $notice,
			'img'               => $imagepath,
			'subject'           => $this->input->post('subject'),
			'submission_date'   => $submission_date
		);
		
		$this->alam->update('homework',$updateDataNotice,"id='$id'");
		
		$this->session->set_flashdata('msg','Notice Updated Successfully');
		redirect('homework/Homework');
	}
	
	public function studentQueries(){
		$user_id = login_details['user_id'];
		$data['elearningData'] = $this->alam->SelectA('e_learning','*,(select CLASS_NM from classes where Class_No=e_learning.class)disp_class,(select distinct(DISP_SEC) from student where SEC=e_learning.sec)disp_sec,(SELECT SubName FROM subjects WHERE SubCode=e_learning.subject)subjectnm,(SELECT chapter FROM chaptertopicmaster WHERE id=e_learning.chapter)chapternm',"emp_id='$user_id' ORDER BY id DESC");
		
		$this->render_template('e_learning/studentQueries',$data);
	}
	
	public function studentQuery($id,$subject,$class,$sec){
		$data['user_id'] = login_details['user_id'];
		$user_id = $data['user_id'];
		$data['elearningData'] = $this->alam->selectA('e_learning','*,(select SubName from subjects where SubCode=e_learning.subject)subjnm,(select chapter from chaptertopicmaster where id=e_learning.chapter)chapternm',"id='$id'");
		
		$nameData = $this->alam->selectA('e_learning_conversation_stu','user_name',"user_id='$user_id'");
		$data['name'] = (!empty($nameData[0]['user_name']))?$nameData[0]['user_name']:'';
		
		$data['conversation_stu'] = $this->alam->selectA('e_learning_conversation_stu','*,(select SubName from subjects where SubCode=e_learning_conversation_stu.subject)subjnm,(select remarks from e_learning where id=e_learning_conversation_stu.topic_id)topicnm',"subject='$subject' AND topic_id='$id' AND classes='$class' AND sec='$sec' order by id desc");
		$this->render_template('e_learning/studentQueriesTeacher',$data);
	}
	
	public function studentQuertySave(){
		$query = $this->input->post('query');
		$classes   = $this->input->post('classes');
		$sec   = $this->input->post('sec');
		$admno   = $this->input->post('admno');
		$user_id = login_details['user_id'];
		$stuNmData = $this->alam->selectA('employee','EMP_FNAME',"EMPID='$admno'");
		$firstnm = $stuNmData[0]['EMP_FNAME'];
		
		$img   = $this->input->post('img');
		$subject   = $this->input->post('subject');
		$topic_id   = $this->input->post('topic_id');
		
		$imgList = array();
		for($i=0; $i<count($_FILES['img']['name']); $i++){
			if(!empty($_FILES['img']['name'][$i])){
			$image              = $_FILES['img']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = strtotime('now'). rand() .'.'.$image_ext;
			$imagepath          = "uploads/e_learning_files/".$image_name;
			
			move_uploaded_file($_FILES["img"]["tmp_name"][$i],$imagepath);
			$imgList[] = $imagepath;
			}else{
				$imagepath  = '';
			}
		}
		
		$studentQuerySave = array(
			'user_id'		  => $admno,
			'user_type'		  => 'T',
			'user_name'		  => $firstnm,
			'subject'         => $subject,
			'topic_id'        => $topic_id,
			'classes'         => $classes,
			'sec'             => $sec,
			'query'           => $query,
			'img'             => serialize($imgList)
		);
		$this->alam->insert('e_learning_conversation_stu',$studentQuerySave);
		
		$conversation_stu = $this->alam->selectA('e_learning_conversation_stu','*,(select SubName from subjects where SubCode=e_learning_conversation_stu.subject)subjnm,(select remarks from e_learning where id=e_learning_conversation_stu.topic_id)topicnm',"subject='$subject' AND topic_id='$topic_id' AND classes='$classes' AND sec='$sec' order by id desc");
		
		$nameData = $this->alam->selectA('e_learning_conversation_stu','user_name',"user_id='$user_id'");
		$name = (!empty($nameData[0]['user_name']))?$nameData[0]['user_name']:'';
		
		if(!empty($conversation_stu)){
			foreach($conversation_stu as $key => $val){
				if($name == $val['user_name']){
					$userIconColor = 'green';
				}else{
					$userIconColor = 'red';
				}
				?>
				 <b><i class="fa fa-user-circle" style='color:<?php echo $userIconColor; ?>'></i> <span style='font-size:12px;'><?php echo $val['user_name']; ?></span></b>
				 <p style='font-size:12px;'>
					<?php echo $val['query']; ?>
					<?php
						if($val['img'] != 'a:0:{}'){
							?>
								<a href='<?php echo base_url(unserialize($val['img'])); ?>' download> &nbsp;<i class="fa fa-download" style='color:red'></i></a>
							<?php
						}
					?>
					<br />
					<span style='text-align:right'><?php echo date('d-M H:i a',strtotime($val['created_at'])); ?></span>
				</p>
				<?php
			}
		}
	}
	
	public function autoRefresh($subject,$topic_id,$classes,$sec){
		$conversation_stu = $this->alam->selectA('e_learning_conversation_stu','*,(select SubName from subjects where SubCode=e_learning_conversation_stu.subject)subjnm,(select remarks from e_learning where id=e_learning_conversation_stu.topic_id)topicnm',"subject='$subject' AND topic_id='$topic_id' AND classes='$classes' AND sec='$sec' order by id desc");
		
		$user_id = login_details['user_id'];
		$nameData = $this->alam->selectA('e_learning_conversation_stu','user_name',"user_id='$user_id'");
		$name = (!empty($nameData[0]['user_name']))?$nameData[0]['user_name']:'';
		
		if(!empty($conversation_stu)){
			foreach($conversation_stu as $key => $val){
				if($name == $val['user_name']){
					$userIconColor = 'green';
				}else{
					$userIconColor = 'red';
				}
				?>
				 <b><i class="fa fa-user-circle" style='color:<?php echo $userIconColor; ?>'></i> <span style='font-size:12px;'><?php echo $val['user_name']; ?></span></b>
				 <p style='font-size:12px;'>
					<?php echo $val['query']; ?>
					<?php
						if($val['img'] != 'a:0:{}'){
							?>
								<a href='<?php echo base_url(unserialize($val['img'])); ?>' download> &nbsp;<i class="fa fa-download" style='color:red'></i></a>
							<?php
						}
					?>
					<br />
					<span style='text-align:right'><?php echo date('d-M H:i a',strtotime($val['created_at'])); ?></span>
				</p>
				<?php
			}
		}
	}
	
	public function lockStatus(){
		$tblId = $this->input->post('tblId');
		$save = array(
			'lock_topic' => $this->input->post('chkbox')
		);
		$this->alam->update('e_learning',$save,"id='$tblId'");
		if($this->input->post('chkbox') == 1){
			echo "Unblocked Successfully..!";
		}else{
			echo "Blocked Successfully..!";
		}
	}
	
	public function chkDownloadStatus(){
		$elearning_tbl_id = $this->input->post('elearning_tbl_id');
		$fetchData = $this->alam->selectA('e_learning_adm_wise','*,(select FIRST_NM from student where ADM_NO=e_learning_adm_wise.admno)firstnm,(select ROLL_NO from student where ADM_NO=e_learning_adm_wise.admno)rollno',"elearning_tbl_id='$elearning_tbl_id'");
		?>
			<table class='table' id='datatable' border='1'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important'>Adm No.</th>
					<th style='background:#337ab7; color:#fff !important'>Name</th>
					<th style='background:#337ab7; color:#fff !important'>Roll No.</th>
					<th style='background:#337ab7; color:#fff !important'>Download Status</th>
				</tr>
			</thead>	
			</tbody>	
		<?php
		if(!empty($fetchData)){
			foreach($fetchData as $key => $val){
				?>
					<tr>
						<td><?php echo $val['admno']; ?></td>
						<td><?php echo $val['firstnm']; ?></td>
						<td><?php echo $val['rollno']; ?></td>
						<td><?php echo ($val['downloadStatus'] == 1)?'<i class="fa fa-check-square" style="color:green; font-size:35px;"></i>':'<i class="fa fa-times" style="color:red; font-size:35px;"></i>'; ?></td>
					</tr>
				<?php
			}
		}
		?>
			</body>
			</table>
			<script>
				$(function () {
				$('#datatable').DataTable({
				  'paging'      : true,
				  'lengthChange': false,
				  'searching'   : true,
				  'ordering'    : false,
				  'info'        : true,
				  'autoWidth'   : true,
				  aaSorting: [[0, 'asc']]
				})
			  });
			</script>
		<?php
	}
}
