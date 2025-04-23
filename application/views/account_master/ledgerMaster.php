<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Account Master</a> <i class="fa fa-angle-right"></i> Ledger Master</li>
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
                    <p class="box-title" style="font-weight: bold;">Ledger Master List
                      <a class="btn btn-black pull-right" href="<?php echo base_url('account_master/ledgermaster/create'); ?>"><i class="fa fa-plus"></i> Add New Ledger</a></p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered dataTable table-striped">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;" class="text-center">Ledger No</th>
                          <th style="background: #337ab7; color: white !important;">Ledger</th>
                          <th style="background: #337ab7; color: white !important;">Account Group</th>
                          <th style="background: #337ab7; color: white !important;" class="text-center">School Group</th>
                          <!-- <th style="background: #337ab7; color: white !important;">Account Type</th> -->
                          <!-- <th style="background: #337ab7; color: white !important;">Account No</th> -->
                          <th style="background: #337ab7; color: white !important;">Opening Balance</th>
                          <th style="background: #337ab7; color: white !important;">Dr./Cr.</th>
                          <th style="background: #337ab7; color: white !important;">Budget Amount</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($ledgerList as $key => $value) { ?>
                          <tr>
                            <td class="text-center"><?php echo $value['LedgerNo']; ?></td>
                            <td><?php echo $value['CCode']; ?></td>
                            <td><?php echo $value['account_group']; ?></td>
                            <td><?php echo $value['school_group']; ?></td>
                            <!-- <td><?php echo $value['ANSWER']; ?></td> -->
                            <!-- <td><?php echo $value['AcNo']; ?></td> -->
                            <td><?php echo $value['OBal']; ?></td>
                            <td><?php echo $value['DC']; ?></td>
                            <td><?php echo $value['BAmount']; ?></td>
                            <td>
                              <a href="<?php echo base_url('account_master/ledgermaster/update/'.$value['AcNo']); ?>" class="btn-xs btn-black"><i class="fa fa-edit"></i> Edit </a>
                            </td>
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
</div><br><br>

<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Narration</h4>
      </div>
      <form id="editForm" method="post" action="<?php echo base_url('account_master/accountgroup/update'); ?>">
        <div class="modal-body">
          <div class="row"> 
            <input type="hidden" name="id" id="editID">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Group No.</label>
                <input type="number" name="group_no" class="form-control" value="<?php echo set_value('group_no'); ?>" id="edit_group_no" autocomplete="off" readonly>
              </div>   
              <div class="form-group">
                <label>Group Name</label><span class="req">*</span>
                <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" id="edit_name" autocomplete="off" style="text-transform: uppercase;" required="">
              </div>   
              <div class="form-group">
                <label>Details</label>
                <textarea class="form-control" name="details" id="edit_details" style="text-transform: uppercase;"></textarea>
              </div>   
              <div class="form-group">
                <label>Budget Amounts</label><span class="req">*</span>
                <input type="number" name="budget_amount" class="form-control" value="<?php echo set_value('budget_amount'); ?>" id="edit_budget_amount" autocomplete="off" required="" vale="0">
              </div>    
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


  <script type="text/javascript">

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      'pageLength'  : 25
    })
  });

     //validation
$(document).ready(function () {

    $('#createForm').validate({ // initialize the plugin
        rules: {
            group_no: {
                remote: {
                url: '<?php echo base_url('account_master/accountgroup/checkGroupNo'); ?>',
                type: "post",
                data: {
                  group_no: function() {
                    return $( "#group_no" ).val();
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

     //validation
$(document).ready(function () {

    $('#editForm').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

function editFun(group_no)
{
  $.ajax({
      url: "<?php echo base_url('account_master/accountgroup/getSingleData'); ?>",
      type: "POST",
      data: {group_no:group_no},
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        $('#editModal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $('#edit_group_no').val(response.cat_code);
        $('#edit_name').val(response.CAT_ABBR);
        $('#edit_details').val(response.CAT_DESC);
        $('#edit_budget_amount').val(response.CAT_Amt);
      }
    });
}
  </script>