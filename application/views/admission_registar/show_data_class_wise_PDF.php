<!DOCTYPE html>
<html>

<head>
    <title>Class Wise Registered Students</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <style>

        #img {
            float: left;
            height: 80px;
            width: 80px;
            margin-left: -5px !important;
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


        #content {
            border: solid 1px black;
            border-radius: 10px;
        }

        table thead tr th {
            background: #337ab7;
            color: #fff !important;
            padding: 5px;
            border: 1px solid black;
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
            size: landscape;
            margin-top: -10px;
            margin-bottom: 0;
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
                <center><?php echo $school_setting[0]->School_Name; ?></center>
            </td>
        </tr>
        <tr>
            <td id="mid-header">
                <center><?php echo $school_setting[0]->School_Address; ?></center>
            </td>
        </tr>
        <tr>
            <td id="last-header">
                <center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)</center>
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
                            <th>Sl No</th>
                            <th>Admission No</th>
                            <th>Roll</th>
                            <th>Student Name</th>
                            <th>Date of Birth</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Admission Date</th>
                            <th>Admission Class</th>
                            <th>Stoppage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($student) {
                            $i = 1;
                            foreach ($student as $data_key) {
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data_key->ADM_NO; ?></td>
                                    <td><?php echo $data_key->ROLL_NO; ?></td>
                                    <td><?php echo $data_key->FIRST_NM; ?></td>
                                    <td><?php echo date('d-M-Y', strtotime($data_key->BIRTH_DT)); ?></td>
                                    <td><?php echo $data_key->FATHER_NM; ?></td>
                                    <td><?php echo $data_key->MOTHER_NM; ?></td>
                                    <td><?php echo date('d-M-Y', strtotime($data_key->ADM_DATE)); ?></td>
                                    <td><?php echo $data_key->ADM_CLASS_id; ?></td>
                                    <td><?php echo $data_key->other_stop; ?></td>
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