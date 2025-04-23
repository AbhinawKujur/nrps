<style>
	form span{
		color:red;
	}
	form label{
		font-size:14px;
	}
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		white-space: nowrap !important;
	  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Class Assessment</a> <i class="fa fa-angle-right"></i> Exam Schedule </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
    <div class='loadEdit'>
	<form class="form-inline" id="exam_schedule">
		<div class='row'>
			<div class='col-sm-3'>
				<label>Exam <span>*</span></label><br />
				<select name='exam' id='exam' class="form-control" required>
					<option value=''>Select</option>
					<?php
						if(!empty($examMaster)){
							foreach($examMaster as $key => $val){
								?>
									<option value='<?php echo $val['id']; ?>'><?php echo $val['exam_name']; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>

			<div class='col-sm-3'>
				<label>Class <span>*</span></label><br />
				<select name='class' id='cls' class="form-control" required onchange='getSec(this.value)'>
					<option value=''>Select</option>
					<?php
						if(!empty($classData)){
							foreach($classData as $key => $val){
								?>
									<option value='<?php echo $val['Class_no']; ?>'><?php echo $val['classnm']; ?></option>
								<?php
							}
						}
					?>
				</select>
			</div>	
			
			<div class='col-sm-3'>	
				<label>Section <span>*</span></label><br />
				<select name='section' id='section' class="form-control" required onchange='getSubj()'>
					<option value=''>Select</option>
				</select>
			</div>
			
			<div class='col-sm-3'>
			<label>Subject <span>*</span></label><br />
				<select name='subject' id='subject' class="form-control" required onchange='subj()'>
					<option value=''>Select</option>
				</select>
			</div>	
		</div><br />
		
		<div class='row'>
			<div class='col-sm-3'>
			<label>Exam Pattern <span>*</span></label><br />
				<select name='exam_pattern' id='exam_pattern' class="form-control" required>
					<option value=''>Select</option>
					<?php
						foreach($exam_pattern as $key => $val){
							?>
								<option value='<?php echo $key; ?>'><?php echo $val; ?></option>
							<?php
						}
					?>
				</select>
			</div>

			<div class='col-sm-3'>
			<label>Exam Date <span>*</span></label><br />
				<input type="text" name='exam_date' id='exam_date' class="form-control exam_date" required readonly>
			</div>

			<div class='col-sm-3'>
			<label>Start Time <span>*</span></label><br />
				<input type="text" name='start_time' id='start_time' class="form-control clockpicker" autocomplete="off" value="00:00" placeholder="00:00" readonly="" required onchange="timeCalculatingEdit()">
			</div>

			<div class='col-sm-3'>
			<label>End Time <span>*</span></label><br />
				<input type="text" name='end_time' id='end_time' class="form-control clockpicker" autocomplete="off" value="00:00" placeholder="00:00" readonly="" required onchange="timeCalculatingEdit()">
			</div>	
		</div><br />
		
		<div class='row'>
			<div class='col-sm-3'>
			<label>Exam Duration </label><br />
				<input type="text" placeholder="00:00" name='exam_duration' id='exam_duration' class="form-control" required readonly>
			</div>
			
			<div class='col-sm-3'>
			<label>Max Marks <span>*</span></label><br />
				<input type="number" name='max_marks' id='max_marks' class="form-control" onkeyup='maxmr(this.value)' required>
			</div>
			
			<div class='col-sm-3'>
			<label>Max Question <span>*</span></label><br />
				<input type="number" name='max_questions' id='max_questions' onkeyup='maxs(this.value)' class="form-control" required>
			</div>
			
			<div class='col-sm-3'>
			<label>Applicable for all Students <span>*</span></label><br />
				<select name='conduct_all' id='conduct_all' class="form-control" required onchange='stuModal(this.value)'>
					<option value=''>Select</option>
					<option value='0'>YES</option>
					<option value='1'>NO</option>
				</select>
			</div>
		</div>
		
		<!-- stu list modal -->	
		<div id="stuListModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Student's List</h4>
			  </div>
			  <div class="modal-body">
				
			  </div>
			  <div class="modal-footer">
				<button type="submit" class="btn btn-success" id='modal_save_btn' disabled>SUBMIT</button>
			  </div>
			</div>
		  </div>
		</div>
		<!-- end stu list modal -->
		<br /><br />	
		<div class='row'>
			<div class='col-sm-3'>
				<button type='submit' class='btn btn-success' id='save_btn' style='display:none'>SUBMIT</button>
			</div>
		</div>
	</form>
	</div>
</div><br />

<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
	<div class='table-responsive' id='load'>
	</div>
</div><br />
	
<script type="text/javascript">
  $('.exam_date').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
	
	function maxs(vals){
		if(vals==0){
			$("#max_questions").val('');
		}
	}
	
	function maxmr(vals){
		if(vals==0){
			$("#max_marks").val('');
		}
	}
  
  $("#exam_schedule").on("submit", function (event) {
    event.preventDefault();
	var conduct_all = $("#conduct_all").val();
	var exam_date  = $("#exam_date").val();
	var start_time = $("#start_time").val();
	var end_time   = $("#end_time").val();
	if(exam_date != '' && start_time != '00:00' && end_time != '00:00'){
		$.ajax({
			url: "<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule/examScheduleSave'); ?>",
			type: "POST",
			data: $("#exam_schedule").serialize(),
			success: function(data){
				if(data == 1){
					alert_msg('','Exam Scheduled Successfully..!','success');
					$("#exam_schedule")[0].reset();
					if(conduct_all == 1){
						$("#stuListModal").modal('hide');
					}
				}else{
					alert_msg('','Exam Already Scheduled..!','error');
				}
			}
		});
	}else{
		alert_msg('','Select Required Fields First','error');
	}
 });
 
 function getSec(val){
	  $.post("<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule/loadSec'); ?>",{class_id:val},function(data){
		  $("#section").html(data);
	  });
  }
  
  function getSubj(){
	  var cls = $("#cls").val();
	  var sec = $("#section").val();
	  $("#subject").val('');
	  $.post("<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule/loadSubj'); ?>",{cls:cls,sec:sec},function(data){
		  $("#subject").html(data);
	  });
  }
  
  function subj(){
	 $("#conduct_all").val('');
	 var cls  = $("#cls").val();
	 var sec  = $("#section").val();	
	 var subj = $("#subject").val();
	
	 $.ajax({
			url: "<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule/getScheduleData'); ?>",
			type: "POST",
			data: {cls:cls,sec:sec,subj:subj},
			success: function(data){
				$("#load").html(data);
			}
		});	
  }
  
  $('.clockpicker').clockpicker({
	placement: 'bottom',
	align: 'left',
	autoclose: true,
	'default': 'now',
	twelvehour: true
  });
  
  //time calculating at edit time
  function timeCalculatingEdit(){
    var time1 = $("#start_time").val();
    var time2 = $("#end_time").val();
    var time1 = time1.split(':');
    var time2 = time2.split(':');
    var hours1 = parseInt(time1[0], 10), 
    hours2 = parseInt(time2[0], 10),
    mins1 = parseInt(time1[1], 10),
    mins2 = parseInt(time2[1], 10);
    var hours = hours2 - hours1, mins = 0;
    if(hours < 0) hours = 12 + hours;
    if(mins2 >= mins1) {
        mins = mins2 - mins1;
    }
    else {
      mins = (mins2 + 60) - mins1;
      hours--;
    }
    if(mins < 9)
    {
      mins = '0'+mins;
    }
    if(hours < 9)
    {
      hours = '0'+hours;
    }
    $("#exam_duration").val(hours+':'+mins);
  }
  
  function stuModal(val){
	  var exam 		 = $("#exam").val();
	  var cls 		 = $("#cls").val();
	  var section    = $("#section").val();
	  var subject    = $("#subject").val();
	  var exam_pattern = $("#exam_pattern").val();
	  var exam_date  = $("#exam_date").val();
	  var start_time = $("#start_time").val();
	  var end_time   = $("#end_time").val();
	  var max_marks  = $("#max_marks").val();
	  var max_questions  = $("#max_questions").val();
	  if(val == 1){
		  if(exam != '' && cls != '' && section != '' && subject != '' && exam_pattern !='' && exam_date != '' && start_time != '00:00' && end_time != '00:00' && max_marks !='' && max_questions != ''){
			  $("#save_btn").hide();
			  $("#save_btn").prop('disabled',true);
			  $.ajax({
				url: "<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule/viewStuList'); ?>",
				type: "POST",
				data: {cls:cls,section:section},
				success: function(res){
					$(".modal-body").empty().append(res);
					$("#stuListModal").modal({
						backdrop: 'static',
						keyboard: false
					});
				}  
			  });
		  }else{
			alert_msg('Error','Select Required Fields First','error');
			$("#conduct_all").val('');
		  }
	  }else{
		$("#save_btn").show();
		$("#save_btn").prop('disabled',false);
	  }
  }
  
  function alert_msg(head,text,icon){
	  $.toast({
			heading: head,
			text: text,
			showHideTransition: 'slide',
			icon: icon,
			position: 'top-right',
		});
  }
</script>