 <br />
 <form method="post" onsubmit="return validation()" action="<?php echo base_url('Admit_card/report_generation'); ?>">
  <div class="row">
	<div class="col-md-4 col-sm-4 col-lg-4">
		<label>Name of Exam:</label>
		<input type="text" class="form-control" id="date" name="date">
	</div>
	<div class="col-md-2 col-sm-2 col-lg-2">
		<br />
		<button class="btn btn-success">Generate Admit Card</button>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-6">
	</div>
 </div><br />
 <table class="table table-bordered" id="example">
	<thead>
		<tr>
			<th><input type="checkbox" id="viewCheckAll">Select All</th>
			<th>Sl No.</th>
			<th>Admission No.</th>
			<th>Roll No.</th>
			<th>Student Name</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if($student){
			$i = 1;
			foreach($student as $data_key){
				?>
					<tr>
						<td><input type="checkbox" class="viewCheck" value="<?php echo $data_key->ADM_NO; ?>" name="adm_no[]"></td>
						<td><?php echo $i; ?></a></td>
						<td><?php echo $data_key->ADM_NO; ?></td>
						<td><?php echo $data_key->ROLL_NO; ?></td>
						<td><?php echo $data_key->FIRST_NM; ?></td>
					</tr>
				<?php
				$i++;
			}
		}
	?>
	</tbody>
 </table>
 </form>
</div>
<div class="inner-block"></div>
<script type="text/javascript">
$(document).ready(function() {
$("#msg").fadeOut(8000);
$('#example').DataTable({
	"paging":   false,
	"ordering": false,
    "info":     false
});
});
 $('#viewCheckAll').click(function(){
        if($(this).prop("checked")) {
            $(".viewCheck").prop("checked", true);
        } else {
            $(".viewCheck").prop("checked", false);
        }                
    });

    $('.viewCheck').click(function(){
        if($(".viewCheck").length == $(".viewCheck:checked").length) {
            $("#viewCheckAll").prop("checked", true);
        }else {
            $("#viewCheckAll").prop("checked", false);            
        }
    });
	
	function validation(){
		var date = $('#date').val();
		if($(".viewCheck").is(":checked")){
			
		}
		else{
			alert("Please Select Atleast One");
			return false;
		}
		if(date !=""){
			
		}
		else{
			alert('Please Fill Exam Type');
			return false;
		}
	}
</script>