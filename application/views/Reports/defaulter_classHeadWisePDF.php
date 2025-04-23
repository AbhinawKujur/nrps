<?php
// echo"kjgkj";
// echo "<pre>";
// print_r($data);
?>
<?php
if ($feehead) {
    $head1 = $feehead[0]->SHNAME;
    $head2 = $feehead[1]->SHNAME;
    $head3 = $feehead[2]->SHNAME;
    $head4 = $feehead[3]->SHNAME;
    $head5 = $feehead[4]->SHNAME;
    $head6 = $feehead[5]->SHNAME;
    $head7 = $feehead[6]->SHNAME;
    $head8 = $feehead[7]->SHNAME;
    $head9 = $feehead[8]->SHNAME;
    $head10 = $feehead[9]->SHNAME;
    $head11 = $feehead[10]->SHNAME;
    $head12 = $feehead[11]->SHNAME;
    $head13 = $feehead[12]->SHNAME;
    $head14 = $feehead[13]->SHNAME;
    $head15 = $feehead[14]->SHNAME;
    $head16 = $feehead[15]->SHNAME;
    $head17 = $feehead[16]->SHNAME;
    $head18 = $feehead[17]->SHNAME;
    $head19 = $feehead[18]->SHNAME;
    $head20 = $feehead[19]->SHNAME;
    $head21 = $feehead[20]->SHNAME;
    $head22 = $feehead[21]->SHNAME;
    $head23 = $feehead[22]->SHNAME;
    $head24 = $feehead[23]->SHNAME;
    $head25 = $feehead[24]->SHNAME;
}
?>
<!DOCTYPE html>

<head>
    <style>
        @page {
            margin: 30px;
        }

        #img {
            height: 80px;
            width: 80px;
			margin-top:40px;
			z-index:-1;
			position:absolute;
			margin-left:100px;
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
            font-size: 14px !important;
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
    <img src="<?php echo base_url($School_setting[0]->SCHOOL_LOGO); ?>" id="img">
    <p style='float:right; font-size:15px; margin-top:15px;'>Report Generation Date:<?php echo date('d-m-y'); ?></p><br />
    <table width="100%" style="float:right;">
        <tr>
            <td id="tp-header">
                <center><?php echo $School_setting[0]->School_Name; ?></center>
            </td>
        </tr>
        <tr>
            <td id="mid-header">
                <center><?php echo $School_setting[0]->School_Address; ?></center>
            </td>
        </tr>
        <tr>
            <td id="last-header">
                <center>SESSION (<?php echo $School_setting[0]->School_Session; ?>)</center>
            </td>
        </tr>
    </table><br /><br /><br /><br />
    <hr>
    <div class='row'>
        <div class='col-md-12 col-xl-12 col-sm-12'>
            <div style='overflow:none;'>
                <table border="1" id='example' style="width: 100%;" cellpadding='0' cellspacing='0'>
					<caption>Fee Head Wise Defaulter For the Month - <?php echo $month; ?></caption>
                    <thead>
                        <tr>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important">SNO</th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important">NAME</th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important">ADM_NO</th>
                            <!-- <th style="background: #337ab7; color: white !important; font-size:12px !important">ROLL NO</th> -->
                            <th style="background: #337ab7; color: white !important; font-size:12px !important">Class/<br>Sec</th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important">Month Upto</th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important">Prev Year Dues</th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important">Curr Year Dues</th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head1; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head2; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head3; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head4; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head5; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head6; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head7; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head8; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head9; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php if($head10 == 'MISC RECEIPT') echo "Misc <br> Recpt"; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php if($head11 == "MISC / DONATION") echo "Misc/<br>Donation"; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head12; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head13; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head14; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head15; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head16; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head17; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head18; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head19; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head20; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head21; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head22; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head23; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important"><?php echo $head24; ?></th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important">
                                <?php if ($head25 == '-') {
                                    echo "PREV DUES";
                                } else {
                                    echo $head25;
                                } ?>
                            </th>
                            <th style="background: #337ab7; color: white !important; font-size:12px !important">TOTAL AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $val) { ?>
                            <tr>
                                <td><?php echo $val[0]; ?></td>
                                <td><?php echo $val[1]; ?></td>
                                <td><?php echo $val[2]; ?></td>
                                <!-- <td><?php echo $val[3]; ?></td> -->
                                <td><?php echo $val[4]; ?></td>
                                <td><?php echo $val[5]; ?></td>
                                <td><?php echo $val[6]; ?></td>
                                <td><?php echo $val[7]; ?></td>
                                <td><?php echo $val[8]; ?></td>
                                <td><?php echo $val[9]; ?></td>
                                <td><?php echo $val[10]; ?></td>
                                <td><?php echo $val[11]; ?></td>
                                <td><?php echo $val[12]; ?></td>
                                <td><?php echo $val[13]; ?></td>
                                <td><?php echo $val[14]; ?></td>
                                <td><?php echo $val[15]; ?></td>
                                <td><?php echo $val[16]; ?></td>
                                <td><?php echo $val[17]; ?></td>
                                <td><?php echo $val[18]; ?></td>
                                <td><?php echo $val[19]; ?></td>
                                <td><?php echo $val[20]; ?></td>
                                <td><?php echo $val[21]; ?></td>
                                <td><?php echo $val[22]; ?></td>
                                <td><?php echo $val[23]; ?></td>
                                <td><?php echo $val[24]; ?></td>
                                <td><?php echo $val[25]; ?></td>
                                <td><?php echo $val[26]; ?></td>
                                <td><?php echo $val[27]; ?></td>
                                <td><?php echo $val[28]; ?></td>
                                <td><?php echo $val[29]; ?></td>
                                <td><?php echo $val[30]; ?></td>
                                <td><?php echo $val[31]; ?></td>
                                <td><?php echo $val[32]; ?></td>
                                <td><?php echo $val[33]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
	window.print();
</script>
</html>