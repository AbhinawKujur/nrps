<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StudentAttDelete extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Alam', 'alam');
    }
    public function index()
    {
        $data['log_cls_no'] = login_details['Class_No'];
        $data['log_sec_no'] = login_details['Section_No'];
        $user_id = login_details['user_id'];

        if (login_details['ROLE_ID'] == 4 || login_details['ROLE_ID'] == 8) {
            $data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm');
        } else {
            //$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm', "Main_Teacher_Code='$user_id'");
        }
        //echo '<pre>';print_r($data);die;
        $this->render_template('student/studentAttDelete', $data);
    }
    public function find_sec()
    {
        $user_id  = login_details['user_id'];
        $class_id = $this->input->post('class_id');

        $att_type = 0;
        $att_type_data = $this->alam->select('student_attendance_type', 'attendance_type', "class_code='$class_id'");
        $att_type = $att_type_data[0]->attendance_type;
        $subj = '';
        //$att_type = 3;
        if ($att_type == 3) {
            if (login_details['ROLE_ID'] == 4 || login_details['ROLE_ID'] == 8) {
                $subjData  = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm');
            } else {
                // $subjData  = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm', "Main_Teacher_Code='$user_id'");
            }

            $subj .= "<option value=''>Select</option>";
            if (isset($subjData)) {
                foreach ($subjData as $data) {
                    $subj .= "<option value=" . $data['subject_code'] . ">" . $data['subjnm'] . "</option>";
                }
            }
        }
        if (login_details['ROLE_ID'] == 4 || login_details['ROLE_ID'] == 8) {
            $sec_data  = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "Class_No = '$class_id'");
        } else {
            // $sec_data  = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "Main_Teacher_Code='$user_id' AND Class_No = '$class_id'");
        }



        $ret = "<option value=''>Select</option>";
        if (isset($sec_data)) {
            foreach ($sec_data as $data) {
                $ret .= "<option value=" . $data['section_no'] . ">" . $data['secnm'] . "</option>";
            }
        }

        $array = array($ret, $att_type, $subj);
        echo json_encode($array);
    }

    public function show_details()
    {
        $dt = $this->input->post('dt');
        $getdata['cls'] = $class = $this->input->post('classs');
        $getdata['sec'] = $sec = $this->input->post('sec');
        $date = strtotime($dt);
        $getdata['dt'] = $new_date = date('Y-m-d', $date);
        //echo $new_date;die;
        $getdata['getdata'] = $this->db->query("SELECT sae.admno, sae.att_status, st.FIRST_NM, st.DISP_CLASS, st.DISP_SEC, st.ROLL_NO, st.C_MOBILE 
          FROM stu_attendance_entry AS sae 
          INNER JOIN student AS st ON st.ADM_NO = sae.admno 
          WHERE sae.`class_code` = '$class' AND sae.`sec_code` = '$sec' AND sae.`att_date` = '$new_date';")->result_array();

        // echo '<pre>';print_r($getdata);die ;

        $this->load->view('student/studentAttDeleteShow', $getdata);
    }

    // public function delete()
    // {
    //     $dt=$this->input->post('dt');
    //     $cls=$this->input->post('cls');
    //     $sec=$this->input->post('sec');

    //     $delete=$this->db->query("DELETE FROM `stu_attendance_entry` WHERE class_code='$cls' AND sec_code='$sec' AND att_date='$dt'");
    //     if($delete)
    //     {
    //         echo "<script type='text/javascript'>alert('Deleted Successfully');document.location='index'</script>";
    //         // redirect('student/StudentAttDelete');
    //     }
    // }
    public function delete()
    {
        $dt = $this->input->post('dt');
        $cls = $this->input->post('cls');
        $sec = $this->input->post('sec');

        $user_id = login_details['user_id'];

        // Start transaction
        $this->db->trans_start();

        // Retrieve attendance data including adm_no
        $attendance_data = $this->db->query("SELECT att_status, admno, remarks FROM stu_attendance_entry WHERE class_code='$cls' AND sec_code='$sec' AND att_date='$dt'")->result();

        // Delete attendance entries
        $delete = $this->db->query("DELETE FROM `stu_attendance_entry` WHERE class_code='$cls' AND sec_code='$sec' AND att_date='$dt'");

        if ($delete) {
            // Log each entry in attendance_deletion_log
            foreach ($attendance_data as $data) {
                $this->db->query("INSERT INTO attendance_deletion_log (delete_cls, delete_sec, deleted_date, emp_id, att_status, admno, remarks) VALUES ('$cls', '$sec', '$dt', '$user_id', '{$data->att_status}', '{$data->admno}', '{$data->remarks}')");
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo "<script type='text/javascript'>alert('An error occurred during deletion');document.location='index'</script>";
            } else {
                echo "<script type='text/javascript'>alert('Deleted Successfully');document.location='index'</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Failed to delete attendance');document.location='index'</script>";
        }
    }
}
