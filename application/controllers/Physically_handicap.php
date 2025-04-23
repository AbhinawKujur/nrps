<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Physically_handicap extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$data['data'] = $this->dbcon->select('student','*',"math_lab='1' AND Student_Status='ACTIVE' ORDER BY CLASS");
		if(!empty($data['data'])){
			$this->fee_template('student_report/handicapinformation',$data);
		}
		else{
			echo "<center><h1>Sorry No Student Found</h1></center>";
		}
		
		
	}
	public function find_sec(){
		$val = $this->input->post('val');
		$data = $this->dbcon->select_distinct('student','DISP_SEC,SEC',"CLASS='$val' AND Student_Status='ACTIVE'");
		?>
		  <option value=''>Select Section</option>
		<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
			<?php
		}
	}
	public function find_detailsstudentinformation(){
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		$short_by 	= $this->input->post('short_by');
		$data['data'] = $this->dbcon->select('student','*',"FREESHIP='1' AND CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$data['class'] = $class;
		$data['sec'] = $sec;
		$data['short_by'] = $short_by;
		if(!empty($data['data'])){
			$this->load->view('student_report/studentfeeshipdetailsshow',$data);
		}
		else{
			echo "<center><h1>Sorry No Student Found Availing Freeship Facility</h1></center>";
		}
		
		
	}
	public function download_studentinformation(){
		$class		= $this->input->post('class');
		$sec 		= $this->input->post('sec');
		$short_by 	= $this->input->post('short_by');
		$data['school_setting'] = $this->dbcon->select('school_setting','*');
		$data['data'] = $this->dbcon->select('student','*',"FREESHIP='1' AND CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$this->load->view('student_report/studentfreeshipPdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Freeship_Information.pdf", array("Attachment"=>0));
	}
}