<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Online Pending Payment Status</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style>
	.ui-datepicker-month, .ui-datepicker-year
	{
		padding : 0px;
	}
	.table,#thead,tr,td,th
    {
        text-align: center;
        color: #000!important;
    }
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
<?php
	if($this->session->flashdata('msg')){
	?>
	<div class="alert alert-success" role="alert" id="msg" style="padding: 6px 0px;">
		<center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
	</div>
<?php
	}
?>
	<table id='example'>
				<thead>
					<tr>
						<th style='color:white!important;'>S.NO</th>
						<th style='color:white!important;'>Order id</th>
						<th style='color:white!important;'>Response Status</th>
						<th style='color:white!important;'>Response id</th>
						<th style='color:white!important;'>Adm no</th>
						<th style='color:white!important;'>Student Name</th>
						<th style='color:white!important;'>Class/Sec</th>
						<th style='color:white!important;'>Month</th>
						<th style='color:white!important; width:30%!important;'>Total Payment</th>
						<th style='color:white!important; width:30%!important;'>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						foreach($onlinependingpayment as $key=>$value){
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->u_id; ?></td>
									<td><?php echo $value->response_status; ?></td>
									<td><?php echo $value->response_status_id; ?></td>
									<td><?php echo $value->adm_no; ?></td>
									<td><?php echo $value->student_name; ?></td>
									<td><?php echo $value->class."/".$value->sec; ?></td>
									<td><?php echo $value->period; ?></td>
									<td><?php echo $value->total; ?></td>
									<td><a href='<?php echo base_url('Onlinependingstatus/editpendingpayment/'.$value->u_id); ?>'><i  title="Edit" style='background:black; color:white;' class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
								</tr>
							<?php
							$i++;
						}
					?>
				</tbody>
			</table>
</div><br />
<div class='clearflex'></div>
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
<script>
	$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Online Payment Pending Status',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Online Payment Pending Status Details',
				exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
                }
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Online Payment Pending Status',
                
            }, */
			/* {
                extend: 'pdfHtml5',
				title: 'Online Payment Pending Status',
                
            }, */
        ]
    });
 });
</script>