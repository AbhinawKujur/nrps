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
    ACCOUNT TYPE : <?php echo $account_type['CAT_ABBR'].' (FIN. YEAR : '.schoolData['School_Session'].')'; ?><span class="page" style="margin-left: 35%;">Page </span>
    <br>
    <div class="text-center">TRIAL BALANCE FROM <?php echo date('d-M-Y',strtotime($date_from)).' TO '. date('d-M-Y',strtotime($date_to)); ?></div>
    <hr>
  </header>
   <div id="footer">
      <!-- <p class="page">Page </p> -->
    </div> 
  <div id="content">
    <div>
      <table style="width: 100%;" class="table">
        <thead>
          <tr>
            <th class="thead-color text-center th" width="10%">SNo</th>
            <th class="thead-color th" width="50%" style="padding-left: 5px;">PARTICULARS</th>
            <th class="thead-color th text-center" width="10%">LEDGER<br>CODE</th>
            <th class="thead-color th text-center" width="15%">Dr.<br>AMOUNT<br>Rs.</th>
            <th class="thead-color th text-center" width="15%">Cr.<br>AMOUNT<br>Rs.</th>
          </tr>
        </thead>
        <tbody style="padding-bottom: 5px;">         

          <?php 
          $i=0; $j=0; $totaldr = 0; $totalcr = 0;
          foreach ($schoolGroupList as $key => $value) { ?>
            <tr>
              <td class="text-center"><b><?php echo $i = number_format($i+1,2); $j = $i; ?></b></td>
              <td style="padding-left: 5px;"><strong><?php echo $value['CAT_ABBR']; ?></strong></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <?php foreach ($reportList[$value['cat_code']] as $keys => $val) {  
              $final_bal = $calculatedResult['bal'][$val['AcNo']];
              if($final_bal != 0):
              ?>
                <tr>
                  <td class="text-center"><?php echo number_format(($j = $j + 0.01),2); ?></td>
                  <td style="padding-left: 5px;"><?php echo $val['CCode']; ?></td>
                  <td class="text-center"><?php echo $val['AcNo']; ?></td>
                  <td class="text-right">
                    <?php if($final_bal > 0){ 
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
                </tr>
            <?php endif; } ?>
              <tr>
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
            <td colspan="3" ></td>
            <td class="text-right"><?php echo number_format($totaldr,2); ?></td>
            <td class="text-right"><?php echo number_format($totalcr,2); ?></td>
          </tr>
          <?php 
          if($totaldr < $totalcr)
          { ?>
            <tr>
              <td colspan="3" class="text-center">Difference in Trial Balance Rs.</td>
              <td class="text-right"><?php echo number_format(($totalcr - $totaldr),2); ?></td>
              <td></td>
            </tr>
          <?php } elseif($totaldr > $totalcr){ ?>
            <tr>
              <td colspan="3" class="text-center">Difference in Trial Balance Rs.</td>
              <td class="text-right"><?php echo number_format(($totaldr - $totalcr),2); ?></td>
            </tr> 
          <?php } ?>

          <?php if($totalcr != $totaldr){ ?>
            <tr>
              <td colspan="3" class="th"></td>
              <td class="th text-right">
                <?php if($totaldr < $totalcr){
                  echo number_format($totaldr + ($totalcr - $totaldr),2);
                }else{
                  echo number_format($totaldr,2);
                }  ?>
              </td>
              <td class="th text-right">
                <?php if($totaldr > $totalcr){
                  echo number_format($totalcr + ($totaldr - $totalcr),2);
                }else{
                  echo number_format($totalcr,2);
                } ?>
              </td>
            </tr>
          <?php } ?>
        </tfoot>
      </table>
      <p class="text-right">Soft Solution MICA Ranchi</p>
    </div>
  </div>
  </body>
</html>