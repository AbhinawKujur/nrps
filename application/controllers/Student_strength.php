<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_strength extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
	}
	
	public function show_strenght_religion()
	{
		$religion = $this->dbcon->select('religion', '*');
		$class = $this->dbcon->select('classes', '*');
		$section = $this->dbcon->select('sections', '*');

		$array = array(
			'religion' => $religion,
			'class' => $class,
			'section'	=> $section
		);
		$this->render_template('class_report/show_strenght_religion', $array);
	}

	
	
	
	public function show_strenght()
	{
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('class_report/student_strength', $array);
	}

	
	
	public function class_wise_pdf()
	{
		$rel = $this->dbcon->select('religion', '*');
		$cat = $this->dbcon->select('category', '*');
		$wardd = $this->dbcon->select('eward', '*');
		$school_setting = $this->dbcon->select('school_setting', '*');
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		
		if ($class == 'ALL' && $sec == 'SWise'){
			$all_data = $this->dbcon->all_strength();
		}elseif($class == 'ALL' && $sec == 'ALL'){
			$all_data = $this->dbcon->classwise_strength_all();
		}else{
			$all_data = $this->dbcon->classwise_strength($class,$sec);
		}
		
		$array = array(
			'school_setting' => $school_setting,
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd,
			'all_data'		=> $all_data,
			'class'			=> $class,
			'sec'			=> $sec
		);
		$this->load->view('class_report/class_wise_strength_pdf', $array);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("student_Strength.pdf", array("Attachment" => 0));
	}
	
	public function student_strenghth_class()
	{
		$rel = $this->dbcon->select('religion', '*');
		$cat = $this->dbcon->select('category', '*');
		$wardd = $this->dbcon->select('eward', '*');
		
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		
		if ($class == 'ALL' && $sec == 'SWise'){
			$all_data = $this->dbcon->all_strength();
		}elseif($class == 'ALL' && $sec == 'ALL'){
			$all_data = $this->dbcon->classwise_strength_all();
		}else{
			$all_data = $this->dbcon->classwise_strength($class,$sec);
		}
		
		$array = array(
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd,
			'all_data'		=> $all_data,
			'class'			=> $class,
			'sec'			=> $sec
			
		);
		$this->load->view('class_report/class_wise_strength', $array);
	}
	public function student_strenghth_all()
	{
		clearstatcache();
		$religion = $this->input->post('religion');
		$category = $this->input->post('category');
		$ward = $this->input->post('ward');
		$rel = $this->dbcon->select('religion', '*');
		$cat = $this->dbcon->select('category', '*');
		$wardd = $this->dbcon->select('eward', '*');
		$all_data = $this->dbcon->all_strength();

		$array = array(
			'all_data'		=> $all_data,
			'religion' 		=> $religion,
			'category'	 	=> $category,
			'ward' 			=> $ward,
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd
		);
		// echo "<pre>";
		// print_r($array);
		// exit;
		$this->load->view('class_report/all_class_wise_strength', $array);
	}
	public function all_class_wise_pdf()
	{
		clearstatcache();
		$rel = $this->dbcon->select('religion', '*');
		$cat = $this->dbcon->select('category', '*');
		$wardd = $this->dbcon->select('eward', '*');
		$school_setting = $this->dbcon->select('school_setting', '*');
		$all_data = $this->dbcon->all_strength();

		$array = array(
			'all_data'		=> $all_data,
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd,
			'school_setting' => $school_setting
		);
		$this->load->view('class_report/all_class_wise_strength_pdf', $array);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Head_Wise_Summary_Report.pdf", array("Attachment" => 0));
	}
}
