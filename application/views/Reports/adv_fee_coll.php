<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Advance Fee Collection Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style>
	.ui-datepicker-month,
	.ui-datepicker-year {
		padding: 0px;
	}

	.table,
	#thead,
	tr,
	td,
	th {
		text-align: center;
		color: #000 !important;
	}
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">

	<div class='row'>
		<div class="col-md-3 form-group">
			<label id='ct'>Start Date</label>
			<input type="date" name="strt_date" id="strt_date" class="form-control">
		</div>

		<div class="col-md-3 form-group">
			<label id='ct'>End Date</label>
			<input type="date" name="end_date" id="end_date" class="form-control">
		</div>

	</div>
	<div class='row'>


	</div>
	<div class="row">
		<center>
			<button class="btn btn-success" onclick="headwise(this.value)">Display</button>
		</center>
	</div><br /><br />

	<div id='load_page'>

	</div>
</div><br />
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
	function headwise() {
		var strt_date = $('#strt_date').val();
		var end_date = $('#end_date').val();

		$.ajax({
			url: "<?php echo base_url('Report/adv_coll_data'); ?>",
			type: "POST",
			data: {
				strt_date: strt_date,
				end_date: end_date
			},
			success: function(data) {
				$('#load_page').html(data);

			}
		});
	}
</script>