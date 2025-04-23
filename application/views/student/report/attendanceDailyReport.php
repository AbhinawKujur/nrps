<style type="text/css">
 
</style>
<?php
$date = date('d-M-Y');
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('punching/manualpunch'); ?>">Student</a> <i class="fa fa-angle-right"></i> Daily Wise Attendance</li>
</ol>
<!-- Content Wrapper. Contains page content -->
<div style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
	<div class='row'>
	  <div class='col-sm-6'><br /><br />
	  <form id='form'>
	    <table class='table'> 
			<tr>
				<th>Date &nbsp;&nbsp;&nbsp;<input type='text' name='Cdate' value='<?php echo date('d-M-Y'); ?>' required class='dt'> &nbsp;&nbsp;&nbsp;<button type='submit' class='btn btn-success btn btn-sm'><i class="fa fa-circle-o-notch fa-spin" style='color:#fff; display:none;' id='process'></i> DISPLAY</button></th>
			</tr>
			<tr>
				<td colspan='2' align='center'></td>
			</tr>
	    </table>
		</form>	
	  </div>
	</div>
	
	<div class='row'>
		<div class='col-sm-12'>
			<div id='load'></div>
		</div>	
	</div>
</div>
<br /><br />

<script>
	$('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true });
	$("#form").on("submit", function (event) {
    event.preventDefault();
	$("#process").show();
	$("#load").html('');
    $.ajax({
		url: "<?php echo base_url('student/report/DailyReport/dailyAttendanceReport'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			$("#process").hide();
			$("#load").html(data);
		}
	});
 });
</script>