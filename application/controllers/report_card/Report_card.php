<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_card extends MY_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Alam', 'alam');
	}

	public function index()
	{

		if (!in_array('viewTermWiseReportCard', permission_data)) {
			redirect('payroll/dashboard/dashboard');
		}

		$this->render_template('report_card/report_card_term');
	}

	public function report_card($trm)
	{

		if (!in_array('viewTermWiseReportCard', permission_data)) {
			redirect('payroll/dashboard/dashboard');
		}

		$class_data = $this->alam->select('classes', '*');
		$array  = array('trm' => $trm, 'class_data' => $class_data);

		$this->render_template('report_card/report_card', $array);
	}

	public function classess_report_card()
	{
		$ret = '';
		$class_code = '';
		$pt_type = '';
		$exam_type = '';

		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student', 'distinct(DISP_SEC),SEC', 'DISP_SEC', "CLASS='$class_nm' AND Student_Status='ACTIVE'");

		$class_data = $this->alam->select('classes', '*', "Class_No='$class_nm'");
		$class_code = $class_data[0]->Class_No;
		$pt_type    = $class_data[0]->PT_TYPE;
		$exam_type  = $class_data[0]->ExamMode;

		$ret .= "<option value=''>Select</option>";
		if (isset($sec_data)) {
			foreach ($sec_data as $data) {
				$ret .= "<option value=" . $data->SEC . ">" . $data->DISP_SEC . "</option>";
			}
		}

		$array = array($ret, $class_code, $pt_type, $exam_type);
		echo json_encode($array);
	}

	public function make_report_card()
	{
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');

		$trm        = $this->input->post('trm');
		$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$date       = $this->input->post('date');
		$dt         = date('Y-m-d', strtotime($date));
		$round      = $this->input->post('round');
		$class_code = $this->input->post('class_code');
		$pt_type    = $this->input->post('pt_type');
		$exam_type  = $this->input->post('exam_type');

		$school_setting = $this->alam->select('school_setting', '*');
		if ($classs == 1 || $classs == 2 || $classs == 3) {
			$stu_data = $this->alam->report_card_student_detail_junior($trm, $classs, $sec);
		} else {
			$stu_data = $this->alam->report_card_student_detail($trm, $classs, $sec);
		}

		$array = array('trm' => $trm, 'school_setting' => $school_setting, 'stu_data' => $stu_data, 'classs' => $classs, 'sec' => $sec, 'round' => $round, 'dt' => $dt);

		if ($trm == 1) {
			if ($classs == 1 || $classs == 2 || $classs == 3) {
				$this->load->view('report_card/report_card_list_junior', $array);
			} elseif ($classs == 13) {
				$this->load->view('report_card/report_card_x', $array);
			} else {
				$this->load->view('report_card/report_card_list', $array);
			}
		} else {
			if ($classs == 1 || $classs == 2 || $classs == 3) {
				$this->load->view('report_card/report_card_list_junior', $array);
			} elseif ($classs == 13) {
				$this->load->view('report_card/report_card_x', $array);
			} else {
				$this->load->view('report_card/report_card_list_t2', $array);
			}
		}
	}


		public function generatePDF()
	{
		// Static data ek baar fetch
		$data['school_setting'] = $this->alam->select('school_setting', '*');
		$data['school_photo'] = $this->alam->select('school_photo', '*');
		$data['report_card_type'] = $this->alam->select('misc_table', '*')[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster', '*');
		$data['signature'] = $this->alam->select('signature', '*');

		// Inputs
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$round_off = $this->input->post('round_off');
		$termId = $term;

		$examModedata = $this->alam->select('classes', 'ExamMode', "Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;

		if ($examode == 1 || $examode == 2) {
			$term = ($term == 1) ? 'TERM-1' : 'TERM-2';
			if (in_array($classs, [4, 5, 6, 7, 8, 9, 10, 11, 14, 15, 18, 20])) {
				$examcode = ($term == 'TERM-1') ? ['1', '2', '3', '4'] : ['1', '2', '3', '4', '5', '7'];
			}else{
				$examcode = ($term == 'TERM-1') ? ['4', '13'] : ['4', '5', '13'];
			}
			$term_array = ($term == 'TERM-1') ? ['TERM-1'] : ['TERM-1', 'TERM-2'];

			// Batch fetch
			$stu_data = $this->alam->studentDetailsByAdmissionNo_Batch($adm_no, $termId, $classs, $sec);
			// echo $this->db->last_query();die;
			$subjectData = $this->alam->getClassWiseSubject($term, $classs, $sec);
			$all_marks = $this->sumit->fetchAllData(
				'admno, ExamC, SCode, M1, M2, M3, Term',
				'marks',
				"admno IN ('" . implode("','", $adm_no) . "') AND ExamC IN ('" . implode("','", $examcode) . "') AND Term IN ('" . implode("','", $term_array) . "') AND status = '1'"
			);

			// echo $this->db->last_query();			die;

			$result = [];
			foreach ($stu_data as $student) {
				$admnum = $student['ADM_NO'];
				$result[$admnum] = $student;

				foreach ($subjectData as $key2 => $val2) {
					$sub_code = $val2['subject_code'];
					$pt_type = $val2['pt_type'];

					if ($val2['opt_code'] == 2) {
						$check_student_subject = $this->sumit->checkData('*', 'studentsubject', ['Adm_no' => $admnum, 'Class' => $student['CLASS'], 'SUBCODE' => $sub_code]);
					} else {
						$check_student_subject = true;
					}

					if ($check_student_subject) {
						$result[$admnum]['sub'][$key2] = [
							'subject_name' => $val2['subj_nm'],
							'subject_code' => $val2['Class_Name_Hindu_arabic'],
							'opt_code' => $val2['opt_code'],
						];

						// Filter marks for this student and subject
						$student_marks = array_filter($all_marks, function ($mark) use ($admnum, $sub_code) {
							return $mark['admno'] == $admnum && $mark['SCode'] == $sub_code;
						});

						$marks = $this->calculateMarks($student_marks, $examcode, $pt_type, $round_off, $term_array);
						$result[$admnum]['sub'][$key2]['marks'] = $marks;
					}
				}
			}

			$data['result'] = $result;
			$data['round_off'] = $round_off;
			$data['trm'] = $termId;
			$data['cls'] = $classs;
			$data['sec'] = $sec;

			$class = $stu_data[0]['CLASS'];
			 //echo '<pre>';print_r($data);die;
			if (in_array($class, [4, 5, 6, 7, 8, 9, 10, 11, 14, 15, 18, 20])) {
				$this->load->view('report_card/report_card_cbsc_pdf_t2_neww', $data);
			} else {
				$this->load->view('report_card/report_card_cbsc_pdf_IX_t2_neww', $data);
			}
		}
	}

	private function calculateMarks($student_marks, $examcode, $pt_type, $round_off, $term_array)
	{
		$marks = [];
		foreach ($term_array as $term) {
			foreach ($examcode as $key => $code) {
				$examC = $code; // Direct code use karo
				if ($term == 'TERM-1' && $code == '1') $examC = '1,7,8'; // TERM-1 ke liye PT multiple codes
				if ($term == 'TERM-2' && $code == '7') $examC = '7'; // TERM-2 ke liye PT Exam Code 7
				//$wetageMarks = $this->sumit->fetchSingleData('wetage1', 'exammaster', ['ExamCode' => $code])['wetage1'] ?? 1; // Default wetage if not found
				$filtered_marks = array_filter($student_marks, function ($m) use ($examC, $term) {
					return in_array($m['ExamC'], explode(',', $examC)) && $m['Term'] == $term;
				});
				if (!empty($filtered_marks)) {
					$mark = reset($filtered_marks);
					$calculated = $mark['M3'];
					$marks[$term][$key] = ($mark['M2'] == 'AB' || $mark['M2'] == '-') ? $mark['M2'] : ($round_off ? round($calculated) : number_format($calculated, 2));
				}
			}
		}
		return $marks;
	}
	public function generatePDF_old()
	{
		$school_setting = $this->alam->select('school_setting', '*');
		$school_photo   = $this->alam->select('school_photo', '*');
		$reportCardType_data = $this->alam->select('misc_table', '*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster', '*');
		$data['signature'] = $this->alam->select('signature', '*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes', 'ExamMode', "Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
		$termId = $term;
		$round_off = $this->input->post('round_off');

		$stu_att_type = 1;
		$att_type = 1;

		$data['tot_working_day'] = 0;
		$data['tot_working_day'] = 0;
		$examcode = array();
		$pt_all_marks = array();
		$result = array();

		if ($examode == 1) //diffrentiate CBSE or CMC
		{
			if ($term == 1) {
				$term = 'TERM-1';
				$examcode = array('1', '2', '3', '4');
			} else {
				$term = 'TERM-2';
				$examcode = array('1', '2', '3', '4', '5');
			}
			// print_r($examcode);die;
			foreach ($adm_no as $key => $value) {
				$stu_data = $this->alam->studentDetailsByAdmissionNo_New($value, $termId, $classs, $sec, $date);

				//echo '<pre>'; print_r($stu_data); echo '</pre>';die;
				$result[$value] = $stu_data;
				$admnum  = $stu_data['ADM_NO'];
				$class   = $stu_data['CLASS'];
				$section = $stu_data['SEC'];
				$skill_1 = $stu_data['skill_1'];
				$skill_2 = $stu_data['skill_2'];
				$skill_3 = $stu_data['skill_3'];
				$skill_5 = $stu_data['skill_5'];
				$dis_grd = $stu_data['dis_grd'];
				$diskill_1 = $stu_data['diskill_1'];
				$diskill_2 = $stu_data['diskill_2'];
				$diskill_3 = $stu_data['diskill_3'];
				$diskill_4 = $stu_data['diskill_4'];
				$rmks    = $stu_data['rmks'];
				$WORK_DAYS    = $stu_data['WORK_DAYS'];
				$subjectData = $this->alam->getClassWiseSubject($term, $class, $section);
				//for attendance //

				//end attendance //
				foreach ($subjectData as $key2 => $val2) {
					if ($val2['opt_code'] == 2) {
						$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $value, 'Class' => $class, 'SUBCODE' => $val2['subject_code']));
					} else {
						$check_student_subject = true;
					}
					if ($check_student_subject) {
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['subject_code'] = $val2['Class_Name_Hindu_arabic'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						if ($term == 1) {
							$term_array = array('TERM-1');
						} else {
							$term_array = array('TERM-1', 'TERM-2');
						}

						foreach ($term_array as $term_arr) {
							foreach ($examcode as $keys => $val) {
								($val == 1) ? $examC = "1,7,8" : $examC = $val;
								$marks = array();
								$tot_per = 0;
								$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC', 'marks', "admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term_arr' AND status = '1'");

								$wetageMarks = $this->sumit->fetchSingleData('wetage1', 'exammaster', array('ExamCode' => $val));
								$absent = array();
								$ab = 0;
								if ($val == 1) {
									$mark = array();
									if ($pt_type == 1) {
										foreach ($all_marks as $key4 => $value4) {
											$mark = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
											$mark = ($value4['M2'] == 'AB' || $value4['M2'] == '-') ? $value4['M2'] : $mark;
										}
										if ($mark == 'AB' || $mark == '-') {
											$final_marks[$keys] = $mark;
										} else {
											$final_marks[$keys] = number_format($mark, 2);
										}
									} elseif ($pt_type == 2) {
										foreach ($all_marks as $key4 => $value4) {
											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
											$tot_per = $tot_per + $mark[$key4];
											$absent[$key4] = $value4['M2'];
										}
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($tot_per / 3, 2);
									} else {
										foreach ($all_marks as $key4 => $value4) {
											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
											$absent[$key4] = $value4['M2'];
										}
										rsort($mark);
										$mark[1] = isset($mark[1]) ? $mark[1] : 0;
										$mark[0] = isset($mark[0]) ? $mark[0] : 0;
										$two_sum = $mark[0] + $mark[1];
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($two_sum / 2, 2);
									}
									if ($final_marks[$keys] != 'AB' && $final_marks[$keys] != '-') {
										$final_marks[$keys] = ($round_off == 1) ? round($final_marks[$keys]) : $final_marks[$keys];
									}
									//$final_marks[$keys]=($round_off==1)?round($final_marks[$keys]):$final_marks[$keys];
								} else {
									if (!empty($all_marks)) {
										$mark = ($all_marks[0]['M3'] / $all_marks[0]['M1']) * $wetageMarks['wetage1'];
										$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-') ? $all_marks[0]['M2'] : $mark;
									} else {
										$mark = 0;
									}
									if ($mark == 'AB' || $mark == '-') {
										$final_marks[$keys] = $mark;
									} else {
										$final_marks[$keys] = ($round_off == 1) ? round($mark) : number_format($mark, 2);
									}
								}
							}

							if ($term == 'TERM-1') {
								$marks['pt'] = $final_marks[0];
								$marks['notebook'] = $final_marks[1];
								$marks['subject_enrichment'] = $final_marks[2];
								$marks['half_yearly'] = $final_marks[3];
								$marks['second_term'] = $final_marks[4];

								$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
								$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
								$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];
								$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-') ? 0 : $marks['half_yearly'];
								$second_term = ($marks['second_term'] == 'AB' || $marks['second_term'] == '-') ? 0 : $marks['second_term'];

								$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
								$marks_ontained_t2 = $pt_marks + $notebook_marks + $se_marks + $second_term;
								$marks['marks_obtained'] = ($round_off == 1) ? round($marks_obtained) : number_format($marks_obtained, 2);
								$marks['marks_ontained_t2'] = ($round_off == 1) ? round($marks_ontained_t2) : number_format($marks_ontained_t2, 2);

								$result[$value]['sub'][$key2]['marks'] = $marks;
							} else {
								if ($term_arr == 'TERM-1') {
									// echo "<pre>";print_r($final_marks);die;
									$pt_t1 = $final_marks[0];
									$notebook_t1 = $final_marks[1];
									$subject_enrichment_t1 = $final_marks[2];
									$half_yearly = $final_marks[3];

									$pt_marks = ($pt == 'AB' || $pt == '-') ? 0 : $pt_t1;
									$notebook_t1_marks = ($notebook_t1 == 'AB' || $notebook_t1 == '-') ? 0 : $notebook_t1;
									$se_marks_t1 = ($subject_enrichment_t1 == 'AB' || $subject_enrichment_t1 == '-') ? 0 : $subject_enrichment_t1;
									$hy_marks = ($half_yearly == 'AB' || $half_yearly == '-') ? 0 : $half_yearly;

									$marks_obtained_t1 = $pt_marks + $notebook_t1_marks + $se_marks_t1 + $hy_marks;
								} else {
									$marks['pt'] = $final_marks[0];
									$marks['notebook'] = $final_marks[1];
									$marks['subject_enrichment'] = $final_marks[2];
									$marks['half_yearly'] = $marks_obtained_t1;
									$marks['second_term'] = $final_marks[4];

									$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
									$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
									$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];

									$second_term = ($marks['second_term'] == 'AB' || $marks['second_term'] == '-') ? 0 : $marks['second_term'];


									$marks_ontained_t2 = $pt_marks + $notebook_marks + $se_marks + $second_term;
									$marks['marks_obtained'] = ($round_off == 1) ? round($marks_ontained_t2) : number_format($marks_ontained_t2, 2);

									$marks['sum_term1_term2'] = ($round_off == 1) ? round(($marks_obtained_t1 + $marks_ontained_t2) / 2) : number_format(($marks_obtained_t1 + $marks_ontained_t2) / 2);

									$t1plust2 = round(($marks_obtained_t1 + $marks_ontained_t2) / 2);


									$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$t1plust2 AND CRange <= $t1plust2");
									$marks['grade'] = $gradeData['Grade'];
									$result[$value]['sub'][$key2]['marks'] = $marks;
								}
							}
						}
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']         = $result;
			$data['school_setting'] = $school_setting;
			$data['school_photo']   = $school_photo;
			$data['trm'] = $termId;
			$data['cls'] = $classs;
			$data['sec'] = $sec;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';
			// die;
			if ($class == 4 || $class == 5 || $class == 6 || $class == 7 || $class == 8 || $class == 9 || $class == 10 || $class == 11) {
				// $this->load->view('report_card/report_card_cbsc_pdf', $data);
				$this->load->view('report_card/report_card_cbsc_pdf_t2', $data);
			} else {
				$this->load->view('report_card/report_card_cbsc_pdf_IX', $data);
			}
		} else {

			if ($term == 1) {
				$term = 'TERM-1';
				$examcode = array('1', '2', '3', '6', '4', '13');
			} else {
				$term = 'TERM-2';
				$examcode = array('1', '2', '3', '6', '4', '5', '13');
			}
			foreach ($adm_no as $key => $value) {
				$stu_data = $this->alam->studentDetailsByAdmissionNo_New($value, $termId, $classs, $sec, $date);

				$result[$value] = $stu_data;
				$admnum  = $stu_data['ADM_NO'];
				$class   = $stu_data['CLASS'];
				$section = $stu_data['SEC'];
				$skill_1 = $stu_data['skill_1'];
				$skill_2 = $stu_data['skill_2'];
				$skill_3 = $stu_data['skill_3'];
				$dis_grd = $stu_data['dis_grd'];
				$diskill_1 = $stu_data['diskill_1'];
				$diskill_2 = $stu_data['diskill_2'];
				$diskill_3 = $stu_data['diskill_3'];
				$diskill_4 = $stu_data['diskill_4'];
				$rmks    = $stu_data['rmks'];

				$subjectData = $this->alam->getClassWiseSubject($term, $class, $section);
				//for attendance //

				//end attendance //
				foreach ($subjectData as $key2 => $val2) {

					if ($val2['opt_code'] == 2) {
						$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $value, 'Class' => $class, 'SUBCODE' => $val2['subject_code']));
					} else {
						$check_student_subject = true;
					}
					if ($check_student_subject) {
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['subject_code'] = $val2['Class_Name_Hindu_arabic'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						if ($term == 1) {
							$term_array = array('TERM-1');
						} else {
							$term_array = array('TERM-1', 'TERM-2');
						}

						foreach ($term_array as $term_arr) {
							foreach ($examcode as $keys => $val) {
								($val == 1) ? $examC = "1,7,8" : $examC = $val;
								$marks = array();
								$tot_per = 0;
								$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC', 'marks', "admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term_arr' AND status = '1'");
								//$str=$this->db->last_query();
								//echo $str;
								//echo '<br/>';

								$wetageMarks = $this->sumit->fetchSingleData('wetage2', 'exammaster', array('ExamCode' => $val));
								$absent = array();
								$ab = 0;
								//echo '<pre>'; print_r($all_marks); echo '</pre>';die;
								if ($val == 1) {
									$mark = array();
									if ($pt_type == 1) {
										foreach ($all_marks as $key4 => $value4) {

											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
											$absent[$key4] = $value4['M2'];
										}
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format(max($mark), 2);
									} elseif ($pt_type == 2) {
										foreach ($all_marks as $key4 => $value4) {

											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
											$tot_per = $tot_per + $mark[$key4];
											$absent[$key4] = $value4['M2'];
										}
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($tot_per / 3, 2);
									} else {
										foreach ($all_marks as $key4 => $value4) {

											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
											$absent[$key4] = $value4['M2'];
										}
										rsort($mark);
										$mark[1] = isset($mark[1]) ? $mark[1] : 0;
										$mark[0] = isset($mark[0]) ? $mark[0] : 0;
										$two_sum = $mark[0] + $mark[1];
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($two_sum / 2, 2);
									}

									($round_off == 1) ? $final_marks[$keys] = round($final_marks[$keys]) : $final_marks[$keys] = $final_marks[$keys];
								} else {
									if (!empty($all_marks)) {
										//$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];
										$mark = ($all_marks[0]['M3']);
										$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-') ? $all_marks[0]['M2'] : $mark;
									} else {
										$mark = 0;
									}
									if ($mark == 'AB' || $mark == '-') {
										$final_marks[$keys] = $mark;
									} else {
										$final_marks[$keys] = ($round_off == 1) ? round($mark) : number_format($mark, 2);
									}
								}
							}
							if ($term == 1) {
								$marks['pt'] = $final_marks[0];
								$marks['notebook'] = $final_marks[1];
								$marks['activity'] = $final_marks[2];
								$marks['subject_enrichment'] = $final_marks[3];
								$marks['half_yearly'] = $final_marks[4];
								$marks['ia'] = $final_marks[5];

								$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
								$ia_marks = ($marks['ia'] == 'AB' || $marks['ia'] == '-') ? 0 : $marks['ia'];
								$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
								$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-') ? 0 : $marks['activity'];
								$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];
								$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-') ? 0 : $marks['half_yearly'];

								$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks + $ia_marks;
								$marks['marks_obtained'] = ($round_off == 1) ? round($marks_obtained) : number_format($marks_obtained, 2);
								$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$marks_obtained AND CRange <= $marks_obtained");
								$marks['grade'] = $gradeData['Grade'];
								$result[$value]['sub'][$key2]['marks'] = $marks;
							} else {
								if ($term_arr == 'TERM-1') {

									// echo "<pre>";print_r($final_marks);die;
									'pt = ' . $pt_t1 = $final_marks[0];
									'nt = ' . $notebook_t1 = $final_marks[1];
									'ac = ' . $activity_t1 = $final_marks[2];
									'se = ' . $subject_enrichment_t1 = $final_marks[3];
									'hy = ' . $half_yearl_t1 = $final_marks[4];
									'sec = ' . $sec_term = $final_marks[5];
									'ia = ' . $ia_t1 = $final_marks[6];

									$pt_marks_t1 = ($pt_t1 == 'AB' || $pt_t1 == '-') ? 0 : $pt_t1;
									$ia_marks_t1 = ($ia_t1 == 'AB' || $ia_t1 == '-') ? 0 : $ia_t1;
									$notebook_marks_t1 = ($notebook_t1 == 'AB' || $notebook_t1 == '-') ? 0 : $notebook_t1;
									$activity_marks_t1 = ($activity_t1 == 'AB' || $activity_t1 == '-') ? 0 : $activity_t1;

									$se_marks_t1 = ($subject_enrichment_t1 == 'AB' || $subject_enrichment_t1 == '-') ? 0 : $subject_enrichment_t1;

									$hy_marks_t1 = ($half_yearl_t1 == 'AB' || $half_yearl_t1 == '-') ? 0 : $half_yearl_t1;

									$marks_obtained_t1 = $pt_marks_t1 + $notebook_marks_t1 + $se_marks_t1 + $hy_marks_t1 + $activity_marks_t1 + $ia_marks_t1;

									// $marks['marks_obtained_t1'] = ($round_off == 1) ? round($marks_obtained_t1) : number_format($marks_obtained_t1, 2);

								} else {
									// echo "<pre>";print_r($final_marks);die;
									$marks['pt'] = $final_marks[0];
									$marks['notebook'] = $final_marks[1];
									$marks['activity'] = $final_marks[3];
									$marks['subject_enrichment'] = $final_marks[2];
									$marks['half_yearly'] = $marks_obtained_t1;
									$marks['ia'] = $final_marks[6];
									$marks['second_term'] = $final_marks[5];

									$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
									$ia_marks = ($marks['ia'] == 'AB' || $marks['ia'] == '-') ? 0 : $marks['ia'];

									$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];

									$activity_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];

									$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];

									$second_term = ($marks['second_term'] == 'AB' || $marks['second_term'] == '-') ? 0 : $marks['second_term'];

									$marks_obtained_t2 = $pt_marks + $notebook_marks + $se_marks + $second_term + $activity_marks;
									$total_t2 = $marks_obtained_t2 + $ia_marks;

									$marks['marks_obtained_t2'] = ($round_off == 1) ? round($marks_obtained_t2) : number_format($marks_obtained_t2, 2);

									$marks['total_t2'] = ($round_off == 1) ? round($total_t2) : number_format($total_t2, 2);

									$total_marks_obtained_t2 = ($total_t2 + $marks_obtained_t1) / 2;
									$marks['total_marks_obtained_t2'] = ($round_off == 1) ? round($total_marks_obtained_t2) : number_format($total_marks_obtained_t2, 2);
									$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$total_marks_obtained_t2 AND CRange <= $total_marks_obtained_t2");
									$marks['grade'] = $gradeData['Grade'];
									$result[$value]['sub'][$key2]['marks'] = $marks;
								}
							}
						}
					}
				}
				$vlarr++;
			}



			$data['school_photo']   = $school_photo;
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['cls'] = $classs;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			//$this->load->view('report_card/report_card_cmc_pdf',$data);
			if ($class == 4 || $class == 5 || $class == 6 || $class == 7 || $class == 8 || $class == 9 || $class == 10 || $class == 11) {
				$this->load->view('report_card/report_card_cmc_pdf', $data);
			} elseif ($class == 12) {
				$this->load->view('report_card/report_card_cbsc_pdf_IX_t2', $data);
			} else {
				// $this->load->view('report_card/report_card_cbsc_pdf_IX', $data);
				$this->load->view('report_card/report_card_cbsc_pdf_XI_t2', $data);
			}
		}
	}

	public function generatePDF_t1()
	{
		$school_setting = $this->alam->select('school_setting', '*');
		$school_photo   = $this->alam->select('school_photo', '*');
		$reportCardType_data = $this->alam->select('misc_table', '*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster', '*');
		$data['signature'] = $this->alam->select('signature', '*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes', 'ExamMode', "Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
		$termId = $term;
		$round_off = $this->input->post('round_off');
		//for attendance //
		//$stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
		//$att_type     = $stu_att_type[0]->attendance_type;
		$stu_att_type = 1;
		$att_type = 1;

		//if($att_type == 1){
		//$att_data = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND att_status in('P','HD') and //att_date>'2024-04-31' and att_date<='$date'");
		//	$data['tot_working_day'] = $att_data[0]->cnt;
		//}else{
		//	$att_data = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date <= '$date'");
		//	$data['tot_working_day'] = $att_data[0]->cnt;
		//}
		//end attendance //
		$data['tot_working_day'] = 0;
		$data['tot_working_day'] = 0;
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		//echo $examode;die;
		if ($examode == 1) //diffrentiate CBSE or CMC
		{
			if ($term == 1) {
				$term = 'TERM-1';
				$examcode = array('1', '2', '3', '4', '5');
			} else {
				$term = 'TERM-2';
				$examcode = array('1', '2', '3', '5');
			}
			foreach ($adm_no as $key => $value) {

				$stu_data = $this->alam->studentDetailsByAdmissionNo($value, $termId, $classs, $sec);
				//echo $this->db->last_query();
				//echo '<pre>'; print_r($stu_data); echo '</pre>';die;
				$result[$value] = $stu_data;
				$admnum  = $stu_data['ADM_NO'];
				$class   = $stu_data['CLASS'];
				$section = $stu_data['SEC'];
				$skill_1 = $stu_data['skill_1'];
				$skill_2 = $stu_data['skill_2'];
				$skill_3 = $stu_data['skill_3'];
				$skill_5 = $stu_data['skill_5'];
				$dis_grd = $stu_data['dis_grd'];
				$diskill_1 = $stu_data['diskill_1'];
				$diskill_2 = $stu_data['diskill_2'];
				$diskill_3 = $stu_data['diskill_3'];
				$diskill_4 = $stu_data['diskill_4'];
				$rmks    = $stu_data['rmks'];
				$WORK_DAYS    = $stu_data['WORK_DAYS'];

				$subjectData = $this->alam->getClassWiseSubject($term, $class, $section);
				// echo '<pre>';
				// print_r($subjectData);
				// die;
				if ($class == '4' || $class == '6' || $class == '7' || $class == '8') {
					$result[$value]['tot_working_day'] = '107';
				} elseif ($class == '5') {
					$result[$value]['tot_working_day'] = '106';
				} elseif ($class == '9') {
					$result[$value]['tot_working_day'] = '108';
				} elseif ($class == '10' and $section == '2') {
					$result[$value]['tot_working_day'] = '108';
				} else {
					$result[$value]['tot_working_day'] = '107';
				}
				//for attendance //
				if ($att_type == 1) {
					$attPresentData = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "date(att_date) >= '2024-04-01' AND date(att_date) <='$date' AND att_status in('P','HD') AND admno='$admnum'");
					$result[$value]['tot_present_day'] = $attPresentData[0]->cnt;
					// echo $this->db->last_query();die;
				} else {
					$attPresentData = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "att_date <= '$date' AND att_status='P' AND admno='$admnum'");
					$data['tot_present_day'] = $attPresentData[0]->cnt;
				}
				//end attendance //

				foreach ($subjectData as $key2 => $val2) {

					if ($val2['opt_code'] == 2) {
						$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $value, 'Class' => $class, 'SUBCODE' => $val2['subject_code']));
					} else {
						$check_student_subject = true;
					}
					if ($check_student_subject) {
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();

						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['subject_code'] = $val2['Class_Name_Hindu_arabic'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						foreach ($examcode as $keys => $val) {

							($val == 1) ? $examC = "1,7,8" : $examC = $val;

							$marks = array();
							$tot_per = 0;

							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC', 'marks', "admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term' AND status = '1'");

							$wetageMarks = $this->sumit->fetchSingleData('wetage1', 'exammaster', array('ExamCode' => $val));
							$absent = array();
							$ab = 0;
							if ($val == 1) {
								$mark = array();
								if ($pt_type == 1) {
									foreach ($all_marks as $key4 => $value4) {
										$mark = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
										$mark = ($value4['M2'] == 'AB' || $value4['M2'] == '-') ? $value4['M2'] : $mark;
										//echo $val2['subj_nm'].'-'.$value4['M3'].'-'.$value4['M1'].'-'.$wetageMarks['wetage1'];
										//echo '<br/>';
										//echo $mark;
										//echo '<br/>';
									}
									//echo $val2['subj_nm'].'-'.$value4['M3'].'-'.$value4['M1'].'-'.$wetageMarks['wetage1'];
									//echo '<br/>';
									//echo $val2['subj_nm'].'-'.$mark;
									//echo '<br/>';
									if ($mark == 'AB' || $mark == '-') {
										$final_marks[$keys] = $mark;
									} else {
										$final_marks[$keys] = number_format($mark, 2);
									}
								} elseif ($pt_type == 2) {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
										$tot_per = $tot_per + $mark[$key4];
										$absent[$key4] = $value4['M2'];
									}
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($tot_per / 3, 2);
								} else {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
										$absent[$key4] = $value4['M2'];
									}
									rsort($mark);
									$mark[1] = isset($mark[1]) ? $mark[1] : 0;
									$mark[0] = isset($mark[0]) ? $mark[0] : 0;
									$two_sum = $mark[0] + $mark[1];
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($two_sum / 2, 2);
								}

								if ($final_marks[$keys] != 'AB' && $final_marks[$keys] != '-') {
									$final_marks[$keys] = ($round_off == 1) ? round($final_marks[$keys]) : $final_marks[$keys];
								}
								//$final_marks[$keys]=($round_off==1)?round($final_marks[$keys]):$final_marks[$keys];
							} else {
								if (!empty($all_marks)) {
									$mark = ($all_marks[0]['M3'] / $all_marks[0]['M1']) * $wetageMarks['wetage1'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-') ? $all_marks[0]['M2'] : $mark;
								} else {
									$mark = 0;
								}
								if ($mark == 'AB' || $mark == '-') {
									$final_marks[$keys] = $mark;
								} else {
									$final_marks[$keys] = ($round_off == 1) ? round($mark) : number_format($mark, 2);
								}
							}
						}


						$marks['pt'] = $final_marks[0];
						$marks['notebook'] = $final_marks[1];
						$marks['subject_enrichment'] = $final_marks[2];
						$marks['half_yearly'] = $final_marks[3];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-') ? 0 : $marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
						$marks['marks_obtained'] = ($round_off == 1) ? round($marks_obtained) : number_format($marks_obtained, 2);

						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$marks_obtained AND CRange <= $marks_obtained");

						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']         = $result;
			$data['school_setting'] = $school_setting;
			$data['school_photo']   = $school_photo;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			//echo '<pre>'; print_r($data); echo '</pre>';die;
			if ($class == 4 || $class == 5 || $class == 6 || $class == 7 || $class == 8 || $class == 9 || $class == 10 || $class == 11) {
				$this->load->view('report_card/report_card_cbsc_pdf', $data);
			} else {
				$this->load->view('report_card/report_card_cbsc_pdf_IX', $data);
			}
		} else {
			if ($term == 1) {
				$term = 'TERM-1';
				$examcode = array('1', '2', '3', '6', '4', '13');
			} else {
				$term = 'TERM-2';
				$examcode = array('1', '2', '3', '6', '5', '13');
			}
			foreach ($adm_no as $key => $value) {
				$stu_data = $this->alam->studentDetailsByAdmissionNo($value, $termId, $classs, $sec);

				$result[$value] = $stu_data;
				$admnum  = $stu_data['ADM_NO'];
				$class   = $stu_data['CLASS'];
				$section = $stu_data['SEC'];
				$skill_1 = $stu_data['skill_1'];
				$skill_2 = $stu_data['skill_2'];
				$skill_3 = $stu_data['skill_3'];
				$dis_grd = $stu_data['dis_grd'];
				$diskill_1 = $stu_data['diskill_1'];
				$diskill_2 = $stu_data['diskill_2'];
				$diskill_3 = $stu_data['diskill_3'];
				$diskill_4 = $stu_data['diskill_4'];
				$rmks    = $stu_data['rmks'];
				//echo $class;die;
				if ($class == '17' || $class == '22') {
					$result[$value]['working_day'] = '112';
				} elseif ($class == '14' || $class == '15' || $class == '18') {
					$result[$value]['working_day'] = '72';
				} elseif ($class == '20') {
					$result[$value]['working_day'] = '74';
				} elseif ($class == '12') {
					$result[$value]['working_day'] = '107';
				} elseif ($class == '19' || $class == '21') {
					$result[$value]['working_day'] = '111';
				} else {
					$result[$value]['working_day'] = '107';
				}
				$subjectData = $this->alam->getClassWiseSubject($term, $class, $section);
				//for attendance //
				if ($att_type == 1) {
					$attPresentData = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status in('P','HD') AND admno='$admnum'");
					$result[$value]['tot_present_day'] = $attPresentData[0]->cnt;
				} else {
					$attPresentData = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
					$result[$value]['tot_present_day'] = $attPresentData[0]->cnt;
				}
				//end attendance //
				foreach ($subjectData as $key2 => $val2) {

					if ($val2['opt_code'] == 2) {
						if ($class == '16' || $class == '17' || $class == '19' || $class == '21' || $class == '22') {
							$check_student_subject = $this->sumit->checkData('*', 'studentsubject_xii', array('Adm_no' => $value, 'SUBCODE' => $val2['subject_code']));
							//echo $this->db->last_query();die;
						} else {
							$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $value, 'Class' => $class, 'SUBCODE' => $val2['subject_code']));
						}
					} else {
						$check_student_subject = true;
					}
					if ($check_student_subject) {
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['subject_code'] = $val2['Class_Name_Hindu_arabic'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						foreach ($examcode as $keys => $val) {

							($val == 1) ? $examC = "1,7,8" : $examC = $val;
							$marks = array();
							$tot_per = 0;
							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC', 'marks', "admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term' AND status = '1'");
							//$str=$this->db->last_query();
							//echo $str;
							//echo '<br/>';

							$wetageMarks = $this->sumit->fetchSingleData('wetage2', 'exammaster', array('ExamCode' => $val));
							$absent = array();
							$ab = 0;
							//echo '<pre>'; print_r($all_marks); echo '</pre>';die;
							if ($val == 1) {
								$mark = array();
								if ($pt_type == 1) {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
										$absent[$key4] = $value4['M2'];
									}
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format(max($mark), 2);
								} elseif ($pt_type == 2) {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
										$tot_per = $tot_per + $mark[$key4];
										$absent[$key4] = $value4['M2'];
									}
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($tot_per / 3, 2);
								} else {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
										$absent[$key4] = $value4['M2'];
									}
									rsort($mark);
									$mark[1] = isset($mark[1]) ? $mark[1] : 0;
									$mark[0] = isset($mark[0]) ? $mark[0] : 0;
									$two_sum = $mark[0] + $mark[1];
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($two_sum / 2, 2);
								}

								($round_off == 1) ? $final_marks[$keys] = round($final_marks[$keys]) : $final_marks[$keys] = $final_marks[$keys];
							} else {
								if (!empty($all_marks)) {
									//$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];
									$mark = ($all_marks[0]['M3']);
									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-') ? $all_marks[0]['M2'] : $mark;
								} else {
									$mark = 0;
								}
								if ($mark == 'AB' || $mark == '-') {
									$final_marks[$keys] = $mark;
								} else {
									$final_marks[$keys] = ($round_off == 1) ? round($mark) : number_format($mark, 2);
								}
							}
						}

						$marks['pt'] = $final_marks[0];
						$marks['notebook'] = $final_marks[1];
						$marks['activity'] = $final_marks[2];
						$marks['subject_enrichment'] = $final_marks[3];
						$marks['half_yearly'] = $final_marks[4];
						$marks['ia'] = $final_marks[5];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
						$ia_marks = ($marks['ia'] == 'AB' || $marks['ia'] == '-') ? 0 : $marks['ia'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
						$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-') ? 0 : $marks['activity'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-') ? 0 : $marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks + $ia_marks;
						$marks['marks_obtained'] = ($round_off == 1) ? round($marks_obtained) : number_format($marks_obtained, 2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
				$vlarr++;
			}



			$data['school_photo']   = $school_photo;
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			//$this->load->view('report_card/report_card_cmc_pdf',$data);
			if ($class == 4 || $class == 5 || $class == 6 || $class == 7 || $class == 8 || $class == 9 || $class == 10 || $class == 11) {
				$this->load->view('report_card/report_card_cmc_pdf', $data);
			} else {
				//echo '<pre>';
				//print_r($data);die;
				$this->load->view('report_card/report_card_cbsc_pdf_IX', $data);
			}
		}
	}

	

	public function generatePDF_t2()
	{
		$school_setting = $this->alam->select('school_setting', '*');
		$school_photo   = $this->alam->select('school_photo', '*');
		$reportCardType_data = $this->alam->select('misc_table', '*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster', '*');
		$data['signature'] = $this->alam->select('signature', '*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes', 'ExamMode', "Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
		$termId = $term;
		$round_off = $this->input->post('round_off');

		$stu_att_type = 1;
		$att_type = 1;

		$data['tot_working_day'] = 0;
		$data['tot_working_day'] = 0;
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if ($examode == 1) //diffrentiate CBSE or CMC
		{
			if ($term == 1) {
				$term = 'TERM-1';
				$examcode = array('1', '2', '3', '4');
			} else {
				$term = 'TERM-2';
				$examcode = array('1', '2', '3', '4', '5');
			}
			// print_r($examcode);die;
			foreach ($adm_no as $key => $value) {
				$stu_data = $this->alam->studentDetailsByAdmissionNo($value, $termId);

				//echo '<pre>'; print_r($stu_data); echo '</pre>';die;
				$result[$value] = $stu_data;
				$admnum  = $stu_data['ADM_NO'];
				$class   = $stu_data['CLASS'];
				$section = $stu_data['SEC'];
				$skill_1 = $stu_data['skill_1'];
				$skill_2 = $stu_data['skill_2'];
				$skill_3 = $stu_data['skill_3'];
				$skill_5 = $stu_data['skill_5'];
				$dis_grd = $stu_data['dis_grd'];
				$diskill_1 = $stu_data['diskill_1'];
				$diskill_2 = $stu_data['diskill_2'];
				$diskill_3 = $stu_data['diskill_3'];
				$diskill_4 = $stu_data['diskill_4'];
				$rmks    = $stu_data['rmks'];
				$WORK_DAYS    = $stu_data['WORK_DAYS'];
				$subjectData = $this->alam->getClassWiseSubject($term, $class, $section);
				//for attendance //

				//end attendance //
				foreach ($subjectData as $key2 => $val2) {
					if ($val2['opt_code'] == 2) {
						$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $value, 'Class' => $class, 'SUBCODE' => $val2['subject_code']));
					} else {
						$check_student_subject = true;
					}
					if ($check_student_subject) {
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['subject_code'] = $val2['Class_Name_Hindu_arabic'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						if ($term == 1) {
							$term_array = array('TERM-1');
						} else {
							$term_array = array('TERM-1', 'TERM-2');
						}

						foreach ($term_array as $term_arr) {
							foreach ($examcode as $keys => $val) {
								($val == 1) ? $examC = "1,7,8" : $examC = $val;
								$marks = array();
								$tot_per = 0;
								$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC', 'marks', "admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term_arr' AND status = '1'");
								$wetageMarks = $this->sumit->fetchSingleData('wetage1', 'exammaster', array('ExamCode' => $val));
								$absent = array();
								$ab = 0;
								if ($val == 1) {
									$mark = array();
									if ($pt_type == 1) {
										foreach ($all_marks as $key4 => $value4) {
											$mark = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
											$mark = ($value4['M2'] == 'AB' || $value4['M2'] == '-') ? $value4['M2'] : $mark;
										}
										if ($mark == 'AB' || $mark == '-') {
											$final_marks[$keys] = $mark;
										} else {
											$final_marks[$keys] = number_format($mark, 2);
										}
									} elseif ($pt_type == 2) {
										foreach ($all_marks as $key4 => $value4) {
											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
											$tot_per = $tot_per + $mark[$key4];
											$absent[$key4] = $value4['M2'];
										}
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($tot_per / 3, 2);
									} else {
										foreach ($all_marks as $key4 => $value4) {
											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
											$absent[$key4] = $value4['M2'];
										}
										rsort($mark);
										$mark[1] = isset($mark[1]) ? $mark[1] : 0;
										$mark[0] = isset($mark[0]) ? $mark[0] : 0;
										$two_sum = $mark[0] + $mark[1];
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($two_sum / 2, 2);
									}
									if ($final_marks[$keys] != 'AB' && $final_marks[$keys] != '-') {
										$final_marks[$keys] = ($round_off == 1) ? round($final_marks[$keys]) : $final_marks[$keys];
									}
									//$final_marks[$keys]=($round_off==1)?round($final_marks[$keys]):$final_marks[$keys];
								} else {
									if (!empty($all_marks)) {
										$mark = ($all_marks[0]['M3'] / $all_marks[0]['M1']) * $wetageMarks['wetage1'];
										$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-') ? $all_marks[0]['M2'] : $mark;
									} else {
										$mark = 0;
									}
									if ($mark == 'AB' || $mark == '-') {
										$final_marks[$keys] = $mark;
									} else {
										$final_marks[$keys] = ($round_off == 1) ? round($mark) : number_format($mark, 2);
									}
								}
							}

							if ($term == 'TERM-1') {
								$marks['pt'] = $final_marks[0];
								$marks['notebook'] = $final_marks[1];
								$marks['subject_enrichment'] = $final_marks[2];
								$marks['half_yearly'] = $final_marks[3];
								$marks['second_term'] = $final_marks[4];

								$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
								$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
								$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];
								$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-') ? 0 : $marks['half_yearly'];
								$second_term = ($marks['second_term'] == 'AB' || $marks['second_term'] == '-') ? 0 : $marks['second_term'];

								$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
								$marks_ontained_t2 = $pt_marks + $notebook_marks + $se_marks + $second_term;
								$marks['marks_obtained'] = ($round_off == 1) ? round($marks_obtained) : number_format($marks_obtained, 2);
								$marks['marks_ontained_t2'] = ($round_off == 1) ? round($marks_ontained_t2) : number_format($marks_ontained_t2, 2);

								$result[$value]['sub'][$key2]['marks'] = $marks;
							} else {
								if ($term_arr == 'TERM-1') {
									// echo "<pre>";print_r($final_marks);die;
									$pt_t1 = $final_marks[0];
									$notebook_t1 = $final_marks[1];
									$subject_enrichment_t1 = $final_marks[2];
									$half_yearly = $final_marks[3];

									$pt_marks = ($pt == 'AB' || $pt == '-') ? 0 : $pt_t1;
									$notebook_t1_marks = ($notebook_t1 == 'AB' || $notebook_t1 == '-') ? 0 : $notebook_t1;
									$se_marks_t1 = ($subject_enrichment_t1 == 'AB' || $subject_enrichment_t1 == '-') ? 0 : $subject_enrichment_t1;
									$hy_marks = ($half_yearly == 'AB' || $half_yearly == '-') ? 0 : $half_yearly;

									$marks_obtained_t1 = $pt_marks + $notebook_t1_marks + $se_marks_t1 + $hy_marks;
								} else {
									$marks['pt'] = $final_marks[0];
									$marks['notebook'] = $final_marks[1];
									$marks['subject_enrichment'] = $final_marks[2];
									$marks['half_yearly'] = $marks_obtained_t1;
									$marks['second_term'] = $final_marks[4];

									$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
									$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
									$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];

									$second_term = ($marks['second_term'] == 'AB' || $marks['second_term'] == '-') ? 0 : $marks['second_term'];


									$marks_ontained_t2 = $pt_marks + $notebook_marks + $se_marks + $second_term;
									$marks['marks_obtained'] = ($round_off == 1) ? round($marks_ontained_t2) : number_format($marks_ontained_t2, 2);

									$marks['sum_term1_term2'] = ($round_off == 1) ? round(($marks_obtained_t1 + $marks_ontained_t2) / 2) : number_format(($marks_obtained_t1 + $marks_ontained_t2) / 2);


									$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$marks_ontained_t2 AND CRange <= $marks_ontained_t2");
									$marks['grade'] = $gradeData['Grade'];
									$result[$value]['sub'][$key2]['marks'] = $marks;
								}
							}
						}
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']         = $result;
			$data['school_setting'] = $school_setting;
			$data['school_photo']   = $school_photo;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';
			// die;
			if ($class == 4 || $class == 5 || $class == 6 || $class == 7 || $class == 8 || $class == 9 || $class == 10 || $class == 11) {
				// $this->load->view('report_card/report_card_cbsc_pdf', $data);
				$this->load->view('report_card/report_card_cbsc_pdf_t2', $data);
			} else {
				$this->load->view('report_card/report_card_cbsc_pdf_IX', $data);
			}
		} else {
			if ($term == 1) {
				$term = 'TERM-1';
				$examcode = array('1', '2', '3', '6', '4', '13');
			} else {
				$term = 'TERM-2';
				$examcode = array('1', '2', '3', '6', '4', '5', '13');
			}
			foreach ($adm_no as $key => $value) {
				$stu_data = $this->alam->studentDetailsByAdmissionNo_New($value, $termId, $classs, $sec);
				// echo $this->db->last_query();
				// die;
				$result[$value] = $stu_data;
				$admnum  = $stu_data['ADM_NO'];
				$class   = $stu_data['CLASS'];
				$section = $stu_data['SEC'];
				$skill_1 = $stu_data['skill_1'];
				$skill_2 = $stu_data['skill_2'];
				$skill_3 = $stu_data['skill_3'];
				$dis_grd = $stu_data['dis_grd'];
				$diskill_1 = $stu_data['diskill_1'];
				$diskill_2 = $stu_data['diskill_2'];
				$diskill_3 = $stu_data['diskill_3'];
				$diskill_4 = $stu_data['diskill_4'];
				$rmks    = $stu_data['rmks'];

				$subjectData = $this->alam->getClassWiseSubject($term, $class, $section);
				//for attendance //

				//end attendance //
				foreach ($subjectData as $key2 => $val2) {

					if ($val2['opt_code'] == 2) {
						$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $value, 'Class' => $class, 'SUBCODE' => $val2['subject_code']));
					} else {
						$check_student_subject = true;
					}
					if ($check_student_subject) {
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['subject_code'] = $val2['Class_Name_Hindu_arabic'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						if ($term == 1) {
							$term_array = array('TERM-1');
						} else {
							$term_array = array('TERM-1', 'TERM-2');
						}

						foreach ($term_array as $term_arr) {
							foreach ($examcode as $keys => $val) {
								($val == 1) ? $examC = "1,7,8" : $examC = $val;
								$marks = array();
								$tot_per = 0;
								$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC', 'marks', "admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term_arr' AND status = '1'");
								//$str=$this->db->last_query();
								//echo $str;
								//echo '<br/>';

								$wetageMarks = $this->sumit->fetchSingleData('wetage2', 'exammaster', array('ExamCode' => $val));
								$absent = array();
								$ab = 0;
								//echo '<pre>'; print_r($all_marks); echo '</pre>';die;
								if ($val == 1) {
									$mark = array();
									if ($pt_type == 1) {
										foreach ($all_marks as $key4 => $value4) {

											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
											$absent[$key4] = $value4['M2'];
										}
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format(max($mark), 2);
									} elseif ($pt_type == 2) {
										foreach ($all_marks as $key4 => $value4) {

											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
											$tot_per = $tot_per + $mark[$key4];
											$absent[$key4] = $value4['M2'];
										}
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($tot_per / 3, 2);
									} else {
										foreach ($all_marks as $key4 => $value4) {

											$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
											$absent[$key4] = $value4['M2'];
										}
										rsort($mark);
										$mark[1] = isset($mark[1]) ? $mark[1] : 0;
										$mark[0] = isset($mark[0]) ? $mark[0] : 0;
										$two_sum = $mark[0] + $mark[1];
										$absent_count = count($absent);
										$total_ab_count = array_count_values($absent);
										$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
										$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
										$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($two_sum / 2, 2);
									}

									($round_off == 1) ? $final_marks[$keys] = round($final_marks[$keys]) : $final_marks[$keys] = $final_marks[$keys];
								} else {
									if (!empty($all_marks)) {
										//$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];
										$mark = ($all_marks[0]['M3']);
										$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-') ? $all_marks[0]['M2'] : $mark;
									} else {
										$mark = 0;
									}
									if ($mark == 'AB' || $mark == '-') {
										$final_marks[$keys] = $mark;
									} else {
										$final_marks[$keys] = ($round_off == 1) ? round($mark) : number_format($mark, 2);
									}
								}
							}
							if ($term == 1) {
								$marks['pt'] = $final_marks[0];
								$marks['notebook'] = $final_marks[1];
								$marks['activity'] = $final_marks[2];
								$marks['subject_enrichment'] = $final_marks[3];
								$marks['half_yearly'] = $final_marks[4];
								$marks['ia'] = $final_marks[5];

								$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
								$ia_marks = ($marks['ia'] == 'AB' || $marks['ia'] == '-') ? 0 : $marks['ia'];
								$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
								$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-') ? 0 : $marks['activity'];
								$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];
								$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-') ? 0 : $marks['half_yearly'];

								$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks + $ia_marks;
								$marks['marks_obtained'] = ($round_off == 1) ? round($marks_obtained) : number_format($marks_obtained, 2);
								$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$marks_obtained AND CRange <= $marks_obtained");
								$marks['grade'] = $gradeData['Grade'];
								$result[$value]['sub'][$key2]['marks'] = $marks;
							} else {
								if ($term_arr == 'TERM-1') {

									// echo "<pre>";print_r($final_marks);die;
									'pt = ' . $pt_t1 = $final_marks[0];
									'nt = ' . $notebook_t1 = $final_marks[1];
									'ac = ' . $activity_t1 = $final_marks[2];
									'se = ' . $subject_enrichment_t1 = $final_marks[3];
									'hy = ' . $half_yearl_t1 = $final_marks[4];
									'sec = ' . $sec_term = $final_marks[5];
									'ia = ' . $ia_t1 = $final_marks[6];

									$pt_marks_t1 = ($pt_t1 == 'AB' || $pt_t1 == '-') ? 0 : $pt_t1;
									$ia_marks_t1 = ($ia_t1 == 'AB' || $ia_t1 == '-') ? 0 : $ia_t1;
									$notebook_marks_t1 = ($notebook_t1 == 'AB' || $notebook_t1 == '-') ? 0 : $notebook_t1;
									$activity_marks_t1 = ($activity_t1 == 'AB' || $activity_t1 == '-') ? 0 : $activity_t1;

									$se_marks_t1 = ($subject_enrichment_t1 == 'AB' || $subject_enrichment_t1 == '-') ? 0 : $subject_enrichment_t1;

									$hy_marks_t1 = ($half_yearl_t1 == 'AB' || $half_yearl_t1 == '-') ? 0 : $half_yearl_t1;

									$marks_obtained_t1 = $pt_marks_t1 + $notebook_marks_t1 + $se_marks_t1 + $hy_marks_t1 + $activity_marks_t1 + $ia_marks_t1;

									// $marks['marks_obtained_t1'] = ($round_off == 1) ? round($marks_obtained_t1) : number_format($marks_obtained_t1, 2);

								} else {
									// echo "<pre>";print_r($final_marks);die;
									$marks['pt'] = $final_marks[0];
									$marks['notebook'] = $final_marks[1];
									$marks['activity'] = $final_marks[3];
									$marks['subject_enrichment'] = $final_marks[2];
									$marks['half_yearly'] = $marks_obtained_t1;
									$marks['ia'] = $final_marks[6];
									$marks['second_term'] = $final_marks[5];

									$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
									$ia_marks = ($marks['ia'] == 'AB' || $marks['ia'] == '-') ? 0 : $marks['ia'];

									$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];

									$activity_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];

									$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];

									$second_term = ($marks['second_term'] == 'AB' || $marks['second_term'] == '-') ? 0 : $marks['second_term'];

									$marks_obtained_t2 = $pt_marks + $notebook_marks + $se_marks + $second_term + $activity_marks;
									$total_t2 = $marks_obtained_t2 + $ia_marks;

									$marks['marks_obtained_t2'] = ($round_off == 1) ? round($marks_obtained_t2) : number_format($marks_obtained_t2, 2);

									$marks['total_t2'] = ($round_off == 1) ? round($total_t2) : number_format($total_t2, 2);

									$total_marks_obtained_t2 = ($total_t2 + $marks_obtained_t1) / 2;
									$marks['total_marks_obtained_t2'] = ($round_off == 1) ? round($total_marks_obtained_t2) : number_format($total_marks_obtained_t2, 2);
									$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$total_marks_obtained_t2 AND CRange <= $total_marks_obtained_t2");
									$marks['grade'] = $gradeData['Grade'];
									$result[$value]['sub'][$key2]['marks'] = $marks;
								}
							}
						}
					}
				}
				$vlarr++;
			}



			$data['school_photo']   = $school_photo;
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			//$this->load->view('report_card/report_card_cmc_pdf',$data);
			if ($class == 4 || $class == 5 || $class == 6 || $class == 7 || $class == 8 || $class == 9 || $class == 10 || $class == 11) {
				$this->load->view('report_card/report_card_cmc_pdf', $data);
			} else {
				// echo '<pre>';print_r($data);die;
				$this->load->view('report_card/report_card_cbsc_pdf_IX', $data);
				//$this->load->view('report_card/report_card_cbsc_pdf_IX_t2', $data);
			}
		}
	}

	public function generatePDF_x()
	{

		$school_setting = $this->alam->select('school_setting', '*');
		$school_photo   = $this->alam->select('school_photo', '*');
		$reportCardType_data = $this->alam->select('misc_table', '*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster', '*');
		$data['signature'] = $this->alam->select('signature', '*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes', 'ExamMode', "Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
		$termId = $term;
		$round_off = $this->input->post('round_off');
		//for attendance //
		//$stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
		//$att_type     = $stu_att_type[0]->attendance_type;
		$stu_att_type = 1;
		$att_type = 1;
		//if($att_type == 1){
		//$att_data = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date <= '$date'");
		//	$data['tot_working_day'] = $att_data[0]->cnt;
		//}else{
		//	$att_data = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date <= '$date'");
		//		$data['tot_working_day'] = $att_data[0]->cnt;
		//	}
		//end attendance //
		$data['tot_working_day'] = 0;
		$data['tot_working_day'] = 0;
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if ($examode == 1) //diffrentiate CBSE or CMC
		{
			if ($term == 1) {
				$term = 'TERM-1';
				$examcode = array('1', '2', '3', '4');
			} else {
				$term = 'TERM-2';
				$examcode = array('1', '2', '3', '5');
			}
			foreach ($adm_no as $key => $value) {

				$stu_data = $this->alam->studentDetailsByAdmissionNo($value, $termId);

				//echo '<pre>'; print_r($stu_data); echo '</pre>';die;
				$result[$value] = $stu_data;
				$admnum  = $stu_data['ADM_NO'];
				$class   = $stu_data['CLASS'];
				$section = $stu_data['SEC'];
				$skill_1 = $stu_data['skill_1'];
				$skill_2 = $stu_data['skill_2'];
				$skill_3 = $stu_data['skill_3'];
				$skill_5 = $stu_data['skill_5'];
				$dis_grd = $stu_data['dis_grd'];
				$diskill_1 = $stu_data['diskill_1'];
				$diskill_2 = $stu_data['diskill_2'];
				$diskill_3 = $stu_data['diskill_3'];
				$diskill_4 = $stu_data['diskill_4'];
				$rmks    = $stu_data['rmks'];
				$WORK_DAYS    = $stu_data['WORK_DAYS'];
				$t2_present_days    = $stu_data['t2_present_days'];
				$t2_working_days    = $stu_data['t2_working_days'];
				$subjectData = $this->alam->getClassWiseSubject($term, $class, $section);

				//for attendance //
				if ($att_type == 1) {
					$attPresentData = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status in('P','HD') AND admno='$admnum'");
					$data['tot_present_day'] = $attPresentData[0]->cnt;
				} else {
					$attPresentData = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
					$data['tot_present_day'] = $attPresentData[0]->cnt;
				}
				//end attendance //
				foreach ($subjectData as $key2 => $val2) {

					if ($val2['opt_code'] == 2) {
						$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $value, 'Class' => $class, 'SUBCODE' => $val2['subject_code']));
					} else {
						$check_student_subject = true;
					}
					if ($check_student_subject) {
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['subject_code'] = $val2['Class_Name_Hindu_arabic'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						foreach ($examcode as $keys => $val) {

							($val == 1) ? $examC = "1,7,8" : $examC = $val;
							$marks = array();
							$tot_per = 0;
							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC', 'marks', "admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term'");

							$wetageMarks = $this->sumit->fetchSingleData('wetage1', 'exammaster', array('ExamCode' => $val));
							$absent = array();
							$ab = 0;
							if ($val == 1) {
								$mark = array();
								if ($pt_type == 1) {
									foreach ($all_marks as $key4 => $value4) {

										$mark = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
										$mark = ($value4['M2'] == 'AB' || $value4['M2'] == '-') ? $value4['M2'] : $mark;
										//echo $val2['subj_nm'].'-'.$value4['M3'].'-'.$value4['M1'].'-'.$wetageMarks['wetage1'];
										//echo '<br/>';
										//echo $mark;
										//echo '<br/>';

									}
									//echo $val2['subj_nm'].'-'.$value4['M3'].'-'.$value4['M1'].'-'.$wetageMarks['wetage1'];
									//echo '<br/>';
									//echo $val2['subj_nm'].'-'.$mark;
									//echo '<br/>';
									if ($mark == 'AB' || $mark == '-') {
										$final_marks[$keys] = $mark;
									} else {
										$final_marks[$keys] = number_format($mark, 2);
									}
								} elseif ($pt_type == 2) {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
										$tot_per = $tot_per + $mark[$key4];
										$absent[$key4] = $value4['M2'];
									}
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($tot_per / 3, 2);
								} else {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage1'];
										$absent[$key4] = $value4['M2'];
									}
									rsort($mark);
									$mark[1] = isset($mark[1]) ? $mark[1] : 0;
									$mark[0] = isset($mark[0]) ? $mark[0] : 0;
									$two_sum = $mark[0] + $mark[1];
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($two_sum / 2, 2);
								}

								if ($final_marks[$keys] != 'AB' && $final_marks[$keys] != '-') {
									$final_marks[$keys] = ($round_off == 1) ? round($final_marks[$keys]) : $final_marks[$keys];
								}
								//$final_marks[$keys]=($round_off==1)?round($final_marks[$keys]):$final_marks[$keys];
							} else {
								if (!empty($all_marks)) {
									$mark = ($all_marks[0]['M3'] / $all_marks[0]['M1']) * $wetageMarks['wetage1'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-') ? $all_marks[0]['M2'] : $mark;
								} else {
									$mark = 0;
								}
								if ($mark == 'AB' || $mark == '-') {
									$final_marks[$keys] = $mark;
								} else {
									$final_marks[$keys] = ($round_off == 1) ? round($mark) : number_format($mark, 2);
								}
							}
						}
						$marks['pt'] = $final_marks[0];
						$marks['notebook'] = $final_marks[1];
						$marks['subject_enrichment'] = $final_marks[2];
						$marks['half_yearly'] = $final_marks[3];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-') ? 0 : $marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
						$marks['marks_obtained'] = ($round_off == 1) ? round($marks_obtained) : number_format($marks_obtained, 2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']         = $result;
			$data['school_setting'] = $school_setting;
			$data['school_photo']   = $school_photo;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			// echo '<pre>'; print_r($data); echo '</pre>';die;
			if ($class == 4 || $class == 5 || $class == 6 || $class == 7 || $class == 8 || $class == 9 || $class == 10 || $class == 11) {
				$this->load->view('report_card/report_card_cbsc_pdf', $data);
			} else {
				$this->load->view('report_card/report_card_cbsc_pdf_IX', $data);
			}
		} else {
			foreach ($adm_no as $key => $value) {
				$stu_data = $this->alam->studentClassByAdmissionNo($value);
				$chk_class   = $stu_data['CLASS'];
				break; // that means the loop will only run for the first element of the $adm_no array.
			}
			//echo $chk_class;die;
			if ($term == 1) {
				$term = 'TERM-1';
				$examcode = array('1', '2', '3', '6', '4', '13');
			} else {
				if ($chk_class == 13) {
					$term = 'TERM-2';
					$examcode = array('1', '2', '3', '6', '14', '13');
				} else {
					$term = 'TERM-2';
					$examcode = array('1', '2', '3', '6', '5', '13');
				}
			}
			//echo '<pre>';
			//print_r($examcode);
			//die;
			foreach ($adm_no as $key => $value) {
				//$stu_data = $this->alam->studentDetailsByAdmissionNo($value,$termId);
				$stu_data = $this->alam->studentDetailsByAdmissionNo($value, $termId, $classs, $sec);
				$result[$value] = $stu_data;
				$admnum  = $stu_data['ADM_NO'];
				$class   = $stu_data['CLASS'];
				$section = $stu_data['SEC'];
				$skill_1 = $stu_data['skill_1'];
				$skill_2 = $stu_data['skill_2'];
				$skill_3 = $stu_data['skill_3'];
				$dis_grd = $stu_data['dis_grd'];
				$diskill_1 = $stu_data['diskill_1'];
				$diskill_2 = $stu_data['diskill_2'];
				$diskill_3 = $stu_data['diskill_3'];
				$diskill_4 = $stu_data['diskill_4'];
				$rmks    = $stu_data['rmks'];

				$subjectData = $this->alam->getClassWiseSubject($term, $class, $section);
				//for attendance //
				if ($att_type == 1) {
					$attPresentData = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status in('P','HD') AND admno='$admnum'");
					$result[$value]['tot_present_day'] = $attPresentData[0]->cnt;
				} else {
					$attPresentData = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
					$result[$value]['tot_present_day'] = $attPresentData[0]->cnt;
				}
				//end attendance //
				foreach ($subjectData as $key2 => $val2) {

					if ($val2['opt_code'] == 2) {
						$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $value, 'Class' => $class, 'SUBCODE' => $val2['subject_code']));
					} else {
						$check_student_subject = true;
					}
					if ($check_student_subject) {
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['subject_code'] = $val2['Class_Name_Hindu_arabic'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						foreach ($examcode as $keys => $val) {

							($val == 1) ? $examC = "1,7,8" : $examC = $val;
							$marks = array();
							$tot_per = 0;
							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC', 'marks', "admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term' AND status = '1'");
							//$str=$this->db->last_query();
							//echo $str;
							//echo '<br/>';

							$wetageMarks = $this->sumit->fetchSingleData('wetage2', 'exammaster', array('ExamCode' => $val));
							$absent = array();
							$ab = 0;
							//echo '<pre>'; print_r($all_marks); echo '</pre>';die;
							if ($val == 1) {
								$mark = array();
								if ($pt_type == 1) {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
										$absent[$key4] = $value4['M2'];
									}
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format(max($mark), 2);
								} elseif ($pt_type == 2) {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
										$tot_per = $tot_per + $mark[$key4];
										$absent[$key4] = $value4['M2'];
									}
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($tot_per / 3, 2);
								} else {
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3'] / $value4['M1']) * $wetageMarks['wetage2'];
										$absent[$key4] = $value4['M2'];
									}
									rsort($mark);
									$mark[1] = isset($mark[1]) ? $mark[1] : 0;
									$mark[0] = isset($mark[0]) ? $mark[0] : 0;
									$two_sum = $mark[0] + $mark[1];
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB'])) ? 0 : $total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB']) ? 'AB' : '0';
									$final_marks[$keys] = ($ab == 'AB') ? $ab : number_format($two_sum / 2, 2);
								}

								($round_off == 1) ? $final_marks[$keys] = round($final_marks[$keys]) : $final_marks[$keys] = $final_marks[$keys];
							} else {
								if (!empty($all_marks)) {
									//$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];
									$mark = ($all_marks[0]['M3']);
									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-') ? $all_marks[0]['M2'] : $mark;
								} else {
									$mark = 0;
								}
								if ($mark == 'AB' || $mark == '-') {
									$final_marks[$keys] = $mark;
								} else {
									$final_marks[$keys] = ($round_off == 1) ? round($mark) : number_format($mark, 2);
								}
							}
						}

						$marks['pt'] = $final_marks[0];
						$marks['notebook'] = $final_marks[1];
						$marks['activity'] = $final_marks[2];
						$marks['subject_enrichment'] = $final_marks[3];
						$marks['half_yearly'] = $final_marks[4];
						$marks['ia'] = $final_marks[5];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-') ? 0 : $marks['pt'];
						$ia_marks = ($marks['ia'] == 'AB' || $marks['ia'] == '-') ? 0 : $marks['ia'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-') ? 0 : $marks['notebook'];
						$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-') ? 0 : $marks['activity'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-') ? 0 : $marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-') ? 0 : $marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks + $ia_marks;
						$marks['marks_obtained'] = ($round_off == 1) ? round($marks_obtained) : number_format($marks_obtained, 2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms', 'grademaster', "ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
				$vlarr++;
			}



			$data['school_photo']   = $school_photo;
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			//$this->load->view('report_card/report_card_cmc_pdf',$data);

			if ($class == 4 || $class == 5 || $class == 6 || $class == 7 || $class == 8 || $class == 9 || $class == 10 || $class == 11) {
				$this->load->view('report_card/report_card_cmc_pdf', $data);
			} elseif ($class == 13) {
				$this->load->view('report_card/report_card_cbsc_pdf_x', $data);
			} else {
				$this->load->view('report_card/report_card_cbsc_pdf_IX', $data);
			}
		}
	}

	

	function adpdf()
	{
		$idd = $this->input->post('idd');
		$lp  = $this->input->post('lp');
		$admnoo = $this->input->post('admno');
		$admno = str_replace("/", "-", $admnoo);
		$url = base_url('assets/dash_css/bootstrap.min.css');
		$html = '';
		$html .= "<html><head><title>Report Card</title><link rel='stylesheet' href='$url'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'></script><link href='https://fonts.googleapis.com/css?family=Laila:700&display=swap' rel='stylesheet'>
		<style>
		 table tr th,td{
			font-size:12px!important;
			padding:3px!important;
		}
		@page { margin: 50px 12px 0px 12px; }
		.sign{
			font-family: 'Laila', serif;
			}
		</style>
	    </head><body><div style='border:5px solid #000; padding:10px;'>";
		$html .= $this->input->post('value');
		$html .= "</div></body></html>";
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$path = 'report_card/term1';
		if (!is_dir($path)) {
			mkdir($path, 0755, true);
			file_put_contents($path . '/' . $admno . '.pdf', $output);
		} else {
			file_put_contents($path . '/' . $admno . '.pdf', $output);
		}
		$this->alam->update('student', array('t1_report_card_status' => 1), "ADM_NO='$admnoo'");
		if ($idd == $lp) {
			$this->session->set_userdata('ref', '1');
		}
		echo $idd;
	}

	public function chksession()
	{
		if (!empty($this->session->userdata('ref'))) {
			echo $this->session->userdata('ref');
			$this->session->unset_userdata('ref');
		} else {
			echo 0;
		}
	}


	public function make_report_card_tabulation($pdf = null, $trm = null, $classs = null, $sec = null, $date = null, $round = null)
	{

		$result = array();
		$final_marks = array();
		if ($pdf == null) {
			$trm    = $this->input->post('trm');
			$classs = $this->input->post('classs');
			$sec    = $this->input->post('sec');
			$date   = $this->input->post('date');
			$round  = $this->input->post('round');
		}

		$examModedata = $this->alam->select('classes', 'ExamMode', "Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;

		if ($examode == 1) //diffrentiate CBSE or CMC
		{
			$term   = $trm;
			if ($trm == 1) {
				$trm = 'TERM-1';
				$examList = $this->alam->selectA('exammaster', '*', "ExamCode in('1','2','3','4')");
			} else {
				$trm = 'TERM-2';
				$examList = $this->alam->selectA('exammaster', '*', "ExamCode in('1','2','3','5')");
			}
			$subjectList = $this->alam->getClassWiseSubject($trm, $classs, $sec);

			//for attendance //
			$stu_att_type = $this->alam->select('student_attendance_type', '*', "class_code='$classs'");
			$att_type     = $stu_att_type[0]->attendance_type;
			if ($att_type == 1) {
				$att_data = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			} else {
				$att_data = $this->alam->select('stu_attendance_entry_periodwise', 'count(DISTINCT att_date)cnt', "class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}
			//end attendance //

			$stu_data = $this->alam->selectA('student', 'ADM_NO,ROLL_NO, `CLASS`,(SELECT ExamMode FROM classes WHERE Class_No=student.CLASS)examode,DISP_CLASS,DISP_SEC,SEC,FIRST_NM,MIDDLE_NM,Height,Weight', "CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			$this->alam->delete('temp_report_card');
			foreach ($stu_data as $key => $val) {

				$result[$val['ADM_NO']] = $val;

				foreach ($examList as $key1 => $val1) {
					$subs = 1;
					$result[$val['ADM_NO']]['exmaList'][$val1['ExamCode']] = $val1['ExamName'];
					$result[$val['ADM_NO']]['wetage'][$val1['ExamCode']] = $val1['wetage1'];
					$admnum = $val['ADM_NO'];
					foreach ($subjectList as $key2 => $val2) {

						$marks = array();
						if ($val2['opt_code'] == 2) {
							$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $val['ADM_NO'], 'Class' => $classs, 'SUBCODE' => $val2['subject_code']));
						} else {
							$check_student_subject = true;
						}

						if ($check_student_subject) {
							$examcodes = ($val1['ExamCode'] == 1) ? array(1, 7, 8) : array($val1['ExamCode']);
							$total_marks = 0;
							$total_mo = 0;
							$total_obtained_marks = 0;
							$obtained_marks = array();
							foreach ($examcodes as $key3 => $val3) {

								$marksObtained = $this->alam->getMarksWithMaxMarks($val3, 1, $classs, $val2["subject_code"], $trm, $val["ADM_NO"]);
								if ($val3 == 1 || $val3 == 7 || $val3 == 8) {
									$marksObtained['M3'] = (isset($marksObtained['M3'])) ? $marksObtained['M3'] : 0;
									$marksObtained['wetage_obt_cbse'] = (isset($marksObtained['wetage_obt_cbse'])) ? $marksObtained['wetage_obt_cbse'] : 0;
									if ($val2['pt_type'] == 1) {

										$marks[] = $marksObtained['wetage_obt_cbse'];
										$final_marks[$val2['subject_code']] = number_format(max($marks), 2);
										$obtained_marks[] = $marksObtained['M3'];
										// $total_mo = $marksObtained['M3'] + $total_mo;
										$total_mo = max($obtained_marks);
									} elseif ($val2['pt_type'] == 2) {

										$marks = $marksObtained['wetage_obt_cbse'];
										$total_marks = $total_marks + $marks;
										$final_marks[$val2['subject_code']] = $total_marks / 3;
										$total_obtained_marks += $marksObtained['M3'];
										$total_mo = $total_obtained_marks / 3;
									} else {
										$marks[$val2['subject_code']][$key3] = $marksObtained['wetage_obt_cbse'];
										$obtained_marks[] = $marksObtained['M3'];
										rsort($obtained_marks);
										rsort($marks[$val2['subject_code']]);
										if (count($marks[$val2['subject_code']]) >= 2) {
											$final_marks[$val2['subject_code']] = ($marks[$val2['subject_code']][0] + $marks[$val2['subject_code']][1]) / 2;
											$total_mo = ($obtained_marks[0] + $obtained_marks[1]) / 2;
										}
									}
								} else {
									$final_marks[$val2['subject_code']] = $marksObtained['wetage_obt_cbse'];
									$total_mo = $marksObtained['M2'];
								}

								$total_mo = ($total_mo == '') ? 0 : $total_mo;
								if (!($total_mo == 'AB' || $total_mo == '-')) {
									$total_mo = ($round == 1) ? round($total_mo) : $total_mo;
								}
								$final_marks[$val2['subject_code']] = (!isset($final_marks[$val2['subject_code']])) ? 0 : $final_marks[$val2['subject_code']];

								$final_marks[$val2['subject_code']] = ($round == 1) ? round($final_marks[$val2['subject_code']]) : number_format($final_marks[$val2['subject_code']], 2);

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = $final_marks[$val2['subject_code']];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = $total_mo;

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = $val2['opt_code'];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 1;
							} //end of exam code
						} else {
							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 0;
						}
						$subs += 1;
					}
				}
			}

			$data['allData'] = $result;
			$data['subject_list'] = $subjectList;
			$data['grade'] = $this->alam->selectA('grademaster', 'CRange,ORange,Grade,Qualitative_Norms');
			$data['trm'] = $trm;
			$data['term'] = $term;
			$data['classs'] = $classs;
			$data['sec'] = $sec;
			$data['date'] = $date;
			$data['round'] = $round;
			if ($pdf == 1) {
				return $data;
			}
			// print_r("<pre>");print_r($data);exit();
			$this->load->view('report_card/report_card_tabulation_cbse', $data);
		} else //for CMC
		{
			$term   = $trm;
			if ($trm == 1) {
				$trm = 'TERM-1';
				$examList = $this->alam->selectA('exammaster', '*', "ExamCode in('1','2','3','6','4')");
			} else {
				$trm = 'TERM-2';
				$examList = $this->alam->selectA('exammaster', '*', "ExamCode in('1','2','3','6','5')");
			}
			$subjectList = $this->alam->getClassWiseSubject($trm, $classs, $sec);

			//for attendance //
			$stu_att_type = $this->alam->select('student_attendance_type', '*', "class_code='$classs'");
			$att_type     = $stu_att_type[0]->attendance_type;
			if ($att_type == 1) {
				$att_data = $this->alam->select('stu_attendance_entry', 'count(DISTINCT att_date)cnt', "class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			} else {
				$att_data = $this->alam->select('stu_attendance_entry_periodwise', 'count(DISTINCT att_date)cnt', "class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}
			//end attendance //

			$stu_data = $this->alam->selectA('student', 'ADM_NO,ROLL_NO, `CLASS`,(SELECT ExamMode FROM classes WHERE Class_No=student.CLASS)examode,DISP_CLASS,DISP_SEC,FIRST_NM,MIDDLE_NM,Height,Weight', "CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			$this->alam->delete('temp_report_card');
			foreach ($stu_data as $key => $val) {

				$result[$val['ADM_NO']] = $val;

				foreach ($examList as $key1 => $val1) {
					$subs = 1;
					$result[$val['ADM_NO']]['exmaList'][$val1['ExamCode']] = $val1['ExamName'];
					$result[$val['ADM_NO']]['wetage'][$val1['ExamCode']] = $val1['wetage2'];
					$admnum = $val['ADM_NO'];
					foreach ($subjectList as $key2 => $val2) {

						$marks = array();
						if ($val2['opt_code'] == 2) {
							$check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $val['ADM_NO'], 'Class' => $classs, 'SUBCODE' => $val2['subject_code']));
						} else {
							$check_student_subject = true;
						}

						if ($check_student_subject) {
							$examcodes = ($val1['ExamCode'] == 1) ? array(1, 7, 8) : array($val1['ExamCode']);
							$total_marks = 0;
							$total_mo = 0;
							foreach ($examcodes as $key3 => $val3) {

								$marksObtained = $this->alam->getMarksWithMaxMarks($val3, 2, $classs, $val2["subject_code"], $trm, $val["ADM_NO"]);

								if ($val3 == 1 || $val3 == 7 || $val3 == 8) {
									if ($val2['pt_type'] == 1) {

										$marks[] = $marksObtained['wetage_obt_cmc'];
										$final_marks[$val2['subject_code']] = number_format(max($marks), 2);
									} elseif ($val2['pt_type'] == 2) {

										$marks = $marksObtained['wetage_obt_cmc'];
										$total_marks = $total_marks + $marks;
										$final_marks[$val2['subject_code']] = $total_marks / 3;
									} else {
										$marks[$val2['subject_code']][$key3] = $marksObtained['wetage_obt_cmc'];
										rsort($marks[$val2['subject_code']]);
										if (count($marks[$val2['subject_code']]) >= 2) {
											$final_marks[$val2['subject_code']] = ($marks[$val2['subject_code']][0] + $marks[$val2['subject_code']][1]) / 2;
										}
									}
									$total_mo = $marksObtained['M3'] + $total_mo;
								} else {
									$final_marks[$val2['subject_code']] = $marksObtained['wetage_obt_cmc'];
									$total_mo = $marksObtained['M2'];
								}

								$total_mo = ($total_mo == '') ? 0 : $total_mo;
								$final_marks[$val2['subject_code']] = (!isset($final_marks[$val2['subject_code']])) ? 0 : $final_marks[$val2['subject_code']];

								$final_marks[$val2['subject_code']] = ($round == 1) ? round($final_marks[$val2['subject_code']]) : number_format($final_marks[$val2['subject_code']], 2);

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = $final_marks[$val2['subject_code']];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = $total_mo;

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = $val2['opt_code'];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 1;
							}
						} else {
							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 0;
						}
						$subs += 1;
					}
				}
			}

			$data['allData'] = $result;
			$data['subject_list'] = $subjectList;
			$data['grade'] = $this->alam->selectA('grademaster', 'CRange,ORange,Grade,Qualitative_Norms');
			$data['trm'] = $trm;
			$data['term'] = $term;
			$data['classs'] = $classs;
			$data['sec'] = $sec;
			$data['date'] = $date;
			$data['round'] = $round;
			if ($pdf == 1) {
				return $data;
			}
			$this->load->view('report_card/report_card_tabulation_cmc', $data);
		}
		// echo "<pre>";
		// print_r($result);
	}

	public function tabulation_cbse_pdf($trm, $term, $classs, $sec, $date, $round)
	{
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');

		$result = $this->make_report_card_tabulation(1, $term, $classs, $sec, $date, $round);
		$data['allData'] = $result['allData'];
		$data['subject_list'] = $result['subject_list'];
		$data['grade'] = $result['grade'];

		$this->load->view('report_card/report_card_tabulation_cbse_pdf', $data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("form.pdf", array("Attachment" => 0));
	}

	public function tabulation_cmc_pdf($trm, $term, $classs, $sec, $date, $round)
	{
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');

		$result = $this->make_report_card_tabulation(1, $term, $classs, $sec, $date, $round);
		$data['allData'] = $result['allData'];
		$data['subject_list'] = $result['subject_list'];
		$data['grade'] = $result['grade'];

		$this->load->view('report_card/report_card_tabulation_cmc_pdf', $data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("form.pdf", array("Attachment" => 0));
	}


	public function generatePDF_junior()
	{
		$school_setting = $this->alam->select('school_setting', '*');
		$school_photo   = $this->alam->select('school_photo', '*');
		$data['signature'] = $this->alam->select('signature', '*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes', 'ExamMode', "Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
		$termId = $term;
		$round_off = $this->input->post('round_off');

		//echo "<pre>";
		//print_r($_POST);die;

		foreach ($adm_no as $key => $value) {

			$stu_data = $this->alam->studentDetailsByAdmissionNo_junior_new($value, $termId, $classs, $sec, $date);

			$result[$value] = $stu_data;
			$admnum  = $stu_data['ADM_NO'];
			$class   = $stu_data['CLASS'];
			$section = $stu_data['SEC'];
			$stu_name = $stu_data['STU_NAME'];
			$father_nm = $stu_data['FATHER_NM'];
			$mother_nm = $stu_data['MOTHER_NM'];
			$dob = $stu_data['BIRTH_DT'];
			$attn    = $stu_data['WORK_DAYS'];
			$rmks    = $stu_data['rmks'];
			// $date = date('Y-m-d');

			$attPresentData = 0;
			$attWorkingData = 0;
			$data['tot_present_day'] = $attPresentData[0]->cnt;
			$data['tot_working_day'] = $attWorkingData[0]->cnt;

			$subjectData = $this->alam->getClassWiseSubject_junior($class, $section);

			foreach ($subjectData as $key2 => $val2) {

				$sub_code = $val2['subject_code'];

				$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
				$result[$value]['sub'][$key2]['subject_code'] = $val2['Class_Name_Hindu_arabic'];
				$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

				$all_marks = $this->sumit->fetchAllData('M2 , type , ExamC', 'marks_junior', "admno='$value' AND Classes=$classs AND Sec=$sec  AND SCode='$sub_code' AND Term='$term'");
				// echo $this->db->last_query();
				// echo '<br>';

				$result[$value]['sub'][$key2]['marks'] = $all_marks;
			}
			// die;
		}


		$data['round_off'] = $round_off;
		$data['result']         = $result;
		$data['school_setting'] = $school_setting;
		$data['school_photo']   = $school_photo;
		$data['trm'] = $term;
		// $data['grade_only_sub'] = $stu_data['grade_only_sub'];
		// echo '<pre>'; print_r($data); echo '</pre>';die;
		// $this->load->view('report_card/report_card_junior_cbsc_pdf', $data);
		$this->load->view('report_card/report_card_junior_cbsc_pdf_t2', $data);
	}

	
	function adpdf_junior()
	{
		$idd = $this->input->post('idd');
		$lp  = $this->input->post('lp');
		$admnoo = $this->input->post('admno');
		$admno = str_replace("/", "-", $admnoo);
		$url = base_url('assets/dash_css/bootstrap.min.css');
		$html = '';
		$html .= "<html><head><title>Report Card</title><link rel='stylesheet' href='$url'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'></script><link href='https://fonts.googleapis.com/css?family=Laila:700&display=swap' rel='stylesheet'>
		<style>
		 .table{
			font-size:12px!important;
			width:100%;
			font-family:'Verdana';
		}
		.table1{
			font-size:12px!important;
			width:100%;
			border-spacing: 7px;
		}

		.table2{
			font-size:12px !important;
			width:100%;
			border-spacing:15px !important;
			border-collapse: collapse;
			border-padding:20px !important;
		}
		.table3{
			font-size:12px !important;
			width:100%;
		}	

		.border{
			border : 1px solid #000;
			padding: 0px;
			height:30px;
		}

		.underline{
			border-bottom: 0.5px solid #000;
			width: 100%;
			display: block;
		}

		@page { margin: 50px 12px 30px 12px; }
		.sign{
			font-family: 'Laila', serif;
			}

		#background{
				position:absolute;
				z-index:0;
				display:block;
				min-height:50%; 
				min-width:50%;
				opacity:0.1;
				top:15%;
		}
			
		#content{
				margin-top:-20px;
				margin-bottom:20px;
				position:absolute;
				z-index:1;
				width: 100%; 
				height: 100%;
		}
		div{
			font-family: Verdana, Geneva, Tahoma, sans-serif;
		}

		</style>
	    </head><body>
		<div id='background'><center><img src='assets/school_logo/BG_LOGO.png' width='80%' height='80%'></center></div> 
		<div id='content' style='border:5px solid #000; padding:10px;'";
		$html .= $this->input->post('value');
		$html .= "</div></body></html>";
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$path = 'report_card/term1';
		if (!is_dir($path)) {
			mkdir($path, 0755, true);
			file_put_contents($path . '/' . $admno . '.pdf', $output);
		} else {
			file_put_contents($path . '/' . $admno . '.pdf', $output);
		}
		$this->alam->update('student', array('t1_report_card_status' => 1), "ADM_NO='$admnoo'");
		if ($idd == $lp) {
			$this->session->set_userdata('ref', '1');
		}
		echo $idd;
	}
}
