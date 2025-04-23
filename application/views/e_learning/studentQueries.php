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
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">e-Learning</a> <i class="fa fa-angle-right"></i> Student Queries </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-12'>
    <div class='table-responsive'>
	<table class="table table-striped table-bordered datatable" id='dt' style='font-size:14px;'>
	  <thead class="table-header">
		<tr>
		 <th style='color:#fff !important; background:#5785c3;'>Date of Upload</th>
		 <th style='color:#fff !important; background:#5785c3;'>Class</th>
		 <th style='color:#fff !important; background:#5785c3;'>Sec.</th>
		 <th style='color:#fff !important; background:#5785c3;'>Subject</th>
		 <th style='color:#fff !important; background:#5785c3;'>Chapter</th>
		 <th style='color:#fff !important; background:#5785c3;'>Topic</th>
		 <th style='color:#fff !important; background:#5785c3;'>Remarks</th>
		 <th style='color:#fff !important; background:#5785c3;'>Download Status</th>
		 <th style='color:#fff !important; background:#5785c3;'>Action</th>
		 <th style='color:#fff !important; background:#5785c3;'>Block Topic</th>
		</tr>
	  </thead>
	  <tbody>
		<?php
			foreach($elearningData as $key => $val){
				$id = $val['id'];
				$cntData = $this->alam->selectA('e_learning_adm_wise','count(*)cnt',"elearning_tbl_id='$id' AND downloadStatus='1'");
				$cnt = $cntData[0]['cnt'];
				?>
				<tr>
					<td><?php echo date('d-M',strtotime($val['homework_date'])); ?></td>
					<td><?php echo $val['disp_class']; ?></td>
					<td><?php echo $val['disp_sec']; ?></td>
					<td><?php echo $val['subjectnm']; ?></td>
					<td><?php echo $val['chapternm']; ?></td>
					<td><?php echo $val['topic']; ?></td>
					<td><?php echo $val['remarks']; ?></td>
					<td> 
					<button type="button" class="btn btn-primary btn-xs" onclick='chkDownloadStatus(<?php echo $id; ?>)'>Students <span class="badge"><?php echo $cnt; ?></span></button>
					</td>
					<td>
					<a href='<?php echo base_url('e_learning/Elearning/studentQuery/'.$val['id'].'/'.$val['subject'].'/'.$val['class'].'/'.$val['sec']); ?>' class='btn btn-warning btn-xs'>STU. QUERIES</a>
						<?php 
							$imgData = unserialize($val['img']); 
							foreach($imgData as $key1 => $val1){
								?>
									<br /><span style='font-size:10px;'>FILE</span> <?php echo $key1 + 1; ?><a download href='<?php echo base_url($val1); ?>'> <i class="fa fa-download" style='color:red'></i></a>
								<?php
							}
						?>
					</td>
					<td>
					<?php
						if($val['lock_topic'] == 1){
					?>
						<label class="switch">
						  <input type="checkbox" id='lcksts_<?php echo $key; ?>' checked onchange='lockStatus(this,<?php echo $id; ?>)'>
						  <span class="slider round"></span>
						</label>
					<?php } else{ ?>
						<label class="switch">
						  <input type="checkbox" id='lcksts_<?php echo $key; ?>' onchange='lockStatus(this,<?php echo $id; ?>)'>
						  <span class="slider round"></span>
						</label>
					<?php } ?>	
					</td>
				</tr>	
				<?php
			}
		?>
	  </tbody>
	</table>
	
	<!-- download status modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><b>Download Status</b></h4>
		  </div>
		  <div class="modal-body">
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- end download status modal -->
	
	</div>
	</div>
	</div>
	</div><br />
	
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
   $("#multiselect").select2();
	
   $(function () {
    $('#dt').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      aaSorting: [[0, 'asc']]
    })
  });
  
  function chkDownloadStatus(elearning_tbl_id){
	$.ajax({
		url: "<?php echo base_url('e_learning/Elearning/chkDownloadStatus'); ?>",
		type: "POST",
		data: {elearning_tbl_id:elearning_tbl_id},
		success: function(ret){
			$(".modal-body").html(ret);
			$("#myModal").modal('show');
		}
	});
  }
  
  function lockStatus(id,tblId){
	  var str = id.id;
	  var splt = str.split("_");
	  var finid = splt[1];
	  var chkbox = $("#lcksts_"+finid).prop('checked') ? 1: 0;
	  $.ajax({
		url: "<?php echo base_url('e_learning/Elearning/lockStatus'); ?>",
		type: "POST",
		data: {chkbox:chkbox,tblId:tblId},
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