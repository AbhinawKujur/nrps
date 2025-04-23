<html>
  <head>
    <title>Subject Ananlysis</title>
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
		padding:7px;
	 }
	
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
	  $class          = $topper_list[0]['classes'];
	  $sec            = $topper_list[0]['sec'];
	  $term           = $topper_list[0]['term'];
	  $photo_left     = $school_photo[0]['School_Logo'];
	  $photo_right    = $school_photo[0]['School_Logo_RT'];
	 
	  // echo "<pre>";
	  // print_r($highest_obt);exit;
	 
	  $subj_nm = array();
	  $highest_obt_mrk = array();
	  $no_of_percent = array();
	  $no_of_avg = array();
	  $no_of_fail = array();
	  for($i=1; $i<=15; $i++){
		  $subj_nm[$i]    = $subj_head[0]['subj'.$i.'_nm'];
		  $highest_obt_mrk[$i] = $highest_obt[0]['subj'.$i.'_mo'];
		  $no_of_percent[$i] = $no_of_per[0]['subj'.$i.'_per'];
		  $no_of_avg[$i] = $subj_avg[0]['subj'.$i.'_avg'];
		  $no_of_fail[$i] = $fail[0]['subj'.$i.'_fl'];
	  }
	  
	?>
	<div id="footer">
      <p class="page" style="float: right;">Page </p>
    </div><br /><br /><br />
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
			  <td>Class-Sec: <?php echo $class.'-'.$sec; ?></td>
			  <td><center><h3>Subject Analysis</h3></center></td>
			  <td style='text-align:right'>Term: <?php echo $term; ?></td>
			</tr>
		  </table>
		  
		  <table class='table' border='1'>
		    <tr>
			  <th style='width:200px;'>Subject</th>
			  <?php
			    foreach($subj_nm as $key1 => $val1){
					if($val1 != ''){
						?>
						  <th><?php echo $val1; ?></th>
						<?php
					}else{
						?>
						  <th><?php echo "-"; ?></th>
						<?php
					}
					
				}
			  ?>
		    </tr>
			
			<tr>
			  <th>Highest Marks Obt</th>
			  <?php
			   foreach($highest_obt_mrk as $key => $val){
				  ?>
				    <th><center><?php echo $val; ?></center></th>
				  <?php	
				}
			  ?>
			</tr>
			
			<tr>
			  <th>Subject Average</th>
			  <?php
			   foreach($no_of_avg as $key => $val){
				  ?>
				    <th><center><?php echo $val; ?></center></th>
				  <?php	
				}
			  ?>
			</tr>
			
			<tr>
			  <th>No. of Students scoring more than 90%</th>
			  <?php
			   foreach($no_of_percent as $key => $val){
				  ?>
				    <th><center><?php echo $val; ?></center></th>
				  <?php	
				}
			  ?>
			</tr>
			
			<tr>
			  <th>No. of Students Failed</th>
			  <?php
			   foreach($no_of_fail as $key => $val){
				  ?>
				    <th><center><?php echo $val; ?></center></th>
				  <?php	
				}
			  ?>
			</tr>
		  </table>
		  
		  <table class='table' border='1'>
		    <tr>
			  <th><center>Marks Range</center></th>
			  <th><center>91-100</center></th>
			  <th><center>81-90</center></th>
			  <th><center>71-80</center></th>
			  <th><center>61-70</center></th>
			  <th><center>51-60</center></th>
			  <th><center>41-50</center></th>
			  <th><center>33-40</center></th>
			  <th><center>32 & Below</center></th>
		    </tr>
			
			<tr>
			  <th><center>Grade</th>
			  <th><center>A1</center></th>
			  <th><center>A2</center></th>
			  <th><center>B1</center></th>
			  <th><center>B2</center></th>
			  <th><center>C1</center></th>
			  <th><center>C2</center></th>
			  <th><center>D</center></th>
			  <th><center>E</center></th>
			</tr>
		  <table>
		</div>
	  </div>
    </div>
  </body>
</html>