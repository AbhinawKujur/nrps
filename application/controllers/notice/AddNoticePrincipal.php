<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddNoticePrincipal extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$data['clasa_no']   = login_details['Class_No'];
		$data['sec_no']     = login_details['Section_No'];
		$data['login_id']   = login_details['user_id'];
		$data['date']       = date('Y-m-d');
		$data['teacher_data'] = $this->alam->selectA('employee','EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,STAFF_TYPE',"STAFF_TYPE='1'");
		
		$data['stuData']    = $this->alam->selectA('student','STUDENTID,ADM_NO,FIRST_NM',"CLASS='$class' AND SEC='$sec'");
		
		$data['classSecData']    = $this->alam->selectA('student','DISP_CLASS,DISP_SEC,CLASS,SEC',"Student_Status = 'ACTIVE' GROUP BY DISP_CLASS,DISP_SEC,CLASS,SEC ORDER BY CLASS,SEC");
		
		$data['noticeData'] = $this->alam->selectA('notice','*',"1='1' order by notice.id desc");
		//echo $this->db->last_query();die;
		
		$this->render_template('notice/add_notice_principal',$data);
	}
	
	public function saveNotice(){
		$lastData           = $this->alam->orderByDesc();
		$last_id            = isset($lastData[0]['id']) ? $lastData[0]['id'] : 0;
		
		$sent               = $this->input->post('sent');
		$date               = $this->input->post('date');
		$category           = $this->input->post('category');
		$notice             = $this->input->post('notice');
		$sendto             = $this->input->post('sendto');// 1=teacher,2=students
		
		if($sendto == 1){
			$selectdata = $this->input->post('teacher[]');
			$sentStatus = 'T';
			$class      = 0;
		    $sec        = 0;
			
			if(!empty($_FILES['img']['name'])){
			$image              = $_FILES['img']['name']; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = $last_id .'.'.$image_ext;
			$imagepath          = "uploads/notice_img/".$image_name;
			
			move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
			}else{
				$imagepath  = '';
			}
			
			$saveDataNotice = array(
				'emp_id'		  => login_details['user_id'],
				'date'            => $date,
				'class'           => $class,
				'sec'             => $sec,
				'notice_category' => $category,
				'notice'          => $notice,
				'img'             => $imagepath,
				'is_allstu'       => $sendto,
				'sent_status'     => $sentStatus,
				'sent_type'       => $sent
			);
			
			$this->alam->insert('notice',$saveDataNotice);
			$insertLastId = $this->db->insert_id();
			
			
			foreach($selectdata as $key => $val){
				if($val != 'all_teacher'){
					
				$teacherData = $this->alam->selectA('employee','EMPID,C_MOBILE,',"STAFF_TYPE='1' AND EMPID = '$val'");
				$mobile = $teacherData[0]['C_MOBILE'];
				
					$saveAllStu = array(
						'notice_tbl_id' => $insertLastId,
						'admno' => $val
					);
					$this->alam->insert('notice_adm_wise',$saveAllStu);
					if($sent == 'sms'){
						$msg = $notice;
						$this->sms_lib->sendSMS($mobile,$msg);
					}
				}else{
					$teacherData = $this->alam->selectA('employee','EMPID,C_MOBILE',"STAFF_TYPE='1'");
					$mobile = array();
					foreach($teacherData as $key2 => $val2){
						$mobile[] = $val2['C_MOBILE'];
						 $saveAllStu = array(
							'notice_tbl_id' => $insertLastId,
							'admno' => $val2['EMPID']
					);
					$this->alam->insert('notice_adm_wise',$saveAllStu);
					}
					if($sent == 'sms'){
						$msg = $notice;
						$mobile = implode(',',$mobile);
						$this->sms_lib->sendSMS($mobile,$msg);
					}
				}	
			}	
			$this->session->set_flashdata('msg','Notice Sent Successfully');
			redirect('notice/AddNoticePrincipal');
			
			
		}else{
			$classSec   = $this->input->post('classSec[]');
			$sentStatus = 'S';
			foreach($classSec as $key => $val){
				//$explodeData = ($val != 'all_classsec') ? explode('-',$val) : '';
				if($val != 'all_classsec'){
					$explodeData = explode('-',$val);
				    $class = $explodeData[0];
				    $sec   = $explodeData[1];
				}else{
					$class = 0;
					$sec   = 0;
				}
				   
				   if(!empty($_FILES['img']['name'])){
					$image              = $_FILES['img']['name']; 
					$expimage           = explode('.',$image);
					$count              = count($expimage);
					$image_ext          = $expimage[$count-1];
					$image_name         = $last_id .'.'.$image_ext;
					$imagepath          = "uploads/notice_img/".$image_name;
					
					move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
					}else{
						$imagepath  = '';
					}
					
					$saveDataNotice = array(
						'emp_id'		  => login_details['user_id'],
						'date'            => $date,
						'class'           => $class,
						'sec'             => $sec,
						'notice_category' => $category,
						'notice'          => $notice,
						'img'             => $imagepath,
						'is_allstu'       => $sendto,
						'sent_status'     => $sentStatus,
						'sent_type'       => $sent
					);
					
					$this->alam->insert('notice',$saveDataNotice);
					$insertLastId = $this->db->insert_id();
					$mobile = array();
					foreach($classSec as $key2 => $val2){
						$stuData = $this->alam->selectA('student','ADM_NO,C_MOBILE',"CLASS='$class' AND SEC = '$sec' AND Student_Status = 'ACTIVE'");
						if($val2 != 'all_classsec'){
						$mobile = array();
						foreach($stuData as $key2 => $val2){
							$mobile[] = $val2['C_MOBILE'];
							$saveAllStu = array(
								'notice_tbl_id' => $insertLastId,
								'admno' => $val2['ADM_NO']
							);
							$this->alam->insert('notice_adm_wise',$saveAllStu);
						}
						if($sent == 'sms'){
							$msg = $notice;
							$mobile = implode(',',$mobile);
							$this->sms_lib->sendSMS($mobile,$msg);
						}
						}else{
							$stuDataa = $this->alam->selectA('student','ADM_NO,C_MOBILE',"Student_Status = 'ACTIVE'");
							
							foreach($stuDataa as $key2 => $val2){
								$mobile[] = $val2['C_MOBILE'];
								 $saveAllStu = array(
									'notice_tbl_id' => $insertLastId,
									'admno' => $val2['ADM_NO']
							    );
							$this->alam->insert('notice_adm_wise',$saveAllStu);
							}
							if($sent == 'sms'){
								$msg = $notice;
								$mobile = implode(',',$mobile);
								$this->sms_lib->sendSMS($mobile,$msg);
							}
						}
					}	
					$this->session->set_flashdata('msg','Notice Sent Successfully');
					redirect('notice/AddNoticePrincipal');
			}
		}

	}
	
	public function noticeEdit(){
		$id = $this->input->post('id');
		$noticeData = $this->alam->selectA('notice','notice_category,notice,img,is_allstu,class,sec',"id='$id'");
		
		$notice_category = $noticeData[0]['notice_category'];
		$notice          = $noticeData[0]['notice'];
		$img             = $noticeData[0]['img'];
		$is_allstu       = $noticeData[0]['is_allstu'];
		$class           = $noticeData[0]['class'];
		$sec             = $noticeData[0]['sec'];
		?>
		<form method='post' action='<?php echo base_url('notice/AddNotice/updateNotice'); ?>' enctype='multipart/form-data'>
		<table class='table'>
		<input type='hidden' name='id' value='<?php echo $id; ?>'>
		<input type='hidden' name='imgg' value='<?php echo $img; ?>'>
			<tr>
				<th>Category</th>
				<td>
					<select class='form-control' name='category' required>
						<option value=''>Select</option>
						<option value='School Notice' <?php if('School Notice' == $notice_category){ echo 'selected'; } ?>>School Notice</option>
						<option value='Complaint Notice' <?php if('Complaint Notice' == $notice_category){ echo 'selected'; } ?>>Complaint Notice</option>
						<option value='Fee Defaulter' <?php if('Fee Defaulter' == $notice_category){ echo 'selected'; } ?>>Fee Defaulter</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Notice</th>
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
				<td colspan='2'><center><button class='btn btn-warning btn-sm'>Update <i class="fa fa-paper-plane" style='color:#fff'></i></button></center></td>
			</tr>
		</table>
		</form>
		<?php
	}
	
	public function updateNotice(){
		
		$category           = $this->input->post('category');
		$notice             = $this->input->post('notice');
		$imgg               = $this->input->post('imgg');
		$id                 = $this->input->post('id');
		
		
		if(!empty($_FILES['img']['name'])){
		$image              = $_FILES['img']['name']; 
		$expimage           = explode('.',$image);
		$count              = count($expimage);
		$image_ext          = $expimage[$count-1];
		$image_name         = $id .'.'.$image_ext;
		$imagepath          = "uploads/notice_img/".$image_name;
		
		move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
		}else{
			$imagepath  = $imgg;
		}
		
		$updateDataNotice = array(
			'notice_category' => $category,
			'notice'          => $notice,
			'img'             => $imagepath,
		);
		
		$this->alam->update('notice',$updateDataNotice,"id='$id'");
		
		$this->session->set_flashdata('msg','Notice Updated Successfully');
		redirect('notice/AddNotice');
	}
}
