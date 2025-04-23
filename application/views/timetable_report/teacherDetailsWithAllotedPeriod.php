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
    <li class="breadcrumb-item"><a href="#">Timetable Report</a> <i class="fa fa-angle-right"></i> Teacher Details With Alloted Period</li>
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
                    <div class="col-sm-6">
                      <div class="box-header with-border">
                        <?php echo form_open('timetable_report/timetablereport/teacherDetailsAllotedPeriod',array('class'=>'form-horizontal')); ?>
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right" for="order_by_id" style="padding: 7px 0px;">ORDER BY</label>
                            <div class="col-sm-6">
                              <select class="form-control" name="order_by" id="order_by_id">
                                <option value="1" <?php if(set_value('order_by')==1){ echo "selected"; } ?>>Teacher Name</option>
                                <option value="2" <?php if(set_value('order_by')==2){ echo "selected"; } ?>>Class Teacher Wise</option>
                              </select>
                            </div>
                            <button type="submit" class="col-sm-3 btn btn-success" name="search"><i class="fa fa-eye"></i> Display</button>
                          </div>
                        <?php echo form_close(); ?>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if(isset($result)){ ?>
                      <table class="table table-striped dataTable">
                        <thead>
                          <tr>
                            <th class="thead-color">S.No.</th>
                            <th class="thead-color">Teacher Name</th>
                            <th class="thead-color text-center">Class Teacher</th>
                            <th class="thead-color text-center">Total Bundle</th>
                            <th class="thead-color text-center">Total Periods</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; foreach ($result as $key => $value) { ?>
                            <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $value['name'] ?></td>
                              <td class="text-center"><?php echo $value['class_section'] ?></td>
                              <td class="text-center"><?php echo $value['Bundle_Count'] ?></td>
                              <td class="text-center"><?php echo $value['total_period'] ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
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
      'ordering'    : true,
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
  </script>