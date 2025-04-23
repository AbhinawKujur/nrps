<?php
if (isset($student_data)) {
    $admission_no = $student_data[0]->ADM_NO;
    $emp_ward = $student_data[0]->EMP_WARD;
    $class = $student_data[0]->CLASS;
    $hostel = $student_data[0]->HOSTEL;
    $COMPUTER = $student_data[0]->COMPUTER;
    $SESSIONID = $student_data[0]->SESSIONID;
    $APR_FEE = $student_data[0]->APR_FEE;
    $MAY_FEE = $student_data[0]->MAY_FEE;
    $JUNE_FEE = $student_data[0]->JUNE_FEE;
    $JULY_FEE = $student_data[0]->JULY_FEE;
    $AUG_FEE = $student_data[0]->AUG_FEE;
    $SEP_FEE = $student_data[0]->SEP_FEE;
    $OCT_FEE = $student_data[0]->OCT_FEE;
    $NOV_FEE = $student_data[0]->NOV_FEE;
    $DEC_FEE = $student_data[0]->DEC_FEE;
    $JAN_FEE = $student_data[0]->JAN_FEE;
    $FEB_FEE = $student_data[0]->FEB_FEE;
    $MAR_FEE = $student_data[0]->MAR_FEE;
}
// if($rcpt_no)
// {
// $rcpt_no;
// }
if ($ward_type) {
    $ward_type;
}
if ($bsn) {
    $bsn;
}
if ($bsa) {
    $bsa;
}
if ($ffm) {
    $ffm;
}
if ($feehead1) {
    $feehead1;
}
if ($feehead2) {
    $feehead2;
}
if ($feehead3) {
    $feehead3;
}
if ($feehead4) {
    $feehead4;
}
if ($feehead5) {
    $feehead5;
}
if ($feehead6) {
    $feehead6;
}
if ($feehead7) {
    $feehead7;
}
if ($feehead8) {
    $feehead8;
}
if ($feehead9) {
    $feehead9;
}
if ($feehead10) {
    $feehead10;
}
if ($feehead11) {
    $feehead11;
}
if ($feehead12) {
    $feehead12;
}
if ($feehead13) {
    $feehead13;
}
if ($feehead14) {
    $feehead14;
}
if ($feehead15) {
    $feehead15;
}
if ($feehead16) {
    $feehead16;
}
if ($feehead17) {
    $feehead17;
}
if ($feehead18) {
    $feehead18;
}
if ($feehead19) {
    $feehead19;
}
if ($feehead20) {
    $feehead20;
}
if ($feehead21) {
    $feehead21;
}
if ($feehead22) {
    $feehead22;
}
if ($feehead23) {
    $feehead23;
}
if ($feehead24) {
    $feehead24;
}
if ($feehead25) {
    $feehead25;
}
if ($amt_feehead1) {
    $amt_feehead1;
}
if ($amt_feehead2) {
    $amt_feehead2;
}
if ($amt_feehead3) {
    $amt_feehead3;
}
if ($amt_feehead4) {
    $amt_feehead4;
}
if ($amt_feehead5) {
    $amt_feehead5;
}
if ($amt_feehead6) {
    $amt_feehead6;
}
if ($amt_feehead7) {
    $amt_feehead7;
}
if ($amt_feehead8) {
    $amt_feehead8;
}
if ($amt_feehead9) {
    $amt_feehead9;
}
if ($amt_feehead10) {
    $amt_feehead10;
}
if ($amt_feehead11) {
    $amt_feehead11;
}
if ($amt_feehead12) {
    $amt_feehead12;
}
if ($amt_feehead13) {
    $amt_feehead13;
}
if ($amt_feehead14) {
    $amt_feehead14;
}
if ($amt_feehead15) {
    $amt_feehead15;
}
if ($amt_feehead16) {
    $amt_feehead16;
}
if ($amt_feehead17) {
    $amt_feehead17;
}
if ($amt_feehead18) {
    $amt_feehead18;
}
if ($amt_feehead19) {
    $amt_feehead19;
}
if ($amt_feehead20) {
    $amt_feehead20;
}
if ($amt_feehead21) {
    $amt_feehead21;
}
if ($amt_feehead22) {
    $amt_feehead22;
}
if ($amt_feehead23) {
    $amt_feehead23;
}
if ($amt_feehead24) {
    $amt_feehead24;
}
if ($amt_feehead25) {
    $amt_feehead25;
}
if ($total_amount) {
    $total_amount;
}

?>
<form method='post' id='form_data'>

    <input type='hidden' value="<?php echo $ward_type; ?>" name="ward_type">
    <input type='hidden' value="<?php echo $bsn; ?>" name="bsn">
    <input type='hidden' value="<?php echo $bsa; ?>" name="bsa">
    <input type='hidden' value="<?php echo $ffm; ?>" name="ffm">
    <input type='hidden' value="<?php echo $rect_date; ?>" name="rect_date">
    <input type='hidden' value="<?php echo $admission_no; ?>" name='adm_no'>
    <div class="row">
        <?php
        if ($feehead1 != "" && $feehead1 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead1; ?></label>
                <input type="text" name="feehead1" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead1; ?>" id="feehead1" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead2 != "" && $feehead2 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead2; ?></label>
                <input type="text" name="feehead2"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead2; ?>" id="feehead2" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead3 != "" && $feehead3 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead3; ?></label>
                <input type="text" name="feehead3"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead3; ?>" id="feehead3" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead4 != "" && $feehead4 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead4; ?></label>
                <input type="text" name="feehead4" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead4; ?>" id="feehead4" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead5 != "" && $feehead5 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead5; ?></label>
                <input type="text" name="feehead5"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead5; ?>" id="feehead5" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead6 != "" && $feehead6 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead6; ?></label>
                <input type="text" name="feehead6" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead6; ?>" id="feehead6" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead7 != "" && $feehead7 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead7; ?></label>
                <input type="text" name="feehead7"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead7; ?>" id="feehead7" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead8 != "" && $feehead8 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead8; ?></label>
                <input type="text" name="feehead8" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead8; ?>" id="feehead8" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead9 != "" && $feehead9 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead9; ?></label>
                <input type="text" name="feehead9" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead9; ?>" id="feehead9" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead10 != "" && $feehead10 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead10; ?></label>
                <input type="text" name="feehead10"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead10; ?>" id="feehead10" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead11 != "" && $feehead11 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead11; ?></label>
                <input type="text" name="feehead11" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead11; ?>" id="feehead11" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead12 != "" && $feehead12 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead12; ?></label>
                <input type="text" name="feehead12"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead12; ?>" id="feehead12" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead13 != "" && $feehead13 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead13; ?></label>
                <input type="text" name="feehead13"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead13; ?>" id="feehead13" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead14 != "" && $feehead14 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead14; ?></label>
                <input type="text" name="feehead14" onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead14; ?>" id="feehead14" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead15 != "" && $feehead15 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead15; ?></label>
                <input type="text" name="feehead15"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead15; ?>" id="feehead15" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead16 != "" && $feehead16 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead16; ?></label>
                <input type="text" name="feehead16"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead16; ?>" id="feehead16" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead17 != "" && $feehead17 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead17; ?></label>
                <input type="text" name="feehead17"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead17; ?>" id="feehead17" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead18 != "" && $feehead18 != "=-") {

        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead18; ?></label>
                <input type="text" name="feehead18"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead18; ?>" id="feehead18" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead19 != "" && $feehead19 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead19; ?></label>
                <input type="text" name="feehead19"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead19; ?>" id="feehead19" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead20 != "" && $feehead20 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead20; ?></label>
                <input type="text" name="feehead20"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead20; ?>" id="feehead20" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead21 != "" && $feehead21 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead21; ?></label>
                <input type="text" name="feehead21"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead21; ?>" id="feehead21" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead22 != "" && $feehead22 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead22; ?></label>
                <input type="text" name="feehead22"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead22; ?>" id="feehead22" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead23 != "" && $feehead23 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead23; ?></label>
                <input type="text" name="feehead23"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead23; ?>" id="feehead23" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <?php
        if ($feehead24 != "" && $feehead24 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead24; ?></label>
                <input type="text" name="feehead24"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead24; ?>" id="feehead24" onchange="amtref()" class="form-control">
            </div>
        <?php
        }
        ?>
        <?php
        if ($feehead25 != "" && $feehead25 != "-") {
        ?>
            <div class="col-md-3 form-group">
                <label><?php echo $feehead25; ?></label>
                <input type="text" name="feehead25"  onkeypress="return event.charCode>=48 && event.charCode<=57 || event.charCode==46" value="<?php echo $amt_feehead25; ?>" id="feehead25" onchange="amtref()" class="form-control">
            </div>
        <?php
        } else {
        }
        ?>
        <div class="col-md-3">

        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-3">

        </div>
    </div>
    <div class="row">
        <div class="col-md-9">

        </div>
        <div class="col-md-3">
            <label>Total Amount</label>
            <input type="text"  style="text-align: right;" name="totalamount" id="totalamount" value="<?php echo $total_amount; ?>" class="form-control">
        </div>
    </div>
    <div class='row'>
        <div class='col-md-12 col-sm-12 col-lg-12'>
            <center>
                <p class='btn btn-success' onclick='payment_popup()'>Confirm Payment</p>
                <!-- <input type='submit' value='Confirm Payment' Class='btn btn-success'> -->
            </center>
        </div>
    </div>


    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background: #5785c3; color: #fff; font-weight: bold;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <CENTER>PAYMENT CONFIRMATION</CENTER>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Net Payable Amount:</label>
                            <input type="text" style="text-align: right;" name="npa" id="npa" value='<?php echo $total_amount; ?>'  class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Payment Mode:<span id="payerror" class="span"></span></label>
                            <select onchange="payment_modee(this.value)" name="pay_mod" class="form-control" id="payment_type">
                                <option value="">Select Option</option>
                                <?php
                                if ($payment_mode) {
                                    foreach ($payment_mode as $pay_data) {
                                ?>
                                        <option value="<?php echo $pay_data->payment_mode; ?>"><?php echo $pay_data->payment_mode; ?></option>

                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="bank_details" style="display: none;">
                        <div class="col-md-12">
                            BANK DETAILS
                        </div>
                    </div>
                    <div class="row" style="display: none;" id="card_show">
                        <div class="col-md-12 form-group">
                            <label id='cn'>Card Number:<span id="carderror" class="span"></span></label>
                            <input type="text" minlength="1" maxlength="50" onkeydown="disableEnterKey2(event)"  onkeypress='return IsAlphaNumeric(event)' ondrop="return false"   placeholder="Enter Card Number" autocomplete="off" name="card_name" id="card_name" class="form-control" value="0000">
                        </div>
                    </div>
                    <div class="row" style="display: none;" id="cheque_show">
                        <div class="col-md-12 form-group">
                            <label>Cheque Number: <span id="cheque" class="span"></span></label>
                            <input type="text" placeholder="Enter Cheque" autocomplete="off" name="chque_name" id="chque_name" class="form-control">
                        </div>
                    </div>
                    <div class="row" style="display: none;" id="bank_show">
                        <div class="col-md-12 form-group">
                            <label>Bank Name:<span id="bankname" class="span"></span></label>
                            <select id="bank_name" name="bank_name" class="form-control">
                                <option value="">select bank</option>
                                <?php
                                if ($bank) {
                                    foreach ($bank as $bank_data) {
                                ?>

                                        <option value="<?php echo $bank_data->Bank_Name; ?>" <?php if ($bank_data->Bank_Name == 'Axis Bank') {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $bank_data->Bank_Name; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="pay_date" style="display: none;">
                        <div class="form-group col-md-12">
                            <label>Payment Date: <span id="paydateerror" class="span"></span></label>
                            <input type="date" name="pd" id="pd" disabled value="<?php echo $rect_date; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row" id="button" style="display: none;">
                        <div class="form-group col-md-12">
                            <center><input type="submit" id='btnSubmit' name="submit" value="PAY NOW" class="btn btn-success"></center>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <input type='hidden' id='pay_mod'>

</form>

<script>
  
	
	var specialKeys = new Array();
    specialKeys.push(8); //Backspace
    specialKeys.push(9); //Tab
    specialKeys.push(46); //Delete
    specialKeys.push(36); //Home
    specialKeys.push(35); //End
    specialKeys.push(37); //Left
    specialKeys.push(39); //Right

    function IsAlphaNumeric(e) {
        var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
        var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || keyCode == 32 || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
        if (ret === false) {
            return ret;
        } else {
            document.getElementById("carderror").style.display = ret ? "none" : "inline";
        }
    }

    //function clos(){
    // location.reload();
    //}
  	function payment_popup() {
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    }
    function payment_modee(val) {
        $('#pay_mod').val(val);
        if (val == 'CASH') {
            $("#pay_date").show();
            $("#button").show();
            $("#bank_details").hide();
            $("#cheque_show").hide();
            $("#card_show").hide();
            $("#bank_show").hide();
            $("#card_name").prop('required', false);
            $("#bank_name").prop('required', false);
            $("#chque_name").prop('required', false);
        } else if (val == 'CARD SWAP') {
            $("#bank_details").show();
            $("#cheque_show").hide();
            $("#pay_date").show();
            $("#card_show").show();
            $("#bank_show").show();
            $("#button").show();
            $("#card_name").prop('required', true);
            $("#bank_name").prop('required', true);
            $("#cn").text('Card No.:');
        } else if (val == "CHEQUE") {
            $("#bank_details").show();
            $("#card_show").hide();
            $("#pay_date").show();
            $("#cheque_show").show();
            $("#bank_show").show();
            $("#button").show();
            $("#chque_name").prop('required', true);
            $("#bank_name").prop('required', true);
        } else if (val == "BQR" || val == "NEFT") {
            $("#bank_details").show();
            $("#cheque_show").hide();
            $("#pay_date").show();
            $("#card_show").show();
            $("#bank_show").show();
            $("#button").show();
            $("#card_name").prop('required', true);
            $("#bank_name").prop('required', true);
            $("#cn").text('Transaction No.:');
        } else {
            $("#bank_details").hide();
            $("#card_show").hide();
            $("#bank_show").hide();
            $("#cheque_show").hide();
            $("#card_deatis").hide();
            $("#pay_date").hide();
            $("#button").hide();
        }
    }
	
	function disableEnterKey(event) {
        if (event.keyCode === 13) {

            event.preventDefault();
        }
    }

    function disableEnterKey2(event) {
        if (event.keyCode === 13) {
            // alert('sdfdfsdf');
            event.stopPropagation();
            document.getElementById('bank_name').focus();
        }
    }

    function pay_date(val) {
        var dt = val;
        $("#pd").val(dt)
        if (event.keyCode === 13) {
            // alert('sdfdfsdf');
            event.stopPropagation();
            
        }
    }


    function amtref() {
        var feehead1 = parseFloat(document.getElementById('feehead1').value);
        var feehead2 = parseFloat(document.getElementById('feehead2').value);
        var feehead3 = parseFloat(document.getElementById('feehead3').value);
        var feehead4 = parseFloat(document.getElementById('feehead4').value);
        var feehead5 = parseFloat(document.getElementById('feehead5').value);
        var feehead6 = parseFloat(document.getElementById('feehead6').value);
        var feehead7 = parseFloat(document.getElementById('feehead7').value);
        var feehead8 = parseFloat(document.getElementById('feehead8').value);
        var feehead9 = parseFloat(document.getElementById('feehead9').value);
        var feehead10 = parseFloat(document.getElementById('feehead10').value);
        var feehead11 = parseFloat(document.getElementById('feehead11').value);
        var feehead12 = parseFloat(document.getElementById('feehead12').value);
        var feehead13 = parseFloat(document.getElementById('feehead13').value);
        var feehead14 = parseFloat(document.getElementById('feehead14').value);
        var feehead15 = parseFloat(document.getElementById('feehead15').value);
        var feehead16 = parseFloat(document.getElementById('feehead16').value);
        var feehead17 = parseFloat(document.getElementById('feehead17').value);
        var feehead18 = parseFloat(document.getElementById('feehead18').value);
        var feehead19 = parseFloat(document.getElementById('feehead19').value);
        var feehead20 = parseFloat(document.getElementById('feehead20').value);
        var feehead21 = parseFloat(document.getElementById('feehead21').value);
        var feehead22 = parseFloat(document.getElementById('feehead22').value);
        var feehead23 = parseFloat(document.getElementById('feehead23').value);
        var feehead24 = parseFloat(document.getElementById('feehead24').value);
        var feehead25 = parseFloat(document.getElementById('feehead25').value);

        var sum = (feehead1 + feehead2 + feehead3 + feehead4 + feehead5 + feehead6 + feehead7 + feehead8 + feehead9 + feehead10 + feehead11 + feehead12 + feehead13 + feehead14 + feehead15 + feehead16 + feehead17 + feehead18 + feehead19 + feehead20 + feehead21 + feehead22 + feehead23 + feehead24 + feehead25);
        $("#totalamount").val('');
        $("#totalamount").val(sum);
        $("#npa").val(sum);
    }

    $("#form_data").on("submit", function(event) {
        event.preventDefault();
        $("#btnSubmit").prop('disabled', true);
        var ffm = $("#ffm").val();
        $.ajax({
            url: "<?php echo base_url('Bank_payment/monthly_pay_details'); ?>",
            type: "POST",
            data: $("#form_data").serialize() + "&ffm=" + ffm,
            success: function(data) {

                window.location = "<?php echo base_url('Bank_payment/payment_rec_gen'); ?>";
                $('#myModal').modal('hide');
            }
        });
    });
</script>


