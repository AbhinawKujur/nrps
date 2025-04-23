<html>
  <head>
    <title>Topper List</title>
	 <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		white-space: nowrap !important;
		font-size:12px;
		padding:5px;
	 }
	 @page { margin: 40px 12px 0px 12px; }
	 #footer { position: fixed; right: 8px; bottom: 20px; text-align: right;}
     #footer .page:after { content: counter(page, decimal); }
	</style>
  </head>
  
  <body>
    <?php
	  $school_nm      = $school_setting[0]['School_Name'];
	  $school_Address = $school_setting[0]['School_Address'];
	  $school_Code    = $school_setting[0]['School_Code'];
	  $school_AfftNo  = $school_setting[0]['School_AfftNo'];
	  $school_session = $school_setting[0]['School_Session'];
	  $sec            = $topper_rank[0]['sec'];
	  $photo_left     = $school_photo[0]['School_Logo'];
	  $photo_right    = $school_photo[0]['School_Logo_RT'];
	?>
	<div id="footer">
      <p class="page" style="float: right;">Page </p>
    </div> 
    <div class='container'>
	  <div class='row'>
	    <div class='col-sm-12'>
		  <table class='table'>
		    <tr>
			  <td><img src='<?php echo $photo_left; ?>' style='width:70px; position:absolute; left:80px;'></td>
			  <th>
			  <center><h3>
			  <?php echo $school_nm; ?><br /><?php echo $school_Address; ?><br /><?php echo $school_session; ?>
			  </center></h3>
			  </th>
			  <td><img src='<?php echo $photo_right; ?>' style='width:70px;'></td>
		    </tr>
			<tr>
			  <td colspan='2'>Affiliation No.:<?php echo $school_AfftNo; ?></td>
			  <td style='text-align:right'>School Code.:<?php echo $school_Code; ?></td>
			</tr>
			<tr>
			  <td>Class: <?php echo $class_nm; ?></td>
			  <td><center><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Topper List</b></center></td>
			  <td style='text-align:right'></td>
			</tr>
		  </table>
		  <table class='table' border='1'>
		    <tr>
			  <th><center>Adm No.</center></th>
			  <th><center>Class</center></th>
			  <th><center>Section</center></th>
			  <th><center>Student Name</center></th>
			  <th><center>Total Percentage</center></th>
			  <th><center>Rank</center></th>
		    </tr>
		    <?php
			  foreach($topper_rank as $key =>$val){
				  ?>
				  <tr>
				    <td><center><?php echo $val['admno']; ?></center></td>
				    <td><center><?php echo $val['classes']; ?></center></td>
				    <td><center><?php echo $val['sec']; ?></center></td>
				    <td><center><?php echo $val['first_nm']; ?></center></td>
				    <td><center><?php echo $val['percent']; ?></center></td>
				    <td><center><?php echo $val['rank']; ?></center></td>
				  </tr>	
				  <?php
			  }
			?>
		  </table>
		</div>
	  </div>
    </div>
  </body>
</html>