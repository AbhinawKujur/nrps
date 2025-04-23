<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Add Student</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white">
		<div class="row">
				<div class="col-md-12">
					<?php
					   if($this->session->flashdata('msg')){
					   	?>
					   	<div class="alert alert-success" role="alert" id="msg" style="padding: 6px 0px;">
			  				<center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
						</div>
					   	<?php
					   }
					?>
				</div>
			</div>
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Student_details/Scholarship'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		 <form action="<?php echo htmlspecialchars(base_url('Student_details/save_scholarship')); ?>" method="post" onsubmit="return validation()">
		   <table class="table table-bordered" id="class_table" style="border-top:3px solid #5785c3;">
			<tr>
			  <td class="text-center"><b>Admission No.</b></td>
			  <td><input type="text" name="adm_no" id="adm_no" class="form-control" oninput="dataswap(this.value)" autocomplete="off"></td>
			</tr>
			<tr>
				<td colspan="2"><center><input type="reset" name="reset" value="RESET" class="btn" style="background-color:#FF5733;"></center></td>
			</tr>
		  </table>
		  <br /><br />
		   <!-- <div id="pageloader">
		   </div> -->
		   <div class='row'>
		   <div class="form-group col-md-4">
            <label>Admission No.</label>
            <input type="text" name="admission" id="admission" class="form-control" readonly="true">
           </div>
		   
           <div class="form-group col-md-4">
           	 <label>Name</label>
           	 <input type="text" name="name" id="name" class="form-control" readonly="true">
           </div>
           <div class="form-group col-md-4">
           	<label>Roll No.</label>
           	<input type="text" name="roll" id="roll" class="form-control" readonly="true">
           </div>
		   </div>
		   
		   
		   <div class='row'>
           <div class="form-group col-md-4">
           	<label>Class/Sec</label>
           	<input type="text" name="clssec" id="clssec" class="form-control" readonly="true">
           </div>
           <div class="form-group col-md-4">
           	 <label>Scholarship Apply From</label>
           	 <select class="form-control" id="saf" name="saf" disabled>
           	 	<option value="">Select Month</option>
           	 	<?php
           	 	if($month)
           	 	{
           	 		foreach($month as $month_data)
           	 		{
           	 			?>
           	 			<option value="<?php echo $month_data->month_name; ?>"><?php echo $month_data->month_name; ?></option>
           	 			<?php
           	 		}
           	 	}
           	 	?>
           	 </select>
           </div>
           <div class="form-group col-md-4">
           	 <label>Scholarship Given By</label>
           	 <select class="form-control" name="sgb" id="sgb" disabled>
           	 	<option value="">Select</option>
				<option value="Meritorious">Meritorious Scholarship
</option>
				<option value="Management">Management</option>
				<option value="4thGrade">4th Grade Employee</option>
				<option value="Hostel">Hostel Students</option>
				<option value="Others">Others</option>
			</select>
           </div>
		   </div>
		   
		   
		   <div class='row'>
				 <div class="form-group col-md-4">
					 <label>Application No.</label>
					 <input type="text" name="app_no" id="app_no" class="form-control" required>
				 </div>
		   </div>
		   <div class='row'>
				 <div class="form-group col-md-4">
					 <label>Recommended By</label>
					 <input type="text" name="recomm" id="recomm" class="form-control" required>
				 </div>
		   </div>
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
           <hr style="border: .5px solid black;">
           <div class="row">
           	 <div class="col-md-12">
           	 	Fee-Head Details In ( <span style='font-size:20px;'>&#8377;</span> )
           	 </div>
           </div><br />
		   <?php
			if($feehead){
				$v =0;
				foreach($feehead as $key=>$value){
					$v = $key+1;
					if($value->FEE_HEAD!="" && $value->FEE_HEAD!="-"){
						?>
							<div class="form-group col-md-3">
								<label><?php echo $value->FEE_HEAD; ?></label>
								<input type="text" value='0' oninput='Checkamount(this.id)' class="form-control" name="feehead<?php echo $v; ?>" id="feehead_<?php echo $v; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46' placeholder="Amount" disabled style="text-align: right;" autocomplete="off">
							</div>
						<?php
					}
					else{
						?>
						<input type="hidden" value='0' class="form-control" name="feehead<?php echo $v; ?>" id="feehead_<?php echo $v; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46' placeholder="Amount" disabled style="text-align: right;" autocomplete="off">
						<?php
					}
				}
			}
		   ?>
           
		<div class="form-group col-md-9">
			<br />
			<center><input type="submit" name="submit" id="submit" value="SAVE" class="btn btn-success" disabled="true"></center>
		</div>
			<input type="hidden" name="class_code" id='class_code'>
		  </form>
</div><br /><br />
		
		 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p id="first"></p>
          <p id="second"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <div class="clearfix"></div><br />
<!-- script-for sticky-nav -->
<script>
	function Checkamount(val){
		var spldata = val.split('_');
		var act_code = spldata[1];
		var amount = $("#feehead_"+act_code).val();
		var class_code = $("#class_code").val();
		var admission = $("#admission").val();
		if(amount != 0){
			$.ajax({
				url:"<?php echo base_url(); ?>Checkfeeheadamount/feeheadamountcheck",
				type: "POST",
				data: {act_code:act_code,class_code:class_code,admission:admission},
				success:function(response){
					
				},
			});
		}else{
			$("#feehead_"+act_code).val(0);
		}
	}
	function dataswap(val)
	{
	  $.ajax({
		url:"<?php echo base_url(); ?>Student_details/Scholarship_add",
			type: "POST",
			data: {value:val},
			success: function(data){
				var user = JSON.parse(data);
				var class_code = user[6];
				$("#class_code").val(class_code);
				if(user[1]==1)
				{
						$('#myModal').modal();
						$('#myModal').find('.modal-header').css({"color":"red","text-align":"center","font-size":"30px"});
						$('#myModal').find('.modal-header').html("Warning !");
						$('#myModal').find('.modal-body').html("This Student Already Facilitate For Scholarship.");
						//$('#adm_no option[value=""]').prop('selected',true);
						$('#adm_no').val("");
						$('#saf option[value=""]').prop('selected',true);
						$('#sgb option[value=""]').prop('selected',true);
						$("#admission").val("0");
						$("#name").val("0");
						$("#roll").val("0");
						$("#clssec").val("0");
						$("#feehead_1").val("0");
						$("#feehead_2").val("0");
						$("#feehead_3").val("0");
						$("#feehead_4").val("0");
						$("#feehead_5").val("0");
						$("#feehead_6").val("0");
						$("#feehead_7").val("0");
						$("#feehead_8").val("0");
						$("#feehead_9").val("0");
						$("#feehead_10").val("0");
						$("#feehead_11").val("0");
						$("#feehead_12").val("0");
						$("#feehead_13").val("0");
						$("#feehead_14").val("0");
						$("#feehead_15").val("0");
						$("#feehead_16").val("0");
						$("#feehead_17").val("0");
						$("#feehead_18").val("0");
						$("#feehead_19").val("0");
						$("#feehead_20").val("0");
						$("#feehead_21").val("0");
						$("#feehead_22").val("0");
						$("#feehead_23").val("0");
						$("#feehead_23").val("0");
						$("#feehead_24").val("0");
						$("#feehead_25").val("0");
						$("#saf").prop('disabled',true);
						$("#sgb").prop('disabled',true);
						$("#feehead_1").prop('disabled',true);
						$("#feehead_2").prop('disabled',true);
						$("#feehead_3").prop('disabled',true);
						$("#feehead_4").prop('disabled',true);
						$("#feehead_5").prop('disabled',true);
						$("#feehead_6").prop('disabled',true);
						$("#feehead_7").prop('disabled',true);
						$("#feehead_8").prop('disabled',true);
						$("#feehead_9").prop('disabled',true);
						$("#feehead_10").prop('disabled',true);
						$("#feehead_11").prop('disabled',true);
						$("#feehead_12").prop('disabled',true);
						$("#feehead_13").prop('disabled',true);
						$("#feehead_14").prop('disabled',true);
						$("#feehead_15").prop('disabled',true);
						$("#feehead_16").prop('disabled',true);
						$("#feehead_17").prop('disabled',true);
						$("#feehead_18").prop('disabled',true);
						$("#feehead_19").prop('disabled',true);
						$("#feehead_20").prop('disabled',true);
						$("#feehead_21").prop('disabled',true);
						$("#feehead_22").prop('disabled',true);
						$("#feehead_23").prop('disabled',true);
						$("#feehead_23").prop('disabled',true);
						$("#feehead_24").prop('disabled',true);
						$("#feehead_25").prop('disabled',true);
						$("#submit").prop('disabled',true);
				}
				else
				{
					$("#admission").val(user[0]);
					$("#name").val(user[2]);
					$("#roll").val(user[4]);
					$("#clssec").val(user[3]);
					$("#saf").prop('disabled',false);
					$("#sgb").prop('disabled',false);
					$("#feehead_1").prop('disabled',false);
					$("#feehead_2").prop('disabled',false);
					$("#feehead_3").prop('disabled',false);
					$("#feehead_4").prop('disabled',false);
					$("#feehead_5").prop('disabled',false);
					$("#feehead_6").prop('disabled',false);
					$("#feehead_7").prop('disabled',false);
					$("#feehead_8").prop('disabled',false);
					$("#feehead_9").prop('disabled',false);
					$("#feehead_10").prop('disabled',false);
					$("#feehead_11").prop('disabled',false);
					$("#feehead_12").prop('disabled',false);
					$("#feehead_13").prop('disabled',false);
					$("#feehead_14").prop('disabled',false);
					$("#feehead_15").prop('disabled',false);
					$("#feehead_16").prop('disabled',false);
					$("#feehead_17").prop('disabled',false);
					$("#feehead_18").prop('disabled',false);
					$("#feehead_19").prop('disabled',false);
					$("#feehead_20").prop('disabled',false);
					$("#feehead_21").prop('disabled',false);
					$("#feehead_22").prop('disabled',false);
					$("#feehead_23").prop('disabled',false);
					$("#feehead_23").prop('disabled',false);
					$("#feehead_24").prop('disabled',false);
					$("#feehead_25").prop('disabled',false);
					$("#submit").prop('disabled',false);
				}
			}
	  });
	}

	function validation()
	{
		var saf = document.getElementById('saf').selectedIndex;
		var sgb = document.getElementById('sgb').selectedIndex;
		if(saf!="" && sgb!="")
		{
			return true;
		}
		else
		{
			$('#myModal').modal();
			$('#myModal').find('.modal-header').css({"color":"red","text-align":"center","font-size":"30px"});
			$('#myModal').find('.modal-header').html("Warning !");
			$('#myModal').find('.modal-body').html("Please Select Scholarship Apply From And Scholarship Given By");
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
			var app_no =document.getElementById('app_no');
		var recomm =document.getElementById('recomm');
			return false;
		}

	}
</script>
<div class="inner-block">

</div>