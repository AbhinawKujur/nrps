<?php
// echo '<pre>';
// print_r($student_data);
// die;
?>
<!-- <style>
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
	.tt{
		font-size:13px;
	}
	
</style> -->

<style>
	#table2 {
		border-collapse: collapse;
		font-size:12px !important;
	}
	#img{
		float:left;
		height:100px;
		width:100px;
		margin-left: 10px !important;
	}
	#tp-header{
		font-size:26px;
	}
	#mid-header{
		font-size:20px;
	}
	#last-header{
		font-size:18px;
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
	}
	.tt{
		font-size:13px;
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
</table><br /><br /><br /><br /><br /><br />
<hr>
<table width="100%" border="1" id="table2" style='font-size:12px !important;'>
	<caption style="font-size:18px;">Ward Category Report For Class - <?php if ($class == 99 ){ echo 'ALL CLASS'; } else { echo $student_data[0]['DISP_CLASS'];} ?> [ <?php echo $ward['HOUSENAME']; ?> ]</caption>
	<br />
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Adm No.</th>
            <th>Student Name</th>
            <th>Class/Sec</th>
            <th>Roll No.</th>
            <th>Father Name</th>
            <th>Mother Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($student_data as $key) {
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $key['ADM_NO']; ?></td>
                <td><?php echo $key['FIRST_NM']; ?></td>
                <td><?php echo $key['DISP_CLASS'] . '/' . $key['DISP_SEC']; ?></td>
                <td><?php echo $key['ROLL_NO']; ?></td>
                <td><?php echo $key['FATHER_NM']; ?></td>
                <td><?php echo $key['MOTHER_NM']; ?></td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>

	
</table>