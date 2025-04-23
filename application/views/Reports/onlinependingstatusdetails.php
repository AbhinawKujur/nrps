<?php
error_reporting(0);
?>
<style>
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
		font-size: 0.9em;
		color: #101010;
		border-top: none !important;
		padding-top: 5px !important;
	}
	tr:nth-child(even) {background: #FFF }
	tr:nth-child(odd) {background: #CCC}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Online Pending Payment Details</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<div class='row'>
		<div class='col-md-12'>
		<a href='<?php echo base_url('Onlinependingstatus/index'); ?>' class='btn btn-primary pull-right'>Back</a>
		</div>
	</div><br>
	<table class='table table-border'>
		<tr>
			<td><b>Name</b></td>
			<td><?php echo $onlinependingpayment[0]->student_name; ?></td>
			<td><b>Class/Sec</b></td>
			<td><?php echo $onlinependingpayment[0]->class."/".$onlinependingpayment[0]->sec; ?></td>
			<td><b>Admission No.</b></td>
			<td><?php echo $onlinependingpayment[0]->adm_no; ?></td>
		</tr>
		<tr>
			<td><b>Payment Date</b></td>
			<td><?php echo date('d-M-Y',strtotime($onlinependingpayment[0]->response_date)); ?></td>
			<td><b>Payment for Month</b></td>
			<td><?php echo $onlinependingpayment[0]->period; ?></td>
			<td><b>Total Amount</b></td>
			<td><?php echo $onlinependingpayment[0]->total; ?></td>
		</tr>
		<tr>
			<td><b>Order Id</b></td>
			<td colspan='5'><?php echo $onlinependingpayment[0]->u_id; ?></td>
		</tr>
	</table><br>
	<div class="alert alert-info">
    <strong>Fee Payment Details Head Wise</strong>
  </div><br>
  <table class='table table-border'>
	<tr>
		<th><center>Sl No.</center></th>
		<th><center>Head Name</center></th>
		<th><center>Amount<center></th>
	</tr>
	<?php
		$i =1;
		$grandtotal = 0;
		foreach($feehead as $key=>$value){
			$fee = 'fee'.$value->ACT_CODE;
			if($onlinependingpayment[0]->$fee > 0){
				?>
				<tr>
					<td><center><?php echo $i; ?></center></td>
					<td><center><?php echo $value->FEE_HEAD; ?></center></td>
					<td><center><?php echo $onlinependingpayment[0]->$fee; ?></center></td>
				</tr>
				<?php
				$grandtotal += $onlinependingpayment[0]->$fee;
				$i++;
			}
			
		}
	?>
	<tr style='background:#669999;'>
		<td colspan=2><center><b>GRAND TOTAL</b></center></td>
		<td><center><strong><?php echo $grandtotal; ?></strong></center></td>
	</tr>
  </table><br>
  <div class='row'>
	<div class='col-md-6 col-sm-6 col-lg-6'>
		<?php echo form_open('Onlineconfirmcancel/paymentsuccess'); ?>
		 <?php
			$data = array(
				'type'      =>'hidden',
				'name'      => 'orderid',
				'class'     => 'form-control',
				'value'		=> $onlinependingpayment[0]->response_order_id,
			);
		 echo form_input($data); ?>
		 <?php
			$data = array(
				'type'      =>'hidden',
				'name'      => 'admno',
				'class'     => 'form-control',
				'value'		=> $onlinependingpayment[0]->adm_no,
			);
		 echo form_input($data); ?>
		 <input type='submit' value='Confirm Payment' class='btn btn-success btn-block'>
		<?php echo form_close(); ?>
	</div>
	<div class='col-md-6 col-sm-6 col-lg-6'>
		<?php echo form_open('Onlineconfirmcancel/cancelonlinepayment'); ?>
		 <?php
			$data = array(
				'type'      =>'hidden',
				'name'      => 'orderid',
				'class'     => 'form-control',
				'value'		=> $onlinependingpayment[0]->response_order_id,
			);
		 echo form_input($data); ?>
		 <?php
			$data = array(
				'type'      =>'hidden',
				'name'      => 'admno',
				'class'     => 'form-control',
				'value'		=> $onlinependingpayment[0]->adm_no,
			);
		 echo form_input($data); ?>
		 <input type='submit' value='Cancel Payment' class='btn btn-danger btn-block'>
		<?php echo form_close(); ?>
	</div>
  </div>
</div><br />
<div class='clearflex'></div>