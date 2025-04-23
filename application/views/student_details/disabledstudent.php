<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Disabled Student</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style type="text/css">
  body{
   font-family: Verdana,Geneva,sans-serif; 
  }
  .box.box-primary {
    border-top-color: #faa21c;
    box-shadow: 0 1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);
}
.box-header.with-border {
    border-bottom: 4px solid #f4f4f4;
	background-color: #a7a7a7;
}
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  margin: 0px auto;
  z-index:999;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<div class="row">
		<div class="col-md-12">
			<?php
			   if($this->session->flashdata('msg')){
				?>
				<div class="alert alert-success" role="alert" id="msg" style="padding: 6px 0px;">
					<center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
				</div>
				<?php
			   }
			?>
		</div>
	</div>
<div class="loader" style="display:none;"></div>
	<div class="row">
		<div class='col-md-12 col-sm-12 col-lg-12'>
			<div class="box box-primary">
				<div class='box-header with-border'>
					<h3 class='box-title'><i class='fa fa-search'></i>Search Criteria</h3>
				</div>
				<div class='box-body'>
					<div class='row'>
						<form id='form'>
						<div class='col-md-6 col-sm-6 col-lg-6'>
							<div class='form-group'>
								<label>Class<span class='span'>*</span></label>
								<select name='class' class='form-control' onchange="selectsec(this.value)" id='class' required>
									<option value=''>Select</option>
									<?php
										foreach($class as $key=>$value){
											?>
											<option value='<?php echo $value->Class_No; ?>'><?php echo $value->CLASS_NM; ?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class='col-md-6 col-sm-6 col-lg-6'>
							<div class='form-group'>
								<label>Sec<span class='span'>*</span></label>
								<select name='sec' class='form-control' id='sec' required>
								</select>
							</div>
						</div>
						<div class='col-sm-12 col-md-12 col-lg-12'>
							<div class="form-group">
								<center><button class='btn btn-success'>Submit</button></center>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div></br></br>
	<div class='row'>
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div id='load_data'>
				<table class="table table-bordered" id="example">
					<thead>
					  <tr>
						<th>Sl no.</th>
						<th>Student Id</th>
						<th>Admission No</th>
						<th>Student Name</th>
						<th>Class</th>
						<th>Sec</th>
						<th>Father Name</th>
						<th>Mother Name</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
					 <?php
						if($student){
							$i = 1;
							foreach($student as $student_data){
								?>
								  <tr>
									<td><?php echo $i; ?></td>
									<td><a href="<?php echo base_url('Student_details/show_student_detailss/'.$student_data->STUDENTID); ?>"><?php echo $student_data->STUDENTID; ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_detailss/'.$student_data->STUDENTID); ?>"><?php echo $student_data->ADM_NO; ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_detailss/'.$student_data->STUDENTID); ?>"><?php echo $student_data->FIRST_NM; ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_detailss/'.$student_data->STUDENTID); ?>"><?php echo $student_data->DISP_CLASS; ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_detailss/'.$student_data->STUDENTID); ?>"><?php echo $student_data->DISP_SEC; ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_detailss/'.$student_data->STUDENTID); ?>"><?php echo $student_data->FATHER_NM ?></a></td>
									<td><a href="<?php echo base_url('Student_details/show_student_detailss/'.$student_data->STUDENTID); ?>"><?php echo $student_data->MOTHER_NM ?></a></td>
									<td><i title="Recall Student" style='cursor: pointer; color:black;' onclick="recall('<?php echo $student_data->STUDENTID; ?>','<?php echo $student_data->ADM_NO; ?>')" class="fa fa-reply" aria-hidden="true"></i></td>
								  </tr>
								<?php
								$i++;
							}
						}
					  ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
  
</div><br /><br />
<div class="clearfix"></div>
                   
	
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		function selectsec(val){
		$.ajax({
			url: "<?php echo base_url('Student_report/find_sec'); ?>",
			type: "POST",
			data: {val:val},
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$("#sec").html(data);
			},
		});
	}
	function recall(val,adm){
		var r = confirm("Are you sure want to recall admission no. "+adm+" ?");
		  if (r == true) {
				$.ajax({
				url: "<?php echo base_url('Disabledstudent/active_student'); ?>",
				method: "POST",
				data:{val:val},
				success:function(data){
					if(data == 1){
						location.reload();
					}
				},
			});
		  }
		
	}
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block"></div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />


   <script type="text/javascript">
   $("#form").on("submit", function (event) {
	event.preventDefault();
		$.ajax({
			url: "<?php echo base_url('Disabledstudent/getdata'); ?>",
			type: "POST",
			data: $('#form').serialize(),
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$("#load_data").html(data);
			},
		});
	});
   	$("#msg").fadeOut(8000);
    $(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			{
                extend: 'copyHtml5',
				title: 'Student Details',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
                }
            },
			{
                extend: 'excelHtml5',
				title: 'Student Details',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
                }
            },
			{
                extend: 'csvHtml5',
				title: 'Student Details',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
                }
            },
			{
                extend: 'pdfHtml5',
				title: 'Student Details',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
                }
            },
        ]
    });
 });

    </script>
