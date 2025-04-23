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
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Homework</a> <i class="fa fa-angle-right"></i> Add Homework </li>
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
		<form action="<?=base_url('e_exam/homework/AddHomework/saveQuestion');?>" method='post' autocomplete='off' enctype='multipart/form-data'>
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
			</tr>
			
			<tr>
				<th>Subject</th>
				<td>
					<select class='form-control' name='subject' required id='subj' onchange='insertValidation(),queslist()'>
						<option value=''>Select</option>
					</select>
				</td>
				
				<th>Submission Date</th>
				<td><input type='text' name='submitDate' id='examDate' class='form-control examDt' required></td>
			</tr>
			
			<tr>
				<th>Questions</th>
				<td id='load_topic' colspan='5'>
					
					<textarea type='text' name='question[]' id='topic_1' class='form-control topic' required rows='4'></textarea>
					<div class='row'>
						<div class='col-sm-4'>
							<select class='form-control' name='question_type[]' required>
								<option value=''>Que. Type</option>
								<option value='1'>Subjective</option>
								<option value='2'>Objective</option>
							</select>
						</div>
						<div class='col-sm-4'><input type='file' name='img[]' class='form-control' id='filePHOTO_1' onchange='imgValidaye(this)'></div>
					</div>
					<br />
				</td>
				<td colspan='6' align='centet'>
					<button onclick='addTopic()' type='button' title='Add more Topics' class='btn btn-success btn-xs pull-left'><i class="fa fa-plus" style='color:#fff;'></i></button>
				</td>
			</tr>
			
			<tr>
				<td colspan='6'><center><button id='btn' class='btn btn-success'><i class="fa fa-circle-o-notch fa-spin" id='process' style='color:#fff; display:none'></i> SAVE & ALLOT</button></center></td>
			</tr>
			<tr>
				<td colspan='6' style='color:red'> <b>Note:</b><ul>
				<li> Press on<button class='btn btn-success btn-xs'><i class="fa fa-plus" style='color:#fff;'></i></button> to add new question.</li>
				<li> Press on "Save & Allot" Button to set and send homework to Students.</li>
				<li> To show homework to the Students, click on the button under Status, once clicked, the questions cannot be modified.</li>
				<li>To view questions in alloted homework. Click On <label class='label label-warning'>Questions</label></li>

				</ul>
				</td>
			</tr> 
		</table>
		</form>
	</div>
	</div>
	
	<div class='row'>
    <div class='col-sm-12'>
    <div class='table-responsive' id='load1'>
	
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
	
	<!-- alert modal -->
	<div id="alertModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Alert</h4>
		  </div>
		  <div class="modal-body">
			<span style='text-align:justify; font-size:19px;'>You have already created homework for selected subject.<br/>
			If you want to add questions to alloted homework, proceed to Edit( <button class='btn btn-success btn-xs'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> ) in Modify tab.<br/>
			Else, you can create new homework for selected subject		
			</span>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>
	<!-- end alert modal -->
	
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
				 $("#alertModal").modal({
					backdrop: 'static',
					keyboard: false 
				 });
				$("#btn").attr('disabled',false); 
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
			url: "<?php echo base_url('e_exam/homework/AddHomework/saveQuestion'); ?>",
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
					heading: '',
					text: 'HW Saved',
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
	
	// CKEDITOR.replace( 'topic_1' );	
	 CKEDITOR.replace( 'topic_1',
            {   
			extraPlugins: 'language',
			// Customizing list of languages available in the Language drop-down.
			//language_list: ['ar:Arabic:rtl', 'fr:French', 'hn:Hindi:rtl', 'es:Spanish'],
			  removeButtons: 'Save',
			  removePlugins: 'Save',
			   height: 100

      
			}
         );
		 
		 
 var i = 2;		
 function addTopic(){
	 var topic = "<div id='rmov_"+i+"'><textarea type='text' name='question[]' id='topic_"+i+"' class='form-control' required rows='4'></textarea><div class='row'><div class='col-sm-4'><select class='form-control' name='question_type[]' required><option value=''>Que. Type</option><option value='1'>Subjective</option><option value='2'>Objective</option></select></div><div class='col-sm-4'><input type='file' name='img[]' onchange='imgValidaye(this)' id='filePHOTO_"+i+"' class='form-control'></div><div class='col-sm-4'><button title='Remove' type='button' class='btn btn-danger btn-xs pull-right' onclick='rmv("+i+")'><i class='fa fa-trash' style='color:#fff;'></i></button></div></div><br /></div>";
	 
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
		if(file_size > 1048576 || (ext != 'jpg') && (ext != 'jpehttps://203.129.217.179:8443/domains/databases/phpMyAdmin/sql.php?db=jvm_e_exam&table=e_exam_questions&pos=0#g') && (ext != 'png')){
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
 
 function viewQue(id){
	$.ajax({
		url: "<?php echo base_url('e_exam/homework/AddHomework/viewModal'); ?>",
		type: "POST",
		data: {id:id},
		success: function(data){
			$("#load").html(data);
			$("#quemodal").modal('show');
		}
	}); 
 }
 
 function onoff(homework_id){	
	var chkbox = $("#examonoff_"+homework_id).prop('checked') ? 1: 0;
	
	$.ajax({
		url: "<?php echo base_url('e_exam/homework/AddHomework/viewExamStatus'); ?>",
		type: "POST",
		data: {homework_id:homework_id,chkbox:chkbox},
		success: function(ret){
			location.reload();
			// $.toast({
				// heading: 'Success',
				// text: ret,
				// showHideTransition: 'slide',
				// icon: 'success',
				// position: 'top-right',
			 // });
		}
	}); 
 }
 function queslist(){
	 var cls 	= $("#cls").val();
	 var section = $("#section").val();
	 var subj 	= $("#subj").val();
	 $.post("<?php echo base_url('e_exam/homework/AddHomework/loadlist'); ?>",{cls:cls,section:section,subj:subj},function(data){
		
		  $("#load1").html(data);
	  });
 }
</script>