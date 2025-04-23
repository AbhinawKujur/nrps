<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
   .thead-color{
    background: #c7b9b7 !important;
    color: black !important;
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
    <li class="breadcrumb-item"><a href="#">Inventory Master</a> <i class="fa fa-angle-right"></i> Supplier  <i class="fa fa-angle-right"></i> Add New Supplier </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div class="main_content">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-primary" style="padding-right: 10px;">
                <div class="box-header with-border">
                  <p class="box-title" style="font-weight: bold;">Create New Supplier <a class="btn btn-success pull-right" href="<?php echo base_url('inventory_master/supplier'); ?>"><i class="fa fa-backward"></i> Back</a></p><hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <?php if($this->session->flashdata('msg'))
                  {
                    echo $this->session->flashdata('msg');
                  } ?>
                  <form id="createForm" action="<?php echo base_url('inventory_master/supplier/addNewSupplier'); ?>" method="post">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Supplier Name :</label><span class="req"> *</span>
                          <input type="text" name="supplier_name" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Address :</label><span class="req"> *</span>
                          <textarea class="form-control" name="address" required=""></textarea>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>City :</label><span class="req"> *</span>
                          <input type="text" name="city" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>State :</label><span class="req"> *</span>
                          <input type="text" name="state" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Country :</label><span class="req"> *</span>
                          <input type="text" name="country" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Pin Code :</label><span class="req"> *</span>
                          <input type="number" name="pin_code" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Contact Person Name :</label><span class="req"> *</span>
                          <input type="text" name="contact_person_name" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Contact Person Mobile :</label><span class="req"> *</span>
                          <input type="number" name="contact_person_mobile" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>PAN No :</label><span class="req"> *</span>
                          <input type="text" name="pan_no" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>GST No :</label><span class="req"> *</span>
                          <input type="text" name="gst_no" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Opening Balance :</label><span class="req"> *</span>
                          <input type="number" name="opening_balance" required="" class="form-control" autocomplete="off" style="text-transform: uppercase;">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Dr/Cr :</label><span class="req"> *</span>
                          <select class="form-control" name="drcr" required="">
                            <option value="">Select</option>
                            <option value="D">Dr</option>
                            <option value="C">Cr</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-black pull-right" type="submit" name="save"><i class="fa fa-save"></i> Save</button>
                  </form>
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


  <script type="text/javascript">

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

  </script>