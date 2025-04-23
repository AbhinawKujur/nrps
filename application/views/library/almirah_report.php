<style>
	label {
		font-size: 12px;
		font-weight: bold !important;
	}

	table {
		padding-right: 20px;
	}

	button.dt-button,
	div.dt-button,
	a.dt-button {
		line-height: 0.66em;
	}

	.dataTables_wrapper .dataTables_paginate .paginate_button.current,
	.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
		line-height: 0.66em;
	}

	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		white-space: nowrap !important;
	}
</style>

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">Almirah Wise Report</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row'>
		<div class='col-sm-4'>
			<?php
			if ($this->session->flashdata('success')) {
			?>
				<div class="alert alert-success">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php
			}
			?>
			<div id='load'>
				<form action="<?php echo base_url('library/RackMaster/getRackData'); ?>" method='post' autocomplete='off'>
					<div class="form-group">
						<label>Almirah Name:</label>
						<select class="form-control" name="rack_nm" style='text-transform: uppercase;' required>
							<option>--Select--</option>
							<?php
							$Rackname = '';
							foreach ($rackMasterData as $key => $val) {
							?>
								<option value="<?= $val['RackNo']; ?>" <?php if ($val['RackNo'] == $select_val) {
																			echo ' selected="selected"';
																		} ?>> <?= $val['RackName'] ?> </option>

							<?php
							} ?>
						</select>
					</div>
					<!-- <div class='row'>
			    <div class='col-sm-6'>
				  <div class="form-group">
					<label>Rack From:</label>
					<input type="number" class="form-control" name="rack_from" style='text-transform: uppercase;' required>
				  </div>
				</div>
				<div class='col-sm-6'>
				  <div class="form-group">
					<label>Rack To:</label>
					<input type="number" class="form-control" name="rack_to" style='text-transform: uppercase;' required>
				  </div>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label>Almirah Description:</label>
				<textarea class="form-control" name="rack_desc" style='text-transform: uppercase;'></textarea>
			  </div> -->
					<button type="submit" class="btn btn-success">Submit</button>
					<h2><?php echo $Rackname; ?></h2>
				</form>
			</div>
		</div>

	</div><br />
	<div class="row">
		<div class='col-sm-12' style='padding-right:20px;'>
			<div class='table-responsive'>
				<table class='table' id='example'>
					<thead>
						<tr>
							<th style='background:#337ab7; color:#fff !important;'>Sl. No.</th>
							<th style='background:#337ab7; color:#fff !important;'>Rack Number</th>
							<th style='background:#337ab7; color:#fff !important;'>Subject Name</th>
							<!-- <th style='background:#337ab7; color:#fff !important;'>Reference Number</th> -->
							<th style='background:#337ab7; color:#fff !important;'>Accession No.</th>
						</tr>
					</thead>
					<tbody>
						<?php

						// print_r($rackMasterData);die();
						$i = 0;
						foreach ($BookMasterData as $key => $value) {
							$i++;
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $value['racnoto']; ?></td>
								<input type="hidden" id="book_name" value="<?php echo $value['id']; ?>" onload='subject(this.value)'>
								<td><?php echo $value['BNAME']; ?></td>
								<!-- <?php foreach ($bookName as $key => $val) {// echo $subID = $value['SUB_ID'];die();?> -->
									<!-- <input type="hidden" id="book_name" value="<?php echo $val['id']; ?>" onload='subject(this.value)'> -->
								<!-- <td><?php echo $val['BNAME']; // $sub_id = $val['SUB_ID']; -->
									// ?></td>
								<!-- <?php } ?> -->

								<!-- <td id="reff_no"><?php echo $value['ID_NO']; ?></td> -->

								<td><?php echo $value['accno']; ?></td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div><br />

<script>
	$(".alert").fadeOut(3000);
	$('#example').DataTable({
		dom: 'Bfrtip',
		buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
				extend: 'excelHtml5',
				title: 'Daily Collection Reports',

			},
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
				extend: 'pdfHtml5',
				title: 'Daily Collection Reports',

			},
		]
	});

	function rackMasterEdit(rack_id, rack_nm, rack_from, rack_to, rack_desc) {
		$.post("<?php echo base_url('library/RackMaster/edit'); ?>", {
			rack_id: rack_id,
			rack_nm: rack_nm,
			rack_from: rack_from,
			rack_to: rack_to,
			rack_desc: rack_desc
		}, function(data) {
			$("#load").html(data);
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var r = $("#book_name").val();
		// alert(r); 
		//Calling a function
		subject(r);
	});

	function subject(subject_id) {
		// console.log("function Called");
		$.post("<?php echo base_url('library/BookMaster/countSubject'); ?>", {
			subject_id: subject_id
		}, function(data) {
			$fillData = $.parseJSON(data);
			console.log($fillData);
			// $("#reff_no").html($fillData[0]);
			// $("#accno").val($fillData[1]);
			// $("#bookno").val($fillData[2]+'-'+$fillData[1]);
			// $("#call_no").val($fillData[2]);
		});
	}
</script>