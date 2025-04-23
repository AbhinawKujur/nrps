<form method="post" action="<?php echo base_url('Class_report/download_class_wise_pdf'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
			<center>
				<button class="btn"><i class="fa fa-file-pdf-o"></i> Download</button>
			</center>
		</div>
	</div>
</form>
<table class="table" id="example">
	<thead>
		<tr>
			<th>Sl No.</th>
			<th>Adm No.</th>
			<th>Student Name</th>
			<th>Roll No.</th>
			<th>Ward</th>
			<th>Details</th>
			<th>APR</th>
			<th>MAY</th>
			<th>JUN</th>
			<th>JUL</th>
			<th>AUG</th>
			<th>SEP</th>
			<th>OCT</th>
			<th>NOV</th>
			<th>DEC</th>
			<th>JAN</th>
			<th>FEB</th>
			<th>MAR</th>
			
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