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
        Class Assessment
      </h1>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-clipboard"></i> Class Assessment</a></li>
        <li class="active">Class Assessment</li>
      </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <div class="row">
			<div class='col-sm-12'>
			<div class='table-responsive' id='load1'>
			<table class='table dataTable' id='example2'>
			<thead>
				<tr>
					<th style='color:#fff !important; background:#5785c3;'>Sl. No.</th>
					
					<th style='color:#fff !important; background:#5785c3;'>Subject</th>
					
					<th style='color:#fff !important; background:#5785c3;'>Exam Date</th>
					<th style='color:#fff !important; background:#5785c3;'>Exam Time</th>
					<th style='color:#fff !important; background:#5785c3;'>Exam Time Duration</th>
					<th style='color:#fff !important; background:#5785c3;'>Action</th>
					
				</tr>
			</thead>	
			<tbody>
				<?php
				$c=0;
					foreach($e_exam_questions as $key => $val){
						$currDate = date('d-M-Y');
						if($val['examDate'] == $currDate){
						?>
							<tr>
								<td><?php echo ++$c; ?></td>
								<td><?php echo $val['subjnm']; ?></td>						
								<td><?php echo $val['examDate']; ?></td>
								<td><?php echo $val['examTime']; ?></td>
								<td><?php echo $val['examTimeDuration']." MIN"; ?></td>
								<td><a href='<?php echo base_url('parent_dashboard/e_exam/Questions'); ?>' style='color:green'><b>Proceed to Exam</b></a></td>
								
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
</script>