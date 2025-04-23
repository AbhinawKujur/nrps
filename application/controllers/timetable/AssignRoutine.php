<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssignRoutine extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');
	}
	public function index()
	{	
		$data['class_detail'] 	= $this->pawan->selectA('class_section_wise_subject_allocation','*',"1='1' group by Class_Sec_SubCode order by Class_Sec_SubCode asc");
		$data['week_detail'] 	= $this->pawan->selectA('tbl_week_master','*');
		$this->render_template1('timetable/assign_routine',$data);
	}

	public function subject_details()
	{
		 $class_id 	= $this->input->post('classid');
				
		$advbook 	= $this->pawan->selectA('class_section_wise_subject_allocation','*',"Class_Sec_SubCode='$class_id' and Total_Period_inWeek!=(select AssignTotal_Period where Class_Sec_SubCode='$class_id')");
		
		?>
		
		<select class="form-control" name="class_sec_id" required="" id="class_sec_id">
		<option value=" ">Select</option>
			<?php foreach ($advbook as $key => $value) { ?>
			  <option value="<?php echo $value['ID']; ?>"><?php echo $value['subj_nm']; ?></option>
			<?php } ?>
	    </select>
	  <?php
	}
	
	public function teacher_details()
	{
		$classec_id 		= $this->input->post('classecid');		
		$clas_sec_detail	= $this->pawan->selectA('class_section_wise_subject_allocation','*',"Class_Sec_SubCode='$classec_id' group by Class_Sec_SubCode");
		$classid			= $clas_sec_detail[0]['Class_No'];
		$sectionid			= $clas_sec_detail[0]['section_no'];
		$techername			= $this->pawan->selectA('login_details','user_id,emp_name',"Class_No='$classid' and Section_No='$sectionid'");	
		$teacher_name		= $techername[0]['emp_name'];
		$emp_id				= $techername[0]['user_id'];
		$subject_sec		= $this->pawan->selectA('class_section_wise_subject_allocation','*',"Class_Sec_SubCode='$classec_id'");
		/************************************************/
		$totalPeriodSumWithoutMerge = $this->sumit->fetchSingleData('SUM(Total_Period_inWeek)total_sum','class_section_wise_subject_allocation',"Class_No='$classid' AND section_no='$sectionid' AND Merged_WithSubCode=0");
		
		$totalPeriodSumWithMerge = $this->sumit->fetchAllData('Total_Period_inWeek,Merged_WithSubCode','class_section_wise_subject_allocation',"Class_No='$classid' AND section_no='$sectionid' AND Merged_WithSubCode != '0' GROUP BY Total_Period_inWeek,Merged_WithSubCode");
		
		
		$total = 0;
		if(!empty($totalPeriodSumWithMerge))
		{
			foreach ($totalPeriodSumWithMerge as $key => $value) {
				
				$total += $value['Total_Period_inWeek'];
			}
		}

		 $totalPeriodSumWithoutMerge = isset($totalPeriodSumWithoutMerge['total_sum'])?$totalPeriodSumWithoutMerge['total_sum']:0;
		$total_perod=$totalPeriodSumWithoutMerge + $total;
		/***********************************************/
		$html="";
		$html .=" <table class='table table-bordered dataTable table-striped'>
                      <thead style='background: #d2d6de;'>
                        <tr>
                          <th style='background: #337ab7; color: white !important;'>S.No.</th>
                          <th style='background: #337ab7; color: white !important;'>Subject</th>
                          <th style='background: #337ab7; color: white !important;'>Period</th>
                          <th style='background: #337ab7; color: white !important;'>Total Assign</th>                        
                        </tr>
                      </thead>
                      <tbody>";
	   $c=0;
	  // $tot_p=0;
	   foreach ($subject_sec as $key => $value) { 
	   //$tot_p=$tot_p+$value['Total_Period_inWeek'];
	   
	   if($value['Merged_WithSubCode'] != 0){
	   $html .="<tr style='background: #e89c84 !important; color: white !important;'>";
	   }elseif($value['Support_Teacher_Required'] != 0){ 
	   
	   $html .="<tr style='background: #ccd7e6 !important; color: white !important;'>";
	   }else{
	   $html .="<tr>"; }	   
	   $html .="<td style='border: 1px solid #b7b3b3;'>".++$c."</td>
		<td style='border: 1px solid #b7b3b3;'>".$value['Subject_Name_Dispaly']."</td>
		<td style='border: 1px solid #b7b3b3;'>".$value['Total_Period_inWeek']."</td>
		<td style='border: 1px solid #b7b3b3;'>".$value['AssignTotal_Period']."</td>
	   </tr>"; }
	   $html .="<tr><td colspan='2' style='border: 1px solid #b7b3b3;' align='center'><b>Total :</b></td><td style='border: 1px solid #b7b3b3;'><b>".$total_perod."</b></td><td style='border: 1px solid #b7b3b3;'></td></tr>"; 
	   $html .="</tbody></table>";
		$array = array($teacher_name,$emp_id,$html);	
		echo json_encode($array);
	}
	
	public function allotedteacher(){
		$subid				= $this->input->post('subid');	
		$subject_sec		= $this->pawan->selectA('class_section_wise_subject_allocation','*',"ID='$subid'");
		$class_id			= $subject_sec[0]['Class_No'];
		$section_id			= $subject_sec[0]['section_no'];
		$main_tech_req		= $subject_sec[0]['Main_Teacher_Required'];
		$sup_tech_req		= $subject_sec[0]['Support_Teacher_Required'];
		$main_tech_id		= $subject_sec[0]['Main_Teacher_Code']; //EMP_id
		$sup_tech_id		= $subject_sec[0]['Support_Teacher_Code']; //EMP_id
		$Merged_WithSubCode	= $subject_sec[0]['Merged_WithSubCode']; // Subject code 
		$Techr_Merge_C_Sta	= $subject_sec[0]['Teacher_Merge_Class_Status'];//  1 For merge
		$Techr_Merge_Class	= $subject_sec[0]['Teacher_Merge_Class_Details'];// Class code
		$merge_class_status = $subject_sec[0]['Merge_Class_Status'];
		$Merge_Class_Details= $subject_sec[0]['Merge_Class_Details'];			
		if($sup_tech_req==0){//check Support Teacher Required*****	
			if($Merged_WithSubCode>0){//Check Merged Subject Code********			
				$mainteacher = $this->pawan->selectA('class_section_wise_subject_allocation','Main_Teacher_Code,subj_nm',"Class_No='$class_id' and section_no='$section_id' and subject_code IN ($Merged_WithSubCode)");				
				$array_con=	 count($mainteacher);
				?>
						
				<table class="table table-bordered dataTable table-striped">
					  <thead style="background: #d2d6de;">
						<tr>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">S.No.</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Teacher Name</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Status</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Alloted</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Assign</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Bundal</th>
						</tr>						
					  </thead>
					  <tbody>
					  <?php
					  $array_teach=array();
					  $c=1;
					  for($i=0; $i<$array_con; $i++){
					  $teachercod  =$mainteacher[$i]['Main_Teacher_Code'];
					  $sub_name	   =$mainteacher[$i]['subj_nm'];
					  $array_teachs=$mainteacher[$i]['Main_Teacher_Code'];
					   array_push($array_teach,$array_teachs);
					  if($teachercod!=""){
					  	$mteacher_name	= $this->pawan->aloted_tech_list($teachercod);					  
					  ?>					  
						<tr>						
							<td style='border: 1px solid #b7b3b3;'><?=$c++?></td>
							<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name[0]['EMP_FNAME'];?> <?=$mteacher_name[0]['EMP_MNAME'];?> <?=$mteacher_name[0]['EMP_LNAME'];?></td>
							<td style='border: 1px solid #b7b3b3;'>MAIN TEACHER</td>
							<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name[0]['total_peri']?></td>
							<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name[0]['assign_tot']?></td>
							<td style='border: 1px solid #b7b3b3;'></td>
						</tr>
						<?php 
						}else{
						echo "<span style='color:red'>Please Assing Subject Teacher $sub_name</span><br>";
						"<input type='hidden' id='mg' value='1'>";
						}
						
						 }
						 $teacher_val=implode(',', $array_teach);
						 ?>					
						 <input type="hidden" name="teacher_codes" id="teacher_codes" value="<?=$teacher_val?>">
					  </tbody>
					</table>
					<?php							
			}else{			
		?>
			<table class="table table-bordered dataTable table-striped">
			  <thead style="background: #d2d6de;">
				<tr>
				  <th style="background: #337ab7; color: white !important;font-size: 10px;">S.No.</th>
				  <th style="background: #337ab7; color: white !important;font-size: 10px;">Teacher Name</th>
				  <th style="background: #337ab7; color: white !important;font-size: 10px;">Status</th>
				  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Alloted</th>
				  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Assign</th>
				  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Bundal</th>
				</tr>
			
			  </thead>
			  <tbody>
					<?php					
					$mteacher_name1	= $this->pawan->aloted_tech_list($main_tech_id);
					if(!empty($mteacher_name1)){
					?>			  
				<tr>						
					<td style='border: 1px solid #b7b3b3;'>1</td>
					<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name1[0]['EMP_FNAME'];?> <?=$mteacher_name1[0]['EMP_MNAME'];?> <?=$mteacher_name1[0]['EMP_LNAME'];?></td>
					<td style='border: 1px solid #b7b3b3;'>MAIN TEACHER</td>
					<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name1[0]['total_peri']?></td>
					<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name1[0]['assign_tot']?></td>
					<td style='border: 1px solid #b7b3b3;'></td>
				</tr>
				<?php 
				}else{
					echo "<span style='color:red'>Please Assing Subject Teacher</span>";
					"<input type='hidden' id='mg' value='1'>";
				} ?>
				 <input type="hidden" name="teacher_codes" id="teacher_codes" value="<?=$main_tech_id?>">
			  </tbody>
			</table>		
		<?php
		}
								
		
		}else{ 	
			if($merge_class_status==0){			
		?>
			<table class="table table-bordered dataTable table-striped">
					  <thead style="background: #d2d6de;">
						<tr>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">S.No.</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Teacher</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Status</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Alloted</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Assign</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Bundal</th>
						</tr>						
					  </thead>
					  <tbody>
					  		<?php
							
							if($main_tech_id!="" and $sup_tech_id!=""){ // Check Support Teacher And Main Teacher
								$mteacher_name1	= $this->pawan->aloted_tech_list($main_tech_id);
							?>			  
						<tr>						
							<td style='border: 1px solid #b7b3b3;'>1</td>
							<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name1[0]['EMP_FNAME'];?> <?=$mteacher_name1[0]['EMP_MNAME'];?> <?=$mteacher_name1[0]['EMP_LNAME'];?></td>
							<td style='border: 1px solid #b7b3b3;'>MAIN TEACHER</td>
							<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name1[0]['total_peri']?></td>
							<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name1[0]['assign_tot']?></td>
							<td style='border: 1px solid #b7b3b3;'></td>
						</tr>
						<?php
						$steacher_name	= $this->pawan->aloted_stech_list($sup_tech_id);						
						?>
						<tr>						
							<td style='border: 1px solid #b7b3b3;'>2</td>
							<td style='border: 1px solid #b7b3b3;'><?=$steacher_name[0]['EMP_FNAME'];?> <?=$steacher_name[0]['EMP_MNAME'];?> <?=$steacher_name[0]['EMP_LNAME'];?></td>
							<td style='border: 1px solid #b7b3b3;'>Support TEACHER</td>
							<td style='border: 1px solid #b7b3b3;'><?=$steacher_name[0]['total_peri']?></td>
							<td style='border: 1px solid #b7b3b3;'><?=$steacher_name[0]['assign_tot']?></td>
							<td style='border: 1px solid #b7b3b3;'></td>
						</tr>						
						<?php 
						}else{
							echo "<span style='color:red'>Please Assing Subject Teacher</span>";
								 "<input type='hidden' id='mg' value='1'>";
						}
						
						?>	
						<input type="hidden" name="teacher_codes" id="teacher_codes" value="<?=$main_tech_id.",".$sup_tech_id?>">						
					  </tbody>
					</table>	
			<?php }else{?>
			
					  <?php
					$mainteacher = $this->pawan->selectA('class_section_wise_subject_allocation','Main_Teacher_Code,Support_Teacher_Code,subj_nm',"Class_No='$class_id'  and Merge_Class_Details IN ($Merge_Class_Details)");				
				$array_con=	 count($mainteacher);
				?>
						
				<table class="table table-bordered dataTable table-striped">
					  <thead style="background: #d2d6de;">
						<tr>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">S.No.</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Teacher Name</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Status</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Alloted</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Assign</th>
						  <th style="background: #337ab7; color: white !important;font-size: 10px;">Total Bundal</th>
						</tr>						
					  </thead>
					  <tbody>
					  <?php
					  $array_teach=array();
					  $c=1;
					  for($i=0; $i<$array_con; $i++){
					  $teachercod  =$mainteacher[$i]['Main_Teacher_Code'];
					  $sub_name	   =$mainteacher[$i]['subj_nm'];
					  $array_teachs=$mainteacher[$i]['Main_Teacher_Code'];
					   array_push($array_teach,$array_teachs);
					  if($teachercod!=""){
					  	$mteacher_name	= $this->pawan->aloted_tech_list($teachercod);					  
					  ?>					  
						<tr>						
							<td style='border: 1px solid #b7b3b3;'><?=$c++?></td>
							<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name[0]['EMP_FNAME'];?> <?=$mteacher_name[0]['EMP_MNAME'];?> <?=$mteacher_name[0]['EMP_LNAME'];?></td>
							<td style='border: 1px solid #b7b3b3;'>MAIN TEACHER</td>
							<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name[0]['total_peri']?></td>
							<td style='border: 1px solid #b7b3b3;'><?=$mteacher_name[0]['assign_tot']?></td>
							<td style='border: 1px solid #b7b3b3;'></td>
						</tr>
						<?php
						}
						}
						$teacher_val=implode(',', $array_teach);
						$steacher_name	= $this->pawan->aloted_stech_list($sup_tech_id);						
						?>
						<tr>						
							<td style='border: 1px solid #b7b3b3;'><?=$c?></td>
							<td style='border: 1px solid #b7b3b3;'><?=$steacher_name[0]['EMP_FNAME'];?> <?=$steacher_name[0]['EMP_MNAME'];?> <?=$steacher_name[0]['EMP_LNAME'];?></td>
							<td style='border: 1px solid #b7b3b3;'>Support TEACHER</td>
							<td style='border: 1px solid #b7b3b3;'><?=$steacher_name[0]['total_peri']?></td>
							<td style='border: 1px solid #b7b3b3;'><?=$steacher_name[0]['assign_tot']?></td>
							<td style='border: 1px solid #b7b3b3;'></td>
						</tr>						
						
						<input type="text" name="teacher_codes" id="teacher_codes" value="<?=$teacher_val.",".$sup_tech_id?>">						
					  </tbody>
					</table>
			<?php 	
			}						
		
		}
				
		
	}
	
	public function period(){
		$class_sec_id	= $this->input->post('class_sec_id');
		$week_detail 	= $this->pawan->selectA('tbl_week_master','*');
		?>
			 <table class='table table-bordered table-striped'>
                <tr  style='font-size:14px'>
                  <td class='tab'></td>
                  <td class='tab'>PERIOD-1</td>
                  <td class='tab'>PERIOD-2</td>
                  <td class='tab'>PERIOD-3</td>
                  <td class='tab'>PERIOD-4</td>
                  <td class='tab'>PERIOD-5</td>
                  <td class='tab'>PERIOD-6</td>
                  <td class='tab'>PERIOD-7</td>
                  <td class='tab'>PERIOD-8</td>
				</tr>
                <tr>
                  <?php foreach ($week_detail as $key => $value) { ?>
                  <td class='tab'><?=$value['dayname']?></td>
                  <?php 
				  for($i=1; $i<=8; $i++){
					  $periodData = $this->pawan->selectA('class_time_table','period_'.$i,"Class_Sec_Code='$class_sec_id' and days='".$value['id']."'");
					  $per = (!empty($periodData[0]['period_'.$i]))?$periodData[0]['period_'.$i]:'';
				  ?>
                  <td style="width: 35vh;height: 12vh;"><b><?php if($per=='UNASSIGN'){ }else{echo $per;} ?></b></td>
                  <?php } ?>
				</tr>
                <?php }?>
			</table> 
		<?php
	}

/************************Assign Routine Start*******************************************/	
	
	public function assign_routin(){
		//$str			= $this->input->post('days');
		$class_sec_id1	= $this->input->post('class_sec_id');
		$subj_name		= $this->input->post('subj_name');
		$selection		= $this->input->post('selection');
		$select_period	= $this->input->post('select_period');
		$fixed_period	= $this->input->post('fixed_period');
		$fixed_period1	= (!empty($fixed_period[0]))?$fixed_period[0]:0; 	
		$teacher_codes	= $this->input->post('teacher_codes');		
		$teacer_arr		=  explode(',', $teacher_codes);
		$cla_sec_tbl	= $this->pawan->selectA('class_section_wise_subject_allocation','*',"ID='$subj_name'");	
		$main_tech_req		= (!empty($cla_sec_tbl[0]['Main_Teacher_Required']))?$cla_sec_tbl[0]['Main_Teacher_Required']:'';
		$Sub_Name_Dispaly	= (!empty($cla_sec_tbl[0]['Subject_Name_Dispaly']))?$cla_sec_tbl[0]['Subject_Name_Dispaly']:'';
		$Class_No			= (!empty($cla_sec_tbl[0]['Class_No']))?$cla_sec_tbl[0]['Class_No']:'';
		$section_no			= (!empty($cla_sec_tbl[0]['section_no']))?$cla_sec_tbl[0]['section_no']:'';
		$subject_code		= (!empty($cla_sec_tbl[0]['subject_code']))?$cla_sec_tbl[0]['subject_code']:'';			
		$Class_name_Roman	= (!empty($cla_sec_tbl[0]['Class_name_Roman']))?$cla_sec_tbl[0]['Class_name_Roman']:'';
		$sup_tech_req		= (!empty($cla_sec_tbl[0]['Support_Teacher_Required']))?$cla_sec_tbl[0]['Support_Teacher_Required']:'';
		$tot_period_wek		= (!empty($cla_sec_tbl[0]['Total_Period_inWeek']))?$cla_sec_tbl[0]['Total_Period_inWeek']:'';		
		$Merged_WithSubCode	= (!empty($cla_sec_tbl[0]['Merged_WithSubCode']))?$cla_sec_tbl[0]['Merged_WithSubCode']:'';		
		$tot_asi_period 	= (!empty($cla_sec_tbl[0]['AssignTotal_Period']))?$cla_sec_tbl[0]['AssignTotal_Period']:0;
		$main_teach			= (!empty($cla_sec_tbl[0]['Main_Teacher_Code']))?$cla_sec_tbl[0]['Main_Teacher_Code']:'';
		$sup_tech_id		= (!empty($cla_sec_tbl[0]['Support_Teacher_Code']))?$cla_sec_tbl[0]['Support_Teacher_Code']:''; 
		$Merge_Class_Status	= (!empty($cla_sec_tbl[0]['Merge_Class_Status']))?$cla_sec_tbl[0]['Merge_Class_Status']:'';
		$Merge_Class_Details= (!empty($cla_sec_tbl[0]['Merge_Class_Details']))?$cla_sec_tbl[0]['Merge_Class_Details']:''; 
		$teacher_count		= count($teacer_arr);
		$msg				="";
		$msg1				="";
		
		if($tot_period_wek>=$tot_asi_period){ //Total number of period must be less then or equal to Total Assign 
			if($selection==1){
				$teacher1=array();
				$teacher_free1=array();
				$priod_in_week	= $this->input->post('priod_in_week');
				if(!empty($priod_in_week)){
					$check_teacher_free1= 0;
					$teccod		=0;					 		
					for($i=1;$i<=$priod_in_week;$i++){
						$days_id	= $i; 
						//***Check Class Is free******
						$check_class=$this->pawan->numrows('class_time_table','*',"Class_Sec_Code='$class_sec_id1' and days='$days_id' and $select_period='UNASSIGN'");						
						if($check_class>0){
							for($t=0; $t<$teacher_count; $t++){
								$emp_cod	=$teacer_arr[$t];
								//***Check Teacher Is free******
								$check_teach=$this->pawan->numrows('teacher_time_table','*',"teacher_code='$emp_cod' and days='$days_id' and $select_period='FREE'");						
								$check_teacher_free1=$check_teach;
								$teccod=$emp_cod;
								array_push($teacher1,$teccod);
								array_push($teacher_free1,$check_teacher_free1);								
							}
							
						}else{						 
							$msg=1; 
						}					
					}
					
					if(in_array(0, $teacher_free1) or empty($teacher_free1)){
						if($msg1==1){
							$msg="Period Already assign ";
						}else{
							$msg="Teacher Not Free ";
						}
					}else{					
						
						if($sup_tech_req==0){
							if($Merged_WithSubCode==0){
								for($j=1;$j<=$priod_in_week;$j++){
									$day_id		= $j;
									$tech_name	=$this->pawan->selectA('employee','EMP_FNAME,EMP_MNAME,EMP_LNAME',"EMPID='$teccod'");							
									$name_teacher=$tech_name[0]['EMP_FNAME'].' '.$tech_name[0]['EMP_MNAME'].' '.$tech_name[0]['EMP_LNAME'];
									$sub_emp	=$Sub_Name_Dispaly.'/'.$name_teacher;
									$class_sub	=$Sub_Name_Dispaly.'/'.$Class_name_Roman;
									$upd=array(
									$select_period =>$sub_emp,
									);
									$assign_class=$this->pawan->update('class_time_table',$upd,"Class_Sec_Code='$class_sec_id1' and days='$day_id'");
									
									$upd1=array(
									$select_period =>$class_sub,
									);
									$assign_tech1=$this->pawan->update('teacher_time_table',$upd1,"teacher_code='$teccod' and days='$day_id'");
									
									$tot_asignperiod1=$this->pawan->selectA("class_section_wise_subject_allocation",'AssignTotal_Period',"ID='$subj_name'");
									$assign_period1=(!empty($tot_asignperiod1[0]['AssignTotal_Period']))?$tot_asignperiod1[0]['AssignTotal_Period']:0;
									
									$assign_peri1=$assign_period1+1;
									$upd3=array(
									'AssignTotal_Period' =>$assign_peri1,
									);
									$this->pawan->update('class_section_wise_subject_allocation',$upd3,"ID='$subj_name'");
									
								}
							}else{
								echo "merge Teacher";die;
							}
						}else{
/**************Support Teacher And Main Teacher Routine Assign********************/
							for($q=1;$q<=$priod_in_week;$q++){
								$day_id		= $q;
								$t_shrt_nm	=array();
								$techerr_count1=count($teacher);
								$class_sub	=$Sub_Name_Dispaly.'/'.$Class_name_Roman;
								for($d=0; $d<$techerr_count1; $d++){
									$teacher_code2=$teacher[$d];
									$tech_name1	=$this->pawan->selectA('employee','EMP_FNAME,EMP_MNAME,EMP_LNAME',"EMPID='$teacher_code2'");								
									$name_teacher1=$tech_name1[0]['EMP_FNAME'].' '.$tech_name1[0]['EMP_LNAME'];
									
									$upd1=array(
									$select_period =>$class_sub,
									);
									$assign_tech1=$this->pawan->update('teacher_time_table',$upd1,"teacher_code='$teacher_code2' and days='$day_id'");
									array_push($t_shrt_nm,$name_teacher1);						 
								}
								$name_teachern=implode(',', $t_shrt_nm);								
								$sub_emp	=$Sub_Name_Dispaly.'/'.$name_teachern;
								
								$upd=array(
								$select_period =>$sub_emp,
								);
								$assign_class=$this->pawan->update('class_time_table',$upd,"Class_Sec_Code='$class_sec_id1' and days='$day_id'");
								
								$tot_asignperiod=$this->pawan->selectA("class_section_wise_subject_allocation",'AssignTotal_Period',"ID='$subj_name'");
								$assign_period=(!empty($tot_asignperiod[0]['AssignTotal_Period']))?$tot_asignperiod[0]['AssignTotal_Period']:0;
								
								$assign_peri=$assign_period+1;
								$upd2=array(
								'AssignTotal_Period' =>$assign_peri,
								);
								$this->pawan->update('class_section_wise_subject_allocation',$upd2,"ID='$subj_name'");							
							}	
						}	
					
					}
				}
				
			}else{   
//*************************************Matrix Selection**********************************************
				$days	= $this->input->post('days');
				$teacher=array();
				$teacher_free=array();
				if(!empty($days)){
					$check_teacher_free	= 0;
					$teccod				= 0;
					$arrcon				= count($days);
					$arr_con			= $arrcon; 
					for($i=0;$i<$arr_con;$i++){
						$days_id	= $days[$i]; 
						//******************Check Class Is free***********************
						$check_class=$this->pawan->numrows('class_time_table','*',"Class_Sec_Code='$class_sec_id1' and days='$days_id' and $select_period='UNASSIGN'");						
						if($check_class>0){
							for($t=0; $t<$teacher_count; $t++){
								$emp_cod	=$teacer_arr[$t];
						//******************Check Teacher Is free*********************
								$check_teach=$this->pawan->numrows('teacher_time_table','*',"teacher_code='$emp_cod' and days='$days_id' and $select_period='FREE'");						
								$check_teacher_free=$check_teach;
								$teccod=$emp_cod;
								array_push($teacher,$teccod);
								array_push($teacher_free,$check_teacher_free);
							}							
						}else{
							 $msg1=1;
						}						
					}
					
					if(in_array(0, $teacher_free) or empty($teacher_free)){
						if($msg1==1){
							$msg="Period Already assign ";
						}else{
							$msg="Teacher Is Not Free ";
						}
					}else{						
						if($sup_tech_req==0){
							
							if($Merged_WithSubCode==0){
		/******************** Main Teacher Routine Assign************************/						
								for($j=0;$j<$arr_con;$j++){
									$day_id		= $days[$j];
									$tech_name	=$this->pawan->selectA('employee','EMP_FNAME,EMP_MNAME,EMP_LNAME',"EMPID='$teccod'");									
									$name_teacher=$tech_name[0]['EMP_FNAME'].' '.$tech_name[0]['EMP_MNAME'].' '.$tech_name[0]['EMP_LNAME'];
									
									$sub_emp	=$Sub_Name_Dispaly.'/'.$name_teacher;
									$class_sub	=$Sub_Name_Dispaly.'/'.$Class_name_Roman;
									$upd=array(
									$select_period =>$sub_emp,
									);
									$assign_class=$this->pawan->update('class_time_table',$upd,"Class_Sec_Code='$class_sec_id1' and days='$day_id'");
									
									$upd1=array(
									$select_period =>$class_sub,
									);
									$assign_tech=$this->pawan->update('teacher_time_table',$upd1,"teacher_code='$teccod' and days='$day_id'");

									$tot_asignperiod=$this->pawan->selectA("class_section_wise_subject_allocation",'AssignTotal_Period',"ID='$subj_name'");
									$assign_period=(!empty($tot_asignperiod[0]['AssignTotal_Period']))?$tot_asignperiod[0]['AssignTotal_Period']:0;
									
									$assign_peri=$assign_period+1;
									$upd2=array(
										'AssignTotal_Period' 	=>	$assign_peri,
									);
									$this->pawan->update('class_section_wise_subject_allocation',$upd2,"ID='$subj_name'");
									$inst=array(
										'class_sec_subcode'	=>	$class_sec_id1,	
										'class_id'			=>	$Class_No,
										'section_id'		=>	$section_no,
										'subject_id'		=>	$subject_code,
										'teacher_code'		=>	$teccod,
										'sts'				=>	0,
										'merged_sts'		=>	0,
										'periods'			=>	$select_period,
										'days'				=>	$day_id,
										'fixed_period'		=>	$fixed_period1,
									);	
									$this->pawan->insert('routine_master',$inst);								
								}
								
							}else{
								echo "merge Teacher";die;
							}
						
						}else{
							if($Merge_Class_Status==0)
							{
		/**************Support Teacher And Main Teacher Routine Assign********************/
									for($p=0;$p<$arr_con;$p++){
									$day_id		= $days[$p];
									$t_shrt_nm	=array();
									$techerr_count1=count($teacher);
									$class_sub	=$Sub_Name_Dispaly.'/'.$Class_name_Roman;
										for($d=0; $d<$techerr_count1; $d++){
											$teacher_code2=$teacher[$d];
											$tech_name1	=$this->pawan->selectA('employee','EMP_FNAME,EMP_MNAME,EMP_LNAME',"EMPID='$teacher_code2'");								
											$name_teacher1=$tech_name1[0]['EMP_FNAME'].' '.$tech_name1[0]['EMP_LNAME'];
											
											$upd1=array(
											$select_period =>$class_sub,
											);
											$assign_tech1=$this->pawan->update('teacher_time_table',$upd1,"teacher_code='$teacher_code2' and days='$day_id'");
											array_push($t_shrt_nm,$name_teacher1);						 
										}
										$name_teachern	=implode(',', $t_shrt_nm);								
										$sub_emp		=$Sub_Name_Dispaly.'/'.$name_teachern;
										
										$upd=array(
										$select_period =>$sub_emp,
										);
										$assign_class=$this->pawan->update('class_time_table',$upd,"Class_Sec_Code='$class_sec_id1' and days='$day_id'");
										
										$tot_asignperiod=$this->pawan->selectA("class_section_wise_subject_allocation",'AssignTotal_Period',"ID='$subj_name'");
										$assign_period=(!empty($tot_asignperiod[0]['AssignTotal_Period']))?$tot_asignperiod[0]['AssignTotal_Period']:0;
										
										$assign_peri=$assign_period+1;
										$upd2=array(
										'AssignTotal_Period' =>$assign_peri,
										);
										$this->pawan->update('class_section_wise_subject_allocation',$upd2,"ID='$subj_name'");	
									
								}								
							}else{
							
								$tch	=$this->pawan->selectA('class_section_wise_subject_allocation','*',"Merge_Class_Details='$Merge_Class_Details'");
								$secs	=array();
									foreach($tch as $key=>$vals){
										 array_push($secs,$vals['section_no']);
										 $Cid			= $vals['ID'];
										 $secid			= $vals['section_no'];
										 $teccod1		= $vals['Main_Teacher_Code'];
										 $teccod_s2		= $vals['Support_Teacher_Code'];
										 $class_sec_id2	= $vals['Class_Sec_SubCode'];
										
										for($j=0;$j<$arr_con;$j++){
										$day_id		= $days[$j];
										$tech_name	=$this->pawan->selectA('employee','EMP_FNAME,EMP_MNAME,EMP_LNAME',"EMPID='$teccod1'");									
										$name_teacher=$tech_name[0]['EMP_FNAME'].' '.$tech_name[0]['EMP_LNAME'];
										
										$tech_name1	=$this->pawan->selectA('employee','EMP_FNAME,EMP_MNAME,EMP_LNAME',"EMPID='$teccod_s2'");									
										$name_teachers=$tech_name1[0]['EMP_FNAME'].' '.$tech_name1[0]['EMP_LNAME'];
										
										$sub_emp	=$Sub_Name_Dispaly.'/'.$name_teacher.','.$name_teachers;
										$class_sub	=$Sub_Name_Dispaly.'/'.$Class_name_Roman;
										$upd=array(
										$select_period =>$sub_emp,
										);
										$assign_class=$this->pawan->update('class_time_table',$upd,"Class_Sec_Code='$class_sec_id2' and days='$day_id'");
										$upd1=array(
										$select_period =>$class_sub,
										);
										$assign_tech=$this->pawan->update('teacher_time_table',$upd1,"teacher_code='$teccod1' and days='$day_id'");
	
										$tot_asignperiod=$this->pawan->selectA("class_section_wise_subject_allocation",'AssignTotal_Period',"ID='$Cid'");
										$assign_period=(!empty($tot_asignperiod[0]['AssignTotal_Period']))?$tot_asignperiod[0]['AssignTotal_Period']:0;
										
										$assign_peri=$assign_period+1;
										$upd2=array(
											'AssignTotal_Period' 	=>	$assign_peri,
										);
										$this->pawan->update('class_section_wise_subject_allocation',$upd2,"ID='$Cid'");
										/*$inst=array(
											'class_sec_subcode'	=>	$class_sec_id2,	
											'class_id'			=>	$Class_No,
											'section_id'		=>	$section_no,
											'subject_id'		=>	$subject_code,
											'teacher_code'		=>	$teccod,
											'sts'				=>	0,
											'merged_sts'		=>	0,
											'periods'			=>	$select_period,
											'days'				=>	$day_id,
											'fixed_period'		=>	$fixed_period1,
										);	
										$this->pawan->insert('routine_master',$inst);*/								
									}
									
								}
								$sec_i		=  implode(",", $secs);
								$sec1		=	$this->pawan->selectA('sections','SECTION_NAME',"section_no IN ($sec_i)");
								$se_nam1		=array();
								foreach($sec1 as $key =>$val){
									$se_nam	=	$val['SECTION_NAME'];
									array_push($se_nam1,$se_nam);
								}
								//****************Mearge Support Teacher assign*************
								  $cl		=	explode("-",$Class_name_Roman);
								   $d		=	$cl[0];
								  $s		= 	implode("+", $se_nam1);
								  $k		= $d.'('.$d.')';							
								  $merg_sup	=	$vals['Support_Teacher_Code'];
								  for($h=0;$h<$arr_con;$h++){
									$day_id1	= $days[$h];
								  	$upd3		= array(
										$select_period 	=>	$s,
										);
										$this->pawan->update('teacher_time_table',$upd3,"teacher_code='$merg_sup' and days='$day_id1'");
								  }						
							}
						}
					}
					
				}	
			}
		}else{
			$msg="All Period Assign this teacher";
		}
					echo $msg;
		
	}
}
?>