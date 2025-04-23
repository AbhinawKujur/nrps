<?php
 if($feehead)
 {
 	$MONTHLY = $feehead[0]->MONTHLY;
 	$CL_BASED = $feehead[0]->CL_BASED;
 	$apr = $feehead[0]->APR;
 	$may = $feehead[0]->may;
 	$jun = $feehead[0]->JUN;
 	$jul = $feehead[0]->JUL;
 	$aug = $feehead[0]->AUG;
 	$sep = $feehead[0]->SEP;
 	$oct = $feehead[0]->OCT;
 	$nov = $feehead[0]->NOV;
 	$dec = $feehead[0]->DECM;
 	$jan = $feehead[0]->JAN;
 	$feb = $feehead[0]->FEB;
 	$mar = $feehead[0]->MAR;
 	$FEE_HEAD = $feehead[0]->FEE_HEAD;
 	$act = $feehead[0]->ACT_CODE;
 	$AccG = $feehead[0]->AccG;
 	$SHNAME =$feehead[0]->SHNAME;
 	$HType = $feehead[0]->HType;
 	$AMOUNT = $feehead[0]->AMOUNT;
 	$EMP = $feehead[0]->EMP;
 	$CCL = $feehead[0]->CCL;
 	$SPL = $feehead[0]->SPL;
 	$EXT = $feehead[0]->EXT;
 	$INTERNAL = $feehead[0]->INTERNAL;
 }
 if($ward1)
 {
 	$ward1 = $ward1[0]->HOUSENAME;
 }
 if($ward2)
 {
 	$ward2 = $ward2[0]->HOUSENAME;
 }
 if($ward3)
 {
 	$ward3 = $ward3[0]->HOUSENAME;
 }
 if($ward4)
 {
 	$ward4 = $ward4[0]->HOUSENAME;
 }
 if($ward5)
 {
 	$ward5 = $ward5[0]->HOUSENAME;
 }
 if($ward6)
 {
 	$ward6 = $ward6[0]->HOUSENAME;
 }
?>
<style type="text/css">

</style>
<form>
	<div class="header" style="background: #5785c3; height: 40px;">
		<center><h3 style="padding-top: 6px; color: white;"><B><?php echo $FEE_HEAD; ?></B></h3></center>
		<input type="hidden" id="feehead" value="<?php echo $act; ?>">
    </div>
<br>
<div class="row">
	<div class="col-md-3 col-sm-3 col-xl-3">
		<input type="hidden" name="month" id="month" value="<?php echo $MONTHLY; ?>">
		<div style="border: solid 1px #5785c3; height: 325px; overflow-y: scroll; " id="month_table">
		<table id="example" width="100%">
			<thead>
			<tr>
				<th colspan="2" style="color: white; text-align: center;">Month Based&nbsp;&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" name="chckall" id="chckall" onchange="checkAll()"></td>
				<td style="color: black; text-transform: uppercase; font-weight: bold;">Check All</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" class="check" name="apr" id="apr" <?php if($apr==1) {echo "checked";} ?>></td>
				<td style="color: black; text-transform: uppercase;">APR</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" class="check" <?php if($may==1) {echo "checked";} ?> name="may" id="may"></td>
				<td style="color: black; text-transform: uppercase;">MAY</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" <?php if($jun==1) {echo "checked";} ?> value="1" class="check" name="jun" id="jun"></td>
				<td style="color: black; text-transform: uppercase;">JUN</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($jul==1) {echo "checked";} ?> class="check" name="jul" id="jul"></td>
				<td style="color: black; text-transform: uppercase;">JUL</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($aug==1) {echo "checked";} ?> class="check" name="aug" id="aug"></td>
				<td style="color: black; text-transform: uppercase;">AUG</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($sep==1) {echo "checked";} ?> class="check" name="sep" id="sep"></td>
				<td style="color: black; text-transform: uppercase;">SEP</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($oct==1) {echo "checked";} ?> class="check" name="oct" id="oct"></td>
				<td style="color: black; text-transform: uppercase;">OCT</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($nov==1) {echo "checked";} ?> class="check" name="nov" id="nov"></td>
				<td style="color: black; text-transform: uppercase;">NOV</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($dec==1) {echo "checked";} ?> class="check" name="dec" id="dec"></td>
				<td style="color: black; text-transform: uppercase;">DEC</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($jan==1) {echo "checked";} ?> class="check" name="jan" id="jan"></td>
				<td style="color: black; text-transform: uppercase;">JAN</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($feb==1) {echo "checked";} ?> class="check" name="feb" id="feb"></td>
				<td style="color: black; text-transform: uppercase;">FEB</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;<input type="checkbox" value="1" <?php if($mar==1) {echo "checked";} ?> class="check" name="mar" id="mar"></td>
				<td style="color: black; text-transform: uppercase;">MAR</td>
			</tr>
			</tbody>
		</table>
	</div>
	</div>
	<div class="col-md-9 col-xl-9 col-sm-9">
		<div id="class_table" style="overflow-x: auto; overflow-y: scroll; height: 325px; border: solid 1px #5785c3;">
			<table class="table table-bordered" id="example">
				<thead>
				<tr>
					<th>SNO</th>
					<th>CLASS</th>
					<?php
					  if($ward)
					  {
					  	foreach ($ward as $data)
					  	 {
					  		?>
					  		 <th width="40%"><?php echo $data->HOUSENAME; ?></th>
					  		<?php
					  	}
					  } 
					?>
					<!-- <th>ACTION</th> -->
				</tr>
				</thead>
					<tbody id="tbody">
						 <img src="<?php echo base_url('assets/preloader/preloader.gif'); ?>" style="width:80px; height:80px; position:absolute; top:40%; left:43%; display:none; z-index:9999;" id="loder">
					</tbody>

			</table>
		</div>
	</div>
</div><br />
<div class="row">
	<div class="col-md-6 col-sm-6 col-xl-6">
		<div class="form-group">
			<label>Account Type</label>
			<select class="form-control" id="account_type">
				<?php
				  if($accg)
				  {
				  	foreach ($accg as $accg_data)
				  	 {
				  		?>
				  		<option value="<?php echo $accg_data->CAT_CODE; ?>" <?php if($accg_data->CAT_CODE==$AccG) {echo "selected";} ?> ><?php echo $accg_data->CAT_ABBR; ?></option>
				  		<?php
				  	}
				  } 
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Fee Head Name</label>
			<input style="text-transform: uppercase;" onkeypress="return event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122 ||event.charCode==32 || event.charCode==45" type="text" name="fhn" class="form-control" id="fhn" value="<?php echo $FEE_HEAD; ?>">
		</div>
		<div class="form-group">
			<label>Short Name</label>
			<input type="text" onkeypress="return event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122 ||event.charCode==32 || event.charCode==45" style="text-transform: uppercase;" name="sn" class="form-control" id="sn" value="<?php echo $SHNAME; ?>">
		</div>
			<div class="form-group">
			<label>Head Type</label>
			<select name="ht" id="ht" class="form-control">
				<?php
				 if($head_type)
				 {
				 	foreach ($head_type as $fee_data)
				 	 {
				 		?>
				 		 <option value="<?php echo $fee_data->head_name; ?>" <?php if($fee_data->head_name==$HType) {echo "selected";} ?> ><?php echo $fee_data->head_name; ?></option>
				 		<?php
				 	}
				 }
				?>
			</select>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<input type="checkbox" id="mb" name="mb" onchange="month_change()" <?php if($MONTHLY==1) {echo "checked";} ?> >&nbsp;Monthly Fee
			</div>
			<div class="form-group col-md-6">
				<input type="checkbox" name="cb" id="cb" onchange="class_change()" <?php if($CL_BASED==1) {echo "checked";} ?> >&nbsp;Class Base Fee
			</div>
			
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xl-6">
		<div id="amount_details">
			<h4>Amount Details</h4>
		<hr style="border: .5px solid black;">
		    <div class="row" style="padding-top: 9px; ">
		    	<div class="col-md-6">
		    		<div class="form-group">
				<label><?php echo $ward1; ?></label>
				<input type="text" name="ward1" id="ward1" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46' value="<?php echo $AMOUNT; ?>">
			</div>
		    	</div>
		    	<div class="col-md-6">
		    		<div class="form-group">
				      <label><?php echo $ward2; ?></label>
				      <input type="text" name="ward2" id="ward2" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46' value="<?php echo $EMP; ?>">
			        </div>
		    	</div>
		    </div>	
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
				     <label><?php echo $ward3; ?></label>
				     <input type="text" name="ward3" id="ward3" onkeypress="return event.charCode >=48 && event.charCode <=57 || event.charCode==46" value="<?php echo $CCL; ?>" class="form-control">
			        </div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
				     <label><?php echo $ward4; ?></label>
				     <input type="text" name="ward4" onkeypress="return event.charCode>=48 && event.charCode <=57 || event.charCode==46" value="<?php echo $SPL; ?>" id="ward4" class="form-control">
			        </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
				     <label><?php echo $ward5; ?></label>
				     <input type="text" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" name="ward5" value="<?php echo $EXT; ?>" id="ward5" class="form-control">
			         </div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <label><?php echo $ward6; ?></label>
					    <input type="text" name="ward6" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $INTERNAL; ?>" id="ward6" class="form-control">
			        </div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xl-12">
		<center><input type="submit" onclick="save_data()" name="submit" value="SAVE" class="btn btn-success"></center>
	</div>
</div>
<script src="jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	 function checkAll(){
	 var val = $("#chckall").is(":checked");
	 if(val == true){
		$(".check").each( function () {
		  $(".check").prop('checked', true); 
	    });
	 }else{
		$(".check").each( function () {
		  $(".check").prop('checked', false); 
	    });
	 }   
 }
 $(document).ready(function(){
 	if($("#mb").is(':checked'))
 	{
 		$('#month_table').show();
 	}
 	else
 	{
 		$('#month_table').hide();
 	}
 	if($("#cb").is(':checked'))
 	{
 		$('#class_table').show();
 		$('#amount_details').hide();
 	}
 	else
 	{
 		$('#class_table').hide();
 		$('#amount_details').show();
 	}
 	function load_data()
 	{
 		$("#loder").show();
 		var id = $("#feehead").val();
 	    $.ajax({
 	    	url:"<?php echo base_url('Fees_master/load_feeclw'); ?>",
 	    	method:"POST",
 	    	datatype:"JSON",
 	    	data:{id:id},
 	    	success:function(data)
 	    	 {
 	    	 	var user = JSON.parse(data);
 	    	 	var html ="";
 	    	 	var i=1;
 	    		for(var count = 0; count < user.length; count++)
        		{
          			html += '<tr>';
          			html += '<td>'+i+'</td>';
          			html += '<td>'+user[count].CLASS_NM+'</td>';
          			html += '<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_cl="'+user[count].CL+'" data-row_fh="'+user[count].FH+'" data-column_name="AMOUNT" contenteditable>'+user[count].AMOUNT+'</td>';
          			html += '<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_cl="'+user[count].CL+'" data-row_fh="'+user[count].FH+'" data-column_name="EMP" contenteditable>'+user[count].EMP+'</td>';

          			html += '<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_cl="'+user[count].CL+'" data-row_fh="'+user[count].FH+'" data-column_name="CCL" contenteditable>'+user[count].CCL+'</td>';

          			html += '<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_cl="'+user[count].CL+'" data-row_fh="'+user[count].FH+'" data-column_name="SPL" contenteditable>'+user[count].SPL+'</td>';

          			html += '<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_cl="'+user[count].CL+'" data-row_fh="'+user[count].FH+'" data-column_name="EXT" contenteditable>'+user[count].EXT+'</td>';

          			html += '<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_cl="'+user[count].CL+'" data-row_fh="'+user[count].FH+'" data-column_name="INTERNAL" contenteditable>'+user[count].INTERNAL+'</td></tr>';
          		
          			i++;
        		}
        		 $("#loder").hide();
        		 $('#tbody').html(html);
 	    	}
 	    });
 	}
 	load_data();
 });
/*function getdetails(val1,val2)
{
	alert(val1);
	alert(val2);
}*/
$(document).on('blur', '.table_data', function(){
    var cl = $(this).data('row_cl');
    var fh = $(this).data('row_fh');
    var table_column = $(this).data('column_name');
    var value = $(this).text();
    //alert("class code is:"+cl+"feehead code is:"+fh+" column name"+table_column+"value is:-"+value);
    $.ajax({
      url:"<?php echo base_url(); ?>Fees_master/table_update",
      method:"POST",
      data:{cl:cl,fh:fh,table_column:table_column, value:value},
      success:function(data)
      {
        load_data();
        /*alert(data);*/
      }
    })
  });
	
	function class_change()
	{
		if($("#cb").is(':checked'))
 	     {
 		   $('#class_table').show();
 		   $('#amount_details').hide();
 	     }
 	    else
 	     {
 		   $('#class_table').hide();
 		   $('#amount_details').show();
 	     }
	}

	function month_change()
	{
		if($("#mb").is(':checked'))
 	     {
 		    $('#month_table').show();
 	     }
 	     else
 	     {
 		   $('#month_table').hide();
 	     }
	}
	function save_data()
	{
		
		var account_type = $("#account_type").val();
		var fhn = $("#fhn").val();
		var sn = $("#sn").val();
		var ht = $("#ht").val();
		var act_code = $("#feehead").val();

		if($("#mb").is(":checked"))
		{
			var mb = 1;
			if($("#apr").is(":checked"))
			{
				var apr = 1
			}
			else
			{
				var apr = 0;
			}

			if($("#may").is(":checked"))
			{
				var may = 1;
			}
			else
			{
				var may = 0;
			}

			if($("#jun").is(":checked"))
			{
				var jun =1;
			}
			else
			{
				var jun = 0;
			}

			if($("#jul").is(":checked"))
			{
				var jul =1;
			}
			else
			{
				
				var jul = 0;
			}

			if($("#aug").is(":checked"))
			{
				var aug =1;
			}
			else
			{
				var aug = 0;
			}

			if($("#sep").is(":checked"))
			{
				var sep =1;
			}
			else
			{
				var sep = 0;
			}

			if($("#oct").is(":checked"))
			{
				var oct =1;
			}
			else
			{
				var oct = 0;
			}

			if($("#nov").is(":checked"))
			{
				var nov =1;
			}
			else
			{
				var nov = 0;
			}

			if($("#dec").is(":checked"))
			{
				var dec = 1;
			}
			else
			{
				var dec = 0;
			}

			if($("#jan").is(":checked"))
			{
				var jan = 1;
			}
			else
			{
				var jan = 0;
			}

			if($("#feb").is(":checked"))
			{
				var feb = 1;
			}
			else
			{
				var feb = 0;
			}

			if($("#mar").is(":checked"))
			{
				var mar = 1;
			}
			else
			{
				var mar = 0;
			}

		}
		else
		{
			var mb = 0;
			var apr = 0;
			var may = 0;
			var jun = 0;
			var jul = 0;
			var aug = 0;
			var sep = 0;
			var oct = 0;
			var nov = 0;
			var dec = 0;
			var jan = 0;
			var feb = 0;
			var mar = 0;

		}

		if($("#cb").is(":checked"))
		{
			var cb =1;
		}
		else
		{
			var cb = 0;
		}

		var ward1 = $("#ward1").val();
		var ward2 = $("#ward2").val();
		var ward3 = $("#ward3").val();
		var ward4 = $("#ward4").val();
		var ward5 = $("#ward5").val();
		var ward6 = $("#ward6").val();
		/*alert("apr:-"+apr+"may:-"+may+"jun:-"+jun+"jul:-"+jul+"aug:-"+aug+"sep:-"+sep+"oct:-"+oct+"nov:-"+nov+"dec:-"+dec+"jan:-"+jan+"feb:-"+feb+"mar:-"+mar+"account_type:-"+account_type+"feehead type"+fhn+"short_name"+sn+"head_type"+ht+"month_base"+mb+"class_base"+cb+"ward1"+ward1+"ward2"+ward2+"ward3"+ward3+"ward4"+ward4+"ward5"+ward5+"ward6"+ward6);*/

		$.ajax({
			url:"<?php echo base_url('Fees_master/save_data'); ?>",
			method:"POST",
			data:{apr:apr,may:may,jun:jun,jul:jul,aug:aug,sep:sep,oct:oct,nov:nov,dec:dec,jan:jan,feb:feb,mar:mar,account_type:account_type,fhn:fhn,sn:sn,ht:ht,mb:mb,cb:cb,ward1:ward1,ward2:ward2,ward3,ward3,ward4:ward4,ward5:ward5,ward6:ward6,act_code:act_code},
			success:function(data)
			{
				if(data==1)
				{
					alert("Data Updated Successfully");
					 location.reload();
				}
				else
				{
					alert("data not updated");
				}
			}
		})

	}
</script>