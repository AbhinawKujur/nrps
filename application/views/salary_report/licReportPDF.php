 <html>
<head>
  <title><?php echo $title; ?></title>
  <style>
    @page { margin: 50px 60px 60px 60px; }
    header { position: fixed; top: -20px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }

body{
  font-family: Verdana,Geneva,sans-serif; 
}
        .table {
          border-collapse: collapse;
          font-size: 10px;
           white-space: nowrap;
        }
        .table, th, td {
          border: 1px solid black;
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
          /*background: #abb0ac !important;*/
          border-color:black !important;
          writing-mode: vertical-rl;
text-orientation: mixed;
        }
        .thead-color-no{
          background: #babfbb !important;
        }
        p{
          font-size: 12px;
        }
        .no-border{
          border:0px solid white;
        }
  </style>
</head>
<body>
  <header id="header">
      <div style="text-align: center;">
        <span style="font-size:20px;font-weight: bold;"><?php echo $school_setting['School_Name'].' '.$school_setting['School_Address'] ?> </span><br>
      </div>
    </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
    <br><br>
    <div id="content" style="font-size: 13px;">
      <div>
        <span>Ref : LIC Premium /<?php echo $year; ?>/</span><span style="margin-left: 300px;"> Date: ____/____/20____</span><br>
        <br>
        To,<br>
        The Branch Manager,<br>
        LIC of India, Hinoo Branch No. 03<br>
        Indira Palace, Main Road Hinoo,<br>
        Ranchi - 834 002 (Ph 2500896, 2506763),<br><br>
        <b>Sub : Premium of our staff for <?php echo $month.' '.$year; ?> (PA CODE : 1278/55)</b><br><br>

        Dear Sir, <br><br>
        <span style="text-align: justify;">
        Please find enclosed herewith an account payee cheque No. ______________________________________ Dated__________________ for <?php echo number_format($total_premium_amt,2).' <b>( Rs.'.ucwords($this->custom_lib->getIndianCurrency($total_premium_amt)).')</b>'; ?> against LIC premium for above said month. You are requested to credit the amount to individual's account as per the list attached and send the receipt for our school record.</span>
      </div>
      <br>
      <div>
        <table style="width: 100%;" class="table">
          <thead id="header-fixed">
            <tr>
              <th class="thead-color text-center">S.No</th>
              <th class="thead-color text-center">Name of the Policy Holder</th>
              <th class="thead-color text-center">Policy Number</th>
              <th class="thead-color text-center">Premium Amount</th>
            </tr>
          </thead>
          <tbody>
              <?php 
              foreach ($resultList as $key => $value) {  ?>
                  <tr>
                    <td style="text-align: center;"><?php echo $key + 1; ?></td>
                    <td><?php echo $value['EMP_NAME']; ?></td>
                    <td class="text-center"><?php echo $value['policy_number']; ?></td>
                    <td class="text-right"><?php echo number_format($value['premium_amt'],2); ?></td>
                  </tr>
              <?php } ?>
             <tr>
               <th></th>
               <th class="text-center">GRAND TOTAL</th>
               <th></th>
               <th class="text-right"><?php echo number_format($total_premium_amt,2); ?></th>
             </tr>
          </tbody>
        </table>
        <div style="clear: all;"></div><br><br>
        <div style="text-align: left;">Thanking You,<br>Yours Faithfully,</div>

        <table style="width: 100%;margin-top: 50px;">
            <th style="border: none;">OFF. PRINCIPAL</th>
        </table>
      </div>
  </div>
  </body>
</html>