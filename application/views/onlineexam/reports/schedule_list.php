<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Exam Student Attendance Summary Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		white-space: nowrap !important;
	  }
</style>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id='form'>
		
		<div class='row'>
			<div class="col-md-4 form-group">
				<label id='ct'>Exam Date</label>
				<input type="date" name='exam_date' id='exam_date' class="form-control exam_date" required onchange='subjectt(this.value)'>
			</div>
			<div class='col-md-4 form-group'>
				<label id='fct'>Subject</label>
				<select name='subject' id='subject' class='form-control' required>
					<option value=''>Select</option>
				</select>
			</div>
			<div class='col-md-4 form-group' id='schooll'>
				<br>
				<button class="btn btn-success">Display</button>
			</div>
			
		<br />
		</div>
	</form>
	
	
</div><br />
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
	<div class='table-responsive' id='load_page'>
		
	</div>
</div><br />

<script>
	
	function subjectt(val){
		
	  $.post("<?php echo base_url('onlineexam/reports/Schedule_report/online_subject'); ?>",{val:val},function(data){
		  var fill = $.parseJSON(data);
		  $("#subject").html(fill[0]);
	  });
  }
	$("#form").on("submit", function (event) {
    event.preventDefault();
	    var exam_date = $('#exam_date').val();
		var subject = $('#subject').val();
		$.ajax({
			url:"<?php echo base_url('onlineexam/reports/Schedule_report/schedule_data'); ?>",
		    type: "POST",
			data:{exam_date:exam_date,subject:subject},
									success:function(data)
									{
										$('#load_page').html(data);
										
										$('#exam_date').val(exam_date);
										$('#subject').val(subject);
										
									}
								});
	});
</script>