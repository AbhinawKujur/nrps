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
?>

	<div class="row">
		<!--<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Receipt No</label>
			<input type="text" class="form-control" readonly name="rcpt_no" id="rcpt_no" value="<?php //echo $reciptno; ?>">
		</div>-->
		<div class="col-md-3 col-sm-3 col-xl-3 form-group">
			<label>Receipt Date</label>
			<input type="date" class="form-control" name="rcpt_date" id="rcpt_date" value="<?php echo date('Y-m-d'); ?>">
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
							<label><input type="checkbox" class="chkboxx" onchange="monthckechk(<?php echo $i?>)" name="chkbox[]" id="chkbox_<?php echo $i?>" disabled value="<?php echo $key+1; ?>" >&nbsp;<?php echo $val[$key]; ?></label>
						</div>
				    <?php
						$i++;
					}
					
				}
					
				?>	
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<center><button class="btn" onclick="get_data()">Get Details</button></center>
				</div>
			</div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	  
	</div>
</div>

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
	$("#chkbox_1").prop('disabled',false);
	
	function show_pay(){
		$("#myModal1").modal();
	}
	
	function get_data()
	{
		var adm_no = $('#adm_no').val();
		var ward_type = $('#ward_type').val();
		var bsn = $('#bsn').val();
		var bsa = $('#bsa').val();
		var rcpt_date = $('#rcpt_date').val();
		var ffm = $('#ffm').val();
		var chkbox = new Array();
         $("input[type='checkbox'][name='chkbox[]']:checked").each(function () {
        chkbox.push($(this).val());
	    });
	   if(chkbox !='')
	   {
	    $.ajax({
	    // url : "<?php //echo base_url('Cmonthly_calculation/get_pay_details') ?>",
	    url : "<?php echo base_url('Bank_calculation/get_pay_details') ?>",
	    type: "POST",
		data: {adm_no:adm_no,ward_type:ward_type,bsn:bsn,bsa:bsa,rcpt_date:rcpt_date,ffm:ffm,chkbox:chkbox},
	    //dataType: "json",
		success: function(data)
	    { 		
		
			    $("#myModal1").modal('hide');
				$('body').css('opacity', '1.0');
				$('#load_calulation').show(2000);
				$('#load_calulation').html(data);
				
		},   
      });
	  }
	  else
	  {
		  alert('Please Select Unpaid Month');
		  $('#load_calulation').hide(2000);
		  return false;
	  }
	
	}
	
	function monthckechk(val)
	{
		var chkbox = $("#chkbox_"+val).prop('checked') ? 1: 0;
		if(chkbox == 1){
			var next = val + 1;
			$("#chkbox_"+next).prop('disabled',false);
		}else{
			var next = val + 1;
			var next1 = val + 2;
			var next2 = val + 3;
			var next3 = val + 4;
			var next4 = val + 5;
			var next5 = val + 6;
			var next6 = val + 7;
			var next7 = val + 8;
			var next8 = val + 9;
			var next9 = val + 10;
			var next10 = val + 11;
			var next11 = val + 12;
			$("#chkbox_"+next).prop('disabled',true);
			$("#chkbox_"+next).prop('checked',false);
			
			$("#chkbox_"+next1).prop('disabled',true);
			$("#chkbox_"+next1).prop('checked',false);
			
			$("#chkbox_"+next2).prop('disabled',true);
			$("#chkbox_"+next2).prop('checked',false);
			
			$("#chkbox_"+next3).prop('disabled',true);
			$("#chkbox_"+next3).prop('checked',false);
			
			$("#chkbox_"+next4).prop('disabled',true);
			$("#chkbox_"+next4).prop('checked',false);
			
			$("#chkbox_"+next5).prop('disabled',true);
			$("#chkbox_"+next5).prop('checked',false);
			
			$("#chkbox_"+next6).prop('disabled',true);
			$("#chkbox_"+next6).prop('checked',false);
			
			$("#chkbox_"+next7).prop('disabled',true);
			$("#chkbox_"+next7).prop('checked',false);
			
			$("#chkbox_"+next8).prop('disabled',true);
			$("#chkbox_"+next8).prop('checked',false);
			
			$("#chkbox_"+next9).prop('disabled',true);
			$("#chkbox_"+next9).prop('checked',false);
			
			$("#chkbox_"+next10).prop('disabled',true);
			$("#chkbox_"+next10).prop('checked',false);
			
			$("#chkbox_"+next11).prop('disabled',true);
			$("#chkbox_"+next11).prop('checked',false);
		}
		
		var chkboxx = new Array();
			  $("input[type='checkbox'][name='chkbox[]']:checked").each(function () {
			 chkboxx.push($(this).val());
			 });
		
		 $.ajax({
			url : "<?php echo base_url('Cmonthly_collection/month_detail') ?>",
			type: "POST",
			data: {chkboxx:chkboxx},
			dataType: "json",
			success: function(data)
			 { 		
				$("#ffm").val(data.mntt);
			 },   
			});
	}
	
	function show_ledger()
	{
		var adm_no = $('#adm_no').val();
		$('#show_details_l').show(1000);
		$.ajax({
	 			url:"<?php echo base_url('Cmonthly_collection/showledger_monthly_collection'); ?>",
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

</script>