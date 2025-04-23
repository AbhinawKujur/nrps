<?php error_reporting(0); ?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Employee</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
 <div style="background-color: white;padding: 0px;border-top: 3px solid #5785c3;">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row" style="padding: 10px;text-align: center;">
            <div class="col-sm-12">
              <!-- <a href="<?php echo base_url('employee/employee/update/').$id; ?>" class="btn btn-danger" title="Edit Details" data-toggle="tooltip"><i class="fa fa-pencil"></i></a> -->
              <a href="#" class="btn btn-black" title="Change Password" data-toggle="tooltip" onclick="changePassword('<?php echo $employeeData['EMPID']; ?>')"><i class="fa fa-key"></i></a>
              <a href="<?php echo base_url('employee/payroll_details/update/').$id; ?>" class="btn btn-success" data-toggle="tooltip" title="Edit Payroll Details"><i class="fa fa-money"></i></a>
            </div>
          </div>
          <div class="row" id="printableArea">
            <div class="col-sm-6 col-xs-12">
              <table class="table table-stripped table-bordered" style="border: 1px solid #b2b9c4;">
                <tr style="background: #b2b9c4;">
                  <?php if($employeeData['profile_img'] == ''){ ?>
                    <td class="text-center" colspan="2"><img src="<?php echo base_url('assets/images/no_image.jpg'); ?>" class="img-circle" width="150" height="150" style="border: 2px solid #c6cad1;" alt="image"></td>
                  <?php } else { ?>
                    <td class="text-center" colspan="2"><img src="<?php echo base_url($employeeData['profile_img']); ?>" class="img-circle" width="150" height="150" style="border: 2px solid #c6cad1;" alt="image"></td>
                  <?php } ?>
                </tr>
                <tr>
                 <th colspan="2" class="text-center"><?php echo $employeeData['EMPID']; ?></th>
                </tr>
                 <tr>
                 <th colspan="2" class="text-center"><?php echo strtoupper($employeeData['EMP_FNAME'].' ' .$employeeData['EMP_MNAME'].' ' .$employeeData['EMP_LNAME']); ?></th>
                </tr>
                <tr>
                  <th>Username</th>
                  <td class="text-right"><?php echo $username; ?></td>
                </tr>
                <tr>
                  <th>Gender</th>
                  <td class="text-right"><?php echo $gender[$employeeData['SEX']]; ?></td>
                </tr>
                <tr>
                  <th>Category</th>
                  <td class="text-right"><?php echo $employeeData['CATEGORY']; ?></td>
                </tr>
                <tr>
                  <th>Designation</th>
                  <td class="text-right"><?php echo $employeeData['designation_name']; ?></td>
                </tr>
                <tr>
                  <th>Date of Birth</th>
                  <td class="text-right"><?php echo date("d-M-Y", strtotime($employeeData['D_O_B'])); ?></td>
                </tr>
                <tr>
                  <th>Date of Joining</th>
                  <td class="text-right"><?php echo date("d-M-Y", strtotime($employeeData['D_O_J'])); ?></td>
                </tr>
                <tr>
                  <th>Date of Retirement</th>
                  <td class="text-right"><?php echo date("d-M-Y", strtotime($employeeData['D_O_RETIER'])); ?></td>
                </tr>
                <tr>
                  <th>Mobile</th>
                  <td class="text-right"><?php echo $employeeData['C_MOBILE']; ?></td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td class="text-right"><?php echo $employeeData['C_EMAIL']; ?></td>
                </tr>
                 <tr>
                  <th>Role</th>
                  <td class="text-right"><?php echo $employeeData['role_name']; ?></td>
                </tr>
                <tr>
                  <th>Wing</th>
                  <td class="text-right"><?php echo $employeeData['wing_name']; ?></td>
                </tr>
                 <tr>
                  <th>Status</th>
                  <td class="text-right"><?php echo $statusList[$employeeData['STATUS']]; ?></td>
                </tr>
                <?php if($employeeData['STATUS'] != 1){ ?>
                  <tr>
                  <th>Date of Separation</th>
                  <td class="text-right"><?php echo date('d-M-Y',strtotime($employeeData['DATE_OF_SEPARATION'])); ?></td>
                </tr>
                <?php } ?>
                <tr><td></td><td></td></tr>
                <tr style="background: #b2b9c4;">
                  <th colspan="2">Basic Information</th>
                </tr>
                <tr>
                  <th>Father's Name</th>
                  <td class="text-right"><?php echo $employeeData['FATHERS_NAME']; ?></td>
                </tr>
                 <tr>
                  <th>Spouse Name</th>
                  <td class="text-right"><?php echo $employeeData['G_NAME']; ?></td>
                </tr>
                <tr>
                  <th>Employee Type</th>
                  <td class="text-right"><?php echo $employeeType[$employeeData['EMP_TYPE']]; ?></td>
                </tr>
                <tr>
                  <th>Staff Type</th>
                  <td class="text-right"><?php echo $staffType[$employeeData['STAFF_TYPE']]; ?></td>
                </tr>
                <?php if($employeeData['TEACHER_TYPE'] != ''){  ?>
                  <tr>
                    <th>Teacher Type</th>
                    <td class="text-right"><?php echo $teacherType[$employeeData['TEACHER_TYPE']]; ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <th>Employee Level</th>
                  <td class="text-right"><?php if($employeeData['EMP_LEVEL'] != '') { echo $empLevel[$employeeData['EMP_LEVEL']]; } ?></td>
                </tr>
                 <tr>
                  <th>Aadhaar Number</th>
                  <td class="text-right"><?php echo $employeeData['AADHAARNO']; ?></td>
                </tr>
                 <tr>
                  <th>PAN Number</th>
                  <td class="text-right"><?php echo $employeeData['PAN_NUMBER']; ?></td>
                </tr>
                <tr>
                  <th>Correspondence Address</th>
                  <td class="text-right"><?php echo $employeeData['C_ADD']; ?></td>
                </tr>
                <tr>
                  <th>Permanent Address</th>
                  <td class="text-right"><?php echo $employeeData['P_ADD']; ?></td>
                </tr>
                <tr><td></td><td></td></tr>
                <tr style="background: #b2b9c4;">
                  <th colspan="2">Qualification Details</th>
                </tr>
                <tr>
                  <th>Basic Qualification</th>
                  <td class="text-right"><?php echo $employeeData['qualification_name']; ?></td>
                </tr>
                <tr>
                  <th>Master Qualification</th>
                  <td class="text-right"><?php echo $employeeData['masterqual_name']; ?></td>
                </tr>
                 <tr>
                  <th>Professional Qualification</th>
                  <td class="text-right"><?php echo $employeeData['profqual_name']; ?></td>
                </tr>
              </table>
            </div>

            <div class="col-sm-6 col-xs-12">
              <table class="table table-stripped table-bordered" style="border: 1px solid #b2b9c4;">
                
                <tr style="background: #b2b9c4;">
                  <th colspan="2">Payroll Details</th>
                </tr>
                <tr>
                  <th>Contract Type</th>
                  <td class="text-right"><?php echo $employeeData['CONTRACT_TYPE']; ?></td>
                </tr>
                <tr>
                  <th>Level No</th>
                  <td class="text-right"><?php echo $employeeData['LEVEL_NO']; ?></td>
                </tr>
                <tr>
                  <th>Level Year</th>
                  <td class="text-right"><?php echo $employeeData['LEVEL_YEAR']; ?></td>
                </tr>
                <tr>
                  <th>Basic Pay</th>
                  <td class="text-right"><?php echo $employeeData['BASIC']; ?></td>
                </tr>
                 <tr>
                  <th>Grade Pay</th>
                  <td class="text-right"><?php echo $employeeData['GRADEPAY']; ?></td>
                </tr>
                <tr>
                  <th>VPF</th>
                  <td class="text-right"><?php echo $employeeData['VPF']; ?></td>
                </tr>
                <tr>
                  <th>ESI Applied</th>
                  <td class="text-right"><?php if($employeeData['ESI_APP'] == 1)
                  {
                  	echo "Yes";
                  }
                  else{
                  	echo "No";
                  } ?></td>
                </tr>
                <?php if($employeeData['ESI_APP'] == 1){ ?>
                  <tr>
                    <th>ESI Account No</th>
                    <td class="text-right"><?php echo $employeeData['ESI_AC_NO']; ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <th>HRA Applied</th>
                  <td class="text-right"><?php if($employeeData['HRA_APP'] == 1)
                  {
                  	echo "Yes";
                  }
                  else{
                  	echo "No";
                  } ?></td>
                </tr>
                <?php if($employeeData['HRA_APP'] == 1){ ?>
                  <tr>
                    <th>EPS Account No</th>
                    <td class="text-right"><?php echo $employeeData['EPS_AC_NO']; ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <th>TA Allowance Applied</th>
                  <td class="text-right"><?php if($employeeData['TA_ALLOWANCE_APP'] == 1)
                  {
                  	echo "Yes";
                  }
                  else{
                  	echo "No";
                  } ?></td>
                </tr>
                <?php if($employeeData['TA_ALLOWANCE_APP'] == 1){ ?>
                  <tr>
                    <th>TA Slab</th>
                    <td class="text-right"><?php echo $taslab[$employeeData['TA_SLAB']]; ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <th>Group Insurance Policy</th>
                  <td class="text-right"><?php if($employeeData['GROUP_INS_POLI'] == 1)
                  {
                  	echo "Yes";
                  }
                  else
                  {
                  	echo "No";
                  } ?></td>
                </tr>
                <?php if($employeeData['GROUP_INS_POLI'] == 1){ ?>
                  <tr>
                    <th>Group Insurance Policy Slab</th>
                    <td class="text-right"><?php echo $employeeData['INS_POLNO']; ?></td>
                  </tr>
                <?php } ?>
                <tr>
                  <th>Bank Account Number</th>
                  <td class="text-right"><?php echo $employeeData['BANK_AC_NO']; ?></td>
                </tr>
                <tr><td></td><td></td></tr>
                 <tr style="background: #b2b9c4;">
                  <th colspan="2">PF Details</th>
                </tr>
               <tr>
                  <th>PF Applied</th>
                  <td class="text-right"><?php if($employeeData['PF_APP'] == 1){
                    echo "Yes";
                  }
                  else
                  {
                    echo "No";
                  } ?></td>
                </tr>
                <?php if($employeeData['PF_APP'] == 1){ ?>
                  <tr>
                    <th>Last PF Account No</th>
                    <td class="text-right"><?php echo $employeeData['LAST_PFNO']; ?></td>
                  </tr>
                  <tr>
                    <th>PF Account No</th>
                    <td class="text-right"><?php echo $employeeData['PF_AC_NO']; ?></td>
                  </tr>
                  <tr>
                    <th>PF Joining Date</th>
                    <td class="text-right"><?php $pf_joining_date = ($employeeData['PF_JOIN_DT']!='')?date("d-M-Y", strtotime($employeeData['PF_JOIN_DT'])):''; echo $pf_joining_date; ?></td>
                  </tr>
                  <tr>
                    <th>UAN No</th>
                    <td class="text-right"><?php echo $employeeData['UANNO']; ?></td>
                  </tr>
                  <tr>
                    <th>Nominee Name</th>
                    <td class="text-right"><?php echo $employeeData['NOMINEE1']; ?></td>
                  </tr>
                  <tr>
                    <th>Relation With Nominee</th>
                    <td class="text-right"><?php if($employeeData['RELATIONTYPE']){ echo $relationType[$employeeData['RELATIONTYPE']]; } ?></td>
                  </tr>
                <?php } ?>
                <tr><td></td><td></td></tr>
                 <tr style="background: #b2b9c4;">
                  <th colspan="2">Leave Details</th>
                </tr>
                <tr>
                  <th>Casual Leave (Opening)</th>
                  <td class="text-right"><?php echo $employeeData['CAS_LEAVE']; ?></td>
                </tr>
                <tr>
                  <th>Medical Leave (Opening)</th>
                  <td class="text-right"><?php echo $employeeData['ML']; ?></td>
                </tr>
                 <tr>
                  <th>Earned Leave (Opening)</th>
                  <td class="text-right"><?php echo $employeeData['EL']; ?></td>
                </tr>
                 <tr>
                  <th>Half Paid Leave (Opening)</th>
                  <td class="text-right"><?php echo $employeeData['hpl']; ?></td>
                </tr>
                <tr><td></td><td></td></tr>
                 <tr style="background: #b2b9c4;">
                  <th colspan="2">Extras Details</th>
                </tr>
                <tr>
                  <th>Quarter No</th>
                  <td class="text-right"><?php echo $employeeData['QUATER_NO']; ?></td>
                </tr>
                <tr>
                  <th>Quarter Type</th>
                  <td class="text-right"><?php echo $employeeData['QUATER_TYPE']; ?></td>
                </tr>
                 <tr>
                  <th>Quarter Area</th>
                  <td class="text-right"><?php echo $employeeData['QUATER_AREA']; ?></td>
                </tr>
                <tr>
                  <th>2nd Shift Allowance</th>
                  <td class="text-right"><?php  if($employeeData['SECOND_SHIFT_ALLOW']==1){ echo "Yes"; } else { echo "No"; } ?></td>
                </tr>
                <tr>
                  <th>Special Allowance</th>
                  <td class="text-right"><?php if($employeeData['SPECIAL_ALLOW']==1){ echo "Yes"; } else { echo "No"; } ?></td>
                </tr>

                <tr><td></td><td></td></tr>
                 <tr style="background: #b2b9c4;">
                  <th colspan="2">Shift Details</th>
                </tr>
                <tr>
                  <th>Shift</th>
                  <td class="text-right"><?php echo $shiftDetails['SHIFT_NAME']; ?></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div><br><br>
<center>
<input type="button" onclick="printDiv('printableArea')" value="Print" class="btn btn-primary" /></center>

<br>
<br>
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });
</script>