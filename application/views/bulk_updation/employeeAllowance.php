<br>
<style type="text/css">
  .thead-color{
   background: #bac9e2 !important;
  }
</style>
  <div class="employee-dashboard">
    <?php if(isset($employeeList)) { ?>
      <div class="row"> 
          <div class="col-sm-12">
            <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
              <div class="panel-heading"><i class="fa fa-edit"></i> Employee Payroll Allowance Bulk Updation</div>
              <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;">
                  <table class='table table-bordered table-striped dataTable'>
                    <thead>
                      <tr>
                        <th class="thead-color text-center">Employee ID</th>
                        <th class="thead-color text-center">Name</th>
                        <th class="thead-color text-center">Fixed Allow.</th>
                        <th class="thead-color text-center">Shift Allow.</th>
                        <th class="thead-color text-center">Medical<br>Reimbursment</th>
                        <th class="thead-color text-center">SH<br>Rent</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($employeeList as $key => $value) { ?>
                        <tr>
                          <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                          <td class="text-center"><?php echo $value['EMP_FNAME'] . ' ' .$value['EMP_MNAME'].' ' .$value['EMP_LNAME'] ; ?></td>
                          <td class="text-center contenteditable" contenteditable="true" onblur="updateDatas('FIXED_ALLOW',<?php echo $value['id']; ?>)" id="FIXED_ALLOW_<?php echo $value['id']; ?>"><?php echo $value['FIXED_ALLOW']; ?></td>
                          <td class="text-center contenteditable" contenteditable="true"  onblur="updateDatas('SHIFT_ALLOW',<?php echo $value['id']; ?>)" id="SHIFT_ALLOW_<?php echo $value['id']; ?>"><?php echo $value['SHIFT_ALLOW']; ?></td>
                          <td class="text-center contenteditable" contenteditable="true"  onblur="updateDatas('MEDICAL_REIMBURSEMENT',<?php echo $value['id']; ?>)" id="MEDICAL_REIMBURSEMENT_<?php echo $value['id']; ?>"><?php echo $value['MEDICAL_REIMBURSEMENT']; ?></td>
                          <td class="text-center contenteditable" contenteditable="true"  onblur="updateDatas('SH_RENT',<?php echo $value['id']; ?>)" id="SH_RENT_<?php echo $value['id']; ?>"><?php echo $value['SH_RENT']; ?></td>
                          
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
          </div>
          </div>
      </div>
    <?php } ?>
    </div>




<br>

<script type="text/javascript">
     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true,
    })
  });

     $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });

     $(".contenteditable").keypress(function(e) {
          if ((e.which < 48 || e.which > 57) && (e.which != 46)) e.preventDefault();
      });

     function updateDatas(column_name,emp_id)
     {
        var cell_value = $('#'+column_name+'_'+emp_id).text();

        $.ajax({
          url:'<?php echo base_url('bulk_updation/employeeallowance/updateDatas'); ?>',
          data:{column_name:column_name,emp_id:emp_id,cell_value:cell_value},
          method:"post",
          dataType:"json",
          success:function()
          {
            $.toast({
                heading: 'Success',
                text: 'Saved Successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            });
          }
        });
     }
  </script>