<?php
error_reporting(0);
if ($tc_details) {
	$adm_date = $tc_details[0]->ADM_DATE;
	$dob = $tc_details[0]->BIRTH_DT;
	$text019 = $tc_details[0]->text019;
	$text020 = $tc_details[0]->text020;
	$adm_d = date("d-M-Y", strtotime($adm_date));
	$dob_t = date("d-M-Y", strtotime($dob));
	$text0191 = date("d-M-Y", strtotime($text019));
	$text0201 = date("d-M-Y", strtotime($text020));
}
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.0.js"></script>
	<style media="print">
		body {
			/* marging: 0px !important;
			paddging: 0px !important; */
		}

		#ptr {
			display: none;

		}

		#border {
			width: 100%;
			height: 100%;
			padding: 5px 20px 0px 20px;
			border: solid 3px black;
		}

		#image {
			height: 100px;
			width: 100px;
			float: right;
		}

		#heading {
			float: right;
		}

		#content {
			border: solid 1px black;
			border-radius: 10px;
		}

		.text-content {
			text-align: right;
		}

		.table td,
		.table th {
			padding: .75rem;
			vertical-align: top;
			border-top: 0px solid #dee2e6;
		}

		.tbl,
		.tr,
		.td {
			font-weight: 1em;
		}

		.table td,
		.table th {
			padding: 8px 0px 0px 0px;
			vertical-align: top;
			border-top: 0px solid #dee2e6;
		}

		@page {
			size: auto;/* auto is the initial value */ 
			margin-top: -10px;/* this affects the margin in the printer settings */ 
			margin-bottom: 0;
			margin-right: 20px;
			margin-left: 20px;
		}

		.head {
			font-weight: bold;
		}

		.head_name {
			font-style: italic;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div>
			<br />
			<br />
			<br />
			<br /> <br />
			<br />
			<div class="row">
				<div class="col-md-3 col-sm-3 col-lg-3">

				</div>
				<div class="col-md-7 col-lg-7 col-sm-7">
					<center>
						<h5>(Affiliated to CBSE Delhi)</h5>
					</center>

				</div>
				<div class="col-md-2 col-sm-2 col-lg-2">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-lg-6">
					<span>School No.:<?php echo $school_setting[0]->School_Code; ?></span>
				</div>
				<div class="col-md-6 col-lg-6 col-sm-6">
					<span style='float:right'>Affln No.:3430053</span>

				</div>

			</div>
			<br /> <br />
			<div class="row">
				<div class="col-md-3 col-sm-3 col-lg-3">
				</div>
				<div class="col-md-6 col-sm-6 col-lg-6">
					<div id="content">
						<center><b>TRANSFER CERTIFICATE</b></center>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3">
				</div>
			</div><br />
			<div class="row">

				<table class="table tbl">
					<tr class="tr">
						<td class="td"></td>
						<td class="td head">TC No.</td>
						<?php if($tc_details[0]->PEN <> ''){ ?>
						<td class="head_name" colspan="2"> :<span style='padding:4px;border-bottom:1px solid black;font-weight:bold'> <?php echo $tc_details[0]->TCNO; ?></span></td>
						<td class="td head" colspan='2'>PEN : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->PEN; ?></span></td>
						<?php } else { ?>
						<td class="head_name" colspan="4"> :<span style='padding:4px;border-bottom:1px solid black;font-weight:bold'> <?php echo $tc_details[0]->TCNO; ?></span></td>
						<?php } ?>

					</tr>
					<tr class="tr">
						<td class="td"></td>
						<td class="td head" style='width:160px'>APAAR ID</td>
						<td class="head_name">: <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'> <?php echo $tc_details[0]->APAR_ID; ?></span></td>
						<td class="td" colspan='3'></td>

					</tr>
					<tr class="tr">
						<td class="td"></td>
						<td class="td head" style='width:160px'>Admission No.</td>
						<td class="head_name">: <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'> <?php echo $tc_details[0]->adm_no; ?></span></td>
						<td class="td" colspan='3'></td>

					</tr>
					<tr class="tr">
						<td class="td">01.</td>
						<td class="td head"> Name of the Pupil</td>
						<td class="td head_name">: <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->Name; ?></span></td>
						<td class="td" colspan='3'></td>
					</tr>
					<tr class="tr">
						<td class="td">02.</td>
						<td class="td head">(a) Mother's Name</td>
						<td class="td head_name">: <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->Mother_NM; ?></span></td>
					</tr>
					<tr class="tr">
						<td class="td"></td>
						<td class="td head">(b) Father's Name</td>
						<td class="td head_name">: <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->Father_NM; ?></span></td>
					</tr>
					<tr class="tr">
						<td class="td">03.</td>
						<td class="td head" colspan='2'>Nationality : &nbsp;&nbsp; <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->Nation; ?></span></td>
						<td class="td head" colspan='2'>04. Whether S.C or S.T. : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->Category; ?></span></td>

					</tr>
					<tr class="tr">
						<td class="td">05.</td>
						<td class="td head" colspan='2'> Date of first Admission in the School : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $adm_d; ?></span></td>

						<td class="td head" colspan='2'>In Class : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->ADM_CLASS; ?> (<?php echo $tc_details[0]->ADM_CLASS_word; ?>)</span></td>
						<td class="td head_name"></td>
					</tr>
					<tr class="tr">
						<td class="td">06.</td>
						<td colspan="3" class="td head"> Date of Birth (in Christan Era) as recorded in the Admission Register:</td>

					</tr>
					<tr class="tr">
						<td class="td"></td>
						<td class="td head_name" colspan="2"><span style='padding:4px;border-bottom:1px solid black;font-weight:bold'> <?php echo $dob_t; ?></span></td>

						<td class="td head_name" colspan="2"> <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->dob_inwords; ?></span></td>
					</tr>

					<tr class="tr">
						<td class="td">07.</td>
						<td class="td head" colspan="3"> Class in which the pupil studied last : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->current_Class; ?> (<?php echo $tc_details[0]->current_Class_word; ?>)</span></td>
						<td class="td head_name"></td>
						<!--<td class="td head">09. Whether failed, in same class </td>
						<td class="td head_name">: <?php //echo $tc_details[0]->combo09; 
													?></td>-->
					</tr>
					<tr class="tr">
						<td class="td">08.</td>
						<td colspan="4" class="td head"> School/Board Annual Examination Last Taken: <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->text08b; ?></span> &nbsp; Result: &nbsp;&nbsp; <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->TEXT08a; ?></span> </td>

					</tr>
					<tr class="tr">
						<td class="td">09.</td>
						<td class="td head" colspan="4"> Whether failed, in same class : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->combo09; ?></span></td>

					</tr>
					<tr class="tr">
						<td class="td">10.</td>
						<td class="td head" colspan="1"> Subject Studied : </td>
						<td class="td head" colspan="3"><span style='padding:4px;border-bottom:1px solid black;font-weight:bold'>
								(1) <?php echo $tc_details[0]->textsub1; ?> ,
								(2) <?php echo $tc_details[0]->textsub2; ?> ,
								(3) <?php echo $tc_details[0]->textsub3; ?> ,
								(4) <?php echo $tc_details[0]->textsub4; ?>,
								(5) <?php echo $tc_details[0]->textsub5; ?>
								<?php if ($tc_details[0]->textsub6 != '') { ?>,(6)<?php } ?> <?php echo $tc_details[0]->textsub6; ?> ,<?php echo $tc_details[0]->textsub7; ?>
							</span>
						</td>
					</tr>


					<tr class="tr">
						<td class="td">11.</td>
						<td class="td head" colspan="4"> Whether qualified for promotion to higher Class : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->combo011; ?></span></td>


					</tr>
					<tr class="tr">
						<td class="td"></td>
						<td class="td head" colspan="2">if so, to which class (in figure)</td>
						<td class="td head_name" colspan="2">:<span style='padding:4px;border-bottom:1px solid black;font-weight:bold'> <?php echo ($tc_details[0]->combo011 == 'NO') ? " " : $tc_details[0]->datacombo011; ?> (<?php echo ($tc_details[0]->combo011 == 'NO') ? " " : $tc_details[0]->datacombo011_word; ?>)</span></td>
					</tr>
					<!--<tr class="tr">
					<td class="td head">(In Words)</td>
					<td class="td head_name" colspan="3">: <?php //echo $tc_details[0]->txtClsW; 
															?></td>
					</tr>-->
					<tr class="tr">
						<td class="td">12.</td>
						<td class="td head" colspan="4"> Month upto which the pupil has paid school due fee :<span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->combo12a; ?></span></td>

					</tr>
					<tr class="tr">
						<td class="td">13.</td>
						<td class="td head" colspan='2'> Any fee concession availed : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->combo016; ?></span></td>

						<td class="td head" colspan='2'>if so the nature of such concession : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo ($tc_details[0]->combo016 == 'NO') ? "-" : $tc_details[0]->text017; ?></span></td>

					</tr>
					<tr class="tr">
						<td class="td">14.</td>
						<td class="td head" colspan='2'>Total No. of School Working days : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->text014; ?></span></td>

						<td class="td head" colspan='2'>15. Total No. of Days Present : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->text015; ?></span></td>

					</tr>
					<tr class="tr">
						<td class="td">16.</td>
						<td class="td head" colspan="4"> Whether NCC Cadet/Boy/Girl Guide (Give Details) : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->combo013; ?></span></td>

					</tr>
					<tr class="tr">
						<td class="td">17.</td>
						<td class="td head" colspan="4"> Games played/extra curricular activities(Please Mention If Any) : <span style='padding:4px;border-bottom:1px solid black;font-weight:bold'><?php echo $tc_details[0]->combo012b; ?></span></td>

					</tr>

					<tr class="tr">
						<td class="td">18.</td>
						<td class="td head" style='width:250px'> General Conduct</td>
						<td class="td head_name" colspan="3">: <span style='width:250px;padding:4px;border-bottom:1px solid black;font-weight:bold;'><?php echo $tc_details[0]->combo018; ?></span></td>
					</tr>
					<tr class="tr">
						<td class="td">19.</td>
						<td class="td head"> Date of application for Certficate</td>
						<td class="td head_name" colspan="3" style='width:250px'>: <span style='width:250px;padding:4px;border-bottom:1px solid black;font-weight:bold;'><?php echo $text0191; ?></span></td>
					</tr>
					<tr class="tr">
						<td class="td">20.</td>
						<td class="td head"> Date of issue of Certficate</td>
						<td class="td head_name" colspan="3" style='width:250px'>: <span style='width:250px;padding:4px;border-bottom:1px solid black;font-weight:bold;'><?php echo $text0201; ?></span></td>
					</tr>
					<tr class="tr">
						<td class="td">21.</td>
						<td class="td head" style='width:250px'> Reasons for leaving the school</td>
						<td class="td head_name" colspan="3">: <span style='width:250px;padding:4px;border-bottom:1px solid black;font-weight:bold;'><?php echo $tc_details[0]->text021; ?></span></td>

					</tr>
					<tr class="tr">
						<td class="td">22.</td>
						<td class="td head" style='width:250px'> Any other Remarks</td>
						<td class="td head_name" colspan="3">: <span style='width:250px;padding:4px;border-bottom:1px solid black;font-weight:bold;'><?php echo $tc_details[0]->text022; ?></span></td>
					</tr>
					<tr>
						<td colspan="4"><br /></td>
					</tr>
					<tr>
						<td colspan="4"><br /></td>
					</tr>
					<tr>
						<td colspan="4"><br /></td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td>
							<center><b>Class Teacher</b></center>
						</td>
						<td>
							<center><b>Checked by </b></center>
						</td>
						<td>
							<center><b>Principal</b></center>
						</td>
					</tr>
				</table>
			</div>
		</div><br />
		<?php
		$str = explode("/", $tc_details[0]->adm_no);
		foreach ($str as $p) {
			$final_adm .= $p . "_";
		}
		$adm_str = rtrim($final_adm, "_");
		// echo $adm_str;die;
		?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<table style='margin-left:30%'>
					<tr>
						<td>

							<span>
								<button class="btn btn-primary" id="printing_button" onclick="printl()" style='display:none'><i class="fa fa-print"></i>&nbsp;PRINT</button>&nbsp;

								<a href="<?php echo base_url('Certificate/re_printpdf/' . $adm_str); ?>" target="_blank" class="btn btn-primary" id="generate_pdf" style='display:non'><i class="fa fa-file-pdf-o"></i>&nbsp;GENERATE & DOWNLOAD PDF</a>&nbsp;

								<a href="<?php echo base_url('Certificate/re_pre_printpdf/' . $adm_str); ?>" target="_blank" class="btn btn-primary" id="generate_pdf" style='display:non'><i class="fa fa-file-pdf-o"></i>&nbsp;GENERATE IN PRE-PRINTED</a>&nbsp;

							</span>

						</td>
						<td>

							<span>
								<form id='formm'>
									<input type="hidden" value="<?php echo $tc_details[0]->adm_no; ?>" id="adm_no" name="adm_no">
									<button class="btn btn-primary" id="cancelled_tc">&nbsp;CANCEL TC</button>
								</form>
							</span>
						</td>
						<td>
							<span>
								<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Certificate/cancel_reprint_tc'); ?>">BACK</a>
							</span>
						</td>
					</tr>
				</table>
			</div>
		</div><br />
		<div class="row">
			<div class="col-md-4 col-sm-4 col-lg-4">
			</div>
			<div class="col-md-4 col-sm-4 col-lg-4">
				<center></center>
			</div>
			<div class="col-md-4 col-sm-4 col-lg-4">
			</div>
		</div>

	</div>

	</div>
	<script type="text/javascript">
		function printl() {
			var adm = $('#adm_no').val();
			$.ajax({
				url: "<?php echo base_url('Certificate/printl'); ?>",
				type: "POST",
				data: {
					adm: adm
				},
				success: function(data) {
					if (data == 1) {
						var printButton = document.getElementById("printing_button");
						var print_cancel = document.getElementById('print_cancel');
						var generate_pdf = document.getElementById('generate_pdf');
						var cancelled_tc = document.getElementById('cancelled_tc');
						print_cancel.style.visibility = 'hidden';
						printButton.style.visibility = 'hidden';
						generate_pdf.style.visibility = 'hidden';
						cancelled_tc.style.visibility = 'hidden';
						window.print();
						printButton.style.visibility = 'visible';
						print_cancel.style.visibility = 'visible';
						generate_pdf.style.visibility = 'visible';
						cancelled_tc.style.visibility = 'visible';
					} else {
						alert('Sorry You Can Not Print This Tc');
					}
				},
			});

		}
		$(document).ready(function() {
			function disableBack() {
				window.history.forward()
			}
			window.onload = disableBack();
			window.onpageshow = function(evt) {
				if (evt.persisted) disableBack()
			}

			function preventBack() {
				window.history.forward();
			}
			setTimeout("preventBack()", 0);
			window.onunload = function() {
				null
			};
		});

		$("#formm").on("submit", function(event) {
			var b = confirm("Are you sure want to cancel TC ?");
			if (b == true) {
				event.preventDefault();
				$.ajax({
					url: "<?php echo base_url('Certificate/cancel_financial_year'); ?>",
					type: "POST",
					data: $("#formm").serialize(),
					success: function(data) {
						window.location = "";
					}
				});
			}
		});
	</script>
</body>

</html>