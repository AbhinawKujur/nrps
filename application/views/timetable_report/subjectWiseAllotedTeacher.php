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
    <li class="breadcrumb-item"><a href="#">Timetable Report</a> <i class="fa fa-angle-right"></i> Subject Wise Alloted Teacher</li>
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
                        <?php echo form_open('timetable_report/timetablereport/subjectWiseAllocatedTeacher',array('class'=>'form-horizontal','id'=>'searchForm')); ?>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right" for="teacher_id">Choose Subject</label>
                            <div class="col-sm-2">
                              <label>
                                <input type="radio" name="select_type" class="select_type" value="1" <?php if(set_value('select_type')==1){ echo "checked"; } ?>> Select All
                              </label>
                              <label>
                                <input type="radio" name="select_type" class="select_type" value="2" <?php if(set_value('select_type')==2){ echo "checked"; } ?>> Particular
                              </label>
                            </div>
                            <div class="col-sm-3 subject_list_div">
                              <select class="form-control select2" name="subject_id" id="subject_id" required="">
                                <option value="">Select</option>
                                <?php foreach ($subjectList as $key => $value) { ?>
                                  <option value="<?php echo $value['subject_code']; ?>" <?php if(set_value('teacher_id')==$value['subject_code']){ echo "selected"; } ?>><?php echo $value['subj_nm']; ?></option>
                                <?php } ?>
                              </select>
                            </div>

                             <div class="col-sm-3">
                              <select class="form-control" name="teacher_type" id="teacher_type" required="">
                                <option value="1" <?php if(set_value('teacher_type')==1){ echo "selected"; } ?>>Main Teacher</option>
                                <option value="2" <?php if(set_value('teacher_type')==2){ echo "selected"; } ?>>Support Teacher</option>
                              </select>
                            </div>

                            <div class="col-sm-2">
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
                              <th class="thead-color text-center">S.No.</th>
                              <th class="thead-color">Subject</th>
                              <th class="thead-color text-center">Class</th>
                              <?php foreach ($sectionList as $key => $value) { ?>
                                <th class="thead-color text-center"><?php echo $value['SECTION_NAME'] ?></th>
                              <?php } ?>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1; 
                            foreach ($resultList as $key => $value) {
                              foreach ($value as $keys => $val) {
                             ?>
                              <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo strtoupper($val['subject']); ?></td>
                                <td class="text-center"><?php echo $val['class_name']; ?></td>
                                <?php foreach ($val['teachers'] as $key2 => $val2) { ?>
                                  <td class="text-center"><?php echo $val2['name'] ?></td>
                                <?php } ?>
                              </tr>
                            <?php }} ?>
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
        $('.subject_list_div').hide();
    }
    else if(this.value == 2) {
        $('.subject_list_div').show();
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
      $('.subject_list_div').show();
    }
    else
    {
      $('.subject_list_div').hide();
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