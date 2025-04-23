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
		$dataBydate = $this->alamm->selectA('notice','distinct(notice_category)',"date='$date' AND emp_id = '$user_id'");
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
		$loadData = $this->alamm->selectA('notice','*,(select count(*) from notice_adm_wise WHERE notice_tbl_id=notice.id)cnt',"date='$date' AND notice_category='$cat' AND emp_id='$empid'");
		if(!empty($loadData)){
			foreach($loadData as $key => $val){
				?>
					<tr>
						<td><?=strtoupper($val['sent_type']);?></td>
						<td><?php echo $val['notice_category']; ?></td>
						<td><?php echo $val['notice']; ?></td>
						<td>
							<?php
							if(!empty($val['img'])){
								$str = $val['img'];
								$ext=explode(".",$str);
								//echo $ext[0];
								 
						?>
						<a href="#" data-href="<?php echo base_url($val['img']); ?>" download="<?='Notice.'.$ext[1];?>" onclick='forceDownload(this)' class="btn btn-success btn-sm"><i class="fa fa-download" title='DOWNLOAD FILE' style='color:#fff;'></i></a>
						
							<?php } else { ?>
									No Attachment
							<?php } ?>
						</td>
						<td><button class='btn btn-success btn-sm' onclick='SentNotice(<?php echo $val['id']; ?>)'><?php echo $val['cnt']; ?></button></td>
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
