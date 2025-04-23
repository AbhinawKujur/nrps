<?php
  $data_id = $this->session->userdata('login_details');
  $log_id = $data_id['user_id'];
  $role_id = $data_id['ROLE_ID'];
?>
<style type="text/css">
 .nav > li > a {
    font-weight: 500;
    padding: 8px 76px 10px 36px;
    font-size: 0.85em;
    border-bottom: 1px solid #E9E9E9;
    font-size: 15px;
}

.nav > li > a:hover, .nav > li > a:focus {
    background: #337ab7 !important;
	color: #fff !important;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #fff;
    cursor: default;
    background-color: #337ab7;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}

/*.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }*/
 .btn-danger{
	 background: red !important;
 } 
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">My Desk</a> <i class="fa fa-angle-right"></i> Leave Approval</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <!--<div class='row'>
    <table class='table'>
	  <tr>
	    <td><b>From Date</b> <input type="date" id="from_date" class="form-control"></td>
	    <td><b>To Date</b> <input type="date" id="to_date" class="form-control"></td>
	    <td><br /><button class='btn btn-success' onclick='date_srch()'>Search</button></td>
	  </tr>
    </table>
  </div>-->
  <?php if($this->session->flashdata('msg')){
	  echo $this->session->flashdata('msg');
	} ?>
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#pending">Pending Approval</a></li>
		<li><a data-toggle="tab" href="#approved">Approved</a></li>
		<li><a data-toggle="tab" href="#disapproved">Disapproved</a></li>
	  </ul>

		  <div class="tab-content">
		    <!-----pending------> 
			<div id="pending" class="tab-pane fade in active table-responsive"><br />
			  <table class='table dataTable'>
			   <thead>
			    <tr>
				  <th style="background: #337ab7 !important; color: white !important;">Emp Id</th>
				  <th style="background: #337ab7 !important; color: white !important;">Emp Name</th>
				  <th style="background: #337ab7 !important; color: white !important;">Designation</th>
				  <th style="background: #337ab7 !important; color: white !important;">Apply Date</th>
				  <th style="background: #337ab7 !important; color: white !important;">From Date</th>
				  <th style="background: #337ab7 !important; color: white !important;">To Date </th>
				  <th style="background: #337ab7 !important; color: white !important;">Total Days</th>
				  <th style="background: #337ab7 !important; color: white !important;">Reason</th>
				  <th style="background: #337ab7 !important; color: white !important;">Reason Details</th>
				  <th style="background: #337ab7 !important; color: white !important;">Action</th>
			    </tr>
			   </thead>
               <tbody>
                <?php
				  if(isset($empLeave)){
					  foreach($empLeave as $data){
						  if($role_id == 5 || $role_id == 6){//for wing
							  if($log_wing_id == $data->wing_id){
						?>
						  <tr>
						    <td><?php echo $data->EMPLOYEE_ID; ?></td>
						    <td><?php echo $data->empfnm ." ". $data->empmnm ." ". $data->emplnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->APPLY_DATE)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
							<td><?php echo ($data->TOTAL_DAYS)*1; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><?php echo $data->REASON_DETAILS; ?></td>
							<td><button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>',<?php echo ($data->TOTAL_DAYS)*1; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
						  </tr>
                        <?php
							  }						
					      }else{
							?>
							 <tr>
								<td><?php echo $data->EMPLOYEE_ID; ?></td>
								<td><?php echo $data->empfnm ." ". $data->empmnm ." ". $data->emplnm; ?></td>
								<td><?php echo $data->designm; ?></td>
								<td><?php echo date('d-M-Y',strtotime($data->APPLY_DATE)); ?></td>
								<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
								<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
								<td><?php echo ($data->TOTAL_DAYS)*1; ?></td>
								<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
								<td><?php echo $data->REASON_DETAILS; ?></td>
								<td><button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>',<?php echo ($data->TOTAL_DAYS)*1; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
							  </tr>
							<?php
						  }
					  }
				  }
				?>			   
               </tbody>			   
			  </table>
			</div>
			  <!--------approval modal------------>
				  <div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
					<form id="newApprovalForm" method="POST" action="<?php echo base_url('leave/leaveapproval/approveNewLeave'); ?>">
					  <div class="modal-content">
						<div class="modal-header" style="background:#5785c3; color:#fff;">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title"><label id='emp_id'></label></h4>
						</div>
						<div class="modal-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="text-center" style="background: #787673 !important;color: white !important;">CL<br>Balance</th>
										<th class="text-center" style="background: #787673 !important;color: white !important;">ML<br>Balance</th>
										<th class="text-center" style="background: #787673 !important;color: white !important;">EL<br>Balance</th>
										<th class="text-center" style="background: #787673 !important;color: white !important;">HPL<br>Balance</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="text-center"><span class="cl_total_balance_pending_area"></span></td>
										<td class="text-center"><span class="ml_total_balance_pending_area"></span></td>
										<td class="text-center"><span class="el_total_balance_pending_area"></span></td>
										<td class="text-center"><span class="hpl_total_balance_pending_area"></span></td>
									</tr>
								</tbody>
							</table>
						  <table class='table'>
						    <tr>
							  <td><b>Leave</b></td>
							  <td>
							    <input type="radio" name="leave" value='1' required="" id="newApproved" checked="" onchange="approveDisapprove(1)"> 
							    <label for="newApproved">Approved</label> &nbsp;&nbsp;
							    <input type="radio" name="leave" value='2' required="" id="newDisapproved" onchange="approveDisapprove(2)"> 
							    <label for="newDisapproved">Disapproved</label>
							  </td>
						    </tr>
						    <tr>
							  <td><b>Applied Date From - To</b></td>
							  <td><input type="text" class='form-control' name='date_from_to' id='date_from_to' readonly></td>
							</tr>
							<tr>
							  <td><b>Applied Total Days</b></td>
							  <td><input type="text" class='form-control' name='tot_days' id='tot_days' readonly></td>
							</tr>
							<tr>
							  <td><b>Remarks</b></td>
							  <td><textarea name='remarks' id="remarks" class='form-control'></textarea></td>
							</tr>
							<input type="hidden" id="updid" name="emp_leave_attendance_id">
							<input type="hidden" id="login_id" name="employee_id">
						  </table>
						  <table class="table table-bordered">
						  	<tr>
							  <td><b>CL</b></td>
							  <td><input type="number" class='form-control' name='cl_total' id='cl_total' min="0" value="0" autocomplete="off" onchange="activeCLDate()" onblur="checkFieldEmpty('cl_total','cl_from_date','cl_to_date')"></td>
							  <td><input type="text" class='form-control datepicker' name='cl_from_date' id='cl_from_date' autocomplete="off" disabled="" required="required" onchange="setToDate('cl_total','cl_from_date','cl_to_date')"></td>

							  <td><input type="text" class='form-control' name='cl_to_date' id='cl_to_date' autocomplete="off" disabled="" readonly=""></td>
							</tr>
							<tr>
							  <td><b>EL</b></td>
							  <td><input type="number" class='form-control' name='el_total' id='el_total' min="0" value="0" autocomplete="off" onchange="activeELDate()" onblur="checkFieldEmpty('el_total','el_from_date','el_to_date')"></td>
							  <td><input type="text" class='form-control datepicker' name='el_from_date' id='el_from_date' autocomplete="off" disabled="" required="" onchange="setToDate('el_total','el_from_date','el_to_date')"></td>
							  <td><input type="text" class='form-control' name='el_to_date' id='el_to_date' autocomplete="off" disabled="" readonly=""></td>
							</tr>
							<tr>
							  <td><b>ML</b></td>
							  <td><input type="number" class='form-control' name='ml_total' id='ml_total' min="0" value="0" autocomplete="off" onchange="activeMLDate()" onblur="checkFieldEmpty('ml_total','ml_from_date','ml_to_date')"></td>
							  <td><input type="text" class='form-control datepicker' name='ml_from_date' id='ml_from_date' autocomplete="off" disabled="" required="" onchange="setToDate('ml_total','ml_from_date','ml_to_date')"></td>
							  <td><input type="text" class='form-control' name='ml_to_date' id='ml_to_date' autocomplete="off" disabled="" readonly=""></td>
							</tr>

							<tr>
							  <td><b>HPL</b></td>
							  <td><input type="number" class='form-control' name='hpl_total' id='hpl_total' min="0" value="0" autocomplete="off" onchange="activeHPLDate()"  onblur="checkFieldEmpty('hpl_total','hpl_from_date','hpl_to_date')"></td>
							  <td><input type="text" class='form-control datepicker' name='hpl_from_date' id='hpl_from_date' autocomplete="off" disabled="" required="" onchange="setToDate('hpl_total','hpl_from_date','hpl_to_date')"></td>
							  <td><input type="text" class='form-control' name='hpl_to_date' id='hpl_to_date' autocomplete="off" disabled="" readonly=""></td>
							</tr>


							<tr>
							  <td><b>LWP</b></td>
							  <td><input type="number" class='form-control' name='lwp_total' id='lwp_total' min="0" value="0" autocomplete="off" onchange="activeLWPDate()" onblur="checkFieldEmpty('lwp_total','lwp_from_date','lwp_to_date')"></td>
							  <td><input type="text" class='form-control datepicker' name='lwp_from_date' id='lwp_from_date' autocomplete="off" disabled="" required="" onchange="setToDate('lwp_total','lwp_from_date','lwp_to_date')"></td>
							  <td><input type="text" class='form-control' name='lwp_to_date' id='lwp_to_date' autocomplete="off" disabled="" readonly=""></td>
							</tr>
							<tr>
							  <td><b>DDL</b></td>
							  <td><input type="number" class='form-control' name='ddl_total' id='ddl_total' min="0" value="0" autocomplete="off" onchange="activeDDLDate()" onblur="checkFieldEmpty('ddl_total','ddl_from_date','ddl_to_date')"></td>
							  <td><input type="text" class='form-control datepicker' name='ddl_from_date' id='ddl_from_date' autocomplete="off" disabled="" required="" onchange="setToDate('ddl_total','ddl_from_date','ddl_to_date')"></td>
							  <td><input type="text" class='form-control' name='ddl_to_date' id='ddl_to_date' autocomplete="off" disabled="" readonly=""></td>
							</tr>
							<tr>
							  <td colspan="2"><b>AGAINST DATE<br> (Only For DDL)</b></td>
							  <td><input type="text" class='form-control datepicker2' name='against_date_from' id='against_date_from' autocomplete="off" required="" disabled="" ></td>
							  <td>
							  	<!-- <input type="text" class='form-control datepicker' name='against_date_to' id='against_date_to' autocomplete="off" required="" disabled="" > -->
							  </td>
							</tr>
						  </table>
						</div>
						<div class="modal-footer">
						  <button type="button" id="check_validation_btn" class="btn btn-success btn-sm" onclick="checkDaysValidation()"><i class="fa fa-check-square-o"></i> Check Validation</button>
						  <button type="submit" id="save_btn" class="btn btn-success btn-sm" style="display: none;"><i class="fa fa-save"></i> SAVE</button>
						  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
						</div>
					  </div>
					</form>
					</div>
				  </div>
			  <!-------end approval modal--------->
			<!-----end pending------> 
			
			<!-----approved------>
			<div id="approved" class="tab-pane fade table-responsive"><br />
			<table class='table dataTable'>
             <thead>			
			  <tr>
			    <th style="background: #337ab7 !important; color: white !important;">Emp Id</th>
				<th style="background: #337ab7 !important; color: white !important;">Emp Name</th>
				<th style="background: #337ab7 !important; color: white !important;">Designation</th>
				<th style="background: #337ab7 !important; color: white !important;">Apply Date</th>
				<th style="background: #337ab7 !important; color: white !important;">Leave Type</th>
				<th style="background: #337ab7 !important; color: white !important;">From Date</th>
				<th style="background: #337ab7 !important; color: white !important;">To Date </th>
				<th style="background: #337ab7 !important; color: white !important;">Against Date</th>
				<th style="background: #337ab7 !important; color: white !important;">total Days</th>
				<th style="background: #337ab7 !important; color: white !important;">Reason</th>
				<th style="background: #337ab7 !important; color: white !important;">Reason Details</th>
				<th style="background: #337ab7 !important; color: white !important;">Approved By</th>
				<th style="background: #337ab7 !important; color: white !important;">Action</th>
			  </tr>
			 </thead>
             <tbody>
              <?php
			    if(isset($empApporoved)){
					foreach($empApporoved as $data){
						if($role_id == 5 || $role_id == 6){//for wing
						  if($log_wing_id == $data->wing_id){
						?>
						 <tr>
							<td><?php echo $data->EMPLOYEE_ID; ?></td>
							<td><?php echo $data->empnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->APPLY_DATE)); ?></td>
							<td><?php 
							if($data->LEAVE_TYPE != '')
							{
								echo $leaveTypeList[$data->LEAVE_TYPE]; 
							}	?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
							<td><?php 
							if($data->AGAINST_DATE_FROM != '')
							{
								echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)); 
							}	?></td>
							<td><?php echo ($data->TOTAL_DAYS)*1; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><?php echo $data->REASON_DETAILS; ?></td>
							<td><?php echo $data->ADMIN_ID ." <span style='color:blue; font-weight:bold;'>(". $data->rolenm .")</span>" ?></td>
							<?php
							  if($role_id == 6){
								if($data->roleid == 6 && $data->UPDATE_LOCK == 0){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php								
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}  
							  }elseif($role_id == 5){
								if($data->roleid == 6 || $data->roleid == 5 && $data->UPDATE_LOCK == 0){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}   
							  }elseif($data->UPDATE_LOCK == 0){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
							  }
							?>
							<!--<td><button class='btn btn-danger btn-xs' onclick="leaveApporoved(<?php //echo $data->ID; ?>,'<?php //echo $data->EMPLOYEE_ID?>','<?php //echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>-->
						 </tr>
						<?php
						  }
						}else{
						  ?>
						  <tr>
							<td><?php echo $data->EMPLOYEE_ID; ?></td>
							<td><?php echo $data->empnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->APPLY_DATE)); ?></td>
							<td><?php 
							if($data->LEAVE_TYPE != '')
							{
								echo $leaveTypeList[$data->LEAVE_TYPE]; 
							}	?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
							<td><?php 
							if($data->AGAINST_DATE_FROM != '')
							{
								echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)); 
							}	?></td>
							<td><?php echo ($data->TOTAL_DAYS)*1; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><?php echo $data->REASON_DETAILS; ?></td>
							<td><?php echo $data->ADMIN_ID ." <span style='color:blue; font-weight:bold;'>(". $data->rolenm .")</span>" ?></td>
							<?php
							  if($role_id == 6 && $data->UPDATE_LOCK == 0){
								if($data->roleid == 6){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php								
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}  
							  }elseif($role_id == 5  && $data->UPDATE_LOCK == 0){
								if($data->roleid == 6 || $data->roleid == 5){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}   
							  }elseif($data->UPDATE_LOCK == 0){
								?>
								<td><button class='btn btn-success btn-xs' onclick="leaveApporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>
                                <?php	
							  }
							?>
							<!--<td><button class='btn btn-danger btn-xs' onclick="leaveApporoved(<?php //echo $data->ID; ?>,'<?php //echo $data->EMPLOYEE_ID?>','<?php //echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>-->
						 </tr>
						  <?php
						}
					}
				}
			  ?>			 
             </tbody>			 
			</table>
            
			 <!--------approval modal------------>
				  <div class="modal fade" id="leave_approved" role="dialog">
					<div class="modal-dialog">
						<form method="post" action="<?php echo base_url('leave/leaveapproval/leave_disapproval_sv_upd'); ?>">
						  <div class="modal-content">
							<div class="modal-header" style="background:#5785c3; color:#fff;">
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							  <h4 class="modal-title"><label id='lv_apro_emp_id'></label></h4>
							</div>
							<div class="modal-body">
							  <table class='table'>
							    <tr>
								  <td><b>Leave</b></td>
								  <td>
								    <input type="radio" name="leave" value='2' id="disapproveApproval"> 
								    <label for="disapproveApproval">Disapproved</label>
								  </td>
							    </tr>
								<tr>
								  <td><b>Remarks</b></td>
								  <td><textarea name='remarks' id="lv_apro_remarks" class='form-control'></textarea></td>
								</tr>
								<input type="hidden" id="lv_apro_updid" name="lv_apro_updid">
								<input type="hidden" id="lv_apro_login_id" name="lv_apro_login_id">
							  </table>
							</div>
							<div class="modal-footer">
							  <button type="submit" class="btn btn-success btn-sm">SAVE</button>
							  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
							</div>
						  </div>
						</form>
					</div>
				  </div>
			  <!-------end approval modal--------->
       			
			</div>
			<!-----end approved------>
			
			<!-------disapproved-------->
			<div id="disapproved" class="tab-pane fade table-responsive"><br />
			  <table class='table dataTable'>
             <thead>			
			  <tr>
			    <th style="background: #337ab7 !important; color: white !important;">Emp Id</th>
				<th style="background: #337ab7 !important; color: white !important;">Emp Name</th>
				<th style="background: #337ab7 !important; color: white !important;">Designation</th>
				<th style="background: #337ab7 !important; color: white !important;">Apply Date</th>
				<th style="background: #337ab7 !important; color: white !important;">Leave Type</th>
				<th style="background: #337ab7 !important; color: white !important;">From Date</th>
				<th style="background: #337ab7 !important; color: white !important;">To Date </th>
				<th style="background: #337ab7 !important; color: white !important;">Against Date </th>
				<th style="background: #337ab7 !important; color: white !important;">total Days</th>
				<th style="background: #337ab7 !important; color: white !important;">Reason</th>
				<th style="background: #337ab7 !important; color: white !important;">Reason Details</th>
				<th style="background: #337ab7 !important; color: white !important;">Disapproved By</th>
				<th style="background: #337ab7 !important; color: white !important;">Action</th>
			  </tr>
			 </thead>
             <tbody>
              <?php
			    if(isset($empDisapporoved)){
					foreach($empDisapporoved as $data){
						if($role_id == 5 || $role_id == 6){//for wing
						if($log_wing_id == $data->wing_id){
						?>
						 <tr>
							<td><?php echo $data->EMPLOYEE_ID; ?></td>
							<td><?php echo $data->empnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->APPLY_DATE)); ?></td>
							<td><?php 
							if($data->LEAVE_TYPE != '')
							{
								echo $leaveTypeList[$data->LEAVE_TYPE]; 
							}	?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
                            </td>
                            <td><?php 
							if($data->AGAINST_DATE_FROM != '')
							{
								echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)); 
							}	?></td>
							<td><?php echo ($data->TOTAL_DAYS)*1; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><?php echo $data->REASON_DETAILS; ?></td>
							<td><?php echo $data->ADMIN_ID ." <span style='color:blue; font-weight:bold;'>(". $data->rolenm .")</span>" ?></td>
							<?php
							  if($role_id == 6){
								if($data->roleid == 6){
								?>
								<td>
									<?php if($data->LEAVE_TYPE != ''){ ?>

										<button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } else{ ?>
										<button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>',<?php echo ($data->TOTAL_DAYS)*1; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } ?>
								</td>
                                <?php								
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}  
							  }elseif($role_id == 5){
								if($data->roleid == 6 || $data->roleid == 5){
								?>
								<td>
									<?php if($data->LEAVE_TYPE != ''){ ?>

										<button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } else{ ?>
										<button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>',<?php echo ($data->TOTAL_DAYS)*1; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } ?>
								</td>
                                <?php	
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}   
							  }else{
								?>
								<td>
									<?php if($data->LEAVE_TYPE != ''){ ?>

										<button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } else{ ?>
										<button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>',<?php echo ($data->TOTAL_DAYS)*1; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } ?>
								</td>
                                <?php	
							  }
							?>
							<!--<td><button class='btn btn-danger btn-xs' onclick="leaveDisapporoved(<?php //echo $data->ID; ?>,'<?php //echo $data->EMPLOYEE_ID?>','<?php //echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>-->
						 </tr>
						<?php
						}
						}else{
							?>
							<tr>
							<td><?php echo $data->EMPLOYEE_ID; ?></td>
							<td><?php echo $data->empnm; ?></td>
							<td><?php echo $data->designm; ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->APPLY_DATE)); ?></td>
							<td><?php 
							if($data->LEAVE_TYPE != '')
							{
								echo $leaveTypeList[$data->LEAVE_TYPE]; 
							}	?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_FROM)); ?></td>
							<td><?php echo date('d-M-Y',strtotime($data->DATE_TO)); ?></td>
							<td><?php 
							if($data->AGAINST_DATE_FROM != '')
							{
								echo date('d-M-Y',strtotime($data->AGAINST_DATE_FROM)); 
							}	?></td>
							<td><?php echo ($data->TOTAL_DAYS)*1; ?></td>
							<td><?php echo $leaveReasonList[$data->REASON]; ?></td>
							<td><?php echo $data->REASON_DETAILS; ?></td>
							<td><?php echo $data->ADMIN_ID ." <span style='color:blue; font-weight:bold;'>(". $data->rolenm .")</span>" ?></td>
							<?php
							  if($role_id == 6){
								if($data->roleid == 6){
								?>
								<td>
									<?php if($data->LEAVE_TYPE != ''){ ?>

										<button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } else{ ?>
										<button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>',<?php echo ($data->TOTAL_DAYS)*1; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } ?>
								</td>
                                <?php								
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}  
							  }elseif($role_id == 5){
								if($data->roleid == 6 || $data->roleid == 5){
								?>
								<td>
									<?php if($data->LEAVE_TYPE != ''){ ?>

										<button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } else{ ?>
										<button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>',<?php echo ($data->TOTAL_DAYS)*1; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } ?>
								</td>
                                <?php	
								}else{
								?>
								<td><button class='btn btn-danger btn-xs' onclick="alert('You are not Authorized for changing Action')"><i class="fa fa-bars" style='color:#fff;'></i> X</button></td>
                                <?php	
								}   
							  }else{
								?>
								<td>
									<?php if($data->LEAVE_TYPE != ''){ ?>

										<button class='btn btn-success btn-xs' onclick="leaveDisapporoved(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID?>','<?php echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } else{ ?>
										<button class='btn btn-success btn-xs' onclick="leave(<?php echo $data->ID; ?>,'<?php echo $data->EMPLOYEE_ID; ?>','<?php echo $log_id; ?>',<?php echo ($data->TOTAL_DAYS)*1; ?>)"><i class="fa fa-bars" style='color:#fff;'></i> Action</button>
									<?php } ?>
								</td>
                                <?php	
							  }
							?>
							<!--<td><button class='btn btn-danger btn-xs' onclick="leaveDisapporoved(<?php //echo $data->ID; ?>,'<?php //echo $data->EMPLOYEE_ID?>','<?php //echo $log_id; ?>')"><i class="fa fa-bars" style='color:#fff;'></i> Action</button></td>-->
						 </tr>
							<?php
						}
					}
				}
			  ?>			 
             </tbody>			 
			</table>
            
			 <!--------approval modal------------>
				  <div class="modal fade" id="leave_disapproved" role="dialog">
					<div class="modal-dialog">
					  <div class="modal-content">
						<div class="modal-header" style="background:#5785c3; color:#fff;">
						  <button type="button" class="close" data-dismiss="modal">&times;</button>
						  <h4 class="modal-title"><label id='lv_disapro_emp_id'></label></h4>
						</div>
						<div class="modal-body">
						  <table class='table'>
						    <tr>
							  <td><b>Leave</b></td>
							  <td>
							    <input type="radio" name="leave" value='1' id="approvedLeave"> 
							    <label for="approvedLeave">Approved</label>
							  </td>
						    </tr>
							<tr>
							  <td><b>Remarks</b></td>
							  <td><textarea name='remarks' id="lv_disapro_remarks" class='form-control'></textarea></td>
							</tr>
							<input type="hidden" id="lv_disapro_updid">
							<input type="hidden" id="lv_disapro_login_id">
						  </table>
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-success btn-sm" onclick="leave_disapprove_save()">SAVE</button>
						  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
						</div>
					  </div>
					</div>
				  </div>
			  <!-------end approval modal--------->
			</div>
			<!-------end disapproved-------->
		  </div>
    </div>
  </div>
</div>
<br><br>


<!-- /.modal -->
<div class="loader"></div>
<script type="text/javascript">
   $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      aaSorting: [[0, 'asc']]
    })
  });

   var appliedEndDate = '';
  
  function leave(ID,emp_id,login_id,tot_days){

  	$.ajax({
  		url:'<?php echo base_url('leave/leaveapproval/getTotalLeaveBalance'); ?>',
  		method:"post",
  		data:{emp_id:emp_id,id:ID},
  		dataType:"json",
  		success:function(response)
  		{
  			var total_cl_balance = Number(response.employeeDetails.CAS_LEAVE)-Number(response.cas_leave_balance.leave_bal);
  			var total_el_balance = Number(response.employeeDetails.ML)-Number(response.el_balance.leave_bal);
  			var total_ml_balance = Number(response.employeeDetails.EL)-Number(response.ml_balance.leave_bal);
  			var total_hpl_balance = Number(response.employeeDetails.hpl)-Number(response.hpl_balance.leave_bal);

  			$('.cl_total_balance_pending_area').text(total_cl_balance);
  			$('.ml_total_balance_pending_area').text(total_ml_balance);
  			$('.el_total_balance_pending_area').text(total_el_balance);
  			$('.hpl_total_balance_pending_area').text(total_hpl_balance);

  			$('#cl_total').attr('max',total_cl_balance);
  			$('#el_total').attr('max',total_el_balance);
  			$('#ml_total').attr('max',total_ml_balance);
  			$('#hpl_total').attr('max',total_hpl_balance);

  			$('.datepicker').datepicker({
		      format: "dd-M-yyyy",
		      autoclose: true,
		     	startDate : new Date(response.from_date),
    			endDate : new Date(response.to_date),
		    });
  			appliedEndDate = response.to_date;
  			$("#emp_id").text(response.employeeDetails.EMP_F_NAME+' '+response.employeeDetails.EMP_M_NAME+' '+response.employeeDetails.EMP_L_NAME+' ('+emp_id+')');
			$("#updid").val(ID);
			$("#login_id").val(login_id);
			$("#tot_days").val(tot_days);
			$("#date_from_to").val(response.applied_date);
			$("#myModal").modal({
				keyboard:false,
				backdrop:"static"
			});
  		}
  	});
	 
  }
  
  $('.datepicker2').datepicker({
      format: "dd-M-yyyy",
      autoclose: true,
    });

  
  function leaveApporoved(id,emp_id,login_id){
  	$.ajax({
	  	url:'<?php echo base_url('leave/leaveapproval/getEmployeeDetails'); ?>',
	  	data:{emp_id:emp_id},
	  	method:"post",
	  	dataType:"json",
	  	success:function(response)
	  	{
	  		$("#lv_apro_updid").val(id);
			$("#lv_apro_emp_id").text(response.EMP_FNAME+' '+response.EMP_MNAME+' '+response.EMP_LNAME+' ('+emp_id+')');
			$("#lv_apro_login_id").val(login_id);
			$("#leave_approved").modal('show');
	  	}
	  }); 
	  
  }
  
  
  function leaveDisapporoved(id,emp_id,login_id){
	  $.ajax({
	  	url:'<?php echo base_url('leave/leaveapproval/getEmployeeDetails'); ?>',
	  	data:{emp_id:emp_id},
	  	method:"post",
	  	dataType:"json",
	  	success:function(response)
	  	{
	  		$("#lv_disapro_updid").val(id);
			$("#lv_disapro_emp_id").text(response.EMP_FNAME+' '+response.EMP_MNAME+' '+response.EMP_LNAME+' ('+emp_id+')');
			$("#lv_disapro_login_id").val(login_id);
			$("#leave_disapproved").modal('show'); 
	  	}
	  }); 
  }
  
  function leave_disapprove_save(){
	  var lv_disapro_updid = $("#lv_disapro_updid").val();
	  var lv_disapro_login_id = $("#lv_disapro_login_id").val();
	  var leave = $("input[name='leave']:checked").val();
	  var lv_disapro_remarks = $("#lv_disapro_remarks").val();
	  
	  if(leave != undefined){	
		$.post("<?php echo base_url('leave/Leaveapproval/leave_reapproval_sv_upd'); ?>",{lv_disapro_updid:lv_disapro_updid,lv_disapro_login_id:lv_disapro_login_id,leave:leave,lv_disapro_remarks:lv_disapro_remarks},function(data){
			$("#leave_disapproved").modal('hide');
			$("input[name='leave']:checked").prop('checked',false);
			$("#lv_disapro_remarks").val('');
			alert('Leave Update');
			location.reload();
		});
		}else{
			alert('Leave Check First');
		} 
  }
  
  function date_srch(){
	var from_date = $("#from_date").val();  
	var to_date   = $("#to_date").val(); 
  
    $.ajax({
		url: "<?php echo base_url('leave/Leaveapproval/pendingleave_datewise'); ?>",
		type: "POST",
		data: {from_date:from_date,to_date:to_date},
		success: function(data){
			alert(data);
		}
	});  
  }

  $(document).ready(function () {
    $('#newApprovalForm').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

  function activeCLDate()
  {
  	var clapproved = $('#cl_total').val();
  	if(clapproved > 0)
  	{
  		$('#cl_from_date').removeAttr('disabled');
  		$('#cl_to_date').removeAttr('disabled');
  	}
  	else
  	{
  		$('#cl_from_date').attr('disabled','');
  		$('#cl_to_date').attr('disabled','');
  	}
  	$('#save_btn').hide();
  	$("#check_validation_btn").show(); 
  }

  function activeMLDate()
  {
  	var mlapproved = $('#ml_total').val();
  	if(mlapproved > 0)
  	{
  		$('#ml_from_date').removeAttr('disabled');
  		$('#ml_to_date').removeAttr('disabled');
  	}
  	else
  	{
  		$('#ml_from_date').attr('disabled','');
  		$('#ml_to_date').attr('disabled','');
  	}
  	$('#save_btn').hide();
  	$("#check_validation_btn").show();
  }

  function activeELDate()
  {
  	var elapproved = $('#el_total').val();
  	if(elapproved > 0)
  	{
  		$('#el_from_date').removeAttr('disabled');
  		$('#el_to_date').removeAttr('disabled');
  	}
  	else
  	{
  		$('#el_from_date').attr('disabled','');
  		$('#el_to_date').attr('disabled','');
  	}
  	$('#save_btn').hide();
  	$("#check_validation_btn").show();
  }

  function activeHPLDate()
  {
  	var hplapproved = $('#hpl_total').val();
  	if(hplapproved > 0)
  	{
  		$('#hpl_from_date').removeAttr('disabled');
  		$('#hpl_to_date').removeAttr('disabled');
  	}
  	else
  	{
  		$('#hpl_from_date').attr('disabled','');
  		$('#hpl_to_date').attr('disabled','');
  	}
  	$('#save_btn').hide();
  	$("#check_validation_btn").show();
  }

  function activeLWPDate()
  {
  	var lwpapproved = $('#lwp_total').val();
  	if(lwpapproved > 0)
  	{
  		$('#lwp_from_date').removeAttr('disabled');
  		$('#lwp_to_date').removeAttr('disabled');
  	}
  	else
  	{
  		$('#lwp_from_date').attr('disabled','');
  		$('#lwp_to_date').attr('disabled','');
  	}
  	$('#save_btn').hide();
  	$("#check_validation_btn").show();
  }

  function activeDDLDate()
  {
  	var ddlapproved = $('#ddl_total').val();
  	if(ddlapproved > 0)
  	{
  		$('#ddl_from_date').removeAttr('disabled');
  		$('#ddl_to_date').removeAttr('disabled');
  		$('#against_date_from').removeAttr('disabled');
  		// $('#against_date_to').removeAttr('disabled');
  	}
  	else
  	{
  		$('#ddl_from_date').attr('disabled','');
  		$('#ddl_to_date').attr('disabled','');
  		$('#against_date_from').attr('disabled','');
  		// $('#against_date_to').attr('disabled','');
  		$('#against_date_from').val('');
  		// $('#against_date_to').val('');
  	}
  	$('#save_btn').hide();
  	$("#check_validation_btn").show();
  }

  function approveDisapprove(status)
  {
  	if(status==2)
  	{
  		$('#cl_total').val('0');
  		$('#cl_total').attr('readonly','readonly');
  		$('#ml_total').val('0');
  		$('#ml_total').attr('readonly','readonly');
  		$('#el_total').val('0');
  		$('#el_total').attr('readonly','readonly');
  		$('#hpl_total').val('0');
  		$('#hpl_total').attr('readonly','readonly');
  		$('#ddl_total').val('0');
  		$('#ddl_total').attr('readonly','readonly');
  		$('#lwp_total').val('0');
  		$('#lwp_total').attr('readonly','readonly');
  		$("#save_btn").show(); 
      	$("#check_validation_btn").hide(); 
  	}
  	else
  	{
  		$("#save_btn").hide(); 
      	$("#check_validation_btn").show(); 
  		$('#cl_total').val('0');
  		$('#cl_total').removeAttr('readonly');
  		$('#ml_total').val('0');
  		$('#ml_total').removeAttr('readonly');
  		$('#el_total').val('0');
  		$('#el_total').removeAttr('readonly');
  		$('#hpl_total').val('0');
  		$('#hpl_total').removeAttr('readonly');
  		$('#ddl_total').val('0');
  		$('#ddl_total').removeAttr('readonly');
  		$('#lwp_total').val('0');
  		$('#lwp_total').removeAttr('readonly');
  	}
  	activeCLDate();
	activeMLDate();
	activeELDate();
	activeHPLDate();
	activeDDLDate();
	activeLWPDate();
  }

  	function checkFieldEmpty(leave_type_id,from_date,to_date)
	{
	  	var leave_days = $('#'+leave_type_id).val();
		$('#'+from_date).val('');
		$('#'+to_date).val('');
		if(leave_days > 0)
		{
			$('#'+from_date).removeAttr('disabled');
			$('#'+to_date).removeAttr('disabled');
		}
		else
		{
			$('#'+leave_type_id).val(0);
			$('#'+from_date).attr('disabled','');
			$('#'+to_date).attr('disabled','');
		}
	}

   // $('.datepicker').datepicker({
   //    format: "dd-M-yyyy",
   //    autoclose: true
   //  });

   function setToDate(leave_type_id,from_date,to_date)
   {
      var toDateStartDate = $('#'+from_date).val();
      total_days = Math.round(Number($('#'+leave_type_id).val()));

      total_days = total_days - 1;

      Date.prototype.addDays = function(days) {
          var date = new Date(toDateStartDate);
          date.setDate(date.getDate() + days);
          return date;
      }

      var date = new Date(toDateStartDate);
      endDate = date.addDays(total_days);

      const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
          "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];

      endDate =  endDate.getDate()+ "-" + monthNames[(endDate.getMonth())] +"-"+endDate.getFullYear() ;
      $('#'+to_date).val(endDate);

      $.ajax({
      	url:"<?php echo base_url('leave/applyleave/checkEndDateisValid'); ?>",
      	data:{endDate:endDate,appliedEndDate:appliedEndDate},
      	method:"post",
      	dataType:"json",
      	success:function(response)
      	{
      		if(response==2)
      		{
      			$('#'+from_date).val('');
      			$('#'+to_date).val('');
      			swal("End date is greater than applied end date!",'', "error");
      		}
      	}
      });
      $('#save_btn').hide();
  	  $("#check_validation_btn").show();

   }


   function checkDaysValidation()
	{
	  var total_applied_days = Number($('#tot_days').val());
	  var cl_approved_days = Number($('#cl_total').val());
	  var ml_approved_days = Number($('#ml_total').val());
	  var el_approved_days = Number($('#el_total').val());
	  var hpl_approved_days = Number($('#hpl_total').val());
	  var lwp_approved_days = Number($('#lwp_total').val());
	  var ddl_approved_days = Number($('#ddl_total').val());

	  var total_approve_days = cl_approved_days + ml_approved_days + el_approved_days + hpl_approved_days + lwp_approved_days + ddl_approved_days; 

	  $('#newApprovalForm').validate();
	  if($('#newApprovalForm').valid())
	  {
	      if(total_approve_days>total_applied_days)
	      {
	        swal("Entered Days are greater than applied days!",'', "error");
	      }
	      else if(total_approve_days > 0)
	      {
	        swal("Now, You are able to approve leave.",'', "success");
	        $("#save_btn").show(); 
	        $("#check_validation_btn").hide(); 
	      }
	      else
	      {
	      	swal("Please enter approval days",'', "warning");
	      }
	  }
	}

	$('#myModal').on('hidden.bs.modal', function () {
	 location.reload();
	});

	$(document).ready(function() {
	  $(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
	  });
	});
</script>