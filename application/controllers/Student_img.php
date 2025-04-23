<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_img extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('FARHEEN', 'farheen');
        $this->load->model('Mymodel', 'dbcon');
    }

    public function index()
    {
        $data['class'] = $class = $this->dbcon->select("classes", "*");
        $data['sec'] = $sec = $this->dbcon->select("sections", "*");
        $this->render_template('Student_img/upload_img', $data);
        // $this->load->view('Student_img/upload_img',$data);
    }
    public function find_sec()
    {
        $val = $this->input->post('val');
        $data = $this->dbcon->select_distinct('student', 'DISP_SEC,SEC', "CLASS='$val' AND Student_Status='ACTIVE'");
?>
        <option value=''>Select Section</option>
        <?php
        foreach ($data as $dt) {
        ?>
            <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
<?php
        }
    }
    public function show_details()
    {
        $class = $this->input->post('cls');
        $sec = $this->input->post('sec');
        $data['data'] = $this->dbcon->select_order_by("student", "FIRST_NM, ADM_NO, DISP_CLASS, DISP_SEC, ROLL_NO, student_image","ROLL_NO", "class='$class' AND sec='$sec' AND Student_Status='ACTIVE'");

        // echo $this->db->last_query();
        // echo '<pre>';
        // print_r($data);
        // die;

        $this->load->view('Student_img/details_', $data);
    }

    public function upload()
    {

        $studentId = $_POST['student_id'];
        $stu_id=$this->dbcon->select("student","STUDENTID","ADM_NO='$studentId'");
        // print_r($stu_id);die;
        $id=$stu_id[0]->STUDENTID;
       
        // Handle the image upload and database update
        if ($_FILES["stu_img"]["error"] == 0) {
           
            $image              = $_FILES['stu_img']['name'];
			$expimage           = explode('.', $image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count - 1];
			$image_name         = $id . '.' . $image_ext;
           // $target_file = $target_dir . basename($_FILES["stu_img"]["name"]);
            $target_file          = "assets/student_photo/" . $image_name;
            //move_uploaded_file($_FILES["stu_img"]["tmp_name"], $imagepath);

            if (move_uploaded_file($_FILES["stu_img"]["tmp_name"], $target_file)) {
                // Update the database with the new image path
                $studentId = $_POST['student_id']; // Assuming you have a student_id associated with each student
                $newImagePath = "assets/student_photo/" . $image_name ;
                
                // Update your database table with $newImagePath for the student with $studentId
                $upd_img=array(
                    'student_image' => $newImagePath
                );
                $this->dbcon->update("student",$upd_img,"ADM_NO='$studentId'");
                //echo $this->db->last_query();

                echo json_encode(['success' => true, 'message' => 'Image uploaded successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to move the uploaded file']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error uploading file']);
        }
    }
}
