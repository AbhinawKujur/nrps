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
  z-index: 999;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@media print {
  .hide-print {
    display: none;
  }
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">My Desk</a> <i class="fa fa-angle-right"></i> Apply Manual Leave</li>
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
                    <?php if($this->session->flashdata('msg')){
                      echo $this->session->flashdata('msg');
                    } ?>
                    <a href="#" class="btn btn-black" onclick="addApplyLeave()"><i class="fa fa-plus"></i> Apply Manual Leave</a>
                    
                    <hr>
                    <div  id="printableArea">
                      <div class="table-responsive">
                        <table class="table table-bordered dataTable">
                          <thead style="background: #d2d6de;">
                            <tr>
                              <th style="background: #337ab7 !important; color: white !important;">EMP ID</th>
                              <th style="background: #337ab7 !important; color: white !important;">Apply Date</th>
                              <th style="background: #337ab7 !important; color: white !important;">Leave Type</th>
                              <th style="background: #337ab7 !important; color: white !important;">Date (From - To)</th>
                              <th style="background: #337ab7 !important; color: white !important;">Against Date (From - To)</th>
                              <th style="background: #337ab7 !important; color: white !important;">Total Days</th>
                              <th style="background: #337ab7 !important; color: white !important;">Leave Reason</th>
                              <th style="background: #337ab7 !important; color: white !important;">Reason Details</th>
                              <th style="background: #337ab7 !important; color: white !important;">Status</th>
                              <th style="background: #337ab7 !important; color: white !important;">Document</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($leaveRequestList as $key => $value) { ?>
                              <tr>
                                <td><?php echo $value['EMPLOYEE_ID']; ?></td>
                                <td><?php echo date('d-M-Y',strtotime($value['APPLY_DATE'])); ?></td>
                                <td><?php echo $leaveTypeList[$value['LEAVE_TYPE']]; ?></td>
                                <td><?php echo date('d-M-Y',strtotime($value['DATE_FROM'])).' - ' .date('d-M-Y',strtotime($value['DATE_TO'])); ?></td>
                                <td>
                                  <?php 
                                  if($value['AGAINST_DATE_FROM'] != '0000-00-00' || $value['AGAINST_DATE_FROM'] != '')
                                  {
                                    echo date('d-M-Y',strtotime($value['AGAINST_DATE_FROM'])).' - ' .date('d-M-Y',strtotime($value['AGAINST_DATE_TO'])); 

                                  } ?>    
                                </td>
                                <td><?php echo $value['TOTAL_DAYS']; ?></td>
                                <td><?php echo $leaveReasonList[$value['REASON']]; ?></td>
                                <td><?php echo $value['REASON_DETAILS']; ?></td>
                                <td><?php if($value['STATUS'] == 0)
                                {
                                  echo "<label class='label label-warning'>Pending</label>";
                                }elseif($value['STATUS'] == 1)
                                {
                                  echo "<label class='label label-success'>Approved</label>";
                                }
                                else
                                {
                                  echo "<label class='label label-danger'>Disapproved</label>";
                                } ?></td>
                                <td><?php if($value['DOCUMENT'] != '')
                                {
                                  echo "<a href='".base_url($value['DOCUMENT'])."'>Your Document Here</a>";
                                } ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>   
                      </div> 
                    </div>
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

<div class="modal fade" id="addApplyLeaveModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Apply Leave</h4>
      </div>
      <form id="addApplyLeaveForm" method="post" action="<?php echo base_url('leave/applyleave/create'); ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Employee</label><span class="req"> *</span>
                <select class="form-control select2" name="emp_id" style="width: 100%;" id="emp_id" onchange="refreshFun()">
                  <option value="">Select Employee</option>
                <?php foreach ($employeeDetails as $key => $value) { ?>
                  <option value="<?php echo $value['EMPID']; ?>"><?php echo $value['EMPID'].' '.$value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></option>
                <?php } ?>
              </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Apply Date</label><span class="req"> *</span>
                <input type="text" class="form-control datepicker" id="" value="<?php echo date('d-M-Y'); ?>" name="apply_date" autocomplete="off">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Leave Type</label><span class="req"> *</span>
                <select class="form-control" name="leave_type" id="leave_type" onchange="getTotalRestLeave()">
                  <option value="">Select Leave Type</option>
                  <?php foreach ($leaveTypeList as $key => $value) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="total_rest_leave_row" style="display: none;">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Total Balance Leave</label><span class="req"> *</span>
                <input type="text" class="form-control" id="total_rest_leave" readonly="" value="0">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Date (From - To) (mm/dd/yyyy)</label><span class="req"> *</span>
                <input type="text" class="form-control mutlidatepicker" name="leave_date" value="" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row against_date_row" style="display: none;" >
            <div class="col-sm-12">
              <div class="form-group">
                <label>Against Date (From - To) (mm/dd/yyyy)</label><span class="req"> *</span>
                <input type="text" class="form-control mutlidatepicker" name="against_date" value="" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Leave Reason </label><span class="req"> *</span>
                <select class="form-control" name="leave_reason" id="leave_reason" onchange="showOtherReason()">
                  <option value="">Select Leave Reason</option>
                  <?php foreach ($leaveReasonList as $key => $value) { ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="leave_reason_details" style="display: none;">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Reason Details</label><span class="req"> *</span>
                <textarea class="form-control" name="reason_details"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Document (If Available)</label>
                <input type="file" class="form-control" name="document" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="save_btn"><i class="fa fa-paper-plane-o"></i> Send For Approval</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
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
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true,
    })
  });


     //Date picker
    $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
      todayHighlight: true,
    });



function addApplyLeave()
{
  $('#addApplyLeaveModal').modal({
    backdrop: 'static',
    keyboard: false
  });
}


//validation
$(document).ready(function () {
    $('#addApplyLeaveForm').validate({ // initialize the plugin
        rules: {
            apply_date: {
                required: true
            },
            leave_type:{
              required: true,
            },
            leave_reason:{
              required: true,
            },
            reason_details:{
              required: true
            },
            leave_date:{
              required: true
            },
            against_date:{
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


$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});


 $('.select2').select2();

 function showOtherReason()
 {
    var leave_reason = $('#leave_reason').val();
    if(leave_reason == 7)
    {
      $('#leave_reason_details').show(1000);
    }
    else
    {
      $('#leave_reason_details').hide(1000);
    }
 }

 function getTotalRestLeave()
 {
    var leave_type = $('#leave_type').val();
    var emp_id = $('#emp_id').val();
    $('#save_btn').prop('disabled',false);
     $('.against_date_row').hide(1000);
    $('#leave_reason').val('');
    
    if(emp_id != '')
    {
      if(leave_type == 5)
      {
         $('#total_rest_leave_row').hide(1000);
         $('.against_date_row').show(1000);
         $('.mutlidatepicker').daterangepicker();
         $('#leave_reason').val(6);
      }
      else if(leave_type == 4)
      {
        $('#total_rest_leave_row').hide(1000);
         $('.mutlidatepicker').daterangepicker();
      }
      else
      {
        $.ajax({
            url: "<?php echo base_url('leave/applyleave/getTotalLeave'); ?>",
            data: {leave_type:leave_type,emp_id:emp_id},
            type: "POST",
            dataType: 'json',
            beforeSend:function()
            {
              $('.loader').show();
              $('body').css('opacity', '0.5');
            },
            success: function (result) {
              $('.loader').hide();
              $('body').css('opacity', '1.0');
              $('#total_rest_leave_row').show(1000);
              $('#total_rest_leave').val(result);
              if(result > 0)
              {
                 $('.mutlidatepicker').daterangepicker({
                  dateLimit: {
                        'days': Number(result)-1
                    }
                });
              }
              else
              {
                $('#formid').on('keyup keypress', function(e) {
                    var keyCode = e.keyCode || e.which;
                    if (keyCode === 13) { 
                      e.preventDefault();
                      return false;
                    }
                  });
                $('#save_btn').prop('disabled',true);
              }
            }
        });
      }
    }
    else
    {
      alert("Please Select Employee First");
      $('#leave_type').val('');
    }
 }

 function refreshFun()
 {
    $('#total_rest_leave_row').hide(1000);
    $('#leave_type').val('');
 }

  </script>