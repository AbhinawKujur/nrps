<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Account Master</a> <i class="fa fa-angle-right"></i> Edit Ledger</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Ledger Master List
                      <a class="btn btn-success pull-right" href="<?php echo base_url('account_master/ledgermaster'); ?>"><i class="fa fa-step-backward"></i> Back</a></p><hr>
                  </div>
                  <!-- /.box-header -->
                  <form id="createForm" action="<?php echo base_url('account_master/ledgermaster/update/'.$id); ?>" method="post">
                    <div class="box-body">
                       <?php if($this->session->flashdata('msg')){ 
                          echo $this->session->flashdata('msg');
                         } ?>
                      <div class="row">
                       <!--  <div class="col-sm-4">
                          <div class="form-group">
                            <label>A/c No.</label><span class="req"> *</span>
                            <input type="text" name="ac_no" class="form-control" readonly="">
                          </div>
                        </div> -->
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Ledger No</label><span class="req"> *</span>
                            <input type="text" name="ledger_no" class="form-control" required="" value="<?php echo $singleData['LedgerNo']; ?>" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Ledger</label><span class="req"> *</span>
                            <input type="text" name="ledger" class="form-control" required="" style="text-transform: uppercase;" value="<?php echo $singleData['CCode']; ?>" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Accounts Group</label><span class="req"> *</span>
                            <select class="form-control select2" name="accountgroup" required="">
                              <option value="">Select</option>
                              <?php foreach ($accountGroupList as $key => $value) { ?>
                                <option value="<?php echo $value['GName']; ?>" <?php if($singleData['CBO']==$value['GName']){ echo "selected"; } ?>><?php echo $value['AcName']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>School Group</label><span class="req"> *</span>
                            <select class="form-control select2" name="schoolgroup" required="">
                              <option value="">Select</option>
                              <?php foreach ($accountSchoolGroupList as $key => $value) { ?>
                                <option value="<?php echo $value['cat_code']; ?>" <?php if($singleData['SG']==$value['cat_code']){ echo "selected"; } ?>><?php echo $value['CAT_ABBR']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Account Type</label><span class="req"> *</span>
                            <select class="form-control select2" name="account_type" required="">
                              <option value="">Select</option>
                              <?php foreach ($accountTypeList as $key => $value) { ?>
                                <option value="<?php echo $value['CAT_CODE']; ?>" <?php if($singleData['ANSWER']==$value['CAT_CODE']){ echo "selected"; } ?>><?php echo $value['CAT_ABBR']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Opening Balance</label><span class="req"> *</span>
                            <input type="text" name="opening_balance" class="form-control" required="" value="<?php echo $singleData['OBal']; ?>" autocomplete="off">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Dr./Cr.</label><span class="req"> *</span>
                            <select name="drcr" class="form-control">
                              <option value="D" <?php if($singleData['DC']=='D'){ echo "selected"; } ?>>Dr.</option>
                              <option value="C" <?php if($singleData['DC']=='C'){ echo "selected"; } ?>>Cr.</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Budget Amount</label><span class="req"> *</span>
                            <input type="text" name="budget_amount" class="form-control" required="" value="<?php echo $singleData['BAmount']; ?>" autocomplete="off">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="box box-footer">
                      <button class="btn btn-black pull-right" type="submit" name="save"><i class="fa fa-save"></i> Save</button>
                    </div>
                  </form>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>

      </div>
    </div>
  </div>
</div><br><br>


  <script type="text/javascript">

     //validation
$(document).ready(function () {

    $('#createForm').validate({ // initialize the plugin
        rules: {
            group_no: {
                remote: {
                url: '<?php echo base_url('account_master/accountgroup/checkGroupNo'); ?>',
                type: "post",
                data: {
                  group_no: function() {
                    return $( "#group_no" ).val();
                  }
                }
              },
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});
  </script>