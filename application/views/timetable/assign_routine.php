<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
 .tab{
	 background: #337ab7; 
	 color: white !important;
	 border: 1px solid #e0d8d8
 }
 



 
   

</style>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Class Routine Allotment</a></li>
</ol>
<!-- Content Wrapper. Contains page content -->
<div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;padding-top: 20px;">
<div class="row">
<div class="col-sm-12">
  <div class="" style="padding-bottom: 20px;">
    <section class="content">
    <div class="row"> <?php echo form_open('timetable/AssignRoutine/createroutine',array('role'=>'form','id'=>'createForm')); ?>
      <div class="col-sm-3">
        <div class="box box-primary">
          <!-- /.box-header -->
          <div class="box-body" style='font-size: 12px;'>
            <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
            <div class="form-group">
              <label>Class Name</label>
              <span class="req">*</span>
              <select class="form-control" name="class_sec_id" required="" id="class_sec_id" onchange="classid(this.value);teacherdet(this.value);period(this.value)">
                <option value="">Select</option>
                <?php foreach ($class_detail as $key => $value) { ?>
                <option value="<?php echo $value['Class_Sec_SubCode']; ?>"><?php echo $value['Class_name_Roman']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Subject Details</label>
              <span class="req">*</span>
              <select class="form-control" name="subj_name" required="" id="subj_name" onchange="subjectid(this.value)">
                <option value="">Select</option>
              </select>
            </div>
            <div class="form-group">
              <label>Class Teacher Name</label>
              <span class="req">*</span>
              <input type="text" name="teachername" class="form-control" id="teachername" readonly="">
            </div>
            <div class="form-group">
              <label>Selection</label>
              <div class="row">
                <div class="col-md-6">
                  <input type="radio" name="selection" id="selection1" value="1" class="selection" onclick="slection(this.value)">
                  Sequentially </div>
                <div class="col-md-6">
                  <input type="radio" name="selection" value="2" id="selection2" class="selection" onclick="slection(this.value)" checked>
                  Matrix Selection </div>
              </div>
              <div class="row">
                <div class="col-md-6"> <span id="sel" style="display:none">
                  <label>No. of period In A Week</label>
                  <select class="" name="priod_in_week"  id="priod_in_week">
                    <option value="">--Select--</option>
                    <?php for($i=1; $i<=6; $i++){ ?>
                    <option value="<?=$i;?>"><?=$i;?></option>
                    <?php }?>
                  </select>
                  </span><br>
                  <div class="form-group">
                    <label>Select Period</label>
                    <select name="select_period" id="select_period" required="" >
                      <option value="">--Select--</option>
                      <?php
						for($i=1; $i<=8; $i++){
					  ?>
                      <option value="period_<?=$i;?>">
                      <?=$i;?>
                      </option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6" id='sel1'>
                  <?php foreach ($week_detail as $key => $value) { ?>
                  <input type="checkbox" name="days" id="days" value='<?=$value['id']?>'>
                  <?=$value['day_shrt_nm']?>
                  <br>
                  <?php }?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <input type="button" name="erase" value="Erase" id="Erase"  class="btn btn-danger btn-xs">
              </div>
              <div class="col-md-6" style="text-align: right;">
                <input type="button" name="assign" value="Assign" onclick="assign_routin();" class="btn btn-primary btn-xs">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4"><br />
        <input type="checkbox" name="fixed_period" value="1" />
        To Fixed The Period<br />
        <br />
        <div style="border: 1px solid;overflow-x: auto;height: 350px;">
          <div class="box box-primary">
            <p class="box-title" style="font-weight: bold; background: #5784c3; color: white;text-align:center;padding-top:10px">Alloted Teacher List</p>
            <!-- /.box-header -->
            <div class="box-body" id="aloted"> </div>
          </div>
        </div>
      </div>
      <?php echo form_close(); ?> <br />
      <div class="col-sm-5" style="border: 1px solid;">
        <div class="box box-primary">
          <div class="box-header with-border">
            <p class="box-title" style="font-weight: bold;"></p>
            <hr>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" style="display:none">
                <tr  style="font-size:14px">
                  <td class="tab"></td>
                  <td class="tab">PERIOD-1</td>
                  <td class="tab">PERIOD-2</td>
                  <td class="tab">PERIOD-3</td>
                  <td class="tab">PERIOD-4</td>
                  <td class="tab">PERIOD-5</td>
                  <td class="tab">PERIOD-6</td>
                  <td class="tab">PERIOD-7</td>
                  <td class="tab">PERIOD-8</td>
                </tr>
                <?php foreach ($week_detail as $key => $value) { ?>
                <tr>
                  <td class="tab"><?=$value['day_shrt_nm']?></td>
                  <?php for($p=1; $p<=8; $p++){ ?>
                  <td><?=$value['id']?>
                    <?=$p?></td>
                  <?php } ?>
                </tr>
                <?php }?>
              </table>
              <div> </div>
            </div>
          </div>
        </div>
        <!-- /.box -->
        </section>
      </div>
      <br>
      <br>
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
        <div class="row">
            <div class="col-sm-8 table-responsive" id="periods">
           
			</div>
        <div class="col-sm-4" style="overflow-x: auto;height: auto;">
        <div class="box box-primary">
        <div class="box-body" id="div"> </div>
		</div>
      </div>
      </div>
          <!-- /.box -->
      </section>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<script>

	function assign_routin(){
		var days = [];
		$("input:checkbox[name=days]:checked").each(function () {
			days.push($(this).attr("value"));
		});
		
		var fixed_period = [];
		$("input:checkbox[name=fixed_period]:checked").each(function () {
			fixed_period.push($(this).attr("value"));
		});
		
		if(document.getElementById('selection1').checked) {
			var selection=1;
		}else{
			var selection=2;
		}
		
		var class_sec_id 		= $('#class_sec_id').val();
		var subj_name 			= $('#subj_name').val();		
		var select_period	 	= $('#select_period').val();
		var teacher_codes	 	= $('#teacher_codes').val();
		var priod_in_week	 	= $('#priod_in_week').val();		
		if(class_sec_id!="")
		{
			if(subj_name!=" ")
			{
				if(select_period!="")
				{
					if(teacher_codes==""){
						$.toast({
						heading: 'Error',
						text: 'Please Assign Subject Teacher',
						showHideTransition: 'slide',
						icon: 'error',
						position: 'top-right',
						});
					}
					$.post("<?php echo base_url('timetable/AssignRoutine/assign_routin'); ?>",{days:days,class_sec_id:class_sec_id,subj_name:subj_name,selection:selection,select_period,select_period,fixed_period:fixed_period,teacher_codes:teacher_codes,priod_in_week:priod_in_week},function(data){
					if(data!=""){
					alert(data);
					}
					period(class_sec_id);
					classid(class_sec_id);	
					
					});
				}else{
					$.toast({
					heading: 'Error',
					text: 'Please Select Period.',
					showHideTransition: 'slide',
					icon: 'error',
					position: 'top-right',
					});
				}
			}else{
				$.toast({
				heading: 'Error',
				text: 'Please Select Subject Name',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
				});
			}
		}else{
			$.toast({
			heading: 'Error',
			text: 'Please Select Class/Section',
			showHideTransition: 'slide',
			icon: 'error',
			position: 'top-right',
			});
		}
	}
/*******************Assign Period Table Data Show********************/

	function period(class_sec_id){
		$.post("<?php echo base_url('timetable/AssignRoutine/period'); ?>",{class_sec_id:class_sec_id},function(data){				
			$('#periods').html(data);				
		});	
	}

/******************Select Subject Option***************/

	function classid(classid){	
				$.post("<?php echo base_url('timetable/AssignRoutine/subject_details'); ?>",{classid:classid},function(data){				
				$('#subj_name').html(data);				
			});
		}
/**************Show and Hide Selection *******************/
		
	function slection(selid){
		var selid=selid;
		if(selid==1){
			$('#sel').show();
			$('#sel1').hide();
		}else{
			$('#sel').hide();
			$('#sel1').show();
		}
		
	}
	
/*********************Teacher Details List**********************/

	function teacherdet(classecid){	
		
			$.post("<?php echo base_url('timetable/AssignRoutine/teacher_details'); ?>",{classecid:classecid},function(data){	
					$fillData = $.parseJSON(data);
					$('#teachername').val($fillData[0]);							
					$('#div').html($fillData[2]);				
				});
		
	}

/***************Alloted Teacher List**********************/
	
	function subjectid(subid){
		$('#aloted').html('');
		if(subid != ' '){
			$.post("<?php echo base_url('timetable/AssignRoutine/allotedteacher'); ?>",{subid:subid},function(data){
					$('#aloted').html(data);				
				});
		}
	}
	
	
	

</script>
