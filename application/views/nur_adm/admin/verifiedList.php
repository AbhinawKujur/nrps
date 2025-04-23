<style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
	white-space: nowrap !important;
	}
</style>

<div class="content-wrapper">
<section class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-sm-6">
		<h1>Verified List</h1>
	  </div>
	  <div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="#">Home</a></li>
		  <li class="breadcrumb-item active">Verified List</li>
		</ol>
	  </div>
	</div>
  </div>
</section>

<section class="content">
  <div class="row">
	<div class="col-12">
	  <div class="card">
		<div class="card-body table-responsive">
		  <table id="example1" class="table table-bordered table-striped">
			<thead>
			<tr>
			  <th>Registration No.</th>
			  <th>Name</th>
			  <th>DOB</th>
			  <th>Physically Challenged</th>
			  <th>Gender</th>
			  <th>Category</th>
			  <th>Aadhaar No.</th>
			  <th>Mother Tongue</th>
			  <th>Religion</th>
			  <th>Blood Group</th>
			  <th>Father's Name</th>
			  <th>Qualification</th>
			  <th>Occupation</th>
			  <th>Father Government Job</th>
			  <th>Father Job Transferable</th>
			  <th>Father Alumini</th>
			  <th>Father Year Leaving</th>
			  <th>Father Reg No.</th>
			  <th>Mother's Name</th>
			  <th>Qualification</th>
			  <th>Occupation</th>
			  <th>Mother Government Job</th>
			  <th>Mother Job Transferable</th>
			  <th>Mother Alumini</th>
			  <th>Mother Year Leaving</th>
			  <th>Mother Reg No.</th>
			  <th>No. of Sons</th>
			  <th>No. of Daughters</th>
			  <th>Single Parent</th>
			  <th>Single Parent(Father/Mother)</th>
			  <th>Grand Parent</th>
			  <th>1 Sibling Registration</th>
			  <th>2 Sibling Registration</th>
			  <th>Residential Address</th>
			  <th>PIN Code</th>
			  <th>Mobile</th>
			  <th>Distance KM</th>
			  <th>Permanent Address</th>
			  <th>PIN Code</th>
			  <th>Mobile</th>
			  <th>Amount</th>
			  <th>Transaction Id</th>
			  <th>Payment time</th>
			</tr>
			</thead>
			<tbody>
				<?php
					foreach($verifiedData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['id'].'/2020'; ?></td>
								<td><?php echo $val['stu_nm']; ?></td>
								<td><?php echo $val['dob']; ?></td>
								<td><?php echo $val['phy_challenged']; ?></td>
								<td><?php echo ($val['gender']==1)?'Male':'Female' ?></td>
								<td><?php echo $val['catnm']; ?></td>
								<td><?php echo $val['aadhaar_no']; ?></td>
								<td><?php echo $motherTounge[$val['mother_tounge']]; ?></td>
								<td><?php echo $val['religionnm']; ?></td>
								<td><?php echo $bloodGroup[$val['blood_group']]; ?></td>
								<td><?php echo $val['f_name']; ?></td>
								<td><?php echo $parent_qualification[$val['f_qualification']]; ?></td>
								<td><?php echo $parent_accupation[$val['f_accupation']]; ?></td>
								<td><?php echo $val['f_gov_job']; ?></td>
								<td><?php echo $val['f_jbo_transferable']; ?></td>
								<td><?php echo $val['f_alumini']; ?></td>
								<td><?php echo $val['f_year_leaving']; ?></td>
								<td><?php echo $val['f_reg_no']; ?></td>
								<td><?php echo $val['m_name']; ?></td>
								<td><?php echo $parent_qualification[$val['m_qualification']]; ?></td>
								<td><?php echo $parent_accupation[$val['m_accupation']]; ?></td>
								<td><?php echo $val['m_gov_job']; ?></td>
								<td><?php echo $val['m_jbo_transferable']; ?></td>
								<td><?php echo $val['m_alumini']; ?></td>
								<td><?php echo $val['m_year_leaving']; ?></td>
								<td><?php echo $val['m_reg_no']; ?></td>
								<td><?php echo $val['no_of_son']; ?></td>
								<td><?php echo $val['no_of_daughters']; ?></td>
								<td><?php echo $val['single_parent']; ?></td>
								<td><?php echo $val['father_or_mother']; ?></td>
								<td><?php echo $grand_parent[$val['grand_parent']]; ?></td>
								<td><?php echo $val['registration_0']; ?></td>
								<td><?php echo $val['registration_1']; ?></td>
								<td><?php echo $val['residentail_add']; ?></td>
								<td><?php echo $val['pin_code']; ?></td>
								<td><?php echo $val['mobile']; ?></td>
								<td><?php echo $val['distance']; ?></td>
								<td><?php echo $val['p_residentail_add']; ?></td>
								<td><?php echo $val['p_pin_code']; ?></td>
								<td><?php echo $val['p_mobile']; ?></td>
								<td><?php echo $val['amt']; ?></td>
								<td><?php echo $val['transaction_id']; ?></td>
								<td><?php echo $val['response_received_time']; ?></td>
							</tr>
						<?php
					}
				?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
  
  <div class='row'>
	<div class="col-12">
	  <div class="card">
		<div class="card-body table-responsive">
		  <table id="example2" class="table table-bordered table-striped">
			<thead>
			<tr>
			  <th>APPLN_NO</th>
			  <th>DT</th>
			  <th>STUDENT_NAME</th>
			  <th>DATE_OF_BITRH</th>
			  <th>SEX</th>
			  <th>PHY_CHALLGD</th>
			  <th>CATEGORY</th>
			  <th>FATR_NAME</th>
			  <th>FATR_QUALFN</th>
			  <th>FATR_ALUMINI</th>
			  <th>FATR_YR_OF_LEAVN</th>
			  <th>FATR_REGTN_NO</th>
			  <th>FATR_OCCUPN</th>
			  <th>FATR_GOVT_OFFCL</th>
			  <th>FATR_JOB_TRANFBL</th>
			  <th>MOTR_NAME</th>
			  <th>MOTR_QUALFN</th>
			  <th>MOTR_ALUMINI</th>
			  <th>MOTR_YR_OF_LEAVN</th>
			  <th>MOTR_REGTN_NO</th>
			  <th>MOTR_OCCUPN</th>
			  <th>MOTR_GOVT_OFFCL</th>
			  <th>MOTR_JOB_TRANFBL</th>
			  <th>SIBL_STDYN_DAV</th>
			  <th>SIBL_CLASS_SEC</th>
			  <th>SIBL_REGTN_NO</th>
			  <th>RESIDNL_ADD_RAN</th>
			  <th>PIN_CODE</th>
			  <th>DIST_OF_RESI_FRM_SCH_KM</th>
			  <th>PHONE_RESI</th>
			  <th>PHONE_OFF</th>
			  <th>PHONE_MOB</th>
			  <th>EMAIL_ID</th>
			  <th>SINGLE_PAR</th>
			  <th>FATR_OR_MOTR</th>
			  <th>DISADV_GR</th>
			  <th>FIN_YR</th>
			  <th>SUP_CHK</th>
			  <th>REGTN_NO</th>
			  <th>ADM_CHK</th>
			  <th>GRAND_CHILD</th>
			  <th>GRANDPARENT_ORGN</th>
			  <th>AADHAAR</th>
			  <th>NATIONALITY</th>
			  <th>MOTHER_TONGUE</th>
			  <th>RELIGION</th>
			  <th>BLOOD_GROUP</th>
			  <th>NO_SONS</th>
			  <th>NO_DAUGHTHERS</th>
			</tr>
			</thead>
			<tbody>
				<?php
					foreach($verifiedData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['id'].'/2020'; ?></td>
								<td><?php echo date('Y-m-d',strtotime($val['created_at'])); ?></td>
								<td><?php echo $val['stu_nm']; ?></td>
								<td><?php echo $val['dob']; ?></td>
								<td><?php echo ($val['gender']==1)?'M':'F' ?></td>
								<td><?php echo ($val['phy_challenged']=='YES')?'Y':'N'; ?></td>
								<td><?php echo $val['catnm']; ?></td>
								<td><?php echo $val['f_name']; ?></td>
								<td><?php echo $parent_qualification[$val['f_qualification']]; ?></td>
								<td><?php echo ($val['f_alumini'] == 'YES')?'Y':'N'; ?></td>
								<td><?php echo $val['f_year_leaving']; ?></td>
								<td><?php echo $val['f_reg_no']; ?></td>
								<td><?php echo $parent_accupation[$val['f_accupation']]; ?></td>
								<td><?php echo ($val['f_gov_job'] == 'YES')?'Y':'N'; ?></td>
								<td><?php echo ($val['f_jbo_transferable']=='YES')?'Y':'N'; ?></td>
								<td><?php echo $val['m_name']; ?></td>
								<td><?php echo $parent_qualification[$val['m_qualification']]; ?></td>
								<td><?php echo ($val['m_alumini'] == 'YES')?'Y':'N'; ?></td>
								<td><?php echo $val['m_year_leaving']; ?></td>
								<td><?php echo $val['m_reg_no']; ?></td>
								<td><?php echo $parent_accupation[$val['m_accupation']]; ?></td>
								<td><?php echo ($val['m_gov_job'] == 'YES')?'Y':'N'; ?></td>
								<td><?php echo ($val['m_jbo_transferable'] == 'YES')?'Y':'N'; ?></td>
								<td>
									<?php
										$add = $val['no_of_son'] + $val['no_of_daughters'];
										if($add > 0){
											echo "Y";
										}else{
											echo "N";
										}
									?>
								</td>
								<td><?php echo $val['classnm_0']."/".$val['secnm_0']; ?></td>
								<td><?php echo $val['registration_0']; ?></td>
								<td><?php echo $val['residentail_add']; ?></td>
								<td><?php echo $val['p_pin_code']; ?></td>
								<td><?php echo $val['distance']; ?></td>
								<td><?php echo $val['p_mobile']; ?></td>
								<td><?php echo $val['phone_ofc']; ?></td>
								<td><?php echo $val['mobile']; ?></td>
								<td><?php echo $val['email']; ?></td>
								<td><?php echo ($val['single_parent'] == 'YES')?'Y':'N'; ?></td>
								<td><?php echo $val['father_or_mother']; ?></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<?php 
										if($grand_parent[$val['grand_parent']] != 4){
											echo "Y";
										}else{
											echo "N";
										}
									?>
								</td>
								<td><?php echo $grand_parent[$val['grand_parent']]; ?></td>
								<td><?php echo $val['aadhaar_no']; ?></td>
								<td>INDIAN</td>
								<td><?php echo $motherTounge[$val['mother_tounge']]; ?></td>
								<td><?php echo $val['religionnm']; ?></td>
								<td><?php echo $bloodGroup[$val['blood_group']]; ?></td>
								<td><?php echo $val['no_of_son']; ?></td>
								<td><?php echo $val['no_of_daughters']; ?></td>
							</tr>
						<?php
					}
				?>
			</tbody>
		  </table>
		</div> 
	  </div> 
	</div> 
  </div> 
		
  </div>
</section>
</div>

<script>
    $(document).ready(function() {
		$('#example1').DataTable( {
			dom: 'Bfrtip',
			buttons: 
			[
				{
					extend: 'excel',
					text: 'EXCEL',
					title: 'Total Registered Students',
					className: 'btn btn-default',
				},
			]
		} );
		
		$('#example2').DataTable( {
			dom: 'Bfrtip',
			buttons: 
			[
				{
					extend: 'excel',
					text: 'EXCEL',
					title: 'Total Registered Students',
					className: 'btn btn-default',
				},
			]
		} );
	} );
	
	$("#verified_menu").addClass('active');
</script>