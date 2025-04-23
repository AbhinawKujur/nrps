<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
   .thead-color{
    background: #337ab7 !important;
    color: white !important;
  }
  button.dt-button, div.dt-button, a.dt-button {
    line-height:0.66em;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    line-height:0.66em;
  }

  .main_content{
    padding-left: 25px !important; background-color: white !important;border-top: 3px solid #5785c3 !important;padding-top: 10px !important;
  }
  @media screen and (max-width: 600px) {
   .main_content{
     padding-left: 0px !important; background-color: white !important;border-top: 3px solid #5785c3 !important;padding-top: 10px !important;
  }
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Inventory Master</a> <i class="fa fa-angle-right"></i> Department</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div class="main_content">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Create Department</p><hr>
                  </div>
                  <!-- /.box-header -->
                <div class="box-body">
                    <?php if($this->session->flashdata('msg'))
                    {
                      echo $this->session->flashdata('msg');
                    } ?>
                    <form id="createForm" action="<?php echo base_url('inventory_master/department/create'); ?>" method="post">

                          <div class="form-group">
                            <label>Name :</label><span class="req"> *</span>
                            <input type="text" name="name" id="name" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                          </div>
                          <div class="form-group">
                            <label>Concerned Person Name :</label><span class="req"> *</span>
                            <input type="text" name="person_name" id="person_name" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                          </div>
                          <div class="form-group">
                            <label>Mobile No :</label><span class="req"> *</span>
                            <input type="text" name="mobile" id="mobile" required="" class="form-control" autocomplete="off">
                          </div>
                          <div class="form-group">
                            <button class="btn btn-black pull-right" type="submit"> <i class="fa fa-save"></i> Save</button>
                          </div>
                    </form>
                </div>
              </div>
            </div>        

            <div class="col-sm-8">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <p class="box-title" style="font-weight: bold;">Department List</p><hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered datatable">
                      <thead>
                        <tr>
                          <th class="thead-color">Name</th>
                          <th class="thead-color">Person Name</th>
                          <th class="thead-color">Person Mobile</th>
                          <th class="thead-color">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($departmentList as $key => $value) { ?>
                         
                          <tr>
                            <td><?php echo $value['Department_Name']; ?></td>
                            <td><?php echo $value['Concerned_Person']; ?></td>
                            <td><?php echo $value['Concerned_Person_Mob_No']; ?></td>
                            <td><a href="#" onclick="editFun(<?php echo $value['Department_ID']; ?>)" class="btn-xs btn-black"><i class="fa fa-edit"></i> Edit </a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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
</div><br><br>

<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Department</h4>
      </div>
      <form id="editForm" method="post" action="<?php echo base_url('inventory_master/department/update'); ?>">
        <div class="modal-body">
          <div class="row"> 
            <input type="hidden" name="id" id="editID">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Name :</label><span class="req"> *</span>
                <input type="text" name="name" id="edit_name" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
              </div>
              <div class="form-group">
                <label>Concerned Person Name :</label><span class="req"> *</span>
                <input type="text" name="person_name" id="edit_person_name" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
              </div>
              <div class="form-group">
                <label>Mobile No :</label><span class="req"> *</span>
                <input type="text" name="mobile" id="edit_mobile" required="" class="form-control" autocomplete="off">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
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
    $('.datatable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })
  });

     //validation
$(document).ready(function () {

    $('#createForm').validate({ // initialize the plugin
        rules: {
            name: {
                remote: {
                url: '<?php echo base_url('inventory_master/department/checkName'); ?>',
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
                url: '<?php echo base_url('inventory_master/department/checkNameatEdit'); ?>',
                type: "post",
                data: {
                  name: function() {
                    return $("#edit_name").val();
                  },
                   id: function() {
                    return $("#editID").val();
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

function editFun(id)
{
  $('#editID').val(id);
  $.ajax({
      url: "<?php echo base_url('inventory_master/department/getSingleData'); ?>",
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
        $('#editModal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $('#edit_name').val(response.Department_Name);
        $('#edit_person_name').val(response.Concerned_Person);
        $('#edit_mobile').val(response.Concerned_Person_Mob_No);
      }
    });
}
  </script>