<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Student Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style type="text/css">
  body{
   font-family: Verdana,Geneva,sans-serif; 
  }
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<div class="row">
		<div class="col-md-11">
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
		<div class='col-sm-1'>
			<a href="<?php echo base_url('Student_details/add_student'); ?>" class='btn btn-warning pull-right'>Add New Student</a><br /><br /><br />
		</div>
	</div>	
  <table class="table table-bordered" id="example">
	<thead>
	  <tr>
		<th>Sl no.</th>
		<th>Student Id</th>
		<th>Admission No</th>
		<th>Student Name</th>
		<th>Apaar Id</th>
		<th>Class</th>
		<th>Sec</th>
		<th>Father Name</th>
		<th>Mother Name</th>
		<th>Mobile No.</th>
	  </tr>
	</thead>
	<tbody>
	  <?php
		if($data){
			$i = 1;
			foreach($data as $student_data){
				?>
				  <tr>
					<td><a href="<?php echo base_url('Student_details/show_student_details/'.$student_data->STUDENTID); ?>"><?php echo $i; ?></a></td>
					<td><a href="<?php echo base_url('Student_details/show_student_details/'.$student_data->STUDENTID); ?>"><?php echo $student_data->STUDENTID; ?></a></td>
					<td><a href="<?php echo base_url('Student_details/show_student_details/'.$student_data->STUDENTID); ?>"><?php echo $student_data->ADM_NO; ?></a></td>
					<td><a href="<?php echo base_url('Student_details/show_student_details/'.$student_data->STUDENTID); ?>"><?php echo $student_data->FIRST_NM; ?></a></td>
					  <td><a href="<?php echo base_url('Student_details/show_student_details/'.$formatted_adm_no); ?>"><?php echo $student_data->APAR_ID; ?></a></td>

					<td><a href="<?php echo base_url('Student_details/show_student_details/'.$student_data->STUDENTID); ?>"><?php echo $student_data->DISP_CLASS; ?></a></td>
					<td><a href="<?php echo base_url('Student_details/show_student_details/'.$student_data->STUDENTID); ?>"><?php echo $student_data->DISP_SEC; ?></a></td>
					<td><a href="<?php echo base_url('Student_details/show_student_details/'.$student_data->STUDENTID); ?>"><?php echo $student_data->FATHER_NM ?></a></td>
					<td><a href="<?php echo base_url('Student_details/show_student_details/'.$student_data->STUDENTID); ?>"><?php echo $student_data->MOTHER_NM ?></a></td>
					  <td><a href="<?php echo base_url('Student_details/show_student_details/'.$student_data->STUDENTID); ?>"><?php echo $student_data->C_MOBILE ?></a></td>
				  </tr>
				<?php
				$i++;
			}
		}
	  ?>
	</tbody>
  </table>
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
   	$("#msg").fadeOut(8000);
    $(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			{
                extend: 'copyHtml5',
				title: 'Student Details',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
                }
            },
			{
                extend: 'excelHtml5',
				title: 'Student Details',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
                }
            },
			{
                extend: 'csvHtml5',
				title: 'Student Details',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
                }
            },
			{
                extend: 'pdfHtml5',
				title: 'Student Details',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
                }
            },
        ]
    });
 });

    </script>
