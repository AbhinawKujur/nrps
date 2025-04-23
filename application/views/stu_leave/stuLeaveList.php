<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}

	.download-file-color-change{
    -webkit-animation: color-change 1s infinite;
    -moz-animation: color-change 1s infinite;
    -o-animation: color-change 1s infinite;
    -ms-animation: color-change 1s infinite;
    animation: color-change 1s infinite;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Leave</a> <i class="fa fa-angle-right"></i> Leave List </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;font-size: 12px;">
  <div class="row">
    <div class='col-sm-12'>
    <div class='table-responsive'>
	<table class='table dataTable'>
	<thead>
		<tr>
			<th style='color:#fff !important; background:#5785c3;'>Apply Date</th>
			<th style='color:#fff !important; background:#5785c3;'>Adm No.</th>
			<th style='color:#fff !important; background:#5785c3;'>Class</th>
			<th style='color:#fff !important; background:#5785c3;'>Sec</th>
			<th style='color:#fff !important; background:#5785c3;'>From Date</th>
			<th style='color:#fff !important; background:#5785c3;'>To Date</th>
			<th style='color:#fff !important; background:#5785c3;'>Reason</th>
			<th style='color:#fff !important; background:#5785c3;'>Attachment</th>
			<th style='color:#fff !important; background:#5785c3;'>Action</th>
		</tr>
	</thead>	
	<tbody>
		<?php
			if(!empty($stuLeaveData)){
				foreach($stuLeaveData as $key => $val){
		?>
		<tr>
			<td><?php echo date('d-M',strtotime($val['created_at'])); ?></td>
			<td><?php echo $val['admno']; ?></td>
			<td><?php echo $val['classnm']; ?></td>
			<td><?php echo $val['secnm']; ?></td>
			<td><?php echo date('d-M',strtotime($val['from_date'])); ?></td>
			<td><?php echo date('d-M',strtotime($val['to_date'])); ?></td>
			<td><?php echo $val['reason']; ?></td>
			<td>
				<?php
					if($val['img'] != ''){
				?>
				<a href='<?php echo base_url($val['img']); ?>' download><i class="fa fa-download"></i> FILE</a>
				<?php } ?>
			</td>
			<td>
				<select class='form-control' onchange='action(this,<?php echo $val['id']; ?>)' id='act_<?php echo $key; ?>'>
					<option value='0' <?php if($val['leave_status_by_teacher'] == 0){ echo "selected"; } ?>>PENDING</option>
					<option value='1' <?php if($val['leave_status_by_teacher'] == 1){ echo "selected"; } ?>>APPROVED</option>
					<option value='2' <?php if($val['leave_status_by_teacher'] == 2){ echo "selected"; } ?>>DISAPPROVED</option>
				</select>
			</td>
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
	</div><br />
	
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
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
  
  function action(actid,id){
	  var str = actid.id;
	  var ids = str.split("_");
	  var finid = ids[1];
	  var act = $("#act_"+finid).val();
	  
	  $.ajax({
		  url: "<?php echo base_url('stu_leave/stuLeave/updateLeave'); ?>",
		  type: "POST",
		  data: {id:id,act:act},
		  success: function(ret){
			$.toast({
				heading: 'Success',
				text: 'Data Saved Successfully..!',
				showHideTransition: 'slide',
				icon: 'success',
				position: 'top-right',
			});  
		  }	
	  });
  }
</script>