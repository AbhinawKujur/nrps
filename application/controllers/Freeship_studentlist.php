<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freeship_studentlist extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('student_report/freeshipinformation',$array);
	}
	public function find_sec(){
		$val = $this->input->post('val');
		if($val != 'All'){
			$data = $this->dbcon->select_distinct('student','DISP_SEC,SEC',"CLASS='$val' AND Student_Status='ACTIVE'");
		}
		?>
		  <option value=''>Select Section</option>
		<?php
		if($val == 'All'){
		?>
		  <option value='All'>All Section</option>
		<?php
		}else{		
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
			<?php
		}
		}
	}
	public function find_detailsstudentinformation(){
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		//$freeship_type = $this->input->post('freeship_type');
		$short_by 	= $this->input->post('short_by');
		if($class == 'All'){
					$data['data'] = $this->dbcon->select('student','*',"FREESHIP='1' AND Student_Status='ACTIVE' ORDER BY $short_by");
		}else{
			$data['data'] = $this->dbcon->select('student','*',"FREESHIP='1' AND CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		}
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
		$data['class'] = $class	= $this->input->post('class');
		$data['sec'] = $sec = $this->input->post('sec');
		$short_by 	= $this->input->post('short_by');
		$data['school_setting'] = $this->dbcon->select('school_setting','*');
		
		if($class == 'All'){
					$data['data'] = $this->dbcon->select('student','*',"FREESHIP='1' AND Student_Status='ACTIVE' ORDER BY $short_by");
		}else{
			$data['data'] = $this->dbcon->select('student','*',"FREESHIP='1' AND CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		}
		
		$this->load->view('student_report/studentfreeshipPdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Freeship_Information.pdf", array("Attachment"=>0));
	}
}