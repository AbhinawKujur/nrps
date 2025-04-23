<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fees_master extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	
	public function class_master(){
		$data = $this->dbcon->select('classes','*');
		$array = array('data'=>$data);
		$this->fee_template('fees_master/class_master',$array);
	}
	
	public function add_class(){
		$data = $this->dbcon->select('classes','*');
		$this->fee_template('fees_master/add_class');
	}
	
	public function class_save(){
		$clasess = strtoupper($this->input->post('class_name'));
		$data = $this->dbcon->max_no('classes','Class_No');
		$max_no = $data[0]->Class_No + 1;
		
		for($i=1;$i<=25;$i++){
			$data = $this->dbcon->select('fee_clw','*',"CL='$max_no' AND FH='$i'");
			$data_cnt = count($data);
			if($data_cnt == 1){
				
			}else{
				$fee_clw = array(
					'CL' => $max_no,
					'FH' => $i,
					'AMOUNT' => 0,
					'EMP' => 0,
					'CCL' => 0,
					'SPL' => 0,
					'EXT' => 0,
					'INTERNAL' => 0
				);
				$this->dbcon->insert('fee_clw',$fee_clw);
			}
		}
			$stu_data = $this->dbcon->select('student_attendance_type','*',"class_code='$max_no' AND class_nm='$clasess'");
			$stu_data_cnt = count($stu_data);
			if($stu_data_cnt == 1){
				
			}else{
				$stu_data_type = array(
					'class_code' => $max_no,
					'class_nm' => $clasess,
					'attendance_type' => 1
				);
				$this->dbcon->insert('student_attendance_type',$stu_data_type);
			}
		
		$data = array(
		 'Class_No' => $max_no,
		 'CLASS_NM' => $clasess
		);
		
		$this->dbcon->insert('classes',$data);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Fees_master/class_master');
	}
	
	public function edit_class($id){
		$data = $this->dbcon->select('classes','*',"Class_No='$id'");
		$array = array('data'=>$data);
		$this->fee_template('fees_master/edit_class',$array);
	}
	
	public function class_update(){
		$upd_id = $this->input->post('upd_id');
		$classes = strtoupper($this->input->post('class_name'));
		$stu_data = array(
			'class_nm' => $classes
		);
		
		$data = array(
		 'CLASS_NM' => $classes
		);
		if($this->dbcon->update('student_attendance_type',$stu_data,"class_code='$upd_id'") && $this->dbcon->update('classes',$data,"Class_No='$upd_id'")){
			$this->session->set_flashdata('msg',"Successfully Updated");
			redirect('Fees_master/class_master');
		}
		else{
			$this->session->set_flashdata('msg',"Failed Updated");
			redirect('Fees_master/class_master');
		}
		
		
	}
	public function section_master(){
		$data = $this->dbcon->select('sections','*');
		$array = array('data'=>$data);
		$this->fee_template('fees_master/section_master',$array);
	}
	public function add_section(){
		$this->fee_template('fees_master/add_section');
	}
	public function section_save(){
		$data = $this->dbcon->max_no('sections','section_no');
		$max_no = $data[0]->section_no + 1;
		
		$data = array(
		 'section_no' => $max_no,
		 'SECTION_NAME' => strtoupper($this->input->post('section_name'))
		);

		$this->dbcon->insert('sections',$data);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Fees_master/section_master');
	}
	public function edit_section($id){
		$data = $this->dbcon->select('sections','*',"section_no='$id'");
		$array = array('data'=>$data);
		$this->fee_template('fees_master/edit_section',$array);
	}
	public function section_update(){
		$upd_id = $this->input->post('upd_id');

		$data = array(
		 'SECTION_NAME' => strtoupper($this->input->post('section_name'))
		);	
		$this->dbcon->update('sections',$data,"section_no='$upd_id'");
		$this->session->set_flashdata('msg',"Successfully Updated");
		redirect('Fees_master/section_master');
	}
	public function ward_master(){
		$data = $this->dbcon->select('eward','*');
		$array = array('data'=>$data);
		$this->fee_template('fees_master/ward_master',$array);
	}
	public function add_ward(){
		$this->fee_template('fees_master/add_ward');
	}
	public function ward_save(){
		$data = $this->dbcon->max_no('eward','HOUSENO');
		$max_no = $data[0]->HOUSENO + 1;

		$data = array(
		 'HOUSENO' => $max_no,
		 'HOUSENAME' => strtoupper($this->input->post('ward_name'))
		);
		$this->dbcon->insert('eward',$data);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Fees_master/ward_master');
	}
	public function edit_ward($id){
		$data = $this->dbcon->select('eward','*',"HOUSENO='$id'");
		$array = array('data'=>$data);
		$this->fee_template('fees_master/edit_ward',$array);
	}
	public function ward_update(){
		$update = $this->input->post('upd_id');
		$data = array(
		 'HOUSENAME' => strtoupper($this->input->post('housename'))
		);
		$this->dbcon->update('eward',$data,"HOUSENO='$update'");
		$this->session->set_flashdata('msg',"Successfully Updated");
		redirect('Fees_master/ward_master');
	}
	public function religion_master(){
		$data = $this->dbcon->select('religion','*');
		$array = array('data'=>$data);
		$this->fee_template('fees_master/religion_master',$array);
		
	}
	public function edit_religion($id){
		$data = $this->dbcon->select('religion','*',"RNo='$id'");
		$array = array('data' =>$data);
		$this->fee_template('fees_master/edit_religion',$array);
	}
	public function religion_update(){
		$id=$this->input->post('upd_id');
		$data = array(
			'Rname' => strtoupper($this->input->post('Religion'))
		);
		$this->dbcon->update('religion',$data,"RNo='$id'");
		$this->session->set_flashdata('msg',"Successfully update");
		redirect('Fees_master/religion_master');
	}
	public function add_religion(){
		$this->fee_template('fees_master/add_religion');
	}
	public function religion_save(){
		$data = $this->dbcon->max_no('religion','RNo');
		$max_no = $data[0]->RNo + 1;
		$data = array(
		 'RNo' => $max_no,
		 'Rname' => strtoupper($this->input->post('religionname'))
		);
		$this->dbcon->insert('religion',$data);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Fees_master/religion_master');
	}

	public function house_master(){
		$data = $this->dbcon->select('house','*');
		$array = array('data'=>$data);
		$this->fee_template('fees_master/house_master',$array);
	}
	public function add_house(){
		$this->fee_template('fees_master/add_house');
	}
	public function house_save(){
		$data = $this->dbcon->max_no('house','HOUSENO');
		$max_no = $data[0]->HOUSENO + 1;
		$data = array(
		 'HOUSENO' => $max_no,
		 'HOUSENAME' => strtoupper($this->input->post('housename'))
		);
		$this->dbcon->insert('house',$data);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Fees_master/house_master');
	}
	public function edit_house($id){
		$data = $this->dbcon->select('house','*',"HOUSENO='$id'");
		$array = array('data' =>$data);
		$this->fee_template('fees_master/edit_house',$array);

	}
	public function house_update(){
		$id =  $this->input->post('upd_id');
		$data = array(
			'HOUSENAME' => strtoupper($this->input->post('house'))
		);
		$this->dbcon->update('house',$data,"HOUSENO='$id'");
		$this->session->set_flashdata('msg',"Successfully update");
		redirect('Fees_master/house_master');

	}
	public function Category_master(){
		$data = $this->dbcon->select('category','*');
		$array = array('data'=>$data);
		$this->fee_template('fees_master/category_master',$array);
	}
	public function add_category(){
		$this->fee_template('fees_master/add_category');
	}
	public function category_save(){
		$data = $this->dbcon->max_no('category','CAT_CODE');
		$max_no=$data[0]->CAT_CODE+1;
		$value=strtoupper($this->input->post('category'));
		$data = array('CAT_CODE' =>$max_no,'CAT_ABBR'=>$value,'CAT_DESC'=>$value );
		$this->dbcon->insert('category',$data);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Fees_master/Category_master');
	}
	public function edit_category($id){
		$data = $this->dbcon->select('category','*',"CAT_CODE='$id'");
		$array = array('data' =>$data);
		$this->fee_template('fees_master/edit_category',$array);

	}
	public function category_update(){
		$id = $this->input->post('upd_id');
		$value = strtoupper($this->input->post('category'));
		$data = array(
			'CAT_CODE' => $id,
			'CAT_ABBR' => $value,
			'CAT_DESC' => $value
		);
		$this->dbcon->update('category',$data,"CAT_CODE='$id'");
		$this->session->set_flashdata('msg',"Successfully update");
		redirect('Fees_master/category_master');
	}
	public function fee_head_master(){
		$this->fee_template('fees_master/feehead_password');
	}
	public function fees_head_password(){
		$password = $this->input->post("password");
		$data_pass = $this->dbcon->select('misc_password','password',"password='$password'");
		$cnt = count($data_pass);
		echo $cnt;
	}
	public function fees_head(){
	$fee_head1 = $this->dbcon->select('feehead','*',"ACT_CODE='1'");
  	$fee_head2 = $this->dbcon->select('feehead','*',"ACT_CODE='2'");
  	$fee_head3 = $this->dbcon->select('feehead','*',"ACT_CODE='3'");
  	$fee_head4 = $this->dbcon->select('feehead','*',"ACT_CODE='4'");
  	$fee_head5 = $this->dbcon->select('feehead','*',"ACT_CODE='5'");
  	$fee_head6 = $this->dbcon->select('feehead','*',"ACT_CODE='6'");
  	$fee_head7 = $this->dbcon->select('feehead','*',"ACT_CODE='7'");
  	$fee_head8 = $this->dbcon->select('feehead','*',"ACT_CODE='8'");
  	$fee_head9 = $this->dbcon->select('feehead','*',"ACT_CODE='9'");
  	$fee_head10 = $this->dbcon->select('feehead','*',"ACT_CODE='10'");
  	$fee_head11 = $this->dbcon->select('feehead','*',"ACT_CODE='11'");
  	$fee_head12 = $this->dbcon->select('feehead','*',"ACT_CODE='12'");
  	$fee_head13 = $this->dbcon->select('feehead','*',"ACT_CODE='13'");
  	$fee_head14 = $this->dbcon->select('feehead','*',"ACT_CODE='14'");
  	$fee_head15 = $this->dbcon->select('feehead','*',"ACT_CODE='15'");
  	$fee_head16 = $this->dbcon->select('feehead','*',"ACT_CODE='16'");
  	$fee_head17 = $this->dbcon->select('feehead','*',"ACT_CODE='17'");
  	$fee_head18 = $this->dbcon->select('feehead','*',"ACT_CODE='18'");
  	$fee_head19 = $this->dbcon->select('feehead','*',"ACT_CODE='19'");
  	$fee_head20 = $this->dbcon->select('feehead','*',"ACT_CODE='20'");
  	$fee_head21 = $this->dbcon->select('feehead','*',"ACT_CODE='21'");
  	$fee_head22 = $this->dbcon->select('feehead','*',"ACT_CODE='22'");
  	$fee_head23 = $this->dbcon->select('feehead','*',"ACT_CODE='23'");
  	$fee_head24 = $this->dbcon->select('feehead','*',"ACT_CODE='24'");
  	$fee_head25 = $this->dbcon->select('feehead','*',"ACT_CODE='25'");
  	$scholarship = array(
  		'fee_head1' => $fee_head1,
  		'fee_head2' => $fee_head2,
  		'fee_head3' => $fee_head3,
  		'fee_head4' => $fee_head4,
  		'fee_head5' => $fee_head5,
  		'fee_head6' => $fee_head6,
  		'fee_head7' => $fee_head7,
  		'fee_head8' => $fee_head8,
  		'fee_head9' => $fee_head9,
  		'fee_head10' => $fee_head10,
  		'fee_head11' => $fee_head11,
  		'fee_head12' => $fee_head12,
  		'fee_head13' => $fee_head13,
  		'fee_head14' => $fee_head14,
  		'fee_head15' => $fee_head15,
  		'fee_head16' => $fee_head16,
  		'fee_head17' => $fee_head17,
  		'fee_head18' => $fee_head18,
  		'fee_head19' => $fee_head19,
  		'fee_head20' => $fee_head20,
  		'fee_head21' => $fee_head21,
  		'fee_head22' => $fee_head22,
  		'fee_head23' => $fee_head23,
  		'fee_head24' => $fee_head24,
  		'fee_head25' => $fee_head25
  	);
		$this->fee_template('fees_master/feehead',$scholarship);
	}
	public function fee_one()
	{
		$id = $this->input->post("id");
		$feehead = $this->dbcon->select('feehead','*',"ACT_CODE='$id'");
		$ward = $this->dbcon->select('eward','*');
		$ward1 = $this->dbcon->select('eward','HOUSENAME',"HOUSENO='1'");
		$ward2 = $this->dbcon->select('eward','HOUSENAME',"HOUSENO='2'");
		$ward3 = $this->dbcon->select('eward','HOUSENAME',"HOUSENO='3'");
		$ward4 = $this->dbcon->select('eward','HOUSENAME',"HOUSENO='4'");
		$ward5 = $this->dbcon->select('eward','HOUSENAME',"HOUSENO='5'");
		$ward6 = $this->dbcon->select('eward','HOUSENAME',"HOUSENO='6'");
		$accg = $this->dbcon->select('accg','*');
		$feeclw = $this->dbcon->feeclw($id);
		$head_type = $this->dbcon->select('head_type','*');
		$array = array(
			'feehead' =>$feehead,
			'ward'=>$ward,
			'feeclw' => $feeclw,
			'accg' => $accg,
			'head_type' => $head_type,
			'ward1' => $ward1,
			'ward2' => $ward2,
			'ward3' => $ward3,
			'ward4' => $ward4,
			'ward5' => $ward5,
			'ward6' => $ward6
		);
		$this->load->view('fees_master/h',$array);
	}

	public function select()
	{
		$id = $this->input->post('id');
		$feehead = $this->dbcon->select('feehead','*',"ACT_CODE='$id'");
	}

	public function load_feeclw()
	{
		$id = $this->input->post('id');
		$feeclw = $this->dbcon->feeclw($id);
		echo json_encode($feeclw);

	}

	public function table_update()
	{
		$cl = $this->input->post('cl');
		$fh = $this->input->post('fh');
		$value = $this->input->post('value');
		$data = array($this->input->post('table_column') => $value );
		$this->dbcon->update('fee_clw',$data,"CL='$cl' AND FH='$fh'");
	}

	public function save_data()
	{
		$act_code = $this->input->post('act_code');
		$data = array(
			'FEE_HEAD' => strtoupper($this->input->post('fhn')),
			'MONTHLY' => $this->input->post('mb'),
			'CL_BASED' => $this->input->post('cb'),
			'AMOUNT' => $this->input->post('ward1'),
			'SHNAME' => strtoupper($this->input->post('sn')),
			'EMP' => $this->input->post('ward2'),
			'CCL' => $this->input->post('ward3'),
			'SPL' => $this->input->post('ward4'),
			'EXT' => $this->input->post('ward5'),
			'INTERNAL' => $this->input->post('ward6'),
			'AccG' => $this->input->post('account_type'),
			'HType' => $this->input->post('ht'),
			'APR' =>$this->input->post('apr'),
			'may' =>$this->input->post('may'),
			'JUN' =>$this->input->post('jun'),
			'JUL' =>$this->input->post('jul'),
			'AUG' =>$this->input->post('aug'),
			'SEP' =>$this->input->post('sep'),
			'OCT' =>$this->input->post('oct'),
			'NOV' =>$this->input->post('nov'),
			'DECM'=>$this->input->post('dec'),
			'JAN' =>$this->input->post('jan'),
			'FEB' =>$this->input->post('feb'),
			'MAR' =>$this->input->post('mar'),
		);
		if($this->dbcon->update('feehead',$data,"ACT_CODE='$act_code'"))
		{
			echo 1;
		}
		else
		{
			
		}
	}

	public function fee_generation()
	{
		$data = $this->dbcon->select('student','*');
		$feehead1 = $this->dbcon->select('feehead','*',"ACT_CODE='1'");
		$count = count($data);
		$month ='APR';
		for($i=0;$i<$count;$i++)
		{
			$array = array(
				'stdid' => $data[$i]->STUDENTID,
				'Month' => $month
			);
			echo "<pre>";
			print_r($array);
		}
		/* echo $count; */
		/* for($x = 0; $x < $count; $x++)
		{
			echo "<br>";
			echo $id = $data[$x]->STUDENTID;
			echo "<br>";
			echo $ward = $data[$x]->EMP_WARD;
			echo "<br>";
			echo $class = $data[$x]->CLASS;
        } */
	}
	public function Bus_Stoppage_Master(){
		$data = $this->dbcon->bus_master_show();
		$array = array('data'=>$data);
		// echo "<pre>";
		// print_r($array);
		// exit;
		$this->fee_template('fees_master/bus_stoppage_master',$array);
	}
	public function add_buss(){
		$data['busnomaster'] = $this->dbcon->select('busnomaster','*');
		$data['stopage_name'] = $this->dbcon->select('stoppage','*');
		$this->fee_template('fees_master/add_busmaster',$data);
	}
	public function add_Stoppage_Master(){
		$stoppage_name = strtoupper($this->input->post('browser'));
		$apr = $this->input->post('apr');
		$may = $this->input->post('may');
		$jun = $this->input->post('jun');
		$jul = $this->input->post('jul');
		$aug = $this->input->post('aug');
		$sep = $this->input->post('sep');
		$oct = $this->input->post('oct');
		$nov = $this->input->post('nov');
		$dec = $this->input->post('dec');
		$jan = $this->input->post('jan');
		$feb = $this->input->post('feb');
		$mar = $this->input->post('mar');
		$data_match = $this->dbcon->select('stoppage','STOPPAGE',"STOPPAGE='$stoppage_name'");
		$fin_name = $data_match[0]->STOPPAGE;
		if($fin_name == $stoppage_name){
			$this->session->set_flashdata('msg',"This Stoppage Name Is Already Exist");
			redirect('Fees_master/add_buss');
		}else{
			$data1 = $this->dbcon->max_no('stoppage','STOPNO');
			$max_no = $data1[0]->STOPNO + 1;
			$stpg = array(
				'STOPPAGE' => $stoppage_name,
				'STOPNO' => $max_no,
			);
			$stp_amt = array(
				'STOP_NO' => $max_no,
				'AMT'	  => $apr,
				'APR_FEE' => $apr,
				'MAY_FEE' => $may,
				'JUN_FEE' => $jun,
				'JUL_FEE' => $jul,
				'AUG_FEE' => $aug,
				'SEP_FEE' => $sep,
				'OCT_FEE' => $oct,
				'NOV_FEE' => $nov,
				'DEC_FEE' => $dec,
				'JAN_FEE' => $jan,
				'FEB_FEE' => $feb,
				'MAR_FEE' => $mar,
			);
			$this->dbcon->insert('stop_amt',$stp_amt);
			$this->dbcon->insert('stoppage',$stpg);
			$this->session->set_flashdata('msg',"Successfully Added");
			redirect('Fees_master/Bus_Stoppage_Master');
		}
	}
	public function edit_busmaster($id){
		$data = $this->dbcon->edit_busmaster($id);
		$bus_no = $this->dbcon->select('busnomaster','*');
		$array = array(
			'data' => $data,
			'bus_no' => $bus_no
		);
		// echo "<pre>";
		// print_r($array);
		// exit;
		$this->fee_template('fees_master/edit_busmaster',$array);
	}
	public function busmaster_update(){
		$stopno    = $this->input->post('id');
		$Apr    = $this->input->post('Apr');
		$May    = $this->input->post('May');
		$Jun    = $this->input->post('Jun');
		$Jul    = $this->input->post('Jul');
		$Aug    = $this->input->post('Aug');
		$Sep    = $this->input->post('Sep');
		$Oct    = $this->input->post('Oct');
		$Nov    = $this->input->post('Nov');
		$Dec    = $this->input->post('Dec');
		$Jan    = $this->input->post('Jan');
		$Feb    = $this->input->post('Feb');
		$Mar    = $this->input->post('Mar');
		$frm_date  = $this->input->post('frm_date');
		$stop_name = $this->input->post('stop_name');
		
		$stop_amt = array(
			'APR_FEE' => $Apr,
			'MAY_FEE' => $May,
			'JUN_FEE' => $Jun,
			'JUL_FEE' => $Jul,
			'AUG_FEE' => $Aug,
			'SEP_FEE' => $Sep,
			'OCT_FEE' => $Oct,
			'NOV_FEE' => $Nov,
			'DEC_FEE' => $Dec,
			'JAN_FEE' => $Jan,
			'FEB_FEE' => $Feb,
			'MAR_FEE' => $Mar
		);
		
		$stoppage = array(
			'STOPPAGE' => $stop_name
		);
		$this->dbcon->update('stop_amt',$stop_amt,"STOP_NO='$stopno'");
		$this->dbcon->update('stoppage',$stoppage,"STOPNO='$stopno'");
		$this->session->set_flashdata('msg',"Successfully update");
		redirect('Fees_master/Bus_Stoppage_Master');
		
	}
}