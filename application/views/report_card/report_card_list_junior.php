<br />
<form target='_blank' id="" method="post" action="<?php echo base_url('report_card/report_card/generatePDF_junior'); ?>">
  <button id='generate_btn' class='btn btn-success btn-xs' disabled onclick="generateReportCard()">Generate</button>
  <input type="hidden" name="term" value="<?=$trm; ?>">
  <input type="hidden" name="round_off" value="<?=$round; ?>">
  <input type="hidden" name="date" value="<?=$dt; ?>">
  <input type="hidden" name="classs" value="<?=$classs; ?>">
  <input type="hidden" name="sec" value="<?=$sec; ?>">
  <table class='table datatable'>
   <thead>
     <tr>
		 <th style='background:#337ab7; color:#fff !important;'><input type="checkbox" id='viewCheckAll'></th>
		 <th style='background:#337ab7; color:#fff !important;'>Adm No.</th>
		 <th style='background:#337ab7; color:#fff !important;'>Stu Name</th>
		 <th style='background:#337ab7; color:#fff !important;'>Roll No.</th>
		 <th style='background:#337ab7; color:#fff !important;'>Report Card Status</th>
     </tr>
   </thead>  
   <tbody>  
    <?php
  	if(isset($stu_data)){
  		foreach($stu_data as $data){
  			?>
  			  <tr>
  			    <td><input type="checkbox" class='viewCheck' name="stu_adm_no[]" value="<?= $data->ADM_NO; ?>"></td>
  				<td><?php echo $data->ADM_NO; ?></td>
  				<td><?php echo $data->FIRST_NM.' ' .$data->MIDDLE_NM; ?></td>
  				<td><?php echo $data->ROLL_NO; ?></td>
  				<td>
					<?php
						if($data->t1_report_card_status == 1){
							$adm = str_replace('/','-',$data->ADM_NO);
							?>
								<a download href='<?php echo base_url('report_card/term1/'.$adm.'.pdf'); ?>' class='btn btn-success btn-sm'> Download </a>
							<?php
						}
					?>
				</td>
  			  </tr>
  			<?php
  		}
  	}
    ?>
    </tbody>
  </table>  
</form>
<script>
    $(function () {
        $('.datatable').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false
        })
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
	
	function ref(){
		$.ajax({
			url: "<?php echo base_url('report_card/report_card/chksession'); ?>",
			success: function(res){
				if(res == 1){
					generate();
				}
			}
		});
	}
	
	function generateReportCard(){
		setInterval(function(){ 
			ref();
		}, 1000);
	}
</script>