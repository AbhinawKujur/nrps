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
  @media (min-width: 768px)
  {
      .modal-dialog {
          width: 766px;
          margin: 30px auto;
      }
  }
  @media screen and (max-width: 600px) {
   .main_content{
     padding-left: 0px !important; background-color: white !important;border-top: 3px solid #5785c3 !important;padding-top: 10px !important;
  }
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Inventory Master</a> <i class="fa fa-angle-right"></i> Item Master</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div class="main_content">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <div class="box box-primary" style="padding-right: 10px;">
                <div class="box-header with-border">
                  <p class="box-title" style="font-weight: bold;">Add Item</p><hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <?php if($this->session->flashdata('msg'))
                  {
                    echo $this->session->flashdata('msg');
                  } ?>
                  <form id="createForm" action="<?php echo base_url('inventory_master/itemmaster/create'); ?>" method="post">
                      <div class="row">
                          <div class="form-group">
                            <label>Department :</label><span class="req"> *</span>
                            <select class="form-control" name="department" id="department" required="">
                              <option value="">Select</option>
                              <?php foreach ($departmentList as $key => $value) { ?>
                                <option value="<?php echo $value['Department_ID']; ?>"><?php echo $value['Department_Name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Item Group :</label><span class="req"> *</span>
                            <select class="form-control" name="item_group" id="item_group" required="" onchange="displayClass()">
                              <option value="">Select</option>
                              <?php foreach ($itemGroupList as $key => $value) { ?>
                                <option value="<?php echo $value['item_group_id']; ?>"><?php echo $value['item_group_name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Item Name :</label><span class="req"> *</span>
                            <input type="text" name="itemname" id="itemname" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                          </div>
                          <div class="form-group">
                            <label>Class :</label><span class="req"> *</span>
                            <select class="form-control" name="class_id" id="class_id" required="" disabled="">
                              <option value="">Select</option>
                              <?php foreach ($classList as $key => $value) { ?>
                                <option value="<?php echo $value['Class_No']; ?>"><?php echo $value['CLASS_NM']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                      </div>
                      <div class="row">
                          <div class="form-group">
                            <label>Unit of Measure :</label><span class="req"> *</span>
                            <input type="text" name="unit_of_measure" id="unit_of_measure" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                          </div>
                          <div class="form-group">
                            <label>Opening Stock :</label><span class="req"> *</span>
                            <input type="number" name="opening_stock" id="opening_stock" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;" min="0">
                          </div>
                          <div class="form-group">
                            <label>Price :</label><span class="req"> *</span>
                            <input type="number" name="price" id="price" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;" min="0">
                          </div>
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
                  <p class="box-title" style="font-weight: bold;"> Item List</p><hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" action="<?php echo base_url('inventory_master/itemmaster'); ?>">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Department</label>
                          <select class="form-control" name="department_search">
                            <option value="">Select</option>
                            <?php foreach ($departmentList as $key => $value) { ?>
                              <option value="<?php echo $value['Department_ID']; ?>" <?php if(set_value('department_search')==$value['Department_ID']){ echo "selected"; } ?>><?php echo $value['Department_Name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Item Group</label>
                          <select class="form-control" name="item_group_search">
                            <option value="">Select</option>
                            <?php foreach ($itemGroupList as $key => $value) { ?>
                              <option value="<?php echo $value['item_group_id']; ?>" <?php if(set_value('item_group_search')==$value['item_group_id']){ echo "selected"; } ?>><?php echo $value['item_group_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <br>
                        <button class="btn btn-black" type="submit" name="search"><i class="fa fa-search"></i> Search</button>
                      </div>
                    </div>
                  </form>
                  <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered datatable">
                      <thead>
                        <tr>
                          <th class="thead-color">Department</th>
                          <th class="thead-color">Item Group</th>
                          <th class="thead-color">Name</th>
                          <th class="thead-color">Class</th>
                          <th class="thead-color">Price</th>
                          <th class="thead-color">Opening Stock</th>
                          <th class="thead-color">Entry Date</th>
                          <th class="thead-color">Measure</th>
                          <th class="thead-color">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($itemList as $key => $value) { ?>
                         
                          <tr>
                            <td><?php echo $value['department']; ?></td>
                            <td><?php echo $value['item_group_name']; ?></td>
                            <td><?php echo $value['item_name']; ?></td>
                            <td><?php echo $value['Class_Name']; ?></td>
                            <td><?php echo $value['item_price']; ?></td>
                            <td><?php echo $value['Opening_Stock']; ?></td>
                            <td><?php echo date('d-M-Y',strtotime($value['Entry_Date'])); ?></td>
                            <td><?php echo $value['measure']; ?></td>
                            <td>
                                <a href="#" onclick="editFun(<?php echo $value['Stock_ID']; ?>)" class="btn-xs btn-black"><i class="fa fa-edit"></i> </a>
                            </td>
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
        <h4 class="modal-title">Edit Item</h4>
      </div>
      <form id="editForm" method="post" action="<?php echo base_url('inventory_master/itemmaster/update'); ?>">
        <div class="modal-body">
            <input type="hidden" name="id" id="editID">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label>Department :</label><span class="req"> *</span>
                <select class="form-control" name="department" id="edit_department" required="">
                  <option value="">Select</option>
                  <?php foreach ($departmentList as $key => $value) { ?>
                    <option value="<?php echo $value['Department_ID']; ?>"><?php echo $value['Department_Name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Item Group :</label><span class="req"> *</span>
                <select class="form-control" name="item_group" id="edit_item_group" required="" onchange="displayClassEdit()">
                  <option value="">Select</option>
                  <?php foreach ($itemGroupList as $key => $value) { ?>
                    <option value="<?php echo $value['item_group_id']; ?>"><?php echo $value['item_group_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Item Name :</label><span class="req"> *</span>
                <input type="text" name="itemname" id="edititemname" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Class :</label><span class="req"> *</span>
                <select class="form-control" name="class_id" id="edit_class_id" required="" disabled="">
                  <option value="">Select</option>
                  <?php foreach ($classList as $key => $value) { ?>
                    <option value="<?php echo $value['Class_No']; ?>"><?php echo $value['CLASS_NM']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label>Unit of Measure :</label><span class="req"> *</span>
                <input type="text" name="unit_of_measure" id="edit_unit_of_measure" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Opening Stock :</label><span class="req"> *</span>
                <input type="number" name="opening_stock" id="edit_opening_stock" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;" min="0">
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Price :</label><span class="req"> *</span>
                <input type="number" name="price" id="edit_price" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;" min="0">
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
    $('.datatable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  });


     //validation
$(document).ready(function () {

    $('#createForm').validate({ // initialize the plugin
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

function editFun(id)
{
  $('#editID').val(id);
  $.ajax({
      url: "<?php echo base_url('inventory_master/itemmaster/getSingleData'); ?>",
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
        $('#edit_item_group').val(response.Item_group_id);
        $('#edititemname').val(response.item_name);
        $('#edit_department').val(response.department_id);
        
        if(response.Class_Name != 0)
        {
          $('#edit_class_id').val(response.Class_Name);
          $('#edit_class_id').removeAttr('disabled');
        }else{
          $('#edit_class_id').val('');
        }
        $('#edit_unit_of_measure').val(response.measure);
        $('#edit_opening_stock').val(response.Opening_Stock);
        $('#edit_price').val(response.item_price);
      }
    });
}

function displayClass()
{
  var itemgroup = $('#item_group').val();
  if(itemgroup == 1 || itemgroup == 8)
  {
    $('#class_id').removeAttr('disabled');
  }
  else
  {
    $('#class_id').attr('disabled','disabled');
  }
}

function displayClassEdit()
{
  var itemgroup = $('#edit_item_group').val();
  if(itemgroup == 1 || itemgroup == 8)
  {
    $('#edit_class_id').removeAttr('disabled');
  }
  else
  {
    $('#edit_class_id').attr('disabled','disabled');
  }
}
  </script>
