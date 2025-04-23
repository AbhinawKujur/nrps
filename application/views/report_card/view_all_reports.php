<style>
.modal-body a:hover{
	color:red;
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Reports</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div style="padding: 25px; background-color: white; border-top:3px solid #337ab7;">

<div class='container'>
  <div class='row'>
    <div class='col-sm-12'>
	<a href='<?php echo base_url('report_card/Report_card_temp_save/topper_list'); ?>' target="_blank">
	  <button type='button' class='btn btn-success'>Topper List</button>
	</a>
	
	<a href='<?php echo base_url('report_card/Report_card_temp_save/topper_rank_class_wise/'.$class_id); ?>' target="_blank">
	  <button type='button' class='btn btn-warning'>Topper Rank Class Wise</button>
	</a>
	
	<a href='<?php echo base_url('report_card/Subject_analysis'); ?>'target="_blank">
	  <button type='submit' class='btn btn-danger'>Subject Analysis</button>
	</a>
	
	<a href='<?php echo base_url('report_card/Percentage_report'); ?>'target="_blank">
	  <button type='submit' class='btn btn-info'>Percentage Report</button>
	</a>
	
	<a href='<?php echo base_url('report_card/Grd_analysis_report'); ?>'target="_blank">
	  <button type='submit' class='btn btn-warning'>Grade Analysis</button>
	</a>
	
	<a href='<?php echo base_url('report_card/Performance_graph_report'); ?>'target="_blank">
	  <button type='submit' class='btn btn-primary'>Average subject Graph</button>
	</a>
	</div>
  </div><br />
  
  <div class='row'>
    <div class='col-sm-12'>
	  <a href='<?php echo base_url('report_card/Higest_sub_graph'); ?>'target="_blank">
		<button type='submit' class='btn btn-warning'>Highest Subject Graph</button>
	  </a>
	  
	  <a data-toggle="modal" data-target="#myModal">  
		<button type='submit' class='btn btn-success' class="btn btn-lg btn-danger">Subject Wise Analysis</button>
	  </a>
	
	</div>
  </div>
  
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
	  <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center>
		 <a href='<?php echo base_url('report_card/Subj_wise_analysis/index/pdf'); ?>' target='_blank'>
			<i class="fa fa-file-pdf-o" style='font-size:50px;' title='PDF'></i>
		 </a>
		 
		 <a href='<?php echo base_url('report_card/Subj_wise_analysis/index/excel'); ?>' target='_blank'>
			<i class="fa fa-file-excel-o" style='font-size:50px;' title='EXCEL'></i>
		 </a>
		</center> 
      </div>
    </div>
  </div>
  </div>
  
  
  
</div>

</div>
<br /><br />