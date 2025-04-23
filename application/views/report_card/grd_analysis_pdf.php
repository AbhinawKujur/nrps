<html>
  <head>
    <title>Grade Ananlysis</title>
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
		font-size:11px;
		padding:5px;
		text-align:center;
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
	 
	  $subj_nm = array();
	  $grd_a1 = array();
	  $grd_a2 = array();
	  $grd_b1 = array();
	  $grd_b2 = array();
	  $grd_c1 = array();
	  $grd_c2 = array();
	  $grd_d = array();
	  $grd_e = array();
	  $absnt = array();
	  $dashh = array();
	  $appeared_stu = array();
	  for($i=1; $i<=15; $i++){
		  $subj_nm[$i]    = $subj_head[0]['subj'.$i.'_nm'];
		  $grd_a1[$i]    = $a1[0]['subj'.$i.'_gr'];
		  $grd_a2[$i]    = $a2[0]['subj'.$i.'_gr'];
		  $grd_b1[$i]    = $b1[0]['subj'.$i.'_gr'];
		  $grd_b2[$i]    = $b2[0]['subj'.$i.'_gr'];
		  $grd_c1[$i]    = $c1[0]['subj'.$i.'_gr'];
		  $grd_c2[$i]    = $c2[0]['subj'.$i.'_gr'];
		  $grd_d[$i]    = $d[0]['subj'.$i.'_gr'];
		  $grd_e[$i]    = $e[0]['subj'.$i.'_gr'];
		  $absnt[$i]    = $ab[0]['subj'.$i.'_gr'];
		  $dashh[$i]    = $dash[0]['subj'.$i.'_gr'];
		  $appeared_stu[$i] = ($subj_nm[$i] != '')?$appeared[0]['subj'.$i.'_p']:'0';
	  }
	?>
	<div id="footer">
      <p class="page" style="float: right;">Page </p>
    </div><br />
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
			  <td colspan='2' style='text-align:left'>Affiliation No.:<?php echo $school_AfftNo; ?></td>
			  <td style='text-align:right'>School Code.:<?php echo $school_Code; ?></td>
			</tr>
			<tr>
			  <td style='text-align:left'>Class-Sec: <?php echo $class.'-'.$sec; ?></td>
			  <td><center><h3>Grade Analysis</h3></center></td>
			  <td style='text-align:right'>Term: <?php echo $term; ?></td>
			</tr>
		  </table>
		  
		  <table class='table' border='1'>
		    <tr>
			  <th>Grade</th>
			  <?php
			    foreach($subj_nm as $key => $val){
					if($val != ''){
						?>
						  <th><?php echo $val; ?></th>
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
			  <th>A1</th>
			  <?php
			    foreach($grd_a1 as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>A2</th>
			  <?php
			    foreach($grd_a2 as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>B1</th>
			  <?php
			    foreach($grd_b1 as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>B2</th>
			  <?php
			    foreach($grd_b2 as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>C1</th>
			  <?php
			    foreach($grd_c1 as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>C2</th>
			  <?php
			    foreach($grd_c2 as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>D</th>
			  <?php
			    foreach($grd_d as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>E</th>
			  <?php
			    foreach($grd_e as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>AB</th>
			  <?php
			    foreach($absnt as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>-</th>
			  <?php
			    foreach($dashh as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
			
			<tr>
			  <th>Student appeared</th>
			  <?php
			    foreach($appeared_stu as $key => $val){
				?>
				 <td><?php echo $val; ?></td>
				<?php
				}
			  ?>
			</tr>
		  </table>
		  
		  <table class='table' border='1'>
		    <tr>
			  <th>Marks Range</th>
			  <th>91 - 100</th>
			  <th>81 - 90</th>
			  <th>71 - 80</th>
			  <th>61 - 70</th>
			  <th>51 - 60</th>
			  <th>41 - 50</th>
			  <th>33 - 40</th>
			  <th>32 Below</th>
		    </tr>
			<tr>
			  <th>Grade</th>
			  <th>A1</th>
			  <th>A2</th>
			  <th>B1</th>
			  <th>B2</th>
			  <th>C1</th>
			  <th>C2</th>
			  <th>D</th>
			  <th>E</th>
			</tr>
		  </table>
		</div>
	  </div>
    </div>
  </body>
</html>