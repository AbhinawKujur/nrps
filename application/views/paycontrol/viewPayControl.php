<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
  }
  .table tr th{
    text-align: center;
  }
   .table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('pay_control/paycontrol'); ?>">Monthly Entries</a> <i class="fa fa-angle-right"></i> View Pay Control</li>
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
                <a href="<?php echo base_url('pay_control/paycontrol/update'); ?>" class="btn btn-black"><i class="fa fa-plus"></i> Create & Update Pay Control</a><br><br>
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                <div class="table-responsive">
                  <table class="table table-stripped table-bordered dataTable">
                    <thead>
                      <tr>
                        <th style="background: #337ab7; color: white !important;">Employee ID</th>
                        <th style="background: #337ab7; color: white !important;">Name</th>
                        <th style="background: #337ab7; color: white !important;" colspan="6">Deduction</th>
                        <th style="background: #337ab7; color: white !important;" colspan="4">House Rent</th>
                        <th style="background: #337ab7; color: white !important;" colspan="2">Allowance</th>
                        <th style="background: #337ab7; color: white !important;" colspan="6">Arrear Salary</th>
                      </tr>
                      <tr>
                        <th style="background: #337ab7; color: white !important;"></th>
                        <th style="background: #337ab7; color: white !important;"></th>
                        <th style="background: #337ab7; color: white !important;">FPF</th>
                        <th style="background: #337ab7; color: white !important;">VPF</th>
                        <th style="background: #337ab7; color: white !important;">Prof. Tax</th>
                        <th style="background: #337ab7; color: white !important;">LIC</th>
                        <th style="background: #337ab7; color: white !important;">TDS</th>
                        <th style="background: #337ab7; color: white !important;">Medical</th>
                        <th style="background: #337ab7; color: white !important;">Rent</th>
                        <th style="background: #337ab7; color: white !important;">Electricity</th>
                        <th style="background: #337ab7; color: white !important;">Security</th>
                        <th style="background: #337ab7; color: white !important;">Garage</th>
                        <th style="background: #337ab7; color: white !important;">Fixed<br>Allow.</th>
                        <th style="background: #337ab7; color: white !important;">Shift<br>Allow.</th>
                        <th style="background: #337ab7; color: white !important;">Basic</th>
                        <th style="background: #337ab7; color: white !important;">DA</th>
                        <th style="background: #337ab7; color: white !important;">HRA</th>
                        <th style="background: #337ab7; color: white !important;">TA</th>
                        <th style="background: #337ab7; color: white !important;">Fixed<br>Allow.</th>
                        <th style="background: #337ab7; color: white !important;">Shift<br>Allow</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($paycontrol as $key => $value) { ?>
                        <tr>
                          <td><?php echo $value['EMP_ID']; ?></td>
                          <td><?php echo $value['EMP_FNAME'] . ' ' .$value['EMP_MNAME'].' ' .$value['EMP_LNAME'] ; ?></td>
                          <td><?php echo $value['FPF']; ?></td>
                          <td><?php echo $value['VPF']; ?></td>
                          <td><?php echo $value['PROF_TAX']; ?></td>
                          <td><?php echo $value['LIC']; ?></td>
                          <td><?php echo $value['TDS']; ?></td>
                          <td><?php echo $value['MEDICAL_DEDUCT']; ?></td>
                          <td><?php echo $value['HRA_RENT']; ?></td>
                          <td><?php echo $value['HRA_ELECT']; ?></td>
                          <td><?php echo $value['HRA_SECURITY']; ?></td>
                          <td><?php echo $value['HRA_GARAGE']; ?></td>
                          <td><?php echo $value['FIXED_ALLOW']; ?></td>
                          <td><?php echo $value['SHIFT_ALLOW']; ?></td>
                          <td><?php echo $value['ARREAR_BASIC']; ?></td>
                          <td><?php echo $value['ARREAR_DA']; ?></td>
                          <td><?php echo $value['ARREAR_HRA']; ?></td>
                          <td><?php echo $value['ARREAR_TA']; ?></td>
                          <td><?php echo $value['ARREAR_FIXED_ALLOW']; ?></td>
                          <td><?php echo $value['ARREAR_SHIFT_ALLOW']; ?></td>
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
      "bSortCellsTop": true,
      dom: 'Bfrtip',
          buttons: [
              'copy', 'excel',
          ],
    })
  });
  </script>