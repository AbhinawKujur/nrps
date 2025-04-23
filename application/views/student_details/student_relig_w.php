<?php
$religion = $religion;
$secc = $sec;
$clss = $cls;
// echo "<pre>";print_r($clss);die;
?>
<center style='display:none'><a href='<?php echo base_url("Student_details/show_strenght_lelig_pdf/$wardt"); ?>'><span class='btn btn-success btn-sm'>Download Pdf</span></a></center>
<br />
<div class='table-responsive'>
	<form method="post" action="<?php echo base_url('Student_details/show_strenght_religion_pdf'); ?>">
		<input type="hidden" name="religion" value="<?php echo $religion; ?>">
		<input type="hidden" name="secc" value="<?php echo $sec; ?>">
		<?php foreach($clss as $p){ ?>
			<input type="hidden" name="langOpt[]" value="<?php echo $p; ?>">
		<?php } ?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<center>
					<button formtarget="_blank" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> Download</button>
				</center>
			</div>
		</div>
	</form>
	<table class="table table-striped" id="example" style='font-size:12px'>
		<thead>
			<tr>
				<th>Sl no.</th>
				<th>Student Id</th>
				<th>Admission No</th>

				<th>Roll No</th>



				<th>Student Name</th>
				<th>Gender</th>
				<th>DOB</th>
				<th>Category</th>
				<th>House</th>


				<th>Class-Sec</th>

				<th>Father Name</th>
				<th>Mother Name</th>
				<th>Mobile No.</th>
				<th>Parent Email-ID.</th>
				<!--  <th>Aadhaar No</th>-->
				<th>Admission Date</th>

				<!-- <th>Bus Stoppage</th>
		   <th>Bus No.</th>-->

				<th>Religion</th>


			</tr>
		</thead>
		<tbody>
			<?php
			if ($data) {
				$i = 1;
				foreach ($data as $student_data) {
			?>
					<tr>
						<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $i; ?></a></td>
						<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->STUDENTID; ?></a></td>
						<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->ADM_NO; ?></a></td>
						<td><?php echo $student_data->ROLL_NO; ?></td>

						<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->FIRST_NM; ?></a></td>
						<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo ($student_data->SEX == 1) ? 'MALE' : 'FEMALE'; ?></a></td>
						<td><?php echo date('d-M-Y', strtotime($student_data->BIRTH_DT)); ?></td>
						<td><?php echo $student_data->CATEGORY_NM; ?></td>
						<td><?php echo $student_data->HOUSE_NM; ?></td>



						<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->DISP_CLASS; ?>-<?php echo $student_data->DISP_SEC; ?></a></td>

						<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->FATHER_NM ?></a></td>
						<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->MOTHER_NM ?></a></td>
						<td><a href="<?php echo base_url('Student_details/show_student_details/' . $student_data->STUDENTID); ?>"><?php echo $student_data->C_MOBILE ?></a></td>
						<td><?php echo $student_data->P_EMAIL; ?></td>
						<!--  <td><?php //echo $student_data->Bus_Book_No; 
									?></td>--->
						<td><?php echo date('d-M-Y', strtotime($student_data->ADM_DATE)); ?></td>

						<!-- <td><?php //echo $student_data->STOP_NM; 
									?></td>
					   <td><?php //echo $student_data->BUS_NO_C; 
							?></td>-->

						<td><?php echo $student_data->religion_nm; ?></td>

					</tr>
			<?php
					$i++;
				}
			}
			?>
		</tbody>
	</table>


	<script>
		$(document).ready(function() {
			var navoffeset = $(".header-main").offset().top;
			$(window).scroll(function() {
				var scrollpos = $(window).scrollTop();
				if (scrollpos >= navoffeset) {
					$(".header-main").addClass("fixed");
				} else {
					$(".header-main").removeClass("fixed");
				}
			});
		});
	</script>
	<!-- /script-for sticky-nav -->
	<!--inner block start here-->
	<div class="inner-block"></div>

	<script type="text/javascript">
		$("#msg").fadeOut(8000);

		$(document).ready(function() {
			$('#example').DataTable({
				'paging': true,
				'lengthChange': true,
				'searching': true,
				'ordering': true,
				'info': true,
				'autoWidth': true,
				'pageLength': 10,
				dom: 'Bfrtip',
				buttons: {
					dom: {
						button: {
							tag: 'button',
							className: ''
						}
					},
					buttons: [{
							extend: 'excel',
							text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
							title: 'Religion wise Student Strength',
							className: 'btn btn-success',
							extension: '.xlsx'
						},
					]
				}
			});
		});
	</script>

	<script type="text/javascript">
		$(window).load(function() { // makes sure the whole site is loaded
			$('#status').fadeOut(); // will first fade out the loading animation

			$('#preloader').delay(50).fadeOut(100);
			$('#example').delay(50).fadeIn(100);
			// will fade out the white DIV that covers the website.
			$('body').delay(50).css({
				'overflow': 'visible'
			});
		})
	</script>