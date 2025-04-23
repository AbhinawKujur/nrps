<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubjectWiseAttendanceReport extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
	
		if(!in_array('viewDailyAttendance', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['log_cls_no'] = login_details['Class_No'];
		$data['log_sec_no'] = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		
		$role = login_details['ROLE_ID'];
		if($role == 2){
			$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id' AND (SELECT attendance_type FROM student_attendance_type WHERE class_code=class_section_wise_subject_allocation.Class_No)='3'");
		}else{
			$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"(SELECT attendance_type FROM student_attendance_type WHERE class_code=class_section_wise_subject_allocation.Class_No)='3'");
		}
		
		$this->render_template('student/report/subject_wise_attendance',$data);
	}
	
	public function loadSec(){
		$user_id  = login_details['user_id'];
		$class_id = $this->input->post('class_id');
		$role = login_details['ROLE_ID'];
		
		$att_type = 0;
		$att_type_data = $this->alam->select('student_attendance_type','attendance_type',"class_code='$class_id'");
		$att_type = $att_type_data[0]->attendance_type;
		$subj = '';
		if($att_type == 3){
			
			if($role == 2){
				$subjData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Main_Teacher_Code='$user_id'");
			}else{
				$subjData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"");
			}
			
			$subj .="<option value=''>Select</option>";
			$subj .="<option value=''>All Subjects</option>";
			if(isset($subjData)){
				foreach($subjData as $data){
					  $subj .="<option value=". $data['subject_code'] .">" . $data['subjnm'] ."</option>";
				}
			}
		}
		
		if($role == 2){
			$sec_data  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class_id'");
		}else{
			$sec_data  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Class_No = '$class_id'");
		}
		
		$ret ="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				  $ret .="<option value=". $data['section_no'] .">" . $data['secnm'] ."</option>";
			}
		}
		
		$array = array($ret,$att_type,$subj);
		echo json_encode($array);
	}
	
	public function subjectWiseReport(){
		$date     = date('Y-m-d',strtotime($this->input->post('dt')));
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$subj     = $this->input->post('subj');
		$att_type = $this->input->post('att_type');
		
		//$getData = $this->alam->selectA('stu_attendance_entry_periodwise','*,(select FIRST_NM from student where ADM_NO=stu_attendance_entry_periodwise.admno)firstnm,(select ROLL_NO from student where ADM_NO=stu_attendance_entry_periodwise.admno)rollno',"att_date='$date' AND class_code='$classs' AND sec_code='$sec' AND att_type='$att_type' AND subject_id='$subj'");
		$getData = $this->alam->selectA('stu_attendance_entry_periodwise','*,(select FIRST_NM from student where ADM_NO=stu_attendance_entry_periodwise.admno)firstnm,(select ROLL_NO from student where ADM_NO=stu_attendance_entry_periodwise.admno)rollno, (select SubName from subjects where SubCode=stu_attendance_entry_periodwise.subject_id)subjnm',"att_date='$date' AND class_code='$classs' AND sec_code='$sec' AND att_type='$att_type'");
		//echo $this->db->last_query();
		//die;
		?>

			<a target='_blank' href="<?php echo base_url('student/report/SubjectWiseAttendanceReport/subjectWiseReportPDF/'.$date.'/'.$classs.'/'.$sec.'/'.$subj.'/'.$att_type); ?>" class='btn btn-danger btn-sm'>PDF</a><br /><br />
			<table class='table' id='example'>
				<thead>
					<tr>
						<th style='background:#337ab7; color:#fff !important'>Adm No.</th>
						<th style='background:#337ab7; color:#fff !important'>Student Name</th>
						<th style='background:#337ab7; color:#fff !important'>Roll No.</th>
						<th style='background:#337ab7; color:#fff !important'>Attendance</th>
						<th style='background:#337ab7; color:#fff !important'>Subject</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($getData as $key => $val){
							$bgcolor = ($val['att_status'] == 'P')?'#c3e6cb':'#f5c6cb';
							?>
								<tr style="background:<?php echo $bgcolor; ?>">
									<td><?php echo $val['admno']; ?></td>
									<td><?php echo $val['firstnm']; ?></td>
									<td><?php echo $val['rollno']; ?></td>
									<td><?php echo $val['att_status']; ?></td>
									<td><?php echo $val['subjnm']; ?></td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		<?php
	}
	
	public function subjectWiseReportPDF($date,$classs,$sec,$subj,$att_type){
		$data['school_setting'] = $this->alam->selectA('school_setting','*');
		//$data['getData'] = $this->alam->selectA('stu_attendance_entry_periodwise','*,(select CLASS_NM from classes where Class_No=stu_attendance_entry_periodwise.class_code)classnm,(select SECTION_NAME from sections where section_no=stu_attendance_entry_periodwise.sec_code)secnm,(select SubName from subjects where SubCode=stu_attendance_entry_periodwise.subject_id)subjnm,(select FIRST_NM from student where ADM_NO=stu_attendance_entry_periodwise.admno)firstnm,(select ROLL_NO from student where ADM_NO=stu_attendance_entry_periodwise.admno)rollno',"att_date='$date' AND class_code='$classs' AND sec_code='$sec' AND att_type='$att_type' AND subject_id='$subj' order by rollno");
		$data['getData'] = $this->alam->selectA('stu_attendance_entry_periodwise','*,(select CLASS_NM from classes where Class_No=stu_attendance_entry_periodwise.class_code)classnm,(select SECTION_NAME from sections where section_no=stu_attendance_entry_periodwise.sec_code)secnm,(select SubName from subjects where SubCode=stu_attendance_entry_periodwise.subject_id)subjnm,(select FIRST_NM from student where ADM_NO=stu_attendance_entry_periodwise.admno)firstnm,(select ROLL_NO from student where ADM_NO=stu_attendance_entry_periodwise.admno)rollno',"att_date='$date' AND class_code='$classs' AND sec_code='$sec' AND att_type='$att_type'order by stu_attendance_entry_periodwise.id asc");
		$data['classnm'] = $data['getData'][0]['classnm'];
		$data['secnm'] = $data['getData'][0]['secnm'];
		$data['subjnm'] = $data['getData'][0]['subjnm'];
		$data['date'] = date('d-M-y',strtotime($date));
		
		$this->load->view('student/report/subject_wise_attendance_pdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("SubjetcWiseAttendance.pdf", array("Attachment"=>0));
	}
}
