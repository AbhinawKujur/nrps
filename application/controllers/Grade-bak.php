<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grade extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$report_card_permission = $this->alam->selectA('report_card_permission','*');
		$t1 = $report_card_permission[0]['term1'];
		$t2 = $report_card_permission[0]['term2'];
		
		$array = array('t1'=>$t1,'t2'=>$t2);
		$this->teacher_template('marks_entry/coscho_term',$array);
	}
	
	public function cosoc($trm){
		$log_cls_no = login_details['Class_No'];
		$log_sec_no = login_details['Section_No'];
	    $class_data = $this->alam->select('classes','*');
		$array = array('class_data'=>$class_data,'trm'=>$trm,'log_cls_no'=>$log_cls_no);
		
		$this->teacher_template('marks_entry/co_scholastic_grade',$array);
	}
	
	public function classess(){
		$ret = '';
		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$log_sec_no = login_details['Section_No'];
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 if($log_sec_no == $data->SEC){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
				 }
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function stu_list(){
		$classs      = $this->input->post('classs');
		$disp_classs = $this->input->post('disp_classs');
		$sec         = $this->input->post('sec');
		$trm         = $this->input->post('trm');
		
		$data        = $this->alam->co_scholastic_grade_data($classs,$sec,$trm);
		$cntData = $this->alam->selectA('co_scholastic_grade','count(*)cnt',"Class='$classs' AND Sec='$sec' AND Term='$trm'"); 
		$cnt = $cntData[0]['cnt'];
		if($cnt == 0){ //insert
		?>
		<form id='formm' method='POST'>
		  <table class='table'>
		    <tr>
			  <th style="background:#5785c3; color:#fff!important;">Adm No</th>
			  <th style="background:#5785c3; color:#fff!important;">Student</th>
			  <th style="background:#5785c3; color:#fff!important;">Roll No</th>
			  <th style="background:#5785c3; color:#fff!important;">WORK EDUCATION GRADE</th>
			  <th style="background:#5785c3; color:#fff!important;">ART EDUCATION GRADE</th>
			  <th style="background:#5785c3; color:#fff!important;">HEALTH & PHYSICAL EDUCATION GRADE</th>
			  <th style="background:#5785c3; color:#fff!important;">DISCIPLINE GRADE</th>
		    </tr>
			<?php
			if(isset($data)){
				foreach($data as $co_data){
					?>
					<tr>
					
						<td>
							<?php echo $co_data->ADM_NO; ?>
							<input type='hidden' name='admno[]' value='<?php echo $co_data->ADM_NO; ?>'>
							<input type='hidden' name='class' value='<?php echo $classs; ?>'>
							<input type='hidden' name='sec' value='<?php echo $sec; ?>'>
							<input type='hidden' name='trm' value='<?php echo $trm; ?>'>
						</td>
						<td><?php echo $co_data->FIRST_NM; ?></td>
						<td><?php echo $co_data->ROLL_NO; ?></td>
						<?php
						  if($disp_classs == 'IX' || $disp_classs == 'X'){
						?>
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="A" name='skill1[]' style="width:50px;"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="A" name='skill2[]' style="width:50px;"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="A" name='skill3[]' style="width:50px;"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="A" name='skill4[]' style="width:50px;"></td>
						
						<?php } else { ?>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="A" name='skill1[]' style="width:50px;"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="A" name='skill2[]' style="width:50px;"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="A" name='skill3[]' style="width:50px;"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="A" name='skill4[]' style="width:50px;"></td>
						
						<?php } ?>
					</tr>	
					<?php
				}
				?>
					<tr>
						<td colspan='7'>
						<button type='submit' class='btn btn-success'><i class="fa fa-circle-o-notch fa-spin" id='btn' style='color:#fff; display:none;'></i> &nbsp;SAVE</button>
						</td>
					</tr>
				<?php
			}
			?>
			</table>
			</form>
			<script>
			$("#formm").on("submit", function (event) {
				event.preventDefault();
				$("#btn").show();
				$.ajax({
					url: "<?php echo base_url('Grade/saveGrade'); ?>",
					type: "POST",
					data: $("#formm").serialize(),
					success: function(data){
						$("#btn").hide();
						alert("Insert Successfully..!");
					}
				});
			 });
			</script>
		    <?php
		}else{ //update
			?>
				<form id='formm' method='POST'>
				  <table class='table'>
					<tr>
					  <th style="background:#5785c3; color:#fff!important;">Adm No</th>
					  <th style="background:#5785c3; color:#fff!important;">Student</th>
					  <th style="background:#5785c3; color:#fff!important;">Roll No</th>
					  <th style="background:#5785c3; color:#fff!important;">WORK EDUCATION GRADE</th>
					  <th style="background:#5785c3; color:#fff!important;">ART EDUCATION GRADE</th>
					  <th style="background:#5785c3; color:#fff!important;">HEALTH & PHYSICAL EDUCATION GRADE</th>
					  <th style="background:#5785c3; color:#fff!important;">DISCIPLINE GRADE</th>
					</tr>
					<?php
					if(isset($data)){
						foreach($data as $co_data){
							?>
							<tr>
							
								<td>
									<?php echo $co_data->ADM_NO; ?>
									<input type='hidden' name='admno[]' value='<?php echo $co_data->ADM_NO; ?>'>
									<input type='hidden' name='class' value='<?php echo $classs; ?>'>
									<input type='hidden' name='sec' value='<?php echo $sec; ?>'>
									<input type='hidden' name='trm' value='<?php echo $trm; ?>'>
								</td>
								<td><?php echo $co_data->FIRST_NM; ?></td>
								<td><?php echo $co_data->ROLL_NO; ?></td>
								<?php
								  if($disp_classs == 'IX' || $disp_classs == 'X'){
								?>
								<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill1; ?>" name='skill1[]' style="width:50px;"></td>
								
								<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill2; ?>" name='skill2[]' style="width:50px;"></td>
								
								<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill3; ?>" name='skill3[]' style="width:50px;"></td>
								
								<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill4; ?>" name='skill4[]' style="width:50px;"></td>
								
								<?php } else { ?>
								
								<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="<?php echo $co_data->skill1; ?>" name='skill1[]' style="width:50px;"></td>
								
								<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="<?php echo $co_data->skill2; ?>" name='skill2[]' style="width:50px;"></td>
								
								<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="<?php echo $co_data->skill3; ?>" name='skill3[]' style="width:50px;"></td>
								
								<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill4; ?>" name='skill4[]' style="width:50px;"></td>
								
								<?php } ?>
							</tr>	
							<?php
						}
						?>
							<tr>
								<td colspan='7'>
								<button type='submit' class='btn btn-success'><i class="fa fa-circle-o-notch fa-spin" id='btn' style='color:#fff; display:none;'></i> &nbsp;UPDATE</button>
								</td>
							</tr>
						<?php
					}
					?>
					</table>
					</form>
					<script>
					$("#formm").on("submit", function (event) {
						event.preventDefault();
						$("#btn").show();
						$.ajax({
							url: "<?php echo base_url('Grade/saveGrade'); ?>",
							type: "POST",
							data: $("#formm").serialize(),
							success: function(data){
								$("#btn").hide();
								alert("Updated Successfully..!");
							}
						});
					 });
					</script>
			<?php
		}	
	}
	
	public function save_upd(){
		$adm_no   = $this->input->post('adm_no');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$skill_id = $this->input->post('skill_id');
		$grade    = strtoupper($this->input->post('grade'));
		$trm      = $this->input->post('trm');
		
		$co_sch_data = $this->alam->select('co_scholastic_grade','count(*)cnt',"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm' AND SkillCode='$skill_id'");
		$cnt = $co_sch_data[0]->cnt;
		if($cnt == 1){
			$upd_data = array(
			'Grade' => $grade
			);
			
			$this->alam->update('co_scholastic_grade',$upd_data,"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm' AND SkillCode='$skill_id'");
		}else{
			$ins_data = array(
			'Adm_no' => $adm_no,
			'Class' => $classs,
			'Sec' => $sec,
			'Term' => $trm,
			'SkillCode' => $skill_id,
			'Grade' => $grade,
			);
			
			$this->alam->insert('co_scholastic_grade',$ins_data);
		}
	}
	
	public function discipline_term(){
		$report_card_permission = $this->alam->selectA('report_card_permission','*');
		$t1 = $report_card_permission[0]['term1'];
		$t2 = $report_card_permission[0]['term2'];
		
		$array = array('t1'=>$t1,'t2'=>$t2);
		$this->teacher_template('marks_entry/discipline_term',$array);
	}
	
	public function displin_grd($trm){
		$log_cls_no = login_details['Class_No'];
		$class_data = $this->alam->select('classes','*');
		$array = array('class_data'=>$class_data,'trm'=>$trm,'log_cls_no'=>$log_cls_no);
		
		$this->teacher_template('marks_entry/discipline_grade',$array);
	}
	
	public function classess_discipline(){
		$ret = '';
		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$log_sec_no = login_details['Section_No'];
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				if($log_sec_no == $data->SEC){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
				}
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function stu_list_discipline(){
		$classs      = $this->input->post('classs');
		$disp_classs = $this->input->post('disp_classs');
		$sec         = $this->input->post('sec');
		$trm         = $this->input->post('trm');
		
		$data        = $this->alam->discipline_grade($classs,$sec,$trm);
		
		?>
		  <table class='table'>
		    <tr>
			  <th style="background:#5785c3; color:#fff!important;">Adm No</th>
			  <th style="background:#5785c3; color:#fff!important;">Student</th>
			  <th style="background:#5785c3; color:#fff!important;">Roll No</th>
			  <th style="background:#5785c3; color:#fff!important;">Discipline Grade</th>
		    </tr>
			<?php
			if(isset($data)){
				foreach($data as $co_data){
					?>
					<tr>
					
						<td><?php echo $co_data->ADM_NO; ?></td>
						<td><?php echo $co_data->FIRST_NM; ?></td>
						<td><?php echo $co_data->ROLL_NO; ?></td>
						<?php
						  if($disp_classs == 'IX' || $disp_classs == 'X'){
						?>
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="discipline_grd('<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } else{ ?>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="discipline_grd('<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } ?>
					</tr>	
					<?php
				}
			}
			?>
			</table>
		    <?php
	}
	
	public function save_upd_discipline(){
		$adm_no   = $this->input->post('adm_no');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$grade    = strtoupper($this->input->post('grade'));
		$trm      = $this->input->post('trm');
		
		$co_sch_data = $this->alam->select('discipline_grades','count(*)cnt',"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm'");
		$cnt = $co_sch_data[0]->cnt;
		if($cnt == 1){
			$upd_data = array(
			'Grade' => $grade
			);
			
			$this->alam->update('discipline_grades',$upd_data,"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm'");
		}else{
			$ins_data = array(
			'Adm_no' => $adm_no,
			'Class' => $classs,
			'Sec' => $sec,
			'Term' => $trm,
			'Grade' => $grade
			);
			
			$this->alam->insert('discipline_grades',$ins_data);
		}
	}
	
	public function discipline_grade_skill_wise_term(){
		$report_card_permission = $this->alam->selectA('report_card_permission','*');
		$t1 = $report_card_permission[0]['term1'];
		$t2 = $report_card_permission[0]['term2'];
		
		$array = array('t1'=>$t1,'t2'=>$t2);
		$this->teacher_template('marks_entry/discipline_grade_skill_wise_term',$array);
	}
	
	public function discipline_grade_skill_wise($trm){
		$log_cls_no = login_details['Class_No'];
		$class_data = $this->alam->select('classes','*');
		$array = array('class_data'=>$class_data,'trm'=>$trm,'log_cls_no'=>$log_cls_no);
		
		$this->teacher_template('marks_entry/discipline_grade_skill_wise',$array);
	}
	
	public function classess_disci_skill_wise(){
		$ret = '';
		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$log_sec_no = login_details['Section_No'];
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				if($log_sec_no == $data->SEC){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
				}
			}
		}
		
		$array = array($ret);
		echo json_encode($array);
	}
	
	public function stu_list_disci_skill_wise(){
		$classs      = $this->input->post('classs');
		$disp_classs = $this->input->post('disp_classs');
		$sec         = $this->input->post('sec');
		$trm         = $this->input->post('trm');
		
		$data        = $this->alam->discipline_grade_skill_wise($classs,$sec,$trm);
		
		?>
		  <table class='table'>
		    <tr>
			  <th style="background:#5785c3; color:#fff!important;">Adm No</th>
			  <th style="background:#5785c3; color:#fff!important;">Student</th>
			  <th style="background:#5785c3; color:#fff!important;">Roll No</th>
			  <th style="background:#5785c3; color:#fff!important;">Attendance Grade</th>
			  <th style="background:#5785c3; color:#fff!important;">Sincerity Grade</th>
			  <th style="background:#5785c3; color:#fff!important;">Behaviour Grade</th>
			  <th style="background:#5785c3; color:#fff!important;">Values Grade</th>
		    </tr>
			<?php
			if(isset($data)){
				foreach($data as $co_data){
					?>
					<tr>
					
						<td><?php echo $co_data->ADM_NO; ?></td>
						<td><?php echo $co_data->FIRST_NM; ?></td>
						<td><?php echo $co_data->ROLL_NO; ?></td>
						<?php
						  if($disp_classs == 'IX' || $disp_classs == 'X'){
						?>
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="co_sch(1,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill2; ?>" style="width:50px;" onchange="co_sch(2,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill3; ?>" style="width:50px;" onchange="co_sch(3,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 69' maxlength='1' value="<?php echo $co_data->skill4; ?>" style="width:50px;" onchange="co_sch(4,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } else{ ?>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="<?php echo $co_data->skill1; ?>" style="width:50px;" onchange="co_sch(1,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="<?php echo $co_data->skill2; ?>" style="width:50px;" onchange="co_sch(2,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="<?php echo $co_data->skill3; ?>" style="width:50px;" onchange="co_sch(3,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<td><input type="text" onkeypress='return event.charCode >= 97 && event.charCode <= 99 || event.charCode == 45 || event.charCode >= 65 && event.charCode <= 67' maxlength='1' value="<?php echo $co_data->skill4; ?>" style="width:50px;" onchange="co_sch(4,'<?php echo $co_data->ADM_NO; ?>',this.value)"></td>
						
						<?php } ?>
					</tr>	
					<?php
				}
			}
			?>
			</table>
		    <?php
	}
	
	public function save_upd_disc_skill_wise(){
		$adm_no   = $this->input->post('adm_no');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$skill_id = $this->input->post('skill_id');
		$grade    = strtoupper($this->input->post('grade'));
		$trm      = $this->input->post('trm');
		
		$co_sch_data = $this->alam->select('discipline_grades','count(*)cnt',"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm' AND SkillCode='$skill_id'");
		$cnt = $co_sch_data[0]->cnt;
		if($cnt == 1){
			$upd_data = array(
			'Grade' => $grade
			);
			
			$this->alam->update('discipline_grades',$upd_data,"Adm_no='$adm_no'AND Class='$classs' AND Sec='$sec' AND Term='$trm' AND SkillCode='$skill_id'");
		}else{
			$ins_data = array(
			'Adm_no' => $adm_no,
			'Class' => $classs,
			'Sec' => $sec,
			'Term' => $trm,
			'SkillCode' => $skill_id,
			'Grade' => $grade,
			);
			
			$this->alam->insert('discipline_grades',$ins_data);
		}
	}
	
	function saveGrade(){
		$class = $this->input->post('class');
		$sec   = $this->input->post('sec');
		$trm   = $this->input->post('trm');
		
		$this->alam->del_grd_tbl($class,$sec,$trm);
		
		$admno = $this->input->post('admno[]');
		foreach($admno as $key => $val){
				$insDataSkill1 = array(
					'Adm_no'    => $this->input->post('admno')[$key],
					'Class'     => $this->input->post('class'),
					'Sec'       => $this->input->post('sec'),
					'Term'      => $this->input->post('trm'),
					'SkillCode' => 1,
					'Grade'     => strtoupper($this->input->post('skill1')[$key])
				);
				$this->alam->insert('co_scholastic_grade',$insDataSkill1);
				
				$insDataSkill2 = array(
					'Adm_no'    => $this->input->post('admno')[$key],
					'Class'     => $this->input->post('class'),
					'Sec'       => $this->input->post('sec'),
					'Term'      => $this->input->post('trm'),
					'SkillCode' => 2,
					'Grade'     => strtoupper($this->input->post('skill2')[$key])
				);
				$this->alam->insert('co_scholastic_grade',$insDataSkill2);
				
				$insDataSkill3 = array(
					'Adm_no'    => $this->input->post('admno')[$key],
					'Class'     => $this->input->post('class'),
					'Sec'       => $this->input->post('sec'),
					'Term'      => $this->input->post('trm'),
					'SkillCode' => 3,
					'Grade'     => strtoupper($this->input->post('skill3')[$key]),
					'user_id'   => login_details['user_id']
				);
				$this->alam->insert('co_scholastic_grade',$insDataSkill3);
				
				$insDataSkill4 = array(
					'Adm_no'    => $this->input->post('admno')[$key],
					'Class'     => $this->input->post('class'),
					'Sec'       => $this->input->post('sec'),
					'Term'      => $this->input->post('trm'), 
					'Grade'     => strtoupper($this->input->post('skill4')[$key]),
					'user_id'   => login_details['user_id']
				);
				$this->alam->insert('discipline_grades',$insDataSkill4);
		}
	}
	
	public function co_scholastic_report_entry(){
		$data['classData'] = $this->alam->co_scholastic_grade_report();
		$this->render_template('marks_entry/co_scholastic_grade_entry_report',$data);
	}
}