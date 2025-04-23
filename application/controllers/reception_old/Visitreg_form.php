<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitreg_form extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Farheen','farheen');
	}
	
	public function index()
    {
		$data['visit_data'] = $this->farheen->select('visitreg_form','*,(select mode_type from mode_type where id=entry_mode)entrymode,(select dept from department where id=dept_id)dept,(select vis_purpose from visitor_purpose where id=vis_pur_id)purpose,(select vis_type from visitor_type where id=vis_type_id)type',"status='Y'");
		$data['school_data'] = $this->farheen->select('school_setting','short_nm',"S_No='1'");
		$this->render_template('reception/visitreg_form',$data);
	}
	public function add_visit()
	{
		$mode_data = $this->farheen->select('mode_type','*',"status='Y'");
		$dept_data = $this->farheen->select('department','*',"status='Y'");
		$pur_data = $this->farheen->select('visitor_purpose','*',"status='Y'");
		$type_data = $this->farheen->select('visitor_type','*',"status='Y'");
		$stuid_data = $this->farheen->select('student','*,(select CLASS_NM from classes where Class_No=ADM_CLASS)stu_class,(select SECTION_NAME from sections where section_no=ADM_SEC)stu_sec',"Student_Status='ACTIVE'");
		$emp_data = $this->farheen->select('employee','*');
		$supp_data = $this->farheen->select('supplier_master','*');
		$school_data = $this->farheen->select('school_setting','short_nm',"S_No='1'");
		$shrt_name = $school_data[0]->short_nm;
		$today_date = date('d-m-Y');
		
        $cur_time = date('H:i:s A');   
    
		$arrayy = array('shrt_name' => $shrt_name,'today_date'=>$today_date,'mode_data'=>$mode_data,'dept_data'=>$dept_data,'pur_data'=>$pur_data,'type_data'=>$type_data,'cur_time'=>$cur_time,'stuid_data'=>$stuid_data,'emp_data'=>$emp_data,'supp_data'=>$supp_data);
		
		$this->render_template('reception/add_visit',$arrayy);
	}
	public function save_visit()
	{
			
		$vis_date = date('Y-m-d',strtotime($this->input->post('vis_date')));
		$array = array(
			
			'stu_id' => $this->input->post('stu_id'),
			'emp_id' => $this->input->post('emp_id'),
			'supp_id' => $this->input->post('sup_id'),
			'entry_mode' => $this->input->post('mode_id'),
			'visit_date' => $vis_date,
			'name' => $this->input->post('name'),
			'mobile' => $this->input->post('mobile'),
			'otp' => $this->input->post('otp'),
			'dept_id' => $this->input->post('dept'),
			'vis_pur_id' => $this->input->post('vis_purpose'),
			'vis_type_id' => $this->input->post('vis_type'),
			'in_time' => $this->input->post('in_time'),
			
			'remarks' => $this->input->post('remarks'),
			);
			$this->farheen->insert('visitreg_form',$array);
			$this->session->set_flashdata('msg',"Successfully Added");
		    redirect('reception/Visitreg_form/add_visit');
			//$this->session->sess_destroy();
	}
	public function genn_otp()
	{
		$rand = mt_rand(1000,9999);
		$this->session->set_userdata('rand',$rand);
		//echo $otp_msg = $this->session->userdata('rand'); die();
		$mssg = 'Your OTP :'.' '.$rand;
		$mob = $this->input->post('mob');
		
		if(!empty($rand))
		{
			$msg="S";
            $arr = array('msg'=>$msg);
            echo json_encode($arr);
		}
		else{
			$msg="E";
            $arr = array('msg'=>$msg);
            echo json_encode($arr);
		}	
		$this->sms_lib->sendSMS($mob,$mssg);
	}
	public function verify_otp()
	{
		$get_otp = $this->input->post('get_otp');
		if($get_otp == $this->session->userdata('rand'))
		{
			echo 1;
		}
		else{
			echo 0;
		}
	}
	public function visit_val()
	{
		$today_date = date('Y-m-d');
		$vis_type = $this->input->post('vis_type');
		$dept = $this->input->post('dept');
		$purpose = $this->input->post('purpose');
		
		$vis_cnt = $this->db->query("select visit_count from visit where vis_type_id=$vis_type and vis_purpose_id=$purpose and dept_id=$dept and f_date='$today_date' and status='Y'")->result();
		@$visit_count = $vis_cnt[0]->visit_count;
		
		$form_vis = $this->db->query("select * from visitreg_form where vis_type_id=$vis_type and vis_pur_id=$purpose and dept_id=$dept and visit_date='$today_date' and status='Y'")->result();
		
		$form_cnt = count($form_vis);
		
		if(($visit_count == $form_cnt) AND ($form_cnt!=0))
		{
			$msg="S";
            $arr = array('msg'=>$msg);
            echo json_encode($arr);
		}
		else{
			$msg="E";
            $arr = array('msg'=>$msg);
            echo json_encode($arr);
		}
	}
	public function stu_fil()
	{
		$stu_id = $this->input->post('stu_id');
		
		$stu_details = $this->db->query("select *,(select CLASS_NM from classes where Class_No=ADM_CLASS)stu_class,(select SECTION_NAME from sections where section_no=ADM_SEC)stu_sec from student where STUDENTID='$stu_id'  and Student_Status='ACTIVE'")->result();
		$stu_name = $stu_details[0]->FIRST_NM;
		$stu_class = $stu_details[0]->stu_class;
		$stuu_sec = $stu_details[0]->stu_sec;
		$father_name = $stu_details[0]->FATHER_NM;
		$father_mob = $stu_details[0]->P_MOBILE;
		
		$json = array('stu_name'=>$stu_name,'stu_class'=>$stu_class,'father_name'=>$father_name,'father_mob'=>$father_mob,'stuu_sec'=>$stuu_sec); 
        echo json_encode($json);
	}
	public function emp_fil()
	{
		$emp_id = $this->input->post('emp_id');
		
		$emp_details = $this->db->query("select * from employee where EMPID='$emp_id'")->result();
		$emp_name = $emp_details[0]->EMP_FNAME;
		$emp_mob = $emp_details[0]->C_MOBILE;
		
		$json = array('emp_name'=>$emp_name,'emp_mob'=>$emp_mob); 
        echo json_encode($json);
	}
	public function supp_fil()
	{
		$sup_id = $this->input->post('sup_id');
		
		$supp_details = $this->db->query("select * from supplier_master where Supplier_ID='$sup_id'")->result();
		$supp_name = $supp_details[0]->Supplier_Name;
		$supp_mob = $supp_details[0]->Contact_Person_Mobile_No;
		
		$json = array('supp_name'=>$supp_name,'supp_mob'=>$supp_mob); 
        echo json_encode($json);
	}
	public function stuu_fil()
	{
		$stuu_id = $this->input->post('stuu_id');
		
		$stu_details = $this->db->query("select *,(select CLASS_NM from classes where Class_No=ADM_CLASS)stu_class,(select SECTION_NAME from sections where section_no=ADM_SEC)stu_sec from student where STUDENTID='$stuu_id'  and Student_Status='ACTIVE'")->result();
		
		$stu_name = $stu_details[0]->FIRST_NM;
		$stuu_class = $stu_details[0]->stu_class;
		$stuu_sec = $stu_details[0]->stu_sec;
		$father_mob = $stu_details[0]->P_MOBILE;
		
		$json = array('stu_name'=>$stu_name,'stuu_class'=>$stuu_class,'stuu_sec'=>$stuu_sec,'father_mob'=>$father_mob); 
        echo json_encode($json);
	}
	
	function str_vis()
    {
	  $strr_date = $this->input->post('strr_date');
	  
	  $strvis_det = $this->db->query("select *,(select mode_type from mode_type where id=entry_mode)entrymode,(select dept from department where id=dept_id)dept,(select vis_purpose from visitor_purpose where id=vis_pur_id)purpose,(select vis_type from visitor_type where id=vis_type_id)type from visitreg_form where visit_date='$strr_date' and status='Y'")->result();
	  
	  $school_data = $this->db->query("select short_nm from school_setting")->result();
	  
	  $shrt_name = $school_data[0]->short_nm;
	  
	  $i = 1;
	  ?>
	  <table class='table table-bordered' id='example'>
		  <thead>
			  <tr>
			  <th>Sl. no.</th>
			  <th>Visitor Id</th>
			  <th>Entry Mode</th>
			  <th>Visit Date</th>
			  <th>Name</th>
			  <th>Mobile No.</th>
			  <th>Department</th>
			  <th>Visitor Purpose</th>
			  <th>Visitor Type</th>
			  <th>In time</th>
			  </tr>
		  </thead>
	  <tbody>
	  <?php
	  foreach ($strvis_det as $key => $value) 
	   {
		   $idd = $value->id;
		   $vis_id = $shrt_name.'-'.$idd;
		   $vis_date = $value->visit_date;
		   $viss_date = date('d-m-Y',strtotime($vis_date));
		?>			
		   <tr>
			   <td><?php echo $i; ?></td>
			   <td><?php echo $vis_id; ?></td>
			   <td><?php echo $value->entrymode; ?></td>
			   <td><?php echo $viss_date; ?></td>
			   <td><?php echo $value->name; ?></td>
			   <td><?php echo $value->mobile; ?></td>
			   <td><?php echo $value->dept; ?></td>
			   <td><?php echo $value->purpose; ?></td>
			   <td><?php echo $value->type; ?></td>
			   <td><?php echo $value->in_time; ?></td>
		   </tr>
		   <?php
         $i++;		   
	   }
	   ?>
	   </tbody>
	  </table>
	  <script>
	  $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			 
			{
                extend: 'excelHtml5',
				title: 'Visitor Reports',
                
            },
			 {
                extend: 'csvHtml5',
				title: 'Visitor Reports',
                
            }, 
			{
                extend: 'pdfHtml5',
				title: 'Visitor Reports',
                
            },
        ]
    });
	  </script>
	  <?php
	 
    }
    
	function endd_vis()
    {
	  $endd_date = $this->input->post('endd_date');
	  $strr_date = $this->input->post('strr_date');
	  $strvis_det = $this->db->query("select *,(select mode_type from mode_type where id=entry_mode)entrymode,(select dept from department where id=dept_id)dept,(select vis_purpose from visitor_purpose where id=vis_pur_id)purpose,(select vis_type from visitor_type where id=vis_type_id)type from visitreg_form where visit_date between '$strr_date' and '$endd_date' and status='Y'")->result();
	 
	  $school_data = $this->db->query("select short_nm from school_setting")->result();
	  
	  $shrt_name = $school_data[0]->short_nm;
	  $i = 1;
	  ?>
	  <table class='table table-bordered table-responsive data_table' id='example'>
		  <thead>
			  <tr>
			  <th>Sl. no.</th>
			  <th>Visitor Id</th>
			  <th>Entry Mode</th>
			  <th>Visit Date</th>
			  <th>Name</th>
			  <th>Mobile No.</th>
			  <th>Department</th>
			  <th>Visitor Purpose</th>
			  <th>Visitor Type</th>
			  <th>In time</th>
			  </tr>
		  </thead>
	  <tbody>
	  <?php
	  foreach ($strvis_det as $key => $value) 
	   {
		   $idd = $value->id;
		   $vis_id = $shrt_name.'-'.$idd;
		   $vis_date = $value->visit_date;
		   $viss_date = date('d-m-Y',strtotime($vis_date));
		?>			
		   <tr>
			   <td><?php echo $i; ?></td>
			   <td><?php echo $vis_id; ?></td>
			   <td><?php echo $value->entrymode; ?></td>
			   <td><?php echo $viss_date; ?></td>
			   <td><?php echo $value->name; ?></td>
			   <td><?php echo $value->mobile; ?></td>
			   <td><?php echo $value->dept; ?></td>
			   <td><?php echo $value->purpose; ?></td>
			   <td><?php echo $value->type; ?></td>
			   <td><?php echo $value->in_time; ?></td>
		   </tr>
		   <?php
         $i++;		   
	   }
	   ?>
	   </tbody>
	  </table>
	  <script>
	  $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			 
			{
                extend: 'excelHtml5',
				title: 'Visitor Reports',
                
            },
			 {
                extend: 'csvHtml5',
				title: 'Visitor Reports',
                
            }, 
			{
                extend: 'pdfHtml5',
				title: 'Visitor Reports',
                
            },
        ]
    });
	  </script>
	  <?php
	 
}
	public function download_form()
	{
		$school_setting = $this->farheen->select('school_setting','*');
		$today_date = date('d-m-Y');
		//echo "<pre>";
		//print_r($school_setting);die();
		$array = array('school_setting'=>$school_setting,'today_date'=>$today_date);
	      $this->load->view('reception/visiter_form_pdf',$array);
			
			 $html = $this->output->get_output();
			 $this->load->library('pdf');
             $this->dompdf->loadHtml($html);
			 $this->dompdf->setPaper('A5', 'landscape');
			 $this->dompdf->render();
			 $this->dompdf->stream("visiter_form_pdf.pdf", array("Attachment"=>0));
	}
}
	