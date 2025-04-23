<style type="text/css">
 .thead-color{
background: #337ab7 !important; color: white !important;
}
 .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Accounts Report</a> <i class="fa fa-angle-right"></i> Ledger Passed Report </li>
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
                  <div class="box-body">
                    <div class="row">
                      <table class="table table-bordered table-striped dataTable">
                        <thead>
                          <tr>
                            <th class="thead-color text-center">SNo.</th>
                            <th class="thead-color">Ledger Head Name</th>
                            <th class="thead-color text-center">School Group</th>
                            <th class="thead-color text-center">Ledger No</th>
                            <th class="thead-color text-center">No. of Entry</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($ledgerHeadList as $key => $value) { ?>
                            <tr>
                              <td class="text-center"><?php echo $key+1; ?></td>
                              <td><?php echo $value['CCode']; ?></td>
                              <td class="text-center"><?php echo $value['SG']; ?></td>
                              <td class="text-center"><?php echo $value['AcNo']; ?></td>
                              <td class="text-center"><?php echo $value['total_entry']; ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div><br>
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
  
$('.dataTable').dataTable({
      "bDestroy": true,
       "ordering": false,
       "paging": false,
        dom: 'Bfrtip',
        buttons: [
            {
              extend: 'excelHtml5',
              title: 'Ledger Entry Passed',
                            
            },
        ],
    });

</script>