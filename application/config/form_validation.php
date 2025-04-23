<?php 

$config = [

	'create_designation_rules' => [
							[
								'field'		=>	'designation',
								'label'		=>	'Designation',
								'rules'		=>	'required|trim|is_unique[desig.DESIG]'
							],
							[
								'field'		=>	'print_position',
								'label'		=>	'Print Position',
								'rules'		=>	'required|trim|is_unique[desig.print_position]|numeric|xss_clean'
							],
						],
	'create_leavetype_rules' => [
							[
								'field'		=>	'name',
								'label'		=>	'Name',
								'rules'		=>	'required|xss_clean'
							],
							[
								'field'		=>	'applicable_for',
								'label'		=>	'Applicable For',
								'rules'		=>	'required|trim|xss_clean'
							],
							[
								'field'		=>	'no_of_days',
								'label'		=>	'No of Days',
								'rules'		=>	'required|trim|numeric|xss_clean'
							],
						],

	'create_pfesi_rules' => [
							[
								'field'		=>	'effective_date',
								'label'		=>	'Effective Date',
								'rules'		=>	'required|trim|xss_clean'
							],
							[
								'field'		=>	'employee_pf_rate',
								'label'		=>	'Employee PF Rate',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'employer_pf_rate',
								'label'		=>	'Employer PF Rate',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'esi_limit',
								'label'		=>	'ESI Limit',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'pension_rate',
								'label'		=>	'Pension Rate',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'pay_limit',
								'label'		=>	'Pay Limit',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'esi_own_rate',
								'label'		=>	'ESI Own Rate',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'esi_emp_rate',
								'label'		=>	'ESI EMP Rate',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'da_rate',
								'label'		=>	'DA Rate',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'ta_rate_slab1',
								'label'		=>	'TA Rate Slab1',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'ta_rate_slab2',
								'label'		=>	'TA Rate Slab2',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'ta_rate_slab3',
								'label'		=>	'TA Rate Slab3',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'spcial_allowance',
								'label'		=>	'Special Allowance',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'fpf',
								'label'		=>	'FPF',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'vpf',
								'label'		=>	'VPF',
								'rules'		=>	'trim|numeric|xss_clean'
							],
							[
								'field'		=>	'staff_welfare_fund',
								'label'		=>	'Staff Welfare Fund',
								'rules'		=>	'trim|numeric|xss_clean'
							],
						],
];