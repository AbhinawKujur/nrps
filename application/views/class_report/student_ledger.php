<style type="text/css">
  body{
   font-family: Verdana,Geneva,sans-serif; 
  }
  .t{
	  background-color:#b6b6c5;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    font-size: 0.9em;
    color: #151414;
    border-top: none !important;
    padding-top: 5px !important;
}
</style>
<div class="panel-group">
	<div class="panel panel-primary">
	  <div class="panel-heading">Student Details</div>
	  <div class="panel-body" style="background-color: #fff;">
		<table class="table table-bordered">
			<tr>
				<td>Admission No.</td>
				<td>:<?php echo $Adm_no; ?></td>
				<td>Student Name</td>
				<td>:<?php echo $student_name; ?></td>
				<td>Roll No.</td>
				<td>:<?php echo $ROLL_NO; ?></td>
			</tr>
			<tr>
				<td>Father Name</td>
				<td colspan='5'>:<?php echo $FATHER_NM; ?></td>
			</tr>
			<tr>
				<td>Class</td>
				<td>:<?php echo $class; ?></td>
				<td>Sec</td>
				<td>:<?php echo $sec; ?></td>
				<td>Ward</td>
				<td>:<?php echo $eward; ?></td>
			</tr>
			
		</table>
		<form action="<?php echo base_url('Feepaid_ledger/gen_pdf'); ?>" method="post">
			<input type="hidden" name="adm" value="<?php echo $Adm_no; ?>">
			<input type="hidden" name="stuname" value="<?php echo $student_name; ?>">
			<input type="hidden" name="roll" value="<?php echo $ROLL_NO; ?>">
			<input type="hidden" name="class" value="<?php echo $class; ?>">
			<input type="hidden" name="sec" value="<?php echo $sec; ?>">
			<input type="hidden" name="ward" value="<?php echo $eward; ?>">
			<input type="hidden" name="father" value="<?php echo $FATHER_NM; ?>">
			<button class="btn pull-left"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Download Pdf</button>
		</form>
	  </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-lg-12">
		<div style="overflow:auto;">
			<table class="table" id="example">
				<tr>
					<th>Receipt No.</th>
					<th>Receipt Date</th>
					<th>Particular</th>
					<th>Total Amount</th>
				</tr>
				<?php
					foreach($arr_mrg as $key=> $value){
						?>
							<tr>
								<td class="t"><?php echo $value->RECT_NO; ?></td>
								<td class="t"><?php echo date("d-M-Y",strtotime($value->RECT_DATE)); ?></td>
								<td class="t"><?php echo $value->PERIOD; ?></td>
								<td class="t"><?php echo $value->TOTAL."/-"; ?></td>
							</tr>
						<?php
						foreach($feehead as $key1=>$value1){
							$fh = $key1+1;
							$fee = "Fee".$fh;
							if($value->$fee > 0){
								?>
									<tr>
										<td></td>
										<td></td>
										<td><?php echo $value1->FEE_HEAD.":-".$value->$fee."/-"; ?></td>
										<td></td>
									</tr>
								<?php
							}
						}
					}
				?>
			</table>
		</div>
	</div>
</div>