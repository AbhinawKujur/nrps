<?php 
if($fee_head1)
	{
		$feehead1 = $fee_head1[0]->FEE_HEAD;
	}
	if($fee_head2)
	{
		$feehead2 = $fee_head2[0]->FEE_HEAD;
	}
	if($fee_head3)
	{
		$feehead3 = $fee_head3[0]->FEE_HEAD;
	}
	if($fee_head4)
	{
		$feehead4 = $fee_head4[0]->FEE_HEAD;
	}
	if($fee_head5)
	{
		$feehead5 = $fee_head5[0]->FEE_HEAD;
	}
	if($fee_head6)
	{
		$feehead6 = $fee_head6[0]->FEE_HEAD;
	}
	if($fee_head7)
	{
		$feehead7 = $fee_head7[0]->FEE_HEAD;
	}
	if($fee_head8)
	{
		$feehead8 = $fee_head8[0]->FEE_HEAD;
	}
	if($fee_head9)
	{
		$feehead9 = $fee_head9[0]->FEE_HEAD;
	}
	if($fee_head10)
	{
		$feehead10 = $fee_head10[0]->FEE_HEAD;
	}
	if($fee_head11)
	{
		$feehead11 = $fee_head11[0]->FEE_HEAD;
	}
	if($fee_head12)
	{
		$feehead12 = $fee_head12[0]->FEE_HEAD;
	}
	if($fee_head13)
	{
		$feehead13 = $fee_head13[0]->FEE_HEAD;
	}
	if($fee_head14)
	{
		$feehead14 = $fee_head14[0]->FEE_HEAD;
	}
	if($fee_head15)
	{
		$feehead15 = $fee_head15[0]->FEE_HEAD;
	}
	if($fee_head16)
	{
		$feehead16 = $fee_head16[0]->FEE_HEAD;
	}
	if($fee_head17)
	{
		$feehead17 = $fee_head17[0]->FEE_HEAD;
	}
	if($fee_head18)
	{
		$feehead18 = $fee_head18[0]->FEE_HEAD;
	}
	if($fee_head19)
	{
		$feehead19 = $fee_head19[0]->FEE_HEAD;
	}
	if($fee_head20)
	{
		$feehead20 = $fee_head20[0]->FEE_HEAD;
	}
	if($fee_head21)
	{
		$feehead21 = $fee_head21[0]->FEE_HEAD;
	}
	if($fee_head22)
	{
		$feehead22 = $fee_head22[0]->FEE_HEAD;
	}
	if($fee_head23)
	{
		$feehead23 = $fee_head23[0]->FEE_HEAD;
	}
	if($fee_head24)
	{
		$feehead24 = $fee_head24[0]->FEE_HEAD;
	}
	if($fee_head25)
	{
		$feehead25 = $fee_head25[0]->FEE_HEAD;
	}
?>
<style type="text/css">
  body{
   font-family: Verdana,Geneva,sans-serif; 
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Scholarship Information</a> <i class="fa fa-angle-right"></i></li>
</ol><br />
<!--four-grids here-->
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
					<a href="<?php echo base_url('Student_details/add_scholarship'); ?>" class='btn btn-warning pull-right'>Add New Student</a><br /><br /><br />
				</div>
			</div>
			<div style="overflow-x:auto;">
				<table class="table table-bordered" id="example">
			<thead>
			  <tr>
				<th>Sl no.</th>
				<th>Admission No</th>
				<th>Student Name</th>
				<th>Class</th>
				<th>Roll No</th>
				<?php
				 if($feehead1!="" && $feehead1!="-")
				 {
				 	?>
				 	<th><?php echo $feehead1; ?></th>
				 	<?php
				 }
				 else{

				 }
				?>
				<?php
				 if($feehead2!="" && $feehead2!="-")
				 {
				 	?>
				 	<th><?php echo $feehead2; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead3!="" && $feehead3!="-")
				 {
				 	?>
				 	<th><?php echo $feehead3; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead4!="" && $feehead4!="-")
				 {
				 	?>
				 	<th><?php echo $feehead4; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead5!="" && $feehead5!="-")
				 {
				 	?>
				 	<th><?php echo $feehead5; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead6!="" && $feehead6!="-")
				 {
				 	?>
				 	<th><?php echo $feehead6; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead7!="" && $feehead7!="-")
				 {
				 	?>
				 	<th><?php echo $feehead7; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead8!="" && $feehead8!="-")
				 {
				 	?>
				 	<th><?php echo $feehead8; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead9!="" && $feehead9!="-")
				 {
				 	?>
				 	<th><?php echo $feehead9; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead10!="" && $feehead10!="-")
				 {
				 	?>
				 	<th><?php echo $feehead10; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead11!="" && $feehead11!="-")
				 {
				 	?>
				 	<th><?php echo $feehead11; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead12!="" && $feehead12!="-")
				 {
				 	?>
				 	<th><?php echo $feehead12; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead13!="" && $feehead13!="-")
				 {
				 	?>
				 	<th><?php echo $feehead13; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead14!="" && $feehead14!="-")
				 {
				 	?>
				 	<th><?php echo $feehead14; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead15!="" && $feehead15!="-")
				 {
				 	?>
				 	<th><?php echo $feehead15; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead16!="" && $feehead16!="-")
				 {
				 	?>
				 	<th><?php echo $feehead16; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead17!="" && $feehead17!="-")
				 {
				 	?>
				 	<th><?php echo $feehead17; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead18!="" && $feehead18!="-")
				 {
				 	?>
				 	<th><?php echo $feehead18; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead19!="" && $feehead19!="-")
				 {
				 	?>
				 	<th><?php echo $feehead19; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead20!="" && $feehead20!="-")
				 {
				 	?>
				 	<th><?php echo $feehead20; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead21!="" && $feehead21!="-")
				 {
				 	?>
				 	<th><?php echo $feehead21; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead22!="" && $feehead22!="-")
				 {
				 	?>
				 	<th><?php echo $feehead22; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead23!="" && $feehead23!="-")
				 {
				 	?>
				 	<th><?php echo $feehead23; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead24!="" && $feehead24!="-")
				 {
				 	?>
				 	<th><?php echo $feehead24; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
				<?php
				 if($feehead25!="" && $feehead25!="-")
				 {
				 	?>
				 	<th><?php echo $feehead25; ?></th>
				 	<?php
				 }
				 else{
				 	
				 }
				?>
			  </tr>
			</thead>
			<tbody>
			  <?php
			    if($scholarship){
					$i = 1;
					foreach($scholarship as $student_data){
						?>
						  <tr>
						    <td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $i; ?></a></td>
						    <td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->ADM_NO; ?></a></td>
						    <td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->STU_NAME; ?></a></td>
						    <td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->CLASS."-".$student_data->SEC; ?></a></td>
						    <td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->ROLL_NO; ?></a></td>
						    <?php
						    if($feehead1!="" && $feehead1!="-")
						    {
						    	?>
						    	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S1; ?></a></td>
						    	<?php
						    }
						    else
						    {

						    }
						    ?>
						    <?php
						     if($feehead2!="" && $feehead2!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S2; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead3!="" && $feehead3!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S3; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead4!="" && $feehead4!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S4; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead5!="" && $feehead5!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S5; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead6!="" && $feehead6!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S6; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead7!="" && $feehead7!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S7; ?></a></td>
						     	<?php
						     }
						    ?>
						    <?php
						     if($feehead8!="" && $feehead8!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S8; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead9!="" && $feehead9!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S9; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead10!="" && $feehead10!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S10; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead11!="" && $feehead11!="")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S11; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead12!="" && $feehead12!="")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S12; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead13!="" && $feehead13!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S13; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead14!="" && $feehead14!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S14; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead15!="" && $feehead15!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S15; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead16!="" && $feehead16!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S16; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						     <?php
						     if($feehead17!="" && $feehead17!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S17; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead18!="" && $feehead18!="-")
						     {
						     	?>
						     	 <td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S18; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead19!="" && $feehead19!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S19; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead20!="" && $feehead20!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S20; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead21!="" && $feehead21!="-")
						     {
						     	?>
						     	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S21; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						    <?php
						     if($feehead22!="" && $feehead22!="-")
						     {
						     	?>
						     	 <td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S22; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						   <?php
						    if($feehead23!="" && $feehead23!="-")
						    {
						    	?>
						    	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S23; ?></a></td>
						    	<?php
						    }
						    else
						    {

						    }
						   ?>
						    <?php
						     if($feehead24!="" && $feehead24!="-")
						     {
						     	?>
						     	 <td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S24; ?></a></td>
						     	<?php
						     }
						     else
						     {

						     }
						    ?>
						   	<?php
						   	 if($feehead25!="" && $feehead25!="-")
						   	 {
						   	 	?>
						   	 	<td><a href="<?php echo base_url('Student_details/scholarship_student/'.$student_data->STUDENTID); ?>"><?php echo $student_data->S25; ?></a></td>
						   	 	<?php
						   	 }
						   	 else
						   	 {

						   	 }
						   	?>
						    
						  </tr>
						<?php
						$i++;
					}
				}
			  ?>
			</tbody>
		  </table>
			</div>	
		  
		</div><br /><br />
        <div class="clearfix"></div>
<div class="inner-block">

</div>
     
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
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','excel','pdf','print'
        ]
    } );
 });
 </script>
