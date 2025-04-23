<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
  }
  .thead-color
  {
    background: #d9dadb !important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Voucher Entry</a> <i class="fa fa-angle-right"></i> Print Voucher </li>
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
                <form id="printForm" action="<?php echo base_url('account_master/printvoucher/printVoucher'); ?>" method="post" target="_blank">
                  <div class="box-body">
                    <div style="background: #e0d0ce;padding: 25px;">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Voucher Type :</label><span class="req"> *</span>
                            <select class="form-control" name="voucher_type" id="voucher_type" required="" onchange="getVoucherNo()" onclick="getVoucherNo()">
                              <option value="">Select Voucher Type</option>
                              <option value="1">Payment Voucher</option>
                              <option value="2">Receipt Voucher</option>
                              <option value="3">Journal Voucher</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Voucher No :</label><span class="req"> *</span>
                            <select class="form-control select2" name="voucher_no" id="voucher_no" required="">
                              
                            </select>
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


function getVoucherNo()
{
  var voucher_type = $('#voucher_type').val();
  if(voucher_type != '')
  {
    $.ajax({
      url:'<?php echo base_url('account_master/printvoucher/getVoucherNo'); ?>',
      method:"post",
      data:{voucher_type:voucher_type},
      dataType:"json",
      success:function(response)
      {
        var div_data = '<option value="">Select</option>';
        $.each(response, function (key, val) {
            div_data += '<option value="'+val['VNo']+'">'+val['VNo']+'</option>';
        });
        $('#voucher_no').html(div_data);
      }
    });
  }
}
  
</script>