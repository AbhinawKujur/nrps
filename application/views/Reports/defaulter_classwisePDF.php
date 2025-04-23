<?php
if ($School_setting) {
    $School_Name = $School_setting[0]->School_Name;
    $School_Address = $School_setting[0]->School_Address;
    $School_Session = $School_setting[0]->School_Session;
    $SCHOOL_LOGO = $School_setting[0]->SCHOOL_LOGO;
}
?>

<!DOCTYPE html>

<head>
    <title>Class Wise Defaulter List</title>
    <style>
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

        table thead tr th {
            background: #337ab7;
            color: #fff !important;
            padding: 5px;
            border: 1px solid black;
        }

        #example tbody tr td {
            padding: 2px 0 2px 5px;
            height: 3%;
            /* border: 1px solid black; */
        }
        #example tfoot tr td {
            padding: 2px 0 2px 5px;
            height: 3%;

            /* border: 1px solid black; */
        }

        hr {
            margin: 10 -30 10 -30;
            width: 100%;
        }

        .header {
            margin-top: -5%;
            padding: 0;
        }
    </style>
</head>

<body>

    <img src="<?php echo $School_setting[0]->SCHOOL_LOGO; ?>" id="img">
    <p style='float:right; font-size:15px; margin-top:-25px;'>Report Generation Date:<?php echo date('d-m-y'); ?></p><br />
    <table width="100%" style="float:right;">
        <tr>
            <td id="tp-header">
                <center><?php echo $School_setting[0]->School_Name; ?><center>
            </td>
        </tr>
        <tr>
            <td id="mid-header">
                <center><?php echo $School_setting[0]->School_Address; ?><center>
            </td>
        </tr>
        <tr>
            <td id="last-header">
                <center>SESSION (<?php echo $School_setting[0]->School_Session; ?>)<center>
            </td>
        </tr>
    </table><br /><br /><br /><br />
    <hr>
    <div class='row'>
        <div class='col-md-12 col-xl-12 col-sm-12'>
            <div style='overflow:auto;'>
                <table border="1" id='example' style="width: 100%;margin: 0px -30px 0px -20px;" cellpadding='0' cellspacing='0'>
                    <thead>
                        <tr>
                            <th style="background: #337ab7; color: white !important;">SNO</th>
                            <th style="background: #337ab7; color: white !important;">NAME</th>
                            <th style="background: #337ab7; color: white !important;">ADM_NO</th>
                            <th style="background: #337ab7; color: white !important;">ROLL NO</th>
                            <th style="background: #337ab7; color: white !important;">Class/Sec</th>
                            <th style="background: #337ab7; color: white !important;">MONTH UPTO</th>
                            <th style="background: #337ab7; color: white !important;">PREVIOUS YEAR DUES</th>
                            <th style="background: #337ab7; color: white !important;">CURRENT YEAR DUES</th>
                            <th style="background: #337ab7; color: white !important;">TOTAL AMOUNT</th>
                            <th style="background: #337ab7; color: white !important;">MOBILE NO</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $month_print = '';
                        $str_month = '';
                        $mon = '';
                        $total_amount = 0;
                        $unpaid_mnth = 0;
                        $previous_duess = 0;
                        $grand_tot = 0;
                        $grand_tot_prev = 0;
                        $grand_tot_currnt = 0;
                        $c = 1;
                        $pre = 0;
                        // echo "<pre>";
                        // print_r($student);
                        // die;

                        for ($i = 0; $i < $student_cnt; $i++) {

                            $str_month = '';
                            $month_print = '';
                            $adm_no = $student[$i]->ADM_NO;
                            $class_sec = $student[$i]->DISP_CLASS . "-" . $student[$i]->DISP_SEC;
                            $MON_FEE[0] = $student[$i]->APR_FEE;
                            $MON_FEE[1] = $student[$i]->MAY_FEE;
                            $MON_FEE[2] = $student[$i]->JUNE_FEE;
                            $MON_FEE[3] = $student[$i]->JULY_FEE;
                            $MON_FEE[4] = $student[$i]->AUG_FEE;
                            $MON_FEE[5] = $student[$i]->SEP_FEE;
                            $MON_FEE[6] = $student[$i]->OCT_FEE;
                            $MON_FEE[7] = $student[$i]->NOV_FEE;
                            $MON_FEE[8] = $student[$i]->DEC_FEE;
                            $MON_FEE[9] = $student[$i]->JAN_FEE;
                            $MON_FEE[10] = $student[$i]->FEB_FEE;
                            $MON_FEE[11] = $student[$i]->MAR_FEE;
                            @$previous_duess = $student[$i]->previous_dues;

                            // echo $loop_cnt;die;
                            for ($l = 0; $l < $loop_cnt; $l++) {
                                if ($MON_FEE[$l] == 'N/A' or  $MON_FEE[$l] == '') {
                                    $month_print .= $monthin[$l] . ',';
                                    if ($str_month != '') {
                                        $str_month = $str_month . ",'" . $monthin[$l] . "'";
                                    } else {
                                        $str_month = "'" . $monthin[$l] . "'";
                                    }
                                }
                            }
                            // echo $str_month;die;
                            if (!empty($str_month)) {
                                $unpaid_month = $this->farheen->select('feegeneration', 'sum(TOTAL)total', "ADM_NO='$adm_no' AND Month_NM in($str_month)");
                                $unpaid_mnth = $unpaid_month[0]->total;
                            }

                            $total_amount = $previous_duess + $unpaid_mnth;

                            if ($total_amount > 0) {
                                $grand_tot_prev = $grand_tot_prev + $previous_duess;
                                $grand_tot_currnt = $grand_tot_currnt + $unpaid_mnth;
                                $grand_tot = $grand_tot + $total_amount;

                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $student[$i]->FIRST_NM; ?></td>
                                    <td><?php echo $student[$i]->ADM_NO; ?></td>
                                    <td><?php echo $student[$i]->ROLL_NO; ?></td>
                                    <td><?php echo $class_sec; ?></td>
                                    <td><?php
                                        if ($previous_duess > 0) {
                                            $mntt = 'PREV.DUES' . ',' . $month_print;
                                            $month_upto = rtrim($mntt, ',');
                                            echo $month_upto;
                                        } else {
                                            $month_upto = rtrim($month_print, ',');
                                            echo $month_upto;
                                        }

                                        ?></td>
                                    <td>
                                        <?php
                                        echo $student[$i]->previous_dues;
                                        ?>
                                    </td>
                                    <td><?php echo $unpaid_mnth; ?></td>
                                    <td><?php echo $total_amount; ?></td>
                                    <td><?php echo $student[$i]->C_MOBILE; ?></td>
                                </tr>
                                <?php
                                $c++;
                            }

                            $total_amount = 0;
                            $unpaid_mnth = 0;
                            $previous_duess = 0;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
                            <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_prev; ?></b></td>
                            <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_currnt; ?></b></td>
                            <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot; ?></b></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>

</html>