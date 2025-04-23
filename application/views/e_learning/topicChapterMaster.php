<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">e-Learning</a> <i class="fa fa-angle-right"></i> Chapter/Topic </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-4'>
	    <?php
			  if($this->session->flashdata('msg')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('msg'); ?>
					</div>
				  <?php
			  }
		?>
		<div id='load'>
		<form id='topicChapterForm' method='post'>
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
			</tr>
			
			<tr>
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
					<select class='form-control' name='subject' required id='subj'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Chapter</th>
				<td><input type='text' name='chapter' id='chapter' class='form-control' required></td>
			</tr>
			<tr>
				<th>Topic</th>
				<td id='load_topic'>
					
					<button onclick='addTopic()' type='button' title='Add more Topics' class='btn btn-success btn-xs pull-right'><i class="fa fa-plus-square" style='color:#fff;'></i></button><br /><br />
					<textarea type='text' name='topic[]' id='topic' class='form-control topic' required></textarea><br /> 
				</td>
			</tr>
			
			<tr>
				<td colspan='2'><center><button id='btn' class='btn btn-success btn-sm'>SAVE <i class="fa fa-paper-plane" style='color:#fff'></i></button></center></td>
			</tr>
		</table>
		</form>
		</div>
	</div>
	
    <div class='col-sm-8'>
    <div class='table-responsive' id='load1'>
	<table class='table dataTable'>
	<thead>
		<tr>
			<th style='color:#fff !important; background:#5785c3;'>Class</th>
			<th style='color:#fff !important; background:#5785c3;'>Sec</th>
			<th style='color:#fff !important; background:#5785c3;'>Subject</th>
			<th style='color:#fff !important; background:#5785c3;'>Chapter</th>
			<th style='color:#fff !important; background:#5785c3;'>Topic</th>
			<th style='color:#fff !important; background:#5785c3;'>Action</th>
		</tr>
	</thead>	
	<tbody>
		<?php
			foreach($chapterTopicMaster as $key => $val){
				?>
					<tr>
						<td><?php echo $val['classnm']; ?></td>
						<td><?php echo $val['secnm']; ?></td>
						<td><?php echo $val['subjnm']; ?></td>
						<td><?php echo $val['chapter']; ?></td>
						<td>
						<?php 
							$topicData = unserialize($val['topic']); {
								foreach($topicData as $key1 => $val1){
									echo $val1."&nbsp;&nbsp;";
								}
							}
						?>
					    </td>
						<td>
							<button class='btn btn-success btn-xs' onclick='edit(<?php echo $val['id']; ?>)'><i class="fa fa-pencil-square-o" style='color:#fff;'></i></button>
						</td>
					</tr>
				<?php
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
  
  function clses(val){
	  $.post("<?php echo base_url('e_learning/TopicChapterMaster/loadSec'); ?>",{class_id:val},function(data){
		  $("#section").html(data);
	  });
  }
  
  function sectn(val){
	  var cls = $("#cls").val();
	  $.post("<?php echo base_url('e_learning/TopicChapterMaster/loadSubj'); ?>",{sec_id:val,cls:cls},function(data){
		  $("#subj").html(data);
	  });
  }
   
  function disabled(){
	$(".btn").attr('disabled',true);
  }
	 
 $("#topicChapterForm").on("submit", function (event) {
	event.preventDefault();
	$.ajax({
		url: "<?php echo base_url('e_learning/TopicChapterMaster/saveMaster'); ?>",
		type: "POST",
		data: $("#topicChapterForm").serialize(),
		success: function(data){
			$("#load1").html(data);
			$("#topicChapterForm").trigger("reset");
			$.toast({
				heading: 'Success',
				text: 'Save Successfully..!',
				showHideTransition: 'slide',
				icon: 'success',
				position: 'top-right',
			});
		}
	});
 });
 
 function addTopic(){
	 var topic = "<textarea type='text' name='topic[]' id='topic' class='form-control' required></textarea><br />";
	 $("#load_topic").append(topic);
 }
 
 function edit(id){
	$.ajax({
		url: "<?php echo base_url('e_learning/TopicChapterMaster/edit'); ?>",
		type: "POST",
		data: {id:id},
		success: function(data){
			$("#load").html(data);
		}
	}); 
 }
</script>