<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Timetable</a> <i class="fa fa-angle-right"></i> Subject Preference</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;padding-top: 20px;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
          
              <?php echo form_open('timetable/Subject_preferences/save_preference',array('role'=>'form','id'=>'createForm')); ?>
                <div class="box box-primary">                 
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('success')){ 
                      echo $this->session->flashdata('success');
                     } ?>
					<div class="col-sm-4">
                    <div class="form-group">
                      <label>Teacher Name</label><span class="req">*</span>
                      <select class="form-control" name="tech_name" required="" id="tech_name" onchange="teacher_detail(this.value);">
                        <option value="">Select</option>
                        <?php foreach ($teacher_data as $key => $value) { ?>
                          <option value="<?php echo $value['EMPID']; ?>"><?php echo $value['EMP_FNAME']; ?> <?php echo $value['EMP_MNAME']; ?> <?php echo $value['EMP_LNAME']; ?>-<?php echo $value['EMPID']; ?></option>
                        <?php } ?>
                      </select>                      
                    </div>
					</div>
					<div class="col-sm-8">					
						<div class="form-group" id="subj_name">					
						
						</div>
                    </div>
                 <div class="col-sm-4"> 
                <div class="box-footer">
                  <button type="submit" class="btn btn-black pull-right">Submit</button>
                </div>
                </div>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
          <!-- /.box -->
        </section>

      </div>
    </div>
  </div>
</div><br><br>


  <script type="text/javascript">
  $('#tech_name').select2();  

  $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })
  });

function teacher_detail(empid){
	  $.post("<?php echo base_url('timetable/Subject_preferences/teacher_details'); ?>",{empid:empid},function(data){
		 $('#subj_name').html(data); 
		});
  }


function deleteFun(id)
{
  if(confirm('Do you want to remove this record?'))
  {
    $.ajax({
        url:'<?php echo base_url('timetable/floorclassdistribution/deleteRecord'); ?>',
        method:"post",
        data:{id:id},
        dataType:"json",
        success:function(response)
        {
          if(response == 1)
          {
            $.toast({
                  heading: 'Success',
                  text: 'Removed Successfully',
                  showHideTransition: 'slide',
                  icon: 'success',
                  position: 'top-right',
              });
            window.setTimeout(function(){location.reload()},1000);
          }
          else if(response == 2)
          {
            $.toast({
                  heading: 'Error',
                  text: 'Failed !',
                  showHideTransition: 'slide',
                  icon: 'error',
                  position: 'top-right',
              });
          }
        }
      });
  }
}

  </script>