<!DOCTYPE html>
<html>

<head>
    <title>Pre Defaulter Class Wise</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <style>
        body {
            marging: 0px !important;
            paddging: 0px !important;
        }

        #img {
            float: left;
            height: 80px;
            width: 80px;
            margin-left: -15px !important;
        }

        #tp-header {
            margin-top: -15px !important;
            font-size: 30px;
        }

        #mid-header {
            margin-top: -10px !important;
            font-size: 26px;
        }

        #last-header {
            margin-top: -10px !important;
            font-size: 22px;
        }

        #example thead,tfoot tr td {
            font-size: 16px !important;
            padding: 2px 0 2px 5px;
            /* border: 1px solid black; */
        }
        #example tbody tr td {
            font-size: 14px !important;
            padding: 2px 0 2px 5px;
            /* border: 1px solid black; */
        }

        .header {
            margin-top: -5%;
            padding: 0;
        }

        @page {
            size: landscape;/ auto is the initial value / margin-top: -10px;/ this affects the margin in the printer settings / margin-bottom: 0;
            margin-right: 20px;
            margin-left: 20px;
        }

        body {
            font-family: Verdana, Geneva, sans-serif;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
    <p style='float:right; font-size:15px; margin-top:-25px;'>Report Generation Date:<?php echo date('d-m-y'); ?></p><br />
    <table width="100%" style="float:right;">
        <tr>
            <td id="tp-header">
                <center><?php echo $school_setting[0]->School_Name; ?><center>
            </td>
        </tr>
        <tr>
            <td id="mid-header">
                <center><?php echo $school_setting[0]->School_Address; ?><center>
            </td>
        </tr>
        <tr>
            <td id="last-header">
                <center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center>
            </td>
        </tr>
    </table><br /><br /><br /><br />
    <hr>
    <div class='row'>
        <div class='col-md-12 col-xl-12 col-sm-12'>
            <div style='overflow:auto;'>
                <table border="1" id='example' style="width: 100%;" cellpadding='0' cellspacing='0'>
                    <thead>
                        <tr style='background-color:#0099cc;color:white;font-weight:bold;'>
                            <td style='border: 1px solid #000;color:white !important;padding-left:5px!important;'>S.NO.</td>
                            <td style='border: 1px solid #000;color:white !important;padding-left:5px!important;'>ADMISSION NO</td>
                            <td style='border: 1px solid #000;color:white !important;padding-left:5px!important;'>NAME</td>
                            <td style='border: 1px solid #000;color:white !important;padding-left:5px!important;'>CLASS</td>
                            <td style='border: 1px solid #000;color:white !important;padding-left:5px!important;'>TOTAL AMOUNT</td>
                            <td style='border: 1px solid #000;color:white !important;padding-left:5px!important;'>MONTH</td>
                            <td style='border: 1px solid #000;color:white !important;padding-left:5px!important;'>MOBILE NO</td>

                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $total_grand = 0;
                        $ii = 1;
                        foreach ($stu as $key) {


                            $concatedata = $this->db->query("select Month_NM,TOTAL from previous_year_feegeneration where ADM_NO='" . $key->ADM_NO . "'")->result();
                            $total = 0;
                            $month = '';
                            foreach ($concatedata as $kky) {
                                $month .= $kky->Month_NM . "-";
                                $total += $kky->TOTAL;
                            }
                            $total_grand += $total;

                        ?>

                            <tr>
                                <td><?php echo $ii; ?></td>
                                <td><?php echo $key->ADM_NO; ?></td>
                                <td><?php echo $key->STU_NAME; ?></td>
                                <td><?php echo $key->CLASS; ?><?php echo $key->SEC; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $month; ?></td>
                                <td><?php echo $key->C_MOBILE; ?></td>
                            </tr>


                        <?php
                            $ii++;
                        }

                        ?>
                    </tbody>
                    <tfoot style="border: 1px solid #000;">
                        <tr style='background-color:#0099cc;color:white !important; font-weight:bold'>
                            <td style = "border: 1px solid #000;"></td>
                            <td style = "border: 1px solid #000;"></td>
                            <td style = "border: 1px solid #000;"> </td>
                            <td style = "border: 1px solid #000;color:white !important;"> Total:</td>
                            <td style = "border: 1px solid #000;color:white !important;"> <?php echo $total_grand; ?></td>
                            <td style = "border: 1px solid #000;"> </td>
                            <td style = "border: 1px solid #000;"> </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>