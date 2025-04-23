<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
    
    public function sms_day_wise(){
		$data['log_cls_no'] = login_details['Class_No'];
		$data['log_sec_no'] = login_details['Section_No'];
		$data['class_data'] = $this->alam->select('student_attendance_type','*');
		$this->render_template('student/sms/sms_day_wise',$data);
	}
   
    public function classes(){
		$ret      = '';
		$att_type = '';
		
		$class_nm = $this->input->post('val');
		$dt = $this->input->post('dt');
		$date = date('Y-m-d',strtotime($dt));
		
		$att_type_data = $this->alam->select('student_attendance_type','attendance_type',"class_code='$class_nm'");
		$att_type = $att_type_data[0]->attendance_type;
		
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$log_sec_no = login_details['Section_No'];
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				if($log_sec_no == $data->SEC){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
				}
			}
		}
		
		$array = array($ret,$att_type);
		echo json_encode($array);
	} 

    public function sms_fetchdata(){
		$dt       = $this->input->post('dt');
		$date     = date('Y-m-d',strtotime($dt));
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$att_sta  = $this->input->post('att_sta');
		$att_type = $this->input->post('att_type');
		$period   = $this->input->post('period');
		if($att_type == 1){
			$stu_data = $this->alam->select('stu_attendance_entry','admno,(SELECT FIRST_NM FROM student where ADM_NO=stu_attendance_entry.admno)fname,(SELECT DISP_CLASS FROM student where ADM_NO=stu_attendance_entry.admno)classnm,(SELECT DISP_SEC FROM student where ADM_NO=stu_attendance_entry.admno)secnm,(SELECT C_MOBILE FROM student where ADM_NO=stu_attendance_entry.admno)cmob',"class_code = '$classs' AND sec_code = '$sec' AND att_date = '$date' AND att_status='$att_sta'");
			?>
			  <table class='table'>
			    <tr>
				  <th style='background:#5785c3; color:#fff !important;'>Sl No.</th>
				  <th style='background:#5785c3; color:#fff !important;'>Adm No.</th>
				  <th style='background:#5785c3; color:#fff !important;'>Name</th>
				  <th style='background:#5785c3; color:#fff !important;'>Class</th>
				  <th style='background:#5785c3; color:#fff !important;'>Sec</th>
				  <th style='background:#5785c3; color:#fff !important;'>Mobile</th>
			    </tr>
				<?php
				  $i = 1;
				  foreach($stu_data as $data){
					  ?>
					  <tr>
					    <td><?php echo $i; ?></td>
					    <td><?php echo $data->admno; ?><input type='hidden' name='admno[]' value='<?php echo $data->admno; ?>'></td>
					    <td><?php echo $data->fname; ?></td>
					    <td><?php echo $data->classnm; ?></td>
					    <td><?php echo $data->secnm; ?></td>
					    <td><?php echo $data->cmob; ?><input type='hidden' name='cmob[]' value='<?php echo $data->cmob; ?>'></td>
					  </tr>	
					  <?php
					  $i++;
				  }
				?>
			  </table>
			<?php
		}else{
			$stu_data = $this->alam->select('stu_attendance_entry_periodwise','admno,(SELECT FIRST_NM FROM student WHERE ADM_NO=stu_attendance_entry_periodwise.admno)fname,(SELECT DISP_CLASS FROM student WHERE ADM_NO=stu_attendance_entry_periodwise.admno)classnm,(SELECT DISP_SEC FROM student WHERE ADM_NO=stu_attendance_entry_periodwise.admno)secnm,period,(SELECT C_MOBILE FROM student WHERE ADM_NO=stu_attendance_entry_periodwise.admno)cmob',"class_code = '$classs' AND sec_code = '$sec' AND att_date = '$date' AND att_status='$att_sta' AND period='$period'");
			?>
			  <table class='table'>
			    <tr>
				  <th style='background:#5785c3; color:#fff !important;'>Sl No.</th>
				  <th style='background:#5785c3; color:#fff !important;'>Adm No.</th>
				  <th style='background:#5785c3; color:#fff !important;'>Name</th>
				  <th style='background:#5785c3; color:#fff !important;'>Class</th>
				  <th style='background:#5785c3; color:#fff !important;'>Sec</th>
				  <th style='background:#5785c3; color:#fff !important;'>Period</th>
				  <th style='background:#5785c3; color:#fff !important;'>Mobile</th>
			    </tr>
				<?php
				  $i = 1;
				  foreach($stu_data as $data){
					  ?>
					  <tr>
					    <td><?php echo $i; ?></td>
					    <td><?php echo $data->admno; ?><input type='hidden' name='admno[]' value='<?php echo $data->admno; ?>'></td>
					    <td><?php echo $data->fname; ?></td>
					    <td><?php echo $data->classnm; ?></td>
					    <td><?php echo $data->secnm; ?></td>
					    <td><?php echo $data->period; ?></td>
					    <td><?php echo $data->cmob; ?><input type='hidden' name='cmob[]' value='<?php echo $data->cmob; ?>'></td>
					  </tr>	
					  <?php
					  $i++;
				  }
				?>
			  </table>
			<?php
		}
	}
	
	public function sendsms(){
		for($i=0; $i<count($this->input->post('admno')); $i++){
			$admno    = $this->input->post('admno')[$i];
			$dt       = $this->input->post('dtt');
			$att_stas = $this->input->post('att_stas');
			
			$stu_data = $this->alam->select('student','TITLE_NM,FIRST_NM,MIDDLE_NM,C_MOBILE',"ADM_NO='$admno'");
			$titlenm  = $stu_data[0]->TITLE_NM;
			$firstnm  = $stu_data[0]->FIRST_NM;
			$middlenm = $stu_data[0]->MIDDLE_NM;
			$mob      = $stu_data[0]->C_MOBILE;
			//----------send sms--------------//
			//Your authentication key
				$authKey = "1179AUO6WzMSj5cbaa62a";

				//Multiple mobiles numbers separated by comma
				$mobileNumber = $mob;

				//Sender ID,While using route4 sender id should be 6 characters long.
				$senderId = "JVMSHM";
                if($att_stas == 'A'){
				 $msg = 'Dear Parent, Your Ward '.$firstnm.' '.$middlenm.' '.$titlenm.' is absent today '.$dt.' from "JVM Shyamali"';
				}elseif($att_stas == 'P'){
				  $msg = 'Dear Parent, Your Ward '.$firstnm.' '.$middlenm.' '.$titlenm.' is present today '.$dt.' from "JVM Shyamali"';	
				}else{
				  $msg = 'Dear Parent, Your Ward '.$firstnm.' '.$middlenm.' '.$titlenm.' is half day today '.$dt.' from "JVM Shyamali"';	
				}

				$message = urlencode($msg);

				//Define route 
				$route = "default";
				//Prepare you post parameters
				$postData = array(
					'authkey' => $authKey,
					'mobiles' => $mobileNumber,
					'message' => $message,
					'sender'  => $senderId,
					'route'   => $route
				);

				//API URL
				$url="http://www.smsmica.com/api/sendhttp.php?authkey=".$authKey."&mobiles=".$mobileNumber."&message=".$message."&sender=".$senderId."&route=4&country=91";

				// init the resource
				$ch = curl_init();
				curl_setopt_array($ch, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $postData
					//,CURLOPT_FOLLOWLOCATION => true
				));


				//Ignore SSL certificate verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


				//get response
				$output = curl_exec($ch);

				//Print error if any
				if(curl_errno($ch))
				{
					echo 'error:' . curl_error($ch);
				}

				curl_close($ch);

				$output ."<br />";
			//-----------end sms send-------------//
		}
		$this->session->set_flashdata('success',"SMS send Successfully..");
		redirect('student/sms/Sms/sms_day_wise');
	}
}
