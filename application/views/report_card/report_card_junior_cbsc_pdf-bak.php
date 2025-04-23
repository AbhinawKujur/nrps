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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <style>
        .table {
            font-size: 12px !important;
        }

        @page {
            margin: 40px 12px 0px 12px;
        }

        .sign {
            font-family: 'Laila', serif;
        }

        .table1 {
            padding: 5px;

        }

        div {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>

<body>
    <?php
    if (isset($result)) {
        $j = 1;
        $tot_rec = count($result);
        foreach ($result as $key => $data) {
    ?>

            <div style="border:5px solid #000; padding:10px;display:none" id='dyn_<?php echo $j; ?>'>

                <table style='border:none !important;' class='table'>
                    <tr>
                        <td style="width: 20% !important;">
                            <center>
                                <img src="<?php echo $school_photo[0]->School_Logo; ?>" style="width:90px;">
                            </center>
                        </td>
                        <td style="width: 60% !important;">
                            <center><span style='font-size:20px !important; font-family: Verdana, Geneva, Tahoma, sans-serif;'><?php echo $school_setting[0]->School_Name; ?></span><br />
                                <span style='font-size:18px !important; font-family: Verdana, Geneva, Tahoma, sans-serif;'>
                                    <?php echo $school_setting[0]->School_Address; ?>
                                </span><br />
                                <span style='font-size:12px !important;font-weight:700; font-family: Verdana, Geneva, Tahoma, sans-serif;'>
                                    ACADEMIC SESSION : <?php echo $school_setting[0]->School_Session; ?>
                                </span><br />
                                <span style='font-size:12px !important;font-weight:700; font-family: Verdana, Geneva, Tahoma, sans-serif;'>
                                    WEBSITE : <?php echo $school_setting[0]->School_Webaddress; ?>
                                </span>
                            </center>
                        </td>
                        <td style='text-align:right; width: 20% !important;'>
                            <center>
                                <img src="<?php echo "assets/school_logo/arya_logo.png"; ?>" style="width:100px;">
                            </center>
                        </td>
                    </tr>
                    <br />
                    <tr>
                        <th><br /></th>
                        <th><br /></th>
                    </tr>
                    <tr>
                        <td style="width: 25% !important; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                            <center>Affiliation No.- <?php echo $school_setting[0]->School_AfftNo; ?></center>
                        </td>
                        <td style="width: 50% !important; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                            <b>
                                <center><span style='font-size:16px !important;font-weight: bold;'><u>REPORT CARD - <?php if ($trm == 1) {
                                                                                                                        echo "MID ";
                                                                                                                    } else {
                                                                                                                        echo "SECOND ";
                                                                                                                    } ?>TERM</u></span></center>
                            </b>
                        </td>
                        <td style="width: 25% !important; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                            <center>School Code - <?php echo $school_setting[0]->School_Code; ?></center>
                        </td>
                    </tr>
                </table>

                <br />
                <table class='table1'>
                    <tr>
                        <th>ADMISSION NO.</th>
                        <td><span class="underline"><?php echo ": " . $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'></span></td>
                        <th>CLASS - SEC</th>
                        <td><span class="underline"><?php echo ": " . $data['DISP_CLASS'] . " - " . $data['DISP_SEC']; ?></span></td>
                        <th>ROLL. NO.</th>
                        <td><span class="underline"><?php echo $data['ROLL_NO']; ?></span></td>
                    </tr>
                    <tr>
                        <th>NAME OF THE STUDENT </th>
                        <td colspan='5'><span class="underline"><?php echo ": " . $data['STU_NAME']; ?></span></td>

                    </tr>
                    <tr>
                        <th>MOTHER'S NAME</th>
                        <td colspan='5'><span class="underline"><?php echo ": " . $data['MOTHER_NM']; ?></span></td>
                    </tr>

                    <tr>
                        <th>FATHER'S NAME</th>
                        <td colspan='5'><span class="underline"><?php echo ": " . $data['FATHER_NM']; ?></span></td>
                    </tr>

                    <tr>
                        <th>D.O.B.</th>
                        <td colspan="2"><span class="underline"><?php echo ": " . date("d-M-Y", strtotime($data['BIRTH_DT'])); ?></span></td>
                        <th>ATTENDANCE :</th>
                        <td colspan="2"><span class="underline"><?php echo ": " . $data['WORK_DAYS']; ?></span></td>
                    </tr>
                </table>

                <br />

                <table class='table2'>
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
                                        echo "SECOND ";
                                    } ?>TERM EXAM</center>
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
                    ?>
                        <?php if ($subject['opt_code'] == 2) { ?>
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
                                // echo "<pre>";print_r($subject['marks']);die; 
                                if (!empty($subject['marks'])){
                                    foreach ($subject['marks'] as $key3 => $mrk) {
                                        if ($trm = 1) { ?>
                                            <td class="border">
                                                <?php if ($mrk['ExamC'] == 9 && $mrk['type'] == 1) {  ?>
                                                    <center><?php echo $mrk['M2']; ?></center>
                                                <?php
                                                } ?>
                                            </td>
                                            <td class="border">
                                                <?php if ($mrk['ExamC'] == 10 && $mrk['type'] == 1) {  ?>
                                                    <center><?php echo $mrk['M2']; ?></center>
                                                <?php
                                                } ?>
                                            </td>
                                    <?php
                                        }
                                    }
                                }else{ ?>
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
                                if (!empty($subject['marks'])){
                                    foreach ($subject['marks'] as $key3 => $mrk) {
                                        if ($trm = 1) { ?>
                                            <td class="border">
                                                <?php if ($mrk['ExamC'] == 9 && $mrk['type'] == 2) {  ?>
                                                    <center><?php echo $mrk['M2']; ?></center>
                                                <?php
                                                } ?>
                                            </td>
                                            <td class="border">
                                                <?php if ($mrk['ExamC'] == 10 && $mrk['type'] == 2) {  ?>
                                                    <center><?php echo $mrk['M2']; ?></center>
                                                <?php
                                                } ?>
                                            </td>
                                    <?php
                                        }
                                    } 
                                }else{ ?>
                                    <td class="border">
                                        </td>
                                    <td class="border">
                                        </td>
                               <?php  } ?>
                            </tr>
                        <?php } else if ($subject['opt_code'] == 1) { ?>
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
                                if (!empty($subject['marks'])){
                                    foreach ($subject['marks'] as $key3 => $mrk) {
                                        if ($trm = 1) { ?>
                                            <td class="border">
                                                <?php if ($mrk['ExamC'] == 9 && $mrk['type'] == 1) {  ?>
                                                    <center><?php echo $mrk['M2']; ?></center>
                                                <?php
                                                } ?>
                                            </td>
                                            <td class="border">
                                                <?php if ($mrk['ExamC'] == 10 && $mrk['type'] == 1) {  ?>
                                                    <center><?php echo $mrk['M2']; ?></center>
                                                <?php
                                                } ?>
                                            </td>
                                    <?php
                                        }
                                    }
                                }else{ ?>
                                    <td class="border">
                                        </td>
                                    <td class="border">
                                        </td>
                               <?php } ?>
                                
                            </tr>
                        <?php } else { ?>
                            <tr class="border">
                                <td class="border">
                                    <center><?php echo $i + 1; ?></center>
                                </td>
                                <td colspan="2" class="border">&nbsp;&nbsp;&nbsp;
                                    <?php echo "  " . $subject['subject_name']; ?>
                                </td>
                                <?php
                                if (!empty($subject['marks'])){
                                    foreach ($subject['marks'] as $key3 => $mrk) {
                                        if ($trm = 1) { ?>
                                            <td class="border">
                                                <?php if ($mrk['ExamC'] == 9 && $mrk['type'] == 0) {  ?>
                                                    <center><?php echo $mrk['M2']; ?></center>
                                                <?php
                                                } ?>
                                            </td>
                                            <td class="border">
                                                <?php if ($mrk['ExamC'] == 10 && $mrk['type'] == 0) {  ?>
                                                    <center><?php echo $mrk['M2']; ?></center>
                                                <?php
                                                } ?>
                                            </td>
                                    <?php
                                        }
                                    }
                                }else{ ?>
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
                <table class='table3'>
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
                <span style="font-family: Verdana, Geneva, Tahoma, sans-serif;font-size:12px">&nbsp;&nbsp;Date of Result Declaration : <?php echo date('d-M-Y'); ?></span>
                    </div>
					
                </div>
              
            </div>
            <?php if ($tot_rec  > $j++) { ?>
                <div style='page-break-after: always;'></div>
            <?php } ?>
            <?php
            ?>

    <?php

        }
    }
    ?>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <center><img class='img-responsive' src="<?php echo base_url('assets/images/loading.gif'); ?>"></center>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal -->
</body>

</html>
<script>
    var lp = '<?php echo $j; ?>';
    var lp = lp - 1;
    $('#myModal').modal('show');
    for (var i = 1; i <= lp; i++) {
        var ab = $("#dyn_" + i).html();
        var adm = $("#adm_" + i).val();
        $.ajax({
            url: "<?php echo base_url('report_card/report_card/adpdf_junior') ?>",
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
</script>