<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OnlineExamStu extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}
	public function index(){
		$this->parentLoggedOut();
		$admno = $this->session->userdata('adm');
		$class_code = $this->session->userdata('class_code');
		$sec_code = $this->session->userdata('sec_code');
		$data['stuDetails'] = $this->alam->selectA('student','ADM_NO,FIRST_NM,DISP_CLASS,DISP_SEC,ROLL_NO',"ADM_NO='$admno' AND Student_Status='ACTIVE'");
		
		$todayDate = date('Y-m-d');
		$data['getSchedule'] = $this->alam->selectA('online_exam_schedule','*,(select SubName from subjects where SubCode=online_exam_schedule.subject_id)subjnm',"date(exam_date)='$todayDate' AND display_status = '1' AND class_id='$class_code' AND sec_id='$sec_code' order by time(start_time)");
		
		$sdate=(!empty($data['getSchedule'][0]['exam_date']))?$data['getSchedule'][0]['exam_date']:'0';
		$stime=(!empty($data['getSchedule'][0]['start_time']))?$data['getSchedule'][0]['start_time']:'0';		
		$data['startdatetime']=$sdate.' '.$stime;		
		
		$this->load->view('onlineExam/student/stuAndScheduleDetals',$data);
	}
	
	public function logout(){
		$admno = $this->session->userdata('adm');
		
		$upd = array(
			'RemID' => 0
		);
		
		$this->alam->update('student',$upd,"ADM_NO='$admno'");
		
		$this->session->unset_userdata('msg');
		$this->session->unset_userdata('adm');
		$this->session->unset_userdata('class_code');
		$this->session->unset_userdata('sec_code');
		$this->session->unset_userdata('duration');
		$this->session->unset_userdata('end_time');
		$this->session->unset_userdata('subject_id');
		$this->session->unset_userdata('subjnm');
		$this->session->unset_userdata('examnm');
		$this->session->unset_userdata('exam_pattern');
		$this->session->unset_userdata('exam_schedule_id');
		$this->session->unset_userdata('login_status');
		$this->session->unset_userdata('exam_date');
		$this->session->unset_userdata('start_time');
		
		redirect('parentlogin');
	}
	
	public function chkDateTimeAdm(){
		$this->parentLoggedOut();
		$admno = $this->input->post('admno');
		$getData = $this->db->query("SELECT osel.id as online_student_exam_list_id,osel.login_status,oes.id as online_exam_schedule_id,oes.start_time,oes.end_time,oes.duration,oes.subject_id,(select SubName from subjects where SubCode=oes.subject_id) as subjnm,oes.exam_id,(select exam_name from online_exam_master where id=oes.exam_id) as examnm,oes.exam_pattern,oes.exam_date FROM `online_exam_schedule` as oes inner JOIN online_student_exam_list as osel on oes.id=osel.exam_schedule_id  WHERE date(oes.exam_date)=CONVERT(CURRENT_DATE,date) and CONVERT(CURRENT_TIME,time)>=CONVERT(oes.start_time,time) AND CONVERT(CURRENT_TIME,time)<=CONVERT(oes.end_time,time) AND oes.display_status='1' AND osel.admno='$admno'")->result_array();
		
		$start_time = (!empty(date('H:i:s',strtotime($getData[0]['start_time']))))?date('H:i:s',strtotime($getData[0]['start_time'])):'00:00:00';
		$currTime   = date('H:i:s');
		
		//if($start_time == $currTime){
			$online_student_exam_list_id = $getData[0]['online_student_exam_list_id'];
			$online_exam_schedule_id     = $getData[0]['online_exam_schedule_id'];
			$duration                    = $getData[0]['duration'];
			$subject_id                  = $getData[0]['subject_id'];
			$subjnm                      = $getData[0]['subjnm'];
			$examnm                      = $getData[0]['examnm'];
			$end_time                    = $getData[0]['end_time'];
			$exam_pattern                = $getData[0]['exam_pattern'];
			$login_status                = $getData[0]['login_status'];
			$exam_date                   = $getData[0]['exam_date'];
			$start_time                  = $getData[0]['start_time'];
			$MAC = exec('getmac'); 
			$MAC = strtok($MAC, ' ');
			
			$upd = array(
				'ip_add'       => '123',
				'mac_add'      => '456',
				'login_status' => 1
			);
			
			$this->alam->update('online_student_exam_list',$upd,"admno='$admno' AND id='$online_student_exam_list_id'");
			
			$this->session->set_userdata('duration',$duration);
			$this->session->set_userdata('end_time',$end_time);
			$this->session->set_userdata('subject_id',$subject_id);
			$this->session->set_userdata('subjnm',$subjnm);
			$this->session->set_userdata('examnm',$examnm);
			$this->session->set_userdata('exam_pattern',$exam_pattern);
			$this->session->set_userdata('exam_schedule_id',$online_exam_schedule_id);
			$this->session->set_userdata('login_status',$login_status);
			$this->session->set_userdata('exam_date',$exam_date);// generate session use in questions controller
			$this->session->set_userdata('start_time',$start_time);
			echo 1; //exam is starting right now
		//}
	}
	
	public function proceedToExam(){
		$this->parentLoggedOut();
		$admno = $this->input->post('admno');
		$getData = $this->db->query("SELECT osel.id as online_student_exam_list_id,osel.login_status,oes.id as online_exam_schedule_id,oes.start_time,oes.end_time,oes.duration,oes.subject_id,(select SubName from subjects where SubCode=oes.subject_id) as subjnm,oes.exam_id,(select exam_name from online_exam_master where id=oes.exam_id) as examnm,oes.exam_pattern,oes.exam_date FROM `online_exam_schedule` as oes inner JOIN online_student_exam_list as osel on oes.id=osel.exam_schedule_id  WHERE date(oes.exam_date)=CONVERT(CURRENT_DATE,date) and CONVERT(CURRENT_TIME,time)>=CONVERT(oes.start_time,time) AND CONVERT(CURRENT_TIME,time)<=CONVERT(oes.end_time,time) AND oes.display_status='1' AND osel.admno='$admno'")->result_array();
		
		$cnt = count($getData);
		if($cnt == 1){
			$online_student_exam_list_id = $getData[0]['online_student_exam_list_id'];
			$online_exam_schedule_id     = $getData[0]['online_exam_schedule_id'];
			$duration                    = $getData[0]['duration'];
			$subject_id                  = $getData[0]['subject_id'];
			$subjnm                      = $getData[0]['subjnm'];
			$examnm                      = $getData[0]['examnm'];
			$end_time                    = $getData[0]['end_time'];
			$exam_pattern                = $getData[0]['exam_pattern'];
			$login_status                = $getData[0]['login_status'];
			$exam_date                   = $getData[0]['exam_date'];
			$start_time                   = $getData[0]['start_time'];
			
			$getDataStuScheduleList = $this->alam->selectA('online_student_exam_list','exam_schedule_id,ip_add,mac_add,login_status',"admno='$admno' AND id='$online_student_exam_list_id'");
			
			$mac_add = $getDataStuScheduleList[0]['mac_add'];
			//$login_status = $getDataStuScheduleList[0]['login_status'];
			
			if($login_status == 0){
				$MAC = exec('getmac'); 
				$MAC = strtok($MAC, ' ');
				$upd = array(
					'ip_add'       => '123',
					'mac_add'      => '456',
					'login_status' => 1
				);
				$this->alam->update('online_student_exam_list',$upd,"admno='$admno' AND id='$online_student_exam_list_id'");
				
				$this->session->set_userdata('duration',$duration);
				$this->session->set_userdata('end_time',$end_time);
			    $this->session->set_userdata('subject_id',$subject_id);
			    $this->session->set_userdata('subjnm',$subjnm);
			    $this->session->set_userdata('examnm',$examnm);
				$this->session->set_userdata('exam_pattern',$exam_pattern);
				$this->session->set_userdata('exam_schedule_id',$online_exam_schedule_id);
				$this->session->set_userdata('login_status',$login_status);
			    $this->session->set_userdata('exam_date',$exam_date);//generate session use in questions controller
				$this->session->set_userdata('start_time',$start_time);
				
				echo 1; //exam is running 
			}else{
				$MAC = exec('getmac'); 
				$MAC = strtok($MAC, ' ');
				
				if($mac_add == $MAC){
					$this->session->set_userdata('duration',$duration);
					$this->session->set_userdata('end_time',$end_time);
					$this->session->set_userdata('subject_id',$subject_id);
			        $this->session->set_userdata('subjnm',$subjnm);
			        $this->session->set_userdata('examnm',$examnm);
					$this->session->set_userdata('exam_pattern',$exam_pattern);
					$this->session->set_userdata('exam_schedule_id',$online_exam_schedule_id);
					$this->session->set_userdata('login_status',$login_status);
			        $this->session->set_userdata('exam_date',$exam_date);
					$this->session->set_userdata('start_time',$start_time);
					
					// generate session exam_session_id use in questions controller
					
				    echo 1; //exam is running
					
				}else{
					$this->session->set_userdata('duration',$duration);
					$this->session->set_userdata('end_time',$end_time);
					$this->session->set_userdata('subject_id',$subject_id);
			        $this->session->set_userdata('subjnm',$subjnm);
			        $this->session->set_userdata('examnm',$examnm);
					$this->session->set_userdata('exam_pattern',$exam_pattern);
					$this->session->set_userdata('exam_schedule_id',$online_exam_schedule_id);
					$this->session->set_userdata('login_status',$login_status);
			        $this->session->set_userdata('exam_date',$exam_date);// generate session exam_session_id use in questions controller
					$this->session->set_userdata('start_time',$start_time);
					
					
					//echo 4; //check MAC address exist or not
					//code in not done
					
					echo 1; //exam is running
				}
			}
		}else{
			$getData2 = $this->db->query("SELECT count(oes.id)cnt FROM `online_exam_schedule` as oes inner JOIN online_student_exam_list as osel on oes.id=osel.exam_schedule_id WHERE date(oes.exam_date)=CONVERT(CURRENT_DATE,date) AND CONVERT(CURRENT_TIME,time)<=CONVERT((SELECT Max(oes.end_time) FROM `online_exam_schedule` as oes inner JOIN online_student_exam_list as osel on oes.id=osel.exam_schedule_id WHERE date(oes.exam_date)=CONVERT(CURRENT_DATE,date) AND oes.display_status='1' AND osel.admno='$admno'),time) AND oes.display_status='1' AND osel.admno='$admno'")->result_array();
			$cnt2 = $getData2[0]['cnt'];
			
			if($cnt2 == 0){
				echo 3;// no any exam for only pop-up 
			}else{
				echo 2; // next exam is coming for only pop-up
			}
		}
	}
}