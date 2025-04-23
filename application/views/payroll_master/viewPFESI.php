<style type="text/css">
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
  .thead-color{
    background: #337ab7 !important; color: white !important;
  }
</style>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Payroll</a> <i class="fa fa-angle-right"></i> View PF ESI</li>
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
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                <div class="table-responsive">
                  <table class="table table-stripped table-bordered dataTable">
                    <thead>
                      <tr>
                        <th class="thead-color text-center">Effective Date</th>
                        <th class="thead-color text-center">Employee<br>PF<br>Rate</th>
                        <th class="thead-color text-center">Employer<br>PF<br>Rate</th>
                        <th class="thead-color text-center">Pension<br>Rate</th>
                        <th class="thead-color text-center">ESI<br>Applied</th>
                        <th class="thead-color text-center">ESI<br>Limit</th>
                        <th class="thead-color text-center">ESI<br>Own<br>Rate</th>
                        <th class="thead-color text-center">ESI<br>EMP<br>Rate</th>
                        <th class="thead-color text-center">HRA<br>Allow.</th>
                        <th class="thead-color text-center">DA<br>Rate</th>
                        <th class="thead-color text-center">Special<br>Allowance</th>
                        <th class="thead-color text-center">Staff<br>Welfare Fund</th>
                        <th class="thead-color text-center">TA<br>Slab1</th>
                        <th class="thead-color text-center">TA<br>Slab2</th>
                        <th class="thead-color text-center">TA<br>Slab3</th>
                        <th class="thead-color text-center">Bus<br>Deduction</th>
                        <th class="thead-color text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pfesi_details as $key => $value) { ?>
                        <tr>
                          <td><?php echo $effective_date = date("d-M-Y", strtotime($value['ST_DATE'])); ?></td>
                          <td class="text-center"><?php echo $value['OWN_RATE']; ?></td>
                          <td class="text-center"><?php echo $value['EMP_RATE']; ?></td>
                          <td class="text-center"><?php echo $value['PEN_RATE']; ?></td>
                          <td class="text-center"><?php 
                                if($value['ESI_Applied'] == 1){
                                  echo "YES";
                                  }else{
                                    echo "NO";
                                  } ?>
                          </td>
                          <td class="text-center"><?php echo $value['ESI_LIMIT']; ?></td>
                          <td class="text-center"><?php echo $value['ESI_OWN_RATE']; ?></td>
                          <td class="text-center"><?php echo $value['ESI_EMP_RATE']; ?></td>
                          <td class="text-center"><?php echo $value['HRA_Rate']; ?></td>
                          <td class="text-center"><?php echo $value['da_rate']; ?></td>
                          <td class="text-center"><?php echo $value['special_allowance']; ?></td>
                          <td class="text-center"><?php echo $value['staff_welfare_fund']; ?></td>
                          <td class="text-center"><?php echo $value['ta_rate_slab1']; ?></td>
                          <td class="text-center"><?php echo $value['ta_rate_slab2']; ?></td>
                          <td class="text-center"><?php echo $value['ta_rate_slab3']; ?></td>
                          <td class="text-center"><?php echo $value['bus_deduction']; ?></td>
                          <td class="text-center">

                            <a href="<?php echo base_url('payroll/master/pfesi/update/').$value['id']; ?>" class="btn-xs btn-danger"><i class="fa fa-edit"></i> Edit</a>
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
      'autoWidth'   : true
    })
  });
  </script>