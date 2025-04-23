<?php
 	if($student_data)
 	{
 		$adm_date = $student_data[0]->ADM_DATE;
 		$adm_no = $student_data[0]->ADM_NO;
 		$FIRST_NM = $student_data[0]->FIRST_NM;
 		$STUDENTID = $student_data[0]->STUDENTID;
 		$FATHER_NM = $student_data[0]->FATHER_NM;
 		$MOTHER_NM = $student_data[0]->MOTHER_NM;
 		$DISP_CLASS = $student_data[0]->DISP_CLASS;
 		$DISP_SEC = $student_data[0]->DISP_SEC;
 		$ROLL_NO = $student_data[0]->ROLL_NO;
 		$EMP_WARD = $student_data[0]->HOUSENAME;
 		$STOPNO = $student_data[0]->STOPPAGE;
 		$STOPNO_AMT = $student_data[0]->AMT;
 		$APR_FEE = $student_data[0]->APR_FEE;
 		$MAY_FEE = $student_data[0]->MAY_FEE;
 		$JUNE_FEE = $student_data[0]->JUNE_FEE;
 		$JULY_FEE = $student_data[0]->JULY_FEE;
 		$AUG_FEE = $student_data[0]->AUG_FEE;
 		$SEP_FEE = $student_data[0]->SEP_FEE;
 		$OCT_FEE = $student_data[0]->OCT_FEE;
 		$NOV_FEE = $student_data[0]->NOV_FEE;
 		$DEC_FEE = $student_data[0]->DEC_FEE;
 		$JAN_FEE = $student_data[0]->JAN_FEE;
 		$FEB_FEE = $student_data[0]->FEB_FEE;
 		$MAR_FEE = $student_data[0]->MAR_FEE;
		//=======================//
		$FEE[0] = $student_data[0]->APR_FEE;
 		$FEE[1] = $student_data[0]->MAY_FEE;
 		$FEE[2] = $student_data[0]->JUNE_FEE;
 		$FEE[3] = $student_data[0]->JULY_FEE;
 		$FEE[4] = $student_data[0]->AUG_FEE;
 		$FEE[5] = $student_data[0]->SEP_FEE;
 		$FEE[6] = $student_data[0]->OCT_FEE;
 		$FEE[7] = $student_data[0]->NOV_FEE;
 		$FEE[8] = $student_data[0]->DEC_FEE;
 		$FEE[9] = $student_data[0]->JAN_FEE;
 		$FEE[10] = $student_data[0]->FEB_FEE;
 		$FEE[11] = $student_data[0]->MAR_FEE;
		//=======================//

 		$clssec = $DISP_CLASS."-".$DISP_SEC;

 	}
	$val = array('APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB','MAR');
	$id = array('apr','may','jun','jul','aug','sep','oct','nov','dec','jan','feb','mar');
?>
<form id='student_details'>
	<div class="row">
		<!--<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Receipt No</label>
			<input type="text" class="form-control" readonly name="rcpt_no" id="rcpt_no" value="<?php //echo $reciptno; ?>">
		</div>-->
		<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Receipt Date</label>
			<input type="text" class="form-control" name="rcpt_date" id="rcpt_date" readonly value="<?php echo date('d-M-Y'); ?>">
		</div>
		<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Admission Number</label>
			<input type="text" name="adm_no" id="adm_no" readonly class="form-control" value="<?php echo $adm_no; ?>">
		</div>
		<div class="col-md-3 col-xl-3 col-sm-3 form-group">
			<label>Admission Date</label>
			<input type="text" readonly name="adm_date" id="adm_date" value="<?php echo $adm_date; ?>" class="form-control">
		</div>
		<div class="col-xl-3 col-sm-3 col-md-3 form-group">
			<label>Student Name</label>
			<input type="text" name="stu_name" id="stu_name" class="form-control" readonly value="<?php echo $FIRST_NM; ?>">
		</div>
		<div class="col-md-3 col-sm-3 col-md-3 form-group">
			<label>Student Id</label>
			<input type="text" name="stu_id" id="stu_id" class="form-control" readonly value="<?php echo $STUDENTID; ?>">
		</div>
		<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Father Name</label>
			<input type="text" name="fname" id="fname" class="form-control" readonly value="<?php echo $FATHER_NM; ?>">
		</div>
		<div class="col-xl-3 col-md-3 col-sm-3 form-group">
			<label>Mother Name</label>
			<input type="text" name="mname" id="mname" class="form-control" readonly value="<?php echo $MOTHER_NM; ?>">
		</div>
		<div class="col-sm-3 col-md-3 col-xl-3 form-group">
			<label>Class/Sec</label>
			<input type="text" name="clssec" id="clssec" class="form-control" readonly value="<?php echo $clssec; ?>">
		</div>
		<div class="col-md-3 col-xl-3 col-sm-3 form-group">
			<label>Roll No</label>
			<input type="text" name="roll" id="roll" class="form-control" readonly value="<?php echo $ROLL_NO; ?>">
		</div>
		<div class="col-sm-3 col-md-3 col-md-3 form-group">
			<label>Ward Type</label>
			<input type="text" name="ward_type" id="ward_type" class="form-control" readonly value="<?php echo $EMP_WARD; ?>">
		</div>
		<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Bus Stoppage Name</label>
			<input type="text" name="bsn" id="bsn" class="form-control" readonly value="<?php echo $STOPNO; ?>">
		</div>
		<div class="col-xl-3 col-md-3 col-sm-3 form-group">
			<label>Bus Stoppage Amount</label>
			<input type="text" name="bsa" id="bsa" class="form-control" readonly value="<?php echo $STOPNO_AMT; ?>">
		</div>
		<div class="col-sm-9 col-md-9 col-xl-9 form-group">
			<label>Fee For Month</label>
			<input type="text" readonly name="ffm" id="ffm" class="form-control">
		</div>
		
		<div class="col-sm-3 col-md-3 col-xl-3 form-group">
			<br />
			<span class="btn btn-success" onclick="show_ledger()"><i class="fa fa-circle-o-notch fa-spin" style="display: none;" id="show_details_l"></i>&nbsp;Show Ledger</span>
			<input type="hidden" readonly name="month_count" id="month_count" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xl-12">
			<center>
				<span class="btn btn-success" onclick="show_pay()">&nbsp;Choose Unpaid Month</span>
			</center>
		</div>
	</div><br/>
<div class="modal fade" id="myModal1" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header" style="background: #5785c3; color: #fff; font-weight: bold;">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title"><CENTER>Unpaid Month</CENTER></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<?php
					$i=1;
					foreach($FEE as $key => $value){
						if($value == 'N/A' || $value == ''){
				?>
						<div class="col-sm-2 col-md-2 form-group">
							<input type="checkbox" class="<?php echo $i; ?>" onchange="monthckechk()" name="<?php echo $id[$key]; ?>" value="<?php echo $val[$key]; ?>" id="<?php echo $id[$key]; ?>">&nbsp;<?php echo $val[$key]; ?>
						</div>
				<?php
						$i++;
					}
					
				}
				?>	
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<center><button class="btn">Get Details</button></center>
				</div>
			</div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	  
	</div>
</div>
</form>
<div id="load_calulation">
	
</div>
<!--</form>-->

<!-- The Modal -->
  <div class="modal fade" id="myleadger">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header" style="background: #5785c3; color: #fff; text-align: center;">
          <h4 class="modal-title">STUDENT LEDGER</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
        </div>
        <style type="text/css">
        	.table,#thead,tr,td,th
        	{
        		text-align: center;
        		color: #000!important;
        	}
        </style>
        <!-- Modal body -->
        <div class="modal-body">
          <div style="overflow: auto; height: 250px;">
          	<table class="table">
          		<thead id="thead">
          			<tr>
          				<th width="10%">SlNO.</th>
          				<th width="25%">Receipt NO</th>
          				<th width="30%">Receipt Date</th>
          				<th width="20%">Period</th>
          				<th width="15%">Total</th>
          			</tr>
          		</thead>
          		<tbody id="ledger_data">
          			
          		</tbody>
          </table>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

<script type="text/javascript">
	function show_pay(){
		$("#myModal1").modal();
	}
	function monthckechk()
	{
		var val1 = $('.1').val();
		if($('.1').is(':checked')){
			var count=parseInt(0);
		if($('#apr').is(':checked'))
		{
			if($('#apr').is(':checked'))
			{
				var apr = $("#apr").val();
				var space1 ="-";
				$("#ffm").val(apr);
				count++;
				
				$('#month_count').val(count);
				if($('#may').is(':checked'))
				{
					var may = $("#may").val();
					var space2 ="-";
					$("#ffm").val(apr+space1+may);
					count++;
					
					$('#month_count').val(count);
					if($('#jun').is(':checked'))
					{
						var jun = $("#jun").val();
						var space3 ="-";
						$("#ffm").val(apr+space1+may+space2+jun);
						count++;
						
						$('#month_count').val(count);
						if( $('#jul').is(':checked') )
						{
							var jul = $("#jul").val();
							var space4 ="-";
							$("#ffm").val(apr+space1+may+space2+jun+space3+jul);
							count++;
							
							$('#month_count').val(count);
							if($('#aug').is(':checked'))
							{
								var aug = $('#aug').val();
								var space5="-";
								$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug);
								count++;
								
								$('#month_count').val(count);
								if($('#sep').is(':checked'))
								{
									var sep = $('#sep').val();
									var space6='-';
									$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep);
									count++;
									
									$('#month_count').val(count);
									if($('#oct').is(':checked'))
									{
										var oct = $('#oct').val();
										var space7='-';
										$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct);
										count++;
										
										$('#month_count').val(count);
										if($('#nov').is(':checked'))
										{
											var nov = $('#nov').val();
											var space8='-';
											$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov);
											count++;
											
											$('#month_count').val(count);
											if( $('#dec').is(':checked') )
											{
												var dec = $('#dec').val();
												var space9='-';
												$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov+space8+dec);
												count++;
												
												$('#month_count').val(count);
												if($('#jan').is(':checked'))
												{
													var jan = $('#jan').val();
													var space10='-';
													$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov+space8+dec+space9+jan);
													count++;
													
													$('#month_count').val(count);
													if($('#feb').is(':checked'))
													{
														var feb = $('#feb').val();
														var space11='-';
														$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov+space8+dec+space9+jan+space10+feb);
														count++;
														
														$('#month_count').val(count);
														if($('#mar').is(':checked') )
														{
															var mar = $('#mar').val();
															var space12='-';
															$('#ffm').val(apr+space1+may+space2+jun+space3+jul+space4+aug+space5+sep+space6+oct+space7+nov+space8+dec+space9+jan+space10+feb+space11+mar);
															count++
															
															$('#month_count').val(count);
															
														}
													}
													else
													{
														$('#mar').prop('checked',false);
													}
												}
												else
												{
													$('#feb').prop('checked',false);
													$('#mar').prop('checked',false);
												}
											}
											else
											{
												$('#jan').prop('checked',false);
												$('#feb').prop('checked',false);
												$('#mar').prop('checked',false);
											}
										}
										else
										{
											$('#dec').prop('checked',false);
											$('#jan').prop('checked',false);
											$('#feb').prop('checked',false);
											$('#mar').prop('checked',false);
										}
									}
									else
									{
										$('#nov').prop('checked',false);
										$('#dec').prop('checked',false);
										$('#jan').prop('checked',false);
										$('#feb').prop('checked',false);
										$('#mar').prop('checked',false);
									}
								}
								else
								{
									$('#oct').prop('checked',false);
									$('#nov').prop('checked',false);
									$('#dec').prop('checked',false);
									$('#jan').prop('checked',false);
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#sep').prop('checked',false);
								$('#oct').prop('checked',false);
								$('#nov').prop('checked',false);
								$('#dec').prop('checked',false);
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#aug').prop('checked',false);
							$('#sep').prop('checked',false);
							$('#oct').prop('checked',false);
							$('#nov').prop('checked',false);
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#jul').prop('checked',false);
						$('#aug').prop('checked',false);
						$('#sep').prop('checked',false);
						$('#oct').prop('checked',false);
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#jun').prop('checked',false);
					$('#jul').prop('checked',false);
					$('#aug').prop('checked',false);
					$('#sep').prop('checked',false);
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			
			}
			else
			{
				$('#may').prop('checked',false);
				$('#jun').prop('checked',false);
				$('#jul').prop('checked',false);
				$('#aug').prop('checked',false);
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#may').is(':checked'))
		{
			if($('#may').is(':checked'))
			{
				var may = $("#may").val();
				var space1 ="-";
				$("#ffm").val(may);
				count++;
				
				$('#month_count').val(count);
				if($('#jun').is(':checked'))
				{
					var jun = $('#jun').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(may+space1+jun);
					
					
					if($('#jul').is(':checked'))
					{
						var jul = $('#jul').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(may+space1+jun+space2+jul);
						
						
						if($('#aug').is(':checked'))
						{
							var aug = $('#aug').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(may+space1+jun+space2+jul+space3+aug);
							
							
							if($('#sep').is(':checked'))
							{
								var sep = $('#sep').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep);
								
								if($('#oct').is(':checked'))
								{
									var oct = $('#oct').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct);
									
									if( $('#nov').is(':checked') )
									{
										var nov = $('#nov').val();
										var space7 ='-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov);
										
										if( $('#dec').is(':checked') )
										{
											var dec = $('#dec').val();
											var space8 = '-';
											count++;
											$('#month_count').val(count);
											$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov+space7+dec);
											
											if( $('#jan').is(':checked') )
											{
												var jan = $('#jan').val();
												var space9 = '-';
												count++;
												$('#month_count').val(count);
												$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov+space7+dec+space8+jan);
												if( $('#feb').is(':checked') )
												{
													var feb = $('#feb').val();
													var space10 = '-';
													count++;
													$('#month_count').val(count);
													$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov+space7+dec+space8+jan+space9+feb);
													if( $('#mar').is(':checked') )
													{
														var mar = $('#mar').val();
														var space11 = '-';
														count++;
														$('#month_count').val(count);
														$('#ffm').val(may+space1+jun+space2+jul+space3+aug+space4+sep+space5+oct+space6+nov+space7+dec+space8+jan+space9+feb+space10+mar);
													
													}
												}
												else{
													$('#mar').prop('checked',false);
												}
											}
											else
											{
												$('#feb').prop('checked',false);
												$('#mar').prop('checked',false);
											}
										}
										else
										{
											$('#jan').prop('checked',false);
											$('#feb').prop('checked',false);
											$('#mar').prop('checked',false);
										}
									}
									else
									{
										$('#dec').prop('checked',false);
										$('#jan').prop('checked',false);
										$('#feb').prop('checked',false);
										$('#mar').prop('checked',false);
									}
								}
								else{
									$('#nov').prop('checked',false);
									$('#dec').prop('checked',false);
									$('#jan').prop('checked',false);
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
								
							}
							else
							{
								$('#oct').prop('checked',false);
								$('#nov').prop('checked',false);
								$('#dec').prop('checked',false);
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#sep').prop('checked',false);
							$('#oct').prop('checked',false);
							$('#nov').prop('checked',false);
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#aug').prop('checked',false);
						$('#sep').prop('checked',false);
						$('#oct').prop('checked',false);
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#jul').prop('checked',false);
					$('#aug').prop('checked',false);
					$('#sep').prop('checked',false);
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#jun').prop('checked',false);
				$('#jul').prop('checked',false);
				$('#aug').prop('checked',false);
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#jun').is(':checked'))
		{
			if($('#jun').is(':checked'))
			{
				var jun = $('#jun').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(jun);
				
				if($('#jul').is(':checked'))
				{
					var jul = $('#jul').val();
					var space2='-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(jun+space1+jul);
					
					if($('#aug').is(':checked'))
					{
						var aug = $('#aug').val();
						var space3 = '-';
						count++
						$('#month_count').val(count);
						$('#ffm').val(jun+space1+jul+space2+aug);
						
						if($('#sep').is(':checked'))
						{
							var sep = $('#sep').val();
							var space4 = '-';
							count++
							$('#month_count').val(count);
							$('#ffm').val(jun+space1+jul+space2+aug+space3+sep);
							
							if($('#oct').is(':checked'))
							{
								var oct = $('#oct').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct);
								
								if($('#nov').is(':checked'))
								{
									var nov = $('#nov').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov);
									
									if($('#dec').is(':checked'))
									{
										var dec = $('#dec').val();
										var space7 = '-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov+space6+dec);
										
										if($('#jan').is(':checked'))
										{
											var jan = $('#jan').val();
											var space8 = '-';
											count++;
											$('#month_count').val(count);
											$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov+space6+dec+space7+jan);
											
											if($('#feb').is(':checked'))
											{
												var feb = $('#feb').val();
												var space9 = '-';
												count++;
												$('#month_count').val(count);
												$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov+space6+dec+space7+jan+space8+feb);
												
												if($('#mar').is(':checked'))
												{
													var mar = $('#mar').val();
													var space10 = '-';
													count++;
													$('#month_count').val(count);
													$('#ffm').val(jun+space1+jul+space2+aug+space3+sep+space4+oct+space5+nov+space6+dec+space7+jan+space8+feb+space9+mar);
													
												}
											}
											else
											{
												$('#mar').prop('checked',false);
											}
										}
										else
										{
											$('#feb').prop('checked',false);
											$('#mar').prop('checked',false);
										}
									}
									else
									{
										$('#jan').prop('checked',false);
										$('#feb').prop('checked',false);
										$('#mar').prop('checked',false);
									}
								}
								else
								{
									$('#dec').prop('checked',false);
									$('#jan').prop('checked',false);
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#nov').prop('checked',false);
								$('#dec').prop('checked',false);
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#oct').prop('checked',false);
							$('#nov').prop('checked',false);
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#sep').prop('checked',false);
						$('#oct').prop('checked',false);
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#aug').prop('checked',false);
					$('#sep').prop('checked',false);
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#jul').prop('checked',false);
				$('#aug').prop('checked',false);
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#jul').is(':checked'))
		{
			if($('#jul').is(':checked'))
			{
				var jul = $('#jul').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(jul);
				
				if($('#aug').is(':checked'))
				{
					var aug  = $('#aug').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(jul+space1+aug);
					
					if($('#sep').is(':checked'))
					{
						var sep = $('#sep').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(jul+space1+aug+space2+sep);
						
						if($('#oct').is(':checked') )
						{
							var oct = $('#oct').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(jul+space1+aug+space2+sep+space3+oct);
							
							if( $('#nov').is(':checked') )
							{
								var nov = $('#nov').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov);
								
								if($('#dec').is(':checked'))
								{
									var dec = $('#dec').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov+space5+dec);
									
									if($('#jan').is(':checked'))
									{
										var jan = $('#jan').val();
										var space7 = '-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov+space5+dec+space6+jan);
										
										if($('#feb').is(':checked'))
										{
											var feb = $('#feb').val();
											var space8 = '-';
											count++;
											$('#month_count').val(count);
											$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov+space5+dec+space6+jan+space7+feb);
											
											if($('#mar').is(':checked'))
											{
												var mar = $('#mar').val();
												var space9 = '-';
												count++;
												$('#month_count').val(count);
												$('#ffm').val(jul+space1+aug+space2+sep+space3+oct+space4+nov+space5+dec+space6+jan+space7+feb+space8+mar);
												
											}
										}
										else
										{
											$('#mar').prop('checked',false);
										}
									}
									else
									{
										$('#feb').prop('checked',false);
										$('#mar').prop('checked',false);
									}
								}
								else
								{
									$('#jan').prop('checked',false);
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#dec').prop('checked',false);
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#nov').prop('checked',false);
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#oct').prop('checked',false);
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#sep').prop('checked',false);
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#aug').prop('checked',false);
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#aug').is(':checked'))
		{
			if($('#aug').is(':checked'))
			{
				var aug = $('#aug').val();
				var space1  = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(aug);
				
				if($('#sep').is(':checked'))
				{
					var sep = $('#sep').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(aug+space1+sep);
					
					if($('#oct').is(':checked'))
					{
						var oct = $('#oct').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(aug+space1+sep+space2+oct);
						
						if($('#nov').is(':checked'))
						{
							var nov = $('#nov').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(aug+space1+sep+space2+oct+space3+nov);
							
							if($('#dec').is(':checked'))
							{
								var dec = $('#dec').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(aug+space1+sep+space2+oct+space3+nov+space4+dec);
								
								if($('#jan').is(':checked'))
								{
									var jan = $('#jan').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(aug+space1+sep+space2+oct+space3+nov+space4+dec+space5+jan);
									
									if($('#feb').is(':checked'))
									{
										var feb  = $('#feb').val();
										var space7 = '-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(aug+space1+sep+space2+oct+space3+nov+space4+dec+space5+jan+space6+feb);
										
										if($('#mar').is(':checked'))
										{
											var mar = $('#mar').val();
											var space8 = '-';
											count++;
											$('#month_count').val(count);
											$('#ffm').val(aug+space1+sep+space2+oct+space3+nov+space4+dec+space5+jan+space6+feb+space7+mar);
											
										}
									}
									else
									{
										$('#mar').prop('checked',false);
									}
								}
								else
								{
									$('#feb').prop('checked',false);
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#jan').prop('checked',false);
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#dec').prop('checked',false);
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
						
					}
					else
					{
						$('#nov').prop('checked',false);
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#oct').prop('checked',false);
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#sep').prop('checked',false);
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#sep').is(':checked'))
		{
			if($('#sep').is(':checked'))
			{
				var sep = $('#sep').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(sep);
				
				if($('#oct').is(':checked'))
				{
					var oct = $('#oct').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(sep+space1+oct);
					
					if($('#nov').is(':checked'))
					{
						var nov  = $('#nov').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(sep+space1+oct+space2+nov);
						
						if($('#dec').is(':checked'))
						{
							var dec = $('#dec').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(sep+space1+oct+space2+nov+space3+dec);
							
							if($('#jan').is(':checked'))
							{
								var jan = $('#jan').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(sep+space1+oct+space2+nov+space3+dec+space4+jan);
								
								if($('#feb').is(':checked'))
								{
									var feb = $('#feb').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(sep+space1+oct+space2+nov+space3+dec+space4+jan+space5+feb);
									
									if($('#mar').is(':checked'))
									{
										var mar = $('#mar').val();
										var space7 = '-';
										count++;
										$('#month_count').val(count);
										$('#ffm').val(sep+space1+oct+space2+nov+space3+dec+space4+jan+space5+feb+space6+mar);
										
									}
								}
								else
								{
									$('#mar').prop('checked',false);
								}
							}
							else
							{
								$('#feb').prop('checked',false);
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#jan').prop('checked',false);
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#dec').prop('checked',false);
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
					
				}
				else
				{
					$('#nov').prop('checked',false);
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#oct').prop('checked',false);
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#oct').is(':checked'))
		{
			if($('#oct').is(':checked'))
			{
				var oct = $('#oct').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(oct);
				
				if($('#nov').is(':checked'))
				{
					var nov = $('#nov').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(oct+space1+nov);
					
					if($('#dec').is(':checked'))
					{
						var dec = $('#dec').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(oct+space1+nov+space2+dec);
						
						if($('#jan').is(':checked'))
						{
							var jan = $('#jan').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(oct+space1+nov+space2+dec+space3+jan);
							
							if($('#feb').is(':checked'))
							{
								var feb = $('#feb').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(oct+space1+nov+space2+dec+space3+jan+space4+feb);
								
								if($('#mar').is(':checked'))
								{
									var mar = $('#mar').val();
									var space6 = '-';
									count++;
									$('#month_count').val(count);
									$('#ffm').val(oct+space1+nov+space2+dec+space3+jan+space4+feb+space5+mar);
									
								}
							}
							else
							{
								$('#mar').prop('checked',false);
							}
						}
						else
						{
							$('#feb').prop('checked',false);
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#jan').prop('checked',false);
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#dec').prop('checked',false);
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#nov').prop('checked',false);
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#nov').is(':checked'))
		{
			if($('#nov').is(':checked'))
			{
				var nov = $('#nov').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(nov);
				
				if($('#dec').is(':checked'))
				{
					var dec = $('#dec').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(nov+space1+dec);
					
					if($('#jan').is(':checked'))
					{
						var jan = $('#jan').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(nov+space1+dec+space2+jan);
						
						if($('#feb').is(':checked'))
						{
							var feb = $('#feb').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(nov+space1+dec+space2+jan+space3+feb);
							
							if($('#mar').is(':checked'))
							{
								var mar = $('#mar').val();
								var space5 = '-';
								count++;
								$('#month_count').val(count);
								$('#ffm').val(nov+space1+dec+space2+jan+space3+feb+space4+mar);
								
							}
						}
						else
						{
							$('#mar').prop('checked',false);
						}
					}
					else
					{
						$('#feb').prop('checked',false);
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#jan').prop('checked',false);
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#dec').prop('checked',false);
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#dec').is(':checked'))
		{
			if($('#dec').is(':checked'))
			{
				var dec = $('#dec').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(dec);
				
				if($('#jan').is(':checked'))
				{
					var jan = $('#jan').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(dec+space1+jan);
					
					if($('#feb').is(':checked'))
					{
						var feb = $('#feb').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(dec+space1+jan+space2+feb);
						
						if($('#mar').is(':checked'))
						{
							var mar = $('#mar').val();
							var space4 = '-';
							count++;
							$('#month_count').val(count);
							$('#ffm').val(dec+space1+jan+space2+feb+space3+mar);
							
						}
					}
					else{
						$('#mar').prop('checked',false);
					}
				}
				else
				{
					$('#feb').prop('checked',false);
					$('#mar').prop('checked',false);
				}
			}
			else
			{
				$('#jan').prop('checked',false);
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#jan').is(':checked'))
		{
			if($('#jan').is(':checked'))
			{
				var jan = $('#jan').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(jan);
				
				if($('#feb').is(':checked'))
				{
					var feb = $('#feb').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(jan+space1+feb);
					
					if($('#mar').is(':checked'))
					{
						var mar = $('#mar').val();
						var space3 = '-';
						count++;
						$('#month_count').val(count);
						$('#ffm').val(jan+space1+feb+space2+mar);
						
					}
				}
				else{
					$('#mar').prop('checked',false);
				}
			}
			else{
				$('#feb').prop('checked',false);
				$('#mar').prop('checked',false);
			}
		}
		else if($('#feb').is(':checked'))
		{
			if($('#feb').is(':checked'))
			{
				var feb = $('#feb').val();
				var space1 = '-';
				count++;
				$('#month_count').val(count);
				$('#ffm').val(feb);
				
				if($('#mar').is(':checked'))
				{
					var mar = $('#mar').val();
					var space2 = '-';
					count++;
					$('#month_count').val(count);
					$('#ffm').val(feb+space1+mar);
					
				}
				
			}
			else
			{
				$('#mar').prop('checked',false);
			}
		}
		else if($('#mar').is(':checked'))
		{
			if($('#mar').is(':checked'))
			{
				var mar = $('#mar').val();
				count++
				$('#month_count').val(count);
				$('#ffm').val(mar);
				
			}
		}
		else
		{
			$('#month_count').val('');
			$('#ffm').val('');
		}
		if($('#apr').is(':checked') || $('#may').is(':checked') || $('#jun').is(':checked') || $('#jul').is(':checked') || $('#aug').is(':checked') || $('#sep').is(':checked') || $('#oct').is(':checked') || $('#nov').is(':checked') || $('#dec').is(':checked') || $('#jan').is(':checked') || $('#feb').is(':checked') || $('#mar').is(':checked')){
		}
	else
	{
		alert('Please Select Unpaid Month');
		$('#load_calulation').hide(2000);
		return false;
	}
			
		}else{
			alert("Please Select "+val1+" First");
			alert('Please Select Unpaid Month');
			$('#load_calulation').hide(2000);
			$("#ffm").val("");
			$("#month_count").val("");
			$('.1').prop('checked',false);
			$('.2').prop('checked',false);
			$('.3').prop('checked',false);
			$('.4').prop('checked',false);
			$('.5').prop('checked',false);
			$('.6').prop('checked',false);
			$('.7').prop('checked',false);
			$('.8').prop('checked',false);
			$('.9').prop('checked',false);
			$('.10').prop('checked',false);
			$('.11').prop('checked',false);
			$('.12').prop('checked',false);
			return false;
			
		}
		
	}
	function show_ledger()
	{
		var adm_no = $('#adm_no').val();
		$('#show_details_l').show(1000);
		$.ajax({
	 			url:"<?php echo base_url('Monthly_collection/showledger_monthly_collection'); ?>",
	 			type:"POST",
	 			data:{adm_no:adm_no},
	 			success:function(data)
	 			{
	 				
	 				if(data!="[]")
	 				{
	 					var html = "";
	 					var user = JSON.parse(data);
	 					var i=1;
	 					for(var count=0; count < user.length; count++)
	 					{
		 					html+="<tr>";
		 					html+="<td>"+i+"</td>"
		 					html+="<td>"+user[count].RECT_NO+"</td>";
		 					html+="<td>"+user[count].RECT_DATE+"</td>";
		 					html+="<td>"+user[count].PERIOD+"</td>";
		 					html+="<td>"+user[count].TOTAL+"</td></tr>";
		 					i++;
	 					}
	 					$("#myleadger").modal();
	 					$('#ledger_data').html(html);
						$('#show_details_l').hide(1000);
	 				}
	 				else
	 				{
	 					var html ="";
	 					html+="<tr>";
	 					html+="<td colspan='5'><h3>No Data Found</h3></td>";
	 					html+="</tr>";
	 					$("#myleadger").modal();
	 					$('#ledger_data').html(html);
						$('#show_details_l').hide(1000);
	 				}
	 				
	 			}

	 		});
	}

		
	$("#student_details").on("submit", function (event) {
	event.preventDefault();
	if($('#apr').is(':checked') || $('#may').is(':checked') || $('#jun').is(':checked') || $('#jul').is(':checked') || $('#aug').is(':checked') || $('#sep').is(':checked') || $('#oct').is(':checked') || $('#nov').is(':checked') || $('#dec').is(':checked') || $('#jan').is(':checked') || $('#feb').is(':checked') || $('#mar').is(':checked'))
	{
		$('#get_details_p').show(1000);
		$.ajax({
			url: "<?php echo base_url('Monthly_calculation/get_pay_details'); ?>",
			type: "POST",
			data: $("#student_details").serialize(),
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$('#load_calulation').show(2000);
				$('#load_calulation').html(data);
				$('#get_details_p').hide(1000);
				$("#myModal1").modal('hide');
			}
		});
		
	}
	else
	{
		alert('Please Select Unpaid Month');
		$('#load_calulation').hide(2000);
		return false;
	}
	});
</script>