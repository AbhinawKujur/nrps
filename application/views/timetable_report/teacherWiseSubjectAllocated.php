<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
  .thead-color{
    background: #337ab7 !important; color: white !important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Timetable Report</a> <i class="fa fa-angle-right"></i> Teacher Wise Class and Section With Subject Alloted</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;padding-top: 20px;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                  <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="box-header with-border">
                        <?php echo form_open('timetable_report/timetablereport/teacherWiseSubjectAllocation',array('class'=>'form-horizontal','id'=>'searchForm')); ?>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right" for="teacher_id">Choose Teacher</label>
                            <div class="col-sm-3">
                              <label>
                                <input type="radio" name="select_type" class="select_type" value="1" <?php if(set_value('select_type')==1){ echo "checked"; } ?>> Select All
                              </label>
                              <label>
                                <input type="radio" name="select_type" class="select_type" value="2" <?php if(set_value('select_type')==2){ echo "checked"; } ?>> Particular
                              </label>
                            </div>
                            <div class="col-sm-3 teacher_list_div">
                              <select class="form-control select2" name="teacher_id" id="teacher_id" required="">
                                <option value="">Select</option>
                                <?php foreach ($teacherList as $key => $value) { ?>
                                  <option value="<?php echo $value['EMPID']; ?>" <?php if(set_value('teacher_id')==$value['EMPID']){ echo "selected"; } ?>><?php echo $value['EMPID'].' - '. $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <button type="submit" class="btn btn-success" name="search"> Display</button>
                            </div>
                          </div>
                        <?php echo form_close(); ?>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if(isset($resultList)){ ?>
                      <div class="table-responsive">
                        <table class="table table-striped dataTable">
                          <thead>
                            <tr>
                              <th class="thead-color">S.No.</th>
                              <th class="thead-color">Teacher Name</th>
                              <th class="thead-color">Class Teacher</th>
                              <th class="thead-color">Total Bundle</th>
                              <th class="thead-color">Total Periods</th>
                              <th class="thead-color">Alloted Class</th>
                              <th class="thead-color">Subjects</th>
                              <th class="thead-color">Periods</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1; foreach ($resultList as $key => $value) {
                              $first =1;
                              foreach ($value['allocatedClass'] as $keys => $val) {
                             ?>
                            <?php if($val['Merged_WithSubCode'] != 0){ ?>
                              <tr style="background: red;">
                            <?php }else{ ?>
                              <tr>
                            <?php } ?>
                                <?php if($first ==1): ?>
                                  <td class="text-center"><?php echo $i++; ?></td>
                                  <td><?php echo strtoupper($value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']); ?></td>
                                  <td class="text-center"><?php echo $value['class_name'].' - '.$value['section_name']; ?></td>
                                  <td class="text-center"><?php echo $value['total_bundle'] ?></td>
                                  <td class="text-center"><?php echo $value['total_period'] ?></td>
                                <?php else: ?>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                <?php endif; ?>
                                <td class="text-center"><?php echo $val['Class_name_Roman'] ?></td>
                                <td class="text-center"><?php echo $val['subj_nm'] ?></td>
                                <td class="text-center"><?php echo $val['Total_Period_inWeek'] ?></td>
                              </tr>
                            <?php $first+=1; } } ?>
                          </tbody>
                        </table>
                      </div>
                    <?php } ?>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>

      </div>
    </div>
  </div>
</div><br><br>


  <script type="text/javascript">

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      dom: 'Bfrtip',
        buttons: [
      {
                extend: 'copyHtml5',
                title: 'Teacher Details With Alloted Period',
            },
      {
                extend: 'excelHtml5',
                title: 'Teacher Details With Alloted Period',
            },
      {
                extend: 'csvHtml5',
                title: 'Teacher Details With Alloted Period',
            },
      {
                extend: 'pdfHtml5',
                title: 'Teacher Details With Alloted Period',
            },
        ]
    })
  });

  $('.select2').select2();

  $('input[type=radio][name="select_type"]').change(function() {
    if (this.value == 1) {
        $('.teacher_list_div').hide();
    }
    else if(this.value == 2) {
        $('.teacher_list_div').show();
    }
});

  $(document).ready(function(){
    displayTeacherList();
  });
  function displayTeacherList()
  {
    var select_type = $('input[type=radio][name="select_type"]:checked').val();
    if(select_type == 2)
    {
      $('.teacher_list_div').show();
    }
    else
    {
      $('.teacher_list_div').hide();
    }
  }

       //validation
$(document).ready(function () {

    $('#searchForm').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});
  </script>