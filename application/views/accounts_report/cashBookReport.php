<?php $session_year = schoolData['School_Session']; 
  $year = explode('-', $session_year);
  $start_year = $year[0];
  $end_year = $year[1];
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Accounts Report</a> <i class="fa fa-angle-right"></i> Cash Book Report </li>
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
                  <form id="printForm" action="<?php echo base_url('accounts_report/cashbookreport/printCashBookReport'); ?>" method="post" target="_blank">
                    <div class="box-body">
                      <div style="background: #e0d0ce;padding: 25px;">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Account Type :</label><span class="req"> *</span>
                              <select class="form-control" name="account_type" id="account_type" required="">
                                <?php foreach ($accountTypeList as $key => $value) { ?>
                                  <option value="<?php echo $value['CAT_CODE']; ?>"><?php echo $value['CAT_ABBR']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Date From :</label><span class="req"> *</span>
                              <input type="text" name="date_from" class="form-control datepicker" value="<?php echo set_value('date_from','01-Apr-'.$start_year); ?>" required="" id="date_from" onchange="dateFromChange()">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Date Upto :</label><span class="req"> *</span>
                              <input type="text" name="date_to" class="form-control datepicker2" required="" id="date_to">
                            </div>
                          </div>
                        </div>
                      </div><br>
                      <button class="btn btn-success pull-right" type="submit"> <i class="fa fa-print"></i> Print</button>
                     
                    </div>
                  </form>
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

dateFromChange();
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

  
</script>