<html>
  <head>
    <title>Subject Wise Ananlysis</title>
	 <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	 <link href="<?php echo base_url('assets/dash_css/jquery.barCharts.css'); ?>" rel="stylesheet" type="text/css">
	<style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		white-space: nowrap !important;
		font-size:11px;
		padding:2px;
	 }
	
	 #footer { position: fixed; right: 8px; bottom: 20px; text-align: right;}
     #footer .page:after { content: counter(page, decimal);}
	 
	 .graphite-container{
		  margin-top: 0px !important;
	  }
	  
	  code {
		  font-size: 13px;
		  color:#fff;
	  }

	  .container {
		  margin-bottom: 68px;
	  }

	  #example1 {
		  margin-left: 40px;
	  }

	  #example2 {
		  margin: auto;
		  width: 100%;
	  }

	  .display-3 {
		  padding-bottom: 6px;
		  
	  }
	  
	 .lead {
		  padding: 6px;
	  }
      .graphite-column{
		color:#fff !important;
        border:1px solid #000;	
		background: linear-gradient(141deg, #9fb8ad 0%, #1fc8db 51%, #2cb5e8 75%) !important;
	  }
	  
	  .graphite-column-label{
		  font-size:12px !important;
	  }
	  

	  @media print {
		.page-break { display: block; page-break-before: always; }
	  }
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
	  
	?>
    <div class='container'>
	  <div class='row'>
	    <div class='col-sm-12'>
		  <table class='table'>
		    <tr>
			  <td><img src='<?php echo base_url($photo_left); ?>' style='width:70px; position:absolute; left:80px;'></td>
			  <th>
			  <center><h3>
			  <?php echo $school_nm; ?><br /><?php echo $school_Address; ?><br /><?php echo $school_session; ?>
			  </center></h3>
			  </th>
			  <td><img src='<?php echo base_url($photo_right); ?>' style='width:70px;'></td>
		    </tr>
			<tr>
			  <td colspan='2'>Affiliation No.:<?php echo $school_AfftNo; ?></td>
			  <td style='text-align:right'>School Code.:<?php echo $school_Code; ?></td>
			</tr>
			<tr>
			  <td>Class-Sec: <?php echo $class.'-'.$sec; ?></td>
			  <td><center><h3>Subject Wise Analysis</h3></center></td>
			  <td style='text-align:right'>Term: <?php echo $term; ?></td>
			</tr>
		  </table>
		</div>
	  </div>
	  
	  <div class='row'>
		<div class='col-sm-12'>
		<?php 
		 for($i=1; $i<=9; $i++){
			 
		?>
			<table class='table' border='1'>
				<tr>
					<th colspan='2'><center>Result Analysis of <?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_nm']; ?></center></th>
				</tr>
				<tr>
					<th colspan='2'><center>First Term</center></th>
				</tr>
				<tr>
					<th><center>Marks</center></th>
					<th><center>No. of Students</center></th>
				</tr>
				<tr>
					<td><center> &gt; 90 </center></td>
					<td><center><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv90']; ?></center></td>
				</tr>
				<tr>
					<td><center> &gt; 80 </center></td>
					<td><center><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv80']; ?></center></td>
				</tr>
				<tr>
					<td><center> &gt; 70 </center></td>
					<td><center><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv70']; ?></center></td>
				</tr>
				<tr>
					<td><center> &gt; 60 </center></td>
					<td><center><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv60']; ?></center></td>
				</tr>
				<tr>
					<td><center> &gt; 50 </center></td>
					<td><center><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv50']; ?></center></td>
				</tr>
				<tr>
					<td><center> &gt; 40 </center></td>
					<td><center><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv40']; ?></center></td>
				</tr>
				<tr>
					<td><center> &gt; 32 </center></td>
					<td><center><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv32']; ?></center></td>
				</tr>
				<tr>
					<td><center> &lt; 32 </center></td>
					<td><center><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_lss32']; ?></center></td>
				</tr>
			</table>
			<br /><br />
			<div class="barChart">
				<div class="barChart__row" data-value="<?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv90']; ?>">
					<span class="barChart__label">&gt; 90</span>
					<span class="barChart__value"><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv90']; ?></span>
					<span class="barChart__bar"><span class="barChart__barFill"></span></span>
				</div>
				<div class="barChart__row" data-value="<?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv80']; ?>">
					<span class="barChart__label">&gt; 80</span>
					<span class="barChart__value"><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv80']; ?></span>
					<span class="barChart__bar"><span class="barChart__barFill"></span></span>
				</div>
				<div class="barChart__row" data-value="<?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv70']; ?>">
					<span class="barChart__label">&gt; 70</span>
					<span class="barChart__value"><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv70']; ?></span>
					<span class="barChart__bar"><span class="barChart__barFill"></span></span>
				</div>
				<div class="barChart__row" data-value="<?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv60']; ?>">
					<span class="barChart__label">&gt; 60</span>
					<span class="barChart__value"><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv60']; ?></span>
					<span class="barChart__bar"><span class="barChart__barFill"></span></span>
				</div>
				<div class="barChart__row" data-value="<?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv50']; ?>">
					<span class="barChart__label">&gt; 50</span>
					<span class="barChart__value"><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv50']; ?></span>
					<span class="barChart__bar"><span class="barChart__barFill"></span></span>
				</div>
				<div class="barChart__row" data-value="<?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv40']; ?>">
					<span class="barChart__label">&gt; 40</span>
					<span class="barChart__value"><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv40']; ?></span>
					<span class="barChart__bar"><span class="barChart__barFill"></span></span>
				</div>
				<div class="barChart__row" data-value="<?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv32']; ?>">
					<span class="barChart__label">&gt; 32</span>
					<span class="barChart__value"><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_abv32']; ?></span>
					<span class="barChart__bar"><span class="barChart__barFill"></span></span>
				</div>
				<div class="barChart__row" data-value="<?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_lss32']; ?>">
					<span class="barChart__label">&lt; 32</span>
					<span class="barChart__value"><?php echo $subj_wise_mrks[$i][0]['subj'.$i.'_lss32']; ?></span>
					<span class="barChart__bar"><span class="barChart__barFill"></span></span>
				</div>
			</div>
			<br /><br />
		    <?php
				if($i < 9 ){
			?>
			<div class="page-break"></div>
			<?php } ?>
		<?php
		 }
		?>	
		</div>
	  </div>
    </div>
  </body>
</html>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo base_url('assets/dash_js/jquery.barChart.js'); ?>"></script>
<script>
 jQuery('.barChart').barChart({easing: 'easeOutQuart'});
</script>