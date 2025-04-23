	<form class="nur_form2">
	
	<table class='table' id='example'>
	<?php 
	$ddt=date_create("$ddt");
	
	$day = date_format($ddt,"D");
	$dateT=date_format($ddt,"Y-m-d");
	;?>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important;'>Name</th>
					<th style='background:#337ab7; color:#fff !important;'>Type</th>
					<th style='background:#337ab7; color:#fff !important;'>Price as <b>'<?php echo $day;?>'<br/><center><sup>(<?php echo $dateT;?>)</sup></center><input type="hidden" value="<?php echo $day;?>" name="day"></b></th>
					<th style='background:#337ab7; color:#fff !important;'>Qnt</th>
					<th style='background:#337ab7; color:#fff !important;'>Total</th>
					
		
				</tr>
			</thead>	
			<tbody>	
				<?php
			
				$i=1;
					foreach($newsMagazineMasterData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['ItemName']; ?>
								<input type="hidden" value="<?php echo $val['ItemID']; ?>" name="itemid[]">
									<input type="hidden" value="<?php echo $dateT; ?>" name="dateday" id="">
								<input type="hidden" value="<?php echo $val['update_id']; ?>" name="update_id[]">
								<input type="hidden" value="<?php echo $val['ItemName']; ?>" name="nm[]"></td>
								<td><?php echo $val['ItemType']; ?><input type="hidden" value="<?php echo $val['ItemType']; ?>" name="type[]"></td>
								<td> <?php echo $val['d_pay']; ?><input type="hidden" value="<?php echo $val['d_pay']; ?>" id="dp<?php echo $i;?>" name="day_price[]"></td>
								<td><input type="number" min=0 value="<?php echo $val['qty']; ?>" name="qnt[]" onkeyup="qntPrice(this.value,<?php echo $i;?>)"></td>
								<td><input type="number" min=0  value="<?php echo $val['total_pay']; ?>" id="<?php echo $i;?>" name="total[]" readonly></td>
							</tr>
						<?php
						
						$i++;
					}
				?>
			</tbody>	
			</table>
			<input type='submit' class="btn btn-success" value='Save'>
			</form>
			<script>
function change_date(date){
		$.post("<?php echo base_url('library/NewsMagazineMaster/Journal_Entry_change'); ?>",{'date':date},function(data){
			$("#data_view").html(data);
		});
}
 $(".nur_form2").on("submit", function (event) {
	 event.preventDefault();
	//$("#sv_btn").prop('',true);
		$("#loading").click();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('library/NewsMagazineMaster/save_journal_entry_change'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
			 $('#loa').html("<p style='font-size:17px;color:green'>Record updated successfully...!!!</p>");
			 $("#loading").click();
				 // swal("Good job!", "Record updated successfully!", "success");
				//window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
			var ddt=	("#dateday").val();
			change_date(ddt);
				//window.location="";
			}
		});
	
	 });
	 
$(".alert").fadeOut(3000);
$('#example').DataTable({
	"paging":   false,
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Daily Collection Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Daily Collection Reports',
                
            },
        ]
    });
	
	function newsMagazineMasterEdit(ItemID){
		$.post("<?php echo base_url('library/NewsMagazineMaster/edit'); ?>",{ItemID:ItemID},function(data){
			$("#load").html(data);
		});
	}
	
	function qntPrice(vl,id){
	
		var d_price=parseFloat($("#dp"+id).val());
		var ttl=d_price*parseFloat(vl);
		$("#"+id).val(ttl);
		
	}
</script>