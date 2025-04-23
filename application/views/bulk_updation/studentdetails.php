<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px!important;
  }
  .table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('employee/employee'); ?>">Student Details</a> <i class="fa fa-angle-right"></i> Update Student Details</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                <div class="table-responsive">
                  <table border="1" class="table table-striped table-bordered dataTable">
                    <thead>
                      <tr>
                        <th style="background: #337ab7; color: white !important;">Sno</th>
                        <th style="background: #337ab7; color: white !important;">Name</th>
                        <th style="background: #337ab7; color: white !important;">Adm No</th>
                        <th style="background: #337ab7; color: white !important;">Roll</th>
                        <th style="background: #337ab7; color: white !important;">Mobile No</th>
                      </tr>
                    </thead>
					<tbody>
                    <?php
						$i=1;
						foreach($studentdetails as $key=>$value){
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->FIRST_NM; ?></td>
									<td><?php echo $value->ADM_NO; ?></td>
									<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" data-row_adm="<?php echo $value->STUDENTID; ?>" data-column_name="ROLL_NO" contenteditable><?php echo $value->ROLL_NO; ?></td>
									<td class="table_data" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46 || event.charCode==78 || event.charCode==65 || event.charCode==47 || event.charCode==97 || event.charCode==110" data-row_adm="<?php echo $value->STUDENTID; ?>" data-column_name="C_MOBILE" contenteditable><?php echo $value->C_MOBILE; ?></td>
								</tr>
							<?php
							$i++;
						}
					?>
					</tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).on('blur', '.table_data', function(){
		var adm = $(this).data('row_adm');
		//var fh = $(this).data('row_fh');
		var table_column = $(this).data('column_name');
		var value = $(this).text();
		//alert("adm is:"+adm+"table is:"+table_column+" value"+value);
		$.ajax({
		  url:"<?php echo base_url('bulk_updation/Studentdetails/update_data'); ?>",
		  method:"POST",
		  data:{adm:adm,table_column:table_column, value:value},
		  success:function(data)
		  {
			$.toast({
                heading: 'Success',
                text: 'Saved Successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            });
		  }
		});
  });
</script>