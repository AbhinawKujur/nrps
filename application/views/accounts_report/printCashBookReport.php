 <html>
<head>
  <style>
    @page { margin: 140px 25px 0px 25px; }
    header { position: fixed; top: -130px; left: 0px; right: 0px;}
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
        td{
          vertical-align: top;
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
        <span>CASH BOOK</span><br>
      </div>
    <hr>
    <table style="width: 100%;border: none;">
      <tr>
        <td class="border-none">Accounting Period : <?php echo '01-Apr-'.$start_year.' TO 31-Mar-'.$end_year; ?></td>
        <td class="border-none text-right"><span class="page">Page Number : </span></td>
      </tr>
       <tr>
        <td class="border-none">Accounting Type : <?php echo $accountType['CAT_ABBR']; ?></td>
        <td class="border-none text-right"></td>
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
            <th class="thead-color text-center th" width="100px">DATE</th>
            <th class="thead-color th text-center" width="60px">VOUCHER<br>NO</th>
            <th class="thead-color th" style="padding-left: 5px;">PARTICULARS</th>
            <th class="thead-color th text-center" width="80px">LEDGER<br>NO.</th>
            <th class="thead-color th text-center" width="120px">Dr.<br>AMOUNT<br>Rs.</th>
            <th class="thead-color th text-center" width="120px">Cr.<br>AMOUNT<br>Rs.</th>
          </tr>
        </thead>
        <tbody style="padding-bottom: 5px;">
        <?php $totaldr = 0; $totalcr = 0; 
          foreach ($voucherNoList as $keys => $val) {  ?>
            <tr>
              <td style="border-top: 1px solid black;">&nbsp;</td>
              <td style="border-top: 1px solid black;">&nbsp;</td>
              <td style="border-top: 1px solid black;">&nbsp;</td>
              <td style="border-top: 1px solid black;">&nbsp;</td>
              <td style="border-top: 1px solid black;">&nbsp;</td>
              <td style="border-top: 1px solid black;">&nbsp;</td>
            </tr>

           <?php foreach ($result[$val['VNo']] as $key => $value) {
              ?>
                <tr>
                  <td class="text-center border-none"><?php echo date('d-M-Y',strtotime($value['TDate'])); ?></td>
                  <td class="text-center border-none"><?php echo $value['VNo']; ?></td>
                  <td style="padding-left: 5px;" class="border-none">
                    <b><?php 
                    if($value['PR'] == 'D'){ 
                      echo 'By '.$value['ledger_head'];
                    }else
                    {
                      echo 'To '.$value['ledger_head'];
                    }
                    ?></b><br>
                    <span style="margin-left: 10px;"><?php echo $value['Nar']; ?></span>
                  </td>
                  <td class="text-center">
                    <?php echo $value['CCode']; ?>
                  </td>
                  <td class="text-right border-none">
                    <?php if($value['PR'] == 'D'){ 
                      echo number_format(abs($value['Amt']),2); 
                      $bal = abs($value['Amt']); 
                      $totaldr += $bal;
                    } ?>
                  </td>
                  <td class="text-right border-none">
                    <?php if($value['PR'] == 'C'){ 
                      echo number_format(abs($value['Amt']),2); 
                      $bal = abs($value['Amt']); 
                      $totalcr += $bal;
                    } ?>
                  </td>
                </tr>
               <!--  <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr> -->
            <?php 
          }
           } ?>
        </tbody>       
        <tfoot style="border-top: 1px solid black;">
          <tr>
            <td class="text-right" colspan="4"><b>TOTAL RS.</b></td>
            <td class="text-right"><?php echo number_format($totaldr,2); ?></td>
            <td class="text-right"><?php echo number_format($totalcr,2); ?></td>
          </tr>
        </tfoot>
      </table>
      <p class="text-right">Soft Solution MICA Ranchi</p>
    </div>
  </div>
  </body>
</html>