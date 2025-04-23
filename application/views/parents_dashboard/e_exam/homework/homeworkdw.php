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
      <!--<h1>
        Homework List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-clipboard"></i> Home</a></li>
        <li class="active">Homework</li>
      </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-clipboard"></i> Homework List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <div class="row">
            <div class="col-sm-12">
              <div class="table-responsive" id="no-more-tables">
                <table class="table table-striped table-bordered datatable">
                  <thead class="table-header">
                    <tr>
                      <th>Sl. No.</th>
                      <th>Subject</th>
                      <th>Homework date</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
					<?php
						if(!empty($homework)){
							foreach($homework as $key => $val){
								$cdate	= date('Y-m-d');
								$sdate	=date('Y-m-d', strtotime($val['submitDate']));
					?>
                      <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $val['subjnm']; ?></td>
                        <td><?php echo date('d-M', strtotime($val['created_at'])); ?></td>
                        <td>
						  <?php
							if(!empty($val['que_img'])){
							echo 't';
							}
								?>
						  </td>
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
  
  function hwUpload(hw_id){
	  $.ajax({
		  url: "<?php echo base_url('parent_dashboard/homeworklist/uploadHwById'); ?>",
		  type: "POST",
		  data:{hw_id:hw_id},
		  success: function(ret){
			  var fill = $.parseJSON(ret);
			  $("#head").html(fill[0]);
			  $("#rematks").html(fill[1]);
			  $("#hwId").val(fill[2]);
			  $("#uploadHwModal").modal('show');
		  }
	  });
  }
  
  $("#filePHOTO").change(function(){
		var file_size = $('#filePHOTO')[0].files[0].size;
		var ext = $('#filePHOTO').val().split('.').pop().toLowerCase();
			if(file_size > 1048576 || (ext != 'jpg') && (ext != 'jpeg') && (ext != 'doc') && (ext != 'docx') && (ext != 'png') && (ext != 'txt') && (ext != 'pdf')){
				toastr.error('File size must be less than 1000kb and only allowed jpg,jpeg,png,doc,docx,pdf,txt format');
				$("#filePHOTO").val('');
			}
		return true;
	});
	
	$("#uploadHw").on("submit", function (event) {
    event.preventDefault();
	$("#sv_btn").prop('disabled',true);
	$("#process").show();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('parent_dashboard/homeworklist/uploadHwSave'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				$("#uploadHwModal").modal('hide');
				$("#process").hide();
				$("#uploadHw").trigger("reset");
				toastr.success('Save Successfully..!');
			}
		});
	 });
</script>