<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <title>Character Certificate</title>
    <style>
        @media print {
            #printPageButton {
                display: none;
            }
            #backPageButton{
                display: none;
            }
        }

        @page {
            margin: 10px 50px 0px 50px;
        }

        a,a:hover{
            color: white;
            text-decoration: none;
        }

        .table>tbody>tr>td {
            height: 27px;
            border-top: none !important;
            margin: 2px 2px;
        }

        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .border_bottom {
            border-bottom: 1px solid #000;
            font-style: italic;
            font-family: "Times New Roman", Times, serif;
            font-size: 13px;
            font-weight: bold;
        }

        .caption {
            font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
            font-size: 13px;
        }

        p {
            word-spacing: 3px;
            line-height: 40px;
        }
    </style>
</head>

<body>
    <center>
        <button id="printPageButton" class='btn btn-primary' onClick="window.print();">PRINT</button>
        <button id="backPageButton" class='btn btn-danger'><a href="<?php echo base_url('Certificate/char_show') ?>">BACK</a></button>
    </center>
    <?php
    error_reporting(0);
    ?>
    <br><br><br><br><br><br><br><br>


    <table style='width:100%;font-size: 14px;' class='table table-borderless'>
        <tr>
            <td style='width:33%;text-align: left;font-weight:700;'><i>Certificate No: - <?php echo $details_fetch[0]->CERT_NO; ?></i></td>
            <td style='width:33%;text-align: center;font-weight:700'><i>Visit us at : www.davnrps.com</i></td>
            <td style='width:33%;text-align: right;font-weight:700'><i>Date : <?php echo date('d-M-Y', strtotime($details_fetch[0]->Issued_Date)); ?> </i></td>
        </tr>
        <tr style="height: 5px;">
        </tr>
        <tr>
            <td style='width:33%;text-align: left;font-weight:700'><i>Affiliation No: - <?php echo $school_setting[0]->School_AfftNo; ?></i></td>
            <td style='width:33%;text-align: center;font-weight:700'></td>
            <td style='width:33%;text-align: right;font-weight:700'><i>School Code : <?php echo $school_setting[0]->School_Code; ?> </i></td>
        </tr>
    </table>
    <p style="font-weight: 700;font-size:14px;">This is to certify that Master/Miss <u style="font-size: 16px;font-style:"><?php echo $details_fetch[0]->S_NAME ?></u> , admission no. <u style="font-size: 16px;font-style:"><?php echo $details_fetch[0]->ADM_NO ?></u>  S/O - D/O <br> <u style="font-size: 16px;font-style:"><?php echo $details_fetch[0]->F_NAME ?></u> & <u style="font-size: 16px;font-style:"><?php echo $details_fetch[0]->M_Name ?></u> was a bonafide student of this institution. He / She passed his / her AISSE / AISSCE in <u style="font-size: 16px;font-style:"><?php echo substr($details_fetch[0]->End_DATE, 0, 4); ?></u> . His / Her general conduct during his / her stay in the School was <u style="font-size: 16px;font-style:">GOOD</u> . </p>

    <br>

    <table style='width:100%;font-size: 14px;' class='table table-borderless'>
		<tr>
            <td style='width:33%;text-align: center;font-weight: 700;'></td>
            <td style='width:33%;text-align: center;font-weight: 700;'></td>
            <td style='width:33%;text-align: center;font-weight: 700;'><i>Principal</i></td>
        </tr>
        <tr style="margin-top:-5px !important;">
            <td style='width:33%;text-align: center;font-weight: 700;'><i>Prepared By</i></td>
            <td style='width:33%;text-align: center;font-weight: 700;'><i>Space For School Stamp</i></td>
            <td style='width:33%;text-align: center;font-weight: 700;'><i><?php echo $school_setting[0]->School_Name; ?></i></td>
        </tr>
    </table>

    <!-- 
    <table style='width:100%' cellspacing='0' class='table'>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">TC. No.</td>
            <td colspan='5'>: <?php echo $tc_details[0]->TCNO; ?></td>
        </tr>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">Adm No.</td>
            <td>: <?php echo $tc_details[0]->adm_no; ?></td>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">Registration No.</td>
            <td>: <?php echo $tc_details[0]->RegistrationNo; ?></td>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">Board's Roll No.</td>
            <td>: <?php echo $tc_details[0]->BoardRollNo; ?></td>
        </tr>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">01. Name Of The Pupil</td>
            <td colspan='5' class='border_bottom'>: <?php echo $tc_details[0]->Name; ?></td>
        </tr>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">02. (A) Mother's Name</td>
            <td colspan='5' class='border_bottom'>: <?php echo $tc_details[0]->Mother_NM; ?></td>
        </tr>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(B) Father's Name</td>
            <td colspan='5' class='border_bottom'>: <?php echo $tc_details[0]->Father_NM; ?></td>
        </tr>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">03. Nationality</td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->Nation; ?></td>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">04. Whether S.C or S.T.</td>
            <td colspan='2' class='border_bottom'>: <?php echo $tc_details[0]->Category; ?></td>
        </tr>
        <tr>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">05. Admission Date In School</td>
            <td class='border_bottom'>: <?php echo $adm_d; ?></td>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">In Class</td>
            <td colspan='2' class='border_bottom'>: <?php echo $tc_details[0]->ADM_CLASS; ?></td>
        </tr>
        <tr>
            <td colspan='5' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">06. Date of birth (in Christan Era) as recorded in the Admission Register</td>
            <td class='border_bottom'>: <?php echo $dob_t; ?></td>
        </tr>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">In Words</td>
            <td colspan="5" class='border_bottom'>: <?php echo $tc_details[0]->dob_inwords; ?></td>
        </tr>
        <tr>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">07. Class in which the pupil studied last</td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->current_Class; ?></td>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">08. Whether failed, in same class </td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->combo09; ?></td>
        </tr>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">09. School/Board Annual Examinaton Last Taken </td>
            <td colspan='3' class='border_bottom'>: <?php echo $tc_details[0]->text08b; ?></td>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold"> Result </td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->TEXT08a; ?></td>
        </tr>
        <tr>
            <td colspan="6" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">10. Subject Studied</td>
        </tr>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">(A) Compulsory</td>
            <td colspan="5">
                <table cellspacing="0" width="100%">
                    <tr>
                        <td class='border_bottom'>(1) <?php echo $tc_details[0]->textsub1; ?></td>
                        <td class='border_bottom'>(2) <?php echo $tc_details[0]->textsub2; ?></td>
                    </tr>
                    <tr>
                        <td class='border_bottom'>(3) <?php echo $tc_details[0]->textsub3; ?></td>
                        <td class='border_bottom'>(4) <?php echo $tc_details[0]->textsub4; ?></td>
                    </tr>
                    <tr>
                        <td class='border_bottom'>(5) <?php echo $tc_details[0]->textsub5; ?></td>
                        <td class='border_bottom'>(6) <?php echo $tc_details[0]->textsub6; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">(B) Optional</td>
            <td colspan="5">
                <table cellspacing="0" width="100%">
                    <tr>
                        <td class='border_bottom'>(1) <?php echo $tc_details[0]->textsub7; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">11. Whether qualified for promotion to higher class</td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->combo011; ?></td>
            <td colspan='1' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">if so, to which class (in figure)</td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->datacombo011; ?> (<?php echo $tc_details[0]->txtClsW; ?>)</td>
        </tr>
        <tr>
            <td colspan="4" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">12. Month upto which the pupil has paid school due</td>
            <td colspan="2" class='border_bottom'>: <?php echo $tc_details[0]->combo12a; ?></td>
        </tr>
        <tr>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">13. Any fee concession availed</td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->combo016; ?></td>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">if so the nature of such concession</td>
            <td class='border_bottom'>: <?php echo ($tc_details[0]->combo016 == 'NO') ? "-" : $tc_details[0]->text017; ?></td>
        </tr>
        <tr>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">14. Total No. of School Working days</td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->text014; ?></td>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">15. Total No. of Days Present</td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->text015; ?></td>
        </tr>
        <tr>
            <td colspan="4" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">16. Whether NCC cadet/Boy/Girl Guide (Give Details)</td>
            <td colspan="2" class='border_bottom'>: <?php echo $tc_details[0]->combo013; ?></td>
        </tr>
        <tr>
            <td colspan="4" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">17. Games played/extra curricular actvites(Please Mention If Any)</td>
            <td colspan="2" class='border_bottom'>: <?php echo $tc_details[0]->combo012b; ?></td>
        </tr>
        <tr>
            <td colspan="3" class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">18. General Conduct</td>
            <td colspan="3" class='border_bottom'>: <?php echo $tc_details[0]->combo018; ?></td>
        </tr>
        <tr>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">19. Date of applicaton for certficate</td>
            <td class='border_bottom'>: <?php echo $text0191; ?></td>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">20. Date of issue of Certficate</td>
            <td class='border_bottom'>: <?php echo $text0201; ?></td>
        </tr>
        <tr>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">21. Reasons for leaving the school</td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->text021; ?></td>
            <td colspan='2' class='caption' style="font-family:calibri;font-size:12px;font-weight:bold">22. Any other Remarks</td>
            <td class='border_bottom'>: <?php echo $tc_details[0]->text022; ?></td>
        </tr>
        <tr>
            <td colspan="6"><br /><br /><br /></td>
        </tr>

        <tr>
            <td width="33.33%">
                <center><b>Class Teacher</b></center>
            </td>

            <td colspan="3">
                <center><b>Checked by <br /> (Name & Designation)</b></center>
            </td>

            <td>
                <center><b>Principal</b></center>
            </td>
        </tr>

    </table> -->
</body>
<script>
    $(document).ready(function() {
        window.print();
    });
</script>

</html>