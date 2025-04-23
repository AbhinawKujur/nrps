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
    <li class="breadcrumb-item"><a href="#">Class Assessment</a> <i class="fa fa-angle-right"></i> Add Exam Question </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
    
	<form class="form-inline" id="exam_schedule">
		<div class='row'>
			

			<div class='col-sm-3'>
				<label>Class <span>*</span></label><br />
				<select name='class' id='cls' class="form-control" required onchange='getSec(this.value)' style="width:100%">
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
				<select name='section' id='section' class="form-control" required onchange='getSubj()' style="width:100%">
					<option value=''>Select</option>
				</select>
			</div>
			
			<div class='col-sm-3'>
			<label>Subject <span>*</span></label><br />
				<select name='subject' id='subject' class="form-control" required onchange='subj()' style="width:100%">
					<option value=''>Select</option>
				</select>
			</div>	
			
			<div class='col-sm-3'>
			<label>Exam Date <span>*</span></label><br />
				<select name='exam_dt' id='exam_dt' class="form-control" required onchange='examDetails()' style="width:100%">
					<option value=''>Select</option>
				</select>
			</div>
		</div><br />
		
		<div class='row' id="load1">
		
					
		</div><br />
		
		
	</form>
</div>

<br />
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

	
<script type="text/javascript">
   $('.exam_date').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
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
  

 
 function getSec(val){
	  $.post("<?php echo base_url('onlineexam/teacher/addquestion/AddExamQuestion/loadSec'); ?>",{class_id:val},function(data){
		  $("#section").html(data);
	  });
  }
  
  function getSubj(){
	  var cls = $("#cls").val();
	  var sec = $("#section").val();
	  $("#subject").val('');
	  $.post("<?php echo base_url('onlineexam/teacher/addquestion/AddExamQuestion/loadSubj'); ?>",{cls:cls,sec:sec},function(data){
		  $("#subject").html(data);
	  });
  }
  
  function subj(){
	 var cls  = $("#cls").val();
	 var sec  = $("#section").val();	
	 var subj = $("#subject").val();
	
	 $.ajax({
			url: "<?php echo base_url('onlineexam/teacher/addquestion/AddExamQuestion/loateExamDate'); ?>",
			type: "POST",
			data: {cls:cls,sec:sec,subj:subj},
			success: function(data){
				 $("#exam_dt").html(data);
			}
		});	
  }
  
   function examDetails(){
	 var cls  = $("#cls").val();
	 var sec  = $("#section").val();	
	 var subj = $("#subject").val();
	 var exam_dt = $("#exam_dt").val();
	
	 $.ajax({
			url: "<?php echo base_url('onlineexam/teacher/addquestion/AddExamQuestion/loadmaxmarks'); ?>",
			type: "POST",
			data: {cls:cls,sec:sec,subj:subj,exam_dt:exam_dt},
			success: function(data){
				 $("#load1").html(data);
			}
		});	
  }
 
 	function q_imgs(img){
	
	    if(img==1){
            $('#div1').show();
			$('#img').show(); 
        } else {
		 	$('#div1').show();
            $('#img').hide(); 
        }    
  }
  
  function viewQue(id){
	$.ajax({
		url: "<?php echo base_url('onlineexam/teacher/addquestion/AddExamQuestion/viewModal'); ?>",
		type: "POST",
		data: {id:id},
		success: function(data){
			$("#load").html(data);
			$("#quemodal").modal('show');
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
</script>