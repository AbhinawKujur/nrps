<?php
if ($cls == 4 || $cls == 6 || $cls == 7 || $cls == 8) {
    $tot_working = 208;
} elseif ($cls == 5) {
    $tot_working = 207;
} else {
    $tot_working = 209;
}
?>
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
            padding: 3px !important;
            border: 1px solid #000 !important;
            font-size: 10px !important;
        }

        .th {
            border: 1px solid #000 !important;
        }

        @page {
            margin: 30px 12px 0px 12px;
        }

        .sign {
            font-family: 'Laila', serif;
        }

        #background {
            position: absolute;
            z-index: 2;
            display: block;
            min-height: 50%;
            min-width: 50%;
            opacity: 0.2;
            margin-top: 20%;
        }
    </style>
</head>

<body>

    <?php
    if (isset($result)) {
        $j = 1;
        $tot_rec = count($result);
        foreach ($result as $key => $data) {

            // echo '<pre>'; print_r($data); echo '</pre>';die;

    ?>

            <div style="border:5px solid #000; padding:10px;" id='dyn_<?php echo $j; ?>'>

                <div id='background'>
                    <center><img src=<?php echo base_url('assets/school_logo/BG_LOGO.png'); ?> width='80%' height='80%'></center>
                </div>

                <table style='border:none !important;' class='table'>
                    <tr>
                        <td>
                            <img src="<?php echo base_url($school_photo[0]->School_Logo); ?>" style="width:90px;">
                        </td>
                        <td>
                            <center><span style='font-size:20px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br />
                                <span style='font-size:18px !important'>
                                    <?php echo $school_setting[0]->School_Address; ?>
                                </span><br />
                                <b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
                                <br />
                                <b>WEBSITE: https://davnrps.com</b>
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
                                <center><span style='font-size:16px !important;'><b>REPORT CARD-ANNUAL EXAM</b></span></center>
                            </b>
                        </td>
                        <td style='text-align:right'><span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span></td>
                    </tr>
                </table>

                    <table style='font-size: 12px !important;padding: 1px !important;width:100%; margin-top:-15px !important;'>
                    <tr>
                        <th>Admission No. :</th>
                        <td style="padding: 8px !important;"><?php echo $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'></td>
                        <th>Class-Sec:</th>
                        <td style="padding: 8px !important;"><?php echo $data['DISP_CLASS'] . " - " . $data['DISP_SEC']; ?></td>
                        <td rowspan="5" colspan="2">
                            <center>
                                <img src="<?php echo base_url($data['student_image']); ?>" width='120px' height='120px' style="opacity: 1;margin-right: -30px;z-index:2;">
                            </center>
                        </td>
                    </tr>

                    <tr>
                        <th>Student's Name :</th>
                        <td style="padding: 8px !important;"><b><?php echo $data['FIRST_NM'] . " " . $data['MIDDLE_NM']; ?></b></td>
                        <th>Roll No.</th>
                        <td style="padding: 8px !important;"><?php echo $data['ROLL_NO']; ?></td>
                    </tr>

                    <tr>
                        <th>Mother's Name :</th>
                        <td style="padding: 8px !important;" colspan='3'><?php echo $data['MOTHER_NM']; ?></td>
                    </tr>

                    <tr>
                        <th>Father's Name :</th>
                        <td style="padding: 8px !important;" colspan='3'><?php echo $data['FATHER_NM']; ?></td>
                    </tr>

                    <tr>
                        <th>Date of Birth :</th>
                        <td style="padding: 8px !important;"><?php echo date('d-M-y', strtotime($data['BIRTH_DT'])); ?></td>
                        <th>Attendance :</th>
                        <td style="padding: 8px !important;" colspan='3'><?php echo $data['t2_present_days'] . '/' . $tot_working; ?></td>
                    </tr>
                </table>
                

                <table class='table'>
                    <tr>
                        <th class='th'>Scholastic Areas :</th>
                        <th colspan='8' class='th'></th>
                    </tr>
                    <tr>
                        <th style="width:250px;" class='th'>Subject Name</th>
                        <th class='th'>
                            <center>PERIODIC TEST<br />(10)</center>
                        </th>
                        <th class='th'>
                            <center>NOTE BOOK<br />(05)</center>
                        </th>
                        <th class='th'>
                            <center>SUBJECT<br />ENRICHMENT (05)</center>
                        </th>
                        <th class='th'>
                            <center>TERM-II<br />(80)</center>
                        </th>
                        <th class='th'>
                            <center>MARKS OBT.<br />TERM-II(100)</center>
                        </th>
                        <th class='th'>
                            <center>MARKS OBT.<br />MID TERM(100)</center>
                        </th>
                        <th class='th'>
                            <center>MID TERM<br />+TERM-II(100)</center>
                        </th>
                        <th class='th'>
                            <center>GRADE</center>
                        </th>
                    </tr>
                    <?php
                    $grnd_tot = 0;
                    $i = 0;
                    foreach ($data['sub'] as $subject) {
                        $term1 = $subject['marks']['TERM-1'] ?? [];
                        $term2 = $subject['marks']['TERM-2'] ?? [];

                        // TERM-1 marks
                        $pt_t1 = $term1[0] ?? '-';
                        $notebook_t1 = $term1[1] ?? '-';
                        $subject_enrichment_t1 = $term1[2] ?? '-';
                        $half_yearly = $term1[3] ?? '-';
                        $t1_total = array_sum(array_filter([$pt_t1, $notebook_t1, $subject_enrichment_t1, $half_yearly], 'is_numeric'));

                        // TERM-2 marks
                        $pt_t2 = $term2[5] ?? '-'; // Exam Code 7 (PT for TERM-2)
                        $notebook_t2 = $term2[1] ?? '-'; // Exam Code 5
                        $subject_enrichment_t2 = $term2[2] ?? '-'; // Exam Code 3
                        $second_term = $term2[4] ?? '-'; // Exam Code 5
                        $t2_total = array_sum(array_filter([$pt_t2, $notebook_t2, $subject_enrichment_t2, $second_term], 'is_numeric'));

                        // Display values
                        $pt = $pt_t2 !== '-' ? $pt_t2 : '-'; // TERM-2 Exam Code 7
                        $notebook = $notebook_t2 !== '-' ? $notebook_t2 : '-';
                        $subject_enrichment = $subject_enrichment_t2 !== '-' ? $subject_enrichment_t2 : '-';
                        $marks_obtained = $t2_total ? ($round_off == 1 ? round($t2_total) : number_format($t2_total, 2)) : '-';
                        $mid_term_total = $t1_total ? ($round_off == 1 ? round($t1_total) : number_format($t1_total, 2)) : '-';
                        $sum_term1_term2 = ($t1_total && $t2_total) ? ($round_off == 1 ? round(($t1_total + $t2_total) / 2) : number_format(($t1_total + $t2_total) / 2, 2)) : '-';

                        // Grade calculation
                        $grade = '-';
                        if (is_numeric($sum_term1_term2)) {
                            foreach ($grademaster as $g) {
                                if ($g->ORange >= $sum_term1_term2 && $g->CRange <= $sum_term1_term2) {
                                    $grade = $g->Grade;
                                    break;
                                }
                            }
                        }
                    ?>
                        <tr>
                            <th class='th'><?php echo $subject['subject_name']; ?></th>
                            <td class='th'>
                                <center><?php echo $pt; ?></center>
                            </td>
                            <td class='th'>
                                <center><?php echo $notebook; ?></center>
                            </td>
                            <td class='th'>
                                <center><?php echo $subject_enrichment; ?></center>
                            </td>
                            <td class='th'>
                                <center><?php echo $second_term; ?></center>
                            </td>
                            <td class='th'>
                                <center><?php echo $marks_obtained; ?></center>
                            </td>
                            <td class='th'>
                                <center><?php echo $mid_term_total; ?></center>
                            </td>
                            <td class='th'>
                                <center><?php echo $sum_term1_term2; ?></center>
                            </td>
                            <td class='th'>
                                <center><?php echo $grade; ?></center>
                            </td>
                        </tr>
                    <?php
                        if (is_numeric($sum_term1_term2)) {
                            $grnd_tot += $sum_term1_term2;
                            $i += 1;
                        }
                    }
                    $grd = $i > 0 ? ($round_off == 1 ? round($grnd_tot / $i) : number_format($grnd_tot / $i, 2)) : 0;
                    $fin_grade = '-';
                    foreach ($grademaster as $grade) {
                        if ($grade->ORange >= $grd && $grade->CRange <= $grd) {
                            $fin_grade = $grade->Grade;
                            break;
                        }
                    }
                    ?>
                    <tr>
                        <th class='th' colspan='1' style="text-align:left">Percentage <?php echo ': ' . $grd; ?>%</th>
                        <th class='th' colspan='6' style="text-align:right">Grand Total</th>
                        <td class='th'>
                            <center><?php echo $grnd_tot; ?></center>
                        </td>
                        <td class='th'>
                            <center><?php echo $fin_grade; ?></center>
                        </td>
                    </tr>
                </table>

                <div class='row'>
                    <div class='col-xs-8'>
                        <table class='table' border='1' style="width:100%">

                            <tr>
                                <th class='th' border='1' !important;>Co-Scholastic Areas :</th>
                                <th class='th' style='text-align:center'>Grade</th>
                            </tr>
                            <tr>
                                <th class='th'>VALUE / VEDIC EDUCATION</th>
                                <td class='th' style='text-align:center'><?php echo $data['skill_5']; ?></td>
                            </tr>
                            <tr>
                                <th class='th'>WORK EDUCATION</th>
                                <td class='th' style='text-align:center'><?php echo $data['skill_1']; ?></td>
                            </tr>
                            <tr>
                                <th class='th'>ART EDUCATION</th>
                                <td class='th' style='text-align:center'><?php echo $data['skill_2']; ?></td>
                            </tr>
                            <tr>
                                <th class='th'>HEALTH & PHYSICAL EDUCATION</th>
                                <td class='th' style='text-align:center'><?php echo $data['skill_3']; ?></td>
                            </tr>
                            <?php if ($report_card_type == 1) { ?>

                                <tr>
                                    <th class='th'>DISCIPLINE</th>
                                    <td class='th' style='text-align:center'><?php echo $data['dis_grd']; ?></td>
                                </tr>
                            <?php } else {
                            ?>


                            <?php
                            } ?>
                            <tr>
                                <td class='th' colspan='2' style='height:50px;'><b>Remarks:</b><br /><?php echo $data['rmks']; ?></td>
                            </tr>
                        </table>
                    </div>


                    <div class='col-xs-4'>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <table style='font-size: 14px;'>
                                    <tr>
                                        <td colspan='2' style="text-align:center; font-weight:bold">INSTRUCTIONS</td>
                                    </tr>
                                    <tr>
                                        <td colspan='2' style="text-align:center; font-weight:bold">Grading Scale for Scholastic Areas</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center;">Marks Range</th>
                                        <th style="text-align:center;">Grade</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">91 - 100</td>
                                        <td style="text-align:center;">A1</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">81 - 90</td>
                                        <td style="text-align:center;">A2</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">71 - 80</td>
                                        <td style="text-align:center;">B1</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">61 - 70</td>
                                        <td style="text-align:center;">B2</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">51 - 60</td>
                                        <td style="text-align:center;">C1</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">41 - 50</td>
                                        <td style="text-align:center;">C2</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">33 - 40</td>
                                        <td style="text-align:center;">D</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;">32 & Below</td>
                                        <td style="text-align:center;">E</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br />
                <br />

                <div class='row'>
                    <div class='col-sm-12'>
                        <table style='font-size:10px;width:100%;'>
                            <tr>
                                <td class='sign'>
                                    <center>SIGNATURE OF CLASS TEACHER</center>
                                </td>
                                <td class='sign'>
                                    <center>SIGNATURE OF PARENTS</center>
                                </td>
                                <td class='sign'>
                                    <center>SIGNATURE OF PRINCIPAL</center>
                                </td>
                            </tr>
                            <tr>
                                <td><br />Date of Result declaration: <?php echo '16-MARCH-2024'; ?> </td>
                            </tr>
                        </table>
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
	var lp = lp-1;
	$('#myModal').modal('show');
	for(var i=1; i<=lp; i++){
		var ab  = $("#dyn_"+i).html();
		var adm = $("#adm_"+i).val();
		$.ajax({	
		 url:"<?php //echo base_url('report_card/report_card/adpdf')
                ?>",
		 data:{'value':ab,'idd':i,'admno':adm,'lp':lp},
		 type:"POST",
		 success:function(data){
		 if(lp == data){
			$('#myModal').modal('hide');
			 $.toast({
				heading: 'Success',
				text: 'Successfully Genrated Report Card..!!',
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