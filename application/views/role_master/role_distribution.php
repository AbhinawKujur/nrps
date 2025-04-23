<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
  }
  .error{
    color: red;
   }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">General Setting </a> <i class="fa fa-angle-right"></i> Role Master</li>
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
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                    <table class="table table-bordered table-striped">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">Module</th>
                          <th style="background: #337ab7; color: white !important;">Menu Name</th>
                          <th style="background: #337ab7; color: white !important;">
                            Can Add <input type="checkbox" name="addCheckAll" class="flat-red" id="addCheckAll"></th>
                          <th style="background: #337ab7; color: white !important;">
                            Can Edit <input type="checkbox" name="editCheckAll" class="flat-red" id="editCheckAll"></th>
                          <th style="background: #337ab7; color: white !important;">
                            Can Delete <input type="checkbox" name="deleteCheckAll" class="flat-red" id="deleteCheckAll"></th>
                          <th style="background: #337ab7; color: white !important;">
                            Can View <input type="checkbox" name="viewCheckAll" class="flat-red" id="viewCheckAll"></th>
                        </tr>
                      </thead>
                      <tbody>
                      <form method="post" action="<?php echo base_url('role_master/role_distribution/updateProcess/').$id; ?>">
                         <?php foreach ($menuData as $key => $value) { ?>
                          <?php if($value['MODULE'] != NULL){ ?>
                             <tr style="background: #d0dbed !important;">
                              <td colspan="6"><strong><?php echo $value['MODULE']; ?></strong></td>
                             </tr>
                          <?php } else { ?>
                            <tr>
                              <td></td>
                              <td><?php echo $value['MENU_NAME']; ?></td>
                              <td>
                                <?php if($value['CAN_ADD'] != ''){ ?>
                                  <input type="checkbox" name="permission_data[]" class="addCheck" value="<?php echo $value['CAN_ADD']; ?>"  <?php if (in_array($value['CAN_ADD'], $permissionData)){ echo "checked"; } ?>>
                                <?php } ?>
                              </td>
                              <td>
                              <?php if($value['CAN_EDIT'] != ''){ ?>
                                <input type="checkbox" name="permission_data[]" class="editCheck" value="<?php echo $value['CAN_EDIT']; ?>" <?php if (in_array($value['CAN_EDIT'], $permissionData)){ echo "checked"; } ?>>
                              <?php } ?>
                              </td>
                              <td>
                              <?php if($value['CAN_DELETE'] != ''){ ?>
                                <input type="checkbox" name="permission_data[]" class="deleteCheck" value="<?php echo $value['CAN_DELETE']; ?>" <?php if (in_array($value['CAN_DELETE'], $permissionData)){ echo "checked"; } ?>>
                              <?php } ?>
                              </td>
                              <td>
                              <?php if($value['CAN_VIEW'] != ''){ ?>
                                <input type="checkbox" name="permission_data[]" class="viewCheck" value="<?php echo $value['CAN_VIEW']; ?>" <?php if (in_array($value['CAN_VIEW'], $permissionData)){ echo "checked"; } ?>>
                              <?php } ?>
                              </td>
                             </tr>
                         <?php } } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="6" class="text-right"><button type="submit" class="btn btn-success"><i class="fa fa-refresh" style="color: white;"></i> Update</button></td>
                          </tr>
                        </tfoot>
                      </form>
                    </table>    
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>
<script type="text/javascript">

  //add checkbox
    $('#addCheckAll').click(function(){
        if($(this).prop("checked")) {
            $(".addCheck").prop("checked", true);
        } else {
            $(".addCheck").prop("checked", false);
        }                
    });

    $('.addCheck').click(function(){
        if($(".addCheck").length == $(".addCheck:checked").length) {
            $("#addCheckAll").prop("checked", true);
        }else {
            $("#addCheckAll").prop("checked", false);            
        }
    });

    //edit checkbox
    $('#editCheckAll').click(function(){
        if($(this).prop("checked")) {
            $(".editCheck").prop("checked", true);
        } else {
            $(".editCheck").prop("checked", false);
        }                
    });

    $('.editCheck').click(function(){
        if($(".editCheck").length == $(".editCheck:checked").length) {
            $("#editCheckAll").prop("checked", true);
        }else {
            $("#editCheckAll").prop("checked", false);            
        }
    });

    //delete checkbox
    $('#deleteCheckAll').click(function(){
        if($(this).prop("checked")) {
            $(".deleteCheck").prop("checked", true);
        } else {
            $(".deleteCheck").prop("checked", false);
        }                
    });

    $('.deleteCheck').click(function(){
        if($(".deleteCheck").length == $(".deleteCheck:checked").length) {
            $("#deleteCheckAll").prop("checked", true);
        }else {
            $("#deleteCheckAll").prop("checked", false);            
        }
    });

    //view checkbox
    $('#viewCheckAll').click(function(){
        if($(this).prop("checked")) {
            $(".viewCheck").prop("checked", true);
        } else {
            $(".viewCheck").prop("checked", false);
        }                
    });

    $('.viewCheck').click(function(){
        if($(".viewCheck").length == $(".viewCheck:checked").length) {
            $("#viewCheckAll").prop("checked", true);
        }else {
            $("#viewCheckAll").prop("checked", false);            
        }
    });
    
    checkAllCheckBox();
    function checkAllCheckBox()
    {
      if($(".addCheck").length == $(".addCheck:checked").length) {
          $("#addCheckAll").prop("checked", true);
      }else {
          $("#addCheckAll").prop("checked", false);            
      }

      if($(".editCheck").length == $(".editCheck:checked").length) {
          $("#editCheckAll").prop("checked", true);
      }else {
          $("#editCheckAll").prop("checked", false);            
      }

      if($(".deleteCheck").length == $(".deleteCheck:checked").length) {
          $("#deleteCheckAll").prop("checked", true);
      }else {
          $("#deleteCheckAll").prop("checked", false);            
      }

      if($(".viewCheck").length == $(".viewCheck:checked").length) {
          $("#viewCheckAll").prop("checked", true);
      }else {
          $("#viewCheckAll").prop("checked", false);            
      }
    }
</script>