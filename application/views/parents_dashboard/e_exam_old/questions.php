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
	<div class='row'>
		<div class='col-sm-4 col-md-4'>
			<span style='font-size:20px;'>
				<b>Assessment of Class <?php echo $classnm; ?></b>
			</span>
		</div>
		
		<div class='col-sm-6 col-md-6'>
				<?php
					foreach($questions as $key => $val){
						?>
							<input id='subj' type='hidden' value='<?php echo $val['subject']; ?>'><span style='font-size:20px; float:right'><b>Subject:-<?php echo $val['subjnm']; ?></b></span>
						<?php
					}
				?>
			<input type='hidden' id='class_code' value='<?php echo $class_code; ?>'>
			<input type='hidden' id='sec_code' value='<?php echo $sec_code; ?>'>
		</div>
	</div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
          <div class="row">
            <div id='load'></div>
		  </div>
      </div>
    </section>
  </div>
  
  <!-- notification Modal -->
	<div id="noti_modal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Notification</h4>
		  </div>
		  <div class="modal-body">
			<h3>Exams is going to start. Please wait for a while...!!!</h3>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default">Okay</button>
		  </div>
		</div>
	  </div>
	</div>
  <!-- Modal --> 
  
  <!-- /.content -->
  <!-- /.content-wrapper -->
  <script type="text/javascript">
	$(function () {
    $('.datatable').DataTable( {
		  responsive: true
		});
	  });
	  
	$(".datepicker").datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
	 
	function refreshPage(){
		let class_code = $("#class_code").val();
		let sec_code  = $("#sec_code").val();
		$.ajax({
			url: "<?php echo base_url('parent_dashboard/e_exam/Questions/timeRefresh'); ?>",
			type: "POST",
			data: {class_code:class_code,sec_code:sec_code},
			success: function(ret){
				if(ret == 1){
					$("#noti_modal").modal({
						backdrop: 'static',
						keyboard: false
					});
					setTimeout(function(){ 
						location.reload(); 
					}, 3000);	
				}
			}
		});
	}		
	
	setInterval(function(){
	   refreshPage();
	},60000)
	
	$(document).ready(function() {
		var subj_code = $("#subj").val();
		$("#load").html('');
		if(subj_code != ''){
			$.ajax({
				url: "<?php echo base_url('parent_dashboard/e_exam/Questions/fetchQuestions'); ?>",
				type: "POST",
				data: {subj_code:subj_code},
				success: function(ret){
					$("#load").html(ret);
					$("#subj").attr('disabled',true);
				}
			});
		}
	});
</script>