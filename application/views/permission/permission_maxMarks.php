<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}

input[type="checkbox"]{
  width: 30px; 
  height: 30px; 
}

.txt span{
	font-size:13px;
	font-weight:bold;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Lock Exam</a> <i class="fa fa-angle-right"></i>  </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
<div class='container'>
  <div class="row">
	<div class='col-sm-4'>
	<form action='<?php echo base_url('permission/PermissionMaxMarks/save'); ?>' method='post'>
	  <table class='table'>
		<tr>
			<th>TERM 1</th>
			<td><input type='checkbox' name='t1' value='1' <?php if($t1 == 1){ echo 'checked'; }?>></td>
			
			<th>TERM 2</th>
			<td><input type='checkbox' name='t2' value='1' <?php if($t2 == 1){ echo 'checked'; }?>></td>
		</tr>
		<tr>
			<td colspan='4'><button class='btn btn-success btn btn-sm'>SAVE</button></td>
		</tr>
	  </table>
	</form>  
	</div>  
  </div>  
</div>  
</div><br />
	
<script type="text/javascript">
  
</script>