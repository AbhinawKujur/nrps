	<table class='table' id='example' style="font-size: 13px;z-index:50;" >	
						<thead>
				  			<tr>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Sl.No.</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Acc. No.</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Book Name</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Author</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Publisher</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Price</th>
				  				<th style="background:#337ab7;color:#fff !important;border:1px solid;">Status</th>
				  			</tr>
				  		</thead>
				  		<tbody >
				  		 <?php
				  			$c=0;
				  			
								foreach($tockreg as $key => $val){
								?>
					  			<tr>
					  				<td class="tab1"><?=++$c?></td>
					  				<td class="tab1"><?=$val['accno']?></td>
					  				<td class="tab1"><?=$val['BNAME']?></td>
					  			
					  				<td class="tab1"><?=$val['AUTHOR']?></td>		
					  				<td class="tab1"><?=$val['PUBLISHER']?></td>
					  				<td class="tab1"><?=$val['PRICE']?></td>
					  				<td class="tab1">
								<?php 
									if($val['FLAG']=='1'){
										$st="ISSUED";
									}else{
										if($val['book_status']=='L'){
										$st="<span style='color:red'>LOST</span>";
									}else if($val['book_status']=='D'){
										$st="<span style='color:red'>Damage</span>";
									}else if($val['book_status']=='W'){
										$st="Written off";
									}else{
										$st="";
									}
									}
									echo $st;
									
									?>
									</td>
					  			</tr>
				  			<?php } ?> 
				  			
				  		</tbody>
			  		</table>
			  	
					<script>
					
$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Book Stock Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Book Stock Reports',
                
            },
        ]
    });
	
	</script>