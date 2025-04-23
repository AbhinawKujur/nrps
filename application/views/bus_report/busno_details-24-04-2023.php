<?php 

?>

<style>
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<form method="post" action="<?php echo base_url('bus_report/download_busreport'); ?>" target="_blank">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				<input type="hidden" value="<?php //echo $stoppage; ?>" name="stoppage">
				<input type="hidden" value="<?php //echo $amt; ?>" name="amt">
				<!--<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>-->
		</div>
	</div>
</form><br />

<br /><br />
<table class="table" id="example">
	<thead> 
		<tr>
			<th>Sl No.</th>
			<th>Admission No.</th>
			<th>Student Name</th>
			<th>Father's Name</th>
			<th>Class</th>
			<th>Section</th>
			<th>Contact No.</th>			
			<th>Stopno</th>
			<th>Stoppage Name</th>
			<th>Bus NO</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($getBusNoData as $key=>$value){
			
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value->ADM_NO; ?></td>
					<td><?php echo $value->FIRST_NM; ?></td>
					<td><?php echo $value->FATHER_NM; ?></td>
					<td><?php echo $value->DISP_CLASS; ?></td>
					<td><?php echo $value->DISP_SEC; ?></td>
					<td><?php echo $value->C_MOBILE; ?></td>
					<td><?php echo $value->STOPNO; ?></td>
				
					<td><?php echo $value->stopnm; ?></td>  
					<td><?php echo $value->Bus_No; ?></td>
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
</table>
<?php if($section=='8'){
	$sec='senior';}
	else
	$sec='junior';
// $b=$buscode[0];
	
?>

<script type="text/javascript">
$(document).ready(function() {
$('#example').DataTable({
	dom: 'Bfrtip',
	ordering: false,
	buttons: [
		{
			extend: 'excelHtml5',
			title: 'Bus No. Wise Report."<?php echo 'busno :'.$buscode.'section :'.$sec; ?>"'
		},
	]
});
});
</script>