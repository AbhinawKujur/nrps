<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px!important;
  }
  .table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
    font-size: 11px !important;
  }
  i{
    color: white !important;
  }
  button.dt-button, div.dt-button, a.dt-button {
    line-height:0.66em;
  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    line-height:0.66em;
  }
</style>
<ol class="breadcrumb">
   <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Employee</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                <a href="<?php echo base_url('employee/employee/create'); ?>" class="btn btn-black"><i class="fa fa-plus"></i> Add New Employee</a><br><br>
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered dataTable">
                    <thead>
                      <tr>
                        <th style="background: #337ab7; color: white !important;">Employee ID</th>
                        <th style="background: #337ab7; color: white !important;">Name</th>
                        <th style="background: #337ab7; color: white !important;">Date Of Joining</th>
                        <th style="background: #337ab7; color: white !important;">Date of Birth</th>
                        <th style="background: #337ab7; color: white !important;">Gender</th>
                        <th style="background: #337ab7; color: white !important;">Mobile</th>
                        <th style="background: #337ab7; color: white !important;">Role</th>
                        <th style="background: #337ab7; color: white !important;">Designation</th>
                        <th style="background: #337ab7; color: white !important;">Wing</th>
                        <th style="background: #337ab7; color: white !important;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($employeeDetails as $key => $value) { ?>
                        <tr>
                          <td><?php echo $value['EMPID']; ?></td>
                          <td><?php echo $value['EMP_FNAME'] . ' ' .$value['EMP_MNAME'].' ' .$value['EMP_LNAME'] ; ?></td>
                          <td><?php echo date("d-M-Y", strtotime($value['D_O_J'])); ?></td>
                          <td><?php echo date("d-M-Y", strtotime($value['D_O_B'])); ?></td>
                          <td><?php echo $gender[$value['SEX']]; ?></td>
                          <td><?php echo $value['C_MOBILE']; ?></td>
                          <td><?php echo $value['Role_name']; ?></td>
                          <td><?php echo $value['DESIG']; ?></td>
                          <td><?php echo $value['wing_master_name']; ?></td>
                          <td>
                            <a href="<?php echo base_url('employee/employee/view/').$value['id']; ?>" class="btn-xs btn-black" data-toggle="tooltip" title="View Employee Details"><i class="fa fa-bars"></i></a> &nbsp; &nbsp; 
                             <a href="<?php echo base_url('employee/employee/update/').$value['id']; ?>" class="btn-xs btn-danger" data-toggle="tooltip" title="Edit Employee Details"><i class="fa fa-edit"></i></a> &nbsp; &nbsp;
                            <a href="<?php echo base_url('employee/payroll_details/update/').$value['id']; ?>" class="btn-xs btn-success" data-toggle="tooltip" title="Edit Payroll Details" data-placement="left"><i class="fa fa-money"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>
   <script type="text/javascript">

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "pageLength": 50,
       dom: 'Bfrtip',
       buttons: [
          {
            extend: 'excelHtml5',
            title: 'Employee Report',
                
            },
        {
        extend: 'pdfHtml5',
        title: 'Employee Report',
                
        },
        ]
    })
  });

$('.dataTable tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );

     $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });
  </script>