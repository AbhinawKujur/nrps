<!DOCTYPE html>
<html>

<head>
    <title>Reconcilation Report of Amt. Collected in Previous Month</title>
    <style>
        table {
            border-collapse: collapse;
        }

        * {
            font-size: 10px;
        }

        table tr th,
        td {
            font-size: 10px !important;
            /* padding: 5px !important; */
            border: #000 1px solid;
        }

        @page {
            margin: 15px 10px 30px 10px;
        }
    </style>
</head>

<body>
    <div>
        <p style='float:right; font-size:10px;'>Report Generation Date:<?php echo date('d-M-Y'); ?></p><br /><br>
        <center>
            <p style='font-size:20px;'><?php echo $School_Name; ?></p>
            <p style='font-size:16px;'><?php echo $School_Address; ?></p>
            <p style='font-size:16px;'>Session (<?php echo $School_Session; ?>)</p>
        </center>
    </div>
    <table width='100%'>
        <tr>
            <th width='50%' style='font-size:16px!important;border:none'>
                <center>Reconcilation Report of Amt. Collected in Previous Month for the month -
                    <?php
                    if ($month == 1) {
                        echo 'JAN - ' . $new_sess;
                    } elseif ($month == 2) {
                        echo 'FEB - ' . $new_sess;
                    } elseif ($month == 3) {
                        echo 'MAR - ' . $new_sess;
                    } elseif ($month == 4) {
                        echo 'APR - ' . $curr_sess;
                    } elseif ($month == 5) {
                        echo 'MAY - ' . $curr_sess;
                    } elseif ($month == 6) {
                        echo 'JUN - ' . $curr_sess;
                    } elseif ($month == 7) {
                        echo 'JUL - ' . $curr_sess;
                    } elseif ($month == 8) {
                        echo 'AUG - ' . $curr_sess;
                    } elseif ($month == 9) {
                        echo 'SEP - ' . $curr_sess;
                    } elseif ($month == 10) {
                        echo 'OCT - ' . $curr_sess;
                    } elseif ($month == 11) {
                        echo 'NOV - ' . $curr_sess;
                    } elseif ($month == 12) {
                        echo 'DEC - ' . $curr_sess;
                    }
                    ?>
                </center>
            </th>
        </tr>
    </table>
    <hr>
    <table style="border: 1px solid #000;width:100% !important;">
        <thead>
            <tr>
                <th width='5%'><b>SL. NO.</b></th>
                <th width='10%'><b>RECT. NO.</b></th>
                <th width='10%'><b>RECT. DATE</b></th>
                <th width='10%'><b>ADM. NO.</b></th>
                <th width='35%'><b>PERIOD</b></th>
                <th width='5%'><b>PAID</b></th>
                <th width='5%'><b>RATE</b></th>
                <th width='10%'><b>AMT. COLLECTED IN PREV. MONTHS</b></th>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($adv_daycoll as $value) {
            ?>
                <tr>
                    <td>&nbsp;&nbsp;<?php echo $i; ?></td>
                    <td>&nbsp;&nbsp;<?php echo $value['RECT_NO']; ?></td>
                    <td>&nbsp;&nbsp;<?php echo date('d-M-Y', strtotime($value['RECT_DATE'])); ?></td>
                    <td>&nbsp;&nbsp;<?php echo $value['ADM_NO']; ?></td>
                    <td>&nbsp;&nbsp;<?php echo $value['PERIOD']; ?></td>
                    <td>&nbsp;&nbsp;<?php echo $value['AMT']; ?></td>
                    <td>&nbsp;&nbsp;<?php echo $value['RATE']; ?></td>
                    <td>&nbsp;&nbsp;<?php echo $value['PREV_AMT']; ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
            <tr>
                <td colspan="7" style="text-align: right;font-weight:700;">TOTAL</td>
                <td style="color: red;font-weight:700;"><?php echo $GRAND_TOT_PREV; ?></td>
            </tr>
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>

</html>