<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homework extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewHomework', permission_data))
		{
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
		
		$data['homeworkData'] = $this->alam->selectA('homework','*,(select distinct(DISP_CLASS) from student where CLASS=homework.class)disp_class,(select distinct(DISP_SEC) from student where SEC=homework.sec)disp_sec,(SELECT SubName FROM subjects WHERE SubCode=homework.subject)subject,(select category from homework_cat_master where id=homework.homework_category)catnm',"emp_id = '$user_id' order by homework.id desc");
		
		
		$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id'");
		
		$data['homeworkCatMaster'] = $this->alam->selectA('homework_cat_master','*');
		
		$this->render_template('homework/add_homework',$data);
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
		$val2 = '';
		$val3 = '';
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Main_Teacher_Code='$user_id' AND Class_No = '$cls' AND section_no = '$sec_id'");
		
		$val2 .="<option value=''>Select</option>";
		
		foreach($secData as $key => $val){
				$val2 .="<option value='".$val['subject_code']."'>".$val['subjnm']."</option>";
		}
		
		$stuData = $this->alam->selectA('student','STUDENTID,ADM_NO,FIRST_NM',"CLASS='$cls' AND SEC='$sec_id' AND Student_Status='ACTIVE'");
		$val3 .="<option select=''>Select</option>";
		foreach($stuData as $key => $val){
				$val3 .= "<option value='".$val['STUDENTID']."'>".$val['ADM_NO'].' ('.$val['FIRST_NM'].')'."</option>";
		}
		$array = array($val2,$val3);
		echo json_encode($array);
	}
	
	public function saveHomework(){
		$lastData           = $this->alam->orderByDescc();
		$last_id            = isset($lastData[0]['id']) ? $lastData[0]['id'] : 0;
		
		
		$class              = $this->input->post('class');
		$sec                = $this->input->post('sec');
		$date               = $this->input->post('date');
		$category           = $this->input->post('category');
		$notice             = $this->input->post('notice');
		$selectAll          = $this->input->post('selectAll');
		$selectParticultStu = $this->input->post('selectParticultStu[]');
		$submission_date    = date('Y-m-d',strtotime($this->input->post('submission_date')));
		
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
			$imagepath          = "uploads/homework_img/".$image_name;
			
			move_uploaded_file($_FILES["img"]["tmp_name"][$i],$imagepath);
			$imgList[] = $imagepath;
			}else{
				$imagepath  = '';
			}
		}
		$saveDataNotice = array(
			'emp_id'		  => login_details['user_id'],
			'date'            => $date,
			'submission_date' => $submission_date,
			'homework_date'   => date('Y-m-d'),
			'subject'         => $this->input->post('subject'),
			'class'           => $class,
			'sec'             => $sec,
			'homework_category' => $category,
			'remarks'          => $notice,
			'img'             => serialize($imgList),
			'is_allstu'       => $selectAll
		);
		
		$this->alam->insert('homework',$saveDataNotice);
		$insertLastId = $this->db->insert_id();
		
		
			foreach($stuData as $key => $val){
					$saveAllStu = array(
						'homework_tbl_id' => $insertLastId,
						'admno' => $val['ADM_NO']
					);
					$this->alam->insert('homework_adm_wise',$saveAllStu);
			}
		$this->session->set_flashdata('msg','Homework Sent Successfully');
		redirect('homework/Homework');
		
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
		
		$subjData    = $this->alam->selectA('class_section_wise_subject_allocation','Class_No,section_no,subject_code,(SELECT SubName FROM subjects WHERE SubCode=class_section_wise_subject_allocation.subject_code)subject',"Class_No='$class' AND section_no='$sec'  AND Main_Teacher_Code = '$user_id' order by sorting_no");
		//echo $this->db->last_query();die;
		$homeworkCatMaster = $this->alam->selectA('homework_cat_master','*');
		
		//print_r($subjData);die;
		
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
						
						<?php
							foreach($subjData as $key => $val){
								?>
									<option <?php if($subject == $val['subject_code']){ echo 'selected'; } ?> value='<?php echo $val['subject_code']; ?>'>
									<?php echo $val['subject']; ?>
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
				<td><input type='text' value="<?php echo date('d-m-Y',strtotime($submission_date)); ?>" id="dt" name='submission_date' class='form-control dt'autocomplete='off' readonly></td>
			</tr>
			
			<tr>
				<td colspan='2'><center><button class='btn btn-warning btn-sm'>Update <i class="fa fa-paper-plane" style='color:#fff'></i></button></center></td>
			</tr>
		</table>
		</form>
		<script>
		$('#dt').datepicker({ format: 'dd-mm-yyyy',autoclose: true });
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
}
