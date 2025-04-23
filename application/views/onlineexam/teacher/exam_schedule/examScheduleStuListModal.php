<table class='table' id='tbl3'>
	<thead>
		<tr>
			<th style='background:#5785c3; color:#fff !important'><input type="checkbox" id='viewCheckAll'> Adm. No.</th>
			<th style='background:#5785c3; color:#fff !important'>Stu. Name</th>
			<th style='background:#5785c3; color:#fff !important'>Roll</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$count = count($stuData);
			foreach($stuData as $key => $val){
				?>
					<tr>
						<td><input type="checkbox" class='viewCheck' name="admno[]" value="<?php echo $val['ADM_NO']; ?>"> <?php echo $val['ADM_NO']; ?></td>
						<td><?php echo $val['FIRST_NM']; ?></td>
						<td><?php echo $val['ROLL_NO']; ?></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
<script>
	$(function () {
		$('#tbl3').DataTable({	
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'autoWidth'   : true,
		  aaSorting: [[0, 'asc']]
		})
	  });	
	  
	$('#viewCheckAll').click(function(){
		if($(this).prop("checked")) {
			$(".viewCheck").prop("checked", true);
			$("#modal_save_btn").prop('disabled',false);
		} else {
			$(".viewCheck").prop("checked", false);
			$("#modal_save_btn").prop('disabled',true);
		}                
	});

	$('.viewCheck').click(function(){
		var rows = '<?php echo $count; ?>';
		if(rows == $(".viewCheck:checked").length) {
			$("#viewCheckAll").prop("checked", true);
		}else {
			$("#viewCheckAll").prop("checked", false); 
		}
		
		if($(".viewCheck:checked").length >= 1){
			$("#modal_save_btn").prop("disabled", false); 
		}else{
			$("#modal_save_btn").prop("disabled", true); 
		}
	});
</script>