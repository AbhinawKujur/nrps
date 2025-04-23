<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('homework/Homework'); ?>">BUS NO WISE SUMMARY REPORT</a> <i class="fa fa-angle-right"></i></li>
</ol>

 <div style="background-color:white; border-top:3px solid #5785c3; padding:18px;">
	<div class='row'>
		<table id='example' border='1' style='width:100%'>
			<thead>
			   <tr>		
					<th class="th">&nbsp;&nbsp;Sl No.</th>
					<th class="th" >&nbsp;&nbsp;BUS NO</th>
					<th class="th" >&nbsp;&nbsp;TOTAL STOPPAGE</th>
					<th class="th" >&nbsp;&nbsp;TOTAL STUDENT</th>
					<th class="th" >&nbsp;&nbsp;VI-VIII</th>
					<th class="th" >&nbsp;&nbsp;IX-X</th>
					<th class="th" >&nbsp;&nbsp;XI-XII</th>
					<th class="th" >&nbsp;&nbsp;BOYS</th>
					<th class="th" >&nbsp;&nbsp;GIRLS</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i=1;
					$stoppage=0;
					$tot_stu=0;
					$group_a=0;
					$group_b=0;
					$group_c=0;
					$group_m=0;
					$group_f=0;

					foreach($alldata as $key){
						?>
							<tr>
								<td class="tt" >&nbsp;&nbsp;<?php echo $i; ?></td>
								<td class="tt" >&nbsp;&nbsp;<?php echo $key['bus_no']; ?></td>
								<td class="tt" >&nbsp;&nbsp;<?php echo $key['stoppage']; $stoppage +=$key['stoppage'] ?></td>
								<td class="tt" >&nbsp;&nbsp;<?php echo $key['tot_stu'];$tot_stu+=$key['tot_stu']?></td>
								<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_a'];$group_a+=$key['group_a']?></td>
								<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_b'];$group_b+=$key['group_b']?></td>
								<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_c'];$group_c+=$key['group_c']?></td>
								<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_m'];$group_m+=$key['group_m']?></td>
								<td class="tt" >&nbsp;&nbsp;<?php echo $key['group_f'];$group_f+=$key['group_f']?></td>
							</tr>
						<?php
						$i++;
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th class="th"></th>
					<th class="th">&nbsp;&nbsp;<span style='float:right'>TOTAL &nbsp;&nbsp;</span></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $stoppage;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $tot_stu;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_a;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_b;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_c;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_m;?></th>
					<th class="th" >&nbsp;&nbsp;<?php echo $group_f;?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<br />

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
		searching:false,
		paging:false,
		ordering: false,
        buttons: [
            {
                extend: 'excel',
                title: 'BUS NO WISE SUMMARY REPORT',
				footer: true
            },
			{
                extend: 'pdf',
                title: 'BUS NO WISE SUMMARY REPORT',
				footer: true
            },
        ]
    } );
} );
</script>