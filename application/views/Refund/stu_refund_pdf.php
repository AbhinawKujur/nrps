<!DOCTYPE html>
<html>

<head>
    <title>Refundable Security Details</title>
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
            margin: 0px !important;
            padding: 0px !important;
            border: 2px solid black;
            padding: 10px;

            /* Additional CSS properties to adjust the background */
        }
        #watermark {
        position: fixed;
        top: 28%;
        left: 45%;
        width: 27%;
        transform: translate(-50%, -50%);
        opacity: 0.3;
        z-index: -1;
    }
    #watermark1 {
        position: fixed;
        top: 79%;
        left: 45%;
        width: 28%;
        transform: translate(-50%, -50%);
        opacity: 0.3;
        z-index: -1;
    }
        @page {
            margin-top: 2px;
            margin-bottom: 0;
            margin-right: 20px;
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        
            <img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="watermark">
            <table class="table" id='example' style="width: 100%;margin-left:-15px !important;" cellpadding='0' cellspacing='0'>
                <tr>
                    <td width="3%"><img src="<?php echo ($school_setting[0]->SCHOOL_LOGO); ?>" id="image" style='width:90px;'></td>

                    <td style="margin-left:-15% !important;">
                        <center><span style='font-size:19px; font-weight:bold;'><?php echo $school_setting[0]->School_Name; ?></span></center>
                        <center><?php echo $school_setting[0]->School_Address; ?></center>
                        <center>Affillated to CBSE, New Delhi </center>
                        <center><span style='font-size:12px;'>(Aff No. :3430154, School Code: 66348)</span></center>
                        <center><span style='font-size:12px;'>Session (<?php echo $school_setting[0]->School_Session; ?>)</span></center>
                    </td>
                </tr>
            </table>
            <center><b>Refundable Security Details</b></center>
            <br>

            <table class="table">
                <tr>
                    <td>
                        <center><b>RECT. NO. :- </b><?php echo $daycoll_data[0]->RECT_NO; ?></center>
                    </td>

                    <td></td>
                    <td></td>

                    <td>
                        <center><b>RECT. DATE. :- </b><?php echo $daycoll_data[0]->RECT_DATE; ?></center>
                    </td>

                </tr>
                <tr>
                    <td>
                        <center><b>ADM. NO. :- </b></i><?php echo $stu_data[0]->ADM_NO; ?></center>
                    </td>

                    <td></td>
                    <td></td>

                    <td>
                        <center><b>ADM. DATE. :- </b><?php echo $stu_data[0]->ADM_DATE; ?></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><b>STU. NAME :- </b><?php echo $stu_data[0]->FIRST_NM; ?></center>
                    </td>

                    <td></td>
                    <td></td>

                    <td>
                        <center><b>FATHER NAME :- </b><?php echo $stu_data[0]->FATHER_NM; ?></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><b>Class/Sec :- </b><?php echo $stu_data[0]->DISP_CLASS . '/' . $stu_data[0]->DISP_SEC; ?></center>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <center><b>TOTAL AMT. :- </b> <?php echo $daycoll_data[0]->Fee16; ?></center>
                    </td>

                </tr>
                <tr>

                </tr>
            </table><br /><br>
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
        <br>
        <br>
        <br>
            <!-- ==================================================================================================================== -->
        
            <img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="watermark1">
            <table class="table" id='example' style="width: 100%;margin-left:-15px !important;" cellpadding='0' cellspacing='0'>
                <tr>
                    <td width="3%"><img src="<?php echo ($school_setting[0]->SCHOOL_LOGO); ?>" id="image" style='width:90px;'></td>

                    <td style="margin-left:-15% !important;">
                        <center><span style='font-size:19px; font-weight:bold;'><?php echo $school_setting[0]->School_Name; ?></span></center>
                        <center><?php echo $school_setting[0]->School_Address; ?></center>
                        <center>Affillated to CBSE, New Delhi </center>
                        <center><span style='font-size:12px;'>(Aff No. :3430154, School Code: 66348)</span></center>
                        <center><span style='font-size:12px;'>Session (<?php echo $school_setting[0]->School_Session; ?>)</span></center>
                    </td>
                </tr>
            </table>
            <center><b>Refundable Security Details</b></center>
            <br>

            <table class="table">
                <tr>
                    <td>
                        <center><b>RECT. NO. :- </b><?php echo $daycoll_data[0]->RECT_NO; ?></center>
                    </td>

                    <td></td>
                    <td></td>

                    <td>
                        <center><b>RECT. DATE. :- </b><?php echo $daycoll_data[0]->RECT_DATE; ?></center>
                    </td>

                </tr>
                <tr>
                    <td>
                        <center><b>ADM. NO. :- </b></i><?php echo $stu_data[0]->ADM_NO; ?></center>
                    </td>

                    <td></td>
                    <td></td>

                    <td>
                        <center><b>ADM. DATE. :- </b><?php echo $stu_data[0]->ADM_DATE; ?></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><b>STU. NAME :- </b><?php echo $stu_data[0]->FIRST_NM; ?></center>
                    </td>

                    <td></td>
                    <td></td>

                    <td>
                        <center><b>FATHER NAME :- </b><?php echo $stu_data[0]->FATHER_NM; ?></center>
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><b>Class/Sec :- </b><?php echo $stu_data[0]->DISP_CLASS . '/' . $stu_data[0]->DISP_SEC; ?></center>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <center><b>TOTAL AMT. :- </b> <?php echo $daycoll_data[0]->Fee16; ?></center>
                    </td>

                </tr>
                <tr>

                </tr>
            </table><br /><br>
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
</body>

</html>