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

        $grand_total_rcv = 0;

        if ($clss == 'all') {
            $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
        } else {
            $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
        }


        switch ($month) {
            case 4:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-05-01'));

                foreach ($class as $cls_val) {
                    // $stu_list = $this->db->query("SELECT ADM_NO,EMP_WARD,SCHOLAR,(SELECT HOUSENAME FROM EWARD WHERE HOUSENO=STUDENT.EMP_WARD) AS HOUSENAME,CLASS,apr_fee,(select rect_date from daycoll where rect_no=student.apr_fee) as apr_rect_date,(select $feehead from daycoll where  rect_no=student.apr_fee) as apr_$feehead FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();
                    // echo $this->db->last_query();die;

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();

                    // echo  $this->db->last_query();die;
                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }

                break;
            case 5:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-06-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 6:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-07-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 7:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-08-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 8:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-09-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 9:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-10-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 10:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-11-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 11:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-12-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 12:
                $end_date = date('Y-m-d', strtotime($new_sess . '-01-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 1:
                $end_date = date('Y-m-d', strtotime($new_sess . '-02-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 2:
                $end_date = date('Y-m-d', strtotime($new_sess . '-03-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 3:
                $end_date = date('Y-m-d', strtotime($new_sess . '-04-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
        }

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
        $data['School_Name'] = $school_setting[0]->School_Name;
        $data['School_Address'] = $school_setting[0]->School_Address;
        $data['School_Session'] = $school_setting[0]->School_Session;
        $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        if ($clss == 'all') {
            $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE CLASS_NO != 16 ORDER BY Class_No")->result();
        } else {
            $class = $this->db->query("SELECT Class_No,CLASS_NM FROM classes WHERE Class_No = $clss ORDER BY Class_No")->result();
        }

        $grand_total_rcv = 0;

        switch ($month) {
            case 4:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-05-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }

                break;
            case 5:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-06-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 6:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-07-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 7:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-08-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 8:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-09-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 9:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-10-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 10:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-11-01'));

                foreach ($class as $cls_val) {


                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 11:
                $end_date = date('Y-m-d', strtotime($curr_sess . '-12-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 12:
                $end_date = date('Y-m-d', strtotime($new_sess . '-01-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 1:
                $end_date = date('Y-m-d', strtotime($new_sess . '-02-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 2:
                $end_date = date('Y-m-d', strtotime($new_sess . '-03-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
            case 3:
                $end_date = date('Y-m-d', strtotime($new_sess . '-04-01'));

                foreach ($class as $cls_val) {

                    $stu_list = $this->db->query("SELECT COUNT(ADM_NO) AS CNT FROM STUDENT WHERE CLASS='$cls_val->Class_No'  AND STUDENT_STATUS='ACTIVE' AND ADM_DATE <'$end_date' AND SEC NOT IN (17,21,22,23,24) AND CLASS NOT IN (16) AND EMP_WARD = '$ward' ORDER BY EMP_WARD")->result();


                    $GEN_COUNT = 0;
                    $TOT_GEN_RCV = 0;

                    $fhamt = $this->db->query("SELECT AMOUNT,EMP,CCL,SPL,EXT,INTERNAL FROM FEE_CLW WHERE CL ='$cls_val->Class_No' AND FH='$feehd'")->result();

                    $GEN_RATE = $fhamt[0]->AMOUNT;

                    $GEN_COUNT = $stu_list[0]->CNT;

                    $TOT_GEN_RCV = $GEN_COUNT * $GEN_RATE;

                    $grand_total_rcv = $grand_total_rcv + $TOT_GEN_RCV;

                    $data['classes'][$cls_val->Class_No] = array(
                        'class' => $cls_val->Class_No,
                        'class_nm' => $cls_val->CLASS_NM,
                        'month' => 'APR',
                        'GEN_COUNT' => $GEN_COUNT,
                        'GEN_RATE'  => $GEN_RATE,
                        'TOT_GEN_RCV'   => $TOT_GEN_RCV,
                    );
                }
                break;
        }

        $data['GRAND_TOT_RCV'] = $grand_total_rcv;
        $this->load->view('Reconcilation/download_pdf', $data);

        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream("Reconcilation Headwise Receivable.pdf", array("Attachment" => 0));
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
            $end_date = $new_sess . '-01-01';
        } elseif ($mnth == 1) {
            $start_date = $curr_sess . '-12-31';
            $end_date = $new_sess . '-02-01';
        } elseif ($mnth == 2) {
            $start_date = $new_sess . '-01-31';
            $end_date = $new_sess . '-03-01';
        } elseif ($mnth == 3) {
            $start_date = $new_sess . '-02-30';
            $end_date = $new_sess . '-04-01';
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
            $end_date = $new_sess . '-01-01';
        } elseif ($mnth == 1) {
            $start_date = $curr_sess . '-12-31';
            $end_date = $new_sess . '-02-01';
        } elseif ($mnth == 2) {
            $start_date = $new_sess . '-01-31';
            $end_date = $new_sess . '-03-01';
        } elseif ($mnth == 3) {
            $start_date = $new_sess . '-02-30';
            $end_date = $new_sess . '-04-01';
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

    public function prev_month_payment()
    {
        $data['classes'] = $this->dbcon->select('classes', '*');
        $data['feehead'] = $this->dbcon->select('feehead', "act_code,fee_head");
        $data['ward'] = $this->dbcon->select('eward', "*");

        $this->fee_template('Reconcilation/prev_index', $data);
    }

    public function prev_month_calculate()
    {
        $data['feehead'] = $feehd = $this->input->post('feehead');
        $data['month'] = $mnth = $this->input->post('month');

        $feehead = 'FEE' . $feehd;

        $school_setting = $this->dbcon->select('school_setting', '*');
        $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        $mnth_nm = strtoupper(date('M', strtotime($curr_sess . '-' . $mnth . '-01')));

        if ($mnth == 4) {
            // $start_date = $curr_sess . '-03-31';
            $end_date = $curr_sess . '-04-01';
        } elseif ($mnth == 5) {
            // $start_date = $curr_sess . '-04-30';
            $end_date = $curr_sess . '-05-01';
        } elseif ($mnth == 6) {
            // $start_date = $curr_sess . '-05-31';
            $end_date = $curr_sess . '-06-01';
        } elseif ($mnth == 7) {
            // $start_date = $curr_sess . '-06-30';
            $end_date = $curr_sess . '-07-01';
        } elseif ($mnth == 8) {
            // $start_date = $curr_sess . '-07-31';
            $end_date = $curr_sess . '-08-01';
        } elseif ($mnth == 9) {
            // $start_date = $curr_sess . '-08-31';
            $end_date = $curr_sess . '-09-01';
        } elseif ($mnth == 10) {
            // $start_date = $curr_sess . '-09-30';
            $end_date = $curr_sess . '-10-01';
        } elseif ($mnth == 11) {
            // $start_date = $curr_sess . '-10-31';
            $end_date = $curr_sess . '-11-01';
        } elseif ($mnth == 12) {
            // $start_date = $curr_sess . '-11-30';
            $end_date = $curr_sess . '-12-01';
        } elseif ($mnth == 1) {
            // $start_date = $curr_sess . '-12-31';
            $end_date = $new_sess . '-01-01';
        } elseif ($mnth == 2) {
            // $start_date = $curr_sess . '-01-30';
            $end_date = $new_sess . '-02-01';
        } elseif ($mnth == 3) {
            // $start_date = $curr_sess . '-02-30';
            $end_date = $new_sess . '-03-01';
        }

        $daycoll_data = $this->db->query("SELECT ADM_NO,(SELECT CLASS_NO FROM CLASSES WHERE CLASS_NM = DAYCOLL.CLASS) AS CLASSS,RECT_NO,RECT_DATE,ADM_NO,PERIOD,$feehead FROM DAYCOLL WHERE DAYCOLL.RECT_DATE < '$end_date' AND DAYCOLL.ADM_NO <> 'NONE' AND $feehead <> 0 AND period like '%$mnth_nm%' ORDER BY RECT_DATE, RECT_NO;")->result();

        $grand_total_prev = 0;
        $i = 0;

        foreach ($daycoll_data as $val) {

            $prevcnt = 0;
            $tot_prev = 0;
            $rate = 0;
            $paid_mnth = 0;
            $amt = 0;

            $month = preg_split('/[-|,]/', $val->PERIOD);

            $paid_mnth = count($month);

            $amt = $val->$feehead;

            $rate = $amt / $paid_mnth;

            if ($rate > 0) {
                $data['adv_daycoll'][$i] = array(
                    'RECT_NO' => $val->RECT_NO,
                    'RECT_DATE' => $val->RECT_DATE,
                    'ADM_NO' => $val->ADM_NO,
                    'PERIOD' => $val->PERIOD,
                    'AMT' => $val->$feehead,
                    'MONTH_PAID' => $paid_mnth,
                    'RATE' => $rate,
                    'PREV_AMT' => $rate
                );

                $grand_total_prev = $grand_total_prev + $rate;
                $i++;
            }
        }

        $data['GRAND_TOT_PREV'] = $grand_total_prev;

        $this->load->view('Reconcilation/prev_calculate', $data);
    }

    public function downloadpdf_prev()
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

        $mnth_nm = strtoupper(date('M', strtotime($curr_sess . '-' . $mnth . '-01')));

        if ($mnth == 4) {
            // $start_date = $curr_sess . '-03-31';
            $end_date = $curr_sess . '-04-01';
        } elseif ($mnth == 5) {
            // $start_date = $curr_sess . '-04-30';
            $end_date = $curr_sess . '-05-01';
        } elseif ($mnth == 6) {
            // $start_date = $curr_sess . '-05-31';
            $end_date = $curr_sess . '-06-01';
        } elseif ($mnth == 7) {
            // $start_date = $curr_sess . '-06-30';
            $end_date = $curr_sess . '-07-01';
        } elseif ($mnth == 8) {
            // $start_date = $curr_sess . '-07-31';
            $end_date = $curr_sess . '-08-01';
        } elseif ($mnth == 9) {
            // $start_date = $curr_sess . '-08-31';
            $end_date = $curr_sess . '-09-01';
        } elseif ($mnth == 10) {
            // $start_date = $curr_sess . '-09-30';
            $end_date = $curr_sess . '-10-01';
        } elseif ($mnth == 11) {
            // $start_date = $curr_sess . '-10-31';
            $end_date = $curr_sess . '-11-01';
        } elseif ($mnth == 12) {
            // $start_date = $curr_sess . '-11-30';
            $end_date = $curr_sess . '-12-01';
        } elseif ($mnth == 1) {
            // $start_date = $curr_sess . '-12-31';
            $end_date = $new_sess . '-01-01';
        } elseif ($mnth == 2) {
            // $start_date = $curr_sess . '-01-30';
            $end_date = $new_sess . '-02-01';
        } elseif ($mnth == 3) {
            // $start_date = $curr_sess . '-02-30';
            $end_date = $new_sess . '-03-01';
        }

        $daycoll_data = $this->db->query("SELECT ADM_NO,(SELECT CLASS_NO FROM CLASSES WHERE CLASS_NM = DAYCOLL.CLASS) AS CLASSS,RECT_NO,RECT_DATE,ADM_NO,PERIOD,$feehead FROM DAYCOLL WHERE DAYCOLL.RECT_DATE < '$end_date' AND DAYCOLL.ADM_NO <> 'NONE' AND $feehead <> 0 AND period like '%$mnth_nm%' ORDER BY RECT_DATE, RECT_NO;")->result();

        $grand_total_prev = 0;
        $i = 0;

        foreach ($daycoll_data as $val) {

            $prevcnt = 0;
            $tot_prev = 0;
            $rate = 0;
            $paid_mnth = 0;
            $amt = 0;

            $month = preg_split('/[-|,]/', $val->PERIOD);

            $paid_mnth = count($month);

            $amt = $val->$feehead;

            $rate = $amt / $paid_mnth;

            if ($rate > 0) {
                $data['adv_daycoll'][$i] = array(
                    'RECT_NO' => $val->RECT_NO,
                    'RECT_DATE' => $val->RECT_DATE,
                    'ADM_NO' => $val->ADM_NO,
                    'PERIOD' => $val->PERIOD,
                    'AMT' => $val->$feehead,
                    'MONTH_PAID' => $paid_mnth,
                    'RATE' => $rate,
                    'PREV_AMT' => $rate
                );

                $grand_total_prev = $grand_total_prev + $rate;
                $i++;
            }
        }

        $data['GRAND_TOT_PREV'] = $grand_total_prev;

        $this->load->view('Reconcilation/download_pdf_prev', $data);
    }

    public function actual()
    {
        $data['classes'] = $this->dbcon->select('classes', '*');
        $data['feehead'] = $this->dbcon->select('feehead', "act_code,fee_head");
        $data['ward'] = $this->dbcon->select('eward', "*");

        $this->fee_template('Reconcilation/actual_index', $data);
    }

    public function actual_calculate()
    {
        $data['feehead'] = $feehd = $this->input->post('feehead');
        $data['month'] = $mnth = $this->input->post('month');
        $data['coll_mode'] = $coll_mode = $this->input->post('coll_mode');

        $feehead = 'FEE' . $feehd;

        $school_setting = $this->dbcon->select('school_setting', '*');
        $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        $mnth_nm = strtoupper(date('M', strtotime($curr_sess . '-' . $mnth . '-01')));

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
            $end_date = $new_sess . '-01-01';
        } elseif ($mnth == 1) {
            $start_date = $curr_sess . '-12-31';
            $end_date = $new_sess . '-02-01';
        } elseif ($mnth == 2) {
            $start_date = $new_sess . '-01-31';
            $end_date = $new_sess . '-03-01';
        } elseif ($mnth == 3) {
            $start_date = $new_sess . '-02-30';
            $end_date = $new_sess . '-04-01';
        }

        if ($coll_mode != 'ALL')
        {
            $daycoll_data = $this->db->query("SELECT ADM_NO,(SELECT CLASS_NO FROM CLASSES WHERE CLASS_NM = DAYCOLL.CLASS) AS CLASSS,RECT_NO,RECT_DATE,ADM_NO,PERIOD,$feehead FROM DAYCOLL WHERE DAYCOLL.RECT_DATE > '$start_date' AND DAYCOLL.RECT_DATE < '$end_date' AND DAYCOLL.ADM_NO <> 'NONE' AND $feehead <> 0  AND RECT_NO LIKE '$coll_mode%' ORDER BY RECT_DATE, RECT_NO;")->result();
        }
        else
        {
            $daycoll_data = $this->db->query("SELECT ADM_NO,(SELECT CLASS_NO FROM CLASSES WHERE CLASS_NM = DAYCOLL.CLASS) AS CLASSS,RECT_NO,RECT_DATE,ADM_NO,PERIOD,$feehead FROM DAYCOLL WHERE DAYCOLL.RECT_DATE > '$start_date' AND DAYCOLL.RECT_DATE < '$end_date' AND DAYCOLL.ADM_NO <> 'NONE' AND $feehead <> 0  ORDER BY RECT_DATE, RECT_NO;")->result();
        }
        

        $grand_total_act = 0;
        $i = 0;

        foreach ($daycoll_data as $val) {

            $amt = 0;

            $amt = $val->$feehead;


            if ($amt > 0) {
                $data['adv_daycoll'][$i] = array(
                    'RECT_NO' => $val->RECT_NO,
                    'RECT_DATE' => $val->RECT_DATE,
                    'ADM_NO' => $val->ADM_NO,
                    'PERIOD' => $val->PERIOD,
                    'AMT' => $val->$feehead,
                );

                $grand_total_act = $grand_total_act + $amt;
                $i++;
            }
        }
        $data['GRAND_TOT_ACT'] = $grand_total_act;

        $this->load->view('Reconcilation/actual_calculate', $data);
    }

    public function downloadpdf_act()
    {
        $data['feehead'] = $feehd = $this->input->post('feehead');
        $data['month'] = $mnth = $this->input->post('month');
        $data['coll_mode'] = $coll_mode = $this->input->post('coll_mode');

        $feehead = 'FEE' . $feehd;

        $school_setting = $this->dbcon->select('school_setting', '*');
        $data['School_Name'] = $school_setting[0]->School_Name;
        $data['School_Address'] = $school_setting[0]->School_Address;
        $data['School_Session'] = $school_setting[0]->School_Session;

        $data['curr_sess'] = $curr_sess = substr($school_setting[0]->School_Session, 0, 4);
        $data['new_sess']  = $new_sess = substr($school_setting[0]->School_Session, 5, 4);

        $mnth_nm = strtoupper(date('M', strtotime($curr_sess . '-' . $mnth . '-01')));

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
            $end_date = $new_sess . '-01-01';
        } elseif ($mnth == 1) {
            $start_date = $curr_sess . '-12-31';
            $end_date = $new_sess . '-02-01';
        } elseif ($mnth == 2) {
            $start_date = $new_sess . '-01-31';
            $end_date = $new_sess . '-03-01';
        } elseif ($mnth == 3) {
            $start_date = $new_sess . '-02-30';
            $end_date = $new_sess . '-04-01';
        }

        if ($coll_mode != 'ALL')
        {
            $daycoll_data = $this->db->query("SELECT ADM_NO,(SELECT CLASS_NO FROM CLASSES WHERE CLASS_NM = DAYCOLL.CLASS) AS CLASSS,RECT_NO,RECT_DATE,ADM_NO,PERIOD,$feehead FROM DAYCOLL WHERE DAYCOLL.RECT_DATE > '$start_date' AND DAYCOLL.RECT_DATE < '$end_date' AND DAYCOLL.ADM_NO <> 'NONE' AND $feehead <> 0  AND RECT_NO LIKE '$coll_mode%' ORDER BY RECT_DATE, RECT_NO;")->result();
        }
        else
        {
            $daycoll_data = $this->db->query("SELECT ADM_NO,(SELECT CLASS_NO FROM CLASSES WHERE CLASS_NM = DAYCOLL.CLASS) AS CLASSS,RECT_NO,RECT_DATE,ADM_NO,PERIOD,$feehead FROM DAYCOLL WHERE DAYCOLL.RECT_DATE > '$start_date' AND DAYCOLL.RECT_DATE < '$end_date' AND DAYCOLL.ADM_NO <> 'NONE' AND $feehead <> 0  ORDER BY RECT_DATE, RECT_NO;")->result();
        }

        $grand_total_act = 0;
        $i = 0;

        foreach ($daycoll_data as $val) {

            $amt = 0;

            $amt = $val->$feehead;


            if ($amt > 0) {
                $data['adv_daycoll'][$i] = array(
                    'RECT_NO' => $val->RECT_NO,
                    'RECT_DATE' => $val->RECT_DATE,
                    'ADM_NO' => $val->ADM_NO,
                    'PERIOD' => $val->PERIOD,
                    'AMT' => $val->$feehead,
                );

                $grand_total_act = $grand_total_act + $amt;
                $i++;
            }
        }
        $data['GRAND_TOT_ACT'] = $grand_total_act;

        $this->load->view('Reconcilation/download_pdf_act', $data);
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
