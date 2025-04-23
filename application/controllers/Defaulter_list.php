<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Defaulter_list extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Farheen', 'farheen');
	}



	public function defaulter_classwise_pre($clss = '')
	{
		// echo 'd';die;
		if (!empty($clss)) {
			$classs = $clss;
		} else {
			$classs = $this->input->post('classs');
		}
		if ($classs != 'All') {
			$stu = $this->db->query("select DISTINCT(previous_year_feegeneration.ADM_NO),previous_year_feegeneration.STU_NAME,previous_year_feegeneration.CLASS,previous_year_feegeneration.SEC,STUDENT.C_MOBILE from previous_year_feegeneration INNER JOIN STUDENT ON previous_year_feegeneration.ADM_NO=STUDENT.ADM_NO where previous_year_feegeneration.CLASS='$classs' ORDER BY previous_year_feegeneration.SEC")->result();
		} else {
			$stu = $this->db->query("select DISTINCT(previous_year_feegeneration.ADM_NO),previous_year_feegeneration.STU_NAME,previous_year_feegeneration.CLASS,previous_year_feegeneration.SEC,STUDENT.C_MOBILE from previous_year_feegeneration inner join student on previous_year_feegeneration.adm_no=student.adm_No order by previous_year_feegeneration.class,previous_year_feegeneration.sec")->result();
		}
		if (!empty($clss)) {
			$school_setting = $this->farheen->select('school_setting', '*');
			$result = array(
				'school_setting' => $school_setting,
				'stu' => $stu,
			);
			$this->load->view("Reports/defaulter_classwise_pre_PDF", $result);
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A4', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("Head_Wise_Summary_Report.pdf", array("Attachment" => 0));
		} else {
?>
			<table class='table table-bordered' id='example'>
				<thead>
					<tr style='background-color:#0099cc;color:white;font-weight:bold'>
						<td style='color:white !important;'>S.NO.</td>
						<td style='color:white !important;'>ADMISSION NO</td>
						<td style='color:white !important;'>NAME</td>
						<td style='color:white !important;'>CLASS</td>
						<td style='color:white !important;'>TOTAL AMOUNT</td>
						<td style='color:white !important;'>MONTH</td>
						<td style='color:white !important;'>MOBILE NO</td>

					</tr>
				</thead>
				<tbody>

					<?php

					$total_grand = 0;
					$ii = 1;
					foreach ($stu as $key) {


						$concatedata = $this->db->query("select Month_NM,TOTAL from previous_year_feegeneration where ADM_NO='" . $key->ADM_NO . "'")->result();
						$total = 0;
						$month = '';
						foreach ($concatedata as $kky) {
							$month .= $kky->Month_NM . "-";
							$total += $kky->TOTAL;
						}
						$total_grand += $total;

					?>

						<tr>
							<td><?php echo $ii; ?></td>
							<td><?php echo $key->ADM_NO; ?></td>
							<td><?php echo $key->STU_NAME; ?></td>
							<td><?php echo $key->CLASS; ?><?php echo $key->SEC; ?></td>
							<td><?php echo $total; ?></td>
							<td><?php echo $month; ?></td>
							<td><?php echo $key->C_MOBILE; ?></td>
						</tr>


					<?php
						$ii++;
					}

					?>
				</tbody>
				<tfoot>

					<tr style='background-color:#0099cc;color:white !important; font-weight:bold'>
						<td></td>
						<td></td>
						<td> </td>
						<td style='color:white !important;'> Total:</td>
						<td style='color:white !important;'> <?php echo $total_grand; ?></td>
						<td> </td>

					</tr>
				</tfoot>
			</table>
			<script>
				$('#example').DataTable({
					'paging': true,
					'lengthChange': true,
					'searching': true,
					'ordering': true,
					'info': true,
					'autoWidth': true,
					'pageLength': 25,
					dom: 'Bfrtip',
					buttons: {
						dom: {
							button: {
								tag: 'button',
								className: ''
							}
						},
						buttons: [{
								extend: 'excel',
								text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
								title: 'Defaulter Head Wise List Of Student',
								className: 'btn btn-success',
								extension: '.xlsx'
							},
							{
								extend: 'pdf',
								title: 'Defaulter Head Wise List Of Student',
								text: '<i class="fa fa-file-pdf-o"></i> PDF',
								className: 'btn btn-primary',
								action: function(e, dt, button, config) {
									var query = dt.search();
									window.open("<?php if (!empty($classs)) {
														echo base_url('Defaulter_list/defaulter_classwise_pre/' . $classs);
													} else {
														echo base_url('Defaulter_list/defaulter_classwise_pre/');
													} ?>");
								}
							}
						]
					}
				});
			</script>
		<?php }
	}

	public function defaulter_classwise()
	{
		$viewupto = $this->input->post('viewupto');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		if($sec != 'All')
		{
			$student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,C_MOBILE,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where CLASS='$classs' AND SEC='$sec' AND FREESHIP != 1 and student_status='ACTIVE' order by FIRST_NM asc")->result();
		}
		else
		{
			$student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,C_MOBILE,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where CLASS='$classs' AND FREESHIP != 1 and student_status='ACTIVE' and sec NOT IN (17,21,22,23,24) order by FIRST_NM asc")->result();
		}
		

		// echo "<pre>";print_r($student);die;
		$student_cnt = count($student);
		if ($viewupto == 'APR') {
			$monthin = array('APR');
			$loop_cnt = 1;
		} elseif ($viewupto == 'MAY') {
			$monthin = array('APR', 'MAY');
			$loop_cnt = 2;
		} elseif ($viewupto == 'JUN') {
			$monthin = array('APR', 'MAY', 'JUN');
			$loop_cnt = 3;
		} elseif ($viewupto == 'JUL') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL');
			$loop_cnt = 4;
		} elseif ($viewupto == 'AUG') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG');
			$loop_cnt = 5;
		} elseif ($viewupto == 'SEP') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP');
			$loop_cnt = 6;
		} elseif ($viewupto == 'OCT') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT');
			$loop_cnt = 7;
		} elseif ($viewupto == 'NOV') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV');
			$loop_cnt = 8;
		} elseif ($viewupto == 'DEC') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
			$loop_cnt = 9;
		} elseif ($viewupto == 'JAN') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN');
			$loop_cnt = 10;
		} elseif ($viewupto == 'FEB') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB');
			$loop_cnt = 11;
		} elseif ($viewupto == 'MAR') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR');
			$loop_cnt = 12;
		} else {
		}

		?>
		<table class='table table-bordered' id='example'>
			<thead>
				<tr>
					<th style="background: #337ab7; color: white !important;">SNO</th>
					<th style="background: #337ab7; color: white !important;">NAME</th>
					<th style="background: #337ab7; color: white !important;">ADM_NO</th>
					<th style="background: #337ab7; color: white !important;">ROLL NO</th>
					<th style="background: #337ab7; color: white !important;">Class/Sec</th>
					<th style="background: #337ab7; color: white !important;">MONTH UPTO</th>
					<th style="background: #337ab7; color: white !important;">PREVIOUS YEAR DUES</th>
					<th style="background: #337ab7; color: white !important;">CURRENT YEAR DUES</th>
					<th style="background: #337ab7; color: white !important;">TOTAL AMOUNT</th>
					<th style="background: #337ab7; color: white !important;">MOBILE NO</th>

				</tr>
			</thead>
			<tbody>

				<?php
				$month_print = '';
				$str_month = '';
				$mon = '';
				$total_amount = 0;
				$unpaid_mnth = 0;
				$previous_duess = 0;
				$grand_tot = 0;
				$grand_tot_prev = 0;
				$grand_tot_currnt = 0;
				$c = 1;
				$pre = 0;
				for ($i = 0; $i < $student_cnt; $i++) {
					$str_month = '';
					$month_print = '';
					$adm_no = $student[$i]->ADM_NO;
					$class_sec = $student[$i]->DISP_CLASS . "-" . $student[$i]->DISP_SEC;
					$MON_FEE[0] = $student[$i]->APR_FEE;
					$MON_FEE[1] = $student[$i]->MAY_FEE;
					$MON_FEE[2] = $student[$i]->JUNE_FEE;
					$MON_FEE[3] = $student[$i]->JULY_FEE;
					$MON_FEE[4] = $student[$i]->AUG_FEE;
					$MON_FEE[5] = $student[$i]->SEP_FEE;
					$MON_FEE[6] = $student[$i]->OCT_FEE;
					$MON_FEE[7] = $student[$i]->NOV_FEE;
					$MON_FEE[8] = $student[$i]->DEC_FEE;
					$MON_FEE[9] = $student[$i]->JAN_FEE;
					$MON_FEE[10] = $student[$i]->FEB_FEE;
					$MON_FEE[11] = $student[$i]->MAR_FEE;
					@$previous_duess = $student[$i]->previous_dues;

					for ($l = 0; $l < $loop_cnt; $l++) {
						if ($MON_FEE[$l] == 'N/A' or  $MON_FEE[$l] == '') {
							$month_print .= $monthin[$l] . ',';
							if ($str_month != '') {
								$str_month = $str_month . ",'" . $monthin[$l] . "'";
							} else {
								$str_month = "'" . $monthin[$l] . "'";
							}
						}
					}
					// echo $str_month;die;
					if (!empty($str_month)) {
						$unpaid_month = $this->farheen->select('feegeneration', 'sum(TOTAL)total', "ADM_NO='$adm_no' AND Month_NM in($str_month)");
						$unpaid_mnth = $unpaid_month[0]->total;
					}

					$total_amount = $previous_duess + $unpaid_mnth;

					if ($total_amount > 0) {
						$grand_tot_prev = $grand_tot_prev + $previous_duess;
						$grand_tot_currnt = $grand_tot_currnt + $unpaid_mnth;
						$grand_tot = $grand_tot + $total_amount;

				?>
						<tr>
							<td><?php echo $c; ?></td>
							<td><?php echo $student[$i]->FIRST_NM; ?></td>
							<td><?php echo $student[$i]->ADM_NO; ?></td>
							<td><?php echo $student[$i]->ROLL_NO; ?></td>
							<td><?php echo $class_sec; ?></td>
							<td><?php
								if ($previous_duess > 0) {
									$mntt = 'PREV.DUES' . ',' . $month_print;
									$month_upto = rtrim($mntt, ',');
									echo $month_upto;
								} else {
									$month_upto = rtrim($month_print, ',');
									echo $month_upto;
								}

								?></td>
							<td>
								<?php
								echo $student[$i]->previous_dues;
								?>
							</td>
							<td><?php echo $unpaid_mnth; ?></td>
							<td><?php echo $total_amount; ?></td>
							<td><?php echo $student[$i]->C_MOBILE; ?></td>
						</tr>
				<?php
						$c++;
					}

					$total_amount = 0;
					$unpaid_mnth = 0;
					$previous_duess = 0;
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
					<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_prev; ?></b></td>
					<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_currnt; ?></b></td>
					<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot; ?></b></td>
				</tr>
			</tfoot>
		</table></br>
		<input type="hidden" name="view_upto" id="view_upto" value="<?php echo $viewupto; ?>">
		<input type="hidden" name="clssss" id="clssss" value="<?php echo $classs; ?>">
		<input type="hidden" name="sec" id="sec" value="<?php echo $sec; ?>">

		<script>
			$(document).ready(function() {
				var viewupto = $("#view_upto").val();
				var cls = $("#clssss").val();
				var sec = $("#sec").val();
				// alert(cls);
				$('#example').DataTable({
					'paging': true,
					'lengthChange': true,
					'searching': true,
					'ordering': false,
					'info': true,
					'autoWidth': true,
					'pageLength': 25,
					dom: 'Bfrtip',
					buttons: {
						dom: {
							button: {
								tag: 'button',
								className: ''
							}
						},
						buttons: [{
								extend: 'excel',
								text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
								title: 'Class wise Defaulter Reports',
								className: 'btn btn-success',
								extension: '.xlsx'
							},
							{
								extend: 'pdf',
								title: 'Class wise Defaulter Reports',
								text: '<i class="fa fa-file-pdf-o"></i> PDF',
								className: 'btn btn-primary',
								action: function(e, dt, button, config) {
									var query = dt.search();
									window.open("<?php echo base_url('Defaulter_list/defaulter_classwise_PDF/' . $viewupto . '/' . $classs . '/' . $sec); ?>");
									// $.post("<?php //echo base_url('Defaulter_list/defaulter_classwise_PDF'); 
												?>", {
									// 	view_upto: viewupto,
									// 	classs: cls,
									// 	sec: sec
									// });
								}
							}
						]
					},
					footer: true,
				});
			});
		</script>
	<?php
	}

	public function defaulter_classwise_PDF($view, $cls, $sec)
	{
		// echo "<pre>";print_r($_POST);die;
		$data['School_setting'] = $School_setting = $this->farheen->select('school_setting', '*');

		$data['viewupto'] = $viewupto = $view;
		$data['classs'] = $classs = $cls;
		$data['sec'] = $sec = $sec;
		if($sec != 'All')
		{
			$data['student'] = $student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,C_MOBILE,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where CLASS='$classs' AND SEC='$sec' AND FREESHIP != 1 and student_status='ACTIVE' order by FIRST_NM asc")->result();
		}
		else
		{
			$data['student'] = $student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,C_MOBILE,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where CLASS='$classs' AND FREESHIP != 1 and student_status='ACTIVE' and sec NOT IN (17,21,22,23,24) order by FIRST_NM asc")->result();
		}
		

		$data['student_cnt'] = $student_cnt = count($student);

		if ($viewupto == 'APR') {
			$monthin = array('APR');
			$loop_cnt = 1;
		} elseif ($viewupto == 'MAY') {
			$monthin = array('APR', 'MAY');
			$loop_cnt = 2;
		} elseif ($viewupto == 'JUN') {
			$monthin = array('APR', 'MAY', 'JUN');
			$loop_cnt = 3;
		} elseif ($viewupto == 'JUL') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL');
			$loop_cnt = 4;
		} elseif ($viewupto == 'AUG') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG');
			$loop_cnt = 5;
		} elseif ($viewupto == 'SEP') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP');
			$loop_cnt = 6;
		} elseif ($viewupto == 'OCT') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT');
			$loop_cnt = 7;
		} elseif ($viewupto == 'NOV') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV');
			$loop_cnt = 8;
		} elseif ($viewupto == 'DEC') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
			$loop_cnt = 9;
		} elseif ($viewupto == 'JAN') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN');
			$loop_cnt = 10;
		} elseif ($viewupto == 'FEB') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB');
			$loop_cnt = 11;
		} elseif ($viewupto == 'MAR') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR');
			$loop_cnt = 12;
		} else {
		}
		$data['monthin'] = $monthin;
		$data['loop_cnt'] = $loop_cnt;
		// echo "<pre>";
		// print_r($data);
		// die;
		$this->load->view('Reports/defaulter_classwisePDF', $data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("defaulter_list_class_wise.pdf", array("Attachment" => 0));
	}

	public function defaulter_allclasswise()
	{
		$viewupto = $this->input->post('viewupto');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,C_MOBILE,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where student_status='ACTIVE' and disp_Sec not in ('K','DT','RT','TC','Z') AND FREESHIP != 1 order by class,sec,first_Nm asc")->result();

		$student_cnt = count($student);

		if ($viewupto == 'APR') {
			$monthin = array('APR');
			$loop_cnt = 1;
		} elseif ($viewupto == 'MAY') {
			$monthin = array('APR', 'MAY');
			$loop_cnt = 2;
		} elseif ($viewupto == 'JUN') {
			$monthin = array('APR', 'MAY', 'JUN');
			$loop_cnt = 3;
		} elseif ($viewupto == 'JUL') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL');
			$loop_cnt = 4;
		} elseif ($viewupto == 'AUG') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG');
			$loop_cnt = 5;
		} elseif ($viewupto == 'SEP') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP');
			$loop_cnt = 6;
		} elseif ($viewupto == 'OCT') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT');
			$loop_cnt = 7;
		} elseif ($viewupto == 'NOV') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV');
			$loop_cnt = 8;
		} elseif ($viewupto == 'DEC') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
			$loop_cnt = 9;
		} elseif ($viewupto == 'JAN') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN');
			$loop_cnt = 10;
		} elseif ($viewupto == 'FEB') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB');
			$loop_cnt = 11;
		} elseif ($viewupto == 'MAR') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR');
			$loop_cnt = 12;
		} else {
		}

	?>
		<table class='table table-bordered' id='example'>
			<thead>
				<tr>
					<th style="background: #337ab7; color: white !important;">SNO</th>
					<th style="background: #337ab7; color: white !important;">NAME</th>
					<th style="background: #337ab7; color: white !important;">ADM_NO</th>
					<th style="background: #337ab7; color: white !important;">ROLL NO</th>
					<th style="background: #337ab7; color: white !important;">Class/Sec</th>
					<th style="background: #337ab7; color: white !important;">MONTH UPTO</th>
					<th style="background: #337ab7; color: white !important;">PREVIOUS YEAR DUES</th>
					<th style="background: #337ab7; color: white !important;">CURRENT YEAR DUES</th>
					<th style="background: #337ab7; color: white !important;">TOTAL AMOUNT</th>
					<th style="background: #337ab7; color: white !important;">MOIBLE NO</th>
				</tr>
			</thead>
			<tbody>

				<?php
				$month_print = '';
				$str_month = '';
				$mon = '';
				$total_amount = 0;
				$unpaid_mnth = 0;
				$previous_duess = 0;
				$grand_tot = 0;
				$grand_tot_prev = 0;
				$grand_tot_currnt = 0;
				$c = 1;
				$pre = 0;
				for ($i = 0; $i < $student_cnt; $i++) {
					$str_month = '';
					$month_print = '';
					$adm_no = $student[$i]->ADM_NO;
					$class_sec = $student[$i]->DISP_CLASS . "-" . $student[$i]->DISP_SEC;
					$MON_FEE[0] = $student[$i]->APR_FEE;
					$MON_FEE[1] = $student[$i]->MAY_FEE;
					$MON_FEE[2] = $student[$i]->JUNE_FEE;
					$MON_FEE[3] = $student[$i]->JULY_FEE;
					$MON_FEE[4] = $student[$i]->AUG_FEE;
					$MON_FEE[5] = $student[$i]->SEP_FEE;
					$MON_FEE[6] = $student[$i]->OCT_FEE;
					$MON_FEE[7] = $student[$i]->NOV_FEE;
					$MON_FEE[8] = $student[$i]->DEC_FEE;
					$MON_FEE[9] = $student[$i]->JAN_FEE;
					$MON_FEE[10] = $student[$i]->FEB_FEE;
					$MON_FEE[11] = $student[$i]->MAR_FEE;
					@$previous_duess = $student[$i]->previous_dues;

					for ($l = 0; $l < $loop_cnt; $l++) {
						if ($MON_FEE[$l] == 'N/A' or  $MON_FEE[$l] == '') {
							$month_print .= $monthin[$l] . ',';
							if ($str_month != '') {
								$str_month = $str_month . ",'" . $monthin[$l] . "'";
							} else {
								$str_month = "'" . $monthin[$l] . "'";
							}
						}
					}
					if (!empty($str_month)) {
						$unpaid_month = $this->farheen->select('feegeneration', 'sum(TOTAL)total', "ADM_NO='$adm_no' AND Month_NM in($str_month)");
						$unpaid_mnth = $unpaid_month[0]->total;
					}

					$total_amount = $previous_duess + $unpaid_mnth;

					if ($total_amount > 0) {
						$grand_tot_prev = $grand_tot_prev + $previous_duess;
						$grand_tot_currnt = $grand_tot_currnt + $unpaid_mnth;
						$grand_tot = $grand_tot + $total_amount;

				?>
						<tr>
							<td><?php echo $c; ?></td>
							<td><?php echo $student[$i]->FIRST_NM; ?></td>
							<td><?php echo $student[$i]->ADM_NO; ?></td>
							<td><?php echo $student[$i]->ROLL_NO; ?></td>
							<td><?php echo $class_sec; ?></td>
							<td><?php
								if ($previous_duess > 0) {
									$mntt = 'PREV.DUES' . ',' . $month_print;
									$month_upto = rtrim($mntt, ',');
									echo $month_upto;
								} else {
									$month_upto = rtrim($month_print, ',');
									echo $month_upto;
								}

								?></td>
							<td>
								<?php
								echo $student[$i]->previous_dues;
								?>
							</td>
							<td><?php echo $unpaid_mnth; ?></td>
							<td><?php echo $total_amount; ?></td>
							<td><?php echo $student[$i]->C_MOBILE; ?></td>
						</tr>
				<?php
						$c++;
					}

					$total_amount = 0;
					$unpaid_mnth = 0;
					$previous_duess = 0;
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
					<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_prev; ?></b></td>
					<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_currnt; ?></b></td>
					<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot; ?></b></td>
				</tr>
			</tfoot>
		</table></br>

		<script>
			$('#example').DataTable({
				'paging': true,
				'lengthChange': true,
				'searching': true,
				'ordering': false,
				'info': true,
				'autoWidth': true,
				'pageLength': 25,
				dom: 'Bfrtip',
				buttons: {
					dom: {
						button: {
							tag: 'button',
							className: ''
						}
					},
					buttons: [{
							extend: 'excel',
							text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
							title: 'Class wise Defaulter Reports',
							className: 'btn btn-success',
							extension: '.xlsx'
						},
						{
							extend: 'pdf',
							title: 'Class wise Defaulter Reports',
							text: '<i class="fa fa-file-pdf-o"></i> PDF',
							className: 'btn btn-primary',
							action: function(e, dt, button, config) {
								var query = dt.search();
								window.open("<?php echo base_url('Defaulter_list/defaulter_allclasswise_PDF/' . $viewupto); ?>");
								// $.post("<?php //echo base_url('Defaulter_list/defaulter_classwise_PDF'); 
											?>", {
								// 	view_upto: viewupto,
								// 	classs: cls,
								// 	sec: sec
								// });
							}
						}
					]
				},
				footer: true,
			});
		</script>
<?php
	}
	public function defaulter_allclasswise_PDF($view)
	{
		$data['School_setting'] = $School_setting = $this->farheen->select('school_setting', '*');

		$data['viewupto'] = $viewupto = $view;
		$data['student'] = $student = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_FEE,MAY_FEE,JUNE_FEE,JULY_FEE,AUG_FEE,SEP_FEE,OCT_FEE,NOV_FEE,DEC_FEE,JAN_FEE,FEB_FEE,MAR_FEE,DISP_CLASS,DISP_SEC,C_MOBILE,ifnull((Select sum(total) from previous_year_feegeneration where adm_no=st.ADM_NO),0) as previous_dues from student as st where student_status='ACTIVE' and disp_Sec not in ('K','DT','RT','TC','Z') AND FREESHIP != 1   order by class,sec,first_Nm asc")->result();

		$data['student_cnt'] = $student_cnt = count($student);

		if ($viewupto == 'APR') {
			$monthin = array('APR');
			$loop_cnt = 1;
		} elseif ($viewupto == 'MAY') {
			$monthin = array('APR', 'MAY');
			$loop_cnt = 2;
		} elseif ($viewupto == 'JUN') {
			$monthin = array('APR', 'MAY', 'JUN');
			$loop_cnt = 3;
		} elseif ($viewupto == 'JUL') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL');
			$loop_cnt = 4;
		} elseif ($viewupto == 'AUG') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG');
			$loop_cnt = 5;
		} elseif ($viewupto == 'SEP') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP');
			$loop_cnt = 6;
		} elseif ($viewupto == 'OCT') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT');
			$loop_cnt = 7;
		} elseif ($viewupto == 'NOV') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV');
			$loop_cnt = 8;
		} elseif ($viewupto == 'DEC') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
			$loop_cnt = 9;
		} elseif ($viewupto == 'JAN') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN');
			$loop_cnt = 10;
		} elseif ($viewupto == 'FEB') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB');
			$loop_cnt = 11;
		} elseif ($viewupto == 'MAR') {
			$monthin = array('APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR');
			$loop_cnt = 12;
		} else {
		}

		$data['monthin'] = $monthin;
		$data['loop_cnt'] = $loop_cnt;
		// echo "<pre>";
		// print_r($data);
		// die;
		$this->load->view('Reports/defaulter_allclasswisePDF', $data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("defaulter_list_class_wise.pdf", array("Attachment" => 0));
	}
}
