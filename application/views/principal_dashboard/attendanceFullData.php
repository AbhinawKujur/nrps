<style type="text/css">
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
  }
  .thead-color
  {
  	background: #337ab7 !important; color: white !important;
  }
</style>
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
	<div class="row">
		<div class='col-sm-12'>
		<?php if(isset($totalStudent)){ ?>
			<table class='table table-bordered table-striped datatable'>
				<h3 style="text-align: center;">Student's Todays Attendance Details of Class - <strong><?php echo $class_name; ?></strong> & Section - <strong><?php echo $section_name; ?></strong></h3><hr>
				<thead>
				   <tr>
				     <th style="background: #337ab7; color: white !important;">S.No.</th>
				     <th style="background: #337ab7; color: white !important;">Adm. No.</th> 
				     <th style="background: #337ab7; color: white !important;">Name</th> 
				     <th style="background: #337ab7; color: white !important;">Gender</th>
				     <th style="background: #337ab7; color: white !important;">Status</th>
				   </tr>
				</thead>
				<tbody>
					<?php $i = 1; foreach ($totalStudent as $key => $value) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $value['ADM_NO']; ?></td>
							<td><?php echo $value['FIRST_NM'].' '.$value['MIDDLE_NM']; ?></td>
							<td><?php if($value['SEX'] == 1)
							{
								echo "Male";
							}else{
								echo "Female";
							} ?></td>
							<td><?php if($value['att_status']=='P'){
								echo "Present";
							}elseif($value['att_status'] =='HD')
							{
								echo "Half Day";
							}else{
								echo "Absent";
							} ?></td>
						</tr>
						
					<?php $i = $i +1; } ?>
				</tbody>
			</table>
		<?php } ?>
		<?php if(isset($totalStudentPeriodWise)){ ?>
			<table class='table table-bordered table-striped datatable'>
				<h3 style="text-align: center;">Student Attendance Details of Class - <strong><?php echo $class_name; ?></strong> & Section - <strong><?php echo $section_name; ?></strong></h3><hr>
				<thead>
				   <tr>
				     <th class="thead-color">S.No.</th>
				     <th class="thead-color">Adm. No.</th> 
				     <th class="thead-color">Student Name</th> 
				     <th class="thead-color">Gender</th>
				     <th  class="text-center thead-color">P1</th>
				   <!--   <th  class="text-center thead-color">P2</th>
				     <th  class="text-center thead-color">P3</th>
				     <th  class="text-center thead-color">P4</th>
				     <th  class="text-center thead-color">P5</th>
				     <th  class="text-center thead-color">P6</th>
				     <th  class="text-center thead-color">P7</th> -->
				     <th  class="text-center thead-color">P8</th>
				   </tr>
				</thead>
				<tbody>
					<?php foreach ($totalStudentPeriodWise as $key => $value) { ?>
						<tr>
							<td class="text-center"><?php echo $key+1; ?></td>
							<td><?php echo $value['admno']; ?></td>
							<td><?php echo $value['FIRST_NM'].' '.$value['MIDDLE_NM']; ?></td>
							<td><?php if($value['SEX'] == 1)
							{
								echo "Male";
							}else{
								echo "Female";
							} ?></td>
							<!-- <?php for ($i=1; $i <= 8; $i++) { ?>
								<td class="text-center"><?php if($value['period'.$i]=='P'){
									echo "<b style='color:green;'>P</b>";
								}else{
									echo "<b style='color:red;'>A</b>";
								} ?></td>
							<?php } ?> -->

							<!--removing part -->
								<td class="text-center"><?php if($value['period1']=='P'){
									echo "<b style='color:green;'>P</b>";
								}else{
									echo "<b style='color:red;'>A</b>";
								} ?></td>
								<td class="text-center"><?php if($value['period8']=='P'){
									echo "<b style='color:green;'>P</b>";
								}else{
									echo "<b style='color:red;'>A</b>";
								} ?></td>
							<!--removing part -->
						</tr>
						
					<?php } ?>
				</tbody>
			</table>
		<?php } ?>
		</div>
	</div>
</div>
<br /><br />
<script type="text/javascript">
	  $('.datatable').dataTable( {
        "paging":true,
        "pageLength":50,

    });
</script>