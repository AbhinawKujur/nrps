<form action='<?php echo base_url('report_card_preptofive/Report_card_prepTofive/preptofiveReportCardPDF'); ?>' method='POST'>
<table class='table dataTable'>
<thead>
    <tr>
		<td><button type='submit' class='btn btn-success btn btn-sm' id='generate_btn' disabled>GENERATE</button></td>
    </tr>
	<tr>
		<th style='background:#5785c3; color:#fff !important'>
		<input type='checkbox' id='viewCheckAll'>
		Adm No.
		</th>
		<th style='background:#5785c3; color:#fff !important'>Name</th>
		<th style='background:#5785c3; color:#fff !important'>Roll No.</th>
	</tr>
	<input type='hidden' value='<?php echo $sec; ?>' name='sec'>
	<input type='hidden' value='<?php echo $class; ?>' name='classes'>
	<input type='hidden' value='<?php echo $round; ?>' name='round'>
</thead>	
<tbody>	
	<?php
		foreach($stuData as $key => $val){
			?>
				<tr>
					<td>
					<input type='checkbox' class='viewCheck' name="stu_adm_no[]" value="<?php echo $val['ADM_NO']; ?>">
					<?php echo $val['ADM_NO']; ?>
					</td>
					<td><?php echo $val['FIRST_NM']; ?></td>
					<td><?php echo $val['ROLL_NO']; ?></td>
				</tr>
			<?php
		}
	?>
</tbody>	
</table><br />
</form>
<script>
$(".dataTable").DataTable({
	"paging":false,
	"ordering":false,
	"info":false,
}); 

$('#viewCheckAll').click(function(){
	if($(this).prop("checked")) {
		$(".viewCheck").prop("checked", true);
		$("#generate_btn").prop('disabled',false);
	} else {
		$(".viewCheck").prop("checked", false);
		$("#generate_btn").prop('disabled',true);
	}                
});

$('.viewCheck').click(function(){
	if($(".viewCheck").length == $(".viewCheck:checked").length) {
		$("#viewCheckAll").prop("checked", true);
		$("#generate_btn").prop('disabled',true);
	}else {
		$("#viewCheckAll").prop("checked", false); 
		$("#generate_btn").prop('disabled',false);			
	}
});

</script>