<html>
  <head>
    <title>Report Card</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
	<style>
	 table tr th,td{
		font-size:12px!important;
		padding:3px!important;
		 border:1px!important;
	}
	@page { margin: 50px 12px 0px 12px; }
	.sign{
		font-family: 'Laila', serif;
		}
	</style>
  </head>
  
  <body>
	  <?php
		if(isset($result)){
			$j = 1;
			$tot_rec = count($result);
			foreach($result as $key => $data){
				
//echo '<pre>'; print_r($data); echo '</pre>';die;
		
				?>
			
				  <div style="border:5px solid #000; padding:10px;display:none" id='dyn_<?php echo $j;?>'>
				  
					<table style='border:none !important;' class='table'>
						<tr>
							<td>
								<img src="<?php echo $school_photo[0]->School_Logo; ?>" style="width:90px;">
							</td>
							<td>
								<center><span style='font-size:20px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br /
								>
								<span style='font-size:18px !important'>
								<?php echo $school_setting[0]->School_Address; ?>
								</span><br />
								<b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
								</span><br />
								<b>WEBSITE: https://davnrps.com</b>
								</center>
								
							</td>
							<td style='text-align:right'>
								<img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:90px;">
							</td>
						</tr>
						<tr>
							<td>
							<span style='font-size:13px !important'>Affiliation No.-
							<?php echo $school_setting[0]->School_AfftNo; ?></span>
							</td>
							<td>
							<b><center><span style='font-size:16px !important;'><b>REPORT CARD-MID TERM</b></span></center></b>
							</td>
							<td style='text-align:right'><span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span></td>
						</tr>
					</table>
				  
				  <table class='table'>
				    <tr>
					  <th>Admission No. :</th>
					  <td><?php echo $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j;?>'></td>
					  <th>Class-Sec:</th>
					  <td><?php echo $data['DISP_CLASS'] ." - " . $data['DISP_SEC']; ?></td>
					  <th>Roll No.</th>
					  <td><?php echo $data['ROLL_NO']; ?></td>
				    </tr>
					
					<tr>
					  <th>Student's Name :</th>
					  <td colspan='5'><?php echo $data['FIRST_NM'] . " " . $data['MIDDLE_NM']; ?></td>
					</tr>
					
					<tr>
					  <th>Mother's Name :</th>
					  <td colspan='5'><?php echo $data['MOTHER_NM']; ?></td>
					</tr>
					
					<tr>
					  <th>Father's Name :</th>
					  <td colspan='5'><?php echo $data['FATHER_NM']; ?></td>
					</tr>
					
					<tr>
					  <th>Date of Birth :</th>
					  <td colspan='2'><?php echo date('d-M-y',strtotime($data['BIRTH_DT'])); ?></td>
					  <th>Attendance :</th>
					  <td colspan='2'><?php echo $data['WORK_DAYS'];; ?></td>
					</tr>
				  </table>
				  <img src="<?php echo $school_photo[0]->School_Logo; ?>" style="position:absolute; right:20%; opacity:0.2; width:500px; z-index:33; border:none !important;">
				  <table class='table' border='1'>
					   <tr>
						
					  <th colspan='7'></th>
					</tr>
				    <tr>
						<th>Scholastic Areas :</th>
					  <th colspan='6'></th>
					</tr>
					<tr>
					 
						<th style="width:300px;">Subject Name</th>
					  <th><center> PERIODIC TEST <br /> (10)</center></th>
						 <th><center> NOTE BOOK <br /> (05)</center></th>
							 <th><center> SUBJECT  <br />ENRICHMENT (05)</center></th>
						<th><center> MID TERM <br /> (80)</center></th>
						<th><center> MARKS OBT. <br /> (100)</center></th>
						<th><center> GRADE</center></th>
					  
					</tr>
					<?php
					  $grnd_tot = 0;
					  $i = 0;
					?>
					<?php foreach($data['sub'] as $subject){ ?>
					<tr>
					  <th><?php echo $subject['subject_name']; ?></th>
					 <td>
					  <?php if($subject['opt_code'] != 1) { ?>
					   <center><?php echo $subject['marks']['pt']; ?></center>
					  <?php } ?> 
					  </td>
						
						 <td>
					  <?php if($subject['opt_code'] != 1) { ?>
					   <center><?php echo $subject['marks']['notebook']; ?></center>
					  <?php } ?> 
					  </td>
						
						 <td>
					  <?php if($subject['opt_code'] != 1) { ?>
					   <center><?php echo $subject['marks']['subject_enrichment']; ?></center>
					  <?php } ?> 
					  </td>
						
						
					  <td>
					  <?php if($subject['opt_code'] != 1) { ?>
					   <center><?php echo $subject['marks']['half_yearly']; ?></center>
					  <?php } ?> 
					  </td>
						
						 <td>
					 
					   <center><?php echo $subject['marks']['marks_obtained']; ?></center>
					 
					  </td>
						
						 <td>
					 
					   <center><?php echo $subject['marks']['grade']; ?></center>
					 
					  </td>
					 
					</tr>
					<?php
					if($subject['opt_code'] != 1){
					  $grnd_tot += $subject['marks']['marks_obtained']; 
                      $i +=1;					  
					}
					$grd = $grnd_tot/$i;
					$grd = ($round_off==1)?round($grd): number_format($grd,2);
					?>
					<?php } ?>
					
					<tr>
					<th  colspan='1' style="text-align:left">Percentage <?php echo': '. $grd; ?>%</th>
					  <th  colspan='4' style="text-align:right">Grand Total</th>
					  <td><center><?php echo $grnd_tot; ?></center></td>
					  <?php
					    $fin_grade = 0;
						foreach($grademaster as $key => $grade){
							if($grade->ORange >=$grd && $grade->CRange <=$grd){
								$fin_grade = $grade->Grade;
								break;
							}
						}
					  ?>
					   <td><center><?php echo $fin_grade; ?></center></td>
					</tr>
				  </table>
				  
				  
				  <div class='row'>
				    <div class='col-xs-8'>
					  <table class='table' border='1' style="width:100%">
						<tr>
						  <th colspan='2'></th>
						 
						</tr>

						  
						  <tr>
						  <th  border='1'!important;>Co-Scholastic Areas :</th>
						  <th style='text-align:center'>Grade</th>
						</tr>
						<tr>
						 <th>VALUE / VEDIC EDUCATION</th>
						 <td style='text-align:center'><?php echo $data['skill_5']; ?></td>
						</tr>
						<tr>
						 <th>WORK EDUCATION</th>
						 <td style='text-align:center'><?php echo $data['skill_1']; ?></td>
						</tr>
						<tr>
						 <th>ART EDUCATION</th>
						 <td style='text-align:center'><?php echo $data['skill_2']; ?></td>
						</tr>
						<tr>
						 <th>HEALTH & PHYSICAL EDUCATION</th>
						 <td style='text-align:center'><?php echo $data['skill_3']; ?></td>
						</tr>
						<?php if($report_card_type == 1){ ?>
						
						<tr>
						  <th>DISCIPLINE</th>
						  <td style='text-align:center'><?php echo $data['dis_grd']; ?></td>
						</tr>
						<?php }else{
							?>
							
							
							<?php
						} ?>
						<tr>
						  <td colspan='2' style='height:50px;'><b>Remarks:</b><br /><?php echo $data['rmks']; ?></td>
						</tr>
					  </table>
					</div>
					
					
				    <div class='col-xs-4'>
					  <div class='row'>
					    <div class='col-sm-12'>
						  <table>
						    <tr>
							  <td colspan='2' style="text-align:center; font-weight:bold">INSTRUCTIONS</td>
						    </tr>
							<tr>
							  <td colspan='2' style="text-align:center; font-weight:bold">Grading Scale for Scholastic Areas</td>
						    </tr>
							<tr>
							  <th style="text-align:center;">Marks Range</th>
							  <th style="text-align:center;">Grade</th>
							</tr>
							<tr>
							  <td style="text-align:center;">91 - 100</td>
							  <td style="text-align:center;">A1</td>
							</tr>
							<tr>
							  <td style="text-align:center;">81 - 90</td>
							  <td style="text-align:center;">A2</td>
							</tr>
							<tr>
							  <td style="text-align:center;">71 - 80</td>
							  <td style="text-align:center;">B1</td>
							</tr>
							<tr>
							  <td style="text-align:center;">61 - 70</td>
							  <td style="text-align:center;">B2</td>
							</tr>
							<tr>
							  <td style="text-align:center;">51 - 60</td>
							  <td style="text-align:center;">C1</td>
							</tr>
							<tr>
							  <td style="text-align:center;">41 - 50</td>
							  <td style="text-align:center;">C2</td>
							</tr>
							<tr>
							  <td style="text-align:center;">33 - 40</td>
							  <td style="text-align:center;">D</td>
							</tr>
							<tr>
							  <td style="text-align:center;">32 & Below</td>
							  <td style="text-align:center;">E</td>
							</tr>
						  </table>
						</div>
					  </div>
					</div>
				  </div><br />
					  
				  <div class='row'>
				    <div class='col-sm-12'>
				    <table class='table'>
					  <tr>
					  <td class='sign'><center>SIGNATURE OF CLASS TEACHER</center></td>
					  <td class='sign'><center>SIGNATURE OF PARENTS</center></td>
					  <td class='sign'><center>SIGNATURE OF PRINCIPAL</center></td>
					  </tr>
					  <tr>
					  <td><br/>Date of Result declaration: <?php echo date('d-M-y'); ?></td>
					  </tr>
				    </table>
					</div>
				  </div>
				  </div>
				  <?php if($tot_rec  > $j++) {?>
				  <div style='page-break-after: always;'></div>
				  <?php } ?>
				<?php
				?>
			
				<?php
			}
		}
	  ?>
	  
	<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-body">
				<center><img class='img-responsive' src="<?php echo base_url('assets/images/loading.gif'); ?>"></center>
			  </div>
			</div>
		  </div>
		</div>
	<!-- end Modal -->
  </body>
  
</html>
<script>
	var lp = '<?php echo $j; ?>';
	var lp = lp-1;
	$('#myModal').modal('show');
	for(var i=1; i<=lp; i++){
		var ab  = $("#dyn_"+i).html();
		var adm = $("#adm_"+i).val();
		$.ajax({	
		 url:"<?php echo base_url('report_card/report_card/adpdf')?>",
		 data:{'value':ab,'idd':i,'admno':adm,'lp':lp},
		 type:"POST",
		 success:function(data){
		 if(lp == data){
			$('#myModal').modal('hide');
			 $.toast({
				heading: 'Success',
				text: 'Successfully Genrated Report Card..!!',
				showHideTransition: 'slide',
				icon: 'success',
				position: 'top-right',
			});
			window.top.close();
			}
		 }	
		 });
	}	
</script>