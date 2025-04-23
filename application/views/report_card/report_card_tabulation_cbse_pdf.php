<html>
  <head>
    <title>Tabulation Report Card</title>
	<style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		font-size:11.55px;
		padding:1px !important;
	  }
	@page { margin: 120px 25px 60px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
    #footer .page:after { content: counter(page, decimal); }
	</style>
  </head>
  <body>
     <header id="header">
      <div style="text-align: center;">
        <span style="font-size: 25px;font-weight: bold;">JVM</span>
        <br><span>Mecon Colony ranchi</span><br>
      </div>
      <div style="text-align: center;">Tabulation Sheet</div>
    </header>
   <div id="footer">
      <p class="page">Page </p>
    </div>
    <div id='content'>	
    <table class='table' border='1' cellspacing='0'>
	 <thead>
	  <tr>
		<th style='background:#337ab7; color:#fff !important'>Adm No</th>
		<th style='background:#337ab7; color:#fff !important'>Stu Name</th>
		<th style='background:#337ab7; color:#fff !important'>Roll Name</th>
		<th style='background:#337ab7; color:#fff !important'>Exam Name</th>
		<?php
		  foreach($subject_list as $key => $subjdata){
			?>
			 <th style='background:#337ab7; color:#fff !important; text-align:center'><?php echo $subjdata['subj_nm']; ?><br /><span style='font-size:8px;'>(MO | WT)</span></th>
			<?php
		  }
		?>
		<th style='background:#337ab7; color:#fff !important'>Max Marks</th>
		<th style='background:#337ab7; color:#fff !important'>Total Marks</th>
		<th style='background:#337ab7; color:#fff !important'>Total Percent</th>
		<th style='background:#337ab7; color:#fff !important'>Grade</th>
		<th style='background:#337ab7; color:#fff !important'>Attendance</th>
	  </tr>
	  </thead>
	  <tbody>
    <?php
	  foreach($allData as $key => $data){
		  ?>
		    <tr>
			  <td><?php echo $data['ADM_NO']; ?></td>
			  <td><?php echo $data['FIRST_NM']; ?></td>
			  <td><?php echo $data['ROLL_NO']; ?></td>
			  <td colspan='14'></td>
			  <td>
			    <?php
				  $fin_wtg = array();
				  $totExamWetArr = 0;
				  $totMarksObtArr = 0;
				  foreach($data['exmaList'] as $key1 => $examdata){
					  ?>
					    <tr>
						  <td colspan='4' style='text-align:right'><?php echo $examdata; ?></td>
						   <?php
						        $i = 0;
						        $tot_wtg = 0;
								$totExamWet = 0;
								$tot_percent = 0;
								foreach($data['marks'][$key1] as $key2 => $mrks){
									$i = $i + 1;
									if(!isset($fin_wtg[$i]))
									{
										$fin_wtg[$i] = 0;
									}

									if($mrks['opt_code'] != 1 && $mrks['display'] == 1){ //check for sub_option(2)
									  $tot_wtg += $mrks['wt'];
								      $totExamWet = $data['wetage'][$key1] + $totExamWet;
									?>
									  <td><?php echo $mrks['mo']." | ".$mrks['wt']; ?></td>

									<?php $fin_wtg[$i] += $mrks['wt'];
									}else{ ?>
									  <td> </td>
									<?php 	
									}
								}
							?>
						  <td><?php echo $totExamWet; 
						  $totExamWetArr += $totExamWet;
						  ?></td>	
						  <td><?php echo $tot_wtg;
						  $totMarksObtArr += $tot_wtg;
						  ?></td>	
						  <td><?php echo $tot_percent = number_format($tot_wtg * 100 / $totExamWet,2); ?></td>
                          <td>
						    <?php
							  foreach($grade as $key3 => $val3){
								if($val3['ORange'] >=$tot_percent && $val3['CRange'] <=$tot_percent){
								echo $val3['Grade'];
								break;
							    }
							  }
							?>
						  </td>
                          <td></td>
					    </tr>
					  <?php
				  }
				?>
			  </td>
		    </tr>
			<tr>
			  <td colspan='4' style='text-align:right'>Total</td>
			  <?php
			    foreach($fin_wtg as $key4 => $val4){
					?>
					  <td><?php echo $val4; ?></td>
					<?php
				}
			  ?>
			  <td><?php echo $totExamWetArr; ?></td>
			  <td style='background:#ece0e0;'><?php echo $totMarksObtArr; 
			  $fper = ($totMarksObtArr * 100)/ $totExamWetArr;
			  ?></td>
			  <td><?php echo number_format($fper,2); ?></td>
			  <td>
			  <?php
			   foreach($grade as $key5 => $val5){
				if($val5['ORange'] >=$fper && $val5['CRange'] <=$fper){
				echo $val5['Grade'];
				break;
				}
			   }
			  ?>
			  </td>
			  <td></td>
			</tr>
			<tr>
			  <td colspan='4' style='text-align:right'>Grade</td>
			  <?php
			    foreach($fin_wtg as $key5 => $val5){
					?>
					  <td>
					    <?php
						   foreach($grade as $key6 => $val6){
							if($val6['ORange'] >=$val5 && $val6['CRange'] <=$val5){
							echo $val6['Grade'];
							break;
							}
						   }
						?>
					  </td>
					<?php
				}
			  ?>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			</tr>
		  <?php
	  }
	?> 
	</tbody>
	</table>
	</div>
  </body>	
</html>