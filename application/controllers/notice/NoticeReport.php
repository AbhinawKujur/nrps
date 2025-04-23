<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NoticeReport extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Notice_model','alam');
		$this->load->model('Alam','alamm');
	}
	
	public function index(){

		// if(!in_array('viewNotice', permission_data)){
			// redirect('payroll/dashboard/dashboard');
		// }
		$empid = login_details['user_id'];
		$data['noticeData'] = $this->alam->noticeReport($empid);
		$this->render_template('notice/noticereport',$data);
	}
	
	public function loadCat(){
		$user_id = login_details['user_id'];
		$date = date('Y-m-d',strtotime($this->input->post('date')));
		if(login_details['ROLE_ID'] != '4'){
			$dataBydate = $this->alamm->selectA('notice','distinct(notice_category)',"date='$date' AND emp_id = '$user_id'");
		}else{
			$dataBydate = $this->alamm->selectA('notice','distinct(notice_category)',"date='$date'");
		}
		?>
			<option value=''>Select</option>
		<?php
		if(!empty($dataBydate)){
			foreach($dataBydate as $key => $val){
				?>
					<option value='<?php echo $val['notice_category']; ?>'><?php echo $val['notice_category']; ?></option>
				<?php
			}
		}
	}
	
	public function loadSearchByData(){
		$date = date('Y-m-d',strtotime($this->input->post('date')));
		$cat  = $this->input->post('cat');
		$empid = login_details['user_id'];
		if(login_details['ROLE_ID'] != '4'){
			$loadData = $this->alamm->selectA('notice','*,(select EMP_FNAME from employee where EMPID=notice.emp_id)empnm,(select SECTION_NAME from sections where section_no=notice.sec)secnm,(select CLASS_NM from classes where Class_No=notice.class)classnm,(select count(*) from notice_adm_wise WHERE notice_tbl_id=notice.id)cnt',"date='$date' AND notice_category='$cat' AND emp_id='$empid'");
		}else{
			$loadData = $this->alamm->selectA('notice','*,(select EMP_FNAME from employee where EMPID=notice.emp_id)empnm,(select SECTION_NAME from sections where section_no=notice.sec)secnm,(select CLASS_NM from classes where Class_No=notice.class)classnm,(select count(*) from notice_adm_wise WHERE notice_tbl_id=notice.id)cnt',"date='$date' AND notice_category='$cat'");
		}
		if(!empty($loadData)){
			foreach($loadData as $key => $val){
				?>
					<tr>
						<td><?php echo $val['empnm']; ?></td>
						<td><?php echo $val['classnm']; ?></td>
						<td><?php echo $val['secnm']; ?></td>
						<td><?php echo $val['notice']; ?></td>
						<td>
							<?php
								if($val['img'] != ''){
							?>
									<a target='_blank' href="<?php echo base_url($val["img"]); ?>"><i class="fa fa-eye"></i></a>
							<?php } else { ?>
									No Attachement
							<?php } ?>
						</td>
						<td><button class='btn btn-success btn-sm' onclick='SentNotice(<?php echo $val['id']; ?>)'><?php echo $val['cnt']; ?></button></td>
						<td><?php echo $val['sent_type']; ?></td>
					</tr>
				<?php 
			}
		}
	}
	
	public function sentNoticeView(){
		$id = $this->input->post('id');
		$stuData = $this->alamm->selectA('notice_adm_wise','*,(select FIRST_NM from student where ADM_NO=notice_adm_wise.admno)firstnm,(select ROLL_NO from student where ADM_NO=notice_adm_wise.admno)rollno,(select FATHER_NM from student where ADM_NO=notice_adm_wise.admno)fname',"notice_tbl_id='$id'");
		?>
		<table class='table'>
			<tr>
				<th>Adm. No.</th>
				<th>Roll No.</th>
				<th>Student Name</th>
				<th>Father's Name</th>
			</tr>
		<?php
		foreach($stuData as $key => $val){
			?>
				<tr>
					<td><?php echo $val['admno']; ?></td>
					<td><?php echo $val['rollno']; ?></td>
					<td><?php echo $val['firstnm']; ?></td>
					<td><?php echo $val['fname']; ?></td>
				</tr>
			<?php
		}
		?>
		</table>
		<?php
	}
}
