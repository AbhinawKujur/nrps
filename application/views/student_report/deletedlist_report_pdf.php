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
		font-size:25px;
	}
	#mid-header{
		font-size:22px;
	}
	#last-header{
		font-size:18px;
	}
	#last-header1{
		font-size:15px;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
        padding: 8px;
	}
    .td{
        font-size: 12px;
    }
</style>
<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
<table width="100%" style="float:right;">
	<tr>
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?></center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?></center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)</center></td>
	</tr>
	<tr>
		<td id="last-header1"><center>Deleted / Recall Report from <?php echo date("d-m-Y", strtotime($strt_dat)); ?> To <?php echo date("d-m-Y", strtotime($end_dat)); ?></center></td>
	</tr>
</table><br /><br /><br /><br /><br /><br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<hr>
<br />

<table class="table2">
	<thead>
		<tr>
			<th class='th'>Sl. No.</th>
			<th class='th'>Admission No.</th>
			<th class='th'>Student Name</th>
			<th class='th'>Class</th>
			<th class='th'>Sec</th>
			<th class='th'>Delete Date</th>
			<th class='th'>Recall Date</th>
			<th class='th'>Login Id</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
            // echo "<pre>";
            // print_r($stu_list);die;
			foreach($stu_list as $key=>$value){
                // echo "<pre>";
                // print_r($value);die;
				?>
				<tr>
					<td class='td'><?php echo $i; ?></td>
					<td class='td'><?php echo $value->Adm_no; ?></td>
					<td class='td'><?php echo $value->Stu_name; ?></td>
					<td class='td'><?php echo $value->cl; ?></td>
					<td class='td'><?php echo $value->sec; ?></td>
					<td class='td'><?php echo $value->del_date; ?></td>
					<td class='td'><?php if($value->recall_date!="0000-00-00"){echo $value->recall_date;} ?></td>
					<td class='td'><?php echo $value->operator_id; ?></td>
					
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>
