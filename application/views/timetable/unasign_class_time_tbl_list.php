<style>
label{
	font-size:12px;
	font-weight: bold !important;
}
table{
	padding-right:20px;
}
button.dt-button, div.dt-button, a.dt-button {
	line-height:0.66em;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
 }
 

</style>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Unassign Blank Class Time Table List</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div id="refresh">
  <form action="<?php echo base_url('timetable/Class_time/generateclasstime'); ?>" method="post" autocomplete="off" id="myForm">
    
    <div class="row">
      <div class='col-sm-6'>
        <div class="card-body">
          <div class="form-group" >
            <label style="font-size:15px"></label>
			<input type="submit" name="submit" value="Generate Blank Class Time Table" class="btn btn-primary" /><br />
			<table  class='table table-responsive' style="margin-top: 20px;">
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important;border:1px solid'>sl.No.</th>
					<th style='background:#337ab7; color:#fff !important;border:1px solid'>Class Name</th>					
				</tr>
			</thead>
			<tbody>			
				<?php
				$c=0;
				foreach($class_list as $key=>$val){?>				
				<tr>
				<td style='border:1px solid #dddddd;'><?=++$c;?></td>
				<td style='border:1px solid #dddddd;'><?=$val['Class_name_Roman']?></td>				
				</tr>
				<input type="hidden" name="class_sec_code<?=$c?>" value="<?=$val['Class_Sec_SubCode']?>" />
				<?php }?>
				<input type="hidden" name="count" value="<?=$c?>" />
			</tbody>				
			</table>
          </div>
        </div>
      </div>
      <!---------------------------**********************-------------------------->
    </div>
  </form>
</div>
<br />
<script>
$(".alert").fadeOut(3000);	
$('#adm_no').select2();
$('#accno').select2();
$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Book Issued Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Book Issued Reports',
                
            },
        ]
    });

</script>
