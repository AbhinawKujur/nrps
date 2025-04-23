<?php
	error_reporting(0);
	if($tc_details){
		$adm_date = $tc_details[0]->ADM_DATE;
		$dob = $tc_details[0]->BIRTH_DT;
		$text019 = $tc_details[0]->text019;
		$text020 = $tc_details[0]->text020;
		$adm_d = date("d-M-Y",strtotime($adm_date));
		$dob_t = date("d-M-Y",strtotime($dob));
		$text0191 = date("d-M-Y",strtotime($text019));
		$text0201 = date("d-M-Y",strtotime($text020));
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
	<style  media="print">
		body {
			marging: 0px !important;
			paddging : 0px !important;
		}
		#border{
			width:100%;
			height: 100%;
			padding : 5px 20px 0px 20px;
			border : solid 3px black;
		}
		#image{
			height : 100px;
			width : 100px;
			float : right;
		}
		#heading{
			float : right;
		}
		#content{
			border: solid 1px black;
			border-radius: 10px;
		}
		.text-content{
			text-align:right;
		}
		.table td, .table th {
			padding: .75rem;
			vertical-align: top;
			border-top: 0px solid #dee2e6;
		}
		.tbl,.tr,.td{
			font-weight:1em;
		}
		.table td, .table th {
			padding: 8px 0px 0px 0px;
			vertical-align: top;
			border-top: 0px solid #dee2e6;
		}
		@page {
    		size: auto;   / auto is the initial value /
    		margin-top: -10px;    / this affects the margin in the printer settings /
    		margin-bottom: 0;
    		margin-right: 20px;
    		margin-left: 20px;
		}
		.head{
			font-weight: bold;
		}
		.head_name{
			font-style: italic;
			font-weight:bold;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
	 <div id="border">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3">
				<img src="<?php echo base_url($school_setting[0]->SCHOOL_LOGO); ?>" id="image">
			</div>
			<div class="col-md-7 col-lg-7 col-sm-7">
				<center><h5><?php echo $school_setting[0]->School_Name; ?></h5></center>
				<center><h6><?php echo $school_setting[0]->School_Address; ?></h6></center>
				<center><h6>Session (<?php echo $school_setting[0]->School_Session; ?>)</h6></center>
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3">
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6">
				<div id="content"><center><b>SCHOOL LEAVING CERTIFICATE</b></center></div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3">
			</div>
		</div><br />
		<div class="row">
			<table cellspacing="0" cellpadding="0" class="table table-striped" style="border:none;">
				<tr>
					<td class="text-content head">TC No.</td>
					<td class="head_name">: <?php echo $tc_details[0]->TCNO; ?></td>
					<td class="text-content head">Affln No.</td>
					<td class="head_name">: <?php echo $school_setting[0]->School_AfftNo; ?></td>
					<td class="text-content head">School Code.</td>
					<td class="head_name">: <?php  echo $school_setting[0]->School_Code; ?></td>
				</tr>
				<tr>
					<td class="text-content head">Admission No.</td>
					<td class="head_name">: <?php echo $tc_details[0]->adm_no; ?></td>
					<td class="text-content head">Registraion No.</td>
					<td class="head_name">: <?php echo $tc_details[0]->RegistrationNo; ?></td>
					<td class="text-content head">Board Roll No.</td>
					<td class="head_name">: <?php echo $tc_details[0]->BoardRollNo; ?></td>
				</tr>
			</table><br />
			<table class="table tbl">
				<tr class="tr">
					<td class="td head">01. Name of the Pupil</td>
					<td class="td head_name">: <?php echo $tc_details[0]->Name; ?></td>
					<td class="td"></td>
					<td class="td"></td>
					<td class="td"></td>
				</tr>
				<tr class="tr">
					<td class="td head">02. Mother's Name</td>
					<td class="td head_name">: <?php echo $tc_details[0]->Mother_NM; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">03. Father's Name</td>
					<td class="td head_name">: <?php echo $tc_details[0]->Father_NM; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">04. Natonality</td>
					<td class="td head_name">: <?php echo $tc_details[0]->Nation; ?></td>
					<td class="td head">05. Whether S.C or S.T.</td>
					<td class="td head_name">: <?php echo $tc_details[0]->Category; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">06. Admission Date in School</td>
					<td class="td head_name">: <?php echo $adm_d; ?></td>
					<td class="td head">In Class</td>
					<td class="td head_name">: <?php echo $tc_details[0]->ADM_CLASS; ?></td>
				</tr>
				<tr class="tr">
					<td colspan="2" class="td head">07. Date of Birth (in Christan Era) as recorded in the Admission Register</td>
					<td class="td head_name">: <?php echo $dob_t; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">(In Words)</td>
					<td class="td head_name" colspan="3">: <?php echo $tc_details[0]->dob_inwords; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">08. Class in which the pupil studied last</td>
					<td class="td head_name">: <?php echo $tc_details[0]->current_Class; ?></td>
					<td class="td head">09. Whether failed, in same class </td>
					<td class="td head_name">: <?php echo $tc_details[0]->combo09; ?></td>
				</tr>
				<tr class="tr">
					<td colspan="2" class="td head">10. School/Board Annual Examinaton Last Taken with Result</td>
					<td class="td head_name" colspan="2">: <?php echo $tc_details[0]->TEXT08a; ?> <?php echo $tc_details[0]->text08b; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head" colspan="4">12. Subject Studied</td>
				</tr>
				<tr class="tr">
					<td class="td head">(A) Compulsory</td>
					<td class="td" colspan="3">
						<table cellspacing="0" cellpadding="0" width="100%">
							<tr>
								<td class="head_name">(1) <?php echo $tc_details[0]->textsub1; ?></td>
								<td class="head_name">(2) <?php echo $tc_details[0]->textsub2; ?></td>
							</tr>
							<tr>
								<td class="head_name">(3) <?php echo $tc_details[0]->textsub3; ?></td>
								<td class="head_name">(4) <?php echo $tc_details[0]->textsub4; ?></td>
							</tr>
							<tr>
								<td class="head_name">(5) <?php echo $tc_details[0]->textsub5; ?></td>
								<td class="head_name">(6) <?php echo $tc_details[0]->textsub6; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="tr">
					<td class="td head">(B) Optional</td>
					<td class="td" colspan="3">
						<table cellspacing="0" cellpadding="0" width="100%">
							<tr>
								<td class="head_name">(1) <?php echo $tc_details[0]->textsub7; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="tr">
					<td class="td head">13. Whether qualified for promoton to higher Class</td>
					<td class="td head_name">: <?php echo $tc_details[0]->combo011; ?></td>
					<td class="td head">if so, to which class (in figure)</td>
					<td class="td head_name">: <?php echo $tc_details[0]->datacombo011; ?></td>
				</tr>
				<!--<tr class="tr">
					<td class="td head">(In Words)</td>
					<td class="td head_name" colspan="3">: <?php //echo $tc_details[0]->txtClsW; ?></td>
				</tr>-->
				<tr class="tr">
					<td class="td head" colspan="2">14. Month upto which the pupil has paid school due fee</td>
					<td class="td head_name" colspan="2">: <?php echo $tc_details[0]->combo12a; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">15. Any fee concession availed</td>
					<td class="td head_name">: <?php echo $tc_details[0]->combo016; ?></td>
					<td class="td head">if so the nature of such concession</td>
					<td class="td head_name">: <?php echo ($tc_details[0]->combo016 == 'NO')?"-":$tc_details[0]->text017; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">16. Total No. of School Working days</td>
					<td class="td head_name">: <?php echo $tc_details[0]->text014; ?></td>
					<td class="td head">17. Total No. of Days Present</td>
					<td class="td head_name">: <?php echo $tc_details[0]->text015; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head" colspan="2">18. Whether NCC Cadet/Boy/Girl Guide (Give Details)</td>
					<td class="td head_name" colspan="2">: <?php echo $tc_details[0]->combo013; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head" colspan="2">19. Games played/extra curricular actvites(Please Mention If Any)</td>
					<td class="td head_name" colspan="2">: <?php echo $tc_details[0]->combo012b; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">20. General Conduct</td>
					<td class="td head_name" colspan="3">: <?php echo $tc_details[0]->combo018; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">21. Date of applicaton for certficate</td>
					<td class="td head_name">: <?php echo $text0191; ?></td>
					<td class="td head">22. Date of issue of Certficate</td>
					<td class="td head_name">: <?php echo $text0201; ?></td>
				</tr>
				<tr class="tr">
					<td class="td head">23. Reasons for leaving the school</td>
					<td class="td head_name">: <?php echo $tc_details[0]->text021; ?></td>
					<td class="td head">24. Any other Remarks</td>
					<td class="td head_name">: <?php echo $tc_details[0]->text022; ?></td>
				</tr>
				<tr>
					<td colspan="4"><br /></td>
				</tr>
			</table>
			<table width="100%">
				<tr>
					<td><center><b>Class Teacher</b></center></td>
					<td><center><b>Checked by <br /> ( Name & Designation)</b></center></td>
					<td><center><b>Principal</b></center></td>
				</tr>
			</table>
		</div>
	 </div><br />
	 <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<center><button class="btn btn-primary" id="printing_button" onclick="printl()"><i class="fa fa-print"></i>&nbsp;PRINT</button>&nbsp;<a href="<?php echo base_url('Certificate/pdf_creation/'.$tc_details[0]->adm_no); ?>" target="_blank" class="btn btn-success" id="generate_pdf"><i class="fa fa-print"></i>&nbsp;GENERATE & DOWNLOAD PDF</a>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Certificate/transfer_certificate'); ?>">BACK</a></center>
		</div>
	 </div><br /><br />
	</div>
	<script type="text/javascript">
		function printl()
		{
			var printButton = document.getElementById("printing_button");
			var print_cancel = document.getElementById('print_cancel');
			var generate_pdf = document.getElementById('generate_pdf');
			print_cancel.style.visibility = 'hidden';
			printButton.style.visibility = 'hidden';
			generate_pdf.style.visibility = 'hidden';
  			window.print();
  			printButton.style.visibility = 'visible';
  			print_cancel.style.visibility = 'visible';
  			generate_pdf.style.visibility = 'visible';
		}
         $(document).ready(function() {
        function disableBack() { window.history.forward() }
        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    });
	</script>
</body>
</html>