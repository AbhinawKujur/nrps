<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamAtt extends MY_controller{
	
	public function __construct(){
		error_reporting(0);
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$this->render_template('exam_att/exam_att');
	}
	
	function getClass(){
		$user_id = login_details['user_id'];
		$session    = $this->input->post('val');
		$tbl = 'login_details';
		
		if(login_details['ROLE_ID'] == 2){
			$getClassT = $this->db->query("select Class_No,(select CLASS_NM from classes where Class_No=$tbl.Class_No)classnm from $tbl where user_id='$user_id'")->result_array();
			$class_id = $getClassT[0]['Class_No'];
			$classnm = $getClassT[0]['classnm'];
			
			?>
				<option value=''>Select</option>
				<option value='<?php echo $class_id; ?>'><?php echo $classnm; ?></option>
			<?php
		}else{
			$getClass = $this->db->query("SELECT DISTINCT(Class_No),(select CLASS_NM from classes where Class_No=$tbl.Class_No)classnm FROM $tbl WHERE Class_tech_sts='1' AND Class_No <> 0 ORDER BY Class_No")->result_array();
			?>
				<option value=''>Select</option>
			<?php
			foreach($getClass as $val){
				?>
					<option value='<?php echo $val['Class_No']; ?>'><?php echo $val['classnm'] ?></option>
				<?php
			}
		}
	}
	
	function getSection(){
		$user_id = login_details['user_id'];
		$session = $this->input->post('session');
		$class = $this->input->post('val');
		$tbl = 'login_details';
		
		if(login_details['ROLE_ID'] == 2){
			$getSecT = $this->db->query("select distinct(Section_No),(select SECTION_NAME from sections where section_no=$tbl.Section_No)secnm from $tbl where Class_No='$class' AND Class_tech_sts='1' AND Class_No <> 0 AND user_id='$user_id' order by Section_No")->result_array();
			?>
				<option value=''>Select</option>
			<?php
			foreach($getSecT as $val){
				?>
					<option value='<?php echo $val['Section_No']; ?>'><?php echo $val['secnm']; ?></option>
				<?php
			}
		}else{
			$getSec = $this->db->query("select distinct(Section_No),(select SECTION_NAME from sections where section_no=$tbl.Section_No)secnm from $tbl where Class_tech_sts='1' AND Class_No <> 0 order by Section_No")->result_array();
			?>
				<option value=''>Select</option>
			<?php
			foreach($getSec as $val){
				?>
					<option value='<?php echo $val['Section_No']; ?>'><?php echo $val['secnm'] ?></option>
				<?php
			}
		}
	}
	
	public function getStu(){
		$session = $this->input->post('session');
		$term    = $this->input->post('val');
		$classs  = $this->input->post('classs');
		$sec     = $this->input->post('sec');
		$stu_tbl = 'student';
		
		
		$get = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_ATT,MAY_ATT,JUNE_ATT,JULY_ATT,AUG_ATT,SEP_ATT,NOV_ATT from $stu_tbl where CLASS='$classs' AND SEC='$sec'  AND Student_Status='ACTIVE' order by ROLL_NO")->result_array();
		// echo '<pre>'; print_r($get); echo '</pre>';
		// die;
		?>
			<div class='table-responsive'>
			<table class='table'>
				<tr>
					<th style='background:#5785c3; color:#fff!important;'>Adm. No.</th>
					<th style='background:#5785c3; color:#fff!important;'>Name</th>
					<th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
					<th style='background:#5785c3; color:#fff!important;'>Attendance</th>
					<th style='background:#5785c3; color:#fff!important;'>Working Days</th>
					<th style='background:#5785c3; color:#fff!important;'>Promoted To</th>
				</tr>
				<?php
					foreach($get as $key => $val){
						if($term == 1){
							$tot_work = $val['APR_ATT'];
							$tot_present = $val['MAY_ATT'];
							$prom = $val['promot'];
						}elseif($term == 2){
							$tot_work = $val['JUNE_ATT'];
							$tot_present = $val['JULY_ATT'];
							$prom = $val['promot'];
						}
						elseif($term == 3){
							$tot_work = $val['AUG_ATT'];
							$tot_present = $val['SEP_ATT'];
							$prom = $val['promot'];
						}
					
					
						//die;
						?>
							<tr>
								<td><?php echo $val['ADM_NO']; ?></td>
								<td><?php echo $val['FIRST_NM']; ?></td>
								<td><?php echo $val['ROLL_NO']; ?></td>
								<td>
									<input value="<?php echo $tot_present ?>" onchange="totPresentByStu(this.value,'<?php echo $val['ADM_NO']; ?>','<?php echo $session; ?>','<?php echo $term; ?>','presentDays')" type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='attendance' class='attendance'>
								</td>
								<td>
									<input value="<?php echo $tot_work ?>" type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='workingDays' class='workingDays' onchange="totPresentByStu(this.value,'<?php echo $val['ADM_NO']; ?>','<?php echo $session; ?>','<?php echo $term; ?>','workingDays')">
								</td>
								
								<td>
									<input value="<?php echo $prom ?>" type='text' name='prom' class='prom' onchange="prom(this.value,'<?php echo $val['ADM_NO']; ?>','<?php echo $session; ?>','<?php echo $term; ?>','workingDays')">
								</td>
							</tr>
						<?php
					}
				?>
			</table>
			</div>
		<?php
	}
	
	function totWorkingDays(){
		$session = $this->input->post('session');
		$classs  = $this->input->post('classs');
		$sec     = $this->input->post('sec');
		$term    = $this->input->post('term');
		
		$enterTotWorkDays = $this->input->post('val');
		$stu_tbl = 'student';
		
		if($term == 1){
			$save['APR_ATT'] = $enterTotWorkDays;
		}else{
			$save['JUNE_ATT'] = $enterTotWorkDays;
		}
		
		$this->alam->update($stu_tbl,$save,"CLASS='$classs' AND SEC='$sec'");
		
	}
	
	
	function PROMOTED(){
		$session = $this->input->post('session');
		$classs  = $this->input->post('classs');
		$sec     = $this->input->post('sec');
		$term    = $this->input->post('term');	
		 $admno   = $this->input->post('admno');
		$val     = $this->input->post('val');
		$stu_tbl = 'student';
		
		$save['promot'] = $val;
			$this->alam->update("student",$save,"ADM_NO='$admno'");
		
	}
	
	public function totPresentDays(){
		$val     = $this->input->post('val');
		$admno   = $this->input->post('admno');
		$session = $this->input->post('session');
		$term    = $this->input->post('term');
		$types   = $this->input->post('types');
		$stu_tbl = 'student';
		
		
		if($term == 1){
			if($types == 'presentDays'){
				$save['MAY_ATT'] = $val;
			}else{
				$save['MAY_ATT'] = $val;
			}
		}elseif($term == 2){
			if($types == 'presentDays'){
				$save['JULY_ATT'] = $val;
			}else{
				$save['JULY_ATT'] = $val;
			}
		}
		
		elseif($term == 3){
			if($types == 'presentDays'){
				$save['SEP_ATT'] = $val;
			}else{
				$save['SEP_ATT'] = $val;
			}
		}
		
		$this->alam->update($stu_tbl,$save,"ADM_NO='$admno'");
	
	}
}