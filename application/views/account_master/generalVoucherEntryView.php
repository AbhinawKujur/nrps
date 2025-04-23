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

  .modal-header {
        background: linear-gradient(to right,#03709e,#18c3fd 100%);
        color: #fff;
        border-top-left-radius: 1px;
        border-top-right-radius: 1px;
    }

</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Voucher Entry</a> <i class="fa fa-angle-right"></i> Update Voucher</li>
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
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Update General Voucher <i class="fa fa-hand-o-down"></i>
                      </p><hr>
                  </div>
                  <hr>
                  <form method="post" action="<?php echo base_url('account_master/voucherentry/voucherView'); ?>">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-2 text-right">
                          <label>Voucher No : </label>
                        </div>
                        <div class="col-sm-6">
                          <select name="voucher_no" class="form-control select2">
                            <option value="">Select Voucher</option>
                            <?php foreach ($voucherList as $key => $value) { ?>
                              <option value="<?php echo $value['VNo']; ?>" <?php if(set_value('voucher_no')==$value['VNo']){ echo "selected"; } ?>><?php echo $value['VNo']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-sm-2 text-right">
                          <button name="search" class="btn btn-success" type="submit"><i class="fa fa-search"></i> Search</button>
                        </div>
                      </div>
                    </div><hr>
                  </form>
                  <?php if($this->session->flashdata('msg')){
                    echo $this->session->flashdata('msg');  
                    $voucher_no = $this->session->userdata('voucher_no'); ?> 
                  <a href="<?php echo base_url('account_master/voucherentryfee/printVoucher/'.$voucher_no); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate Receipt</a>
                  <?php } ?>
                  <!-- /.box-header -->
                <?php if(isset($resultList) && !empty($resultList)){ ?>
                  <form id="addForm">
                    <div class="box-body">
                      <div style="background: #e0d0ce;padding: 25px;">
                        <div class="row">
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Voucher No :</label><span class="req"> *</span>
                              <input type="text" name="voucher_no" class="form-control" autocomplete="off" required="" id="voucher_no" value="<?php echo $voucher_no; ?>" readonly="">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Date :</label><span class="req"> *</span>
                              <input type="text" name="date" class="form-control" autocomplete="off" required="" id="date" value="<?php echo date('d-M-Y',strtotime($date)); ?>" readonly="">
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>A/c Type :</label><span class="req"> *</span>
                              <select class="form-control" name="account_type" required="" id="account_type">
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
                                <option value="DR">DR</option>
                                <option value="CR">CR</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Account Head :</label><span class="req"> *</span>
                              <select class="form-control" name="account_head" required="" id="account_head">
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
                      <a class="btn btn-success pull-right savebtn" href="<?php echo base_url('account_master/voucherentry/updateVoucher/'.$voucher_no); ?>"> <i class="fa fa-save"></i> Save</a>
                      <?php if($this->session->flashdata('msg')){
                          echo $this->session->flashdata('msg');
                      } ?>
                      <br><br>
                      <table class="table table-bordered table-striped" id="example">
                        <thead style="background: #d2d6de;">
                          <tr>
                            <th class="thead-color">Account Head</th>
                            <th class="text-center thead-color">Dr. <span style="text-transform: capitalize;">(Rs.)</span></th>
                          <th class="text-center thead-color">Cr.  <span style="text-transform: capitalize;">(Rs.)</span></th>
                            <th class="thead-color">Narration</th>
                            <th class="thead-color">Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr style="background: #d9dadb;">
                            <td class="text-right"><b>Grand Total</b></td>
                            <td id="total_dr" class="text-right"></td>
                            <td id="total_cr" class="text-right"></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tfoot>
                      </table>    
                    </div>
                  </form>
                <?php } ?>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>

      </div>
    </div>
  </div>
</div><br><br>

<div id="unlockModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Unlock Update Voucher</h4>
      </div>
      <form action="<?php echo base_url('account_master/voucherentry/unlock'); ?>" method="post">
        <div class="modal-body">
          <?php if($this->session->flashdata('msg'))
          {
            echo $this->session->flashdata('msg');
          } ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <input type="password" name="password" placeholder="Enter password" autocomplete="off" class="form-control" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="<?php echo base_url(); ?>" class="btn btn-danger pull-left"><i class="fa fa-ban"></i> Close</a>
          <button type="submit" class="btn btn-success pull-right"><i class="fa fa-unlock"></i> Unlock</button>
        </div>
      </form>
    </div>

  </div>
</div>


  <script type="text/javascript">
getData();

 function getData()
 {
    //fetching data from advance_salary_history
    $('#example').dataTable( {
          "ajax":"<?= base_url('account_master/voucherentry/getTempVoucheratEdit'); ?>",
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
  
  $('.select2').select2();

function deleteRecord(id)
{
  if(confirm("Do you want to delete this record?"))
  {
    $.ajax({
        url: "<?php echo base_url('account_master/voucherentry/deleteTempVoucher'); ?>",
        data:{id:id},
        type: "POST",
        dataType: 'json',
        success: function(response){
          getData();
          checkCrequalsDr();
        }
      });
  }
}


var unlock = "<?php echo $this->session->userdata('unlockvoucherupdate'); ?>";

if(unlock == '')
{
  openUnlockModal();
}
  
  function openUnlockModal()
  {
    $('#unlockModal').modal({
        backdrop: 'static',
        keyboard: false
    });
  }

      </script>