<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_card_pre extends MY_controller
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

        $this->render_template('report_card_pre/report_card_term');
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


    //1
    public function report_card($trm)
    {

        if (!in_array('viewTermWiseReportCard', permission_data)) {
            redirect('payroll/dashboard/dashboard');
        }

        $class_data = $this->alam->select('classes', '*', 'Class_No IN (17,19,21,22,13)');
        $array  = array('trm' => $trm, 'class_data' => $class_data);

        //$this->render_template('report_card/report_card', $array);
        $this->render_template('report_card_pre/report_card', $array);
    }

    //2
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
            }  else {
                $this->load->view('report_card/report_card_list', $array);
            }
        } else {
            if ($classs == 1 || $classs == 2 || $classs == 3) {
                $this->load->view('report_card/report_card_list_junior', $array);
            } else {
                $this->load->view('report_card_pre/report_card_list_t1', $array);
            }
        }
    }

    //3
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
        // echo $examode;die;
        
            if ($term == 1) {
                $term = 'TERM-2';
                $examcode = array('14', '17', '16','13');
            } else {
                $term = 'TERM-2';
                $examcode = array('14', '17', '16','13');
            }
            foreach ($adm_no as $key => $value) {
                $stu_data = $this->alam->studentDetailsByAdmissionNo($value, $termId, $classs, $sec);
				//echo $this->db->last_query();die;
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
              if ($class == '17' ) {
                $result[$value]['working_day'] = '180';
            } elseif ($class == '19') {
                $result[$value]['working_day'] = '183';
            } elseif ($class == '21') {
                $result[$value]['working_day'] = '184';
            } else {
                $result[$value]['working_day'] = '190';
            }
                $subjectData = $this->alam->getClassWiseSubject($term, $class, $section);
				//echo $this->db->last_query();die;
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
                            // $str=$this->db->last_query();
                            // echo $str;
                            // echo '<br/>';

                            $wetageMarks = $this->sumit->fetchSingleData('wetage2', 'exammaster', array('ExamCode' => $val));
                            $absent = array();
                            $ab = 0;
                            // echo '<pre>'; print_r($all_marks); echo '</pre>';
                            // echo $val;
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

                        $marks['half_yearly'] = $final_marks[0];
						$marks['notebook'] = $final_marks[1];
                   		$marks['pt2'] = $final_marks[2];
                    	$marks['ia'] = $final_marks[3];
                    	$marks['activity'] = $final_marks[4];
                    	$marks['subject_enrichment'] = $final_marks[5];
                        // echo '<pre>';print_r($marks);die;
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
            if ($class == 13) {
                $this->load->view('report_card_pre/report_card_pdf_x', $data);
            } else {
                //echo '<pre>';
                //print_r($data);die;
                $this->load->view('report_card_pre/report_card_cbsc_pdf_XI_XII', $data);
            }
        
    }

    //generate cross list
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

        // echo '<pre>';print_r($_POST);die;

        $examModedata = $this->alam->select('classes', 'ExamMode', "Class_No='$classs'");
        $examode = $examModedata[0]->ExamMode;
        // echo $examode;die;
        if ($examode == 1) //diffrentiate CBSE or CMC
        {
            $term   = $trm;
            if ($trm == 1) {
                $trm = 'TERM-1';
                $examList = $this->alam->selectA('exammaster', '*', "ExamCode in('1','2','3','4')");
            } else {
                $trm = 'TERM-2';
                $examList = $this->alam->selectA('exammaster', '*', "ExamCode in('1','2','16','17')");
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
                $examList = $this->alam->selectA('exammaster', '*', "ExamCode in('14','17')");
            }
            $subjectList = $this->alam->getClassWiseSubject($trm, $classs, $sec);
            // echo '<pre>';print_r($subjectList);die;
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
                            if ($classs == '16' || $classs == '17' || $classs == '19' || $classs == '21' || $classs == '22') {
                                $check_student_subject = $this->sumit->checkData('*', 'studentsubject_xii', array('Adm_no' => $val['ADM_NO'], 'SUBCODE' => $val2['subject_code']));
                                // echo $this->db->last_query();die;
                            } else {
                                $check_student_subject = $this->sumit->checkData('*', 'studentsubject', array('Adm_no' => $val['ADM_NO'], 'Class' => $classs, 'SUBCODE' => $val2['subject_code']));
                            }
                        } else {
                            $check_student_subject = true;
                        }

                        if ($check_student_subject) {
                            $examcodes = ($val1['ExamCode'] == 1) ? array(1, 7, 8) : array($val1['ExamCode']);
                            $total_marks = 0;
                            $total_mo = 0;
                            foreach ($examcodes as $key3 => $val3) {
                                $marksObtained = $this->alam->getMarksWithMaxMarks($val3, 2, $classs, $val2["subject_code"], $trm, $val["ADM_NO"]);
                                // echo $this->db->last_query();die;
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
            $this->load->view('report_card_pre/report_card_tabulation_cmc', $data);
        }
        // echo "<pre>";
        // print_r($result);
    }
}
