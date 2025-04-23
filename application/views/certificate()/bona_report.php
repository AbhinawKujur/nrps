<?php
	error_reporting(0);
	if($details_fetch){
		$Adm_Date = $details_fetch[0]->Adm_Date;
		$End_DATE = $details_fetch[0]->End_DATE;
		$adm_date1 = date('d-M-Y',strtotime($Adm_Date));
		$End_DATE1 = date('d-M-Y',strtotime($End_DATE));
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
		
		@page {
    		size: auto;   / auto is the initial value /
    		margin-top: -10px;    / this affects the margin in the printer settings /
    		margin-bottom: 0;
    		margin-right: 20px;
    		margin-left: 20px;
		}
		.f-s{
			font-size: 26px;
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
				<center><h5><b><?php echo $school_setting[0]->School_Name; ?></b></h5></center>
				<center><h6><?php echo $school_setting[0]->School_Address; ?></h6></center>
				<center><h6>Affillated to <?php echo $school_setting[0]->board; ?>, New Delhi (Aff No. :<?php echo $school_setting[0]->School_AfftNo; ?>, School Code: <?php echo $school_setting[0]->School_Code; ?>)</h6></center>
				<center><h6>Session (<?php echo $school_setting[0]->School_Session; ?>)</h6></center>
			</div>
			<div class="col-md-2 col-sm-2 col-lg-2">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-lg-3">
			</div>
			<div class="col-md-6 col-sm-6 col-lg-6">
				<div id="content"><center><b>BONAFIDE CERTIFICATE</b></center></div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3">
			</div>
		</div><br /><br />
		<center><h3><u>TO WHOMSOEVER IT MAY CONCERN</u></h3></center>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<b><i>Certificate No</i>.:- <?php echo $details_fetch[0]->CERT_NO; ?></b>
			</div>
		</div><br /><br /><br />
		<table class="table">
			<tr>
				<td class="f-s"><center><b><i>This is to certify that Master/Miss :</i> &nbsp;&nbsp;&nbsp;&nbsp; <u><?php echo $details_fetch[0]->S_NAME; ?></u></b></center></td>
			</tr>
			<tr>
				<td class="f-s"><center><b><i>S/O/D/O :</i> &nbsp;&nbsp;&nbsp;&nbsp; <u><?php echo $details_fetch[0]->F_NAME; ?></u></b>&nbsp;&nbsp;<b> & </b>&nbsp;&nbsp; <u><b><?php echo $details_fetch[0]->M_Name; ?></b></u></center></td>
			</tr>
			<tr>
				<td class="f-s"><center><b><i>Admission No.:</i> &nbsp;&nbsp;&nbsp;&nbsp; <u><?php echo $details_fetch[0]->ADM_NO; ?></u></b>&nbsp;&nbsp;<b>, Class </b>&nbsp;&nbsp; <u><b><?php echo $details_fetch[0]->class_name; ?></b></u>&nbsp;&nbsp;<b><i>is a</i></b></center></td>
			</tr>
			<tr>
				<td class="f-s"><center><b><i>bonafide student of this school from :</i> &nbsp; <u><?php echo $adm_date1; ?></u></b>&nbsp;<b> To </b>&nbsp; <u><b><?php echo $End_DATE1; ?></b></u></center></td>
			</tr>
			<tr>
				<td class="f-s"><center><b><i>I wish him/her every success in life. </i> </b></center></td>
			</tr>
		</table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<div class="row">
			<table width="100%">
				<tr>
					<td><center><b>Issue Date</b></center></td>
					<td><center><b>Dealing Clerk <br /> Signature</b></center></td>
					<td><center><b>Principal <br /> Signature</b></center></td>
				</tr>
			</table>
		</div>
	 </div><br />
	 <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<center><button class="btn btn-primary" id="printing_button" onclick="printl()"><i class="fa fa-print"></i>&nbsp;PRINT</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('Bonafide_certificate/show_bonafide'); ?>">BACK</a></center>
		</div>
	 </div><br /><br />
	</div>
	<script type="text/javascript">
		function printl()
		{
			var printButton = document.getElementById("printing_button");
			var print_cancel = document.getElementById('print_cancel');
			print_cancel.style.visibility = 'hidden';
			printButton.style.visibility = 'hidden';
  			window.print();
  			printButton.style.visibility = 'visible';
  			print_cancel.style.visibility = 'visible';
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