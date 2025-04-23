<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classsecwise extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
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
		$this->render_template('bulk_updation/classsecwise',$array);
	}
		public function match_password(){
		$pass = $this->input->post('pass');
		$pass_details = $this->dbcon->select('misc_password','password',"id='6' AND username='bulk-updation' AND password='$pass'");
		echo $cnt = count($pass_details);
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
		$data['data'] = $this->dbcon->select('student','*',"CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$data['category'] = $this->dbcon->select('category','*');
		$data['religion'] = $this->dbcon->select('religion','*');
		$data['classlist'] = $this->dbcon->select('classes','*');
		$data['seclist'] = $this->dbcon->select('sections','*');
		$data['subject'] = $this->dbcon->select('subjects','*');
		$data['class'] = $class;
		$data['sec'] = $sec;
		$data['short_by'] = $short_by;
		// echo "<pre>";
		// print_r($data);
		// die;
		if(!empty($data['data'])){
			$this->load->view('bulk_updation/classsecwisestudentdata',$data);
		}
		else{
			echo "<center><h1>Sorry No Student Found.</h1></center>";
		}
		
		
	}
	public function update_data(){
		$stdid = $this->input->post('adm');
		$col_name = $this->input->post('table_column');
		if($col_name == 'C_EMAIL'){
			$value = $this->input->post('value');
		}else{
			$value = strtoupper($this->input->post('value'));
		}
		$data = array($this->input->post('table_column') => $value );
		$this->dbcon->update('student',$data,"ADM_NO='$stdid'");
	}
	public function birth_data(){
		$stu_id = $this->input->post('val');
		$value = $this->input->post('value');
		$array = array(
			'BIRTH_DT' => $value
		);
		if($this->dbcon->update('student',$array,"ADM_NO='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
		
	}
	public function adm_noupdate(){
		$stu_id = $this->input->post('finid');
		$value = $this->input->post('value1');
		$array = array(
			'ADM_DATE' => $value
		);
		if($this->dbcon->update('student',$array,"ADM_NO='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changegender(){
		$stu_id = $this->input->post('finidd');
		$value = $this->input->post('gender_value');
		$array = array(
			'SEX' => $value
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changecategory(){
		$stu_id = $this->input->post('finiddd');
		$value = $this->input->post('category_value');
		$array = array(
			'CATEGORY' => $value
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changereligion(){
		$stu_id = $this->input->post('finiddd1');
		$value = $this->input->post('religion_value');
		$array = array(
			'religion' => $value
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changesection(){
		$stu_id = $this->input->post('finidd');
		$value = $this->input->post('sec_value');
		$sql=$this->dbcon->select("sections","SECTION_NAME","section_no=$value");
		$disp_sec=$sql[0]->SECTION_NAME;

		$array = array(
			'sec' => $value,
			'disp_sec'	=>$disp_sec
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changesubject1(){
		$stu_id = $this->input->post('finidd');
		$value = $this->input->post('sub_value');
		$sql=$this->dbcon->select("subjects","SubName","SubCode=$value");
		$subject_nm=$sql[0]->SubName;

		$array = array(
			'SUBJECT1'	=>$subject_nm
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changesubject2(){
		$stu_id = $this->input->post('finidd');
		$value = $this->input->post('sub_value');
		$sql=$this->dbcon->select("subjects","SubName","SubCode=$value");
		$subject_nm=$sql[0]->SubName;

		$array = array(
			'SUBJECT2'	=>$subject_nm
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changesubject3(){
		$stu_id = $this->input->post('finidd');
		$value = $this->input->post('sub_value');
		$sql=$this->dbcon->select("subjects","SubName","SubCode=$value");
		$subject_nm=$sql[0]->SubName;

		$array = array(
			'SUBJECT3'	=>$subject_nm
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changesubject4(){
		$stu_id = $this->input->post('finidd');
		$value = $this->input->post('sub_value');
		$sql=$this->dbcon->select("subjects","SubName","SubCode=$value");
		$subject_nm=$sql[0]->SubName;

		$array = array(
			'SUBJECT4'	=>$subject_nm
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changesubject5(){
		$stu_id = $this->input->post('finidd');
		$value = $this->input->post('sub_value');
		$sql=$this->dbcon->select("subjects","SubName","SubCode=$value");
		$subject_nm=$sql[0]->SubName;

		$array = array(
			'SUBJECT5'	=>$subject_nm
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
	public function changesubject6(){
		$stu_id = $this->input->post('finidd');
		$value = $this->input->post('sub_value');
		$sql=$this->dbcon->select("subjects","SubName","SubCode=$value");
		$subject_nm=$sql[0]->SubName;

		$array = array(
			'SUBJECT6'	=>$subject_nm
		);
		if($this->dbcon->update('student',$array,"STUDENTID='$stu_id'"))
		{
			echo 1;
		}else{
			echo 2;
		}
	}
}