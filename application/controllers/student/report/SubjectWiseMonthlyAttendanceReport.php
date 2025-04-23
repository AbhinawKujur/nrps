<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubjectWiseMonthlyAttendanceReport extends MY_Controller {
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
		$data['month_master'] = $this->alam->selectA('month_master','*');
		
		if($role == 2){
			$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id' AND (SELECT attendance_type FROM student_attendance_type WHERE class_code=class_section_wise_subject_allocation.Class_No)='3'");
		}else{
			$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"(SELECT attendance_type FROM student_attendance_type WHERE class_code=class_section_wise_subject_allocation.Class_No)='3'");
		}
		
		$this->render_template('student/report/subject_wise_attendance_monthly',$data);
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
			$subj .="<option value=''>ALL SUBJECTS</option>";
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
		$date     = date('Y-m-d');
		$explod   = explode('-',$date);
		$year     = $explod[0];
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$subj     = $this->input->post('subj');
		$att_type = $this->input->post('att_type');
		$month    = $this->input->post('month');
		
		$num_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		?>
			<a target='_blank' href="<?php echo base_url('student/report/SubjectWiseMonthlyAttendanceReport/subjectWiseReportPDF/'.$classs.'/'.$sec.'/'.$subj.'/'.$att_type.'/'.$month); ?>" class='btn btn-danger btn-sm'>PRINT</a><br /><br />
			<table class='table' id='example'>
				<thead>
					<tr>
						<th style='background:#337ab7; color:#fff !important'>Adm No.</th>
						<th style='background:#337ab7; color:#fff !important'>Stu. Name</th>
						<th style='background:#337ab7; color:#fff !important'>Roll No.</th>
						<?php
							for($i=1; $i<=$num_of_days; $i++){
								$showDays = $year.'-'.$month.'-'.$i;
								?>
									<th style='background:#337ab7; color:#fff !important'><?php echo $i.'<br> '.date("D", strtotime($showDays)); ?></th>
								<?php
							}
						?>
					</tr>
				</thead>
				<tbody>
				<?php
					$getStuData = $this->alam->selectA('student','ADM_NO,FIRST_NM,ROLL_NO',"Student_Status='ACTIVE' AND CLASS='$classs' AND SEC='$sec' ORDER BY ROLL_NO");
					foreach($getStuData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['ADM_NO']; ?></td>
								<td><?php echo $val['FIRST_NM']; ?></td>
								<td><?php echo $val['ROLL_NO']; ?></td>
								<?php
									$this->getMonthlyAtt($num_of_days,$year,$month,$classs,$sec,$att_type,$subj,$val['ADM_NO']);
								?>
							</tr>
						<?php
					}
				?>
				</tbody>
			</table>
			
			<script>
				$('#example').DataTable( {
					dom: 'Bfrtip',
					searching: false,
					paging: false,
					buttons: [
						{
							extend: 'excelHtml5',
							title: 'Attendance Report'
						},
					]
				} );
			</script>
		<?php
	}
	
	public function getMonthlyAtt($num_of_days,$year,$month,$classs,$sec,$att_type,$subj,$admno){
		for($i=1; $i<=$num_of_days; $i++){
			$dt = $year.'-'.$month.'-'.$i;
			
			$finDate = date('Y-m-d',strtotime($dt));
			$checkSunday = date('N',strtotime($finDate));
			
			//$getAttData = $this->alam->selectA('stu_attendance_entry_periodwise','*',"month(att_date)='$month' AND att_date='$finDate' AND class_code='$classs' AND sec_code='$sec' AND att_type='$att_type' AND subject_id='$subj' AND admno='$admno'");
			$getAttData = $this->alam->selectA('stu_attendance_entry_periodwise','*',"month(att_date)='$month' AND att_date='$finDate' AND class_code='$classs' AND sec_code='$sec' AND att_type='$att_type' AND admno='$admno' AND subject_id='$subj'");
			//$str = $this->db->last_query();
			//echo $str;
			//die;
			if(!empty($getAttData)){
				$att_status = $getAttData[0]['att_status'];
			}else if($checkSunday == 7){
				$att_status = 'H';
			}else{
				$att_status = '-';
			}
			if($att_status == 'A'){
				$color = 'red';
			}else if($att_status == 'P'){
				$color = 'green';
			}else if($att_status == '-'){
				$color = 'black';
			}else{
				$color = 'blue';
			}
			?>
				<td style='color:<?php echo $color; ?>'><?php echo $att_status; ?></td>
			<?php
		}
	}
	
	public function subjectWiseReportPDF($classs,$sec,$subj,$att_type,$month){
		$month_master = $this->alam->selectA('month_master','month_name',"month_code='$month'");
		$class_master = $this->alam->selectA('classes','CLASS_NM',"Class_No='$classs'");
		$sec_master = $this->alam->selectA('sections','SECTION_NAME',"section_no='$sec'");
		$subj_master = $this->alam->selectA('subjects','SubName',"SubCode='$subj'");
		$date     = date('Y-m-d');
		$explod   = explode('-',$date);
		$year     = $explod[0];
		$num_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		
		$school_setting = $this->alam->selectA('school_setting','*');
		?>
			<center>
			<table class='table' border='1' cellspacing='0' style='text-align:center'>
				<tr>
					<td colspan='<?php echo $num_of_days + 3; ?>'>
						<h1>
						<center>
							<?php echo $school_setting[0]['School_Name']; ?><br />
						</center>
						</h1>
						<h3>
							<center>
								<?php echo $school_setting[0]['School_Address']; ?>
							</center>
						</h3>
					</td>
				</tr>
				<tr>
					<th colspan='<?php echo $num_of_days + 3; ?>'><h4><center>MONTHLY SUBJECT WISE ATTENDANCE REPORT</center></h4></th>
				</tr>
				<tr>
					<td>Month: <?php echo $month_master[0]['month_name']; ?></td>
					<td colspan='<?php echo $num_of_days+1; ?>'><center><h3><?php echo $subj_master[0]['SubName']; ?></h3></center></td>
					<td>Class-Sec: <?php echo $class_master[0]['CLASS_NM'].'-'.$sec_master[0]['SECTION_NAME']; ?></td>
				</tr>
				<tr>
					<th style='background:#337ab7; color:#fff !important'>Adm No.</th>
					<th style='background:#337ab7; color:#fff !important'>Stu. Name</th>
					<th style='background:#337ab7; color:#fff !important'>Roll No.</th>
					<?php
						for($i=1; $i<=$num_of_days; $i++){
							$showDays = $year.'-'.$month.'-'.$i;
							?>
								<th style='background:#337ab7; color:#fff !important'><?php echo $i.'<br> '.date("D", strtotime($showDays)); ?></th>
							<?php
						}
					?>
				</tr>
				<?php
					$getStuData = $this->alam->selectA('student','ADM_NO,FIRST_NM,ROLL_NO',"Student_Status='ACTIVE' AND CLASS='$classs' AND SEC='$sec' ORDER BY ROLL_NO");
					foreach($getStuData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['ADM_NO']; ?></td>
								<td><?php echo $val['FIRST_NM']; ?></td>
								<td><?php echo $val['ROLL_NO']; ?></td>
								<?php
									$this->getMonthlyAtt($num_of_days,$year,$month,$classs,$sec,$att_type,$subj,$val['ADM_NO']);
								?>
							</tr>
						<?php
					}
				?>
			</table>
			</center>
			<script>
				window.print();
			</script>
		<?php
	}
}
