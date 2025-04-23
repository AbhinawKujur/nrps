<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddHomework extends MY_Controller {
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
		$role_id            = login_details['ROLE_ID'];
		if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
			$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm');
			
			//$data['e_exam_questions_hw'] = $this->alam->selectA('e_exam_questions_hw','id,classes,sec,subject,homework_display_status,(select CLASS_NM from classes where Class_No=e_exam_questions_hw.classes)classnm, (select SECTION_NAME from sections where section_no=e_exam_questions_hw.sec)secnm,(select count(id) from e_exam_questions_hw_append where e_exam_questions_hw_id=e_exam_questions_hw.id)cnt, (select SubName from subjects where SubCode=e_exam_questions_hw.subject)subjnm,submitDate,created_at',"1='1' order by created_at desc");
		}else{
		//$data['e_exam_questions_hw'] = $this->alam->selectA('e_exam_questions_hw','id,classes,sec,subject,homework_display_status,(select CLASS_NM from classes where Class_No=e_exam_questions_hw.classes)classnm, (select SECTION_NAME from sections where section_no=e_exam_questions_hw.sec)secnm,(select count(id) from e_exam_questions_hw_append where e_exam_questions_hw_id=e_exam_questions_hw.id)cnt, (select SubName from subjects where SubCode=e_exam_questions_hw.subject)subjnm,submitDate,created_at',"empid='$user_id' order by created_at desc");
		
		$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id'");
		}
		$this->render_template('e_exam/homework/addhomework',$data);
	}
	
	public function loadSec(){
		$user_id  = login_details['user_id'];
		$class_id = $this->input->post('class_id');
		$user_id            = login_details['user_id'];
		$role_id            = login_details['ROLE_ID'];
		if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm'," Class_No = '$class_id' order by section_no asc");	
		}else{
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_id' order by section_no asc");
		}
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
		$role_id  = login_details['ROLE_ID'];
		if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm'," Class_No = '$cls' AND section_no = '$sec_id'");	
		}else{
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Main_Teacher_Code='$user_id' AND Class_No = '$cls' AND section_no = '$sec_id'");
		}
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
			<?php
		}
	}
	
	public function loadlist(){
		
		$user_id = login_details['user_id'];
		$cls     = $this->input->post('cls');
		$section = $this->input->post('section');
		$subj    = $this->input->post('subj');
		
		
		$e_exam_questions_hw1 = $this->alam->selectA('e_exam_questions_hw','id,classes,sec,subject,homework_display_status,(select CLASS_NM from classes where Class_No=e_exam_questions_hw.classes)classnm, (select SECTION_NAME from sections where section_no=e_exam_questions_hw.sec)secnm,(select count(id) from e_exam_questions_hw_append where e_exam_questions_hw_id=e_exam_questions_hw.id)cnt, (select SubName from subjects where SubCode=e_exam_questions_hw.subject)subjnm,submitDate,created_at',"classes='$cls' and sec='$section' and subject='$subj' order by created_at desc");
		
		?>
			<table class='table dataTable'>
	<thead>
		<tr>
			<th style='color:#fff !important; background:#5785c3;'>Class</th>
			<th style='color:#fff !important; background:#5785c3;'>Section</th>
			<th style='color:#fff !important; background:#5785c3;'>Subject</th>
			<th style='color:#fff !important; background:#5785c3;'>Question</th>
			<th style='color:#fff !important; background:#5785c3;'>Homework Date</th>
			<th style='color:#fff !important; background:#5785c3;'>Submission Date</th>
			<th style='color:#fff !important; background:#5785c3;'>Status</th>
			<th style='color:#fff !important; background:#5785c3;'>Modify</th>
		</tr>
	</thead>	
	<tbody>
		<?php
			foreach($e_exam_questions_hw1 as $key => $val){
				$date = date('Y-m-d',strtotime($val['created_at']));
				?>
					<tr>
						<td><?php echo $val['classnm']; ?></td>
						<td><?php echo $val['secnm']; ?></td>
						<td><?php echo $val['subjnm']; ?></td>
						<td><a class='label label-warning' onclick="viewQue(<?php echo $val['id']; ?>)">Questions <?php echo $val['cnt']; ?></a></td>
						<td><?php echo date('d-M',strtotime($val['created_at'])); ?></td>
						<td><?php echo date('d-M',strtotime($val['submitDate'])); ?></td>
						<td>
							<label class="switch" onchange="onoff(<?php echo $val['id']; ?>)">
							<?php
								if($val['homework_display_status'] == 1){
									?>	
										<?php
											if($val['homework_display_status'] == 1){
										?>
											<input type="checkbox" id='examonoff_<?php echo $val['id']; ?>' checked disabled>
										<span class="slider"></span>
										<?php
											}else{
											?>
											<input type="checkbox" id='examonoff_<?php echo $val['id']; ?>' checked>	
											<?php	
											}
										?>
									<?php
								}else{
									?>
										<input type="checkbox" id='examonoff_<?php echo $val['id']; ?>'>
										<span class="slider"></span>
									<?php
								}
							?>
							  
							</label>
						</td>
						<td>
						<?php
							if($val['homework_display_status'] != 1){
						?>
						<a href="<?php echo base_url('e_exam/homework/AddHomework/editQue/'.$val['id']); ?>" class='btn btn-success btn-xs'><i class="fa fa-pencil-square-o" style='color:#fff;' title='EDIT'></i></a>
						<?php }else{
							?>
								<button class='btn btn-danger btn-xs'><i class="fa fa-lock" style='color:#fff;'></i></button>
							<?php
						} ?>
						</td>
					</tr>
				<?php
			}
		?>
	</tbody>	
	</table>

		
		<?php
	}
	
	
	
	
	
	
	public function saveQuestion(){
		$saveData = array(
			'classes'          => $this->input->post('class'),
			'sec'              => $this->input->post('sec'),
			'subject'          => $this->input->post('subject'),
			'submitDate'       => date('Y-m-d',strtotime($this->input->post('submitDate'))),
			'empid'            => login_details['user_id']
		);
		$this->alam->insert('e_exam_questions_hw',$saveData);
		$insert_id = $this->db->insert_id();
		
		$que = $this->input->post('question[]');
		
		foreach($que as $key => $val){
			$que_no = $key+1;
			if(!empty($_FILES['img']['name'][$key])){
				$image              = $_FILES['img']['name'][$key]; 
				$expimage           = explode('.',$image);
				$count              = count($expimage);
				$image_ext          = $expimage[$count-1];
				$image_name         = strtotime('now'). mt_rand() .'.'.$image_ext;
				$imagepath          = "uploads/e_exam_hw/".$image_name;
					
			move_uploaded_file($_FILES["img"]["tmp_name"][$key],$imagepath);
			}else{
				$imagepath  = '';
			}
			
			
			$saveAppData = array(
				'e_exam_questions_hw_id' => $insert_id,
				'question_type'          => $this->input->post('question_type')[$key],
				'que_no'                 => $que_no,
				'question'               => $val,
				'que_img'                => $imagepath,
				'user_id'				 => login_details['user_id']
			);
			$this->alam->insert('e_exam_questions_hw_append',$saveAppData);
		}
		redirect('e_exam/homework/AddHomework');
	}
	
	public function editSaveQuestion(){
		$que        = $this->input->post('question[]');
		$upd_id     = $this->input->post('upd_id');
		//$this->alam->del('e_exam_questions_hw_append',"e_exam_questions_hw_id='$upd_id'");
		$lastQueNo = $this->input->post('lastQueNo');
		
		foreach($que as $key => $val){
			$que_id = $this->input->post('que_id')[$key];
			$old_img_path = $this->input->post('img_path')[$key];
			if($que_id != ''){
				if(!empty($_FILES['img']['name'][$key])){
					$image              = $_FILES['img']['name'][$key]; 
					$expimage           = explode('.',$image);
					$count              = count($expimage);
					$image_ext          = $expimage[$count-1];
					$image_name         = strtotime('now'). mt_rand() .'.'.$image_ext;
					$imagepath          = "uploads/e_exam_hw/".$image_name;
						
				move_uploaded_file($_FILES["img"]["tmp_name"][$key],$imagepath);
				}else{
					if($old_img_path != ''){
					    $imagepath  = $old_img_path;	
					}else{
						$imagepath  = '';
					}
					
				}
				$saveAppData = array(
					'question_type'          => $this->input->post('question_type')[$key],
					'question'               => $val,
					'que_img'                => $imagepath,
				);
				
				$this->alam->update('e_exam_questions_hw_append',$saveAppData,"id='$que_id'");
			}else{
				$lastQueNo=$lastQueNo+1;
				$que_no = $lastQueNo;				
				if(!empty($_FILES['img']['name'][$key])){
					$image              = $_FILES['img']['name'][$key]; 
					$expimage           = explode('.',$image);
					$count              = count($expimage);
					$image_ext          = $expimage[$count-1];
					$image_name         = strtotime('now'). mt_rand() .'.'.$image_ext;
					$imagepath          = "uploads/e_exam_hw/".$image_name;
						
				move_uploaded_file($_FILES["img"]["tmp_name"][$key],$imagepath);
				}else{
					$imagepath  = '';
				}
				$saveAppData = array(
					'e_exam_questions_hw_id' => $upd_id,
					'question_type'          => $this->input->post('question_type')[$key],
					'que_no'                 => $que_no,
					'question'               => $val,
					'que_img'                => $imagepath,
					'user_id'				 => login_details['user_id']
				);
				$this->alam->insert('e_exam_questions_hw_append',$saveAppData);
			}	
		}
		redirect('e_exam/homework/AddHomework');
	}
	
	public function editQue($id){
		$data['editQue'] = $this->alam->selectA('e_exam_questions_hw','*,(select CLASS_NM from classes where Class_No=e_exam_questions_hw.classes)classnm,(select SECTION_NAME from sections where section_no=e_exam_questions_hw.sec)secnm,(select SubName from subjects where SubCode=e_exam_questions_hw.subject)subjnm',"id='$id'");
		
		$data['editQueAppnd'] = $this->alam->selectA('e_exam_questions_hw_append','*',"e_exam_questions_hw_id='$id'");
		$this->render_template('e_exam/homework/edithomeworkQue',$data);
	}
	
	public function edit(){
		$id = $this->input->post('id');
		$data['masterTopicData'] = $this->alam->selectA('e_exam_questions','*,(select CLASS_NM from classes where Class_No=e_exam_questions.classes)classnm,(select SECTION_NAME from sections where section_no=e_exam_questions.sec)secnm,(select SubName from subjects where SubCode=e_exam_questions.subject)subjnm',"id='$id'");
		$this->load->view('e_exam/loadAddQuestionsEdit',$data);
	}
	
	public function updMaster(){
		$id = $this->input->post('id');
		$saveData = array(
			'chapter' => $this->input->post('chapter'),
			'topic'   => serialize($this->input->post('topic'))
		);
		$this->alam->update('e_exam_questions',$saveData,"id='$id'");
		$this->load->view('e_exam/loadAddQuestions');
	}
	
	public function insertValidation(){
		$cls      = $this->input->post('cls');
		$section  = $this->input->post('section');
		$subj     = $this->input->post('subj');
		$date     = date('Y-m-d');
		
		$chkData = $this->alam->selectA('e_exam_questions_hw','count(*)cnt',"classes='$cls' AND sec='$section' AND subject='$subj' AND date(created_at)='$date'");
		$cnt = $chkData[0]['cnt'];
		
		if($cnt == 0){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	public function viewModal(){
		$id         = $this->input->post('id');
		
		$data['getData'] = $this->alam->selectA('e_exam_questions_hw_append','*',"e_exam_questions_hw_id='$id'");
		
		$this->load->view('e_exam/homework/load_question_modal',$data);
	}
	
	public function viewExamStatus(){
		$homework_id = $this->input->post('homework_id');
		$chkbox      = $this->input->post('chkbox');
		
		$save = array(
			'homework_display_status' => $chkbox
		);
		
		$this->alam->update('e_exam_questions_hw',$save,"id='$homework_id'");
	}
}
