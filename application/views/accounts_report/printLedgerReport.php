 <html>
<head>
  <style>
    @page { margin: 140px 25px 50px 25px; }
    header { position: fixed; top: -110px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
    #footers { position: fixed; right: 0px; bottom: 50px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }
.page:after { content: counter(page, decimal); }
        .table,.th,tr,td{
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
        .border-none{
          border: none;
        }
  </style>
</head>
<body>
  <?php $session_year = schoolData['School_Session']; 
    $year = explode('-', $session_year);
    $start_year = $year[0];
    $end_year = $year[1];
  ?>
  <header id="header">
      <div style="text-align: center;font-size: 15px;font-weight: bold;">
        <span><?php echo schoolData['School_Name'] ?> </span>
        <br><span><?php echo schoolData['School_Address'] ?> </span><br>
      </div>
    <hr>
    <table style="width: 100%;border: none;">
      <tr>
        <td class="border-none"><b>LEDGER OF : <?php echo $ledgerDetails['CCode']; ?></b></td>
        <td class="border-none text-right">Ledger Folio No : <?php echo $ledgerDetails['AcNo']; ?> </td>
      </tr>
      <tr>
        <td class="border-none">Accounting Period : <?php echo '01-Apr-'.$start_year.' TO '. '31-Mar-'.$end_year; ?></td>
        <td class="border-none text-right"><span class="page">Page Number : </span></td>
      </tr>
    </table>
   <!--  <span style="margin-left: 35%;"></span>
    <br>
    <div>
    <span class="page" style="margin-left: 35%;">Page Number : </span></div> -->
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
            <th class="thead-color text-center th">DATE</th>
            <th class="thead-color th" style="padding-left: 5px;">PARTICULARS</th>
            <th class="thead-color th text-center">VOUCHER<br>NO</th>
            <th class="thead-color th text-center">Dr.<br>AMOUNT<br>Rs.</th>
            <th class="thead-color th text-center">Cr.<br>AMOUNT<br>Rs.</th>
            <th class="thead-color th text-center">BALANCE</th>
          </tr>
        </thead>
        <tbody style="padding-bottom: 5px;">
        <?php $totaldr = 0; $totalcr = 0; ?>         
          <tr>
            <td></td>
            <td>OPENING BALANCE AS ON <?php echo date('d-M-Y',strtotime('-1 day', strtotime($date_from))); ?> </td>
            <td></td>
            <td class="text-right">
              <?php if($calculatedResult['ob'] >= 0){
                echo number_format(abs($calculatedResult['ob']),2);
                $totaldr += abs($calculatedResult['ob']);
              } ?>
            </td>
            <td class="text-right">
              <?php if($calculatedResult['ob'] < 0){
                echo number_format(abs($calculatedResult['ob']),2);
                $totalcr += abs($calculatedResult['ob']);
              } ?>
            </td>
            <td class="text-right">
              <?php if($calculatedResult['ob'] >= 0){
                echo number_format(abs($calculatedResult['ob']),2).' Dr.';
                $closing_bal = $calculatedResult['ob'];
              }
              else{
                echo number_format(abs($calculatedResult['ob']),2).' Cr.';
                $closing_bal = $calculatedResult['ob'];
              } ?>
            </td>
          </tr>
          <?php 
          foreach ($tcashData as $keys => $val) {  
              ?>
                <tr>
                  <td class="text-center"><?php echo date('d-M-Y',strtotime($val['TDate'])); ?></td>
                  <td style="padding-left: 5px;"><?php echo $val['Nar']; ?></td>
                  <td class="text-center"><?php echo $val['VNo']; ?></td>
                  <td class="text-right">
                    <?php if($val['PR'] == 'D'){ 
                      echo number_format(abs($val['Amt']),2); 
                      $bal = abs($val['Amt']); 
                      $closing_amt = $val['Amt'];
                      $totaldr += $bal;
                    } ?>
                  </td>
                  <td class="text-right">
                    <?php if($val['PR'] == 'C'){ 
                      echo number_format(abs($val['Amt']),2); 
                      $bal = abs($val['Amt']); 
                      $closing_amt = -1*$val['Amt'];
                      $totalcr += $bal;
                    } ?>
                  </td>
                  <td class="text-right"> 
                    <?php 
                      $closing_bal = $closing_bal + $closing_amt;
                      if($closing_bal>=0)
                      {
                         echo number_format(abs($closing_bal),2).' Dr.'; 
                      }
                      else
                      {
                        echo number_format(abs($closing_bal),2).' Cr.'; 
                      }
                    ?>
                  </td>
                </tr>
            <?php 
           } ?>
        </tbody>       
        <tfoot style="border-top: 1px solid black;">
          <tr>
            <td></td>
            <td class="text-right">TOTAL RS.</td>
            <td></td>
            <td class="text-right"><?php echo number_format($totaldr,2); ?></td>
            <td class="text-right"><?php echo number_format($totalcr,2); ?></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
      <p class="text-right">Soft Solution MICA Ranchi</p>
    </div>
  </div>
  </body>
</html>