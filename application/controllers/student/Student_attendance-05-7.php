<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Student_attendance extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		$this->load->library('Sms_lib','sms_lib');
	}
	
	public function index(){

		if(!in_array('viewDailyAttendance', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['log_cls_no'] = login_details['Class_No']; //9
		$data['log_sec_no'] = login_details['Section_No']; //2
		$data['log_role_id'] = login_details['ROLE_ID']; //2
		
		$wing = $this->alam->select('classes','wing_id',"Class_No='".login_details['Class_No']."'");
		$data['class_data'] = $this->alam->select('classes','*');
		$this->render_template('student/student_attendance',$data);
	}
	
	public function classes(){
		$ret      = '';
		$att_type = '';
		
		$class_nm = $this->input->post('val');
		$dt = $this->input->post('dt');
		$date = date('Y-m-d',strtotime($dt));
		
		$att_type_data = $this->alam->select('student_attendance_type','attendance_type',"class_code='$class_nm'");
		$att_type = $att_type_data[0]->attendance_type;
		
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		//echo $this->db->last_query();
		//die;
		
		$log_sec_no = login_details['Section_No'];
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 if($log_sec_no == $data->SEC){
				  $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
				 }
			}
		}
		
		$array = array($ret,$att_type);
		echo json_encode($array);
	}
	
	public function fetchData(){
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$dt       = $this->input->post('dt');
		$att_date = date('Y-m-d',strtotime($dt));
		$att_type = $this->input->post('att_type'); //1
		
		$stu_data = $this->alam->select('student','ADM_NO,TITLE_NM,FIRST_NM,MIDDLE_NM,ROLL_NO',"CLASS='$classs' AND SEC = '$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
		
		$holdy_data = $this->alam->select('holiday_master','DAY_TYPE,FROM_DATE,TO_DATE,APPLIED_FOR,CLASS_ID,NAME',"date(FROM_DATE) <= '$att_date' AND date(TO_DATE) >='$att_date' AND APPLIED_FOR IN (0,2)");

		// echo $this->db->last_query();die;
		
		@$name = $holdy_data[0]->NAME; 
		@$applied_for = $holdy_data[0]->APPLIED_FOR; 
		@$class_id = $holdy_data[0]->CLASS_ID; 
		@$from_date = $holdy_data[0]->FROM_DATE; 
		@$to_date = $holdy_data[0]->TO_DATE; 
		
		if(($applied_for == 2 && $class_id == 0 && date($from_date) <= $att_date && date($to_date) >= $att_date) || ($applied_for == 0 && $class_id == 0 && date($from_date) <= $att_date && date($to_date) >= $att_date))//all classes
		{
			echo "<h2 style='color:red; font-weight:bold'><center>HAPPY " .$name ."</center></h2>";
		}
		else if($applied_for == 2 && $class_id != 0 && date($from_date) <= $att_date && date($to_date) >= $att_date && $class_id == $classs)//particular classes
		{
			echo "<h2 style='color:red; font-weight:bold'><center>HAPPY " .$name ."</center></h2>";
		}
		else
		{
		if($att_type == 1){
		?>
		<div class='table-responsive'>
		  <table class='table'>
		    <tr>
			  <th style="background:#337ab7; color:#fff !important">Adm No.</th>
			  <th style="background:#337ab7; color:#fff !important">Roll No</th>
			  <th style="background:#337ab7; color:#fff !important">Student Name</th>
			  <th style="background:#337ab7; color:#fff !important">Attendance</th>
		    </tr>
			<input type="hidden" name='classs' value='<?php echo $classs; ?>'>
	        <input type="hidden" name='sec' value='<?php echo $sec; ?>'>
	        <input type="hidden" name='dt' value='<?php echo $dt; ?>'>
		<?php
		foreach($stu_data as $key => $data){
			$exist_dataa = $this->alam->select('stu_attendance_entry','att_status,remarks',"admno='$data->ADM_NO' AND att_date='$att_date'");
			

			$cntt = count($exist_dataa);
			// echo $cntt;die;
			@$att_status = $exist_dataa[0]->att_status;
			@$remarks    = $exist_dataa[0]->remarks;
		?>
		  <tr>
		    <td><?php echo $data->ADM_NO; ?></td>
			<td><?php echo $data->ROLL_NO; ?></td>
		    <td><?php echo $data->TITLE_NM ." " . $data->FIRST_NM . " ". $data->MIDDLE_NM; ?></td>
			<?php
			  if($cntt == 0){
				
			?>
		    <td>
			  <label><input type='radio' name='dwa_<?php echo $key; ?>' id='present' value='P' onclick="hd('P',<?php echo $key; ?>)" checked> <span style='color:green'><b>P</b></span></label>&nbsp;&nbsp;&nbsp;
			  <label><input type='radio' name='dwa_<?php echo $key; ?>' id='absent' value='A' onclick="hd('A',<?php echo $key; ?>)"> <span style='color:red'><b>A</b></span></label>&nbsp;&nbsp;&nbsp;
			  <label><input type='radio' name='dwa_<?php echo $key; ?>' id='halfday' value='HD'onclick="hd('HD',<?php echo $key; ?>)"> <span style='color:orange'><b>HD</b></span></label>
			  <span style="display:none;" id="key_<?php echo $key; ?>"><textarea name='hdrmk_<?php echo $key; ?>' class='form-control' placeholder='Remarks' style='width:120px;'></textarea></span>
			</td>
			  <?php } else{
				
				?>
				<td>
				  <label><input type='radio' name='dwa_<?php echo $key; ?>' id='present' value='P' onclick="hd('P',<?php echo $key; ?>)" <?php if($att_status == 'P'){ echo "checked"; }?>> <span style='color:green'><b>P</b></span></label>&nbsp;&nbsp;&nbsp;
				  <label><input type='radio' name='dwa_<?php echo $key; ?>' id='absent' value='A' onclick="hd('A',<?php echo $key; ?>)" <?php if($att_status == 'A'){ echo "checked"; }?>> <span style='color:red'><b>A</b></span></label>&nbsp;&nbsp;&nbsp;
				  <label><input type='radio' name='dwa_<?php echo $key; ?>' id='halfday' value='HD'onclick="hd('HD',<?php echo $key; ?>)" <?php if($att_status == 'HD'){ echo "checked"; }?>> <span style='color:orange'><b>HD</b></span></label>
				  <?php 
				    if($att_status == 'HD'){
				  ?>
				  <span id="key_<?php echo $key; ?>"><textarea name='hdrmk_<?php echo $key; ?>' class='form-control' placeholder='Remarks' style='width:120px;'><?php echo $remarks; ?></textarea></span>
				  <?php }else{
					?>
					<span style="display:none;" id="key_<?php echo $key; ?>"><textarea name='hdrmk_<?php echo $key; ?>' class='form-control' placeholder='Remarks' style='width:120px;'></textarea></span>
                    <?php					
				  } ?>
				</td>  
				<?php
			  }?>
		  </tr>
        <?php		
		}
		?>
		 <tr>
		   <td colspan='4' align='center'><button type="button" id="dwa_btn" class='btn btn-success' onclick='att_temp_save()'>verify</button></td>
		   
		 </tr>
		</table>
		</div>
	    <?php
		}else{
			
			$period_pwa_data = $this->alam->select('stu_attendance_entry_periodwise','distinct(period)',"class_code='$classs' AND sec_code='$sec' AND att_date='$att_date'");
			@$period = $period_pwa_data[0]->period;
		  ?>
		  <div class='table-responsive'>
		  <table class='table'>
		    <tr>
			  <th>Class Period</th>
			  <td colspan='3'>
			    <select class="form-control" name='period' id='period' onchange='cls_period(this.value)'>
				  <option value=''>Select</option>
				  <option value='1' <?php if($period == 1){ echo "selected"; } ?>>1</option>
				  <option value='2' <?php if($period == 2){ echo "selected"; } ?>>2</option>
				  <option value='3' <?php if($period == 3){ echo "selected"; } ?>>3</option>
				  <option value='4' <?php if($period == 4){ echo "selected"; } ?>>4</option>
				  <option value='5' <?php if($period == 5){ echo "selected"; } ?>>5</option>
				  <option value='6' <?php if($period == 6){ echo "selected"; } ?>>6</option>
				  <option value='7' <?php if($period == 7){ echo "selected"; } ?>>7</option>
				  <option value='8' <?php if($period == 8){ echo "selected"; } ?>>8</option>
			    </select>
			  </td>
		    </tr>
		    <tr>
			  <th style="background:#337ab7; color:#fff !important">Adm No.</th>
			  <th style="background:#337ab7; color:#fff !important">Roll No</th>
			  <th style="background:#337ab7; color:#fff !important">Student Name</th>
			  <th style="background:#337ab7; color:#fff !important">Attendance</th>
		    </tr>
			<input type="hidden" name='classs' value='<?php echo $classs; ?>'>
	        <input type="hidden" name='sec' value='<?php echo $sec; ?>'>
	        <input type="hidden" name='dt' value='<?php echo $dt; ?>'>
			<?php
			foreach($stu_data as $key => $data){
				$exist_dataa = $this->alam->select('stu_attendance_entry_periodwise','att_status,period',"admno='$data->ADM_NO' AND att_date='$att_date'");
			    $cntt = count($exist_dataa);
			    @$att_status = $exist_dataa[0]->att_status;
			    @$period     = $exist_dataa[0]->period;
			?>
			
			  <tr>
				<td><?php echo $data->ADM_NO; ?></td>
				<td><?php echo $data->ROLL_NO; ?></td>
				<td><?php echo $data->TITLE_NM ." " . $data->FIRST_NM . " ". $data->MIDDLE_NM; ?></td>
				
				<?php
				  if($cntt == 0){
				?>
				<td>
				 <label><input type='radio' name='pwa_<?php echo $key; ?>' id='present' value='P' checked> <span style='color:green'><b>P</b></span></label>&nbsp;&nbsp;&nbsp;
			     <label><input type='radio' name='pwa_<?php echo $key; ?>' id='absent' value='A'> <span style='color:red'><b>A</b></span></label>
				</td>
				<?php } else{ ?>
				<td>
				 <label><input type='radio' name='pwa_<?php echo $key; ?>' id='present' value='P' checked> <span style='color:green' <?php if($att_status == 'P'){ echo "checked"; }?>><b>P</b></span></label>&nbsp;&nbsp;&nbsp;
			     <label><input type='radio' name='pwa_<?php echo $key; ?>' id='absent' value='A' <?php if($att_status == 'A'){ echo "checked"; }?>> <span style='color:red'><b>A</b></span></label>
				</td>
				<?php } ?>
			  </tr>
			<?php		
			}
			?>
			 <tr>
			   <td colspan='4' align='center'><button type="button" id='pwa_btn' class='btn btn-success' onclick='att_temp_save_period()'>verify</button></td>
			 </tr>
		   </table>
		   </div>
	    <?php	
		}
		}
	}
	
	
	function att_temp_save(){
		$this->db->query("delete from att_temp_save where user_id='".login_details['user_id']."'");
		$classs = $this->input->post('classs');
		$sec    = $this->input->post('sec');
		$dt     = $this->input->post('dt');
		$att_date = date('Y-m-d',strtotime($dt));
		
		$stu_data = $this->alam->select('student','ADM_NO,TITLE_NM,FIRST_NM,MIDDLE_NM,ROLL_NO,C_MOBILE',"CLASS='$classs' AND SEC = '$sec' AND Student_Status='ACTIVE' order by ROLL_NO");

			foreach($stu_data as $key => $data){
				$name = $data->FIRST_NM;
				$roll = $data->ROLL_NO;
				$ins_data = array(
				 'name'       => $name,
				 'roll'   => $roll,
				 'admno'      => $data->ADM_NO,
				 'user_id' => login_details['user_id'],
				);
				
				if($this->input->post('dwa_'.$key) == 'A'){
					$this->alam->insert('att_temp_save',$ins_data);
				}			
			}
			$temdata = $this->alam->selectA('att_temp_save','*',"user_id='".login_details['user_id']."'");
			if(!empty($temdata)){  
			?> 
				<table class='table'>
					<tr>
						<th>Adm No</th>
						<th>Roll</th>
						<th>Name</th>
					</tr>
					<?php
						foreach($temdata as $key => $val){
							?>
								<tr>
									<td><?php echo $val['admno']; ?></td>
									<td><?php echo $val['roll']; ?></td>
									<td><?php echo $val['name']; ?></td>
								</tr>
							<?php
						}
					?>
				</table>
			<?php
			}else{
				echo "<h3>No any one absent</h3>";
			}
	}
	
	function att_temp_save_period(){
		$this->alam->delete('att_temp_save');
		$classs = $this->input->post('classs');
		$sec    = $this->input->post('sec');
		$dt     = $this->input->post('dt');
		$att_date = date('Y-m-d',strtotime($dt));
		
		$stu_data = $this->alam->select('student','ADM_NO,TITLE_NM,FIRST_NM,MIDDLE_NM,ROLL_NO,C_MOBILE',"CLASS='$classs' AND SEC = '$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			foreach($stu_data as $key => $data){
				$name = $data->FIRST_NM;
				$roll = $data->ROLL_NO;
				$ins_data = array(
				 'name'  => $name,
				 'roll'  => $roll,
				 'admno' => $data->ADM_NO
				);
				
				if($this->input->post('pwa_'.$key) == 'A'){
					$this->alam->insert('att_temp_save',$ins_data);
				}			
			}
			$temdata = $this->alam->selectA('att_temp_save','*');
			if(!empty($temdata)){  
			?> 
				<table class='table'>
					<tr>
						<th>Adm No</th>
						<th>Roll</th>
						<th>Name</th>
					</tr>
					<?php
						foreach($temdata as $key => $val){
							?>
								<tr>
									<td><?php echo $val['admno']; ?></td>
									<td><?php echo $val['roll']; ?></td>
									<td><?php echo $val['name']; ?></td>
								</tr>
							<?php
						}
					?>
				</table>
			<?php
			}else{
				echo "<h3>No any one absent</h3>";
			}
	}
	
	public function att_sv_upd(){
		// $template_id = '1407165631478222047';
		$template_id = '1407166685533890450';
		
		$classs = $this->input->post('classs');
		$sec    = $this->input->post('sec');
		$dt     = $this->input->post('dt');
		$att_date = date('Y-m-d',strtotime($dt));
		// die;
		$exist_data = $this->alam->select('stu_attendance_entry','count(*)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date='$att_date'");
		$cnt = $exist_data[0]->cnt;

		if($cnt == 0){
			$stu_data = $this->alam->select('student','ADM_NO,TITLE_NM,FIRST_NM,MIDDLE_NM,ROLL_NO,C_MOBILE',"CLASS='$classs' AND SEC = '$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			foreach($stu_data as $key => $data){
				$ins_data = array(
				 'class_code' => $classs,
				 'sec_code'   => $sec,
				 'admno'      => $data->ADM_NO,
				 'att_status' => $this->input->post('dwa_'.$key),
				 'att_date'   => $att_date,
				 'remarks'    => $this->input->post('hdrmk_'.$key),
				);

				$this->alam->insert('stu_attendance_entry',$ins_data);
				
				if($this->input->post('dwa_'.$key) == 'A'){

					$message = "Dear Parents, Your Ward ".$data->FIRST_NM ." ".$data->MIDDLE_NM ." ".$data->TITLE_NM ." is absent today ".$att_date.". Regards, DAV NRPS";

					$mobile = $data->C_MOBILE;
					
					if($mobile != 'N/A'){
						$this->sms_lib->sendSMS($mobile,$message,$template_id);
					}
				}
			}
		}
		else{
			$stu_data = $this->alam->select('student','ADM_NO,TITLE_NM,FIRST_NM,MIDDLE_NM,ROLL_NO',"CLASS='$classs' AND SEC = '$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			foreach($stu_data as $key => $data){
				$upd_data = array(
				 'class_code' => $classs,
				 'sec_code' => $sec,
				 'admno' => $data->ADM_NO,
				 'att_status' => $this->input->post('dwa_'.$key),
				 'att_date' => $att_date,
				 'remarks' => $this->input->post('hdrmk_'.$key),
				);
				$this->alam->update('stu_attendance_entry',$upd_data,"admno='$data->ADM_NO' AND att_date='$att_date'");
			}
		}
	}
	
	public function att_sv_upd_periodwise(){
		$template_id = '1407166685533890450';
		$period   = $this->input->post('period');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$dt       = $this->input->post('dt');
		$att_date = date('Y-m-d',strtotime($dt));
		
		$exist_data = $this->alam->select('stu_attendance_entry_periodwise','count(*)cnt,period',"class_code='$classs' AND sec_code='$sec' AND att_date='$att_date' AND period = '$period'");
		$prd = $exist_data[0]->period;
		$cnt = $exist_data[0]->cnt;
		if($cnt == 0 && $prd != $period){
			$stu_data = $this->alam->select('student','ADM_NO,TITLE_NM,FIRST_NM,MIDDLE_NM,ROLL_NO,C_MOBILE',"CLASS='$classs' AND SEC = '$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			foreach($stu_data as $key => $data){
				$ins_data = array(
				 'class_code' => $classs,
				 'sec_code'   => $sec,
				 'admno'      => $data->ADM_NO,
				 'att_status' => $this->input->post('pwa_'.$key),
				 'period'     => $period,
				 'att_date'   => $att_date
				);
				
				$this->alam->insert('stu_attendance_entry_periodwise',$ins_data);
				
				if($this->input->post('pwa_'.$key) == 'A'){
					if(strtotime($att_date) == strtotime(date('Y-m-d'))){
					 $message = "Dear Parent, Your Ward ".$data->FIRST_NM ." ".$data->MIDDLE_NM ." ".$data->TITLE_NM ." is absent today (".$att_date.") . ".schoolData['short_nm'];
					}else{
					 $message = "Dear Parent, Your Ward ".$data->FIRST_NM ." ".$data->MIDDLE_NM ." ".$data->TITLE_NM ." was absent (".$att_date.") . ".schoolData['short_nm'];	
					}
					$mobile = $data->C_MOBILE;
					
					if($mobile != 'N/A'){
						$this->sms_lib->sendSms($mobile,$message,$template_id);
					}
				}
			}
		}else{
			$stu_data = $this->alam->select('student','ADM_NO,TITLE_NM,FIRST_NM,MIDDLE_NM,ROLL_NO',"CLASS='$classs' AND SEC = '$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			foreach($stu_data as $key => $data){
				$upd_data = array(
				 'class_code' => $classs,
				 'sec_code'   => $sec,
				 'admno'      => $data->ADM_NO,
				 'att_status' => $this->input->post('pwa_'.$key),
				 'period'     => $period,
				 'att_date'   => $att_date
				);
				
				$this->alam->update('stu_attendance_entry_periodwise',$upd_data,"admno='$data->ADM_NO' AND att_date='$att_date' AND period='$period'");
			}
		}
	}
	
	public function fetch_period(){
		$cls_period = $this->input->post('cls_period');
		@$class_copy = $cls_period - 1;
		@$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$dt         = $this->input->post('dt');
		$att_date   = date('Y-m-d',strtotime($dt));
		?>
		<div class='table-responsive'>
		  <table class='table'>
		    <tr>
			  <th>Class Period</th>
			  <td colspan='3'>
			    <select class="form-control" name='period' id='period' onchange='cls_period(this.value)'>
				  <option value=''>Select</option>
				  <option value='1' <?php if($cls_period == 1){ echo "selected"; } ?>>1</option>
				  <option value='2' <?php if($cls_period == 2){ echo "selected"; } ?>>2</option>
				  <option value='3' <?php if($cls_period == 3){ echo "selected"; } ?>>3</option>
				  <option value='4' <?php if($cls_period == 4){ echo "selected"; } ?>>4</option>
				  <option value='5' <?php if($cls_period == 5){ echo "selected"; } ?>>5</option>
				  <option value='6' <?php if($cls_period == 6){ echo "selected"; } ?>>6</option>
				  <option value='7' <?php if($cls_period == 7){ echo "selected"; } ?>>7</option>
				  <option value='8' <?php if($cls_period == 8){ echo "selected"; } ?>>8</option>
			    </select>
			  </td>
		    </tr>
		    <tr>
			  <th style="background:#337ab7; color:#fff !important">Adm No.</th>
			  <th style="background:#337ab7; color:#fff !important">Roll No</th>
			  <th style="background:#337ab7; color:#fff !important">Student Name</th>
			 
			  <th style="background:#337ab7; color:#fff !important">Attendance</th>
		    </tr>
			<input type="hidden" name='classs' value='<?php echo $classs; ?>'>
	        <input type="hidden" name='sec' value='<?php echo $sec; ?>'>
	        <input type="hidden" name='dt' value='<?php echo $dt; ?>'>
			<?php
			$stu_data = $this->alam->select('student','ADM_NO,TITLE_NM,FIRST_NM,MIDDLE_NM,ROLL_NO',"CLASS='$classs' AND SEC = '$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			
			foreach($stu_data as $key => $data){
				$exist_dataa = $this->alam->select('stu_attendance_entry_periodwise','att_status,period',"admno='$data->ADM_NO' AND att_date='$att_date' AND period='$cls_period'");
			    $cntt = count($exist_dataa);
			    @$att_status = $exist_dataa[0]->att_status;
			    @$period     = $exist_dataa[0]->period;
				
				$exist_dataa_copy = $this->alam->select('stu_attendance_entry_periodwise','att_status,period',"admno='$data->ADM_NO' AND att_date='$att_date' AND period='1'");
				@$att_status_copy = $exist_dataa_copy[0]->att_status;
			?>
			
			  <tr>
				<td><?php echo $data->ADM_NO; ?></td>
				<td><?php echo $data->ROLL_NO; ?></td>
				<td><?php echo $data->TITLE_NM ." " . $data->FIRST_NM . " ". $data->MIDDLE_NM; ?></td>
				
				<?php
				  if($cntt == 0){
				?>
				<td>
				<?php
				  if($att_status_copy == 'P' || $cls_period == 1){
				?>
				 <label><input type='radio' name='pwa_<?php echo $key; ?>' id='present' value='P' checked> <span style='color:green'><b>P</b></span></label>
				<?php }else{ ?>
				 <label><input type='radio' name='pwa_<?php echo $key; ?>' id='present' value='P'> <span style='color:green'><b>P</b></span></label>
				<?php } ?>
				 &nbsp;&nbsp;&nbsp;
				<?php
				  if($att_status_copy == 'A'){
				?>
			     <label><input type='radio' name='pwa_<?php echo $key; ?>' id='absent' value='A' checked> <span style='color:red'><b>A</b></span></label>
				<?php } else { ?>
				<label><input type='radio' name='pwa_<?php echo $key; ?>' id='absent' value='A'> <span style='color:red'><b>A</b></span></label>
				<?php } ?>
				</td>
				<?php } else{ ?>
				<td>
				 <label><input type='radio' name='pwa_<?php echo $key; ?>' id='present' value='P' checked> <span style='color:green' <?php if($att_status == 'P'){ echo "checked"; }?>><b>P</b></span></label>&nbsp;&nbsp;&nbsp;
			     <label><input type='radio' name='pwa_<?php echo $key; ?>' id='absent' value='A' <?php if($att_status == 'A'){ echo "checked"; }?>> <span style='color:red'><b>A</b></span></label>
				</td>
				<?php } ?>
			  </tr>
			<?php		
			}
			?>
			 <tr>
			   <td colspan='4' align='center'><button type="button" id='pwa_btn' class='btn btn-success' onclick='att_temp_save_period()'>verify</button></td>
			 </tr>
		   </table>
		   </div>
		<?php
	}
}
