<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Admission Register</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<style>
	 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
	  {
		color: black;
	  }
	  /* The container */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: grey;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #4CAF50;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
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
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
<form id="data_id">
	<div class='row'>
		<div class='col-md-3 form-group'>
			<fieldset>
				<legend id='dm'>Display Mode</legend>
				<label class="container">Class Wise
				  <input type="radio" onclick="dt(this.value)" value='1' name='disp_mode' id='cw'>
				  <span class="checkmark"></span>
				</label>
				<label class="container">Date Wise
				  <input type="radio" onclick='dt(this.value)' value='2' id='ac' name='disp_mode'>
				  <span class="checkmark"></span>
				</label>
			</fieldset>
		</div>
		<div class="col-md-3">
			<fieldset>
				<legend><span id='class1'>Class</span>/<span id='sec1'>Sec</span> Wise</legend>
				<div class='row'>
					<div class='col-md-6'>
						<select class='form-control' name='classs' id='classs' disabled >
							<option value=''>select Class</option>
							<?php
								if($class)
								{
									foreach($class as $class_code)
									{
										?>
											<option value='<?php echo $class_code->CLASS_NM; ?>'><?php echo $class_code->CLASS_NM; ?></option>
										<?php
									}
								}
							?>
						</select>
					</div>
					<div class='col-md-6'>
						<select class='form-control' name='sec' id='sec' disabled>
							<option value=''>Select Sec</option>
							<?php
								if($sec)
								{
									foreach($sec as $sec_code)
									{
										?>
											<option value='<?php echo $sec_code->SECTION_NAME; ?>'><?php echo $sec_code->SECTION_NAME; ?></option>
										<?php
									}
								}
							?>
						</select>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="col-md-6">
			<div class='row'>
				<div class='col-md-6'>
					<label id="date_from">Date From</label>
					<input type="date" class="form-control" id="date1" name="date1"> 
				</div>
				<div class='col-md-6'>
					<label>To</label>
					<input type="date" class="form-control" id="date2" name="date2"> 
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
			<center><button class='btn btn-success btn-sm'>Display</button></center>
		</div>
	</div>
</form>
<div id="load_data"></div>
</div><br />
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<script>
function dt(val)
{
	 if(val==1)
	 {
		$('#classs').prop('disabled', false);
		$('#sec').prop('disabled', false);
	 }
	 else{
		$('#classs').prop('disabled',true);
		$('#sec').prop('disabled', true);
	 }
}
$("#data_id").on("submit", function (event) {
event.preventDefault();
	var cw = $('#cw').val();
	var ac = $('#ac').val();
	var classs = $('#classs').val();
	var sec = $('#sec').val();
	var date1 = $('#date1').val();
	var date2 = $('#date2').val();
	if( $('#cw').is(":checked") || $('#ac').is(":checked") ){
		if( $('#cw').is(":checked") ){
			$('#dm').css("color","black");
			if(classs!=''){
				$('#class1').css("color","black");
				if(sec!=''){
					$('#sec1').css("color","black");
						//=======================//
						$.ajax({
							url : "<?php echo base_url('Admission_registar/student_register_class'); ?>",
							type: "POST",
							data: $('#data_id').serialize(),
							beforeSend:function(){
								$('.loader').show();
								$('body').css('opacity', '0.5');
							},
							success: function(data){
								$('.loader').hide();
								$('body').css('opacity', '1.0');
								$("#load_data").html(data);
							},
						});
					
				}else{
					$('#sec1').css("color","red");
				}
			}
			else{
				$('#class1').css("color","red");
			}
		}
		else if( $('#ac').is(":checked") ){
			$('#dm').css("color","black");
				if(date1 !='' && date2 !=''){
					$('#date_from').css("color","black");
					$.ajax({
					url : "<?php echo base_url('Admission_registar/student_details_date_wise'); ?>",
					type: "POST",
					data: $('#data_id').serialize(),
					beforeSend:function(){
						$('.loader').show();
						$('body').css('opacity', '0.5');
					},
					success: function(data){
						$('.loader').hide();
						$('body').css('opacity', '1.0');
						$("#load_data").html(data);
					},
				});
			}
			else{
				alert("Please Select Date From AND To");
				$('#date_from').css("color","red");
			}
		}
	}
	else
	{
		$('#dm').css("color","red");
	}
});
</script>