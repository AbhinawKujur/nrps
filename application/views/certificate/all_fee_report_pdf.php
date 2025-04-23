<?php
error_reporting(0);
if ($details_fetch) {
    $Birth_Date = $details_fetch[0]->Birth_Date;
    $Birth_Date1 = date('d-M-Y', strtotime($Birth_Date));
}

if ($total_paid) {
    $total_paid;
}

$number = $total_paid;
$no = round($number);
$point = round($number - $no, 2) * 100;
$hundred = null;
$digits_1 = strlen($no);
$i = 0;
$str = array();
$words = array(
    '0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety'
);
$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
while ($i < $digits_1) {
    $divider = ($i == 2) ? 10 : 100;
    $number = floor($no % $divider);
    $no = floor($no / $divider);
    $i += ($divider == 10) ? 1 : 2;
    if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? '' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str[] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
    } else $str[] = null;
}
$str = array_reverse($str);
$result = implode('', $str);
$points = ($point) ?
    "." . $words[$point / 10] . " " .
    $words[$point = $point % 10] : '';
$amtinword = "Rupees " . $result . "Only";
?>
<!DOCTYPE html>
<html>

<head>
    <title>All Fee Head Certificate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <style media="print">
        body {
            marging: 0px !important;
            paddging: 0px !important;
        }

        #border {
            width: 100%;
            height: 100%;
            padding: 5px 20px 0px 20px;
            border: solid 3px black;
        }

        #image {
            height: 100px;
            width: 100px;
            float: right;
        }

        #heading {
            float: right;
        }

        #content {
            border: solid 1px black;
            border-radius: 10px;
        }

        .text-content {
            text-align: right;
        }

        @page {
            size: auto;/ auto is the initial value / margin-top: -10px;/ this affects the margin in the printer settings / margin-bottom: 0;
            margin-right: 20px;
            margin-left: 20px;
        }

        .f-s {
            font-size: 22px;
        }

        .st {
            text-align: center;
            font-weight: bold;
            font-style: italic;
        }

        .amt_inword {
            font-weight: bold;
        }

        .head {
            color: #fff !important;
            text-align: center;
            background-color: #5784c3;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div id="border">
            <table class="table" id='example' style="width: 100%;margin-left:-15px !important;" cellpadding='0' cellspacing='0'>
                <tr>
                    <td width="3%"><img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="image" style='width:90px;'></td>
                    <td style="margin-left:-15% !important;">
                        <center><span style='font-size:19px; font-weight:bold;'><?php echo $school_setting[0]->School_Name; ?></span></center>
                        <center><?php echo $school_setting[0]->School_Address; ?></center>
                        <center>Affillated to CBSE, New Delhi </center>
                        <center><span style='font-size:14px;'>(Aff No. :3430154, School Code: 66348)</span></center>
                        <center><span style='font-size:14px;'>Session (<?php echo $school_setting[0]->School_Session; ?>)</span></center>
                    </td>
                </tr>
            </table>
            <center><b>ALL FEE PAID CERTIFICATE</b></center>
            <br><br>
            <center>
                <h3><u>TO WHOMSOEVER IT MAY CONCERN</u></h3>
            </center>
            <table class="table">
                <tr>
                    <td class="f-s">
                        <center><i>This is to certify that <b><?php echo $F_NAME; ?></b> & <b><?php echo $M_Name; ?></b> have paid School Fee for the study of their ward in our
                                School as per details given below.</i></center>
                    </td>
                </tr>
            </table>
            <table width="100%" border="1">
                <thead>
                    <tr>
                        <td  style="padding-left: 5px; background-color:#5784c3;color:#fff; border:1px solid #000;" class="st" rowspan="2">Admission No.</td>
                        <td  style="padding-left: 5px; background-color:#5784c3;color:#fff; border:1px solid #000;" class="st" rowspan="2">Ward Name</td>
                        <td  style="padding-left: 5px; background-color:#5784c3;color:#fff; border:1px solid #000;" class="st" rowspan="2">Class</td>
                        <td  style="padding-left: 5px; background-color:#5784c3;color:#fff; border:1px solid #000;" class="st" colspan="2">Period</td>
                        <td  style="padding-left: 5px; background-color:#5784c3;color:#fff; border:1px solid #000;" class="st" rowspan="2">Total Fee Paid</td>
                    </tr>
                    <tr>
                        <td  style="padding-left: 5px; background-color:#5784c3;color:#fff; border:1px solid #000;" class="st">From</td>
                        <td  style="padding-left: 5px; background-color:#5784c3;color:#fff; border:1px solid #000;" class="st">To</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  style="padding-left: 5px ;" class="st"><?php echo $ADM_NO; ?></td>
                        <td  style="padding-left: 5px ;" class="st"><?php echo $S_NAME; ?></td>
                        <td  style="padding-left: 5px ;" class="st"><?php echo $class_name . "-" . $sec; ?></td>
                        <td  style="padding-left: 5px ;" class="st"><?php echo $fee_paid_from; ?></td>
                        <td  style="padding-left: 5px ;" class="st"><?php echo $upto; ?></td>
                        <td  style="padding-left: 5px ;" class="st"><?php echo $total_paid; ?></td>
                    </tr>
                </tbody>
            </table>
            <table width="100%" border='1'>
                <tr>
                    <th  style="padding-left: 5px ;" class="head">Fee Head</th>
                    <th  style="padding-left: 5px ;" class="head">Rate</th>
                    <th  style="padding-left: 5px ;" class="head">Fee Paid</th>
                </tr>
                <?php
                if ($feehead) {
                    foreach ($feehead as $key => $value) {
                        $fee = "Fee" . $key;
                        if ($daycoll[0]->$fee > 0) {
                ?>
                            <tr>
                                <td  style="padding-left: 5px ;" class="st"><?php echo $value->FEE_HEAD; ?></td>
                                <td  style="padding-left: 5px ;" class="st"><?php echo $fee_details[$key]; ?></td>
                                <td  style="padding-left: 5px ;" class="st"><?php echo $daycoll[0]->$fee; ?></td>
                            </tr>
                <?php
                        }
                    }
                }
                ?>
                <tr>
                    <td  style="padding-right: 5px ;text-align: right;" colspan="2" class="st"><b>GRAND TOTAL</b></td>
                    <td  style="padding-left: 5px ;" class="st"><strong><?php echo $daycoll[0]->TOTAL; ?></strong></td>
                </tr>
            </table>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <p class="amt_inword">Amount Paid (in words) : <?php echo $amtinword; ?>.</p>
                </div>
            </div><br /><br /><br /><br /><br><br><br>
            <div class="row">
                <table width="100%">
                    <tr>
                        <td>
                            <center><b>Issue Date</b></center>
                        </td>
                        <td>
                            <center><b>Dealing Clerk <br /> Signature</b></center>
                        </td>
                        <td>
                            <center><b>Principal <br /> Signature</b></center>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>