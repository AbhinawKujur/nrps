<html>
  <head>
    <title>Percentage Report</title>
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
		padding:3px;
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
	  for($i=1; $i<=15; $i++){
		  $subj_nm[$i] = $subj_head[0]['subj'.$i.'_nm'];
	  }
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
			  <td colspan='2' style='text-align:left'>Affiliation No.:<?php echo $school_AfftNo; ?></td>
			  <td style='text-align:right'>School Code.:<?php echo $school_Code; ?></td>
			</tr>
			<tr>
			  <td style='text-align:left'>Class-Sec: <?php echo $class.'-'.$sec; ?></td>
			  <td><center><h3>Student Wise percentage Report</h3></center></td>
			  <td style='text-align:right'>Term: <?php echo $term; ?></td>
			</tr>
		  </table>
		  
		  <table class='table main' border='1'>
		    <tr>
			  <th>Roll No.</th>
			  <th>Adm No.</th>
			  <th>Stu Name</th>
			  <?php
			   foreach($subj_nm as $key => $val){
				   if($val == ''){
					   ?>
					    <th>-</th>
					   <?php
				   }else{
					   ?>
					   <th><?php echo $val; ?></th>
					   <?php
				   }
			   }
			  ?>
			  <th>Total Max obt</th>
			  <th>Total Percent</th>
			  <th>Grade</th>
			  <th>Attendence</th>
		    </tr>
			
			<?php
			  foreach($all_stu_per_report as $key => $val){
			?>
				    <tr>
					  <td><?php echo $val['roll_no']; ?></td>
					  <td><?php echo $val['adm_no']; ?></td>
					  <td><?php echo $val['first_nm']; ?></td>
					  
					  <?php if($val['subj1_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj1_mo']; ?></td>  
					  <?php }else if($val['subj1_mo'] >= 33 && $val['subj1_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj1_mo']; ?></td>
					  <?php }else if($val['subj1_mo'] >= 41 && $val['subj1_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj1_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj1_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj2_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj2_mo']; ?></td>  
					  <?php }else if($val['subj2_mo'] >= 33 && $val['subj2_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj2_mo']; ?></td>
					  <?php }else if($val['subj2_mo'] >= 41 && $val['subj2_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj2_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj2_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj3_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj3_mo']; ?></td>  
					  <?php }else if($val['subj3_mo'] >= 33 && $val['subj3_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj3_mo']; ?></td>
					  <?php }else if($val['subj3_mo'] >= 41 && $val['subj3_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj3_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj3_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj4_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj4_mo']; ?></td>  
					  <?php }else if($val['subj4_mo'] >= 33 && $val['subj4_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj4_mo']; ?></td>
					  <?php }else if($val['subj4_mo'] >= 41 && $val['subj4_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj4_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj4_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj5_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj5_mo']; ?></td>  
					  <?php }else if($val['subj5_mo'] >= 33 && $val['subj5_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj5_mo']; ?></td>
					  <?php }else if($val['subj5_mo'] >= 41 && $val['subj5_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj5_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj5_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj6_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj6_mo']; ?></td>  
					  <?php }else if($val['subj6_mo'] >= 33 && $val['subj6_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj6_mo']; ?></td>
					  <?php }else if($val['subj6_mo'] >= 41 && $val['subj6_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj6_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj6_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj7_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj7_mo']; ?></td>  
					  <?php }else if($val['subj7_mo'] >= 33 && $val['subj7_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj7_mo']; ?></td>
					  <?php }else if($val['subj7_mo'] >= 41 && $val['subj7_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj7_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj7_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj8_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj8_mo']; ?></td>  
					  <?php }else if($val['subj8_mo'] >= 33 && $val['subj8_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj8_mo']; ?></td>
					  <?php }else if($val['subj8_mo'] >= 41 && $val['subj8_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj8_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj8_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj9_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj9_mo']; ?></td>  
					  <?php }else if($val['subj9_mo'] >= 33 && $val['subj9_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj9_mo']; ?></td>
					  <?php }else if($val['subj9_mo'] >= 41 && $val['subj9_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj9_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj9_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj10_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj10_mo']; ?></td>  
					  <?php }else if($val['subj10_mo'] >= 33 && $val['subj10_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj10_mo']; ?></td>
					  <?php }else if($val['subj10_mo'] >= 41 && $val['subj10_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj10_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj10_mo']; ?></td>
					  <?php } ?>
					  
					  <?php if($val['subj11_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj11_mo']; ?></td>  
					  <?php }else if($val['subj11_mo'] >= 33 && $val['subj11_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj11_mo']; ?></td>
					  <?php }else if($val['subj11_mo'] >= 41 && $val['subj11_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj11_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj11_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj12_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj12_mo']; ?></td>  
					  <?php }else if($val['subj12_mo'] >= 33 && $val['subj12_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj12_mo']; ?></td>
					  <?php }else if($val['subj12_mo'] >= 41 && $val['subj12_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj12_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj12_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj13_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj13_mo']; ?></td>  
					  <?php }else if($val['subj13_mo'] >= 33 && $val['subj13_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj13_mo']; ?></td>
					  <?php }else if($val['subj13_mo'] >= 41 && $val['subj13_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj13_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj13_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj14_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj14_mo']; ?></td>  
					  <?php }else if($val['subj14_mo'] >= 33 && $val['subj14_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj14_mo']; ?></td>
					  <?php }else if($val['subj14_mo'] >= 41 && $val['subj14_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj14_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj14_mo']; ?></td>
					  <?php } ?>
					  
					  
					  <?php if($val['subj15_mo'] <= 33){ ?>
					  <td style='background:#e46969; color:#fff'><?php echo $val['subj15_mo']; ?></td>  
					  <?php }else if($val['subj15_mo'] >= 33 && $val['subj15_mo'] <= 40){ ?>
					  <td style='background:#dcdc82;'><?php echo $val['subj15_mo']; ?></td>
					  <?php }else if($val['subj15_mo'] >= 41 && $val['subj15_mo'] <= 70){ ?>
					  <td style='background:#6868a5; color:#fff'><?php echo $val['subj15_mo']; ?></td>
					  <?php }else{ ?>
					  <td style='background:#72a772; color:#fff'><?php echo $val['subj15_mo']; ?></td>
					  <?php } ?>
					  
					
					  <td><?php echo $val['tot_wet_mrk']; ?></td>
					  <td><?php echo $val['tot_per']; ?></td>
					  <td><?php echo $val['tot_grd']; ?></td>
					  <td><?php echo $val['attendance']; ?></td>
				    </tr>
				  <?php
			  }
			?>
		  </table><br /><br />
		  
		  <table class='table' style='width:50%' border='1'>
		    <tr>
			  <th>Percentage Range</th>
			  <th>Color Code</th>
		    </tr>
			<tr>
			  <td>Below - 33</td>
			  <td style='background:#e46969; color:#fff'>RED</td>
			</tr>
			<tr>
			  <td>33 - 40</td>
			  <td style='background:#dcdc82;'>YELLOW</td>
			</tr>
			<tr>
			  <td>41 - 70</td>
			  <td style='background:#6868a5; color:#fff'>BLUE</td>
			</tr>
			<tr>
			  <td>71 - 100</td>
			  <td style='background:#72a772; color:#fff'>GREEN</td>
			</tr>
		  </table>
		</div>
	  </div>
    </div>
  </body>
</html>