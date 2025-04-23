<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}

</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Homework</a> <i class="fa fa-angle-right"></i>Homework Status</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-3'>
	<?php
		if($this->session->flashdata('msg')){
			?>
				<div class="alert alert-success">
				  <?php echo $this->session->flashdata('msg'); ?>
				</div>

			<?php
		}
	?>
		<form id='form' autocomplete='off'>
		<div class="form-group">
			<label><b>Submission Date:</b></label>
			<input type='text' name='submission_dt' id='submission_dt' class='form-control dt' onchange='submissionDate(this.value)' required>
		</div>
		
		<div class="form-group">
			<label><b>Category:</b></label>
			<select class='form-control' name='category' id='cat' required onchange='categoryy(this.value)'>
				<option value=''>Select</option>
			</select>
		</div>
		
		<div class="form-group">
			<label><b>Class:</b></label>
			<select class='form-control' name='class' id='class' required onchange='cls(this.value)'>
				<option value=''>Select</option>
			</select>
		</div>
		
		<div class="form-group">
			<label><b>Section:</b></label>
			<select class='form-control' name='section' id='sec' required onchange='sctn(this.value)'>
				<option value=''>Select</option>
			</select>
		</div>
		
		<div class="form-group">
			<label><b>Subjects:</b></label>
			<select class='form-control' name='subject' required id='subj'>
				<option value=''>Select</option>
			</select>
		</div>
		
		<div class="form-group">
			<label><b>Homework Status:</b></label>
			<select class='form-control' name='hw_status' required>
				<option value=''>Select</option>
				<option value='Y'>Completed</option>
				<option value='N'>Incompleted</option>
			</select>
		</div>
		
		<div class="form-group">
			<center><button class='btn btn-success'>SHOW</button></center>
		</div>
		</form>
		
	</div>
	
    <div class='col-sm-8' id='load'>
	</div>
  </div>
</div>  <br />
	
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true });
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
  
 function submissionDate(val){
	 $.post("<?php echo base_url('homework/HomeworkStatus/loadCat'); ?>",{SubDate:val},function(data){
		$("#cat").html(data);
	});
 }
 
 function categoryy(val){
	 var SubDate = $("#submission_dt").val();
	 $.post("<?php echo base_url('homework/HomeworkStatus/loadClass'); ?>",{SubDate:SubDate,cat:val},function(data){
		$("#class").html(data);
	 });
 }
 
 function cls(val){
	var SubDate = $("#submission_dt").val();
	var cat     = $("#cat").val();
	 $.post("<?php echo base_url('homework/HomeworkStatus/loadSec'); ?>",{SubDate:SubDate,cat:cat,cls:val},function(data){
		$("#sec").html(data);
	 }); 
 }
 
 function sctn(val){
	var SubDate = $("#submission_dt").val();
	var cat     = $("#cat").val();
	var cls   = $("#class").val();
	 $.post("<?php echo base_url('homework/HomeworkStatus/loadSubj'); ?>",{SubDate:SubDate,cat:cat,cls:cls,sec:val},function(data){
		$("#subj").html(data);
	 });  
 }
 
 $("#form").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('homework/HomeworkStatus/fetchData'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			$("#load").html(data);
		}
	});
 });
</script>