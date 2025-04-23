<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">List Of Issue Tc</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
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
	 <table class="table table-bordered" id="example">
		<thead>
			<tr>
				<th>Sl No.</th>
				<th>TC No.</th>
				<th>Admission No.</th>
				<th>Student Name</th>
				<th>Father Name</th>
				<th>Mother Name</th>
				<th>Current Class</th>
				<th>Application Date</th>
				<th>Issue Date</th>
				<th>Status</th>
				<th>No of Copy Issue</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if($data){
				$i = 1;
				foreach($data as $data_key){
					?>
						<tr>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo $i; ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo $data_key->TCNO; ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo $data_key->adm_no; ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo $data_key->Name; ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo $data_key->Father_NM; ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo $data_key->Mother_NM; ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo $data_key->current_Class; ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo date('d-M-Y',strtotime($data_key->text019)); ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo date('d-M-Y',strtotime($data_key->text020)); ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo $data_key->Tc_Status; ?></a></td>
							<td><a href="<?php echo base_url('Certificate/show_cancel_reprint_tc/'.$data_key->adm_no); ?>"><?php echo $data_key->duplicate_issue; ?></a></td>
						</tr>
					<?php
					$i++;
				}
			}
		?>
		</tbody>
	 </table>
</div>
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
    $(document).ready(function() {
	$("#msg").fadeOut(8000);
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			{
                extend: 'excelHtml5',
				title: 'Tc Issue List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7,8,9]
                }
            },
			{
                extend: 'csvHtml5',
				title: 'Tc Issue List',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7,8,9]
                }
            },
			{
                extend: 'pdfHtml5',
				title: 'Tc Issue List',
				orientation: 'landscape',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7,8,9]
                }
            },
        ]
    });
 });

    </script>
