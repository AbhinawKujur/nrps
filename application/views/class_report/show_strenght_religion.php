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
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Religion wise Student Strength</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style>
	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		color: black;
	}

	/* The container */
	.container {
		display: block;
		position: relative;
		padding-left: 35px;
		margin-bottom: 12px;
		cursor: pointer;
		font-size: 22px;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	/* Hide the browser's default radio button */
	.container input {
		position: absolute;
		opacity: 0;
		cursor: pointer;
	}

	#langOpt_input {
		width: 150%;
	}

	/* Create a custom radio button */
	.checkmark {
		position: absolute;
		top: 0;
		left: 0;
		height: 25px;
		width: 25px;
		background-color: grey;
		border-radius: 50%;
	}

	/* On mouse-over, add a grey background color */
	.container:hover input~.checkmark {
		background-color: #4CAF50;
	}

	/* When the radio button is checked, add a blue background */
	.container input:checked~.checkmark {
		background-color: #2196F3;
	}

	/* Create the indicator (the dot/circle - hidden when not checked) */
	.checkmark:after {
		content: "";
		position: absolute;
		display: none;
	}

	/* Show the indicator (dot/circle) when checked */
	.container input:checked~.checkmark:after {
		display: block;
	}

	/* Style the indicator (dot/circle) */
	.container .checkmark:after {
		top: 9px;
		left: 9px;
		width: 8px;
		height: 8px;
		border-radius: 50%;
		background: white;
	}

	.loader {
		border: 16px solid #f3f3f3;
		border-radius: 50%;
		border-top: 16px solid #3498db;
		width: 120px;
		height: 120px;
		margin: 0px auto;
		z-index: 999;
		-webkit-animation: spin 2s linear infinite;
		/* Safari */
		animation: spin 2s linear infinite;
	}

	/* Safari */
	@-webkit-keyframes spin {
		0% {
			-webkit-transform: rotate(0deg);
		}

		100% {
			-webkit-transform: rotate(360deg);
		}
	}

	@keyframes spin {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}
</style>
<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id="data_id">
		<div class='row'>
			<div class='col-md-3 form-group'>
				<fieldset>
					<label><b>Class</b></label>
					<br />
					<select class='form-control' name="langOpt[]" multiple id="langOpt" onchange="selectsec(this.value)">
						<option value='All'>All</option>
						<?php foreach ($class as $key) {
						?>
							<option value='<?php echo $key->Class_No; ?>'> <?php echo $key->CLASS_NM; ?></option>
						<?php
						} ?>
					</select>
				</fieldset>
			</div>
			<div class='col-md-3 form-group'>
				<fieldset>
					<label><b>Section</b>

					</label>
					<select class='form-control' id='sec' name='SECC'>

						<option value='All'>All</option>
						<?php foreach ($section as $key) {
						?>
							<option value='<?php echo $key->section_no; ?>'> <?php echo $key->SECTION_NAME; ?></option>
						<?php
						} ?>

					</select>
				</fieldset>
			</div>
			<div class='col-md-3 form-group'>

				<label><b>Religion Wise</b>

				</label>
				<select class='form-control' name='religion'>

					<?php foreach ($religion as $Key) {
					?>
						<option value='<?php echo $Key->RNo; ?>'><?php echo $Key->Rname; ?></option>
					<?php
					} ?>

				</select>
			</div>
			<div class="col-md-4" style='display:none'>
				<fieldset>
					<label class="container">Class Section Wise
						<input type="radio" onclick='dt(this.value)' value='2' id='ac' name='disp_mode'>
						<span class="checkmark"></span>
					</label>
				</fieldset>
			</div>

			<!--<div class="col-md-3">
			<fieldset>
				<legend><span id='dt'>Details Type</legend>
				<input type="checkbox" value="religion" name="religion" id="religion">Religion Type Details<br />
				<input type="checkbox" value="category" name="category" id="category">Category Type Details<br />
				<input type="checkbox" value="ward" name="ward" id="ward">Ward Type Details<br />
				
			</fieldset>
		</div>-->
			<div class="col-md-3">
				<br />
				<button class='btn btn-success  btn-block'>Display</button>
			</div>
		</div>
	</form>
	<div id="load_data"></div>
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
</div><br />
<script>
	$("#data_id").on("submit", function(event) {
		event.preventDefault();

		$.ajax({
			url: "<?php echo base_url('Student_details/show_strenght_religion'); ?>",
			type: "POST",
			data: $('#data_id').serialize(),
			beforeSend: function() {
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data) {
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$("#load_data").html(data);
			},
		});

	});

	$('select[multiple]').multiselect();
	$('#langOpt').multiselect({
		columns: 1,
		placeholder: 'Student Details',
		search: true
	});
</script>