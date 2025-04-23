<style type="text/css">
 .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
	 color: #000;
	 white-space: nowrap !important;
 }
</style>
<?php
$date = date('d-M-Y');
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('punching/manualpunch'); ?>">Teacher</a> <i class="fa fa-angle-right"></i> Assign Subject Teacher </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
   <div class="col-sm-3">
   
   <?php
    if($this->session->flashdata('sms')){
		?>
		<div class="alert alert-success">
		   <?php echo $this->session->flashdata('sms'); ?>
		</div>
		<?php
	}
   ?>
   
   
   <form action="<?php echo base_url('teacher/Assign_subject_teacher/updateSubjectTeacher'); ?>" method='post'>
    <div class="form-group">
		<label><b>Class:</b></label>
		<select class='form-control' name='classes' id='clss' onchange='clsses(this.value)' required>
			<option value=''>Select</option>
			<?php
				if(!empty($class_data)){
					foreach($class_data as $key => $val){
						?>
							<option value='<?php echo $val['Class_No']; ?>'><?php echo $val['classnm']; ?></option>
						<?php
					}
				}
			?>
		</select>
	</div>
	
	<div class="form-group">
		<label><b>Section:</b></label>
		<select class='form-control' name='sec' id='section' onchange='sectionn(this.value)' required>
			<option value=''>Select</option>
		</select>
	</div>
	
	<div class="form-group">
		<label><b>Subject:</b></label>
		<select class='form-control' name='subject' id='subject' required>
			<option value=''>Select</option>
		</select>
	</div>
	
	<div class="form-group">
		<label><b>Teachers:</b></label>
		<select class='form-control' name='teacher' id='teacher' required>
			<option value=''>Select</option>
			<?php
				foreach($emp_data as $key => $val){
					?>
						<option value='<?php echo $val['EMPID']; ?>'><?php echo $val['EMP_FNAME']." ".$val['EMP_MNAME']." ".$val['EMP_LNAME']; ?></option>
					<?php
				}
			?>
		</select>
	</div>
	
	<div class="form-group">
		<center><button class='btn btn-success' type='submit'>UPDATE</button></center>
	</div>
	</form>
	
   </div>
   
   <div class='col-sm-9'>
	 <div class='table-responsive'>
     <table class='table dataTable'>
		<thead>
			<tr>
				<th style='background:#337ab7; color:#fff; !important'>Sl No.</th>
				<th style='background:#337ab7; color:#fff; !important'>Class</th>
				<th style='background:#337ab7; color:#fff; !important'>Sec</th>
				<th style='background:#337ab7; color:#fff; !important'>Subject</th>
				<th style='background:#337ab7; color:#fff; !important'>Teacher Id</th>
				<th style='background:#337ab7; color:#fff; !important'>Name</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(!empty($teacherData)){
					foreach($teacherData as $key => $val){
						?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $val['classnm'] ; ?></td>
								<td><?php echo $val['secnm'] ; ?></td>
								<td><?php echo $val['subjnm'] ; ?></td>
								<td><?php echo $val['Main_Teacher_Code'] ; ?></td>
								<td><?php echo $val['teachernm'] ; ?></td>
							</tr>
						<?php
					}
				}
			?>
		</tbody>
     </table>
	 </div>
   </div>
  </div>
</div>
<br /><br />


<!-- /.modal -->
<div class="loader"></div>
<script type="text/javascript">
   $("#teacher").select2();
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
  
  function clsses(value){
	  $.ajax({
		  url: "<?php echo base_url('teacher/Assign_subject_teacher/getsection'); ?>",
		  type : "POST",
		  data : {class_id:value},
		  success: function(data){
			  $("#section").html(data);
		  }
	  });
  }
  
  function sectionn(value){
	  var class_id = $("#clss").val();
	  $.ajax({
		  url: "<?php echo base_url('teacher/Assign_subject_teacher/getsubject'); ?>",
		  type : "POST",
		  data : {sec_id:value,class_id:class_id},
		  success: function(data){
			  $("#subject").html(data);
		  }
	  });
  }
</script>