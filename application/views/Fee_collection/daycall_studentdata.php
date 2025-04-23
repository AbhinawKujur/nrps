<?php

if (isset($rect_details)) {
    $RECT_NO = $rect_details[0]->RECT_NO;
    $CHQ_NO = $rect_details[0]->CHQ_NO;
    $Payment_Mode = $rect_details[0]->Payment_Mode;
    $Bank_Name = $rect_details[0]->Bank_Name;
}
?>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">

    <form id='form_data'>

        <div class="row">

            <div class="col-md-6 form-group">
                <label>Receipt No.<span id="rd" class="span"></span></label>
                <input type="text" name="recpitno" readonly value="<?php echo $RECT_NO; ?>" id="recpitno" class="form-control">
            </div>

            <div class="col-md-6 form-group">
                <label>Current Payment Mode<span id='fn' class="span"></span></label>
                <input type="text" class="form-control" readonly value="<?php echo $Payment_Mode; ?>">
            </div>

        </div>

        <?php if ($Payment_Mode == 'CARD SWAP' || $Payment_Mode == 'BQR' || $Payment_Mode == 'NEFT' ) { ?>
            <div class="row">

                <div class="col-md-6 form-group">
                    <label>Current Cheque/Card no.<span id="rd" class="span"></span></label>
                    <input type="text" name="chq_no" readonly value="<?php echo $CHQ_NO; ?>" id="chq_no" class="form-control">
                </div>

                <div class="col-md-6 form-group">
                    <label>Current Bank Name<span id='fn' class="span"></span></label>
                    <input type="text" class="form-control" readonly value="<?php echo $Bank_Name; ?>">
                </div>

            </div>
        <?php } ?>



        <div class="row">

            <div class="col-md-4 form-group">
                <label>Select Payment Mode<span id="cls" class="span"></span></label>
                <select id="paymentmode" name="paymentmode" class="form-control" onchange="Select_Bank(this.value);">
                    <option value="">select Payment Mode</option>
                    <?php
                    foreach ($payment_mode_all as $paymod) {
                        if ($Payment_Mode != $paymod->payment_mode) {
                    ?>
                            <option value="<?php echo $paymod->payment_mode ?>"><?php echo $paymod->payment_mode ?></option>
                    <?php }
                    }

                    ?>
                </select>
            </div>

            <div class="col-md-4 form-group" id="bank_div" style="display: none;">
                <label>Select Bank<span id="cls" class="span"></span></label>
                <select id="bank_name" name="bank_name" class="form-control">
                    <option value="">select Bank</option>
                    <?php
                    foreach ($bank_master_all as $bank) { ?>
                        <option value="<?php echo $bank->Bank_Name ?>"><?php echo $bank->Bank_Name; ?></option>
                    <?php }
                    ?>
                </select>
            </div>

            <div class="col-md-4 form-group" id="chq_div" style="display: none;">
                <label>Transaction No.<span id='fn' class="span"></span></label>
                <input type="text" class="form-control" maxlength="25" id="chq_no" name="chq_no">
            </div>
        </div>

        <div class="row">

            <div class="col-md-12 form-group">
                <center><input type="submit" name="submit" id="submit" value="SAVE" class="btn btn-success"></center>
            </div>

        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
</link>

<script>
    function Select_Bank(val) {
        if (val == 'CASH' || val == 'ONLINE') {
            $("#bank_div").hide();
            $("#chq_div").hide();
        }
        if (val == 'CARD SWAP' || val == 'UPI' || val == 'CHEQUE' || val == 'BQR' || val == 'NEFT') {
            $("#bank_div").show();
            $("#chq_div").show();
        }
    }

    $("#form_data").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('Fees_collection/update_paymode'); ?>",
            type: "POST",
            data: $("#form_data").serialize(),
            success: function(response) {
                swal({
                    title: "Payment Mode",
                    text: "Payment Mode Updated",
                    type: "success",
                }).then(function() {
                    window.location = 'pay_mode_update';
                });
            }

        });
    });
</script>