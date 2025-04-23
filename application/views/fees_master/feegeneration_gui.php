<style>
	.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  margin: 0px auto;
  z-index:999;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Fee Generation</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;" ></div>
<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
	<form id='feegeneration'>
		<div class='row'>
			<div class='col-md-3 form-group'>
				<label>Choose Month</label>
			</div>
			<div class='col-md-3 form-group'>
				<select class='form-control select2' name='month_generation' id='selectmonth1' onchange="month(this.value)">
					<option value=''>SELECT MONTH</option>
					<?php
						if($month_master)
						{
							foreach($month_master as $month_details)
							{
								?>
									<option value="<?php echo $month_details->month_name; ?>"><?php echo $month_details->month_name; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>
			<div class='col-md-3 form-group'>
				<button class='btn btn-success btn-sm'>Generate <span id='feeid'></span> Fee</button>
			</div>
			<div>
				<p class='btn btn-success btn-sm' onclick="modify()">Modify</p>
			</div>
		</div>
	</form>
	<form id='modify_details' style='display:none;'>
		<!--<div class='row'>
			<div class='col-md-12 form-group'>
				<input type="checkbox" id='new'>Check If New Admission Student <span class='span'>(Only For 1 Month)</span>
			</div>
		</div> -->
		<div class='row'>
			<div class='col-md-2 form-group'>
				<label id='ad_id'>Adm No.</label>
			</div>
			<div class='col-md-3 form-group'>
				<input type='text' id='adm_no' name='adm_no' class='form-control' placeholder='Enter Admission Number' autocomplete='off'>
			</div>
			<div class='col-md-2 form-group'>
				<label id='cm'>Choose Month</label>
			</div>
			<div class='col-md-3 form-group'>
				<select class='form-control select2' id='u_m' name='u_m'>
					<option value=''>Select Month</option>
					<?php
						if($month_master)
						{
							foreach($month_master as $month_details)
							{
								?>
									<option value="<?php echo $month_details->month_name; ?>"><?php echo $month_details->month_name; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>
			<div class='col-md-2 form-group'>
				<button class='btn btn-success btn-sm'>Update Fee</button>
			</div>
		</div>
		<div class='row'>
			<center><p onclick='goto_feegeneration()' class='btn btn-success btn-sm'>Go TO Fee Generation</p></center>
		</div>
	</form>
	<div id='load'>
	</div>
</div><br />
 <div class="clearfix"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
 <script>
	$('.loader').hide();
	$('.select2').select2();
	function month(value)
	{
		$('#feeid').text(value);
	}
	function modify()
	{
		$('#feegeneration').hide(1000);
		$('#modify_details').show(1000);
	}
	function goto_feegeneration()
	{
		$('#feegeneration').show(1000);
		$('#modify_details').hide(1000);
	}
	$("#feegeneration").on("submit", function (event) {
    event.preventDefault();
		var month = $('#selectmonth1').val();
		if(month!="")
		{
			    $.ajax({
				url: "<?php echo base_url('Feegeneration/fee_generation'); ?>",
				type: "POST",
				data: $("#feegeneration").serialize(),
				beforeSend:function(){
					$('.loader').show();
					$('body').css('opacity', '0.5');
				},
				success: function(data){
					$('.loader').hide();
					$('body').css('opacity', '1.0');
					if(data==1)
					{
						alert(month+" Fee Already Generated");
					}
					else if(data==2){
						alert(month+" Fee Generation Successful");
					}
					$('.loader').hide();
					$('body').css('opacity', '1.0')
				}
			});
		}
		else
		{
			alert('Please Select Month');
			$("#selectmonth1").css("border-color","red");
		}
 });
 $("#modify_details").on("submit", function (event) {
    event.preventDefault();
		var adm_no = $('#adm_no').val();
		var u_m = $('#u_m').val();
		if(adm_no!="")
		{
			$("#ad_id").css("color","black");
			if(u_m!="")
			{
				$('#cm').css("color","black");
					$.ajax({
					url: "<?php echo base_url('Updatefeegeneration/fee_generation_update'); ?>",
					type: "POST",
					data: $("#modify_details").serialize(),
					success: function(data){
						alert(data);
					}
				});
			}
			else{
				alert('Please Select Month');
				$('#cm').css("color","red");
			}
		}
		else
		{
			alert('Please Enter Admission Number');
			$("#ad_id").css("color","red");
		}
 });
 </script>