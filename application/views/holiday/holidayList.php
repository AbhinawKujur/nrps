<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
  }
  .error{
    color: red;
   }
.loader {
  position: fixed;
  top: 50%;
  left: 50%;
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">General Setting </a> <i class="fa fa-angle-right"></i> Holiday Master</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <a href="#" class="btn btn-black" onclick="addHoliday()"><i class="fa fa-plus"></i> Add Holiday</a><br><br>
                    <table class="table table-bordered dataTable">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">Name</th>
                          <th style="background: #337ab7; color: white !important;">From Date</th>
                          <th style="background: #337ab7; color: white !important;">To Date</th>
                          <th style="background: #337ab7; color: white !important;">Applied For</th>
                          <th style="background: #337ab7; color: white !important;">Class</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($holidayList as $key => $value) { ?>
                          <tr>
                            <td><?php echo $value['NAME']; ?></td>
                            <td><?php echo date("d-M-Y", strtotime($value['FROM_DATE'])); ?></td>
                            <td><?php echo date("d-M-Y", strtotime($value['TO_DATE'])); ?></td>
                            <td><?php if($value['APPLIED_FOR'] == 1)
                            {
                              echo "EMPLOYEE";
                            }elseif ($value['APPLIED_FOR'] == 2) {
                              echo "STUDENT";
                            }else{
                              echo "ALL";
                            } ?></td>
                            <td><?php echo $value['class_name']; ?></td>
                            <td><a href="#" class="btn-xs btn-black" onclick="editHoliday('<?php echo $value['ID']; ?>')"><i class="fa fa-edit"></i> Edit</a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>    
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>

<div class="modal fade" id="addHolidayModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Holiday Creation</h4>
      </div>
      <form id="addHolidayForm" class="form-horizontal">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-sm-3">Holiday Name:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" autocomplete="off" style="text-transform: uppercase;">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">Day Type</label>

            <div class="col-sm-4"> 
              <input type="radio" name="day_type" id="single_day" class="flat-red day_type" checked="" value="1"> <label for="single_day">Single Day</label>
            </div>
            <div class="col-sm-5">
               <input type="radio" name="day_type" id="multiple_day" class="flat-red day_type" value="2"> <label for="multiple_day">Multiple Day</label>
            </div>
          </div>
          <div class="single_date">
            <div class="form-group">
              <label class="control-label col-sm-3">Date :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control datepicker" id="" readonly="" name="date">
              </div>
            </div>
          </div>
          <div class="multiple_date" style="display: none;">
            <div class="form-group">
              <label class="control-label col-sm-3">Date From :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control datepicker" id="" readonly="" name="from_date">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Date To :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control datepicker" id="" readonly="" name="to_date">
              </div>
            </div>
          </div>
          <div>
            <div class="form-group">
              <label class="control-label col-sm-3">Applied For :</label>
              <div class="col-sm-9">
                <select class="form-control" name="applied_for" id="applied_for" onchange="appliedFor()">
                  <option value="">Select Applied For</option>
                  <option value="1">Employee</option>
                  <option value="2">Student</option>
                  <option value="0">All</option>
                </select>
              </div>
            </div>
          </div>
          <div id="class_area" style="display: none;">
            <div class="form-group">
              <label class="control-label col-sm-3">Class :</label>
              <div class="col-sm-9">
                <select class="form-control" name="class" id="class_name">
                  <option value="0">All Classes</option>
                  <?php foreach ($classList as $key => $value) { ?>
                    <option value="<?php echo $value['Class_No']; ?>"><?php echo $value['CLASS_NM']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="save_btn">Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Edit Modal-->
<div class="modal fade" id="editHolidayModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Holiday Updation</h4>
      </div>
      <form id="editHolidayForm" class="form-horizontal">
        <div class="modal-body">
          <input type="hidden" name="id" id="ID">
          <div class="form-group">
            <label class="control-label col-sm-3">Holiday Name:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" id="name" autocomplete="off" style="text-transform: uppercase;">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">Day Type</label>

            <div class="col-sm-4"> 
              <input type="radio" name="day_type" id="edit_single_day" class="flat-red day_type" value="1"> <label for="edit_single_day">Single Day</label>
            </div>
            <div class="col-sm-5">
               <input type="radio" name="day_type" id="edit_multiple_day" class="flat-red day_type" value="2"> <label for="edit_multiple_day">Multiple Day</label>
            </div>
          </div>
          <div class="single_date">
            <div class="form-group">
              <label class="control-label col-sm-3">Date :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control datepicker" id="editDate" readonly="" name="date">
              </div>
            </div>
          </div>
          <div class="multiple_date">
            <div class="form-group">
              <label class="control-label col-sm-3">Date From :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control datepicker" id="editFromDate" readonly="" name="from_date" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Date To :</label>
              <div class="col-sm-9">
                <input type="text" class="form-control datepicker" id="editToDate" readonly="" name="to_date">
              </div>
            </div>
          </div>
          <div>
            <div class="form-group">
              <label class="control-label col-sm-3">Applied For :</label>
              <div class="col-sm-9">
                <select class="form-control" name="applied_for" id="edit_applied_for" onchange="editAppliedFor()">
                  <option value="">Select Applied For</option>
                  <option value="1">Employee</option>
                  <option value="2">Student</option>
                  <option value="0">All</option>
                </select>
              </div>
            </div>
          </div>
          <div id="edit_class_area" style="display: none;">
            <div class="form-group">
              <label class="control-label col-sm-3">Class :</label>
              <div class="col-sm-9">
                <select class="form-control" name="class" id="edit_class_name">
                  <option value="0">All Classes</option>
                  <?php foreach ($classList as $key => $value) { ?>
                    <option value="<?php echo $value['Class_No']; ?>"><?php echo $value['CLASS_NM']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="update_btn">Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="loader"></div>
 <script type="text/javascript">
$('.loader').hide();

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });

      //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

     //Date picker
    $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
    });


//disable field on yes or no option
$('.day_type').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $('.single_date').show(1000);
      $('.multiple_date').hide(1000);
    }
    else
    {
      $('.single_date').hide(1000);
      $('.multiple_date').show(1000);
    }
});

function addHoliday()
{
  $('#addHolidayModal').modal({
    backdrop: 'static',
    keyboard: false
  });
}

function editHoliday(id)
{
  $('#ID').val(id);
  $.ajax({
      url: "<?php echo base_url('holiday/getSingeHoliday'); ?>",
      type: "POST",
      data: {id:id},
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        $('#editHolidayModal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $('#name').val(response.NAME);
        if(response.DAY_TYPE == 1)
        {
          $('.single_date').show(1000);
          $('.multiple_date').hide(1000);
          $('#edit_single_day').iCheck('check');
          $('#edit_multiple_day').iCheck('uncheck');
        }
        else
        {
          $('.single_date').hide(1000);
          $('.multiple_date').show(1000);
          $('#edit_multiple_day').iCheck('check');
          $('#edit_single_day').iCheck('uncheck');
        }
        $('#editDate').val(response.FROM_DATE);
        $('#editFromDate').val(response.FROM_DATE);
        $('#editToDate').val(response.TO_DATE);
        $('#edit_applied_for').val(response.APPLIED_FOR);
        $('#edit_class_name').val(response.CLASS_ID);
        editAppliedFor();
      }
    });
}

//validation
$(document).ready(function () {
    $('#addHolidayForm').validate({ // initialize the plugin
        rules: {
            name: {
                required: true
            },
            date:{
              required: true
            },
            from_date:{
              required: true
            },
            to_date:{
              required: true
            },
            applied_for:{
              required: true
            },
            class:{
              required: true
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

//validation at the time of editing
$(document).ready(function () {
    $('#editHolidayForm').validate({ // initialize the plugin
        rules: {
            name: {
                required: true
            },
            date:{
              required: true
            },
            from_date:{
              required: true
            },
            to_date:{
              required: true
            },
            applied_for:{
              required: true
            },
            class:{
              required: true
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});


//validation of regex
$.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "It accept digits and point only"
);

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

//creating new shift
 $("#save_btn").on("click", function(event){
  $("#addHolidayForm").validate();
  if ($('#addHolidayForm').valid())
  {
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('holiday/create'); ?>",
      type: "POST",
      data: $("#addHolidayForm").serialize(),
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.msg == 1)
        {
          $('#addHolidayForm')[0].reset();
          $('#addHolidayModal').modal('hide');
          swal({title: "Created Successfully", text: "Created Successfully", type: "success"},
             function(){ 
                 location.reload();
             }
          );          
        }
        else
        {
          swal({title: "Creation Failed!", text: "Creation Failed!", type: "error"});
        }
      }
    });
   }
});


  //updating shift data
 $("#update_btn").on("click", function(event){
  $("#editHolidayForm").validate();
  if ($('#editHolidayForm').valid())
  {
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('holiday/update'); ?>",
      type: "POST",
      data: $("#editHolidayForm").serialize(),
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.msg == 1)
        {
          $('#editHolidayForm')[0].reset();
          $('#editHolidayModal').modal('hide');
          swal({title: "Updated Successfully", text: "Updated Successfully", type: "success"},
             function(){ 
                 location.reload();
             }
          );          
        }
        else
        {
          swal({title: "Updation Failed", text: "Updation Failed", type: "error"});    
        }
      }
    });
   }
});

 function appliedFor()
 {
    var applied_for = $('#applied_for').val();
    if(applied_for == 0 || applied_for == 1)
    {
      $('#class_area').hide();
    }
    else
    {
      $('#class_area').show();
    }
 }


 function editAppliedFor()
 {
    var applied_for = $('#edit_applied_for').val();
    if(applied_for == 0 || applied_for == 1)
    {
      $('#edit_class_area').hide();
    }
    else
    {
      $('#edit_class_area').show();
    }
 }
  </script>