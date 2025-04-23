<html>
  <title>Visitor</title>
  <head>
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/font-awesome.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Notable' rel='stylesheet' type='text/css'>
	
	<style> 
	  table tr th,td{
		font-size:12px!important;
		padding:3.5px!important;
	}
	@page { 
		margin: 10px 5px 5px 12px; 	
	}
	@media print{
		.table tr th .thead{
			font-color:#fff;
		}
	}
	.sign{
		font-family: 'Laila', serif;
	}
	body{
		padding-left:20px;
		padding-right:20px;
	}	
	.table,tr,td,th{
	  border-top:1px solid #ffff !important;
	}
		.table,tr{
		background-color:#f2f2f2;
			margin-top:5px;
		}
	.no_border tr td,.no_border tr th{
		border:none !important;
	}
	
	.sin_no_border{
		border:none !important;
	}
	.schl_nm{
		font-family: 'Notable', sans-serif;
		color:#b6061e !important;
	}
	
	</style>
  </head>
   <body>
	   
	   <div style="border:3px solid #000; padding:20px;">
		  <div class='row'>
			<div class="col-sm-2">
				<img class="pull-right" src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" style="width:100px;">
				<span style='position:absolute; top:110px; font-size:10px; right:20px;'><b>Visit Date</b> <?php echo $today_date; ?><br /><b>Visitor Id</b> <?php echo $emp_data[0]->id.'-VIS'; ?></span>
			</div>
			<div class='col-sm-7'>
			  <center>
				<?php
				  echo "<h3><span class='schl_nm'>".$school_setting[0]->School_Name ."</span></h3>";
				  echo "<span style='color:#b6061e !important;'>".$school_setting[0]->School_Address ."</span><br/>";
				  echo "<b>ACADEMIC SESSION:</b> ".$school_setting[0]->School_Session ."<br />";
				  echo "<h4>Visitor Slip </h4> <br />";
				?>
			  </center>
			</div>
			<div class="col-sm-3">
				<img src="<?php echo $emp_data[0]->VIS_ID; ?>" style="width:100px; margin-top:10px; margin-left:-20px;">
			</div>
			
		  </div>
		   
		   
		   <table class='table'>
			   <tr>
				   <th>
					   Department Name      
				   </th>
				   <th>
					     :   
				   </th>
				   <td>
					   
					   <?php echo $emp_data[0]->dptnm;?>
				   </td>
				   <th>
					   Visitor Purpose   
				   </th>
				   <th>
					     : 
				   </th>
				   <td>
					   <?php echo $emp_data[0]->vis_pur;?> 
				   </td>
			   </tr>
			   <tr>
				   <th>
					   Visitor Type      
				   </th>
				   <th>
					     :  
				   </th>
				   <td>
					   <?php echo $emp_data[0]->vis_type;?> 
				   </td>
				   <td>
					      
				   </td>
				   <td>
					     
				   </td>
				   <td>
					   
				   </td>
				   </tr>
				   <tr>
				   <th>
					   Name      
				   </th>
				   <th>
					     :  
				   </th>
				   <td>
					   <?php echo $emp_data[0]->name;?> 
				   </td>
				   <th>
					   Mobile No.   
				   </th>
				   <th>
					     :  
				   </th>
				   <td>
					   <?php echo $emp_data[0]->mobile;?> 
				   </td>
			   </tr>
			    <tr>
				   <th>
					   In time      
				   </th>
				   <th>
					     :  
				   </th>
				   <td>
					   <?php echo $emp_data[0]->in_time;?>
				   </td>
				   <th>
					   Out time   
				   </th>
				   <th>
					     :  
				   </th>
				   <td>
					    ___________
				   </td>
			   </tr>
			   <tr>
			    <th>
					   Remarks   
				   </th>
				   <th>
					     :  
				   </th>
				   <td>
					     <?php echo $emp_data[0]->remarks;?> 
				   </td>
			   </tr>
		   </table>
		   <table class='table'>
		<tr style='background-color:white;text-align:center'>
		   <th><center>Visitor Sign.</center></th> <th><center>Department Sign.</center></th><th><center>Reception Sign.</center></th></tr>
		   <tr style='background-color:white'><td><center>_______________</center></td><td><center>_______________</center></td><td><center>_______________</center></td></tr>
		   </table>
	            </div>
   </body>
</html>