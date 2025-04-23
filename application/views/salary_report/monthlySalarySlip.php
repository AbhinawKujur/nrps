 <style type="text/css">
     .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    color: black;
    font-size: 12px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
.thead-color{
  background: #abb0ac !important;
}

 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <b>Monthly Salary Slip</b>
      <hr>
     <form id="searchForm" method="post" action="<?php echo base_url('salary_report/monthly_salary_slip'); ?>">
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>Month and Year</label><span class="req"> *</span>
              <input type="text" name="date" class="form-control datepicker" id="date" autocomplete="off" value="<?php echo set_value('date'); ?>" required="">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label></label>
              <button type="submit" class="btn btn-success form-control" name="search"><i class="fa fa-search"></i> Search</button>
            </div>
          </div>
        </div>
      </form>
      <hr>
      <?php if(isset($resultList) && !empty($resultList)){ ?>
        <form method="post"  onsubmit="return checkEmpData()" action="<?php echo base_url('salary_report/monthly_salary_slip/generateSalarySlipPDF'); ?>" target="_blank">
          <input type="hidden" name="month" value="<?php echo $month; ?>">
          <input type="hidden" name="year" value="<?php echo $year; ?>">
          <div class="row">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-success pull-right"><i class="fa fa-file-pdf-o" style="color: white;"></i> Generate Salary Slip</button>
            </div>
          </div>
          <br><br>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable">
              <thead id="header-fixed">
                <tr>
                  <th class="thead-color"><input type="checkbox" name="" id="checkAll"></th>
                  <th class="thead-color">Pers. ID</th>
                  <th class="thead-color">Employee Name</th>
                  <th class="thead-color">Designation</th>
                  <th class="thead-color">Basic Pay</th>
                  <th class="thead-color">PF Joining Date</th>
                  <th class="thead-color">PF A/c No</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  foreach ($resultList as $key => $value) {  $eps_wages=0; ?>
                      <tr>
                        <td><input type="checkbox" name="employee[]" value="<?php echo $value['emp_id']; ?>" class="checkEmp"></td>
                        <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                        <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                        <td><?php echo $value['DESIG']; ?></td>
                        <td class="text-right"><?php echo $value['BASIC']; ?></td>
                        <td class="text-center"><?php 
                        if($value['PF_JOIN_DT'] != '')
                        {
                          echo date('d-M-Y',strtotime($value['PF_JOIN_DT']));
                        }
                         ?></td>
                        <td class="text-center"><?php echo $value['PF_AC_NO']; ?></td>
                      </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
          <br>
      <?php } else { ?>
        <div class="row">
          <div class="col-sm-12">
            <?php if($this->session->flashdata('msg')){
              echo $this->session->flashdata('msg');
            } ?>
          </div>
        </div>
      <?php } ?>
          <br>
          <br>
</div>


<script type="text/javascript">
        $(function () {
        $('.datatable').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : true,
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'excelHtml5',
                title: 'Montly PF Statement',
                              
              },
              {
                extend: 'pdfHtml5',
                title: 'Montly PF Statement',
                              
              },
          ],
        })
      });

    $('.datepicker').datepicker({
      format: "M-yyyy",
      autoclose: true,
      startView: "months", 
    minViewMode: "months"
    });

     //add checkbox
    $('#checkAll').click(function(){
        if($(this).prop("checked")) {
            $(".checkEmp").prop("checked", true);
        } else {
            $(".checkEmp").prop("checked", false);
        }                
    });

    $('.checkEmp').click(function(){
        if($(".checkEmp").length == $(".checkEmp:checked").length) {
            $("#checkAll").prop("checked", true);
        }else {
            $("#checkAll").prop("checked", false);            
        }
    });

    function checkEmpData()
    {
      var emp_id = [];
      $.each($("input[name='employee[]']:checked"), function(){            
          emp_id.push($(this).val());
      });
      if(emp_id != '')
      {
        return true;
      }
      else
      {
        swal({title: "Please Select At Least One Employee", text: "", type: "warning"});  
        return false;
      }
    }
</script>