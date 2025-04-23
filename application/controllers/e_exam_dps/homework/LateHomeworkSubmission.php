<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LateHomeworkSubmission extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');		
		$this->load->model('Alam','alam');		
	}
	
	public function index(){
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		$role_id            = login_details['ROLE_ID'];
		if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
		$array['class_no']   	= $this->pawan->selectA('classes','*');				
		}else{
			$array['class_no'] = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(Class_no) as Class_No,(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)CLASS_NM',"Main_Teacher_Code='$user_id'");
		}				
        $this->render_template('e_exam/homework/lateHwSubmission',$array);		
	}
	
	public function Class_sec(){
		 $user_id   = login_details['user_id'];
		 $class_no	= $this->input->post('class_code');
		 $sec       = login_details['Section_No'];
		 $role_id   = login_details['ROLE_ID'];
		 if($role_id==1 || $role_id==4 || $role_id==5 || $role_id==6){
			$data  = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm'," Class_No = '$class_no'");
		 }else{
			$data  = $this->pawan->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_no'");
		 }		 
		 ?>
		<select id="section_id" name='section_id' style="padding:2px; width:174px;">
		  <option value=''>Select</option>
		  <?php
					if(isset($data)){
					foreach($data as $key => $val){
					?>
						<option value='<?php echo $val['section_no']; ?>'><?php echo $val['secnm']; ?></option>
					<?php
				          }
					}
					?>
		</select>
		<?php 
	}
	
	public function getReport(){
		 $class_no	= $this->input->post('class_code');
		 $sec_no	= $this->input->post('sec_no');
		 $user_id   = login_details['user_id'];
		 $role_id   = login_details['ROLE_ID'];
		 
		 $lateReportData = $this->alam->selectA('e_exam_answers_hw','admno,(SELECT FIRST_NM FROM student WHERE ADM_NO=e_exam_answers_hw.admno)firstnm,(SELECT ROLL_NO FROM student WHERE ADM_NO=e_exam_answers_hw.admno)rollno,(select SubName from subjects where SubCode=e_exam_answers_hw.subj_id)subjnm,target_date,final_submit_by_stu',"class_no = '$class_no' AND sec_no = '$sec_no' AND date(target_date) < date(final_submit_by_stu) AND date(target_date) > '2020-05-20' GROUP BY admno,subjnm,target_date,final_submit_by_stu order by date(target_date)");
		 ?>
			<div class='table-responsive' style='padding:5px;'><br />
			<table class='table dataTable'>
				<thead>
					<tr>
						<th style='background:#337ab7; color:#fff !important;'>Adm. No.</th>
						<th style='background:#337ab7; color:#fff !important;'>Student Name</th>
						<th style='background:#337ab7; color:#fff !important;'>Roll No.</th>
						<th style='background:#337ab7; color:#fff !important;'>Subject Name</th>
						<th style='background:#337ab7; color:#fff !important;'>Target Date</th>
						<th style='background:#337ab7; color:#fff !important;'>Submission Date</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if(!empty($lateReportData)){
							foreach($lateReportData as $key => $val){
								?>
									<tr>
										<td><?php echo $val['admno']; ?></td>
										<td><?php echo $val['firstnm']; ?></td>
										<td><?php echo $val['rollno']; ?></td>
										<td><?php echo $val['subjnm']; ?></td>
										<td><?php echo date('d-M-Y',strtotime($val['target_date'])); ?></td>
										<td><?php echo date('d-M-Y',strtotime($val['final_submit_by_stu'])); ?></td>
									</tr>
								<?php
							}
						}
					?>
				</tbody>
			</table>
			</div>
			<script>
				 $(document).ready(function() {
					$('.dataTable').DataTable( {
						dom: 'Bfrtip',
						buttons: [
							'excelHtml5',
							'pdfHtml5'
						],
						'ordering': false,
					} );
				} );
			</script>
		 <?php
	}
} 