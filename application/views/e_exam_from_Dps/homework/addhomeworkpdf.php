

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
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Homework</a> <i class="fa fa-angle-right"></i>Upload Answer</li>
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
					<select class='form-control' name='subject' required id='subj' onchange='subjectid()'>
						<option value=''>Select</option>
					</select>
				</td>
				
				<th>Homework Date</th>
				<td><select class='form-control' name='sdate' required id='date' onchange='queslist()' >
						<option value=''>Select</option>
					</select></td>
			</tr>
			
		</table>
		</form>
	</div>
	</div>
	
	<div class='row'>
	<form action="<?=base_url('e_exam/homework/AddHomeworkpdf/saveQuestion');?>" method='post' autocomplete='off' enctype='multipart/form-data'>
    <div class='col-sm-12'>
    <div class='table-responsive' id='load1'>
	
	</div>
	</div>
	</form>
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
	
	<!-- alert modal 
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
  
  function subjectid(){
	var cls = $("#cls").val();
	var section = $("#section").val();
	var subj = $("#subj").val();
	 $.ajax({
		 url: "<?php echo base_url('e_exam/homework/AddHomeworkpdf/datevalid'); ?>",
		 type: "POST",
		 data: {cls:cls,section:section,subj:subj},
		 success: function(ret){
			$("#date").html(ret);
		 }
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
			url: "<?php echo base_url('e_exam/homework/AddHomeworkpdf/update'); ?>",
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

 function validateImage() {
    var formData = new FormData(); 
    var file = document.getElementById("img").files[0]; 
    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "pdf") {
        alert('Please select a valid image file');
        document.getElementById("img").value = '';
        return false;
    }
    if (file.size > 1024000) {
        alert('Max Upload size is 1MB only');
        document.getElementById("img").value = '';
        return false;
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
 
 
 function queslist(){
	 var cls 	= $("#cls").val();
	 var section = $("#section").val();
	 var subj 	= $("#subj").val();
	 var date 	= $("#date").val();
	 $.post("<?php echo base_url('e_exam/homework/AddHomeworkpdf/loadlist'); ?>",{cls:cls,section:section,subj:subj,date:date},function(data){
		
		  $("#load1").html(data);
	  });
 }
</script>

 