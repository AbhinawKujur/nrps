 <html>
<head>
  <style>
    @page { margin: 120px 25px 50px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
    #footers { position: fixed; right: 0px; bottom: 50px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }

        .table {
          border-collapse: collapse;
          white-space: nowrap;
        }

        .table {
          border: 1px solid #abb5c4;
        }
        .name {
          text-align: left;
        }
        .text-center{
          text-align: center;
          font-weight: bold;
        }
        .text-right{
          text-align: right;
        }
        .thead-color{
          background: #abb0ac !important;
        }
  </style>
</head>
<body>
  <header id="header">
    <img src="<?php echo $school_setting['SCHOOL_LOGO']; ?>" width="100px" height="100px" style="float:left">
    <div style="text-align: center;">
      <span style="font-size: 25px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
      <br><span><?php echo $school_setting['School_Address'] ?> </span><br>
    </div>
    <div style="text-align: center;"><?php 
    if($voucher_type == 1)
    {
      echo "PAYMENT VOUCHER ";
    }
    elseif($voucher_type == 2 || $voucher_type == 5 ||$voucher_type == 6)
    {
      echo "RECEIPT VOUCHER ";
    }
    elseif($voucher_type == 3)
    {
      echo "JOURNAL VOUCHER ";
    }
    elseif($voucher_type == 4)
    {
      echo "CONTRA VOUCHER ";
    }
    ?> (<?php echo $school_setting['School_Session']; ?>)</div>
  </header>
   <div id="footer">
      <!-- <p class="page">Page </p> -->
    </div> 
  <div id="content">
    <div>
      <table style="width: 100%;" class="table">
        <tr>
          <th class="thead-color" style="padding: 10px;">Voucher No: <?php echo $voucherList[0]['VNo']; ?></th>
          <th class="thead-color text-right" style="padding: 10px;" colspan="2">Date :  <?php echo date('d-M-Y',strtotime($voucherList[0]['TDate'])); ?></th>
        </tr>
      </table>
      <table style="width: 100%;" class="table">
        <thead>
          <tr>
            <th class="thead-color">Particulars</th>
            <th class="thead-color text-right">Amount<br> Dr.</th>
            <th class="thead-color text-right">Amount<br> Cr.</th>
          </tr>
        </thead>
        <tbody>
            <?php 
            $dr_amt = 0;
            $cr_amt = 0;
            foreach ($voucherList as $key => $value) { 
              ?>
              <tr>
                <td style="padding: 10px 0px 20px 20px;"><?php echo $value['head_name'].'<br> &nbsp; &nbsp;  &nbsp; &nbsp; <b>Narration : </b>'.$value['Nar']; ?></td>
                <td class="text-right" valign="bottom" style="padding: 10px 0px 20px 20px;">
                  <?php 
                  if($value['PR']=='D')
                  { 
                    echo number_format($value['Amt'],2);
                    $dr_amt += $value['Amt'];
                  } ?>
                </td>
                <td class="text-right" valign="bottom" style="padding: 10px 0px 20px 20px;">
                  <?php 
                  if($value['PR']=='C')
                  { 
                    echo number_format($value['Amt'],2); 
                    $cr_amt += $value['Amt'];
                  } ?>
                </td>
              </tr>
            <?php } ?>
        </tbody>
        <tfoot>
          <tr style="font-weight: bold;">
            <td style="border: 1px solid #abb5c4;" class="text-center">Grand Total</td>
            <td style="border: 1px solid #abb5c4;padding: 10px 0px 20px 20px;" class="text-right"><b><?php echo number_format($dr_amt,2); ?></b></td>
            <td style="border: 1px solid #abb5c4;padding: 10px 0px 20px 20px;" class="text-right"><b><?php echo number_format($cr_amt,2); ?></b></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div id="footers">
      <table style="width: 100%;font-weight: bold;">
        <tr>
          <td>Accountant</td>
          <td class="text-right">Principal</td>
        </tr>
      </table>
    </div> 
  </body>
</html>