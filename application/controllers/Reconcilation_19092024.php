<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reconcilation extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Mymodel', 'dbcon');
    }
    public function index()
    {
        $data['classes'] = $this->dbcon->select('classes', '*');
        $data['feehead'] = $this->dbcon->select('feehead', "act_code,fee_head");
        $data['ward'] = $this->dbcon->select('eward', "*");

        $this->fee_template('Reconcilation/index', $data);
    }
    public function calculate()
    {
        $data['clssss'] = $clss = $this->input->post('classes');
        $data['feehead'] = $feehd = $this->input->post('feehead');
        $data['ward'] = $ward = $this->input->post('ward');
        $data['month'] = $month = $this->input->post('month');

        $feehead = 'FEE' . $feehd;

        $school_setting = $this->dbcon->select('school_setting', '*');
        $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        $grand_total_pyd = 0;
        $grand_total_dues = 0;
        $grand_total_rcv = 0;


        //-------------------------APR FEES START-------------------------------//
        if ($month == 4) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-05-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,apr_fee,(select rect_date from daycoll where rect_no=student.apr_fee) as apr_rect_date,(select $feehead from daycoll where  rect_no=student.apr_fee) as apr_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_STAFF_RCV = 0;
                $apr_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,APR FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $apr_rect_no = '';
                    $check_apr_rect_no = '';

                    if ($val->apr_fee != '') {
                        $apr_rect_no = $val->apr_fee;
                        $check_apr_rect_no = substr($apr_rect_no, 1);

                        if (substr($apr_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_apr_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $apr_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $apr_rectno = "";
                                $apr_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'apr_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->apr_rect_date != '') {
                                    $apr_rectdate = date('Y-m-d', strtotime($val->apr_rect_date));
                                    if ($apr_rectdate < $end_date) {
                                        $apr_rectno = $apr_rectno;
                                        $apr_rectdate_temp = $apr_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $apr_rectno = "";
                                        $apr_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $apr_rectno = "";
                                    $apr_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $apr_rectno = "";
                                $apr_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $apr_rectno = "";
                        $apr_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'APR',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }

        //-------------------------APR FEES END-------------------------------//


        //-------------------------MAY FEES START-------------------------------//
        if ($month == 5) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-06-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,may_fee,(select rect_date from daycoll where rect_no=student.may_fee) as may_rect_date,(select $feehead from daycoll where  rect_no=student.may_fee) as may_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_STAFF_RCV = 0;
                $may_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,MAY FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $may_rect_no = '';
                    $check_may_rect_no = '';

                    if ($val->may_fee != '') {
                        $may_rect_no = $val->may_fee;
                        $check_may_rect_no = substr($may_rect_no, 1);

                        if (substr($may_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_may_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $may_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $may_rectno = "";
                                $may_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'may_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->may_rect_date != '') {
                                    $may_rectdate = date('Y-m-d', strtotime($val->may_rect_date));
                                    if ($may_rectdate < $end_date) {
                                        $may_rectno = $may_rectno;
                                        $may_rectdate_temp = $may_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $may_rectno = "";
                                        $may_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $may_rectno = "";
                                    $may_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $may_rectno = "";
                                $may_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $may_rectno = "";
                        $may_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'MAY',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------MAY FEES END-------------------------------//


        //-------------------------JUN FEES START-------------------------------//
        if ($month == 6) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-07-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,june_fee,(select rect_date from daycoll where rect_no=student.june_fee) as june_rect_date,(select $feehead from daycoll where  rect_no=student.june_fee) as june_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_STAFF_RCV = 0;
                $june_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,JUN FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $june_rect_no = '';
                    $check_june_rect_no = '';

                    if ($val->june_fee != '') {
                        $june_rect_no = $val->june_fee;
                        $check_june_rect_no = substr($june_rect_no, 1);

                        if (substr($june_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_june_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $june_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $june_rectno = "";
                                $june_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'june_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->june_rect_date != '') {
                                    $june_rectdate = date('Y-m-d', strtotime($val->june_rect_date));
                                    if ($june_rectdate < $end_date) {
                                        $june_rectno = $june_rectno;
                                        $june_rectdate_temp = $june_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $june_rectno = "";
                                        $june_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $june_rectno = "";
                                    $june_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $june_rectno = "";
                                $june_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $june_rectno = "";
                        $june_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'JUNE',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------JUN FEES END-------------------------------//


        //-------------------------JUL FEES START-------------------------------//
        if ($month == 7) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-08-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,july_fee,(select rect_date from daycoll where rect_no=student.july_fee) as july_rect_date,(select $feehead from daycoll where  rect_no=student.july_fee) as july_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;

                $july_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,JUL FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $july_rect_no = '';
                    $check_july_rect_no = '';

                    if ($val->july_fee != '') {
                        $july_rect_no = $val->july_fee;
                        $check_july_rect_no = substr($july_rect_no, 1);

                        if (substr($july_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_july_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $july_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $july_rectno = "";
                                $july_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'july_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->july_rect_date != '') {
                                    $july_rectdate = date('Y-m-d', strtotime($val->july_rect_date));
                                    if ($july_rectdate < $end_date) {
                                        $july_rectno = $july_rectno;
                                        $july_rectdate_temp = $july_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $july_rectno = "";
                                        $july_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $july_rectno = "";
                                    $july_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $july_rectno = "";
                                $july_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $july_rectno = "";
                        $july_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'JULY',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------JUL FEES END-------------------------------//


        //-------------------------AUG FEES START-------------------------------//
        if ($month == 8) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-09-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,aug_fee,(select rect_date from daycoll where rect_no=student.aug_fee) as aug_rect_date,(select $feehead from daycoll where  rect_no=student.aug_fee) as aug_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $aug_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,AUG FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->AUG == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->AUG == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $aug_rect_no = '';
                    $check_aug_rect_no = '';

                    if ($val->aug_fee != '') {
                        $aug_rect_no = $val->aug_fee;
                        $check_aug_rect_no = substr($aug_rect_no, 1);

                        if (substr($aug_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_aug_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $aug_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $aug_rectno = "";
                                $aug_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'aug_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->aug_rect_date != '') {
                                    $aug_rectdate = date('Y-m-d', strtotime($val->aug_rect_date));
                                    if ($aug_rectdate < $end_date) {
                                        $aug_rectno = $aug_rectno;
                                        $aug_rectdate_temp = $aug_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $aug_rectno = "";
                                        $aug_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $aug_rectno = "";
                                    $aug_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $aug_rectno = "";
                                $aug_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $aug_rectno = "";
                        $aug_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'AUG',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------AUG FEES END-------------------------------//


        //-------------------------SEP FEES START-------------------------------//
        if ($month == 9) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-10-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,sep_fee,(select rect_date from daycoll where rect_no=student.sep_fee) as sep_rect_date,(select $feehead from daycoll where  rect_no=student.sep_fee) as sep_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $sep_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,SEP FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->SEP == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->SEP == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->SEP == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->SEP == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->SEP == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $sep_rect_no = '';
                    $check_sep_rect_no = '';

                    if ($val->sep_fee != '') {
                        $sep_rect_no = $val->sep_fee;
                        $check_sep_rect_no = substr($sep_rect_no, 1);

                        if (substr($sep_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_sep_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $sep_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $sep_rectno = "";
                                $sep_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'sep_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->sep_rect_date != '') {
                                    $sep_rectdate = date('Y-m-d', strtotime($val->sep_rect_date));
                                    if ($sep_rectdate < $end_date) {
                                        $sep_rectno = $sep_rectno;
                                        $sep_rectdate_temp = $sep_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $sep_rectno = "";
                                        $sep_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $sep_rectno = "";
                                    $sep_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $sep_rectno = "";
                                $sep_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $sep_rectno = "";
                        $sep_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'SEP',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------SEP FEES END-------------------------------//


        //-------------------------OCT FEES START-------------------------------//
        if ($month == 10) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-11-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,oct_fee,(select rect_date from daycoll where rect_no=student.oct_fee) as oct_rect_date,(select $feehead from daycoll where  rect_no=student.oct_fee) as oct_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $oct_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,OCT FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->OCT == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->OCT == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->OCT == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->OCT == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->OCT == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $oct_rect_no = '';
                    $check_oct_rect_no = '';

                    if ($val->oct_fee != '') {
                        $oct_rect_no = $val->oct_fee;
                        $check_oct_rect_no = substr($oct_rect_no, 1);

                        if (substr($oct_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_oct_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $oct_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $oct_rectno = "";
                                $oct_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'oct_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->oct_rect_date != '') {
                                    $oct_rectdate = date('Y-m-d', strtotime($val->oct_rect_date));
                                    if ($oct_rectdate < $end_date) {
                                        $oct_rectno = $oct_rectno;
                                        $oct_rectdate_temp = $oct_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $oct_rectno = "";
                                        $oct_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $oct_rectno = "";
                                    $oct_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $oct_rectno = "";
                                $oct_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $oct_rectno = "";
                        $oct_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'OCT',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------OCT FEES END-------------------------------//


        //-------------------------NOV FEES START-------------------------------//
        if ($month == 11) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-12-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,nov_fee,(select rect_date from daycoll where rect_no=student.nov_fee) as nov_rect_date,(select $feehead from daycoll where  rect_no=student.nov_fee) as nov_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $nov_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,NOV FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->NOV == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->NOV == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->NOV == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->NOV == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->NOV == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $nov_rect_no = '';
                    $check_nov_rect_no = '';

                    if ($val->nov_fee != '') {
                        $nov_rect_no = $val->nov_fee;
                        $check_nov_rect_no = substr($nov_rect_no, 1);

                        if (substr($nov_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_nov_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $nov_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $nov_rectno = "";
                                $nov_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'nov_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->nov_rect_date != '') {
                                    $nov_rectdate = date('Y-m-d', strtotime($val->nov_rect_date));
                                    if ($nov_rectdate < $end_date) {
                                        $nov_rectno = $nov_rectno;
                                        $nov_rectdate_temp = $nov_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $nov_rectno = "";
                                        $nov_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $nov_rectno = "";
                                    $nov_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $nov_rectno = "";
                                $nov_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $nov_rectno = "";
                        $nov_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'NOV',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------NOV FEES END-------------------------------//


        //-------------------------DEC FEES START-------------------------------//
        if ($month == 12) {
            $end_date = date('Y-m-d', strtotime($new_sess . '-01-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,dec_fee,(select rect_date from daycoll where rect_no=student.dec_fee) as dec_rect_date,(select $feehead from daycoll where  rect_no=student.dec_fee) as dec_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $dec_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,DECM FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->DECM == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->DECM == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->DECM == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->DECM == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->DECM == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $dec_rect_no = '';
                    $check_dec_rect_no = '';

                    if ($val->dec_fee != '') {
                        $dec_rect_no = $val->dec_fee;
                        $check_dec_rect_no = substr($dec_rect_no, 1);

                        if (substr($dec_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_dec_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $dec_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $dec_rectno = "";
                                $dec_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'dec_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->dec_rect_date != '') {
                                    $dec_rectdate = date('Y-m-d', strtotime($val->dec_rect_date));
                                    if ($dec_rectdate < $end_date) {
                                        $dec_rectno = $dec_rectno;
                                        $dec_rectdate_temp = $dec_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $dec_rectno = "";
                                        $dec_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $dec_rectno = "";
                                    $dec_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $dec_rectno = "";
                                $dec_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $dec_rectno = "";
                        $dec_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'DEC',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------DEC FEES END-------------------------------//


        //-------------------------JAN FEES START-------------------------------//
        if ($month == 1) {
            $end_date = date('Y-m-d', strtotime($new_sess . '-02-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,jan_fee,(select rect_date from daycoll where rect_no=student.jan_fee) as jan_rect_date,(select $feehead from daycoll where  rect_no=student.jan_fee) as jan_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $jan_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,JAN FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JAN == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JAN == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JAN == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JAN == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JAN == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $jan_rect_no = '';
                    $check_jan_rect_no = '';

                    if ($val->jan_fee != '') {
                        $jan_rect_no = $val->jan_fee;
                        $check_jan_rect_no = substr($jan_rect_no, 1);

                        if (substr($jan_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_jan_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $jan_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $jan_rectno = "";
                                $jan_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'jan_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->jan_rect_date != '') {
                                    $jan_rectdate = date('Y-m-d', strtotime($val->jan_rect_date));
                                    if ($jan_rectdate < $end_date) {
                                        $jan_rectno = $jan_rectno;
                                        $jan_rectdate_temp = $jan_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $jan_rectno = "";
                                        $jan_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $jan_rectno = "";
                                    $jan_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $jan_rectno = "";
                                $jan_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $jan_rectno = "";
                        $jan_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'JAN',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------JAN FEES END-------------------------------//


        //-------------------------FEB FEES START-------------------------------//
        if ($month == 2) {
            $end_date = date('Y-m-d', strtotime($new_sess . '-03-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,feb_fee,(select rect_date from daycoll where rect_no=student.feb_fee) as feb_rect_date,(select $feehead from daycoll where  rect_no=student.feb_fee) as feb_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $feb_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,FEB FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->FEB == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->FEB == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->FEB == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->FEB == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->FEB == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $feb_rect_no = '';
                    $check_feb_rect_no = '';

                    if ($val->feb_fee != '') {
                        $feb_rect_no = $val->feb_fee;
                        $check_feb_rect_no = substr($feb_rect_no, 1);

                        if (substr($feb_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_feb_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $feb_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $feb_rectno = "";
                                $feb_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'feb_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->feb_rect_date != '') {
                                    $feb_rectdate = date('Y-m-d', strtotime($val->feb_rect_date));
                                    if ($feb_rectdate < $end_date) {
                                        $feb_rectno = $feb_rectno;
                                        $feb_rectdate_temp = $feb_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $feb_rectno = "";
                                        $feb_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $feb_rectno = "";
                                    $feb_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $feb_rectno = "";
                                $feb_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $feb_rectno = "";
                        $feb_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'FEB',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------FEB FEES END-------------------------------//


        //-------------------------MAR FEES START-------------------------------//
        if ($month == 3) {
            $end_date = date('Y-m-d', strtotime($new_sess . '-04-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,mar_fee,(select rect_date from daycoll where rect_no=student.mar_fee) as mar_rect_date,(select $feehead from daycoll where  rect_no=student.mar_fee) as mar_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $mar_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,MAR FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAR == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAR == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAR == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAR == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAR == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $mar_rect_no = '';
                    $check_mar_rect_no = '';

                    if ($val->mar_fee != '') {
                        $mar_rect_no = $val->mar_fee;
                        $check_mar_rect_no = substr($mar_rect_no, 1);

                        if (substr($mar_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_mar_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $mar_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $mar_rectno = "";
                                $mar_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'mar_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->mar_rect_date != '') {
                                    $mar_rectdate = date('Y-m-d', strtotime($val->mar_rect_date));
                                    if ($mar_rectdate < $end_date) {
                                        $mar_rectno = $mar_rectno;
                                        $mar_rectdate_temp = $mar_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $mar_rectno = "";
                                        $mar_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $mar_rectno = "";
                                    $mar_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $mar_rectno = "";
                                $mar_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $mar_rectno = "";
                        $mar_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'MAR',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------MAR FEES END-------------------------------//

        $data['GRAND_TOT_PYD'] = $grand_total_pyd;
        $data['GRAND_TOT_DUES'] = $grand_total_dues;
        $data['GRAND_TOT_RCV'] = $grand_total_rcv;


        $this->load->view('Reconcilation/calculate', $data);
    }

    public function download()
    {
        $data['class'] = $clss = $this->input->post('class');
        $data['feehead'] = $feehd = $this->input->post('feehead');
        $data['ward'] = $ward = $this->input->post('ward');
        $data['month'] = $month = $this->input->post('month');

        $feehead = 'FEE' . $feehd;

        $school_setting = $this->dbcon->select('school_setting', '*');
        $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        $grand_total_pyd = 0;
        $grand_total_dues = 0;
        $grand_total_rcv = 0;


        //-------------------------APR FEES START-------------------------------//
        if ($month == 4) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-05-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,apr_fee,(select rect_date from daycoll where rect_no=student.apr_fee) as apr_rect_date,(select $feehead from daycoll where  rect_no=student.apr_fee) as apr_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_STAFF_RCV = 0;
                $apr_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,APR FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $apr_rect_no = '';
                    $check_apr_rect_no = '';

                    if ($val->apr_fee != '') {
                        $apr_rect_no = $val->apr_fee;
                        $check_apr_rect_no = substr($apr_rect_no, 1);

                        if (substr($apr_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_apr_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $apr_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $apr_rectno = "";
                                $apr_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'apr_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->apr_rect_date != '') {
                                    $apr_rectdate = date('Y-m-d', strtotime($val->apr_rect_date));
                                    if ($apr_rectdate < $end_date) {
                                        $apr_rectno = $apr_rectno;
                                        $apr_rectdate_temp = $apr_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $apr_rectno = "";
                                        $apr_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $apr_rectno = "";
                                    $apr_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $apr_rectno = "";
                                $apr_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $apr_rectno = "";
                        $apr_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'APR',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }

        //-------------------------APR FEES END-------------------------------//


        //-------------------------MAY FEES START-------------------------------//
        if ($month == 5) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-06-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,may_fee,(select rect_date from daycoll where rect_no=student.may_fee) as may_rect_date,(select $feehead from daycoll where  rect_no=student.may_fee) as may_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_STAFF_RCV = 0;
                $may_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,MAY FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $may_rect_no = '';
                    $check_may_rect_no = '';

                    if ($val->may_fee != '') {
                        $may_rect_no = $val->may_fee;
                        $check_may_rect_no = substr($may_rect_no, 1);

                        if (substr($may_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_may_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $may_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $may_rectno = "";
                                $may_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'may_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->may_rect_date != '') {
                                    $may_rectdate = date('Y-m-d', strtotime($val->may_rect_date));
                                    if ($may_rectdate < $end_date) {
                                        $may_rectno = $may_rectno;
                                        $may_rectdate_temp = $may_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $may_rectno = "";
                                        $may_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $may_rectno = "";
                                    $may_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $may_rectno = "";
                                $may_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $may_rectno = "";
                        $may_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'MAY',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------MAY FEES END-------------------------------//


        //-------------------------JUN FEES START-------------------------------//
        if ($month == 6) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-07-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,june_fee,(select rect_date from daycoll where rect_no=student.june_fee) as june_rect_date,(select $feehead from daycoll where  rect_no=student.june_fee) as june_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_STAFF_RCV = 0;
                $june_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,JUN FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $june_rect_no = '';
                    $check_june_rect_no = '';

                    if ($val->june_fee != '') {
                        $june_rect_no = $val->june_fee;
                        $check_june_rect_no = substr($june_rect_no, 1);

                        if (substr($june_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_june_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $june_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $june_rectno = "";
                                $june_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'june_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->june_rect_date != '') {
                                    $june_rectdate = date('Y-m-d', strtotime($val->june_rect_date));
                                    if ($june_rectdate < $end_date) {
                                        $june_rectno = $june_rectno;
                                        $june_rectdate_temp = $june_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $june_rectno = "";
                                        $june_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $june_rectno = "";
                                    $june_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $june_rectno = "";
                                $june_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $june_rectno = "";
                        $june_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'JUNE',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------JUN FEES END-------------------------------//


        //-------------------------JUL FEES START-------------------------------//
        if ($month == 7) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-08-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,july_fee,(select rect_date from daycoll where rect_no=student.july_fee) as july_rect_date,(select $feehead from daycoll where  rect_no=student.july_fee) as july_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;

                $july_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,JUL FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $july_rect_no = '';
                    $check_july_rect_no = '';

                    if ($val->july_fee != '') {
                        $july_rect_no = $val->july_fee;
                        $check_july_rect_no = substr($july_rect_no, 1);

                        if (substr($july_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_july_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $july_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $july_rectno = "";
                                $july_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'july_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->july_rect_date != '') {
                                    $july_rectdate = date('Y-m-d', strtotime($val->july_rect_date));
                                    if ($july_rectdate < $end_date) {
                                        $july_rectno = $july_rectno;
                                        $july_rectdate_temp = $july_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $july_rectno = "";
                                        $july_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $july_rectno = "";
                                    $july_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $july_rectno = "";
                                $july_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $july_rectno = "";
                        $july_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'JULY',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------JUL FEES END-------------------------------//


        //-------------------------AUG FEES START-------------------------------//
        if ($month == 8) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-09-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,aug_fee,(select rect_date from daycoll where rect_no=student.aug_fee) as aug_rect_date,(select $feehead from daycoll where  rect_no=student.aug_fee) as aug_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $aug_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,AUG FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->AUG == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->AUG == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $aug_rect_no = '';
                    $check_aug_rect_no = '';

                    if ($val->aug_fee != '') {
                        $aug_rect_no = $val->aug_fee;
                        $check_aug_rect_no = substr($aug_rect_no, 1);

                        if (substr($aug_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_aug_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $aug_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $aug_rectno = "";
                                $aug_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'aug_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->aug_rect_date != '') {
                                    $aug_rectdate = date('Y-m-d', strtotime($val->aug_rect_date));
                                    if ($aug_rectdate < $end_date) {
                                        $aug_rectno = $aug_rectno;
                                        $aug_rectdate_temp = $aug_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $aug_rectno = "";
                                        $aug_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $aug_rectno = "";
                                    $aug_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $aug_rectno = "";
                                $aug_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $aug_rectno = "";
                        $aug_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'AUG',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------AUG FEES END-------------------------------//


        //-------------------------SEP FEES START-------------------------------//
        if ($month == 9) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-10-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,sep_fee,(select rect_date from daycoll where rect_no=student.sep_fee) as sep_rect_date,(select $feehead from daycoll where  rect_no=student.sep_fee) as sep_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $sep_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,SEP FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->SEP == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->SEP == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->SEP == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->SEP == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->SEP == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $sep_rect_no = '';
                    $check_sep_rect_no = '';

                    if ($val->sep_fee != '') {
                        $sep_rect_no = $val->sep_fee;
                        $check_sep_rect_no = substr($sep_rect_no, 1);

                        if (substr($sep_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_sep_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $sep_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $sep_rectno = "";
                                $sep_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'sep_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->sep_rect_date != '') {
                                    $sep_rectdate = date('Y-m-d', strtotime($val->sep_rect_date));
                                    if ($sep_rectdate < $end_date) {
                                        $sep_rectno = $sep_rectno;
                                        $sep_rectdate_temp = $sep_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $sep_rectno = "";
                                        $sep_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $sep_rectno = "";
                                    $sep_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $sep_rectno = "";
                                $sep_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $sep_rectno = "";
                        $sep_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'SEP',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------SEP FEES END-------------------------------//


        //-------------------------OCT FEES START-------------------------------//
        if ($month == 10) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-11-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,oct_fee,(select rect_date from daycoll where rect_no=student.oct_fee) as oct_rect_date,(select $feehead from daycoll where  rect_no=student.oct_fee) as oct_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $oct_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,OCT FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->OCT == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->OCT == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->OCT == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->OCT == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->OCT == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $oct_rect_no = '';
                    $check_oct_rect_no = '';

                    if ($val->oct_fee != '') {
                        $oct_rect_no = $val->oct_fee;
                        $check_oct_rect_no = substr($oct_rect_no, 1);

                        if (substr($oct_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_oct_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $oct_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $oct_rectno = "";
                                $oct_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'oct_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->oct_rect_date != '') {
                                    $oct_rectdate = date('Y-m-d', strtotime($val->oct_rect_date));
                                    if ($oct_rectdate < $end_date) {
                                        $oct_rectno = $oct_rectno;
                                        $oct_rectdate_temp = $oct_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $oct_rectno = "";
                                        $oct_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $oct_rectno = "";
                                    $oct_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $oct_rectno = "";
                                $oct_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $oct_rectno = "";
                        $oct_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'OCT',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------OCT FEES END-------------------------------//


        //-------------------------NOV FEES START-------------------------------//
        if ($month == 11) {
            $end_date = date('Y-m-d', strtotime($curr_sess . '-12-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,nov_fee,(select rect_date from daycoll where rect_no=student.nov_fee) as nov_rect_date,(select $feehead from daycoll where  rect_no=student.nov_fee) as nov_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $nov_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,NOV FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->NOV == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->NOV == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->NOV == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->NOV == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->NOV == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $nov_rect_no = '';
                    $check_nov_rect_no = '';

                    if ($val->nov_fee != '') {
                        $nov_rect_no = $val->nov_fee;
                        $check_nov_rect_no = substr($nov_rect_no, 1);

                        if (substr($nov_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_nov_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $nov_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $nov_rectno = "";
                                $nov_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'nov_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->nov_rect_date != '') {
                                    $nov_rectdate = date('Y-m-d', strtotime($val->nov_rect_date));
                                    if ($nov_rectdate < $end_date) {
                                        $nov_rectno = $nov_rectno;
                                        $nov_rectdate_temp = $nov_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $nov_rectno = "";
                                        $nov_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $nov_rectno = "";
                                    $nov_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $nov_rectno = "";
                                $nov_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $nov_rectno = "";
                        $nov_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'NOV',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------NOV FEES END-------------------------------//


        //-------------------------DEC FEES START-------------------------------//
        if ($month == 12) {
            $end_date = date('Y-m-d', strtotime($new_sess . '-01-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,dec_fee,(select rect_date from daycoll where rect_no=student.dec_fee) as dec_rect_date,(select $feehead from daycoll where  rect_no=student.dec_fee) as dec_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $dec_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,DECM FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->DECM == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->DECM == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->DECM == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->DECM == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->DECM == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $dec_rect_no = '';
                    $check_dec_rect_no = '';

                    if ($val->dec_fee != '') {
                        $dec_rect_no = $val->dec_fee;
                        $check_dec_rect_no = substr($dec_rect_no, 1);

                        if (substr($dec_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_dec_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $dec_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $dec_rectno = "";
                                $dec_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'dec_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->dec_rect_date != '') {
                                    $dec_rectdate = date('Y-m-d', strtotime($val->dec_rect_date));
                                    if ($dec_rectdate < $end_date) {
                                        $dec_rectno = $dec_rectno;
                                        $dec_rectdate_temp = $dec_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $dec_rectno = "";
                                        $dec_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $dec_rectno = "";
                                    $dec_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $dec_rectno = "";
                                $dec_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $dec_rectno = "";
                        $dec_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'DEC',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------DEC FEES END-------------------------------//


        //-------------------------JAN FEES START-------------------------------//
        if ($month == 1) {
            $end_date = date('Y-m-d', strtotime($new_sess . '-02-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,jan_fee,(select rect_date from daycoll where rect_no=student.jan_fee) as jan_rect_date,(select $feehead from daycoll where  rect_no=student.jan_fee) as jan_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $jan_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,JAN FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JAN == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JAN == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JAN == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JAN == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JAN == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $jan_rect_no = '';
                    $check_jan_rect_no = '';

                    if ($val->jan_fee != '') {
                        $jan_rect_no = $val->jan_fee;
                        $check_jan_rect_no = substr($jan_rect_no, 1);

                        if (substr($jan_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_jan_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $jan_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $jan_rectno = "";
                                $jan_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'jan_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->jan_rect_date != '') {
                                    $jan_rectdate = date('Y-m-d', strtotime($val->jan_rect_date));
                                    if ($jan_rectdate < $end_date) {
                                        $jan_rectno = $jan_rectno;
                                        $jan_rectdate_temp = $jan_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $jan_rectno = "";
                                        $jan_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $jan_rectno = "";
                                    $jan_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $jan_rectno = "";
                                $jan_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $jan_rectno = "";
                        $jan_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'JAN',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------JAN FEES END-------------------------------//


        //-------------------------FEB FEES START-------------------------------//
        if ($month == 2) {
            $end_date = date('Y-m-d', strtotime($new_sess . '-03-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,feb_fee,(select rect_date from daycoll where rect_no=student.feb_fee) as feb_rect_date,(select $feehead from daycoll where  rect_no=student.feb_fee) as feb_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $feb_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,FEB FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->FEB == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->FEB == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->FEB == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->FEB == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->FEB == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $feb_rect_no = '';
                    $check_feb_rect_no = '';

                    if ($val->feb_fee != '') {
                        $feb_rect_no = $val->feb_fee;
                        $check_feb_rect_no = substr($feb_rect_no, 1);

                        if (substr($feb_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_feb_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $feb_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $feb_rectno = "";
                                $feb_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'feb_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->feb_rect_date != '') {
                                    $feb_rectdate = date('Y-m-d', strtotime($val->feb_rect_date));
                                    if ($feb_rectdate < $end_date) {
                                        $feb_rectno = $feb_rectno;
                                        $feb_rectdate_temp = $feb_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $feb_rectno = "";
                                        $feb_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $feb_rectno = "";
                                    $feb_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $feb_rectno = "";
                                $feb_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $feb_rectno = "";
                        $feb_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'FEB',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------FEB FEES END-------------------------------//


        //-------------------------MAR FEES START-------------------------------//
        if ($month == 3) {
            $end_date = date('Y-m-d', strtotime($new_sess . '-04-01'));

            if ($clss == 'all') {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
            } else {
                $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
            }

            foreach ($class as $cls_val) {
                $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,mar_fee,(select rect_date from daycoll where rect_no=student.mar_fee) as mar_rect_date,(select $feehead from daycoll where  rect_no=student.mar_fee) as mar_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                $GEN_COUNT = 0;
                $STAFF_COUNT = 0;
                $EXT_COUNT = 0;
                $INT_COUNT = 0;
                $TOT_GEN_PYD = 0;
                $TOT_GEN_DUES = 0;
                $TOT_GEN_RCV = 0;
                $TOT_GEN_ADV = 0;
                $TOT_STAFF_RCV = 0;
                $mar_rectno = '';

                $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,MAR FROM FEEHEAD WHERE ACT_CODE=$ward")->result();


                // echo $this->db->last_query();die;
                foreach ($stu_list as $val) {
                    $adm_no = $val->ADM_NO;
                    $ward = $val->EMP_WARD;
                    $cls = $val->CLASS;

                    if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAR == 1) {

                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAR == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAR == 1) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAR == 0) {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 3) {
                            $rate = 0;
                        } else if ($ward == 4) {
                            $rate = 0;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = 0;
                            $rate = 0;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = 0;
                            $rate = 0;
                        }
                    } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAR == 0) {
                        $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $fhamt[0]->AMOUNT;
                            $rate = $fhamt[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $fhamt[0]->EMP;
                            $rate = $fhamt[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $fhamt[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $fhamt[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $fhamt[0]->EXT;
                            $rate = $fhamt[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $fhamt[0]->INTERNAL;
                            $rate = $fhamt[0]->INTERNAL;
                        }
                    } else {
                        if ($ward == 1) {
                            $GEN_COUNT = $GEN_COUNT + 1;
                            $GEN_RATE = $feehdtype[0]->AMOUNT;
                            $rate = $feehdtype[0]->AMOUNT;
                        } else if ($ward == 2) {
                            $STAFF_COUNT = $STAFF_COUNT + 1;
                            $STAFF_RATE = $feehdtype[0]->EMP;
                            $rate = $feehdtype[0]->EMP;
                        } else if ($ward == 3) {
                            $rate = $feehdtype[0]->CCL;
                        } else if ($ward == 4) {
                            $rate = $feehdtype[0]->SPL;
                        } else if ($ward == 5) {
                            $EXT_COUNT = $EXT_COUNT + 1;
                            $EXT_RATE = $feehdtype[0]->EXT;
                            $rate = $feehdtype[0]->EXT;
                        } else if ($ward == 6) {
                            $INT_COUNT = $INT_COUNT + 1;
                            $INT_RATE = $feehdtype[0]->INTERNAL;
                            $rate = $feehdtype[0]->INTERNAL;
                        }
                    }

                    $mar_rect_no = '';
                    $check_mar_rect_no = '';

                    if ($val->mar_fee != '') {
                        $mar_rect_no = $val->mar_fee;
                        $check_mar_rect_no = substr($mar_rect_no, 1);

                        if (substr($mar_rect_no, 0, 1) == 'P') {
                            $tempdaycoll = $this->db->query("SELECT RECT_DATE,$feehead FROM TEMP_DAYCOLL WHERE RECT_NO='$check_mar_rect_no' AND ADM_NO='$adm_no'")->result();

                            if ($tempdaycoll[0]->$feehead > 0) {
                                $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                $mar_rectdate_temp = date('Y-m-d', strtotime($tempdaycoll[0]->RECT_DATE));
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $mar_rectno = "";
                                $mar_rectdate_lab = "";
                            }
                        } else {
                            $amt = 0;
                            if ($amt != '') {
                                $monthhd = 'mar_' . $feehead;
                                $amt = $val->$monthhd;
                            } else {
                                $amt = 0;
                            }

                            if ($amt > 0) {
                                if ($val->mar_rect_date != '') {
                                    $mar_rectdate = date('Y-m-d', strtotime($val->mar_rect_date));
                                    if ($mar_rectdate < $end_date) {
                                        $mar_rectno = $mar_rectno;
                                        $mar_rectdate_temp = $mar_rectdate;
                                        $TOT_GEN_PYD = $TOT_GEN_PYD + $rate;
                                    } else {
                                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                        $mar_rectno = "";
                                        $mar_rectdate_temp = "";
                                    }
                                } else {
                                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                    $mar_rectno = "";
                                    $mar_rectdate_temp = "";
                                }
                            } else {
                                $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                                $mar_rectno = "";
                                $mar_rectdate_temp = "";
                            }
                        }
                    } else {
                        $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                        $mar_rectno = "";
                        $mar_rectdate_temp = "";
                    }
                }
                $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;
                $TOT_STAFF_RCV = $STAFF_COUNT * $STAFF_RATE;

                $grand_total_pyd = $grand_total_pyd + $TOT_GEN_PYD;
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
                $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                $data['classes'][$cls] = array(
                    'class' => $cls,
                    'class_nm' => $cls_val->CLASS_NM,
                    'month' => 'MAR',
                    'GEN_COUNT' => $GEN_COUNT,
                    'GEN_RATE'  => $GEN_RATE,
                    'TOT_GEN_PYD'   => $TOT_GEN_PYD,
                    'TOT_GEN_DUES'  => $TOT_GEN_DUES,
                    'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                );
            }
        }
        //-------------------------MAR FEES END-------------------------------//


        $school_setting = $this->db->query('SELECT * FROM school_setting')->result();

        $wardd = $this->db->query("SELECT HOUSENAME FROM eward WHERE HOUSENO = $ward")->result();

        $data['School_Name'] = $school_setting[0]->School_Name;
        $data['School_Address'] = $school_setting[0]->School_Address;
        $data['School_Session'] = $school_setting[0]->School_Session;
        $data['ward_nm'] = $wardd[0]->HOUSENAME;
        

        $data['GRAND_TOT_PYD'] = $grand_total_pyd;
        $data['GRAND_TOT_DUES'] = $grand_total_dues;
        $data['GRAND_TOT_RCV'] = $grand_total_rcv;


        $this->load->view('Reconcilation/download_pdf', $data);
    }
	public function advance()
    {
        $data['classes'] = $this->dbcon->select('classes', '*');
        $data['feehead'] = $this->dbcon->select('feehead', "act_code,fee_head");
        $data['ward'] = $this->dbcon->select('eward', "*");

        $this->fee_template('Reconcilation/advance_index', $data);
    }
	public function advance_calculate()
    {
        $data['feehead'] = $feehd = $this->input->post('feehead');
        $data['month'] = $mnth = $this->input->post('month');

        $feehead = 'FEE' . $feehd;

        $school_setting = $this->dbcon->select('school_setting', '*');
        $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        if ($mnth == 4) {
            $start_date = $curr_sess . '-03-31';
            $end_date = $curr_sess . '-05-01';
        } elseif ($mnth == 5) {
            $start_date = $curr_sess . '-04-30';
            $end_date = $curr_sess . '-06-01';
        } elseif ($mnth == 6) {
            $start_date = $curr_sess . '-05-31';
            $end_date = $curr_sess . '-07-01';
        } elseif ($mnth == 7) {
            $start_date = $curr_sess . '-06-30';
            $end_date = $curr_sess . '-08-01';
        } elseif ($mnth == 8) {
            $start_date = $curr_sess . '-07-31';
            $end_date = $curr_sess . '-09-01';
        } elseif ($mnth == 9) {
            $start_date = $curr_sess . '-08-31';
            $end_date = $curr_sess . '-10-01';
        } elseif ($mnth == 10) {
            $start_date = $curr_sess . '-09-30';
            $end_date = $curr_sess . '-11-01';
        } elseif ($mnth == 11) {
            $start_date = $curr_sess . '-10-31';
            $end_date = $curr_sess . '-12-01';
        } elseif ($mnth == 12) {
            $start_date = $curr_sess . '-11-30';
            $end_date = $curr_sess . '-01-01';
        } elseif ($mnth == 1) {
            $start_date = $curr_sess . '-12-31';
            $end_date = $curr_sess . '-02-01';
        } elseif ($mnth == 2) {
            $start_date = $curr_sess . '-01-30';
            $end_date = $curr_sess . '-03-01';
        } elseif ($mnth == 3) {
            $start_date = $curr_sess . '-02-30';
            $end_date = $curr_sess . '-04-01';
        }

        $daycoll_data = $this->db->query("SELECT ADM_NO,(SELECT CLASS_NO FROM CLASSES WHERE CLASS_NM = DAYCOLL.CLASS) AS CLASSS,RECT_NO,RECT_DATE,ADM_NO,PERIOD,$feehead FROM DAYCOLL WHERE DAYCOLL.RECT_DATE > '$start_date' AND DAYCOLL.RECT_DATE < '$end_date' AND DAYCOLL.ADM_NO <> 'NONE' AND $feehead <> 0 ORDER BY RECT_DATE, RECT_NO;")->result();

        $grand_total_adv = 0;
        $i = 0;

        foreach ($daycoll_data as $val) {

            $advcnt = 0;
            $tot_adv = 0;
            $rate = 0;
            $paid_mnth = 0;
            $amt = 0;

            $month = preg_split('/[-|,]/', $val->PERIOD);

            $paid_mnth = count($month);

            $amt = $val->$feehead;

            $rate = $amt / $paid_mnth;

            if ($mnth == 4) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                        $advcnt++;
                    } else if ($mnthval == 'JUN') {
                        $advcnt++;
                    } else if ($mnthval == 'JUL') {
                        $advcnt++;
                    } else if ($mnthval == 'AUG') {
                        $advcnt++;
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 5) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                        $advcnt++;
                    } else if ($mnthval == 'JUL') {
                        $advcnt++;
                    } else if ($mnthval == 'AUG') {
                        $advcnt++;
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 6) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                        $advcnt++;
                    } else if ($mnthval == 'AUG') {
                        $advcnt++;
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 7) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                        $advcnt++;
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 8) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 9) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 10) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 11) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 12) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                    } else if ($mnthval == 'DEC') {
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 1) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                    } else if ($mnthval == 'DEC') {
                    } else if ($mnthval == 'JAN') {
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 2) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                    } else if ($mnthval == 'DEC') {
                    } else if ($mnthval == 'JAN') {
                    } else if ($mnthval == 'FEB') {
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            }

            $tot_adv = $rate * $advcnt;

            if ($tot_adv > 0) {
                $data['adv_daycoll'][$i] = array(
                    'RECT_NO' => $val->RECT_NO,
                    'RECT_DATE' => $val->RECT_DATE,
                    'ADM_NO' => $val->ADM_NO,
                    'PERIOD' => $val->PERIOD,
                    'AMT' => $val->$feehead,
                    'MONTH_PAID' => $paid_mnth,
                    'MONTH_ADV' => $advcnt,
                    'RATE' => $rate,
                    'TOTAL_ADV' => $tot_adv,
                );

                $grand_total_adv = $grand_total_adv + $tot_adv;
                $i++;
            }
        }

        $data['GRAND_TOT_ADV'] = $grand_total_adv;

        $this->load->view('Reconcilation/advance_calculate', $data);
    }
	public function downloadpdf_advance()
    {

        $data['feehead'] = $feehd = $this->input->post('feehead');
        $data['month'] = $mnth = $this->input->post('month');

        $feehead = 'FEE' . $feehd;

        $school_setting = $this->dbcon->select('school_setting', '*');

        $data['School_Name'] = $school_setting[0]->School_Name;
        $data['School_Address'] = $school_setting[0]->School_Address;
        $data['School_Session'] = $school_setting[0]->School_Session;


        $data['curr_sess'] = $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $data['new_sess'] = $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        if ($mnth == 4) {
            $start_date = $curr_sess . '-03-31';
            $end_date = $curr_sess . '-05-01';
        } elseif ($mnth == 5) {
            $start_date = $curr_sess . '-04-30';
            $end_date = $curr_sess . '-06-01';
        } elseif ($mnth == 6) {
            $start_date = $curr_sess . '-05-31';
            $end_date = $curr_sess . '-07-01';
        } elseif ($mnth == 7) {
            $start_date = $curr_sess . '-06-30';
            $end_date = $curr_sess . '-08-01';
        } elseif ($mnth == 8) {
            $start_date = $curr_sess . '-07-31';
            $end_date = $curr_sess . '-09-01';
        } elseif ($mnth == 9) {
            $start_date = $curr_sess . '-08-31';
            $end_date = $curr_sess . '-10-01';
        } elseif ($mnth == 10) {
            $start_date = $curr_sess . '-09-30';
            $end_date = $curr_sess . '-11-01';
        } elseif ($mnth == 11) {
            $start_date = $curr_sess . '-10-31';
            $end_date = $curr_sess . '-12-01';
        } elseif ($mnth == 12) {
            $start_date = $curr_sess . '-11-30';
            $end_date = $curr_sess . '-01-01';
        } elseif ($mnth == 1) {
            $start_date = $curr_sess . '-12-31';
            $end_date = $curr_sess . '-02-01';
        } elseif ($mnth == 2) {
            $start_date = $curr_sess . '-01-30';
            $end_date = $curr_sess . '-03-01';
        } elseif ($mnth == 3) {
            $start_date = $curr_sess . '-02-30';
            $end_date = $curr_sess . '-04-01';
        }

        $daycoll_data = $this->db->query("SELECT ADM_NO,(SELECT CLASS_NO FROM CLASSES WHERE CLASS_NM = DAYCOLL.CLASS) AS CLASSS,RECT_NO,RECT_DATE,ADM_NO,PERIOD,$feehead FROM DAYCOLL WHERE DAYCOLL.RECT_DATE > '$start_date' AND DAYCOLL.RECT_DATE < '$end_date' AND DAYCOLL.ADM_NO <> 'NONE' AND $feehead <> 0 ORDER BY RECT_DATE, RECT_NO;")->result();

        $grand_total_adv = 0;
        $i = 0;

        foreach ($daycoll_data as $val) {

            $advcnt = 0;
            $tot_adv = 0;
            $rate = 0;
            $paid_mnth = 0;
            $amt = 0;

            $month = preg_split('/[-|,]/', $val->PERIOD);

            $paid_mnth = count($month);

            $amt = $val->$feehead;

            $rate = $amt / $paid_mnth;

            if ($mnth == 4) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                        $advcnt++;
                    } else if ($mnthval == 'JUN') {
                        $advcnt++;
                    } else if ($mnthval == 'JUL') {
                        $advcnt++;
                    } else if ($mnthval == 'AUG') {
                        $advcnt++;
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 5) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                        $advcnt++;
                    } else if ($mnthval == 'JUL') {
                        $advcnt++;
                    } else if ($mnthval == 'AUG') {
                        $advcnt++;
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 6) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                        $advcnt++;
                    } else if ($mnthval == 'AUG') {
                        $advcnt++;
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 7) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                        $advcnt++;
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 8) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                        $advcnt++;
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 9) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                        $advcnt++;
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 10) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                        $advcnt++;
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 11) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                    } else if ($mnthval == 'DEC') {
                        $advcnt++;
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 12) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                    } else if ($mnthval == 'DEC') {
                    } else if ($mnthval == 'JAN') {
                        $advcnt++;
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 1) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                    } else if ($mnthval == 'DEC') {
                    } else if ($mnthval == 'JAN') {
                    } else if ($mnthval == 'FEB') {
                        $advcnt++;
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            } elseif ($mnth == 2) {
                foreach ($month as $mnthval) {
                    if ($mnthval == 'APR') {
                    } else if ($mnthval == 'MAY') {
                    } else if ($mnthval == 'JUN') {
                    } else if ($mnthval == 'JUL') {
                    } else if ($mnthval == 'AUG') {
                    } else if ($mnthval == 'SEP') {
                    } else if ($mnthval == 'OCT') {
                    } else if ($mnthval == 'NOV') {
                    } else if ($mnthval == 'DEC') {
                    } else if ($mnthval == 'JAN') {
                    } else if ($mnthval == 'FEB') {
                    } else if ($mnthval == 'MAR') {
                        $advcnt++;
                    }
                }
            }

            $tot_adv = $rate * $advcnt;

            if ($tot_adv > 0) {
                $data['adv_daycoll'][$i] = array(
                    'RECT_NO' => $val->RECT_NO,
                    'RECT_DATE' => $val->RECT_DATE,
                    'ADM_NO' => $val->ADM_NO,
                    'PERIOD' => $val->PERIOD,
                    'AMT' => $val->$feehead,
                    'MONTH_PAID' => $paid_mnth,
                    'MONTH_ADV' => $advcnt,
                    'RATE' => $rate,
                    'TOTAL_ADV' => $tot_adv,
                );

                $grand_total_adv = $grand_total_adv + $tot_adv;
                $i++;
            }
        }

        $data['GRAND_TOT_ADV'] = $grand_total_adv;

        $this->load->view('Reconcilation/download_pdf_adv', $data);
    }
	
	public function dues()
    {
        ini_set('max_execution_time', 0);
        $data['feehead'] = $this->dbcon->select('feehead', "act_code,fee_head");

        $school_setting = $this->dbcon->select('school_setting', '*');
        $data['current_year'] = $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $data['next_year'] = $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        $this->fee_template('Reconcilation/dues_index', $data);
    }
	
	 public function dues_calculate()
    {
        ini_set('max_execution_time', 0);
        $data['feehead'] = $feehd = $this->input->post('feehead');
        $data['month'] = $mnth = $this->input->post('month');

        $feehead = 'FEE' . $feehd;

        $date = explode('-', $mnth);
        $month = $date[0];
        $year = $date[1];

        $school_setting = $this->dbcon->select('school_setting', '*');
        $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        $grand_total_dues = 0;

        if ($month == 4) {
            $end_date = $curr_sess . '-05-01';
        } elseif ($month == 5) {
            $end_date = $curr_sess . '-06-01';
        } elseif ($month == 6) {
            $end_date = $curr_sess . '-07-01';
        } elseif ($month == 7) {
            $end_date = $curr_sess . '-08-01';
        } elseif ($month == 8) {
            $end_date = $curr_sess . '-09-01';
        } elseif ($month == 9) {
            $end_date = $curr_sess . '-10-01';
        } elseif ($month == 10) {
            $end_date = $curr_sess . '-11-01';
        } elseif ($month == 11) {
            $end_date = $curr_sess . '-12-01';
        } elseif ($month == 12) {
            $end_date = $new_sess . '-01-01';
        } elseif ($month == 1) {
            $end_date = $new_sess . '-02-01';
        } elseif ($month == 2) {
            $end_date = $new_sess . '-03-01';
        } elseif ($month == 3) {
            $end_date = $new_sess . '-04-01';
        }


        $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
        $i = 1;
        foreach ($class as $cls_val) {

            // $stu_list = $this->db->query("SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name,APR_FEE,(SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)AS APR_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK,SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) HAVING APR_FEE_CHK ='N/A' ORDER BY CLASS")->result();

            if ($month == 4) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK,SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.APR_FEE_CHK='N/A';")->result();
            } else if ($month == 5) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.MAY_FEE_CHK='N/A';")->result();
            } else if ($month == 6) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.JUN_FEE_CHK='N/A';")->result();
            } else if ($month == 7) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.JUL_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JUL_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.JUL_FEE_CHK='N/A';")->result();
            } else if ($month == 8) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.JUL_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JUL_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.AUG_FEE_CHK='N/A';")->result();
            } else if ($month == 9) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.JUL_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JUL_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.SEP_FEE)>='$end_date','N/A',STUDENT.SEP_FEE) AS SEP_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.SEP_FEE_CHK='N/A';")->result();
            } else if ($month == 10) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.JUL_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JUL_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.SEP_FEE)>='$end_date','N/A',STUDENT.SEP_FEE) AS SEP_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.OCT_FEE)>='$end_date','N/A',STUDENT.OCT_FEE) AS OCT_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.OCT_FEE_CHK='N/A';")->result();
            } else if ($month == 11) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.JUL_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JUL_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.SEP_FEE)>='$end_date','N/A',STUDENT.SEP_FEE) AS SEP_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.OCT_FEE)>='$end_date','N/A',STUDENT.OCT_FEE) AS OCT_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.NOV_FEE)>='$end_date','N/A',STUDENT.NOV_FEE) AS NOV_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.NOV_FEE_CHK='N/A';")->result();
            } else if ($month == 12) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.JUL_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JUL_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.SEP_FEE)>='$end_date','N/A',STUDENT.SEP_FEE) AS SEP_FEE_CHK,IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.OCT_FEE)>='$end_date','N/A',STUDENT.OCT_FEE) AS OCT_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.NOV_FEE)>='$end_date','N/A',STUDENT.NOV_FEE) AS NOV_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.DEC_FEE)>='$end_date','N/A',STUDENT.DEC_FEE) AS DEC_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.DEC_FEE_CHK='N/A';")->result();
            } else if ($month == 1) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.JUL_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JUL_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.SEP_FEE)>='$end_date','N/A',STUDENT.SEP_FEE) AS SEP_FEE_CHK,IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.OCT_FEE)>='$end_date','N/A',STUDENT.OCT_FEE) AS OCT_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.NOV_FEE)>='$end_date','N/A',STUDENT.NOV_FEE) AS NOV_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.DEC_FEE)>='$end_date','N/A',STUDENT.DEC_FEE) AS DEC_FEE_CHK,  IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JAN_FEE)>='$end_date','N/A',STUDENT.JAN_FEE) AS JAN_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.JAN_FEE_CHK='N/A';")->result();
            } else if ($month == 2) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.JUL_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JUL_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.SEP_FEE)>='$end_date','N/A',STUDENT.SEP_FEE) AS SEP_FEE_CHK,IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.OCT_FEE)>='$end_date','N/A',STUDENT.OCT_FEE) AS OCT_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.NOV_FEE)>='$end_date','N/A',STUDENT.NOV_FEE) AS NOV_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.DEC_FEE)>='$end_date','N/A',STUDENT.DEC_FEE) AS DEC_FEE_CHK,  IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JAN_FEE)>='$end_date','N/A',STUDENT.JAN_FEE) AS JAN_FEE_CHK,  IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.FEB_FEE)>='$end_date','N/A',STUDENT.FEB_FEE) AS FEB_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.FEB_FEE_CHK='N/A';")->result();
            } else if ($month == 3) {
                $stu_list = $this->db->query("SELECT T1. ADM_NO,T1.STU_NAME,T1.APR_FEE_CHK,T1.MAY_FEE_CHK,T1.JUN_FEE_CHK,T1.JUL_FEE_CHK,T1.SCHOLAR FROM (SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUN_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JUL_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.SEP_FEE)>='$end_date','N/A',STUDENT.SEP_FEE) AS SEP_FEE_CHK,IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.OCT_FEE)>='$end_date','N/A',STUDENT.OCT_FEE) AS OCT_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.NOV_FEE)>='$end_date','N/A',STUDENT.NOV_FEE) AS NOV_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.DEC_FEE)>='$end_date','N/A',STUDENT.DEC_FEE) AS DEC_FEE_CHK,  IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JAN_FEE)>='$end_date','N/A',STUDENT.JAN_FEE) AS JAN_FEE_CHK,  IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.FEB_FEE)>='$end_date','N/A',STUDENT.FEB_FEE) AS FEB_FEE_CHK, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAR_FEE)>='$end_date','N/A',STUDENT.MAR_FEE) AS MAR_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) ORDER BY CLASS) AS T1 WHERE T1.MAR_FEE_CHK='N/A';")->result();
            }

            $GEN_COUNT = 0;
            $DUES_COUNT = 0;
            $TOT_GEN_DUES = 0;


            $cls = $cls_val->Class_No;

            foreach ($stu_list as $val) {
                $UNPAID_MONTH = '';
                $NO_UNPAID_MONTH = 0;
                $adm_no = '';
                $adm_no = $val->adm_no;
                $ward = 1;
                $rate = 0;
                $tot_dues = 0;
                $month_nm = '';

                if ($month == 4) {
                    $month_nm = "'APR'";
                } else if ($month == 5) {
                    if ($val->MAY_FEE_CHK == 'N/A') {
                        $month_nm = "'MAY'";
                    }
                    if ($val->APR_FEE_CHK == 'N/A') {
                        $month_nm = "'APR'," . $month_nm;
                    }
                } else if ($month == 6) {
                    if ($val->JUN_FEE_CHK == 'N/A') {
                        $month_nm = "'JUN'";
                    }
                    if ($val->MAY_FEE_CHK == 'N/A') {
                        $month_nm = "'MAY'," . $month_nm;
                    }
                    if ($val->APR_FEE_CHK == 'N/A') {
                        $month_nm = "'APR'," . $month_nm;
                    }
                } else if ($month == 7) {

                    if ($val->JUL_FEE_CHK == 'N/A') {
                        $month_nm = "'JUL'";
                    }
                    if ($val->JUN_FEE_CHK == 'N/A') {
                        $month_nm = "'JUN'," . $month_nm;
                    }
                    if ($val->MAY_FEE_CHK == 'N/A') {
                        $month_nm = "'MAY'," . $month_nm;
                    }
                    if ($val->APR_FEE_CHK == 'N/A') {
                        $month_nm = "'APR'," . $month_nm;
                    }
                } else if ($month == 8) {
                    if ($val->AUG_FEE_CHK == 'N/A') {
                        $month_nm = "'AUG'";
                    }
                    if ($val->JUL_FEE_CHK == 'N/A') {
                        $month_nm = "'JUL'," . $month_nm;
                    }
                    if ($val->JUN_FEE_CHK == 'N/A') {
                        $month_nm = "'JUN'," . $month_nm;
                    }
                    if ($val->MAY_FEE_CHK == 'N/A') {
                        $month_nm = "'MAY'," . $month_nm;
                    }
                    if ($val->APR_FEE_CHK == 'N/A') {
                        $month_nm = "'APR'," . $month_nm;
                    }
                } else if ($month == 9) {
                    if ($val->SEP_FEE_CHK == 'N/A') {
                        $month_nm = "'SEP'";
                    }
                    if ($val->AUG_FEE_CHK == 'N/A') {
                        $month_nm = "'AUG'," . $month_nm;
                    }
                    if ($val->JUL_FEE_CHK == 'N/A') {
                        $month_nm = "'JUL'," . $month_nm;
                    }
                    if ($val->JUN_FEE_CHK == 'N/A') {
                        $month_nm = "'JUN'," . $month_nm;
                    }
                    if ($val->MAY_FEE_CHK == 'N/A') {
                        $month_nm = "'MAY'," . $month_nm;
                    }
                    if ($val->APR_FEE_CHK == 'N/A') {
                        $month_nm = "'APR'," . $month_nm;
                    }
                } else if ($month == 10) {
                    if ($val->SEP_FEE_CHK == 'N/A') {
                        $month_nm = "'OCT'";
                    }
                    if ($val->SEP_FEE_CHK == 'N/A') {
                        $month_nm = "'SEP'," . $month_nm;
                    }
                    if ($val->AUG_FEE_CHK == 'N/A') {
                        $month_nm = "'AUG'" . $month_nm;
                    }
                    if ($val->JUL_FEE_CHK == 'N/A') {
                        $month_nm = "'JUL'," . $month_nm;
                    }
                    if ($val->JUN_FEE_CHK == 'N/A') {
                        $month_nm = "'JUN'," . $month_nm;
                    }
                    if ($val->MAY_FEE_CHK == 'N/A') {
                        $month_nm = "'MAY'," . $month_nm;
                    }
                    if ($val->APR_FEE_CHK == 'N/A') {
                        $month_nm = "'APR'," . $month_nm;
                    }
                }

                if ($month_nm != '') {
                    $month_nm = trim($month_nm, ',');

                    $feehdamt = $this->db->query("SELECT sum(fee1)tot,fee1 FROM `feegeneration` where adm_no='$adm_no' AND MONTH_NM IN ($month_nm)")->result();
                    $rate = $feehdamt[0]->fee1;
                    $tot_dues = $feehdamt[0]->tot;
                    $UNPAID_MONTH = preg_replace("/[']/", '', $month_nm);
                    $NO_UNPAID_MONTH = count(preg_split("/[,]/", $month_nm));


                    $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
                    // $DUES_COUNT  = $DUES_COUNT + 1;


                    $data['classes'][$i] = [
                        'class' => $cls,
                        'class_nm' => $cls_val->CLASS_NM,
                        'ADM_NO' => $adm_no,
                        'STU_NAME' => $val->stu_name,
                        'UNPAID_MONTH' => $UNPAID_MONTH,
                        'NO_UNPAID_MONTH' => $NO_UNPAID_MONTH,
                        'RATE' => $rate,
                        'TOT_DUES' => $tot_dues
                    ];

                    $i = $i + 1;
                }
            }



            if ($TOT_GEN_DUES > 0) {
                $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
            }
        }

        $data['GRAND_TOT_DUES'] = $grand_total_dues;

        //-------------------------APR FEES ENDS-------------------------------//
        //-------------------------MAY FEES START-------------------------------//
        // else if ($month == 5) {

        //     $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
        //     $i = 1;
        //     foreach ($class as $cls_val) {

        //         $stu_list = $this->db->query("SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, APR_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)AS APR_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, MAY_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)AS MAY_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK, SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) HAVING MAY_FEE_CHK = 'N/A' ORDER BY CLASS;")->result();

        //         $GEN_COUNT = 0;
        //         $DUES_COUNT = 0;
        //         $TOT_GEN_DUES = 0;


        //         $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,APR,MAY FROM FEEHEAD WHERE ACT_CODE=1")->result();

        //         $cls = $cls_val->Class_No;

        //         foreach ($stu_list as $val) {
        //             $NO_UNPAID_MONTH = 0;
        //             $UNPAID_MONTH = '';
        //             $adm_no = '';
        //             $adm_no = $val->adm_no;
        //             $ward = 1;
        //             $rate = 0;



        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->APR_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;

        //                 $UNPAID_MONTH = 'APR';
        //                 $NO_UNPAID_MONTH = 1;
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->MAY_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'MAY';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', MAY';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $data['classes'][$i] = [
        //                 'class' => $cls,
        //                 'class_nm' => $cls_val->CLASS_NM,
        //                 'ADM_NO' => $adm_no,
        //                 'STU_NAME' => $val->stu_name,
        //                 'UNPAID_MONTH' => $UNPAID_MONTH,
        //                 'NO_UNPAID_MONTH' => $NO_UNPAID_MONTH,
        //                 'RATE' => $rate,
        //             ];


        //             $i = $i + 1;
        //         }


        //         if ($TOT_GEN_DUES > 0) {
        //             $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
        //         }
        //     }
        //     // echo '<pre>';print_r($data);die;
        //     $data['GRAND_TOT_DUES'] = $grand_total_dues;
        // }
        //-------------------------MAY FEES END-------------------------------//

        //-------------------------JUN FEES START-------------------------------//
        // else if ($month == 6) {

        //     $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
        //     $i = 1;
        //     foreach ($class as $cls_val) {

        //         $stu_list = $this->db->query("SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name, APR_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)AS APR_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, MAY_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)AS MAY_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK,
        //         JUNE_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)AS JUNE_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUNE_FEE_CHK,
        //         SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) HAVING JUNE_FEE_CHK = 'N/A' ORDER BY CLASS;")->result();

        //         $GEN_COUNT = 0;
        //         $DUES_COUNT = 0;
        //         $TOT_GEN_DUES = 0;


        //         $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,APR,MAY,JUN FROM FEEHEAD WHERE ACT_CODE=1")->result();

        //         $cls = $cls_val->Class_No;

        //         foreach ($stu_list as $val) {
        //             $NO_UNPAID_MONTH = 0;
        //             $UNPAID_MONTH = '';
        //             $adm_no = '';
        //             $adm_no = $val->adm_no;
        //             $ward = 1;
        //             $rate = 0;



        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->APR_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;

        //                 $UNPAID_MONTH = 'APR';
        //                 $NO_UNPAID_MONTH = 1;
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->MAY_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'MAY';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', MAY';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->JUNE_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'JUN';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', JUN';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $data['classes'][$i] = [
        //                 'class' => $cls,
        //                 'class_nm' => $cls_val->CLASS_NM,
        //                 'ADM_NO' => $adm_no,
        //                 'STU_NAME' => $val->stu_name,
        //                 'UNPAID_MONTH' => $UNPAID_MONTH,
        //                 'NO_UNPAID_MONTH' => $NO_UNPAID_MONTH,
        //                 'RATE' => $rate,
        //             ];


        //             $i = $i + 1;
        //         }


        //         if ($TOT_GEN_DUES > 0) {
        //             $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
        //         }
        //     }
        //     // echo '<pre>';print_r($data);die;
        //     $data['GRAND_TOT_DUES'] = $grand_total_dues;
        // }
        //-------------------------JUN FEES END-------------------------------//

        //-------------------------JUL FEES START-------------------------------//
        // else if ($month == 7) {

        //     $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
        //     $i = 1;
        //     foreach ($class as $cls_val) {

        //         $stu_list = $this->db->query("SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name,
        //         APR_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)AS APR_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, MAY_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)AS MAY_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK,
        //         JUNE_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)AS JUNE_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUNE_FEE_CHK,
        //         JULY_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)AS JULY_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JULY_FEE_CHK,
        //         SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) HAVING JULY_FEE_CHK = 'N/A' ORDER BY CLASS;")->result();

        //         $GEN_COUNT = 0;
        //         $DUES_COUNT = 0;
        //         $TOT_GEN_DUES = 0;


        //         $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,APR,MAY,JUN,JUL FROM FEEHEAD WHERE ACT_CODE=1")->result();

        //         $cls = $cls_val->Class_No;

        //         foreach ($stu_list as $val) {
        //             $NO_UNPAID_MONTH = 0;
        //             $UNPAID_MONTH = '';
        //             $adm_no = '';
        //             $adm_no = $val->adm_no;
        //             $ward = 1;
        //             $rate = 0;



        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->APR_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;

        //                 $UNPAID_MONTH = 'APR';
        //                 $NO_UNPAID_MONTH = 1;
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->MAY_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'MAY';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', MAY';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->JUNE_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'JUN';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', JUN';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }


        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->JULY_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'JUL';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', JUL';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $data['classes'][$i] = [
        //                 'class' => $cls,
        //                 'class_nm' => $cls_val->CLASS_NM,
        //                 'ADM_NO' => $adm_no,
        //                 'STU_NAME' => $val->stu_name,
        //                 'UNPAID_MONTH' => $UNPAID_MONTH,
        //                 'NO_UNPAID_MONTH' => $NO_UNPAID_MONTH,
        //                 'RATE' => $rate,
        //             ];


        //             $i = $i + 1;
        //         }


        //         if ($TOT_GEN_DUES > 0) {
        //             $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
        //         }
        //     }
        //     // echo '<pre>';print_r($data);die;
        //     $data['GRAND_TOT_DUES'] = $grand_total_dues;
        // }
        //-------------------------JUL FEES END-------------------------------//

        //-------------------------AUG FEES START-------------------------------//
        // else if ($month == 8) {

        //     $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
        //     $i = 1;
        //     foreach ($class as $cls_val) {

        //         $stu_list = $this->db->query("SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name,
        //         APR_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)AS APR_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, 
        //         MAY_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)AS MAY_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK,
        //         JUNE_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)AS JUNE_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUNE_FEE_CHK,
        //         JULY_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)AS JULY_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JULY_FEE_CHK,
        //         AUG_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)AS AUG_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK,
        //         SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) HAVING AUG_FEE_CHK = 'N/A' ORDER BY CLASS;")->result();

        //         $GEN_COUNT = 0;
        //         $DUES_COUNT = 0;
        //         $TOT_GEN_DUES = 0;


        //         $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,APR,MAY,JUN,JUL,AUG FROM FEEHEAD WHERE ACT_CODE=1")->result();

        //         $cls = $cls_val->Class_No;

        //         foreach ($stu_list as $val) {
        //             $NO_UNPAID_MONTH = 0;
        //             $UNPAID_MONTH = '';
        //             $adm_no = '';
        //             $adm_no = $val->adm_no;
        //             $ward = 1;
        //             $rate = 0;



        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->APR_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;

        //                 $UNPAID_MONTH = 'APR';
        //                 $NO_UNPAID_MONTH = 1;
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->MAY_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'MAY';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', MAY';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->JUNE_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'JUN';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', JUN';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }


        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->JULY_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'JUL';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', JUL';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->AUG == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->AUG == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->AUG_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'AUG';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', AUG';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $data['classes'][$i] = [
        //                 'class' => $cls,
        //                 'class_nm' => $cls_val->CLASS_NM,
        //                 'ADM_NO' => $adm_no,
        //                 'STU_NAME' => $val->stu_name,
        //                 'UNPAID_MONTH' => $UNPAID_MONTH,
        //                 'NO_UNPAID_MONTH' => $NO_UNPAID_MONTH,
        //                 'RATE' => $rate,
        //             ];


        //             $i = $i + 1;
        //         }


        //         if ($TOT_GEN_DUES > 0) {
        //             $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
        //         }
        //     }
        //     // echo '<pre>';print_r($data);die;
        //     $data['GRAND_TOT_DUES'] = $grand_total_dues;
        // }
        //-------------------------AUG FEES END-------------------------------//

        //-------------------------SEP FEES START-------------------------------//
        // else if ($month == 9) {

        //     $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
        //     $i = 1;
        //     foreach ($class as $cls_val) {

        //         $stu_list = $this->db->query("SELECT adm_no,concat_ws(' ',FIRST_NM,MIDDLE_NM,TITLE_NM)AS stu_name,
        //                 APR_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)AS APR_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.APR_FEE)>='$end_date','N/A',STUDENT.APR_FEE) AS APR_FEE_CHK, 
        //                 MAY_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)AS MAY_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.MAY_FEE)>='$end_date','N/A',STUDENT.MAY_FEE) AS MAY_FEE_CHK,
        //                 JUNE_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)AS JUNE_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JUNE_FEE)>='$end_date','N/A',STUDENT.JUNE_FEE) AS JUNE_FEE_CHK,
        //                 JULY_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)AS JULY_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.JULY_FEE)>='$end_date','N/A',STUDENT.JULY_FEE) AS JULY_FEE_CHK,
        //                 AUG_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)AS AUG_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.AUG_FEE)>='$end_date','N/A',STUDENT.AUG_FEE) AS AUG_FEE_CHK,
        //                 SEP_FEE, (SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.SEP_FEE)AS SEP_DATE, IF((SELECT RECT_DATE FROM DAYCOLL WHERE RECT_NO = STUDENT.SEP_FEE)>='$end_date','N/A',STUDENT.SEP_FEE) AS SEP_FEE_CHK,
        //                 SCHOLAR from student where CLASS='$cls_val->Class_No' AND adm_date<'$end_date' AND Student_Status = 'ACTIVE' AND EMP_WARD = 1 AND SEC NOT IN (17,21,22,23,24) HAVING SEP_FEE_CHK = 'N/A' ORDER BY CLASS;")->result();

        //         $GEN_COUNT = 0;
        //         $DUES_COUNT = 0;
        //         $TOT_GEN_DUES = 0;


        //         $feehdtype = $this->db->query("SELECT MONTHLY,CL_BASED,AMOUNT,EMP,CCL,SPL,EXT,INTERNAL,APR,MAY,JUN,JUL,AUG,SEP FROM FEEHEAD WHERE ACT_CODE=1")->result();

        //         $cls = $cls_val->Class_No;

        //         foreach ($stu_list as $val) {
        //             $NO_UNPAID_MONTH = 0;
        //             $UNPAID_MONTH = '';
        //             $adm_no = '';
        //             $adm_no = $val->adm_no;
        //             $ward = 1;
        //             $rate = 0;



        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->APR == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->APR == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->APR_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;

        //                 $UNPAID_MONTH = 'APR';
        //                 $NO_UNPAID_MONTH = 1;
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->MAY == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->MAY == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->MAY_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'MAY';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', MAY';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUN == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUN == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->JUNE_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'JUN';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', JUN';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }


        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->JUL == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->JUL == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->JULY_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'JUL';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', JUL';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->AUG == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->AUG == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->AUG == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->AUG_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'AUG';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', AUG';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $rate = 0;
        //             if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->SEP == 1) {

        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();
        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->SEP == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->SEP == 1) {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 1 && $feehdtype[0]->CL_BASED == 0 && $feehdtype[0]->SEP == 0) {
        //                 if ($ward == 1) {
        //                     $rate = 0;
        //                 }
        //             } else if ($feehdtype[0]->MONTHLY == 0 && $feehdtype[0]->CL_BASED == 1 && $feehdtype[0]->SEP == 0) {
        //                 $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls' AND FH='$feehd'")->result();

        //                 if ($ward == 1) {
        //                     $rate = $fhamt[0]->AMOUNT;
        //                 }
        //             } else {
        //                 if ($ward == 1) {
        //                     $rate = $feehdtype[0]->AMOUNT;
        //                 }
        //             }

        //             if ($val->SEP_FEE_CHK == 'N/A') {
        //                 $TOT_GEN_DUES = $TOT_GEN_DUES + $rate;
        //                 $DUES_COUNT  = $DUES_COUNT + 1;
        //                 if ($UNPAID_MONTH == '') {
        //                     $UNPAID_MONTH = 'SEP';
        //                     $NO_UNPAID_MONTH = 1;
        //                 } else {
        //                     $UNPAID_MONTH = $UNPAID_MONTH . ', SEP';
        //                     $NO_UNPAID_MONTH = $NO_UNPAID_MONTH + 1;
        //                 }
        //             }

        //             $data['classes'][$i] = [
        //                 'class' => $cls,
        //                 'class_nm' => $cls_val->CLASS_NM,
        //                 'ADM_NO' => $adm_no,
        //                 'STU_NAME' => $val->stu_name,
        //                 'UNPAID_MONTH' => $UNPAID_MONTH,
        //                 'NO_UNPAID_MONTH' => $NO_UNPAID_MONTH,
        //                 'RATE' => $rate,
        //             ];


        //             $i = $i + 1;
        //         }


        //         if ($TOT_GEN_DUES > 0) {
        //             $grand_total_dues = $grand_total_dues + $TOT_GEN_DUES;
        //         }
        //     }
        //     // echo '<pre>';print_r($data);die;
        //     $data['GRAND_TOT_DUES'] = $grand_total_dues;
        // }
        //-------------------------SEP FEES END-------------------------------//
        $this->load->view('Reconcilation/dues_calculate', $data);
    }
}
