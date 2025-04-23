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
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Homework</a> <i class="fa fa-angle-right"></i> Edit Homework </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <?php
	$class      = $editQue[0]['classnm'];
	$sec        = $editQue[0]['secnm'];
	$subject    = $editQue[0]['subjnm'];
	$id         = $editQue[0]['id'];
	
	$class_id      = $editQue[0]['classes'];
	$sec_id        = $editQue[0]['sec'];
	$subject_id    = $editQue[0]['subject'];
	$submitDate = date('d-M', strtotime($editQue[0]['submitDate']));
  ?>		
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
		<form action='<?php echo base_url('e_exam/homework/AddHomework/editSaveQuestion'); ?>' method='post' autocomplete='off' enctype='multipart/form-data'>
		<input type='hidden' name='upd_id' value='<?php echo $id; ?>'>
		<table class='table'>
			<tr>
				<th>Class</th>
				<td>
					<select class='form-control' name='class' id='cls' onchange='clses(this.value)'>
						<option value='<?php echo $class_id; ?>'><?php echo $class; ?></option>
					</select>
				</td>
				
				<th>Section</th>
				<td>
					<select class='form-control' name='sec' id='section' onchange='sectn(this.value)'>
						<option value='<?php echo $sec_id; ?>'><?php echo $sec; ?></option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Subject</th>
				<td>
					<select class='form-control' name='subject' id='subj' onchange='insertValidation()'>
						<option value='<?php echo $subject_id; ?>'><?php echo $subject; ?></option>
					</select>
				</td>
				
				<th>Submission Date</th>
				<td><input type='text' name='submitDate' id='examDate' class='form-control examDt' value='<?php echo $submitDate; ?>' readonly></td>
			</tr>
			
			<?php
				if(!empty($editQueAppnd)){
					foreach($editQueAppnd as $key => $val){
			?>
			
			<tr>
				<td id='load_topic' colspan='5'>
					<input type='hidden' name='que_id[]' value='<?php echo $val['id']; ?>'>
					<input type='hidden' name='img_path[]' value='<?php echo $val['que_img']; ?>'>
					<input type='hidden' name='lastQueNo' value='<?php echo $key + 1; ?>'>
					<textarea type='text' name='question[]' id='topic_<?=$key;?>' class='form-control topic' required rows='4'><?php echo $val['question']; ?></textarea>
					<div class='row'>
						<div class='col-sm-4'>
							<select class='form-control' name='question_type[]' required>
								<option value=''>Que. Type</option>
								<option value='1' <?php if($val['question_type'] == 1){ echo "selected"; } ?>>Subjective</option>
								<option value='2' <?php if($val['question_type'] == 2){ echo "selected"; } ?>>Objective</option>
							</select>
						</div>
						<div class='col-sm-4'>
							<?php
								if($val['que_img'] != ''){
									?>
										<center><a href='<?php echo base_url($val['que_img']); ?>' download><i class="fa fa-download"></i> DOWNLOAD</a></center>
										<span style='color:red; font-size:12px;'>Note:- Question is Already an Attached File.If You Upload Again "Previous File" will be lost. </span>
										
									<?php
								}
							?>
						</div>
						<div class='col-sm-4'><input type='file' name='img[]' class='form-control' id='filePHOTO_1' onchange='imgValidaye(this)'></div>
					</div>
					<br />
				</td>
				<?php
					if($key == 0){
				?>
				<td colspan='6' align='center'>
					<button onclick='addTopic()' type='button' title='Add more Topics' class='btn btn-success btn-xs pull-left'><i class="fa fa-plus" style='color:#fff;'></i></button>
				</td>
				<?php }?>
			</tr>
			
			<script>
			CKEDITOR.replace( 'topic_'+<?=$key?>,
            {   
			 uiColor: '#CCEAEE',
			 
			}
         ); 
			
			</script>
			
			
			<?php		
					}
				}
			?>
			
			<tr>
				<td colspan='6'><center><button id='btn' class='btn btn-success'><i class="fa fa-circle-o-notch fa-spin" id='process' style='color:#fff; display:none'></i> Update </button></center></td>
			</tr>
			<tr>
				<td colspan='6' style='color:red'> <b>Note:</b><ul>
				<li> Press <button class='btn btn-success btn-xs'><i class="fa fa-plus" style='color:#fff;'></i></button> To Add New Question.</li>
				<li> Press Update Button After You Will Add All Questions for Selected subject.</li>
				

				</ul>
				</td>
			</tr> 
		</table>
		</form>
	</div>
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
	  $.post("<?php echo base_url('e_exam/homework/AddHomework/loadSec'); ?>",{class_id:val},function(data){
		  $("#section").html(data);
	  });
  }
  
  function sectn(val){
	  var cls = $("#cls").val();
	  $.post("<?php echo base_url('e_exam/homework/AddHomework/loadSubj'); ?>",{sec_id:val,cls:cls},function(data){
		  $("#subj").html(data);
	  });
  }
   
  function disabled(){
	$(".btn").attr('disabled',true);
  }
  
  function insertValidation(){
	 let cls = $("#cls").val();
	 let section = $("#section").val();
	 let subj = $("#subj").val();
	 $.ajax({
		 url: "<?php echo base_url('e_exam/homework/AddHomework/insertValidation'); ?>",
		 type: "POST",
		 data: {cls:cls,section:section,subj:subj},
		 success: function(ret){
			 if(ret == 1){
				$("#btn").attr('disabled',false); 
			 }else{
				 $.toast({
					heading: 'Error',
					text: 'Subject Already Assigned',
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
	 
    $("#addQuestionForm").on("submit", function (event) {
    event.preventDefault();
	$("#btn").prop('disabled',true);
	$("#process").show();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('e_exam/homework/AddHomework/editSaveQuestion'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				$("#btn").prop('disabled',false);
				$("#process").hide();
				$("#addQuestionForm").trigger("reset");
				window.location='<?php echo base_url("e_exam/homework/AddHomework"); ?>';
				
				setTimeout(function(){ 
					location.reload();
				}, 2000);
			}
		});
	 });
	 CKEDITOR.replace( 'topic_1',
            {   
			
			}
         ); 
 var i = 2;		
 function addTopic(){
	 var topic = "<input type='hidden' name='que_id[]' value=''><input type='hidden' name='img_path[]' value=''><div id='rmov_"+i+"'><textarea type='text' name='question[]' id='topic_"+i+"' class='form-control' required rows='4'></textarea><div class='row'><div class='col-sm-4'><select class='form-control' name='question_type[]' required><option value=''>Que. Type</option><option value='1'>Subjective</option><option value='2'>Objective</option></select></div><div class='col-sm-4'><input type='file' name='img[]' onchange='imgValidaye(this)' id='filePHOTO_"+i+"' class='form-control'></div><div class='col-sm-4'><button title='Remove' type='button' class='btn btn-danger btn-xs pull-right' onclick='rmv("+i+")'><i class='fa fa-trash' style='color:#fff;'></i></button></div></div><br /></div>";
	 
	 $("#load_topic").append(topic);
	 CKEDITOR.replace('topic_'+i);	
	 i++;
 }
 
 function rmv(divId){
	 $("#rmov_"+divId).remove();
 }
 
 function edit(id){
	$.ajax({
		url: "<?php echo base_url('e_exam/homework/AddHomework/edit'); ?>",
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
		if(file_size > 1048576 || (ext != 'jpg') && (ext != 'jpeg') && (ext != 'png') && (ext != 'pdf')){
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
 
 function viewQue(cls,sec,subject,created_at){
	$.ajax({
		url: "<?php echo base_url('e_exam/homework/AddHomework/viewModal'); ?>",
		type: "POST",
		data: {cls:cls,sec:sec,subject:subject,created_at:created_at},
		success: function(data){
			$("#load").html(data);
			$("#quemodal").modal('show');
		}
	}); 
 }
 
 function onoff(key,cls,sec,subject,examDate){	
	var chkbox = $("#examonoff_"+key).prop('checked') ? 1: 0;
	$.ajax({
		url: "<?php echo base_url('e_exam/homework/AddHomework/viewExamStatus'); ?>",
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