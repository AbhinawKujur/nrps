<html>
<head>
  <style>
    @page { margin: 20px 25px 30px 20px; }
    #footer { position: fixed; right: 0px; bottom: 20px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }

        .table {
          border-collapse: collapse;
          font-size: 13px;
          white-space: nowrap;
        }

        .table, th, td {
          border: 1px solid black;
           padding: 0px 5px;
        }
        .name {
          text-align: left;
        }
        .text-right {
          text-align: right;
        }
        .text-center {
          text-align: center;
        }
        .thead-color{
          background: #abb0ac !important;
        }
        .not-border{
          border: none;
          border-left: 1px solid black;
        }
  </style>
<body>
  <!-- <div id="header">
    <h1>Widgets Express</h1>
  </div> -->
 <!--  <div id="footer">
    <p style="float: left;"><?php echo $school_setting['short_nm'].' '.$current_session['Session_Nm']; ?></p>
    <p class="page" style="float: right;">Page </p>
  </div>  -->
  <div style="clear: all;"></div>
  <div id="content">  
    <?php $totalEmp = count($employeeList); ?>
    <?php foreach ($employeeList as $key => $value) { ?>
      <table style="width: 100%;" class="table">
          <tr>
            <th class="text-center" colspan="4">FORM NO.16<br>PART B (Annexure)</th>
          </tr>
          <tr>
            <td><b>Personal ID :</b> <?php echo $value['EMPID']; ?></td>
            <td colspan="3"><b>Employee Name :</b> <?php echo strtoupper($value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']); ?></td>
          </tr>
          <tr>
            <td><b>PAN No. of the Employee:</b> <?php echo $value['PAN_NUMBER']; ?></td>
            <td colspan="3"></td>
          </tr>
          <tr>
            <th class="text-center" colspan="4">DETAILS OF SALARY PAID AND ANY OTHER INCOME AND TAX DEDUCTED</th>
          </tr>
          <tr>
            <td class="not-border">1. Gross Salary</td>
            <td class="not-border"></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  (a) Salary as per provisions contained in Section 17(1)</td>
            <td class="text-right not-border"><?php $a = $payslip[$value['id']]['total_gross_salary']; echo number_format($a,2); ?></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  (b) Value of prerequisites under Section 17(2) (as per Form No.12BA, <br>&nbsp; &nbsp; &nbsp;  wherever applicable)</td>
            <td class="text-right not-border"><?php $b = 0; echo number_format($b,2); ?></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  (c) Profits in lien of Salary under Section 17(3) (as per Form No.12BA, <br>&nbsp; &nbsp; &nbsp;  wherever applicable)</td>
            <td class="text-right not-border"><?php $c = 0; echo number_format($c,2); ?></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  (d) Total</td>
            <td class="text-right not-border"></td>
            <th class="not-border text-right"><?php $d = ($a+ $b + $c); echo number_format($d,2); ?></th>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border">2. Less : Allowance to be exempted under Section 10</td>
            <td class="not-border"></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  Conveyance - Section 10 (14)</td>
            <td class="not-border text-right"><?php $e = 0; echo number_format($e,2); ?></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <th class="not-border"> &nbsp; &nbsp; &nbsp;  Total</th>
            <th class="not-border"></th>
            <th class="not-border text-right"><?php echo number_format($e,2); ?></th>
            <th class="not-border"></th>
          </tr>
          <tr>
            <td class="not-border">3. Balance (1-2)</td>
            <td class="not-border"></td>
            <th class="not-border text-right"><?php $f = $d-$e; echo number_format($f,2); ?></th>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border">4. Deductions :</td>
            <td class="not-border"></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  (a) Entertainment Allowance</td>
            <td class="text-right not-border"><?php $g = 0; echo number_format($g,2); ?></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  (b) Tax on employment</td>
            <td class="text-right not-border"><?php $h = $payslip[$value['id']]['total_prof_tax']; echo number_format($h,2); ?></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border">5. Aggregate of 4 (a) to (b) </td>
            <td class="not-border"></td>
            <td class="not-border text-right"><?php $i = $g+$h; echo number_format($i,2); ?></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border">6. Income Chargeable under the head "SALARIES" (3-5)</td>
            <td class="not-border"></td>
            <td class="not-border text-right"></td>
            <th class="not-border text-right"><?php $j = $f-$i; echo number_format($j,2); ?></th>
          </tr>
          <tr>
            <td class="not-border">7. Add : Any other Income reported by the Employee</td>
            <td class="not-border"></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  Interest on Let out property</td>
            <td class="text-right not-border"><?php $k = 0; echo number_format($k,2); ?></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  Total</td>
            <td class="text-right not-border"></td>
            <td class="not-border"></td>
            <th class="not-border text-right"><?php  echo number_format($k,2); ?></th>
          </tr>
          <tr>
            <td class="not-border">8. Gross Total Income (6 + 7) </td>
            <td class="not-border"></td>
            <td class="not-border text-right"></td>
            <th class="not-border text-right"><?php $l = $j+$k; echo number_format($l,2); ?></th>
          </tr>
          <tr>
            <td class="not-border">9. Deduction under Chapter VIA</td>
            <td class="not-border"></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  <b>(A).</b> Sections 80C, 80CCC, 80CCD &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; <strong>Gross Amount</strong></td>
            <td class="text-right not-border"><strong>Qualifying Amount</strong></td>
            <td class="text-right not-border"><strong>Deductible Amount</strong></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  (a). Section 80C </td>
            <td class="text-right not-border"></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border">
              <table width="100%">
                <tr>
                  <td style="border:0px solid  white;"> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  1. Employee PF Deduction  
                  </td>
                  <td class="text-right" style="border:0px solid  white;"><?php $m = $payslip[$value['id']]['total_pf_own_deduct']; echo number_format($m,2); ?></td>
                </tr>
              </table>
            </td>
            <td class="text-right not-border"><?php echo number_format($m,2); ?></td>

            <td class="text-right not-border"><?php echo number_format($m,2); ?></td>
               
            <td class="text-right not-border"></td>
          </tr>
          <tr>
            <td style="border:0px solid  white;">
              <table width="100%">
                <tr>
                    <td style="border:0px solid  white;"> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  2. Principal Loan Repayment
                    </td>
                    <td class="text-right" style="border:0px solid  white;"> <?php $n=0; echo number_format($n,2); ?></td>
                  </tr>
                </table>
              </td>
              <td class="text-right not-border"><?php echo number_format($n,2); ?></td>
          
              <td class="text-right not-border"><?php echo number_format($n,2); ?></td>
         
              <td class="text-right not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  (b). Section 80CCC </td>
            <td class="text-right not-border"><?php $o=0; echo number_format($o,2); ?></td>
            <td class="not-border text-right"><?php echo number_format($o,2); ?></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;  (c). Section 80CCD </td>
            <td class="text-right not-border"><?php $p=0; echo number_format($p,2); ?></td>
            <td class="not-border text-right"><?php echo number_format($p,2); ?></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  Note:1 - Aggregate amount deductible under Section 80C <br> &nbsp; &nbsp; &nbsp; shall not exceed one lakh rupees</td>
            <td class="not-border"></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
             <td class="not-border"> &nbsp; &nbsp; &nbsp;  Note:2 - Aggregate amount deductible under Section, ie, 80C, 80CCC  <br> &nbsp; &nbsp; &nbsp;  and 80CCD, shall not exceed one lakh rupees</td>
            <td class="not-border"></td>
            <td class="not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border"> &nbsp; &nbsp; &nbsp;  <b>(B).</b> Other Sections (for e.g., 80E, 80G etc.)</td>
            <td class="text-right not-border"></td>
            <td class="text-right not-border"></td>
            <td class="not-border"></td>
          </tr>
          <tr>
            <th class="not-border text-right">Gross Amount</th>
            <th class="text-right not-border">Qualifying Amount</th>
            <th class="text-right not-border">Deductible Amount</th>
            <td class="not-border"></td>
          </tr>
          <tr>
            <td class="not-border">10. Aggregate of Deductible Amount under Chapter VIA</td>
            <td class="not-border"></td>
            <td class="not-border text-right"></td>
            <th class="not-border text-right"><?php $q= $m+ $n + $o + $p; echo number_format($q,2); ?></th>
          </tr>
          <tr>
            <td class="not-border">11. Total Income (8-10) </td>
            <td class="not-border"></td>
            <td class="not-border text-right"></td>
            <th class="not-border text-right"><?php $r= $l - $q; echo number_format($r,2); ?></th>
          </tr>
          <tr>
            <td class="not-border">12. Tax on Total Income </td>
            <td class="not-border"></td>
            <td class="not-border text-right"></td>
            <th class="not-border text-right"><?php $s= 0; echo number_format($s,2); ?></th>
          </tr>
          <tr>
            <td class="not-border">13. Education Cess @3% (on tax computed at S.No. 12)</td>
            <td class="not-border"></td>
            <td class="not-border text-right"></td>
            <th class="not-border text-right"><?php $t= 0; echo number_format($t,2); ?></th>
          </tr>
          <tr>
            <td class="not-border">14. Tax Payable (12 + 13) </td>
            <td class="not-border"></td>
            <td class="not-border text-right"></td>
            <th class="not-border text-right"><?php $u= $s + $t; echo number_format($u,2); ?></th>
          </tr>
          <tr>
            <td class="not-border">15. Less: Relief under Section 89 (attach details)</td>
            <td class="not-border"></td>
            <td class="not-border text-right"></td>
            <th class="not-border text-right"><?php $v= 0; echo number_format($v,2); ?></th>
          </tr>
          <tr>
            <td class="not-border">16. Tax Payable (14 - 15)</td>
            <td class="not-border"></td>
            <td class="not-border text-right"></td>
            <th class="not-border text-right"><?php $w= $u-$v; echo number_format($w,2); ?></th>
          </tr>

          <tr>
            <th class="text-center" colspan="4" style="border-bottom: none;padding-top: 25px;">Verification<br></th>
          </tr>
          <tr>
            <td class="text-center" colspan="4" style="text-align: justify;white-space: normal;border-top: none;border-bottom: none;">I. <?php echo $principalDetails['EMP_FNAME'].' '.$principalDetails['EMP_MNAME'].' '.$principalDetails['EMP_LNAME']; ?>, son/daughter of <?php echo $principalDetails['FATHERS_NAME']; ?> working in the capacity of <strong>Authorised Signatory</strong> do hereby certify that a sum of Rs. <?php  echo number_format($w,2); ?> has been deducted at source and paid to the credit of the Central Government. I further certify that the information given above is true, complete and correct and is based on the books of account, documents. TDS statement, TDS deposited and other available records.</td>
          </tr>
          <tr>
            <td class="text-center" style="text-align: justify;white-space: normal;border-top: none;border-right: none;padding-top:35px;">
              Place:  &nbsp; &nbsp; &nbsp;  Ranchi<br>
              Date:  &nbsp; &nbsp; &nbsp;   <?php echo date('d-M-Y'); ?>
            </td>
            <td class="text-center" colspan="3" style="text-align: justify;white-space: normal;border-top: none;padding-top:35px;border-left: none;">
              Signature of the person responsible for deduction of tax<br>
              Full Name:  &nbsp; &nbsp; &nbsp; &nbsp;  <strong><?php echo $principalDetails['EMP_FNAME'].' '.$principalDetails['EMP_MNAME'].' '.$principalDetails['EMP_LNAME']; ?></strong><br>
              Designation: &nbsp; &nbsp; &nbsp;Authorised Signatory
            </td>
          </tr>
      </table>
      <?php if($totalEmp > $key+1){ ?>
        <div style="clear: all;page-break-after: always;"></div>
      <?php } ?>
    <?php } ?>
  </div>
</body>
</html>