<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_transport extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		error_reporting(0);
 	    $this->load->model('Mymodel','dbcon');
	    $this->load->model('Common_fun','comm');
	    $this->load->model('student_transport/student_transport_model','stm');
	} 
	public function index(){
		$this->fee_template('student_transport/bus_transport_view');
	}
	public function show_student(){

		

		$data['adm_no']=$adm_no=rawurldecode($this->input->post('adm_no'));
		
		$data['trans_report']=$this->dbcon->select('student_transport_facility','*',"ADM_NO='$adm_no' order by ID");
		
		if(empty($data['trans_report']))
		{
			// $this->session->set_flashdata('error', 'Student is not availing transport facility, Want to Add then proceed.');
        	 redirect('student_transport/Bus_transport/allocate_bus_stoppage/'.urlencode(base64_encode($adm_no)),refresh);

		}
		$data['student_details']=$student_details=$this->dbcon->select('student','*',"ADM_NO='$adm_no'");

		$data['FIRST_NM']=$student_details[0]->FIRST_NM;
		$data['DISP_CLASS']=$student_details[0]->DISP_CLASS;
		$data['DISP_SEC']=$student_details[0]->DISP_SEC;

		$data['APR_FEE']=$student_details[0]->APR_FEE;
		$data['MAY_FEE']=$student_details[0]->MAY_FEE;
		$data['JUN_FEE']=$student_details[0]->JUNE_FEE;
		$data['JUL_FEE']=$student_details[0]->JULY_FEE;
		$data['AUG_FEE']=$student_details[0]->AUG_FEE;
		$data['SEP_FEE']=$student_details[0]->SEP_FEE;
		$data['OCT_FEE']=$student_details[0]->OCT_FEE;
		$data['NOV_FEE']=$student_details[0]->NOV_FEE;
		$data['DEC_FEE']=$student_details[0]->DEC_FEE;
		$data['JAN_FEE']=$student_details[0]->JAN_FEE;
		$data['FEB_FEE']=$student_details[0]->FEB_FEE;
		$data['MAR_FEE']=$student_details[0]->MAR_FEE;

		$data['stoppage']=$this->dbcon->select('stoppage','*'," 1='1'order by STOPPAGE");
		
	$monthNum = date("m");
	$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
	$data['CURR_MON']=substr(strtoupper($monthName), 0, 3);

	$pre_row=$this->stm->stu_first_bus_stoppage_row($adm_no);
	$data['pre_rowid']=$pre_row[0]->ID;

	$data['month_master']=$this->dbcon->select('month_master','*');
	
			

		$this->fee_template('student_transport/bus_transport_view',$data);
	}

	public function allocate_stopage()
	{
		$adm_no=$this->input->post('adm_no');
		$MON=$this->input->post('mon_list');
		$NEW_STOPNO=$this->input->post('selstoppage');

		if($MON=="none"){
			$this->session->set_flashdata('error', 'Please Select Month');
        	 redirect('student_transport/Bus_transport',refresh);
		}
		if($NEW_STOPNO=="none"){
			$this->session->set_flashdata('error', 'Please Select Stoppage');
        	 redirect('student_transport/Bus_transport',refresh);
		}

// to find current stoppage
		$trans_report=$this->dbcon->select('student_transport_facility','*',"ADM_NO='$adm_no' order by ID");
		foreach($trans_report as $p){
			$old_stop=$p->NEW_STOPNO;
		}
		$cnt=count($trans_report);

for($i=0;$i<$cnt;$i++){
	$rowID=$trans_report[$i]->ID;
	$rowFAM[$i] =$trans_report[$i]->FROM_APPLICABLE_MONTH;
	$rowTAM[$i]= $trans_report[$i]->TO_APPLICABLE_MONTH;
	if(!empty($trans_report[$i+1]->FROM_APPLICABLE_MONTH)){
	 $mfam = date('m',strtotime($trans_report[$i+1]->FROM_APPLICABLE_MONTH));
	 $mfam_new = date("F", mktime(0, 0, 0, $mfam-1, 10));

	 if($mfam_new=="March" || $mfam_new=="MARCH"){
	 	$mfam_new = date("F", mktime(0, 0, 0, $mfam, 10));
	 }
	 
	 $monthNameNew1=substr(strtoupper($mfam_new), 0, 3);

	 $pmonth_code=$this->stm->get_month_calender((int)$mfam-1);
	 
	 if($pmonth_code[0]->id=="12"){
	 	
	 	$pmonth_code=$this->stm->get_month_calender($mfam);
	 }
	 
	 $mon_code_new=$pmonth_code[0]->id;
	 
	 

 $this->stm->update_transport_table($monthNameNew1,$mon_code_new,$adm_no,$rowID);
 
	}
}



	

	 //$monthNum = date("m");
	 $monthNum=$MON;
	 $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));


	$getmaxno = $this->dbcon->max_no('student_transport_facility','ID');
	$max_no = $getmaxno[0]->ID + 1;

	//Previous Month Name
	//$monthNum = date("m");
	$monthNum=$MON;
	$monthName_pre = date("F", mktime(0, 0, 0, $monthNum-1, 10));

if($monthName_pre=="March" || $monthName_pre=="MARCH"){
	 	$monthName_pre = date("F", mktime(0, 0, 0, $monthNum, 10));
	 }
	 

	$mname_pre=substr(strtoupper($monthName_pre), 0, 3);

	$pre_row=$this->stm->stu_last_bus_stoppage($adm_no);
	$pre_rowid=$pre_row[0]->ID;


	//substr(strtoupper($monthName), 0, 3);
	$pmonth_code=$this->stm->get_month_calender($monthNum-1);

	 $mon_code_new=$pmonth_code[0]->id;

if($mon_code_new=="12"){
	 	
	 	$pmonth_code=$this->stm->get_month_calender($monthNum);
	 	$mon_code_new=$pmonth_code[0]->id;
	 }

	 $cmonth_code=$this->stm->get_month_calender($MON);
	 
	 $mon_code_curr=$cmonth_code[0]->id;

		$flag=0;
		$data['ID']=$max_no;
		$data['ADM_NO']=$adm_no;
		$data['OLD_STOPNO']=$old_stop;
		$data['NEW_STOPNO']=$NEW_STOPNO;
		$data['FROM_APPLICABLE_MONTH']=substr(strtoupper($monthName), 0, 3);
		$data['TO_APPLICABLE_MONTH']='MAR';
		$data['FROM_APPLICABLE_MONTH_CODE']=$mon_code_curr;
		$data['TO_APPLICABLE_MONTH_CODE']='12';
		$data['CREATED_DATE']=date('Y-m-d');
		$data['USER_ID']=$this->session->userdata('user_id');
// for student table
		$update_array = array(
			'stopno' => $NEW_STOPNO,
			'student_transport_facility_id'=>$max_no
		);
// for student_transport_facility	TO_APPLICABLE_MONTH field previous one	
		$update_array_pre = array(
			'TO_APPLICABLE_MONTH' => $mname_pre,
			'TO_APPLICABLE_MONTH_CODE' => $mon_code_new
		);

			$this->db->trans_start();
			$this->dbcon->insert('student_transport_facility',$data);
			
			$this->dbcon->update('student',$update_array,"ADM_NO='$adm_no'");
			
			$this->dbcon->update('student_transport_facility',$update_array_pre,"ID='$pre_rowid'");
			
			$this->db->trans_complete();

			
			if($this->db->trans_status() === FALSE)
					{
			   			$this->db->trans_rollback();
			   			$this->session->set_flashdata('error', 'Record Not Saved, Please try again.');
        	 redirect('student_transport/Bus_transport',refresh);
			   			
					}else
					{
			   			$this->db->trans_complete();
			   			$this->session->set_flashdata('success', 'Record Saved Sucessfully');
        	 		redirect('student_transport/Bus_transport',refresh);

					}


		

	}

	function allocate_bus_stoppage($adm_no){
		// $data['status']="Student is not availing transport facility,Want to Add then proceed. ";
		$data['adm_no']=base64_decode(urldecode($adm_no));
		$data['stoppage']=$this->dbcon->select('stoppage','*'," 1='1'order by STOPPAGE");
		
		$this->fee_template('student_transport/bus_transport_allocate',$data);
	}

	function add_student(){
		$data['adm_no']=$adm_no=$this->input->post('adm_no');
$data['stoppage']=$this->dbcon->select('stoppage','*'," 1='1'order by STOPPAGE");
		$this->fee_template('student_transport/bus_transport_allocate',$data);
	}

	function allocate_stopage_fornew(){

		

		$adm_no=htmlentities($this->input->post('adm_no'));


		$MON=$this->input->post('mon_list');
		$NEW_STOPNO=$this->input->post('selstoppage');

		
		if($MON=="none"){
			$this->session->set_flashdata('error', 'Please Select Month');
        	 redirect('student_transport/Bus_transport',refresh);
		}
		if($NEW_STOPNO=="none"){
			$this->session->set_flashdata('error', 'Please Select Stoppage');
        	 redirect('student_transport/Bus_transport',refresh);
		}

		$getmaxno = $this->dbcon->max_no('student_transport_facility','ID');
		$max_no = $getmaxno[0]->ID + 1;
		
		$monthNum=$MON;
		$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));

		$cmonth_code=$this->stm->get_month_calender($MON);
	 
	 	$mon_code_curr=$cmonth_code[0]->id;

		$data['ID']=$max_no;
		$data['ADM_NO']=$adm_no;
		$data['OLD_STOPNO']='1';
		$data['NEW_STOPNO']=$NEW_STOPNO;
		$data['FROM_APPLICABLE_MONTH']=substr(strtoupper($monthName), 0, 3);
		$data['TO_APPLICABLE_MONTH']='MAR';
		$data['FROM_APPLICABLE_MONTH_CODE']=$mon_code_curr;
		$data['TO_APPLICABLE_MONTH_CODE']='12';
		$data['CREATED_DATE']=date('Y-m-d');
		$data['USER_ID']=$this->session->userdata('user_id');

// for student table
		$update_array = array(
			'stopno' => $NEW_STOPNO,
			'student_transport_facility_id'=>$max_no
		);

		$this->db->trans_start();
			$this->dbcon->insert('student_transport_facility',$data);
			
			$this->dbcon->update('student',$update_array,"ADM_NO='$adm_no'");
			
			
			
			$this->db->trans_complete();

			
			if($this->db->trans_status() === FALSE)
					{
			   			$this->db->trans_rollback();
			   			$this->session->set_flashdata('error', 'Record Not Saved, Please try again.');
        	 redirect('student_transport/Bus_transport',refresh);
			   			
					}else
					{
			   			$this->db->trans_complete();
			   			$this->session->set_flashdata('success', 'Record Saved Sucessfully');
        	 		redirect('student_transport/Bus_transport',refresh);

					}


	}
	function del_transport()
	{
			$id=$this->input->post('id');
			$adm_no=$this->input->post('adm_no');

			//echo $id.'/'.$adm_no;
			$trans_report=$this->dbcon->select('student_transport_facility','*',"ADM_NO='$adm_no' order by ID");
			 $cnt=count($trans_report);
			
			if($cnt==1){
			 	echo '1';
			 }
			 if($cnt>1)
			 {
			 	$stu_report=$this->dbcon->select('student','*',"ADM_NO='$adm_no'");
				$p= $stu_report[0]->student_transport_facility_id;
				if($id==$p){
					echo '2';
				}
				else{

					$this->db->trans_start();
					$t=$this->stm->select_and_insert($id);
					$p=$this->stm->del_from_bus_transport($id);
					$this->db->trans_complete(); 
					if ($this->db->trans_status() === FALSE) {
					    $this->db->trans_rollback();
					   echo '4';
					} 
					else {
					    $this->db->trans_commit();
					    echo '3';
					}
					
				}
			 }
			
			
	}
	
	
}