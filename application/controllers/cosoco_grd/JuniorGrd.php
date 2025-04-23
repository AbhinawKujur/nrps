<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JuniorGrd extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Alam', 'alam');
        $this->load->model('Mymodel', 'dbcon');
    }

    public function cosoc($trm)
    {
        $user_id    = login_details['user_id'];
        $Class_No   = login_details['Class_No'];

        $class_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm', "Class_No IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14)");
        if ($trm == 1) {
            $examData = $this->alam->selectA('exammaster', '*', "examcode in (9,10)");
        } else {
            $examData = $this->alam->selectA('exammaster', '*', "examcode in (11,12)");
        }

        $array = array('class_data' => $class_data, 'examData' => $examData, 'trm' => $trm, 'Class_No' => $Class_No);



        // echo "<pre>";print_r($examData);die;

        $this->render_template('grade_entry/junior_grade', $array);
    }

    public function classess()
    {
        $user_id  = login_details['user_id'];
        $ret = '';
        $Class_No = '';
        // $ExamMode = '';
        $class = $this->input->post('val');



        $class_data = $this->dbcon->select('classes', 'Class_No', "Class_No='$class'");

        $Class_No = $class_data[0]->Class_No;


        $sec_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "Class_No = '$class'");

        $Section_No = login_details['Section_No'];

        $ret .= "<option value=''>Select</option>";
        if (isset($sec_data)) {
            foreach ($sec_data as $data) {
                if ($Section_No == $data['section_no']) {
                    $ret .= "<option value=" . $data['section_no'] . ">" . $data['secnm'] . "</option>";
                }
            }
        }

        $array = array($ret, $Class_No);
        echo json_encode($array);
    }

    public function getSubject()
    {
        $user_id = login_details['user_id'];
        $classs = $this->input->post('classs');
        $sec    = $this->input->post('sec');
        $subData = $this->alam->selectA('class_section_wise_subject_allocation', 'Class_No,section_no,subject_code,(SELECT SubName FROM subjects WHERE SubCode=class_section_wise_subject_allocation.subject_code)subjnm,Main_Teacher_Code', "Class_No = '$classs' AND section_no='$sec'");

?>
        <option value=''>Select</option>
        <?php
        foreach ($subData as $key => $val) {
        ?>
            <option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
<?php
        }
    }

    public function stu_list()
    {
        $sortval  = $this->input->post('sortval');
        if ($sortval == 'adm_no') {
            $data['sorting'] = 'ADM_NO';
            $sorting = 'ADM_NO';
        } else if ($sortval == 'stu_name') {
            $data['sorting'] = 'FIRST_NM';
            $sorting = 'FIRST_NM';
        } else {
            $data['sorting'] = 'ROLL_NO';
            $sorting = 'ROLL_NO';
        }

        $sub  = $this->input->post('sub');
        $data['sub']        = $this->input->post('sub');
        $trm                = $this->input->post('trm');
        $data['trm']        = $this->input->post('trm');
        $data['Class_No']   = $this->input->post('Class_No');
        $Class_No           = $this->input->post('Class_No');
        $data['sec']        = $this->input->post('sec');
        $sec                = $this->input->post('sec');
        $exm_code           = $this->input->post('exm_code');
        $data['exm_code']   = $this->input->post('exm_code');
        $data['modal']      = $this->input->post('modal');

        $data['skillData'] = $this->alam->selectA('student ', "ADM_NO,concat_ws(' ',first_nm,middle_nm,title_nm)STU_NAME,ROLL_NO,(select m2 from marks_junior where admno=student.adm_no and examc=$exm_code and scode=$sub and term=$trm and type=1)ORAL,(select m2 from marks_junior where admno=student.adm_no and examc=$exm_code and scode=$sub and term=$trm and type=2)WRITTEN,(select m2 from marks_junior where admno=student.adm_no and examc=$exm_code and scode=$sub and term=$trm and type=0)GRADE", "class=$Class_No and sec=$sec and student_status='ACTIVE' order by $sorting");

        $data['opt_code'] = $this->db->query("select opt_code from class_section_wise_subject_allocation where  Class_No = '$Class_No' AND section_no='$sec'and subject_code=$sub")->row_array();


        $this->load->view('grade_entry/load_marks_pnurtoprep', $data);
    }

    public function save_upd_validate()
    {
        $adm_no      = $this->input->post('admno[]');
        $classs      = $this->input->post('classs');
        $sec         = $this->input->post('sec');
        $opt_code     = $this->input->post('opt_code');
        $sub         = $this->input->post('sub');
        $trm         = $this->input->post('trm');
        $exm_code         = $this->input->post('exm_code');
        $user_id     = login_details['user_id'];

        $check_data = $this->db->query("select * from marks_junior where classes=$classs and sec=$sec and term=$trm and scode=$sub and examc=$exm_code")->result_array();

        
        if (!empty($check_data)) {
            $i = 1;
            $j = 0;
            if ($opt_code == 2) {
                foreach ($adm_no as $key => $val) {
                    while ($i <= $opt_code) {
                        $updData = array(
                            'm2' => $this->input->post('subskill_' . $key)[$j],
                            'teacher_code'  =>login_details['user_id']
                        );
                        $this->alam->update('marks_junior', $updData, "admno='$val' AND classes='$classs' AND sec='$sec' AND examc = '$exm_code' AND term='$trm' AND scode='$sub' AND type=$i");
                        $i++;
                        $j++;
                    }
                    $i = 1;
                    $j = 0;
                }
            } else if ($opt_code == 1) {
                foreach ($adm_no as $key => $val) {
                    $updData = array(
                        'm2' => $this->input->post('subskill_' . $key)[$j],
                        'teacher_code'  =>login_details['user_id']
                    );
                    $this->alam->update('marks_junior', $updData, "admno='$val' AND classes='$classs' AND sec='$sec' AND examc = '$exm_code' AND term='$trm' AND scode='$sub' AND type=$i");
                }
            } else {
                foreach ($adm_no as $key => $val) {
                    $updData = array(
                        'm2' => $this->input->post('subskill_' . $key)[$j],
                        'teacher_code'  =>login_details['user_id']
                    );
                    $this->alam->update('marks_junior', $updData, "admno='$val' AND classes='$classs' AND sec='$sec' AND examc = '$exm_code' AND term='$trm' AND scode='$sub' AND type=0");
                }
            }

        } else {
            $i = 1;
            $j = 0;
            if ($opt_code == 2) {
                foreach ($adm_no as $key => $val) {
                    while ($i <= $opt_code) {
                        $saveData = array(
                            'admno' => $val,
                            'examc' => $exm_code,
                            'scode' => $sub,
                            'classes' => $classs,
                            'sec' => $sec,
                            'term' => $trm,
                            'm2' => $this->input->post('subskill_' . $key)[$j],
                            'type'  => $i,
                            'edate' => date('Y-m-d'),
                            'teacher_code'  =>login_details['user_id']
                        );
                        $this->alam->insert('marks_junior', $saveData);
                        $i++;
                        $j++;
                    }
                    $i = 1;
                    $j = 0;
                }
            } else if ($opt_code == 1) {
                foreach ($adm_no as $key => $val) {
                    $saveData = array(
                        'admno' => $val,
                        'examc' => $exm_code,
                        'scode' => $sub,
                        'classes' => $classs,
                        'sec' => $sec,
                        'term' => $trm,
                        'm2' => $this->input->post('subskill_' . $key)[$j],
                        'type'  => $i,
                        'edate' => date('Y-m-d'),
                        'teacher_code'  =>login_details['user_id']
                    );
                    $this->alam->insert('marks_junior', $saveData);
                }
            } else {
                foreach ($adm_no as $key => $val) {
                    $saveData = array(
                        'admno' => $val,
                        'examc' => $exm_code,
                        'scode' => $sub,
                        'classes' => $classs,
                        'sec' => $sec,
                        'term' => $trm,
                        'm2' => $this->input->post('subskill_' . $key)[$j],
                        'type'  => 0,
                        'edate' => date('Y-m-d'),
                        'teacher_code'  =>login_details['user_id']
                    );
                    $this->alam->insert('marks_junior', $saveData);
                }
            }
        }
    }
}
