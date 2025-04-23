<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annual_report_card extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		if(!in_array('viewTermWiseReportCard', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
		$data['class_data'] = $this->alam->select('classes','*',"class_no in (5,6,7)");
		$this->render_template('report_card/annual_report_card',$data);
	}
	
	public function classess_report_card(){
		$ret = '';
		$class_code = '';
		$pt_type = '';
		$exam_type = '';
		
		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$class_data = $this->alam->select('classes','*',"Class_No='$class_nm'");
		$class_code = $class_data[0]->Class_No;
		$pt_type    = $class_data[0]->PT_TYPE;
		$exam_type  = $class_data[0]->ExamMode;
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
			}
		}
		
		$array = array($ret,$class_code,$pt_type,$exam_type);
		echo json_encode($array);
	}
	
	public function make_report_card(){
		$trm        = $this->input->post('trm');
		$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$date       = $this->input->post('date');
		$dt         = date('Y-m-d',strtotime($date));
		$round      = $this->input->post('round');
		$class_code = $this->input->post('class_code');
		$pt_type    = $this->input->post('pt_type');
		$exam_type  = $this->input->post('exam_type');
		
		$school_setting = $this->alam->select('school_setting','*');
		$stu_data = $this->alam->annual_report_card_student_detail1($classs,$sec);
		
		$array = array('trm'=>$trm,'school_setting'=>$school_setting,'stu_data'=>$stu_data,'classs'=>$classs,'sec'=>$sec,'round'=>$round,'dt'=>$dt);
		
	    $this->load->view('report_card/annual_report_card_list',$array);
	}
	
	public function generatePDF(){
		$class         = $this->input->post('classs');
		$dispClassData = $this->alam->selectA('classes','CLASS_NM',"Class_No='$class'");
		$DISP_CLASS    = $dispClassData[0]['CLASS_NM'];
		$sec           = $this->input->post('sec');
		$round_off     = $this->input->post('round_off');
		$examModeData  = $this->alam->selectA('classes','ExamMode',"Class_No='$class'");
		$examMode      = $examModeData[0]['ExamMode'];
		$school_photo = $this->alam->selectA('school_photo','*');
		$data['School_Logo'] = $school_photo[0]['School_Logo'];
		if($class != '11'){ //chk for IX class
			if($examMode == 1){//for cbse
				$data['class']          = $class;
				$data['DISP_CLASS']     = $DISP_CLASS;
				$data['sec']            = $sec;
				$data['round']          = $round_off;
				$data['selected_stu']   = $this->input->post('stu_adm_no[]');
				$data['grademaster']    = $this->alam->select('grademaster','*');
				$data['subjectData']    = $this->alam->getClassWiseSubject(1,$class,$sec);
				$data['school_setting'] = $this->alam->select('school_setting','*');
				$this->load->view('report_card/cbse_annual_report_card_pdf',$data);
				
			}else{//for cmc
				echo "CMC Work in Progress"; 
			}
		}else{
			if($examMode == 1){//for cbse
				$data['class']          = $class;
				$data['DISP_CLASS']     = $DISP_CLASS;
				$data['sec']            = $sec;
				$data['round']          = $round_off;
				$data['selected_stu']   = $this->input->post('stu_adm_no[]');
				$data['grademaster']    = $this->alam->select('grademaster','*');
				$data['subjectData']    = $this->alam->getClassWiseSubject(1,$class,$sec);
				$data['school_setting'] = $this->alam->select('school_setting','*');
				$this->load->view('report_card/cbse_annual_report_card_pdf_IX',$data);
				
			}else{//for cmc
				echo "CMC Work in Progress"; 
			}
		}
	}
}