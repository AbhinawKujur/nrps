<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">e-Learning</a> <i class="fa fa-angle-right"></i> Student Queries</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">

<div class='row'>
	<div class='col-sm-12'>
		<label><?php echo $elearningData[0]['subjnm']; ?></label><br />
		<label><?php echo $elearningData[0]['chapternm']; ?></label>
		<label style='font-size:13px; color: brown;'>(<?php echo $elearningData[0]['topic']; ?>)</label>
		<h5><label style='color:#c7aaaa;'><?php echo $elearningData[0]['remarks']; ?></label></h5>
	</div>
</div>

  <div class="row">
    <div class='col-sm-12'>
    <div class='table-responsive'>
	  <div class='col-sm-6'>
		<form id='eLearningForm' method='post' enctype='multipart/form-data'>
		  <table class='table'>
			<tr>
				<th>Query / Reply</th>
				<td><textarea required name='query' id='query' col='20' rows='6' class='form-control'></textarea></td>
				<input type='hidden' id='classes' name='classes' value='<?php echo $elearningData[0]['class']; ?>'>
				<input type='hidden' id='sec' name='sec' value='<?php echo $elearningData[0]['sec']; ?>'>
				<input type='hidden' name='admno' value='<?php echo $user_id; ?>'>
				<input type='hidden' id='subject' name='subject' value='<?php echo $elearningData[0]['subject']; ?>'>
				<input type='hidden' id='topic_id' name='topic_id' value='<?php echo $elearningData[0]['id']; ?>'>
			</tr>
			<tr>
				<th>Attachment</th>
				<td><input type='file' id='img' name='img[]' multiple></td>
			</tr>
			<tr>
				<td colspan='2'><input type='submit' value='Send' class='btn btn-success'></td>
			</tr>
		  </table>
		</form>  
	  </div>
	  
	  <div class='col-sm-6'>
	  <div id='load_query' style='height:250px; overflow:auto;'>
		<?php
			if(!empty($conversation_stu)){
				foreach($conversation_stu as $key => $val){
					if($name == $val['user_name']){
						$userIconColor = 'green';
					}else{
						$userIconColor = 'red';
					}
					?>
					 <b><i class="fa fa-user-circle" style='color:<?php echo $userIconColor; ?>'></i> <span style='font-size:12px;'><?php echo $val['user_name']; ?></span></b>
					 <p style='font-size:12px;'>
						<?php echo $val['query']; ?>
						<?php
							if($val['img'] != 'a:0:{}'){
								?>
									<a href='<?php echo base_url(unserialize($val['img'])); ?>' download> &nbsp;<i class="fa fa-download" style='color:red'></i></a>
								<?php
							}
						?><br />
						<span style='text-align:right'><?php echo date('d-M H:i a',strtotime($val['created_at'])); ?></span>
					</p>
					<?php
				}
			}
		?>
	  </div>
	  </div>
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
  
  $("#eLearningForm").on("submit", function (event) {
    event.preventDefault();
	$("#btn").prop('disabled',true);
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('e_learning/Elearning/studentQuertySave'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				$.toast({
					heading: 'Success',
					text: 'Sent Successfully..!',
					showHideTransition: 'slide',
					icon: 'success',
					position: 'top-right',
				});
				$("#load_query").html(data);
				$("#query").val('');
				$("#img").val('');
			}
		});
	 });
	 
	 setInterval(function(){
		 var subject  = $("#subject").val();
		 var topic_id = $("#topic_id").val();
		 var classes  = $("#classes").val();
		 var sec      = $("#sec").val();
		   $('#load_query').load('<?php echo base_url("e_learning/Elearning/autoRefresh/'+subject+'/'+topic_id+'/'+classes+'/'+sec+'"); ?>');
		}, 2000)
</script>