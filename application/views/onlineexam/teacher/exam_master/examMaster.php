<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Class Assessment</a> <i class="fa fa-angle-right"></i> Exam Master </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
    <div class="row">
		<div class='col-sm-6' id='load'>
			<form class="form-inline" id="exam_master">
			  <label class="mr-sm-2">Exam Name</label>
			  <input type="text" name='exam_name' class="form-control mb-2 mr-sm-2" placeholder="" required autocomplete='off' style='text-transform:uppercase'>
			  <button type="submit" class="btn btn-success mb-2">Submit</button>
			</form>
		</div>
		
		<div class='col-sm-6'>
			<table class='table dataTable'>
				<thead>
					<tr>
						<th style='background:#5785c3; color:#fff !important; text-align:center'>Sl. No.</th>
						<th style='background:#5785c3; color:#fff !important; text-align:center'>Exam Name</th>
						<th style='background:#5785c3; color:#fff !important; text-align:center'>Modify</th>
					</tr>
				</thead>
				
				<tbody>
				<?php
					if(!empty($examMasterData)){
						foreach($examMasterData as $key => $val){
							?>
								<tr>
									<td><center><?php echo $key+1; ?></center></td>
									<td><?php echo $val['exam_name']; ?></td>
									<td><center><a class='label label-success' onclick='examMasterEdit(<?php echo $val['id']; ?>)'><i style='color:#fff' class="fa fa-pencil-square-o"></i></center></a></td>
								</tr>
							<?php
						}
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div><br />
	
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
  
  $("#exam_master").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('onlineexam/teacher/exam_master/ExamMaster/examMasterSave'); ?>",
		type: "POST",
		data: $("#exam_master").serialize(),
		success: function(data){
			if(data == 1){
				alert_msg(' ','Save Successfully..!','');
				setTimeout(function(){ 
					location.reload();
				}, 3000);
			}else{
				alert_msg('Error','Already Exist..!','error');
			}
		}
	});
 });
 
 function examMasterEdit(id){
	$.ajax({
		url: "<?php echo base_url('onlineexam/teacher/exam_master/ExamMaster/examMasterEdit'); ?>",
		type: "POST",
		data: {id:id},
		success: function(res){
			$("#load").html(res);
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