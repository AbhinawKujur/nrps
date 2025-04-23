<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scholarship_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function studentscholarshipinformation(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('student_report/scholarshipinformation',$array);
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
		$data['data'] = $this->dbcon->select('student','*',"SCHOLAR='1' AND CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$data['class'] = $class;
		$data['sec'] = $sec;
		$data['short_by'] = $short_by;
		if(!empty($data['data'])){
			$this->load->view('student_report/studentscholarshipdetailsshow',$data);
		}
		else{
			echo "<center><h1>Sorry No Student Found Availing Scholarship Facility</h1></center>";
		}
		
		
	}
	public function download_studentinformation(){
		$class		= $this->input->post('class');
		$sec 		= $this->input->post('sec');
		$short_by 	= $this->input->post('short_by');
		$data['school_setting'] = $this->dbcon->select('school_setting','*');
		$data['data'] = $this->dbcon->select('student','*',"SCHOLAR='1' AND CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$this->load->view('student_report/studentscholarshipPdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Scholarship_Information.pdf", array("Attachment"=>0));
	}
}