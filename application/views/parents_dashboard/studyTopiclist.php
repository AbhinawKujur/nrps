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
        Study Topic List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i> Home</a></li>
        <li class="active">Study Topic</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-book"></i> Study Topic List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <div class="row">
            <div class="col-sm-12">
              <div class="table-responsive" id="no-more-tables">
                <table class="table table-striped table-bordered datatable">
                  <thead class="table-header">
                    <tr>
                      <th>S.No</th>
                      <th>Date</th>
                      <th>Subject</th>
                      <th>Chapter</th>
                      <th>Topic</th>
                      <th>Remarks</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
						foreach($elearningData as $key => $val){
							?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo date('d-M-Y',strtotime($val['homework_date'])); ?></td>
								<td><?php echo $val['subjnm']; ?></td>
								<td><?php echo $val['chapternm']; ?></td>
								<td><?php echo $val['topic']; ?></td>
								<td><?php echo $val['remarks']; ?></td>
								<td>
								<?php
									if($val['lock_topic'] == 1){
								?>
									<a href='<?php echo base_url('parent_dashboard/StudyTopiclist/studentQuery/'.$val['id'].'/'.$val['subject'].'/'.$val['class'].'/'.$val['sec']); ?>' class='btn btn-warning btn-sm'>QUERY</a>
								<?php } else { ?>
									<a class='btn btn-danger btn-sm'><i class="fa fa-lock"></i> QUERY</a>
								<?php } ?>
								<?php 
									$imgData = unserialize($val['img']); 
									foreach($imgData as $key1 => $val1){
										?>
											<br /><span style='font-size:10px;'>FILE</span> <?php echo $key1 + 1; ?><a download href='<?php echo base_url($val1); ?>' onclick='downloadStatus(<?php echo $val['id']; ?>,<?php echo $admno; ?>)'> <i class="fa fa-download" style='color:red'></i></a>
										<?php
									}
								?>
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
		  <!-- for videos -->
		  <div class="row">
				<?php
					foreach($elearningData as $key => $val){
				?>
				<div class='col-sm-4'>
					<iframe src="https://www.youtube.com/embed/<?php echo $val['link']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style='border:5px solid #3c8dbc'></iframe><br />
					<h4><b><?php echo $val['chapternm']; ?></b></h4>
					<h5><?php echo $val['topic']; ?> (<i><?php echo $val['remarks']; ?></i>) </h5>
				</div>
				
				<?php } ?>
		  </div>	
		  <!-- for videos -->
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
  })
  
  function downloadStatus(elearning_tbl_id,admno){
	  $.ajax({
		  url: "<?php echo base_url('parent_dashboard/StudyTopiclist/statusSave'); ?>",
		  type: "POST",
		  data: {elearning_tbl_id:elearning_tbl_id,admno:admno},
		  success: function(ret){
		  }
	  });
  }
</script>