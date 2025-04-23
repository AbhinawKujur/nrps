<style>
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 23px;
	}

	.switch input { 
	  opacity: 0;
	  width: 0;
	  height: 0;
	}

	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	.slider:before {
	  position: absolute;
	  content: "";
	  height: 15px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}

	input:checked + .slider {
	  background-color: #2196F3;
	}

	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}

	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}

	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}

	.slider.round:before {
	  border-radius: 50%;
	}
</style>
<table class='table' id='tbl1'>
	<thead>
		<tr>
			<th style='background:#337ab7; color:#fff !important;'>Subject</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Exam Date</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Start Time</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Exam Duration</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Applicable for all Student</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Status</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Add Question</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'> Question</th>
			<th style='background:#337ab7; color:#fff !important;text-align:center;'>Copy Question</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(!empty($getData)){
				foreach($getData as $key => $val){
					$id	=$val['id'];
					$allotedqus			=$this->alam->selectA('online_exam_question','count(id) as tot_qus',"schedule_id='$id'");
					$allot_ques			=(!empty($allotedqus[0]['tot_qus']))?$allotedqus[0]['tot_qus']:'0';
					?>
						<tr>
							<td><?php echo $val['subjnm']; ?></td>
							<td style='text-align:center;'><?php echo date('d-M-Y',strtotime($val['exam_date'])); ?></td>
							<td style='text-align:center;'><?php echo $val['start_time']; ?></td>
							<td style='text-align:center;'><?php echo $val['duration']; ?></td>
							<td><center><?php echo ($val['conduct_stu_status'] == 0)?'<a class="label label-success" onclick="viewStus('.$val['id'].')">YES</a>':'<a class="label label-danger" onclick="viewStus('.$val['id'].')">NO</a>'; ?></center></td>
							<td>
								<label class="switch" onchange="onoff(<?php echo $val['id']; ?>)">
								<?php
									if($val['display_status'] == 1){
										?>
											<input type="checkbox" id='examonoff_<?php echo $val['id']; ?>' checked>
											<span class="slider"></span>
										<?php
									}else{
										?>
											<input type="checkbox" id='examonoff_<?php echo $val['id']; ?>'>
											<span class="slider"></span>
										<?php
									}
								?>
								  
								</label>
							</td>
							<td><center><a href='<?php echo base_url('onlineexam/teacher/addquestion/AddExamQuestion/addquestion/'.$val['id']); ?>' class='label label-danger'>Add</a></center></td>
							<td style="border: 1px solid #bbb0b0;"><a class='label label-warning' onclick="viewQue(<?php echo $val['id']; ?>)">Questions <?=$allot_ques;?></a></td>
						<?php	if($allot_ques>0){?>
							<td><center><a href='<?php echo base_url('onlineexam/teacher/addquestion/CopyQuestions/index/'.$val['id']); ?>' class='label label-info'>Copy</a></center></td>
							<?php } else{ ?>
							<td><center><a href='#' class='label label-info' disabled>Copy</a></center></td>
							<?php } ?>
						</tr>
					<?php
				}
			}
		?>
	</tbody>
</table>
<!-- Modal -->
<div id="scheduledStuList" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Student's List</h4>
      </div>
      <div class="modal-body">
        <div id='load_stus'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Queation Modal -->
	<div id="quemodal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content modal-lg">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Question</h4>
		  </div>
		  <div class="modal-body" id='load'>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>
	<!-- End Queation Modal -->
<script>
	  $(function () {
		$('#tbl1').DataTable({	
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'autoWidth'   : true,
		  aaSorting: [[0, 'asc']]
		})
	  });	
	  
	  function onoff(id){
		  var chkbox = $("#examonoff_"+id).prop('checked') ? 1: 0;
			$.ajax({
				url: "<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule/displayStatus'); ?>",
				type: "POST",
				data: {id:id,chkbox:chkbox},
				success: function(ret){
					alert_msg('Success',ret,'success');
				}
			}); 
	  }
	  
	  function examScheduleEdit(id){
		  $.ajax({
				url: "<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule/examScheduleEdit'); ?>",
				type: "POST",
				data: {id:id},
				success: function(ret){
					$(".loadEdit").html(data);
				}
			}); 
	  }
	  
	  function viewStus(id){
		  $.ajax({
				url: "<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule/viewScheduledStuList'); ?>",
				type: "POST",
				data: {id:id},
				success: function(ret){
					$("#load_stus").empty().append(ret);
					$("#scheduledStuList").modal({
						backdrop: 'static',
						keyboard: false
					});
				}
			}); 
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
	
	function viewQue(id){
	$.ajax({
		url: "<?php echo base_url('onlineexam/teacher/exam_schedule/ExamSchedule/viewModal1'); ?>",
		type: "POST",
		data: {id:id},
		success: function(data){
			$("#load").html(data);
			$("#quemodal").modal('show');
		}
	}); 
 }
</script>