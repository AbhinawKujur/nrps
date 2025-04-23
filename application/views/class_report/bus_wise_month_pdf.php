<style>
	#table2 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:130px;
		width:130px;
		margin-left: 150px !important;
	}
	#tp-header{
		font-size:30px;
	}
	#mid-header{
		font-size:26px;
	}
	#last-header{
		font-size:22px;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
	}
</style>
<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
<table width="100%" style="float:right;">
	<tr>
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?><center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?><center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center></td>
	</tr>
</table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<caption style="font-size:24px;">Bus Wise Collection Report of Students of Class: <?php echo $classec[0]->DISP_CLASS."/".$classec[0]->DISP_SEC; ?></caption>
	<thead>
		<tr>
			<th class="th">Sl No.</th>
			<th class="th">Adm No.</th>
			<th class="th">Student Name</th>
			<th class="th">Roll No.</th>
			<th class="th">Ward</th>
			<th class="th">Details</th>
			<th class="th">APR</th>
			<th class="th">MAY</th>
			<th class="th">JUN</th>
			<th class="th">JUL</th>
			<th class="th">AUG</th>
			<th class="th">SEP</th>
			<th class="th">OCT</th>
			<th class="th">NOV</th>
			<th class="th">DEC</th>
			<th class="th">JAN</th>
			<th class="th">FEB</th>
			<th class="th">MAR</th>
			
		</tr>
	</thead>
	<tbody>
		<?php
			$i =1;
		 foreach($student_data as $key){
			 ?>
			 <tr>
				<td rowspan="3"><?php echo $i; ?></td>
				<td rowspan="3"><?php echo $key->ADM_NO; ?></td>
				<td rowspan="3"><?php echo $key->FIRST_NM; ?></td>
				<td rowspan="3"><?php echo $key->ROLL_NO; ?></td>
				<td rowspan="3"><?php echo $key->housenm; ?></td>
				<td>Receipt No.</td>
				<td><?php 
					if($key->APR_FEE_RECPT != null){
						echo $key->APR_FEE_RECPT;
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->MAY_FEE_RECPT != null){
						echo $key->MAY_FEE_RECPT;
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->JUNE_FEE_RECPT != null){
						echo $key->JUNE_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->JULY_FEE_RECPT != null){
						echo $key->JULY_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->AUG_FEE_RECPT != null){
						echo $key->AUG_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->SEP_FEE_RECPT != null){
						echo $key->SEP_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->OCT_FEE_RECPT != null){
						echo $key->OCT_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->NOV_FEE_RECPT != null){
						echo $key->NOV_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->DEC_FEE_RECPT != null){
						echo $key->DEC_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->JAN_FEE_RECPT != null){
						echo $key->JAN_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->FEB_FEE_RECPT != null){
						echo $key->FEB_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->MAR_FEE_RECPT != null){
						echo $key->MAR_FEE_RECPT;
					}else{
						echo "N/A";
					}
				?></td>
			 </tr>
			 <tr>
				<td>Receipt Date</td>
				<td><?php
					if($key->APR_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->APR_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->MAY_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->MAY_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->JUNE_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->JUNE_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->JULY_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->JULY_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->AUG_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->AUG_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->SEP_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->SEP_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->OCT_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->OCT_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->NOV_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->NOV_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->DEC_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->DEC_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->JAN_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->JAN_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->FEB_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->FEB_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
				<td><?php
					if($key->MAR_FEE_DATE != null)
					{
						echo date('d-M-Y',strtotime($key->MAR_FEE_DATE));
					}
					else{
						echo "N/A";
					}
				?></td>
			 </tr>
			  <tr>
				<td>Receipt Amt</td>
				<td><?php
					if($key->APR_FEE_AMT != null)
					{
						echo $key->APR_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->MAY_FEE_AMT != null)
					{
						echo $key->MAY_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->JUNE_FEE_AMT != null)
					{
						echo $key->JUNE_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->JULY_FEE_AMT != null)
					{
						echo $key->JULY_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->AUG_FEE_AMT != null)
					{
						echo $key->AUG_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->SEP_FEE_AMT != null)
					{
						echo $key->SEP_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->OCT_FEE_AMT != null)
					{
						echo $key->OCT_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->NOV_FEE_AMT != null)
					{
						echo $key->NOV_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->DEC_FEE_AMT != null)
					{
						echo $key->DEC_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->JAN_FEE_AMT != null)
					{
						echo $key->JAN_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->FEB_FEE_AMT != null)
					{
						echo $key->FEB_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
				<td><?php
					if($key->MAR_FEE_AMT != null)
					{
						echo $key->MAR_FEE_AMT;
					}
					else{
						echo 0;
					}
				?></td>
			 </tr>
			 <?php
			 $i++;
		 }
		?>
	</tbody>
</table>