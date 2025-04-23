<html>
<head>
  <style>
    @page { margin: 140px 25px 50px 25px; }
    header { position: fixed; top: -110px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
    #footers { position: fixed; right: 0px; bottom: 50px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }
.page:after { content: counter(page, decimal); }
        .table,.th{
          border-collapse: collapse;
          border: 1px solid black;
          font-size: 12px;
        }
        .table tr th,.table tr td{
          border-collapse: collapse;
          border-left: 1px solid black;
        }
        .name {
          text-align: left;
        }
        .text-center{
          text-align: center;
        }
        .text-right{
          text-align: right;
        }
        .thead-color{
          background: #e3e3e3 !important;
        }
        body{
          font-family: Verdana,Geneva,sans-serif;
          font-size: 10pt;
        }
  </style>
</head>
<body>
  <header id="header">
      <div style="text-align: center;font-size: 15px;font-weight: bold;">
        <span><?php echo schoolData['School_Name'] ?> </span>
        <br><span><?php echo schoolData['School_Address'] ?> </span><br>
      </div>
    <hr>
    ACCOUNT TYPE : <?php echo $account_type['CAT_ABBR'].' (FIN. YEAR : '.schoolData['School_Session'].')'; ?><span class="page" style="margin-left: 45%;">Page </span>
    <br>
    <div class="text-center">TRIAL BALANCE FROM <?php echo date('d-M-Y',strtotime($date_from)).' TO '. date('d-M-Y',strtotime($date_to)); ?></div>
    <hr>
  </header>
   <div id="footer" style="border-top: 1px solid black;margin-top: 2px;">
      <!-- <p class="page">Page </p> -->
      <p class="text-right">Soft Solution MICA Ranchi</p>
    </div> 
  <div id="content">
    <div>
      <table style="width: 100%;" class="table">
        <thead>
          <tr>
            <th class="thead-color text-center th" rowspan="2">SNo</th>
            <th class="thead-color th" style="padding-left: 5px;" rowspan="2">PARTICULARS</th>
            <th class="thead-color th text-center" rowspan="2">LEDGER<br>CODE</th>
            <th class="thead-color th text-center" colspan="2">Balance Upto <br><?php echo date('d-M-Y',strtotime('-1 day', strtotime($date_from))); ?></th>
            <th class="thead-color th text-center" colspan="2">Transaction During The Period <br> <?php echo date('d-M-Y',strtotime($date_from)).' TO '. date('d-M-Y',strtotime($date_to)); ?></th>
            <th class="thead-color th text-center" colspan="2">Net Balance As On<br> <?php echo date('d-M-Y',strtotime($date_to)); ?></th>
          </tr>
          <tr>
            <th class="thead-color th text-center">Dr.<br>Amount<br>Rs.</th>
            <th class="thead-color th text-center">Cr.<br>Amount<br>Rs.</th>
            <th class="thead-color th text-center">Dr.<br>Amount<br>Rs.</th>
            <th class="thead-color th text-center">Cr.<br>Amount<br>Rs.</th>
            <th class="thead-color th text-center">Dr.<br>Amount<br>Rs.</th>
            <th class="thead-color th text-center">Cr.<br>Amount<br>Rs.</th>
          </tr>
        </thead>
        <tbody style="padding-bottom: 5px;">         

          <?php 
          $i=0; $j=0; $totaldr = 0; $totalcr = 0;$total_opening_cr = 0;$total_opening_dr = 0;$total_closing_cr = 0;$total_closing_dr = 0;
          foreach ($schoolGroupList as $key => $value) { ?>
            <tr>
              <td class="text-center"><b><?php echo $i = number_format($i+1,2); $j = $i; ?></b></td>
              <td style="padding-left: 5px;"><strong><?php echo $value['CAT_ABBR']; ?></strong></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <?php 
            if(!empty($reportList[$value['cat_code']])):
            foreach ($reportList[$value['cat_code']] as $keys => $val) {  

              $opening_bal = $calculatedResult['ob'][$val['AcNo']];
              $final_bal = $calculatedResult['bal'][$val['AcNo']];

              if($final_bal != 0 || $opening_bal!=0):
              ?>
                <tr>
                  <td class="text-center"><?php echo number_format(($j = $j + 0.01),2); ?></td>
                  <td style="padding-left: 5px;"><?php echo $val['CCode']; ?></td>
                  <td class="text-center"><?php echo $val['AcNo']; ?></td>
                  <td class="text-right">
                    <?php if($opening_bal > 0){ 
                      echo number_format(abs($opening_bal),2); 
                      $total_opening_dr += abs($opening_bal);
                    } ?>
                  </td>
                  <td class="text-right">
                    <?php if($opening_bal <0){
                      echo number_format(abs($opening_bal),2); 
                      $total_opening_cr += abs($opening_bal);
                    } ?>
                  </td>
                  <td class="text-right">
                    <?php if($final_bal > 0 || $final_bal == 0){ 
                      echo number_format(abs($final_bal),2); 
                      $bal = abs($final_bal); 
                      $totaldr = $totaldr + $bal;
                    } ?>
                  </td>
                  <td class="text-right">
                    <?php if($final_bal < 0){ 
                      echo number_format(abs($final_bal),2); 
                      $bal = abs($final_bal); 
                      $totalcr = $totalcr + $bal;
                    } ?>
                  </td>
                  <?php $closing_bal = $opening_bal + $final_bal; ?>
                  <td class="text-right">
                    <?php if($closing_bal >= 0){ 
                      echo number_format(abs($closing_bal),2); 
                      $total_closing_dr += abs($closing_bal);
                    } 
                     ?>
                  </td>
                  <td class="text-right">
                   <?php if($closing_bal < 0){ 
                      echo number_format(abs($closing_bal),2); 
                      $total_closing_cr += abs($closing_bal);
                    } 
                     ?>
                  </td>
                </tr>
            <?php endif; } endif;?>
              <tr>
                <td>&nbsp; </td>
                <td>&nbsp; </td>
                <td>&nbsp; </td>
                <td>&nbsp; </td>
                <td>&nbsp; </td>
                <td>&nbsp; </td>
                <td>&nbsp; </td>
                <td>&nbsp; </td>
                <td>&nbsp; </td>
              </tr>
          <?php } ?>
        </tbody>       
        <tfoot style="border-top: 1px solid black;">
          <tr>
            <td colspan="3"></td>
            <td class="text-right"><?php echo number_format($total_opening_dr,2); ?> </td>
            <td class="text-right"><?php echo number_format($total_opening_cr,2); ?> </td>
            <td class="text-right"><?php echo number_format($totaldr,2); ?> </td>
            <td class="text-right"><?php echo number_format($totalcr,2); ?> </td>
            <td class="text-right"><?php echo number_format($total_closing_dr,2); ?> </td>
            <td class="text-right"><?php echo number_format($total_closing_cr,2); ?> </td>
          </tr>
          <?php 
          if($total_opening_dr < $total_opening_cr)
          { ?>
            <tr>
              <td colspan="3" class="text-center">Difference in Trial Balance Rs.</td>
              <td class="text-right"><?php echo number_format(($total_opening_cr - $total_opening_dr),2); ?></td>
              <td colspan="5"></td>
            </tr>
          <?php } elseif($total_opening_dr > $total_opening_cr){ ?>
            <tr>
              <td colspan="3" class="text-center">Difference in Trial Balance Rs.</td>
              <td></td>
              <td class="text-right"><?php echo number_format(($total_opening_dr - $total_opening_cr),2); ?></td>
              <td colspan="4"></td>
            </tr> 
          <?php } ?>
        </tfoot>
      </table>
      
    </div>
  </div>
  </body>
</html>