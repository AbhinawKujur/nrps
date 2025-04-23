<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
	 padding: 2px !important;
 }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('punching/manualpunch'); ?>">Employee</a> <i class="fa fa-angle-right"></i> Student Attendance Type</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
  <?php
    if($this->session->flashdata('message')){
		?>
		 <div class="alert alert-success alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Success!</strong> <?php echo $this->session->flashdata('message'); ?>
		 </div>
		<?php
	}
  ?>
  <div class="row">
   <form action='<?php echo base_url('student/master/Student_attendance_type/upd_att_type'); ?>' method='post'>
    <table class="table table-bordered">
	  <tr>
	    <th style="background:#5785c3; color:#fff;"><center>Class Name</center></th>
	    <th style="background:#5785c3; color:#fff;"><center>Day Wise</center></th>
	    <th style="background:#5785c3; color:#fff;"><center>Period Wise</center></th>
	  </tr>
	  <?php
	    foreach($student_attendance_type as $key => $data){
			?>
			 <tr>
			    <td><center><?php echo $data->class_nm; ?></center></td> 
			    <td><center><input type="radio" name="attendanceType_<?php echo $key; ?>" value='1' <?php if($data->attendance_type == 1){ echo "checked";} ?>></center></td> 
			    <td><center><input type="radio" name="attendanceType_<?php echo $key; ?>" value='2' <?php if($data->attendance_type == 2){ echo "checked";} ?>></center></td> 
			 </tr>
			<?php
		}
	  ?>
	  <tr>
	  <br /><br />
	    <td colspan='4' align='center'><button type="submit" class='btn btn-success'>SAVE</button></td>
	  </tr>
    </table>
  </form>	
  </div>
</div>
<br /><br />


<!-- /.modal -->
<div class="loader"></div>
<script type="text/javascript">
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
</script>