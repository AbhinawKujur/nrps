 <style type="text/css">
   .error{
    color: red;
   }
   .box-header>.box-tools {
        position: relative;
    }
    .loader {
      position: fixed;
      top: 50%;
      left: 50%;
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
      }
    .thead-colors{
      background: #d1e6da !important;
    }
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
input[type="text"]
{
  text-transform: uppercase;
}
 </style>
 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Edit Payroll Details</li>
</ol>
 <div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
   <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <!-- Content Header (Page header) -->
        <section class="content">
          <form role="form" action="<?php echo base_url('employee/payroll_details/updateProcess/').$singleData['id']; ?>" method="post" id="myform">
            <div class="box box-primary">
              <center><strong><?php echo $singleData['EMPID'].' ('.$singleData['EMP_FNAME'].' '.$singleData['EMP_MNAME'].' '.$singleData['EMP_LNAME']. ')'; ?></strong></center>
              <div class="box-header with-border">
                <h3 class="box-title">Payroll Details</h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body">   
                  <div class="row">
                    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Level No</label><span class="req">*</span>
                        <select class="form-control" name="level_no" id="level_no" onchange="getLevelYear()">
                          <option value="">Select</option>
                          <?php foreach($level_no as $key => $value){ ?>
                            <option value="<?php echo $value['level_no']; ?>" <?php if(set_value('level_no',$singleData['LEVEL_NO'])==$value['level_no']){ echo "selected";} ?>><?php echo $value['level_no']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Level Year</label><span class="req">*</span>
                        <select class="form-control" name="level_year" id="level_year" onchange="getPay()">
                        </select>
                      </div>
                    </div>   
                     <div class="col-sm-3">
                      <!-- checkbox -->
                      <div class="form-group">
                        <label>Basic / Pay Matrix</label><span class="req">*</span>
                        <input type="text" name="basic_pay" class="form-control" autocomplete="off" value="<?php echo set_value('basic_pay'); ?>"  id="basic_pay">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="form-group">
                        <label>Pension Applied</label>
                        <div class="form-group">
                          <label>
                            <input type="radio" name="pension_applied" class="flat-red pension_applied" value="1" <?php if($singleData['pension_applied']==1){ echo "checked"; } ?>>
                            Yes
                          </label>
                          <label>
                            <input type="radio" name="pension_applied" class="flat-red pension_applied" value="0" <?php if($singleData['pension_applied']==0){ echo "checked"; } ?>>
                            No
                          </label>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Pension A/C No.</label><span class="req"> *</span>
                        <input type="text" name="pension_ac" class="form-control pension_ac_no" autocomplete="off" value="<?php echo set_value('pension_ac',$singleData['pension_ac']); ?>" required="" <?php if($singleData['pension_applied']==0){ echo "disabled"; } ?>>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Grade Pay</label>
                        <input type="text" name="grade_pay" class="form-control" autocomplete="off" value="<?php echo set_value('grade_pay',$singleData['GRADEPAY']); ?>" id="grade_pay">
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>VPF</label>
                        <input type="text" name="vpf" class="form-control" autocomplete="off" value="<?php echo set_value('vpf',$singleData['VPF']); ?>" id="vpf">
                      </div>
                    </div>   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Bank A/C No.</label>
                        <input type="text" name="bank_ac" class="form-control" autocomplete="off" value="<?php echo set_value('bank_ac',$singleData['BANK_AC_NO']); ?>">
                      </div>
                    </div>  
                   <!--  <div class="col-sm-3">
                      <div class="form-group">
                        <label></label><br>
                        <label>
                          <input type="checkbox" class="flat-red" name="2nd_shift_allowance" value="1" <?php if($singleData['SECOND_SHIFT_ALLOW']==1){ echo "checked"; } ?>>
                          2nd Shift Allowance
                        </label>
                    </div>     
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                        <label></label><br>
                        <label>
                          <input type="checkbox" class="flat-red" name="special_allowance" value="1" <?php if($singleData['SPECIAL_ALLOW']==1){ echo "checked"; } ?>>
                          Special Allowance
                        </label>
                    </div>     
                  </div>   -->
                  </div>
                  
                  <div class="row">
                      
                    <!-- <div class="col-sm-3">
                      <div class="form-group">
                        <label>Group Insurance Policy</label>
                        <div class="form-group">
                          <label>
                            <input type="radio" name="group_insurance_policy" class="flat-red group_insurance_policy" value="1" <?php if($singleData['GROUP_INS_POLI']==1){ echo "checked"; } ?>>
                            Yes
                          </label>
                          <label>
                            <input type="radio" name="group_insurance_policy" class="flat-red group_insurance_policy" value="0" <?php if($singleData['GROUP_INS_POLI']==0){ echo "checked"; } ?>>
                            No
                          </label>
                        </div>
                      </div>
                    </div>   
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Group Insurance Policy Slab</label>
                        <select name="group_insurance_policy_slab" class="form-control group_insurance_policy_slab"  <?php if($singleData['GROUP_INS_POLI']==0){ echo "disabled"; } ?>>
                          <option value="">Select</option>
                          <option value="75000" <?php if(set_value('group_insurance_policy_slab',$singleData['INS_POLNO'])=='75000'){ echo "selected"; }  ?>>75000</option>
                          <option value="150000" <?php if(set_value('group_insurance_policy_slab',$singleData['INS_POLNO'])=='150000'){ echo "selected"; }  ?>>150000</option>
                          <option value="200000" <?php if(set_value('group_insurance_policy_slab',$singleData['INS_POLNO'])=='200000'){ echo "selected"; }  ?>>200000</option>
                        </select>
                      </div>
                    </div>   -->
                  </div>

                  <div class="row">
                    <div class="col-sm-3">
                      <!-- checkbox -->
                      <div class="form-group">
                        <label>ESI Applied</label>
                        <div class="form-group">
                          <label>
                            <input type="radio" name="esi_applied" class="flat-red esi_applied" value="1" <?php if($singleData['ESI_APP']==1){ echo "checked"; } ?>>
                            Yes
                          </label>
                          <label>
                            <input type="radio" name="esi_applied" class="flat-red esi_applied" value="0"  <?php if($singleData['ESI_APP']==0){ echo "checked"; } ?>>
                            No
                          </label>
                        </div>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>ESI A/C No.</label>
                        <input type="text" name="esi_ac_no" class="form-control esi_ac_no" autocomplete="off" value="<?php echo set_value('esi_ac_no',$singleData['ESI_AC_NO']); ?>"  <?php if($singleData['ESI_APP']==0){ echo "disabled"; } ?>>
                      </div>
                    </div>     
                    <div class="col-sm-3">
                      <!-- checkbox -->
                      <div class="form-group">
                        <label>TA Allowance Applied</label>
                        <div class="form-group">
                          <label>
                            <input type="radio" name="ta_allowance_applied" class="flat-red ta_allowance_applied" value="1" <?php if($singleData['TA_ALLOWANCE_APP']==1){ echo "checked"; } ?>>
                            Yes
                          </label>
                          <label>
                            <input type="radio" name="ta_allowance_applied" class="flat-red ta_allowance_applied" value="0" <?php if($singleData['TA_ALLOWANCE_APP']==0){ echo "checked"; } ?>>
                            No
                          </label>
                        </div>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>TA Slab</label>
                        <select class="form-control ta_slab" name="ta_slab"  <?php if($singleData['TA_ALLOWANCE_APP']==0){ echo "disabled"; } ?>>
                          <option value="">select</option>
                          <?php foreach ($taslab as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('ta_slab',$singleData['TA_SLAB'])==$key){ echo "selected"; } ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>  
                     <div class="col-sm-3">
                      <div class="form-group">
                        <label>HRA Applied</label>
                        <div class="form-group">
                          <label>
                            <input type="radio" name="hra_applied" class="flat-red" value="1" <?php if($singleData['HRA_APP']==1){ echo "checked"; } ?>>
                            Yes
                          </label>
                           <label>
                            <input type="radio" name="hra_applied" class="flat-red" value="0" <?php if($singleData['HRA_APP']==0){ echo "checked"; } ?>>
                            No
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                    <div class="form-group">
                      <div class="form-group">
                      <label>Adhoc</label>
                      <div class="form-group">
                        <label>
                          <input type="radio" name="adhoc" class="flat-red" value="1" <?php if($singleData['AD_HOC']==1){ echo "checked"; } ?>>
                          Yes
                        </label>
                        <label>
                          <input type="radio" name="adhoc" class="flat-red" value="0" <?php if($singleData['AD_HOC']==0){ echo "checked"; } ?>>
                          No
                        </label>
                      </div>
                    </div>
                    </div>
                  </div>
                    <!-- <div class="col-sm-3">
                      <div class="form-group"> -->
                        <!-- <label>EPS A/C No</label>
                        <input type="text" name="eps_ac_no" class="form-control eps_ac_no" autocomplete="off" value="<?php echo set_value('eps_ac_no',$singleData['EPS_AC_NO']); ?>"  <?php if($singleData['HRA_APP']==0){ echo "disabled"; } ?>> -->
                       <!--  <label>HRA Amount</label>
                        <input type="text" name="hra_amount" class="form-control hra_amount" autocomplete="off" readonly="">
                      </div>
                    </div>   -->
                  </div>

                 <!--  <div class="row">
                      
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Quarter No</label><span class="req"> *</span>
                        <input type="text" name="quater_no" class="form-control hra_applied_field" autocomplete="off" value="<?php echo set_value('quater_no',$singleData['QUATER_NO']); ?>" <?php if($singleData['HRA_APP'] != 1){ echo "disabled"; } ?>>
                      </div>
                    </div>    
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Quarter Type</label><span class="req"> *</span>
                        <select class="form-control hra_applied_field" name="quater_type" <?php if($singleData['HRA_APP'] != 1){ echo "disabled"; } ?>>
                          <option value="">Select Quarter Type</option>
                          <option value="Mecon" <?php if(set_value('quater_type',$singleData['QUATER_TYPE']) == 'Mecon') ?>>Mecon</option>
                          <option value="Sail" <?php if(set_value('quater_type',$singleData['QUATER_TYPE']) == 'Sail') ?>>Sail</option>
                          <option value="Other" <?php if(set_value('quater_type',$singleData['QUATER_TYPE']) == 'Other') ?>>Other</option>
                        </select>
                      </div>
                    </div> 
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Quarter Area (Sq. Ft.)</label><span class="req"> *</span>
                        <input type="text" name="quater_area" class="form-control hra_applied_field" autocomplete="off" value="<?php echo set_value('quater_area',$singleData['QUATER_AREA']); ?>" <?php if($singleData['HRA_APP'] != 1){ echo "disabled"; } ?>>
                      </div>
                    </div>    
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>House Rent (<i class="fa fa-inr"></i>)</label><span class="req"> *</span>
                        <input type="text" name="house_rent" class="form-control hra_applied_field rent_amount house_rent" autocomplete="off" value="<?php echo set_value('house_rent',0); ?>" disabled="" onkeyup="rateCalculation()">
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Electricity (<i class="fa fa-inr"></i>)</label><span class="req"> *</span>
                        <input type="text" name="electricity_rent" class="form-control hra_applied_field rent_amount electricity_rent" autocomplete="off" value="<?php echo set_value('electricity_rent',0); ?>" disabled="" onkeyup="rateCalculation()">
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Security (<i class="fa fa-inr"></i>)</label><span class="req"> *</span>
                        <input type="text" name="security_rent" class="form-control hra_applied_field rent_amount security_rent" autocomplete="off" value="<?php echo set_value('security_rent',0); ?>" disabled="" onkeyup="rateCalculation()">
                      </div>
                    </div>  
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Garage Rent (<i class="fa fa-inr"></i>)</label><span class="req"> *</span>
                        <input type="text" name="garage_rent" class="form-control hra_applied_field rent_amount garage_rent" autocomplete="off" value="<?php echo set_value('garage_rent',0); ?>" disabled="" onkeyup="rateCalculation()">
                      </div>
                    </div>    
                  </div> -->

              </div>
            </div><br>
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">PF Details</h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body">   
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label>PF Applied</label>
                      <div class="form-group">
                        <label>
                          <input type="radio" name="pf_applied" class="flat-red pf_applied" value="1" <?php if($singleData['PF_APP']==1){ echo "checked"; } ?>>
                          Yes
                        </label>
                        <label>
                          <input type="radio" name="pf_applied" class="flat-red pf_applied" value="0"  <?php if($singleData['PF_APP']==0){ echo "checked"; } ?>>
                          No
                        </label>
                      </div>
                    </div>
                  </div>  
                  <div class="col-sm-4 prev_pf_ac_no_div">
                    <div class="form-group">
                      <label>Previous PF A/C No</label>
                      <input type="text" name="prev_pf_ac_no" class="form-control prev_pf_ac_no" autocomplete="off" value="<?php echo set_value('prev_pf_ac_no',$singleData['LAST_PFNO']); ?>" <?php if($singleData['PF_APP']==0){ echo "disabled"; } ?>>
                    </div>
                  </div> 
                  <div class="col-sm-4 pf_ac_no_div">
                    <div class="form-group">
                      <label>PF A/C No</label>
                      <input type="text" name="pf_ac_no" class="form-control pf_ac_no" autocomplete="off" value="<?php echo set_value('pf_ac_no',$singleData['PF_AC_NO']); ?>" <?php if($singleData['PF_APP']==0){ echo "disabled"; } ?>>
                    </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                        <label>PF Joining Date</label>
                        <?php $pf_joining_date = ($singleData['PF_JOIN_DT'] != '' && $singleData['PF_JOIN_DT']!=NULL)?date('d-M-Y',strtotime($singleData['PF_JOIN_DT'])):""; ?>
                        <input type="text" name="pf_joining_date" class="form-control datepicker pf_joining_date" value="<?php echo $pf_joining_date; ?>" <?php if($singleData['PF_APP']==0){ echo "disabled"; } ?> autocomplete="off">
                      </div>
                    </div>  
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>UAN No</label>
                        <input type="text" name="uan_no" class="form-control uan_no" value="<?php echo set_value('uan_no',$singleData['UANNO']); ?>"  <?php if($singleData['PF_APP']==0){ echo "disabled"; } ?>  autocomplete="off">
                      </div>
                    </div>   
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Nominee Name</label>
                        <input type="text" name="nominee_name" class="form-control nominee_name" value="<?php echo set_value('nominee_name',$singleData['NOMINEE1']); ?>"  <?php if($singleData['PF_APP']==0){ echo "disabled"; } ?>  autocomplete="off">
                      </div>
                    </div>   
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Relation With Nominee</label>
                        <select class="form-control relation" name="relation"  <?php if($singleData['PF_APP']==0){ echo "disabled"; } ?>>
                          <option value="">select</option>
                          <?php foreach ($relationType as $key => $value) { ?>
                            <option value="<?php echo $key; ?>" <?php if(set_value('relation',$singleData['RELATIONTYPE'])==$key){ echo "selected"; } ?>><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>    
                </div>
              </div>
            </div><br>
             <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">LIC Details</h3><hr>
              </div>
              <!-- /.box-header -->
              <div class="box-body">   
                <div class="row">
                  <div class="col-sm-12">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="thead-colors">#</th>
                          <th class="thead-colors">Policy No</th>
                          <th class="thead-colors">Premium Amount</th>
                          <th class="thead-colors">Nominee Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td><input type="text" name="policy_no_1" class="form-control" autocomplete="off" value="<?php echo set_value('policy_no_1',$licData['policyno1']); ?>" required=""></td>
                          <td><input type="number" name="premium_amount_1" class="form-control" autocomplete="off" value="<?php echo set_value('premium_amount_1',$licData['premium_amt_1']); ?>" min="0" required=""></td>
                          <td><input type="text" name="nominee_name_1" class="form-control" autocomplete="off" value="<?php echo set_value('nominee_name_1',$licData['nominee1']); ?>" required=""></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td><input type="text" name="policy_no_2" class="form-control" autocomplete="off" value="<?php echo set_value('policy_no_2',$licData['policyno2']); ?>"  required=""></td>
                          <td><input type="number" name="premium_amount_2" class="form-control" autocomplete="off" value="<?php echo set_value('premium_amount_2',$licData['premium_amt_2']); ?>" min="0"  required=""></td>
                          <td><input type="text" name="nominee_name_2" class="form-control" autocomplete="off" value="<?php echo set_value('nominee_name_2',$licData['nominee2']); ?>"  required=""></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td><input type="text" name="policy_no_3" class="form-control" autocomplete="off" value="<?php echo set_value('policy_no_3',$licData['policyno3']); ?>"  required=""></td>
                          <td><input type="number" name="premium_amount_3" class="form-control" autocomplete="off" value="<?php echo set_value('premium_amount_3',$licData['premium_amt_3']); ?>" min="0"  required=""></td>
                          <td><input type="text" name="nominee_name_3" class="form-control" autocomplete="off" value="<?php echo set_value('nominee_name_3',$licData['nominee3']); ?>" required=""></td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td><input type="text" name="policy_no_4" class="form-control" autocomplete="off" value="<?php echo set_value('policy_no_4',$licData['policyno4']); ?>" required=""></td>
                          <td><input type="number" name="premium_amount_4" class="form-control" autocomplete="off" value="<?php echo set_value('premium_amount_4',$licData['premium_amt_4']); ?>" min="0" required=""></td>
                          <td><input type="text" name="nominee_name_4" class="form-control" autocomplete="off" value="<?php echo set_value('nominee_name_4',$licData['nominee4']); ?>" required=""></td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td><input type="text" name="policy_no_5" class="form-control" autocomplete="off" value="<?php echo set_value('policy_no_5',$licData['policyno5']); ?>" required=""></td>
                          <td><input type="number" name="premium_amount_5" class="form-control" autocomplete="off" value="<?php echo set_value('premium_amount_5',$licData['premium_amt_5']); ?>" min="0" required=""></td>
                          <td><input type="text" name="nominee_name_5" class="form-control" autocomplete="off" value="<?php echo set_value('nominee_name_5',$licData['nominee5']); ?>" required=""></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-black pull-right"><i class="fa fa-refresh"></i> Update</button>
              </div>
            </div><br>
          </form>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div><br><br>
<div class="loader"></div>
  <script type="text/javascript">
    $('.loader').hide();

       //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });

//disable field on yes or no option
$('.pf_applied').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".prev_pf_ac_no").removeAttr("disabled"); 
      $(".pf_ac_no").removeAttr("disabled"); 
      $(".pf_joining_date").removeAttr("disabled"); 
      $(".uan_no").removeAttr("disabled"); 
      $(".nominee_name").removeAttr("disabled"); 
      $(".relation").removeAttr("disabled"); 
    }
    else
    {
      $(".pf_ac_no").val('');
      $(".prev_pf_ac_no").val('');
      $(".pf_joining_date").val('');
      $(".uan_no").val('');
      $(".nominee_name").val('');
      $(".relation").val('');
       $(".pf_ac_no").attr("disabled", "disabled"); 
       $(".prev_pf_ac_no").attr("disabled", "disabled"); 
       $(".pf_joining_date").attr("disabled", "disabled"); 
       $(".uan_no").attr("disabled", "disabled"); 
       $(".nominee_name").attr("disabled", "disabled"); 
       $(".relation").attr("disabled", "disabled"); 
    }
});

$('.esi_applied').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".esi_ac_no").removeAttr("disabled"); 
    }
    else
    {
        $(".esi_ac_no").val('');
       $(".esi_ac_no").attr("disabled", "disabled"); 
    }
});

$('.hra_applied').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".hra_applied_field").removeAttr("disabled"); 
    }
    else
    {
       $(".hra_applied_field").val('0'); 
       $(".hra_applied_field").attr("disabled", "disabled"); 
    }
});

$('.pension_applied').on('ifChanged', function(event){
    if(this.value == 1)
    {
      $(".pension_ac_no").removeAttr("disabled"); 
    }
    else
    {
       $(".pension_ac_no").val(''); 
       $(".pension_ac_no").attr("disabled", "disabled"); 
    }
});

$('.ta_allowance_applied').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".ta_slab").removeAttr("disabled"); 
    }
    else
    {
       $(".ta_slab").val(''); 
       $(".ta_slab").attr("disabled", "disabled"); 
    }
});

$('.group_insurance_policy').on('ifChanged', function(event){
    if(this.value == '1')
    {
      $(".group_insurance_policy_slab").removeAttr("disabled"); 
    }
    else
    {
       $(".group_insurance_policy_slab").val(''); 
       $(".group_insurance_policy_slab").attr("disabled", "disabled"); 
    }
});


//validation
$(document).ready(function () {

    $('#myform').validate({ // initialize the plugin
        rules: {
             level_no: {
                required: true
            },
             level_year: {
                required: true
            },
             basic_pay: {
                required: true
            },
            pf_ac_no: {
                required: true,
            },
            pf_joining_date: {
                required: true,
            },
            nominee_name: {
                required: true,
            },
            uan_no: {
                required: true,
            },
            relation: {
                required: true,
            },
            esi_ac_no: {
                required: true,
            },
            eps_ac_no: {
                required: true,
            },
            ta_slab: {
                required: true,
            },
            group_insurance_policy_slab: {
                required: true,
            },
            bank_ac: {
                digits: true,
            },
            house_rent: {
                required: true,
                regexs: /^[0-9.]{1,40}$/
            },
            electricity_rent: {
                required: true,
                regexs: /^[0-9.]{1,40}$/
            },
            garage_rent: {
                required: true,
                regexs: /^[0-9.]{1,40}$/
            },
            security_rent: {
                required: true,
                regexs: /^[0-9.]{1,40}$/
            },
            quater_no: {
                required: true,
            },
            quater_type: {
                required: true,
            },
            quater_area: {
                digits: true,
            },
            vpf:{
              regexs: /^[0-9.]{1,40}$/
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

$.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "It accepts only , / - symbol"
);

//pan number validation
$.validator.addMethod(
        "regexs",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "Please do not enter any special character"
);

$(document).ready(function(){
  var level_year_data = '<?php echo set_value('level_year',$singleData['LEVEL_YEAR']); ?>';
  getLevelYear(level_year_data);
});
function getLevelYear(level_year_data=null)
{
  var div_data = "<option value=''>Select Level Year</option>";
  var level_no = $('#level_no').val();
  $.ajax({
      url: "<?php echo base_url('employee/employee/getLevelYear'); ?>",
      data: {level_no:level_no},
      type: "POST",
      dataType: 'json',
      success: function (result) {
           $.each(result, function (key, val) {
                if(val.level_year == level_year_data)
                {
                  var sel = "";
                  sel = "selected";
                  getPay();
                }
                div_data += "<option value='"+val.level_year+"'"+sel+">"+val.level_year+"</option>";
            });
           $('#level_year').html(div_data);
      }
  });
}
function getPay()
{
  var level_no = $('#level_no').val();
  var level_year = $('#level_year').val();
  if(level_year == null)
  {
    var level_year = '<?php echo $singleData['LEVEL_YEAR']; ?>';
  }
  $.ajax({
      url: "<?php echo base_url('employee/employee/getPay'); ?>",
      data: {level_year:level_year,level_no:level_no},
      type: "POST",
      dataType: 'json',
      success: function (result) {
           $('#basic_pay').val(result.pay);
      }
  });
}

  $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
    });

$('.select2').select2();

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

function rateCalculation()
{
  var house_rent = $('.house_rent').val();
  var electricity_rent = $('.electricity_rent').val();
  var security_rent = $('.security_rent').val();
  var garage_rent = $('.garage_rent').val();

  var total = Number(house_rent) +  Number(electricity_rent) +  Number(security_rent) + Number(garage_rent);
  $('.hra_amount').val(total);
}
</script>