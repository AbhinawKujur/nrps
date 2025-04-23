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
        #example{
            margin-left: -25px;
        }

        table thead tr th {
            background: #337ab7;
            color: #fff !important;
            font-size: 12.5px;
            padding: 5px;
            border: 1px solid black;
        }
        
        table tbody tr td {
            font-size: 12px;
            padding: 2px 5px 2px 5px;
            /* border: 1px solid black; */
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
    <hr style="margin:5 -25px 5 -25px;">
    <div class='row'>
        <div class='col-md-12 col-xl-12 col-sm-12'>
            <div style='overflow:auto;'>
                <table border="1" id='example' style="width: 100%;" cellpadding='0' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>TC No.</th>
                            <th>Admission No.</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Current Class</th>
                            <th>Application Date</th>
                            <th>Issue Date</th>
                            <th>Session Year</th>
                            <th>Status</th>
                            <th>No of Copy Issue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($data) {
                            $i = 1;
                            foreach ($data as $data_key) {
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data_key->TCNO; ?></td>
                                    <td><?php echo $data_key->adm_no; ?></td>
                                    <td><?php echo $data_key->Name; ?></td>
                                    <td><?php echo $data_key->Father_NM; ?></td>
                                    <td><?php echo $data_key->Mother_NM; ?></td>
                                    <td><?php echo $data_key->current_Class; ?></td>
                                    <td><?php echo date('d-M-Y', strtotime($data_key->text019)); ?></td>
                                    <td><?php echo date('d-M-Y', strtotime($data_key->text020)); ?></td>
                                    <td><?php echo $data_key->session_year; ?></td>
                                    <td><?php echo $data_key->Tc_Status; ?></td>
                                    <td><?php echo $data_key->duplicate_issue; ?></td>
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>