<?php
error_reporting(0);
if ($details_fetch) {
    $Adm_Date = $details_fetch[0]->Adm_Date;
    $End_DATE = $details_fetch[0]->End_DATE;
    $adm_date1 = date('d-M-Y', strtotime($Adm_Date));
    $birth_dt = $details_fetch[0]->birth_dt;
    $birth_dt1 = date('d-M-Y', strtotime($birth_dt));
    $End_DATE1 = date('d-M-Y', strtotime($End_DATE));
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Bonafide Certificate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <style>
        #border {
            padding: 5px 20px 0px 20px;
            border: double 3px black;
        }

        #image {
            height: 80px;
            width: 80px;
            /* float: right; */
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
            margin: 20px 20px 20px 20px;
        }

        .f-s {
            font-size: 17px !important;
        }

        td {
            font-size: 15px !important;
        }
    </style>
</head>

<body id="border"><br>
    <table width='100%'>
        <tr>
            <th rowspan="5" width='15%'><img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="image"></th>
            <th width='70%'>
                <center>
                    <h3><b><?php echo $school_setting[0]->School_Name; ?></b></h3>
                </center>
            </th>
            <th width='15%'></th>
        </tr>
        <tr>
            <td width='70%'>
                <center>
                    <b><?php echo $school_setting[0]->School_Address; ?></b>
                </center>
            </td>
            <td width='15%'></td>
        </tr>
        <tr>
            <td width='70%'>
                <center><b>
                        Affillated to CBSE,New Delhi (Aff No. :<?php echo $school_setting[0]->School_AfftNo; ?>, School Code: <?php echo $school_setting[0]->School_Code; ?>)</b>
                </center>
            </td>
            <td width='15%'></td>
        </tr>
        <tr>
            <td width='70%'>
                <center><b>
                        Phone No. : <?php echo $school_setting[0]->School_MobileNo; ?></b>
                </center>
            </td>
            <td width='15%'></td>
        </tr>
        <tr>
            <td width='70%'>
                <center><b>
                        Website : <?php echo $school_setting[0]->School_Webaddress; ?>, Email : <?php echo $school_setting[0]->School_Email; ?></b>
                </center>
            </td>
            <td width='15%'></td>
        </tr>
    </table>
    <br>
    <center><b style="font-size: 18px !important;">BONAFIDE CERTIFICATE</b></center>
    <br>
    <center>
        <h6><b><u>TO WHOMSOEVER IT MAY CONCERN</u></b></h6>
    </center>
    <br><br>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <b style="font-size: 16px !important;"><i>Certificate No</i>.:- <?php echo $details_fetch[0]->CERT_NO; ?></b>
        </div>
    </div><br /><br /><br />
    <table>
        <tr>
            <td class="f-s">
                <p><b><i>This is to certify that Master/Miss :</i> &nbsp;&nbsp;&nbsp;&nbsp; <u><?php echo $details_fetch[0]->S_NAME; ?></u></b></p>
            </td>
        </tr>
        <tr>
            <td class="f-s">
                <p><b><i>S/O/D/O :</i> &nbsp;&nbsp;&nbsp;&nbsp; <u><?php echo $details_fetch[0]->F_NAME; ?></u></b>&nbsp;&nbsp;<b> & </b>&nbsp;&nbsp; <u><b><?php echo $details_fetch[0]->M_Name; ?></b></u></p>
            </td>
        </tr>
        <tr>
            <td class="f-s">
                <p><b><i>Admission No.:</i> &nbsp;&nbsp;&nbsp;&nbsp; <u><?php echo $details_fetch[0]->ADM_NO; ?></u></b>&nbsp;&nbsp;<b>, Class </b>&nbsp;&nbsp; <u><b><?php echo $details_fetch[0]->class_name; ?></b></u>&nbsp;&nbsp;<b><i>is a bonafide student of this</i></b></p>
            </td>
        </tr>
        <tr>
            <td class="f-s">
                <p><b><i> school for academic session <?php echo $school_setting[0]->School_Session; ?> from :</i> &nbsp; <u><?php echo $adm_date1; ?></u></b>&nbsp;<b> To </b>&nbsp; <u><b><?php echo $End_DATE1; ?></b></u></p>
            </td>
        </tr>

        <tr>
            <td class="f-s">
                <p><b><i>To the best of my knowledge he/she bears a Good moral character.</i></b></p>
            </td>
        </tr>

        <tr>
            <td class="f-s">
                <p><b><i>I wish him/her every success in life. </i> </b></p>
            </td>
        </tr>
    </table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br>
    <div class="row">
        <table width="100%">
            <tr>
                <td>
                    <center><b><i><?php echo date('d-M-Y');  ?><br>Issue Date</i></b></center>
                </td>
                <td>
                    <center><b><i>Dealing Clerk <br /> Signature</i></b></center>
                </td>
                <td>
                    <center><b><i>Principal <br /> Signature</i></b></center>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>