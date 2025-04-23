<style type="text/css">
  .modal-header {
        background: linear-gradient(to right,#03709e,#18c3fd 100%);
        color: #fff;
        border-top-left-radius: 1px;
        border-top-right-radius: 1px;
    }

</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Voucher Entry</a> <i class="fa fa-angle-right"></i> Cancel Voucher</li>
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
                <form id="printForm" method="post" action="<?php echo base_url('account_master/cancelvoucher/cancelVoucher'); ?>">
                  <div class="box-body">
                    <?php if($this->session->flashdata('cancelmsg'))
                      {
                        echo $this->session->flashdata('cancelmsg');
                      } ?>
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
                    <button class="btn btn-danger pull-right" type="submit"> <i class="fa fa-ban"></i> Cancel Voucher</button>
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

<div id="unlockModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Unlock Cancel Voucher</h4>
      </div>
      <form action="<?php echo base_url('account_master/cancelvoucher/unlock'); ?>" method="post">
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

var unlock = "<?php echo $this->session->userdata('unlockcancelvoucher'); ?>";

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