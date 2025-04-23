<style>
	#table2 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:130px;
		width:130px;
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
</table><br /><br /><br /><br /><br /><br /><br />
<center>Award List of Class:- <?php echo $student[0]->DISP_CLASS; ?>/<?php echo $student[0]->DISP_SEC; ?></center>
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th">Sl No</th>
			<th class="th">Adm No</th>
			<th class="th">Roll No</th>
			<th class="th">Student Name</th>
			<th class="th">Mark</th>
			<?php if($mobile == 'with_mobile'){ ?>
				<th class="th">Phone Number</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php
			$i =1;
		 foreach($student as $key){
			 ?>
			 <tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $key->ADM_NO; ?></td>
				<td><?php echo $key->ROLL_NO; ?></td>
				<td><?php echo $key->FIRST_NM; ?></td>
				<td></td>
				<?php if($mobile == 'with_mobile'){ ?>
					<td><?php echo $key->C_MOBILE ?></td>
			<?php } ?>
			 </tr>
			<?php $i++;
		 }
		?>
	</tbody>
</table>