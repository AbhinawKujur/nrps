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
							<b><center><span style='font-size:16px !important;'>REPORT CARD</span></center></b>
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
					  <td colspan='2'><?php //echo $tot_present_day; ?><!--/--><?php //echo $tot_working_day; ?></td>
					</tr>
				  </table>
				  
				  <table class='table' border='1'>
				    <tr>
					  <th>Scholastic Areas :</th>
					  <th colspan='6'><center><?php if($trm == 1){echo "FIRST ";}else{echo "SECOND ";}?>TERMINAL EXAMINATION</center></th>
					</tr>
					<tr>
					  <th style="width:300px;">Subject Name</th>
					  <th><center> PERIODIC TEST <br /> (10)</center></th>
						 <th><center> NOTEBOOK <br /> (05)</center></th>
							 <th><center> SUBJECT  <br />ENRICHMENT (05)</center></th>
						<th><center> HALF YEARLY <br /> (80)</center></th>
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
					 
					  <th  colspan='5' style="text-align:right">Grand Total</th>
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
				  
				  
				  <br />
					  <br />
					  <br />
					  <br />
					  <br />
					  
				  <div class='row'>
				    <div class='col-sm-12'>
				    <table class='table'>
					  <tr>
					  <?php
					    foreach($signature as $key=> $val){
							if($val->SIGNATURE != '-'){
					  ?>
					    <td class='sign'>
						<center><?php echo $val->SIGNATURE; ?></center></td>
						<?php }} ?>	
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