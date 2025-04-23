<style type="text/css">
  .table-header{
      background: #c3c7c4;
    }
    @media only screen and (max-width: 800px) {
  
  /* Force table to not be like tables anymore */
  #no-more-tables table, 
  #no-more-tables thead, 
  #no-more-tables tbody, 
  #no-more-tables th, 
  #no-more-tables td, 
  #no-more-tables tr { 
    display: block; 
  }
 
  /* Hide table headers (but not display: none;, for accessibility) */
  #no-more-tables thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
 
  #no-more-tables tr { border: 1px solid #ccc; }
 
  #no-more-tables td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
    white-space: normal;
    text-align:left;
  }
 
  #no-more-tables td:before { 
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%; 
    padding-right: 10px; 
    white-space: nowrap;
    text-align:left;
    font-weight: bold;
  }
 
  /*
  Label the data
  */
  #no-more-tables td:before { content: attr(data-title); }
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Query
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i> Home</a></li>
        <li class="active">Student Query</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-book"></i> Student Query</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
		<div class='row'>
			<div class='col-sm-12'>
				<label><?php echo $elearningData[0]['subjnm']; ?></label><br />
				<label><?php echo $elearningData[0]['chapternm']; ?></label>
				<label style='font-size:13px; color: brown;'>(<?php echo $elearningData[0]['topic']; ?>)</label>
				<h5><label style='color:#c7aaaa;'><?php echo $elearningData[0]['remarks']; ?></label></h5>
			</div>
		</div>
          <div class="row">
            <div class="col-sm-12">
			  <div class='row'>
			  <div class='col-sm-6'>
				<form id='eLearningForm' method='post' enctype='multipart/form-data'>
				  <table class='table'>
					<tr>
						<th>Query / Reply</th>
						<td><textarea required name='query' id='query' col='20' rows='6' class='form-control'></textarea></td>
						<input type='hidden' id='classes' name='classes' value='<?php echo $elearningData[0]['class']; ?>'>
						<input type='hidden' id='sec' name='sec' value='<?php echo $elearningData[0]['sec']; ?>'>
						<input type='hidden' name='admno' value='<?php echo $admno; ?>'>
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
			  <div id='load_query' style='height:200px; overflow:auto;'>
				<?php
					if(!empty($conversation_stu)){
						foreach($conversation_stu as $key => $val){
							if($name == $val['user_name']){
								$userIconColor = 'green';
							}else{
								$userIconColor = 'red';
							}
							?>
							 <b><i class="fa fa-user-circle" style='color:<?php echo $userIconColor; ?>'></i> <?php echo $val['user_name']; ?></b>
							 <p style='font-size:12px;'>
								<?php echo $val['query']; ?>
								<?php
									if($val['img'] != 'a:0:{}'){
										?>
											<a href='<?php echo base_url(unserialize($val['img'])); ?>' download> &nbsp;<i class="fa fa-download" style='color:red'></i></a>
										<?php
									}
								?>
								<br />
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
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
	$(function () {
		$('.datatable').DataTable( {
		  responsive: true
		});
	});
	
	$("#eLearningForm").on("submit", function (event) {
    event.preventDefault();
	$("#btn").prop('disabled',true);
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('parent_dashboard/StudyTopiclist/studentQuertySave'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				if(data == 'query_blocked'){
					alert('Query Blocked....!');
					window.location="<?php echo base_url('parent_dashboard/StudyTopiclist'); ?>";
				}else{
					toastr.success('sent successfully');
					$("#load_query").html(data);
					$("#query").val('');
					$("#img").val('');
				}
			}
		});
	 });
	 
	 setInterval(function(){
		 var subject  = $("#subject").val();
		 var topic_id = $("#topic_id").val();
		 var classes  = $("#classes").val();
		 var sec      = $("#sec").val();
		   $('#load_query').load('<?php echo base_url("parent_dashboard/StudyTopiclist/autoRefresh/'+subject+'/'+topic_id+'/'+classes+'/'+sec+'"); ?>');
		}, 2000)
</script>