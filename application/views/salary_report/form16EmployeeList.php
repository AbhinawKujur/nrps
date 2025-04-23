 <style type="text/css">
   .table{
    font-size: 12px;
   }
   .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .thead-color{
    background: #337ab7 !important;
    color: white !important;
  }
 </style>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <h4 style="text-align: center;font-weight: bold;">Form 16</h4><hr>
    <form  onsubmit="return checkEmpData()"  action="<?php echo base_url('salary_report/form16/generatePDF'); ?>" method="post">
      <?php if(!empty($employeeList)){ ?>
        <center>
        <button type="submit" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Generate</button>
      <?php } ?>
       <table class="table table-bordered table-striped table-hover datatable">
          <thead>
            <tr>
              <th class="thead-color text-center"><input type="checkbox" id="checkAll"></th>
              <th class="thead-color text-center">S.No</th>
              <th class="thead-color text-center">Employee ID</th>  
              <th class="thead-color text-center">Employee Name</th>  
              <th class="thead-color text-center">Bank A/c</th>  
              <th class="thead-color text-center">PAN No</th>  
            </tr>
          </thead>
          <tbody>
              <?php 

              $total_amt = 0;
              foreach ($employeeList as $key => $value) {  ?>
                  <tr>
                    <td><input type='checkbox' name='emp_id[]' class='checkEmp' value="<?php echo $value['id']; ?>" onclick='checkEmp()'></td>
                      <td class="text-center"><?php echo $key + 1; ?></td>
                      <td class="text-center"><?php echo $value['EMPID']; ?></td>
                      <td class="text-center"><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                      <td><?php echo $value['BANK_AC_NO']; ?></td>
                      <td><?php echo $value['PAN_NUMBER']; ?></td>
                  </tr>
              <?php } ?>
          </tbody>
        </table>
      </form>
      <br>
</div><br>
<script type="text/javascript">
        $(function () {
        $('.datatable').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : true,
          'pageLength'  : 25,
        })
      });

         //add checkbox
    $('#checkAll').click(function(){
        
          if($(this).prop("checked")) {
            if(confirm('Do you want to generate all employee Form 16?'))
            {
              $(".checkEmp").prop("checked", true);
            }
            else
            {
              $(this).prop("checked",false);
            }
          } else {
              $(".checkEmp").prop("checked", false);
          }              
    });

    function checkEmp()
    {
        if($(".checkEmp").length == $(".checkEmp:checked").length) {
            $("#checkAll").prop("checked", true);
        }else {
            $("#checkAll").prop("checked", false);            
        }
    }

    function checkAllCheckBox()
    {
      if($(".checkEmp").length == $(".checkEmp:checked").length) {
          $("#checkAll").prop("checked", true);
      }else {
          $("#checkAll").prop("checked", false);            
      }
    }

    function checkEmpData()
    {
      var emp_id = [];
      $.each($("input[name='emp_id[]']:checked"), function(){ 
          emp_id.push($(this).val());
      });
      if(emp_id != '')
      {
        return true;
      }
      else
      {
        alert('Please Select Employee First');
        return false;
      }  
    }
</script>