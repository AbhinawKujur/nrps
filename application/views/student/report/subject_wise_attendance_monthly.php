<style>
  button.dt-button, div.dt-button, a.dt-button {
	  padding:2px;
  }
  .dataTables_paginate .paginate_button.current {
	 padding:2px;  
  }
</style>
<?php
$date = date('d-M-Y');
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Student Attendance</a> <i class="fa fa-angle-right"></i> 
	Subject Wise Monthly Attendance	Report</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
   <div class="col-sm-3">
   <form id='form'>
    <table class="table">
	    <tr>
		  <th>Class</th>
		  <td colspan='3' align='center'>
		    <select class="form-control" onchange='clses(this.value)' name='classs' id="classs" required>
			  <option value=''>Select</option>
			  <?php
			    if(isset($classData)){
					foreach($classData as $data){
						?>
						  <option value="<?php echo $data['Class_no']; ?>"><?php echo $data['classnm']; ?></option>
						<?php
					}
				}
			  ?>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Sec</th>
		  <td colspan='3' align='center'>
		    <select class="form-control" name="sec" id="sec" required>
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
		
		<tr id='subjHide'>
		  <th>Subject</th>
		  <td colspan='3' align='center'>
		    <select class="form-control" name="subj" id="subj" required>
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Month</th>
		  <td colspan='3' align='center'>
		    <select class="form-control" name="month" id="month" required>
			  <option value=''>Select</option>
			  <?php
				foreach($month_master as $key => $val){
					?>
						<option value='<?php echo $val['month_code']; ?>'><?php echo $val['month_name']; ?></option>
					<?php
				}
			  ?>
		    </select>
		  </td>
	    </tr>
		
		<input type="hidden" name="att_type" id="att_type">
		
		<tr>
		  <td colspan='2' align='center'><button type="submit" id='btn' class='btn btn-success btn-xs'><i class="fa fa-circle-o-notch fa-spin" style='display:none; color:#fff' id='process'></i> Submit</button></td>
		</tr>
	  </table>
	  </form>
   </div>
   
   <div class='col-sm-9'>
     <div id="load_data" style='height:350px; overflow:auto;'>
	    <h3><center>No Data Found</center></h3>
	 </div>
   </div>
   
  </div>
</div>
<br /><br />


<!-- /.modal -->
<script type="text/javascript">
   $('#dt').datepicker({ 
	format: 'dd-M-yyyy',
	autoclose: true 
   });
  
  function clses(val){
	  $("#load_data").html('');
		$.post("<?php echo base_url('student/report/SubjectWiseMonthlyAttendanceReport/loadSec'); ?>",{class_id:val},function(data){
		  var fill = $.parseJSON(data);
		  $("#sec").html(fill[0]);
		  $("#att_type").val(fill[1]);
		  $("#subj").html(fill[2]);
		  
		  var att_type = $("#att_type").val();
		  if(att_type != 3){
			  $("#subjHide").hide();
		  }else{
			  $("#subjHide").show(); 
		  }
	  });
  }
  
  $("#form").on("submit", function (event) {
	$("#load_data").html(''); 
	$("#btn").prop('disabled',true);
	$("#process").show();	
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('student/report/SubjectWiseMonthlyAttendanceReport/subjectWiseReport'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			$("#load_data").html(data);
			$("#btn").prop('disabled',false);
			$("#process").hide();
		}
	});
 });
</script>
