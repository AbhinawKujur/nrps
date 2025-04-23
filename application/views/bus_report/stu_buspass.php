<?php
// echo"<pre>";print_r($getData);
?>
<title>Bus-Pass</title>

<!-- CSS only -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style type='text/css' media='print'>
    @page {
        size: A7;
        margin: 0;
    }
</style>
<style>
    body {
        font-family: Verdana, Geneva, sans-serif;
        margin: revert;
    }

    .parent {
        border: 1px solid #000;
        width: 340px;
        height: 207px;
        display: flex;
        margin-top: 40px;
    }

    .child {
        display: block;
        border: 1px solid black;
        width: 93px;
    }

    .first {
        display: -webkit-inline-box;
        /* border: 1px solid #000; */
        width: 245px;
        height: 40px;
    }

    .last {
        /* border: 1px solid red; */
        height: 155px;
    }

    #fontId {
        color: red;
        text-shadow: 1px 1px 1px #ccc;
        font-size: 1.5em;
    }

    .fa-bus {
        color: #000;
        text-shadow: 1px 1px 1px #ccc;
        font-size: 1em;
    }


    .main {
        width: 780px;
        height: auto;
        padding-left: 15px;
        padding-right: 15px;
        padding-bottom: 20px;
        margin-left: 10px;
    }

    #right-box {
        float: right;
        background-color: white;
        margin-bottom: 20px;
        margin-right: 10px;
    }

    /* #nd-box {
        float: left;
        width: 180px;
        height: 160px;
        background-color: white;
        border: solid black;
        margin-left: 20px;
    } */

    #left-box {
        float: left;
        background-color: white;
        margin-bottom: 20px;
        margin-left: 10px;
    }

    .fixed {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
    }
</style>
<div class="main">
    <div id="hide" class="sticky" style="display: stiky; margin-left: 800px;">
        <div style="float:center"> <button class="btn btn-success" id="print">print</button></div>
    </div>
    <?php
    $j = 1;
    $i = 0;
    foreach ($getData as $key => $val) {
        if ($i > 7) {
            $i = 0;
    ?>
            <div style="page-break-after: always;padding-top: 40px;"></div>
        <?php
        }
        $i = $i + 1;

        if ($j % 2 != 0) { ?>

            <div id="left-box" class="parent">

                <div class="header" style="border: 1px solid black; width: 247px">
                    <div class="first">
                        <div style="height: fit-content;">
                            <table style='width:100%; font-size:8px;'>
                                <tr>
                                    <td>
                                        <center><img src="../<?php echo $schoolData[0]['SCHOOL_LOGO']; ?>" style="width:30px"></center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table style='width:87%; font-size:9px;'>
                            <tr>
                                <td>
                                    <center><b><?php echo strtoupper($schoolData[0]['School_Name']); ?>, RANCHI-834004<b></center>
                                </td>
                            </tr>
                            <tr style='width:100%; font-size:7.5px;'>
                                <td>
                                    <center><b>Phone- 2441176,<?php echo $schoolData[0]['School_PhoneNo'] . "," . $schoolData[0]['School_MobileNo']; ?><b></center>
                                </td>
                            </tr>
                            <tr style="border: 2px solid #000;display: inline-block;margin-left: 73px;font-size:10px; color:red">
                                <td style="padding: 2px;">
                                    <center><b>BUS PASS<b></center>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table style='width:100%; height:155px; font-size:8px; margin: 4px 6px;'>
                        <tr>
                            <td><b>Adm. No.</td>
                            <td>:</td>
                            <td colspan="3"><b><?php echo $val['ADM_NO']; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Class-Sec : <?php echo $val['DISP_CLASS'] . "-" . $val['DISP_SEC']; ?></b></td>
                            <!-- <td>&nbsp;</td> -->

                        </tr>
                        <tr>
                            <td><b>Name</b></td>
                            <td>:</td>
                            <td colspan="3"><b> <?php echo $val['FIRST_NM']; ?></b></td>

                        </tr>
                        <tr>
                            <td><b>Father's Name</b></td>
                            <td>:</td>
                            <td colspan="3"><b><?php echo $val['FATHER_NM']; ?></b></td>
                        </tr>

                        <tr>
                            <td><b>Mobile<b></td>
                            <td>:</td>
                            <td><b> <?php echo $val['C_MOBILE']; ?></b></td>
                            <td><b> Ph. : <?php echo $val['P_MOBILE']; ?></b></td>
                        </tr>
                        <tr>
                            <td><b>Stoppage</b></td>
                            <td>:</td>
                            <td colspan="3"><b><?php echo $val['STOPNO']; ?></b></td>
                            <!-- <td></td> -->
                        </tr>

                        <!-- <tr>
                            <td colspan="1"><b>Arrival Bus No.: D. <?php echo $val['arrival_bus_code']; ?></b></td>
                            <td colspan="3"><b>Departure Bus No.: D. <?php echo $val['departure_bus_code']; ?></b></td>
                            <td>&nbsp;</td>
                        </tr> -->
                        <tr>
                            <td><b>Address</b></td>
                            <td>:</td>
                            <td colspan="3"><b><?php echo $val['CORR_ADD'] . $val['C_CITY']; ?></b></td>
                            <!-- <td>&nbsp;</td> -->
                        </tr>

                        <tr>
                            <td colspan="2" style='text-align:right'><b><img src="../assets/school_logo/auth_sign.png" style='width:75px; height: 33px'><br />
                                    <center>Auth.Sig.</center>
                                </b></td>
                            <td><b>&nbsp;</b></td>
                            <td colspan="2" style='text-align:left'><b>
                                    <center><img src="../assets/school_logo/prin.png" style='width:75px; height: 33px'><br /> PRINCIPAL </center>
                                </b></td>
                        </tr>
                    </table>
                </div>
                <div class="child">
                    <table style='width:100%;height: 30px; font-size:8px;'>
                        <tr>
                            <td><b>
                                    <center>Academic Session <?php echo $schoolData[0]['School_Session']; ?> </center>
                                </b></td>
                        </tr>
                    </table>
                    <table class="" style="height: 175px; padding:1px;font-size: 10px; ">
                        <tr>
                            <td>
                                <img src="../<?php echo $val['student_image']; ?>" style="width:85px;height: 101px;">
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;"><b> Arr. : <span style="color:red; font-size:14px"><?php echo $val['arrival_bus_code']; ?></span></b></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;"><b> Dep.: <span style="color:red; font-size:14px"><?php echo $val['departure_bus_code']; ?></span></b></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;"><i id="fontId" class="fas fa-solid fa-droplet" color="red"></i><b> <?php echo $val['BLOOD_GRP']; ?></b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div> &emsp;

        <?php
        } else if ($j % 2 == 0) { ?>

            <div id="right-box" class="parent">

                <div class="header" style="border: 1px solid black; width: 247px">
                    <div class="first">
                        <div style="height: fit-content;">
                            <table style='width:100%; font-size:8px;'>
                                <tr>
                                    <td>
                                        <center><img src="../<?php echo $schoolData[0]['SCHOOL_LOGO']; ?>" style="width:30px"></center>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table style='width:87%; font-size:9px;'>
                            <tr>
                                <td>
                                    <center><b><?php echo strtoupper($schoolData[0]['School_Name']); ?>, RANCHI-834004<b></center>
                                </td>
                            </tr>
                            <tr style='width:100%; font-size:7.5px;'>
                                <td>
                                    <center><b>Phone- 2441176,<?php echo $schoolData[0]['School_PhoneNo'] . "," . $schoolData[0]['School_MobileNo']; ?><b></center>
                                </td>
                            </tr>
                            <tr style="border: 2px solid #000;display: inline-block;margin-left: 73px;font-size:10px; color:red">
                                <td style="padding: 2px;">
                                    <center><b>BUS PASS<b></center>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table style='width:100%; height:155px; font-size:8px; margin: 4px 6px;'>
                        <tr>
                            <td><b>Adm. No.</td>
                            <td>:</td>
                            <td colspan="3"><b><?php echo $val['ADM_NO']; ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Class-Sec : <?php echo $val['DISP_CLASS'] . "-" . $val['DISP_SEC']; ?></b></td>
                            <!-- <td>&nbsp;</td> -->

                        </tr>
                        <tr>
                            <td><b>Name</b></td>
                            <td>:</td>
                            <td colspan="3"><b> <?php echo $val['FIRST_NM']; ?></b></td>

                        </tr>
                        <tr>
                            <td><b>Father's Name</b></td>
                            <td>:</td>
                            <td colspan="3"><b><?php echo $val['FATHER_NM']; ?></b></td>
                        </tr>

                        <tr>
                            <td><b>Mobile<b></td>
                            <td>:</td>
                            <td><b> <?php echo $val['C_MOBILE']; ?></b></td>
                            <td><b> Ph. : <?php echo $val['P_MOBILE']; ?></b></td>
                        </tr>
                        <tr>
                            <td><b>Stoppage</b></td>
                            <td>:</td>
                            <td colspan="3"><b><?php echo $val['STOPNO']; ?></b></td>
                            <!-- <td></td> -->
                        </tr>

                        <!-- <tr>
                            <td colspan="1"><b>Arrival Bus No.: D. <?php echo $val['arrival_bus_code']; ?></b></td>
                            <td colspan="3"><b>Departure Bus No.: D. <?php echo $val['departure_bus_code']; ?></b></td>
                            <td>&nbsp;</td>
                         </tr> -->
                        <tr>
                            <td><b>Address</b></td>
                            <td>:</td>
                            <td colspan="3"><b><?php echo $val['CORR_ADD'] . $val['C_CITY']; ?></b></td>
                            <!-- <td>&nbsp;</td> -->
                        </tr>

                        <tr>
                            <td colspan="2" style='text-align:right'><b><img src="../assets/school_logo/auth_sign.png" style='width:75px; height: 33px'><br />
                                    <center>Auth.Sig.</center>
                                </b></td>
                            <td><b>&nbsp;</b></td>
                            <td colspan="2" style='text-align:left'><b>
                                    <center><img src="../assets/school_logo/prin.png" style='width:75px; height: 33px'><br /> PRINCIPAL </center>
                                </b></td>
                        </tr>
                    </table>
                </div>
                <div class="child">
                    <table style='width:100%;height: 30px; font-size:8px;'>
                        <tr>
                            <td><b>
                                    <center>Academic Session <?php echo $schoolData[0]['School_Session']; ?> </center>
                                </b></td>
                        </tr>
                    </table>
                    <table class="" style="height: 175px; padding:1px;font-size: 10px; ">
                        <tr>
                            <td>
                                <img src="../<?php echo $val['student_image']; ?>" style="width:85px;height: 101px !important;">
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;"><b> Arr. : <span style="color:red; font-size:14px"><?php echo $val['arrival_bus_code']; ?></span></b></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;"><b> Dep.: <span style="color:red; font-size:14px"><?php echo $val['departure_bus_code']; ?></span></b></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;"><i id="fontId" class="fas fa-solid fa-droplet" color="red"></i><b> <?php echo $val['BLOOD_GRP']; ?></b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div> &emsp;

        <?php } else {
            $j = 1;
        }
        ?>
    <?php ++$j;
    } ?>
</div>

<script>
    $("#print").click(function() {
        $(".main").show();
        $("#hide").hide();
        var p = window.print();
        if (!p) {
            $("#hide").show();
        }
    });
    $(window).scroll(function() {
        var sticky = $('.sticky'),
            scroll = $(window).scrollTop();

        if (scroll >= 100) sticky.addClass('fixed');
        else sticky.removeClass('fixed');
    });
</script>