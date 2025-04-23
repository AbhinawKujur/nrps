<style type="text/css">
  .thead-color{
   background: #bac9e2 !important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('homework/Homework'); ?>">Homework</a> <i class="fa fa-angle-right"></i> Homework Details </li>
</ol>

  <div class="employee-dashboard">
    <div class="row"> 
            <div class="col-sm-12">
              <div class="panel panel-default" style="background: #3278ab !important;font-size: 13px">
                <div class="panel-heading"><i class="fa fa-search"></i> Search Criteria</div>
                <div class="" style="background: white !important;border:1px solid #3278ab;padding: 20px;">
                  <form action="<?php echo base_url('homework/homeworkreport'); ?>" method="post" autocomplete="off">
                    <div class="row">
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>From Date</label>
                          <input type="text" name="from_date" readonly="" class="form-control datepicker" value="<?php echo set_value('from_date',date('d-M-Y')); ?>">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>To Date</label>
                          <input type="text" name="to_date" readonly="" class="form-control datepicker" value="<?php echo set_value('to_date',date('d-M-Y')); ?>">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Class</label>
                          <select class="form-control" name="class_id" id="class_id" onchange="getSectionByClassId()">
                            <option value="">Select</option>
                            <?php foreach ($classList as $key => $value) { ?>
                              <option value="<?php echo $value['Class_no']; ?>" <?php if(set_value('class_id')==$value['Class_no']){ echo "selected"; } ?>><?php echo $value['classnm']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Section</label>
                          <select class="form-control" name="section_id" id="section_id" onchange='getSubject(this.value)'>
                           
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Subject</label>
                          <select class="form-control" name="subject" id="subject_id">
                            <option value="">Select</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Homework Category</label>
                          <select class="form-control" name="homework_category">
                            <option value="">Select</option>
                            <?php foreach ($homeworkCategory as $key => $value) { ?>
                              <option value="<?php echo $value['id']; ?>" <?php if(set_value('homework_category')==$value['id']){ echo "selected"; } ?>><?php echo $value['category']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-success pull-right" name="search"><i class="fa fa-search"></i> Search</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
            </div>
        </div>

    <?php if(isset($homeworkDetails)) { ?>
      <div class="row"> 
          <div class="col-sm-12">
            <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
              <div class="panel-heading"><i class="fa fa-clipboard"></i> Homework Report</div>
              <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;">
                  <table class='table table-bordered table-striped dataTable'>
                    <thead>
                      <tr>
                        <th class="thead-color text-center">Class - Section</th>
                        <th class="thead-color">Category</th>
                        <th class="thead-color text-center">Subject</th>
                        <th class="thead-color text-center">Homework Date</th>
                        <th class="thead-color text-center">Submission Date</th>
                        <th class="thead-color text-center">Remarks</th>
                        <th class="thead-color text-center">Document</th>
                        <th class="thead-color text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($homeworkDetails as $key => $value) { ?>
                        <tr>
                          <td class="text-center"><?php echo $value['class_name'].' - '.$value['section_name']; ?></td>
                          <td><?php echo $value['category']; ?></td>
                          <td class="text-center"><?php echo $value['subject_name']; ?></td>
                          <td class="text-center"><?php echo date('d-M-Y',strtotime($value['homework_date'])); ?></td>
                          <td class="text-center"><?php echo date('d-M-Y',strtotime($value['submission_date'])); ?></td>
                          <td><?php echo $value['remarks']; ?></td>
                          <td>
							 <?php
							if($value['homework_date'] > '2020-04-09'){											  
							if($value['img'] != 'a:0:{}'){											  
							$imgData = unserialize($value['img']); 
							foreach($imgData as $key1 => $val1){
								?>
									<br /><span style='font-size:10px;'>FILE</span> <?php echo $key1 + 1; ?><a download href='<?php echo base_url($val1); ?>'> <i class="fa fa-download" style='color:red'></i></a>
								<?php
							}
							}
							}
						?>
							
						  </td>
                          <td>
                            <a class="btn-xs btn-black" onclick="viewHomework('<?php echo $value['id']; ?>')"><i class="fa fa-bars"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
          </div>
          </div>
      </div>
    <?php } ?>
    </div>


<!--View Homework Details Modal-->
<div class="modal fade" id="viewHomeworkModal" style="font-size: 12px;font-family: Verdana,Geneva,sans-serif;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Homework Details</h4>
      </div>
        <div class="modal-body" id="homeworkDetailsModalBody">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<br>

<script type="text/javascript">
     $(function () {
    $('.dataTable').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true,
    })
  });

     $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });

      $('.datepicker').datepicker({
         format: 'dd-M-yyyy',
         autoclose: true,
       });

      var section_id = '<?php echo set_value('section_id'); ?>';
      getSectionByClassId();
      function getSectionByClassId(){
        div_data = '<option value="">Select</option>';
        var class_id = $('#class_id').val();
        $.ajax({
          url:'<?php echo base_url('homework/homeworkreport/getSectionByClassId'); ?>',
          data:{class_id:class_id},
          method:"post",
          dataType:"json",
          success:function(response)
          {
            $.each(response, function (key, val) {
                var sel = "";
                if(section_id == val.section_no)
                {
                  sel = "selected";
                }
                div_data += '<option value="'+val.section_no+'"'+sel+'>'+val.secnm+'</option>';
            });
            $('#section_id').html(div_data);
            getSubject();
          }
        });
      }

      var subject_id = '<?php echo set_value('subject'); ?>';
      function getSubject(){
        div_data = '<option value="">Select</option>';
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();
        $.ajax({
          url:'<?php echo base_url('homework/homeworkreport/getSubject'); ?>',
          data:{cls:class_id,sec_id:section_id},
          method:"post",
          dataType:"json",
          success:function(response)
          {
            $.each(response, function (key, val) {
                var sel = "";
                if(subject_id == val.subject_code)
                {
                  sel = "selected";
                }
                div_data += '<option value="'+val.subject_code+'"'+sel+'>'+val.subjnm+'</option>';
            });
            $('#subject_id').html(div_data);
          }
        });
      }

      function viewHomework(id)
      {
        $.ajax({
          url:'<?php echo base_url('homework/homeworkreport/getHomeworkDetails'); ?>',
          data:{id:id},
          method:"post",
          success:function(response)
          {
            $('#homeworkDetailsModalBody').html(response);
            $('#viewHomeworkModal').modal({
              backdrop:"static",
              keyboard:false
            });
          }
        });        
      }
  </script>