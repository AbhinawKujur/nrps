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

        table tbody tr td {
            padding: 2px 0 2px 5px;
            /* border: 1px solid black; */
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
                <table border="1" id='example' style="width: 100%;" cellpadding='0' cellspacing='0'>
                    <thead>
                        <tr>
                            <th style='color:white!important;'>S.NO</th>
                            <th style='color:white!important;'>Head Name</th>
                            <th style='color:white!important;'>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($feehead as $k => $v) {  ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $v[0]->ACT_CODE; ?></td>
                                <td style="text-align: left;"><?php echo $v[0]->FEE_HEAD; ?></td>
                                <td style="text-align: left;"><?php echo $v[1][0]->Fee; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>