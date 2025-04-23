<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Account Master</a> <i class="fa fa-angle-right"></i> School Group</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;padding-top: 20px;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <form role="form" action="<?php echo base_url('account_master/schoolgroup/create'); ?>" method="post" id="createForm">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Create School Group</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                    <div class="form-group">
                      <label>Group Name</label><span class="req">*</span>
                      <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" id="name" autocomplete="off" style="text-transform: uppercase;" required="">
                    </div>   
                    <div class="form-group">
                      <label>Details</label>
                      <textarea class="form-control" name="details" id="details" style="text-transform: uppercase;"></textarea>
                    </div>   
                    <div class="form-group">
                      <label>Budget Amounts</label><span class="req">*</span>
                      <input type="number" name="budget_amount" class="form-control" value="<?php echo set_value('budget_amount'); ?>" id="budget_amount" autocomplete="off" required="" vale="0">
                    </div>    
                  </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-black pull-right">Save</button>
                </div>
                </div>
              </form>
            </div>


            <div class="col-sm-8">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">School Group List</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered dataTable table-striped">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;" class="text-center">Group No</th>
                          <th style="background: #337ab7; color: white !important;">Group Name</th>
                          <th style="background: #337ab7; color: white !important;">Details</th>
                          <th style="background: #337ab7; color: white !important;" class="text-center">Budget Amount</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($schoolGroupList as $key => $value) { ?>
                          <tr>
                            <td class="text-center"><?php echo $value['cat_code']; ?></td>
                            <td><?php echo $value['CAT_ABBR']; ?></td>
                            <td><?php echo $value['CAT_DESC']; ?></td>
                            <td class="text-center"><?php echo $value['CAT_Amt']; ?></td>
                            <td>
                              <a href="#" onclick="editFun(<?php echo $value['cat_code']; ?>)" class="btn-xs btn-black"><i class="fa fa-edit"></i> Edit </a>
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
        <h4 class="modal-title">Edit School Group</h4>
      </div>
      <form id="editForm" method="post" action="<?php echo base_url('account_master/schoolgroup/update'); ?>">
        <div class="modal-body">
          <div class="row"> 
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
            name: {
                remote: {
                url: '<?php echo base_url('account_master/schoolgroup/checkGroupName'); ?>',
                type: "post",
                data: {
                  name: function() {
                    return $( "#name" ).val();
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
      rules: {
            name: {
                remote: {
                url: '<?php echo base_url('account_master/schoolgroup/checkGroupNameAtEdit'); ?>',
                type: "post",
                data: {
                  name: function() {
                    return $( "#edit_name" ).val();
                  },
                  group_no: function() {
                    return $( "#edit_group_no" ).val();
                  },
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

function editFun(group_no)
{
  $.ajax({
      url: "<?php echo base_url('account_master/schoolgroup/getSingleData'); ?>",
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