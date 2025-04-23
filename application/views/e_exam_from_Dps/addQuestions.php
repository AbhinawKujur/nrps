<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
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
  height: 26px;
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

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Class Assessment</a> <i class="fa fa-angle-right"></i> Add Questions </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-12'>
	    <?php
			  if($this->session->flashdata('msg')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('msg'); ?>
					</div>
				  <?php
			  }
		?>
		<form id='addQuestionForm' method='post' autocomplete='off' enctype='multipart/form-data'>
		<table class='table'>
			<tr>
				<th>Class</th>
				<td>
					<select class='form-control' name='class' id='cls' required onchange='clses(this.value)'>
						<option value=''>Select</option>
						<?php
							if($classData){
								foreach($classData as $key => $val){
									?>
										<option value='<?php echo $val['Class_no']; ?>'><?php echo $val['classnm']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</td>
				
				<th>Section</th>
				<td>
					<select class='form-control' name='sec' id='section' required onchange='sectn(this.value)'>
						<option value=''>Select</option>
					</select>
				</td>
				
				<th>Subject</th>
				<td>
					<select class='form-control' name='subject' required id='subj'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			
			<tr>
				
				
				<th>Exam Date</th>
				<td><input type='text' name='examDate' id='examDate' class='form-control examDt' required onchange='insertValidation()'></td>
				
				<th>Exam Time</th>
				<td><input type='text' name='examTime'  class='form-control timepicker' required></td>
				
				<th>Exam Time Duration</th>
				<td>
					<select class='form-control' name='examTimeDuration' required>
						<option value=''>Select</option>
						<option value='30'>30 Min</option>
						<option value='40'>40 Min</option>
						<option value='60'>60 Min</option>
						<option value='90'>90 Min</option>
						<option value='120'>120 Min</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Questions</th>
				<td id='load_topic' colspan='5'>
					
					<textarea type='text' name='question[]' id='topic' class='form-control topic' required rows='4'></textarea>
					<div class='row'>
						<div class='col-sm-4'>
							<select class='form-control' name='question_type[]' required>
								<option value=''>Que. Type</option>
								<option value='1'>Subjective</option>
								<option value='2'>Objective</option>
							</select>
						</div>
						<div class='col-sm-4'><input type='file' name='img[]' class='form-control' id='filePHOTO_1' onchange='imgValidaye(this)'></div>
						<div class='col-sm-4'><input min='0' type='number' placeholder='Max Marks' name='max_marks[]' class='form-control' required></div>
					</div>
					<br />
				</td>
				<td colspan='6' align='center'>
					<button onclick='addTopic()' type='button' title='Add more Topics' class='btn btn-success btn-xs pull-left'><i class="fa fa-plus-square" style='color:#fff;'></i></button>
				</td>
			</tr>
			
			<tr>
				<td colspan='6'><center><button id='btn' class='btn btn-success' disabled><i class="fa fa-circle-o-notch fa-spin" id='process' style='color:#fff; display:none'></i> SAVE </button></center></td>
			</tr>
		</table>
		</form>
	</div>
	</div>
	
	<div class='row'>
    <div class='col-sm-12'>
    <div class='table-responsive' id='load1'>
	<table class='table dataTable'>
	<thead>
		<tr>
			<th style='color:#fff !important; background:#5785c3;'>Class</th>
			<th style='color:#fff !important; background:#5785c3;'>Sec</th>
			<th style='color:#fff !important; background:#5785c3;'>Subject</th>
			<th style='color:#fff !important; background:#5785c3;'>Que.</th>
			<th style='color:#fff !important; background:#5785c3;'>Exam Date</th>
			<th style='color:#fff !important; background:#5785c3;'>Exam Time</th>
			<th style='color:#fff !important; background:#5785c3;'>Exam Time Duration</th>
			<th style='color:#fff !important; background:#5785c3;'>Action</th>
		</tr>
	</thead>	
	<tbody>
		<?php
			foreach($e_exam_questions as $key => $val){
				?>
					<tr>
						<td><?php echo $val['classnm']; ?></td>
						<td><?php echo $val['secnm']; ?></td>
						<td><?php echo $val['subjnm']; ?></td>
						<td><a class='label label-warning' onclick="viewQue(<?php echo $val['classes']; ?>,<?php echo $val['sec']; ?>,<?php echo $val['subject']; ?>,'<?php echo $val['examDate']; ?>','<?php echo $val['examTime']; ?>')">Questions</a></td>
						<td><?php echo $val['examDate']; ?></td>
						<td><?php echo $val['examTime']; ?></td>
						<td><?php echo $val['examTimeDuration']." MIN"; ?></td>
						<td>
							<label class="switch" onchange="onoff(<?php echo $key; ?>,<?php echo $val['classes']; ?>,<?php echo $val['sec']; ?>,<?php echo $val['subject']; ?>,'<?php echo $val['examDate']; ?>')">
							<?php
								if($val['exam_display_status'] == 1){
									?>
										<input type="checkbox" id='examonoff_<?php echo $key; ?>' checked>
										<span class="slider"></span>
									<?php
								}else{
									?>
										<input type="checkbox" id='examonoff_<?php echo $key; ?>'>
										<span class="slider"></span>
									<?php
								}
							?>
							  
							</label>
						</td>
					</tr>
				<?php
			}
		?>
	</tbody>	
	</table>
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
	
	</div>
	</div><br />
	
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
   $('.examDt').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
   //$('.timepicker').pickatime({});
   $('.timepicker').timepicker();
   $("#multiselect").select2();
	
   $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      aaSorting: [[0, 'asc']]
    })
  });
  
  function clses(val){
	  $.post("<?php echo base_url('e_exam/AddQuestions/loadSec'); ?>",{class_id:val},function(data){
		  $("#section").html(data);
	  });
  }
  
  function sectn(val){
	  var cls = $("#cls").val();
	  $.post("<?php echo base_url('e_exam/AddQuestions/loadSubj'); ?>",{sec_id:val,cls:cls},function(data){
		  $("#subj").html(data);
	  });
  }
   
  function disabled(){
	$(".btn").attr('disabled',true);
  }
	 
    $("#addQuestionForm").on("submit", function (event) {
    event.preventDefault();
	$("#btn").prop('disabled',true);
	$("#process").show();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('e_exam/AddQuestions/saveQuestion'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				$("#btn").prop('disabled',false);
				$("#process").hide();
				$("#addQuestionForm").trigger("reset");
				$.toast({
					heading: 'Success',
					text: 'Save Successfully..!',
					showHideTransition: 'slide',
					icon: 'success',
					position: 'top-right',
				});
				setTimeout(function(){ 
					location.reload();
				}, 2000);
			}
		});
	 });
	 
 var i = 2;		
 function addTopic(){
	 var topic = "<textarea type='text' name='question[]' id='topic' class='form-control' required rows='4'></textarea><div class='row'><div class='col-sm-4'><select class='form-control' name='question_type[]' required><option value=''>Que. Type</option><option value='1'>Subjective</option><option value='2'>Objective</option></select></div><div class='col-sm-4'><input type='file' name='img[]' onchange='imgValidaye(this)' id='filePHOTO_"+i+"' class='form-control'></div><div class='col-sm-4'><input min='0' type='number' placeholder='Max Marks' name='max_marks[]' class='form-control' required></div></div><br />";
	 
	 $("#load_topic").append(topic);
	 i++;
 }
 
 function edit(id){
	$.ajax({
		url: "<?php echo base_url('e_exam/AddQuestions/edit'); ?>",
		type: "POST",
		data: {id:id},
		success: function(data){
			$("#load").html(data);
		}
	}); 
 }
 
 $(".filePHOTO").change(function(){
	var file_size = $('.filePHOTO')[0].files[0].size;
	var ext = $('.filePHOTO').val().split('.').pop().toLowerCase();
		if(file_size > 1048576 || (ext != 'jpg') && (ext != 'jpeg') && (ext != 'png')){
			$.toast({
				heading: 'Error',
				text: 'File size must be less than 1000kb and only allowed jpg,jpeg,png format',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
			});
			$(".filePHOTO").val('');
		}
	return true;
});

 function imgValidaye(id){
	 var str = id.id;
	 var splt = str.split("_");
	 var id = splt[1];
	 
	 var file_size = $('#filePHOTO_'+id)[0].files[0].size;
	 var ext = $('#filePHOTO_'+id).val().split('.').pop().toLowerCase();
		if(file_size > 1048576 || (ext != 'jpg') && (ext != 'jpeg') && (ext != 'png')){
			$.toast({
				heading: 'Error',
				text: 'File size must be less than 1000kb and only allowed jpg,jpeg,png format',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
			});
			$("#filePHOTO_"+id).val('');
		}
	 return true;
 }
 
 function insertValidation(){
	 let cls = $("#cls").val();
	 let section = $("#section").val();
	 let subj = $("#subj").val();
	 let examDate = $("#examDate").val();
	 $.ajax({
		 url: "<?php echo base_url('e_exam/AddQuestions/insertValidation'); ?>",
		 type: "POST",
		 data: {cls:cls,section:section,subj:subj,examDate:examDate},
		 success: function(ret){
			 if(ret == 1){
				$("#btn").attr('disabled',false); 
			 }else{
				 $.toast({
					heading: 'Error',
					text: 'Exam Already scheduled',
					showHideTransition: 'slide',
					icon: 'error',
					position: 'top-right',
				 });
				$("#addQuestionForm").trigger("reset");
				$("#btn").attr('disabled',true);
			 }
		 }
	 });
 }
 
 function viewQue(cls,sec,subject,examDate,examTime){
	$.ajax({
		url: "<?php echo base_url('e_exam/AddQuestions/viewModal'); ?>",
		type: "POST",
		data: {cls:cls,sec:sec,subject:subject,examDate:examDate,examTime:examTime},
		success: function(data){
			$("#load").html(data);
			$("#quemodal").modal('show');
		}
	}); 
 }
 
 function onoff(key,cls,sec,subject,examDate){	
	var chkbox = $("#examonoff_"+key).prop('checked') ? 1: 0;
	$.ajax({
		url: "<?php echo base_url('e_exam/AddQuestions/viewExamStatus'); ?>",
		type: "POST",
		data: {cls:cls,sec:sec,subject:subject,examDate:examDate,chkbox:chkbox},
		success: function(ret){
			$.toast({
				heading: 'Success',
				text: ret,
				showHideTransition: 'slide',
				icon: 'success',
				position: 'top-right',
			 });
		}
	}); 
 }
 
</script>