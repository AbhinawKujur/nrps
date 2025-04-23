<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Notice</a> <i class="fa fa-angle-right"></i> Sent Report Details </li>
</ol>

  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
     <div class='col-sm-4'>
	    <table class='table'>
			<tr>
				<th>Date</th>
				<td><input class='dt' id='date' type='text' name='date' autocomplete='off' class='form-control' onchange='dt(this.value)'></td>
			</tr>
			<tr>
				<th>Category </th>
				<td>
					<select class='form-control' id='cat'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><button class='btn btn-success btn-sm' onclick='search()'>Search</button></td>
			</tr>
	    </table>
     </div>
     <div class='col-sm-8'>
		<div class='table-responsive'>
        <table class='table dataTable'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important'>Teacher</th>
					<th style='background:#337ab7; color:#fff !important'>Class</th>
					<th style='background:#337ab7; color:#fff !important'>Sec</th>
					<th style='background:#337ab7; color:#fff !important'>Notice</th>
					<th style='background:#337ab7; color:#fff !important'>Attachment</th>
					<th style='background:#337ab7; color:#fff !important'>Total Sent</th>
					<th style='background:#337ab7; color:#fff !important'>Sent Type</th>
				</tr>
			</thead>
			<tbody id='load_body'>
				
			</tbody>
        </table>
        </div>
	 </div>
	 
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Student List</h4>
		  </div>
		  <div class="modal-body">
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	 
	 
  </div>
</div>
<br /><br />


<!-- /.modal -->
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true });
   $("#multiselect").select2();
	
   $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
	  'pageLength'  : 5,
      aaSorting: [[0, 'asc']]
    })
  });
  
  function dt(val){
	 $.post("<?php echo base_url('notice/NoticeReport/loadCat'); ?>",{date:val},function(data){
		 $("#cat").html(data);
	 });
  }
  
  function search(){
	  var date = $("#date").val();
	  var cat  = $("#cat").val();
	  if(date !='' && cat != ''){
		  $.post("<?php echo base_url('notice/NoticeReport/loadSearchByData'); ?>",{date:date,cat:cat},function(data){
			 $("#load_body").html(data);
		  });
	  }else{
		  $.toast({
                heading: 'Error',
                text: 'Select First',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
            });
	  }
  }
  
  function SentNotice(id){
	  $.ajax({
		  url :"<?php echo base_url('notice/NoticeReport/sentNoticeView'); ?>",
		  type :"POST",
		  data :{id:id},
		  success: function(data){
			  $("#myModal").modal('show');
			  $(".modal-body").html(data);
		  }
	  });
  }
</script>