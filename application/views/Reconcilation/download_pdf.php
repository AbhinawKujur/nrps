<!DOCTYPE html>
<html>

<head>
    <title>Reconcilation Report</title>
    <style>
        table {
            border-collapse: collapse;
        }

        * {
            font-size: 14px;
            font-weight: bold;
        }

        table tr th,
        td {
            font-size: 14px !important;
            padding: 5px !important;
            border: #000 1px solid;
        }

        @page {
            margin: 15px 30px 0px 30px;
        }
    </style>
</head>

<body>
    <div>
        <p style='float:right; font-size:14px;'>Report Generation Date:<?php echo date('d-M-Y'); ?></p><br /><br>
        <center>
            <p style='font-size:24px; position:relative; top:-5px;'><?php echo $School_Name; ?></p>
            <p style='font-size:20px; position:relative; top:-25px;'><?php echo $School_Address; ?></p>
            <p style='font-size:20px; position:relative; top:-35px;'>Session (<?php echo $School_Session; ?>)</p>
        </center>
    </div>
    <table width='100%'>
        <tr>
            <th width='50%' style='font-size:16px!important;border:none'>
                <center>Reconcilation Report of <?php echo $ward_nm.' for the month - ';
                                                 if ($month == 1) {
                                                    echo 'JAN';
                                                } elseif ($month == 2) {
                                                    echo 'FEB';
                                                } elseif ($month == 3) {
                                                    echo 'MAR';
                                                } elseif ($month == 4) {
                                                    echo 'APR';
                                                } elseif ($month == 5) {
                                                    echo 'MAY';
                                                } elseif ($month == 6) {
                                                    echo 'JUN';
                                                } elseif ($month == 7) {
                                                    echo 'JUL';
                                                } elseif ($month == 8) {
                                                    echo 'AUG';
                                                } elseif ($month == 9) {
                                                    echo 'SEP';
                                                } elseif ($month == 10) {
                                                    echo 'OCT';
                                                } elseif ($month == 11) {
                                                    echo 'NOV';
                                                } elseif ($month == 12) {
                                                    echo 'DEC';
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
                <th>CLASS</th>
                <th>MONTH</th>
                <th>TOTAL STUDENT</th>
                <th>RATE</th>
                <th>TOTAL RECEIVABLE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($classes as $value) {
            ?>
                <tr>
                    <td><?php echo $value['class_nm']; ?></td>
                    <td><?php echo $value['month']; ?></td>
                    <td><?php echo $value['GEN_COUNT']; ?></td>
                    <td><?php echo $value['GEN_RATE']; ?></td>
                    <td><?php echo $value['TOT_GEN_RCV']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;font-weight:700;">TOTAL</td>
                <td style="color: red;font-weight:700;"><?php echo $GRAND_TOT_RCV; ?></td>
            </tr>
        </tfoot>
    </table>
</body>
<script>
    window.print();
</script>
</html>