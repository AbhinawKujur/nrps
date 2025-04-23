<html>
  <title>Visitor</title>
  <head>
	</head>
	<body>
	  <div style='border:2px solid #000; padding:10px;'>				
		  <table cellspacing='0' border='1' style='width:100%;padding:10px;'>
			<tr>
				<td><center><img class="pull-right" src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" style="width:100px;"></center></td>
				<td><center><span style='font-size:25px; color:#b30000'><b><?php echo $school_setting[0]->School_Name; ?></b></span><br /><br /><?php echo $school_setting[0]->School_Address; ?><br /><b>ACADEMIC SESSION:</b><?php echo $school_setting[0]->School_Session; ?></center></td>
				<td><center><img class="pull-right" src="<?php echo $emp_data[0]->VIS_ID; ?>" style="width:100px;"></center></td>
			</tr>
		  </table>
		  <table cellspacing='0' style='width:100%'>
			   <tr>
				   <th style='background:#eee;'>Department Name</th>
				   <th style='background:#eee;'>:</th>
				   <td style='background:#eee;'><?php echo $emp_data[0]->dptnm;?></td>
				   <th style='background:#eee;'>Visitor Purpose</th>
				   <th style='background:#eee;'>:</th>
				   <td style='background:#eee;'><?php echo $emp_data[0]->vis_pur;?></td>
			   </tr>
			   <tr>
				   <th style='background:#eee;'>Visitor Type</th>
				   <th style='background:#eee;'>:</th>
				   <td style='background:#eee;'><?php echo $emp_data[0]->vis_type;?></td>
				    <th style='background:#eee;'>Visit Date</th>
				   <th style='background:#eee;'>:</th>
				   <td style='background:#eee;'><?php echo date('d-M-y');?></td>
			   </tr>
			   <tr>
				   <th style='background:#eee;'>Name</th>
				   <th style='background:#eee;'>:</th>
				   <td style='background:#eee;'><?php echo $emp_data[0]->name;?></td>
				   <th style='background:#eee;'>Mobile No.</th>
				   <th style='background:#eee;'>:</th>
				   <td style='background:#eee;'><?php echo $emp_data[0]->mobile;?></td>
			   </tr>
			   <tr>
				   <th style='background:#eee;'>In time</th>
				   <th style='background:#eee;'>:</th>
				   <td style='background:#eee;'><?php echo $emp_data[0]->in_time;?></td>
				   <th style='background:#eee;'>Out time</th>
				   <th style='background:#eee;'>:</th>
				   <td style='background:#eee;'>___________</td>
			   </tr>
			   <tr>
			    <th style='background:#eee;'>Remarks </th>
				<th style='background:#eee;'>:</th>
				<td style='background:#eee;'><?php echo $emp_data[0]->remarks;?></td>
				<td style='background:#eee;'></td>
				<td style='background:#eee;'></td>
				<td style='background:#eee;'></td>
			   </tr>
		   </table>
		   <table cellspacing='0' style='width:100%'>
				<tr style='background-color:white;text-align:center'>
				<th><center>Visitor Sign.</center></th> <th><center>Department Sign.</center></th><th><center>Reception Sign.</center></th></tr>
				<tr style='background-color:white'><td><center>_______________</center></td><td><center>_______________</center></td><td><center>_______________</center></td></tr>
		   </table>
	  </div>
   </body>
</html>