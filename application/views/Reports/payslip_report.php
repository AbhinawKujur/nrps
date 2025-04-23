<?php error_reporting(0); ?>
<style type="text/css">
    .table {
  border-collapse: collapse;
}

.table, th, td {
  border: 1px solid #abb5c4;
  text-align: right;
}
.name {
  text-align: left;
}
*
{
    font-size:12px;
    font-weight:bold;
}
    @page { margin: 20px 5px 10px 20px; }
</style>
<div>
<p style='float:right; font-size:15px;'>Payslip Report Generation Date:<?php echo date('d-m-y'); ?></p><br />
    <table style="width: 80%;border: 0px;">
        <tr>
            <td style="width: 25%;text-align: center;border: none;"><img src="<?php echo $school_setting['SCHOOL_LOGO']; ?>"></td>
            <td style="text-align: center;border: none;">
                <h1 style='font-size:30px;'><?php echo $school_setting['School_Name']; ?></h1>
                <p style='font-size:22px; position:relative; top:-15px;'><?php echo $school_setting['School_Address'];  ?></p>
                <p style='font-size:22px; position:relative; top:-25px;'>Session (<?php echo $school_setting['School_Session']; ?>)</p>
            </td>
        </tr>
    </table>
</div>
<br />
<hr style='position:relative; top:-18px;'>
  <table class="table">
    <thead>
      <tr> 
       <th colspan="5" style="background: #337ab7 !important; color: white !important;text-align: center !important;"></th>
        <th colspan="7" style="background: #337ab7 !important; color: white !important;text-align: center !important;">Allowance</th>
        <th style="background: #337ab7 !important; color: white !important;text-align: center !important;"></th>
        <th colspan="12" style="background: #337ab7 !important; color: white !important;text-align: center !important;">Deduction</th>
        <th style="background: #337ab7 !important; color: white !important;text-align: center !important;"></th>
        <th colspan="6" style="background: #337ab7 !important; color: white !important;text-align: center !important;">Arrear</th>
        <th style="background: #337ab7 !important; color: white !important;text-align: center !important;"></th>
      </tr>
      <tr>
        <th style="background: #337ab7 !important; color: white !important;">S.No</th>
        <th style="background: #337ab7 !important; color: white !important;">Employee ID</th>  
        <th style="background: #337ab7 !important; color: white !important;">Employee NAME</th>  
        <th style="background: #337ab7 !important; color: white !important;">Working Days</th>  
        <th style="background: #337ab7 !important; color: white !important;">Present Days</th>   
        <th style="background: #337ab7 !important; color: white !important;">Actual Basic</th>   
        <th style="background: #337ab7 !important; color: white !important;">Basic Payable</th>   
        <th style="background: #337ab7 !important; color: white !important;">DA</th>   
        <th style="background: #337ab7 !important; color: white !important;">HRA</th>   
        <th style="background: #337ab7 !important; color: white !important;">TA</th>   
        <th style="background: #337ab7 !important; color: white !important;">Fixed Allow.</th>   
        <th style="background: #337ab7 !important; color: white !important;">Shift Allow.</th>   
        <th style="background: #337ab7 !important; color: white !important;">Gross Payable</th>   
        <th style="background: #337ab7 !important; color: white !important;">EPF</th>   
        <th style="background: #337ab7 !important; color: white !important;">FPF</th>   
        <th style="background: #337ab7 !important; color: white !important;">VPF</th>   
        <th style="background: #337ab7 !important; color: white !important;">ESI</th>   
        <th style="background: #337ab7 !important; color: white !important;">Prof. Tax</th>   
        <th style="background: #337ab7 !important; color: white !important;">LIC</th> 
        <th style="background: #337ab7 !important; color: white !important;">HR</th> 
        <th style="background: #337ab7 !important; color: white !important;">Group Insurance Amt</th>   
        <th style="background: #337ab7 !important; color: white !important;">Staff Welfare Fund</th>   
        <th style="background: #337ab7 !important; color: white !important;">TDS</th>   
        <th style="background: #337ab7 !important; color: white !important;">Medical</th>   
        <th style="background: #337ab7 !important; color: white !important;">Advance Salary</th>   
        <th style="background: #337ab7 !important; color: white !important;">Total Deduction</th>   
        <th style="background: #337ab7 !important; color: white !important;">Basic</th>   
        <th style="background: #337ab7 !important; color: white !important;">DA</th>   
        <th style="background: #337ab7 !important; color: white !important;">HRA</th>     
        <th style="background: #337ab7 !important; color: white !important;">TA</th>   
        <th style="background: #337ab7 !important; color: white !important;">Fixed Allow.</th>   
        <th style="background: #337ab7 !important; color: white !important;">Shift Allow.</th>   
        <th style="background: #337ab7 !important; color: white !important;">Payable Amount</th>   
      </tr>
    </thead>
    <tbody>
        <?php 

        $gross_payable = 0;
        $total_deduction = 0;
        $payable_amount = 0;
        foreach ($payslipEmpData as $key => $value) { 
            
                $gross_payable = $gross_payable + $value['12'];
                $total_deduction = $total_deduction + $value['25'];
                $payable_amount = $payable_amount + $value['32'];
            ?>
        <tr>
            <?php for ($i=1; $i <= 32; $i++) { ?>
                <?php if($i==2 || $i == 0) { ?>
                    <td class="name"><?php echo $value[$i]; ?></td>
                <?php }else{  ?>
                    <td><?php echo $value[$i]; ?></td>
            <?php } } ?>
        </tr>
        <?php } ?>
    </tbody>

     <tfoot>
        <tr>
            <th colspan="11" style="text-align: center;">Grand Total</th>
            <th><?php echo $gross_payable; ?></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><?php echo $total_deduction; ?></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><?php echo $payable_amount; ?></th>
        </tr>
    </tfoot>
  </table>