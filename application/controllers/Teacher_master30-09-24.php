<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_master extends MY_Controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
	}
	
	public function class_master(){
		$data = $this->dbcon->select('classes','*');
		$array = array('data'=>$data);
		$this->teacher_template('Teacher_master/class_master',$array);
	}
	
	public function add_class(){
		$data = $this->dbcon->select('classes','*');
		$this->teacher_template('Teacher_master/add_class');
	}
	
	public function class_save(){
		$data = $this->dbcon->max_no('classes','Class_No');
		$max_no = $data[0]->Class_No + 1;
		
		$data = array(
		 'Class_No' => $max_no,
		 'CLASS_NM' => strtoupper($this->input->post('class_name')),
		 'ExamMode' => $this->input->post('exam_type')
		);
		
		$this->dbcon->insert('classes',$data);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Teacher_master/class_master');
	}
	
	public function edit_class($id){
		$data = $this->dbcon->select('classes','*',"Class_No='$id'");
		$array = array('data'=>$data);
		$this->teacher_template('Teacher_master/edit_class',$array);
	}
	
	public function class_update(){
		$upd_id = $this->input->post('upd_id');
		
		$data = array(
		 'CLASS_NM' => strtoupper($this->input->post('class_name')),
		 'ExamMode' => $this->input->post('exam_type')
		);
	
		$this->dbcon->update('classes',$data,"Class_No='$upd_id'");
		$this->session->set_flashdata('msg',"Successfully Updated");
		redirect('Teacher_master/class_master');
	}
	public function section_master(){
		$data = $this->dbcon->select('sections','*');
		$array = array('data'=>$data);
		$this->teacher_template('Teacher_master/section_master',$array);
	}
	public function add_section(){
		$this->teacher_template('Teacher_master/add_section');
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
		redirect('Teacher_master/section_master');
	}
	public function edit_section($id){
		$data = $this->dbcon->select('sections','*',"section_no='$id'");
		$array = array('data'=>$data);
		$this->teacher_template('Teacher_master/edit_section',$array);
	}
	public function section_update(){
		$upd_id = $this->input->post('upd_id');

		$data = array(
		 'SECTION_NAME' => strtoupper($this->input->post('section_name'))
		);	
		$this->dbcon->update('sections',$data,"section_no='$upd_id'");
		$this->session->set_flashdata('msg',"Successfully Updated");
		redirect('Teacher_master/section_master');
	}
	
	public function clswise_subj_allco(){
		$log_cls_no = login_details['Class_No'];
		$log_sec_no = login_details['Section_No'];
		$classes = $this->dbcon->select('classes','*');
		$subs = $this->dbcon->select('subjects','*');
		$array = array('classes' => $classes, 'subs'=>$subs,'log_cls_no'=>$log_cls_no,'log_sec_no'=>$log_sec_no);
		$this->teacher_template('teacher_master/clswise_subj_allco',$array);
	}
	
	public function classwiseallco(){
		$class = $this->input->post('val');
		
		//$data = $this->dbcon->select("class_section_wise_subject_allocation","*,(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subname","Class_No='$class' AND section_no='1'");
		
		$dataa = $this->dbcon->subjwiseallco($class);
		?>
		
		<table class='table' id='ad_mor' style="border:1px solid #5785c3;">
	       <tr style='background:#5785c3;'>
		     <th style="color:#fff!important;">SELECTED SUBJECT</th>
		     <th style="color:#fff!important;">SUBJECT TYPE</th>
		     <th style="color:#fff!important;">ACTION</th>
		  </tr>
		  
		 <?php
			$i = 1;
			foreach($dataa as $dtt){
				$conv = $dtt->opt_code;
				//$mrks = $dtt->M2;
		 ?>		
				<tr style='padding:2px!important;' id='row_<?php echo $i; ?>'>	
				   <input type="hidden" value="<?php echo $dtt->Class_No; ?>" id="classno_<?php echo $i; ?>">
				   <input type="hidden" value="<?php echo $dtt->subject_code; ?>" id="subjectcode_<?php echo $i; ?>">
				   <td><input type='text' id='subjname_<?php echo $i; ?>' name='subj_name[]' value='<?php echo $dtt->subj_nm ?>' readonly></td>
				   <td>
				     <select id='optcode_<?php echo $i; ?>' name='opt_code[]' style="padding:2px; width:174px;" disabled>
					   <option value=''>Select</option>
					   <option value='0' <?php if($conv == 0){ echo "selected"; } ?>>Main</option>
					   <option value='1' <?php if($conv == 1){ echo "selected"; } ?>>Optional</option>
					   <option value='2' <?php if($conv == 2){ echo "selected"; } ?>>Sub-Optional</option>
					 </select>
				   </td>		
				   <td>
					 <button type="button" title='EDIT' class='btn btn-warning btn-xs'><i class='fa fa-pencil-square-o' id='edit_<?php echo $i; ?>' style='color:#fff;; cursor:pointer; font-size:18px;' onclick='edit(this)'></i></button> 
					 <button type="button" title='SAVE' id='save_<?php echo $i; ?>' class='btn btn-success btn-xs' disabled onclick="class_upd(this)"><i class='fa fa-floppy-o' style='color:#fff; cursor:pointer; font-size:18px;'></i></button> 	
					 <button type="button" title='DELETE' class='btn btn-danger btn-xs'><i class='fa fa-times' id='rv_<?php echo $i; ?>' title='DELETE' style='color:#fff; cursor:pointer; font-size:18px;' onclick='rv(this)'></i></button>							
				   </td> 			
				</tr>
		<?php		
				$i++;
            }	
		?>	
			</table>
		<?php	
	
	}
	
	public function apnd(){
		$class = $this->input->post('classs');
		$ii = $this->input->post('count');
		$data = $this->dbcon->select("class_section_wise_subject_allocation","*,(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subname","Class_No='$class' AND section_no='1'");
		?>
		  <tr id="row_<?php echo $ii; ?>">
			<td>
			  <select id="subjname_<?php echo $ii; ?>" name='subj_name[]' style="padding:2px; width:174px;" onchange="chk_sub(this)">
			    <option value=''>Select</option>
				<?php
				  if(isset($data)){
					  foreach($data as $dt){
						  ?>
						   <option value="<?php echo $dt->subject_code; ?>"><?php echo $dt->subname; ?></option>
						  <?php
					  }
				  }
				?>
			  </select>
			</td>
			<td>
			  <select id="optcode_<?php echo $ii; ?>" name='opt_code[]' style="padding: 2px; width: 174px;">
				  <option value=''>Select</option>
				  <option value='0'>Main</option>
				  <option value='1'>Optional</option>
				  <option value='2'>Sub-Optional</option>
			  </select>
			</td>
			<td>
			  <button type="button" title='SAVE' class='btn btn-success btn-xs'><i class='fa fa-floppy-o' id='save_<?php echo $ii; ?>' style='color:#fff; cursor:pointer; font-size:18px;' onclick="new_upd(this)"></i></button> 
			  
			  <button type="button" title='DELETE' class='btn btn-danger btn-xs'><i class='fa fa-times' id='rv_<?php echo $ii; ?>' title='DELETE' style='color:#fff; cursor:pointer; font-size:18px;' onclick='rv(this)'></i></button>
			</td>
		  </tr>	
        <?php	
	}
	
	public function new_sub_upd(){
		$subcode  = $this->input->post('subcode');
		$class_no = $this->input->post('class_no');
		
		$data = array(
		 'sorting_no'      => $this->input->post('sort'),
		 'applicable_exam' => 1,
		 'opt_code'        => $this->input->post('optcode')
		);
		
		$this->dbcon->update('class_section_wise_subject_allocation',$data,"subject_code='$subcode' AND Class_No='$class_no'");
		echo "Update Successfully";
	}
	
	public function chk_subject(){
		$subjname = $this->input->post('subjname');
		$classs   = $this->input->post('classs');
		$data  = $this->dbcon->subjcnt($subjname,$classs);
		$cnt = count($data);
		if($cnt == 1){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	public function class_upd(){
		$opt_code    = $this->input->post('opt_code');
		$classno     = $this->input->post('classno');
		$subjectcode = $this->input->post('subjectcode');
		
		$data = array(
		'opt_code' => $opt_code
		);
		
		$this->dbcon->update('class_section_wise_subject_allocation',$data,"Class_No='$classno' AND subject_code = '$subjectcode'");
		echo "updated Successfully";
	}
	
	public function stuwise_subj_allco(){
		$classes = $this->dbcon->select('classes','*');
		$array = array('classes'=>$classes);
		$this->teacher_template('teacher_master/stuwise_subj_allco',$array);
	}
	
	public function classsec(){
		$classs = $this->input->post('classs');
		$data = $this->dbcon->select_distinct('student','DISP_SEC,SEC',"DISP_CLASS='$classs' AND Student_Status='ACTIVE'");
		?>
		  <option value=''>Select</option>
		<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
			<?php
		}
	}
	
	public function section(){
		$classs = $this->input->post('classs');
		$data = $this->dbcon->select_distinct('class_section_wise_subject_allocation','subj_nm,subject_code',"opt_code='2' AND applicable_exam='1' AND Class_No = '$classs'");
		?>
		  <option value=''>Select</option>
		<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->subject_code; ?>'><?php echo $dt->subj_nm; ?></option>
			<?php
		}
	}
	
	public function chk_del(){
		$class          = $this->input->post('classs');
		$classsid       = $this->input->post('classsid');
		$subjectcode    = $this->input->post('subjectcode');
		
		$data = $this->dbcon->select("marks","count(M2)cnt","classes='$class' AND SCode = '$subjectcode'");
		$cnt = $data[0]->cnt;
		if($cnt == 0){
			$data = array(
			  'sorting_no'      => 0,
			  'applicable_exam' => 0
			);
			
			$this->dbcon->update('class_section_wise_subject_allocation',$data,"Class_No='$classsid' AND subject_code = '$subjectcode'");
			echo 'Y';
			
		}else{
			echo 'N';
		}
	}
	
	public function allco_stu_list(){
		$classs    = $this->input->post('classs');
		$sec       = $this->input->post('sec');
		$subj_code = $this->input->post('subj_code');
		$stutbl    = $this->dbcon->stu_list_subj_allocation($classs,$sec);
		?>
		<div class="table-responsive">
		<table class="table">
		  <tr style="background:#5785c3;">
		    <th style="color:#fff!important;"><input type="checkbox" name="chkall" onchange="checkAll()"> Select</th>
		    <th style="color:#fff!important;">Adm No.</th>
		    <th style="color:#fff!important;">Name</th>
		    <th style="color:#fff!important;">Roll</th>
		    <th style="color:#fff!important;">Subject</th>
		  </tr>
		<?php
		foreach($stutbl as $stu_data){
			?>
			  <tr>
			    <td><input type="checkbox" name='adm_no[]' value="<?php echo $stu_data->ADM_no; ?>" onclick="chk_one()"></td>
			    <td><?php echo $stu_data->ADM_no; ?><input type="hidden" name="class" value="<?php echo $classs; ?>"><input type="hidden" name="sec" value="<?php echo $sec; ?>"><input type="hidden" name="subj_code" value="<?php echo $subj_code; ?>"></td>
			    <td><?php echo $stu_data->FIRST_NM; ?></td>
			    <td><?php echo $stu_data->ROLL_NO; ?></td>
			    <td><?php if($stu_data->subnm != ''){ echo $stu_data->subnm; }else{ echo "--"; } ?></td>
			  </tr>
			<?php
		}
		?>
		</table>
		</div>
		<?php
	}
	
	public function save_and_upd(){
		$class     = $this->input->post('class');
		$sec       = $this->input->post('sec');
		$subj_code = $this->input->post('subj_code');
		
		for($i=0; $i<count($this->input->post('adm_no')); $i++){
		    $adm_no  = $this->input->post('adm_no')[$i];
			
			$chk_data = $this->dbcon->select('studentsubject','ID',"Adm_no='$adm_no' AND Class = '$class' AND SEC = '$sec'");
			$cnt = count($chk_data);
			if($cnt == 1){
				$data = array(
				 'SUBCODE' => $subj_code
				);
				
				$this->dbcon->update("studentsubject",$data,"Adm_no='$adm_no' AND Class = '$class' AND SEC = '$sec'");
				echo 'upd';
				
			}else{
				$data_ins = array(
				 'Adm_no'  => $adm_no,
				 'Class'   => $class,
				 'SEC'     => $sec,
				 'SUBCODE' => $subj_code
				);
				
				$this->dbcon->insert('studentsubject',$data_ins);
				echo "ins";
			}
		}
	}
	
	public function max_marks_allco(){
		
		$classes = $this->dbcon->select('classes','*');
		$report_card_permission = $this->alam->selectA('report_card_permission','*');
		$t1 = $report_card_permission[0]['term1'];
		$t2 = $report_card_permission[0]['term2'];
		$array = array('classes'=>$classes,'t1'=>$t1,'t2'=>$t2);
		
		$this->teacher_template('teacher_master/max_marks_allco',$array);
	}
	
	public function chk_classes_exam_mode(){
		$classes  = $this->input->post('classes');
		$cls      = $this->dbcon->select('classes','ExamMode',"Class_No='$classes'");
		echo $ExamMode = $cls[0]->ExamMode;
	}
	
	public function term(){
		$ret  = '';
		$rett = '';
		$classes = $this->input->post('classes');
		$board   = $this->input->post('board');
		$term    = $this->input->post('term');
		if($term == 'T1'){
			$trm = 'TERM-1';
		}else{
			$trm = 'TERM-2';
		}
		$sqldata = $this->dbcon->select('exammaster','*');
		$ret .= "<option value=''>Select</option>";
		if($board == 1){
			if($term == 'T1'){
			  foreach($sqldata as $key => $data){
				if($data->ExamCode != 6 && $data->ExamCode != 5){
				  $ret .= "<option value=".$data->ExamCode .">".$data->ExamName ."</option>";
				}
			  }	
			}else{
				foreach($sqldata as $key => $data){
				if($data->ExamCode != 6 && $data->ExamCode != 4){
				  $ret .= "<option value=".$data->ExamCode .">".$data->ExamName ."</option>";
				}
			  }	
			}
		}else{
			if($term == 'T1'){
			  foreach($sqldata as $key => $data){
				if($data->ExamCode != 5){
				  $ret .= "<option value=".$data->ExamCode .">".$data->ExamName ."</option>";
				}
			  }	
			}else{
				foreach($sqldata as $key => $data){
				if($data->ExamCode != 4){
				  $ret .= "<option value=".$data->ExamCode .">".$data->ExamName ."</option>";
				}
			  }	
			}
		}
		
		$max_mrks_allco_trem = $this->dbcon->max_mrks_allco_trem($classes,$trm,$board);
		
		$rett .="
		  <table class='table' style='border:1px solid #5785c3'>
		    <tr style='background:#5785c3;'>
			  <th style='color:#fff!important;'>Sl No.</th>
			  <th style='color:#fff!important;'>Exam Name</th>
			  <th style='color:#fff!important;'>Subject Name</th>
			  <th style='color:#fff!important;'>Max Marks</th>
		    </tr>";
			$i=1;
			foreach($max_mrks_allco_trem as $max_data){
				$rett .="
				<tr>
				  <td>". $i ."</td>
				  <td>". $max_data->exmnm ."</td>
				  <td>". $max_data->subnm ."</td>
				  <td>". $max_data->MaxMarks ."</td>
				</tr>
				";
				$i++;
			}
		$rett .= "</table>";
		
		
		$array = array($ret,$rett);
		echo json_encode($array);
	}
	
	public function examination(){
		$ret  = '';
		$rett = '';
		
	    $exammode  = $this->input->post('exammode');
		$classcode = $this->input->post('classcode');
		$term      = $this->input->post('term');
		
		if($term == 'T1'){
			$term = 'TERM-1';
		}else{
			$term = 'TERM-2';
		}

		$examcode  = $this->input->post('examcode');
		
		if($examcode == 1 || $examcode == 2 || $examcode == 3 || $examcode == 6 || $examcode == 7 || $examcode == 8 || $examcode == 9 || $examcode == 10 || $examcode == 11 || $examcode == 12 || $examcode == 13){
		   $sqldata = $this->dbcon->select_distinct('class_section_wise_subject_allocation','subject_code,subj_nm',"Class_No='$classcode' AND applicable_exam = '1' AND opt_code in (0,2)");
		}else{
			$sqldata = $this->dbcon->select_distinct('class_section_wise_subject_allocation','subject_code,subj_nm',"Class_No='$classcode' AND applicable_exam = '1'");
		}
		
		$ret .= "<option value=''>Select</option>";
		foreach($sqldata as $data){
			  $ret .= "<option value=" .$data->subject_code .">" .$data->subj_nm ."</option>";
		}
		
		$max_mrks_allco_exam = $this->dbcon->max_mrks_allco_exam($classcode,$term,$exammode,$examcode);
		
		$rett .="
		  <table class='table' style='border:1px solid #5785c3'>
		    <tr style='background:#5785c3;'>
			  <th style='color:#fff!important;'>Sl No.</th>
			  <th style='color:#fff!important;'>Exam Name</th>
			  <th style='color:#fff!important;'>Subject Name</th>
			  <th style='color:#fff!important;'>Max Marks</th>
		    </tr>";
			$i=1;
			foreach($max_mrks_allco_exam as $max_data){
				$rett .="
				<tr>
				  <td>". $i ."</td>
				  <td>". $max_data->exmnm ."</td>
				  <td>". $max_data->subnm ."</td>
				  <td>". $max_data->MaxMarks ."</td>
				</tr>
				";
				$i++;
			}
		$rett .= "</table>";
		
		$array = array($ret,$rett);
		echo json_encode($array);
	}
	
	public function save_upd_max_marks(){
		$exammode  = $this->input->post('exammode');
		$classcode = $this->input->post('classcode');
		$classnm   = $this->input->post('classnm');
		$term      = $this->input->post('term');
		if($term == 'T1'){
			$termm  = 'TERM-1';
		}else{
			$termm  = 'TERM-2';
		}
		$examcode  = $this->input->post('examcode');
		$subcode  = $this->input->post('subcode');
		$max_marks = $this->input->post('max_marks');
		
		$sqldata   = $this->dbcon->select('maxmarks','*',"ExamCode = '$examcode' AND ExamMode = '$exammode' AND ClassCode = '$classcode' AND Term = '$termm' AND teacher_code = '$subcode'");
		$cnt = count($sqldata);
		if($cnt == 0){
			
			$ins_data = array(
			'ExamCode'     => $examcode,
			'ExamMode'     => $exammode,
			'MaxMarks'     => $max_marks,
			'ClassCode'    => $classcode,
			'Term'         => $termm,
			'teacher_code' => $subcode
			);
			
			$this->dbcon->insert('maxmarks',$ins_data);
			echo "Data Insert Successfully";
			
		}else{
			$sqldt = $this->dbcon->select('marks','*',"ExamC = '$examcode' AND SCode = '$subcode' AND Classes = '$classcode' AND Term = '$termm'");
			$cntt = count($sqldt);
			if($cntt == 0){
				
				$upd_data = array(
				'MaxMarks'     => $max_marks
				);
				$this->dbcon->update('maxmarks',$upd_data,"ExamCode='$examcode' AND teacher_code='$subcode' AND ClassCode='$classcode' AND Term = '$termm'");
				echo "Data Update Successfully";
				
			}else{
				echo "No Update";
			}
		}
	}
	
	public function stu_recored_keeping(){
		$this->teacher_template('teacher_master/stu_recored_keeping');
	}
	
	public function stu_adm_no(){
		$ret                 = "";
		$adm_no              = $this->input->post('adm_no');
		$data                = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		$data_record_keeping = $this->dbcon->select('Record_Keeping','ID,Adm_No,SName,Record,Date_of_Record',"ADM_NO='$adm_no'");
		$cnt = count($data_record_keeping);
		
		if(isset($data)){
			@$DISP_CLASS = $data[0]->DISP_CLASS;
			@$FIRST_NM   = $data[0]->FIRST_NM;
			@$DISP_SEC   = $data[0]->DISP_SEC;
			@$FATHER_NM  = $data[0]->FATHER_NM;
			@$P_MOBILE   = $data[0]->P_MOBILE;
		}
		
		if($cnt != 0){
		$ret .="<table class='table'>";
		$ret .="
		       <tr style='background:#5785c3;'>
			     <th></th>
			     <th></th>
			     <th>Record</th>
			     <th>Remarks</th>
		       </tr>
		       ";
		foreach($data_record_keeping as $keep_data){
			$ret .="<tr>";
				$ret .="<td colspan='3' text-align='center'>". $keep_data->Record ."</td>";
				$ret .="<td>
				
						<i onclick='remarks(". $keep_data->ID .",". '"teacher"' .")' title='TEACHER' class='fa fa-file-text'></i>
						  
				        <i onclick='remarks(". $keep_data->ID .",". '"principal"' .")' title='PRINCIPAL' class='fa fa-file-text'></i>
						 
				        <i onclick='remarks(". $keep_data->ID .",". '"parent"' .")' title='PARENTS' class='fa fa-file-text'></i>
						 
						</td>";
			$ret .="</tr>";
		}	   
		$ret .="</table>";
		}
		else{
			$ret .= "<h3><center>No Record Found.</center></h3>";
		}
		
		$array = array($DISP_CLASS,$FIRST_NM,$DISP_SEC,$FATHER_NM,$P_MOBILE,$ret);
		echo json_encode($array);
	}
	
	public function save_stu_keeping_record(){
		$adm_no = $this->input->post('adm_no');
		$data = array(
		'ADM_NO'  => $this->input->post('adm_no'),
		'Classes' => $this->input->post('class_nm'),
		'SName'   => $this->input->post('stu_nm'),
		'Section' => $this->input->post('sec'),
		'FName'   => $this->input->post('f_nm'),
		'PhNo'    => $this->input->post('cont'),
		'Record'  => $this->input->post('remarks')
		);
		
		$this->dbcon->insert('Record_Keeping',$data);
		$rec_data = $this->dbcon->select('Record_Keeping','*',"Adm_No='$adm_no'");
		?>
		<table class="table">
		<tr style='background:#5785c3;'>
		  <th></th>
		  <th></th>
		  <th>Record</th>
		  <th>Remarks</th>
	    </tr>
		<?php
		foreach($rec_data as $data){
			$rec_data = $data->Date_of_Record;
			
			?>
			 <tr>
			   <td colspan='3' text-align='center'><?php echo $data->Record; ?></td>
			   <td>
			     <i onclick='remarks(<?php echo $data->ID; ?>,"teacher")' class='fa fa-file-text'></i>
			     <i onclick='remarks(<?php echo $data->ID; ?>,"principal")' class='fa fa-file-text'></i>
			     <i onclick='remarks(<?php echo $data->ID; ?>,"parent")' class='fa fa-file-text'></i>
			   </td>
			 </tr>
			<?php
		}
		?>
		</table>
		<?php
	}
	
	public function remarks(){
		$upd_id = $this->input->post('id');
		$type = $this->input->post('type');
		?>
		  <table class="table">
		  <input type="hidden" name="upd_id" value="<?php echo $upd_id; ?>">
		  <input type="hidden" name="type" value="<?php echo $type; ?>">
		    <tr>
			  <th>Remarks from <?php echo $type; ?></th>
			  <td><textarea name="remarks" id="remarks" class="form-control"></textarea></td>
		    </tr>
		  </table>
		<?php
	}
	
	public function save_remarks(){
		$type    = $this->input->post('type');
		$remarks = $this->input->post('remarks');
		$upd_id  = $this->input->post('upd_id');
		$today   = date("d-m-y");
		
		if($type == 'teacher'){
			$data = array(
			 'Remarks_Class_Teacher' => $remarks,
			 'Date_Class_Teacher' => $today
			);
			$this->dbcon->update('Record_Keeping',$data,"ID='$upd_id'");
			echo "Teacher Remarks Update";
		}
		if($type == 'principal'){
			$data = array(
			 'Remarks_Principal'  => $remarks,
			 'Date_Principal'     => $today
			);
			$this->dbcon->update('Record_Keeping',$data,"ID='$upd_id'");
			echo "Principal Remarks Update";
		}
		if($type == 'parent'){
			$data = array(
			 'Feedback'      => $remarks,
			 'Date_Feedback' => $today
			);
			$this->dbcon->update('Record_Keeping',$data,"ID='$upd_id'");
			echo "Parent Remarks Update";
		}
	}
}