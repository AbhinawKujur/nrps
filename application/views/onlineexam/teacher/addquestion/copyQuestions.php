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
    <li class="breadcrumb-item"><a href="#">Class Assessment</a> <i class="fa fa-angle-right"></i> Copy Questions </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
    <div class='loadEdit'>
	<form class="form-inline" id="exam_schedule">
		<div class='row'>
			<div class='col-sm-3'>
				<label>Exam <span>*</span></label>
				<input type=" text" name="" readonly  class="form-control" value="<?=$schedule[0]['exam_name'];?>" />
			<input type="hidden" name='exam' id='exam'  readonly class="form-control" value="<?=$schedule[0]['exam_id'];?>" />
			<input type="hidden" name='schedulid' id='schedulid'  readonly class="form-control" value="<?=$schedule[0]['id'];?>" />
			</div>

			<div class='col-sm-3'>
				<label>Class <span>*</span></label>
				<input type=" text" name=""  readonly class="form-control" value="<?=$schedule[0]['CLASS_NM'];?>" />
				<input type="hidden" name='class' id='class'  readonly class="form-control" value="<?=$schedule[0]['class_id'];?>" />
			</div>	
			
			<div class='col-sm-3'>	
				<label>Section <span>*</span></label><br />
				<select name='section[]' id='section'  class="form-control" multiple="multiple" style="width:100%;" >
					
					<?php
						if(!empty($section)){
							foreach($section as $key => $val){
								?>
									<option value='<?php echo $val['section_no']; ?>'><?php echo $val['secnm']; ?></option>
								<?php
							}
						}
					?>
				</select>
				
			</div>
			
			<div class='col-sm-3'>
			<label>Subject <span>*</span></label><br />
				<input type=" text" name=""  class="form-control" value="<?=$schedule[0]['SubName'];?>" />
				<input type="hidden" name='subject' id='subject' class="form-control" value="<?=$schedule[0]['subject_id'];?>" />
			</div>	
		</div><br />
		
		<div class='row'>
			<div class='col-sm-3'>
			<label>Exam Pattern <span>*</span></label><br />
				<input type=" text" readonly name=""  class="form-control" value="<?php if($schedule[0]['exam_pattern']==1){echo 'Sbjective';}elseif($schedule[0]['SubName']==2){echo 'Objective';}else{echo 'Both';}?>" />
				<input type="hidden" name='exam_pattern' id='exam_pattern' class="form-control" value="<?=$schedule[0]['exam_pattern'];?>" />
			</div>

			<div class='col-sm-3'>
			<label>Exam Date <span>*</span></label><br />
				<input type="text" name='exam_date' id='exam_date' value="<?=$schedule[0]['exam_date'];?>" class="form-control exam_date" required readonly>
			</div>

			<div class='col-sm-3'>
			<label>Start Time <span>*</span></label><br />
				<input type="text" name='start_time' id='start_time' value="<?=$schedule[0]['start_time'];?>" class="form-control clockpicker" autocomplete="off"  placeholder="00:00" readonly="" required >
			</div>

			<div class='col-sm-3'>
			<label>End Time <span>*</span></label><br />
				<input type="text" name='end_time' id='end_time' class="form-control clockpicker" autocomplete="off"  placeholder="00:00" readonly="" required value="<?=$schedule[0]['end_time'];?>">
			</div>	
		</div><br />
		
		<div class='row'>
			<div class='col-sm-3'>
			<label>Exam Duration </label><br />
				<input type="text"value="<?=$schedule[0]['duration'];?>" name='exam_duration' id='exam_duration' class="form-control" required readonly>
			</div>
			
			<div class='col-sm-3'>
			<label>Max Marks <span>*</span></label><br />
				<input type="number" name='max_marks' readonly id='max_marks' class="form-control" value="<?=$schedule[0]['max_marks'];?>" required>
			</div>
			
			<div class='col-sm-3'>
			<label>Max Question <span>*</span></label><br />
				<input type="number" readonly name='max_questions' id='max_questions' value="<?=$schedule[0]['max_question'];?>" class="form-control" required>
			</div>
			
			<div class='col-sm-3'>
			<label>Applicable for all Students <span>*</span></label><br />
				<select name='conduct_all' id='conduct_all' class="form-control" required onchange='stuModal(this.value)'>
					<option value=''>Select</option>
					<option value='0' selected="selected">YES</option>
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
				<button type='submit' class='btn btn-success' id='save_btn' ><i class="fa fa-circle-o-notch fa-spin" id='process' style='display:none'></i> SUBMIT</button>
			</div>
		</div>
	</form>
	</div>
</div><br />
	
<script type="text/javascript">
	$("#section").select2();
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
  	$("#save_btn").prop('disabled',true);
	$("#process").show();
    event.preventDefault();
	var conduct_all = $("#conduct_all").val();
	var exam_date  	= $("#exam_date").val();
	var start_time 	= $("#start_time").val();
	var end_time   	= $("#end_time").val();
	if(exam_date != '' && start_time != '00:00' && end_time != '00:00'){	
		$.ajax({		
			url: "<?php echo base_url('onlineexam/teacher/addquestion/CopyQuestions/examScheduleSave'); ?>",
			type: "POST",
			data: $("#exam_schedule").serialize(),
			success: function(data){
			$("#process").hide();
			$("#save_btn").prop('disabled',false);
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