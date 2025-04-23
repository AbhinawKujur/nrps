<style type="text/css">
  .thead-color{
    background: #c7b9b7 !important;
    color: black !important;
  }
</style>
<?php $session_year = schoolData['School_Session']; 
  $year = explode('-', $session_year);
  $start_year = $year[0];
  $end_year = $year[1];
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Student Attendance</a> <i class="fa fa-angle-right"></i> Attendance Percentage Report</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <div class="row">
      <div class="col-sm-12">
        <div class="" style="padding-bottom: 20px;">
          <section class="content">
              <div class="panel panel-default" style="background: #edecec !important;color: black;font-size: 13px;border: 1px solid #337ab7;">
                <div class="panel-heading" style="background: #337ab7;color: white;"><i class="fa fa-search"></i> Search Criteria</div>
                <div class="panel-body">
                  <form id="printForm" action="<?php echo base_url('student/report/attendancepercentagereport'); ?>" method="post">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Class :</label><span class="req"> *</span>
                          <select class="form-control" name="class_id" id="class_id" required="" onchange="getSectionByClassID()">
                            <option value="">Select</option>
                            <?php foreach ($classList as $key => $value) { ?>
                              <option value="<?php echo $value['Class_No']; ?>" <?php if(set_value('class_id')==$value['Class_No']){ echo "selected"; } ?>><?php echo $value['CLASS_NM']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Section :</label><span class="req"> *</span>
                          <select class="form-control" name="section_id" id="section_id" required="">
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Date From :</label><span class="req"> *</span>
                          <input type="text" name="date_from" class="form-control datepicker" value="<?php echo set_value('date_from',date('d-M-Y')); ?>" required="" id="date_from" onchange="dateFromChange()">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>Date Upto :</label><span class="req"> *</span>
                          <input type="text" name="date_to" class="form-control datepicker2" required="" id="date_to" value="<?php echo set_value('date_to',date('d-M-Y')); ?>">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label>.</label>
                          <button class="btn btn-black pull-right form-control" type="submit" name="search"> <i class="fa fa-search"></i> Search</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            <!-- /.box -->
          </section>
        </div>
      </div>

    <?php if(isset($resultList)): ?>
      <div class="col-sm-12">
        <div class="panel panel-default" style="background: #edecec !important;color: black;font-size: 13px;border: 1px solid #337ab7;">
          <div class="panel-heading" style="background: #337ab7;color: white;"><i class="fa fa-users"></i> Student Attendance Percentage Details</div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered datatable" style="border: 1px solid #b2b9c4;">
                <thead>
                  <tr>
                    <th class="thead-color text-center">SNo</th>
                    <th class="thead-color text-center">ADM NO</th>
                    <th class="thead-color text-center">Roll No</th>
                    <th class="thead-color">Name</th>
                    <th class="thead-color text-center">Working Days</th>
                    <th class="thead-color text-center">Present Days</th>
                    <th class="thead-color text-center">Percentage (%)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($resultList as $key => $value) {  ?>
                    <tr>
                      <td class="text-center"><?php echo $key+1; ?></td>
                      <td class="text-center"><?php echo $value['admno']; ?></td>
                      <td class="text-center"><?php echo $value['roll_no']; ?></td>
                      <td><?php echo $value['stu_name']; ?></td>
                      <td class="text-center"><?php echo $totalAttendance['total_attendance']; ?></td>
                      <td class="text-center"><?php echo $value['total_attendance']; ?></td>
                      <td class="text-center">
                      <?php 
                      if($totalAttendance['total_attendance'] == 0)
                      {
                        $total_percentage = 0;
                      }
                      else
                      {
                        $total_percentage = ($value['total_attendance']*100)/$totalAttendance['total_attendance'];
                      }
                      if($total_percentage < 75)
                      { ?>
                        <span style="color: red;font-weight: bold;">
                          <?php echo rtrim(rtrim(number_format($total_percentage,2), "0"),".");  ?>
                        </span>
                      <?php }else{ 
                        echo rtrim(rtrim(number_format($total_percentage,2), "0"),".");
                      } ?>
                      </td>
                      
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    </div>
  </div><br><br>

<script type="text/javascript">
  $('.select2').select2();
     //validation
$(document).ready(function () {

    $('#printForm').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

var st_date = '<?php echo $start_year.'-04-01'; ?>';
var end_dt = '<?php echo $end_year.'-'.'03-31'; ?>';
var startDate = new Date(st_date);
var endDate = new Date(end_dt);


$(".datepicker").datepicker({
 format: 'dd-M-yyyy',
    autoclose: true,
   startDate: startDate,
   endDate: endDate,
   orientation: "bottom",
});

function dateFromChange()
{
  var date_from = $('#date_from').val();
  $('#date_to').val(date_from);
  date_from = new Date(date_from);
  $(".datepicker2").datepicker('destroy').datepicker({
   format: 'dd-M-yyyy',
      autoclose: true,
     startDate: date_from,
     endDate: endDate,
     orientation: "bottom",
  });
}
  
  getSectionByClassID(1);
  function getSectionByClassID(autoload =null)
  {
    var class_id = $('#class_id').val();
    if(autoload == 1)
    {
      var section_id = '<?php echo set_value('section_id'); ?>';
    }
    else
    {
      var section_id = 0;
    }
    if(class_id != '')
    {
      $.ajax({
        url:'<?php echo base_url('student/report/attendancepercentagereport/getSectionByClassID'); ?>',
        data:{class_id:class_id},
        method:"post",
        dataType:"json",
        success:function(response)
        {
          var sel;
          var div_data = '<option value="">Select</option>';
          $.each(response, function( key, value ) {
          sel='';
            if(section_id == value.SEC)
            {
              sel = "selected";
            }
            div_data += '<option value="'+value.SEC+'"'+sel+'>'+value.DISP_SEC+'</option>';
          });
          $('#section_id').html(div_data);
        }
      });
    }
  }

  $('.datatable').dataTable( {
       "ordering": true,
       "bDestroy": true,
       "searching":true,
        "paging":false,
        dom: 'Bfrtip',
          buttons: [
              {
                extend: 'excelHtml5',
                title: 'Student Attendance Percentage',
                              
              },
              {
                extend: 'pdfHtml5',
                title: 'Student Attendance Percentage',
                              
              },
          ],
      });
</script>