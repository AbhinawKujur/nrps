<style>
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
	font-size:12px;
	padding:2px !important;
  }
</style>
<br />
<div class='table-responsive'>


<a target='_blank' href="<?php echo base_url('report_card/Report_card/tabulation_cmc_pdf/'.$trm.'/'.$term.'/'.$classs.'/'.$sec.'/'.$date.'/'.$round); ?>" class='btn btn-info'> <i class="fa fa-file-pdf-o"></i> PDF </a>

<button type='submit' class='btn btn-success' form='temp_save'><i class="fa fa-floppy-o" title='SAVE'></i></button><br /><br />

<form action='<?php echo base_url('report_card/Report_card_temp_save/save_temp_tbl'); ?>' method='post' id='temp_save'>
<table class='table' border='1'>
  <tr>
   <thead>
    <th style='background:#337ab7; color:#fff !important'>Adm No</th>
    <th style='background:#337ab7; color:#fff !important'>Stu Name</th>
    <th style='background:#337ab7; color:#fff !important'>Roll Name</th>
    <th style='background:#337ab7; color:#fff !important'>Exam Name</th>
	<?php
	  foreach($subject_list as $key => $subjdata){
		?>
		 <th style='background:#337ab7; color:#fff !important; text-align:center'><?php echo $subjdata['subj_nm']; ?><br /><span style='font-size:8px;'>(MO | WT)</span></th>
		 <input type='hidden' name='subj_nm[]' value='<?php echo $subjdata['subj_nm']; ?>'>
		<?php
	  }
	?>
	<th style='background:#337ab7; color:#fff !important'>Max Marks</th>
	<th style='background:#337ab7; color:#fff !important'>Total Marks</th>
	<th style='background:#337ab7; color:#fff !important'>Total Percent</th>
	<th style='background:#337ab7; color:#fff !important'>Grade</th>
	<th style='background:#337ab7; color:#fff !important'>Attendance</th>
   </thead>	
  </tr>
  <tbody>
  <tr>
  <input type='hidden' name='term' value='<?php echo $trm; ?>'>
    <?php
	  foreach($allData as $key => $data){
		   //for attendance //
		   $admnum = $data['ADM_NO'];
		   $stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
		   $att_type     = $stu_att_type[0]->attendance_type;
		   
			if($att_type == 1){
			  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date' AND att_status in('P','HD') AND admno='$admnum'");
			  
			  $tot_present_day = $attPresentData[0]->cnt;
							  
			}else{
			  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date' AND att_status='P' AND admno='$admnum'");
			  $tot_present_day = $attPresentData[0]->cnt;		
			}
			//end attendance //
		  ?>
		    <tr>
			  <td><?php echo $data['ADM_NO']; ?><input type='hidden' name='adm_no[]' value='<?php echo $data['ADM_NO']; ?>'></td>
			  <td><?php echo $data['FIRST_NM']; ?><input type='hidden' name='first_nm[]' value='<?php echo $data['FIRST_NM']; ?>'></td>
			  <td><?php echo $data['ROLL_NO']; ?><input type='hidden' name='roll_no[]' value='<?php echo $data['ROLL_NO']; ?>'>
			  <input type='hidden' name='class[]' value='<?php echo $data['DISP_CLASS']; ?>'>
			  <input type='hidden' name='sec[]' value='<?php echo $data['DISP_SEC']; ?>'>
			  </td>
			  <td colspan='13'></td>
			  <td>
			    <?php
				  $fin_wtg = array();
				  $totExamWetArr = 0;
				  $totMarksObtArr = 0;
				  foreach($data['exmaList'] as $key1 => $examdata){
					  ?>
					    <tr>
						  <td colspan='4' style='text-align:right'><?php echo $examdata; ?></td>
						   <?php
						        $i = 0;
						        $tot_wtg = 0;
								$totExamWet = 0;
								$tot_percent = 0;
								$optt_code = array();
								$is_display = array();
								foreach($data['marks'][$key1] as $key2 => $mrks){
									$i = $i + 1;
									if(!isset($fin_wtg[$i]))
									{
										$fin_wtg[$i] = 0;
									}

									$optt_code[$i] = $mrks['opt_code'];
									$is_display[$i] = $mrks['display'];

									if($mrks['opt_code'] != 1 && $mrks['display'] == 1){ //check for sub_option(2)
									  $tot_wtg += $mrks['wt'];
								      $totExamWet = $data['wetage'][$key1] + $totExamWet;
									?>
									<td>
									   <?php echo $mrks['mo']." | ".$mrks['wt']; ?>
									</td>

									<?php $fin_wtg[$i] += $mrks['wt'];
									}else{ ?>
									  <td></td>
									<?php 	
									}
								}
							?>
						  <td><?php echo $totExamWet; 
						  $totExamWetArr += $totExamWet;
						  ?></td>	
						  <td><?php echo $tot_wtg;
						  $totMarksObtArr += $tot_wtg;
						  ?></td>	
						  <td><?php echo $tot_percent = number_format($tot_wtg * 100 / $totExamWet,2); ?></td>
                          <td>
						    <?php
							  foreach($grade as $key3 => $val3){
								if($val3['ORange'] >=$tot_percent && $val3['CRange'] <=$tot_percent){
								echo $val3['Grade'];
								break;
							    }
							  }
							?>
						  </td>
                          <td></td>
					    </tr>
					  <?php
				  }
				?>
			  </td>
		    </tr>
			<tr>
			  <td colspan='4' style='text-align:right'>Total</td>
			  <?php
			    foreach($fin_wtg as $key4 => $val4){
					?>
					  <td><?php echo $val4; ?><input type='hidden' name='tot_mo[<?php echo $data['ADM_NO']; ?>][]' value='<?php echo $val4; ?>'></td>
					<?php
				}
			  ?>
			  <td><?php echo $totExamWetArr; ?></td>
			  <td style='background:#ece0e0;'><?php echo $totMarksObtArr; 
			  $fper = ($totMarksObtArr * 100)/ $totExamWetArr;
			  ?>
			  <input type='hidden' name='tot_wet_mrk[]' value='<?php echo $totMarksObtArr; ?>'>
			  </td>
			  <td><?php echo number_format($fper,2); ?>
			  <input type='hidden' name='tot_per[]' value='<?php echo number_format($fper,2); ?>'>
			  </td>
			  <td>
			  <?php
			   foreach($grade as $key5 => $val5){
				if($val5['ORange'] >=$fper && $val5['CRange'] <=$fper){
				echo $val5['Grade'];
				?>
				<input type='hidden' name='tot_grd[]' value='<?php echo $val5['Grade']; ?>'>
				<?php
				break;
				}
			   }
			  ?>
			  </td>
			  <td></td>
			</tr>
			<tr>
			  <td colspan='4' style='text-align:right'>Grade</td>
			  <?php
			    foreach($fin_wtg as $key5 => $val5){
					?>
					  <td>
					    <?php
						if($is_display[$key5] == 1){
						   foreach($grade as $key6 => $val6){
							if($val6['ORange'] >=$val5 && $val6['CRange'] <=$val5){
							echo $val6['Grade'];
							?>
							  <input type='hidden' name='grd[<?php echo $data['ADM_NO']; ?>][]' value='<?php echo $val6['Grade']; ?>'>
							<?php
							break;
							}
						   }
						}else{
							echo '-';
							?>
							  <input type='hidden' name='grd[<?php echo $data['ADM_NO']; ?>][]' value='-'>
							  <?php
						}
						?>
					  </td>
					<?php
				}
			  ?>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td><?php echo $tot_present_day."/".$tot_working_day; ?>
			  <input type='hidden' name='attendance[]' value='<?php echo $tot_present_day."/".$tot_working_day; ?>'>
			  </td>
			</tr>
		  <?php
	  }
	?> 
  </tr>
  </tbody>	
</table>
</form>
</div>