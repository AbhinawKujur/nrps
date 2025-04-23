<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddHomeworkpdf extends MY_Controller {
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
			
		}else{
		
		$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id'");
		}
		$this->render_template('e_exam/homework/addhomeworkpdf',$data);
	}
	
	public function loadSec(){
		$user_id  = login_details['user_id'];
		$class_id = $this->input->post('class_id');
		$user_id            = login_details['user_id'];
		$role_id            = login_details['ROLE_ID'];
		if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm'," Class_No = '$class_id'");	
		}else{
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_id'");
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
	
	public function datevalid(){
		$cls     = $this->input->post('cls');
		$section = $this->input->post('section');
		$subj    = $this->input->post('subj');
		$datelist	=$this->alam->selectA('e_exam_questions_hw','*',"classes='$cls' and sec='$section' and subject='$subj'");
		?>
			<option value=''>Select</option>
		<?php
		foreach($datelist as $key => $val){
			?>
				<option value='<?php echo date('Y-m-d',strtotime($val['created_at'])); ?>'><?php echo date('d-m-Y',strtotime($val['submitDate'])); ?></option>
			<?php
		}
	}
	
	public function loadlist(){
		
		$user_id = login_details['user_id'];
		$cls     = $this->input->post('cls');
		$section = $this->input->post('section');
		$subj    = $this->input->post('subj');
		$date    = $this->input->post('date');
		
		
		$e_exam_questions_hw1 = $this->alam->selectA('e_exam_questions_hw','id,classes,sec,subject,homework_display_status,(select CLASS_NM from classes where Class_No=e_exam_questions_hw.classes)classnm, (select SECTION_NAME from sections where section_no=e_exam_questions_hw.sec)secnm,(select count(id) from e_exam_questions_hw_append where e_exam_questions_hw_id=e_exam_questions_hw.id)cnt, (select SubName from subjects where SubCode=e_exam_questions_hw.subject)subjnm,submitDate,created_at,file',"classes='$cls' and sec='$section' and subject='$subj' and date(created_at)='$date' order by created_at desc");
		
		?>
			<table class='table dataTable' style='font-size:12px'>
	<thead>
		<tr>
			<th style='color:#fff !important; background:#5785c3;'>Class</th>
			<th style='color:#fff !important; background:#5785c3;'>Section</th>
			<th style='color:#fff !important; background:#5785c3;'>Subject</th>
			<th style='color:#fff !important; background:#5785c3;'>Question</th>
			<th style='color:#fff !important; background:#5785c3;'>Homework Date</th>
			<th style='color:#fff !important; background:#5785c3;'>Submission Date</th>
			<th style='color:#fff !important; background:#5785c3;'>File</th>
			<th style='color:#fff !important; background:#5785c3;'>Upload</th>
			<th style='color:#fff !important; background:#5785c3;'>Action</th>
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
						<?php
						if(!empty($val['file'])){
						?>
						<a href='<?=base_url($val['file']);?>' target='_blank'><i class='fa fa-download' style='font-size: 30px; color:red'></i></a>
						<?php }else{?>
						<i class='fa fa-download' style='font-size: 30px;'></i>
						<?php }?>
						</td>
						<td>
						<input type='hidden' name='ids' value='<?=$val['id'];?>'>
						
						<input type='file' name='img' style='width: 112px;' class='form-control' id="img" onchange="validateImage()">
						<p style='color:red;'>Only PDF File Upload!</p>
						</td>
						
						<td>
						<button id='btn' class='btn btn-success btn-sm'><i class="fa fa-circle-o-notch fa-spin" id='process' style='color:#fff; display:none'></i> Upload</button>
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
		 $ids 		= $this->input->post('ids'); 
		 $user_id   = login_details['user_id'];
		
			if(!empty($_FILES['img']['name'])){
				$image              = $_FILES['img']['name']; 
				$expimage           = explode('.',$image);
				$image_ext          = $expimage[1];
				$image_name         = strtotime('now'). mt_rand() .'.'.$image_ext;
				$imagepath          = "uploads/e_exam_hw/".$image_name;
					
			move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
			$saveAppData = array(				
					'updated_by'		  => $user_id,
					'file'                => $imagepath,
				);
			$this->alam->update('e_exam_questions_hw',$saveAppData,"id='$ids'");
			}
			redirect('e_exam/homework/AddHomeworkpdf');
	}
	
	
}
