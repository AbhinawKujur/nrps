<?php
if ($feehead1) {
	$feehead1 = $feehead1[0]->FEE_HEAD;
}
if ($feehead2) {
	$feehead2 = $feehead2[0]->FEE_HEAD;
}
if ($feehead3) {
	$feehead3 = $feehead3[0]->FEE_HEAD;
}
if ($feehead4) {
	$feehead4 = $feehead4[0]->FEE_HEAD;
}
if ($feehead5) {
	$feehead5 = $feehead5[0]->FEE_HEAD;
}
if ($feehead6) {
	$feehead6 = $feehead6[0]->FEE_HEAD;
}
if ($feehead7) {
	$feehead7 = $feehead7[0]->FEE_HEAD;
}
if ($feehead8) {
	$feehead8 = $feehead8[0]->FEE_HEAD;
}
if ($feehead9) {
	$feehead9 = $feehead9[0]->FEE_HEAD;
}
if ($feehead10) {
	$feehead10 = $feehead10[0]->FEE_HEAD;
}
if ($feehead11) {
	$feehead11 = $feehead11[0]->FEE_HEAD;
}
if ($feehead12) {
	$feehead12 = $feehead12[0]->FEE_HEAD;
}
if ($feehead13) {
	$feehead13 = $feehead13[0]->FEE_HEAD;
}
if ($feehead14) {
	$feehead14 = $feehead14[0]->FEE_HEAD;
}
if ($feehead15) {
	$feehead15 = $feehead15[0]->FEE_HEAD;
}
if ($feehead16) {
	$feehead16 = $feehead16[0]->FEE_HEAD;
}
if ($feehead17) {
	$feehead17 = $feehead17[0]->FEE_HEAD;
}
if ($feehead18) {
	$feehead18 = $feehead18[0]->FEE_HEAD;
}
if ($feehead19) {
	$feehead19 = $feehead19[0]->FEE_HEAD;
}
if ($feehead20) {
	$feehead20 = $feehead20[0]->FEE_HEAD;
}
if ($feehead21) {
	$feehead21 = $feehead21[0]->FEE_HEAD;
}
if ($feehead22) {
	$feehead22 = $feehead22[0]->FEE_HEAD;
}
if ($feehead23) {
	$feehead23 = $feehead23[0]->FEE_HEAD;
}
if ($feehead24) {
	$feehead24 = $feehead24[0]->FEE_HEAD;
}
if ($feehead25) {
	$feehead25 = $feehead25[0]->FEE_HEAD;
}
?>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Daily/Monthly Collection Report</a> <i class="fa fa-angle-right"></i></li>
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
	<form id='form'>
		<div class='row'>
			<div class="col-md-4 form-group">
				<label id='ct'>Collection Type</label>
				<select name='collectiontype' id='collectiontype' class='form-control'>
					<option value=''>Select</option>
					<option value='1'>School</option>
					<option value='3'>Online</option>
					<option value='2'>Bank</option>
				</select>
			</div>
			<div class='col-md-4 form-group' id='schooll'>
				<label id='fct'>Fees Collection Type</label>
				<select name='feecollectiontype' id='feecollectiontype' class='form-control'>
					<option value=''>Select</option>
					<option value='All'>All Type of Collection</option>
					<option value='Monthly'>Monthly Collection</option>
					<option value='PRE'>Previous Year Collection</option>
					<option value='MISL'>Miscelleneous Collection</option>
					<option value='NONE'>Collection Without Adm</option>
				</select>
			</div>

			<div class='col-md-4 form-group'>
				<label id='cc'>Collection Counter</label>
				<select class='form-control' name='collectioncounter' id='collectioncounter'>
					<option value=''>Select</option>
					<?php
					if ($ROLE_ID == 10) {
					?>
						<option value='%'>All Counter</option>
					<?PHP
					}
					?>

					<?php
					if ($user_id) {
						foreach ($user_id as $data) {
					?>
							<option value='<?php echo $data->User_Id; ?>'><?php echo $data->User_Id; ?></option>
					<?php
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class='row'>
			<div class="col-md-3 form-group">
				<label id="vt">View Type</label><br />
				<input type="radio" name="viewtype" id="date_wise" value="1" onclick="dt(this.value)"> Date Wise &nbsp;
				<input type="radio" name="viewtype" id="month_wise" value="2" onclick="dt(this.value)"> Month Wise
			</div>
			<div class="col-md-6 form-group">
				<div id="datewise" style="display: none;">
					<label id='sd'>Select Date:</label>
					<input type="date" name="" autocomplete='off' id="single" class="form-control">
				</div>
				<div id="monthwise" style="display: none;">
					<div class="row">
						<div class="col-md-6 form-group">
							<label id='sdm'>Start Date:</label>
							<input type="date" name="" id="multiple_date1" class="form-control">
						</div>
						<div class="col-md-6 form-group">
							<label id='edm'>End Date:</label>
							<input type="date" name="" id="multiple_date2" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 form-group">
				<label>A/C Wise Total</label>
				<select class="form-control" id="awt" name="awt">
					<option value="">Select</option>
				</select>
			</div>
		</div>
		<div class="row">
			<center>
				<button class="btn btn-success">Display</button>
			</center>
		</div><br /><br />
	</form>
	<form style="display:none;" id='dreport' action='<?php echo base_url('Report/daily_report'); ?>' method='post'>
		<input type='hidden' name='ct1' id='ct1'>
		<input type='hidden' name='fct1' id='fct1'>
		<input type='hidden' name='cc1' id='cc1'>
		<input type='hidden' name='vt1' id='vt1'>
		<input type='hidden' name='sd1' id='sd1'>
		<center>
			<button formtarget="_blank" class='btn btn-success'><i class="fa fa-file-pdf-o"></i> Download Daily Report</button>
		</center>
	</form>
	<form style="display:none;" id='dmreport' action='<?php echo base_url('Report/monthly_report'); ?>' method='post'>
		<input type='hidden' name='ct2' id='ct2'>
		<input type='hidden' name='fct2' id='fct2'>
		<input type='hidden' name='cc2' id='cc2'>
		<input type='hidden' name='vt2' id='vt2'>
		<input type='hidden' name='sd2' id='sd2'>
		<input type='hidden' name='sdf2' id='sdf2'>
		<center>
			<button formtarget="_blank" class='btn btn-success'><i class="fa fa-file-pdf-o"></i> Download Monthly Report</button>
		</center>
	</form>
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
	function dt(val) {
		if (val == 1) {
			$('#datewise').show(1000);
		} else {
			$('#datewise').hide(1000);
		}
		if (val == 2) {
			$('#monthwise').show(1000);
		} else {
			$('#monthwise').hide(1000);
		}
	}

	$("#form").on("submit", function(event) {
		event.preventDefault();
		var collectiontype = $('#collectiontype').val();
		var feecollectiontype = $('#feecollectiontype').val();

		var collectioncounter = $('#collectioncounter').val();
		var single = $('#single').val();
		var multiple_date1 = $('#multiple_date1').val();
		var multiple_date2 = $('#multiple_date2').val();

		if (collectiontype != '') {
			$('#ct').css('color', 'black');
			if (feecollectiontype != '') {
				$('#fct').css('color', 'black');
				if (collectioncounter != '') {
					$('#cc').css('color', 'black');
					if ($('#date_wise').is(':checked') || $('#month_wise').is(':checked')) {
						$('#vt').css('color', 'black');
						if ($('#date_wise').is(':checked')) {
							if (single != '') {
								$('#sd').css('color', 'black');
								$.ajax({
									url: "<?php echo base_url('Report/single_date'); ?>",
									type: "POST",
									data: {
										collectiontype: collectiontype,
										feecollectiontype: feecollectiontype,
										collectioncounter: collectioncounter,
										single: single
									},
									success: function(data) {
										$('#load_page').html(data);
										$('#load_page').show(1000);
										$('#dreport').show(1000);
										$('#dmreport').hide(1000);
										$('#ct1').val(collectiontype);
										$('#fct1').val(feecollectiontype);
										$('#cc1').val(collectioncounter);
										$('#sd1').val(single);
									}
								});
							} else {
								alert('Please select Date Format');
								$('#sd').css('color', 'red');
								return false;
							}
						}
						if ($('#month_wise').is(':checked')) {
							if (multiple_date1 != '' && multiple_date2 != '') {
								$('#sdm').css('color', 'black');
								$('#edm').css('color', 'black');
								$.ajax({
									url: "<?php echo base_url('Report/mult_date'); ?>",
									type: "POST",
									data: {
										collectiontype: collectiontype,
										feecollectiontype: feecollectiontype,
										collectioncounter: collectioncounter,
										multiple_date1: multiple_date1,
										multiple_date2: multiple_date2
									},
									success: function(data) {
										$('#load_page').html(data);
										$('#load_page').show(1000);
										$('#dreport').hide(1000);
										$('#dmreport').show(1000);
										$('#ct2').val(collectiontype);
										$('#fct2').val(feecollectiontype);
										$('#cc2').val(collectioncounter);
										$('#sd2').val(multiple_date1);
										$('#sdf2').val(multiple_date2);
									}
								});
							} else {
								alert('Please Select Start Date And End Date');
								$('#sdm').css('color', 'red');
								$('#edm').css('color', 'red');
								return false;
							}
						}

						if ($('#month_wise').is('checked')) {

						}
					} else {
						alert('Please Select View Type');
						$('#vt').css('color', 'red');
						return false;
					}
				} else {
					alert('Please Select Collection Counter');
					$('#cc').css('color', 'red');
					return false;
				}
			} else {
				alert('Please Select Fees Collection Type1111');
				$('#fct').css('color', 'red');
				return false;
			}
		} else {
			alert('Please Select Collection Type');
			$('#ct').css('color', 'red');
			return false;
		}
	});
</script>