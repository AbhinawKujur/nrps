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
    background: #337ab7 !important;
    color: white !important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Voucher Entry</a> <i class="fa fa-angle-right"></i> General Entry </li>
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
                <form id="addForm">
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){
                        echo $this->session->flashdata('msg');  
                        $voucher_no = $this->session->userdata('voucher_no'); ?> 
                      <a href="<?php echo base_url('account_master/voucherentryfee/printVoucher/'.$voucher_no); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate Receipt</a>
                      <?php } ?>
                    <div style="background: #e0d0ce;padding: 25px;">
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Voucher Type :</label><span class="req"> *</span>
                            <select class="form-control" name="voucher_type" id="voucher_type" required="">
                              <option value="">Select Voucher Type</option>
                              <option value="1">Payment Voucher</option>
                              <option value="2">Receipt Voucher</option>
                              <option value="3">Journal Voucher</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Voucher No :</label><span class="req"> *</span>
                            <input type="text" name="voucher_no" class="form-control" autocomplete="off" required="" id="voucher_no" value="<?php echo $maxvocherno['max_vno']+1; ?>">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Date :</label><span class="req"> *</span>
                            <input type="text" name="date" class="form-control datepicker" autocomplete="off" required="" id="date">
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-group">
                            <label>A/c Type :</label><span class="req"> *</span>
                            <select class="form-control select2" name="account_type" required="" id="account_type">
                              <option value="">Select</option>
                              <?php foreach ($accountTypeList as $key => $value) { ?>
                                <option value="<?php echo $value['CAT_CODE']; ?>"><?php echo $value['CAT_ABBR']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Dr/Cr :</label><span class="req"> *</span>
                            <select class="form-control" name="drcr" required="">
                              <option value="DR">Dr</option>
                              <option value="CR">Cr</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Account Head :</label><span class="req"> *</span>
                            <select class="form-control select2" name="account_head" required="" id="account_head">
                              <option value="">Select</option>
                              <?php foreach ($ledgerList as $key => $value) { ?>
                                <option value="<?php echo $value['AcNo']; ?>"><?php echo $value['CCode']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Amount :</label><span class="req"> *</span>
                            <input type="number" name="amount" class="form-control" autocomplete="off" required="" style="text-align: right;" id="amount">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Narration :</label><span class="req"> *</span>
                            <input list="narration" name="narration" class="form-control">
                            <datalist id="narration">
                              <?php foreach ($narrationList as $key => $value) { ?>
                                <option value="<?php echo $value['Act']; ?>">
                              <?php } ?>
                            </datalist>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <button class="btn btn-danger pull-right" type="button" onclick="addVoucher()"><i class="fa fa-plus"></i> Add</button>
                        </div>
                      </div>
                    </div><br>
                    <a class="btn btn-success pull-right savebtn" href="<?php echo base_url('account_master/voucherentry/saveVoucher'); ?>"> <i class="fa fa-save"></i> Save</a>
                   
                    <br><br>
                    <table class="table table-bordered table-striped" id="example">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th class="thead-color">Account Head</th>
                          <th class="text-center thead-color"><span style="text-transform: capitalize;">Dr. (Rs.)</span></th>
                          <th class="text-center thead-color"><span style="text-transform: capitalize;"> Cr. (Rs.)</span></th>
                          <th class="thead-color">Narration</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr style="background: #d9dadb;">
                          <td class="text-right thead-color"><b>Grand Total</b></td>
                          <td id="total_dr" class="text-right thead-color"></td>
                          <td id="total_cr" class="text-right thead-color"></td>
                          <td class="thead-color"></td>
                        </tr>
                      </tfoot>
                    </table>    
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
getData();

 function getData()
 {
    //fetching data from advance_salary_history
    $('#example').dataTable( {
          "ajax":"<?= base_url('account_master/voucherentry/getTempVoucher'); ?>",
          'order':[],
           "ordering": false,
           "bDestroy": true,
           "searching":false,
            "paging":false,
      });

}


     //validation
$(document).ready(function () {

    $('#addForm').validate({ // initialize the plugin
      rules: {
            voucher_no: {
                remote: {
                url: '<?php echo base_url('account_master/voucherentry/checkVoucherNo'); ?>',
                type: "post",
                data: {
                  voucher_no: function() {
                    return $( "#voucher_no" ).val();
                  }
                }
              },
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});
checkCrequalsDr();
function checkCrequalsDr()
{
  $.ajax({
      url: "<?php echo base_url('account_master/voucherentry/checkCRequalsDR'); ?>",
      type: "POST",
      dataType: 'json',
      success: function(response){
        $('#total_cr').html(response.cr.toFixed(2));
        $('#total_dr').html(response.dr.toFixed(2));
        if((response.cr == response.dr) && response.cr >0)
        {
          $('.savebtn').show();
        }
        else
        {
           $('.savebtn').hide();
        }
      }
    });
}


function addVoucher()
{
  $('#addForm').validate();
  if($('#addForm').valid())
  {
    $.ajax({
        url: "<?php echo base_url('account_master/voucherentry/createtempvoucher'); ?>",
        type: "POST",
        data: $('#addForm').serialize(),
        dataType: 'json',
         beforeSend:function()
          {
            $('.loader').show();
            $('body').css('opacity', '0.5');
          },
        success: function(response){
          $('.loader').hide();
          $('body').css('opacity', '1.0');
          getData();
          checkCrequalsDr();
          $('#voucher_no').attr('readonly','');
          $('#date').attr('readonly','');
          $('#account_type').attr('readonly','');
          $('#voucher_type').attr('readonly','');
          $('#account_head').val('');
          $('#amount').val('');
          $('#narration').val('');
        }
      });
  }
}

//Date picker
    $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
    });
         

      </script>