<style>
	label span{
		color:red;
		font-weight:bold;
	}
	fieldset.scheduler-border {
		border: 1px groove #ddd !important;
		padding: 0 1.4em 1.4em 1.4em !important;
		margin: 0 0 1.5em 0 !important;
		-webkit-box-shadow:  0px 0px 0px 0px #000;
				box-shadow:  0px 0px 0px 0px #000;
	}

	legend.scheduler-border {
		font-size: 1.2em !important;
		font-weight: bold !important;
		text-align: left !important;
		width:inherit; /* Or auto */
		padding:0 10px; /* To give a bit of padding on the left and right */
		border-bottom:none;
	}
	.main{
		background:#eee;
		padding:10px;
	}
	body{
		font-family: Verdana,Geneva,sans-serif !important; 
	}
	input,select,textarea{
		text-transform: uppercase
	}
	.form-control:focus{
		border:1px solid red;
	}
</style>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admission Test Marks Entry</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admission Test Marks Entry</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

   
    <section class="content">
      <div class="card">
        <div class="card-body">
			<div style='color:red'><b>Max Marks: <?php echo $maxmarks[0]['maxmarks']; ?></b></div>
			<table class='table' id='example1'>
				<thead>
					<tr>
						<th><center>Registration No.</center></th>
						<th><center>Student Name</center></th>
						<th><center>Father's Name</center></th>
						<th><center>Marks</center></th>
					</tr>
				</thead>
				<tbody id='load'>
				<?php
					foreach($stuData as $key => $val){
						$marks =  !empty($val['marks'])?$val['marks']:''
				?>
					<tr>
						<td><center><?php echo $val['id']."/2020"; ?></center></td>
						<td><center><?php echo $val['stu_nm']; ?></center></td>
						<td><center><?php echo $val['f_name']; ?><center></td>
						<td><center><input value='<?php echo $marks; ?>' type='text' id='<?php echo $val['id']; ?>' name='marks' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 65 || event.charCode == 66 || event.charCode == 97 || event.charCode == 98' style='text-align:right' onchange="marksEntry('<?php echo $val['id']; ?>',this.value)"></center></td>
					</tr>
				<?php } ?>	
				</tbody>
			</table>
        </div>
      </div>
    </section>
  </div>
  
<script type="text/javascript">
	$("#marks").addClass('active');
	
	$(document).ready(function() {
		$('#example1').DataTable( {
			'paging':false
		} );
	} );
	
	function marksEntry(stu_reg_no,marksValue){
		var maxmarks = "<?php echo $maxmarks[0]['maxmarks']; ?>";
		var mm = Number(maxmarks);
		var mv = Number(marksValue);
		if(mv > mm && marksValue != 'ab' && marksValue != 'AB'){
			$.toast({
				heading: 'Error',
				text: 'Enter Valid Marks',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
			});
			$("#"+stu_reg_no).val('');
			$("#"+stu_reg_no).focus();
		}else{
			$.ajax({
				url: "<?php echo base_url('adm_three/MarksEntry/saveNdUpdMarks'); ?>",
				type: "POST",
				data: {stu_reg_no:stu_reg_no,marksValue:marksValue},
				success: function(ret){
					$.toast({
						heading: 'Success',
						text: 'Marks Inserted Sucessfully',
						showHideTransition: 'slide',
						icon: 'success',
						position: 'top-right',
					});
				}
			});
		}
	}
</script>