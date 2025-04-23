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
    <li class="breadcrumb-item"><a href="#">Voucher Entry</a> <i class="fa fa-angle-right"></i> Receipt Voucher (Counter Collection) </li>
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
                <form id="addForm">
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){
                        echo $this->session->flashdata('msg');  
                        $voucher_no = $this->session->userdata('voucher_no'); ?> 
                      <a href="<?php echo base_url('account_master/voucherentryfee/printVoucher/'.$voucher_no); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate Receipt</a>
                      <?php } ?>
                    <div style="background: #e0d0ce;padding: 25px;">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Voucher No :</label><span class="req"> *</span>
                            <input type="text" name="voucher_no" class="form-control" autocomplete="off" required="" id="voucher_no" value="<?php echo $maxvocherno['max_vno']+1; ?>">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Date :</label><span class="req"> *</span>
                            <input type="text" name="date" class="form-control datepicker" autocomplete="off" required="" id="date" onchange="getCollectionMode()">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Collection Mode :</label><span class="req"> *</span>
                            <select class="form-control select2" name="collection_mode" required="" id="collection_mode" multiple="">
                              
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>.</label>
                            <button type="button" onclick="getFeeData()" class="btn btn-black form-control" id="getdata"><i class="fa fa-search"></i> Get</button>
                          </div>
                        </div>
                        <!-- <div class="col-sm-3">
                          <div class="form-group">
                            <label>A/c Type :</label><span class="req"> *</span>
                            <select class="form-control select2" name="account_type" required="" id="account_type">
                              <option value="">Select</option>
                              <?php foreach ($accountTypeList as $key => $value) { ?>
                                <option value="<?php echo $value['CAT_CODE']; ?>"><?php echo $value['CAT_ABBR']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div> -->
                      </div>
                      <div class="row voucheradd" style="display: none;">
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
                            <input type="number" name="amount" class="form-control" autocomplete="off" required="" style="text-align: right;" id="amount" min="0">
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
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>.</label>
                            <button class="btn btn-danger form-control" type="button" onclick="addVoucher()"><i class="fa fa-plus"></i> Add</button>
                          </div>
                        </div>
                      </div>
                    </div><br>
                    <a class="btn btn-success pull-right savebtn"> <i class="fa fa-save"></i> Save</a>
                    
                    <br><br>
                    <table class="table table-bordered table-striped" id="example">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th class="thead-color">Account Head</th>
                          <th class="text-center thead-color"><span style="text-transform: capitalize;">Dr. (Rs.)</span></th>
                          <th class="text-center thead-color"><span style="text-transform: capitalize;">Cr. (Rs.)</span></th>
                          <th class="thead-color">Narration</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
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
    $('.select2').select2();
getData();

 function getData()
 {
    //fetching data from advance_salary_history
    $('#example').dataTable( {
          "ajax":"<?= base_url('account_master/voucherentry/getTempVoucher'); ?>",
          'order':[],
           "ordering": true,
           "bDestroy": true,
           "searching":false,
            "paging":false,
      });
    checkCrequalsDr();
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
        var max_dr = Number(response.cr) - Number(response.dr);
        $('#amount').attr('max',max_dr);
        $('#amount').val(max_dr);
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
        url: "<?php echo base_url('account_master/voucherentryfee/createtempvoucher'); ?>",
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
          $('#account_head').val('');
          $('#amount').val('');
          $('#narration').val('');
        }
      });
  }
}

function getFeeData()
{
    var date = $('#date').val();
    var voucher_no = $('#voucher_no').val();
    var collection_mode = $('#collection_mode').val();
    if(date==''|| voucher_no==''||collection_mode=='')
    {
      alert('Please Fill all field');
      $('#collection_mode').val('');
    }
    else
    {
      var sendCollectionMode = collection_mode.toString().replace(/,/g, '-');
      $('.savebtn').attr('href',"<?php echo base_url('account_master/voucherentryfee/saveVoucher/'); ?>"+sendCollectionMode);
      $.ajax({
          url: "<?php echo base_url('account_master/voucherentryfee/getTodaysFeeCollection'); ?>",
          type: "POST",
          data: {date:date,voucher_no:voucher_no,collection_mode:collection_mode},
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
            $('#getdata').prop('disabled',true);
            $('#collection_mode').prop('disabled',true);
            $('#voucher_no').attr('readonly','');
            $('#date').attr('readonly','');
            $('#date').removeClass("datepicker");
            $('.voucheradd').show();
          }
        });
    }
}


function getCollectionMode()
{
    var voucher_no = $('#voucher_no').val();
    var date = $('#date').val();
    if(voucher_no == '')
    {
      alert('Please Enter Voucher No');
      $('#date').val('');
    }
    else
    {
      var divdata;
      $.ajax({
          url: "<?php echo base_url('account_master/voucherentryfee/getCollectionMode'); ?>",
          type: "POST",
          data: {date:date,voucher_no:voucher_no},
          dataType: 'json',
           beforeSend:function()
            {
              $('.loader').show();
              $('body').css('opacity', '0.5');
            },
          success: function(response){
            $('.loader').hide();
            $('body').css('opacity', '1.0');
            $.each( response, function( key, value ) {
              divdata += '<option value="'+value['Payment_Mode']+'">'+value['Payment_Mode']+'</option>';
            });
            $('#collection_mode').html(divdata);
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