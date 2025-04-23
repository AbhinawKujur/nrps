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
    .table > thead > tr > th,
  .table > tbody > tr > th,
  .table > tfoot > tr > th,
  .table > thead > tr > td,
  .table > tbody > tr > td,
  .table > tfoot > tr > td {
      white-space: nowrap !important;
    }
  @media screen and (max-width: 600px) {
   .main_content{
     padding-left: 0px !important; background-color: white !important;border-top: 3px solid #5785c3 !important;padding-top: 10px !important;
  }
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Inventory Master</a> <i class="fa fa-angle-right"></i> Supplier</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div class="main_content">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <p class="box-title" style="font-weight: bold;">Department List
                    <a class="btn btn-black pull-right" href="<?php echo base_url('inventory_master/supplier/addNewSupplier'); ?>"><i class="fa fa-plus"></i> Add New Supplier</a>
                  </p><hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered datatable">
                      <thead>
                        <tr>
                          <th class="thead-color">Supplier Name</th>
                          <th class="thead-color">Address</th>
                          <th class="thead-color">City</th>
                          <th class="thead-color">State</th>
                          <th class="thead-color">Country</th>
                          <th class="thead-color">PIN Code</th>
                          <th class="thead-color">Contact <br>Person Name</th>
                          <th class="thead-color">Contact <br>Person Mobile</th>
                          <th class="thead-color">PAN No</th>
                          <th class="thead-color">GST No</th>
                          <th class="thead-color">Opening<br>Balance</th>
                          <th class="thead-color">Dr/Cr</th>
                          <th class="thead-color">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($supplierList as $key => $value) { ?>
                         
                          <tr>
                            <td><?php echo $value['Supplier_Name']; ?></td>
                            <td><?php echo $value['Supplier_Address']; ?></td>
                            <td><?php echo $value['City']; ?></td>
                            <td><?php echo $value['State']; ?></td>
                            <td><?php echo $value['Country']; ?></td>
                            <td><?php echo $value['Pin_Code']; ?></td>
                            <td><?php echo $value['Contact_Person_Name']; ?></td>
                            <td><?php echo $value['Contact_Person_Mobile_No']; ?></td>
                            <td><?php echo $value['PAN_No']; ?></td>
                            <td><?php echo $value['GST_No']; ?></td>
                            <td class="text-right"><?php echo $value['Opening_Balance']; ?></td>
                            <td><?php if($value['Debit_Credit']=='D')
                            {
                              echo "Dr.";
                            }else{
                              echo "Cr.";
                            } ?></td>
                            <td><a href="<?php echo base_url('inventory_master/supplier/updateSupplier/'.$value['Supplier_ID']); ?>" class="btn-xs btn-black"><i class="fa fa-edit"></i> Edit </a></td>
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

  </script>