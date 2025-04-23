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
input{
  text-transform: uppercase;
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">General Setting </a> <i class="fa fa-angle-right"></i> Role Master</li>
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
                    <a href="#" class="btn btn-black" onclick="addRole()"><i class="fa fa-plus"></i> Add Role</a><br><br>
                    <table class="table table-bordered dataTable">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">Role</th>
                          <th style="background: #337ab7; color: white !important;">Description</th>
                          <th style="background: #337ab7; color: white !important;">Status</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($roleList as $key => $value) { ?>
                          <tr>
                            <td><?php echo $value['NAME']; ?></td>
                            <td><?php echo $value['DESCRIPTION']; ?></td>
                            <td><?php if($value['IS_ACTIVE']==1)
                            {
                              echo "<label class='label label-success'>Active</label>";
                            } 
                            else
                            {
                              echo "<label class='label label-danger'>Inactive</label>";
                            } ?></td>
                            <td>
                              <?php if($value['IS_SYSTEM'] != 1){ ?>
                                <a href="#" onclick="editRole('<?php echo $value['ID']; ?>')" class="btn-xs btn-black"><i class="fa fa-pencil-square-o" style="color:white;"></i> Edit</a>
                              <?php } ?>
                              <?php if($value['IS_SUPERADMIN'] != 1){ ?>
                                <a href="<?php echo base_url('role_master/role_distribution/update/').$value['ID']; ?>" class="btn-xs btn-success"><i class="fa fa-tags" style="color:white;"></i> Assign</a>
                              <?php } ?>
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
</div>
<br><br>

<div class="modal fade" id="addRoleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add New Role</h4>
      </div>
      <form id="addRoleForm" class="form-horizontal">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-sm-3">Role: <span class="req"> *</span></label>
            <div class="col-sm-9">
              <input type="text" name="name" class="form-control" id="name">
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">Description:</label>
            <div class="col-sm-9">
              <input type="text" name="description" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="save_btn"><i class="fa fa-floppy-o"></i> Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="editRoleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Role</h4>
      </div>
      <form id="editRoleForm" class="form-horizontal">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="id" id="role_id">
            <label class="control-label col-sm-3">Role: <span class="req"> *</span></label>
            <div class="col-sm-9">
              <input type="text" name="name" class="form-control" id="editName">
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">Description:</label>
            <div class="col-sm-9">
              <input type="text" name="description" class="form-control" id="editDescription">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="update_btn"><i class="fa fa-refresh"></i> Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

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

function addRole()
{
  $('#addRoleModal').modal({
    backdrop: 'static',
    keyboard: false
  });
}


//validation
$(document).ready(function () {
    $('#addRoleForm').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
                remote: {
                    url: "<?php echo base_url('role_master/role/checkRoleName'); ?>",
                    type: "post",
                    data: {
                      name: function() {
                        return $("#name").val();
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
    $('#editRoleForm').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
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
  $("#addRoleForm").validate();
  if ($('#addRoleForm').valid())
  {
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('role_master/role/create'); ?>",
      type: "POST",
      data: $("#addRoleForm").serialize(),
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
          $('#addRoleForm')[0].reset();
          $('#addRoleModal').modal('hide');
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



function editRole(id)
{
  $('#role_id').val(id);
  $.ajax({
      url: "<?php echo base_url('role_master/role/getSingeRole'); ?>",
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
        $('#editRoleModal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $('#editName').val(response.NAME);
        $('#editDescription').val(response.DESCRIPTION);
      }
    });
  }



//creating new shift
 $("#update_btn").on("click", function(event){
  $("#editRoleForm").validate();
  if ($('#editRoleForm').valid())
  {
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('role_master/role/update'); ?>",
      type: "POST",
      data: $("#editRoleForm").serialize(),
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
          $('#editRoleForm')[0].reset();
          $('#editRoleModal').modal('hide');
          swal({title: "Updated Successfully", text: "Updated Successfully", type: "success"},
             function(){ 
                 location.reload();
             }
          );          
        }
        else
        {
          swal({title: "Updation Failed!", text: "Updation Failed!", type: "error"});
        }
      }
    });
   }
});
  </script>