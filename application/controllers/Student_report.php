<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_studentpanel(){
		$this->fee_template('student_report/show_report');
	}
	public function studentinformation(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		
		$this->fee_template('student_report/studentinformation',$array);
	}
	public function find_sec(){
		$val = $this->input->post('val');
		$data = $this->dbcon->select_distinct('student','DISP_SEC,SEC',"CLASS='$val' AND Student_Status='ACTIVE'");
		?>
		  <option value=''>Select</option>
		<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
			<?php
		}
	}
	public function find_detailsstudentinformation(){
		$class		= $this->input->post('class_name');
		$class_code = implode(', ', $class);
		$sec 		= $this->input->post('sec_name');
		$sec_code = implode(', ', $sec);
		$short_by 	= $this->input->post('short_by');
		$data['data'] = $this->dbcon->student_information_new($class_code,$sec_code,$short_by);
		$data['class'] = $class;
		$data['sec'] = $sec;
		$data['short_by'] = $sec;
		if(!empty($data['data'])){
			$this->load->view('student_report/studentdetailsshow',$data);
		}
		else{
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}
	
	public function download_studentinformation(){
		$class		= $this->input->post('class');
		$sec 		= $this->input->post('sec');
		$short_by 	= $this->input->post('short_by');
		$data['school_setting'] = $this->dbcon->select('school_setting','*');
		$data['data'] = $this->dbcon->student_information_new($class,$sec,$short_by);
		$this->load->view('student_report/studentinformationPdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Student_Information.pdf", array("Attachment"=>0));
	}
	
	//new function 22/06/2023

	public function studentlist()
	{
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);

		// $this->load->view('student_report/studentlist',$array);
		$this->fee_template('student_report/studentlist', $array);
	}

	public function find_detailsstudentlist()
	{
		$class		= $this->input->post('class_name');

		$sec 		= $this->input->post('sec_name');


		$data['data'] = $this->dbcon->student_list($class, $sec);

		//    echo $this->db->last_query();

		$data['class'] = $class;
		$data['sec'] = $sec;
		$data['short_by'] = $sec;
		if (!empty($data['data'])) {
			// $this->load->view('student_report/studentdetailsshow',$data);
			$this->load->view('student_report/studentlistshow', $data);
		} else {
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}

	public function download_studentlist()
	{
		$class		= $this->input->post('class');
		$sec 		= $this->input->post('sec');
		$short_by 	= $this->input->post('short_by');
		$data['school_setting'] = $this->dbcon->select('school_setting', '*');

		$data['data'] = $this->dbcon->student_list($class, $sec);
        
		$data['class']= $this->db->query('select class_nm from classes where Class_No='.$class)->result();
		$data['sec'] = $this->db->query('select section_name from sections where section_no='.$sec)->result();
		// $this->load->view('student_report/studentinformationPdf',$data);
		$this->load->view('student_report/studentlistPdf', $data);


		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Student_Subject_List.pdf", array("Attachment" => 0));
	}
	
	public function deleted_student_list()
	{
		$this->fee_template("student_report/deletedlist");
	}
	public function deleted_list()
	{
		$strt_dat = $this->input->post('strt_date');
		$end_dat = $this->input->post('end_date');
		$type = $this->input->post('type');

		if ($type == 'delete') {
			$data = $this->db->query('select * from deleted_student_details where del_date>="' . $strt_dat . '" and del_date<="' . $end_dat . '"')->result();
		} elseif ($type == 'recall') {
			$data = $this->db->query('select * from deleted_student_details where recall_date>="' . $strt_dat . '" and recall_date<="' . $end_dat . '"')->result();
		}
		// echo $this->db->last_query();die;

		// echo "<pre>";
		// print_r($data);
		// die;

		$array = array(
			'strt_dat'	=> $strt_dat,
			'end_dat'	=> $end_dat,
			'type'		=> $type,
			'stu_list'	=> $data
		);
		$this->load->view("student_report/deletedlist_report", $array);
	}
	public function download_deleted_studentlist(){
		$strt_dat = $this->input->post('strt_dat');
		$end_dat = $this->input->post('end_dat');
		$type = $this->input->post('type');


		if ($type == 'delete') {
			$data = $this->db->query('select * from deleted_student_details where del_date>="' . $strt_dat . '" and del_date<="' . $end_dat . '"')->result();
		} elseif ($type == 'recall') {
			$data = $this->db->query('select * from deleted_student_details where recall_date>="' . $strt_dat . '" and recall_date<="' . $end_dat . '"')->result();
		}
		// echo $this->db->last_query();die;

		// echo "<pre>";
		// print_r($data);
		// die;
		$school_setting = $this->dbcon->select('school_setting','*');

		$array = array(
			'school_setting' => $school_setting,
			'strt_dat'	=> $strt_dat,
			'end_dat'	=> $end_dat,
			'type'		=> $type,
			'stu_list'	=> $data
		);


		$this->load->view("student_report/deletedlist_report_pdf", $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'Portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Deleted_Student_list.pdf", array("Attachment" => 0));
	}
}