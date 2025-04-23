<html>

<head>
    <title>Report Card</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script> -->
    <style>
        .table {
            font-size: 15px !important;
        }

        @page {
            margin: 40px 12px 0px 12px;
        }

        .sign {
            font-family: 'Laila', serif;
        }

        .table1 {
            padding: 10px !important;
            font-size: 10px;
            width: 100%;
            border-spacing: 15px !important;
        }

        .table2 {
            font-size: 10px;
            width: 100%;
            height: 40%;

        }

        .border {
            border: 1px solid #000;
        }

        div {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        #background {
            position: absolute;
            z-index: 2;
            display: block;
            min-height: 50%;
            min-width: 50%;
            opacity: 0.2;
            margin-top: 25%;
        }
    </style>
</head>

<body>
    <?php
    if (isset($result)) {
        $j = 1;

        $tot_rec = count($result);
        foreach ($result as $key => $data) {

            //$trm=2;
            // echo "asds";
    ?>

            <div style="border:5px solid #000 !important; padding:10px;" id='dyn_<?php echo $j; ?>'>
                <div id='background'>
                    <center><img src=<?php echo base_url('assets/school_logo/BG_LOGO.png'); ?> width='70%' height='70%'></center>
                </div>

                <table style='border:none !important;' class='table'>
                    <tr>
                        <td>
                            <img src="<?php echo base_url($school_photo[0]->School_Logo); ?>" style="width:80px;height:80px">
                        </td>
                        <td>
                            <center><span style='font-size:20px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br />
                                <span style='font-size:18px !important'>
                                    <?php echo $school_setting[0]->School_Address; ?>
                                </span><br />
                                <b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
                                </span><br />
                                <b>WEBSITE: https://www.davnrps.com</b>
                            </center>

                        </td>
                        <td style='text-align:right'>
                            <img src="<?php echo base_url($school_photo[0]->School_Logo_RT); ?>" style="width:90px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span style='font-size:13px !important'>Affiliation No.-
                                <?php echo $school_setting[0]->School_AfftNo; ?></span>
                        </td>
                        <td>
                            <b>
                                <center><span style='font-size:16px !important;'><b><?php if ($trm == 1) {
                                                                                        echo "REPORT CARD-MID TERM";
                                                                                    } else {
                                                                                        echo "REPORT CARD-ANNUAL EXAM";
                                                                                    } ?></b></span></center>
                            </b>
                        </td>
                        <td style='text-align:right'><span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span></td>
                    </tr>
                </table>

                <br />
                <table class='table1'>
                    <tr>
                        <th>Admission No. :</th>
                        <td style="padding: 8px !important;"><?php echo $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'></td>
                        <th>Class-Sec:</th>
                        <td style="padding: 8px !important;"><?php echo $data['DISP_CLASS'] . " - " . $data['DISP_SEC']; ?></td>
                        <td></td>
                        <td rowspan="5">
                            <center>
                                <img src="<?php echo base_url($data['student_image']); ?>" width='120px' height='120px' style="opacity: 1;margin-right: -30px;z-index:-1;">
                            </center>
                        </td>
                    </tr>

                    <tr>
                        <th>Student's Name :</th>
                        <td style="padding: 8px !important;" colspan='1'><?php echo $data['STU_NAME']; ?></td>
                        <th>Roll No.</th>
                        <td style="padding: 8px !important;"><?php echo $data['ROLL_NO']; ?></td>
                    </tr>

                    <tr>
                        <th>Mother's Name :</th>
                        <td style="padding: 8px !important;" colspan='5'><?php echo $data['MOTHER_NM']; ?></td>
                    </tr>

                    <tr>
                        <th>Father's Name :</th>
                        <td style="padding: 8px !important;" colspan='5'><?php echo $data['FATHER_NM']; ?></td>
                    </tr>

                    <tr>
                        <th>Date of Birth :</th>
                        <td style="padding: 8px !important;" colspan='1'><?php echo date('d-M-y', strtotime($data['BIRTH_DT'])); ?></td>
                        <th>Attendance :</th>
                        <td style="padding: 8px !important;text-align: left;" colspan='2'><?php echo ": " . $data['t2_present_days'] . '/182'; ?></td>
                    </tr>
                </table>

                <br />
                <br />

                <table class='table2' style="border-spacing: 15px !important;border-collapse:collapse !important;">
                    <tr class="border">
                        <th rowspan='2' class="border">
                            <center>SL. NO.</center>
                        </th>
                        <th rowspan='2' colspan='2' class="border">
                            <center>SUBJECT</center>
                        </th>
                        <th colspan='2' class="border">
                            <center><?php if ($trm == 1) {
                                        echo "MID ";
                                    } else {
                                        echo "ANNUAL ";
                                    } ?> EXAM</center>
                        </th>
                    </tr>
                    <tr class="border">
                        <th class="border">
                            <center> <?php if ($trm == 1) {
                                            echo "1<sup style='font-size:8px !important;'>ST</sup><br/>EVALUATION";
                                        } else {
                                            echo "3<sup style='font-size:8px !important;'>RD</sup><br/>EVALUATION";
                                        } ?> </center>
                        </th>
                        <th class="border">
                            <center><?php if ($trm == 1) {
                                        echo "2<sup style='font-size:8px !important;'>ND</sup><br/>EVALUATION";
                                    } else {
                                        echo "4<sup style='font-size:8px !important;'>TH</sup><br/>EVALUATION";
                                    } ?> </center>
                            </center>
                        </th>
                    </tr>
                    <?php
                    $grnd_tot = 0;
                    $i = 0;
                    ?>
                    <?php foreach ($data['sub'] as $key2 => $subject) {
                        // echo "<pre>";print_r($subject);die; 
                        if ($subject['opt_code'] == 2) { ?>
                            <tr class="border">
                                <td rowspan="2" class="border">
                                    <center><?php echo $i + 1; ?></center>
                                </td>
                                <td rowspan="2" class="border">&nbsp;&nbsp;&nbsp;
                                    <?php echo $subject['subject_name']; ?>
                                </td>
                                <td class="border">
                                    <center>ORAL</center>
                                </td>

                                <?php
                                if (!empty($subject['marks'])) {
                                    if ($trm == 1) { ?>
                                        <td class="border">
                                            <?php foreach ($subject['marks'] as $key99 => $val99) {
                                                if ($val99['ExamC'] == 9 && $val99['type'] == 1) { ?>
                                                    <center><?php echo $val99['M2']; ?></center>
                                        </td>
                                <?php  }
                                            } ?>
                                <td class="border">
                                    <?php foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 10 && $val99['type'] == 1) { ?>

                                            <center><?php echo $val99['M2']; ?></center>
                                </td>
                        <?php  }
                                        }
                                    } else {
                        ?>
                        <td class="border">
                            <?php foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 11 && $val99['type'] == 1) { ?>

                                    <center><?php echo $val99['M2']; ?></center>
                        </td>
                <?php  }
                                        } ?>
                <td class="border">
                    <?php foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 12 && $val99['type'] == 1) { ?>

                            <center><?php echo $val99['M2']; ?></center>
                </td>
    <?php  }
                                        }
                                    }
                                } else { ?>
    <td class="border">
    </td>
    <td class="border">
    </td>
<?php } ?>

                            </tr>
                            <tr class="border">
                                <td class="border">
                                    <center>WRITTEN</center>
                                </td>
                                <?php
                                if (!empty($subject['marks'])) {
                                    if ($trm == 1) { ?>
                                        <td class="border">
                                            <?php foreach ($subject['marks'] as $key99 => $val99) {
                                                if ($val99['ExamC'] == 9 && $val99['type'] == 2) { ?>

                                                    <center><?php echo $val99['M2']; ?></center>

                                            <?php  }
                                            } ?>
                                        <td class="border">
                                            <?php foreach ($subject['marks'] as $key99 => $val99) {
                                                if ($val99['ExamC'] == 10 && $val99['type'] == 2) { ?>

                                                    <center><?php echo $val99['M2']; ?></center>

                                            <?php  }
                                            }
                                        } else { ?>
                                        <td class="border">
                                            <?php foreach ($subject['marks'] as $key99 => $val99) {
                                                if ($val99['ExamC'] == 11 && $val99['type'] == 2) { ?>

                                                    <center><?php echo $val99['M2']; ?></center>

                                            <?php  }
                                            } ?>
                                        <td class="border">
                                            <?php foreach ($subject['marks'] as $key99 => $val99) {
                                                if ($val99['ExamC'] == 12 && $val99['type'] == 2) { ?>

                                                    <center><?php echo $val99['M2']; ?></center>

                                        <?php  }
                                            }
                                        }
                                    } else { ?>
                                        <td class="border">
                                        </td>
                                        <td class="border">
                                        </td>
                                    <?php  } ?>
                            </tr>
                        <?php } else if ($subject['opt_code'] == 1) {

                        ?>
                            <tr class="border">
                                <td class="border">
                                    <center><?php echo $i + 1; ?></center>
                                </td>
                                <td class="border">&nbsp;&nbsp;&nbsp;
                                    <?php echo "  " . $subject['subject_name']; ?>
                                </td>
                                <td class="border">
                                    <center>ORAL</center>
                                </td>

                                <?php
                                if (!empty($subject['marks'])) {
                                    if ($trm == 1) {
                                        foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 9 && $val99['type'] == 1) { ?>
                                                <td class="border">
                                                    <center><?php echo $val99['M2']; ?></center>

                                                <?php  }
                                        }

                                        foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 10 && $val99['type'] == 1) { ?>
                                                <td class="border">
                                                    <center><?php echo $val99['M2']; ?></center>

                                                <?php  }
                                        }
                                    } else {
                                        foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 11 && $val99['type'] == 1) { ?>
                                                <td class="border">
                                                    <center><?php echo $val99['M2']; ?></center>

                                                <?php  }
                                        }

                                        foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 12 && $val99['type'] == 1) { ?>
                                                <td class="border">
                                                    <center><?php echo $val99['M2']; ?></center>

                                        <?php  }
                                        }
                                    }
                                } else { ?>
                                                <td class="border">
                                                </td>
                                                <td class="border">
                                                </td>
                                            <?php } ?>

                            </tr>
                        <?php } else {
                        ?>
                            <tr class="border">
                                <td class="border">
                                    <center><?php echo $i + 1; ?></center>
                                </td>
                                <td colspan="2" class="border">&nbsp;&nbsp;&nbsp;
                                    <?php echo "  " . $subject['subject_name']; ?>
                                </td>
                                <?php
                                if (!empty($subject['marks'])) {
                                    if ($trm == 1) {
                                        foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 9 && $val99['type'] == 0) { ?>
                                                <td class="border">
                                                    <center><?php echo $val99['M2']; ?></center>

                                                <?php  }
                                        }

                                        foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 10 && $val99['type'] == 0) { ?>
                                                <td class="border">
                                                    <center><?php echo $val99['M2']; ?></center>

                                                <?php  }
                                        }
                                    } else {
                                        foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 11 && $val99['type'] == 0) { ?>
                                                <td class="border">
                                                    <center><?php echo $val99['M2']; ?></center>

                                                <?php  }
                                        }

                                        foreach ($subject['marks'] as $key99 => $val99) {
                                            if ($val99['ExamC'] == 12 && $val99['type'] == 0) { ?>
                                                <td class="border">
                                                    <center><?php echo $val99['M2']; ?></center>

                                        <?php  }
                                        }
                                    }
                                } else { ?>
                                                <td class="border">
                                                </td>
                                                <td class="border">
                                                </td>
                                            <?php } ?>

                            </tr> <?php
                                }
                                $i++;
                            } ?>
                </table>
                <br />
                <table class='table3' style="font-size: 12px;">
                    <tr>
                        <th>Remarks:</th>
                        <td><?php echo $data['rmks']; ?></td>
                    </tr>
                </table>


                <br />
                <br />
                <br />
                <br />




                <div class='row'>
                    <div class='col-sm-12'>
                        <table class='table'>
                            <tr>
                                <?php
                                foreach ($signature as $key => $val) {
                                    if ($val->SIGNATURE != '-') {
                                ?>
                                        <td class='sign'>
                                            <center><?php echo $val->SIGNATURE; ?></center>
                                        </td>
                                <?php }
                                } ?>
                            </tr>
                        </table>
                        <br /><br />
                        <span style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size:12px">&nbsp;&nbsp;Date of Result
                            Declaration : <?php echo '21-MARCH-2025'; ?></span>
                    </div>

                </div>

            </div>
            <?php if ($tot_rec  > $j++) { ?>
                <div style='page-break-after: always;'></div>
    <?php }
        }
    }
    ?>

    <!-- Modal -->
    <!-- <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <center><img class='img-responsive' src="<?php //echo base_url('assets/images/loading.gif'); 
                                                                ?>"></center>
                </div>
            </div>
        </div>
    </div> -->
    <!-- end Modal -->
</body>

</html>
<!-- <script>
    var lp = '<?php //echo $j; 
                ?>';
    var lp = lp - 1;
    $('#myModal').modal('show');
    for (var i = 1; i <= lp; i++) {
        var ab = $("#dyn_" + i).html();
        var adm = $("#adm_" + i).val();
        $.ajax({
            url: "<?php //echo base_url('report_card/report_card/adpdf_junior') 
                    ?>",
            data: {
                'value': ab,
                'idd': i,
                'admno': adm,
                'lp': lp
            },
            type: "POST",
            success: function(data) {
                if (lp == data) {
                    $('#myModal').modal('hide');
                    $.toast({
                        heading: 'Success',
                        text: 'Successfully Generated Report Card..!!',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right',
                    });
                    window.top.close();
                }
            }
        });
    }
</script> -->